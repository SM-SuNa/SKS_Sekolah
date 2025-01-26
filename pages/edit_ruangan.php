<?php
include "koneksi.php";

// Periksa apakah parameter `id` dikirim melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data ruangan berdasarkan ID
    $query = "SELECT * FROM ruangan WHERE id = $id";
    $result = mysqli_query($conn, $query);

    // Periksa apakah data ditemukan
    if (mysqli_num_rows($result) > 0) {
        $ruangan = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Data ruangan tidak ditemukan!'); window.location.href='manajemen_ruangan';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID ruangan tidak ditemukan!'); window.location.href='manajemen_ruangan';</script>";
    exit;
}

// Proses update data ruangan
if (isset($_POST['update'])) {
    $nama_ruangan = $_POST['nama_ruangan'];
    $kapasitas = $_POST['kapasitas'];
    $lokasi = $_POST['lokasi'];
    $keterangan = $_POST['keterangan'];

    $query = "UPDATE ruangan SET 
              nama_ruangan = '$nama_ruangan', 
              kapasitas = $kapasitas, 
              lokasi = '$lokasi', 
              keterangan = '$keterangan' 
              WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='?page=manajemen_ruangan';</script>";
    } else {
        echo "<script>alert('Data gagal diperbarui!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ruangan</title>
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
                        <h1 class="m-0">Edit Ruangan</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form Edit Ruangan</h3>
                    </div>
                    <form method="POST" action="">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama_ruangan">Nama Ruangan</label>
                                <input type="text" name="nama_ruangan" id="nama_ruangan" 
                                       value="<?= $ruangan['nama_ruangan'] ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="kapasitas">Kapasitas</label>
                                <input type="number" name="kapasitas" id="kapasitas" 
                                       value="<?= $ruangan['kapasitas'] ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="lokasi">Lokasi</label>
                                <input type="text" name="lokasi" id="lokasi" 
                                       value="<?= $ruangan['lokasi'] ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control" required><?= $ruangan['keterangan'] ?></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" name="update" class="btn btn-success">Simpan Perubahan</button>
                            <a href="?page=manajemen_ruangan" class="btn btn-secondary">Batal</a>
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
