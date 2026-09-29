<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Buy Product_CARGILL</title>

  <!-- Styles -->
  <link rel="stylesheet" href="/public/site/layui/css/layui.css">
  <link rel="stylesheet" href="/public/site/css/common.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">

  <!-- Optional: Custom Style -->
  <style>
    .product_name {
      font-family: PingFang SC, PingFang SC;
      font-weight: 700;
      font-size: 24px;
      color: #FFFFFF;
      line-height: 24px;
    }
    .dashed {
      border-top: 1px dashed #cccccc;
      height: 1px;
      overflow: hidden;
      position: relative;
    }
    .dashed:before, .dashed:after {
      display: block;
      position: absolute;
      content: "";
      width: 20px;
      height: 20px;
      background-color: #f3f5f9;
      border-radius: 50%;
      top: -10px;
    }
    .dashed:before {
      left: -10px;
    }
    .dashed:after {
      right: -10px;
    }

    /* Confirmation dialog style */
    .dialog_contents {
      padding: 10px;
      font-size: 15px;
    }
    .dialog_contents .explain {
      font-weight: bold;
      margin-bottom: 10px;
    }
    .dialog_contents .item {
      display: flex;
      justify-content: space-between;
      padding: 5px 0;
    }
    .dialog_contents .item .label {
      color: #666;
    }
    .dialog_contents .item .value {
      font-weight: bold;
    }
  </style>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://unpkg.com/layer-mobile/layer.js"></script>
</head>

<body class="common_body">
  <div class="common_header common_header_order" style="height: 150px;">
    <a href="javascript:history.back(-1)" class="back position">
      <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p> Buy Product
    </a>
    <a href="/help" style="position:absolute;top:15px; right:15px;height: 36px;width: 36px;background: #20C57A;border-radius: 12px;border: 1px solid #7DD8A2;">
      <img src="/public/site/img/common/service.png" style="height:22px;width: 22px;padding-top: 8px;padding-left: 8px">
    </a>
    <div style="padding: 10px 20px;">
      <p class="product_name">{{$package->name}}</p>
    </div>
  </div>

  <div class="product_details_main">
    <div class="product_details_card" style="padding: 0px">
      <div style="border-radius: 16px;padding: 15px">
        <div class="product_details_item" style="border-bottom: none">
          <div>
            <p class="value position"> {{$package->validity}} Days </p>
            <p class="label" style="margin-top: 5px">Revenue Duration</p>
          </div>
          <div>
            <p class="value position"><span class="unit">R</span> {{($package->price)}}</p>
            <p class="label" style="margin-top: 5px">Price</p>
          </div>
        </div>
        <div class="product_details_item" style="border-bottom: none">
          <div>
            <p class="value position" style="margin-left: 15px;"><span class="unit">R</span> {{($package->commission_with_avg_amount)}}</p>
            <p class="label" style="margin-top: 5px">Total Income</p>
          </div>
          <div>
            <p class="value" style="text-align: center"><img src="/public/site/img/vip/lv0.png" style="height: 18px;width: 18px"></p>
            <p class="label" style="margin-top: 5px">Need Level</p>
          </div>
          <div>
            <p class="value">5</p>
            <p class="label" style="margin-top: 5px">Maximum</p>
          </div>
        </div>
      </div>

      <div class="dashed"></div>

      <div style="padding: 15px">
        <div class="product_details_item">
          <p class="label">Buy Share</p>
          <p class="value buy_share">1</p>
        </div>
        <div class="product_details_item">
          <p class="label"> Daily Income </p>
          <p class="value position"><span class="unit">R</span> <span class="daily_income">{{($package->commission_with_avg_amount / $package->validity)}}</span></p>
        </div>
        <div class="product_details_item">
          <p class="label">Payment</p>
          <p class="value position"><span class="unit">R</span><span id="total_money">{{($package->price)}}</span></p>
        </div>

        <div class="product_details_item">
         <!-- <div style="font-weight: 700;font-size: 13px;color: #666;height: 30px;line-height: 30px;padding-right: 10px;width: 80px;">MIN1</div>
          <div id="ID-slider-demo-value" style="width: 100%;margin-top: 12px;">
            <div class="layui-slider">
              <div class="layui-slider-tips" style="left: 0%; display: inline-block;">1</div>
              <div class="layui-slider-bar" style="background:#27C85D; width:0%;left:0;"></div>
              <div class="layui-slider-wrap" style="left:0%;">
                <div class="layui-slider-wrap-btn" style="border: 2px solid #27C85D;"></div>
              </div>
            </div>
          </div>
          <div style="padding-left:10px;width:80px;font-weight: 700;font-size: 13px;color: #666;height: 30px;line-height: 30px">MAX100</div>
        </div>-->

        <div class="layui-btn layui-btn-lg layui-btn-radius buy-btn layui-btn-fluid buy_btn" onclick="buyConfirm()">Buy Now</div>
      </div>
    </div>

    <div class="product_details_card">
      <div class="product_details_name" style="border-left: 4px solid #EBD8A3 ;padding-left: 10px;">
        {{$package->category}}
      </div>
      <div style="font-family: Arial;font-weight: 400;font-size: 14px;color: #2A415C;line-height: 22px;">
        <p style="margin-bottom: 10px;">The investment amount of this product is as low as {{price($package->price)}}</p>
        <p style="margin-bottom: 10px;">Period：{{$package->validity}} Days</p>
        <p style="margin-bottom: 10px;">Total income obtained：R {{($package->commission_with_avg_amount)}}</p>
      </div>
    </div>
  </div>

  <!-- Buy Now Confirmation Dialog -->
  
<div class="loading" style="position: fixed; top: 50%; left: 50%; width: 100%; height: 100%; display: none; transform: translate(-50%, -50%); z-index: 22;">
    <img style="width: 120px;position: absolute;top: 50%; transform: translate(-50%, -50%); left: 50%;" src="{{asset('public/loading.gif')}}" alt="">
</div>

@include('alert-message')
@include('alert-message')

<script>
    function buyConfirm(){
        document.querySelector('.loading').style.display = 'block';
        window.location.href='{{url('purchase/confirmation')}}'+'/'+'{{$package->id}}';
    }
</script>

</body>
</html>