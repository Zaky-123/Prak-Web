<?php
session_start();
require_once '../config/db.php';

// Pastikan alumni sudah login
if (!isset($_SESSION['alumni_logged_in'])) {
    header('Location: ../index.php');
    exit;
}

$nisn = $_SESSION['alumni_nisn'];

// Ambil daftar alumni lain
$query = "SELECT nisn, nama, angkatan, foto FROM alumni WHERE nisn != '$nisn'";
$result = mysqli_query($conn, $query);

$alumni_list = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $alumni_list[] = $row;
    }
}
?>


