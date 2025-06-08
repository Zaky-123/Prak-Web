<?php
session_start();
require_once '../config/db.php';

// Pastikan alumni sudah login
if (!isset($_SESSION['alumni_logged_in'])) {
    header('Location: ../index.php');
    exit;
}

$nisn = $_SESSION['alumni_nisn'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $field = mysqli_real_escape_string($conn, $_POST['field']);
    $nilai_baru = mysqli_real_escape_string($conn, $_POST['nilai_baru']);

    // Ambil nilai lama
    $query = "SELECT `$field` FROM alumni WHERE nisn = '$nisn'";
    $result = mysqli_query($conn, $query);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        $nilai_lama = $row[$field];

        // Insert ke alumni_revisi
        $insert = "INSERT INTO alumni_revisi (alumni_id, field, nilai_lama, nilai_baru, status) 
                   VALUES ('$nisn', '$field', '$nilai_lama', '$nilai_baru', 'pending')";
        if (mysqli_query($conn, $insert)) {
            echo "Permintaan perubahan berhasil diajukan.";
        } else {
            echo "Gagal mengajukan perubahan.";
        }
    } else {
        echo "Field tidak valid.";
    }
}
?>