<?php
use App\Models\Package;

$packages = Package::where('status', 'active')->get();
?>
<html>
 <head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>product_</title> 
  <link rel="stylesheet" href="/public/site/layui/css/layui.css"> 
  <link rel="stylesheet" href="/public/site/css/common.css"> 
  <link rel="stylesheet" href="/public/site/css/swiper-bundle.min.css">
  <style>
  .product_list {
  display: none;
}
.product_list.active {
  display: block;
}
</style>
 </head> 
 <body> 
  <div class="index_header"> 
   <div class="index_logo"> 
    <img src="{{setting('logo')}}" style="width:80px; height:80px;border-radius:50px;"> 
    <a href="/notice" class="notice" style="line-height: 50px;"><img src="/public/site/img/index/notice.png" style="height: 24px;width: 24px;"></a> 
   </div> 
   <div class="index_menu"> 
    <div class="nav nav_active" style="text-align: center;width: 30%;" data-type="1" data-image="fixed" onclick="setActiveTab(1)">
     <img class="nav_fixed" src="/public/site/img/product/fixed_active.png" style="width: 50px;height: 50px;"> 
     <p class="title">Stable Fund</p> 
    </div> 
    <div class="nav" style="text-align: center;width: 30%" data-type="2" data-image="welfare" onclick="setActiveTab(2)"> 
     <img class="nav_welfare" src="/public/site/img/product/welfare.png" style="width: 50px;height: 50px;"> 
     <p class="title">Daily Fund</p> 
    </div> 
    <div class="nav" style="text-align: center;width: 30%" data-type="3" data-image="activity" onclick="setActiveTab(3)">
     <img class="nav_activity" src="/public/site/img/product/activity.png" style="width: 50px;height: 50px;"> 
     <p class="title">Welfare Fund</p> 
    </div> 
   </div> 
  </div> 
  <div class="index_main"> 
   <div class="product_type_1 product_list active" id="fixed_fund">
       @foreach ($packages as $package)
      @if ($package->category == 'fixed')
    <a onclick="window.location.href='{{route('vip.details', $package->id)}}'" class="product_card position"> 
     <div class="buy">
      Buy
     </div> 
     <div class="product_content"> 
      <div class="product_title flex_left"> 
       <img class="product_image" src="{{ asset($package->photo) }}"> 
       <div> 
        <div class="product_name">
         <img src="/public/site/img/vip/lv{{ $package->vip_level ?? 0 }}.png" style="border:none;border-radius:0px;width: 18px;height: 18px;margin-right: 5px;">{{$package->name}}
        </div> 
        <div class="product_price flex_left"> 
         <p class="label">Each Price</p> 
         <p class="value position"> <span class="unit">R</span> <span class="price"> {{ ($package->price) }}</span> </p> 
        </div> 
       </div> 
      </div> 
      <div class="flex_space"> 
       <div class="product_item"> 
        <p class="label">Revenue</p> 
        <p class="value position"> {{ $package->validity }} Days </p> 
       </div> 
       <div class="product_item"> 
        <p class="label">Daily Earnings</p> 
        <p class="value"> <span class="position" style="padding-left: 10px"> <span class="unit"> {{setting('currency')}}</span> {{($package->commission_with_avg_amount / $package->validity)}} </span> </p> 
       </div> 
       <div class="product_item"> 
        <p class="label">Total Revenue</p> 
        <p class="value"> <span class="position" style="padding-left: 10px"> <span class="unit"> {{setting('currency')}}</span> {{ ($package->commission_with_avg_amount) }}  </span> </p> 
       </div> 
      </div> 
     </div> </a>@endif
    @endforeach
    <div class="none_data  hide"> 
     <img class="none_image" src="/public/site/img/order/none_order.png"> 
     <p class="none_text"> No items available for invest </p> 
    </div> 
   </div> 
   <div class="product_type_2 product_list "id="welfare_fund">
       @foreach ($packages as $package)
      @if ($package->category == 'welfare')
    <a onclick="window.location.href='{{route('vip.details', $package->id)}}'" class="product_card position"> 
     <div class="buy">
      Buy
     </div> 
     <div class="product_content"> 
      <div class="product_title flex_left"> 
       <img class="product_image" src="{{ asset($package->photo) }}"> 
       <div> 
        <div class="product_name">
         <img src="/public/site/img/vip/lv{{ $package->vip_level ?? 0 }}.png" style="border:none;border-radius:0px;width: 18px;height: 18px;margin-right: 5px;">{{$package->name}}
        </div> 
        <div class="product_price flex_left"> 
         <p class="label">Each Price</p> 
         <p class="value position"> <span class="unit">R</span> <span class="price"> {{ ($package->price) }}</span> </p> 
        </div> 
       </div> 
      </div> 
      <div class="flex_space"> 
       <div class="product_item"> 
        <p class="label">Revenue</p> 
        <p class="value position"> {{ $package->validity }} Days </p> 
       </div> 
       <div class="product_item"> 
        <p class="label">Daily Earnings</p> 
        <p class="value"> <span class="position" style="padding-left: 10px"> <span class="unit"> {{setting('currency')}}</span> {{($package->commission_with_avg_amount / $package->validity)}} </span> </p> 
       </div> 
       <div class="product_item"> 
        <p class="label">Total Revenue</p> 
        <p class="value"> <span class="position" style="padding-left: 10px"> <span class="unit"> {{setting('currency')}}</span> {{ ($package->commission_with_avg_amount) }}  </span> </p> 
       </div> 
      </div> 
     </div> </a>@endif
    @endforeach
    <div class="none_data  hide"> 
     <img class="none_image" src="/public/site/img/order/none_order.png"> 
     <p class="none_text"> No items available for invest </p> 
    </div> 
   </div>  
   <div class="product_type_3 product_list "id="activity_fund">
       @foreach ($packages as $package)
      @if ($package->category == 'activity')
    <a onclick="window.location.href='{{route('vip.details', $package->id)}}'" class="product_card position"> 
     <div class="buy">
      Buy
     </div> 
     <div class="product_content"> 
      <div class="product_title flex_left"> 
       <img class="product_image" src="{{ asset($package->photo) }}"> 
       <div> 
        <div class="product_name">
         <img src="/public/site/img/vip/lv{{ $package->vip_level ?? 0 }}.png" style="border:none;border-radius:0px;width: 18px;height: 18px;margin-right: 5px;">{{$package->name}}
        </div> 
        <div class="product_price flex_left"> 
         <p class="label">Each Price</p> 
         <p class="value position"> <span class="unit">R</span> <span class="price"> {{ ($package->price) }}</span> </p> 
        </div> 
       </div> 
      </div> 
      <div class="flex_space"> 
       <div class="product_item"> 
        <p class="label">Revenue</p> 
        <p class="value position"> {{ $package->validity }} Days </p> 
       </div> 
       <div class="product_item"> 
        <p class="label">Daily Earnings</p> 
        <p class="value"> <span class="position" style="padding-left: 10px"> <span class="unit"> {{setting('currency')}}</span> {{($package->commission_with_avg_amount / $package->validity)}} </span> </p> 
       </div> 
       <div class="product_item"> 
        <p class="label">Total Revenue</p> 
        <p class="value"> <span class="position" style="padding-left: 10px"> <span class="unit"> {{setting('currency')}}</span> {{ ($package->commission_with_avg_amount) }} </span> </p> 
       </div> 
      </div> 
     </div> </a>@endif
    @endforeach 
    <div class="none_data  hide"> 
     <img class="none_image" src="/public/site/img/order/none_order.png"> 
     <p class="none_text"> No items available for invest </p> 
    </div> 
   </div> 
   <textarea style="height: 1px;opacity: 0" name="copyTxt" id="copyTxt" readonly>https://fei1001.cc/?invitation_code=D76CF</textarea> 
  </div> 
  <textarea id="notice_content" style="display: none"></textarea> 
  <!--	底部内容-开始	  --> 
  <a href="/help" target="_blank" id="service"> <img src="/public/site/img/common/service.png" style="width: 40px;height: 40px"> </a> 
  <!--	底部内容-结束	  --> 
  <!--	底部内容-开始	  --> 
  <div class="footer_menu"> 
   <div class="border" style="height: 20px;"> 
   </div> 
   <div class="content"> 
    <a href="/" class="item "> <img src="/public/site/img/footer/home.png"> <p>Home</p> </a> 
    <a href="/product" class="item active"> <img src="/public/site/img/footer/invest_active.png"> <p>Invest</p> </a> 
    <a href="/team" class="item "> <img src="/public/site/img/footer/team.png"> <p>Team</p> </a> 
    <a href="/blog" class="item "> <img src="/public/site/img/footer/mboard.png"> <p>MBoard</p> </a> 
    <a href="/my" class="item "> <img src="/public/site/img/footer/account.png"> <p>Account</p> </a> 
   </div> 
  </div> 
  <!-- Snackbar container -->
<div id="snackbar"></div>

<!-- CSRF Token for AJAX Requests -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="lay"></div>

<script>
  // Function to close the modal
  function closeModal() {
    document.getElementById('accd').style.display = 'none';
    document.querySelector('.lay').style.display = 'none';
  }

  // JavaScript for modal close functionality when clicking outside the modal
  document.querySelector('.lay').addEventListener('click', closeModal);

  // Function to set the active tab
  function setActiveTab(type) {
    // Remove active class from all tabs
    var navItems = document.querySelectorAll('.nav');
    navItems.forEach(function(nav) {
      nav.classList.remove('nav_active');
    });

    // Add active class to the clicked tab
    var activeNav = document.querySelector('.nav[data-type="' + type + '"]');
    activeNav.classList.add('nav_active');

    // Hide all product lists
    var productLists = document.querySelectorAll('.product_list');
    productLists.forEach(function(list) {
      list.classList.remove('active');
    });

    // Show the selected product list
    var activeProductList = document.getElementById(type === 1 ? 'fixed_fund' : (type === 2 ? 'welfare_fund' : 'activity_fund'));
    activeProductList.classList.add('active');
  }
</script>

</body>
</html>