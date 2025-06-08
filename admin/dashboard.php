<?php
session_start();
require_once '../config/db.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login_admin.php');
    exit;
}
?>