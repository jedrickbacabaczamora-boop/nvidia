<html>
 <head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>Help Center</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <link rel="stylesheet" href="/public/site/layui/css/layui.css"> 
  <link rel="stylesheet" href="/public/site/css/common.css"> 
  <style>

        .help_card{
            margin: 20px;
            padding: 15px 20px;
            background: #FFFFFF;
            border-radius: 8px 8px 8px 8px;
            border: none;
        }

        .help_card  .logo{
            padding-right: 10px;
        }
        .help_card  .logo img{
            width: 60px;height: 60px;
        }
        .help_card .title{
            font-family: Arial, Arial;
            font-weight: 700;
            font-size: 18px;
            color: #333333;
            line-height: 22px;
        }
        .help_card  .describe{
            font-family: Arial, Arial;
            font-weight: 400;
            font-size: 14px;
            color: #666666;
            line-height: 22px;
        }
    </style> 
  <style id="ss-chat-custom-css">.ss-chat-body {overflow: hidden !important}</style>
 </head> 
 <body class="common_body"> 
  <div class="common_header common_header_order" style="height: 150px"> 
   <a href="javascript:history.back(-1)" class="back position"> <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p> Help Center </a> 
  </div> 
  <div style="position: relative;top: -80px;"> 
   <div class="help_card" style="margin-top: 30px;"> 
    <div href="/chatlink.html?&amp;language=en" class="flex_left service"> 
     <div class="logo"> 
      <img src="/public/site/img/user/service.png"> 
     </div> 
     <div> 
      <p class="title">Online service</p> 
      <p class="describe">Working hours: 08:00-18:00</p> 
     </div> 
    </div> 
   </div> 
   <div class="help_card"> 
    <a href="https://t.me/+AxzjFD0FlchiNzI0" class="flex_left"> 
     <div class="logo"> 
      <img src="/public/site/img/user/telegram.png"> 
     </div> 
     <div> 
      <p class="title">Telegram</p> 
      <p class="describe">Follow our official telegram channel for the latest news and discounts.</p> 
     </div> </a> 
   </div> 
   <div class="help_card"> 
    <a href="https://t.me/+AxzjFD0FlchiNzI0" class="flex_left"> 
     <div class="logo"> 
      <img src="/public/site/img/help/recharge.png"> 
     </div> 
     <div> 
      <p class="title">Your deposit has not been received yet?</p> 
      <p class="describe"> After successfully charging your account, if the balance has not been entered into your account, please provide it here and customer service personnel will assist you in handling it!</p> 
     </div> </a> 
   </div> 
  </div> 
  <!--	底部内容-开始	  --> 
  <a href="https://t.me/+AxzjFD0FlchiNzI0" id="service"> <img src="/public/site/img/common/service.png" style="width: 40px;height: 40px"> </a> 
  <!--	底部内容-结束	  --> 
  <!-- body 末尾处引入 layui --> 
  <!-- --> 
  <script>
    layui.use(function(){
        var $ = layui.jquery;
        var layer = layui.layer;
        var form = layui.form;
        var laydate = layui.laydate;
        var slider = layui.slider;
        var element = layui.element;

        // 语言选项（根据需要选择并设置）
        // 'en-US': 'English',       英语
        // 'zh-CN': '中文',          简体中文
        // 'zh-HK': '繁體中文',      繁体中文
        // 'ru-RU': 'русский',      俄语
        // 'th-TH': 'ภาษาไทย',     泰语
        // 'vi-VN': 'Tiếng Việt',   越南语
        // 'mn': 'Монгол',          蒙古语
        // 'ja-JP': 'やまと',        日语
        // 'fr': 'français',        法语
        // 'pt': 'português',       葡萄牙语
        // 'es': 'español',         西班牙语
        // 'ar': 'العربية',         阿拉伯语
        // 'de': 'Deutsch'           德语
        ssq.push('setLoginInfo', {
            user_id: "1019ed321349fd618943581c83c04f80", // 加密后的用户id, 必填！
            user_name: '9078333621', // 对应用户名
            language: 'en-US', // 对应用户语言
            phone: '【882125】【90******21】', // 对应用户手机号
            email: '', // 对应用户邮箱
            description: '【882125】【9078333621】', // 对应客户资料的用户描述信息，例如套餐信息
        });
        $('.service').click(function (){
            ssq.push('chatOpen');
        })
    });
</script> 
  <div id="ss-chat-p">
   <audio id="sspSoundNotice" preload="metadata" style="width:0;height:0;" src="https://client.salesmartly.com/setting/sounds/ling.mp3"></audio>
   <iframe id="s-chat-plugin" style="
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
   <iframe id="s-chat-popup" style="
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