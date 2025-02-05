<?php
$pdo = new PDO("mysql:host=localhost;dbname=test_db", "root", "password");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "✅ Kết nối MySQL thành công!";
?>
