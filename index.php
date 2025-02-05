<?php

include "inc/header.php";
?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php
  
    include "inc/topnav.php";
    include "inc/sidebar.php";

    // Menentukan halaman yang ditampilkan
    if (isset($_GET['page'])) {
        $page = "pages/" . $_GET['page'] . ".php";
        if (file_exists($page)) {
            include $page;
        } else {
            echo "<h1>Halaman tidak ditemukan!</h1>";
        }
    } else {
        include "pages/home.php"; // Halaman default jika tidak ada parameter page
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
