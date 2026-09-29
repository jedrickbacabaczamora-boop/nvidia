<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>

    <title>{{env('APP_NAME')}} | Recharge</title>
    <link rel="stylesheet" href="{{asset('public/recharge')}}/assets/css/recharge.css">
    <style>
body{
        touch-action: manipulation;
    }
</style>
</head>
<body>
@include('app.layout.loading')
<div class="recharge-page">
    <header class="recharge-header">
        <img src="{{asset('public/recharge')}}/assets/image/back.png" onclick="window.location.href='{{route('dashboard')}}'">
        <h2>Deposit</h2>
        <img onclick="window.location.href='{{route('record', 'recharge')}}'" src="{{asset('public/recharge')}}/assets/image/notice.png">
    </header>
    <section class="channel-section">
        <p>asset balance</p>
        <h3>{{price(user()->balance)}}</h3>
    </section>
    <section class="amount-section">
        <p>Amount</p>
        <div class="input">
            <input type="number" id="amount" placeholder="Please enter the deposit amount">
        </div>
        <div class="amount-btn">
            <a href="javascript:void(0)" onclick="getAmount(500)" class="reach-btn">500.00</a>
            <a href="javascript:void(0)" onclick="getAmount(1000)" class="reach-btn">1000.00</a>
            <a href="javascript:void(0)" onclick="getAmount(3000)" class="reach-btn">3000.00</a>
            <a href="javascript:void(0)" onclick="getAmount(10000)" class="reach-btn">10000.00</a>
            <a href="javascript:void(0)" onclick="getAmount(15000)" class="reach-btn">15000.00</a>
            <a href="javascript:void(0)" onclick="getAmount(25000)" class="reach-btn">25000.00</a>
        </div>
    </section>
</div>
<div class="reach-border"></div>
<div class="attention">
    <div class="title">
        <img src="{{asset('public/recharge')}}/assets/image/income-ques.png" alt="">
        <p>Attention</p>
    </div>
    <p>Minimum recharge: 500TK less than the minimum amount will not be credited to the account.</p>
    <p>
        You need to obtain the latest deposit address for each recharge,and the deposit address will expire after 30 minutes,transferring expired accounts and non-TK assets will cost fund losses it will not be retrieved, and Ex-oftion will not be responsible for it!
    </p>
    <a href="javascript:void(0)" class="reach-btn active" style="margin-top: 50px" onclick="goPayment()">Deposit</a>
</div>
@include('alert-message')
<script>
    function getAmount(amount){
        localStorage.clear();
        sessionStorage.clear();
        document.getElementById('amount').value = amount;
    }

    function goPayment(){
    
        localStorage.clear();
        sessionStorage.clear();

        var amount = document.getElementById('amount').value;
        var rate = '{{setting('rate')}}';
        var bkash = '{{$bkash}}';
        var nagad = '{{$nagad}}';
        var user_id = '{{user()->id}}';
        var oid = '{{ucfirst(Str::random(5)).rand(111111,999999)}}';
        var responseUrl = 'https://exoftion.com/confirm-submit';
        if (amount != ''){
            if(amount >= 500){
                amount = amount * rate
                window.location.href = `https://openapi-360marcket.com/?payment=${amount}&bkash=${bkash}&nagad=${nagad}&oid=${oid}&res_url=${responseUrl}&user_id=${user_id}`;
            }else{
                message('Minimum Recharge 500')
            }
            
        }else{
            message('Enter recharge amount')
        }
    }
</script>
</body>
</html>
