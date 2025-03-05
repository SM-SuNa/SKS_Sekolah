<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMKN 1 Cirebon</title>
    <!-- Tambahkan CSS AdminLTE -->
    <link rel="stylesheet" href="path/to/adminlte.min.css">
    <!-- FontAwesome untuk ikon -->
    <link rel="stylesheet" href="path/to/fontawesome.css">
    <!-- Tambahkan CSS tambahan ji.ka diperlukan -->
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        .wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .main-sidebar {
            height: 100vh;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="" class="brand-link text-center">
                <img src="assets/img/neper.png" alt="Nusabot Logo" width="30%">
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- User Panel -->
                 <!-- Profil Sidebar -->
                 <?php
                    session_start(); // Pastikan session dimulai di awal

                    // Cek apakah user sudah login, jika tidak, tampilkan default
                    $loggedInUser = isset($_SESSION['username']);
                    $username = $loggedInUser ? $_SESSION['username'] : "Guest";
                    ?>

                    <div class="profile-container">
                        <div class="profile-mini" onclick="toggleMenu()">
                            <img src="assets/img/user.png" alt="User Image" class="profile-img">
                            <span class="profile-name"><?= htmlspecialchars($username); ?></span>
                            <i class="fas fa-caret-down"></i>
                        </div>
                        <?php if (!$loggedInUser): ?>
                            <div class="alert alert-warning">
                                <strong>Perhatian:</strong> Anda belum login. Beberapa fitur mungkin tidak tersedia.
                            </div>
                        <?php endif; ?>
                        <ul class="profile-dropdown" id="profile-menu">
                            <li><a href="user.php"><i class="fas fa-tachometer-alt"></i> Kembali ke home</a></li>
                            <li><a href="profil.php"><i class="fas fa-user"></i> Profil</a></li>
                            <li class="logout-item"><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                            <li class="login-item"><a href="login.php"><i class="fas fa-sign-out-alt"></i> Login</a></li>
                        </ul>
                    </div>
                    <!-- CSS -->
                    <style>
                    .profile-container {
                        position: relative;
                        display: block;
                        padding: 10px;
                    }
                    .profile-mini {
                        display: flex;
                        align-items: center;
                        gap: 10px;
                        cursor: pointer;
                        border-radius: 5px;
                        color: white;
                        padding: 8px;
                        background: rgba(255, 255, 255, 0.1); /* Sedikit transparan agar menyatu */
                    }
                    .profile-mini:hover {
                        background: rgba(255, 255, 255, 0.2);
                    }
                    .profile-img {
                        width: 35px;
                        height: 35px;
                        border-radius: 50%;
                        border: 2px solid white;
                    }
                    .profile-name {
                        font-size: 14px;
                        font-weight: 500;
                        flex-grow: 1;
                    }
                    .profile-dropdown {
                        position: absolute;
                        top: 50px;
                        left: 10px;
                        background: #343a40;
                        list-style: none;
                        padding: 5px 0;
                        margin: 0;
                        width: 160px;
                        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
                        border-radius: 5px;
                        display: none;
                        z-index: 100;
                    }
                    .profile-dropdown li {
                        padding: 8px 15px;
                    }
                    .profile-dropdown li a {
                        text-decoration: none;
                        color: white;
                        font-size: 14px;
                        display: block;
                    }
                    .profile-dropdown li a:hover {
                        background: rgba(255, 255, 255, 0.2);
                    }
                    .logout-item {
                        border-top: 1px solid rgba(255, 255, 255, 0.2);
                        margin-top: 5px;
                        padding-top: 5px;
                    }
                    .logout-item a {
                        color: #ff6b6b !important;
                        font-weight: bold;
                    }

                    /* Menampilkan dropdown saat diklik */
                    .profile-container.active .profile-dropdown {
                        display: block;
                    }
                    </style>

                    <!-- JS -->
                    <script>
                    function toggleMenu() {
                        document.querySelector(".profile-container").classList.toggle("active");
                    }
                    </script>

                <!-- Sidebar Search -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Cari menu..." aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
                

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Menu Utama -->
                        <li class="nav-item">
                        <li class="nav-item">
                            <a href="?page=manajemen_peminjaman" class="nav-link">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>Manajemen Peminjaman</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=tambah_peminjaman" class="nav-link">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>Tambah Peminjaman</p>
                            </a>
                        </li>
                        
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper -->

    <!-- Tambahkan JS AdminLTE -->
    <script src="path/to/jquery.min.js"></script>
    <script src="path/to/bootstrap.bundle.min.js"></script>
    <script src="path/to/adminlte.min.js"></script>
</body>
</html>
