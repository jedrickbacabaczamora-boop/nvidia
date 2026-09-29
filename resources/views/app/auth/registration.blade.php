<!DOCTYPE html>
<html lang="zh">
<head>
  <meta charset="UTF-8">
  <title>{{ env('APP_NAME') }} - SIGN UP</title>
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
  <link rel="stylesheet" href="/public/theme/nvidia-ui.css"> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
</head>
<body class="loginBg">
<div class="login-warp">
    <div class="engChange">
      <form class="layui-form layui-form-pane" method="POST" action="{{ url('register') }}">
        @csrf

        <span>
          <img src="/static/home/images/change.png" alt="" class="languageImg">
          <i class="layui-icon layui-icon-down" style="font-size: 15px; color: #000;"></i>
        </span>
    </div>

    <div class="login-change">
      <a href="{{ url('login') }}">Sign In <i></i></a>
      <a class="cur" href="{{ url('register') }}">Sign Up <i></i></a>
    </div>

    <div class="login-head">
      <div class="login-tit">Create Account</div>
      <p>Let’s sign up for explore continues</p>
      <img src="/static/home/images/login_1.png" alt="">
    </div>

    <div class="login-main">
      <div class="login-body">

        <div class="text-name">Mobile number</div>
        <div class="text-inline text-mobile">
          <div class="text-icon">+27</div>
          <input type="number" name="phone" lay-verify="required" autocomplete="off" placeholder="Please enter mobile number">
        </div>

        <div class="text-name">Login Password</div>
        <div class="text-inline">
          <img src="/static/home/images/n_1.png" alt="">
          <input type="password" name="password" lay-verify="required" autocomplete="off" placeholder="Please enter login password">
        </div>

        <div class="text-inline">
          <img src="/static/home/images/n_1.png" alt="">
          <input type="password" name="financial" lay-verify="required" autocomplete="off" placeholder="Please enter financial password">
        </div>

        <div class="text-inline">
          <img src="/static/home/images/n_2.png" alt="">
          <input type="text" name="ref_by" lay-verify="required" autocomplete="off" placeholder="Please enter invitation code" value="{{ $ref_by ?? rand(100000,999999) }}">
        </div>

        <div class="text-inline">
          <img src="/static/home/images/n_3.png" alt="">
          <input type="text" name="code" lay-verify="required" autocomplete="off" placeholder="Please enter captcha code">
          <img id="captchaBox"
               src="{{ captcha_src('custom') }}"
               onclick="refreshCaptcha()"
               alt="captcha"
               style="width: 100px; height: 35px; cursor: pointer; border: 1px solid #ccc; display: inline-block;">
        </div>

      </div>

      <div class="text-btm">
        <button type="submit" class="form-button" lay-submit lay-filter="registerForm" style="width: 100%;">
          SIGN UP
        </button>
      </div>
    </div>
  </form>
</div>
@include('alert-message')
<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/layui@2.8.17/dist/layui.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  function refreshCaptcha() {
    const box = document.getElementById('captchaBox');
    box.src = "{{ captcha_src('custom') }}?t=" + Date.now();
  }

  layui.use('form', function(){
    var form = layui.form;

    form.on('submit(registerForm)', function(data){
      var btn = document.querySelector('.form-button');
      btn.disabled = true;
      btn.innerText = 'Submitting...';

      setTimeout(function(){
        document.querySelector('form.layui-form').submit();
      }, 2000);

      return false;
    });
  });
</script>

</body>
</html>
