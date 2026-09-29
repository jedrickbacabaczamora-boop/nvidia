<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Order Detail</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/layui@2.8.17/dist/css/layui.css" />
  <style>
    body {
      background: #0F131B;
      color: #fff;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 20px;
    }

    .order-card {
      background: #1E242C;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.4);
    }

    .order-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
    }

    .order-header h2 {
      font-size: 20px;
      color: #FFD700;
    }

    .status {
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 13px;
      font-weight: bold;
      text-transform: uppercase;
    }

    .status.active {
      background: #28a745;
      color: white;
    }

    .status.completed {
      background: #007bff;
      color: white;
    }

    .order-info p {
      margin: 6px 0;
      font-size: 15px;
    }

    .progress-bar-container {
      background: #2c2f36;
      border-radius: 6px;
      overflow: hidden;
      height: 12px;
      margin-top: 10px;
    }

    .progress-bar {
      background: linear-gradient(to right, #28a745, #6fd37f);
      height: 100%;
    }

    .footer-text {
      text-align: center;
      margin-top: 30px;
      font-size: 14px;
      color: #999;
    }

  </style>
</head>
<body>

  <div class="order-card">
    <div class="order-header">
      <h2>{{ $purchase->package->name ?? 'Unknown Package' }}</h2>
      <div class="status {{ $purchase->status === 'completed' ? 'completed' : 'active' }}">
        {{ ucfirst($purchase->status) }}
      </div>
    </div>

    <div class="order-info">
      <p><strong>Price:</strong> {{ price($purchase->amount) }}</p>
      <p><strong>Cycle:</strong> {{ $purchase->package->validity ?? 0 }} days</p>
      <p><strong>Daily Income:</strong> {{ price($purchase->daily_income ?? 0) }}</p>
      <p><strong>Total Expected:</strong> {{ price($purchase->package->commission_with_avg_amount ?? 0) }}</p>
      <p><strong>Created At:</strong> {{ $purchase->created_at->format('Y-m-d H:i') }}</p>

      @php
          use Carbon\Carbon;
          $daysPassed = Carbon::parse($purchase->created_at)->diffInDays(now());
          $progress = ($purchase->package->validity ?? 1) > 0 ? min(100, ($daysPassed / $purchase->package->validity) * 100) : 0;
          $totalIncome = ($purchase->daily_income ?? 0) * $daysPassed;
      @endphp

      <p><strong>Days Passed:</strong> {{ $daysPassed }} / {{ $purchase->package->validity ?? 0 }}</p>
      <p><strong>Earned Income:</strong> {{ price($totalIncome) }}</p>

      <div class="progress-bar-container">
        <div class="progress-bar" style="width: {{ $progress }}%"></div>
      </div>

      <p style="margin-top: 5px;">Progress: {{ number_format($progress, 2) }}%</p>
    </div>
  </div>

  <div class="footer-text">
    <p>Thank you for investing with us.</p>
  </div>

</body>
</html>
