<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Tasks</title>
    <link rel="stylesheet" href="{{asset('public')}}/public/site/layui/css/layui.css">
    <link rel="stylesheet" href="{{asset('public')}}/public/site/css/common.css">
    <link rel="stylesheet" href="{{asset('public')}}/public/web/css/common.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
    <link rel="stylesheet" href="/public/site/layui/css/layui.css">
    <link rel="stylesheet" href="/public/site/css/common.css">
    <style>
    .invite_btn {
        width: 47%;
        height: 40px;
        text-align: center;
        line-height: 40px;
        background: #396ED1;
        border-radius: 100px 100px 100px 100px;
        cursor: pointer;
      }
      .copy_link_btn {
        font-family: Arial, Arial;
        font-weight: 700;
        font-size: 14px;
        color: #FFFFFF;
      }
      .qr_code_btn {
        font-family: Arial, Arial;
        font-weight: 700;
        font-size: 14px;
        color: #FFFFFF;
        background: #29BE71;
      }
      .label {
        font-family: Arial, Arial;
        font-weight: 400;
        font-size: 14px;
        color: #95FCBE;
        line-height: 22px;
      }
      .value {
        font-family: Arial, Arial;
        font-weight: 700;
        font-size: 24px;
        color: #FFFB00;
        line-height: 28px;
      }
      .common_card .title {
        padding-left: 10px;
        font-family: Arial, Arial;
        font-weight: 700;
        font-size: 18px;
        color: #0F7A5A;
        height: 30px;
        line-height: 30px;
        display: flex;
        justify-content: space-between;
      }
      .reward_card {
        height: auto;
        background-image: url("/public/site/img/tasks/bg.png?t=222");
        background-size: 100%;
        background-repeat: no-repeat;
        border-radius: 15px;
        padding-top: 40px;
      }
      .reward_icon {
        height: 30px;
        width: 30px;
      }
      .reward_card .title {
        padding-left: 15px;
        font-family: Arial, Arial;
        font-weight: 400;
        font-size: 18px;
        color: #333333;
      }
      .reward_card .label {
        font-family: Arial, Arial;
        font-weight: 400;
        font-size: 14px;
        color: #333333;
        line-height: 16px;
      }
      .reward_card .value {
        font-family: Arial, Arial;
        font-weight: 400;
        font-size: 16px;
        color: #333333;
        line-height: 18px;
      }
      .reward_card .content {
        margin-bottom: 15px;
        margin-top: unset;
        width: 100%;
      }
      .reward_text {
        margin-top: 10px;
        font-family: Arial, Arial;
        font-weight: 400;
        font-size: 14px;
        color: #666666;
        line-height: 24px;
      }
      .link {
        padding-left: 10px;
        margin-bottom: 10px;
      }

        /*.invite_btn {
            width: 47%;
            height: 40px;
            text-align: center;
            line-height: 40px;
            background: #396ED1;
            border-radius: 100px 100px 100px 100px;
            cursor: pointer;
        }

        .copy_link_btn {
            font-family: Arial, Arial;
            font-weight: 700;
            font-size: 14px;
            color: #FFFFFF;

        }

        .qr_code_btn {
            font-family: Arial, Arial;
            font-weight: 700;
            font-size: 14px;
            color: #FFFFFF;
            background: #29BE71;

        }

        .label {
            font-family: Arial, Arial;
            font-weight: 400;
            font-size: 14px;
            color: #95FCBE;
            line-height: 22px;
        }

        .value {
            font-family: Arial, Arial;
            font-weight: 700;
            font-size: 24px;
            color: #FFFB00;
            line-height: 28px;
        }

        .common_card .title {
            padding-left: 10px;
            font-family: Arial, Arial;
            font-weight: 700;
            font-size: 18px;
            color: #0F7A5A;
            height: 30px;
            line-height: 30px;
            display: flex;
            justify-content: space-between;
        }

        .reward_card {
            height: auto;
            background-image: url("{{asset('public')}}/public/site/img/tasks/bg.png?t=222");
            background-size: 100%;
            background-repeat: no-repeat;
            border-radius: 15px;
            padding-top: 40px;
        }

        .reward_icon {
            height: 30px;
            width: 30px;
        }

        .reward_card .title {
            padding-left: 15px;
            font-family: Arial, Arial;
            font-weight: 400;
            font-size: 18px;
            color: #333333;
        }

        .reward_card .label {
            font-family: Arial, Arial;
            font-weight: 400;
            font-size: 14px;
            color: #333333;
            line-height: 16px;
        }

        .reward_card .value {
            font-family: Arial, Arial;
            font-weight: 400;
            font-size: 16px;
            color: #333333;
            line-height: 18px;
        }

        .reward_card .content {
            margin-bottom: 15px;
            margin-top: unset;
            width: 100%;
        }

        .reward_text {
            margin-top: 10px;
            font-family: Arial, Arial;
            font-weight: 400;
            font-size: 14px;
            color: #666666;
            line-height: 24px;
        }

        .link {
            padding-left: 10px;
            margin-bottom: 10px;
        }
        a.rccc {
            background: linear-gradient(102deg, rgb(36, 161, 150) 0%, rgb(39, 200, 93) 100%);
            padding: 4px 12px;
            margin: 8px;
            display: inline-block;
            border-radius: 5px;
            color: #ffffff;
        }
        .invite_btn {
            width: 49%;
            border-radius: 0;
        }
        .qr_code_btn {
            font-family: Arial, Arial;
            font-weight: 700;
            font-size: 14px;
            color: #FFFFFF;
            background: #01539f;
        }
        a.rccc {
            background: #01539f;
            padding: 4px 12px;
            margin: 8px;
            display: inline-block;
            border-radius: 5px;
            color: #ffffff;
        }
        .common_body {
            padding: 0px;
            margin: 0px;
            margin-top: 50px;
            background: #e7e7e7 !important;
        }
        .top {
            position: fixed;
            z-index: 9999;
            top: 0px;
            left: 0px;
            height: 30px;
            padding: 10px;
            width: 100%;
            background: #01539f;
        }*/
    </style>
