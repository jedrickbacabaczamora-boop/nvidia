<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\FundInvest;
use App\Models\Package;
use App\Models\Purchase;
use App\Models\User;
use App\Models\UserLedger;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function login()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }


    public function salaryView(){
        return view('admin.salary');
    }
    
    /*public function commission()
    {
        $purchases = Purchase::where('status', 'active')->get();

        foreach ($purchases as $purchase) {
            $user = User::find($purchase->user_id);
            $package = Package::find($purchase->package_id);

            if (!$user || !$package) continue;

            // Expire if validity passed
            if (Carbon::parse($purchase->validity)->isPast()) {
                $purchase->status = 'inactive';
                $purchase->save();
                continue;
            }

            // Only if it's time
            if (now()->greaterThanOrEqualTo($purchase->date)) {
                $income = 0;
                $nextDate = now();
                $description = '';

                if ($purchase->hourly > 0) {
                    $income = $purchase->hourly;
                    $nextDate = now()->addHour();
                    $description = $package->name . ' hourly commission received';
                } elseif ($purchase->daily_income > 0) {
                    $income = $purchase->daily_income;
                    $nextDate = now()->addDay();
                    $description = $package->name . ' daily commission received';
                } elseif ($purchase->weekly_income > 0) {
                    $income = $purchase->weekly_income;
                    $nextDate = now()->addWeek();
                    $description = $package->name . ' weekly commission received';
                }

                if ($income > 0) {
                    // Credit user
                    $user->increment('balance', $income);

                    // Save new drop time
                    $purchase->date = $nextDate;
                    $purchase->save();

                    // Log ledger
                    UserLedger::create([
                        'user_id' => $user->id,
                        'reason' => 'balance_added',
                        'perticulation' => $description,
                        'amount' => $income,
                        'credit' => $income,
                        'status' => 'approved',
                        'date' => now()->format('Y-m-d H:i'),
                    ]);
                }
            }
        }

        // Handle fund investments
        $userFunds = FundInvest::where('status', 'active')->get();
        foreach ($userFunds as $fund) {
            if (Carbon::parse($fund->validity_expired)->isPast()) {
                $fund->status = 'inactive';
                $fund->save();

                $user = User::find($fund->user_id);
                if ($user) {
                    $user->increment('balance', $fund->return_amount);

                    UserLedger::create([
                        'user_id' => $user->id,
                        'reason' => 'fund',
                        'perticulation' => 'Fund return with commission.',
                        'amount' => $fund->return_amount,
                        'credit' => $fund->return_amount,
                        'status' => 'approved',
                        'date' => now()->format('Y-m-d H:i'),
                    ]);
                }
            }
        }
    }*/




    public function commission()
    {
        $purchases = Purchase::where('status', 'active')->get();
        foreach ($purchases as $purchase){
            $user = User::where('id', $purchase->user_id)->first();
            if ($user){
                $package = Package::where('id', $purchase->package_id)->first();
                if ($package){

                    if (now()->greaterThanOrEqualTo($purchase->date)){
                        $amount = $user->balance + $purchase->daily_income;
                        $user->balance = $amount;
                        $user->save();

                        $purchase->date = now()->addHours(24);
                        $purchase->save();

                        $ledger = new UserLedger();
                        $ledger->user_id = $user->id;
                        $ledger->reason = 'balance_added';
                        $ledger->perticulation = $package->name. ' commission Add. received now';
                        $ledger->amount = $purchase->daily_income;
                        $ledger->credit = $purchase->daily_income;
                        $ledger->status = 'approved';
                        $ledger->date = date("Y-m-d H:i:s");
                        $ledger->save();

                        $checkExpire = new Carbon($purchase->validity);
                        if ($checkExpire->isPast()){
                            $ppp = Purchase::where('id', $purchase->id)->first();
                            $ppp->status = 'inactive';
                            $ppp->save();
                        }
                    }
                }
            }
        }




        $userFunds = FundInvest::where('status', 'active')->get();
        foreach ($userFunds as $fund) {
            $xTime = Carbon::parse($fund->validity_expired);
            if ($xTime->isPast()) {
                if ($fund->status == 'active') {
                    //Update FunInvest Record
                    $fIn = FundInvest::where('id', $fund->id)->first();
                    $fIn->status = 'inactive';

                    //Insert Balance into user balance
                    if ($fIn->save()){
                        $user = User::where('id', $fund->user_id)->first();
                        $user->balance = $user->balance + $fund->return_amount;
                        $user->save();

                        $ledger = new UserLedger();
                        $ledger->user_id = $user->id;
                        $ledger->reason = 'fund';
                        $ledger->perticulation = 'Congratulations You have received your fund with commission. ';
                        $ledger->amount = $fund->return_amount;
                        $ledger->debit = $fund->return_amount;
                        $ledger->status = 'approved';
                        $ledger->date = date('d-m-Y H:i');
                        $ledger->save();
                    }
                }
            }
        }
    }

    public function login_submit(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
            if ($admin->type == 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Logged In Successful.');
            } else {
                return error_redirect('admin.login', 'error', 'Admin Credentials Very Secured Please Don"t try Again.');
            }
        } else {
            return error_redirect('admin.login', 'error', 'Admin Credentials Does Not Match.');
        }
    }

    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')->with('success', 'Logged out successful.');
        } else {
            return error_redirect('admin.login', 'error', 'You are already logged out.');
        }
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function developer()
    {
        return view('admin.developer');
    }

    public function profile()
    {
        return view('admin.profile.index');
    }

    public function profile_update()
    {
        $admin = Admin::first();
        return view('admin.profile.update-details', compact('admin'));
    }

    public function profile_update_submit(Request $request)
    {
        $admin = Admin::find(1);
        $path = uploadImage(false, $request, 'photo', 'admin/assets/images/profile/', $admin->photo);
        $admin->photo = $path ?? $admin->photo;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->address = $request->address;
        $admin->update();
        return redirect()->route('admin.profile.update')->with('success', 'Admin profile updated.');
    }

    public function change_password()
    {
        $admin = admin()->user();
        return view('admin.profile.change-password', compact('admin'));
    }

    public function check_password(Request $request)
    {
        $admin = admin()->user();
        $password = $request->password;
        if (Hash::check($password, $admin->password)) {
            return response()->json(['message' => 'Password matched.', 'status' => true]);
        } else {
            return response()->json(['message' => 'Password dose not match.', 'status' => false]);
        }
    }

    public function change_password_submit(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required'
        ]);
        if ($validate->fails()) {
            session()->put('errors', true);
            return redirect()->route('admin.changepassword')->withErrors($validate->errors());
        }

        $admin = admin()->user();
        $password = $request->old_password;
        if (Hash::check($password, $admin->password)) {
            if (strlen($request->new_password) > 5 && strlen($request->confirm_password) > 5){
                if ($request->new_password === $request->confirm_password) {
                    $admin->password = Hash::make($request->new_password);
                    $admin->update();
                    return redirect()->route('admin.changepassword')->with('success', 'Password changed successfully');
                } else {
                    return error_redirect('admin.changepassword', 'error', 'New password and confirm password dose not match');
                }
            }else{
                return error_redirect('admin.changepassword', 'error',  'Password must be greater then 6 or equal.');
            }
        } else {
            return error_redirect('admin.changepassword', 'error',  'Password dose not match');
        }
    }
}
