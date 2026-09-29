<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Rebate;
use App\Models\User;
use App\Models\Task;
use App\Models\TaskRequest;
use App\Models\Deposit;
use App\Models\Purchase;
use App\Models\UserLedger;
use Illuminate\Support\Facades\Auth;

class MiningController extends Controller
{
    public function running_mining()
    {
        return view('app.main.order.order');
    }

    public function start_mining($pack_id){
        $parchase = Purchase::where('package_id', $pack_id)->where('user_id', \auth()->id())->where('status', 'active')->orderByDesc('id')->first();
        if ($parchase){
            $parchase->running_status = 'running';
            $parchase->save();
        }
        return back();
    }


    public function received_amount()
    {
        $user = Auth::user();
        $rebate = Rebate::first();

        if ($user->receive_able_amount > 0){
            $uu = User::where('id', $user->id)->first();
            $uu->balance = $user->balance + $user->receive_able_amount;

            $ledger = new UserLedger();
            $ledger->user_id = $user->id;
            $ledger->reason = 'daily_income';
            $ledger->perticulation = 'Commission Received.';
            $ledger->amount = $user->receive_able_amount;
            $ledger->credit = $user->receive_able_amount;
            $ledger->status = 'approved';
            $ledger->date = date("Y-m-d H:i:s");
            $ledger->save();

            $uu->receive_able_amount = 0;
            $uu->save();

            return response()->json(['status'=>true, 'success'=>'My Commission Received.', 'received_balance'=> price($uu->receive_able_amount)]);
        }else{
            return response()->json(['status'=>false, 'error'=>'Income not added yet.']);
        }
    }


    public function received_tareget_registered()
    {
        $user = Auth::user();
        $first_level_users = User::where('ref_by', auth()->user()->ref_id)->count();
        if($first_level_users >= setting('total_member_register_reword')){
            if ($user->reword_balance > 0){
                $user->balance = $user->balance + $user->reword_balance;

                $ledger = new UserLedger();
                $ledger->user_id = $user->id;
                $ledger->reason = 'reword';
                $ledger->perticulation = 'Invite Register Reword';
                $ledger->amount = $user->reword_balance;
                $ledger->debit = $user->reword_balance;
                $ledger->status = 'approved';
                $ledger->date = date('d-m-Y H:i');
                $ledger->save();

                $user->reword_balance = 0;
                $user->save();

                return response()->json(['status'=>true, 'message'=>'Congratulations. you have received reword.', 'reword'=> price($user->reword_balance)]);
            }else{
                return response()->json(['status'=>false, 'message'=>'Already received '.setting('total_member_register_reword'). 'member reword.', 'reword'=> price($user->reword_balance)]);
            }
        }else{
            return response()->json(['status'=>false, 'message'=>'Not yet ready for received reword.', 'reword'=> price($user->reword_balance)]);
        }
    }


    public function received_invest_commission()
    {
        $user = Auth::user();
        if ($user->invest_cumulative_balance > 0){
            $user->balance = $user->balance + $user->invest_cumulative_balance;
            $user->invest_cumulative_balance_received = $user->invest_cumulative_balance_received + $user->invest_cumulative_balance;

            $ledger = new UserLedger();
            $ledger->user_id = $user->id;
            $ledger->reason = 'reword';
            $ledger->perticulation = 'Invest commission received.';
            $ledger->amount = $user->invest_cumulative_balance;
            $ledger->debit = $user->invest_cumulative_balance;
            $ledger->status = 'approved';
            $ledger->date = date('d-m-Y H:i');
            $ledger->save();

            $user->invest_cumulative_balance = 0;
            $user->save();

            return response()->json(['status'=>true, 'message'=>'Congratulations. you have received invest commission.', 'invest_balance'=> price($user->invest_cumulative_balance), 'cumulative'=> price($user->invest_cumulative_balance_received)]);
        }else{
            return response()->json(['status'=>false, 'message'=>'Receivable amount not eligible ', 'invest_balance'=> price($user->invest_cumulative_balance), 'cumulative'=> price($user->invest_cumulative_balance_received)]);
        }
    }


    public function received_interest_commission()
    {
        $user = Auth::user();
        if ($user->interest_cumulative_balance > 0){
            $user->balance = $user->balance + $user->interest_cumulative_balance;
            $user->interest_cumulative_balance_received = $user->interest_cumulative_balance_received + $user->interest_cumulative_balance;

            $ledger = new UserLedger();
            $ledger->user_id = $user->id;
            $ledger->reason = 'reword';
            $ledger->perticulation = 'Interest commission received.';
            $ledger->amount = $user->interest_cumulative_balance;
            $ledger->debit = $user->interest_cumulative_balance;
            $ledger->status = 'approved';
            $ledger->date = date('d-m-Y H:i');
            $ledger->save();

            $user->interest_cumulative_balance = 0;
            $user->save();

            return response()->json(['status'=>true, 'message'=>'Congratulations. you have received invest commission.', 'interest_receive_balance'=> price($user->interest_cumulative_balance), 'interest_received_balance'=> price($user->interest_cumulative_balance_received)]);
        }else{
            return response()->json(['status'=>false, 'message'=>'Receivable amount not eligible ', 'interest_receive_balance'=> price($user->interest_cumulative_balance), 'interest_received_balance'=> price($user->interest_cumulative_balance_received)]);
        }
    }

    public function process()
    {
        return view('app.main.order.process');
    }
    public function apply_task_commission($task_id)
    {
        $task = Task::find($task_id);

        if (!$task) {
            return redirect('tasks')->with('error', 'Invalid task.');
        }

        $user = Auth::user();

        // Already applied?
        $taskSubmitCheck = TaskRequest::where('user_id', $user->id)
            ->where('task_id', $task_id)
            ->where('status', '!=', 'rejected')
            ->exists();

        if ($taskSubmitCheck) {
            return redirect('tasks')->with('success', 'Already submitted.');
        }

        // Get valid referrals
        $referUsers = User::where('ref_by', $user->ref_id)
            ->where('investor', 1) // only those who have invested
            ->pluck('id');

        if ($referUsers->count() < $task->team_size) {
            return redirect('tasks')->with('error', 'You need more team members.');
        }

        // Check total deposit of referrals
        $totalTeamInvestment = Deposit::whereIn('user_id', $referUsers)
            ->where('status', 'approved')
            ->sum('amount');

        if ($totalTeamInvestment < $task->invest) {
            return redirect('tasks')->with('error', 'Total team investment not enough.');
        }

        // Save task request
        $taskRequest = new TaskRequest();
        $taskRequest->task_id = $task->id;
        $taskRequest->user_id = $user->id;
        $taskRequest->team_invest = $task->invest;
        $taskRequest->team_size = $task->team_size;
        $taskRequest->status = 'approved'; // Auto approved
        $taskRequest->save();

        // Add to user ledger
        $ledger = new UserLedger();
        $ledger->user_id = $user->id;
        $ledger->reason = 'task';
        $ledger->perticulation = 'Task bonus reward';
        $ledger->amount = $task->bonus;
        $ledger->credit = $task->bonus;
        $ledger->status = 'approved';
        $ledger->date = now();
        $ledger->save();

        return redirect('tasks')->with('success', 'Task bonus claimed!');
    }

}