</head>

    <body class="common_body">
    <div class="common_header common_header_order" style="height: 150px;">
      <a href="javascript:history.back(-1)" class="back position">
        <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p> Tasks
      </a>
      <a href="https://t.me/+AxzjFD0FlchiNzI0" style="position: absolute; top: 15px; right: 15px; height: 36px; width: 36px; background: #20C57A; border-radius: 12px 12px 12px 12px; border: 1px solid #7DD8A2;">
        <img src="/public/site/img/common/service.png" style="height:22px;width: 22px;padding-top: 8px;padding-left: 8px">
      </a>
      <div style="padding: 10px 20px;">
        <p class="label">Total Commission Rate</p>
        <p class="value" style="margin-top: 10px">36%</p>
      </div>
    </div>
    <div style="padding: 15px; margin-bottom: 20px; position: relative; top: -80px">
      <div class="common_card" style="margin-bottom: 0px">
        <div class="flex_left">
          <img class="reward_icon" src="/public/site/img/tasks/reward_icon.png">
          <div class="title">
            Reward Description
          </div>
        </div>
        <p class="reward_text"> Every time you purchase a product or invite a valid member, you will get an additional chance to win a prize!
        </p>
      </div>
      <div class="common_card" style=" margin-top:20px;background: #FFFFFF;border-radius: 16px;">
        <div class="title">
          <p>Invite Link</p>
        </div>
        <p class="link">{{url('register').'?shareCode='.auth()->user()->ref_id}}</p>
        <div class="flex_space">
          <p class="invite_btn copy_link_btn" onclick="copyLink('{{url('register').'?shareCode='.auth()->user()->ref_id}}')">Copy invitation link</p>
          <p class="invite_btn qr_code_btn" id="poster">Invitation QR code</p>
        </div>
      </div>

    <?php
    $lv1 = \App\Models\User::where('ref_by', auth()->user()->ref_id)->where('investor', 1)->count();
    $lv1active = \App\Models\User::where('ref_by', auth()->user()->ref_id)->where('investor', 1)->count();
    $referUser = \App\Models\User::where('ref_by', auth()->user()->ref_id)->get();
    $teamInvestAmount = \App\Models\Deposit::whereIn('user_id', $referUser->pluck('id')->toArray())->where('status', 'approved')->sum('amount');
    ?>
    <div class="reward_card">
        <div class="title">
            <p>Invitation tasks</p>
        </div>
        <div style=" background: #FFFFFF;padding: 15px;border-radius: 15px;">
            @foreach(\App\Models\Task::get() as $element)
        <?php
          $apply = \App\Models\TaskRequest::where('task_id', $element->id)->where('user_id', auth()->id())->where('status', '!=', 'rejected')->first();
        ?>
            <div class="content flex_left">
                <div style="width: 34px;height: 34px;background: #E5F2E8;border-radius: 12px 12px 12px 12px;padding: 7px;margin-right: 10px">
                    <img style="width: 34px;height: 34px;" data-cfsrc="{{asset('public')}}/public/site/img/tasks/reward_icon.png"
                         data-cfstyle="width: 34px;height: 34px;"
                         src="{{asset('public')}}/public/site/img/tasks/reward_icon.png">
                </div>

                <div style="width: 100%" onclick="getDeposirreward('{{url('apply-for-task-commission'.'/'. $element->id)}}')">
                    <div class="flex_space" style="margin-bottom: 10px;">
                        <div class="label">Invitation activation of {{$element->team_size}}, </div>
                        <div class="value position"><span class="unit"> </span>  {{price($element->bonus)}}</div>
                    </div>
                    <div class="flex_space">
                        <div class="layui-progress " style="width: 160px;height: 10px;margin-top: 5px">
                            <div class="layui-progress-bar layui-bg-blue"
                                 style="height: 10px; background: linear-gradient(102deg, rgb(36, 161, 150) 0%, rgb(39, 200, 93) 100%); width: @if($apply) 100% @else 0% @endif;"></div>
                        </div>
                       <div class="value"><span style="color: #359B5A"></span>
                            
                                <!--<a href="javascript:void(0)" class="rccc" style="background: linear-gradient(102deg, rgb(36 161 150 / 43%) 0%, rgb(39 200 93 / 38%) 100%);">Success</a>
                            
                        <!--a href="javascript:void(0)" class="rccc" onclick="applyes('{{$element->id}}')"></a>-->
                    
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>



