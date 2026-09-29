<html>
 <head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>Bank Card Info</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <link rel="stylesheet" href="/public/site/layui/css/layui.css"> 
  <link rel="stylesheet" href="/public/site/css/common.css"> 
  <style>
        .layui-form-item{
            background: none;border-radius: 4px 4px 4px 4px;border: 1px solid #DCDCDC;
        }
        .layui-input{background: none;color:#333333;border: none; }

    </style> 
 </head> 
 <body class="common_body"> 
  <div class="common_header" style=" background: #2857AF;"> 
   <a href="javascript:history.back(-1)" class="back position"> <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p> Bank Card Info </a> 
  </div>
  @php
    $user = auth()->user();
@endphp
  <div class="common_header_order"></div> 
  <div class="common_card" style=" margin: 15px;"> 
   <div class="common_card_content"> 
    <form action="{{route('user.bank_setup_confirm')}}" class="layui-form" lay-filter="saveBankCardInfoForm" method="post">
                    @csrf 
     <input name="id" type="hidden" value=""> 
     <div class="demo-login-container"> 
      <div class="layui-form-item"> 
       <div class="layui-input-wrap"> 
        <div class="layui-input-prefix"> 
         <i class="layui-icon layui-icon-list"></i> 
        </div>
        <select name="gateway_method" lay-verify="required" lay-reqtext="Please Select Bank">
                                    <option value="">Please Select Bank</option>
                                    @foreach(\App\Models\BankList::where('status', '1')->get() as $elemenet)
                                        <option value="{{$elemenet->bank_code}}" @if($user->gateway_method == $elemenet->bank_code) selected @endif>{{$elemenet->name}}</option>
                                      @endforeach
                                </select>
        <!--select name="bank_id" lay-verify="required" lay-reqtext="Please Select Bank"> <option value="">Please Select Bank</option> <option value="138">GCASH</option> </select>
        <div class="layui-unselect layui-form-select">
         <div class="layui-select-title">
          <input type="text" placeholder="Please Select Bank" value="" readonly class="layui-input layui-unselect" name="">
          <i class="layui-edge"></i>
         </div>
         <dl class="layui-anim layui-anim-upbit">
          <dd lay-value="" class="layui-select-tips">
           Please Select Bank
          </dd>
          <dd lay-value="138" class="">
           GCASH
          </dd>
         </dl>
        </div> -->
       </div> 
      </div> 
      <!--<div class="layui-form-item">--> 
      <!--    <div class="layui-input-wrap">--> 
      <!--        <div class="layui-input-prefix">--> 
      <!--            <i class="layui-icon layui-icon-layer"></i>--> 
      <!--        </div>--> 
      <!--        <input type="text" name="bank_code"  value="" lay-verify="required" placeholder="Bank IFSC" autocomplete="off" class="layui-input">--> 
      <!--    </div>--> 
      <!--</div>--> 
      <div class="layui-form-item"> 
       <div class="layui-input-wrap"> 
        <div class="layui-input-prefix"> 
         <i class="layui-icon layui-icon-username"></i> 
        </div> 
        <input type="text" name="realname" value="{{ $user->realname }}" lay-verify="required" placeholder="card holder name" autocomplete="off" class="layui-input"> 
       </div> 
      </div> 
      <div class="layui-form-item"> 
       <div class="layui-input-wrap"> 
        <div class="layui-input-prefix"> 
         <i class="layui-icon layui-icon-layer"></i> 
        </div> 
        <input type="text" name="gateway_address" value="{{ $user->gateway_address }}" lay-verify="required" placeholder="card number" autocomplete="off" class="layui-input"> 
       </div> 
      </div> 
      <div class="layui-form-item"> 
       <div class="layui-input-wrap"> 
        <div class="layui-input-prefix"> 
         <i class="layui-icon layui-icon-password"></i> 
        </div> 
        <input type="password" name="trade_password" value="" lay-verify="required" placeholder="trade password" lay-reqtext="trade password" autocomplete="off" class="layui-input" style="border-radius:8px;" lay-affix="eye">
        <div class="layui-input-affix layui-input-suffix">
         <i class="layui-icon layui-icon-eye-invisible"></i>
        </div> 
       </div> 
      </div> 
      <div class="layui-form-item" style="border: none"> 
       <button type="submit" class="layui-btn  layui-btn-lg layui-btn-fluid layui-btn-radius" style="background: #1A53CF;color: #FFFFFF !important;" lay-submit="" lay-filter="saveBankCardInfo">Add bank card</button> 
      </div> 
     </div> 
    </form> 
   </div> 
  </div> 
  <div class="common_card" style=" margin: 15px;"> 
   <div class="common_card_content"> 
    <div class="demo-login-container" style=""> 
     <p class="common_explain">Explain</p> 
     <div class="common_content"> 
      <p> 1 - You can only add a bank card for withdrawals </p> 
      <p> 2 - Please ensure that the bank accounts are correct and functioning properly </p> 
     </div> 
    </div> 
   </div> 
  </div>
 
 <!-- Body Ending with layui --> 
  <img style="position: fixed;
        display: none;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 100%;" src="{{asset('public/loading.gif')}}" class="loading" alt="">
    <div class="layui-layer-move"></div>
    @include('alert-message')

    <!-- Include layui's JavaScript and initialize the form -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/layui.all.js"></script>
    <script>
        layui.use('form', function() {
            var form = layui.form;

            // Listen for form submission
            form.on('submit(saveBankCardInfoForm)', function(data){
                // Show loading animation
                document.querySelector('.loading').style.display = 'block';

                // Validate all fields before submitting
                var isValid = true;

                // Triggering the verification explicitly for each input
                form.verify({
                    required: function(value, item) {
                        if (!value.trim()) {
                            return 'This field is required!';
                        }
                    }
                });

                // Check if the form is valid
                if (!form.checkValidity()) {
                    // Hide loading animation if form is invalid
                    document.querySelector('.loading').style.display = 'none';
                    isValid = false;
                }

                // If everything is valid, submit the form
                return isValid; // This will allow or prevent the form from being submitted
            });

            // Re-render the form to apply the styles
            form.render();  
        });
    </script>
</body>
</html>
   