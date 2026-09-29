<html>
 <head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>Home_</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <link rel="stylesheet" href="/public/site/layui/css/layui.css"> 
  <link rel="stylesheet" href="/public/site/css/common.css?t=1.2"> 
  <link rel="stylesheet" href="/public/site/css/swiper-bundle.min.css"> 
 </head> 
 <body> 
  <div class="index_header"> 
   <div class="index_logo"> 
    <img src="{{setting('logo')}}" style="width:80px; height:80px;border-radius:50px;"> 
    <a href="/notice" class="notice" style="line-height: 50px;"><img src="/public/site/img/index/notice.png" style="height: 24px;width: 24px;"></a> 
   </div> 
   <div class="index_banner" style="padding: 20px 25px;height: auto"> 
    <div class="title">
     Main Wallet
    </div> 
    <div class="label">
     Your Balnace
    </div> 
    <div class="title" style="font-size: 26px;margin-top: 10px">
     {{price(auth()->user()->balance)}}
    </div> 
    <div class="flex_space" style="margin-top: 20px"> 
     <a href="/recharge" class="wallet_btn" style="margin-right: 15px;"> <img src="/public/site/img/index/recharge.png"> Recharge </a> 
     <a href="/withdraw" class="wallet_btn"> <img src="/public/site/img/index/withdraw.png"> Withdraw </a> 
    </div> 
   </div> 
   <div class="index_menu"> 
    <div class="nav_active" style="text-align: center;width: 30%;"> 
     <a href="/team"> <img src="/public/site/img/index/team.png" style="width: 50px;height: 50px;"> <p class="menu-title">Team</p> </a> 
    </div> 
    <div class="nav_active" style="text-align: center;width: 30%"> 
     <a href="/my-personal-details"> <img src="/public/site/img/index/message.png" style="width: 50px;height: 50px;"> <p class="menu-title">Message</p> </a> 
    </div> 
    <div class="nav_active" style="text-align: center;width: 30%"> 
     <a href="/orders"> <img src="/public/site/img/index/order.png" style="width: 50px;height: 50px;"> <p class="menu-title">Orders</p> </a> 
    </div> 
   </div> 
   <div class="reward_card"> 
    <div class="title"> 
     <p>Invitation</p> 
     <a href="/team" style="font-size: 13px;color: #9BBBFF;line-height: 20px;"> My Team <img src="/public/site/img/common/right.png" style="width:16px; padding-right: 70px;display: inline-block"> </a> 
    </div> 
    <div class="content flex_left"> 
     <div style="background: #3E70CE;border-radius: 12px;padding: 7px;margin-right: 10px;"> 
      <img src="/public/site/img/index/reward.png" style="width: 34px;height: 34px;"> 
     </div> 
     <div style="width: 100%"> 
      <p style="font-family: Arial Rounded MT Bold, Arial Rounded MT Bold;font-weight: 400;font-size: 14px;color: #9BBBFF;line-height: 16px;">Promotional Links</p> 
      <p style="margin-top:10px;font-family: Arial, Arial;font-weight: 400;font-size: 12px;color: #ffffff;line-height: 14px;text-align: left;font-style: normal;text-transform: none;"> {{url('register').'?ref='.auth()->user()->ref_id}} </p> 
     </div> 
    </div> 
    <div class="flex_space" style="margin-top: 20px;"> 
     <p class="invite_btn copy_link_btn" id="copy" onclick="copyLink('{{url('register').'?ref='.auth()->user()->ref_id}}')">Copy invitation link</p> 
    </div> 
   </div> 
  </div> 
  <div class="index_main"> 
   <a href="/get-bonus" class="common_card invite" style="display:block;margin-bottom:15px;"> 
    <div class="title" style="color:#ffffff;font-weight:700;font-size: 18px;">
     Treasure Chest
    </div> 
    <div class="desc" style="color:#ffffff;margin: 10px 0;">
     Copy your treasure code and redeem cash
    </div> 
    <div class="go_lottery layui-btn layui-btn-normal layui-btn-radius" id="sign_in" style="width:80px;text-align:center;color:#ffffff">
      Go 
    </div> </a> 
   <div class="common_card invite" style="margin-bottom:15px;"> 
    <div class="title" style="padding-left:0px;color:#ffffff;;font-weight:700;font-size: 18px;">
     Sign in to receive rewards
    </div> 
    <div class="desc" style="margin: 10px 0;;color:#ffffff">
     Daily check-in can receive R{{setting('checkin')}}
    </div> 
    <div class="go_lottery layui-btn layui-btn-normal layui-btn-radius" id="sign_in" style="text-align:center;color:#ffffff" onclick="checkin()">
      Sign in now 
    </div> 
    <a href="#" class="go_lottery layui-btn layui-btn-primary layui-btn-radius" style="text-align:center;color:#ffffff"> Sign In Record </a> 
   </div> 
   <div class="reward_card" style="background: #2B5CB9;height:100%;padding-bottom:20px;padding: 15px;"> 
    <div class="title"> 
     <p>Quest Rewards</p> 
    </div> 