<textarea style="height: 1px;opacity: 0" name="copyTxt" id="copyTxt" readonly="">{{url('account').'?inviteCode='.auth()->user()->ref_id}}</textarea>


<!--	底部内容-结束	  -->
<!--	底部内容-开始	  -->
@include('app.layout.menu')
<!--	底部内容-结束	  -->

<!-- body 末尾处引入 layui -->
<script src="{{asset('public')}}/public/site/layui/layui.js"></script>
<!--	底部内容-开始	  --
<div class="top">

    <div class="content flex_space">
        <div class="flex_left" style="color: #ffffff">
            Invitation
        </div>
        <div>
            <div class="dropdown-base" style="border: none;margin-right: 20px;line-height: 30px;">
                <span style="color: #FFFFFF"></span>
            </div>
        </div>
    </div>
</div>-->

<div class="loader" style="
    position: fixed;
    display: none;
    top: 50%;
    z-index: 99;
    width: 143px;
    border-radius: 15px;
    overflow: hidden;
    left: 50%;
    transform: translate(-50%, -50%);
">
    <img src="{{asset('public/loading.gif')}}" style="width: 100%;" alt="">
</div>

@include('alert-message')
<script>
    function copyLink(text)
    {
        const body = document.body;
        const input = document.createElement("input");
        body.append(input);
        input.style.opacity = 0;
        input.value = text.replaceAll(' ', '');
        input.select();
        input.setSelectionRange(0, input.value.length);
        document.execCommand("Copy");
        input.blur();
        input.remove();
        message('Copied success..')
    }


    function receivedReward(condition){
        if (condition == true){
            window.location.href='{{route('user.received.reward')}}';
        }else {
            message('Target not eligible.')
        }
    }

    function closeCheckIn(){
        var checkinOverLay = document.querySelector('.checkinOverLay');
        var checkinOverBlock = document.querySelector('.checkinOverBlock');

        checkinOverLay.style.display = 'none';
        checkinOverBlock.style.display = 'none';
    }

    function openCheckIn(){
        var checkinOverLay = document.querySelector('.checkinOverLay');
        var checkinOverBlock = document.querySelector('.checkinOverBlock');

        checkinOverLay.style.display = 'block';
        checkinOverBlock.style.display = 'block';
    }

    function checkin(){
        closeCheckIn()
        var code = document.querySelector('input[name="code"]').value;
        window.location.href='{{url('submit-bonus-amount')}}'+"/"+code
    }


    function getDeposirreward(url){
        document.querySelector('.loader').style.display='block';
        window.location.href=url
    }
</script>
</body>
</html>
