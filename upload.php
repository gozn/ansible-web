<?php
// File: upload.php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$upload_dir = 'uploads/';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file = $_FILES['file'];
    $destination = $upload_dir . $file['name']; // Không kiểm tra định dạng file!

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if (move_uploaded_file($file['tmp_name'], $destination)) {
        echo "✅ File uploaded successfully: <a href='$destination'>$destination</a>";
    } else {
        echo "❌ Upload failed!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload File</title>
</head>
<body>
<h2>Upload File</h2>
<form method="post" enctype="multipart/form-data">
    <label>Chọn file:</label>
    <input type="file" name="file" required><br>
    <button type="submit">Upload</button>
</form>
<a href="dashboard.php">Quay lại Dashboard</a>
</body>
</html>
