<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Balance Details</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <link rel="stylesheet" href="/public/site/layui/css/layui.css">
  <link rel="stylesheet" href="/public/site/css/common.css">
  <style>
    .header {
      border: none;
      background: none;
      background-image: url("/public/site/img/user/bill_bg.png");
      background-size: 100% 180px;
      background-repeat: no-repeat;
      height: 180px;
      margin-bottom: 0px;
      padding-bottom: 0px;
    }
    #Balance_details {
      margin: 15px;
    }
    .record {
      background: #234FA4;
      border-radius: 8px;
      border: 1px solid #396AC7;
      margin-bottom: 15px;
    }
    .record .right {
      padding: 15px;
    }
    .record .right .item {
      display: flex;
      justify-content: space-between;
      font-size: 12px;
    }
    .record .right .item .label {
      font-family: Arial;
      font-weight: 700;
      font-size: 16px;
      color: #D9E6FF;
      line-height: 18px;
    }
    .record .right .item .date {
      font-family: PingFang SC;
      font-weight: 400;
      font-size: 13px;
      color: #8AA8E1;
      line-height: 18px;
    }
    .record .right .item .value {
      font-family: Arial;
      font-weight: 700;
      font-size: 16px;
      color: #2BE26C;
      line-height: 18px;
    }
    .record .right .item .out {
      color: #FFA559;
    }
    .record .right .item .in {
      color: #2BE26C;
    }
    .tab-head {
      margin-top: 30px;
      list-style-type: none;
      display: flex;
      justify-content: space-between;
      overflow-x: auto;
    }
    .tab-head-item {
      flex: 1 0 auto;
      color: white;
      padding: 0 5px;
      padding-bottom: 10px;
    }
    .tab-head-item p {
      height: 34px;
      font-family: Arial;
      font-size: 16px;
      text-align: center;
      line-height: 34px;
      background: rgba(255, 255, 255, 0.25);
      border-radius: 100px;
      padding: 0 20px;
    }
    .tab-head-item .this {
      font-weight: 700;
      font-size: 18px;
      background: #AF8923;
    }
    .bill_main {
      overflow: hidden;
      background: #5779B9;
      background-image: url(/public/site/img/common/card_header_bg.png);
      background-size: 100% auto;
      background-repeat: no-repeat;
      padding-top: 18px;
      border-radius: 20px 20px 0 0;
    }
    .bill_bg {
      background: #17469F;
      border-radius: 16px 16px 0 0;
      border: 1px solid #17469F;
    }
    .nav {
      text-align: center;
      width: 30%;
      cursor: pointer;
    }
    .nav_active .title {
      font-weight: bold;
      color: #FFC800;
    }
  </style>
</head>
<body class="common_body">
  <div class="common_header">
    <a href="javascript:history.back(-1)" class="back position">
      <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p>
      Balance Details
    </a>
  </div>

  <div class="index_header">
    <div class="index_menu" style="display: flex;">
      <div class="nav nav_active" data-type="all">
        <img class="nav_all" src="/public/site/img/bill/all_active.png" style="width: 50px; height: 50px;">
        <p class="title">All</p>
      </div>
      <div class="nav" data-type="recharge">
        <img class="nav_recharge" src="/public/site/img/bill/recharge.png" style="width: 50px; height: 50px;">
        <p class="title">Recharge</p>
      </div>
      <div class="nav" data-type="withdrawal">
        <img class="nav_withdrawal" src="/public/site/img/bill/withdrawal.png" style="width: 50px; height: 50px;">
        <p class="title">Withdrawal</p>
      </div>
    </div>
  </div>

  <div class="bill_main">
    <div class="bill_bg">
      <div id="Balance_details">

        <!-- Task reward (shown in all) -->
        @foreach(\App\Models\UserLedger::where('user_id', auth()->id())->orderByDesc('id')->get() as $element)
        <div class="record" data-type="all">
          <div class="right">
            <div class="item">
              <p class="label">{{$element->reason}}</p>
              <p class="value in">+ {{price($element->amount)}}</p>
            </div>
            <div class="item" style="margin-top: 5px;">
              <p class="date">{{ $element->created_at }}</p>
              <p class="date">recharge balance</p>
            </div>
          </div>
        </div>@endforeach

        <!-- Recharge -->
        @foreach(\App\Models\Deposit::where('user_id', auth()->id())->orderByDesc('id')->get() as $element)
        <div class="record" data-type="all recharge">
          <div class="right">
            <div class="item">
              <p class="label">Recharge</p>
              <p class="value in">+ {{price($element->amount)}}</p>
            </div>
            <div class="item" style="margin-top: 5px;">
              <p class="date">{{ $element->created_at }}</p>
              <p class="date">recharge balance</p>
            </div>
          </div>
        </div>@endforeach

        <!-- Withdrawal -->
        @foreach(\App\Models\Withdrawal::where('user_id', auth()->id())->orderByDesc('id')->get() as $element)
        <div class="record" data-type="all withdrawal">
          <div class="right">
            <div class="item">
              <p class="label">Withdrawal</p>
              <p class="value out">- {{price($element->amount)}}</p>
            </div>
            <div class="item" style="margin-top: 5px;">
              <p class="date">{{ $element->created_at }}</p>
              <p class="date">withdrawal</p>
            </div>
          </div>
        </div>@endforeach

        <div class="layui-flow-more" style="text-align: center; padding: 10px; color: #ccc;">
          No more
        </div>
      </div>
    </div>
  </div>

  <!-- Help Button -->
  <a href="/help" target="_blank" id="service">
    <img src="/public/site/img/common/service.png" style="width: 40px; height: 40px;">
  </a>

  <!-- ✅ Tab JavaScript only -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const tabs = document.querySelectorAll('.nav');
      const records = document.querySelectorAll('.record');

      tabs.forEach(tab => {
        tab.addEventListener('click', () => {
          const type = tab.getAttribute('data-type');

          tabs.forEach(t => t.classList.remove('nav_active'));
          tab.classList.add('nav_active');

          records.forEach(record => {
            const types = record.getAttribute('data-type').split(' ');
            if (type === 'all' || types.includes(type)) {
              record.style.display = 'block';
            } else {
              record.style.display = 'none';
            }
          });

          // update icons
          document.querySelector('.nav_all').src = (type === 'all') ? '/public/site/img/bill/all_active.png' : '/public/site/img/bill/all.png';
          document.querySelector('.nav_recharge').src = (type === 'recharge') ? '/public/site/img/bill/recharge_active.png' : '/public/site/img/bill/recharge.png';
          document.querySelector('.nav_withdrawal').src = (type === 'withdrawal') ? '/public/site/img/bill/withdrawal_active.png' : '/public/site/img/bill/withdrawal.png';
        });
      });
    });
  </script>
</body>
</html>
