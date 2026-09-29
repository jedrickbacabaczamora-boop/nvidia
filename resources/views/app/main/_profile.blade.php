<html>
 <head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>My</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <link rel="stylesheet" href="/public/site/layui/css/layui.css"> 
  <link rel="stylesheet" href="/public/site/css/common.css"> 
 </head> 
 <body class="common_body"> 
  <div class="user_header"> 
   <div class="user_info"> 
    <div class="user_contents"> 
     <div class="info"> 
      <a href="/my-personal-details" style="border: 2px solid #fff;border-radius:50%"><img src="{{setting('logo')}}" class="layui-circle"></a> 
      <div class="username"> 
       <a href="/info" class="nickname"> <p> {{user()->phone}} </p> </a> 
       <p class="">{{substr(auth()->user()->phone, 0, 3)}}******{{substr(strrev(auth()->user()->phone), 0, 2)}} ID:{{user()->ref_id}}</p> 
      </div> 
     </div>
     @php
    $vipLevel = $user->vip_level ?? 0;
    $totalInvestment = \App\Models\Purchase::where('user_id', auth()->id())->sum('amount');

    $vipTargets = [
        1 => 500,
        2 => 1000,
        3 => 2000,
        4 => 4000,
        5 => 8000,
        6 => 16000,
        7 => 32000,
        8 => 64000,
        9 => 128000,
        10 => 256000,
    ];

    $nextVipLevel = $vipLevel < 10 ? $vipLevel + 1 : 10;
    $nextTarget = $vipTargets[$nextVipLevel] ?? $totalInvestment;

    $progressPercent = $nextTarget > 0 ? min(100, ($totalInvestment / $nextTarget) * 100) : 0;
