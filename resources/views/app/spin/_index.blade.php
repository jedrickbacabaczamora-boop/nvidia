<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Spin & Win</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Basic styling -->
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f8fb;
            padding: 20px;
            margin: 0;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        #spin-chances {
            font-weight: bold;
            color: #007bff;
        }
        #wheel {
            width: 240px;
            height: 240px;
            margin: 30px auto;
            border: 12px solid #28a745;
            border-radius: 50%;
            background: repeating-conic-gradient(#e6ffe6 0deg 45deg, #ffffff 45deg 90deg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #28a745;
            font-weight: bold;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        #spin-button {
            margin-top: 20px;
            padding: 12px 30px;
            background-color: #28a745;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            color: #fff;
            cursor: pointer;
        }
        #spin-button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
        #spin-result {
            margin-top: 25px;
            font-size: 20px;
            font-weight: bold;
        }
        .reds-amount {
            color: red;
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h2>🎯 Spin & Win</h2>

    <div style="font-size: 18px; margin-bottom: 10px;">
        Chances Left: <span id="spin-chances">{{ $chances }}</span>
    </div>

    <div id="wheel">Spin Me</div>

    @if(session('reward'))
        <div id="spin-result">🎉 You won <span style="color:green;">{{ session('reward') }}</span>!</div>
        @php
            $reds = intval(str_replace('₦', '', session('reward')));
        @endphp
        <div class="reds-amount">Reds Amount: {{ $reds }}</div>
    @elseif(session('error'))
        <div id="spin-result" style="color:red;">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('spin.now') }}">
        @csrf
        <button id="spin-button" type="submit" {{ $chances <= 0 ? 'disabled' : '' }}>Spin Now</button>
    </form>

</body>
</html>
