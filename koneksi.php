<?php

$host = "localhost"; 
$username = "root";  // 
$password = "";      
$dbname = "peminjaman_ruangan"; 


$conn = mysqli_connect($host, $username, $password, $dbname);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Jika berhasil, simpan koneksi dalam variabel $koneksi
$koneksi = $conn;
?>
