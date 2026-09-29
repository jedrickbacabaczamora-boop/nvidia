<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NoticeController extends Controller
{
    public $route = 'admin.notice';
    public function index()
    {
        $datas = Notice::orderByDesc('id')->get();
        return view('admin.pages.notice.index', compact('datas'));
    }
    public function view($id)
    {
        $data = Notice::find($id);
        return view('admin.pages.notice.view', compact('data'));
    }
    public function create($id=null)
    {
        $data = null;
        if ($id){
            $data = Notice::find($id);
        }
        return view('admin.pages.notice.insert', compact('data'));
    }

    public function insert_or_update(Request $request)
    {
        $this->validate($request,[
            'notice_type'=> 'required',
            'notice_title'=> 'required',
            'notice_desc'=> 'required',
        ]);

        if ($request->id){
            $model = Notice::findOrFail($request->id);
            $model->status = $request->status;
        }else{
            $model = new Notice();
        }

        $model->notice_type = $request->notice_type;
        $model->notice_title = $request->notice_title;
        $model->notice_desc = $request->notice_desc;

        $model->save();
        return redirect()->route($this->route.'.index')->with('success', $request->id ? 'Notice Updated Successful.' : 'Notice Created Successful.');
    }

    public function delete($id)
    {
        $model = Notice::find($id);
        $model->delete();
        return redirect()->route($this->route.'.index')->with('success','Item Deleted Successful.');
    }
}
