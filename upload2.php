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
    $destination = $upload_dir . $file['name']; // Không kiểm tra gì cả!

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if (move_uploaded_file($file['tmp_name'], $destination)) {
        chmod($destination, 0777); // Cấp quyền thực thi trên Linux

        // Nếu chạy trên Windows, sử dụng icacls để cấp Full Control
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $escaped_path = escapeshellarg(realpath($destination));
            shell_exec("icacls $escaped_path /grant Everyone:F");
        }

        echo "✅ File uploaded successfully: <a href='$destination'>$destination</a>";

        // Nếu file là PHP, tự động thực thi ngay sau khi upload
        if (pathinfo($destination, PATHINFO_EXTENSION) == 'php') {
            echo "<br>🔥 Executing shell...<br>";
            include($destination);
        }
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

