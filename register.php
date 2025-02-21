<?php
include "koneksi.php"; // Pastikan koneksi database sudah benar

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $email = $_POST['email'];
    $role = $_POST['role']; // Ambil role dari form

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto w-32" src="aset/ROOMTY.jpg" alt="Your Company">
            <h2 class="mt-10 text-center text-2xl font-bold text-gray-900">Create your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="register.php" method="POST">
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-900">Nama Lengkap</label>
                    <input id="nama" name="nama" type="text" required class="w-full px-3 py-2 border rounded">
                </div>

                <div>
                    <label for="username" class="block text-sm font-medium text-gray-900">Username</label>
                    <input id="username" name="username" type="text" required class="w-full px-3 py-2 border rounded">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-900">Email</label>
                    <input id="email" name="email" type="email" required class="w-full px-3 py-2 border rounded">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
                    <input id="password" name="password" type="password" required class="w-full px-3 py-2 border rounded">
                </div>

                <div>
                    <label for="role" class="block text-sm font-medium text-gray-900">Role</label>
                    <select id="role" name="role" required class="w-full px-3 py-2 border rounded">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div>
                    <button type="submit" name="submit" class="w-full bg-indigo-600 text-white py-2 rounded">Sign up</button>
                </div>
            </form>

            <p class="mt-4 text-center text-sm text-gray-500">
                Have an account?
                <a href="login.php" class="text-indigo-600">Sign in</a>
            </p>
        </div>
    </div>

</body>
</html>
