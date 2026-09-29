<?php
use App\Models\Package;

$packages = Package::where('status', 'active')->get();
?>
<html class=" js no-touch">
 <head> 
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8"> 
  <title>{{env('APP_NAME')}} - Product</title> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"> 
  <meta name="apple-mobile-web-app-capable" content="yes"> 
  <meta name="apple-mobile-web-app-status-bar-style" content="black"> 
  <meta name="format-detection" content="telephone=no"> 
  <meta name="wap-font-scale" content="no">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <link rel="stylesheet" href="/static/home/layui/css/layui.css"> 
  <link rel="stylesheet" href="/static/home/css/reset.css"> 
  <link rel="stylesheet" href="/static/home/css/style.css"> 
  <link rel="stylesheet" href="/static/home/css/swiper-bundle.min.css"> 
  <link rel="stylesheet" href="/static/home/css/liMarquee.css"> 
  <link id="layuicss-layer" rel="stylesheet" href="https://www.cashkumarinvest.com/static/home/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all">
 </head> 
 <body class="wBg"> 
  <div class="product-head"> 
   <h2>Product</h2> 
   <div class="product-head-right"> 
    <a href="#"> <img src="/static/home/images/icon_3.png" alt=""> <i></i> </a> 
    <a href="#"> <img src="/static/home/images/avatar.png" alt=""> </a> 
   </div> 
  </div> 
  <!--div class="recordImgTop">
  <ul id="tabMenu">
    <li class="cur" data-tab="saving"><span>Savings</span></li>
    <li data-tab="dividends"><span>Dividends</span></li>
    <li data-tab="finance"><span>Finance</span></li>
    <li data-tab="bonds"><span>Bonds</span></li>
  </ul>--
</div>-->
<div class="home-level-nav"> 
  <a href="javascript:void(0);" class="cur">Growth</a> 
  <a href="javascript:void(0);">Weekly</a> 
  <a href="javascript:void(0);">Monthly</a> 
</div>

<!-- DAY Products -->
<div class="home-level-tab-item" style="display: block;">
    @foreach ($packages as $package)
      @if ($package->category == 'fixed')
  <div class="productList">
    <ul>
      <li>
        <div class="productList-title">{{$package->name}}</div>
        <div class="productList-name">
          <dl>
            <dd>Total Revenue( {{setting('currency')}}) <span>{{ ($package->commission_with_avg_amount) }}</span></dd>
            <dd>Price( {{setting('currency')}}) <span>{{ ($package->price) }}</span></dd>
          </dl>
        </div>
        <div class="productList-item">
          <p>Daily Earnings: <span><label> {{setting('currency')}}</label>{{($package->commission_with_avg_amount / $package->validity)}}</span></p>
          <p>Revenue Days: <span>{{ $package->validity }}</span></p>
          <p>Invest Quantity: <span>{{ $package->max_purchase_limit }}</span></p>
        </div>
        <div class="productList-btm">
          <div class="productList-link">
            <a onclick="window.location.href='{{route('vip.details', $package->id)}}'">Invest</a>
          </div>
        </div>
      </li>
      <!-- Add more DAY products here -->
    </ul>
  </div>@endif
    @endforeach
</div>

<!-- WEEKLY Products -->
<div class="home-level-tab-item" style="display: none;">
    @foreach ($packages as $package)
      @if ($package->category == 'welfare')
  <div class="productList">
    <ul>
      <li>
        <div class="productList-title">{{$package->name}}</div>
        <div class="productList-name">
          <dl>
            <dd>Total Revenue( {{setting('currency')}}) <span>{{ ($package->commission_with_avg_amount) }}</span></dd>
            <dd>Price( {{setting('currency')}}) <span>{{ ($package->price) }}</span></dd>
          </dl>
        </div>
        <div class="productList-item">
          <p>Daily Earnings: <span><label> {{setting('currency')}}</label>{{($package->commission_with_avg_amount / $package->validity)}}</span></p>
          <p>Revenue Days: <span>{{ $package->validity }}</span></p>
          <p>Invest Quantity: <span>{{ $package->max_purchase_limit }}</span></p>
        </div>
        <div class="productList-btm">
          <div class="productList-link">
            <a onclick="window.location.href='{{route('vip.details', $package->id)}}'">Invest</a>
          </div>
        </div>
      </li>
      <!-- Add more WEEKLY products here -->
    </ul>
  </div>@endif
    @endforeach
</div>

<!-- MONTHLY Products -->
<div class="home-level-tab-item" style="display: none;">
    @foreach ($packages as $package)
      @if ($package->category == 'activity')
  <div class="productList">
    <ul>
      <li>
        <div class="productList-title">{{$package->name}}</div>
        <div class="productList-name">
          <dl>
            <dd>Total Revenue( {{setting('currency')}}) <span>{{ ($package->commission_with_avg_amount) }}</span></dd>
            <dd>Price( {{setting('currency')}}) <span>{{ ($package->price) }}</span></dd>
          </dl>
        </div>
        <div class="productList-item">
          <p>Daily Earnings: <span><label> {{setting('currency')}}</label>{{($package->commission_with_avg_amount / $package->validity)}}</span></p>
          <p>Revenue Days: <span>{{ $package->validity }}</span></p>
          <p>Invest Quantity: <span>{{ $package->max_purchase_limit }}</span></p>
        </div>
        <div class="productList-btm">
          <div class="productList-link">
            <a onclick="window.location.href='{{route('vip.details', $package->id)}}'">Invest</a>
          </div>
        </div>
      </li>
      <!-- Add more MONTHLY products here -->
    </ul>
  </div>@endif
    @endforeach
     </div> 
  

<nav class="foot"> 
   <ul> 
    <li> <a href="/home"> <img src="/static/home/images/f_1.png"> <p>Home</p> </a> </li> 
    <li class="on"> <a href="https://www.cashkumarinvest.com/product"> <img src="/static/home/images/f_2g.png"> <p>Product</p> </a> </li> 
    <li> <a href="/team"> <img src="/static/home/images/f_3.png"> <p>Team</p> </a> </li> 
    <li> <a href="/member"> <img src="/static/home/images/f_4.png"> <p>Comment</p> </a> </li> 
    <li> <a href="/user"> <img src="/static/home/images/f_5.png"> <p>ME</p> </a> </li> 
   </ul> 
  </nav>
</div>
@include('alert-message')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const navLinks = document.querySelectorAll('.home-level-nav a');
    const tabContents = document.querySelectorAll('.home-level-tab-item');

    navLinks.forEach((link, index) => {
      link.addEventListener('click', function () {
        // Remove 'cur' class from all nav links
        navLinks.forEach(nav => nav.classList.remove('cur'));
        
        // Hide all product lists
        tabContents.forEach(tab => tab.style.display = 'none');
        
        // Add 'cur' class to clicked tab
        this.classList.add('cur');
        
        // Show the matching product tab
        tabContents[index].style.display = 'block';
      });
    });
  });
</script>

