<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
    .custom-image {
        width: 150px; /* Atur lebar sesuai kebutuhan */
        height: auto; /* Tinggi otomatis untuk menjaga proporsi */
    }
</style>
<body>

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <?php
            ob_start();
            include "koneksi.php";
            if (isset($_POST['submit'])) {
                $nama = $_POST['nama'];
                $username = $_POST['username'];
                $password = $_POST['password'];

                $result = mysqli_query(
                    $koneksi,
                    "INSERT INTO users(nama, username, password) VALUES('$nama','$username', '$password')"
                );

                if ($result) {
                    header("Location: login.php");
                } else {
                    echo "Error: " . mysqli_error($koneksi);
                }
            }
            ?>
            <img class="mx-auto custom-image" src="aset/ROOMTY.jpg" alt="Your Company">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Create your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="#" method="POST">
                <div>
                    <label for="nama" class="block text-sm font-medium leading-6 text-gray-900">Nama Lengkap</label>
                    <div class="mt-2">
                        <input id="nama" name="nama" type="nama" autocomplete="nama" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div>
                    <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                    <div class="mt-2">
                        <input id="username" name="username" type="username" autocomplete="username" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>

                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" name="submit">Sign up</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Have an account?
                <a href="login.php" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Sign in</a>
            </p>
        </div>
    </div>

</body>

</html>