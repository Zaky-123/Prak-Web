<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['alumni_logged_in'])) {
    header('Location: ../auth/login_alumni.php');
    exit;
}

$nisn = $_SESSION['alumni_nisn'];

// Ambil revisi yang statusnya bukan pending
$query = "
SELECT field, nilai_baru, status, created_at 
FROM alumni_revisi 
WHERE alumni_id = '$nisn' AND status != 'pending' 
ORDER BY created_at DESC
LIMIT 5
";
$result = mysqli_query($conn, $query);
?>

<h3>Notifikasi Terbaru</h3>

<?php if (mysqli_num_rows($result) > 0): ?>
    <ul>
    <?php while ($notif = mysqli_fetch_assoc($result)) : ?>
        <li>
            Pengajuan perubahan <strong><?= htmlspecialchars($notif['field']) ?></strong> 
            ke <strong><?= htmlspecialchars($notif['nilai_baru']) ?></strong> 
            telah <strong><?= htmlspecialchars($notif['status']) ?></strong>
            (<?= date('d-m-Y H:i', strtotime($notif['created_at'])) ?>)
        </li>
    <?php endwhile; ?>
    </ul>
<?php else: ?>
    <p>Tidak ada notifikasi saat ini.</p>
<?php endif; ?>

<p><a href="../alumni/home.php">Kembali ke Home</a></p>
