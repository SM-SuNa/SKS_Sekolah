<?php
include "koneksi.php";

// Query untuk mendapatkan data laporan peminjaman
$query = "SELECT 
            p.id, 
            u.username AS nama_user, 
            r.nama_ruangan AS nama_ruangan, 
            p.waktu_mulai, 
            p.selesai, 
            p.status 
          FROM peminjaman p
          JOIN user u ON p.user_id = u.id
          JOIN ruangan r ON p.ruangan_id = r.id
          ORDER BY p.waktu_mulai DESC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman</title>
    <!-- Tambahkan link CSS AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Laporan Peminjaman</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Laporan Peminjaman</h3>
                    </div>
                    <div class="card-body">
                        <table id="userTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama User</th>
                                    <th>Nama Ruangan</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= $row['nama_user'] ?></td>
                                        <td><?= $row['nama_ruangan'] ?></td>
                                        <td><?= date('d-m-Y H:i', strtotime($row['waktu_mulai'])) ?></td>
                                        <td><?= date('d-m-Y H:i', strtotime($row['selesai'])) ?></td>
                                        <td>
                                            <?php if ($row['status'] === 'diterima'): ?>
                                                <span class="badge badge-success"><?= ucfirst($row['status']) ?></span>
                                            <?php elseif ($row['status'] === 'ditolak'): ?>
                                                <span class="badge badge-danger"><?= ucfirst($row['status']) ?></span>
                                            <?php else: ?>
                                                <span class="badge badge-warning"><?= ucfirst($row['status']) ?></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- Tambahkan script DataTables dan AdminLTE -->
<script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script defer src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script defer src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script defer src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script defer src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script defer src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script defer src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script defer src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        $("#userTable").DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#userTable_wrapper .col-md-6:eq(0)');
    });
</script>
</body>
</html>
