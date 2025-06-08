<?php
session_start();

// Hapus semua data session
session_unset();
session_destroy();

// Redirect ke login (bisa disesuaikan mau ke login alumni atau admin)
header('Location: ../index.php');
exit;
?>
