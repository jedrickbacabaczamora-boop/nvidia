<html class=" js no-touch">
 <head> 
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8"> 
  <title>{{env('APP_NAME')}} - Account</title> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"> 
  <meta name="apple-mobile-web-app-capable" content="yes"> 
  <meta name="apple-mobile-web-app-status-bar-style" content="black"> 
  <meta name="format-detection" content="telephone=no"> 
  <meta name="wap-font-scale" content="no"> 
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">-->
  <link rel="stylesheet" href="/static/home/css/reset.css"> 
  <link rel="stylesheet" href="/static/home/css/style.css"> 
  <link rel="stylesheet" href="/static/home/layui/css/layui.css"> 
  <style id="ss-chat-custom-css">.ss-chat-body {overflow: hidden !important}</style>
  <link id="layuicss-layer" rel="stylesheet" href="https://www.cashkumarinvest.com/static/home/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all">
 </head> 
 <body class="bgColor"> 
  <div class="headTop" style="color: #000">
    Account 
  </div> 
  <div class="mine" style="padding-bottom: 50px"> 
   <div class="mineTop" style="background: none; height: auto; width: 100%"> 
    <div class="mineLogo" id="avatar"> 
     <img class="logoAvater" src="/static/home/images/avatar.png"> 
    </div>
    <input class="layui-upload-file" type="file" accept="" name="file"> 
    <div class="mineMain"> 
     <h3> ID: {{user()->ref_id}} </h3> 
     <p>+27 {{substr(auth()->user()->phone, 0, 3)}}******{{substr(strrev(auth()->user()->phone), 0, 2)}}</p> 
     <a href="#"> <img src="/static/home/images/icon_3.png" alt=""> <i></i> </a> 
    </div> 
    <div class="mineWallet"> 
     <ul> 
      <li> <span>Total Balance</span> <h3 class="bGr">{{price(auth()->user()->balance)}}</h3> </li> 
      <li> <span>Deposit Balance</span> <h3 class="bGr">{{price(auth()->user()->balance)}}</h3> </li> 
      <li> <img src="/static/home/images/m_num.png" alt=""> </li> 
     </ul> 
     <div class="mineFlex"> 
      <a href="/orders"> <label><img src="/static/home/images/nav_5.png" alt=""></label> <p>My Order</p> </a> 
      <a href="/add-bank"> <label><img src="/static/home/images/nav_6.png" alt=""></label> <p>BankCard</p> </a> 
      <a href="/team"> <label><img src="/static/home/images/nav_3.png" alt=""></label> <p>Team</p> </a> 
      <a href="/get-bonus"> <label><img src="/static/home/images/nav_4.png" alt=""></label> <p>Bonus</p> </a> 
     </div> 
    </div> 
   </div> 
   <div class="mineFlexA"> 
    <a href="/recharge"> 
     <dl> 
      <dd>
       Deposit
      </dd> 
      <dt>
       <img src="/static/home/images/m_1.png" alt="">
      </dt> 
     </dl> </a> 
    <a href="/withdraw"> 
     <dl> 
      <dd>
       Withdraw
      </dd> 
      <dt>
       <img src="/static/home/images/m_2.png" alt="">
      </dt> 
     </dl> </a> 
   </div> 
   <div class="userAd"> 
    <a href="tasks"> 
     <dl> 
      <dt>
       TaskHall
      </dt> 
      <dd>
       {{ price(\App\Models\UserLedger::where('user_id', auth()->id())->where('reason', 'task')->sum('amount')) }}
      </dd> 
     </dl> </a> 
   </div> 
   <div class="minePro"> 
    <ul> 
     <li> <a href="/vip"> <img src="/static/home/images/m_3.png" alt=""> <p>VIP level</p> </a> </li> 
     <li> <a href="/balanceDetails"> <img src="/static/home/images/m_4.png" alt=""> <p>Fund record</p> </a> </li> 
     <li> <a href="/team/commission"> <img src="/static/home/images/m_5.png" alt=""> <p>Commission</p> </a> </li> 
     <li> <a href="/help"> <img src="/static/home/images/m_6.png" alt=""> <p>Help Center</p> </a> </li> 
     <li> <a href="/orders"> <img src="/static/home/images/m_7.png" alt=""> <p>My Order</p> </a> </li> 
     <li> <a href="/change/password"> <img src="/static/home/images/m_8.png" alt=""> <p>LoginPWD</p> </a> </li> 
     <li> <a href="javascript:void(0);" class="mineLang"> <img src="/static/home/images/m_9.png" alt=""> <p>Language</p> </a> </li> 
     <li> <a href="#"> <img src="/static/home/images/m_10.png" alt=""> <p>Download APP</p> </a> </li> 
     <li> <a href="/my-personal-details"> <img src="/static/home/images/m_11.png" alt=""> <p>MyInfo</p> </a> </li> 
    </ul> 
   </div> 
   <div class="logout"> 
    <a href="/logout"> <p>Log Out</p> </a> 
   </div> 
  </div> 
  <div class="z-lang" style="display: none"> 
   <div class="mask-lang"> 
    <div class="lang-tit">
     Select a language
    </div> 
    <ul> 
     <li class="cur" onclick="Language('eng');">English<i></i></li> 
     <li onclick="Language('ind');">हिन्दी<i></i></li> 
     <li onclick="Language('tam');">தமிழ்<i></i></li> 
     <li onclick="Language('tel');">తెలుగు<i></i></li> 
    </ul> 
   </div> 
  </div> 
  <script type="text/javascript">
        ssq.push('setLoginInfo', {
            user_id: '201336',
            user_name: '9015501668',
        });
    </script> 
  <nav class="foot"> 
   <ul> 
    <li> <a href="/home"> <img src="/static/home/images/f_1.png"> <p>Home</p> </a> </li> 
    <li> <a href="/product"> <img src="/static/home/images/f_2.png"> <p>Product</p> </a> </li> 
    <li> <a href="/team"> <img src="/static/home/images/f_3.png"> <p>Team</p> </a> </li> 
    <li> <a href="/member"> <img src="/static/home/images/f_4.png"> <p>Comment</p> </a> </li> 
    <li class="on"> <a href="/user"> <img src="/static/home/images/f_5g.png"> <p>ME</p> </a> </li> 
   </ul> 
  </nav>
  <script type="text/javascript">
    var _token = "jtgDcoQ5Dv86TWsURniQnC8DIuSrGu5HcuzMGSW6";
    layui.use(['upload', 'form', 'layer'], function () {
        $ = layui.jquery;
        var form = layui.form, layer = layui.layer, upload = layui.upload;
        $("body").on('click', '.mineLang', function () {
            $(".z-lang").show()
        })

        $(".z-lang").on('click', function (e) {
            if ($(e.target).closest(".mask-lang").length > 0) {
                return false;
            } else {
                $(".z-lang").hide()
            }
        });
        upload.render({
            elem: '#avatar',
            url: "https://www.cashkumarinvest.com/common/image",
            accept: 'file',
            auto: true,
            multiple: false,
            done: function (result) {
                switch (result.code) {
                    case 200:
                        setAvatar(result.url);
                        break;
                    case 201:
                        layer.msg('login invalid...', {icon: 16, time: 1000, shade: [0.5, '#393D49']}, function () {
                            location.href = "https://www.cashkumarinvest.com/login?redirect=https%3A%2F%2Fwww.cashkumarinvest.com%2Fuser";
                        });
                        break;
                    default:
                        layer.msg(result.msg, {icon: 16, time: 1000, shade: [0.5, '#393D49']});
                }
                return false;
            }
        });
    });

    function setAvatar(avatar) {
        var loading = layer.load(2, {shade: [0.5, '#393D49']});
        var data = {avatar: avatar, _token: _token};
        $.post("https://www.cashkumarinvest.com/user/avatar", data, function (result) {
            layer.close(loading);
            switch (result.code) {
                case 200:
                    layer.msg('success...', {icon: 16, time: 1000, shade: [0.5, '#393D49']}, function () {
                        location.reload();
                    });
                    break;
                case 201:
                    layer.msg('login invalid...', {icon: 16, time: 1000, shade: [0.5, '#393D49']}, function () {
                        location.href = "https://www.cashkumarinvest.com/login?redirect=https%3A%2F%2Fwww.cashkumarinvest.com%2Fuser";
                    });
                    break;
                default:
                    layer.msg(result.msg, {icon: 16, time: 1000, shade: [0.5, '#393D49']});
            }
            return false;
        }, "json");
    }

    function Language(lang) {
        $.post("https://www.cashkumarinvest.com/common/lang", {lang: lang, _token: _token}, function (result) {
            if (result.code == 200) {
                $('.z-mask').hide();
                location.reload();
            }
            return false;
        }, "json");
    }
</script> 
  <div id="ss-chat-p">
   <audio id="sspSoundNotice" preload="metadata" style="width:0;height:0;" src="https://client.salesmartly.com/setting/sounds/ling.mp3"></audio>
   <iframe title="Contact us" id="s-chat-plugin" style="
        display: none;
        border: none;
        position: fixed;
        opacity: 1;
        background: none transparent !important;
        margin: 0px;
        max-height: 100vh;
        max-width: 100vw;
        transform: translateY(0px);
        transition: all .5s ease 0s !important;
        visibility: visible;
        z-index: 999999999 !important;
        color-scheme: none;
        width: 100px;height: 90px;
        
        border-radius: 16px;
        top: auto;right: 0;bottom: 15px;left: auto
    "></iframe>
   <ssp-widget id="sspWidget" style="
        position: fixed;
        color-scheme: none;
        font-family: Roboto,sans-serif;
        top: auto;right: 12px;bottom: 10px;left: auto;
        z-index: 999999999 !important;
    "></ssp-widget>
   <iframe title="Preview Popup" id="s-chat-popup" style="
        display: none;
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0px;
        left: 0px;
        z-index: 2147483003;
        border: 0px;
        color-scheme: none;
    "></iframe>
  </div>
 </body>
</html>