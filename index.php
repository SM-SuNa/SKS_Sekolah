<?php
session_start();
include "koneksi.php"; // Pastikan koneksi tersedia

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Ambil peran pengguna
$username = $_SESSION['username'];
$query = mysqli_query($conn, "SELECT role FROM user WHERE username='$username'");
$user = mysqli_fetch_assoc($query);
$role = $user['role'] ?? 'user'; // Default ke 'user' jika role tidak ditemukan

// Jika pengguna adalah user, arahkan ke user.php
if ($role == 'user') {
    header("Location: user.php");
    exit();
}

// Jika admin, lanjutkan ke halaman default (AdminLTE)
include "inc/header.php";
?>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php
        include "inc/topnav.php";
        include "inc/sidebar.php";

        if (isset($_GET['page'])) {
            $page = "pages/" . $_GET['page'] . ".php";
            if (file_exists($page)) {
                include $page;
            } else {
                echo "<h1>Halaman tidak ditemukan!</h1>";
            }
        } else {
            include "pages/home.php"; // Halaman default admin
        }

        include "inc/footer.php";
        ?>
    </div>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
