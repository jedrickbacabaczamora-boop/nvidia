<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Services\PaymentServices;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\UserLedger;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Deposit;
use App\Models\Purchase;
use App\Models\Setting;
use Carbon\Carbon;

class WithdrawController extends Controller
{
    public function withdraw_history()
    {
        $withdraws = Withdrawal::where('user_id', auth()->id())
            ->orderByDesc('id')
            ->get();

        return view('app.main.withdraw_history', compact('withdraws'));
    }

    public function withdraw()
    {
    $setting = \App\Models\Setting::first();
    $minWithdraw = $setting->minimum_withdraw ?? 0;
    $maxWithdraw = $setting->maximum_withdraw ?? 0;
    $withdrawCharge = $setting->withdraw_charge ?? 0;

    if (auth()->user()->gateway_method && auth()->user()->gateway_address) {
        return view('app.main.withdraw.index', compact('minWithdraw', 'maxWithdraw', 'withdrawCharge'));
    } else {
        return redirect()->route('user.bank')->with('success', 'First create a bank account');
    }
    }

    public function withdrawRequest(Request $request, PaymentServices $payment)
    {
        $now = Carbon::now('Africa/Harare');

        if ($now->hour < 10 || $now->hour >= 16) {
            return redirect()->back()->with('error', 'Withdrawals are allowed only between 10:00 AM and 4:00 PM.');
        }

        $dailyWithdrawCount = Withdrawal::where('user_id', auth()->id())
            ->whereDate('created_at', Carbon::today())
            ->count();

        if ($dailyWithdrawCount >= 2) {
            return redirect()->back()->with('error', 'You can only withdraw 2 times per day.');
        }

        $validate = Validator::make($request->all(), [
            'amount' => 'required|numeric|gt:0',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $setting = Setting::first();
        $amount = (float) $request->amount;
        $user = auth()->user();

        $payments = Deposit::where('user_id', $user->id)->where('status', 'approved')->count();
        if ($payments < 1) {
            return redirect()->back()->with('error', "You can't withdraw before depositing.");
        }

        if (!Purchase::where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', "You need to invest before withdrawing.");
        }

        if (!$setting || $setting->open_transfer != 1) {
            return redirect()->back()->with('error', 'Withdrawals are currently disabled. Try again later.');
        }

        if ($amount > (float) $user->balance) {
            return redirect()->back()->with('error', 'Insufficient balance for withdrawal.');
        }

        if ($amount < (float) $setting->minimum_withdraw) {
            return redirect()->back()->with('error', 'Minimum withdrawal is ₦' . number_format($setting->minimum_withdraw, 2));
        }

        if ($amount > (float) $setting->maximum_withdraw) {
            return redirect()->back()->with('error', 'Maximum withdrawal is ₦' . number_format($setting->maximum_withdraw, 2));
        }

        if (!$user->gateway_method || !$user->gateway_address || !$user->realname) {
            return redirect()->back()->with('error', 'Please complete your payout account details before withdrawing.');
        }

        $charge = $setting->withdraw_charge > 0
            ? ($amount * (float) $setting->withdraw_charge) / 100
            : 0;
        $finalAmount = round($amount - $charge, 2);
        $reference = 'W' . strtoupper(Str::random(18));
        $autoTransfer = (int) $setting->auto_transfer === 1;
        $statusId = $autoTransfer ? 'processing' : 'pending';
        $statusText = $autoTransfer
            ? 'Your withdrawal was submitted to the payment gateway.'
            : 'Withdraw request under review.';

        // Persist the withdrawal BEFORE calling the gateway. This prevents a fast
        // gateway callback from arriving before its transaction record exists.
        try {
            $withdrawal = DB::transaction(function () use ($user, $amount, $charge, $finalAmount, $reference, $statusId, $setting) {
                $lockedUser = User::whereKey($user->id)->lockForUpdate()->firstOrFail();

                if ((float) $lockedUser->balance < $amount) {
                    throw new \RuntimeException('Insufficient balance for withdrawal.');
                }

                $lockedUser->balance = (float) $lockedUser->balance - $amount;
                $lockedUser->save();

                $paymentMethod = PaymentMethod::where('tag', $setting->auto_transfer_default)->first();

                $withdrawal = new Withdrawal();
                $withdrawal->user_id = $lockedUser->id;
                $withdrawal->method_name = $paymentMethod->name ?? '---';
                $withdrawal->trx = $reference;
                $withdrawal->account_info = json_encode([
                    'bank_account' => $lockedUser->gateway_address,
                    'full_name' => $lockedUser->realname,
                    'bank_name' => $lockedUser->bank_name,
                    'bank_code' => $lockedUser->gateway_method,
                ]);
                $withdrawal->number = $lockedUser->gateway_address;
                $withdrawal->amount = $amount;
                $withdrawal->currency = 'NGN';
                $withdrawal->charge = $charge;
                $withdrawal->oid = 'W-' . strtoupper(Str::random(24));
                $withdrawal->final_amount = $finalAmount;
                $withdrawal->status = $statusId;
                $withdrawal->admin_feedback = $statusId === 'processing' ? 'Automatic gateway payout submitted.' : null;
                $withdrawal->saveOrFail();

                $ledger = new UserLedger();
                $ledger->user_id = $lockedUser->id;
                $ledger->reason = 'withdraw_request';
                $ledger->perticulation = $lockedUser->bank_name . ' ' . $lockedUser->gateway_address;
                $ledger->amount = $amount;
                $ledger->debit = $finalAmount;
                $ledger->status = 'approved';
                $ledger->date = now()->format('Y-m-d H:i');
                $ledger->save();

                return $withdrawal;
            });
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        if ($autoTransfer) {
            $transfer = $payment->gatewayPayout(
                $withdrawal->trx,
                'NGN',
                $finalAmount,
                $setting->auto_transfer_default,
                $user->gateway_method,
                $user->gateway_address,
                $user->realname
            );

            if (!$transfer['status']) {
                // The gateway explicitly rejected the request. Return the funds and
                // mark the request rejected. Unknown network failures are surfaced
                // as processing only if the gateway service itself cannot determine
                // the outcome; the provider should be reconciled before retrying.
                DB::transaction(function () use ($withdrawal, $user, $transfer) {
                    $locked = Withdrawal::whereKey($withdrawal->id)->lockForUpdate()->first();
                    if (!$locked || in_array($locked->status, ['approved', 'rejected'], true)) {
                        return;
                    }

                    $locked->status = 'rejected';
                    $locked->admin_feedback = 'Automatic payout failed: ' . $transfer['message'];
                    $locked->save();

                    $lockedUser = User::whereKey($user->id)->lockForUpdate()->first();
                    $lockedUser->balance = (float) $lockedUser->balance + (float) $locked->amount;
                    $lockedUser->save();
                });

                return redirect()->back()->with('error', $transfer['message']);
            }

            $gatewayReference = $transfer['data']['order_ref'] ?? null;
            $withdrawal->status = 'approved';
            $withdrawal->admin_feedback = 'Automatic payout accepted by the payment gateway.';
            if ($gatewayReference) {
                $withdrawal->admin_feedback .= ' Gateway ref: ' . $gatewayReference;
            }
            $withdrawal->save();
            $statusText = 'Your withdrawal has been approved and sent to the payment gateway.';
        }

        return redirect()->back()->with('success', $statusText);
    }

    public function withdrawPreview()
    {
        $withdraws = Withdrawal::with('payment_method')
            ->where('user_id', Auth::id())
            ->orderByDesc('id')
            ->get();

        return view('app.main.withdraw_history', compact('withdraws'));
    }
}
