<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login_admin.php');
    exit;
}

if (!isset($_GET['nisn'])) {
    echo "NISN tidak ditemukan.";
    exit;
}

$nisn = mysqli_real_escape_string($conn, $_GET['nisn']);

// Hapus data alumni dan relasi terkait (jika ada ON DELETE CASCADE di DB sudah cukup)
$query = "DELETE FROM alumni WHERE nisn = '$nisn'";

if (mysqli_query($conn, $query)) {
    header('Location: read.php?msg=deleted');
    exit;
} else {
    echo "Gagal menghapus data: " . mysqli_error($conn);
}
