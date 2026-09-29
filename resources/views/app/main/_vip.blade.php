<?php
use App\Models\Package;

$packages = Package::where('status', 'active')->get();
?>
<html>
 <head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>product_CARGILL</title> 
  <link rel="stylesheet" href="/public/site/layui/csss/layui.css"> 
  <link rel="stylesheet" href="/public/site/csss/common.css"> 
  <link rel="stylesheet" href="/public/site/csss/swiper-bundle.min.css"> 
  <style>
        .index_header{
            background: linear-gradient( 136deg, #17A278 0%, #18CA72 100%);
            border-bottom-left-radius: 8%;
            border-bottom-right-radius: 8%;
        }
      /*  .nav{
    background-image: url("/public/site/img/product/nav.png");
    background-size:  100%;
    background-repeat: no-repeat;
    height: 40px;
    line-height: 40px;
    }
    .nav_active{
    background-image: url("/public/site/img/product/nav_active.png");
    background-size:  100%;
    background-repeat: no-repeat;
   text-align: center;
    margin: auto;
    }
    .nav_active .title{
    font-family: Arial, Arial;
    font-weight: 700;
    font-size: 14px;
    color: #FFFFFF;
    line-height: 40px;
    }*/
    .product_list {
      display: none;
    }
    .product_list.active {
      display: block;
    }
    </style> 
 </head> 
 <body> 
  <div class="index_header" style=""> 
   <div class="index_logo"> 
    <div style="padding-top: 10px"> 
     <img src="/mbtech/IMG-20250601-WA0037.jpg" style="height: 24px;"> 
    </div> 
    <a href="/help" class="notice" style="background: #22C87F;border-radius: 12px 12px 12px 12px;border: 1px solid #7DD8A2;width:36px;height:36px;line-height: 36px;text-align: center;margin-top: 10px;"> <img src="/public/site/img/common/service.png" style="height: 24px;width: 24px;"> </a> 
   </div> 
   <div class="index_menu" style="position: relative;bottom: -20px;margin-top: 0px"> 
    <div class="nav nav_active" style="text-align: center;width: 33%;" data-type="1" data-image="fixed" onclick="setActiveTab(1)">
     <p class="title">Fixed Product</p> 
    </div> 
    <div class="nav" style="text-align: center;width: 33%" data-type="2" data-image="welfare" onclick="setActiveTab(2)">
     <p class="title">Welfare Product</p> 
    </div> 
    <div class="nav" style="text-align: center;width: 33%" data-type="3" data-image="activity" onclick="setActiveTab(3)">
     <p class="title">Premium Product</p>
     <div class="layui-badge" style="position:absolute; top:-8px;right:0px;">
      HOT
     </div> 
    </div> 
   </div> 
  </div> 
  <div class="index_main" style="margin-top: 40px"> 
   <div class="product_type_1 product_list active" id="fixed_fund">
       @foreach ($packages as $package)
      @if ($package->category == 'fixed')
    <a onclick="window.location.href='{{route('vip.details', $package->id)}}'" class="product_card position"> 
     <div class="level">
      <img src="/public/site/img/vip/lv0.png">
     </div> 
     <div class="product_content position"> 
      <div class="product_title flex_left"> 
       <div class="product_image" style="background-image: url('{{ asset($package->photo) }}')">
        <img src="/mbtech/product.png">
       </div> 
       <div class="product_info"> 
        <div class="product_name flex_space"> 
         <p style="width:140px; overflow: hidden;white-space: nowrap; text-overflow: ellipsis;text-align:left">{{$package->name}}</p> 
         <div class="buy">
          Buy
         </div> 
        </div> 
        <div class="product_item flex_space"> 
         <p class="label">Each Price</p> 
         <p class="value position" style="font-weight: 700"> <span class="unit">R</span> <span class="price"> {{ ($package->price) }}</span> </p> 
        </div> 
        <div class="product_item flex_space"> 
         <p class="label">Revenue</p> 
         <p class="value position">  {{ $package->validity }} Days </p> 
        </div> 
        <div class="product_item flex_space"> 
         <p class="label"> Daily Earnings </p> 
         <p class="value"> <span class="position"> <span class="unit">R</span> {{($package->commission_with_avg_amount / $package->validity)}} </span> </p> 
        </div> 
        <div class="product_item flex_space"> 
         <p class="label">Total Revenue</p> 
         <p class="value"> <span class="position"> <span class="unit">R</span> {{ price($package->commission_with_avg_amount) }} </span> </p> 
        </div> 
       </div> 
      </div> 
     </div> </a>@endif
    @endforeach
    
 
    <div class="none_data  hide"> 
     <img class="none_image" src="/public/site/img/order/none_order.png"> 
     <p class="none_text"> No items available for invest </p> 
    </div> 
   </div> 
   <div class="product_type_2 product_list" id="welfare_fund">
       @foreach ($packages as $package)
      @if ($package->category == 'welfare')
    <a onclick="window.location.href='{{route('vip.details', $package->id)}}'" class="product_card position"> 
     <div class="level">
      <img src="/public/site/img/vip/lv1.png">
     </div> 
     <div class="product_content position"> 
      <div class="product_title flex_left"> 
       <div class="product_image" style="background-image: url('{{ asset($package->photo) }}')">
        <img src="/mbtech/product.png"> 
       </div> 
       <div class="product_info"> 
        <div class="product_name flex_space"> 
         <p style="width:140px; overflow: hidden;white-space: nowrap; text-overflow: ellipsis;text-align:left">{{$package->name}}</p> 
         <div class="buy">
          Buy
         </div> 
        </div> 
        <div class="product_item flex_space"> 
         <p class="label">Each Price</p> 
         <p class="value position" style="font-weight: 700"> <span class="unit">R</span> <span class="price"> {{ price($package->price) }}</span> </p> 
        </div> 
        <div class="product_item flex_space"> 
         <p class="label">Revenue</p> 
         <p class="value position">  {{ $package->validity }} Days </p> 
        </div> 
        <div class="product_item flex_space"> 
         <p class="label"> Daily Earnings </p> 
         <p class="value"> <span class="position"> <span class="unit">R</span> {{($package->commission_with_avg_amount / $package->validity)}}</span> </p> 
        </div> 
        <div class="product_item flex_space"> 
         <p class="label">Total Revenue</p> 
         <p class="value"> <span class="position"> <span class="unit">R</span> {{ ($package->commission_with_avg_amount) }} </span> </p> 
        </div> 
       </div> 
      </div> 
     </div> </a>@endif
    @endforeach
    
    
    
 
         
         

 
    <div class="none_data  hide"> 
     <img class="none_image" src="/public/site/img/order/none_order.png"> 
     <p class="none_text"> No items available for invest </p> 
    </div> 
   </div> 
   <div class="product_type_3 product_list" id="activity_fund">
       @foreach ($packages as $package)
      @if ($package->category == 'activity')
    <a onclick="window.location.href='{{route('vip.details', $package->id)}}'" class="product_card position"> 
     <div class="level">
      <img src="/public/site/img/vip/lv1.png">
     </div> 
     <div class="product_content position"> 
      <div class="product_title flex_left"> 
       <div class="product_image" style="background-image: url('{{ asset($package->photo) }}')">
        <img src="/mbtech/product.png"> 
       </div> 
       <div class="product_info"> 
        <div class="product_name flex_space"> 
         <p style="width:140px; overflow: hidden;white-space: nowrap; text-overflow: ellipsis;text-align:left">{{$package->name}}</p> 
         <div class="buy">
          Buy
         </div> 
        </div> 
        <div class="product_item flex_space"> 
         <p class="label">Each Price</p> 
         <p class="value position" style="font-weight: 700"> <span class="unit">R</span> <span class="price"> {{ ($package->price) }}</span> </p> 
        </div> 
        <div class="product_item flex_space"> 
         <p class="label">Revenue</p> 
         <p class="value position">  {{ $package->validity }} Days </p> 
        </div> 
        <div class="product_item flex_space"> 
         <p class="label"> Daily Earnings </p> 
         <p class="value"> <span class="position"> <span class="unit">R</span> {{($package->commission_with_avg_amount / $package->validity)}} </span> </p> 
        </div> 
        <div class="product_item flex_space"> 
         <p class="label">Total Revenue</p> 
         <p class="value"> <span class="position"> <span class="unit">R</span> {{ ($package->commission_with_avg_amount) }} </span> </p> 
        </div> 
       </div> 
      </div> 
     </div> </a>@endif
    @endforeach
  
    <div class="none_data  hide"> 
     <img class="none_image" src="/public/site/img/order/none_order.png"> 
     <p class="none_text"> No items available for invest </p> 
    </div> 
   </div> 
   <textarea style="height: 1px;opacity: 0" name="copyTxt" id="copyTxt" readonly>https://www.elsewedyelectricnf.cc/?invitation_code=63509</textarea> 
  </div> 
  <textarea id="notice_content" style="display: none"></textarea> 
  <a href="/help" target="_blank" id="service"> <img src="/public/site/img/common/service.png" style="width: 40px;height: 40px"> </a> 
 
<!-- Include Menu -->
@include('app.layout.menu')

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