<?php
include "../koneksi.php"; // Pastikan path ini benar

if (isset($_GET['id']) && isset($_GET['type'])) {
    $id = intval($_GET['id']);
    $type = $_GET['type'];

    // Validasi ID
    if ($id <= 0) {
        $pesan = "ID tidak valid!";
        $status = "error";
    } else {
        // Tentukan tabel berdasarkan tipe
        $tabel_valid = ['peminjaman', 'ruangan', 'user'];
        if (in_array($type, $tabel_valid)) {
            $table = $type;
            
            // Eksekusi query penghapusan
            $query = "DELETE FROM $table WHERE id = $id";
            if (mysqli_query($conn, $query)) {
                $pesan = ucfirst($type) . " berhasil dihapus!";
                $status = "success";
                $redirect = "../booking.php?page=manajemen_$type";
            } else {
                $pesan = "Gagal menghapus data: " . mysqli_error($conn);
                $status = "error";
            }
        } else {
            $pesan = "Tipe tidak valid!";
            $status = "error";
        }
    }
} else {
    $pesan = "ID tidak ditemukan!";
    $status = "error";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penghapusan</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script>
        Swal.fire({
            title: "<?= $status == 'success' ? 'Sukses!' : 'Gagal!'; ?>",
            text: "<?= $pesan; ?>",
            icon: "<?= $status; ?>",
            confirmButtonText: "OK"
        }).then(() => {
            <?php if (isset($redirect)) : ?>
                window.location.href = "<?= $redirect; ?>";
            <?php else : ?>
                window.history.back();
            <?php endif; ?>
        });
    </script>
</body>
</html>
