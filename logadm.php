<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Admin</title>
    <link rel="stylesheet" href="logadm.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="login-box">
        <h1>LOGIN <br> ADMIN</h1>
        <form action="/submit" method="POST">
            <div class="input-group">
                <input type="text" name="username" placeholder="username" required>
                <i class="fas fa-user-tie icon"></i>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
                <i class="fas fa-lock icon"></i>
            </div>
            <div class="options">
                <label><input type="checkbox" name="remember"> Remember me</label>
                <a href="#">Forgot password?</a>
            </div>
            <button type="submit" class="login-btn">Login</button>
            <p class="switch-link">you are not an Admin? <a href="alumni.php"><strong>ALUMNI</strong></a></p>
        </form>
    </div>
</body>
</html>
