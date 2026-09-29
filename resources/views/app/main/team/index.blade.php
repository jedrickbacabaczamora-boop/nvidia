<html class=" js no-touch">
 <head> 
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8"> 
  <title>{{env('APP_NAME')}} - Team</title> 
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
  <link rel="stylesheet" href="/static/home/css/swiper-bundle.min.css"> 
  <style id="ss-chat-custom-css">.ss-chat-body {overflow: hidden !important}</style>
  <link id="layuicss-layer" rel="stylesheet" href="https://www.cashkumarinvest.com/static/home/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all">
 </head> 
 <body class="bgColor"> 
  <div class="team-head"> 
  </div> 
  <div class="team"> 
   <div class="inviteBox"> 
    <div class="team-people"> 
     <dl> 
      <dt>
       Total Commission
      </dt> 
      <dd> 
       <span>{{ price($totalCommission) }}</span> 
      </dd> 
     </dl> 
     <dl> 
      <dt>
       Gross income
      </dt> 
      <dd> 
       <span>{{ price($grossIncome) }}</span> 
      </dd> 
     </dl> 
     <dl> 
      <dt>
       Invite User
      </dt> 
      <dd> 
       <span>{{ $team_size }}</span> 
      </dd> 
     </dl> 
    </div> 
    <div class="team-link copy"""> 
     <p>{{url('register').'?ref='.auth()->user()->ref_id}}</p> 
     <span onclick="copyLink('{{url('register').'?ref='.auth()->user()->ref_id}}')">Copy</span> 
    </div> 
    <a class="team-mask" href="/invitation"> Invite Friends </a> 
   </div> 
   <div class="team-all-level"> 
    <ul> 
     <li> <img src="/static/home/images/team_4.png" alt=""> 
      <div class="team-all-level-con"> 
       <div class="team-all-level-con-hd"> 
        <h3>Level1</h3> 
        <a href="/member/1"> Conmission Rate: <span>31%</span> <i class="layui-icon layui-icon-right" style="font-size: 18px; color: #000;"></i> </a> 
       </div> 
       <div class="team-all-level-con-bd"> 
        <dl> 
         <dt>
          {{$first_level_users->where('investor', 1)->count()}}
         </dt> 
         <dd>
         Valid Invite User
         </dd> 
        </dl> 
        <dl> 
         <dt>
          {{$first_level_users->count()}}
         </dt> 
         <dd>
          registration
         </dd> 
        </dl> 
        <dl> 
         <dt>
          {{price($levelTotalCommission1)}}
         </dt> 
         <dd>
          Conmission
         </dd> 
        </dl> 
       </div> 
      </div> </li> 
     <li> <img src="/static/home/images/team_5.png" alt=""> 
      <div class="team-all-level-con"> 
       <div class="team-all-level-con-hd"> 
        <h3>Level2</h3> 
        <a href="/member/3"> Conmission Rate: <span>2%</span> <i class="layui-icon layui-icon-right" style="font-size: 18px; color: #000;"></i> </a> 
       </div> 
       <div class="team-all-level-con-bd"> 
        <dl> 
         <dt>
          {{$second_level_users->where('investor', 1)->count()}}
         </dt> 
         <dd>
         Valid Invite User
         </dd> 
        </dl> 
        <dl> 
         <dt>
          {{$second_level_users->count()}}
         </dt> 
         <dd>
          registration
         </dd> 
        </dl> 
        <dl> 
         <dt>
          {{price($levelTotalCommission2)}}
         </dt> 
         <dd>
          Conmission
         </dd> 
        </dl> 
       </div> 
      </div> </li> 
     <li> <img src="/static/home/images/team_6.png" alt=""> 
      <div class="team-all-level-con"> 
       <div class="team-all-level-con-hd"> 
        <h3>Level3</h3> 
        <a href="/member/3"> Conmission Rate: <span>1%</span> <i class="layui-icon layui-icon-right" style="font-size: 18px; color: #000;"></i> </a> 
       </div> 
       <div class="team-all-level-con-bd"> 
        <dl> 
         <dt>
          {{$third_level_users->where('investor', 1)->count()}}
         </dt> 
         <dd>
         Valid Invite User
         </dd> 
        </dl> 
        <dl> 
         <dt>
          {{$third_level_users->count()}}
         </dt> 
         <dd>
          registration
         </dd> 
        </dl> 
        <dl> 
         <dt>
         {{price($levelTotalCommission3)}}
         </dt> 
         <dd>
          Conmission
         </dd> 
        </dl> 
       </div> 
      </div> </li> 
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
    <li class="on"> <a href="/team"> <img src="/static/home/images/f_3g.png"> <p>Team</p> </a> </li> 
    <li> <a href="/member"> <img src="/static/home/images/f_4.png"> <p>Comment</p> </a> </li> 
    <li> <a href="/user"> <img src="/static/home/images/f_5.png"> <p>ME</p> </a> </li> 
   </ul> 
  </nav>
  <div class="loader" style="
    position: fixed;
    display: none;
    top: 50%;
    z-index: 99;
    width: 143px;
    border-radius: 15px;
    overflow: hidden;
    left: 50%;
    transform: translate(-50%, -50%);
">
    <img src="{{asset('public/loading.gif')}}" style="width: 100%;" alt="">
</div>

@include('alert-message')
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
        mes('Copied success..')
    }
</script>
</body>
</html>