<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ruangan_id = $_POST['ruangan_id'];
    $waktu_mulai = $_POST['waktu_mulai'];
    $selesai = $_POST['selesai'];

    $cekQuery = "SELECT * FROM peminjaman 
                 WHERE ruangan_id = '$ruangan_id' 
                 AND ('$waktu_mulai' < selesai AND '$selesai' > waktu_mulai)";
    
    $resultCek = mysqli_query($conn, $cekQuery);

    echo (mysqli_num_rows($resultCek) > 0) ? "terpakai" : "tersedia";
}
?>

