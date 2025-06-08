<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login_admin.php');
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
    $no_hp = mysqli_real_escape_string($conn, $_POST['no_handphone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $status_pekerjaan = mysqli_real_escape_string($conn, $_POST['status_pekerjaan']);
    $foto_path = null;

    // Upload foto jika ada
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
                alamat, no_handphone, email, foto, status_pekerjaan
              ) VALUES (
                '$nisn', '$nama', '$peminatan', '$angkatan', '$tanggal_masuk', '$tanggal_lulus',
                '$alamat', '$no_hp', '$email', '$foto_path', '$status_pekerjaan'
              )";

    if (mysqli_query($conn, $query)) {
        $success = "Data alumni berhasil ditambahkan.";
    } else {
        $error = "Gagal menambahkan data: " . mysqli_error($conn);
    }
}
?>

<h2>Tambah Data Alumni</h2>

<?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="POST" enctype="multipart/form-data">
    NISN: <input type="text" name="nisn" required><br><br>
    Nama: <input type="text" name="nama" required><br><br>
    Peminatan: <input type="text" name="peminatan"><br><br>
    Angkatan: <input type="text" name="angkatan" required><br><br>
    Tanggal Masuk: <input type="date" name="tanggal_masuk" required><br><br>
    Tanggal Lulus: <input type="date" name="tanggal_lulus" required><br><br>
    Alamat: <textarea name="alamat" required></textarea><br><br>
    No HP: <input type="text" name="no_handphone"><br><br>
    Email: <input type="email" name="email" required><br><br>
    Foto: <input type="file" name="foto"><br><br>
    Status Pekerjaan:
    <select name="status_pekerjaan">
        <option value="Kuliah">Kuliah</option>
        <option value="Bekerja">Bekerja</option>
    </select><br><br>

    <button type="submit">Simpan</button>
</form>

<p><a href="dashboard.php">Kembali ke Dashboard</a></p>
