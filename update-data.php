<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Dosis', sans-serif;
        }

        body,
        html {
            height: 100%;
            overflow: hidden;
            /* Hapus scroll */
        }

        body {
            background: url('bg.png') no-repeat center center fixed;
            background-position: center -180px;
            /* height: 100vh; */
            overflow: auto;
            /* background-attachment: fixed;
            background-size: cover; */
            font-family: 'Dosis', sans-serif;
            /* min-height: 100vh; */
            height: 100%;

        }

        .container {
            display: flex;
            min-height: 100vh;
            width: 100%;
            flex-wrap: wrap;
        }

        .sidebar {
            background-color: #2e857d;
            width: 60px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px 0;

        }

        .sidebar .icon,
        .sidebar .menu i,
        .logout a {
            color: white;
        }

        .sidebar .icon {
            margin-bottom: 20px;
            font-size: 28px;
        }

        .sidebar .menu i {
            display: block;
            margin: 23px 0;
            font-size: 25px;
        }

        .menu a,
        .icon a {
            display: block;
            text-decoration: none;
            padding: 1px;
            transition: color 0.5s, transform 0.4s;
        }

        .icon a {
            font-size: 40px;
            color: #b5d1cc;
        }

        .menu a:hover i,
        .menu a.active i {
            color: #ffa44a;
            transform: scale(1.2);
        }

        .icon a:hover i {
            transform: scale(1.2);
        }

        .logout {
            margin-top: auto;
        }

        .logout a {
            font-size: 20px;
            transition: color 0.5s, transform 0.5s;
        }

        .logout a:hover {
            color: #00ffd0;
            transform: scale(1.2);
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .form-header {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            /* atau 'center' kalau mau tengah */
            margin-bottom: 20px;
        }

        .header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 45px;
            font-weight: bold;
            color: black;
            margin: 0;
            /* margin-left: 10px;
            font-size: 35px;
            font-weight: bold;
            flex: 1; */
            /* margin-bottom: 10px; */
        }

        .header p {
            margin-top: 10px;
            font-size: 18px;
            /* margin-bottom: 30px; */
            /* margin: 0; */
        }

        .header h1 {
            font-family: 'Lobster', cursive;
            font-size: 50px;
            font-weight: bold;
            color: #004c3f;
            margin-top: -65px;
        }

        .profile-section {
            margin-top: 20px;
        }

        .profile-section h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .profile-section p {
            margin-bottom: 20px;
        }

        form {
            /* background: #ffffffb2;
            padding: 20px;
            border-radius: 10px;
            max-width: 100%;
            display: flex;
            flex-direction: column;
            gap: 15px; */
            /* background: rgba(255, 255, 255, 0.9); */
            padding: 30px;
            margin-top: -25px;
            border-radius: 16px;
            /* box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15); */
            max-width: 100%;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        form div {
            display: flex;
            flex-direction: column;
        }

        form label {
            /* margin-bottom: 5px;
            font-weight: bold; */
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        form input[type="text"],
        form textarea {
            /* padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px; */
            padding: 12px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            background-color: #fff;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        form select {
            appearance: none;
            /* Hilangkan style default browser */
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: #fff;
            background-image: url("data:image/svg+xml;utf8,<svg fill='%23444' height='20' viewBox='0 0 24 24' width='20' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");

            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 12px;
            padding: 12px 40px 12px 12px;
            /* padding kanan ditambah untuk ruang ikon */
            border: none;
            border-radius: 12px;
            font-size: 16px;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
            cursor: pointer;
        }

        form input:focus,
        form select:focus,
        form textarea:focus {
            outline: none;
            box-shadow: 0 0 0 2px #ffa44a;
        }

        .form-buttons {
            display: flex;
            flex-direction: row;
            gap: 10px;
            justify-content: flex-start;
            margin-top: 10px;
        }

        .form-buttons button {
            /* padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            background-color: #2e857d;
            color: white;
            transition: background-color 0.3s ease; */
            /* flex: 1;
            padding: 12px;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            background-color: #005c56;
            color: white; */
            transition: background-color 0.3s ease, transform 0.2s;
            padding: 8px 16px;
            font-size: 14px;
            background-color: #004c3f;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 180px;
        }

        .form-buttons button:hover {
            /* background-color: #ffa44a; */
            background-color: #00a788;
            transform: scale(1.05);
        }

        .footer {
            margin-top: auto;
            padding: 10px 20px;
            text-align: right;
        }

        .footer a {
            color: black;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                flex-direction: row;
                justify-content: space-around;
                width: 100%;
                height: 60px;
                padding: 0;
            }

            .sidebar .menu,
            .sidebar .logout,
            .sidebar .icon {
                display: flex;
                flex-direction: row;
                align-items: center;
                justify-content: center;
                margin: 0;
            }

            .sidebar .menu i,
            .sidebar .logout a,
            .sidebar .icon a {
                margin: 0 10px;
                font-size: 20px;
            }

            .main-content {
                padding: 10px;
            }

            .header {
                flex-direction: column;
                align-items: center;
                gap: 10px;
                text-align: center;
            }

            .header h1 {
                margin-top: 0;
                font-size: 35px;
            }

            .header h2 {
                font-size: 25px;
            }

            .avatar {
                width: 80px;
                height: 80px;
            }

            .profile-section {
                flex-direction: column;
                gap: 20px;
            }

            .footer {
                text-align: center;
                padding: 10px 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <div class="icon">
                <a href="profile.php"><i class="fas fa-user-circle"></i></a>
            </div>
            <div class="menu">
                <a href="home.php"><i class="fas fa-home"></i></a>
                <a href="update-data.php" class="active"><i class="fas fa-edit"></i></a>
                <a href="status.php"><i class="fas fa-clipboard-check"></i></a>
            </div>

            <div class="logout">
                <a href="login.php"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </aside>
        <main class="main-content">
            <header class="header">
                <div class="form-header">
                    <h2>Form update data</h2>
                    <p>Silahkan pilih data yang ingin di update dan ajukan revisi kepada admin</p>
                </div>
                <h1>Insan Cendekia</h1>
            </header>
            <section class="profile-section">
                <form action="#" method="POST">
                    <div>
                        <label for="dataSelect">Data yang ingin diubah</label>
                        <select id="dataSelect" name="dataSelect" required>
                            <option value="">--Pilih data--</option>
                            <option value="alamat">Alamat</option>
                            <option value="email">Email</option>
                            <option value="telepon">No Handphone</option>
                        </select>
                    </div>

                    <div>
                        <label for="newData">Data baru</label>
                        <input type="text" id="newData" name="newData" required>
                    </div>

                    <div>
                        <label for="reason">Alasan</label>
                        <textarea id="reason" name="reason" rows="4" required></textarea>
                    </div>

                    <div class="form-buttons">
                        <button type="submit">KIRIM</button>
                        <button type="reset">BATAL</button>
                    </div>
                </form>
            </section>
            <footer class="footer">
                <a href="lihat.php">BACK</a>
            </footer>
        </main>
    </div>
</body>

</html>