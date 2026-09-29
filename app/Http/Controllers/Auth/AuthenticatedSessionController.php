<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Deposit;
use App\Models\User;
use App\Models\UserLedger;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request)
    {
        if (Auth::check()){
            return redirect()->route('home');
        }
        return view('app.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request){
       $user = User::where('phone', $request->phone)->first();

       if (!$user){
           return redirect()->back()->with('error', 'Mobile number not registered.');
        }

        //Check user ban or unban
        if ($user->ban_unban == 'ban')
        {
            return redirect()->back()->with('error', 'Your account has been banned.');
        }

        if ($user){
            //Check password
            if (Hash::check($request->password, $user->password)){
                Auth::login($user);
                return redirect()->route('home')->with('success', 'Login Successful');
            }else{
                return redirect()->back()->with('error', 'Incorrect login password.');
            }
        }else{
            return redirect()->back()->with('error', 'Login Successful.');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
