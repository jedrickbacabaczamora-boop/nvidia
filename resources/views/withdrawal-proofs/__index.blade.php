<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Blog</title>
  <link rel="stylesheet" href="/public/site/layui/csss/layui.css">
  <link rel="stylesheet" href="/public/site/csss/common.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <style>
    .blog_header {
      background: linear-gradient(133deg, #063D9E 0%, #0062E1 99%);
      border-radius: 0px 0px 0px 0px;
      height: 120px;
    }

    .blog_contents {
      position: relative;
      background: none;
      margin: 15px;
      margin-bottom: 200px;
    }

    .bold_card {
      background: #FFFFFF;
      padding: 15px;
      margin-bottom: 15px;
      border-radius: 16px;
    }

    .bold_card .card_header {
      display: flex;
      justify-content: space-between;
    }

    .bold_card .card_header .title {
      display: flex;
      justify-content: left;
    }

    .bold_card .card_header .title .info {
      padding-left: 10px;
    }

    .bold_card .card_header .title .nickname {
      font-family: Arial, Arial;
      font-weight: 700;
      font-size: 16px;
      color: #333333;
      line-height: 18px;
    }

    .bold_card .card_header .title .account {
      font-family: Arial, Arial;
      font-weight: 400;
      font-size: 14px;
      color: #818393;
      line-height: 16px;
    }

    .bold_card .card_header .gold_bg {
      width: 40px;
      height: 40px;
      background-image: url("/public/site/img/blog/gold_bg.png");
      background-size: 40px 40px;
      background-repeat: no-repeat;
      line-height: 40px;
      font-family: Arial, Arial;
      font-weight: 700;
      font-size: 12px;
      color: #FCAA00;
      text-align: center;
    }

    .bold_card .contents {
      margin-left: 40px;
    }

    .bold_card .contents .text {
      font-family: Arial, Arial;
      font-weight: 400;
      font-size: 16px;
      color: #666666;
      line-height: 20px;
      margin: 10px 0;
    }

    .blog_img {
      width: 100%;
      min-height: 84px;
    }

    .avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      border: 1px solid #EEEEEE;
    }

    .footer {
      margin-left: 40px;
      display: flex;
      justify-content: space-between;
    }

    .footer img {
      width: 16px;
      height: 16px;
    }

    .date {
      font-family: PingFang SC, PingFang SC;
      font-weight: 400;
      font-size: 14px;
      color: #818393;
      line-height: 14px;
    }

    .icon {
      font-family: PingFang SC, PingFang SC;
      font-weight: 400;
      font-size: 16px;
      color: #FCAA00;
    }

    .layui-layer-msg {
      min-width: 180px;
      border: 1px solid #d3d4d3;
      box-shadow: none;
    }

    /* Dialog Styling */
    #reward-dialog {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.6);
      z-index: 9999;
      display: none;
      justify-content: center;
      align-items: center;
    }

    .dialog_contents {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      max-width: 90%;
      width: 400px;
      position: relative;
    }

    #close-dialog {
      position: absolute;
      top: 10px;
      right: 15px;
      cursor: pointer;
      font-weight: bold;
      font-size: 20px;
    }
  </style>
</head>

<body class="common_body">
  <div class="common_header common_header_order">
    <a href="javascript:history.back(-1)" class="back position">
      <p class="btn"><i class="layui-icon layui-icon-left layui-font-20"></i></p>
      Blog
    </a>
  </div>

  <div class="blog_contents" id="blog_contents" style="overflow: hidden; position: relative; top: -60px">
    @foreach(\App\Models\WithdrawProof::where('status', 'approved')->orderByDesc('id')->get() as $proof)
    <?php $user = \App\Models\User::find($proof->user_id); ?>
      <div class="bold_card">
        <div class="card_header">
          <div class="title">
            <img class="avatar" src="/public/uploads/user/avatar.png">
            <div class="info">
              <p class="nickname">{{ $user->name ?? 'User' }}</p>
              <p class="account">
                {{ substr($user->phone ?? '********', 0, 2) }}****{{ substr($user->phone ?? '********', -2) }}
              </p>
            </div>
          </div>
        </div>
        <div class="contents">
          <div class="text">{{ $proof->comment }}</div>
          <div class="image">
            <div class="layui-row layui-col-space10">
              <div class="layui-col-md4 layui-col-xs4">
                <img class="blog_img" src="{{ asset($proof->photo) }}">
              </div>
            </div>
          </div>
        </div>
        <div style="height: 15px;"></div>
        <div class="footer">
          <div class="icon">
            <img src="/mbtech/reward_icon.png" alt=""> R{{ number_format($proof->reward_amount) }}
          </div>
          <div class="date">
            <p>{{ $proof->created_at->format('Y-m-d H:i:s') }}</p>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <div id="blog_post" style="position:fixed;right:0px;bottom:200px;background: none;width: 80px;padding: 10px 0">
    <a href="javascript:" class="rules">
      <img src="/mbtech/rules.png" style="width: 70px;height: 70px">
    </a>
    <a href="/post-proof">
      <img src="/mbtech/publish.png" style="width: 70px;height: 70px">
    </a>
  </div>
@include('app.layout.menu')
@include('alert-message')
  <!-- Reward Dialog -->
  <div id="reward-dialog">
    <div class="dialog_contents">
      <span id="close-dialog">×</span>
      <p class="explain">Reward Description</p>
      <p class="title">Share withdrawal screenshots to receive cash rewards</p>
      <p class="text">Send a screenshot of the latest successful withdrawal to the comment section, and once approved, you will immediately receive a reward of R1 – R100.</p>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const rulesBtn = document.querySelector('.rules');
      const dialog = document.getElementById('reward-dialog');
      const closeBtn = document.getElementById('close-dialog');

      rulesBtn.addEventListener('click', function () {
        dialog.style.display = 'flex';
      });

      closeBtn.addEventListener('click', function () {
        dialog.style.display = 'none';
      });

      dialog.addEventListener('click', function (e) {
        if (e.target === dialog) {
          dialog.style.display = 'none';
        }
      });
    });
  </script>
</body>
</html>
