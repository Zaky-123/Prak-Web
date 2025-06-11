<?php
session_start();
require_once '../config/db.php';

// Pastikan alumni sudah login
if (!isset($_SESSION['alumni_logged_in'])) {
    header('Location: ../auth/login_admin.php');
    exit;
}

$nisn = $_SESSION['alumni_nisn'];
$success_message = "";
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $field = mysqli_real_escape_string($conn, $_POST['dataSelect']);
    $nilai_baru = mysqli_real_escape_string($conn, $_POST['newData']);
    $alasan = mysqli_real_escape_string($conn, $_POST['reason']);

    // Ambil nilai lama
    $allowed_alumni_fields = ['alamat', 'email', 'no_hp'];
    $histori_fields = ['pekerjaan', 'pendidikan'];

    // Validasi field yang dipilih
    if (in_array($field, $allowed_alumni_fields)) {
        $query = "SELECT `$field` FROM alumni WHERE nisn = '$nisn'";
        $result = mysqli_query($conn, $query);
        if ($result && $row = mysqli_fetch_assoc($result)) {
            $nilai_lama = $row[$field];
        } else {
            $error_message = "Gagal mengambil data lama dari alumni.";
        }
    } elseif ($field === 'pekerjaan') {
        $query = "SELECT nama_perusahaan, posisi, tanggal_mulai, tanggal_selesai 
                FROM histori_pekerjaan 
                WHERE alumni_id = '$nisn' 
                ORDER BY tanggal_mulai DESC 
                LIMIT 1";
        $result = mysqli_query($conn, $query);
        if ($result && $row = mysqli_fetch_assoc($result)) {
            $tgl_selesai = $row['tanggal_selesai'] ?? 'Sekarang';
            $nilai_lama = "{$row['nama_perusahaan']} - {$row['posisi']} ({$row['tanggal_mulai']} s.d. $tgl_selesai)";
        } else {
            $nilai_lama = 'Belum ada data';
        }
    } elseif ($field === 'pendidikan') {
        $query = "SELECT nama_institusi, jurusan, jenjang, tahun_masuk, tahun_lulus 
                FROM histori_pendidikan 
                WHERE alumni_id = '$nisn' 
                ORDER BY tahun_masuk DESC 
                LIMIT 1";
        $result = mysqli_query($conn, $query);
        if ($result && $row = mysqli_fetch_assoc($result)) {
            $tahun_lulus = $row['tahun_lulus'] ?? 'Sekarang';
            $nilai_lama = "{$row['jenjang']} - {$row['nama_institusi']} ({$row['jurusan']}) {$row['tahun_masuk']} - $tahun_lulus";
        } else {
            $nilai_lama = 'Belum ada data';
        }
    } else {
        $error_message = "Field tidak valid.";
    }

        if (empty($error_message)) {
            // Simpan data update ke tabel pengajuan
            $query = "INSERT INTO alumni_revisi (alumni_id, field, nilai_lama, nilai_baru, status, keterangan) 
                    VALUES ('$nisn', '$field', '$nilai_lama', '$nilai_baru', 'pending','$alasan')";
            if (mysqli_query($conn, $query)) {
                $success_message = "Pengajuan update berhasil dikirim.";
            } else {
                $error_message = "Gagal mengirim pengajuan: " . mysqli_error($conn);
            }
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>UPDATE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="stylesheet" href="pengajuan_update.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet"/>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="icon">
                <a href="profile.php"><i class="fas fa-user-circle"></i></a>
            </div>
            <div class="menu">
                <a href="home.php"><i class="fas fa-home"></i></a>
                <a href="pengajuan_update.php" class="active"><i class="fas fa-edit"></i></a>
                <a href="status_pengajuan.php"><i class="fas fa-clipboard-check"></i></a>
            </div>
            <div class="logout">
                <a href="../auth/logout.php"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </aside>

        <main class="main-content">
            <header class="header">
                <div class="form-header">
                    <h2>Form update data</h2>
                    <p>Silahkan pilih data yang ingin di update dan ajukan revisi kepada admin</p>
                </div>
                <h1>Insan Cendekia</h1>
            </header>

            <section class="profile-section">
                <?php if ($success_message): ?>
                    <p style="color: green;"><strong><?= $success_message ?></strong></p>
                <?php elseif ($error_message): ?>
                    <p style="color: red;"><strong><?= $error_message ?></strong></p>
                <?php endif; ?>

                <form action="" method="POST">
                    <div>
                        <label for="dataSelect">Data yang ingin diubah</label>
                        <select id="dataSelect" name="dataSelect" required>
                            <option value="">--Pilih data--</option>
                            <option value="alamat">Alamat</option>
                            <option value="email">Email</option>
                            <option value="no_hp">No Handphone</option>
                            <option value="pekerjaan">Pekerjaan</option>
                            <option value="pendidikan">Pendidikan</option>
                        </select>
                    </div>

                    <div>
                        <label for="newData">Data baru</label>
                        <input type="text" id="newData" name="newData" required />
                    </div>

                    <div>
                        <label for="reason">Alasan</label>
                        <textarea id="reason" name="reason" rows="4" required></textarea>
                    </div>

                    <div class="form-buttons">
                        <button type="submit">KIRIM</button>
                        <button type="reset">BATAL</button>
                    </div>
                </form>
            </section>

            <footer class="footer">
                <a href="home.php">BACK</a>
            </footer>
        </main>
    </div>
</body>
</html>
