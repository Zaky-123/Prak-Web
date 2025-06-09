<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login_admin.php');
    exit;
}

if (!isset($_GET['nisn'])) {
    echo "NISN tidak ditemukan.";
    exit;
}

$nisn = mysqli_real_escape_string($conn, $_GET['nisn']);
$query = "SELECT * FROM alumni WHERE nisn = '$nisn'";
$result = mysqli_query($conn, $query);
$alumni = mysqli_fetch_assoc($result);

if (!$alumni) {
    echo "Data alumni tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $peminatan = mysqli_real_escape_string($conn, $_POST['peminatan']);
    $angkatan = mysqli_real_escape_string($conn, $_POST['angkatan']);
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $tanggal_lulus = $_POST['tanggal_lulus'];
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $status_pekerjaan = mysqli_real_escape_string($conn, $_POST['status_pekerjaan']);

    // Foto upload
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $upload_dir = '../uploads/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['foto']['tmp_name'], $upload_dir . $filename);
        $foto_path = 'uploads/' . $filename;
    } else {
        $foto_path = $alumni['foto'];
    }

    $update = "UPDATE alumni SET
        nama = '$nama',
        peminatan = '$peminatan',
        angkatan = '$angkatan',
        tanggal_masuk = '$tanggal_masuk',
        tanggal_lulus = '$tanggal_lulus',
        alamat = '$alamat',
        no_hp = '$no_hp',
        email = '$email',
        password = '{$alumni['password']}', 
        status_pekerjaan = '$status_pekerjaan',
        foto = '$foto_path'
        WHERE nisn = '$nisn'";

    if (mysqli_query($conn, $update)) {
        $success = "Data berhasil diupdate.";
        $result = mysqli_query($conn, "SELECT * FROM alumni WHERE nisn = '$nisn'");
        $alumni = mysqli_fetch_assoc($result);
    } else {
        $error = "Gagal mengupdate data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Alumni</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="update.css">
</head>
<body>
<div class="sidebar">
    <a href="#"><i class="fas fa-user-circle" style="font-size: 30px;"></i></a>
    <a href="dashboard_adm.php"><i class="fas fa-home"></i></a>
    <div class="in"><i class="fas fa-user-edit"></i></div>
    <a href="read.php"><i class="fas fa-list-ul"></i></a>
    <a href="persetujuan.php"><i class="fas fa-edit"></i></a>
    <div class="out"><a href="../auth/logout.php"><i class="fas fa-sign-out-alt"></i></a></div>
</div>

<div class="content">
    <h2>Edit Data Alumni</h2>

    <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form action="" method="POST" enctype="multipart/form-data" class="form-wrapper">
        <input type="hidden" name="nisn" value="<?= htmlspecialchars($alumni['nisn']) ?>">

        <div class="form-section">
            <h3>🧍 Data Diri</h3>
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" name="nama" value="<?= htmlspecialchars($alumni['nama']) ?>" required>
            </div>
            <div class="form-group">
                <label>Peminatan:</label>
                <input type="text" name="peminatan" value="<?= htmlspecialchars($alumni['peminatan']) ?>">
            </div>
            <div class="form-group">
                <label>Angkatan:</label>
                <input type="text" name="angkatan" value="<?= htmlspecialchars($alumni['angkatan']) ?>" required>
            </div>
            <div class="form-group">
                <label>Tanggal Masuk:</label>
                <input type="date" name="tanggal_masuk" value="<?= $alumni['tanggal_masuk'] ?>">
            </div>
            <div class="form-group">
                <label>Tanggal Lulus:</label>
                <input type="date" name="tanggal_lulus" value="<?= $alumni['tanggal_lulus'] ?>">
            </div>
            <div class="form-group">
                <label>Alamat:</label>
                <input type="text" name="alamat" value="<?= htmlspecialchars($alumni['alamat']) ?>">
            </div>
            <div class="form-group">
                <label>No. Handphone:</label>
                <input type="tel" name="no_hp" value="<?= htmlspecialchars($alumni['no_hp']) ?>">
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($alumni['email']) ?>" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah">
            <div class="form-group">
                <label>Status Pekerjaan:</label>
                <select name="status_pekerjaan">
                    <option value="Kuliah" <?= $alumni['status_pekerjaan'] == 'Kuliah' ? 'selected' : '' ?>>Kuliah</option>
                    <option value="Bekerja" <?= $alumni['status_pekerjaan'] == 'Bekerja' ? 'selected' : '' ?>>Bekerja</option>
                </select>
            </div>
            <div class="form-group">
                <label>Foto:</label>
                <input type="file" name="foto">
                <p>Foto lama: <?= $alumni['foto'] ?></p>
            </div>
        </div>

        <button type="submit">Simpan Perubahan</button>
    </form>

    <p><a href="read_alumni.php">⬅️ Kembali ke Data Alumni</a></p>
</div>
</body>
</html>
