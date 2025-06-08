<?php
session_start();
require_once '../config/db.php';

// Pastikan alumni sudah login
if (!isset($_SESSION['alumni_logged_in'])) {
    header('Location: ../index.php');
    exit;
}

// Cek apakah ada NISN di URL
if (!isset($_GET['nisn'])) {
    echo "Alumni tidak ditemukan.";
    exit;
}

$nisn = mysqli_real_escape_string($conn, $_GET['nisn']);

// Ambil data utama alumni
$query = "SELECT * FROM alumni WHERE nisn = '$nisn'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) !== 1) {
    echo "Data alumni tidak ditemukan.";
    exit;
}

$alumni = mysqli_fetch_assoc($result);

// Ambil histori pekerjaan
$q1 = "SELECT * FROM histori_pekerjaan WHERE alumni_id = '$nisn'";
$res1 = mysqli_query($conn, $q1);
$pekerjaan = mysqli_fetch_all($res1, MYSQLI_ASSOC);

// Ambil histori pendidikan
$q2 = "SELECT * FROM histori_pendidikan WHERE alumni_id = '$nisn'";
$res2 = mysqli_query($conn, $q2);
$pendidikan = mysqli_fetch_all($res2, MYSQLI_ASSOC);
?>

