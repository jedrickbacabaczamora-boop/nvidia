<!DOCTYPE html>
<html class="js no-touch">
<head> 
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8"> 
  <title>{{ env('APP_NAME') }} - Orders</title> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"> 
  <meta name="apple-mobile-web-app-capable" content="yes"> 
  <meta name="apple-mobile-web-app-status-bar-style" content="black"> 
  <meta name="format-detection" content="telephone=no"> 
  <meta name="wap-font-scale" content="no">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <link rel="stylesheet" href="/static/home/css/reset.css"> 
  <link rel="stylesheet" href="/static/home/css/style.css"> 
  <link rel="stylesheet" href="/static/home/css/swiper-bundle.min.css"> 
  <link rel="stylesheet" href="/static/home/layui/css/layui.css"> 
</head> 

<body class="bgColor"> 
  <div class="header"> 
    <a href="{{ url('/user') }}"> 
      <i class="layui-icon layui-icon-left" style="font-size: 22px; color: #000;"></i> 
    </a> 
    Orders 
  </div> 

  <div class="order"> 
    <div class="recordsTop"> 
      <ul> 
        <li class="cur" data-tab="valid">
          <a href="javascript:void(0);"><i></i>Valid Orders</a>
        </li> 
        <li data-tab="expired">
          <a href="javascript:void(0);"><i></i>Expired Orders</a>
        </li> 
      </ul> 
    </div> 

    @php
      use Carbon\Carbon;
      use App\Models\Purchase;

      $purchases = Purchase::where('user_id', auth()->id())
          ->with('package')
          ->orderByDesc('id')
          ->get();

      $validOrders = $purchases->filter(fn($p) => $p->status !== 'completed');
      $expiredOrders = $purchases->filter(fn($p) => $p->status === 'completed');
    @endphp

    <div class="orderHtml"> 
      <!-- Valid Orders -->
      <div class="order-list tab-content" id="valid-orders">
        <ul>
          @forelse($validOrders as $purchase)
    @php
        $daysPassed = \Carbon\Carbon::parse($purchase->created_at)->diffInDays(now());
        $totalDays = $purchase->package->validity ?? 0;
        $dailyIncome = $purchase->daily_income ?? 0;
        $totalIncome = $dailyIncome * $daysPassed;
    @endphp
            <li>
              <div class="order-list-top">
                <div class="order-list-img">
                  <dl>
                    <dt>{{ $package->name ?? 'Package' }}</dt>
                    <dd><label>{{ price($purchase->package->price ?? 0) }}</label> Price</dd>
                    <dd><label>{{ price($dailyIncome) }}</label> Daily Income</dd>
                  </dl>
                </div>
                <span>Settled Daily</span>
              </div>
              <div class="order-list-btm">
                <p>Buy Quantity <span>{{ $purchase->quantity ?? 1 }}</span></p>
                <p>Revenue Term <span>{{ $daysPassed }}/{{ $purchase->package->validity ?? 0 }} Days</span></p>
                <p>Actually Paid <span class="bigG">{{ price($purchase->amount ?? 0) }}</span></p>
                <p>Start Date <span>{{ $purchase->created_at->format('Y-m-d') }}</span></p>
                <p>Unsettled Earnings <span class="bigR">+ {{ price($totalIncome) }}</span></p>
              </div>
            </li>
          @empty
            <li>No valid orders found.</li>
          @endforelse
        </ul>
      </div>

      <!-- Expired Orders -->
      <div class="order-list tab-content" id="expired-orders" style="display:none;">
        <ul>
          @forelse($expiredOrders as $purchase)
            @php
              $package = $purchase->package;
            @endphp
            <li>
              <div class="order-list-top">
                <div class="order-list-img">
                  <dl>
                    <dt>{{ $package->name ?? 'Package' }}</dt>
                    <dd><label>₹{{ number_format($package->price ?? 0) }}</label> Price</dd>
                    <dd><label>₹{{ number_format($purchase->daily_income ?? 0) }}</label> Daily Income</dd>
                  </dl>
                </div>
                <span>Settled Periodic</span>
              </div>
              <div class="order-list-btm">
                <p>Buy Quantity <span>{{ $purchase->quantity ?? 1 }}</span></p>
                <p>Revenue Term <span>{{ $purchase->duration ?? 'N/A' }} Days</span></p>
                <p>Actually Paid <span class="bigG">₹{{ number_format($purchase->amount ?? 0) }}</span></p>
                <p>Start Date <span>{{ $purchase->created_at->format('Y-m-d') }}</span></p>
                <p>End Date <span>{{ optional($purchase->end_date)->format('Y-m-d') ?? 'N/A' }}</span></p>
                <p>Unsettled Earnings <span class="bigR">+ ₹0</span></p>
              </div>
            </li>
          @empty
            <li>No expired orders found.</li>
          @endforelse
        </ul>
      </div>
    </div>
  </div> 

  <!-- JavaScript for Tab Switching -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const tabs = document.querySelectorAll(".recordsTop li");
      const validOrders = document.getElementById("valid-orders");
      const expiredOrders = document.getElementById("expired-orders");

      tabs.forEach(tab => {
        tab.addEventListener("click", function () {
          tabs.forEach(t => t.classList.remove("cur"));
          this.classList.add("cur");

          if (this.dataset.tab === "valid") {
            validOrders.style.display = "block";
            expiredOrders.style.display = "none";
          } else {
            validOrders.style.display = "none";
            expiredOrders.style.display = "block";
          }
        });
      });
    });
  </script>
</body>
</html>
