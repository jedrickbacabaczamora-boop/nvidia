<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SpinChance;
use App\Models\SpinReward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpinController extends Controller
{
    /**
     * Show the spin page with user's current spin chances.
     */
    public function showSpin()
    {
        $userId = auth()->id();

        // Get current chances or default to 0
        $chances = SpinChance::where('user_id', $userId)->value('chances') ?? 0;

        return view('app.spin.index', compact('chances'));
    }

    /**
     * Handle the spin request via AJAX and return JSON response.
     */
    public function spinNow(Request $request)
    {
        $userId = auth()->id();

        // Get current chances
        $chances = SpinChance::where('user_id', $userId)->value('chances') ?? 0;

        if ($chances <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'No spin chances left.'
            ]);
        }

        // Exact prizes array matching frontend order & labels
        $prizes = [
            ['label' => '₦50',   'color' => '#d32f2f', 'image' => '/mbtech/Mbtech.jpg'],
            ['label' => '₦100',  'color' => '#388e3c', 'image' => '/mbtech/Mbtech.jpg'],
            ['label' => '₦250',  'color' => '#f5f5f5', 'image' => '/mbtech/Mbtech.jpg'],
            ['label' => '₦500',  'color' => '#212121', 'image' => '/mbtech/Mbtech.jpg'],
            ['label' => '₦750',  'color' => '#ef5350', 'image' => '/mbtech/Mbtech.jpg'],
            ['label' => '₦1000', 'color' => '#66bb6a', 'image' => '/mbtech/Mbtech.jpg'],
            ['label' => '₦2000', 'color' => '#eeeeee', 'image' => '/mbtech/Mbtech.jpg'],
            ['label' => '₦3000', 'color' => '#424242', 'image' => '/mbtech/Mbtech.jpg'],
        ];

        // Randomly select a prize index
        $winIndex = rand(0, count($prizes) - 1);
        $prize = $prizes[$winIndex];

        // Deduct one spin chance
        SpinChance::where('user_id', $userId)->decrement('chances');

        // Extract numeric amount for adding to balance
        $amount = intval(str_replace('₦', '', $prize['label']));

        if ($amount > 0) {
            User::where('id', $userId)->increment('balance', $amount);
        }

        // Optionally save SpinReward record here
        /*
        SpinReward::create([
            'user_id' => $userId,
            'reward' => $prize['label'],
        ]);
        */

        return response()->json([
            'success' => true,
            'index' => $winIndex,        // For frontend slice alignment
            'amount' => $prize['label'], // Prize label like "₦50"
            'image' => $prize['image'],  // Image URL for prize
            'message' => "You won {$prize['label']}!"
        ]);
    }

    public function spin()
    {
        $user = Auth::user();
        $bonusHistory = \App\Models\BonusLedger::where('user_id', $user->id)
            ->latest()
            ->limit(10)
            ->get();

        return view('app.main.spin.index', compact('bonusHistory'));
    }

    public function spin_history()
    {
        return view('app.main.spin_history');
    }

    public function submitbonuscheck($code)
    {
        $bonus = \App\Models\Bonus::where('status', 'active')->first();
        $user = Auth::user();

        if ($bonus) {
            if ($code == $bonus->code) {
                // Check if user already used this bonus
                $checkBonusUses = \App\Models\BonusLedger::where('bonus_id', $bonus->id)
                    ->where('user_id', $user->id)
                    ->first();

                if ($checkBonusUses) {
                    return response()->json(['status' => false, 'message' => 'Invalid Code.']);
                }

                if ($bonus->counter < $bonus->set_service_counter) {
                    return response()->json(['status' => true]);
                } else {
                    return response()->json(['status' => false, 'message' => 'Targeted fulfil.']);
                }
            } else {
                return response()->json(['status' => false, 'message' => 'Code invalid.']);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Not available.']);
        }
    }

    public function submitbonusamount(Request $request)
    {
        $code = $request->code;
        $bonus = \App\Models\Bonus::where('status', 'active')->first();
        $user = Auth::user();

        if ($bonus) {
            if ($code == $bonus->code) {
                // Check if this user has already used the code
                $checkBonusUses = \App\Models\BonusLedger::where('bonus_id', $bonus->id)
                    ->where('user_id', $user->id)
                    ->first();

                if ($checkBonusUses) {
                    return redirect()->back()->with('success', 'Do not use this code again.');
                }

                if ($bonus->counter < $bonus->set_service_counter) {
                    $amount = $bonus->amount;

                    // Update user balance
                    $user->balance += $amount;
                    $user->save();

                    // Record user ledger
                    \App\Models\UserLedger::create([
                        'user_id' => $user->id,
                        'reason' => 'Claim',
                        'perticulation' => 'Congratulations ' . $user->name . ' you have successfully claimed your bonus.',
                        'amount' => $amount,
                        'debit' => $amount,
                        'status' => 'approved',
                        'date' => now()->format('d-m-Y H:i'),
                    ]);

                    // Update bonus usage count
                    $bonus->increment('counter');

                    // Record bonus usage
                    \App\Models\BonusLedger::create([
                        'user_id' => $user->id,
                        'bonus_id' => $bonus->id,
                        'bonus_code' => $code,
                        'amount' => $amount,
                    ]);

                    return redirect()->back()->with('success', 'Received ' . price($amount));
                } else {
                    return redirect()->back()->with('success', 'Try again later. Bonus limit reached.');
                }
            } else {
                return redirect()->back()->with('success', 'Invalid code.');
            }
        } else {
            return redirect()->back()->with('success', 'Bonus not available yet.');
        }
    }
}
