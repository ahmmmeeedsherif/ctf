<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CTF File Uploader</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="bg-white p-8 rounded shadow-md w-full max-w-md text-center">
    <h1 class="text-2xl font-semibold mb-4">Upload Your Image</h1>

    <form id="uploadForm" action="upload.php" method="POST" enctype="multipart/form-data" class="space-y-4">
      <input type="file" id="fileInput" name="file" accept="image/*"
             class="block w-full text-sm text-gray-700 border border-gray-300 rounded px-3 py-2" required>
      <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Upload
      </button>
    </form>

    <div id="message" class="mt-4 text-red-600 hidden">❌ Only image files are allowed!</div>

    <?php if (isset($_GET['success'])): ?>
      <p class="mt-4 text-green-600">✅ File uploaded successfully!</p>
    <?php elseif (isset($_GET['error'])): ?>
      <p class="mt-4 text-red-600">❌ Error uploading file.</p>
    <?php endif; ?>

    <?php
    $files = array_diff(scandir('uploads'), ['.', '..']);
    if (!empty($files)): ?>
      <div class="mt-6 text-left">
        <h2 class="font-semibold mb-2">Uploaded Files:</h2>
        <ul class="text-sm text-blue-700 space-y-1">
          <?php foreach ($files as $file): ?>
            <li>
              <a href="uploads/<?= htmlspecialchars($file) ?>" target="_blank" class="underline">
                <?= htmlspecialchars($file) ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
  </div>

  <script>
    document.getElementById('uploadForm').addEventListener('submit', function(e) {
      const fileInput = document.getElementById('fileInput');
      const file = fileInput.files[0];
      const message = document.getElementById('message');
      if (file && !file.type.startsWith('image/')) {
        e.preventDefault();
        message.classList.remove('hidden');
      }
    });
  </script>
</body>
</html>