@php
  $referUsers = \App\Models\User::where('ref_by', auth()->user()->ref_id)->where('investor', 1)->count();
@endphp

@foreach(\App\Models\Task::all() as $task)
  @php
    $apply = \App\Models\TaskRequest::where('task_id', $task->id)
              ->where('user_id', auth()->id())
              ->where('status', '!=', 'rejected')
              ->first();

    $progress = min(100, ($referUsers / $task->team_size) * 100);
    $currentCount = min($referUsers, $task->team_size);
    $isClaimable = !$apply && $referUsers >= $task->team_size;
  @endphp

  <div class="content flex_left" style="background: #2B5CB9;"> 
    <div style="background: #3E70CE;border-radius: 12px;padding: 7px;margin-right: 10px;"> 
      <img src="/public/site/img/index/reward.png" style="width: 34px;height: 34px;"> 
    </div> 
    <div style="width: 100%"> 
      <div class="flex_space" style="margin-bottom: 10px;"> 
        <div class="label">Inviting activation of {{ $task->team_size }}</div> 
        <div class="value position">
          <span class="unit">R</span>{{ number_format($task->bonus, 2) }}
        </div> 
      </div> 
      <div class="flex_space"> 
        <div class="layui-progress" style="width: 160px;height: 10px;margin-top: 5px"> 
          <div class="layui-progress-bar layui-bg-blue"
               style="height: 10px;background: #83ADFF;width: {{ $progress }}%;"></div> 
        </div> 
        <div class="value">
          <span style="color: #FFE048">{{ $currentCount }}</span> / {{ $task->team_size }}
        </div> 
      </div> 

      <div style="margin-top: 10px;">
        @if($apply)
          <button class="layui-btn layui-btn-sm" style="background: #00c48f; border-radius: 20px;" disabled>Claimed</button>
        @elseif($isClaimable)
          <a href="{{ route('user.received.reward', $task->id) }}" class="layui-btn layui-btn-sm" style="background: #FFE048; color: #000; border-radius: 20px;">Claim Now</a>
        @else
          <button class="layui-btn layui-btn-sm layui-btn-disabled" style="border-radius: 20px;">Not Ready</button>
        @endif
      </div>
    </div> 
  </div>
