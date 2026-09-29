<?php
use App\Models\Purchase;

$purchases = Purchase::where('status', 'active')
    ->where('user_id', auth()->id())
    ->with('package') // include related package
    ->get();
?>

<html>
 <head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>product_CARGILL</title> 
  <link rel="stylesheet" href="/mbtech/layui.css"> 
  <link rel="stylesheet" href="/mbtech/common.css"> 
  <link rel="stylesheet" href="/mbtech/swiper-bundle.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <style>
        .index_header{
            background: linear-gradient( 136deg, #17A278 0%, #18CA72 100%);
            border-bottom-left-radius: 8%;
            border-bottom-right-radius: 8%;
        }
        /*.nav{
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
   /*.back{
            display: block;
            width: 100%;
            font-family: Arial, Arial;
            font-weight: 700;
            font-size: 20px;
            color: #FFFFFF;
            text-align: center;
            padding:0;
            line-height: 36px;
        }
        .back .btn{
            width: 36px;
            height: 36px;
            background: #2FAB86;
            border-radius: 12px 12px 12px 12px;
            border: 1px solid #74BC8E;
            line-height: 36px;
            text-align: center;
            position: absolute;
            top:0px;
            left: 15px;
        }


        .order_details {
            width: 80px;
            height: 30px;
            background: #FFFFFF;
            border-radius: 100px 100px 100px 100px;
            border: 1px solid #CDCDCD;
            font-family: PingFang SC, PingFang SC;
            font-weight: 400;
            font-size: 16px;
            color: #666666;
            line-height: 30px;
            text-align: center;
        }
        .product_details_status {
            font-family: Arial, Arial;
            font-weight: 400;
            font-size: 16px;
            color: #818393;
        }
        .normal {
            color: #0F7A5A;
        }
        .layui-flow-more {
            display: none
        }
        .product_details_name{
            font-family: Arial, Arial;
            font-weight: 700;
            font-size: 18px;
            color: #333333;
            margin-bottom: 0px !important;
        }*
        .label{
            color: #666666 !important;
            margin-bottom: 0px !important;
            line-height: 30px !important;
        }
        .value{
            color: #333333 !important;
            margin-bottom: 0px !important;
            line-height: 30px !important;
        }
        .product_details_item{ padding: 5px !important; border-bottom: none !important;}

        .border_bottom{
            border-bottom: 1px solid #EAEAEA !important;
        }*/
    </style> 
 </head> 
 <body>
  <div class="index_header common_header common_header_order" style="padding: 0px;height: 100px;"> 
   <a href="javascript:history.back(-1)" class="back position"> <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p> My product </a> 
   <div class="index_menu" style="position: absolute;bottom: -20px;margin-top: 0px;width: 100%"> 
    <div class="nav nav_active" style="text-align: center;width: 33%;" data-type="1" data-image="fixed" onclick="setActiveTab(1)">
     <p class="title">Fixed ordered</p> 
    </div> 
    <div class="nav" style="text-align: center;width: 33%" data-type="2" data-image="welfare" onclick="setActiveTab(2)">
     <p class="title">Welfare ordered</p> 
    </div> 
    <div class="nav" style="text-align: center;width: 33%" data-type="3" data-image="activity" onclick="setActiveTab(3)">
     <p class="title">Premium ordered</p>
    </div> 
   </div> 
  </div>
  <div class="common_main" style="margin-top: 30px;"> 
   <div id="order_list" style="background: none;border-radius: 8px;"> 
  <!--div class="index_main" style="margin-top: 40px">-->
   <div class="product_type_1 product_list active" id="fixed_fund">
       @foreach ($purchases as $purchase)
    @if ($purchase->package && $purchase->package->category == 'fixed')
    <a  class="product_card position"> 
     <div class="level">
      <img src="/public/site/img/vip/lv0.png">
     </div> 
     <div class="product_content position"> 
      <div class="product_title flex_left"> 
       <div class="product_image" style="background-image: url('{{ asset($purchase->package->photo) }}')">
        <img src="/mbtech/product.png">
       </div> 
       <div class="product_info"> 
        <div class="product_name flex_space"> 
         <p style="width:140px; overflow: hidden;white-space: nowrap; text-overflow: ellipsis;text-align:left"></p> 
        <!-- <div class="buy">
          Buyt
         </div> -->
        </div> 
        <div class="product_item flex_space"> 
  <p class="label">Each Price</p> 
  <p class="value position" style="font-weight: 700"> 
    <small>{{ $purchase->package->price }}<span class="unit"></span><span class="price"> </span></small> 
  </p> 
</div> 

<div class="product_item flex_space"> 
  <p class="label">Running Days</p> 
  <p class="value position">  
    <small>{{ \Carbon\Carbon::parse($purchase->created_at)->diffInDays(now()) }} Days</small> 
  </p> 
</div> 

<div class="product_item flex_space"> 
  <p class="label">Returned Income</p> 
  <p class="value"> 
    <small><span class="position"> 
      {{ \Carbon\Carbon::parse($purchase->created_at)->diffInDays(now()) * $purchase->daily_income }}
      <span class="unit"></span> 
    </span></small> 
  </p> 
</div> 

<div class="product_item flex_space"> 
  <p class="label">Total Revenue</p> 
  <p class="value">
    <small>{{ price($purchase->package->commission_with_avg_amount) }} 
    <span class="position"><span class="unit"></span></span></small> 
  </p> 
</div> 

<div class="product_item flex_space"> 
  <p class="label">Time</p>
  <p class="value">
    <small>{{ \Carbon\Carbon::parse($purchase->created_at)->format('d M Y, h:i A') }}</small>
  </p>
</div>

       </div> 
      </div> 
     </div> </a>
    @endif
  @endforeach
    
 
    <div class="none_data  hide"> 
     <img class="none_image" src="/public/site/img/order/none_order.png"> 
     <p class="none_text"> No items available for invest </p> 
    </div> 
   </div> 
   <div class="product_type_2 product_list" id="welfare_fund">
    @foreach ($purchases as $purchase)
    @if ($purchase->package && $purchase->package->category == 'welfare')
    <a  class="product_card position"> 
     <div class="level">
      <img src="/public/site/img/vip/lv1.png">
     </div> 
     <div class="product_content position"> 
      <div class="product_title flex_left"> 
       <div class="product_image" style="background-image: url('{{ asset($purchase->package->photo) }}')">
        <img src="/mbtech/product.png"> 
       </div> 
       <div class="product_info"> 
        <div class="product_name flex_space"> 
         <p style="width:140px; overflow: hidden;white-space: nowrap; text-overflow: ellipsis;text-align:left"></p> 
        <!-- <div class="buy">
          Buyt
         </div> -->
        </div> 
        <div class="product_item flex_space"> 
  <p class="label">Each Price</p> 
  <p class="value position" style="font-weight: 700"> 
    <small>{{ $purchase->package->price }}<span class="unit"></span><span class="price"> </span></small> 
  </p> 
</div> 

<div class="product_item flex_space"> 
  <p class="label">Running Days</p> 
  <p class="value position">  
    <small>{{ \Carbon\Carbon::parse($purchase->created_at)->diffInDays(now()) }} Days</small> 
  </p> 
</div> 

<div class="product_item flex_space"> 
  <p class="label">Returned Income</p> 
  <p class="value"> 
    <small><span class="position"> 
      {{ \Carbon\Carbon::parse($purchase->created_at)->diffInDays(now()) * $purchase->daily_income }}
      <span class="unit"></span> 
    </span></small> 
  </p> 
</div> 

<div class="product_item flex_space"> 
  <p class="label">Total Revenue</p> 
  <p class="value">
    <small>{{ price($purchase->package->commission_with_avg_amount) }} 
    <span class="position"><span class="unit"></span></span></small> 
  </p> 
</div> 

<div class="product_item flex_space"> 
  <p class="label">Time</p>
  <p class="value">
    <small>{{ \Carbon\Carbon::parse($purchase->created_at)->format('d M Y, h:i A') }}</small>
  </p>
</div>

       </div> 
      </div> 
     </div> </a>
    @endif
  @endforeach
    
    
    
    
 
         
         

 
    <div class="none_data  hide"> 
     <img class="none_image" src="/public/site/img/order/none_order.png"> 
     <p class="none_text"> No items available for invest </p> 
    </div> 
   </div> 
   <div class="product_type_3 product_list" id="activity_fund">
    @foreach ($purchases as $purchase)
    @if ($purchase->package && $purchase->package->category == 'activity')
    <a class="product_card position"> 
     <div class="level">
      <img src="/public/site/img/vip/lv1.png">
     </div> 
     <div class="product_content position"> 
      <div class="product_title flex_left"> 
       <div class="product_image" style="background-image: url('{{ asset($purchase->package->photo) }}')">
        <img src="/mbtech/product.png"> 
       </div> 
       <div class="product_info"> 
        <div class="product_name flex_space"> 
         <p style="width:140px; overflow: hidden;white-space: nowrap; text-overflow: ellipsis;text-align:left"></p> 
        <!-- <div class="buy">
          Buyt
         </div> -->
        </div> 
        <div class="product_item flex_space"> 
  <p class="label">Each Price</p> 
  <p class="value position" style="font-weight: 700"> 
    <small>{{ $purchase->package->price }}<span class="unit"></span><span class="price"> </span></small> 
  </p> 
</div> 

<div class="product_item flex_space"> 
  <p class="label">Running Days</p> 
  <p class="value position">  
    <small>{{ \Carbon\Carbon::parse($purchase->created_at)->diffInDays(now()) }} Days</small> 
  </p> 
</div> 

<div class="product_item flex_space"> 
  <p class="label">Returned Income</p> 
  <p class="value"> 
    <small><span class="position"> 
      {{ \Carbon\Carbon::parse($purchase->created_at)->diffInDays(now()) * $purchase->daily_income }}
      <span class="unit"></span> 
    </span></small> 
  </p> 
</div> 

<div class="product_item flex_space"> 
  <p class="label">Total Revenue</p> 
  <p class="value">
    <small>{{ price($purchase->package->commission_with_avg_amount) }} 
    <span class="position"><span class="unit"></span></span></small> 
  </p> 
</div> 

<div class="product_item flex_space"> 
  <p class="label">Time</p>
  <p class="value">
    <small>{{ \Carbon\Carbon::parse($purchase->created_at)->format('d M Y, h:i A') }}</small>
  </p>
</div>

       </div> 
      </div> 
     </div> </a>
    @endif
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