<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Alumni</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="tambah.css">
</head>
<body>
    <div class="sidebar">
        <a href="#"><i class="fas fa-user-circle" style="font-size: 30px;"></i></a>
        <a href="dbadm.php"><i class="fas fa-home"></i></a>
        <div class="in"><i class="fas fa-user-plus"></i></div>
        <a href="data.php"><i class="fas fa-list-ul"></i></a>
        <a href="daftar.php"><i class="fas fa-edit"></i></a>
        <div class="out"><i class="fas fa-sign-out-alt"></i></div>
    </div>

    <div class="content">
        <h2>Tambah Data Alumni</h2>
        <form action="simpan_alumni.php" method="post" class="form-wrapper">
            <div class="form-section">
                <h3>🧍 Data Diri</h3>
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="nisn">NISN:</label>
                    <input type="text" id="nisn" name="nisn" required>
                </div>
                <div class="form-group">
                    <label for="peminatan">Peminatan:</label>
                    <input type="text" id="peminatan" name="peminatan">
                </div>
                <div class="form-group">
                    <label for="tgl_masuk">Tanggal Masuk:</label>
                    <input type="date" id="tgl_masuk" name="tgl_masuk">
                </div>
                <div class="form-group">
                    <label for="tgl_lulus">Tanggal Lulus:</label>
                    <input type="date" id="tgl_lulus" name="tgl_lulus">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" id="alamat" name="alamat">
                </div>
                <div class="form-group">
                    <label for="hp">No. Handphone:</label>
                    <input type="tel" id="hp" name="hp">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email">
                </div>
            </div>

            <div class="form-section">
                <h3>🎓 Riwayat Pendidikan</h3>
                <div class="form-group">
                    <label for="jenjang">Jenjang:</label>
                    <input type="text" id="jenjang" name="jenjang">
                </div>
                <div class="form-group">
                    <label for="nama_instansi">Nama Sekolah/Perguruan Tinggi:</label>
                    <input type="text" id="nama_instansi" name="nama_instansi">
                </div>
                <div class="form-group">
                    <label for="jurusan">Jurusan:</label>
                    <input type="text" id="jurusan" name="jurusan">
                </div>
                <div class="form-group">
                    <label for="tahun_pendidikan">Tahun Masuk:</label>
                    <input type="text" id="tahun_pendidikan" name="tahun_pendidikan">
                </div>
            </div>

            <div class="form-section">
                <h3>💼 Riwayat Pekerjaan</h3>
                <div class="form-group">
                    <label for="pekerjaan">Pekerjaan:</label>
                    <input type="text" id="pekerjaan" name="pekerjaan">
                </div>
                <div class="form-group">
                    <label for="perusahaan">Nama Perusahaan:</label>
                    <input type="text" id="perusahaan" name="perusahaan">
                </div>
                <div class="form-group">
                    <label for="tahun_bekerja">Tahun Mulai Bekerja:</label>
                    <input type="text" id="tahun_bekerja" name="tahun_bekerja">
                </div>
            </div>

            <button type="submit">Simpan Data</button>
        </form>
    </div>
</body>
</html>
