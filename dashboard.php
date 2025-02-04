<?php
// File: dashboard.php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
<h2>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h2>
<ul>
    <li><a href="upload.php">Upload File</a></li>
    <li><a href="readfile.php">Read File</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>
</body>
</html>
