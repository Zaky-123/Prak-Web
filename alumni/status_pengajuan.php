<?php
session_start();
require_once '../config/db.php';

// Pastikan alumni sudah login
if (!isset($_SESSION['alumni_logged_in'])) {
    header('Location:../auth/login_admin.php');
    exit;
}

$nisn = $_SESSION['alumni_nisn'];

// Ambil semua pengajuan perubahan oleh alumni ini
$query = "SELECT field, nilai_lama, nilai_baru, status, keterangan, created_at 
          FROM alumni_revisi 
          WHERE alumni_id = '$nisn' 
          ORDER BY created_at DESC";

$result = mysqli_query($conn, $query);
$pengajuan = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $pengajuan[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STATUS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="status pengajuan.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <div class="icon">
                <a href="profile.php"><i class="fas fa-user-circle"></i></a>
            </div>
            <div class="menu">
                <a href="home.php"><i class="fas fa-home"></i></a>
                <a href="pengajuan_update.php"><i class="fas fa-edit"></i></a>
                <a href="status_pengajuan.php" class="active"><i class="fas fa-clipboard-check"></i></a>
            </div>
            <div class="logout">
                <a href="login.php"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </aside>

        <main class="main-content">
            <div class="header">
                <h2>Status Pengajuan Update</h2>
                <h1>Insan Cendekia</h1>
            </div>

            <div class="list-alumni">
                <?php if (empty($pengajuan)) : ?>
                    <p style="margin-top: 50px; text-align: center;">Belum ada pengajuan perubahan data.</p>
                <?php else : ?>
                    <?php foreach ($pengajuan as $data) : ?>
                        <div class="alumni-item">
                            <span>Update <?= htmlspecialchars($data['field']) ?>: <b><?= htmlspecialchars($data['nilai_lama']) ?></b> → <b><?= htmlspecialchars($data['nilai_baru']) ?></b></span>

                            <?php
                            $statusClass = '';
                            if ($data['status'] == 'dalam_proses') $statusClass = 'dalam-proses';
                            elseif ($data['status'] == 'selesai') $statusClass = 'selesai';
                            elseif ($data['status'] == 'ditolak') $statusClass = 'ditolak';
                            ?>

                            <span class="status <?= $statusClass ?>"><?= ucwords(str_replace('_', ' ', $data['status'])) ?></span>
                            <span class="tanggal"><?= date('d M Y', strtotime($data['created_at'])) ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <footer class="footer">
                <a href="home.php">BACK</a>
            </footer>
        </main>
    </div>
</body>

</html>
