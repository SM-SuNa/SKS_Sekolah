<?php
include "koneksi.php";

// Ambil data user dari database
$query = "SELECT * FROM user";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manajemen User</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar User</h3>
                        <a href="?page=tambah_user" class="btn btn-success float-right">Tambah User</a>
                    </div>
                    <div class="card-body">
                        <table id="userTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= $row['username'] ?></td>
                                        <td><?= $row['role'] ?></td>
                                        <td>
                                            <a href="?page=edit_user&id=<?= $row['id'] ?>&edit_success=1" class="btn btn-warning btn-sm">Edit</a>
                                            <button class="btn btn-danger btn-sm" onclick="confirmHapus(<?= $row['id'] ?>)">Hapus</button>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $('#userTable').DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
        });

        // Cek apakah ada parameter edit_success di URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('edit_success')) {
            Swal.fire({
                title: 'Sukses!',
                text: 'Data berhasil diperbarui.',
                icon: 'success',
                timer: 3000,
                showConfirmButton: false
            });
        }
        
        if (urlParams.has('delete_success')) {
            Swal.fire({
                title: 'Dihapus!',
                text: 'Data berhasil dihapus.',
                icon: 'success',
                timer: 3000,
                showConfirmButton: false
            });
        }
    });

    function confirmHapus(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "User yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "pages/hapus_pengguna.php?id=" + id + "&delete_success=1";
            }
        });
    }
</script>

</body>
</html>
