<?php
include "inc/header.php";
?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php
    include "inc/topnav.php";
    include "inc/sidebar.php";

    if(isset($_GET['page'])){
      include "pages/" . $_GET['page'] . ".php";
    } else {
      include "pages/home.php";
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
