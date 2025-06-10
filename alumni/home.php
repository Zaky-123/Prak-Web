<?php
session_start();
require_once '../config/db.php';

// Pastikan alumni sudah login
if (!isset($_SESSION['alumni_logged_in'])) {
    header('Location:../auth/login_admin.php');
    exit;
}

$nisn = $_SESSION['alumni_nisn'];
$username = $_SESSION['alumni_nama'] ?? 'Alumni';

// Ambil input pencarian jika ada
$cari = $_GET['cari'] ?? '';
$cari_safe = mysqli_real_escape_string($conn, $cari);

// Query dasar alumni (tidak termasuk diri sendiri)
$query = "SELECT nisn, nama, status_pekerjaan FROM alumni WHERE nisn != '$nisn'";

// Jika ada pencarian, tambahkan kondisi pencarian
if (!empty($cari)) {
    $query .= " AND (nama LIKE '%$cari_safe%' OR nisn LIKE '%$cari_safe%' OR angkatan LIKE '%$cari_safe%')";
}

$result = mysqli_query($conn, $query);

$alumni_list = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $alumni_list[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="stylesheet" href="home.css" />
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
            <a href="home.php" class="active"><i class="fas fa-home"></i></a>
            <a href="pengajuan_update.php"><i class="fas fa-edit"></i></a>
            <a href="status_pengajuan.php"><i class="fas fa-clipboard-check"></i></a>
        </div>
        <div class="logout">
            <a href="../auth/logout.php"><i class="fas fa-sign-out-alt"></i></a>
        </div>
    </aside>

    <main class="main-content">
        <div class="header">
            <h2>Hai <?= htmlspecialchars($username) ?></h2>
            <h1>Insan Cendekia</h1>
        </div>

        <!-- Filter & Cari -->
        <div class="filter-section">
            <select>
                <option>Urutkan berdasarkan</option>
                <option>Mahasiswa Top 10 PTN</option>
                <option>Mahasiswa Perguruan Tinggi Luar Negeri</option>
                <option>Jalur Penerimaan SNBT</option>
                <option>Jalur Penerimaan SNBP</option>
            </select>

            <form method="GET" style="display: inline;">
                <input 
                    type="text" 
                    name="cari" 
                    placeholder="Cari..." 
                    value="<?= htmlspecialchars($cari) ?>"
                >
            </form>
        </div>

        <div class="list-alumni">
            <?php if (empty($alumni_list)): ?>
                <p>Tidak ada alumni ditemukan.</p>
            <?php else: ?>
                <?php foreach ($alumni_list as $alumni): ?>
                    <div class="alumni-item">
                        <span><?= htmlspecialchars($alumni['nama']) ?></span>
                        <div class="alumni-info">
                            <span class="status <?= strtolower($alumni['status_pekerjaan']) === 'kuliah' ? 'kuliah' : 'bekerja' ?>">
                                <?= ucfirst($alumni['status_pekerjaan']) ?>
                            </span>
                            <a href="detail_alumni.php?nisn=<?= $alumni['nisn'] ?>" class="lihat-link">Lihat</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>
</div>
</body>
</html>
