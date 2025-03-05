<?php
include 'koneksi.php';
session_start();

$login_failed = false; // Variabel untuk menandakan kegagalan login

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        // Gunakan prepared statement
        $stmt = $koneksi->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($data = $result->fetch_assoc()) {
            // Verifikasi password yang di-hash
            if (password_verify($password, $data['password'])) {
                $_SESSION['username'] = $data['username'];
                $_SESSION['role'] = $data['role']; // Simpan role dalam session

                // Periksa role dan arahkan sesuai
                if ($data['role'] == 'admin') {
                    header('location: index.php');
                    exit;
                } else {
                    header('location: user.php');
                    exit;
                }
            }
        }
        $login_failed = true; // Set jika login gagal
    } else {
        $login_failed = true; // Set jika username atau password kosong
    }
}
?>

<style>
    .custom-image {
        width: 150px;
        height: auto;
    }
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Tampilkan modal jika login gagal
        window.onload = function() {
            <?php if ($login_failed): ?>
                document.getElementById('loginFailedModal').classList.remove('hidden');
            <?php endif; ?>
        };

        function closeModal() {
            document.getElementById('loginFailedModal').classList.add('hidden');
        }
    </script>
</head>

<body class="bg-gray-50">

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto custom-image" src="assets/img/neper.png" alt="Your Company">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Login</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="#" method="POST">
                <div>
                    <label for="username" class="block text-sm font-bold leading-6 text-gray-900">Username</label>
                    <div class="mt-2">
                        <input id="username" name="username" type="username" autocomplete="username" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-bold leading-6 text-gray-900">Password</label>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        name="submit">Sign in</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Belum punya akun?
                <a href="register.php" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Daftar</a>
            </p>
        </div>
    </div>

    <!-- Modal -->
    <div id="loginFailedModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg p-6 max-w-sm w-full">
            <h2 class="text-lg font-bold text-center">Login Gagal</h2>
            <p class="mt-4 text-center">Username atau password salah. Pastikan Anda memasukkan <span
                    class="text-red-500">Username</span> dan <span class="text-red-500">Password</span> yang benar.</p>
            <div class="mt-6 flex justify-center">
                <button onclick="closeModal()" class="rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-500">Ok</button>
            </div>
        </div>
    </div>

</body>

</html>
