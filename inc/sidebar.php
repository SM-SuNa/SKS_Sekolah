<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminLTE Sidebar</title>
    <!-- Tambahkan CSS AdminLTE -->
    <link rel="stylesheet" href="path/to/adminlte.min.css">
    <!-- FontAwesome untuk ikon -->
    <link rel="stylesheet" href="path/to/fontawesome.css">
    <!-- Tambahkan CSS tambahan jika diperlukan -->
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
            <a href="index.php" class="brand-link text-center">
                <img src="dist/img/nusabot.png" alt="Nusabot Logo" width="30%">
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- User Panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block">Bapak Budi</a>
                    </div>
                </div>

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
                            <a href="?page=manajemen_pengguna" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Manajemen Pengguna</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=tambah_user" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Tambah Pengguna</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=manajemen_ruangan" class="nav-link">
                                <i class="nav-icon fas fa-door-open"></i>
                                <p>Manajemen Ruangan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=tambah_ruangan" class="nav-link">
                                <i class="nav-icon fas fa-door-open"></i>
                                <p>tambah ruangan</p>
                            </a>
                        </li>
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
                        <li class="nav-item">
                            <a href="?page=laporan" class="nav-link">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>Laporan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?page=device" class="nav-link">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>Daftar Perangkat</p>
                            </a>
                        </li>
                        <!-- Menu Pengaturan -->
                        <li class="nav-header">PENGATURAN</li>
                        <li class="nav-item">
                            <a href="?page=pengaturan" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>Pengaturan</p>
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