@endforeach

     

    <!--<div class="content flex_left" style=" background: #2B5CB9;"> 
     <div style="background: #3E70CE;border-radius: 12px;padding: 7px;margin-right: 10px;"> 
      <img src="/public/site/img/index/reward.png" style="width: 34px;height: 34px;"> 
     </div> 
     <div style="width: 100%"> 
      <div class="flex_space" style="margin-bottom: 10px;"> 
       <div class="label">
        Inviting activation of 10
       </div> 
       <div class="value position">
        <span class="unit">₱</span>518.00
       </div> 
      </div> 
      <div class="flex_space"> 
       <div class="layui-progress " style="width: 160px;height: 10px;margin-top: 5px"> 
        <div class="layui-progress-bar layui-bg-blue" lay-percent="%" style="height: 10px;background: #83ADFF"></div> 
       </div> 
       <div class="value">
        <span style="color: #FFE048">0</span> / 10
       </div> 
      </div> 
     </div> 
    </div> 
    <div class="content flex_left" style=" background: #2B5CB9;"> 
     <div style="background: #3E70CE;border-radius: 12px;padding: 7px;margin-right: 10px;"> 
      <img src="/public/site/img/index/reward.png" style="width: 34px;height: 34px;"> 
     </div> 
     <div style="width: 100%"> 
      <div class="flex_space" style="margin-bottom: 10px;"> 
       <div class="label">
        Inviting activation of 20
       </div> 
       <div class="value position">
        <span class="unit">₱</span>1888.00
       </div> 
      </div> 
      <div class="flex_space"> 
       <div class="layui-progress " style="width: 160px;height: 10px;margin-top: 5px"> 
        <div class="layui-progress-bar layui-bg-blue" lay-percent="%" style="height: 10px;background: #83ADFF"></div> 
       </div> 
       <div class="value">
        <span style="color: #FFE048">0</span> / 20
       </div> 
      </div> 
     </div> 
    </div> 
    <div class="content flex_left" style=" background: #2B5CB9;"> 
     <div style="background: #3E70CE;border-radius: 12px;padding: 7px;margin-right: 10px;"> 
      <img src="/public/site/img/index/reward.png" style="width: 34px;height: 34px;"> 
     </div> 
     <div style="width: 100%"> 
      <div class="flex_space" style="margin-bottom: 10px;"> 
       <div class="label">
        Inviting activation of 100
       </div> 
       <div class="value position">
        <span class="unit">₱</span>7888.00
       </div> 
      </div> 
      <div class="flex_space"> 
       <div class="layui-progress " style="width: 160px;height: 10px;margin-top: 5px"> 
        <div class="layui-progress-bar layui-bg-blue" lay-percent="%" style="height: 10px;background: #83ADFF"></div> 
       </div> 
       <div class="value">
        <span style="color: #FFE048">0</span> / 100
       </div> 
      </div> 
     </div> 
    </div> 
    <div class="content flex_left" style=" background: #2B5CB9;"> 
     <div style="background: #3E70CE;border-radius: 12px;padding: 7px;margin-right: 10px;"> 
      <img src="/public/site/img/index/reward.png" style="width: 34px;height: 34px;"> 
     </div> 
     <div style="width: 100%"> 
      <div class="flex_space" style="margin-bottom: 10px;"> 
       <div class="label">
        Inviting activation of 500
       </div> 
       <div class="value position">
        <span class="unit">₱</span>48888.00
       </div> 
      </div> 
      <div class="flex_space"> 
       <div class="layui-progress " style="width: 160px;height: 10px;margin-top: 5px"> 
        <div class="layui-progress-bar layui-bg-blue" lay-percent="%" style="height: 10px;background: #83ADFF"></div> 
       </div> 
       <div class="value">
        <span style="color: #FFE048">0</span> / 500
       </div> 
      </div> 
     </div> 
    </div> 
    <div class="content flex_left" style=" background: #2B5CB9;"> 
     <div style="background: #3E70CE;border-radius: 12px;padding: 7px;margin-right: 10px;"> 
      <img src="/public/site/img/index/reward.png" style="width: 34px;height: 34px;"> 
     </div> 
     <div style="width: 100%"> 
      <div class="flex_space" style="margin-bottom: 10px;"> 
       <div class="label">
        Inviting activation of 1000
       </div> 
       <div class="value position">
        <span class="unit">₱</span>88888.00
       </div> 
      </div> 
      <div class="flex_space"> 
       <div class="layui-progress " style="width: 160px;height: 10px;margin-top: 5px"> 
        <div class="layui-progress-bar layui-bg-blue" lay-percent="%" style="height: 10px;background: #83ADFF"></div> 
       </div> 
       <div class="value">
        <span style="color: #FFE048">0</span> / 1000
       </div> 
      </div> 
     </div> 
    </div> 
    <div class="content flex_left" style=" background: #2B5CB9;"> 
     <div style="background: #3E70CE;border-radius: 12px;padding: 7px;margin-right: 10px;"> 
      <img src="/public/site/img/index/reward.png" style="width: 34px;height: 34px;"> 
     </div> 
     <div style="width: 100%"> 
      <div class="flex_space" style="margin-bottom: 10px;"> 
       <div class="label">
        Inviting activation of 1500
       </div> 
       <div class="value position">
        <span class="unit">₱</span>158888.00
       </div> 
      </div> 
      <div class="flex_space"> 
       <div class="layui-progress " style="width: 160px;height: 10px;margin-top: 5px"> 
        <div class="layui-progress-bar layui-bg-blue" lay-percent="%" style="height: 10px;background: #83ADFF"></div> 
       </div> 
       <div class="value">
        <span style="color: #FFE048">0</span> / 1500
       </div> 
      </div> 
     </div> 
    </div> 
    <div class="content flex_left" style=" background: #2B5CB9;"> 
     <div style="background: #3E70CE;border-radius: 12px;padding: 7px;margin-right: 10px;"> 
      <img src="/public/site/img/index/reward.png" style="width: 34px;height: 34px;"> 
     </div> 
     <div style="width: 100%"> 
      <div class="flex_space" style="margin-bottom: 10px;"> 
       <div class="label">
        Inviting activation of 3000
       </div> 
       <div class="value position">
        <span class="unit">₱</span>588888.00
       </div> 
      </div> 
      <div class="flex_space"> 
       <div class="layui-progress " style="width: 160px;height: 10px;margin-top: 5px"> 
        <div class="layui-progress-bar layui-bg-blue" lay-percent="%" style="height: 10px;background: #83ADFF"></div> 
       </div> 
       <div class="value">
        <span style="color: #FFE048">0</span> / 3000
       </div> 
      </div> 
     </div> 
    </div>--
   </div> -->
   <textarea style="height: 1px;opacity: 0" name="copyTxt" id="copyTxt" readonly>https://fei1001.cc/?invitation_code=AF174</textarea> 
  </div> 
  <textarea id="notice_content" style="display: none"></textarea> 
  <!--	底部内容-开始	  --> 
  <a href="https://chat.whatsapp.com/H4ZlfbpveDDDmEBP1EwT7y?mode=r_t" target="_blank" id="service"> <img src="/public/site/img/BackgroundEraser_20250712_111211739.png" style="width: 40px;height: 40px"> </a> 
  <!--	底部内容-结束	  --> 
  <!--	底部内容-开始	  --> 
  <div class="footer_menu"> 
   <div class="border" style="height: 20px;"> 
   </div> 
   <div class="content"> 
    <a href="/" class="item active"> <img src="/public/site/img/footer/home_active.png"> <p>Home</p> </a> 
    <a href="/product" class="item "> <img src="/public/site/img/footer/invest.png"> <p>Invest</p> </a> 
    <a href="/team" class="item "> <img src="/public/site/img/footer/team.png"> <p>Team</p> </a> 
    <a href="/blog" class="item "> <img src="/public/site/img/footer/mboard.png"> <p>MBoard</p> </a> 
    <a href="/my" class="item "> <img src="/public/site/img/footer/account.png"> <p>Account</p> </a> 
   </div> 
  </div> 
  
  <!-- popup -->
  <div class="layui-layer-shade" id="layui-layer-shade1" times="1" style="z-index: 19891014; background-color: rgb(0, 0, 0); opacity: 0.3;"></div>
  <div class="layui-layer layui-layer-page  layer-anim layer-anim-00" id="layui-layer1" type="page" times="1" showtime="0" contype="string" style="z-index: 19891015; width: 90%; height: auto; position: fixed; top: 191px; left: 18px;">
   <div class="layui-layer-content" style="height: 287px;">
    <div class="dialog">
     <div class="dialog_contents">
      <div class="logo">
       <img src="/public/site/img/index/telegram.png" style="">
      </div>
      <div class="title" style="margin:15px 0;text-align: center;font-weight: 700;font-size: 20px;">
       Telegeram
      </div>
      <div class="text" style="text-align: center;font-weight:400;font-size: 14px;color: #818393;line-height: 24px;">
       Follow our official telegram channel for the latest news and discounts.
      </div>
     </div>
     <div class="btn_group">
      <a href="{{setting('telegram')}}" class="confirm telegram_confirm" style="width: 100%">Follow Now</a>
     </div>
    </div>
   </div>
   <div class="layui-layer-setwin">
    <span class="layui-icon layui-icon-close layui-layer-close layui-layer-close2"></span>
   </div>
   <span class="layui-layer-resize"></span>
  </div>
  <div class="layui-layer-move" id="layui-layer-move"></div>
 <!--
