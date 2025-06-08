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
    $no_hp = mysqli_real_escape_string($conn, $_POST['no_handphone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $status_pekerjaan = mysqli_real_escape_string($conn, $_POST['status_pekerjaan']);

    // Cek jika foto diunggah
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
        no_handphone = '$no_hp',
        email = '$email',
        status_pekerjaan = '$status_pekerjaan',
        foto = '$foto_path'
        WHERE nisn = '$nisn'";

    if (mysqli_query($conn, $update)) {
        $success = "Data berhasil diupdate.";
        // Refresh data
        $result = mysqli_query($conn, "SELECT * FROM alumni WHERE nisn = '$nisn'");
        $alumni = mysqli_fetch_assoc($result);
    } else {
        $error = "Gagal mengupdate data: " . mysqli_error($conn);
    }
}
?>

<h2>Edit Data Alumni</h2>

<?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="POST" enctype="multipart/form-data">
    Nama: <input type="text" name="nama" value="<?= htmlspecialchars($alumni['nama']) ?>" required><br><br>
    Peminatan: <input type="text" name="peminatan" value="<?= htmlspecialchars($alumni['peminatan']) ?>"><br><br>
    Angkatan: <input type="text" name="angkatan" value="<?= htmlspecialchars($alumni['angkatan']) ?>" required><br><br>
    Tanggal Masuk: <input type="date" name="tanggal_masuk" value="<?= $alumni['tanggal_masuk'] ?>" required><br><br>
    Tanggal Lulus: <input type="date" name="tanggal_lulus" value="<?= $alumni['tanggal_lulus'] ?>" required><br><br>
    Alamat: <textarea name="alamat"><?= htmlspecialchars($alumni['alamat']) ?></textarea><br><br>
    No HP: <input type="text" name="no_handphone" value="<?= htmlspecialchars($alumni['no_handphone']) ?>"><br><br>
    Email: <input type="email" name="email" value="<?= htmlspecialchars($alumni['email']) ?>" required><br><br>
    Status Pekerjaan:
    <select name="status_pekerjaan">
        <option value="Kuliah" <?= $alumni['status_pekerjaan'] == 'Kuliah' ? 'selected' : '' ?>>Kuliah</option>
        <option value="Bekerja" <?= $alumni['status_pekerjaan'] == 'Bekerja' ? 'selected' : '' ?>>Bekerja</option>
    </select><br><br>
    Foto: <input type="file" name="foto"><br>
    (foto lama: <?= $alumni['foto'] ?>)<br><br>

    <button type="submit">Simpan Perubahan</button>
</form>

<p><a href="read_alumni.php">Kembali ke Data Alumni</a></p>
