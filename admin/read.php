<?php
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
if (!$result) {
    die('Query Error: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Alumni</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="read.css">
</head>
<body>
<div class="sidebar">
    <a href="#"><i class="fas fa-user-circle" style="font-size: 30px;"></i></a>
    <a href="dashboard_adm.php"><i class="fas fa-home"></i></a>
    <a href="create.php"><i class="fas fa-user-plus"></i></a>
    <div class="in"><i class="fas fa-list-ul"></i></div>
    <a href="persetujuan.php"><i class="fas fa-edit"></i></a>
    <div class="out"><a href="../auth/logout.php"><i class="fas fa-sign-out-alt"></i></a></div>
</div>

<div class="content">
    <h1>Data Alumni</h1>
    
    <form method="GET">
        <input type="text" name="q" placeholder="Cari berdasarkan NISN / Nama / Angkatan..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Cari</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NISN</th>
                <th>Nama</th>
                <th>Angkatan</th>
                <th>Email</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['nisn']) ?></td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= htmlspecialchars($row['angkatan']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['status_pekerjaan']) ?></td>
                    <td>
                        <a class="edit" href="update.php?nisn=<?= $row['nisn'] ?>">Edit</a>
                        <a class="hapus" href="delete.php?nisn=<?= $row['nisn'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