<script>
    function copyLink(text)
    {
        const body = document.body;
        const input = document.createElement("input");
        body.append(input);
        input.style.opacity = 0;
        input.value = text.replaceAll(' ', '');
        input.select();
        input.setSelectionRange(0, input.value.length);
        document.execCommand("Copy");
        input.blur();
        input.remove();
        message('Copied success..')
    }
 
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @include('alert-message')
<img style="position: fixed;
    display: none;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;" src="{{asset('public/loading.gif')}}" class="loading" alt="">
<script>
    function checkin(){
        //document.querySelector('.loading').style.display = 'block';
        window.location.href='{{route('user.checkin')}}'
    }
document.addEventListener('DOMContentLoaded', function () {
  const closeBtn = document.querySelector('.layui-layer-close2');
  const popup = document.getElementById('layui-layer1');
  const shade = document.getElementById('layui-layer-shade1');

  closeBtn.addEventListener('click', function () {
    if (popup) popup.style.display = 'none';
    if (shade) shade.style.display = 'none';
  });
});
</script>--
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/layui-src/dist/css/layui.css">
<script src="https://cdn.jsdelivr.net/npm/layui-src/dist/layui.js"></script>-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@include('alert-message')

<!-- ✅ Global Copy Function -->
<script>
function copyLink(text) {
    const body = document.body;
    const input = document.createElement("input");
    body.append(input);
    input.style.opacity = 0;
    input.value = text.replaceAll(' ', '');
    input.select();
    input.setSelectionRange(0, input.value.length);
    document.execCommand("Copy");
    input.blur();
    input.remove();
    message('Copied successfully.');
}
</script>

