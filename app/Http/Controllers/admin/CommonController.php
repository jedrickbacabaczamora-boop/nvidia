<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CommonController extends Controller
{
    public function status(Request $request)
    {
        $table = DB::table($request->table)->where('id', $request->id);
        if ($table->first()){
            $table->update(
                [
                   'status' =>  $request->status
                ]
            );
            return response()->json(['status'=> true, 'msg'=> 'WOW. Status changed successfully.']);
        }else{
            return response()->json(['status'=> false, 'msg'=> 'OOPs! Data not found.']);
        }
    }
}
