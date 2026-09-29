<html>
 <head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>rechargeLists</title> 
  <link rel="stylesheet" href="/public/v2/layui/css/layui.css"> 
  <link rel="stylesheet" href="/public/v2/css/common.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <style>
        .layui-layer-page {
            background-color: #FFFFFf;
        }
        .common_card{background:#FFFFFf }
        .layui-input{background: none}

        .layui-collapse{ border-radius: 15px;}
        .layui-colla-item{ }
        .layui-colla-title{

            font-family: Arial, Arial;
            font-weight: 700;
            font-size: 16px;
            color: #003862;
        }
        .layui-colla-title .success{color: #2BE26C;}
        .layui-colla-title .progress{color: #003862;}
        .layui-colla-title .returned{color: #FFA559;}
        .layui-colla-content,.layui-colla-item {
            border-top: 1px solid #dddddd;
        }
        .layui-colla-item .label {
            color: #ffffff;
        }
        .layui-colla-item .value {
            font-weight: 700;
            font-size: 16px;
            color: #ffffff;
            padding-left: 10px;
        }
        .padding{ padding: 10px 0}
        .bottom_order{
            border-bottom: 1px solid #EBEAEA;
        }
        .label{
            color: #666666 !important;
        }
        .value{
            color: #07262C !important;font-weight: 700;
        }
    </style> 
 </head> 
 <body class="common_background" style="background-image: url(/public/v2/img/order/bg1.png);"> 
  <div class="common_header"> 
   <a href="javascript:history.back(-1)" class="back position"> <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p> rechargeLists </a> 
  </div> 
  <div style="margin: 15px"> 
   <div class="common_card " style="background: #FFFFFF;"> 
    <p class="value" style="font-family: Arial, Arial;font-weight: 700;font-size: 18px;color:#333333;line-height: 21px;"> {{ price(auth()->user()->balance) }}</p> 
    <p class="label" style="font-family: Arial, Arial;font-weight: 400;font-size: 14px;color: #444444;line-height: 21px;"> Account Balance </p> 
   </div> 
   <div style="margin-top:20px">
           @foreach(\App\Models\Deposit::where('user_id', auth()->id())->orderByDesc('id')->get() as $element)
    @php
        $statusColor = match($element->status) {
            'approved' => '#2BE26C',
            'progress' => '#003862',
            'rejected' => '#F44336',
            default => '#FF8725'
        };
    @endphp
    <a ref="/rechargeDetails/68202" class="common_card position" style="display:block"> 
     <div class="flex_space padding bottom_order"> 
      <p class="label">Recharge status</p> 
      <p class="value"> <span style="color: {{ $statusColor }}">{{ ucfirst($element->status) }}</span> </p> 
     </div> 
     <div href="/withdrawRecordDetails/68202" class="flex_space padding bottom_order"> 
      <p class="label">Recharge Amount </p> 
      <p class="value position"> <span></span>{{ price($element->amount) }} </p> 
     </div> 
     <div href="/withdrawRecordDetails/68202" class="flex_space padding bottom_order"> 
      <p class="label">Received Amount</p> 
      <p class="value position"> <span></span>{{ price($element->final_amount) }}</p> 
     </div> 
     <div href="/withdrawRecordDetails/68202" class="flex_space padding bottom_order"> 
      <p class="label">tax amount</p> 
      <p class="value position"> <span></span> {{ price($element->charge_amount) }}</p> 
     </div> 
     <div href="/withdrawRecordDetails/68202" class="flex_space padding bottom_order"> 
      <p class="label">Initiation time</p> 
      <p class="value position"> {{ $element->created_at }} </p> 
     </div> </a> @endforeach
     
   </div> 
  </div> 
  <!--<a href="/help"  id="service">--> 
  <!--  <img src="/public/v1/img/common/service.png" style="width: 40px;height: 40px">--> 
  <!--</a>--> 
  <!-- body 末尾处引入 layui --> 
  <script>
     
 </body>
</html>