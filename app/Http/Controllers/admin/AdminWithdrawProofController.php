<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WithdrawProof;
use App\Models\UserLedger;

class AdminWithdrawProofController extends Controller
{
    public function index()
    {
        $title = 'Withdraw Proof';
        $proofs = WithdrawProof::with('user')->latest()->get();

        return view('admin.withdraw_proofs.index', compact('proofs', 'title'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $proof = WithdrawProof::with('user')->findOrFail($id);

        if ($request->status === 'approved' && $proof->status !== 'approved') {
            $user = $proof->user;

            // ✅ Update user balance
            $user->balance += $proof->reward_amount;
            $user->save();

            // ✅ Save to UserLedger
            UserLedger::create([
                'user_id' => $user->id,
                'reason' => 'reward',
                'perticulation' => 'Reward for approved withdrawal proof',
                'amount' => $proof->reward_amount,
                'credit' => $proof->reward_amount,
                'debit' => 0,
                'status' => 'approved',
                'step' => 'admin',
                'date' => now()->format('Y-m-d H:i:s'),
            ]);
        }

        // ✅ Update proof status
        $proof->status = $request->status;
        $proof->save();

        return back()->with('success', 'Proof status updated to ' . $request->status);
    }
}
