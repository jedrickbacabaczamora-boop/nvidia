<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Bonus;
use App\Models\BonusLedger;
use App\Models\Checkin;
use App\Models\User;
use App\Models\UserLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class GetBonusController extends Controller
{
    public function index()
    {
        $data = Bonus::where('status', 'active')->first();
        return view('app.main.bonus.index', compact('data'));
    }

    public function gift()
    {
        return view('app.main.gift.index');
    }

    public function submitBonusCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bonus_code' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => 'Bonus code is required.'
            ]);
        }

        $code = $request->bonus_code;
        $bonus = Bonus::where('status', 'active')->first();
        $user = Auth::user();

        if (!$bonus) {
            return response()->json(['status' => 0, 'message' => 'No active bonus available.']);
        }

        if ($code !== $bonus->code) {
            return response()->json(['status' => 0, 'message' => 'Invalid bonus code.']);
        }

        $checkBonusUses = BonusLedger::where('bonus_id', $bonus->id)
            ->where('user_id', $user->id)
            ->first();

        if ($checkBonusUses) {
            return response()->json(['status' => 0, 'message' => 'You have already used this bonus.']);
        }

        if ($bonus->counter >= $bonus->set_service_counter) {
            return response()->json(['status' => 0, 'message' => 'Bonus quota is full.']);
        }

        // Credit user balance
        $user->balance += $bonus->amount;
        $user->save();

        // Log to UserLedger
        UserLedger::create([
            'user_id' => $user->id,
            'reason' => 'bonus',
            'perticulation' => 'Bonus Code Redeemed: ' . $code,
            'amount' => $bonus->amount,
            'credit' => $bonus->amount,
            'status' => 'approved',
            'step' => 'self',
            'date' => now()->format('Y-m-d H:i'),
        ]);

        // Update bonus counter
        $bonus->increment('counter');

        // Record bonus usage
        BonusLedger::create([
            'user_id' => $user->id,
            'bonus_id' => $bonus->id,
            'amount' => $bonus->amount,
            'bonus_code' => $code,
        ]);

        return response()->json([
            'status' => 1,
            'message' => 'Bonus received successfully: ' . price($bonus->amount)
        ]);
    }

    public function checkin(Request $request)
    {
        $user = Auth::user();
        $lastCheckin = Checkin::where('user_id', $user->id)->orderByDesc('id')->first();

        if (!$lastCheckin || now()->greaterThanOrEqualTo(Carbon::parse($lastCheckin->date))) {
            $amount = setting('checkin');

            Checkin::create([
                'user_id' => $user->id,
                'date' => now()->addHours(24),
                'amount' => $amount,
            ]);

            $user->balance += $amount;
            $user->save();

            UserLedger::create([
                'user_id' => $user->id,
                'reason' => 'checkin',
                'perticulation' => 'Daily check-in bonus',
                'amount' => $amount,
                'debit' => $amount,
                'status' => 'approved',
                'step' => 'self',
                'date' => now()->format('Y-m-d H:i:s'),
            ]);

            return redirect()->back()->with('success', 'You have received your daily check-in bonus.');
        }

        $remaining = Carbon::parse($lastCheckin->date)->diffForHumans();
        return redirect()->back()->with('error', 'Already checked in. Try again ' . $remaining);
    }

    public function checkin_ledger()
    {
        $checkins = Checkin::where('user_id', Auth::id())->orderByDesc('id')->get();
        return view('app.main.checkin-ledger', compact('checkins'));
    }

    public function preview()
    {
        $datas = BonusLedger::with(['bonus', 'user'])
            ->where('user_id', Auth::id())
            ->orderByDesc('id')
            ->get();

        return view('app.main.bonus.bonus-preview', compact('datas'));
    }
}
