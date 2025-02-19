<?php
include "koneksi.php";

// Ambil data user dengan role "user"
$queryUser = "SELECT id, username FROM user WHERE role = 'user'";
$resultUser = mysqli_query($conn, $queryUser);

// Ambil data ruangan
$queryRuangan = "SELECT id, nama_ruangan, kapasitas FROM ruangan";
$resultRuangan = mysqli_query($conn, $queryRuangan);

// Proses tambah peminjaman
if (isset($_POST['submit'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $ruangan_id = mysqli_real_escape_string($conn, $_POST['ruangan_id']);
    $waktu_mulai = mysqli_real_escape_string($conn, $_POST['waktu_mulai']);
    $selesai = mysqli_real_escape_string($conn, $_POST['selesai']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);

    // Ambil kapasitas ruangan berdasarkan ID ruangan yang dipilih
    $queryKapasitas = "SELECT kapasitas FROM ruangan WHERE id = '$ruangan_id'";
    $resultKapasitas = mysqli_query($conn, $queryKapasitas);
    $rowKapasitas = mysqli_fetch_assoc($resultKapasitas);
    $kapasitas = $rowKapasitas['kapasitas']; // Simpan kapasitas ruangan

    // Cek apakah ruangan sudah dipinjam di waktu tersebut
    $cekQuery = "SELECT * FROM peminjaman 
                 WHERE ruangan_id = '$ruangan_id' 
                 AND ('$waktu_mulai' BETWEEN waktu_mulai AND selesai 
                 OR '$selesai' BETWEEN waktu_mulai AND selesai)";
    $resultCek = mysqli_query($conn, $cekQuery);

    if (mysqli_num_rows($resultCek) > 0) {
        echo "<script>alert('Ruangan sudah dipakai di waktu yang dipilih. Silakan pilih waktu lain.');</script>";
    } else {
        // Simpan peminjaman dengan kapasitas yang sesuai
        $queryInsert = "INSERT INTO peminjaman (user_id, ruangan_id, waktu_mulai, selesai, status, keterangan, kapasitas) 
                        VALUES ('$user_id', '$ruangan_id', '$waktu_mulai', '$selesai', 'pending', '$keterangan', '$kapasitas')";

        if (mysqli_query($conn, $queryInsert)) {
            echo "<script>alert('Peminjaman berhasil diajukan!'); window.location.href='?page=manajemen_peminjaman';</script>";
        } else {
            echo "<script>alert('Gagal mengajukan peminjaman.');</script>";
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

                            <div class="form-group">
                                <label for="waktu_mulai">Waktu Mulai</label>
                                <input type="datetime-local" name="waktu_mulai" id="waktu_mulai" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="selesai">Waktu Selesai</label>
                                <input type="datetime-local" name="selesai" id="selesai" class="form-control" required>
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
<script src="adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="adminlte/dist/js/adminlte.min.js"></script>

<script>
    $(document).ready(function () {
        $("#ruangan_id").change(function () {
            let kapasitas = $(this).find(':selected').data('kapasitas');
            $("#kapasitas").val(kapasitas ? kapasitas : '');
        });

        // Cek ketersediaan ruangan sebelum submit
        $("form").on("submit", function (e) {
            let ruangan_id = $("#ruangan_id").val();
            let waktu_mulai = $("#waktu_mulai").val();
            let selesai = $("#selesai").val();

            if (ruangan_id && waktu_mulai && selesai) {
                $.ajax({
                    url: "cek_ketersediaan.php",
                    method: "POST",
                    data: { ruangan_id: ruangan_id, waktu_mulai: waktu_mulai, selesai: selesai },
                    success: function (response) {
                        if (response === "terpakai") {
                            alert("Ruangan sudah dipakai di waktu yang dipilih. Silakan pilih waktu lain.");
                            e.preventDefault();
                        }
                    }
                });
            }
        });
    });
</script>

</body>
</html>
