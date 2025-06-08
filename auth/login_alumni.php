<?php
session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nisn = mysqli_real_escape_string($conn, $_POST['nisn']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM alumni WHERE nisn = '$nisn' LIMIT 1";
    $result = mysqli_query($conn, $query);

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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Alumni</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-cover bg-center bg-no-repeat flex items-center justify-center" style="background-image: url('Login alumni.jpg');">
  <div class="bg-white/80 backdrop-blur-md rounded-lg shadow-xl px-8 py-10 w-[90%] max-w-md">
    <h2 class="text-3xl font-extrabold text-center mb-6 font-mono">LOGIN <br> ALUMNI</h2>

    <!-- Tampilkan pesan error -->
    <?php if (isset($_SESSION['error'])): ?>
      <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4 text-sm text-center">
        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
      </div>
    <?php endif; ?>

    <form action="login_alumni.php" method="POST" class="space-y-4">
      <div>
        <label class="sr-only" for="nisn">NISN</label>
        <div class="flex items-center border rounded-lg bg-white px-3 py-2 shadow-sm">
          <input type="text" name="nisn" id="nisn" placeholder="NISN" required class="w-full outline-none bg-transparent" />
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 ml-2" viewBox="0 0 20 20" fill="currentColor">
            <path d="M10 10a4 4 0 100-8 4 4 0 000 8zm0 2c-2.5 0-6 1.3-6 4v1h12v-1c0-2.7-3.5-4-6-4z"/>
          </svg>
        </div>
      </div>

      <div>
        <label class="sr-only" for="password">Password</label>
        <div class="flex items-center border rounded-lg bg-white px-3 py-2 shadow-sm">
          <input type="password" name="password" id="password" placeholder="Password" required class="w-full outline-none bg-transparent" />
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 ml-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v2H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-1V6a4 4 0 00-4-4zm-2 6V6a2 2 0 114 0v2H8z" clip-rule="evenodd" />
          </svg>
        </div>
      </div>

      <div class="flex items-center justify-between text-sm">
        <label class="flex items-center gap-1">
          <input type="checkbox" class="form-checkbox rounded text-blue-600" name="remember" />
          Remember me
        </label>
        <a href="#" class="text-blue-600 hover:underline">Forgot password?</a>
      </div>

      <button type="submit" class="w-full bg-black text-white py-2 rounded-full hover:bg-gray-800 transition duration-200">Login</button>
    </form>

    <p class="mt-4 text-center text-sm">Admin Registration? <a href="login_admin.php" class="font-bold text-black hover:underline">ADMIN</a></p>
  </div>
</body>
</html>
