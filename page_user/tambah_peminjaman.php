<?php
include "koneksi.php";

// Ambil daftar user untuk dropdown
$queryUser = "SELECT id, nama_lengkap FROM user WHERE role = 'user'";
$resultUser = mysqli_query($conn, $queryUser) or die("Query Error: " . mysqli_error($conn));

// Ambil daftar ruangan untuk dropdown
$queryRuangan = "SELECT id, nama_ruangan, kapasitas FROM ruangan";
$resultRuangan = mysqli_query($conn, $queryRuangan) or die("Query Error: " . mysqli_error($conn));

// Proses tambah peminjaman
$notif = "";
if (isset($_POST['submit'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $ruangan_id = mysqli_real_escape_string($conn, $_POST['ruangan_id']);
    $waktu_mulai = mysqli_real_escape_string($conn, $_POST['waktu_mulai']);
    $selesai = mysqli_real_escape_string($conn, $_POST['selesai']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);

    // Ambil kapasitas ruangan
    $queryKapasitas = "SELECT kapasitas FROM ruangan WHERE id = '$ruangan_id'";
    $resultKapasitas = mysqli_query($conn, $queryKapasitas);
    $kapasitas = ($rowKapasitas = mysqli_fetch_assoc($resultKapasitas)) ? $rowKapasitas['kapasitas'] : 0;

    // Cek apakah ruangan sudah dipakai dalam rentang waktu tersebut
    $cekQuery = "SELECT * FROM peminjaman 
                 WHERE ruangan_id = '$ruangan_id' 
                 AND ('$waktu_mulai' BETWEEN waktu_mulai AND selesai 
                 OR '$selesai' BETWEEN waktu_mulai AND selesai) 
                 AND NOT ('$waktu_mulai' = selesai OR '$selesai' = waktu_mulai)";
    $resultCek = mysqli_query($conn, $cekQuery);

    if (mysqli_num_rows($resultCek) > 0) {
        $notif = "Ruangan sudah dipakai di waktu yang dipilih. Silakan pilih waktu lain.";
    } else {
        $queryInsert = "INSERT INTO peminjaman (user_id, ruangan_id, waktu_mulai, selesai, status, keterangan, kapasitas) 
                        VALUES ('$user_id', '$ruangan_id', '$waktu_mulai', '$selesai', 'menunggu', '$keterangan', '$kapasitas')";

        if (mysqli_query($conn, $queryInsert)) {
            $notif = "Peminjaman berhasil diajukan!";
        } else {
            $notif = "Gagal mengajukan peminjaman.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjaman</title>
    <link rel="stylesheet" href="adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0">Tambah Peminjaman</h1>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form Tambah Peminjaman</h3>
                    </div>
                    <form method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="user_id">Nama Peminjam</label>
                                <select name="user_id" id="user_id" class="form-control" required>
                                    <option value="">-- Pilih Nama --</option>
                                    <?php while ($user = mysqli_fetch_assoc($resultUser)): ?>
                                        <option value="<?= $user['id'] ?>"><?= $user['nama_lengkap'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="ruangan_id">Pilih Ruangan</label>
                                <select name="ruangan_id" id="ruangan_id" class="form-control" required>
                                    <option value="">-- Pilih Ruangan --</option>
                                    <?php while ($ruangan = mysqli_fetch_assoc($resultRuangan)): ?>
                                        <option value="<?= $ruangan['id'] ?>" data-kapasitas="<?= $ruangan['kapasitas'] ?>">
                                            <?= $ruangan['nama_ruangan'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="kapasitas">Kapasitas Maksimal</label>
                                <input type="text" id="kapasitas" class="form-control" readonly>
                            </div>

                            <!-- Perbaikan Tampilan Waktu Mulai & Selesai -->
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="waktu_mulai">Waktu Mulai</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="datetime-local" name="waktu_mulai" id="waktu_mulai" class="form-control" required>
                                    </div>
                                    <small class="form-text text-muted">Pilih tanggal dan waktu mulai peminjaman.</small>
                                </div>

                                <div class="col-md-6">
                                    <label for="selesai">Waktu Selesai</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                        </div>
                                        <input type="datetime-local" name="selesai" id="selesai" class="form-control" required>
                                    </div>
                                    <small class="form-text text-muted">Pilih tanggal dan waktu selesai peminjaman.</small>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control" rows="3" required></textarea>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function () {
        let notif = "<?= $notif ?>";
        if (notif) {
            toastr.success(notif);
        }

        $("#ruangan_id").change(function () {
            let kapasitas = $(this).find(':selected').data('kapasitas');
            $("#kapasitas").val(kapasitas ? kapasitas : '');
        });
    });
</script>
</body>
</html>
