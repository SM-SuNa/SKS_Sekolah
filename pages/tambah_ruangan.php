<?php
include "koneksi.php";

if (isset($_POST['submit'])) {
    $nama_ruangan = $_POST['nama_ruangan'];
    $kapasitas = $_POST['kapasitas'];
    $lokasi = $_POST['lokasi'];
    $keterangan = $_POST['keterangan'];

    $query = "INSERT INTO ruangan (nama_ruangan, kapasitas, lokasi, keterangan) VALUES ('$nama_ruangan', '$kapasitas', '$lokasi', '$keterangan')";
    mysqli_query($conn, $query);

    echo "<script>alert('Ruangan berhasil ditambahkan!'); window.location.href='?page=manajemen_ruangan';</script>";
}
?>

<div class="content-wrapper">
    <div class="content-header">
        <h1>Tambah Ruangan</h1>
    </div>
    <div class="content">
        <form method="post">
            <div class="form-group">
                <label>Nama Ruangan</label>
                <input type="text" name="nama_ruangan" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Kapasitas</label>
                <input type="number" name="kapasitas" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Lokasi</label>
                <input type="text" name="lokasi" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control"></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
