<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Fund;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FundController extends Controller
{
    public $route = 'admin.fund';
    public function index()
    {
        $funds = Fund::get();
        return view('admin.pages.fund.index', compact('funds'));
    }
    public function create($id=null)
    {
        $data = null;
        if ($id){
            $data = Fund::find($id);
        }
        return view('admin.pages.fund.insert', compact('data'));
    }

    public function view($id=null)
    {
        $data = Fund::find($id);
        return view('admin.pages.fund.view', compact('data'));
    }

    public function insert_or_update(Request $request)
    {
        $this->validate($request,[
            'name'=> 'required',
            'title'=> 'required',
            'commission'=> 'required',
            'validity'=> 'required',
            'minimum_invest'=> 'required|numeric',
        ]);
        if ($request->id){
            $model = Fund::findOrFail($request->id);
            $model->status = $request->status;
        }else{
            $model = new Fund();
        }

        $path = uploadImage(false ,$request, 'photo', 'upload/fund/', 200, 200 ,$model->photo);
        $model->photo = $path ?? $model->photo;

        $model->name = $request->name;
        $model->title = $request->title;
        $model->minimum_invest = $request->minimum_invest;
        $model->commission = $request->commission;
        $model->validity = $request->validity;
        $model->save();
        return redirect()->route($this->route.'.index')->with('success', $request->id ? 'Fund Updated Successful.' : 'Package Created Successful.');
    }

    public function delete($id)
    {
        $model = Fund::find($id);
        $model->delete();
        return redirect()->route($this->route.'.index')->with('success','Item Deleted Successful.');
    }
}
