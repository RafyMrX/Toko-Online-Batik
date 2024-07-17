<?php
include 'header.php';

$kd = mysqli_real_escape_string($conn, $_GET['kode_cs']);
$cs = mysqli_query($conn, "SELECT * FROM customer WHERE kode_customer = '$kd'");
$rows = mysqli_fetch_assoc($cs);

// Proses form jika ada data POST yang dikirimkan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $provinsi = $_POST['provinsi'];
    $kota = $_POST['kota'];
    $alamat = $_POST['almt'];
    $kode_pos = $_POST['kopos'];
    $kurir = $_POST['kurir'];

    // Validasi jika ada field yang kosong
    if (empty($nama) || empty($provinsi) || empty($kota) || empty($alamat) || empty($kode_pos) || empty($kurir)) {
        echo '<div class="alert alert-danger" role="alert">Harap lengkapi semua kolom pada form!</div>';
    } else {
        // Lanjut ke proses order karena semua field sudah diisi
        // Lakukan proses order di sini
        // Misalnya, redirect ke halaman proses order
        header('Location: proses/order.php');
        exit;
    }
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="container" style="padding-bottom: 200px">
    <h2 style="width: 100%; border-bottom: 4px solid #ff8680"><b>Checkout</b></h2>
    <div class="row">
        <div class="col-md-6">
            <h4>Daftar Pesanan</h4>
            <table class="table table-striped">
                <!-- Isi tabel pesanan -->
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
            <h5>Isi Form di Bawah Ini</h5>
        </div>
    </div>
    <br>
    <form action="" method="POST">
        <input type="hidden" name="kode_cs" value="<?= $kd; ?>">
        <!-- Input form untuk nama, provinsi, kota, alamat, kode pos, kurir -->
        <div class="form-group">
            <label for="exampleInputEmail1">Nama</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama" name="nama" style="width: 557px;" value="<?= $rows['nama']; ?>" readonly>
        </div>
        <!-- Input untuk provinsi, kota/kabupaten, alamat, kode pos, kurir -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="provinsi">Provinsi</label>
                    <select id="provinsi" name="provinsi" class="form-control">
                        <option value="">Pilih Provinsi</option>
                        <option value="Aceh">Aceh</option>
                        <option value="Bali">Bali</option>
                        <!-- Daftar provinsi lainnya -->
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
        <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart"></i> Order Sekarang</button>
        <a href="keranjang.php" class="btn btn-danger">Cancel</a>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#provinsi').change(function() {
            var provinsi = $(this).val();
            // Ajax untuk mengambil data kota/kabupaten berdasarkan provinsi
            $.ajax({
                type: 'POST',
                url: 'get_kota.php',
                data: 'provinsi=' + provinsi,
                success: function(response) {
                    $("#kota").val(response);
                }
            });
        });

        $("#kurir").change(function() {
            var kurir = $(this).val();
            // Penanganan untuk memilih kurir
        });

        $("select[name=paket]").change(function() {
            // Penanganan untuk memilih paket pengiriman
        });
    });
</script>

<?php
include 'footer.php';
?>
