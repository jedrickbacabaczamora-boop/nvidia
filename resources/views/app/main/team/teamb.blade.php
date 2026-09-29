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
  <style>
    .inviteBox {
        height: 120px;
        background: url('/static/home/images/team_7.png') no-repeat;
        background-size: 100% 100%;
    }
</style>
  <link id="layuicss-layer" rel="stylesheet" href="https://www.cashkumarinvest.com/static/home/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all">
  <style id="ss-chat-custom-css">.ss-chat-body {overflow: hidden !important}</style>
 </head> 
 <body class="bgColor"> 
  <div class="headTop"> 
   <a href="javascript:history.back(-1)"> <i class="layui-icon layui-icon-left" style="font-size: 22px; color: #000;"></i> </a> Team 
  </div> 
  <div class="team" style="padding-top: 20px"> 
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
   </div> 
   <div class="team-lvs"> 
    <div class="team-lvs-top"> 
     <a href="/member/1"> Level1 <label>Conmission Rate</label> <span>31%</span> <i class="triangle"></i> </a> 
     <a href="/member/2" class="cur"> Level2 <label>Conmission Rate</label> <span>2%</span> <i class="triangle"></i> </a> 
     <a href="/member/3"> Level3 <label>Conmission Rate</label> <span>1%</span> <i class="triangle"></i> </a> 
    </div> 
    <div class="team-lvs-btm"> 
     <ul> 
      <li> 
       <dl> 
        <dt>
         {{price($levelTotalCommission1)}}
        </dt> 
        <dd>
         Conmission
        </dd> 
       </dl> </li> 
      <li> 
       <dl> 
        <dt>
         {{$second_level_users->count()}}
        </dt> 
        <dd>
         Total invite
        </dd> 
       </dl> </li> 
     </ul> 
    </div> 
    <div class="team-lv-con"> 
    @foreach ($second_level_users as $user)
     <div class="team-lv-list">
      <ul> 
       <li><img src="/static/home/images/logo.png" alt="">
        <div class="team-lv-lists">
         <dl>
          <dt>
           ID:{{ $user->ref_id }}
          </dt>
          <dd>
           {{ substr($user->phone, 0, 2) }}******{{ substr($user->phone, -2) }}
          </dd>
         </dl>
         <span>{{ $user->created_at }}</span>
        </div></li>
      </ul> 
     </div>@endforeach
    </div> 
   </div> 
   <div class="dropload-down">
    <div class="dropload-nodata">
     none more
    </div>
   </div>
  </div> 
   