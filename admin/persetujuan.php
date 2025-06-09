<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login_admin.php');
    exit;
}

// Proses persetujuan atau penolakan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aksi'])) {
    $id = (int) $_POST['id'];
    $aksi = $_POST['aksi'];

    $query = "SELECT * FROM alumni_revisi WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $revisi = mysqli_fetch_assoc($result);

    if ($revisi && $revisi['status'] === 'pending') {
        if ($aksi === 'approve') {
            $field = mysqli_real_escape_string($conn, $revisi['field']);
            $new_value = mysqli_real_escape_string($conn, $revisi['nilai_baru']);
            $alumni_id = mysqli_real_escape_string($conn, $revisi['alumni_id']);

            mysqli_query($conn, "UPDATE alumni SET $field = '$new_value', status_update = 'approved' WHERE nisn = '$alumni_id'");
            mysqli_query($conn, "UPDATE alumni_revisi SET status = 'approved' WHERE id = $id");

        } elseif ($aksi === 'reject') {
            mysqli_query($conn, "UPDATE alumni_revisi SET status = 'rejected' WHERE id = $id");
        }
    }
}

$query = "
SELECT ar.*, a.nama 
FROM alumni_revisi ar
JOIN alumni a ON ar.alumni_id = a.nisn
ORDER BY ar.created_at DESC
";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengajuan Revisi Data Alumni</title>
    <link rel="stylesheet" href="persetujuan.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<div class="sidebar">
    <a href="#"><i class="fas fa-user-circle" style="font-size: 30px;"></i></a>
    <a href="dashboard_adm.php"><i class="fas fa-home"></i></a>
    <a href="create.php"><i class="fas fa-user-plus"></i></a>
    <a href="read.php"><i class="fas fa-list-ul"></i></a>
    <div class="in"><i class="fas fa-edit"></i></div>
    <div class="out"><i class="fas fa-sign-out-alt"></i></div>
</div>

<div class="content">
    <h1>Pengajuan Revisi Data Alumni</h1>

    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <div class="card">
            <p><strong>Nama:</strong> <?= htmlspecialchars($row['nama']) ?></p>
            <p><strong>Field:</strong> <?= htmlspecialchars($row['field']) ?></p>
            <p><strong>Nilai Lama:</strong> <?= htmlspecialchars($row['nilai_lama']) ?></p>
            <p><strong>Nilai Baru:</strong> <?= htmlspecialchars($row['nilai_baru']) ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($row['status']) ?></p>
            <?php if ($row['status'] === 'pending') : ?>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button type="submit" name="aksi" value="approve" class="btn-accept" onclick="return confirm('Setujui perubahan ini?')">Setujui</button>
                </form>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button type="submit" name="aksi" value="reject" class="btn-reject" onclick="return confirm('Tolak perubahan ini?')">Tolak</button>
                </form>
            <?php else : ?>
                <p><em>Tidak ada aksi</em></p>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
</div>
</body>
</html>
