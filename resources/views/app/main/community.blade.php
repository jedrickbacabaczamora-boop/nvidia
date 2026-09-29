<html class=" js no-touch">
 <head> 
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8"> 
  <title>{{env('APP_NAME')}} - VIP Ievel description</title> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"> 
  <meta name="apple-mobile-web-app-capable" content="yes"> 
  <meta name="apple-mobile-web-app-status-bar-style" content="black"> 
  <meta name="format-detection" content="telephone=no"> 
  <meta name="wap-font-scale" content="no"> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <link rel="stylesheet" href="/static/home/layui/css/layui.css"> 
  <link rel="stylesheet" href="/static/home/css/reset.css"> 
  <link rel="stylesheet" href="/static/home/css/style.css"> 
  <link rel="stylesheet" href="/static/home/layui/css/layui.css"> 
  <link rel="stylesheet" href="/static/home/css/swiper-bundle.min.css"> 
  <link id="layuicss-layer" rel="stylesheet" href="https://www.cashkumarinvest.com/static/home/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all">
 </head> 
 <body class="bgColor"> 
  <div class="head" style="background: none;"> 
   <a href="javascript:history.back();"> <i class="layui-icon layui-icon-left"></i> </a> VIP Ievel description 
  </div> 
  <div class="level" style="padding-top: 50px"> 
   <div class="mineTop" style="border: none;"> 
    <div class="mineLogo" id="avatar" style="width: 50px; height: 50px; margin-right: 6px;"> 
     <img class="logoAvater" src="/static/home/images/avatar.png"> 
    </div> 
    <div class="mineMain" style="margin: 0; width: calc(100% - 65px); text-align: left;"> 
     <h3 style="color: #FCE07B"> ID: {{user()->ref_id}}  <img class="lvImg" src="https://files.cashkumarcloud.top/20250710/114276500b39bf8c44b1e29c55149655.png" alt=""> </h3> 
     <p style="color: #A6881C">+27 {{substr(auth()->user()->phone, 0, 3)}}******{{substr(strrev(auth()->user()->phone), 0, 2)}}</p> 
    </div> 
    <div class="mineMainTar"> 
     <div class="mineMainTarHd"> 
      <div class="mineMainTarHdTop"> 
       <span>497</span> more to upgrade to VIP1 
      </div> 
      <div class="mineMainTarHdBar"> 
       <span style="width: 50%"></span> 
      </div> 
     </div> 
     <div class="mineMainTarBd">
       Upgrade Now 
     </div> 
    </div> 
   </div> 
   <div class="levelDetailHead"> 
    <h3>Membership Level</h3> 
    <div class="vipHead"> 
     <div class="vip-slide one" data-slide="1"> 
      <img src="https://files.cashkumarcloud.top/20250710/114276500b39bf8c44b1e29c55149655.png" alt="" class="vipBgImg"> 
      <div class="vipBgTxt"> 
       <h2>{{setting('currency')}} 0</h2> 
      </div> 
     </div> 
     <div class="vip-slide two" data-slide="2"> 
      <img src="https://files.cashkumarcloud.top/20250710/f13b570df8824a6e105e0ae706b39c52.png" alt="" class="vipBgImg"> 
      <div class="vipBgTxt"> 
       <h2>{{setting('currency')}} 497</h2> 
      </div> 
     </div> 
     <div class="vip-slide three" data-slide="3"> 
      <img src="https://files.cashkumarcloud.top/20250710/53cf3d0b6d1da61bc9b9dabdb7494c08.png" alt="" class="vipBgImg"> 
      <div class="vipBgTxt"> 
       <h2>{{setting('currency')}} 7999</h2> 
      </div> 
     </div> 
     <div class="vip-slide four" data-slide="4"> 
      <img src="https://files.cashkumarcloud.top/20250710/bb8b171397100699649799fa5ec15179.png" alt="" class="vipBgImg"> 
      <div class="vipBgTxt"> 
       <h2>{{setting('currency')}} 29999</h2> 
      </div> 
     </div> 
     <div class="vip-slide five" data-slide="5"> 
      <img src="https://files.cashkumarcloud.top/20250710/c5df607d4cb151946f3e8189bb2c5c4b.png" alt="" class="vipBgImg"> 
      <div class="vipBgTxt"> 
       <h2>{{setting('currency')}} 99999</h2> 
      </div> 
     </div> 
     <div class="vip-slide six" data-slide="6"> 
      <img src="https://files.cashkumarcloud.top/20250710/a61336e0bda88205faf478aaa7f04738.png" alt="" class="vipBgImg"> 
      <div class="vipBgTxt"> 
       <h2>{{setting('currency')}} 299999</h2> 
      </div> 
     </div> 
     <div class="vip-slide seven" data-slide="7"> 
      <img src="https://files.cashkumarcloud.top/20250710/4e29153bb06879a6260a79e2430184b2.png" alt="" class="vipBgImg"> 
      <div class="vipBgTxt"> 
       <h2>{{setting('currency')}} 599999</h2> 
      </div> 
     </div> 
    </div> 
   </div> 
  </div> 
  <script type="text/javascript">
    layui.use(['form', 'layer'], function () {
        $ = layui.jquery;
        var form = layui.form, layer = layui.layer;
    });
</script> 
 </body>
</html>