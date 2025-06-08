<?php
session_start();
require_once '../config/db.php';

// Pastikan alumni sudah login
if (!isset($_SESSION['alumni_logged_in'])) {
    header('Location: ../index.php');
    exit;
}

$nisn = $_SESSION['alumni_nisn'];

// Ambil data alumni dari database
$query = "SELECT * FROM alumni WHERE nisn = '$nisn'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) === 1) {
    $alumni = mysqli_fetch_assoc($result);
} else {
    echo "Data alumni tidak ditemukan.";
    exit;
}
?>