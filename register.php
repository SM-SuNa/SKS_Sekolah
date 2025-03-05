<?php
include "koneksi.php"; // Pastikan koneksi database sudah benar

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $role = "user"; 

    // Cek apakah email sudah digunakan
    $check_email = mysqli_query($koneksi, "SELECT * FROM user WHERE email = '$email'");
    if (mysqli_num_rows($check_email) > 0) {
        echo "<script>alert('Email sudah terdaftar!'); window.location='register.php';</script>";
    } else {
        // Simpan ke database
        $query = "INSERT INTO user (nama_lengkap, username, password, email, role) 
                  VALUES ('$nama', '$username', '$password', '$email', '$role')";

        if (mysqli_query($koneksi, $query)) {
            header("Location: login.php"); // Redirect ke login setelah berhasil daftar
            exit();
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen items-center justify-center bg-gray-100">

    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
        <div class="text-center">
            <img class="mx-auto w-32" src="assets/img/neper.png" alt="Logo">
            <h2 class="mt-4 text-xl font-bold text-gray-900">Buat Akun Barumu</h2>
        </div>

        <form class="mt-6" action="register.php" method="POST">
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-900">Nama Lengkap</label>
                <input id="nama" name="nama" type="text" required class="w-full px-3 py-2 border rounded focus:ring focus:ring-indigo-200">
            </div>

            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-900">Username</label>
                <input id="username" name="username" type="text" required class="w-full px-3 py-2 border rounded focus:ring focus:ring-indigo-200">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-900">Email</label>
                <input id="email" name="email" type="email" required class="w-full px-3 py-2 border rounded focus:ring focus:ring-indigo-200">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
                <input id="password" name="password" type="password" required class="w-full px-3 py-2 border rounded focus:ring focus:ring-indigo-200">
            </div>

            <div class="mt-6">
                <button type="submit" name="submit" class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">
                    Sign up
                </button>
            </div>
        </form>

        <p class="mt-4 text-center text-sm text-gray-500">
            Sudah punya akun?
            <a href="login.php" class="text-indigo-600">Masuk</a>
        </p>
    </div>

</body>
</html>
