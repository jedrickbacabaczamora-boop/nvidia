<html>
 <head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>Team</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <link rel="stylesheet" href="/public/site/layui/css/layui.css"> 
  <link rel="stylesheet" href="/public/site/css/common.css"> 
  <link rel="stylesheet" href="/public/site/css/swiper-bundle.min.css"> 
  <style>


    </style> 
 </head> 
 <body> 
  <div class="team_header"> 
   <a href="javascript:history.back(-1)" class="back position"> <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p> Team </a> 
   <p class="label">Total Commission Rate</p> 
   <p class="value">38%</p> 
   <!--    <p class="value" ><span class="unit">₱</span>40.00</p>--> 
  </div> 
  <div class="team_main"> 
   <div class="team_card" style="height: auto;border-bottom: 2px solid #007aff;"> 
    <p class="title">Level 1 teams</p> 
    <div class="flex_left" style="justify-content: start"> 
     <div class="left"> 
      <img class="level_icon" src="/public/site/img/index/lv1.png"> 
      <p class="value">35%</p> 
      <p class="label">Commission Rate</p> 
     </div> 
     <div class="right"> 
      <div class="item flex_space"> 
       <p class="label">Total Recharge：</p> 
       <p class="value position"><span class="unit">R</span> {{$lv1Recharge}}</p> 
      </div> 
      <div class="item flex_space"> 
       <p class="label">My Commission：</p> 
       <p class="value position"><span class="unit">R</span> {{$levelTotalCommission1}}</p> 
      </div> 
      <div class="item flex_space"> 
       <p class="label">Referral (Valid/Total)：</p> 
       <p class="value">{{$first_level_users->where('investor', 1)->count()}} / {{$first_level_users->count()}}</p> 
      </div> 
     </div> 
    </div> 
    <a href="/member/1" style="text-align: center; color: #ffffff;margin-bottom: 10px;"> <p style="transform: rotate(90deg);"><i class="layui-icon layui-icon-next layui-font-28"></i></p> </a> 
   </div> 
   <div class="team_card" style="height: auto;border-bottom: 2px solid #007aff;"> 
    <p class="title">Level 2 teams</p> 
    <div class="flex_left" style="justify-content: start"> 
     <div class="left"> 
      <img class="level_icon" src="/public/site/img/index/lv1.png"> 
      <p class="value">2%</p> 
      <p class="label">Commission Rate</p> 
     </div> 
     <div class="right"> 
      <div class="item flex_space"> 
       <p class="label">Total Recharge：</p> 
       <p class="value position"><span class="unit">R</span> {{$lv2Recharge}}</p> 
      </div> 
      <div class="item flex_space"> 
       <p class="label">My Commission：</p> 
       <p class="value position"><span class="unit">R</span> {{$levelTotalCommission2}}</p> 
      </div> 
      <div class="item flex_space"> 
       <p class="label">Referral (Valid/Total)：</p> 
       <p class="value"> {{$second_level_users->where('investor', 1)->count()}} / {{$second_level_users->count()}}</p> 
      </div> 
     </div> 
    </div> 
    <a href="/member/2" style="text-align: center; color: #ffffff;margin-bottom: 10px;"> <p style="transform: rotate(90deg);"><i class="layui-icon layui-icon-next layui-font-28"></i></p> </a> 
   </div> 
   <div class="team_card" style="height: auto;border-bottom: 2px solid #007aff;"> 
    <p class="title">Level 3 teams</p> 
    <div class="flex_left" style="justify-content: start"> 
     <div class="left"> 
      <img class="level_icon" src="/public/site/img/index/lv1.png"> 
      <p class="value">1%</p> 
      <p class="label">Commission Rate</p> 
     </div> 
     <div class="right"> 
      <div class="item flex_space"> 
       <p class="label">Total Recharge：</p> 
       <p class="value position"><span class="unit">R</span> {{$lv3Recharge}}</p> 
      </div> 
      <div class="item flex_space"> 
       <p class="label">My Commission：</p> 
       <p class="value position"><span class="unit">R</span> {{$levelTotalCommission3}}</p> 
      </div> 
      <div class="item flex_space"> 
       <p class="label">Referral (Valid/Total)：</p> 
       <p class="value">  {{$third_level_users->where('investor', 1)->count()}} / {{$third_level_users->count()}}</p> 
      </div> 
     </div> 
    </div> 
    <a href="/member/3" style="text-align: center; color: #ffffff;margin-bottom: 10px;"> <p style="transform: rotate(90deg);"><i class="layui-icon layui-icon-next layui-font-28"></i></p> </a> 
   </div> 
  </div> 
  <!--	底部内容-开始	  --> 
  <a href="/help" target="_blank" id="service"> <img src="/public/site/img/common/service.png" style="width: 40px;height: 40px"> </a> 
  <!--	底部内容-结束	  --> 
  <!--	底部内容-开始	  --> 
  <div class="footer_menu"> 
   <div class="border" style="height: 20px;"> 
   </div> 
   <div class="content"> 
    <a href="/" class="item "> <img src="/public/site/img/footer/home.png"> <p>Home</p> </a> 
    <a href="/product" class="item "> <img src="/public/site/img/footer/invest.png"> <p>Invest</p> </a> 
    <a href="/team" class="item active"> <img src="/public/site/img/footer/team_active.png"> <p>Team</p> </a> 
    <a href="/blog" class="item "> <img src="/public/site/img/footer/mboard.png"> <p>MBoard</p> </a> 
    <a href="/my" class="item "> <img src="/public/site/img/footer/account.png"> <p>Account</p> </a> 
   </div> 
  </div> 
  <!--	底部内容-结束	  --> 
  <script>

</script> 
  <script>
    layui.use(function(){
        var $ = layui.jquery;
        var layer = layui.layer;
        var form = layui.form;
        var laydate = layui.laydate;
        var slider = layui.slider;
        var element = layui.element;
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: "auto",
            centeredSlides: true,
            initialSlide :1,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            dynamicBullets: true,
            on: {
                slideChangeTransitionStart: function(){
                    // layui.layer.msg(this.activeIndex)
                    var level = this.activeIndex
                    $('.team_contents').removeClass('layui-show').addClass('layui-hide')
                    $('.team_'+level).removeClass('layui-hide').addClass('layui-show')
                },
            }
        });
    });
</script> 
 </body>
</html>