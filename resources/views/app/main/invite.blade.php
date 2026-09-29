<html class=" js no-touch">
 <head> 
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8"> 
  <title>{{env('APP_NAME')}} - Team</title> 
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
  <link rel="stylesheet" href="/static/home/css/swiper-bundle.min.css"> 
  <style id="ss-chat-custom-css">.ss-chat-body {overflow: hidden !important}</style>
  <link id="layuicss-layer" rel="stylesheet" href="https://www.cashkumarinvest.com/static/home/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all">
 </head> 
 <body class="bgColor"> 
  <div class="headTop"> 
   <a href="javascript:history.back();"> <i class="layui-icon layui-icon-left" style="font-size: 22px; color: #000;"></i> </a> Team 
  </div> 
  <div class="team" style="padding: 0"> 
   <div class="team-mask-div"> 
    <img class="cancelTx" src="/static/home/images/avatar.png" alt=""> 
    <div class="team-mask-divs"> 
     <h5>Invite Code</h5> 
     <h2>{{user()->ref_id}}</h2> 
     <a href="javascript:;" class="team-mask-divs-code copy" data-clipboard-text="{{user()->ref_id}}" onclick="copyLink('{{user()->ref_id}}')">Copy</a> 
     <img src="https://files.cashkumarcloud.top/20250721/2fa92a549a0067d8db943d0f4c1688a8.png" alt=""> 
     <p>{{url('register').'?ref='.auth()->user()->ref_id}}</p> 
     <a href="javascript:;" class="team-mask-divs-link copy" data-clipboard-text="{{url('register').'?ref='.auth()->user()->ref_id}}" onclick="copyLink('{{url('register').'?ref='.auth()->user()->ref_id}}')"> Copy Invitation </a> 
    </div> 
   </div> 
  </div> 
  <div class="loader" style="
    position: fixed;
    display: none;
    top: 50%;
    z-index: 99;
    width: 143px;
    border-radius: 15px;
    overflow: hidden;
    left: 50%;
    transform: translate(-50%, -50%);
">
    <img src="{{asset('public/loading.gif')}}" style="width: 100%;" alt="">
</div>

@include('alert-message')
<script>
    function copyLink(text)
    {
        const body = document.body;
        const input = document.createElement("input");
        body.append(input);
        input.style.opacity = 0;
        input.value = text.replaceAll(' ', '');
        input.select();
        input.setSelectionRange(0, input.value.length);
        document.execCommand("Copy");
        input.blur();
        input.remove();
        mes('Copied success..')
    }
</script>
</body>
</html>