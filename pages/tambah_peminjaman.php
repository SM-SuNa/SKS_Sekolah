<?php
include "koneksi.php";

// Ambil data user untuk dropdown
$queryUser = "SELECT id, username FROM user";
$resultUser = mysqli_query($conn, $queryUser);

// Ambil data ruangan untuk dropdown
$queryRuangan = "SELECT id, nama_ruangan FROM ruangan";
$resultRuangan = mysqli_query($conn, $queryRuangan);

// Proses penambahan data peminjaman
if (isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
    $ruangan_id = $_POST['ruangan_id'];
    $waktu_mulai = $_POST['waktu_mulai'];
    $selesai = $_POST['selesai'];
    $status = $_POST['status'];

    $queryInsert = "INSERT INTO peminjaman (user_id, ruangan_id, waktu_mulai, selesai, status) 
                    VALUES ($user_id, $ruangan_id, '$waktu_mulai', '$selesai', '$status')";

    if (mysqli_query($conn, $queryInsert)) {
        echo "<script>alert('Peminjaman berhasil ditambahkan!'); window.location.href='?page=manajemen_peminjaman';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan peminjaman!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjaman</title>
    <!-- Tambahkan link CSS AdminLTE -->
    <link rel="stylesheet" href="adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
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
                        <h1 class="m-0">Tambah Peminjaman</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form Tambah Peminjaman</h3>
                    </div>
                    <form method="POST" action="">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="user_id">Pilih User</label>
                                <select name="user_id" id="user_id" class="form-control" required>
                                    <option value="">-- Pilih User --</option>
                                    <?php while ($user = mysqli_fetch_assoc($resultUser)): ?>
                                        <option value="<?= $user['id'] ?>"><?= $user['username'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ruangan_id">Pilih Ruangan</label>
                                <select name="ruangan_id" id="ruangan_id" class="form-control" required>
                                    <option value="">-- Pilih Ruangan --</option>
                                    <?php while ($ruangan = mysqli_fetch_assoc($resultRuangan)): ?>
                                        <option value="<?= $ruangan['id'] ?>"><?= $ruangan['nama_ruangan'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="waktu_mulai">Waktu Mulai</label>
                                <input type="datetime-local" name="waktu_mulai" id="waktu_mulai" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="selesai">Waktu Selesai</label>
                                <input type="datetime-local" name="selesai" id="selesai" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="pending">Pending</option>
                                    <option value="diterima">Diterima</option>
                                    <option value="ditolak">Ditolak</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                            <a href="?page=manajemen_peminjaman" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- Tambahkan script AdminLTE -->
<script src="adminlte/plugins/jquery/jquery.min.js"></script>
<script src="adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
