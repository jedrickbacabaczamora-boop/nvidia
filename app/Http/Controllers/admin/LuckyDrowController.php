<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Drow;
use Illuminate\Http\Request;

class LuckyDrowController extends Controller
{
    public $route = 'admin.drow';
    public function index()
    {
        $datas = Drow::get();
        return view('admin.pages.drow.index', compact('datas'));
    }

    public function bonuslist()
    {
        $datas = BonusLedger::with(['user', 'bonus'])->orderByDesc('id')->get();
        return view('admin.pages.drow.drowlist', compact('datas'));
    }

    public function status($id)
    {
        $data = Drow::find($id);

        if ($data->status == 'active'){
            $data->status = 'inactive';
        }else{
            $data->status = 'active';
        }

        $data->update();
        return redirect()->route('admin.drow.index')->with('success', 'Successfully Activate bonus');
    }
    public function create($id=null)
    {
        $data = null;
        if ($id){
            $data = Drow::find($id);
        }
        return view('admin.pages.drow.insert', compact('data'));
    }

    public function view($id=null)
    {
        $data = Drow::find($id);
        return view('admin.pages.drow.view', compact('data'));
    }

    public function insert_or_update(Request $request)
    {
        $this->validate($request,[
            'amount'=> 'required|numeric',
        ]);
        if ($request->id){
            $model = Drow::findOrFail($request->id);
        }else{
            $model = new Drow();
        }
        $path = uploadImage(false ,$request, 'icon', 'upload/draw/', 70, 70 ,$model->photo);
        $model->icon = $path ?? $model->icon;
        $model->amount = $request->amount;
        $model->save();
        return redirect()->route($this->route.'.index')->with('success', $request->id ? 'Draw Updated Successful.' : 'Draw Created Successful.');
    }

    public function delete($id)
    {
        $model = Drow::find($id);
        deleteImage($model->icon);
        $model->delete();
        return redirect()->route($this->route.'.index')->with('success','Item Deleted Successful.');
    }
}
