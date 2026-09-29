<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{env('APP_NAME')}}</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
    <link rel="stylesheet" href="{{asset('public')}}/static/index.97465e7b.css">
    <link rel="stylesheet" href="{{asset('public')}}/record.css">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <style>
        uni-page-body {
            width: 100%;
        }
    </style>
</head>
<body class="uni-body pages-bill">
<uni-app class="">
    <uni-page data-page="pages/bill">
        <uni-page-wrapper>
            <uni-page-body>
                <uni-view data-v-2c9aa287="" class="content">
                    <uni-view data-v-373aa5ec="" data-v-2c9aa287="" class="tabbar pr">
                        <uni-view data-v-373aa5ec="" class="back-wrap">
                            <img onclick="window.location.href='{{route('spin.show')}}'" src="{{asset('public/left.png')}}" alt="">
                        </uni-view>
                        <uni-text data-v-373aa5ec="" class="title" style="color: rgb(255, 255, 255);"><span>Spin History</span></uni-text>
                        <uni-view data-v-373aa5ec="" class="right"></uni-view>
                    </uni-view>

                    @foreach(\App\Models\UserLedger::where('user_id', auth()->id())->where('reason', 'spin')->orderByDesc('id')->get() as $element)
                    <uni-view data-v-2c9aa287="" class="record d-b-c">
                        <uni-image data-v-2c9aa287="">
                            <div style="background-image: url({{asset('public')}}/static/img/coin.png); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;"></div>
                            <img src="{{asset('public')}}/static/img/coin.png" draggable="false"></uni-image>
                        <uni-view data-v-2c9aa287="" class="flex-1">
                            <uni-view data-v-2c9aa287="" class="ui text-ellipsis">Lucky Draw Rewards</uni-view>
                            <uni-view data-v-2c9aa287="" class="d-b-c mt10">
                                <uni-text data-v-2c9aa287="" class="f24"><span>Time:{{$element->created_at}}</span></uni-text>
                                <uni-text data-v-2c9aa287="" class="ui"><span>{{price($element->amount)}}</span></uni-text>
                            </uni-view>
                        </uni-view>
                    </uni-view>
                    @endforeach
                </uni-view>
            </uni-page-body>
        </uni-page-wrapper>
    </uni-page>
</uni-app>
</body>
</html>
