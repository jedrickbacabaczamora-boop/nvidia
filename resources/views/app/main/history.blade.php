<!DOCTYPE html>
<html class="no-touch">
<head>
  <meta charset="utf-8">
  <title>{{ env('APP_NAME') }} - Financial History</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport"
    content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
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
  <div class="headTop">
    <a href="javascript:history.back();">
      <i class="layui-icon layui-icon-left" style="font-size: 22px; color: #000;"></i>
    </a>
    Financial History
  </div>

  <div class="record">
    <div class="recordHtml">
      <!-- Tabs -->
      <div class="recordsTopa" style="margin-top: 10px">
        <ul>
          <li class="cur" data-tab="account"><a href="javascript:void(0);">Account</a></li>
          <li data-tab="deposit"><a href="javascript:void(0);">Deposit</a></li>
          <li data-tab="withdraw"><a href="javascript:void(0);">Withdraw</a></li>
        </ul>
      </div>

      <!-- Account Tab -->
      <div class="recordList tab-content" id="tab-account" style="display: block;"> 
        @foreach(\App\Models\UserLedger::where('user_id', auth()->id())->orderByDesc('id')->get() as $element)
    <div class="recordLi">
        <div class="recordLiTop">
            <label><img src="/static/home/images/m_1.png"></label>
            <div class="recordLiSpan">
                <span>{{ $element->reason }}</span>
                <span>{{ $element->created_at }}</span>
            </div>
        </div>
        <div class="recordTxt">
            @if($element->credit > 0)
                <span class="text-success">+ {{ price($element->credit) }}</span>
            @elseif($element->debit > 0)
                <span class="text-danger">- {{ price($element->debit) }}</span>
            @else
                <span>{{ price(0) }}</span>
            @endif
        </div>
    </div>
@endforeach

      </div>

      <!-- Deposit Tab -->
<div class="recordList tab-content" id="tab-deposit" style="display: none;">
    @foreach(\App\Models\Deposit::where('user_id', auth()->id())->orderByDesc('id')->get() as $element)
        <div class="recordLi">
            <div class="recordLiTop">
                <span>
                    <label><img src="/static/home/images/m_1.png"></label>
                    {{ $element->oid }}
                </span>
            </div>
            <div class="recordTxt">
                <span>{{ price($element->amount) }}</span>
                <span>{{ $element->created_at->format('M d Y H:i:s') }}</span>
            </div>
            <div class="recordTxt">
                <span>Result</span>
                <span>{{ ucfirst($element->status) }}</span>
            </div>
        </div>
    @endforeach
</div>

<!-- Withdraw Tab -->
<div class="recordList tab-content" id="tab-withdraw" style="display: none;">
    @foreach(\App\Models\Withdrawal::where('user_id', auth()->id())->orderByDesc('id')->get() as $element)
        <div class="recordLi">
            <div class="recordLiTop">
                <span>
                    <label><img src="/static/home/images/m_1.png"></label>
                    {{ $element->oid }}
                </span>
            </div>
            <div class="recordTxt">
                <span>{{ price($element->amount) }}</span>
                <span>{{ $element->created_at->format('M d Y H:i:s') }}</span>
            </div>
            <div class="recordTxt">
                <span>Result</span>
                <span>{{ ucfirst($element->status) }}</span>
            </div>
        </div>
    @endforeach
</div>


      </div>
    </div>
  </div>

  <!-- JavaScript to switch tabs -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const tabs = document.querySelectorAll(".recordsTopa ul li");
      const contents = document.querySelectorAll(".tab-content");

      tabs.forEach(tab => {
        tab.addEventListener("click", function () {
          tabs.forEach(t => t.classList.remove("cur"));
          contents.forEach(c => c.style.display = "none");

          tab.classList.add("cur");
          const selectedTab = tab.getAttribute("data-tab");
          document.getElementById("tab-" + selectedTab).style.display = "block";
        });
      });
    });
  </script>
</body>
</html>
