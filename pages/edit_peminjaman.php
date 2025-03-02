<?php
include 'koneksi.php';

$id = $_GET['id'];

// Cek apakah ID valid
$query = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE id = '$id'");
$data = mysqli_fetch_array($query);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location.href='?page=manajemen_peminjaman';</script>";
    exit;
}

// Jika form disubmit
if (isset($_POST['submit'])) {
    $waktu_mulai = mysqli_real_escape_string($koneksi, $_POST['waktu_mulai']);
    $selesai = mysqli_real_escape_string($koneksi, $_POST['selesai']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);

    // Validasi status agar hanya menerima nilai yang diizinkan
    $allowed_status = ['menunggu', 'diterima', 'ditolak'];
    if (!in_array($status, $allowed_status)) {
        echo "<script>alert('Status tidak valid!'); window.location.href='?page=manajemen_peminjaman';</script>";
        exit;
    }

    // Update data peminjaman
    $updateQuery = "UPDATE peminjaman SET waktu_mulai='$waktu_mulai', selesai='$selesai', status='$status' WHERE id='$id'";

    if (mysqli_query($koneksi, $updateQuery)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='?page=manajemen_peminjaman';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!');</script>";
    }
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Peminjaman</h1>
    </section>

    <section class="content">
        <div class="box box-primary">
            <form method="POST">
                <div class="box-body">
                    <div class="form-group">
                        <label for="waktu_mulai">Waktu Mulai</label>
                        <input type="datetime-local" name="waktu_mulai" class="form-control" 
                               value="<?php echo date('Y-m-d\TH:i', strtotime($data['waktu_mulai'])); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="selesai">Waktu Selesai</label>
                        <input type="datetime-local" name="selesai" class="form-control" 
                               value="<?php echo date('Y-m-d\TH:i', strtotime($data['selesai'])); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="menunggu" <?php echo ($data['status'] == 'menunggu') ? 'selected' : ''; ?>>Menunggu</option>
                            <option value="diterima" <?php echo ($data['status'] == 'diterima') ? 'selected' : ''; ?>>Diterima</option>
                            <option value="ditolak" <?php echo ($data['status'] == 'ditolak') ? 'selected' : ''; ?>>Ditolak</option>
                        </select>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="?page=manajemen_peminjaman" class="btn btn-default">Batal</a>
                </div>
            </form>
        </div>
    </section>
</div>
