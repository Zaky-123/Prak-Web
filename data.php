<?php
$conn = new mysqli("localhost", "root", "", "dataalumni");
$data = $conn->query("SELECT * FROM alumni");
?>

<html>
<head>
    <title>Data Alumni</title>
    <link rel="stylesheet" href="data.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<div class="sidebar">
        <a href="#"><i class="fas fa-user-circle" style="font-size: 30px;"></i></a>
        <a href="dbadm.php"><i class="fas fa-home"></i></a>
        <a href="tambah.php"><i class="fas fa-user-plus"></i></a>
        <div class="in"><i class="fas fa-list-ul"></i></div>
        <a href="daftar.php"><i class="fas fa-edit"></i></a>
        <div class="out"><i class="fas fa-sign-out-alt"></i></div>
</div>

<div class="content">
    <h1>Data Alumni</h1>
    <input type="text" placeholder="Cari Berdasarkan NISN/Nama">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NISN</th>
                <th>Tahun Lulus</th>
                <th>Jurusan</th>
                <th>Status</th>
                <th>Email</th>
                <th style="text">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; while($row = $data->fetch_assoc()): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['nisn'] ?></td>
                <td><?= $row['tahun_lulus'] ?></td>
                <td><?= $row['jurusan'] ?></td>
                <td><?= $row['status'] ?></td>
                <td><?= $row['email'] ?></td>
                <td>
                    <button style="background-color: yellow;">Edit</button>
                    <button style="background-color: red; color: white;" >Hapus</button>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
