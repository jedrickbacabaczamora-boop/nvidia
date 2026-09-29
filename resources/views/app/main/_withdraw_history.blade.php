<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Withdrawal record</title>
  <link rel="stylesheet" href="/mamber/layui.css">
  <link rel="stylesheet" href="/mamber/common.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  
  <style>
    body {
      background: #e7cca0;
      margin: 0;
      font-family: Arial, sans-serif;
    }
    .header {
      background: none;
      padding: 15px;
      display: flex;
      align-items: center;
      font-weight: bold;
      font-size: 20px;
      color: #fff;
    }
    .header i {
      font-size: 24px;
      margin-right: 10px;
    }
    .balance {
      text-align: center;
      color: #fff;
      font-size: 16px;
      margin: 10px 0 20px;
    }
    .record-card {
      background: #fff;
      border-radius: 10px;
      margin: 15px;
      padding: 15px;
      box-shadow: 0px 2px 6px rgba(0,0,0,0.08);
    }
    .record-title {
      background: #003862;
      color: #fff;
      font-weight: bold;
      padding: 8px 15px;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
    }
    .record-item {
      display: flex;
      justify-content: space-between;
      padding: 10px 0;
      border-bottom: 1px solid #eee;
      font-size: 14px;
    }
    .record-item:last-child {
      border-bottom: none;
    }
    .label {
      color: #666;
    }
    .value {
      font-weight: bold;
      color: #222;
    }
  </style>
</head>
<body>

  <div class="header">
    <a href="javascript:history.back(-1)">
      <i class="layui-icon layui-icon-left"></i>
    </a>
    Withdrawal record
  </div>

  <div class="balance">
    Account Balance: <strong>{{ price(auth()->user()->balance) }}</strong>
  </div>

  @foreach(\App\Models\Withdrawal::where('user_id', auth()->id())->orderByDesc('id')->get() as $element)
    @php
      $statusColor = match($element->status) {
          'approved' => '#2BE26C',
          'progress' => '#003862',
          'rejected' => '#F44336',
          default => '#FF8725'
      };
    @endphp

    <div class="record-card">
      <div class="record-title">Withdrawal</div>
      <div class="record-item">
        <span class="label">Withdrawal Amount</span>
        <span class="value">₱{{ number_format($element->amount, 2) }}</span>
      </div>
      <div class="record-item">
        <span class="label">Amount Received</span>
        <span class="value">₱{{ number_format($element->final_amount, 2) }}</span>
      </div>
      <div class="record-item">
        <span class="label">Fee</span>
        <span class="value">₱{{ number_format($element->charge, 2) }}</span>
      </div>
      <div class="record-item">
        <span class="label">Request Date</span>
        <span class="value">{{ $element->created_at }}</span>
      </div>
    </div>
  @endforeach

</body>
</html>
