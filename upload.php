<?php
$uploadDir = 'uploads/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $filename = basename($_FILES['file']['name']);
        $targetPath = $uploadDir . $filename;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
            header("Location: index.php?success=1");
            exit();
        }
    }

    header("Location: index.php?error=1");
    exit();
}
