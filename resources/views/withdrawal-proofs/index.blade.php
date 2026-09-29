<html lang="zh">
 <head> 
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8"> 
  <title>{{env('APP_NAME')}} - MBoard</title> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"> 
  <meta name="apple-mobile-web-app-capable" content="yes"> 
  <meta name="apple-mobile-web-app-status-bar-style" content="black"> 
  <meta name="format-detection" content="telephone=no"> 
  <meta name="wap-font-scale" content="no"> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/layui/2.5.7/css/layui.min.css">
  <link rel="stylesheet" href="/static/home/css/reset.css"> 
  <link rel="stylesheet" href="/static/home/css/style.css"> 
  <link rel="stylesheet" href="/static/home/layui/css/layui.css"> 
  <link id="layuicss-layer" rel="stylesheet" href="https://www.cashkumarinvest.com/static/home/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all">
 </head> 
 <body class="bgColor"> 
  <div class="official"> 
   <div class="officialHead"> 
    <h2>Comment</h2> 
    <div class="officialHead-img" style="cursor:pointer;"> 
     <img src="/static/home/images/n_7.png" alt=""> Rule 
    </div> 
   </div> 
   <div class="official-list"> 
    <ul> @foreach(\App\Models\WithdrawProof::where('status', 'approved')->orderByDesc('id')->get() as $proof)
    <?php $user = \App\Models\User::find($proof->user_id); ?>
     <!-- your existing li items here -->
     <li>
      <div class="official-top"> 
       <div class="official-top-left">
        <img src="/static/home/images/logo.png" alt="">
        <dl>
         <dt>{{ $user->realname ?? 'visitors' }}</dt>
         <dd>{{ substr($user->phone ?? '********', 0, 2) }}****{{ substr($user->phone ?? '********', -2) }}</dd>
        </dl>
       </div>
      </div>
      <div class="official-txt">
       {{ $proof->comment }}
      </div>
      <div class="official-img">
       <img src="{{ asset($proof->photo) }}" alt="">
       <img src="{{ asset($proof->photo) }}" alt="">
      </div>
      <div class="official-bottom">
       <p><i class="layui-icon layui-icon-time" style="font-size: 18px; color: #999;"></i>{{ $proof->created_at->format('Y-m-d H:i:s') }}</p>
       <div class="official-bottom-left">
        <img src="/static/home/images/starT.png" alt="">
        <img src="/static/home/images/starT.png" alt="">
        <img src="/static/home/images/starT.png" alt="">
        <img src="/static/home/images/starT.png" alt="">
        <img src="/static/home/images/starT.png" alt="">
       </div>
      </div>
     </li>@endforeach
     <!-- other li’s omitted for brevity -->
    </ul> 
   </div> 
   <a href="/member/done" class="official-fiexd"> 
    <img src="/static/home/images/icon_10.png" alt=""> 
   </a> 
   <div class="dropload-down">
    <div class="dropload-refresh">
     ↑ pull up to load more
    </div>
   </div>
  </div> 
  <div class="z-mask" style="display:none;"> 
   <div class="official-mask" style="position:relative;"> 
    <div class="official-mask-tit" style="cursor:pointer;"> 
     <img src="/static/home/images/rule_1.png" alt=""> 
    </div> 
    <div class="official-mask-txt"> 
     <p> 1. Share your feedback and ratings on the cashkumar platform. </p> 
     <p> The system will automatically review your post, and after the review is passed, you will receive a reward of 20-150 rupees. </p> 
     <p> 2. If you successfully withdraw money today, please upload a screenshot of the successful SMS and the withdrawal page of the platform. </p> 
     <p> After the review is passed, you will receive a cash reward of 50-200 rupees. </p> 
     <p> Note: You can only comment once a day, and the screenshot must be authentic and valid. </p> 
    </div> 
    <img src="/static/home/images/g_1.png" class="official-mask-bg" alt="" style="position:absolute;top:0;right:0;width:30px;height:30px;cursor:pointer;"> 
   </div> 
  </div> 
  <div class="official-image" style="display: none"> 
   <div class="official-image-img"></div> 
   <img class="mask-image-close" src="/static/home/images/g_1.png" alt=""> 
  </div> 
  <nav class="foot"> 
   <ul> 
    <li> <a href="/home"> <img src="/static/home/images/f_1.png" alt=""> <p>Home</p> </a> </li> 
    <li> <a href="/product"> <img src="/static/home/images/f_2.png" alt=""> <p>Product</p> </a> </li> 
    <li> <a href="/team"> <img src="/static/home/images/f_3.png" alt=""> <p>Team</p> </a> </li> 
    <li class="on"> <a href="/member"> <img src="/static/home/images/f_4g.png" alt=""> <p>Comment</p> </a> </li> 
    <li> <a href="/user"> <img src="/static/home/images/f_5.png" alt=""> <p>ME</p> </a> </li> 
   </ul> 
  </nav>

  <script>
    // Show rule popup on clicking the "Rule" area
    document.querySelector('.officialHead-img').addEventListener('click', function() {
      document.querySelector('.z-mask').style.display = 'block';
    });

    // Hide rule popup on clicking the background overlay or the close image
    document.querySelector('.z-mask').addEventListener('click', function(e) {
      if (e.target === this) { // click only on background overlay
        this.style.display = 'none';
      }
    });

    document.querySelector('.official-mask-bg').addEventListener('click', function() {
      document.querySelector('.z-mask').style.display = 'none';
    });
  </script>
 </body>
</html>
