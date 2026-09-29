<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Register_CARGILL</title>
  <link rel="stylesheet" href="/public/site/layui/css/layui.css">
  <link rel="stylesheet" href="/public/site/css/common.css">
  <style>
    body {
      background: #f5f5f5;
    }

    .otp-banner {
      display: none;
      background: #3766B7;
      color: #FFFFFF;
      font-size: 14px;
      padding: 15px;
      text-align: left;
      line-height: 1.6;
      border-radius: 0 0 10px 10px;
      animation: fadeInDown 0.3s ease-out;
    }

    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .loadingClass {
      display: none;
      position: fixed;
      z-index: 9999;
      background: rgba(0, 0, 0, 0.5);
      top: 0; left: 0;
      width: 100%; height: 100%;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

    .spinner {
      width: 50px; height: 50px;
      border: 4px solid #f3f3f3;
      border-top: 4px solid #0062E1;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      to { transform: rotate(360deg); }
    }
  </style>
</head>

<body class="login_body">

<div class="login_bg">
  <div class="main">
    <div class="logo">
      <img src="{{setting('logo')}}" style="width:80px; height:80px;margin-top: 10px;">
    </div>

    <!-- ✅ OTP message banner -->
    <div id="otpMessage" class="otp-banner">
      คYou need to ensure that your phone number is correct. To withdraw funds, you need to collect an OTP verification code on your phone.
    </div>

    <div class="login_form">
      <form class="layui-form layui-form-pane" method="POST" action="{{ url('register') }}">
        @csrf

        <div class="form_tab">
          <div class="left">Register</div>
          <a href="{{ url('login') }}" class="right">Login</a>
        </div>

        <div class="form_container">

          <!-- Phone -->
          <div class="label">Mobile phone number</div>
          <div class="layui-form-item">
            <label class="layui-form-label">+27</label>
            <div class="layui-input-block">
              <div class="layui-input-wrap">
                <input type="text" name="phone" lay-verify="required" placeholder="Please enter your phone number" autocomplete="off" class="layui-input" lay-affix="clear">
                <div class="layui-input-affix layui-input-suffix layui-hide">
                  <i class="layui-icon layui-icon-clear"></i>
                </div>
              </div>
            </div>
          </div>

          <!-- Password -->
          <div class="label">Password</div>
          <div class="layui-form-item">
            <div class="layui-input-wrap">
              <input type="password" name="password" lay-verify="required" placeholder="Please enter password" autocomplete="off" class="layui-input" lay-affix="eye" style="border-radius:8px;">
              <div class="layui-input-affix layui-input-suffix">
                <i class="layui-icon layui-icon-eye-invisible"></i>
              </div>
            </div>
          </div>

          <!-- Invitation -->
          <div class="label">Invitation Code</div>
          <div class="layui-form-item">
            <div class="layui-input-wrap">
              <input type="text" name="ref_by" value="{{ $ref_by ?? rand(100000,999999) }}"  lay-verify="required" placeholder="Please enter invitation code" autocomplete="off" class="layui-input" lay-affix="clear">
              <div class="layui-input-affix layui-input-suffix layui-hide">
                <i class="layui-icon layui-icon-clear"></i>
              </div>
            </div>
          </div>

          <!-- Hidden ref_by -->
          <input type="hidden" name="ref_by" value="{{ $ref_by ?? rand(100000,999999) }}">

          <!-- OTP -->
          <div class="label">Verification code (OTP)</div>
          <div class="layui-form-item">
            <div class="layui-row">
              <div class="layui-col-xs8">
                <div class="layui-input-wrap">
                  <input type="number" name="code" id="code" lay-verify="required" placeholder="Verification code" autocomplete="off" class="layui-input" style="border-radius:8px;">
                </div>
              </div>
              <div class="layui-col-xs4">
                <div style="margin-left: 11px;">
                  <div class="layui-btn layui-btn-fluid layui-btn-primary" style="color: #1A53CF; border: none; line-height: 50px;" id="getCode">
                    Send
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Register Button -->
          <div style="margin-top: 40px">
            <button class="layui-btn layui-btn-lg layui-btn-fluid layui-btn-radius login_btn" lay-submit lay-filter="register">Register Now</button>
          </div>

        </div>
      </form>
    </div>
  </div>
</div>

<!-- ✅ Loading Overlay -->
<div class="loadingClass" id="loadingBox">
  <div class="spinner"></div>
  <p style="color:white;margin-top:10px;">Processing...</p>
</div>

<!-- JS Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/layui.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
layui.use(['form', 'layer'], function(){
  var form = layui.form;
  var layer = layui.layer;

  // Custom required validation
  form.verify({
    required: function(value){
      if(!value.trim()){
        return 'This field is required';
      }
    }
  });

  // Virtual OTP sender
  $('#getCode').on('click', function(){
    const phone = $('input[name="phone"]').val();
    if (!phone) {
      layer.msg('Please enter your phone number');
      return;
    }

    // Show loading
    $('#loadingBox').css('display', 'flex');

    // Fake delay
    setTimeout(() => {
      $('#loadingBox').hide();

      // Generate fake 6-digit OTP
      const otp = Math.floor(100000 + Math.random() * 900000);
      $('#code').val(otp);

      // Show OTP message banner
      $('#otpMessage').slideDown();

      setTimeout(() => {
        $('#otpMessage').slideUp();
      }, 2000);

      // Start countdown
      let timeLeft = 120;
      $('#getCode').text(timeLeft + 's').attr('disabled', true);
      let timer = setInterval(() => {
        timeLeft--;
        $('#getCode').text(timeLeft + 's');
        if (timeLeft <= 0) {
          clearInterval(timer);
          $('#getCode').text('Send').removeAttr('disabled');
        }
      }, 1000);

    }, 1000);
  });

  // Submit Form
  form.on('submit(register)', function(){
    $('#loadingBox').css('display', 'flex');
    return true;
  });
});
</script>

</body>
</html>
