<html lang="zh">
 <head> 
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8"> 
  <title>{{env('APP_NAME')}} - Comment</title> 
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
  <link id="layuicss-layer" rel="stylesheet" href="/static/home/layer.css?v=3.1.1" media="all">
 </head> 
 <body> 
  <div class="headTop"> 
   <a href="/member"> <i class="layui-icon layui-icon-left" style="font-size: 22px; color: #000;"></i> </a> Comment 
  </div> 
  <div class="official-form"> 
   <div class="official-detail"> 

    <!-- ADD FORM START -->
    <form method="POST" action="{{ route('proof.store') }}" enctype="multipart/form-data">
      @csrf

      <div class="official-tabel"> 
       <div class="official-tabel-tit">
        What do you think?
       </div> 
       <div class="official-tabel-txt" style="justify-content: center"> 
        <div id="score" class="layui-inline">
         <ul class="layui-rate">
          <li class="layui-inline"><i class="layui-icon layui-icon-rate-solid" style="color: #F4C11A;"></i></li>
          <li class="layui-inline"><i class="layui-icon layui-icon-rate-solid" style="color: #F4C11A;"></i></li>
          <li class="layui-inline"><i class="layui-icon layui-icon-rate-solid" style="color: #F4C11A;"></i></li>
          <li class="layui-inline"><i class="layui-icon layui-icon-rate-solid" style="color: #F4C11A;"></i></li>
          <li class="layui-inline"><i class="layui-icon layui-icon-rate-solid" style="color: #F4C11A;"></i></li>
         </ul>
         <span class="layui-inline" id="rating-text">5 POINTS</span>
        </div> 
        <!-- Give a proper name and id for rating -->
        <input type="hidden" name="rating" id="rating" value="5"> 
       </div> 
       <div class="official-tabel-txt"> 
        <textarea name="comment" placeholder="please enter utterance..."></textarea> 
       </div> 
       <div class="official-tabel-tit" style="text-align: left">
        Picture upload
       </div> 
       <div class="official-tabel-txt official-tabel-img-list"> 
        <div class="official-tabel-up"> 
         <label for="photo-upload" style="cursor: pointer;">
           <img src="/static/home/images/up.png" alt=""> 
         </label>
        </div>
        <!-- Add onchange event to trigger preview -->
        <input class="layui-upload-file" type="file" accept="image/*" name="photo" id="photo-upload" onchange="previewImage(event)"> 
       </div> 

       <!-- ADD PREVIEW CONTAINER -->
       <div id="preview-container" style="margin-top:10px;"></div>

      </div> 

      <button type="submit" class="recharge-btn">Confirm</button> 
    </form>
    <!-- ADD FORM END -->

   </div> 
  </div> 
   @include('alert-message')

  <script>
    // Update rating points and hidden input (basic example)
    const stars = document.querySelectorAll('#score ul li');
    const ratingInput = document.getElementById('rating');
    const ratingText = document.getElementById('rating-text');

    stars.forEach((star, index) => {
      star.style.cursor = 'pointer';
      star.onclick = () => {
        const points = index + 1;
        ratingInput.value = points;
        ratingText.textContent = points + " POINTS";

        stars.forEach((s, i) => {
          s.querySelector('i').style.color = i < points ? '#F4C11A' : '#ccc';
        });
      }
    });

    // Image preview function
    function previewImage(event) {
      const preview = document.getElementById('preview-container');
      preview.innerHTML = '';

      const file = event.target.files[0];
      if (file) {
        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.alt = "Preview";
        img.style.maxWidth = '120px';
        img.style.maxHeight = '120px';
        img.style.borderRadius = '5px';
        img.style.border = '1px solid #ddd';

        const wrapper = document.createElement('div');
        wrapper.className = 'upload-preview';
        wrapper.style.position = 'relative';
        wrapper.style.display = 'inline-block';

        const deleteBtn = document.createElement('button');
        deleteBtn.innerText = '🗑️';
        deleteBtn.className = 'delete-btn';
        deleteBtn.type = 'button';
        deleteBtn.style.position = 'absolute';
        deleteBtn.style.top = '-8px';
        deleteBtn.style.right = '-8px';
        deleteBtn.style.background = 'red';
        deleteBtn.style.color = 'white';
        deleteBtn.style.border = 'none';
        deleteBtn.style.borderRadius = '50%';
        deleteBtn.style.cursor = 'pointer';
        deleteBtn.style.fontSize = '14px';
        deleteBtn.style.width = '24px';
        deleteBtn.style.height = '24px';
        deleteBtn.style.lineHeight = '20px';
        deleteBtn.style.textAlign = 'center';
        deleteBtn.onclick = () => {
          document.getElementById('photo-upload').value = '';
          preview.innerHTML = '';
        };

        wrapper.appendChild(img);
        wrapper.appendChild(deleteBtn);
        preview.appendChild(wrapper);
      }
    }
  </script>

</body>
</html>
