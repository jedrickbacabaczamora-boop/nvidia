<html class=" js no-touch">
 <head>
<title>Redeem Code</title> 
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
 <body class="bgColor"> 
  <div class="headTop"> 
   <a href="javascript:history.back(-1)"> <i class="layui-icon layui-icon-left" style="font-size: 22px; color: #000;"></i> </a> Bonus 
  </div> 
  <div>
      
   <div class="gift"> 
    </div> 
     <div class="giftCon">
      <form class="layui-form" id="redeem-form">
      <input type="text" name="bonus_code" required placeholder="please enter the bonus code"> 
      <button type="submit" class="gift-btn" lay-submit lay-filter="submitBonus">Receive Bonus</button>
      </div>
      </form>
     </div>

   <div class="z-mask" style="display:none"> 
    <div class="giftMask"> 
     <div class="giftMaskTxt"></div> 
     <div class="giftMaskTit"> 
      <p>Congratulations on receiving it successfully</p> 
     </div> 
     <img src="/static/home/images/g_1.png" class="giftMaskCo" alt=""> 
     <p class="giftMaskC">knew</p> 
    </div> 
   </div> 
  </div>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/layui.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
  <script>
    layui.use(['form', 'layer'], function(){
      var form = layui.form;
      var layer = layui.layer;

      form.on('submit(submitBonus)', function(data){
        layer.load(1, {shade: [0.1,'#fff']});
        $('#messageBox').text('').removeClass('success error');

        $.ajax({
          url: "{{ route('user.submit-bonus') }}",
          method: "POST",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: data.field,
          success: function(res){
            layer.closeAll('loading');
            if(res.status === 1){
              $('#messageBox').text(res.message).addClass('msg success');
              layer.msg(res.message, {icon: 1});
              showConfetti();
            } else {
              $('#messageBox').text(res.message).addClass('msg error');
              layer.msg(res.message, {icon: 2});
            }
          },
          error: function(){
            layer.closeAll('loading');
            $('#messageBox').text("An error occurred.").addClass('msg error');
          }
        });

        return false;
      });
    });

    function showConfetti() {
      const duration = 2 * 1000;
      const animationEnd = Date.now() + duration;
      const confettiSettings = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 1000 };

      const interval = setInterval(function() {
        if (Date.now() > animationEnd) {
          return clearInterval(interval);
        }

        confetti(Object.assign({}, confettiSettings, {
          particleCount: 50,
          origin: { x: Math.random(), y: Math.random() - 0.2 }
        }));
      }, 200);
    }
  </script>
</body>
</html>