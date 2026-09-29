<!DOCTYPE html>
<html>
<head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>My Product</title> 
  <link rel="stylesheet" href="/public/v2/layui/css/layui.css"> 
  <link rel="stylesheet" href="/public/v2/css/common.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <style>
    .layui-layer-btn .layui-layer-btn0 {
        border-color: transparent;
        background-color: #FFC800 !important;
        color: #fff;
    }
    .details_item {
        display: flex;justify-content: space-between;
        padding: 5px 20px;
    }
    .details_item .label{
        font-family: Arial, Arial;
        font-weight: 400;
        font-size: 14px;
        color: #888888;
        line-height: 16px;
    }
    .details_item .value{
        font-family: PingFang SC, PingFang SC;
        font-weight: 400;
        font-size: 14px;
        color: #333333;
        line-height: 20px;
    }
    .record_title {
        font-family: Arial, Arial;
        font-weight: 700;
        font-size: 18px;
        color: #07262C;
        line-height: 21px;
        border-bottom: 1px solid #E3E5EE;
        padding-bottom: 10px;
    }
    .order_record {
        display: flex;
        justify-content: space-between;
        width: 100%;
        padding: 20px 0;
        border-bottom: 1px solid #EAEAEA;
    }
    .order_record .record_date {
        font-family: Arial, Arial;
        font-weight: 400;
        font-size: 14px;
        color: #84878A;
    }
    .order_record .record_value {
        font-family: Arial, Arial;
        font-weight: 700;
        font-size: 14px;
        color: #07262C;
    }
    .order_btn {
        background: #14C565;
        box-shadow: 0px 4px 10px 0px rgba(26,83,207,0.2);
    }
  </style> 
</head> 
<body class="common_background" style="background-image: url(/public/v2/img/order/bg1.png);"> 
  <div class="common_header"> 
    <a href="javascript:history.back(-1)" class="back position"> 
      <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p> My product 
    </a> 
  </div> 

  <div style="margin: 15px; padding-bottom: 150px;"> 
    <div class="product_details_card"> 
      <div> 
        <div class="product_details_name">
          {{ $purchase->package->name ?? 'Unknown Package' }}
        </div> 

        <div class="product_details_item"> 
          <p class="label">Price</p> 
          <p class="value price">{{ price($purchase->amount) }}</p> 
        </div> 

        <div class="product_details_item"> 
          <p class="label">Revenue Duration</p> 
          <p class="value">{{ $purchase->package->validity ?? 0 }} days</p> 
        </div> 

        <div class="product_details_item"> 
          <p class="label">Buy Share</p> 
          <p class="value">{{ $purchase->share ?? '1' }}</p> 
        </div> 

        @php
          $daysPassed = \Carbon\Carbon::parse($purchase->created_at)->diffInDays(now());
          $dailyIncome = $purchase->daily_income ?? 0;
          $totalIncome = $dailyIncome * $daysPassed;
          $estimatedIncome = $dailyIncome * ($purchase->package->validity ?? 0);
        @endphp

        <div class="product_details_item"> 
          <p class="label">Generated Income</p> 
          <p class="value">{{ price($totalIncome) }}</p> 
        </div> 

        <div class="product_details_item"> 
          <p class="label">Estimate Income</p> 
          <p class="value">{{ price($estimatedIncome) }}</p> 
        </div> 
      </div> 
    </div> 
    
    <div class="product_details_card"> 
  <div> 
    <div class="record_title">Settlement Records</div> 
    <?php
      $commissions = \App\Models\UserLedger::where('user_id', auth()->id())
        ->where('reason', 'balance_added')
        ->orderByDesc('id')
        ->get();
    ?>
    @forelse ($commissions as $element)
      <div class="order_record">
        <div class="record_date">{{ \Carbon\Carbon::parse($element->created_at)->format('Y-m-d') }}</div>
        <div class="record_value">
          {{ price($element->amount) }}
          <span style="color: #888;">daily income</span>
        </div>
      </div>
    @empty
      <div class="order_record">
        <div class="record_date">--</div>
        <div class="record_value">No  history found.</div>
      </div>
    @endforelse
  </div> 
</div>


    <!--<div class="product_details_card"> 
      <div> 
        <div class="record_title">Settlement Records</div> 
        {{-- Optional: loop actual income settlements --}}
        {{-- Example: --}}
        {{-- @foreach ($purchase->settlements as $settlement)
          <div class="order_record">
            <div class="record_date">{{ $settlement->date }}</div>
            <div class="record_value">₹{{ number_format($settlement->amount, 2) }}</div>
          </div>
        @endforeach --}}
        <div class="order_record">
          <div class="record_date">{{ $purchase->created_at->format('Y-m-d') }}</div>
          <div class="record_value">₹{{ number_format($dailyIncome, 2) }} / day</div>
        </div>
      </div> 
    </div> 
  </div> -->

  <div style="background: #4568E8; margin: 0; width: 100%; position: fixed; bottom: 0; left: 0;"> 
    <div class="layui-row" style="margin: 20px;"> 
      <div class="layui-col-xs6 layui-col-sm6 layui-col-md6"> 
        <p style="font-family: Arial; font-weight: 700; font-size: 18px; color: #ffffff;">
          <em class="currency"></em> 
          <span class="total_money">{{ price($totalIncome) }}</span>
        </p> 
        <span style="font-family: PingFang SC; font-size: 14px; color: #ffffff;">Total Income</span> 
      </div> 

      <div class="layui-col-xs6 layui-col-sm6 layui-col-md6"> 
        <div class="layui-inline" style="text-align: right; width: 100%;"> 
          <div class="layui-btn layui-btn-lg layui-btn-radius" style="background: #6394F1">
            Finish
          </div> 
        </div> 
      </div> 
    </div> 
  </div> 
</body>
</html>
