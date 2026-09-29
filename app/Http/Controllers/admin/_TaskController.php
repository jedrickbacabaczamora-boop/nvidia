<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Improvment;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public $route = 'admin.task';
    public function index()
    {
        $data = Task::first();
        return view('admin.pages.task.index', compact('data'));
    }

    public function create($id=null)
    {
        $data = null;
        if ($id){
            $data = Task::find($id);
        }
        return view('admin.pages.improvement.insert', compact('data'));
    }

    public function insert_or_update(Request $request)
    {
        $this->validate($request,[
            'task_code'=> 'required',
            'remaining_code'=> 'required|numeric',
            'amount'=> 'required|numeric',
        ]);

        if ($request->id){
            $model = Task::findOrFail($request->id);
        }else{
            $model = new Task();
        }
        $model->task_code = $request->task_code;
        $model->remaining_code = $request->remaining_code;
        $model->amount = $request->amount;
        $model->save();
        return redirect()->route($this->route.'.index')->with('success', $request->id ? 'Improvement Updated Successful.' : 'Improvement Created Successful.');
    }

    public function delete($id)
    {
        $model = Task::find($id);
        $model->delete();
        return redirect()->route($this->route.'.index')->with('success','Item Deleted Successful.');
    }
}
