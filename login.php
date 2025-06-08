<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="login_style.css">
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="wrapper">
        <form action="home.php" method="POST">
            <h1>Login Alumni</h1>
            <div class="input-box">
                <input type="text" placeholder="Username" required>
                <i class='bx  bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" required>
                <i class='bx  bxs-lock-keyhole'></i>
            </div>

            <div class="remember-forgot">
                <label for=""><input type="checkbox">Remenber Me</label>
                <a href="#">Forgot Password?</a>
            </div>
            <button type="submit" class="btn">Login</button>

            <!-- <form action="home.html" method="POST">
                <button type="submit" class="btn">Login</button>
            </form> -->
            <!-- <button type="button" class="btn" onclick="location.href='home.html'">Login</button> -->

            <div class="register-link">
                <p>Admin Registration? <a href="#">ADMIN</a></p>
            </div>

        </form>
    </div>
</body>

</html>