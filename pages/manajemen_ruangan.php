<?php
include "koneksi.php";

// Ambil data ruangan
$query = "SELECT * FROM ruangan";
$result = mysqli_query($conn, $query);
?>

<div class="content-wrapper">
    <div class="content-header">
        <h1>Manajemen Ruangan</h1>
        <a href="?page=tambah_ruangan" class="btn btn-primary mb-3">Tambah Ruangan</a>
    </div>
    <div class="content">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Ruangan</th>
                    <th>Kapasitas</th>
                    <th>Lokasi</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$no}</td>
                        <td>{$row['nama_ruangan']}</td>
                        <td>{$row['kapasitas']}</td>
                        <td>{$row['lokasi']}</td>
                        <td>{$row['keterangan']}</td>
                        <td>
                            <a href='?page=edit_ruangan&id={$row['id']}' class='btn btn-warning'>Edit</a>
                            <a href='?page=hapus_ruangan&id={$row['id']}' class='btn btn-danger' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                        </td>
                    </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
