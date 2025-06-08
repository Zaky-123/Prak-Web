<?php
session_start();

// Cek apakah user sudah login
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: admin/dashboard.php");
    exit;
} elseif (isset($_SESSION['alumni_logged_in'])) {
    header("Location: alumni/home.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Informasi Alumni</title>
</head>
<body>
    <h2>Selamat Datang di Sistem Informasi Alumni</h2>
    <p>Silakan login sebagai:</p>
    <ul>
        <li><a href="auth/login_alumni.php">Login Alumni</a></li>
        <li><a href="auth/login_admin.php">Login Admin</a></li>
    </ul>
</body>
</html>
