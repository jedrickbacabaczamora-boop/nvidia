<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Purchase;
use App\Models\Rebate;
use App\Models\User;
use App\Models\SpinChance;
use App\Models\UserLedger;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function purchaseConfirmation($id)
    {
        try {
            $package = Package::find($id);
            $user = Auth::user();
            $rebate = Rebate::first();

            if (!$package) {
                return back()->with('error', "Package not found.");
            }

            if ($package->status !== 'active') {
                return back()->with('error', "Package is inactive.");
            }

            if ($package->vip_level < $user->vip_level) {
                return back()->with('error', "You cannot downgrade to a lower VIP package.");
            }

            $userPurchaseCount = Purchase::where('user_id', $user->id)
                ->where('package_id', $package->id)
                ->count();

            if ($userPurchaseCount >= $package->max_purchase_limit) {
                return back()->with('error', "You have reached the maximum purchase limit of {$package->max_purchase_limit} for this package.");
            }

            /*if (!$this->checkIfCanBuyPackage($user, $package)) {
                return back()->with('error', "You must purchase the required packages first.");
            }*/

            if ($package->price > $user->balance) {
                return back()->with('error', "You currently have low balance.");
            }

            // Deduct user balance and mark as investor
            User::where('id', $user->id)->update([
                'balance' => $user->balance - $package->price,
                'investor' => 1
            ]);

            // Create Purchase
            $purchase = new Purchase();
            $purchase->user_id = $user->id;
            $purchase->package_id = $package->id;
            $purchase->amount = $package->price;
            $purchase->daily_income = $package->commission_with_avg_amount / $package->validity;
            $purchase->hourly = ($package->commission_with_avg_amount / $package->validity) / 24;
            $purchase->date = now()->addHours(24);
            $purchase->validity = Carbon::now()->addDays($package->validity);
            $purchase->status = 'active';
            $purchase->save();

            // 🧾 Save purchase to UserLedger
            $ledger = new UserLedger();
            $ledger->user_id = $user->id;
            $ledger->reason = 'purchase';
            $ledger->perticulation = 'Purchased package: ' . $package->name;
            $ledger->amount = $package->price;
            $ledger->debit = $package->price;
            $ledger->credit = 0;
            $ledger->status = 'approved';
            $ledger->date = now();
            $ledger->step = 'purchase';
            $ledger->save();

            // 🔼 VIP Upgrade
            $totalInvestment = Purchase::where('user_id', $user->id)->sum('amount');
            $vipLevel = 0;

            if ($totalInvestment >= 256000000) $vipLevel = 10;
            elseif ($totalInvestment >= 128000000) $vipLevel = 9;
            elseif ($totalInvestment >= 64000000) $vipLevel = 8;
            elseif ($totalInvestment >= 3200000) $vipLevel = 7;
            elseif ($totalInvestment >= 150000) $vipLevel = 6;
            elseif ($totalInvestment >= 78000) $vipLevel = 5;
            elseif ($totalInvestment >= 35000) $vipLevel = 4;
            elseif ($totalInvestment >= 10000) $vipLevel = 3;
            elseif ($totalInvestment >= 2000) $vipLevel = 2;
            elseif ($totalInvestment >= 500) $vipLevel = 1;

            if ($vipLevel > $user->vip_level) {
                $user->vip_level = $vipLevel;
                $user->save();
            }

            // 🎰 Add Spin Chance
            SpinChance::updateOrCreate(
                ['user_id' => $user->id],
                ['chances' => \DB::raw('chances + 1')]
            );

            // 👥 Commission distribution
            $this->distributeCommission($user, $package, $rebate);

            return back()->with('success', 'Investment successful.');

        } catch (\Exception $e) {
            return back()->with('error', "Unexpected error: " . $e->getMessage());
        }
    }

    protected function checkIfCanBuyPackage($user, $package)
    {
        $purchased = Purchase::where('user_id', $user->id)->pluck('package_id')->toArray();

        switch ($package->category) {
            case 'welfare':
                $fixed = Package::where('category', 'fixed')->first();
                return $fixed && in_array($fixed->id, $purchased);
            case 'activity':
                $fixed = Package::where('category', 'fixed')->first();
                $welfare = Package::where('category', 'welfare')->first();
                return $fixed && in_array($fixed->id, $purchased) &&
                       $welfare && in_array($welfare->id, $purchased);
            default:
                return true;
        }
    }

    protected function distributeCommission($user, $package, $rebate)
    {
        $first = User::where('ref_id', $user->ref_by)->first();
        if ($first) {
            $amount = $package->price * $rebate->team_commission1 / 100;
            User::where('id', $first->id)->increment('balance', $amount);

            $this->saveCommissionLedger($first->id, $user->id, 'First Level Commission', 'first', $amount);

            $this->secondLevelCommission($first, $package, $rebate, $user);
        }
    }

    protected function secondLevelCommission($first, $package, $rebate, $user)
    {
        $second = User::where('ref_id', $first->ref_by)->first();
        if ($second) {
            $amount = $package->price * $rebate->team_commission2 / 100;
            User::where('id', $second->id)->increment('balance', $amount);

            $this->saveCommissionLedger($second->id, $user->id, 'Second Level Commission', 'second', $amount);

            $this->thirdLevelCommission($second, $package, $rebate, $user);
        }
    }

    protected function thirdLevelCommission($second, $package, $rebate, $user)
    {
        $third = User::where('ref_id', $second->ref_by)->first();
        if ($third) {
            $amount = $package->price * $rebate->team_commission3 / 100;
            User::where('id', $third->id)->increment('balance', $amount);

            $this->saveCommissionLedger($third->id, $user->id, 'Third Level Commission', 'third', $amount);
        }
    }

    protected function saveCommissionLedger($userId, $fromUserId, $text, $step, $amount)
    {
        $ledger = new UserLedger();
        $ledger->user_id = $userId;
        $ledger->get_balance_from_user_id = $fromUserId;
        $ledger->reason = 'commission';
        $ledger->perticulation = $text;
        $ledger->amount = $amount;
        $ledger->credit = $amount;
        $ledger->debit = 0;
        $ledger->status = 'approved';
        $ledger->step = $step;
        $ledger->date = now();
        $ledger->save();
    }

    public function vip_confirm($vip_id)
    {
        $vip = Package::find($vip_id);
        return view('app.main.vip_confirm', compact('vip'));
    }
}
