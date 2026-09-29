<html class=" js no-touch">
 <head> 
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8"> 
  <title>{{env('APP_NAME')}} - Change Password</title> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"> 
  <meta name="apple-mobile-web-app-capable" content="yes"> 
  <meta name="apple-mobile-web-app-status-bar-style" content="black"> 
  <meta name="format-detection" content="telephone=no"> 
  <meta name="wap-font-scale" content="no"> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <link rel="stylesheet" href="/static/home/css/reset.css"> 
  <link rel="stylesheet" href="/static/home/css/style.css"> 
  <link rel="stylesheet" href="/static/home/css/swiper-bundle.min.css"> 
  <link rel="stylesheet" href="/static/home/layui/css/layui.css"> 
  <link id="layuicss-layer" rel="stylesheet" href="https://www.cashkumarinvest.com/static/home/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all">
 </head> 
 <body class="bgColor"> 
  <div class="headTop"> @php $user = auth()->user(); @endphp
   <a href="javascript:history.back();"> <i class="layui-icon layui-icon-left" style="font-size: 22px; color: #000;"></i> </a> Change Password 
  </div> 
  <div class="recharge"> 
   <div class="bindCon"> 
    <img src="/static/home/images/login_2.png" class="loginPsw" alt=""> 
    <div class="recharge-amount"> 
     <h3>Mobile number</h3> 
     <div class="recharge-input"> 
      <input type="text" disabled value="{{ $user->phone }}"> 
     </div> 
    </div> 
    <div class="recharge-amount"> 
     <h3>Old Password</h3> 
     <div class="recharge-input"> 
      <input type="password" name="oldPass" placeholder="please enter old password..."> 
     </div> 
    </div> 
    <div class="recharge-amount"> 
     <h3>New Password</h3> 
     <div class="recharge-input"> 
      <input type="password" name="newPass" placeholder="please enter new password..."> 
     </div> 
    </div> 
    <div class="recharge-amount"> 
     <h3>Confirm Password</h3> 
     <div class="recharge-input"> 
      <input type="password" name="rePass" placeholder="please confirm password..."> 
     </div> 
    </div> 
    <div class="recharge-amount"> 
     <h3>Verification code(OTP)</h3> 
     <div class="recharge-input"> 
      <input type="text" name="code" placeholder="please enter verification code..."> 
     </div> 
     <button type="button" class="bindingyzms">send</button> 
    </div> 
   </div> 
   <div class="cardMessage"> 
    <button type="button" class="recharge-btn">Confirm </button> 
   </div> 
  </div> 
  <script type="text/javascript">
    var _token = "d1VtW342SGgO4wOQsajkCTplTQqqjEYrqDNJITo7";
    var mobile = "9015501668";
    layui.use(['form', 'layer'], function () {
        $ = layui.jquery;
        var form = layui.form, layer = layui.layer;
        $('body').on('click', '.recordsTop li', function () {
            $(this).addClass('cur').siblings().removeClass('cur');
        });
        $("body").on('click', '.recharge-btn', function () {
            var _this = $(this);
            _this.attr('disabled', true);
            var loading = layer.load(2, {shade: [0.5, '#393D49']});
            var oldPass = $.trim($("input[name='oldPass']").val());
            var newPass = $.trim($("input[name='newPass']").val());
            var rePass = $("input[name='rePass']").val();
            var code = $("input[name='code']").val();
            if (oldPass.length == 0) {
                layer.close(loading);
                _this.attr('disabled', false);
                layer.msg('please enter old password...', {icon: 16, time: 1000, shade: [0.5, '#393D49']});
                return false;
            }
            if (newPass.length == 0) {
                layer.close(loading);
                _this.attr('disabled', false);
                layer.msg('please enter new password...', {icon: 16, time: 1000, shade: [0.5, '#393D49']});
                return false;
            }
            if (newPass != rePass) {
                layer.close(loading);
                _this.attr('disabled', false);
                layer.msg('please confirm password...', {icon: 16, time: 1000, shade: [0.5, '#393D49']});
                return false;
            }
            if (code.length == 0) {
                layer.close(loading);
                _this.attr('disabled', false);
                layer.msg('please enter verification code...', {icon: 16, time: 1000, shade: [0.5, '#393D49']});
                return false;
            }
            var data = {original: oldPass, newpass: newPass, code: code, _token: _token};
            $.post("https://www.cashkumarinvest.com/password/login", data, function (result) {
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
                            location.href = "https://www.cashkumarinvest.com/login?redirect=https%3A%2F%2Fwww.cashkumarinvest.com%2Fpassword%2Flogin";
                        });
                        break;
                    default:
                        layer.msg(result.msg, {icon: 16, time: 1000, shade: [0.5, '#393D49']});
                }
                return false;
            }, "json");
        });
    });

    $("body").on('click', '.bindingyzms', function () {
        var _this = $(this);
        _this.attr("disabled", true);
        var loading = layer.load(1, {shade: [0.5, '#393D49']});
        var intAs = 60;
        var data = {mobile: mobile, type: 1, _token: _token};
        $.post("https://www.cashkumarinvest.com/sms", data, function (result) {
            layer.close(loading);
            _this.attr("disabled", false);
            if (result.code == 200) {
                layer.msg('success...', {icon: 16, time: 1000, shade: [0.5, '#393D49']}, function () {
                    jsInnerTimeout(intAs);
                });
            } else {
                layer.msg(result.msg, {icon: 16, time: 1000, shade: [0.5, '#393D49']});
            }
            return false;
        }, "json").fail(function () {
            _this.attr('disabled', false);
            return false;
        });
    });

    function jsInnerTimeout(intAs) {
        var _this = $(".bindingyzms");
        intAs--;
        if (intAs < 1) {
            _this.html("send");
            _this.attr("disabled", false);
            return true;
        }
        _this.html(intAs + ' s');
        setTimeout(function () {
            jsInnerTimeout(intAs);
        }, 1000);
    }
</script> 
 </body>
</html>