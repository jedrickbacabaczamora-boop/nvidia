<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\HiruNotice;
use Illuminate\Http\Request;

class HiruSliderController extends Controller
{
    public $route = 'admin.hiruslider';
    public function index()
    {
        $datas = HiruNotice::orderByDesc('id')->get();
        return view('admin.pages.hiruslider.index', compact('datas'));
    }

    public function create($id=null)
    {
        $data = null;
        if ($id){
            $data = HiruNotice::find($id);
        }
        return view('admin.pages.hiruslider.insert', compact('data'));
    }

    public function insert_or_update(Request $request)
    {
        $this->validate($request,[
            'desc'=> 'required',
        ]);

        if ($request->id){
            $model = HiruNotice::findOrFail($request->id);
        }else{
            $model = new HiruNotice();
        }

        $model->desc = $request->desc;

        $model->save();
        return redirect()->route($this->route.'.index')->with('success', $request->id ? ' Updated Successful.' : ' Created Successful.');
    }

    public function delete($id)
    {
        $model = HiruNotice::find($id);
        $model->delete();
        return redirect()->route($this->route.'.index')->with('success','Item Deleted Successful.');
    }
}