<!-- ✅ Loading GIF -->
<img style="position: fixed;
    display: none;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;" src="{{ asset('public/loading.gif') }}" class="loading" alt="">

<!-- ✅ Check-in Function -->
<script>
function checkin() {
    // Optional show loading animation
    // document.querySelector('.loading').style.display = 'block';
    window.location.href = '{{ route("user.checkin") }}';
}
</script>

<!-- ✅ Close Popup Layer -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const closeBtn = document.querySelector('.layui-layer-close2');
    const popup = document.getElementById('layui-layer1');
    const shade = document.getElementById('layui-layer-shade1');

    if (closeBtn) {
        closeBtn.addEventListener('click', function () {
            if (popup) popup.style.display = 'none';
            if (shade) shade.style.display = 'none';
        });
    }
});
</script>
<!-- ✅ Task Reward Claim Logic --
<script>
function getDeposirreward(url) {
    layer.confirm('Are you sure you want to claim this reward?', {
        icon: 3,
        title: 'Confirm'
    }, function(index) {
        layer.close(index);
        $('.loading').show(); // Show loading

        $.ajax({
            type: "GET",
            url: url,
            success: function(res) {
                $('.loading').hide(); // Hide loading
                if (res.status === true || res.status === 1) {
                    layer.msg(res.message || "Reward claimed successfully!", {icon: 1, time: 2000});
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    layer.msg(res.message || "Failed to claim reward.", {icon: 2, time: 3000});
                }
            },
            error: function() {
                $('.loading').hide();
                layer.msg("An error occurred.", {icon: 2, time: 3000});
            }
        });
    });
}
</script>-->
<script>
function receivedReward(condition) {
  if (condition === true) {
    window.location.href = '{{ route("user.received.reward", ["task_id" => "__TASK_ID__"]) }}';
  } else {
    alert('Target not eligible.');
  }
}
</script>

</body>
</html>


 