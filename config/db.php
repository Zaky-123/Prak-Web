<?php
$host = "localhost";
$user = "root";         // ganti jika bukan root
$pass = "";             // ganti sesuai password MySQL kamu
$db   = "db_alumni";    // ganti dengan nama database kamu

$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>