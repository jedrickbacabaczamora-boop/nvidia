<!DOCTYPE html>
<html class="js no-touch">
<head>
  <meta charset="utf-8">
  <title>{{ env('APP_NAME') }} - Add Bankcard</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.css">
  <!--<link rel="stylesheet" href="/static/home/css/reset.css"> 
  <link rel="stylesheet" href="/static/home/css/style.css"> 
  <!--<link rel="stylesheet" href="/static/home/css/swiper-bundle.min.css"> --
  <link rel="stylesheet" href="/static/home/css/style.mobile.css"> 
  <link rel="stylesheet" href="/static/home/layui/css/layui.css"> -->
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: linear-gradient(to bottom, #FEE17D, #FFF4B0);
    }

    .container {
      max-width: 480px;
      margin: 0 auto;
      padding: 20px;
    }

    .headTop {
      display: flex;
      align-items: center;
      padding: 15px;
      font-size: 18px;
      font-weight: bold;
      color: #000;
    }

    .headTop i {
      font-size: 22px;
      margin-right: 10px;
      cursor: pointer;
    }

    .form-box {
      background: white;
      border-radius: 14px;
      padding: 20px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .form-box .recharge-tit {
      margin-top: 15px;
      font-weight: bold;
    }

    .form-box input, .form-box select {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 15px;
      box-sizing: border-box;
    }

    .recharge-input {
      margin-top: 5px;
    }

    .recharge-btn {
      display: block;
      width: 100%;
      padding: 14px;
      background: #f7c621;
      border-radius: 40px;
      font-size: 16px;
      font-weight: bold;
      border: none;
      margin-top: 25px;
      cursor: pointer;
    }

    .recharge-rultit {
      text-align: center;
      margin-top: 30px;
      font-size: 16px;
      font-weight: bold;
    }

    .recharge-rul {
      font-size: 14px;
      line-height: 1.6;
      padding: 10px 0;
    }
  </style>
</head>
<body>

<div class="container">

  <div class="headTop">
    <a href="/user"><i class="layui-icon layui-icon-left" style="font-size: 22px;"></i></a>
    Add Bankcard
  </div>

  @php $user = auth()->user(); @endphp

  <form class="layui-form" action="{{ route('user.bank_setup_confirm') }}" method="POST">
    @csrf
    <div class="form-box">

      <!-- Mobile Number -->
      <div class="recharge-tit">Mobile Number</div>
      <div class="recharge-input">
        <input type="text" disabled value="{{ $user->phone }}">
      </div>

      <!-- Select Bank -->
      <div class="recharge-tit">Select Bank</div>
      <div class="recharge-input">
        <select name="gateway_method" lay-filter="bankSelect" lay-verify="required">
          <option value="">Please select a bank</option>
          @foreach(\App\Models\BankList::where('status', '1')->get() as $elemenet)
                                        <option value="{{$elemenet->bank_code}}" @if($user->gateway_method == $elemenet->bank_code) selected @endif>{{$elemenet->name}}</option>
                                      @endforeach
        </select>
      </div>

      <!-- Holder Name -->
      <div class="recharge-tit">Holder Name</div>
      <div class="recharge-input">
        <input type="text" name="realname" placeholder="Please enter holder name..." value="{{ $user->realname }}" required>
      </div>

      <!-- Bank Account -->
      <div class="recharge-tit">Bank Account</div>
      <div class="recharge-input">
        <input type="text" name="gateway_address" placeholder="Please enter bank account..." value="{{ $user->gateway_address }}" required>
      </div>

      <!-- Submit -->
      <button type="submit" class="recharge-btn">Confirm</button>

    </div>
  </form>

  <!-- Explanation Section -->
  <div class="recharge-rultit">Explain</div>
  <div class="recharge-rul">
    <p>1. Ensure the registered phone number is correct to receive OTP.</p>
    <p>2. Fill in correct bank info. IFSC 5th digit should be "0".</p>
    <p>3. For crypto withdrawals, use USDT TRC20 on Tron network.</p>
  </div>
</div>

<!-- Layui JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/layui.min.js"></script>
<script>
layui.use(['form'], function(){
  var form = layui.form;
  form.render('select'); // Re-render select elements

  // Optional: Listen to dropdown change
  form.on('select(bankSelect)', function(data){
    console.log("Bank selected:", data.value);
  });
});
</script>
</body>
</html>
