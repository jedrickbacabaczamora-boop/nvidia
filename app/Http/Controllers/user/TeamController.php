<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Checkin;
use App\Models\Commission;
use App\Models\Deposit;
use App\Models\Improvment;
use App\Models\LuckyLedger;
use App\Models\Purchase;
use App\Models\User;
use App\Models\UserLedger;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    //
    public function team()
{
    $user = Auth::user();

    // ------------------ FIRST LEVEL ------------------
    $first_level_users = User::where('ref_by', $user->ref_id)->get();
    $first_level_users_ids = $first_level_users->pluck('id')->toArray();

    foreach ($first_level_users as $u) {
        $u->is_active = Deposit::where('user_id', $u->id)->where('status', 'approved')->exists()
                        || Purchase::where('user_id', $u->id)->exists() ? 'Active' : 'Inactive';
    }

    // ------------------ SECOND LEVEL ------------------
    $second_level_users = collect();
    $second_level_users_ids = [];

    foreach ($first_level_users as $element) {
        $users = User::where('ref_by', $element->ref_id)->get();

        foreach ($users as $u) {
            $u->is_active = Deposit::where('user_id', $u->id)->where('status', 'approved')->exists()
                            || Purchase::where('user_id', $u->id)->exists() ? 'Active' : 'Inactive';

            $second_level_users->push($u);
            $second_level_users_ids[] = $u->id;
        }
    }

    // ------------------ THIRD LEVEL ------------------
    $third_level_users = collect();
    $third_level_users_ids = [];

    foreach ($second_level_users as $element) {
        $users = User::where('ref_by', $element->ref_id)->get();

        foreach ($users as $u) {
            $u->is_active = Deposit::where('user_id', $u->id)->where('status', 'approved')->exists()
                            || Purchase::where('user_id', $u->id)->exists() ? 'Active' : 'Inactive';

            $third_level_users->push($u);
            $third_level_users_ids[] = $u->id;
        }
    }

    // ------------------ SUMMARY DATA ------------------
    $team_size = count($first_level_users_ids) + count($second_level_users_ids) + count($third_level_users_ids);

    $first_ids = collect($first_level_users_ids);
    $second_ids = collect($second_level_users_ids);
    $third_ids = collect($third_level_users_ids);

    $lv1Recharge = Deposit::whereIn('user_id', $first_ids)->where('status', 'approved')->sum('amount');
    $lv2Recharge = Deposit::whereIn('user_id', $second_ids)->where('status', 'approved')->sum('amount');
    $lv3Recharge = Deposit::whereIn('user_id', $third_ids)->where('status', 'approved')->sum('amount');
    $lvTotalDeposit = $lv1Recharge + $lv2Recharge + $lv3Recharge;

    $lv1PendingRecharge = Deposit::whereIn('user_id', $first_ids)->where('status', 'pending')->sum('amount');
    $lv2PendingRecharge = Deposit::whereIn('user_id', $second_ids)->where('status', 'pending')->sum('amount');
    $lv3PendingRecharge = Deposit::whereIn('user_id', $third_ids)->where('status', 'pending')->sum('amount');
    $lvTotalPendingDeposit = $lv1PendingRecharge + $lv2PendingRecharge + $lv3PendingRecharge;

    $lv1Withdraw = Withdrawal::whereIn('user_id', $first_ids)->where('status', 'approved')->sum('amount');
    $lv2Withdraw = Withdrawal::whereIn('user_id', $second_ids)->where('status', 'approved')->sum('amount');
    $lv3Withdraw = Withdrawal::whereIn('user_id', $third_ids)->where('status', 'approved')->sum('amount');
    $lvTotalWithdraw = $lv1Withdraw + $lv2Withdraw + $lv3Withdraw;

    $activeMembers1 = Deposit::whereIn('user_id', $first_ids)->where('status', 'approved')->groupBy('user_id')->count();
    $activeMembers2 = Deposit::whereIn('user_id', $second_ids)->where('status', 'approved')->groupBy('user_id')->count();
    $activeMembers3 = Deposit::whereIn('user_id', $third_ids)->where('status', 'approved')->groupBy('user_id')->count();

    $totalInvestment = Purchase::whereIn('user_id', array_merge($first_ids->toArray(), $second_ids->toArray(), $third_ids->toArray()))->sum('amount');
    $totalLevelInvest1 = Purchase::whereIn('user_id', $first_ids)->sum('amount');
    $totalLevelInvest2 = Purchase::whereIn('user_id', $second_ids)->sum('amount');
    $totalLevelInvest3 = Purchase::whereIn('user_id', $third_ids)->sum('amount');

    $levelTotalCommission1 = UserLedger::where('user_id', $user->id)->where('reason', 'commission')->where('step', 'first')->sum('amount');
    $levelTotalCommission2 = UserLedger::where('user_id', $user->id)->where('reason', 'commission')->where('step', 'second')->sum('amount');
    $levelTotalCommission3 = UserLedger::where('user_id', $user->id)->where('reason', 'commission')->where('step', 'third')->sum('amount');

    $activerecharge1 = Deposit::whereIn('user_id', $first_ids)->where('status', 'approved')->sum('amount');
    $activerecharge2 = Deposit::whereIn('user_id', $second_ids)->where('status', 'approved')->sum('amount');
    $activerecharge3 = Deposit::whereIn('user_id', $third_ids)->where('status', 'approved')->sum('amount'); 
     
    $totalCommission = $levelTotalCommission1 + $levelTotalCommission2 + $levelTotalCommission3; 
    $grossIncome = $lvTotalDeposit + $totalCommission; // or adjust as needed

    return view('app.main.team.index', compact(
        'first_level_users',
        'second_level_users',
        'third_level_users',
        'team_size',
        'lvTotalDeposit',
        'lvTotalWithdraw',
        'lvTotalPendingDeposit',
        'lv1Recharge',
        'lv2Recharge',
        'lv3Recharge',
        'lv1Withdraw',
        'lv2Withdraw',
        'lv3Withdraw',
        'activeMembers1',
        'activeMembers2',
        'activeMembers3',
        'totalInvestment',
        'levelTotalCommission1',
        'levelTotalCommission2',
        'levelTotalCommission3',
        'totalLevelInvest1',
        'totalLevelInvest2',
        'totalLevelInvest3',
        'activerecharge1',
        'activerecharge2',
        'activerecharge3', 
        'totalCommission', 
        'grossIncome'
    ));
}

    public function teama()
{
    $user = Auth::user();

    // ------------------ FIRST LEVEL ------------------
    $first_level_users = User::where('ref_by', $user->ref_id)->get();
    $first_level_users_ids = $first_level_users->pluck('id')->toArray();

    foreach ($first_level_users as $u) {
        $u->is_active = Deposit::where('user_id', $u->id)->where('status', 'approved')->exists()
                        || Purchase::where('user_id', $u->id)->exists() ? 'Active' : 'Inactive';
    }

    // ------------------ SECOND LEVEL ------------------
    $second_level_users = collect();
    $second_level_users_ids = [];

    foreach ($first_level_users as $element) {
        $users = User::where('ref_by', $element->ref_id)->get();

        foreach ($users as $u) {
            $u->is_active = Deposit::where('user_id', $u->id)->where('status', 'approved')->exists()
                            || Purchase::where('user_id', $u->id)->exists() ? 'Active' : 'Inactive';

            $second_level_users->push($u);
            $second_level_users_ids[] = $u->id;
        }
    }

    // ------------------ THIRD LEVEL ------------------
    $third_level_users = collect();
    $third_level_users_ids = [];

    foreach ($second_level_users as $element) {
        $users = User::where('ref_by', $element->ref_id)->get();

        foreach ($users as $u) {
            $u->is_active = Deposit::where('user_id', $u->id)->where('status', 'approved')->exists()
                            || Purchase::where('user_id', $u->id)->exists() ? 'Active' : 'Inactive';

            $third_level_users->push($u);
            $third_level_users_ids[] = $u->id;
        }
    }

    // ------------------ SUMMARY DATA ------------------
    $team_size = count($first_level_users_ids) + count($second_level_users_ids) + count($third_level_users_ids);

    $first_ids = collect($first_level_users_ids);
    $second_ids = collect($second_level_users_ids);
    $third_ids = collect($third_level_users_ids);

    $lv1Recharge = Deposit::whereIn('user_id', $first_ids)->where('status', 'approved')->sum('amount');
    $lv2Recharge = Deposit::whereIn('user_id', $second_ids)->where('status', 'approved')->sum('amount');
    $lv3Recharge = Deposit::whereIn('user_id', $third_ids)->where('status', 'approved')->sum('amount');
    $lvTotalDeposit = $lv1Recharge + $lv2Recharge + $lv3Recharge;

    $lv1PendingRecharge = Deposit::whereIn('user_id', $first_ids)->where('status', 'pending')->sum('amount');
    $lv2PendingRecharge = Deposit::whereIn('user_id', $second_ids)->where('status', 'pending')->sum('amount');
    $lv3PendingRecharge = Deposit::whereIn('user_id', $third_ids)->where('status', 'pending')->sum('amount');
    $lvTotalPendingDeposit = $lv1PendingRecharge + $lv2PendingRecharge + $lv3PendingRecharge;

    $lv1Withdraw = Withdrawal::whereIn('user_id', $first_ids)->where('status', 'approved')->sum('amount');
    $lv2Withdraw = Withdrawal::whereIn('user_id', $second_ids)->where('status', 'approved')->sum('amount');
    $lv3Withdraw = Withdrawal::whereIn('user_id', $third_ids)->where('status', 'approved')->sum('amount');
    $lvTotalWithdraw = $lv1Withdraw + $lv2Withdraw + $lv3Withdraw;

    $activeMembers1 = Deposit::whereIn('user_id', $first_ids)->where('status', 'approved')->groupBy('user_id')->count();
    $activeMembers2 = Deposit::whereIn('user_id', $second_ids)->where('status', 'approved')->groupBy('user_id')->count();
    $activeMembers3 = Deposit::whereIn('user_id', $third_ids)->where('status', 'approved')->groupBy('user_id')->count();

    $totalInvestment = Purchase::whereIn('user_id', array_merge($first_ids->toArray(), $second_ids->toArray(), $third_ids->toArray()))->sum('amount');
    $totalLevelInvest1 = Purchase::whereIn('user_id', $first_ids)->sum('amount');
    $totalLevelInvest2 = Purchase::whereIn('user_id', $second_ids)->sum('amount');
    $totalLevelInvest3 = Purchase::whereIn('user_id', $third_ids)->sum('amount');

    $levelTotalCommission1 = UserLedger::where('user_id', $user->id)->where('reason', 'commission')->where('step', 'first')->sum('amount');
    $levelTotalCommission2 = UserLedger::where('user_id', $user->id)->where('reason', 'commission')->where('step', 'second')->sum('amount');
    $levelTotalCommission3 = UserLedger::where('user_id', $user->id)->where('reason', 'commission')->where('step', 'third')->sum('amount');

    $activerecharge1 = Deposit::whereIn('user_id', $first_ids)->where('status', 'approved')->sum('amount');
    $activerecharge2 = Deposit::whereIn('user_id', $second_ids)->where('status', 'approved')->sum('amount');
    $activerecharge3 = Deposit::whereIn('user_id', $third_ids)->where('status', 'approved')->sum('amount');
    $totalCommission = $levelTotalCommission1 + $levelTotalCommission2 + $levelTotalCommission3; 
    $grossIncome = $lvTotalDeposit + $totalCommission; // or adjust as needed 
    
    return view('app.main.team.teama', compact(
        'first_level_users',
        'second_level_users',
        'third_level_users',
        'team_size',
        'lvTotalDeposit',
        'lvTotalWithdraw',
        'lvTotalPendingDeposit',
        'lv1Recharge',
        'lv2Recharge',
        'lv3Recharge',
        'lv1Withdraw',
        'lv2Withdraw',
        'lv3Withdraw',
        'activeMembers1',
        'activeMembers2',
        'activeMembers3',
        'totalInvestment',
        'levelTotalCommission1',
        'levelTotalCommission2',
        'levelTotalCommission3',
        'totalLevelInvest1',
        'totalLevelInvest2',
        'totalLevelInvest3',
        'activerecharge1',
        'activerecharge2',
        'activerecharge3', 
        'totalCommission', 
        'grossIncome'
    ));
}
    public function teamb()
{
    $user = Auth::user();

    // ------------------ FIRST LEVEL ------------------
    $first_level_users = User::where('ref_by', $user->ref_id)->get();
    $first_level_users_ids = $first_level_users->pluck('id')->toArray();

    foreach ($first_level_users as $u) {
        $u->is_active = Deposit::where('user_id', $u->id)->where('status', 'approved')->exists()
                        || Purchase::where('user_id', $u->id)->exists() ? 'Active' : 'Inactive';
    }

    // ------------------ SECOND LEVEL ------------------
    $second_level_users = collect();
    $second_level_users_ids = [];

    foreach ($first_level_users as $element) {
        $users = User::where('ref_by', $element->ref_id)->get();

        foreach ($users as $u) {
            $u->is_active = Deposit::where('user_id', $u->id)->where('status', 'approved')->exists()
                            || Purchase::where('user_id', $u->id)->exists() ? 'Active' : 'Inactive';

            $second_level_users->push($u);
            $second_level_users_ids[] = $u->id;
        }
    }

    // ------------------ THIRD LEVEL ------------------
    $third_level_users = collect();
    $third_level_users_ids = [];

    foreach ($second_level_users as $element) {
        $users = User::where('ref_by', $element->ref_id)->get();

        foreach ($users as $u) {
            $u->is_active = Deposit::where('user_id', $u->id)->where('status', 'approved')->exists()
                            || Purchase::where('user_id', $u->id)->exists() ? 'Active' : 'Inactive';

            $third_level_users->push($u);
            $third_level_users_ids[] = $u->id;
        }
    }

    // ------------------ SUMMARY DATA ------------------
    $team_size = count($first_level_users_ids) + count($second_level_users_ids) + count($third_level_users_ids);

    $first_ids = collect($first_level_users_ids);
    $second_ids = collect($second_level_users_ids);
    $third_ids = collect($third_level_users_ids);

    $lv1Recharge = Deposit::whereIn('user_id', $first_ids)->where('status', 'approved')->sum('amount');
    $lv2Recharge = Deposit::whereIn('user_id', $second_ids)->where('status', 'approved')->sum('amount');
    $lv3Recharge = Deposit::whereIn('user_id', $third_ids)->where('status', 'approved')->sum('amount');
    $lvTotalDeposit = $lv1Recharge + $lv2Recharge + $lv3Recharge;

    $lv1PendingRecharge = Deposit::whereIn('user_id', $first_ids)->where('status', 'pending')->sum('amount');
    $lv2PendingRecharge = Deposit::whereIn('user_id', $second_ids)->where('status', 'pending')->sum('amount');
    $lv3PendingRecharge = Deposit::whereIn('user_id', $third_ids)->where('status', 'pending')->sum('amount');
    $lvTotalPendingDeposit = $lv1PendingRecharge + $lv2PendingRecharge + $lv3PendingRecharge;

    $lv1Withdraw = Withdrawal::whereIn('user_id', $first_ids)->where('status', 'approved')->sum('amount');
    $lv2Withdraw = Withdrawal::whereIn('user_id', $second_ids)->where('status', 'approved')->sum('amount');
    $lv3Withdraw = Withdrawal::whereIn('user_id', $third_ids)->where('status', 'approved')->sum('amount');
    $lvTotalWithdraw = $lv1Withdraw + $lv2Withdraw + $lv3Withdraw;

    $activeMembers1 = Deposit::whereIn('user_id', $first_ids)->where('status', 'approved')->groupBy('user_id')->count();
    $activeMembers2 = Deposit::whereIn('user_id', $second_ids)->where('status', 'approved')->groupBy('user_id')->count();
    $activeMembers3 = Deposit::whereIn('user_id', $third_ids)->where('status', 'approved')->groupBy('user_id')->count();

    $totalInvestment = Purchase::whereIn('user_id', array_merge($first_ids->toArray(), $second_ids->toArray(), $third_ids->toArray()))->sum('amount');
    $totalLevelInvest1 = Purchase::whereIn('user_id', $first_ids)->sum('amount');
    $totalLevelInvest2 = Purchase::whereIn('user_id', $second_ids)->sum('amount');
    $totalLevelInvest3 = Purchase::whereIn('user_id', $third_ids)->sum('amount');

    $levelTotalCommission1 = UserLedger::where('user_id', $user->id)->where('reason', 'commission')->where('step', 'first')->sum('amount');
    $levelTotalCommission2 = UserLedger::where('user_id', $user->id)->where('reason', 'commission')->where('step', 'second')->sum('amount');
    $levelTotalCommission3 = UserLedger::where('user_id', $user->id)->where('reason', 'commission')->where('step', 'third')->sum('amount');

    $activerecharge1 = Deposit::whereIn('user_id', $first_ids)->where('status', 'approved')->sum('amount');
    $activerecharge2 = Deposit::whereIn('user_id', $second_ids)->where('status', 'approved')->sum('amount');
    $activerecharge3 = Deposit::whereIn('user_id', $third_ids)->where('status', 'approved')->sum('amount');
  
    $totalCommission = $levelTotalCommission1 + $levelTotalCommission2 + $levelTotalCommission3; 
    $grossIncome = $lvTotalDeposit + $totalCommission; // or adjust as needed 
    
    return view('app.main.team.teamb', compact(
        'first_level_users',
        'second_level_users',
        'third_level_users',
        'team_size',
        'lvTotalDeposit',
        'lvTotalWithdraw',
        'lvTotalPendingDeposit',
        'lv1Recharge',
        'lv2Recharge',
        'lv3Recharge',
        'lv1Withdraw',
        'lv2Withdraw',
        'lv3Withdraw',
        'activeMembers1',
        'activeMembers2',
        'activeMembers3',
        'totalInvestment',
        'levelTotalCommission1',
        'levelTotalCommission2',
        'levelTotalCommission3',
        'totalLevelInvest1',
        'totalLevelInvest2',
        'totalLevelInvest3',
        'activerecharge1',
        'activerecharge2',
        'activerecharge3', 
        'totalCommission', 
        'grossIncome'
    ));
}   
    public function teamc()
{
    $user = Auth::user();

    // ------------------ FIRST LEVEL ------------------
    $first_level_users = User::where('ref_by', $user->ref_id)->get();
    $first_level_users_ids = $first_level_users->pluck('id')->toArray();

    foreach ($first_level_users as $u) {
        $u->is_active = Deposit::where('user_id', $u->id)->where('status', 'approved')->exists()
                        || Purchase::where('user_id', $u->id)->exists() ? 'Active' : 'Inactive';
    }

    // ------------------ SECOND LEVEL ------------------
    $second_level_users = collect();
    $second_level_users_ids = [];

    foreach ($first_level_users as $element) {
        $users = User::where('ref_by', $element->ref_id)->get();

        foreach ($users as $u) {
            $u->is_active = Deposit::where('user_id', $u->id)->where('status', 'approved')->exists()
                            || Purchase::where('user_id', $u->id)->exists() ? 'Active' : 'Inactive';

            $second_level_users->push($u);
            $second_level_users_ids[] = $u->id;
        }
    }

    // ------------------ THIRD LEVEL ------------------
    $third_level_users = collect();
    $third_level_users_ids = [];

    foreach ($second_level_users as $element) {
        $users = User::where('ref_by', $element->ref_id)->get();

        foreach ($users as $u) {
            $u->is_active = Deposit::where('user_id', $u->id)->where('status', 'approved')->exists()
                            || Purchase::where('user_id', $u->id)->exists() ? 'Active' : 'Inactive';

            $third_level_users->push($u);
            $third_level_users_ids[] = $u->id;
        }
    }

    // ------------------ SUMMARY DATA ------------------
    $team_size = count($first_level_users_ids) + count($second_level_users_ids) + count($third_level_users_ids);

    $first_ids = collect($first_level_users_ids);
    $second_ids = collect($second_level_users_ids);
    $third_ids = collect($third_level_users_ids);

    $lv1Recharge = Deposit::whereIn('user_id', $first_ids)->where('status', 'approved')->sum('amount');
    $lv2Recharge = Deposit::whereIn('user_id', $second_ids)->where('status', 'approved')->sum('amount');
    $lv3Recharge = Deposit::whereIn('user_id', $third_ids)->where('status', 'approved')->sum('amount');
    $lvTotalDeposit = $lv1Recharge + $lv2Recharge + $lv3Recharge;

    $lv1PendingRecharge = Deposit::whereIn('user_id', $first_ids)->where('status', 'pending')->sum('amount');
    $lv2PendingRecharge = Deposit::whereIn('user_id', $second_ids)->where('status', 'pending')->sum('amount');
    $lv3PendingRecharge = Deposit::whereIn('user_id', $third_ids)->where('status', 'pending')->sum('amount');
    $lvTotalPendingDeposit = $lv1PendingRecharge + $lv2PendingRecharge + $lv3PendingRecharge;

    $lv1Withdraw = Withdrawal::whereIn('user_id', $first_ids)->where('status', 'approved')->sum('amount');
    $lv2Withdraw = Withdrawal::whereIn('user_id', $second_ids)->where('status', 'approved')->sum('amount');
    $lv3Withdraw = Withdrawal::whereIn('user_id', $third_ids)->where('status', 'approved')->sum('amount');
    $lvTotalWithdraw = $lv1Withdraw + $lv2Withdraw + $lv3Withdraw;

    $activeMembers1 = Deposit::whereIn('user_id', $first_ids)->where('status', 'approved')->groupBy('user_id')->count();
    $activeMembers2 = Deposit::whereIn('user_id', $second_ids)->where('status', 'approved')->groupBy('user_id')->count();
    $activeMembers3 = Deposit::whereIn('user_id', $third_ids)->where('status', 'approved')->groupBy('user_id')->count();

    $totalInvestment = Purchase::whereIn('user_id', array_merge($first_ids->toArray(), $second_ids->toArray(), $third_ids->toArray()))->sum('amount');
    $totalLevelInvest1 = Purchase::whereIn('user_id', $first_ids)->sum('amount');
    $totalLevelInvest2 = Purchase::whereIn('user_id', $second_ids)->sum('amount');
    $totalLevelInvest3 = Purchase::whereIn('user_id', $third_ids)->sum('amount');

    $levelTotalCommission1 = UserLedger::where('user_id', $user->id)->where('reason', 'commission')->where('step', 'first')->sum('amount');
    $levelTotalCommission2 = UserLedger::where('user_id', $user->id)->where('reason', 'commission')->where('step', 'second')->sum('amount');
    $levelTotalCommission3 = UserLedger::where('user_id', $user->id)->where('reason', 'commission')->where('step', 'third')->sum('amount');

    $activerecharge1 = Deposit::whereIn('user_id', $first_ids)->where('status', 'approved')->sum('amount');
    $activerecharge2 = Deposit::whereIn('user_id', $second_ids)->where('status', 'approved')->sum('amount');
    $activerecharge3 = Deposit::whereIn('user_id', $third_ids)->where('status', 'approved')->sum('amount'); 
    
    $totalCommission = $levelTotalCommission1 + $levelTotalCommission2 + $levelTotalCommission3; 
    $grossIncome = $lvTotalDeposit + $totalCommission; // or adjust as needed

    return view('app.main.team.teamc', compact(
        'first_level_users',
        'second_level_users',
        'third_level_users',
        'team_size',
        'lvTotalDeposit',
        'lvTotalWithdraw',
        'lvTotalPendingDeposit',
        'lv1Recharge',
        'lv2Recharge',
        'lv3Recharge',
        'lv1Withdraw',
        'lv2Withdraw',
        'lv3Withdraw',
        'activeMembers1',
        'activeMembers2',
        'activeMembers3',
        'totalInvestment',
        'levelTotalCommission1',
        'levelTotalCommission2',
        'levelTotalCommission3',
        'totalLevelInvest1',
        'totalLevelInvest2',
        'totalLevelInvest3',
        'activerecharge1',
        'activerecharge2',
        'activerecharge3', 
        'totalCommission', 
        'grossIncome'
    ));
}


    public function income()
    {
        return  view('app.main.income');
    }
    public function level($level = null)
    {
        $user = Auth::user();

        //First Level Users
        $first_level_users = User::where('ref_by', $user->ref_id)->get();
        $first_level_users_ids = [];
        foreach ($first_level_users as $user){
            array_push($first_level_users_ids, $user->id);
        }

        //Second Level Users
        $second_level_users_ids = [];
        foreach ($first_level_users as $element) {
            $users = User::where('ref_by', $element->ref_id)->get();
            foreach ($users as $user){
                array_push($second_level_users_ids, $user->id);
            }
        }
        $second_level_users = User::whereIn('id', $second_level_users_ids)->get();

        //Third Level Users
        $third_level_users_ids = [];
        foreach ($second_level_users as $element) {
            $users = User::where('ref_by', $element->ref_id)->get();
            foreach ($users as $user){
                array_push($third_level_users_ids, $user->id);
            }
        }
        $third_level_users = User::whereIn('id', $third_level_users_ids)->get();


        if ($level == 1){
            $users = $first_level_users;
        }
        if ($level == 2){
            $users = $second_level_users;
        }
        if ($level == 3){
            $users = $third_level_users;
        }

        return  view('app.main.team.level', compact('users', 'level'));
    }
}