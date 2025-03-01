<?php
include "koneksi.php";

// Ambil semua data peminjaman, termasuk kapasitas dan nama lengkap
$query = "SELECT peminjaman.id, user.nama_lengkap, ruangan.nama_ruangan, 
                 ruangan.kapasitas, peminjaman.waktu_mulai, peminjaman.selesai, 
                 peminjaman.status, peminjaman.keterangan 
          FROM peminjaman 
          JOIN user ON peminjaman.user_id = user.id 
          JOIN ruangan ON peminjaman.ruangan_id = ruangan.id";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Peminjaman</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manajemen Peminjaman</h1>
                    </div>
                </div>
            </div>
        </div>
        
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
                                    <th>Nama Peminjam</th>
                                    <th>Nama Ruangan</th>
                                    <th>Kapasitas Ruangan</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= $row['nama_lengkap'] ?></td> <!-- Nama Peminjam -->
                                        <td><?= $row['nama_ruangan'] ?></td>
                                        <td><?= $row['kapasitas'] ?></td>
                                        <td><?= date('d-m-Y H:i', strtotime($row['waktu_mulai'])) ?></td>
                                        <td><?= date('d-m-Y H:i', strtotime($row['selesai'])) ?></td>
                                        <td><?= htmlspecialchars($row['keterangan']) ?></td>
                                        <td>
                                            <?php if ($row['status'] === 'diterima'): ?>
                                                <span class="badge badge-success">Diterima</span>
                                            <?php elseif ($row['status'] === 'ditolak'): ?>
                                                <span class="badge badge-danger">Ditolak</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning">Menunggu</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger btn-sm btn-delete" 
                                                    data-id="<?= $row['id'] ?>">Batalkan</button>
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

<script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script defer src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script defer src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        $('#peminjamanTable').DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/Indonesian.json'
            }
        });

        // Konfirmasi hapus
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function () {
                let id = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Peminjaman ini akan dibatalkan dan tidak bisa dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Batalkan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect ke proses hapus
                        window.location.href = `page_user/hapus_peminjaman.php?id=${id}&type=peminjaman`;
                        
                        // Notifikasi sukses setelah penghapusan
                        setTimeout(() => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Peminjaman berhasil dibatalkan!',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }, 500);
                    }
                });
            });
        });
    });
</script>

</body>
</html>
