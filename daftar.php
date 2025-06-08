<?php
$conn = new mysqli("localhost", "root", "", "revisi");

$query = "SELECT * FROM pengajuan";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pengajuan Revisi Data Alumni</title>
  <link rel="stylesheet" href="daftar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<div class="sidebar">
        <a href="#"><i class="fas fa-user-circle" style="font-size: 30px;"></i></a>
        <a href="dbadm.php"><i class="fas fa-home"></i></a>
        <a href="tambah.php"><i class="fas fa-user-plus"></i></a>
        <a href="data.php"><i class="fas fa-list-ul"></i></a>
        <div class="in"><i class="fas fa-edit"></i></div>
        <div class="out"><i class="fas fa-sign-out-alt"></i></div>
</div>
<div class="content">
    <h1>Pengajuan Revisi Data Alumni</h1>

    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="card">
        <p><strong>Nama:</strong> <?= htmlspecialchars($row['nama']) ?></p>
        <p><strong>NISN:</strong> <?= htmlspecialchars($row['nisn']) ?></p>
        <p><strong>Data Lama:</strong> <?= htmlspecialchars($row['data_lama']) ?></p>
        <p><strong>Data Baru:</strong> <?= htmlspecialchars($row['data_baru']) ?></p>
            <button class="btn btn-accept">Setujui</button>
            <button class="btn btn-reject">Tolak</button>
      </div>
    <?php endwhile; ?>   
</div>
</body>
</html>
