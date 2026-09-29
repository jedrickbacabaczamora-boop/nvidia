<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskRequest;
use App\Models\User;
use App\Models\UserLedger;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public $route = 'admin.task';
    public function index()
    {
        $tasks = Task::get();
        return view('admin.pages.task.index', compact('tasks'));
    }
    public function create($id=null)
    { 
        $data = null;
        if ($id){
            $data = Task::find($id);
        }
        return view('admin.pages.task.insert', compact('data'));
    }

    public function insert_or_update(Request $request)
    {
        $this->validate($request,[
            'invest'=> 'required|numeric',
            'bonus'=> 'required|numeric',
            'team_size'=> 'required|numeric',
        ]);
        if ($request->id){
            $model = Task::findOrFail($request->id);
        }else{
            $model = new Task();
        }
        $model->invest = $request->invest;
        $model->bonus = $request->bonus;
        $model->team_size = $request->team_size;
        $model->save();
        return redirect()->route($this->route.'.index')->with('success', $request->id ? 'Task Updated Successful.' : 'Task Created Successful.');
    }

    public function delete($id)
    {
        $model = Task::find($id);
        $taQuests = TaskRequest::where('task_id', $id)->get();

        foreach ($taQuests as $el){
            TaskRequest::find($el->id)->delete();
        }

        $model->delete();
        return redirect()->route($this->route.'.index')->with('success','Item Deleted Successful.');
    }


    public function task_request(){
        $tasks = TaskRequest::orderByDesc('id')->get();
        return view('admin.pages.task_request', compact('tasks'));
    }

    public function task_request_status($task_re_id, $status){
        $taskRe = TaskRequest::where('id', $task_re_id)->first();
        if ($taskRe){
            $task = Task::where('id', $taskRe->task_id)->first();
            $user = User::where('id', $taskRe->user_id)->first();
            if ($user){
                if ($status == 'approved' && $taskRe->status == 'pending'){
                    $user->balance = $user->balance + $task->bonus;
                    $user->save();

                    $taskRe->status = 'approved';
                    $taskRe->save();

                    $ledger = new UserLedger();
                    $ledger->user_id = $user->id;
                    $ledger->reason = 'task';
                    $ledger->perticulation = 'Task Mission Bonus';
                    $ledger->amount = $task->bonus;
                    $ledger->credit = $task->bonus;
                    $ledger->status = $status;
                    //$ledger->date = date('d-m-Y H:i');
                    $ledger->date = now()->format('Y-m-d H:i');
                    $ledger->save();
                }
                if ($status == 'rejected'){
                    if ($taskRe->status == 'pending'){
                        $taskRe->status = 'rejected';
                        $taskRe->save();
                    }
                    if ($taskRe->status == 'approved'){
                        $user->balance = $user->balance - $task->bonus;
                        $user->save();

                        $taskRe->status = 'rejected';
                        $taskRe->save();
                    }

                    $ledger = new UserLedger();
                    $ledger->user_id = $user->id;
                    $ledger->reason = 'task';
                    $ledger->perticulation = 'Task Commission '.price($task->bonus).' Rejected';
                    $ledger->amount = $task->bonus;
                    $ledger->debit = $task->bonus;
                    $ledger->status = $status;
                    //$ledger->date = date('d-m-Y H:i');
                    $ledger->date = now()->format('Y-m-d H:i');
                    $ledger->save();
                }

                return redirect()->route('admin.task.request.index')->with('success','request '.$taskRe->status);
            }else{
                return redirect()->route('admin.task.request.index')->with('success','User not found');
            }
        }else{
            return redirect()->route('admin.task.request.index')->with('success','Task Not found ');
        }
    }
}
