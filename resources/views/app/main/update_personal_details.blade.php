<html class=" js no-touch">
 <head> 
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8"> 
  <title>{{env('APP_NAME')}} - My invitation</title> 
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
   <a href="javascript:history.back();"> <i class="layui-icon layui-icon-left" style="font-size: 22px; color: #000;"></i> </a> My invitation 
  </div> 
  <div class="recharge" style="margin-top: 12vh"> 
   <div class="info-top"> 
    <div class="infoLogo" id="avatar"> 
     <img src="/static/home/images/avatar.png"> 
     <input type="hidden" name="avatar" value=""> 
     <span> <img src="/static/home/images/edit.png" alt=""> </span> 
    </div>
    <input class="layui-upload-file" type="file" accept="" name="file"> 
   </div> 
   <div class="bindCon" style="width: 86%; padding-top: 60px"> 
    <div class="recharge-amount"> 
     <h3>User Name</h3> 
     <div class="recharge-input"> 
      <i class="layui-icon layui-icon-username" style="color: #000"></i> 
      <input type="text" name="nickname" placeholder="please enter user name..." value=""> 
     </div> 
    </div> 
    <div class="recharge-amount"> 
     <h3>E-mail</h3> 
     <div class="recharge-input"> 
      <i class="layui-icon layui-icon-email" style="color: #000"></i> 
      <input type="text" name="email" placeholder="please enter email..." value=""> 
     </div> 
    </div> 
    <button type="button" class="recharge-btn">Confirm <img src="/static/home/images/go.png" alt=""></button> 
   </div> 
  </div> 
  <script type="text/javascript">
    var _token = "d1VtW342SGgO4wOQsajkCTplTQqqjEYrqDNJITo7";
    layui.use(['upload', 'form', 'layer'], function () {
        $ = layui.jquery;
        var form = layui.form, layer = layui.layer, upload = layui.upload;
        upload.render({
            elem: '#avatar',
            url: "https://www.cashkumarinvest.com/common/image",
            accept: 'file',
            auto: true,
            multiple: false,
            done: function (result) {
                switch (result.code) {
                    case 200:
                        $("#avatar img").attr('src', result.url);
                        $("input[name='avatar']").val(result.url);
                        break;
                    case 201:
                        layer.msg('login invalid...', {icon: 16, time: 1000, shade: [0.5, '#393D49']}, function () {
                            location.href = "https://www.cashkumarinvest.com/login?redirect=https%3A%2F%2Fwww.cashkumarinvest.com%2Fuser%2Finfo";
                        });
                        break;
                    default:
                        layer.msg(result.msg, {icon: 16, time: 1000, shade: [0.5, '#393D49']});
                }
                return false;
            }
        });
        $("body").on('click', '.recharge-btn', function () {
            var _this = $(this);
            _this.attr('disabled', true);
            var loading = layer.load(2, {shade: [0.5, '#393D49']});
            var avatar = $("input[name='avatar']").val();
            var email = $("input[name='email']").val();
            var nickname = $("input[name='nickname']").val();
            if (nickname.length == 0) {
                layer.close(loading);
                _this.attr('disabled', false);
                layer.msg('please enter user name...', {icon: 16, time: 1000, shade: [0.5, '#393D49']});
                return false;
            }
            if (email.length == 0) {
                layer.close(loading);
                _this.attr('disabled', false);
                layer.msg('please enter email...', {icon: 16, time: 1000, shade: [0.5, '#393D49']});
                return false;
            }
            var data = {avatar: avatar, nickname: nickname, email: email, _token: _token};
            $.post("https://www.cashkumarinvest.com/user/info", data, function (result) {
                layer.close(loading);
                _this.attr('disabled', false);
                switch (result.code) {
                    case 200:
                        layer.msg('success...', {icon: 16, time: 500, shade: [0.5, '#393D49']}, function () {
                            // location.reload();
                            location.href = "https://www.cashkumarinvest.com/user";
                        });
                        break;
                    case 201:
                        layer.msg('login invalid...', {icon: 16, time: 1000, shade: [0.5, '#393D49']}, function () {
                            location.href = "https://www.cashkumarinvest.com/login?redirect=https%3A%2F%2Fwww.cashkumarinvest.com%2Fuser%2Finfo";
                        });
                        break;
                    default:
                        layer.msg(result.msg, {icon: 16, time: 1000, shade: [0.5, '#393D49']});
                }
                return false;
            }, "json");
        });
    });
</script> 
 </body>
</html>