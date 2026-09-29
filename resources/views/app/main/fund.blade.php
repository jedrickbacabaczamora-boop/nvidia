<html style="font-size: 47.2px;">
<head>
    <meta charset="utf-8">
    <title>{{env('APP_NAME')}}</title>
    <meta name="viewport"
          content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no,viewport-fit=cover">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="full-screen" content="true">
    <meta name="x5-fullscreen" content="true">
    <meta name="360-fullscreen" content="true">
    <meta name="renderer" content="webkit">
    <style>* {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
        }</style>
    <link href="{{asset('public')}}/static/css/app.c1933b14.css" rel="preload" as="style">
    <link href="{{asset('public')}}/static/css/chunk-vant.d14f5539.css" rel="preload" as="style">
    <link href="{{asset('public')}}/static/css/chunk-vendors.794edbf9.css" rel="preload" as="style">
    <link href="{{asset('public')}}/static/css/chunk-vant.d14f5539.css" rel="stylesheet">
    <link href="{{asset('public')}}/static/css/chunk-vendors.794edbf9.css" rel="stylesheet">
    <link href="{{asset('public')}}/static/css/app.c1933b14.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('public')}}/static/css/chunk-159f11a9.a3a3db2b.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public')}}/static/css/chunk-5576a184.9f52f39a.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public')}}/static/css/chunk-3b94db02.5929650c.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public')}}/static/css/chunk-a6d04a00.3a1821fc.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public')}}/static/css/chunk-5ba702ec.7902583a.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public')}}/static/css/chunk-9884782a.e91864af.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public')}}/static/css/chunk-07731f62.d388cdd4.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public')}}/static/css/chunk-15e30c0e.9dcbd293.css">
    <style>
        .info[data-v-11bc267c] {
            background: url({{asset('public')}}/static/img/ai_bg2.2a79c9b7.png) no-repeat;
            background-size: 100% 100%;
            color: #fff;
            padding: .28rem;
        }

        .jindu .x[data-v-11bc267c] {
            height: 38px;
            border-radius: .26rem;
            background: #ebeffc;
            margin-top: .1rem;
            overflow: hidden;
            line-height: 36px;
        }

        .jindu .x span[data-v-11bc267c] {
            background: #3862e4;
            display: block;
            width: 100%;
            height: 100%;
            text-align: center;
            color: #fff;
            padding: 1px 0;
        }

        .it.flex {
            margin: 25px 0;
        }

        .list li[data-v-11bc267c] {
            margin-bottom: .24rem;
            border-radius: .16rem;
            border: .02rem solid #eee;
            padding: .24rem;
            position: relative;
            background: #eee;
        }

        .list li .he .ico img[data-v-11bc267c] {
            width: .96rem;
            height: .96rem;
            border-radius: 0;
        }
    </style>
