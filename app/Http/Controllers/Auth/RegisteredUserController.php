<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Checkin;
use App\Models\User;
use App\Models\UserLedger;
use App\Models\Setting; // ✅ Add Setting model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    public function create(Request $request, $id = null)
    {
        if ($id) {
            $user = User::find($id);
            if ($user) {
                $user->delete();
            }
        }

        $ref_by = $request->query('ref');
        return view('app.auth.registration', compact('ref_by'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'phone' => ['required', 'unique:users,phone'],
            'password' => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        }

        /*/ ✅ Check for IP limit
        $userIP = $request->ip();
        $existing = User::where('ip', $userIP)->first();
        if ($existing) {
            return redirect()->back()->with('error', 'Only one account allowed per IP address.');
        }*/

        // ✅ Get registration bonus from settings
        $bonus = Setting::first()->registration_bonus ?? 0;

        // ✅ Generate referral code
        $referralCode = $this->generateUniqueReferralCode();

        // ✅ Create user
        $user = User::create([
            'name' => 'u' . $request->phone,
            'username' => env('APP_NAME'),
            'ref_id' => $referralCode,
            'ref_by' => $request->ref_by ?? env('APP_NAME'),
            'email' => 'user' . rand(1000, 9999) . Str::random(2) . '@gmail.com',
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'type' => 'user',
            'balance' => $bonus,
            'code' => $request->code,
            'remember_token' => Str::random(30),
            //'ip' => $userIP,
        ]);

        if ($user) {
            // ✅ Record check-in
            Checkin::create([
                'user_id' => $user->id,
                'date' => now(),
                'amount' => 0,
            ]);

            // ✅ Ledger entry for signup bonus
            UserLedger::create([
                'user_id' => $user->id,
                'reason' => 'signup_bonus',
                'perticulation' => 'Registration bonus',
                'amount' => $bonus,
                'credit' => $bonus,
                'status' => 'approved',
                'step' => 'self',
                'date' => now()->format('Y-m-d H:i'),
            ]);

            Auth::login($user);
            return redirect()->route('home');
        }

        return redirect()->back()->with('error', 'Something went wrong. Please try again.');
    }

    private function generateUniqueReferralCode($length = 6)
    {
        do {
            $code = strtoupper(Str::random($length));
        } while (User::where('ref_id', $code)->exists());

        return $code;
    }
}
