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
            // Update field di tabel alumni
            $field = mysqli_real_escape_string($conn, $revisi['field']);
            $new_value = mysqli_real_escape_string($conn, $revisi['nilai_baru']);
            $alumni_id = mysqli_real_escape_string($conn, $revisi['alumni_id']);

            $update = "UPDATE alumni SET $field = '$new_value', status_update = 'approved' WHERE nisn = '$alumni_id'";
            mysqli_query($conn, $update);

            // Update status revisi
            mysqli_query($conn, "UPDATE alumni_revisi SET status = 'approved' WHERE id = $id");

        } elseif ($aksi === 'reject') {
            mysqli_query($conn, "UPDATE alumni_revisi SET status = 'rejected' WHERE id = $id");
        }
    }
}

// Ambil daftar permintaan revisi
$query = "
SELECT ar.*, a.nama 
FROM alumni_revisi ar
JOIN alumni a ON ar.alumni_id = a.nisn
ORDER BY ar.created_at DESC
";
$result = mysqli_query($conn, $query);
?>

<h2>Daftar Permintaan Revisi Data Alumni</h2>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Nama Alumni</th>
        <th>Field</th>
        <th>Nilai Lama</th>
        <th>Nilai Baru</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
    <tr>
        <td><?= htmlspecialchars($row['nama']) ?></td>
        <td><?= htmlspecialchars($row['field']) ?></td>
        <td><?= htmlspecialchars($row['nilai_lama']) ?></td>
        <td><?= htmlspecialchars($row['nilai_baru']) ?></td>
        <td><?= htmlspecialchars($row['status']) ?></td>
        <td>
            <?php if ($row['status'] === 'pending') : ?>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button type="submit" name="aksi" value="approve" onclick="return confirm('Setujui perubahan ini?')">Setujui</button>
                </form>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button type="submit" name="aksi" value="reject" onclick="return confirm('Tolak perubahan ini?')">Tolak</button>
                </form>
            <?php else : ?>
                Tidak ada aksi
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<p><a href="dashboard.php">Kembali ke Dashboard</a></p>
