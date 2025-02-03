<?php
// koneksi.php
$host = "localhost"; // Ganti dengan host database Anda, misalnya 'localhost'
$username = "root";  // Ganti dengan username database Anda
$password = "";      // Ganti dengan password database Anda
$dbname = "peminjaman_ruangan"; // Ganti dengan nama database Anda

// Membuat koneksi menggunakan mysqli_connect
$conn = mysqli_connect($host, $username, $password, $dbname);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Jika berhasil, simpan koneksi dalam variabel $koneksi
$koneksi = $conn;
?>
