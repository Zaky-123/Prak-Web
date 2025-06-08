<?php
$result = mysqli_query($conn, $query);
if (!$result) {
    die('Query Error: ' . mysqli_error($conn));
}

session_start();
require_once '../config/db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login_admin.php');
    exit;
}

$search = '';
if (isset($_GET['q'])) {
    $search = mysqli_real_escape_string($conn, $_GET['q']);
    $query = "SELECT * FROM alumni 
              WHERE nama LIKE '%$search%' 
              OR nisn LIKE '%$search%' 
              OR angkatan LIKE '%$search%' 
              ORDER BY nama ASC";
} else {
    $query = "SELECT * FROM alumni ORDER BY nama ASC";
}

$result = mysqli_query($conn, $query);
?>

<h2>Data Alumni</h2>

<form method="GET">
    <input type="text" name="q" placeholder="Cari nama/NISN/angkatan..." value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Cari</button>
</form>

<br>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>NISN</th>
        <th>Nama</th>
        <th>Angkatan</th>
        <th>Email</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= htmlspecialchars($row['nisn']) ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['angkatan']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['status_pekerjaan']) ?></td>
            <td>
                <a href="update_alumni.php?nisn=<?= $row['nisn'] ?>">Edit</a> |
                <a href="delete_alumni.php?nisn=<?= $row['nisn'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<p><a href="dashboard.php">Kembali ke Dashboard</a></p>
