<html>
 <head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>Notice</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <link rel="stylesheet" href="/public/site/layui/css/layui.css"> 
  <link rel="stylesheet" href="/public/site/css/common.css"> 
  <style>
        .mail_title {
          display: -webkit-box;
          -webkit-box-orient: vertical;
          -webkit-line-clamp: 1; /* 定义显示的行数 */
          overflow: hidden;
          text-overflow: ellipsis;
        }
        .layui-panel-window{background:#FFFFFf !important;border-top: none }
        .mail_contents {
            margin-bottom: 5px !important;
        }
        .mail_date {
            margin-bottom: 5px !important;
        }
     
        .mail_contents {
          display: -webkit-box;
          -webkit-box-orient: vertical;
          -webkit-line-clamp: 3; /* 定义显示的行数 */
          overflow: hidden;
          text-overflow: ellipsis;
        }
    </style> 
 </head> 
 <body class="common_body"> 
  <div class="common_header common_header_order" style="height:80px"> 
   <a href="javascript:history.back(-1)" class="back position"> <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p> Notice </a> 
  </div> 
  <div class="mail_main"> 
  </div> 
  <a href="/help" target="_blank" id="service"> <img src="/public/site/img/common/service.png" style="width: 40px;height: 40px"> </a> 
  <div class="footer_menu"> 
   <div class="border" style="height: 20px;"> 
   </div> 
   <div class="content"> 
    <a href="/" class="item "> <img src="/public/site/img/footer/home.png"> <p>Home</p> </a> 
    <a href="/product" class="item "> <img src="/public/site/img/footer/invest.png"> <p>Invest</p> </a> 
    <a href="/team" class="item "> <img src="/public/site/img/footer/team.png"> <p>Team</p> </a> 
    <a href="/blog" class="item "> <img src="/public/site/img/footer/mboard.png"> <p>MBoard</p> </a> 
    <a href="/my" class="item "> <img src="/public/site/img/footer/account.png"> <p>Account</p> </a> 
   </div> 
  </div> 
  <script>
    layui.use(function(){
        var $ = layui.jquery;
        var layer = layui.layer;
        var form = layui.form;
        var laydate = layui.laydate;
        var slider = layui.slider;
        var element = layui.element;
        $('.mail').click(function(){
            var title = $(this).attr('data-title')
            var contents = $(this).attr('data-content')
            layer.open({
                type: 1,
                area: ['90%', '300px'], // 宽高
                title: false, // 不显示标题栏
                closeBtn: true,
                shadeClose: true, // 点击遮罩关闭层
                content: '<div style="padding: 16px;border-radius: 10px">' +
                    '<h3 class="layui-padding-1">'+title+'</h3>' +
                    '<p class="layui-padding-1 layui-font-16"> ' +
                    '      <textarea placeholder="" rows="10" class="layui-textarea" style="border: none">'+contents+'</textarea>\n' +
                    '</p>' +
                    '</div>'
            });
        })
    });
</script> 
 </body>
</html>