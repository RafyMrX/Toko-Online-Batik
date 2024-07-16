<?php 
include 'header.php';
$sortage = mysqli_query($conn, "SELECT * FROM produksi where cek = '1'");
$cek_sor = mysqli_num_rows($sortage);
?>

<style>
    body {
        background: url('path/to/electronics-theme-background.jpg') no-repeat center center fixed;
        background-size: cover;
        color: #333;
    }
    .container {
        background: rgba(255, 255, 255, 0.9);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }
    h2 {
        color: #007BFF;
    }
    .bg-success {
        background-color: #28a745 !important;
    }
    .btn-default {
        background-color: #f8f9fa;
        border-color: #ced4da;
        color: #333;
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .table th {
        background-color: #007BFF;
        color: white;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 123, 255, 0.1);
    }
</style>

<div class="container">
    <h2 style="width: 100%; border-bottom: 4px solid gray"><b>Daftar Pesanan</b></h2>
    <br>
    <h5 class="bg-success" style="padding: 7px; width: 710px; font-weight: bold;">
        <marquee>Lakukan Reload Setiap Masuk Halaman ini, untuk menghindari terjadinya kesalahan data dan informasi</marquee>
    </h5>
    <a href="produksi.php" class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i> Reload</a>
    <br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Invoice</th>
                <th scope="col">Kode Customer</th>
                <th scope="col">Status</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $result = mysqli_query($conn, "SELECT DISTINCT invoice, kode_customer, status, kode_produk, qty, terima, tolak, cek, tgl FROM produksi GROUP BY invoice");
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $kodep = $row['kode_produk'];
                $inv = $row['invoice'];
                ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $row['invoice']; ?></td>
                    <td><?= $row['kode_customer']; ?></td>
                    <td>
                        <?php if ($row['terima'] == 1) { ?>
                            <span style="color: green; font-weight: bold;">Pesanan Diterima (Siap Kirim)</span>
                        <?php } elseif ($row['tolak'] == 1) { ?>
                            <span style="color: red; font-weight: bold;">Pesanan Ditolak</span>
                        <?php } elseif ($row['terima'] == 0 && empty($row['images'])) { ?>
                            <span style="color: orange; font-weight: bold;">Pesanan Baru</span>
                        <?php } ?>
                    </td>
                    <td><?= $row['tgl']; ?></td>
                    <td>
                        <?php if ($row['terima'] == 0 && $row['tolak'] == 0) { ?>
                            <a href="proses/terima.php?inv=<?= $row['invoice']; ?>&kdp=<?= $row['kode_produk']; ?>" class="btn btn-success">
                                <i class="glyphicon glyphicon-ok-sign"></i> Terima
                            </a> 
                            <a href="proses/tolak.php?inv=<?= $row['invoice']; ?>" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menolak ?')">
                                <i class="glyphicon glyphicon-remove-sign"></i> Tolak
                            </a> 
                        <?php } ?>
                        <a href="detailorder.php?inv=<?= $row['invoice']; ?>&cs=<?= $row['kode_customer']; ?>" class="btn btn-primary">
                            <i class="glyphicon glyphicon-eye-open"></i> Detail Pesanan
                        </a>
                    </td>
                </tr>
                <?php
                $no++; 
            }
            ?>
        </tbody>
    </table>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<?php 
include 'footer.php';
?>
