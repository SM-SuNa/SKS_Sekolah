<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Laporan</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <?php
        include "koneksi.php";
        $id = $_GET['id'];
        $query = "SELECT * FROM laporan WHERE id = $id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="card">
            <div class="card-body">
                <h3><?php echo $row['judul']; ?></h3>
                <p><strong>Tanggal:</strong> <?php echo $row['tanggal']; ?></p>
                <p><?php echo nl2br($row['isi']); ?></p>
            </div>
        </div>
    </section>
</div>
