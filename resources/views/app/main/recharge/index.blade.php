<!DOCTYPE html>
<html class="js no-touch">
<head>
  <meta charset="utf-8">
  <title>{{env('APP_NAME')}} - Deposit</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <!-- CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <link rel="stylesheet" href="/static/home/css/reset.css">
  <link rel="stylesheet" href="/static/home/css/style.css">
  <link rel="stylesheet" href="/static/home/layui/css/layui.css">
  <link id="layuicss-layer" rel="stylesheet" href="https://www.cashkumarinvest.com/static/home/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all">
</head>

<body class="bgColor">
  <div class="headTop">
    <a href="javascript:history.back();"><i class="layui-icon layui-icon-left" style="font-size: 22px; color: #000;"></i></a> Deposit
  </div>

  <!--<div class="news-change">
    <a class="cur" href="/recharge/cash"><img src="/static/home/images/u_1.png" alt=""> CASH ACCOUNT</a>
    <a href="/recharge/usdt"><img src="/static/home/images/u_4.png" alt=""> USDT ACCOUNT</a>
  </div>-->

  <div class="rechargeWallet">
    <p>Account balance</p>
    <h3> <span>{{price(auth()->user()->balance)}}</span></h3>
    <!--<small>≈ ₮1.1348</small>-->
  </div>

  <div class="recharge">
    <div class="recharge-all">

      <!-- Amount Section -->
      <div class="recharge-amounts">
        <div class="recharge-tit">Quick amount</div>
        <div class="recharge-input-new">
          <p>Amount</p>
          <i> {{setting('currency')}}</i>
          <input type="number" name="amount" placeholder="please enter deposit amount...">
        </div>
        <div class="recharge-click">
          <ul>
            <li data-amount="1000"> {{setting('currency')}}<span>1,000</span></li>
            <li data-amount="3000"> {{setting('currency')}}<span>3,000</span></li>
            <li data-amount="5000"> {{setting('currency')}}<span>5,000</span></li>
            <li data-amount="10000"> {{setting('currency')}}<span>10,000</span></li>
            <li data-amount="30000"> {{setting('currency')}}<span>30,000</span></li>
            <li data-amount="50000"> {{setting('currency')}}<span>50,000</span></li>
          </ul>
        </div>
      </div>

      <!-- Deposit Channels -->
      <div class="recharge-change">
        <div class="recharge-tit">Deposit Channel</div>
        <div class="recharge-list">
          @foreach(\App\Models\PaymentMethod::get() as $el)
          <div class="recharge-li" data-method="{{ $el->id }}">
            <div>
              <h3>{{ $el->name }}</h3>
              <p> {{setting('currency')}}200 ~  {{setting('currency')}}100,000</p>
            </div>
            <i></i>
          </div>
          @endforeach
        </div>
      </div>

      <!-- Submit -->
      <div class="recharge-change">
        <button type="button" class="recharge-btn">To Deposit</button>
      </div>

      <!-- Explanation -->
      <div class="recharge-rultit"><i></i>Explain</div>
      <div class="recharge-rul">
        <p>1. The minimum recharge amount is  {{setting('currency')}}200, and the minimum recharge amount for TRC-20 cryptocurrency is ₮10 USDT.</p>
        <p>2. Ensure the payment amount matches the entered amount. Always submit the recharge order before paying.</p>
        <p>3. If funds don't arrive within 5 minutes, contact customer support.</p>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="/static/home/layui/layui.js"></script>

  <script>
    // Select amount
    document.querySelectorAll('.recharge-click li').forEach(el => {
      el.addEventListener('click', function () {
        document.querySelectorAll('.recharge-click li').forEach(li => li.classList.remove('cur'));
        this.classList.add('cur');
        const amount = this.getAttribute('data-amount');
        document.querySelector('input[name="amount"]').value = amount;
      });
    });

    // Select deposit channel
    document.querySelectorAll('.recharge-li').forEach(el => {
      el.addEventListener('click', function () {
        document.querySelectorAll('.recharge-li').forEach(li => li.classList.remove('cur'));
        this.classList.add('cur');
      });
    });

    // Submit button logic
    document.querySelector('.recharge-btn').addEventListener('click', function () {
      const amount = document.querySelector('input[name="amount"]').value;
      const selectedChannel = document.querySelector('.recharge-li.cur');

      if (!amount || parseFloat(amount) < 200) {
        layer.msg("Minimum deposit amount is  {{setting('currency')}}200", { icon: 5 });
        return;
      }

      if (!selectedChannel) {
        layer.msg("Please select a payment channel", { icon: 5 });
        return;
      }

      const methodId = selectedChannel.getAttribute('data-method');
      const redirectUrl = `/user/payment/${amount}/${methodId}`;

      window.location.href = redirectUrl;
    });
  </script>
</body>
</html>
