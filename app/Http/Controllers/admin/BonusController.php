<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Bonus;
use App\Models\BonusLedger;
use Illuminate\Http\Request;

class BonusController extends Controller
{
    public $route = 'admin.bonus';
    public function index()
    {
        $datas = Bonus::get();
        return view('admin.pages.bonus.index', compact('datas'));
    }

    public function bonuslist()
    {
        $datas = BonusLedger::with(['user', 'bonus'])->orderByDesc('id')->get();
        return view('admin.pages.bonus.bonuslist', compact('datas'));
    }

    public function status($id)
    {
        $data = Bonus::find($id);
        $bonuses = Bonus::get();
        foreach ($bonuses as $bonus){
            Bonus::where('id', $bonus->id)->update([
                'status'=> 'inactive'
            ]);
        }
        $data->status = 'active';
        $data->update();
        return redirect()->route('admin.bonus.index')->with('success', 'Successfully Activate bonus');
    }
    public function create($id=null)
    {
        $data = null;
        if ($id){
            $data = Bonus::find($id);
        }
        return view('admin.pages.bonus.insert', compact('data'));
    }

    public function view($id=null)
    {
        $data = Bonus::find($id);
        return view('admin.pages.bonus.view', compact('data'));
    }

    public function insert_or_update(Request $request)
    {
        $this->validate($request,[
            'bonus_name'=> 'required',
            'set_service_counter'=> 'required|numeric',
            'code'=> 'required',
            'amount'=> 'required',
        ]);
        if ($request->id){
            $model = Bonus::findOrFail($request->id);
        }else{
            $model = new Bonus();
        }
        $model->bonus_name = $request->bonus_name;
        $model->set_service_counter = $request->set_service_counter;
        $model->code = $request->code;
        $model->amount = $request->amount;
        $model->save();
        return redirect()->route($this->route.'.index')->with('success', $request->id ? 'Bonus Updated Successful.' : 'Bonus Created Successful.');
    }

    public function delete($id)
    {
        $model = Bonus::find($id);
        $model->delete();
        return redirect()->route($this->route.'.index')->with('success','Item Deleted Successful.');
    }
}
