<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Services\PaymentServices;
use App\Models\Deposit;
use App\Models\PaymentMethod;
use App\Models\Usdt;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OnepayController extends Controller
{
    public function index()
    {
        return view('app.main.recharge.index');
    }
    public function recharge_record()
    {
        return view('app.main.recharge.recharge_record');
    }

    public function paymentMethod($amount)
    {
        return view('app.main.recharge.payment-method', compact('amount'));
    }

    public function payment_confirm($amount, $method, PaymentServices $payment)
    {

        $setting = Setting::first();

        $payment_method = PaymentMethod::where(['id' => $method, 'status' => 'active'])->inRandomOrder()->first();
        if (!$payment_method){
            return back()->with('error', 'Method not available.');
        }

        // Verify if Recharge Allowed
        if ($setting->open_deposit != 1) {
            return redirect()->back()->with('error', "You can't Recharge your wallet now, Service not available. Try again later.");
        }

        $jsonData = '';
        $linkData = '';
        $reference = rand(00000,99999);

        // Auto Deposit
        if($payment_method->auto && $setting->auto_deposit) {
            // Charge Payment
            $chargePayment = $payment->charge($reference, 'NGN', $amount, $payment_method->tag);

            // Exception
            if($chargePayment['status'] == false) {
                return back()->with("error", $chargePayment['message']);
            }

            $jsonData = json_encode([
                'reference' => $chargePayment['data']['reference'],
                'order_ref' => $chargePayment['data']['order_ref']
            ]);
            
            $linkData = $chargePayment['data']['link'];

            $model = new Deposit();
            $model->user_id = Auth::id();
            $model->method_name = $payment_method->name;
            $model->order_id = $reference;
            $model->transaction_id = $chargePayment['data']['order_ref'];
            $model->amount = $amount;
            $model->final_amount = $amount;
            $model->pay_link = $linkData;
            $model->data = $jsonData;
            $model->date = date('d-m-Y H:i:s');
            $model->status = 'pending';
            $model->save();

            return redirect()->away($linkData);
        }

        return view('app.main.recharge.payment-confirm', compact('amount', 'payment_method'));
    }

    public function depositSubmit(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'payment_method' => 'required',
            'transaction_id' => 'required',
            'photo' => 'required',
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate->errors());
        }

        $model = new Deposit();
        $model->user_id = Auth::id();
        $path = uploadImage(false ,$request, 'photo', 'upload/payment/', null, null ,$model->photo);

        $model->photo = $path ?? $model->photo;
        $model->method_name = $request->payment_method;
        $model->order_id = rand(00000,99999);
        $model->transaction_id = $request->transaction_id;
        $model->amount = $request->amount; 
        $model->oid = 'W-' . rand(100000, 999999) . rand(100000, 999999);
        $model->final_amount = $request->amount;
        $model->date = date('d-m-Y H:i:s');
        $model->status = 'pending';
        $model->save();
        return redirect()->route('home')->with('success', 'Deposit Success');
    }

    public function return_number($type)
    {
        $number = DB::table('payment_methods')->where('type', $type)->where('status', 'active')->inRandomOrder()->first();
        if ($number){
            $number = $number->number;
            return response()->json(['status'=> true, 'number'=> $number, 'message'=> $type. 'Available']);
        }else{
            return response()->json(['status'=> false, 'message'=> $type. 'Not processable']);
        }
    }

    public function amounviewer($amount)
    {
        $methods = PaymentMethod::where('status', 'active')->get()->unique('type');
        return view('app.main.recharge.onepay-method', compact('amount', 'methods'));
    }

    public function onepaytimeout()
    {
        return view('app.main.recharge.timeout');
    }

    public function onepaydetails()
    {
        $data = session()->get('onepay');
        if ($data['pay_method'] == 4){
            return view('app.main.recharge.order_cencle');
        }
        $method = PaymentMethod::where('id', $data['pay_method'])->first();

        $numbers = PaymentMethod::where('type', $method->type)->get()->pluck('number')->toArray();

        return view('app.main.recharge.onepaydetail', compact('data', 'numbers', 'method'));
    }

    public function onepaysubmit(Request $request)
    {
        $data = $request->all();
        session()->put('onepay', $data);
        return response()->json(['status'=> true]);
    }

    public function onePaydepositSubmit(Request $request)
    {
        $validate = Validator::make($request->all(), [
           'acc_acount' => 'required|numeric',
           'amount' => 'required|numeric',
            'oid' => 'required',
            'pay_method'=> 'required',
            'transaction_id'=> 'required'
        ], [
            'acc_acount.required'=> 'Account number mismatch',
            'oid.required'=> 'Order Id mismatch',
            'pay_method.required'=> "you can't select Payment method",
        ]);
        if ($validate->fails()){
            return back()->withErrors($validate->errors());
        }

        $method = PaymentMethod::find($request->pay_method);
        if ($method->minimum_recharge > 0 && $request->amount < $method->minimum_recharge){
            return "Recharge amount must be greater then ".$method->minimum_recharge;
        }
        if ($method->maximum_recharge > 0 && $request->amount > $method->maximum_recharge){
            return "Recharge amount must be less then ".$method->maximum_recharge;
        }

        $final_amount = 0;
        if ($method->recharge_charge > 0){
            $final_amount = ($method->recharge_charge * $request->amount) / 100;
        }

        $model = new Deposit();
        $model->user_id = Auth::id();
        $model->method_name = $method->name;
        $model->method_number = $method->number;
        $model->order_id = $request->oid;
        $model->transaction_id = $request->transaction_id;
        $model->number = $request->acc_acount;
        $model->amount = $request->amount;
        $model->charge_amount = $final_amount;
        $model->final_amount = $request->amount - $final_amount;
        $model->date = date('d-m-Y H:i:s');
        $model->status = 'pending';

        if ($model->save())
        {
            if (session()->has('onepay')){
                $data = [
                    'user_id'=> $model->user_id,
                    'order_id'=> $model->order_id,
                    'transaction_id'=> $model->transaction_id,
                    'number'=> $model->number,
                    'amount'=> $model->amount,
                    'charge_amount'=> $final_amount,
                    'final_amount'=> $request->amount - $final_amount,
                    'status'=> $model->status,
                ];
                session()->put('onepay', $data);
            }
            return response()->json(['status'=> true]);
        }
    }

    public function onepayDepositSuccess()
    {
        if (session()->has('onepay')){
            $data = session()->get('onepay');
        }else{
            $data = [];
        }
        return view('app.main.recharge.success', compact('data'));
    }

    public function usdt_deposit_submit(Request $request)
    {
        $model = new Usdt();
        $model->user_id = Auth::id();
        $model->amount = $request->usdt_amount;
        $model->save();
        return redirect()->route('user.onepay')->with('success', 'Success.');
    }

}
