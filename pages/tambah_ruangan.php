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
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Ruangan</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Ruangan</h3>
                </div>
                <form method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_ruangan">Nama Ruangan</label>
                            <input type="text" name="nama_ruangan" class="form-control" id="nama_ruangan" placeholder="Masukkan nama ruangan" required>
                        </div>
                        <div class="form-group">
                            <label for="kapasitas">Kapasitas</label>
                            <input type="number" name="kapasitas" class="form-control" id="kapasitas" placeholder="Masukkan kapasitas ruangan" required>
                        </div>
                        <div class="form-group">
                            <label for="lokasi">Lokasi</label>
                            <input type="text" name="lokasi" class="form-control" id="lokasi" placeholder="Masukkan lokasi ruangan" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" class="form-control" id="keterangan" rows="3" placeholder="Masukkan keterangan tambahan"></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        <a href="?page=manajemen_ruangan" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
