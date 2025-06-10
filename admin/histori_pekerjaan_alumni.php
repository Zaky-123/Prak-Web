<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../auth/login_admin.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nisn = mysqli_real_escape_string($conn, $_POST['nisn']);
    $nama_perusahaan = mysqli_real_escape_string($conn, $_POST['nama_perusahaan']);
    $posisi = mysqli_real_escape_string($conn, $_POST['posisi']);
    $tanggal_mulai = $_POST['tanggal_mulai'];
    $tanggal_selesai = !empty($_POST['tanggal_selesai']) ? $_POST['tanggal_selesai'] : null;

    $query = "INSERT INTO histori_pekerjaan (alumni_id, nama_perusahaan, posisi, tanggal_mulai, tanggal_selesai)
              VALUES ('$nisn', '$nama_perusahaan', '$posisi', '$tanggal_mulai', " . 
              ($tanggal_selesai ? "'$tanggal_selesai'" : "NULL") . ")";

    if (mysqli_query($conn, $query)) {
        $success = "Histori pekerjaan berhasil disimpan.";
    } else {
        $error = "Gagal menyimpan histori pekerjaan: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Histori Pekerjaan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="histori_pekerjaan.css">
</head>
<body>

<div class="sidebar">
    <a href="#"><i class="fas fa-user-circle" style="font-size: 30px;"></i></a>
    <a href="dashboard_adm.php"><i class="fas fa-home"></i></a>
    <a href="create.php"><i class="fas fa-user-plus"></i></a>
    <a href="read.php"><i class="fas fa-list-ul"></i></a>
    <a href="persetujuan.php"><i class="fas fa-edit"></i></a>
    <a href="../auth/logout.php" class="out"><i class="fas fa-sign-out-alt"></i></a>
</div>

<div class="content">
    <h2>Tambah Histori Pekerjaan</h2>
    <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST" class="form-wrapper">
        <div class="form-section">
            <h3>📋 Data Alumni</h3>

            <div class="form-group">
                <label for="nisn">NISN Alumni:</label>
                <input type="text" id="nisn" name="nisn" required>
            </div>

            <h3>🏢 Informasi Pekerjaan</h3>

            <div class="form-group">
                <label for="nama_perusahaan">Nama Perusahaan:</label>
                <input type="text" id="nama_perusahaan" name="nama_perusahaan" required>
            </div>

            <div class="form-group">
                <label for="posisi">Posisi:</label>
                <input type="text" id="posisi" name="posisi" required>
            </div>

            <div class="form-group">
                <label for="tanggal_mulai">Tanggal Mulai:</label>
                <input type="date" id="tanggal_mulai" name="tanggal_mulai" required>
            </div>

            <div class="form-group">
                <label for="tanggal_selesai">Tanggal Selesai (opsional):</label>
                <input type="date" id="tanggal_selesai" name="tanggal_selesai">
            </div>
        </div>

        <button type="submit">Simpan Histori</button>
    </form>
                <footer class="footer">
                <a href="dashboard_adm.php">BACK</a>
            </footer>
</div>

</body>
</html>
