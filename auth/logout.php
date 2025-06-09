<?php
session_start();

// Hapus semua data session
session_unset();
session_destroy();

// Redirect ke login (bisa disesuaikan mau ke login alumni atau admin)
header('Location: ../auth/login_alumni.php'); // Ganti dengan 'login_admin.php' jika ingin redirect ke login admin
exit;
?>
