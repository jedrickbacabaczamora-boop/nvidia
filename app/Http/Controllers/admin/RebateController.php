<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Rebate;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RebateController extends Controller
{
    public $route = 'admin.rebate';
    public function index()
    {
        $data = Rebate::find(1);
        return view('admin.pages.rebate', compact('data'));
    }

    public function insert_or_update(Request $request)
    {
        $model = Rebate::findOrFail(1);
        $model->team_commission1 = $request->team_commission1;
        $model->team_commission2 = $request->team_commission2;
        $model->team_commission3 = $request->team_commission3;
        $model->interest_commission1 = $request->interest_commission1;
        $model->interest_commission2 = $request->interest_commission2;
        $model->interest_commission3 = $request->interest_commission3;

        $model->update();
        return redirect()->route($this->route.'.index')->with('success', 'Rebate Updated Successfully.');
    }
}
