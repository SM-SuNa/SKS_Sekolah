<?php
include "koneksi.php";

// Periksa apakah parameter `id` dikirim melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data user berdasarkan ID
    $query = "SELECT * FROM user WHERE id = $id";
    $result = mysqli_query($conn, $query);

    // Periksa apakah data ditemukan
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Data user tidak ditemukan!'); window.location.href='?page=manajemen_pengguna';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID user tidak ditemukan!'); window.location.href='?page=manajemen_pengguna';</script>";
    exit;
}

// Proses update data user
if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $role = $_POST['role'];

    // Cek apakah password diubah
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password baru
        $query_update = "UPDATE user SET username = '$username', password = '$password', role = '$role' WHERE id = $id";
    } else {
        $query_update = "UPDATE user SET username = '$username', role = '$role' WHERE id = $id";
    }

    if (mysqli_query($conn, $query_update)) {
        echo "<script>alert('Data user berhasil diperbarui!'); window.location.href='?page=manajemen_pengguna';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data user!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- Tambahkan link CSS AdminLTE -->
    <link rel="stylesheet" href="adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit User</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form Edit User</h3>
                    </div>
                    <form method="POST" action="">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" 
                                       value="<?= $user['username'] ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password (kosongkan jika tidak ingin mengubah)</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control" required>
                                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                    <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" name="update" class="btn btn-success">Simpan Perubahan</button>
                            <a href="?page=manajemen_pengguna" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- Tambahkan script AdminLTE -->
<script src="adminlte/plugins/jquery/jquery.min.js"></script>
<script src="adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
