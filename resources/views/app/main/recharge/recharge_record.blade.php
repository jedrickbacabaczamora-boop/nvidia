<html>
 <head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>rechargeLists</title> 
  <link rel="stylesheet" href="/public/v2/layui/css/layui.css"> 
  <link rel="stylesheet" href="/public/v2/css/common.css"> 
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
 <body class="common_background" style="background-image: url(/public/v2/img/order/bg.png);"> 
  <div class="common_header"> 
   <a href="javascript:history.back(-1)" class="back position"> <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p> rechargeLists </a> 
  </div> 
  <div style="margin: 15px"> 
   <div class="common_card " style="background: #FFFFFF;"> 
    <p class="value" style="font-family: Arial, Arial;font-weight: 700;font-size: 18px;color:#333333;line-height: 21px;"> ₹30.00</p> 
    <p class="label" style="font-family: Arial, Arial;font-weight: 400;font-size: 14px;color: #444444;line-height: 21px;"> Account Balance </p> 
   </div> 
   <div style="margin-top:20px"> 
    <a href="/rechargeDetails/68202" class="common_card position" style="display:block"> 
     <div class="flex_space padding bottom_order"> 
      <p class="label">Recharge status</p> 
      <p class="value"> <span style="color: #FF8725">Processing</span> </p> 
     </div> 
     <div href="/withdrawRecordDetails/68202" class="flex_space padding bottom_order"> 
      <p class="label">Recharge Amount </p> 
      <p class="value position"> <span>₹</span>970.00</p> 
     </div> 
     <div href="/withdrawRecordDetails/68202" class="flex_space padding bottom_order"> 
      <p class="label">Received Amount</p> 
      <p class="value position"> <span>₹</span>970.00</p> 
     </div> 
     <div href="/withdrawRecordDetails/68202" class="flex_space padding bottom_order"> 
      <p class="label">tax amount</p> 
      <p class="value position"> <span>₹</span> 0.00 </p> 
     </div> 
     <div href="/withdrawRecordDetails/68202" class="flex_space padding bottom_order"> 
      <p class="label">Initiation time</p> 
      <p class="value position"> 2025-08-01 20:40:29 </p> 
     </div> </a> 
    <a href="/rechargeDetails/68201" class="common_card position" style="display:block"> 
     <div class="flex_space padding bottom_order"> 
      <p class="label">Recharge status</p> 
      <p class="value"> <span style="color: #FF8725">Processing</span> </p> 
     </div> 
     <div href="/withdrawRecordDetails/68201" class="flex_space padding bottom_order"> 
      <p class="label">Recharge Amount </p> 
      <p class="value position"> <span>₹</span>19070.00</p> 
     </div> 
     <div href="/withdrawRecordDetails/68201" class="flex_space padding bottom_order"> 
      <p class="label">Received Amount</p> 
      <p class="value position"> <span>₹</span>19070.00</p> 
     </div> 
     <div href="/withdrawRecordDetails/68201" class="flex_space padding bottom_order"> 
      <p class="label">tax amount</p> 
      <p class="value position"> <span>₹</span> 0.00 </p> 
     </div> 
     <div href="/withdrawRecordDetails/68201" class="flex_space padding bottom_order"> 
      <p class="label">Initiation time</p> 
      <p class="value position"> 2025-08-01 20:40:14 </p> 
     </div> </a> 
    <a href="/rechargeDetails/68197" class="common_card position" style="display:block"> 
     <div class="flex_space padding bottom_order"> 
      <p class="label">Recharge status</p> 
      <p class="value"> <span style="color: #FF8725">Processing</span> </p> 
     </div> 
     <div href="/withdrawRecordDetails/68197" class="flex_space padding bottom_order"> 
      <p class="label">Recharge Amount </p> 
      <p class="value position"> <span>₹</span>1970.00</p> 
     </div> 
     <div href="/withdrawRecordDetails/68197" class="flex_space padding bottom_order"> 
      <p class="label">Received Amount</p> 
      <p class="value position"> <span>₹</span>1970.00</p> 
     </div> 
     <div href="/withdrawRecordDetails/68197" class="flex_space padding bottom_order"> 
      <p class="label">tax amount</p> 
      <p class="value position"> <span>₹</span> 0.00 </p> 
     </div> 
     <div href="/withdrawRecordDetails/68197" class="flex_space padding bottom_order"> 
      <p class="label">Initiation time</p> 
      <p class="value position"> 2025-08-01 20:39:40 </p> 
     </div> </a> 
   </div> 
  </div> 
  <!--<a href="/help"  id="service">--> 
  <!--  <img src="/public/v1/img/common/service.png" style="width: 40px;height: 40px">--> 
  <!--</a>--> 
  <!-- body 末尾处引入 layui --> 
  <script>
    layui.use(function(){
        var $ = layui.jquery;
        var layer = layui.layer;
        var form = layui.form;
        var upload = layui.upload;
        var element = layui.element;
        element.render('collapse', 'collapse');

        $(document).on('click','.cancel', function () {
            layer.closeAll()
        })
        var is_withdraw = 0;
        // 提交事件
        form.on('submit(withdraw)', function(data){
            if(is_withdraw){
                $('#withdraw').addClass('layui-btn-disabled')
                layer.msg('การถอนเงินกำลังดำเนินการอยู่ โปรดอย่าส่งใหม่!');return false;
            }
            is_withdraw = 1;
            layer.msg('loading', {
                icon: 16,
                shade: 0.01
            });;
            var pay_way_id = $('input[name=pay_way_id]').val();
            var data = data.field; // 获取表单字段值
            data.pay_way_id = pay_way_id
            $.post('/withdraw',data,function (res) {
                if(res.status==1){
                    layer.msg(res.msg,{end:function () {
                            window.location.href = '/my'
                        }});
                }else{
                    layer.msg(res.msg);
                }
                is_withdraw = 0;
                $('#withdraw').removeClass('layui-btn-disabled')
            })
            return false; // 阻止默认 form 跳转
        });

        // $('#withdrawal_amount').bind('input propertychange',function () {
        //     $('#received_amount').val($(this).val())
        // })
        $('#withdrawal_amount').on('input', function() {
            var ratio = "0.05"
            $('#received_amount').html($(this).val()-$(this).val()*ratio)
            // 当input的value值改变时，这里的代码会被执行
            console.log('Input value changed:', $(this).val());
            // 你可以在这里添加其他的逻辑处理
        });

    });
</script> 
 </body>
</html>