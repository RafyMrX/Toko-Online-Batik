<?php
include 'header.php';
$kd = mysqli_real_escape_string($conn,$_GET['kode_cs']);
$cs = mysqli_query($conn, "SELECT * FROM customer WHERE kode_customer = '$kd'");
$rows = mysqli_fetch_assoc($cs);
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="container" style="padding-bottom: 200px">
    <h2 style=" width: 100%; border-bottom: 4px solid #ff8680"><b>Checkout</b></h2>
    <div class="row">
        <div class="col-md-6">
            <h4>Daftar Pesanan</h4>
            <table class="table table-stripped">
                <thead>   
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Ukuran</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Sub Total</th>
              </tr>
                </thead>
                <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT k.*, p.harga as harga FROM keranjang k JOIN produk p ON k.kode_produk = p.kode_produk WHERE k.kode_customer = '$kd'");

                $no = 1;
                $hasil = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                     // Ambil harga dan ukuran dari produk
                      $harga_list = explode(',', $row['harga_produk']);
                    $ukuran_list = explode(',', $row['ukuran_produk']);

                     // Temukan indeks ukuran yang sesuai
                     $ukuran_index = array_search($row['ukuran'], $ukuran_list);

                     if ($ukuran_index !== false) {
                         $harga = floatval($harga_list[$ukuran_index]);
                     } else {
                         $harga = 0; // Handle jika ukuran tidak ditemukan
                     }

                     $qty = intval($row['qty']);
                     $subtotal = $harga * $qty;
                     $grand_total += $subtotal;
                 ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $row['nama_produk']; ?></td>
                        <td><?= strtoupper($row['ukuran']); ?></td>
                        <td>Rp.<?= number_format($harga); ?></td>
                        <td><?= $qty; ?></td>
                        <td>Rp.<?= number_format($subtotal); ?></td>
                    </tr>
                    <?php
                    $no++;
                }
                ?>
                <tr>
                    <td colspan="5" style="text-align: right; font-weight: bold;">Grand Total</td>
                    <td>Rp.<?= number_format($grand_total); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 bg-success">
            <h5>Pastikan Pesanan Anda Sudah Benar</h5>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6 bg-warning">
            <h5>Isi Form dibawah ini </h5>
        </div>
    </div>
    <br>
    <div class="alert alert-danger" id="alamat-alert" style="display: none;">
        <strong>Perhatian!</strong> Silakan isi alamat lengkap Anda sebelum melanjutkan pembayaran.
    </div>
    <form id="checkout-form" action="proses/order.php" method="POST">
        <input type="hidden" name="kode_cs" value="<?= $kd; ?>">
        <input type="hidden" id="berat" name="berat" value="<?= $jum; ?>">
        <div class="form-group">
            <label for="exampleInputEmail1">Nama</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama" name="nama" style="width: 557px;" value="<?= $rows['nama']; ?>" readonly>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="provinsi">Provinsi</label>
                    <select id="provinsi" name="provinsi" class="form-control">
                        <option value="">Pilih Provinsi</option>
                        <option value="Aceh">Aceh</option>
                        <option value="Bali">Bali</option>
                        <option value="Bangka Belitung">Bangka Belitung</option>
                        <option value="Banten">Banten</option>
                        <option value="Bengkulu">Bengkulu</option>
                        <option value="Gorontalo">Gorontalo</option>
                        <option value="Jakarta">Jakarta</option>
                        <option value="Jambi">Jambi</option>
                        <option value="Jawa Barat">Jawa Barat</option>
                        <option value="Jawa Tengah">Jawa Tengah</option>
                        <option value="Jawa Timur">Jawa Timur</option>
                        <option value="Kalimantan Barat">Kalimantan Barat</option>
                        <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                        <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                        <option value="Kalimantan Timur">Kalimantan Timur</option>
                        <option value="Kalimantan Utara">Kalimantan Utara</option>
                        <option value="Kepulauan Riau">Kepulauan Riau</option>
                        <option value="Lampung">Lampung</option>
                        <option value="Maluku">Maluku</option>
                        <option value="Maluku Utara">Maluku Utara</option>
                        <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                        <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                        <option value="Papua">Papua</option>
                        <option value="Papua Barat">Papua Barat</option>
                        <option value="Riau">Riau</option>
                        <option value="Sulawesi Barat">Sulawesi Barat</option>
                        <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                        <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                        <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                        <option value="Sulawesi Utara">Sulawesi Utara</option>
                        <option value="Sumatera Barat">Sumatera Barat</option>
                        <option value="Sumatera Selatan">Sumatera Selatan</option>
                        <option value="Sumatera Utara">Sumatera Utara</option>
                        <option value="Yogyakarta">Yogyakarta</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="kota">Kota/Kabupaten</label>
                    <input type="text" class="form-control" id="kota" placeholder="Kota/Kabupaten" name="kota">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputPassword1">Alamat</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Alamat" name="almt">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputPassword1">Kode Pos</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Kode Pos" name="kopos">
                </div>
            </div>
        </div>
        <div class="row" style="border-bottom: 2px solid #cacaca; margin-bottom: 18px;">
            <div class="col-md-6">
                <div class="form-group">    
                    <label>Kurir</label>
                    <select id="kurir" name="kurir" class="form-control">
                        <option selected>-- Pilih Kurir --</option>
                        <option value="jne">JNE</option>
                        <option value="tiki">TIKI</option>
                        <option value="pos">POS INDONESIA</option>
                    </select>
                </div>
            </div>
        </div>
        <button type="button" id="order-btn" class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart"></i> Order Sekarang</button>
        <a href="keranjang.php" class="btn btn-danger">Cancel</a>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#provinsi').change(function(){
            var provinsi = $(this).val();
            // Simulasi pengambilan data kota/kabupaten berdasarkan provinsi
            // Anda dapat menyesuaikan ini dengan kebutuhan Anda
            $.ajax({
                type : 'POST',
                url : 'get_kota.php', // Sesuaikan dengan file PHP yang digunakan untuk mengambil data kota/kabupaten berdasarkan provinsi
                data :  'provinsi=' + provinsi,
                success: function (response) {
                    $("#kota").val(response); // Isi nilai kota/kabupaten berdasarkan provinsi yang dipilih
                }
            });
        });

        $("#kurir").change(function(){
            var kurir = $(this).val();
            // Mengisi bagian ini sesuai kebutuhan untuk memilih paket pengiriman
            // Anda bisa menyesuaikan dengan pilihan yang ada dan menggantinya dengan logika yang sesuai
        });

        $("#order-btn").click(function(){
            // Memeriksa apakah alamat lengkap sudah terisi sebelum melanjutkan
            var alamat = $("input[name=almt]").val();
            var kota = $("#kota").val();
            var provinsi = $("#provinsi").val();
            if(alamat === "" || kota === "" || provinsi === "") {
                $("#alamat-alert").show();
            } else {
                $("#checkout-form").submit();
            }
        });
    });
</script>

<?php 
include 'footer.php';
?>
