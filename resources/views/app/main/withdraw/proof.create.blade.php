{{-- resources/views/proof/create.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Post Proof</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #f5f5f5;
    }

    .header {
      background: #00b35a;
      color: white;
      padding: 15px;
      text-align: center;
      font-size: 20px;
      font-weight: bold;
      position: sticky;
      top: 0;
    }

    .container {
      padding: 20px;
    }

    .card {
      background: white;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }

    label {
      font-weight: bold;
      margin-bottom: 5px;
      display: block;
    }

    textarea {
      width: 100%;
      border: none;
      border-radius: 10px;
      background: #eee;
      padding: 15px;
      resize: none;
      font-size: 16px;
      box-sizing: border-box;
      margin-bottom: 20px;
    }

    .upload-section {
      margin-bottom: 20px;
    }

    .upload-preview {
      position: relative;
      display: inline-block;
    }

    .upload-preview img {
      max-width: 100px;
      border-radius: 8px;
      margin-bottom: 10px;
    }

    .delete-btn {
      background: red;
      color: white;
      border: none;
      border-radius: 50%;
      padding: 5px 8px;
      font-size: 14px;
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      bottom: -10px;
      cursor: pointer;
    }

    .upload-box {
      width: 100px;
      height: 100px;
      border: 2px dashed #ccc;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
    }

    .upload-box img {
      width: 40px;
      height: 40px;
    }

    .btn {
      background: linear-gradient(to right, #1fd866, #1dbda5);
      color: white;
      border: none;
      padding: 15px;
      width: 100%;
      font-size: 18px;
      border-radius: 30px;
      cursor: pointer;
    }

    .btn:active {
      opacity: 0.8;
    }

    .alert {
      background: #d4edda;
      padding: 10px;
      border-radius: 8px;
      color: #155724;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

  <div class="header">Post Blog</div>

  <div class="container">
    <div class="card">

      @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
      @endif

      <form method="POST" action="{{ route('proof.store') }}" enctype="multipart/form-data">
        @csrf

        <label for="content">Content</label>
        <textarea id="content" name="comment" rows="6" placeholder="Please enter the content" required>{{ old('comment') }}</textarea>

        <label>Upload photos</label>
        <div class="upload-section">
          <div id="preview-container"></div>
          <label class="upload-box">
            <input type="file" name="image" id="image" accept="image/*" style="display: none;" onchange="previewImage(event)" required />
            <img src="https://img.icons8.com/ios/50/image--v1.png" alt="Upload">
          </label>
        </div>

        <button type="submit" class="btn">Publish</button>
      </form>
    </div>
  </div>

  <script>
    function previewImage(event) {
      const preview = document.getElementById('preview-container');
      preview.innerHTML = '';

      const file = event.target.files[0];
      if (file) {
        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.alt = "Preview";

        const wrapper = document.createElement('div');
        wrapper.className = 'upload-preview';

        const deleteBtn = document.createElement('button');
        deleteBtn.innerText = '🗑️';
        deleteBtn.className = 'delete-btn';
        deleteBtn.onclick = () => {
          document.getElementById('image').value = '';
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
