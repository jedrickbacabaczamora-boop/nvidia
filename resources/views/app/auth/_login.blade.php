<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="/public/site/layui/css/layui.css">
  <link rel="stylesheet" href="/public/site/css/common.css">
</head>
<body class="login_body">
  <div class="login_bg">
    <div class="main">
      <div class="logo">
        <div>
          <img src="{{setting('logo')}}"  style="width:80px; height:80px; margin-top: 10px;">
        </div>
        <div class="footer_order"></div>
      </div>

      <div class="login_form">
        <form action="{{ url('login') }}" method="post" class="layui-form layui-form-pane" id="loginForm">
          @csrf

          <div class="form_tab">
            <div class="left">Login</div>
            <a href="{{ url('register') }}" class="right">Register</a>
          </div>

          <div class="form_container">
            <!-- Phone Number -->
            <div class="label">Mobile phone number</div>
            <div class="layui-form-item">
              <label class="layui-form-label">+27</label>
              <div class="layui-input-block">
                <div class="layui-input-wrap">
                  <input type="text" name="phone" placeholder="Please enter your phone number" class="layui-input" lay-verify="required" required>
                </div>
              </div>
            </div>

            <!-- Password -->
            <div class="label">Password</div>
            <div class="layui-form-item">
              <div class="layui-input-wrap" style="border: none; background: none;">
                <input type="password" name="password" placeholder="password" class="layui-input" style="border-radius:8px;" lay-verify="required" required>
              </div>
            </div>

            <!-- Submit Button -->
            <div style="margin-top: 40px;">
              <button type="submit" class="layui-btn layui-btn-lg layui-btn-fluid layui-btn-radius login_btn" lay-submit lay-filter="demo-login">
                Login Now
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- ✅ JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/layui.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
layui.use(['form', 'layer'], function () {
  var form = layui.form;
  var layer = layui.layer;

  // ✅ Custom "required" rule (optional override)
  form.verify({
    required: function (value) {
      if (!value.trim()) {
        return 'This field is required';
      }
    }
  });

  // ✅ Submit event
  /*form.on('submit(demo-login)', function (data) {
    const formData = data.field;*/

    $.post('/login', formData, function (res) {
      layer.msg(res.msg || 'Logging in...');

      if (res.status == 1) {
        window.location.href = "/";
      }
    });

    return false; // prevent default form submit
  });
});
</script>

</body>
</html>
