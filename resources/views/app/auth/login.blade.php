<!DOCTYPE html>
<html lang="zh">
<head> 
  <meta charset="utf-8"> 
  <title>{{ env('APP_NAME') }} - SIGN IN</title> 
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
</head> 

<body class="loginBg">
<div class="login-warp"> 
    <div class="engChange"> 
      <span> 
        <img src="/static/home/images/change.png" alt="" class="languageImg"> 
        <i class="layui-icon layui-icon-down" style="font-size: 15px; color: #000;"></i> 
      </span> 
    </div>

    <form action="{{ url('login') }}" method="post" class="layui-form layui-form-pane" id="loginForm">
      @csrf

      <div class="login-change"> 
        <a class="cur" href="{{ url('login') }}">Sign In <i></i></a> 
        <a href="{{ url('register') }}">Sign Up <i></i></a> 
      </div> 

      <div class="login-head"> 
        <div class="login-tit">Sign in</div> 
        <p>Let’s Sign In to explore</p> 
        <img src="/static/home/images/login_1.png" alt=""> 
      </div> 

      <div class="login-main"> 
        <div class="login-body"> 

          <div class="text-name">Mobile number</div> 
          <div class="text-inline text-mobile"> 
            <div class="text-icon">+91</div> 
            <input type="number" name="phone" lay-verify="required" placeholder="Please enter mobile number"> 
          </div> 

          <div class="text-name">Password</div> 
          <div class="text-inline"> 
            <img src="/static/home/images/n_1.png" alt=""> 
            <input type="password" name="password" lay-verify="required" placeholder="Please enter login password"> 
          </div> 
        </div> 

        <div class="text-flex"> 
          <a href="https://www.cashkumarinvest.com/recover">Forgot Password?</a> 
        </div> 

        <div class="text-btm"> 
          <button type="submit" class="form-button" lay-submit lay-filter="loginForm" style="width: 100%;">
            SIGN IN
          </button> 
        </div> 
      </div> 
    </form>
  </div> 

  <div class="z-lang" style="display: none"> 
    <div class="mask-lang"> 
      <div class="lang-tit">
        Select a language 
        <div class="lang-true">Confirm</div> 
      </div> 
      <ul>
        @include('alert-message')
        <li class="cur" onclick="Language('eng');">English<i></i></li> 
        <li onclick="Language('ind');">हिन्दी<i></i></li> 
        <li onclick="Language('tam');">தமிழ்<i></i></li> 
        <li onclick="Language('tel');">తెలుగు<i></i></li> 
      </ul> 
    </div> 
  </div> 

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/layui@2.8.17/dist/layui.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    layui.use(['form', 'layer'], function(){
      var form = layui.form;
      var layer = layui.layer;

      form.on('submit(loginForm)', function(data){
        var btn = document.querySelector('.form-button');
        btn.disabled = true;
        btn.innerText = 'Signing in...';

        // Delay 2 seconds
        setTimeout(function(){
          document.getElementById('loginForm').submit();
        }, 2000);

        // Show a loading notification (you can remove this if not needed)
        layer.msg('Processing login, please wait...', {
          icon: 16,
          shade: 0.3,
          time: 2000
        });

        return false;
      });
    });
  </script>

</body>
</html>
