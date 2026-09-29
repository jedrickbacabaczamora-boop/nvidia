<html class=" js no-touch">
 <head> 
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8"> 
  <title>{{env('APP_NAME')}} - Product</title> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"> 
  <meta name="apple-mobile-web-app-capable" content="yes"> 
  <meta name="apple-mobile-web-app-status-bar-style" content="black"> 
  <meta name="format-detection" content="telephone=no"> 
  <meta name="wap-font-scale" content="no">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <link rel="stylesheet" href="/static/home/css/reset.css"> 
  <link rel="stylesheet" href="/static/home/css/style.css"> 
  <link rel="stylesheet" href="/static/home/layui/css/layui.css"> 
  <link id="layuicss-layer" rel="stylesheet" href="https://www.cashkumarinvest.com/static/home/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all">
 </head> 
 <body class="wBg"> 
  <div class="headTop"> 
   <a href="javascript:history.back();"> <i class="layui-icon layui-icon-left" style="font-size: 22px; color: #000;"></i> </a> Product 
  </div> 
  <div class="productDetail"> 
   <h2 class="productDetailTitle">{{$package->name}}</h2> 
   <div class="productDetailCon"> 
    <div class="productDetailTop"> 
     <div class="productDetailTop-item"> 
      <label class="productDetailTop-label">Purchase Quantity</label> 
      <h3><span id="value">{{ $package->min_purchase_limit }}</span></h3> 
      <div class="productDetailInput"> 
       <p> <span>1</span> <span>{{ $package->max_purchase_limit }}</span> </p> 
       <input type="range" min="1" max="1000" value="1" id="myRange" class="slider"> 
      </div> 
     </div> 
    </div> 
    <p>Total Revenue <span>{{ price($package->commission_with_avg_amount) }}</span></p> 
    <p>Price <span>{{price ($package->price)}}</span></p> 
    <p>Daily Earnings <span>{{price($package->commission_with_avg_amount / $package->validity)}}</span></p> 
    <p>Revenue Days <span>{{ $package->validity }} </span></p> 
    <p>Invest Quantity <span class="number">{{ $package->max_purchase_limit }}</span></p> 
   </div> 
   <div class="productDetailHead"> 
    <img src="/static/home/images/p_5.png" class="productDetailHeadImg" alt=""> 
    <dl> 
     <dt>
      Account balance
     </dt> 
     <dd>
      <label></label>{{price(auth()->user()->balance)}}
     </dd> 
    </dl> 
    <a href="/recharge">Deposit <img src="/static/home/images/go.png" alt=""></a> 
   </div> 
   <div class="productList-links"> 
    <a class="rental" onclick="buyConfirm()"> Invest Now<span>{{ price($package->price) }}</span> </a> 
   </div> 
   <div class="productDetailTxt"> 
    <div class="productDetailTxtPro"> 
    </div> 
   </div> 
  </div> 
  <div class="z-mask" style="display: none"> 
   <div class="productDetailMask"> 
    <h3>Shopping list</h3> 
    <h5 class="tpaid"><span>₹</span></h5> 
    <ul> 
     <li>Buy Quantity <span class="tquantite"></span></li> 
     <li>Daily Income <span class="tdaile"></span></li> 
    </ul> 
    <div class="productDetailCancel"> 
     <div class="cancelLeft">
      <i class="layui-icon layui-icon-close" style="font-size: 22px; color: #333;"></i> 
     </div> 
     <div class="cancelRight">
      Confirm
     </div> 
    </div> 
   </div> 
  </div> 
  <!-- Loader Spinner -->
  <div class="loader loading" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 999;">
    <img src="{{ asset('public/loading.gif') }}" style="width: 100px;" alt="Loading">
  </div>

  @include('alert-message')

  <script src="/public/site/layui/layui.js"></script>
  <script>
    layui.use(['slider'], function(){
      var slider = layui.slider;
      let price = parseFloat("{{ $package->price }}");
      let min = parseInt("{{ $package->min_purchase_limit }}");
      let max = parseInt("{{ $package->max_purchase_limit }}");
      let buy_share = 1;

      // Render slider
      slider.render({
        elem: '#ID-slider-demo-value',
        value: 1,
        min: min,
        max: max,
        theme: '#0062E1',
        tips: true,
        tipsAlways: true,
        change: function(value){
          buy_share = value;
          let total_money = price * value;
          document.getElementById('total_money').innerText = total_money.toFixed(2);
          let daily = ({{ $package->commission_with_avg_amount }} / {{ $package->validity }}) * value;
          document.querySelector('.daily_income').innerText = daily.toFixed(2);
          document.querySelector('.buy_share').innerText = value;
        }
      });
    });

    function buyConfirm(){
      document.querySelector('.loading').style.display = 'block';
      window.location.href = '{{ url('purchase/confirmation/'.$package->id) }}';
    }
  </script>
</body>
</html>