<?php
// File: readfile.php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

// Lỗi File Path Traversal: không làm sạch đầu vào từ GET 'file'
if (isset($_GET['file'])) {
    $requested_file = $_GET['file'];

    // Ghép đường dẫn với thư mục uploads
    $filepath = "uploads/" . $requested_file;

    // Kiểm tra file có tồn tại
    if (file_exists($filepath)) {
        // Hiển thị nội dung file (vulnerable vì không kiểm tra file path hợp lệ)
        echo "<pre>" . htmlspecialchars(file_get_contents($filepath)) . "</pre>";
    } else {
        echo "File không tồn tại: " . htmlspecialchars($requested_file);
    }
} else {
    echo "Vui lòng cung cấp tham số 'file' trong URL. Ví dụ: <code>readfile.php?file=test.txt</code>";
}
?>
