<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="dbadm.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    < class="sidebar">
        <a href="#"><i class="fas fa-user-circle" style="font-size: 30px;"></i></a>
        <div class="in"><i class="fas fa-home"></i></div>
        <a href="tambah.php"><i class="fas fa-user-plus"></i></a>
        <a href="data.php"><i class="fas fa-list-ul"></i></a>
        <a href="daftar.php"><i class="fas fa-edit"></i></a>
        <div class="out"><i class="fas fa-sign-out-alt"></i></div>
    </div>

    <div class="main-content">
        <h1>Dashboard Admin</h1>

        <div class="card-container">
            <div class="card">
                <h2>Data Alumni</h2>
                <p>Tambahkan data alumni</p>
                <button>Tambah Alumni</button>
            </div>

            <div class="card">
                <h2>Pengajuan Revisi Data</h2>
                <p>Tinjau Revisi dari alumni dan setuju atau tolak</p>
                <button>Daftar Revisi</button>
            </div>

            <div class="card full">
                <h2>Cari data Alumni</h2>
                <p>Melihat dan Mencari data dari alumni berdasarkan NISN</p>
                <button>Cari NISN/Nama</button>
                <button>Lihat & Edit</button>
            </div>
        </div>
    </div>
</body>
</html>
