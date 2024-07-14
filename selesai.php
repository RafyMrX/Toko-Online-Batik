<?php
include 'header.php';

// Ensure session is started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['inv'])) {
    $inv = $_SESSION['inv'];
    $result = mysqli_query($conn, "SELECT * FROM produksi WHERE kode_customer = '$kode_cs' AND invoice = '$inv'");
    $row = mysqli_fetch_assoc($result);
    $data = $row['tanggal'];
    $ongkir = $row['ongkir'];
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<div class="container" style="padding-bottom: 300px;">
    <div class="row">
        <?php
        if (!isset($_SESSION['cek']) && !isset($_SESSION['inv'])) {
            if (isset($_SESSION['msg'])) {
        ?>
                <div class="col-md-6">
                    <h3 class="alert-success">Pembayaran Berhasil Resi Akan Dikirimkan Ke Alamat Email Anda</h3>
                    <div id="timer" style="font-size: 40px;" class="alert-warning text-center"></div>
                </div>
            <?php
                unset($_SESSION['msg']);
            } else {
            ?>
                <div class="col-md-6">
                    <h3 class="alert-warning">Tidak Ada Pesanan</h3>
                    <div id="timer" style="font-size: 40px;" class="alert-warning text-center"></div>
                </div>
            <?php
            }
        }

        if (isset($_SESSION['cek']) && isset($_SESSION['inv'])) {
            ?>
            <div class="container" style="padding-bottom: 300px;">
                <h2 class="bg-success" style="padding: 10px;">Checkout Berhasil</h2>
                <div class="row">
                    <div class="col-md-8">
                        <h3>Sisa Waktu Pembayaran :</h3>
                        <div id="timer" style="font-size: 40px;" class="alert-warning text-center"></div>
                        <table class="table table-striped" style="background-color: #fff;">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Sub Total</th>
                            </tr>
                            <?php
                            $result = mysqli_query($conn, "SELECT p.nama, o.harga, o.qty 
                                                       FROM produksi o 
                                                       JOIN produk p ON o.kode_produk = p.kode_produk 
                                                       WHERE o.kode_customer = '$kode_cs' AND o.invoice = '$inv'");
                            $no = 1;
                            $hasil = 0;
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Ensure the harga value is properly formatted as a number
                                $harga = floatval(str_replace(',', '', $rows['harga']));
                                $subtotal = $harga * $rows['qty'];
                                $hasil += $subtotal;
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $rows['nama']; ?></td>
                                    <td>Rp.<?= number_format($harga); ?></td>
                                    <td><?= $rows['qty']; ?></td>
                                    <td>Rp.<?= number_format($subtotal); ?></td>
                                </tr>
                            <?php
                                $no++;
                            }
                            // Ensure the ongkir value is properly formatted as a number
                            $ongkir = floatval(str_replace(',', '', $ongkir));
                            ?>
                            <tr>
                                <td colspan="5" style="text-align: right; font-weight: bold;">Ongkir = Rp. <?= number_format($ongkir); ?></td>
                            </tr>
                            <tr>
                                <td colspan="5" style="text-align: right; font-weight: bold;">Grand Total = Rp. <?= number_format($hasil + $ongkir); ?></td>
                            </tr>
                        </table>
                        <h4>Bayar Sesuai Nominal Dibawah ini :</h4>
                        <table class="table table-striped">
                            <tr>
                                <th>Total yang Harus dibayar</th>
                                <th bgcolor="#EE5A24" style="color: #fff">Rp. <?= number_format($hasil + $ongkir); ?></th>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <h4>Informasi Pembayaran</h4>
                        <table class="table table-striped">
                            <tr>
                                <td>Atas Nama</td>
                                <td>YOHAFA</td>
                            </tr>
                            <tr>
                                <td>No Rekening</td>
                                <td>4581321302266340</td>
                            </tr>
                            <tr>
                                <td>Bank</td>
                                <td>BRI</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h4>Silahkan Upload Bukti Pembayaran disini :</h4>
                        <form action="proses/bukti.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="cs" value="<?= $kode_cs; ?>">
                            <input type="hidden" name="inv" value="<?= $inv; ?>">
                            <div class="form-group">
                                <label>Pilih Gambar</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-warning">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<script>
    var countDownDate = new Date("<?php echo $data; ?>").getTime();

    var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = countDownDate - now;

        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("timer").innerHTML = hours + "h : " + minutes + "m : " + seconds + "s ";

        if (distance < 1) {
            $.ajax({
                type: 'POST',
                url: 'http://localhost/inovasi/cek.php',
                success: function(data) {
                    console.log(data);
                }
            });

            clearInterval(x);
            document.getElementById("timer").innerHTML = "Batas Waktu Pembayaran Telah Berakhir";
        }
    }, 1000);
</script>

<?php
include 'footer.php';
?>
