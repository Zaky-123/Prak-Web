<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Alumni dan Histori Pendidikan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="create.css">
    <style>
        .footer {
            margin-top: auto;
            padding: 10px 20px;
            text-align: right;
        }

        .footer a {
            color: black;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location:../auth/login_admin.php');
    exit;
}

$success = $error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil dan bersihkan input
    $nisn = mysqli_real_escape_string($conn, $_POST['nisn']);
    $nama_institusi = mysqli_real_escape_string($conn, $_POST['nama_institusi']);
    $jurusan = mysqli_real_escape_string($conn, $_POST['jurusan']);
    $jenjang = mysqli_real_escape_string($conn, $_POST['jenjang']);
    $tahun_masuk = intval($_POST['tahun_masuk_pend']);
    $tahun_lulus = intval($_POST['tahun_lulus_pend']);

    // Cek apakah NISN ada di tabel alumni
    $cek_alumni = "SELECT * FROM alumni WHERE nisn = '$nisn'";
    $result = mysqli_query($conn, $cek_alumni);

    if (mysqli_num_rows($result) > 0) {
        // Simpan histori pendidikan
        $query_histori = "INSERT INTO histori_pendidikan (alumni_id, nama_institusi, jurusan, jenjang, tahun_masuk, tahun_lulus)
                          VALUES ('$nisn', '$nama_institusi', '$jurusan', '$jenjang', $tahun_masuk, $tahun_lulus)";

        if (mysqli_query($conn, $query_histori)) {
            $success = "Histori pendidikan berhasil ditambahkan.";
        } else {
            $error = "Gagal menyimpan histori pendidikan: " . mysqli_error($conn);
        }
    } else {
        $error = "NISN tidak ditemukan dalam data alumni.";
    }
}
?>

<div class="sidebar">
    <a href="#"><i class="fas fa-user-circle" style="font-size: 30px;"></i></a>
    <a href="dashboard_adm.php"><i class="fas fa-home"></i></a>
    <div class="in"><i class="fas fa-user-plus"></i></div>
    <a href="read.php"><i class="fas fa-list-ul"></i></a>
    <a href="persetujuan.php"><i class="fas fa-edit"></i></a>
    <a href="../auth/logout.php" class="out"><i class="fas fa-sign-out-alt"></i></a>
</div>

<div class="content">
    <h2>Tambah Histori Pendidikan</h2>
    <?php if ($success) echo "<p style='color:green;'>$success</p>"; ?>
    <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>

    <form action="" method="post" class="form-wrapper" enctype="multipart/form-data">      
        <div class="form-section">
             <h3>📋 Data Alumni</h3>

            <div class="form-group">
                <label for="nisn">NISN Alumni:</label>
                <input type="text" id="nisn" name="nisn" required>
            </div>
            <h3>🎓 Histori Pendidikan</h3>
            <div class="form-group">
                <label for="nama_institusi">Nama Institusi:</label>
                <input type="text" id="nama_institusi" name="nama_institusi" required>
            </div>
            <div class="form-group">
                <label for="jurusan">Jurusan:</label>
                <input type="text" id="jurusan" name="jurusan" required>
            </div>
            <div class="form-group">
                <label for="jenjang">Jenjang:</label>
                <input type="text" id="jenjang" name="jenjang" required>
            </div>
            <div class="form-group">
                <label for="tahun_masuk_pend">Tahun Masuk:</label>
                <input type="number" id="tahun_masuk_pend" name="tahun_masuk_pend" required>
            </div>
            <div class="form-group">
                <label for="tahun_lulus_pend">Tahun Lulus:</label>
                <input type="number" id="tahun_lulus_pend" name="tahun_lulus_pend" required>
            </div>
        </div>

        <button type="submit">Simpan Data</button>
    </form>
            <footer class="footer">
                <a href="dashboard_adm.php">BACK</a>
            </footer>
</div>
</body>
</html>