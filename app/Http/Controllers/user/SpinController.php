<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SpinChance;
use App\Models\SpinReward;
use App\Models\Bonus;
use App\Models\BonusLedger;
use App\Models\UserLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpinController extends Controller
{
    /**
     * Show the spin page with user's current spin chances.
     */
    public function showSpin()
    {
        $user = Auth::user();
        $chances = SpinChance::where('user_id', $user->id)->value('chances') ?? 0;

        return view('app.spin.index', compact('chances', 'user'));
    }

    /**
     * Handle the spin request via AJAX and return JSON response.
     */
    public function spinNow(Request $request)
    {
        $user = Auth::user();

        // Get current chances
        $chances = SpinChance::where('user_id', $user->id)->value('chances') ?? 0;

        if ($chances <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'No spin chances left.'
            ]);
        }

        // Reward list matching slice colors and labels (must correspond with frontend slices)
        $rewardList = [
            ['reward' => '₦50', 'color' => '#d32f2f', 'image' => asset('images/rewards/red.png')],
            ['reward' => '₦100', 'color' => '#388e3c', 'image' => asset('images/rewards/green.png')],
            ['reward' => '₦250', 'color' => '#f5f5f5', 'image' => asset('images/rewards/white.png')],
            ['reward' => '₦500', 'color' => '#212121', 'image' => asset('images/rewards/black.png')],
            ['reward' => '₦750', 'color' => '#ef5350', 'image' => asset('images/rewards/lightred.png')],
            ['reward' => '₦1000', 'color' => '#66bb6a', 'image' => asset('images/rewards/lightgreen.png')],
            ['reward' => '₦2000', 'color' => '#eeeeee', 'image' => asset('images/rewards/nearwhite.png')],
            ['reward' => '₦3000', 'color' => '#424242', 'image' => asset('images/rewards/darkgray.png')],
        ];

        // Randomly select a prize index
        $prizeIndex = array_rand($rewardList);
        $prize = $rewardList[$prizeIndex];

        $rewardLabel = $prize['reward'];
        $rewardAmount = intval(str_replace('₦', '', $rewardLabel));
        $rewardImage = $prize['image'];

        // Record the spin reward in DB
        SpinReward::create([
            'user_id' => $user->id,
            'reward' => $rewardLabel,
        ]);

        // Deduct a chance
        SpinChance::where('user_id', $user->id)->decrement('chances');

        // Add reward amount to user's balance if > 0
        if ($rewardAmount > 0) {
            $user->increment('balance', $rewardAmount);
        }

        return response()->json([
            'success' => true,
            'amount' => $rewardLabel,
            'image' => $rewardImage,
            'index' => $prizeIndex, // for frontend wheel stop position
            'message' => "You won $rewardLabel!"
        ]);
    }

    /**
     * Show the spin history page.
     */
    public function spin_history()
    {
        return view('app.main.spin_history');
    }

    /**
     * AJAX check if bonus code is valid and usable.
     */
    public function submitbonuscheck($code)
    {
        $bonus = Bonus::where('status', 'active')->first();
        $user = Auth::user();

        if (!$bonus) {
            return response()->json(['status' => false, 'message' => 'Bonus not available.']);
        }

        if ($code !== $bonus->code) {
            return response()->json(['status' => false, 'message' => 'Invalid code.']);
        }

        $hasUsed = BonusLedger::where('bonus_id', $bonus->id)->where('user_id', $user->id)->exists();

        if ($hasUsed) {
            return response()->json(['status' => false, 'message' => 'You have already used this bonus code.']);
        }

        if ($bonus->counter >= $bonus->set_service_counter) {
            return response()->json(['status' => false, 'message' => 'Bonus usage limit reached.']);
        }

        return response()->json(['status' => true]);
    }

    /**
     * Handle bonus amount claim submission.
     */
    public function submitbonusamount(Request $request)
    {
        $code = $request->code;
        $bonus = Bonus::where('status', 'active')->first();
        $user = Auth::user();

        if (!$bonus) {
            return redirect()->back()->with('error', 'Bonus not available yet.');
        }

        if ($code !== $bonus->code) {
            return redirect()->back()->with('error', 'Invalid bonus code.');
        }

        $hasUsed = BonusLedger::where('bonus_id', $bonus->id)->where('user_id', $user->id)->exists();

        if ($hasUsed) {
            return redirect()->back()->with('error', 'You have already claimed this bonus.');
        }

        if ($bonus->counter >= $bonus->set_service_counter) {
            return redirect()->back()->with('error', 'Bonus usage limit reached. Try again later.');
        }

        $amount = $bonus->amount;

        // Update user balance
        $user->increment('balance', $amount);

        // Record user ledger entry
        UserLedger::create([
            'user_id' => $user->id,
            'reason' => 'Claim',
            'perticulation' => 'Congratulations '.$user->name.' you have successfully claimed your bonus.',
            'amount' => $amount,
            'debit' => $amount,
            'status' => 'approved',
            'date' => now()->format('d-m-Y H:i'),
        ]);

        // Increment bonus usage counter
        $bonus->increment('counter');

        // Record bonus usage by user
        BonusLedger::create([
            'user_id' => $user->id,
            'bonus_id' => $bonus->id,
            'bonus_code' => $code,
            'amount' => $amount,
        ]);

        return redirect()->back()->with('success', 'Received ' . number_format($amount, 2));
    }
}
