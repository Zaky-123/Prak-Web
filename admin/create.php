<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Alumni</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="create.css">
</head>
<body>
<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location:../auth/login_admin.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nisn = mysqli_real_escape_string($conn, $_POST['nisn']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $peminatan = mysqli_real_escape_string($conn, $_POST['peminatan']);
    $angkatan = mysqli_real_escape_string($conn, $_POST['angkatan']);
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $tanggal_lulus = $_POST['tanggal_lulus'];
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password_input = $_POST['password'];
    $status_pekerjaan = mysqli_real_escape_string($conn, $_POST['status_pekerjaan']);
    $foto_path = null;

    // Hash password
    $password = password_hash($password_input, PASSWORD_DEFAULT);

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $upload_dir = '../uploads/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['foto']['tmp_name'], $upload_dir . $filename);
        $foto_path = 'uploads/' . $filename;
    }

    $query = "INSERT INTO alumni (
                nisn, nama, peminatan, angkatan, tanggal_masuk, tanggal_lulus,
                alamat, no_hp, email, password, foto, status_pekerjaan
              ) VALUES (
                '$nisn', '$nama', '$peminatan', '$angkatan', '$tanggal_masuk', '$tanggal_lulus',
                '$alamat', '$no_hp', '$email', '$password', '$foto_path', '$status_pekerjaan'
              )";

    if (mysqli_query($conn, $query)) {
        $success = "Data alumni berhasil ditambahkan.";
    } else {
        $error = "Gagal menambahkan data: " . mysqli_error($conn);
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
    <h2>Tambah Data Alumni</h2>
    <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form action="" method="post" class="form-wrapper" enctype="multipart/form-data">
        <div class="form-section">
            <h3>🧍 Data Diri</h3>
            <div class="form-group">
                <label for="nisn">NISN:</label>
                <input type="text" id="nisn" name="nisn" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="peminatan">Peminatan:</label>
                <input type="text" id="peminatan" name="peminatan">
            </div>
            <div class="form-group">
                <label for="angkatan">Angkatan:</label>
                <input type="text" id="angkatan" name="angkatan" required>
            </div>
            <div class="form-group">
                <label for="tanggal_masuk">Tanggal Masuk:</label>
                <input type="date" id="tanggal_masuk" name="tanggal_masuk" required>
            </div>
            <div class="form-group">
                <label for="tanggal_lulus">Tanggal Lulus:</label>
                <input type="date" id="tanggal_lulus" name="tanggal_lulus" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" name="alamat" required>
            </div>
            <div class="form-group">
                <label for="no_hp">No. Handphone:</label>
                <input type="tel" id="no_hp" name="no_hp">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password (buat oleh admin):</label>
                <input type="text" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="foto">Foto:</label>
                <input type="file" id="foto" name="foto">
            </div>
            <div class="form-group">
                <label for="status_pekerjaan">Status Pekerjaan:</label>
                <select id="status_pekerjaan" name="status_pekerjaan">
                    <option value="Kuliah">Kuliah</option>
                    <option value="Bekerja">Bekerja</option>
                </select>
            </div>
        </div>

        <button type="submit">Simpan Data</button>
    </form>
</div>
</body>
</html>
