<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
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
            height: 100vh;
            /* overflow: hidden; */
            overflow: auto;
        }

        .container {
            /* display: flex;
            height: 100vh;
            width: 100vw; */
            display: flex;
            min-height: 100vh;
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
            /* margin-bottom: 20px; */
            padding: 0 20px;
            margin-top: 13px;
        }

        .header h2 {
            /* font-family: 'Oswald', sans-serif; */
            font-family: 'Playfair Display', serif;
            margin-left: 10px;
            margin-top: -17px;
            font-size: 50px;
            font-weight: bold;
            flex: 1;
        }

        .header h1 {
            font-family: 'Lobster', cursive;
            font-size: 50px;
            font-weight: bold;
            color: #004c3f;
            margin-top: -25px;
            margin-left: 10px;
        }

        .filter-section {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-bottom: 20px;
            margin-top: 30px;
        }

        .filter-section select,
        .filter-section input[type="text"] {
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .list-alumni {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .alumni-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* background: rgba(255, 255, 255, 0.9); */
            border-radius: 10px;
            padding: 15px 20px;
        }

        .alumni-item:nth-child(odd) {
            background: linear-gradient(to top, #e0f7f6, #f2f2f2);
        }

        .alumni-item:nth-child(even) {
            background: linear-gradient(to top, #fff2e6, #f2f2f2);
        }

        /* .alumni-item:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transform: scale(1.01);
            transition: all 0.3s ease;
        } */

        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
        }

        .kuliah {
            background-color: #c5f3c1;
            color: #2d6a4f;
        }

        .bekerja {
            background-color: #f7b2b2;
            color: #9e1c1c;
        }

        .lihat-link {
            text-decoration: underline;
            color: black;
            font-weight: bold;
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

            .profile-info,
            .career-section {
                width: 100%;
            }

            .career-section {
                flex-direction: column;
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
                <a href="home.php" class="active"><i class="fas fa-home"></i></a>
                <a href="update-data.php"><i class="fas fa-edit"></i></a>
                <a href="status.php"><i class="fas fa-clipboard-check"></i></a>
            </div>

            <div class="logout">
                <a href="login.php"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </aside>
        <main class="main-content">
            <div class="header">
                <h2>Hai &lt;username&gt;</h2>
                <h1>Insan Cendekia</h1>
            </div>
            <div class="filter-section">
                <select>
                    <option>Urutkan berdasarkan</option>
                    <option>Mahasiswa Top 10 PTN</option>
                    <option>Mahasiswa Perguruan Tinggi Luar Negeri</option>
                    <option>Jalur Penerimaan SNBT</option>
                    <option>Jalur Penerimaan SNBP</option>
                </select>
                <input type="text" placeholder="Cari...">
            </div>
            <div class="list-alumni">
                <div class="alumni-item">
                    <span>Nama</span>
                    <span class="status bekerja">Bekerja</span>
                    <a href="lihat.php" class="lihat-link">Lihat</a>
                </div>
                <div class="alumni-item">
                    <span>Nama</span>
                    <span class="status kuliah">Kuliah</span>
                    <a href="lihat.php" class="lihat-link">Lihat</a>
                </div>
                <div class="alumni-item">
                    <span>Nama</span>
                    <span class="status kuliah">Kuliah</span>
                    <a href="lihat.php" class="lihat-link">Lihat</a>
                </div>
                <div class="alumni-item">
                    <span>Nama</span>
                    <span class="status bekerja">Bekerja</span>
                    <a href="lihat.php" class="lihat-link">Lihat</a>
                </div>
                <div class="alumni-item">
                    <span>Nama</span>
                    <span class="status kuliah">Kuliah</span>
                    <a href="lihat.php" class="lihat-link">Lihat</a>
                </div>
            </div>
        </main>
    </div>
</body>

</html>






<!-- main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        } -->