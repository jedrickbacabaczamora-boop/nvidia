<?php

namespace App\Http\Controllers\user;

use App\Models\Fund;
use App\Models\FundInvest;
use App\Models\User;
use App\Models\UserLedger;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserFundInvestController extends Model
{
    use HasFactory;

    public function fund()
    {
        return view('app.main.fund');
    }

    public function myfund()
    {
        return view('app.main.myfund');
    }

    public function fund_confirmation($id)
    {
        $fund = Fund::find($id);

        $user = Auth::user();

        if ($user->balance >= $fund->minimum_invest){
            //User balance update
            User::where('id', $user->id)->update(['balance'=> $user->balance - $fund->minimum_invest]);

            //Insert new record into fundInvest for purchase
            $model = new FundInvest();
            $model->user_id = Auth::id();
            $model->fund_id = $fund->id;
            $model->validity_expired = Carbon::now()->addDays($fund->validity);
            $model->price = $fund->minimum_invest;
            $model->return_amount = $fund->commission;
            $model->status = 'active';
            $model->save();

            //Create a ledger
            $ledger = new UserLedger();
            $ledger->user_id = Auth::id();
            $ledger->reason = 'invest_fund';
            $ledger->perticulation = 'Congratulations '.$user->name. ' Start Fund Streaming';
            $ledger->amount = $fund->minimum_invest;
            $ledger->date = Carbon::now();
            $ledger->save();
            return redirect()->route('fund')->with('success', 'Start Streaming');
        }else{
            return redirect()->route('fund')->with('message', 'Sufficient balance.');
        }
    }
}
