<html>
 <head> 
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <title>Setting Info</title> 
  <link rel="stylesheet" href="/public/v2/layui/css/layui.css"> 
  <link rel="stylesheet" href="/public/v2/css/common.css"> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <style>
        .layui-panel-window {
            background: #FFFFFF !important;
            border-top: none
        }

        .layui-form-item {
            background: none;
            border-radius: 8px;
            background: #F6F6F6;
            height: 44px;
            line-height: 44px;
        }

        .layui-input {
            background: none;
            font-weight: 700;
            font-size: 18px;
            color: #07262C;
            border: none;
            height: 44px;
            line-height: 44px;
        }
        .layui-input::placeholder {
            font-weight: 400;
            font-size: 16px;
            color: #B3B3B3;
        }

        .login_btn {
            background: linear-gradient( 180deg, #4A6DEB 0%, #5C7DF5 100%);
            box-shadow: 0px 4px 10px 0px rgba(103,173,79,0.15);
            font-family: Arial, Arial;
            font-weight: 700;
            font-size: 18px;
            color: #FFFFFF;
            height: 44px;
            line-height: 44px;

        }
        .password_item{
            display: block;
            padding: 10px;
            border-bottom: 1px solid #EDEDED;
            font-family: PingFang SC, PingFang SC;
            font-weight: 400;
            font-size: 14px;
            color: #07262C;
            line-height: 20px;
        }
    </style> 
 </head> 
 <body class="common_body"> 
  <div class="common_header" style="background: #4A6DEB"> 
   <a href="javascript:history.back(-1)" class="back position"> <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p> Setting Info </a> 
  </div> 
  <div style="margin: 30px 15px;"> 
   <div style="background: #FFFFFF;padding: 15px;border-radius: 8px;"> 
    <div class="layui-panel-window layui-font-16" style="border-radius: 8px;"> 
     <form class="layui-form" lay-filter="saveBankCardInfoForm"> 
      <input name="avatar" id="avatar" type="hidden" value="/public/uploads/user/avatar.png"> 
      <div class="demo-login-container"> 
       <div class="user-header" style="margin-top: 10px;display: flex;justify-content: flex-start"> 
        <div> 
         <img src="{{setting('logo')}}" style="width: 60px;height: 60px" class="layui-circle" id="upload_avatar">
         <input class="layui-upload-file" type="file" accept="image/*" name="file"> 
        </div> 
        <div style="padding-left: 10px;color: #818393"> 
         <h1 class="layui-font-16" style="color: #07262C;margin-bottom: 10px;">Click to change picture</h1> 
         <p>It is recommended to upload 1:1 images larger than 100px</p> 
        </div> 
        <div style="clear: both"></div> 
       </div> 
       <div style="margin-top: 20px;margin-bottom: 7px;color: #474747;font-size: 18px;">
        NickName
       </div> 
       <div class="layui-form-item"> 
        <input type="text" name="nickname" value="@nano_coders" lay-verify="required" placeholder="nickname" autocomplete="off" class="layui-input"> 
       </div> 
       <!--<div style="margin-top: 20px;margin-bottom: 7px;color: #474747;font-size: 18px;">E-mail</div>--> 
       <!--<div class="layui-form-item">--> 
       <!--    <input type="text" name="email"  value="" lay-verify="required" placeholder="Email" autocomplete="off" class="layui-input">--> 
       <!--</div>--> 
       <div class="layui-form-item" style="border: none;       margin-top: 30px;"> 
        <button class="layui-btn  layui-btn-lg layui-btn-fluid layui-btn-radius login_btn" lay-submit="" lay-filter="saveInfo"> Save Info </button> 
       </div> 
      </div> 
     </form> 
    </div> 
   </div> 
  </div> 
  <!--<div class="common_card" style="margin: 15px;"> 
  <!--<a class="password_item" href="/password"> 
    <!--div class="flex_space"> 
     <div>
      <i class="layui-icon layui-icon-password"></i> Login Password
     </div> 
     <div>
      <i class="layui-icon layui-icon-right"></i>
     </div> 
    </div> </a> 
   <a class="password_item" href="/tradePassword"> 
    <div class="flex_space"> 
     <div>
      <i class="layui-icon layui-icon-vercode"></i> Trade Password
     </div>--
     <div>
      <i class="layui-icon layui-icon-right"></i>
     </div> 
    </div> </a> --
  </div> -->
  <!--	底部内容-开始	  --> 
  <!--<a href="/help"  id="service">--> 
  <!--  <img src="/public/v1/img/common/service.png" style="width: 40px;height: 40px">--> 
  <!--</a>--> 
  <!--	底部内容-结束	  --> 
  <!-- body 末尾处引入 layui --> 
  <script>
    layui.use(function(){
        var $ = layui.jquery;
        var layer = layui.layer;
        var form = layui.form;
        var upload = layui.upload;
        var element = layui.element;
        //常规使用 - 普通图片上传
        var uploadInst = upload.render({
            elem: '#upload_avatar'
            ,url: '/api/user/uploadAvatar' // 实际使用时改成您自己的上传接口即可。
            ,acceptMime: 'image/*'
            ,accept:'jpg|png|gif|jpeg'
            ,data:{'directory':'avatar'}
            ,done: function(res){
                layer.msg(res.msg);
                //如果上传失败
                if(res.status = 1){
                    $('#avatar').val(res.result.path);
                    $('#upload_avatar').attr('src',res.result.show_path);
                }

            }
            ,error: function(){

            }
        });
        // 提交事件
        form.on('submit(saveInfo)', function(data){
            var data = data.field; // 获取表单字段值
            $.post('/info',data,function (res) {
                layer.msg(res.msg);
                if(res.status==1){
                    window.location.href = '/my'
                }
            })
            return false; // 阻止默认 form 跳转
        });

    });
</script> 
 </body>
</html>