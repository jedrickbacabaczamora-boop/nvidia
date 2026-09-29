<html>
 <head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>Tasks</title> 
  <!--<link rel="stylesheet" href="/public/site/layui/csss/layui.css"> 
  <link rel="stylesheet" href="/public/site/csss/common.css"> -->
  <style>

        .invite_btn{
            width: 47%;
            height: 40px;
            text-align: center;
            line-height: 40px;
            background: #396ED1;
            border-radius: 100px 100px 100px 100px;
            cursor: pointer;
        }
        .copy_link_btn{
            font-family: Arial, Arial;
            font-weight: 700;
            font-size: 14px;
            color: #FFFFFF;

        }
        .qr_code_btn{
            font-family: Arial, Arial;
            font-weight: 700;
            font-size: 14px;
            color: #FFFFFF;
            background: #29BE71;

        }
        .label{
            font-family: Arial, Arial;
            font-weight: 400;
            font-size: 14px;
            color: #95FCBE;
            line-height: 22px;
        }
        .value{
            font-family: Arial, Arial;
            font-weight: 700;
            font-size: 24px;
            color: #FFFB00;
            line-height: 28px;
        }
        .common_card .title{
            padding-left: 10px;
            font-family: Arial, Arial;
            font-weight: 700;
            font-size: 18px;
            color: #0F7A5A;
            height: 30px;
            line-height: 30px;
            display: flex;
            justify-content:space-between ;
        }
        .reward_card{
            height: auto;
            background-image: url("/public/site/img/tasks/bg.png?t=222");
            background-size: 100%;
            background-repeat: no-repeat;
            border-radius: 15px;
            padding-top: 40px;
        }

        .reward_icon{
            height: 30px;
            width: 30px;
        }
        .reward_card .title{
           padding-left: 15px;
            font-family: Arial, Arial;
            font-weight: 400;
            font-size: 18px;
            color: #333333;
        }
        .reward_card .label{
            font-family: Arial, Arial;
            font-weight: 400;
            font-size: 14px;
            color: #333333;
            line-height: 16px;
        }
        .reward_card .value{
            font-family: Arial, Arial;
            font-weight: 400;
            font-size: 16px;
            color: #333333;
            line-height: 18px;
        }
        .reward_card .content{
            margin-bottom: 15px;
            margin-top: unset;
            width: 100%;
        }
        .reward_text{
            margin-top: 10px;
            font-family: Arial, Arial;
            font-weight: 400;
            font-size: 14px;
            color: #666666;
            line-height: 24px;
        }
        .link{
            padding-left: 10px;
            margin-bottom: 10px;
        }
         .footer_menu{
    position: fixed;
    z-index:9999;
    bottom: 0px;
    left: 0px;
    right: 0px;
    /*height: 80px;*/
    background:none;
    /*box-shadow: 0px 4px 10px 0px rgba(42,65,92,0.3);*/
    /*border: 1px solid #ACC8FD;*/
    border-radius: 120px 120px 0  0;
    padding: 0;
    margin: 0;
}

.footer_menu .content{
    background-image:url(/mbtech/menu_bg.png) ;
    background-size: 100%;
    background-repeat: no-repeat;
    display: flex;
    width: 100%;
    color: #A1BFF6;
}
.footer_menu .content a{
    color: #A1BFF6 !important;
    font-weight: 400;
}
.footer_menu .content .item{
    padding: 10px;
    width: 20%;
    text-align: center;
    justify-content: center;
}
.footer_menu .content .item img{
    width: 21px;
    height: 21px;
}
.footer_menu .content .item p{
    margin-top: 4px;
    font-family: Arial, Arial;
    font-weight: 400;
    font-size: 14px;
    color: #AFAFAF;
    height: 20px;
    line-height: 20px;
}
.footer_menu .content  .active{
    text-align: center;
    font-family: Arial, Arial;
    font-weight: 400;
    font-size: 14px;
    color: #00A576;
}

