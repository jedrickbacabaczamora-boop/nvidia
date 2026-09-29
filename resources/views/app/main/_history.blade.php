<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Balance Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
    <link rel="stylesheet" href="/public/site/layui/css/layui.css">
    <link rel="stylesheet" href="/public/site/css/common.css">
    <style>
        .header{ 
            border: none;
            background: none;
            background-image: url("/public/site/img/user/bill_bg.png");
            background-size: 100% 180px;
            background-repeat: no-repeat;
            height:180px;
            margin-bottom: 0px;
            padding-bottom: 0px;
        }
        #Balance_details{
            margin: 0px;
            border-radius: 16px;
            background: #FFFFFf;
            padding: 15px;
        }
        .record {
            padding-bottom: 0px;
        }
        .record .img {width: 121px;height: 100%; min-height: 120px; max-height: 130px; border-radius: 10px 0 0 10px;}
        .record .right {
            border-bottom: 1px solid #E5E5E5;
            padding: 15px 0;
        }
        .record .right .item{display:flex;justify-content: space-between; font-size: 12px;}
        .record .right .item .label{
            font-family: Arial, Arial;
            font-weight: 700;
            font-size: 16px;
            color: #333333;
            line-height: 18px
        }
        .record .right .item .date{
            font-family: PingFang SC, PingFang SC;
            font-weight: 400;
            font-size: 13px;
            color: #898B9A;
            line-height: 18px;
        }
        .record .right .item .value{
            font-family: Arial, Arial;
            font-weight: 700;
            font-size: 16px;
            color: #2BE26C;
            line-height: 18px;
        }
        .record .right .item .out{color: #FC7F16;}
        .record .right .item .in{color: #12B24B;}
        /* 隐藏滚动条 */
        ::-webkit-scrollbar {
            display: none;
        }
        .tab-head{
            margin-top: 30px;
            list-style-type: none;
            display:-webkit-box;
            display:-webkit-flex;
            display:-ms-flexbox;
            display:flex;
            -webkit-flex-wrap:nowrap;
            -ms-flex-wrap:nowrap;
            flex-wrap:nowrap;
            -webkit-box-pack:justify;
            -webkit-justify-content:space-between;
            -ms-flex-pack:justify;
            justify-content:space-between;
            background:none;
            padding:0;
            overflow:auto;
        }
        .tab-head-item{
            -webkit-box-flex:1;
            -webkit-flex:1 0 auto;
            -ms-flex:1 0 auto;
            flex:1 0 auto;
            color:white;
            padding:0 5px;
            padding-bottom: 10px;
        }
        .tab-head-item p{
            height: 34px;
            font-family: Arial, Arial;
            font-weight: 400;
            font-size: 16px;
            color: #FFFFFF;
            text-align: left;
            font-style: normal;
            text-transform: none;
            line-height: 34px;
            text-align: center;
            background: rgba(255,255,255,0.25);
            border-radius: 100px 100px 100px 100px;
            padding: 0px 20px;
        }
        .tab-head-item .this{
            font-weight: 700;
            font-size: 18px;
            background: #AF8923;
            border-radius: 100px 100px 100px 100px;
        }
        .bill_main{
            overflow: hidden;
            margin: 15px;
        }
        .bill_bg{
            background: #FFFFFF;
            border-radius: 16px 16px 0px 0px;
        }
    </style>
</head>
<body class="common_body">
<div class="common_header common_header_order">
    <a href="/home" class="back position">
        <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p>
        Balance Details </a>
</div>
<div class="index_header position" style="background: none;top: -90px;">
    <div class="index_menu">
        <div class="nav nav_active" onclick="tabber(this, 1)" style="text-align: center;width: 30%;" data-type="1" data-image="all">
            <p class="title">All</p>
        </div>
        <div class="nav" onclick="tabber(this, 2)" style="text-align: center;width: 30%" data-type="2" data-image="recharge">
            <p class="title">Recharge</p>
        </div>
        <div class="nav" onclick="tabber(this, 3)" style="text-align: center;width: 30%" data-type="1" data-image="withdrawal">
            <p class="title">Withdrawal</p>
        </div>
    </div>
    <div class="bill_main" style="margin: 0px"> 
        <div class="bill_bg">
            <div id="Balance_details">
                <!-- All Transactions -->
                <div class="record">
                    @foreach(\App\Models\UserLedger::where('user_id', auth()->id())->orderByDesc('id')->get() as $element)
                            <div class="right">
                                <div class="item">
                                    <p class="label">{{$element->perticulation}}</p>
                                    <p class="value in">+ {{price($element->amount)}}</p>
                                </div>
                                <div class="item" style="margin-top: 5px;">
                                    <p class="date">{{$element->created_at}}</p>
                                    <p class="date">{{$element->status}}</p>
                                </div>
                            </div>
                        @endforeach
                </div>

                <!-- Recharge Transactions -->
                <div class="record" style="display: none;" id="recharge-records">
                    @foreach(\App\Models\Deposit::where('user_id', auth()->id())->orderByDesc('id')->get() as $element)
                        
                            <div class="right">
                                <div class="item">
                                    <p class="label">Recharge</p>
                                    <p class="value in">+ {{price($element->amount)}}</p>
                                </div>
                                <div class="item" style="margin-top: 5px;">
                                    <p class="date">{{ $element->created_at }}</p>
                                    <p class="date">{{$element->status}}</p>
                                </div>
                            </div>
                        
                    @endforeach
                       <!-- <p>No recharge records found</p>-->
                    
                </div>

                <!-- Withdrawal Transactions -->
                <div class="record" style="display: none;" id="withdrawal-records">
                        @foreach(\App\Models\Withdrawal::where('user_id', auth()->id())->orderByDesc('id')->get() as $element)
                            <div class="right">
                                <div class="item">
                                    <p class="label">Withdrawal</p>
                                    <p class="value out">- R{{ number_format($element->amount, 2) }}</p>
                                </div>
                                <div class="item" style="margin-top: 5px;">
                                    <p class="date">{{ $element->created_at }}</p>
                                    <p class="date">{{$element->status}}</p>
                                </div>
                            </div>
                        
                    @endforeach
                       <!-- <p>No withdrawal records found</p>-->
                    
                </div>

                <div class="layui-flow-more">No more</div>
            </div>
        </div>
    </div>
</div> 
<!-- 底部内容-开始 -->
        <a href="https://t.me/+AxzjFD0FlchiNzI0" id="service">
        <img src="/public/site/img/common/service.png" style="width: 40px;height: 40px">
    </a>
<script>
    function tabber(_this, tabNumber){
        var elements = document.querySelectorAll('.nav');
        for (let i = 0; i < elements.length; i++) {
            if (elements[i].classList.contains('nav_active')){
                elements[i].classList.remove('nav_active');
            }
        }
        _this.classList.add('nav_active');

        var el1 = document.querySelector('.record'); // All transactions
        var el2 = document.querySelector('#recharge-records'); // Recharge transactions
        var el3 = document.querySelector('#withdrawal-records'); // Withdrawal transactions
        if (tabNumber == 1){
            el1.style.display = 'block';
            el2.style.display = 'none';
            el3.style.display = 'none';
        }
        if (tabNumber == 2){
            el1.style.display = 'none';
            el2.style.display = 'block';
            el3.style.display = 'none';
        }
        if (tabNumber == 3){
            el1.style.display = 'none';
            el2.style.display = 'none';
            el3.style.display = 'block';
        }
    }
</script>

</body>
</html>