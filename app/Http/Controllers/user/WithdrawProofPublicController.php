<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WithdrawProof;
use App\Models\Withdrawal;
use App\Models\UserLedger;
use Carbon\Carbon;

class WithdrawProofPublicController extends Controller
{   
    public function index()
    {
        // Your logic here
        return view('withdrawal-proofs.index');
    }
    // Show form
    public function create()
    {
        return view('proof.create');
    }

    // Handle submission
    public function store(Request $request)
    {
        $userId = Auth::id();
        $today = Carbon::today();

        // ✅ Check if already submitted today
        $alreadySubmitted = WithdrawProof::where('user_id', $userId)
            ->whereDate('created_at', $today)
            ->exists();

        if ($alreadySubmitted) {
            return redirect()->back()->with('error', 'You have already submitted a proof today.');
        }

        // ✅ Check if user has approved withdrawal today
        $hasSuccessfulWithdrawal = Withdrawal::where('user_id', $userId)
            ->where('status', 'approved')
            ->whereDate('created_at', $today)
            ->exists();

        if (!$hasSuccessfulWithdrawal) {
            return redirect()->back()->with('error', 'You can only submit proof after a successful withdrawal today.');
        }

        // ✅ Validate form input
        $request->validate([
            'comment' => 'required|string|max:500',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // ✅ Select reward randomly
        $rewardOptions = [3, 5, 8, 10, 15, 20];
        $reward = $rewardOptions[array_rand($rewardOptions)];

        // ✅ Upload image
        $proof = new WithdrawProof();
        $proof->user_id = $userId;
        $proof->comment = $request->comment;
        $path = uploadImage(false, $request, 'photo', 'upload/comment/', 200, 200, $proof->photo);
        $proof->photo = $path ?? $proof->photo;
        $proof->status = 'pending';
        $proof->reward_amount = $reward;
        $proof->save();

        /*/ ✅ Update user balance
        $user = Auth::user();
        $user->balance += $reward;
        $user->save();*/

        /*/ ✅ Add to user ledger
        UserLedger::create([
            'user_id' => $user->id,
            'type' => 'reward',
            'amount' => $reward,
            'description' => 'Reward for submitting withdrawal proof',
            'reference_id' => $proof->id,
            'reference_type' => WithdrawProof::class,
            'balance_after' => $user->balance,
            'created_at' => now(),
        ]);*/

        return redirect()->back()->with('success', 'Proof submitted successfully! Reward: R' . $reward);
    }
}
