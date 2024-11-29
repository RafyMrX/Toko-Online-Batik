<?php 
include 'header.php';

$date = date('Y-m-d'); // Format tanggal yang benar
$date1 = $date;
$date2 = $date;

if(isset($_POST['submit'])){
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];
}
?>

<style type="text/css">
    body, html {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
    }

    .container {
        flex: 1;
        background: rgba(255, 255, 255, 0.9);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    body {
        background: url('path/to/electronics-theme-background.jpg') no-repeat center center fixed;
        background-size: cover;
        color: #333;
    }

    h2 {
        color: #007BFF;
    }

    .btn-primary {
        background-color: #007BFF;
        border-color: #007BFF;
        color: white;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
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

    @media print {
        .print {
            display: none;
        }
    }
</style>

<div class="container">
    <h2 style="width: 100%; border-bottom: 4px solid gray; padding-bottom: 5px;"><b>Laporan Penjualan</b></h2>
    <div class="row print">
        <div class="col-md-9">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <table>
                    <tr>
                        <td><input type="date" name="date1" class="form-control" value="<?= htmlspecialchars($date1); ?>"></td>
                        <td>&nbsp; - &nbsp;</td>
                        <td><input type="date" name="date2" class="form-control" value="<?= htmlspecialchars($date2); ?>"></td>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="submit" class="btn btn-primary" value="Tampilkan"></td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="col-md-3">
            <form action="exp_omset.php" method="POST">
                <table>
                    <tr>
                        <td><input type="hidden" name="date1" class="form-control" value="<?= htmlspecialchars($date1); ?>"></td>
                        <td><input type="hidden" name="date2" class="form-control" value="<?= htmlspecialchars($date2); ?>"></td>
                        <td><button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-save-file"></i> Export to Excel</button></td>
                        <td>&nbsp;</td>
                        <td><a href="" onclick="window.print()" class="btn btn-default"><i class="glyphicon glyphicon-print"></i> Cetak</a></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <br>
    <br>
    <table class="table table-striped">
        <tr>
            <th>No</th>
            <th>Invoice</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Subtotal</th>
            <th>Tanggal</th>
        </tr>
        <?php 
        if(isset($_POST['submit'])){
            $result = mysqli_query($conn, "SELECT * FROM produksi WHERE terima = 1 AND tgl BETWEEN '$date1' AND '$date2'");
            if ($result) {
                $no = 1;
                $total = 0;
                $t = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($no); ?></td>
                        <td><?= htmlspecialchars($row['invoice']); ?></td>
                        <td><?= htmlspecialchars($row['nama_produk']); ?></td>
                        <td><?= number_format($row['harga']); ?></td>
                        <td><?= htmlspecialchars($row['qty']); ?></td>
                        <td><?= number_format($row['harga'] * $row['qty']); ?></td>
                        <td><?= htmlspecialchars($row['tgl']); ?></td>
                    </tr>
                    <?php 
                    $t += $row['qty'];
                    $total += $row['harga'] * $row['qty'];
                    $no++;
                }
                ?>
                <tr>
                    <td colspan="7" class="text-right"><b>Total Penjualan = <?= htmlspecialchars($t); ?></b></td>
                </tr>
                <tr>
                    <td colspan="7" class="text-right alert-success"><b>Total Pendapatan = <?= number_format($total); ?></b></td>
                </tr>
                <?php 
            } else {
                echo '<tr><td colspan="7">Tidak ada data</td></tr>';
            }
        }
        ?>
    </table>
</div>

<?php 
include 'footer.php';
?>
