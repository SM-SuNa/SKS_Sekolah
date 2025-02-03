<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Peminjaman Ruangan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .hero {
            background: url('banner.jpg') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .highlight {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }
        .highlight div {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Sistem Peminjaman</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#peminjaman">Peminjaman</a></li>
                    <li class="nav-item"><a class="nav-link" href="#riwayat">Riwayat</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <h1>Pinjam Ruangan dengan Mudah</h1>
        <p>Kelola peminjaman ruangan secara cepat dan efisien</p>
        <a href="#peminjaman" class="btn btn-primary">Pinjam Sekarang</a>
    </div>

    <!-- Keunggulan -->
    <div class="container mt-5">
        <h2 class="text-center">Keunggulan Sistem</h2>
        <div class="highlight">
            <div>
                <h4>Mudah Digunakan</h4>
                <p>Interface sederhana dan user-friendly.</p>
            </div>
            <div>
                <h4>Real-Time Update</h4>
                <p>Data selalu diperbarui secara langsung.</p>
            </div>
            <div>
                <h4>Notifikasi Otomatis</h4>
                <p>Dapatkan informasi status peminjaman.</p>
            </div>
        </div>
    </div>

    <!-- Halaman Peminjaman -->
    <div class="container mt-5" id="peminjaman">
        <h2>Peminjaman Ruangan</h2>
        <form>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Peminjam</label>
                <input type="text" class="form-control" id="nama">
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal & Waktu</label>
                <input type="datetime-local" class="form-control" id="tanggal">
            </div>
            <div class="mb-3">
                <label for="ruangan" class="form-label">Ruangan</label>
                <select class="form-control" id="ruangan">
                    <option>Lab 1</option>
                    <option>Lab 2</option>
                    <option>Ruang Rapat</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="keperluan" class="form-label">Keperluan</label>
                <textarea class="form-control" id="keperluan"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Ajukan Peminjaman</button>
        </form>
    </div>

    <!-- Halaman Riwayat -->
    <div class="container mt-5" id="riwayat">
        <h2>Riwayat Peminjaman</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Ruangan</th>
                    <th>Waktu Peminjaman</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Lab 1</td>
                    <td>01-02-2025 10:00</td>
                    <td>Disetujui</td>
                    <td><button class="btn btn-danger btn-sm">Batalkan</button></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center p-3 mt-5">
        <p>Hak Cipta &copy; 2025 Sistem Peminjaman Ruangan</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