@endphp
     <div style=" background: #B6CDFA;border-radius: 50%;width: 35px;height: 35px;text-align: center;line-height: 35px;"> 
      <a href="/vip"> <img src="{{ asset('public/site/img/vip/lv' . $vipLevel . '.png') }}" style="width: 24px;height: 24px;display: inline"> </a> 
     </div> 
    </div>
    
    <div class="balance"> 
     <div class="flex_space"> 
      <div class="item"> 
       <p class="value">{{ \App\Models\Purchase::where('user_id', auth()->id())->count() }}</p> 
       <p class="label">Buy</p> 
      </div> 
      <div class="item"> 
       <p class="value">{{ price(\App\Models\UserLedger::where('user_id', auth()->id())->where('reason', 'balance_added')->sum('amount')) }}</p> 
       <p class="label">Product Income</p> 
      </div> 
      <div class="item"> 
       <p class="value">{{ price(\App\Models\UserLedger::where('user_id', auth()->id())->where('reason', 'task')->sum('amount')) }}</p> 
       <p class="label">Tasks Reward</p> 
      </div> 
     </div> 
    </div> 
   </div> 
  </div> 
  <div class="user_main"> 
   <div class="index_menu"> 
    <a href="/recharge" class="nav nav_active" style="text-align: center;width: 30%;" data-type="1" data-image="fixed"> <img class="nav_fixed" src="/public/site/img/user/recharge.png" style="width: 50px;height: 50px;"> <p class="title">Recharge</p> <p class="value">{{ price(\App\Models\Deposit::where('user_id', auth()->id())->where('status', 'approved')->sum('amount')) }}
    </p> </a> 
    <a href="/withdraw" class="nav nav_active" style="text-align: center;width: 30%" data-type="2" data-image="welfare"> <img class="nav_welfare" src="/public/site/img/user/withdrawal.png" style="width: 50px;height: 50px;"> <p class="title">Withdrawal</p> <p class="value">{{ price(\App\Models\Withdrawal::where('user_id', auth()->id())->where('status', 'approved')->sum('amount')) }}
    </p></a> 
    <a href="/orders" class="nav nav_active" style="text-align: center;width: 30%" data-type="1" data-image="activity"> <img class="nav_activity" src="/public/site/img/user/orders.png" style="width: 50px;height: 50px;"> <p class="title">Orders </p> <p class="value">{{ \App\Models\Purchase::where('user_id', user()->id)->count() }}</p> </a> 
   </div> 
   <div class="user_list"> 
    <div class="user_card"> 
     <div class="item"> 
      <a href="/team" style="width: 100%"> <img src="/public/site/img/user/team.png" style="display: inline"> <p class="title">Team</p> </a> 
      <p class="right_icon"><i class="layui-icon layui-icon-right"></i></p> 
     </div> 
    </div> 
    <div class="user_card"> 
     <div class="item"> 
      <a href="/vip" style="width: 100%"> <img src="/public/site/img/user/vip.png" style="display: inline"> <p class="title">VIP</p> </a> 
      <p class="right_icon"><i class="layui-icon layui-icon-right"></i></p> 
     </div> 
    </div> 
    <div class="user_card"> 
     <div class="item"> 
      <a href="/add-bank" style="width: 100%"> <img src="/public/site/img/user/bank_card.png" style="display: inline"> <p class="title">Bank Card</p> </a> 
      <p class="right_icon"><i class="layui-icon layui-icon-right"></i></p> 
     </div> 
    </div> 
    <div class="user_card"> 
     <div class="item"> 
      <a href="/balanceDetails" style="width: 100%"> <img src="/public/site/img/user/bill.png" style="display: inline"> <p class="title">Bill</p> </a> 
      <p class="right_icon"><i class="layui-icon layui-icon-right"></i></p> 
     </div> 
    </div> 
    <!--<div class="user_card">--> 
    <!--    <div class="item">--> 
    <!--        <a href="/about" style="width: 100%">--> 
    <!--            <img src="/public/site/img/user/about.png" style="display: inline" >--> 
    <!--            <p class="title">About</p>--> 
    <!--        </a>--> 
    <!--        <p class="right_icon"><i class="layui-icon layui-icon-right"></i></p>--> 
    <!--    </div>--> 
    <!--</div>--> 
    <div class="user_card"> 
     <div class="item"> 
      <a href="/my-personal-details" style="width: 100%"> <img src="/public/site/img/user/message.png" style="display: inline"> <p class="title">Message</p> </a> 
      <p class="right_icon"><i class="layui-icon layui-icon-right"></i></p> 
     </div> 
    </div> 
    <div class="user_card"> 
     <div class="item"> 
      <a href="/notice" style="width: 100%"> <img src="/public/site/img/user/notice.png" style="display: inline"> <p class="title">System Notice</p> </a> 
      <p class="right_icon"><i class="layui-icon layui-icon-right"></i></p> 
     </div> 
    </div> 
    <div class="user_card"> 
     <div class="item"> 
      <a href="/help" style="width: 100%"> <img src="/public/site/img/user/help.png" style="display: inline"> <p class="title">Help Center</p> </a> 
      <p class="right_icon"><i class="layui-icon layui-icon-right"></i></p> 
     </div> 
    </div> 
   </div> 
   <div class="user_list"> 
    <div class="user_card"> 
     <div class="item"> 
      <a href="my-personal-details" style="width: 100%"> <img src="/public/site/img/user/info.png" style="display: inline"> <p class="title">Info</p> </a> 
      <p class="right_icon"><i class="layui-icon layui-icon-right"></i></p> 
     </div> 
    </div> 
    <div class="user_card"> 
     <div class="item"> 
      <a href="/setting" style="width: 100%"> <img src="/public/site/img/user/trade_password.png" style="display: inline"> <p class="title">Trade Password</p> </a> 
      <p class="right_icon"><i class="layui-icon layui-icon-right"></i></p> 
     </div> 
    </div> 
    <div class="user_card"> 
     <div class="item"> 
      <a href="/change/password" style="width: 100%"> <img src="/public/site/img/user/password.png" style="display: inline"> <p class="title">Password</p> </a> 
      <p class="right_icon"><i class="layui-icon layui-icon-right"></i></p> 
     </div> 
    </div> 
   </div> 
   <div class="user_list" style="padding: 15px;border-radius:20px;text-align: center;"> 
    <a href="/logout" class="logout"><img src="/public/site/img/user/logout.png"> Logout</a> 
   </div> 
  </div> 
  <!--	底部内容-开始	  --> 
  <div class="footer_menu"> 
   <div class="border" style="height: 20px;"> 
   </div> 
   <div class="content"> 
    <a href="/" class="item "> <img src="/public/site/img/footer/home.png"> <p>Home</p> </a> 
    <a href="/product" class="item "> <img src="/public/site/img/footer/invest.png"> <p>Invest</p> </a> 
    <a href="/team" class="item "> <img src="/public/site/img/footer/team.png"> <p>Team</p> </a> 
    <a href="/blog" class="item "> <img src="/public/site/img/footer/mboard.png"> <p>MBoard</p> </a> 
    <a href="/my" class="item active"> <img src="/public/site/img/footer/account_active.png"> <p>Account</p> </a> 
   </div> 
  </div> 
  <!--	底部内容-结束	  --> 
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
            // var json_data =JSON.parse( "[{"alt":"Qrcode","pid":1,"src":"https:\/\/fei1001.cc\/public\/uploads\/poster\/h5\/poster_40236_1.jpg"}]");
            var json_data =[{"alt":"Qrcode","pid":1,"src":"https:\/\/fei1001.cc\/public\/uploads\/poster\/h5\/poster_40236_1.jpg"}];
            layer.photos({
                photos: {
                    "title": "Photos Demo",
                    "start": 0,
                    "data": json_data
                }
            });
        })
        $('.recharge').click(function () {
            layer.msg('Please contact customer service to recharge');
        })
    });
</script> 
 </body>
</html>