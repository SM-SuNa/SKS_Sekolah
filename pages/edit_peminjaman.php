<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE id = '$id'");
$data = mysqli_fetch_array($query);

if (isset($_POST['submit'])) {
    $waktu_mulai = $_POST['waktu_mulai'];
    $selesai = $_POST['selesai'];
    $status = $_POST['status'];

    mysqli_query($koneksi, "UPDATE peminjaman SET waktu_mulai='$waktu_mulai', selesai='$selesai', status='$status' WHERE id='$id'");
    echo "<script>alert('Data berhasil diperbarui!'); window.location.href='?page=manajemen_peminjaman';</script>";
    exit;
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
                        <input type="datetime-local" name="waktu_mulai" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($data['waktu_mulai'])); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="selesai">Waktu Selesai</label>
                        <input type="datetime-local" name="selesai" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($data['selesai'])); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="pending" <?php echo ($data['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                            <option value="diterima" <?php echo ($data['status'] == 'diterima') ? 'selected' : ''; ?>>Diterima</option>
                            <option value="ditolak" <?php echo ($data['status'] == 'ditolak') ? 'selected' : ''; ?>>Ditolak</option>
                        </select>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="index.php?page=manajemen_peminjaman" class="btn btn-default">Batal</a>
                </div>
            </form>
        </div>
    </section>
</div>
