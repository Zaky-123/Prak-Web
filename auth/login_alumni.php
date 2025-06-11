<?php
session_start();
require_once '../config/db.php';
//mengambil data dari inputan form login alumni
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nisn = mysqli_real_escape_string($conn, $_POST['nisn']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM alumni WHERE nisn = '$nisn' LIMIT 1";
    $result = mysqli_query($conn, $query);
    // Cek apakah query berhasil dan ada satu baris data yang ditemukan
    // Jika ada, ambil data alumni  
    if ($result && mysqli_num_rows($result) === 1) {
        $alumni = mysqli_fetch_assoc($result);
        if (password_verify($password, $alumni['password'])) {
            $_SESSION['alumni_logged_in'] = true;
            $_SESSION['alumni_nisn'] = $alumni['nisn'];
            $_SESSION['alumni_nama'] = $alumni['nama'];
            header('Location: ../alumni/home.php');
            exit;
        }
    }

    $_SESSION['error'] = "NISN atau password salah!";
    header('Location: login_alumni.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login Alumni</title>
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="login_style.css">
</head>
<body>
    <div class="wrapper">
        <h1>Login Alumni</h1>

        <?php if (isset($_SESSION['error'])): ?>
            <div style="color: red; font-size: 14px; text-align: center; margin-bottom: 10px;">
                <?= $_SESSION['error']; ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form action="login_alumni.php" method="POST">
            <div class="input-box">
                <input type="text" name="nisn" placeholder="NISN" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock-keyhole'></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox">Remember Me</label>
                <a href="#">Forgot Password?</a>
            </div>
            <button type="submit" class="btn">Login</button>
            <div class="register-link">
                <p>Login sebagai <a href="login_admin.php"><strong>ADMIN</strong></a></p>
            </div>
        </form>
    </div>
</body>
</html>
