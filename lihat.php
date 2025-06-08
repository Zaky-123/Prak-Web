<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIHAT</title>
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

        body {
            /* background: linear-gradient(to top, #ffa44a, #66c6c4); */
            background: url('bg.png') no-repeat center center fixed;
            background-position: center -180px;
            height: 100%;
            /* overflow: hidden; */
            overflow: auto;
        }

        .container {
            /* display: flex;
            height: 100vh;
            width: 100vw; */
            display: flex;
            min-height: 100vh;
            /* width: 100vw; */
            width: 100%;
            overflow-y: auto;
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

        .sidebar .icon {
            margin-bottom: 20px;
            color: white;
            font-size: 28px;
        }

        .sidebar .menu i {
            display: block;
            color: white;
            margin: 23px 0;
            font-size: 25px;
        }

        .menu a,
        i {
            display: block;
            text-decoration: none;
            padding: 1px;
            transition: color 0.5s, transform 0.4s;
        }

        .icon a {
            display: block;
            color: #b5d1cc;
            text-decoration: none;
            font-size: 40px;
            padding: 1px;
            transition: color 0.5s, transform 0.4s;
        }

        .menu a:hover i {
            color: #ffa44a;
            transform: scale(1.2);
        }

        .icon a:hover i {
            transform: scale(1.2);
        }

        .menu a.active i {
            color: #ffa44a;
        }

        .icon a.active {
            color: #ffa44a;
        }

        .logout {
            margin-top: auto;
            /* padding-top: 20px; */
        }

        .logout a {
            color: white;
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

        .avatar {
            width: 100px;
            height: 100px;
            /* background: white url('https://img.icons8.com/ios/50/landscape.png') no-repeat center; */
            background: url('contact.jpeg') ;
            background-size: contain;
            border-radius: 10px;
        }

        .header h2 {
            margin-left: 10px;
            font-size: 35px;
            font-weight: bold;
            flex: 1;
        }

        .header h1 {
            font-family: 'Lobster', cursive;
            font-size: 50px;
            font-weight: bold;
            color: #004c3f;
            margin-top: -65px;
        }

        .profile-section {
            display: flex;
            margin-top: 20px;
            gap: 30px;
            align-items: flex-start;
        }

        .profile-info {
            /* background: rgba(255, 255, 255, 0.9); */
            /* background: linear-gradient(to top, #909b9a, #379e94); */
            /* background: linear-gradient(to top, #ed943a, #379e94); */
            padding: 20px;
            border-radius: 10px;
            width: 60%;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .profile-info p {
            /* background-color: #e5f4f2;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold; */
            background: rgba(229, 244, 242, 0.75);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 10px;
            padding: 15px 20px;
        }

        .profile-info p:nth-child(odd) {
            /* background: #e0f7f6; */
            background: linear-gradient(to top, #e0f7f6, #f2f2f2);
        }

        .profile-info p:nth-child(even) {
            /* background: #ebc2e0; */
            background: linear-gradient(to top, #fff2e6, #f2f2f2);
        }

        .career-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 40%;
        }

        .career-card {
            background-color: #e5f4f2;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .career-card h3 {
            background-color: #2e857d;
            color: white;
            padding: 8px 12px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            margin: -15px -15px 10px -15px;
        }

        .career-card ul {
            list-style: none;
            margin-bottom: 10px;
        }

        .career-card li {
            padding: 5px 0;
            color: #004c3f;
        }

        .career-card button {
            background-color: #2e857d;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        .career-card button:hover {
            background-color: #246a63;
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
                overflow-y: auto;
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
                text-align: center;
                gap: 10px;
            }

            .header h1 {
                margin-top: 0;
                font-size: 35px;
            }

            .header h2 {
                font-family: 'Playfair Display', serif;
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

            .profile-info,
            .career-section {
                width: 100%;
            }

            .career-section {
                flex-direction: column;
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
                <a href="update-data.php"><i class="fas fa-edit"></i></a>
                <a href="status.php"><i class="fas fa-clipboard-check"></i></a>
            </div>

            <div class="logout">
                <a href="login.php"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </aside>
        <main class="main-content">
            <header class="header">
                <div class="avatar"></div>
                <h2>Username</h2>
                <h1>Insan Cendekia</h1>
            </header>
            <section class="profile-section">
                <div class="profile-info">
                    <p><strong>NISN:</strong></p>
                    <p><strong>PEMINATAN:</strong></p>
                    <p><strong>ANGKATAN:</strong></p>
                    <p><strong>TANGGAL MASUK:</strong></p>
                    <p><strong>TANGGAL LULUS:</strong></p>
                    <p><strong>ALAMAT:</strong></p>
                    <p><strong>NO HANDPHONE:</strong></p>
                    <p><strong>E-MAIL:</strong></p>
                </div>
                <div class="career-section">
                    <div class="career-card">
                        <h3>Riwayat Pekerjaan</h3>
                        <ul>
                            <li>PT A - Staff IT (2023-01-01)</li>
                            <li>PT B - Developer (2024-03-01)</li>
                        </ul>
                        <button onclick="location.href='update-data.php'">Tambah Riwayat Pekerjaan</button>
                    </div>
                    <div class="career-card">
                        <h3>Riwayat Pendidikan</h3>
                        <ul>
                            <li>Universitas XYZ - S1 Informatika (2017 - 2021)</li>
                            <li>Universitas ABC - S2 Informatika (2021 - 2023)</li>
                        </ul>
                        <button onclick="location.href='update-data.php'">Tambah Riwayat Pendidikan</button>
                    </div>
                </div>
            </section>
            <footer class="footer">
                <a href="home.php">BACK</a>
            </footer>
        </main>
    </div>
</body>

</html>