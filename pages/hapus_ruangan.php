<?php
include "koneksi.php"; // Pastikan koneksi database ada

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Pastikan ID berupa angka

    // Cek apakah ruangan dengan ID tersebut ada
    $queryCheck = "SELECT * FROM ruangan WHERE id = $id";
    $resultCheck = mysqli_query($conn, $queryCheck);

    if (mysqli_num_rows($resultCheck) > 0) {
        // Hapus ruangan
        $queryDelete = "DELETE FROM ruangan WHERE id = $id";
        if (mysqli_query($conn, $queryDelete)) {
            echo "<script>alert('Ruangan berhasil dihapus!'); window.location.href='../index.php?page=manajemen_ruangan';</script>";
        } else {
            echo "<script>alert('Gagal menghapus ruangan!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Ruangan tidak ditemukan!'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('ID tidak valid!'); window.history.back();</script>";
}
?>