</head>
<body class="w856">
<div id="app" class="applang">
    <div data-v-6e534c71="" data-v-11bc267c="" class="page">
        <div data-v-11bc267c="" data-v-6e534c71="" class="bg"><img data-v-11bc267c="" data-v-6e534c71=""
                                                                   src="{{asset('public')}}/static/img/bg_ai.ecc46501.png"
                                                                   alt=""></div>
        <div data-v-6e534c71="" class="headers">
            <div data-v-a53c4a36="" data-v-11bc267c="" class="head" data-v-6e534c71="">
                <div data-v-a53c4a36="" class="container flex">
                    <div data-v-a53c4a36="" class="myName"><img data-v-a53c4a36=""
                                                                src="{{asset(setting('logo'))}}"
                                                                alt=""></div>
                    <div data-v-a53c4a36="" class="name tac">Funding</div>
                    <div data-v-a53c4a36="" class="flex1"></div>
                    <div data-v-a53c4a36="" class="lang"><img data-v-a53c4a36=""
                                                              src="data:image/png;base64,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"
                                                              alt=""></div>
                    <div data-v-a53c4a36="" class="notice"><img data-v-a53c4a36=""
                                                                src="data:image/png;base64,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"
                                                                alt=""></div>
                </div>
                <div data-v-a53c4a36=""></div>
            </div>
        </div>
        <div data-v-6e534c71="" id="scroll" class="content-container" style="padding-top: 45px; padding-bottom: 54px;">
            <div data-v-6e534c71="" id="content" class="content-scroll">
                <div data-v-11bc267c="" data-v-6e534c71="" class="container">
                    <div data-v-11bc267c="" data-v-6e534c71="">
                        <ul data-v-11bc267c="" data-v-6e534c71="" class="list">

                            @foreach(\App\Models\Fund::where('status', 'active')->get() as $element)
                                <?php
                                $myFund = \App\Models\FundInvest::where('user_id', auth()->id())->where('status', 'active')->where('fund_id', $element->id)->first();
                                ?>
                                <li data-v-11bc267c="" data-v-6e534c71="">
                                    <div data-v-11bc267c="" data-v-6e534c71="" class="he flex">
                                        <div data-v-11bc267c="" data-v-6e534c71="" class="ico">
                                            <img data-v-11bc267c="" data-v-6e534c71="" alt=""
                                                 data-src="{{asset($element->photo)}}" src="{{asset($element->photo)}}"
                                                 lazy="loaded">
                                        </div>
                                        <div data-v-11bc267c="" data-v-6e534c71="" class="flex1">
                                            <div data-v-11bc267c="" data-v-6e534c71=""
                                                 class="n">{{$element->name}}</div>
                                            <div data-v-11bc267c="" data-v-6e534c71="" class="tag">
                                                <span data-v-11bc267c="" data-v-6e534c71="">Low barrier to entry</span>
                                                <span data-v-11bc267c="" data-v-6e534c71="">novice friendly</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-v-11bc267c="" data-v-6e534c71="" class="it flex">
                                        <div data-v-11bc267c="" data-v-6e534c71="" class="li">
                                            <div data-v-11bc267c="" data-v-6e534c71=""
                                                 class="s">{{price($element->minimum_invest)}}</div>
                                            <div data-v-11bc267c="" data-v-6e534c71="" class="n">Invest range</div>
                                        </div>
                                        <div data-v-11bc267c="" data-v-6e534c71="" class="li">
                                            <div data-v-11bc267c="" data-v-6e534c71="" class="s">
                                                {{price($element->commission / $element->validity)}}
                                            </div>
                                            <div data-v-11bc267c="" data-v-6e534c71="" class="n">Daily yield</div>
                                        </div>
                                        <div data-v-11bc267c="" data-v-6e534c71="" class="li">
                                            <div data-v-11bc267c="" data-v-6e534c71="" class="s">
                                                {{price($element->commission)}}
                                            </div>
                                            <div data-v-11bc267c="" data-v-6e534c71="" class="n">Total yield</div>
                                        </div>
                                        <div data-v-11bc267c="" data-v-6e534c71="" class="li">
                                            <div data-v-11bc267c="" data-v-6e534c71="" class="s">{{$element->validity}}
                                                Days
                                            </div>
                                            <div data-v-11bc267c="" data-v-6e534c71="" class="n">Period</div>
                                        </div>
                                    </div>
                                    <div data-v-11bc267c="" data-v-6e534c71="" class="jindu">
                                        @if($myFund)
                                            <div data-v-11bc267c="" data-v-6e534c71="" class="x">
                                                <span data-v-11bc267c="" data-v-6e534c71=""
                                                      style="width: 100%;background: #3862e46b">
                                                    Streaming
                                                </span>
                                            </div>
                                        @else
                                            <div data-v-11bc267c="" data-v-6e534c71="" class="x"
                                                 onclick="buyFund('{{$element->id}}')">
                                                <span data-v-11bc267c="" data-v-6e534c71="" style="width: 100%;">
                                                    Join Stream
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @include('app.layout.manu')
    </div>
</div>

@include('alert-message')
@include('loading')

@if(session()->has('success'))
    <script>
        msg('Successful')
        setTimeout(function () {
            msgOff();
        }, 1000)
    </script>
@endif


<script>
    function buyFund(id) {
        loading()
        window.location.href = '{{url('fund-invest-confirm')}}' + '/' + id;
    }
</script>

</body>
</html>
