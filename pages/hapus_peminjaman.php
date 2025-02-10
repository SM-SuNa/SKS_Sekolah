<?php
include "../koneksi.php"; // Pastikan path ini benar

if (isset($_GET['id']) && isset($_GET['type'])) {
    $id = intval($_GET['id']);
    $type = $_GET['type'];

    // Cek apakah id valid
    if ($id <= 0) {
        echo "<script>alert('ID tidak valid!'); window.history.back();</script>";
        exit();
    }

    // Tentukan tabel berdasarkan tipe
    $table = "";
    if ($type === 'peminjaman') {
        $table = "peminjaman";
    } elseif ($type === 'ruangan') {
        $table = "ruangan";
    } elseif ($type === 'user') {
        $table = "user";
    } else {
        echo "<script>alert('Tipe tidak valid!'); window.history.back();</script>";
        exit();
    }

    // Eksekusi query penghapusan
    $query = "DELETE FROM $table WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil dihapus!'); window.location.href='../index.php?page=manajemen_$type';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data: " . mysqli_error($conn) . "'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('ID tidak ditemukan!'); window.history.back();</script>";
}
?>
