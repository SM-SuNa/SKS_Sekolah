<?php
include "../koneksi.php"; // Pastikan path ini benar

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Cek apakah id valid
    if ($id <= 0) {
        echo "<script>alert('ID tidak valid!'); window.history.back();</script>";
        exit();
    }

    // Cek apakah user ada di database
    $queryCheck = "SELECT * FROM user WHERE id = $id";
    $resultCheck = mysqli_query($conn, $queryCheck);
    
    if (mysqli_num_rows($resultCheck) > 0) {
        // Hapus user
        $queryDelete = "DELETE FROM user WHERE id = $id";
        if (mysqli_query($conn, $queryDelete)) {
            echo "<script>alert('User berhasil dihapus!'); window.location.href='../index.php?page=manajemen_pengguna';</script>";
        } else {
            echo "<script>alert('Gagal menghapus user: " . mysqli_error($conn) . "'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('User tidak ditemukan!'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('ID tidak ditemukan!'); window.history.back();</script>";
}
?>
