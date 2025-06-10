<?php
session_start();
require_once '../config/db.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location:../auth/login_admin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="dbadm.css">
</head>
<body>
    <div class="sidebar">
        <a href="#"><i class="fas fa-user-circle" style="font-size: 30px;"></i></a>
        <div class="in"><i class="fas fa-home"></i></div>
        <a href="create.php"><i class="fas fa-user-plus"></i></a>
        <a href="read.php"><i class="fas fa-list-ul"></i></a>
        <a href="persetujuan.php"><i class="fas fa-edit"></i></a>
        <div class="out"><a href="../auth/logout.php"><i class="fas fa-sign-out-alt"></i></a></div>
    </div>

    <div class="main-content">
        <h1>Dashboard Admin</h1>

        <div class="card-container">
            <div class="card">
                <h2>Data Alumni</h2>
                <p>Tambahkan data alumni</p>
                <button onclick="location.href='create.php'">Tambah Data Alumni</button>
                <button onclick="location.href='histori_pendidikan_alumni.php'">Tambah Data Pendidikan Alumni</button>
                <button onclick="location.href='histori_pekerjaan_alumni.php'">Tambah Data Pekerjaan Alumni</button>
            </div>

            <div class="card">
                <h2>Pengajuan Revisi Data</h2>
                <p>Tinjau Revisi dari alumni dan setuju atau tolak</p>
                <button onclick="location.href='persetujuan.php'">Daftar Revisi</button>
            </div>

            <div class="card full">
                <h2>Cari data Alumni</h2>
                <p>Melihat dan Mencari data dari alumni berdasarkan NISN</p>
                <button onclick="location.href='read.php'">Cari NISN/Nama</button>
                <button onclick="location.href='read.php'">Lihat & Edit</button>
            </div>
        </div>
    </div>
</body>
</html>
