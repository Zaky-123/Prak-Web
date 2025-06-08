<?php
session_start();
require_once '../config/db.php';

// Pastikan alumni sudah login
if (!isset($_SESSION['alumni_logged_in'])) {
    header('Location: ../index.php');
    exit;
}

$nisn = $_SESSION['alumni_nisn'];

// Ambil semua pengajuan perubahan oleh alumni ini
$query = "SELECT field, nilai_lama, nilai_baru, status, keterangan, created_at 
          FROM alumni_revisi 
          WHERE alumni_id = '$nisn' 
          ORDER BY created_at DESC";

$result = mysqli_query($conn, $query);
$pengajuan = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $pengajuan[] = $row;
    }
}
?>