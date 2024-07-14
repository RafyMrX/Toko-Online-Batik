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

<br>
<br>
<br>
<br>
<br>

<?php 
include 'footer.php';
?>