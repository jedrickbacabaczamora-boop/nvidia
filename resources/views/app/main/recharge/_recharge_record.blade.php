<html>
 <head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>rechargeLists</title> 
  <link rel="stylesheet" href="/public/site/layui/css/layui.css"> 
  <link rel="stylesheet" href="/public/site/css/common.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <style>
        .layui-layer-page {
            background-color: #FFFFFf;
        }
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
            color: #003862;
        }
        .layui-colla-item .value {
            font-weight: 700;
            font-size: 16px;
            color: #003862;
            padding-left: 10px;
        }
        .padding{ padding: 10px 0}
        .bottom_order{
            border-bottom: 1px solid #EBEAEA;
        }
    </style> 
 </head> 
 <body class="common_body" style="background-image: url(/public/site/img/user/bill_bg.png);"> 
  <div class="common_header common_header_order"> 
   <a href="javascript:history.back(-1)" class="back position"> <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p> rechargeLists </a> 
  </div> 
  <div style="margin: 20px"> 
   <div class="common_card " style="background: #FFFFFF;"> 
    <p class="value" style="font-family: Arial, Arial;font-weight: 700;font-size: 18px;color:#333333;line-height: 21px;"> Rs40.00</p> 
    <p class="label" style="font-family: Arial, Arial;font-weight: 400;font-size: 14px;color: #444444;line-height: 21px;"> Account Balance </p> 
   </div> 
   <div> 
    <div class="common_card position"> 
     <a href="" class="flex_space padding bottom_order"> <p class="label">Withdrawal status</p> <p class="value"> <span style="color: #FF8725">in review</span> </p> </a> 
     <a href="" class="flex_space padding bottom_order"> <p class="label">Recharge Amount </p> <p class="value position"> <span class="unit">Rs</span>2000.00</p> </a> 
     <a href="" class="flex_space padding bottom_order"> <p class="label">Received Amount</p> <p class="value position"> <span class="unit">Rs</span>2000.00</p> </a> 
     <a href="" class="flex_space padding bottom_order"> <p class="label">tax amount</p> <p class="value position"> <span class="unit">Rs</span> 0.00 </p> </a> 
     <a href="" class="flex_space padding bottom_order"> <p class="label">Initiation time</p> <p class="value position"> 2025-06-22 14:35:43 </p> </a> 
    </div> 
   </div> 
  </div> 
  <!--<a href="/help"  id="service" style="background:#ffffff">--> 
  <!--  <img src="/public/site/img/common/service.png" style="width: 40px;height: 40px">--> 
  <!--</a>--> 
  <!--<a href="/lottery"  id="lottery" class="animate__animated animate__fadeInUp" style=" position: fixed;   z-index:9999;   bottom: 200px;   left: 0px;">--> 
  <!--    <img src="/public/site/img/common/lottery.png" style="width: 40px;height: 40px">--> 
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