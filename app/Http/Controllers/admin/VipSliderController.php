<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\VipSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VipSliderController extends Controller
{
    public $route = 'admin.vipslider';
    public function index()
    {
        $sliders = VipSlider::get();
        return view('admin.pages.vipslider.index', compact('sliders'));
    }
    public function create($id=null)
    {
        $data = null;
        if ($id){
            $data = VipSlider::find($id);
        }
        return view('admin.pages.vipslider.insert', compact('data'));
    }

    public function insert_or_update(Request $request)
    {
        if ($request->id){
            $model = VipSlider::findOrFail($request->id);
            $model->status = $request->status;
        }else{
            $model = new VipSlider();
        }
        $path = uploadImage(false ,$request, 'photo', 'upload/slider/', null, null ,$model->photo);
        $model->photo = $path ?? $model->photo;
        $model->page_type = 'home_page';
        $model->save();
        return redirect()->route($this->route.'.index')->with('success', $request->id ? 'Slider Updated Successful.' : 'Slider Created Successful.');
    }

    public function delete($id)
    {
        $model = VipSlider::find($id);
        deleteImage($model->photo);
        $model->delete();
        return redirect()->route($this->route.'.index')->with('success','Item Deleted Successful.');
    }
}
