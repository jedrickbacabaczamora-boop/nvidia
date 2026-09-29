<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" href="{{asset('public')}}/CLREnergy/dist/favicon.ico">
    <title>{{env('APP_NAME')}}</title>
    <link href="{{asset('public')}}/CLREnergy/dist/css/chunk-vendors.a9285ddb.css" rel="stylesheet">
    <link href="{{asset('public')}}/CLREnergy/dist/css/app.865ef51f.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('public')}}/CLREnergy/dist/css/791.be86190f.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public')}}/CLREnergy/dist/css/278.5b9352be.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public')}}/CLREnergy/dist/css/345.18397afb.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public')}}/CLREnergy/dist/css/335.0a1ca413.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public')}}/CLREnergy/dist/css/189.6fd946d4.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public')}}/CLREnergy/dist/css/764.7f62e783.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public')}}/CLREnergy/dist/css/4.dcbe59fd.css">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
</head>
<body class="">
<div id="app" data-v-app="">
    <div>
        <div class="aboutpage" data-v-00a2d0b3="">
            <div class="van-nav-bar van-hairline--bottom navboxi" data-v-00a2d0b3="">
                <div class="van-nav-bar__content">
                    <div class="van-nav-bar__left van-haptics-feedback" onclick="window.location.href='{{route('order')}}'"><i
                            class="van-badge__wrapper van-icon van-icon-arrow-left van-nav-bar__arrow"><!----><!---->
                            <!----></i><!----></div>
                    <div class="van-nav-bar__title van-ellipsis">Package Commission History</div><!----></div>
            </div>
            <div role="feed" class="van-list" aria-busy="false" data-v-00a2d0b3=""><!---->
                <?php $commissions = \App\Models\UserLedger::where('user_id', auth()->id())->where('reason', 'daily_income')->orderByDesc('id')->get(); ?>
                @foreach($commissions as $element)
                    <div class="record-list" data-v-00a2d0b3="">
                        <div class="record-item" data-v-00a2d0b3="">
                            <div data-v-00a2d0b3=""><p data-v-00a2d0b3="">{{$element->perticulation}}</p><span data-v-00a2d0b3="">{{$element->created_at}}</span>
                            </div>
                            <p data-v-00a2d0b3="">{{price($element->amount)}}</p></div>
                    </div>
                @endforeach
                <div class="van-list__finished-text"></div><!---->
                <div class="van-list__placeholder"></div>
            </div>
        </div>
    </div><!---->
</div>
</body>
</html>
