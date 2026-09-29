<html class=" js no-touch">
 <head> 
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8"> 
  <title>{{env('APP_NAME')}} - Withdraw</title> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"> 
  <meta name="apple-mobile-web-app-capable" content="yes"> 
  <meta name="apple-mobile-web-app-status-bar-style" content="black"> 
  <meta name="format-detection" content="telephone=no"> 
  <meta name="wap-font-scale" content="no"> 
  <link rel="stylesheet" href="/static/home/css/reset.css"> 
  <link rel="stylesheet" href="/static/home/css/style.css"> 
  <link rel="stylesheet" href="/static/home/css/swiper-bundle.min.css"> 
  <link rel="stylesheet" href="/static/home/layui/css/layui.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <link id="layuicss-layer" rel="stylesheet" href="https://www.cashkumarinvest.com/static/home/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all">
 </head>   @php $user = auth()->user(); @endphp
 <body class="bgColor"> 
  <div class="headTop"> 
   <a href="javascript:history.back();"> <i class="layui-icon layui-icon-left" style="font-size: 22px; color: #000;"></i> </a> Withdraw 
  </div> 
  <form class="layui-form" method="post" action="{{route('user.withdraw.request')}}">
        @csrf
  <!--<div class="news-change"> 
   <a class="cur" href="#"><img src="/static/home/images/u_1.png" alt=""> CASH WITHDRAW</a> 
   <a href="#"><img src="/static/home/images/u_4.png" alt=""> USDT WITHDRAW</a>
  </div> -->
  <div class="rechargeWallet"> 
   <p>Account balance</p> 
   <h3> <span>{{price(auth()->user()->balance)}}</span></h3> 
  <!--<small>≈ ₮1.0000</small> -->
  </div> 
  <div class="recharge"> 
   <div class="recharge-all"> 
    <div> 
     <div class="recharge-tit" style="margin-top: 0">
      Quick amount
     </div> 
     <div class="recharge-amount"> 
      <div class="recharge-input"> 
       <p class="recharge-p">Amount</p> 
       <i> {{setting('currency')}}</i> 
       <input type="number" name="amount" placeholder="please enter withdraw amount..."> 
      </div> 
     </div> 
     <div class="recharge-change"> 
      <div class="recharge-tit">
       Withdraw method
      </div> 
      <div class="recharge-dl"> 
       <div class="recharge-dt" data-mod="0"> 
        <div class="recharge-dd"> 
         <div class="recharge-amount"> 
          <h3>Holder Name</h3> 
          <span>{{ $user->realname }}</span> 
         </div> 
         <div class="recharge-amount"> 
          <h3>Bank Account</h3> 
          <span>{{ $user->gateway_address }}</span> 
         </div> 
         <div class="recharge-amount"> 
          <h3>WhatsApp</h3> 
          <span>{{ $user->phone }}</span> 
         </div> 
        </div> 
       </div> 
      </div> 
      <button type="submit" class="recharge-btn">Confirm</button> 
      <div class="recharge-rultit">
       <i></i>Explain
      </div> 
      <div class="recharge-rul"> 
       <p><span style="text-wrap: nowrap;"></span></p>
       <p><span style="color: rgb(0, 0, 0);"></span></p>
       <p><span style="color: rgb(255, 192, 0);"><strong><span style="text-wrap: nowrap;"></span></strong></span></p>
       <p><span style="font-size: 14px; font-family: "></span><span style="text-wrap: nowrap; font-family: ">1. A tax fee of 6% will be deducted from each withdrawal, with a minimum withdrawal application amount of  {{setting('currency')}}250.00 and a minimum withdrawal amount of USDT being ₮50.00.</span></p>
       <p><span style="text-wrap: nowrap; font-family: "><br></span></p>
       <p><span style="text-wrap: nowrap; font-family: ">2. Withdrawal application time is from 06:00 to 17:00 every day (excluding public holidays).</span></p>
       <p><span style="text-wrap: nowrap; font-family: "><br></span></p>
       <p><span style="text-wrap: nowrap; font-family: ">3. Your withdrawal amount will typically be credited within 24 hours, though the exact timing is determined by the bank's system, as banks update periodically after business hours. If you have any questions related to withdrawals, please contact official customer service for assistance.</span></p>
       <p><span style="font-size: 14px; font-family: "></span><br></p>
       <p></p>
       <p></p>
       <p></p>
       <p></p>
       <p></p>
       <p></p>
       <p></p>
       <p></p>
       <p></p>
       <p></p>
       <p></p>
       <p></p>
       <p></p>
       <p></p>
       <p></p>
       <p></p>
       <p></p>
       <p></p>
       <p></p>
       <p></p>
       <p></p>
       <p></p>
       <p></p>
       <p></p>
       <p></p>
       <p></p>
       <p></p> 
      </div> 
     </div> 
    </div> 
   </div> 
  </div> 
   
   @include('alert-message')
  <img style="position: fixed; display: none; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%;" src="{{asset('public/loading.gif')}}" class="loading" alt="">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/layui.min.js"></script>
  <script>
    function submitWithdraw() {
      document.querySelector('.loading').style.display = 'block';
      document.querySelector('form').submit();
    }
  </script>
</body>
</html>