#service{
    /*display: none;*/
    position: fixed;
    z-index:9999;
    bottom: 200px;
    right: 0px;
    width: 40px;
    height: 40px;
    padding: 3px;
    padding-left: 5px;
    padding-top: 5px;
    box-shadow: 0px 4px 10px 0px rgba(0,0,0,0.1);
    background: #22C87F;
    border-radius: 12px 12px 12px 12px;
    border: 1px solid #7DD8A2;
    text-align: center;
}
    </style> 
 </head> 
 <!--<body class="common_body"> 
  <div class="common_header common_header_order" style="height: 150px;"> 
   <a href="javascript:history.back(-1)" class="back position"> <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p> Tasks </a> 
   <a href="/help" style="position:absolute;top:15px; right:15px;height: 36px;width: 36px;background: #20C57A;border-radius: 12px 12px 12px 12px;border: 1px solid #7DD8A2;"> <img src="/public/site/img/common/service.png" style="height:22px;width: 22px;padding-top: 8px;padding-left: 8px "> </a> 
   <div style="padding: 10px 20px;"> 
    <p class="label">Total Commission Rate</p> 
    <p class="value" style="margin-top: 10px">36%</p> 
   </div> 
  </div> 
  <div style="padding: 15px; margin-bottom: 20px;position: relative;top: -80px"> 
   <div class="common_card" style="margin-bottom: 0px"> 
    <div class="flex_left"> 
     <img class="reward_icon" src="/public/site/img/tasks/reward_icon.png"> 
     <div class="title">
       Reward Description 
     </div> 
    </div> 
    <p class="reward_text"> If your friend gets up to VIP1 or above then you will get more rewards! </p> 
   </div> 
   <div class="common_card" style=" margin-top:20px;background: #FFFFFF;border-radius: 16px;"> 
    <div class="title"> 
     <p>Invite Link</p> 
    </div> 
    <p class="link">https://www.elsewedyelectricnf.cc/?invitation_code=C8120</p> 
    <div class="flex_space"> 
     <p class="invite_btn copy_link_btn" id="copy">Copy invitation link</p> 
     <p class="invite_btn qr_code_btn" id="poster">Invitation QR code</p> 
    </div> 
   </div> 
  </div>-->
  <div class="footer_menu"> 
   <div class="content"> 
    <a href="/" class="item "> <img src="/mbtech/home.png"> <p>Home</p> </a> 
    <a href="/vip" class="item "> <img src="/mbtech/invest.png"> <p>Invest</p> </a> 
    <a href="/invite" class="item position" style=""> <p style="position:absolute;top: -12px;left: 0px;width: 100%"> <img src="/mbtech/Tasks.png" style="display:inline-block;height: 45px;width: 45px;"> </p> </a> 
    <a href="/withdrawal-proofs" class="item "> <img src="/mbtech/mboard.png"> <p>Blog</p> </a> 
    <a href="/profile" class="item "> <img src="/mbtech/account.png"> <p>Account</p> </a> 
   </div> 
  </div> 
  <textarea style="height: 1px;opacity: 0" name="copyTxt" id="copyTxt" readonly>https://www.elsewedyelectricnf.cc/?invitation_code=C8120</textarea> 
  <!--&lt;!&ndash;	底部内容-开始	  &ndash;&gt;--> 
  <!--<div class="footer_menu">

    <div class="content">
        <a  href="/" class="item ">
            <img src="/public/site/img/footer/home.png"/>
            <p>Home</p>
        </a>
        <a  href="/product" class="item ">
            <img src="/public/site/img/footer/invest.png"/>
            <p>Invest</p>
        </a>
        <a  href="/tasks" class="item position" style="">
            <p style="position:absolute;top: -12px;left: 0px;width: 100%">
                <img src="/public/site/img/footer/Tasks.png" style="display:inline-block;height: 45px;width: 45px;"/>
            </p>

        </a>
        <a  href="/blog" class="item " >
            <img src="/public/site/img/footer/mboard.png"/>
            <p>Blog</p>
        </a>

        <a href="/my" class="item ">
            <img src="/public/site/img/footer/account.png"/>
            <p>Account</p>
        </a>
    </div>
</div>--> 
  <!--&lt;!&ndash;	底部内容-结束	  &ndash;&gt;--> 
  <!-- body 末尾处引入 layui --> 
  <script>
    layui.use(function(){
        var  $= layui.jquery;
        var  layer= layui.layer;
        var flow = layui.flow;

        $('#copy').click(function () {
            var copyText = document.getElementById("copyTxt");
            copyText.select(); // 选择对象
            document.execCommand("Copy");
            layer.msg('copy success');
        })
        $('#poster').click(function () {
            // var json_data =JSON.parse( "[{"alt":"Qrcode","pid":1,"src":"https:\/\/www.elsewedyelectricnf.cc\/public\/uploads\/poster\/h5\/poster_888978_1.jpg"}]");
            var json_data =[{"alt":"Qrcode","pid":1,"src":"https:\/\/www.elsewedyelectricnf.cc\/public\/uploads\/poster\/h5\/poster_888978_1.jpg"}];
            layer.photos({
                photos: {
                    "title": "Photos Demo",
                    "start": 0,
                    "data": json_data
                }
            });
        })

    });
</script> 
 </body>
</html>