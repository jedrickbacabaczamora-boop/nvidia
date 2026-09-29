<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Withdraw</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <link rel="stylesheet" href="/public/site/layui/css/layui.css">
  <link rel="stylesheet" href="/public/site/css/common.css">
  <style>
    body { background: #F4F6FB; }
    .layui-input { background: none; }
    .common_header { background: #2857AF; }
    .withdraw-record { background: #234FA4; border-radius: 8px; border: 1px solid #396AC7; padding: 15px; margin-bottom: 15px; }
    .withdraw-record .item { display: flex; justify-content: space-between; font-size: 14px; margin-bottom: 5px; }
    .withdraw-record .label { color: #D9E6FF; font-weight: bold; }
    .withdraw-record .value { color: #2BE26C; font-weight: bold; }
    .withdraw-record .value.fail { color: #FFA559; }
    .withdraw-record .sub { font-size: 12px; color: #8AA8E1; margin-top: 2px; }
    .value.pending {
  color: #FFA500; /* orange for pending */
 .value.fail {
  color: #FFA559; /* red-ish for rejected */
}

  </style>
</head>
<body class="common_body">
  <div class="common_header">
    <a href="javascript:history.back(-1)" class="back position">
      <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p> withdraw
    </a>
  </div>

  <div class="common_card position" style="margin: 15px;">
    <div class="common_card_content" style="background: #FFFFFF;">
      <form class="layui-form" method="post" action="{{route('user.withdraw.request')}}">
        @csrf
        <h3 style="font-family: PingFang SC; font-weight: 400; font-size: 16px; color: #17469F;">
          Withdrawal Balance：<span style="color:#0751A0;font-weight: 700">{{ price(auth()->user()->balance) }}</span>
        </h3>

        <div class="layui-form-item" style="margin-top: 20px">
          <div class="layui-input-wrap">
            <input type="number" name="amount" min="{{ $minWithdraw }}" max="{{ $maxWithdraw }}" placeholder="Withdrawal amount {{ price($minWithdraw) }} - {{ price($maxWithdraw) }}" class="layui-input">
          </div>
        </div>

        <div class="layui-form-item">
          <div class="layui-input-wrap">
            <input type="password" name="trade_password" placeholder="Trade password" class="layui-input">
          </div>
        </div>

        <div class="layui-form-item">
          <div class="layui-input-wrap">
            <select name="user_bank_id" class="layui-input">
              <option value="">Choose a bank card</option>
             {{-- @foreach(auth()->user()->banks as $bank)
                <option value="{{ $bank->id }}">{{ $bank->bank_name }} - {{ $bank->account_number }}</option>
              @endforeach--}}
            </select>
          </div>
        </div>

        <div class="layui-form-item" style="margin-top: 30px">
          <button type="submit" class="layui-btn layui-btn-lg layui-btn-fluid layui-btn-radius" style="background:#0062E1;border: none;color: #FFFFFF!important;">
            Apply Withdrawal
          </button>
        </div>
      </form>
    </div>
  </div>

  <div class="common_card position" style="margin: 15px;">
    <img class="lianjie lianjie_left" src="/public/site/img/common/lianjie.png">
    <img class="lianjie lianjie_right" src="/public/site/img/common/lianjie.png">
    <div class="common_card_content">
      <p class="common_explain">Explain</p>
      <div class="common_content">
        <p>1. Daily marketing from 10:00:00 to 16:00:00</p>
        <p>2. Withdraw an amount between {{ price($minWithdraw) }} and {{ price($maxWithdraw) }}</p>
        <p>3. You can only request withdrawal 2 times per day</p>
        <p>4. Withdrawal rate: {{ $withdrawCharge }}%</p>
      </div>
    </div>
  </div>

  <div class="common_card position" style="margin: 15px;">
    <img class="lianjie lianjie_left" src="/public/site/img/common/lianjie.png">
    <img class="lianjie lianjie_right" src="/public/site/img/common/lianjie.png">
    <div class="common_card_content">
      <p class="common_explain">My Withdrawal Records</p>
      <div class="common_content" style="border-radius: 15px;">
          @foreach(\App\Models\Withdrawal::where('user_id', auth()->id())->orderByDesc('id')->get() as $element)
        <div class="withdraw-record">
          <div class="item">
            <div class="label">Amount</div>
            <div class="value">{{ price($element->amount) }}</div>
          </div>
          <div class="item">
            <div class="label">Status</div>
            <div class="value {{ $element->status == 'rejected' ? 'fail' : ($element->status == 'pending' ? 'pending' : '') }}">{{ ucfirst($element->status) }}</div>
          </div>

          <div class="item">
            <div class="label">Account</div>
            <div class="sub">{{ json_decode($element->account_info)->bank_name ?? '' }} - {{ json_decode($element->account_info)->bank_account ?? '' }}</div>
          </div>
          <div class="item">
            <div class="label">Submitted</div>
            <div class="sub">{{ $element->created_at }}</div>
          </div>
        </div>@endforeach
        
        <div style="text-align: center; color: #888;">No more</div>
      </div>
    </div>
  </div>

  <a href="/help" target="_blank" id="service">
    <img src="/public/site/img/common/service.png" style="width: 40px; height: 40px;">
  </a>
@include('alert-message')
  <img style="position: fixed; display: none; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%;" src="{{asset('public/loading.gif')}}" class="loading" alt="">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/layui.min.js"></script>
  <script>
    function submitWithdraw() {
      document.querySelector('.loading').style.display = 'block';
      document.querySelector('form').submit();
    }
  </script>
</body>
</html>
