<?php
session_start();
require_once '../config/db.php';

// Pastikan alumni sudah login
if (!isset($_SESSION['alumni_logged_in'])) {
    header('Location: ../auth/login_admin.php');
    exit;
}

$nisn = $_SESSION['alumni_nisn'];

// Ambil data alumni
$query = "SELECT * FROM alumni WHERE nisn = '$nisn'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) !== 1) {
    echo "Data alumni tidak ditemukan.";
    exit;
}

$alumni = mysqli_fetch_assoc($result);

// Ambil histori pekerjaan
$q1 = "SELECT * FROM histori_pekerjaan WHERE alumni_id = '$nisn'";
$res1 = mysqli_query($conn, $q1);
$pekerjaan = mysqli_fetch_all($res1, MYSQLI_ASSOC);

// Ambil histori pendidikan
$q2 = "SELECT * FROM histori_pendidikan WHERE alumni_id = '$nisn'";
$res2 = mysqli_query($conn, $q2);
$pendidikan = mysqli_fetch_all($res2, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>PROFILE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="profile.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet"/>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="icon">
                <a href="profile.php" class="active"><i class="fas fa-user-circle"></i></a>
            </div>
            <div class="menu">
                <a href="home.php"><i class="fas fa-home"></i></a>
                <a href="pengajuan_update.php"><i class="fas fa-edit"></i></a>
                <a href="status_pengajuan.php"><i class="fas fa-clipboard-check"></i></a>
            </div>
            <div class="logout">
                <a href="../auth/logout.php"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </aside>

        <main class="main-content">
            <header class="header">
                <div class="avatar"></div>
                <h2><?= htmlspecialchars($alumni['nama']) ?></h2>
                <h1>Insan Cendekia</h1>
            </header>

            <section class="profile-section">
                <div class="profile-info">
                    <p><strong>NISN:</strong> <?= htmlspecialchars($alumni['nisn']) ?></p>
                    <p><strong>PEMINATAN:</strong> <?= htmlspecialchars($alumni['peminatan']) ?></p>
                    <p><strong>ANGKATAN:</strong> <?= htmlspecialchars($alumni['angkatan']) ?></p>
                    <p><strong>TANGGAL MASUK:</strong> <?= htmlspecialchars($alumni['tanggal_masuk']) ?></p>
                    <p><strong>TANGGAL LULUS:</strong> <?= htmlspecialchars($alumni['tanggal_lulus']) ?></p>
                    <p><strong>ALAMAT:</strong> <?= htmlspecialchars($alumni['alamat']) ?></p>
                    <p><strong>NO HANDPHONE:</strong> <?= htmlspecialchars($alumni['no_hp']) ?></p>
                    <p><strong>E-MAIL:</strong> <?= htmlspecialchars($alumni['email']) ?></p>
                </div>

                <!-- Riwayat Pekerjaan dan Pendidikan -->
                <div class="career-section">
                    <div class="career-card">
                        <h3>Riwayat Pekerjaan</h3>
                        <ul>
                            <?php if (!empty($pekerjaan)): ?>
                                <?php foreach ($pekerjaan as $p): ?>
                                    <li><?= htmlspecialchars($p['nama_perusahaan']) ?> - <?= htmlspecialchars($p['posisi']) ?> (<?= htmlspecialchars($p['tanggal_mulai']) ?>)</li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li>Belum ada riwayat pekerjaan</li>
                            <?php endif; ?>
                        </ul>
                        <button onclick="location.href='pengajuan_update.php'">Tambah Riwayat Pekerjaan</button>
                    </div>

                    <div class="career-card">
                        <h3>Riwayat Pendidikan</h3>
                        <ul>
                            <?php if (!empty($pendidikan)): ?>
                                <?php foreach ($pendidikan as $p): ?>
                                    <li><?= htmlspecialchars($p['nama_institusi']) ?> - <?= htmlspecialchars($p['jenjang']) ?> (<?= htmlspecialchars($p['tahun_masuk']) ?> - <?= htmlspecialchars($p['tahun_lulus']) ?>)</li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li>Belum ada riwayat pendidikan</li>
                            <?php endif; ?>
                        </ul>
                        <button onclick="location.href='pengajuan_update.php'">Tambah Riwayat Pendidikan</button>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
