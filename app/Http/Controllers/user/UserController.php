<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Api\OnepayController;
use App\Http\Controllers\Controller;
use App\Http\Services\PaymentServices;
use App\Models\BankList;
use App\Models\Checkin;
use App\Models\Comunity;
use App\Models\Deposit;
use App\Models\Package;
use App\Models\PaymentMethod;
use App\Models\Purchase;
use App\Models\Task;
use App\Models\TaskRequest;
use App\Models\User;
use App\Models\UserLedger;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function home() 
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
        $team_size = $first_level_users->count() + $second_level_users->count() + $third_level_users->count();

        //Get level wise user ids
        $first_ids = $first_level_users->pluck('id'); //first
        $second_ids = $second_level_users->pluck('id'); //Second
        $third_ids = $third_level_users->pluck('id'); //Third
        return view('app.main.index', compact(
            'team_size'
        ));
    }

    public function vip()
    {
        return view('app.main.product.index');
    }
    public function community()
    {
        return view('app.main.community');
    }
    public function add_com()
    {
        return view('app.main.add_com');
    }

    public function cacheClear()
    {
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        return redirect('dashboard')->with('success', 'Success');
    }

    public function vip_details($id)
    {
        $package = Package::find($id);
        return view('app.main.vip_details', compact('package'));
    }

    public function history()
    {
        return view('app.main.history');
    }

    public function fund()
    {
        return view('app.main.fund');
    }
    public function apply_task_commission($task_id){
        $task = Task::where('id', $task_id)->first();
        $apply = TaskRequest::where('task_id', $task_id)->where('user_id', auth()->id())->first();
        if ($apply){
            return redirect('task')->with('success', 'Already you have received the reward');
        }

        if ($task){
            $referUser = User::where('ref_by', auth()->user()->ref_id)->where('investor', 1)->get();
            if ($referUser->count() >= $task->team_size){
                $model = new TaskRequest();
                $model->task_id = $task->id;
                $model->user_id = auth()->id();
                $model->team_invest = $task->invest;
                $model->team_size = $task->team_size;
                $model->save();

                $ledger = new UserLedger();
                $ledger->user_id = auth()->id();
                $ledger->reason = 'rebate';
                $ledger->perticulation = 'Team Investor Reward received successful';
                $ledger->amount = $task->bonus;
                $ledger->debit = $task->bonus;
                $ledger->status = 'approved';
                $ledger->date = now();
                $ledger->save();

                $auth = auth()->user();
                $auth->balance = $auth->balance + $task->bonus;
                $auth->save();

                return redirect('task')->with('success', 'Request sent successful.');
            }else{
                return redirect('task')->with('error', 'Please improve your team.');
            }
        }
        return back();
    }
    public function task()
    {
        $user = Auth::user();
        //First Level Users
        $first_level_users = User::where('ref_by', $user->ref_id)->get();
        $first_level_users_ids = [];
        foreach ($first_level_users as $user) {
            array_push($first_level_users_ids, $user->id);
        }

        //Second Level Users
        $second_level_users_ids = [];
        foreach ($first_level_users as $element) {
            $users = User::where('ref_by', $element->ref_id)->get();
            foreach ($users as $user) {
                array_push($second_level_users_ids, $user->id);
            }
        }
        $second_level_users = User::whereIn('id', $second_level_users_ids)->get();

        //Third Level Users
        $third_level_users_ids = [];
        foreach ($second_level_users as $element) {
            $users = User::where('ref_by', $element->ref_id)->get();
            foreach ($users as $user) {
                array_push($third_level_users_ids, $user->id);
            }
        }
        $third_level_users = User::whereIn('id', $third_level_users_ids)->get();
        $team_size = $first_level_users->count() + $second_level_users->count() + $third_level_users->count();

        //Get level wise user ids
        $first_ids = $first_level_users->pluck('id'); //first
        $second_ids = $second_level_users->pluck('id'); //Second
        $third_ids = $third_level_users->pluck('id'); //Third

        $lv1Recharge = Deposit::whereIn('user_id', $first_ids)->where('status', 'approved')->sum('amount');
        $lv2Recharge = Deposit::whereIn('user_id', $second_ids)->where('status', 'approved')->sum('amount');
        $lv3Recharge = Deposit::whereIn('user_id', $third_ids)->where('status', 'approved')->sum('amount');
        $lvTotalDeposit = $lv1Recharge + $lv2Recharge + $lv3Recharge;

        $lv1Withdraw = Withdrawal::whereIn('user_id', $first_ids)->where('status', 'approved')->sum('amount');
        $lv2Withdraw = Withdrawal::whereIn('user_id', $second_ids)->where('status', 'approved')->sum('amount');
        $lv3Withdraw = Withdrawal::whereIn('user_id', $third_ids)->where('status', 'approved')->sum('amount');
        $lvTotalWithdraw = $lv1Withdraw + $lv2Withdraw + $lv3Withdraw;

        $activeMembers1 = Deposit::whereIn('user_id', $first_ids)->where('status', 'approved')->groupBy('user_id')->count();
        $activeMembers2 = Deposit::whereIn('user_id', $second_ids)->where('status', 'approved')->groupBy('user_id')->count();
        $activeMembers3 = Deposit::whereIn('user_id', $third_ids)->where('status', 'approved')->groupBy('user_id')->count();


        $Lv1active = 0;
        $Lv2active = 0;
        $Lv3active = 0;

        foreach ($first_level_users as $uuss) {
            $purchase = Purchase::where('user_id', $uuss->id)->first();
            if ($purchase) {
                $Lv1active = $Lv1active + 1;
            }
        }
        foreach ($second_level_users as $uuss) {
            $purchase = Purchase::where('user_id', $uuss->id)->first();
            if ($purchase) {
                $Lv2active = $Lv2active + 1;
            }
        }
        foreach ($third_level_users as $uuss) {
            $purchase = Purchase::where('user_id', $uuss->id)->first();
            if ($purchase) {
                $Lv3active = $Lv3active + 1;
            }
        }

        $teamTotalActiveMembers = $Lv1active + $Lv2active + $Lv3active;


        return view('app.main.tasks.index', compact('team_size', 'teamTotalActiveMembers', 'lv1Recharge', 'lv2Recharge', 'lv3Recharge', 'lv1Withdraw', 'lv2Withdraw', 'lv3Withdraw', 'first_level_users', 'second_level_users', 'third_level_users'));
    }


    public function history_all()
    {
        return view('app.main.history_all');
    }

    public function history_income()
    {
        return view('app.main.history_income');
    }


    public function ordered()
{
    $purchases = Purchase::where('user_id', auth()->id())
        ->with('package')
        ->latest()
        ->get();

    return view('app.main.ordered', compact('purchases'));
}


    public function checkin_history()
    {
        return view('app.main.checkin_history');
    }

    public function lucky()
    {
        return view('app.main.lucky');
    }

    public function checkin()
    {
        // check this user already check it
        $check = Checkin::where('user_id', Auth::user()->id)->orderByDesc('id')->first();
        if ($check){
            //check submit today
            $todayCheck = new Carbon($check->date);
            if ($todayCheck->isToday()){
                return redirect()->route('dashboard')->with('error', 'Already Checkin');
            }
        }

        $amo = rand(1, 6);

        //Create checkin record
        $model = new Checkin();
        $model->user_id = Auth::id();
        $model->date = Carbon::now();
        $model->amount = $amo;
        $model->save();

        //Added balance in user account
        User::where('id', Auth::user()->id)->update([
            'balance'=> Auth::user()->balance + $amo,
        ]);

        return redirect()->route('dashboard')->with('success', 'Congratulations daily checkin '.price($amo));
    }

    public function checkin_ledger()
    {
        $checkins = Checkin::where('user_id', Auth::id())->orderByDesc('id')->get();
        return view('app.main.checkin-ledger', compact('checkins'));
    }

    public function vip_commission()
    {
        return view('app.main.vip_commission');
    }

    public function team_commission_history()
    {
        return view('app.main.team_commission_history');
    }

    public function reword_history()
    {
        return view('app.main.reword_history');
    }

    public function commission()
    {
        return view('app.main.commission');
    }

    public function amount_history()
    {
        return view('app.main.amount_history');
    }

    public function package_details($id)
    {
        $package = Package::find($id);
        return view('app.main.package_details', compact('package'));
    }

    public function profile()
    {
        return view('app.main.profile');
    }

    public function team()
    {
        return view('app.main.team.index');
    }


    public function setting()
    {
        return view('app.main.mine.setting');
    }

    public function recharge()
    {
        return view('app.main.recharge.index');
    }

    public function recharge_method()
    {
        return view('app.main.recharge.index_method');
    }

    public function deposit_confirm(Request $request){
        $model = new Deposit();
        $model->user_id = Auth::id();
        $model->method_name = $request->paymethod;
        $model->order_id = rand(00000000,99999999);
        $model->transaction_id = $request->transaction_id;
        $model->number = $request->phone_number;
        $model->amount = $request->amount;
        $model->charge_amount = 0;
        $model->final_amount = $request->amount;
        $model->date = date('d-m-Y H:i:s');
        $model->status = 'pending';
        $model->save();
        return redirect()->route('user.recharge')->with('success', 'Successful');
    }

    public function deposit_history()
    {
        return view('app.main.deposit_history');
    }

    public function payment(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'transaction_id' => 'required',
            'method_' => 'required',
        ]);

        if ($validate->fails()){
            return redirect()->back()->with('message', 'Incorrect Deposit');
        }

        $user_id = \auth()->id();
        $model = new Deposit();
        $model->user_id = $user_id;
        $model->method_name = $request->method_;
        $model->order_id = rand(0,999999).rand(0,999999);
        $model->transaction_id = $request->transaction_id;
        $model->amount = $request->amount;
        $model->final_amount = $request->amount;
        $model->date = date('d-m-Y H:i:s');
        $model->status = 'pending';
        $model->save();

        //Create user ledger
        $ledger = new UserLedger();
        $ledger->user_id = $user_id;
        $ledger->reason = 'user_deposit';
        $ledger->perticulation = 'user deposit using externals';
        $ledger->amount = $request->amount;
        $ledger->debit = $request->amount;
        $ledger->status = 'pending';
        $ledger->date = date('y-m-d');
        $ledger->save();
        return redirect()->back()->with('message', 'Deposit Success.');
    }

    public function update_profile(Request $request)
    {
        $user = User::find(Auth::id());
        $path = uploadImage(false, $request, 'photo', 'upload/profile/', 200, 200, $user->photo);
        $user->photo = $path ?? $user->photo;

        $user->update();
        return redirect()->route('my.profile')->with('success', 'Successful');
    }

    public function personal_details()
    {
        return view('app.main.update_personal_details');
    }

     
    public function invite(){
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
        $team_size = $first_level_users->count() + $second_level_users->count() + $third_level_users->count();

        //Get level wise user ids
        $first_ids = $first_level_users->pluck('id'); //first
        $second_ids = $second_level_users->pluck('id'); //Second
        $third_ids = $third_level_users->pluck('id'); //Third

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
        $totalLevelInvest1 = Purchase::whereIn('user_id', array_merge($first_ids->toArray()))->sum('amount');
        $totalLevelInvest2 = Purchase::whereIn('user_id', array_merge($second_ids->toArray()))->sum('amount');
        $totalLevelInvest3 = Purchase::whereIn('user_id', array_merge($third_ids->toArray()))->sum('amount');

        $levelTotalCommission1 = UserLedger::where('user_id', \auth()->id())->where('reason', 'commission')->where('step', 'first')->sum('amount');
        $levelTotalCommission2 = UserLedger::where('user_id', \auth()->id())->where('reason', 'commission')->where('step', 'second')->sum('amount');
        $levelTotalCommission3 = UserLedger::where('user_id', \auth()->id())->where('reason', 'commission')->where('step', 'third')->sum('amount');

        $activerecharge1 = Deposit::whereIn('user_id', $first_ids)->where('status', 'approved')->sum('amount');
        $activerecharge2 = Deposit::whereIn('user_id', $second_ids)->where('status', 'approved')->sum('amount');
        $activerecharge3 = Deposit::whereIn('user_id', $third_ids)->where('status', 'approved')->sum('amount');

        return view('app.main.invite', compact(
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
            'activerecharge3'
        ));
        
    }


    public function service()
    {
        return view('app.main.service');
    }
    public function add_bank()
    {
        return view('app.main.bank.index');
    }

    public function add_bank_setup()
    {
        return view('app.main.bank.index_setup');
    }
    public function add_bank_setup_confirm(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'realname' => 'required',
            'gateway_method' => 'required',
            'gateway_address' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->route('user.bank')->withErrors($validate->errors());
        }

        // Find Bank
        $bank = BankList::where('bank_code', $request->gateway_method)->first();

        // Not Exist
        if(!$bank) {
            //
            return redirect()->route('user.bank')->with('error', 'Selected Bank not found');
        }

        $user = User::find(Auth::id());

        $user->realname = $request->realname;
        $user->gateway_address = $request->gateway_address;
        $user->gateway_method = $request->gateway_method;
        $user->bank_name = $bank->name;
        $user->update();
        return redirect()->route('home')->with('success', 'Successfully update account');
    }

    public function appreview()
    {
        return view('app.main.appreview');
    }

    public function rule()
    {
        return view('app.main.rule');
    }

    public function notice()
    {
        return view('app.main.notice');
    }

    public function setting_change_password(Request $request)
    {
        //Check current password
        $user = User::find(Auth::id());
        if (Hash::check($request->old_password, $user->password)) {
            if ($request->new_password == $request->confirm_password) {
                $user->password = Hash::make($request->new_password);
                $user->update();
                return redirect()->route('login_password')->with('success', 'Password changed');
            } else {
                return redirect()->route('login_password')->with('success', 'Password not match.');
            }
        } else {
            return redirect()->route('login_password')->with('success', 'Password not match');
        }
    }

    public function download_apk()
    {
        $file = public_path('strg.apk');
        return response()->file($file, [
            'Content-Type' => 'application/vnd.android.package-archive',
            'Content-Disposition' => 'attachment; filename="strg.apk"',
        ]);
    }
}







