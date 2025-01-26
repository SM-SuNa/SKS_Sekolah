<?php
include "koneksi.php";

// Ambil semua data peminjaman
$query = "SELECT peminjaman.id, user.username, ruangan.nama_ruangan, 
                 peminjaman.waktu_mulai, peminjaman.selesai, peminjaman.status 
          FROM peminjaman 
          JOIN user ON peminjaman.user_id = user.id 
          JOIN ruangan ON peminjaman.ruangan_id = ruangan.id";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Peminjaman</title>
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
                        <h1 class="m-0">Manajemen Peminjaman</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Peminjaman</h3>
                        <a href="?page=tambah_peminjaman" class="btn btn-success float-right">Tambah Peminjaman</a>
                    </div>
                    <div class="card-body">
                        <table id="peminjamanTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Ruangan</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= $row['username'] ?></td>
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
                                        <td>
                                            <a href="?page=edit_peminjaman&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="?page=hapus_peminjaman&id=<?= $row['id'] ?>" 
                                               class="btn btn-danger btn-sm" 
                                               onclick="return confirm('Yakin ingin menghapus peminjaman ini?')">Hapus</a>
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

<!-- Tambahkan script AdminLTE dan DataTables dengan atribut defer -->
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
        $('#peminjamanTable').DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/Indonesian.json'
            },
            buttons: [
                { extend: 'copy', className: 'btn btn-info' },
                { extend: 'csv', className: 'btn btn-success' },
                { extend: 'excel', className: 'btn btn-primary' },
                { extend: 'pdf', className: 'btn btn-danger' },
                { extend: 'print', className: 'btn btn-warning' }
            ]
        }).buttons().container().appendTo('#peminjamanTable_wrapper .col-md-6:eq(0)');
    });
</script>
</body>
</html>
