<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Api\OnepayController;
use App\Http\Controllers\Controller;
use App\Http\Services\PaymentServices;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\AdminLedger;
use App\Models\User;
use App\Models\UserLedger;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class ManageWithdrawController extends Controller
{
    public function processWithdraw()
    {
        $title = 'Processing';
        $withdraws = Withdrawal::with(['user', 'payment_method'])->where('status', 'processing')->orderByDesc('id')->get();
        return view('admin.pages.withdraw.list', compact('withdraws', 'title'));
    }

    public function pendingWithdraw ()
    {
        $title = 'Pending';
        $withdraws = Withdrawal::with(['user', 'payment_method'])->where('status', 'pending')->orderByDesc('id')->get();
        return view('admin.pages.withdraw.list', compact('withdraws', 'title'));
    }

    public function rejectedWithdraw()
    {
        $title = 'Rejected';
        $withdraws = Withdrawal::with(['user', 'payment_method'])->where('status', 'rejected')->orderByDesc('id')->get();
        return view('admin.pages.withdraw.list', compact('withdraws', 'title'));
    }

    public function approvedWithdraw()
    {
        $title = 'Approved';
        $withdraws = Withdrawal::with(['user', 'payment_method'])->where('status', 'approved')->orderByDesc('id')->get();
        return view('admin.pages.withdraw.list', compact('withdraws', 'title'));
    }

    /*public function processWithdraw()
    {
        $title = 'Process';
        $withdraws = Withdrawal::with(['user', 'payment_method'])->where('status', 'processing')->orderByDesc('id')->get();
        return view('admin.pages.withdraw.list', compact('withdraws', 'title'));
    }*/

    public function withdrawStatus(Request $request, $id, PaymentServices $payment)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'note' => 'nullable|string|max:1000',
        ]);

        $withdraw = Withdrawal::with('user')->findOrFail($id);

        if ($withdraw->status !== 'pending') {
            return redirect()->back()->with('error', 'This withdrawal has already been processed.');
        }

        if ($request->status === 'rejected') {
            DB::transaction(function () use ($withdraw, $request) {
                $locked = Withdrawal::whereKey($withdraw->id)->lockForUpdate()->firstOrFail();

                if ($locked->status !== 'pending') {
                    throw new \RuntimeException('This withdrawal has already been processed.');
                }

                $lockedUser = User::whereKey($locked->user_id)->lockForUpdate()->firstOrFail();
                $lockedUser->balance = (float) $lockedUser->balance + (float) $locked->amount;
                $lockedUser->save();

                $locked->status = 'rejected';
                $locked->admin_feedback = $request->note ?: 'Withdrawal rejected by administrator.';
                $locked->save();
            });

            return redirect()->back()->with('success', 'Withdrawal rejected and the user balance was refunded.');
        }

        // Lock the request as processing before the external call so a double-click
        // or concurrent admin action cannot create two gateway payouts.
        DB::transaction(function () use ($withdraw, $request) {
            $locked = Withdrawal::whereKey($withdraw->id)->lockForUpdate()->firstOrFail();
            if ($locked->status !== 'pending') {
                throw new \RuntimeException('This withdrawal has already been processed.');
            }
            $locked->status = 'processing';
            $locked->admin_feedback = $request->note ?: 'Manual approval submitted to payment gateway.';
            $locked->save();
        });

        $account = json_decode($withdraw->account_info, true) ?: [];
        $gatewayMethod = $account['bank_code'] ?? $withdraw->method_name;
        $accountNumber = $account['bank_account'] ?? $withdraw->number;
        $accountName = $account['full_name'] ?? ($withdraw->user->realname ?? $withdraw->user->username);

        $transfer = $payment->gatewayPayout(
            $withdraw->trx,
            $withdraw->currency ?: 'NGN',
            $withdraw->final_amount,
            $withdraw->method_name,
            $gatewayMethod,
            $accountNumber,
            $accountName,
            'Manual approval payout for ' . $accountName
        );

        if (!$transfer['status']) {
            // Explicit provider rejection: refund and close the request.
            DB::transaction(function () use ($withdraw, $transfer) {
                $locked = Withdrawal::whereKey($withdraw->id)->lockForUpdate()->firstOrFail();
                if ($locked->status !== 'processing') {
                    return;
                }

                $lockedUser = User::whereKey($locked->user_id)->lockForUpdate()->firstOrFail();
                $lockedUser->balance = (float) $lockedUser->balance + (float) $locked->amount;
                $lockedUser->save();

                $locked->status = 'rejected';
                $locked->admin_feedback = 'Gateway payout failed: ' . $transfer['message'];
                $locked->save();
            });

            return redirect()->back()->with('error', 'Gateway payout failed: ' . $transfer['message']);
        }

        $gatewayReference = $transfer['data']['order_ref'] ?? null;
        $withdraw->status = 'approved';
        $withdraw->admin_feedback = ($request->note ?: 'Approved and sent to payment gateway.')
            . ($gatewayReference ? ' Gateway ref: ' . $gatewayReference : '');
        $withdraw->save();

        return redirect()->back()->with('success', 'Withdrawal approved and sent to the payment gateway.');
    }

}
