<?php
include 'header.php';
$kd = mysqli_real_escape_string($conn, $_GET['kode_cs']);
$cs = mysqli_query($conn, "SELECT * FROM customer WHERE kode_customer = '$kd'");
$rows = mysqli_fetch_assoc($cs);
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="container" style="padding-bottom: 200px">
    <h2 style="width: 100%; border-bottom: 4px solid #ff8680"><b>Checkout</b></h2>
    <div class="row">
        <div class="col-md-6">
            <h4>Daftar Pesanan</h4>
            <table class="table table-striped">
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
                    $result = mysqli_query($conn, "SELECT k.*, p.nama AS nama_produk, p.harga AS harga_produk, p.ukuran AS ukuran_produk FROM keranjang k JOIN produk p ON k.kode_produk = p.kode_produk WHERE k.kode_customer = '$kd'");

                    $no = 1;
                    $grand_total = 0;
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
            <h5>Isi Form di Bawah Ini</h5>
        </div>
    </div>
    <br>
    <form id="checkoutForm" action="proses/order.php" method="POST" onsubmit="return validateForm()">
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
                    <select id="provinsi" name="provinsi" class="form-control" onchange="populateCities()">
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
                    <select id="kota" name="kota" class="form-control">
                        <option value="">Pilih Kota/Kabupaten</option>
                    </select>
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
    function validateForm() {
        var nama = document.forms["checkoutForm"]["nama"].value;
        var provinsi = document.forms["checkoutForm"]["provinsi"].value;
        var kota = document.forms["checkoutForm"]["kota"].value;
        var alamat = document.forms["checkoutForm"]["almt"].value;
        var kodePos = document.forms["checkoutForm"]["kopos"].value;
        var kurir = document.forms["checkoutForm"]["kurir"].value;

        if (nama == "" || provinsi == "" || kota == "" || alamat == "" || kodePos == "" || kurir == "-- Pilih Kurir --") {
            alert("Harap lengkapi semua field sebelum melanjutkan proses order.");
            return false;
        }
        return true;
    }

    function populateCities() {
        var provinsi = document.getElementById("provinsi").value;
        var kotaSelect = document.getElementById("kota");

        // Clear existing options
        while (kotaSelect.options.length > 0) {
            kotaSelect.remove(0);
        }

        // Populate cities based on selected province
        switch (provinsi) {
            case "Aceh":
                kotaSelect.options[kotaSelect.options.length] = new Option("Banda Aceh", "Banda Aceh");
                kotaSelect.options[kotaSelect.options.length] = new Option("Sabang", "Sabang");
                kotaSelect.options[kotaSelect.options.length] = new Option("Lhokseumawe", "Lhokseumawe");
                kotaSelect.options[kotaSelect.options.length] = new Option("Langsa", "Langsa");
                break;
            case "Bali":
                kotaSelect.options[kotaSelect.options.length] = new Option("Denpasar", "Denpasar");
                kotaSelect.options[kotaSelect.options.length] = new Option("Badung", "Badung");
                kotaSelect.options[kotaSelect.options.length] = new Option("Tabanan", "Tabanan");
                kotaSelect.options[kotaSelect.options.length] = new Option("Gianyar", "Gianyar");
                break;
            case "Bangka Belitung":
                kotaSelect.options[kotaSelect.options.length] = new Option("Pangkal Pinang", "Pangkal Pinang");
                kotaSelect.options[kotaSelect.options.length] = new Option("Toboali", "Toboali");
                kotaSelect.options[kotaSelect.options.length] = new Option("Mentok", "Mentok");
                break;
            case "Banten":
                kotaSelect.options[kotaSelect.options.length] = new Option("Serang", "Serang");
                kotaSelect.options[kotaSelect.options.length] = new Option("Tangerang", "Tangerang");
                kotaSelect.options[kotaSelect.options.length] = new Option("Cilegon", "Cilegon");
                kotaSelect.options[kotaSelect.options.length] = new Option("Serang", "Serang");
                break;
            case "Bengkulu":
                kotaSelect.options[kotaSelect.options.length] = new Option("Bengkulu", "Bengkulu");
                kotaSelect.options[kotaSelect.options.length] = new Option("Curup", "Curup");
                kotaSelect.options[kotaSelect.options.length] = new Option("Mukomuko", "Mukomuko");
                break;
            case "Gorontalo":
                kotaSelect.options[kotaSelect.options.length] = new Option("Gorontalo", "Gorontalo");
                kotaSelect.options[kotaSelect.options.length] = new Option("Kwandang", "Kwandang");
                kotaSelect.options[kotaSelect.options.length] = new Option("Pohuwato", "Pohuwato");
                break;
            case "Jakarta":
                kotaSelect.options[kotaSelect.options.length] = new Option("Jakarta Pusat", "Jakarta Pusat");
                kotaSelect.options[kotaSelect.options.length] = new Option("Jakarta Utara", "Jakarta Utara");
                kotaSelect.options[kotaSelect.options.length] = new Option("Jakarta Barat", "Jakarta Barat");
                kotaSelect.options[kotaSelect.options.length] = new Option("Jakarta Selatan", "Jakarta Selatan");
                kotaSelect.options[kotaSelect.options.length] = new Option("Jakarta Timur", "Jakarta Timur");
                break;
            case "Jambi":
                kotaSelect.options[kotaSelect.options.length] = new Option("Jambi", "Jambi");
                kotaSelect.options[kotaSelect.options.length] = new Option("Sungai Penuh", "Sungai Penuh");
                kotaSelect.options[kotaSelect.options.length] = new Option("Muara Bungo", "Muara Bungo");
                break;
            case "Jawa Barat":
                kotaSelect.options[kotaSelect.options.length] = new Option("Bandung", "Bandung");
                kotaSelect.options[kotaSelect.options.length] = new Option("Bekasi", "Bekasi");
                kotaSelect.options[kotaSelect.options.length] = new Option("Depok", "Depok");
                kotaSelect.options[kotaSelect.options.length] = new Option("Bogor", "Bogor");
                kotaSelect.options[kotaSelect.options.length] = new Option("Cimahi", "Cimahi");
                break;
            case "Jawa Tengah":
                kotaSelect.options[kotaSelect.options.length] = new Option("Semarang", "Semarang");
                kotaSelect.options[kotaSelect.options.length] = new Option("Surakarta", "Surakarta");
                kotaSelect.options[kotaSelect.options.length] = new Option("Pekalongan", "Pekalongan");
                kotaSelect.options[kotaSelect.options.length] = new Option("Tegal", "Tegal");
                kotaSelect.options[kotaSelect.options.length] = new Option("Magelang", "Magelang");
                break;
            case "Jawa Timur":
                kotaSelect.options[kotaSelect.options.length] = new Option("Surabaya", "Surabaya");
                kotaSelect.options[kotaSelect.options.length] = new Option("Malang", "Malang");
                kotaSelect.options[kotaSelect.options.length] = new Option("Sidoarjo", "Sidoarjo");
                kotaSelect.options[kotaSelect.options.length] = new Option("Mojokerto", "Mojokerto");
                kotaSelect.options[kotaSelect.options.length] = new Option("Probolinggo", "Probolinggo");
                break;
            case "Kalimantan Barat":
                kotaSelect.options[kotaSelect.options.length] = new Option("Pontianak", "Pontianak");
                kotaSelect.options[kotaSelect.options.length] = new Option("Singkawang", "Singkawang");
                kotaSelect.options[kotaSelect.options.length] = new Option("Ketapang", "Ketapang");
                kotaSelect.options[kotaSelect.options.length] = new Option("Sambas", "Sambas");
                break;
            case "Kalimantan Selatan":
                kotaSelect.options[kotaSelect.options.length] = new Option("Banjarmasin", "Banjarmasin");
                kotaSelect.options[kotaSelect.options.length] = new Option("Banjarbaru", "Banjarbaru");
                kotaSelect.options[kotaSelect.options.length] = new Option("Martapura", "Martapura");
                kotaSelect.options[kotaSelect.options.length] = new Option("Paringin", "Paringin");
                break;
            case "Kalimantan Tengah":
                kotaSelect.options[kotaSelect.options.length] = new Option("Palangka Raya", "Palangka Raya");
                kotaSelect.options[kotaSelect.options.length] = new Option("Sampit", "Sampit");
                kotaSelect.options[kotaSelect.options.length] = new Option("Kuala Kapuas", "Kuala Kapuas");
                kotaSelect.options[kotaSelect.options.length] = new Option("Muara Teweh", "Muara Teweh");
                break;
            case "Kalimantan Timur":
                kotaSelect.options[kotaSelect.options.length] = new Option("Samarinda", "Samarinda");
                kotaSelect.options[kotaSelect.options.length] = new Option("Balikpapan", "Balikpapan");
                kotaSelect.options[kotaSelect.options.length] = new Option("Bontang", "Bontang");
                kotaSelect.options[kotaSelect.options.length] = new Option("Tenggarong", "Tenggarong");
                break;
            case "Kalimantan Utara":
                kotaSelect.options[kotaSelect.options.length] = new Option("Tanjung Selor", "Tanjung Selor");
                kotaSelect.options[kotaSelect.options.length] = new Option("Tideng Pale", "Tideng Pale");
                kotaSelect.options[kotaSelect.options.length] = new Option("Tarakan", "Tarakan");
                break;
            case "Kepulauan Riau":
                kotaSelect.options[kotaSelect.options.length] = new Option("Batam", "Batam");
                kotaSelect.options[kotaSelect.options.length] = new Option("Tanjung Pinang", "Tanjung Pinang");
                kotaSelect.options[kotaSelect.options.length] = new Option("Bintan", "Bintan");
                kotaSelect.options[kotaSelect.options.length] = new Option("Natuna", "Natuna");
                break;
            case "Lampung":
                kotaSelect.options[kotaSelect.options.length] = new Option("Bandar Lampung", "Bandar Lampung");
                kotaSelect.options[kotaSelect.options.length] = new Option("Metro", "Metro");
                kotaSelect.options[kotaSelect.options.length] = new Option("Lampung Selatan", "Lampung Selatan");
                kotaSelect.options[kotaSelect.options.length] = new Option("Lampung Timur", "Lampung Timur");
                break;
            case "Maluku":
                kotaSelect.options[kotaSelect.options.length] = new Option("Ambon", "Ambon");
                kotaSelect.options[kotaSelect.options.length] = new Option("Tual", "Tual");
                kotaSelect.options[kotaSelect.options.length] = new Option("Ternate", "Ternate");
                kotaSelect.options[kotaSelect.options.length] = new Option("Pulau Haruku", "Pulau Haruku");
                break;
            case "Maluku Utara":
                kotaSelect.options[kotaSelect.options.length] = new Option("Ternate", "Ternate");
                kotaSelect.options[kotaSelect.options.length] = new Option("Tidore Kepulauan", "Tidore Kepulauan");
                kotaSelect.options[kotaSelect.options.length] = new Option("Labuha", "Labuha");
                break;
            case "Nusa Tenggara Barat":
                kotaSelect.options[kotaSelect.options.length] = new Option("Mataram", "Mataram");
                kotaSelect.options[kotaSelect.options.length] = new Option("Bima", "Bima");
                kotaSelect.options[kotaSelect.options.length] = new Option("Sumbawa Besar", "Sumbawa Besar");
                kotaSelect.options[kotaSelect.options.length] = new Option("Praya", "Praya");
                break;
            case "Nusa Tenggara Timur":
                kotaSelect.options[kotaSelect.options.length] = new Option("Kupang", "Kupang");
                kotaSelect.options[kotaSelect.options.length] = new Option("Maumere", "Maumere");
                kotaSelect.options[kotaSelect.options.length] = new Option("Ende", "Ende");
                kotaSelect.options[kotaSelect.options.length] = new Option("Rote Ndao", "Rote Ndao");
                break;
            case "Papua":
                kotaSelect.options[kotaSelect.options.length] = new Option("Jayapura", "Jayapura");
                kotaSelect.options[kotaSelect.options.length] = new Option("Merauke", "Merauke");
                kotaSelect.options[kotaSelect.options.length] = new Option("Biak", "Biak");
                kotaSelect.options[kotaSelect.options.length] = new Option("Wamena", "Wamena");
                break;
            case "Papua Barat":
                kotaSelect.options[kotaSelect.options.length] = new Option("Manokwari", "Manokwari");
                kotaSelect.options[kotaSelect.options.length] = new Option("Sorong", "Sorong");
                kotaSelect.options[kotaSelect.options.length] = new Option("Fak-Fak", "Fak-Fak");
                kotaSelect.options[kotaSelect.options.length] = new Option("Kaimana", "Kaimana");
                break;
            case "Riau":
                kotaSelect.options[kotaSelect.options.length] = new Option("Pekanbaru", "Pekanbaru");
                kotaSelect.options[kotaSelect.options.length] = new Option("Dumai", "Dumai");
                kotaSelect.options[kotaSelect.options.length] = new Option("Bengkalis", "Bengkalis");
                kotaSelect.options[kotaSelect.options.length] = new Option("Selat Panjang", "Selat Panjang");
                break;
            case "Sulawesi Barat":
                kotaSelect.options[kotaSelect.options.length] = new Option("Mamuju", "Mamuju");
                kotaSelect.options[kotaSelect.options.length] = new Option("Majene", "Majene");
                kotaSelect.options[kotaSelect.options.length] = new Option("Polewali Mandar", "Polewali Mandar");
                break;
            case "Sulawesi Selatan":
                kotaSelect.options[kotaSelect.options.length] = new Option("Makassar", "Makassar");
                kotaSelect.options[kotaSelect.options.length] = new Option("Parepare", "Parepare");
                kotaSelect.options[kotaSelect.options.length] = new Option("Palopo", "Palopo");
                kotaSelect.options[kotaSelect.options.length] = new Option("Sengkang", "Sengkang");
                break;
            case "Sulawesi Tengah":
                kotaSelect.options[kotaSelect.options.length] = new Option("Palu", "Palu");
                kotaSelect.options[kotaSelect.options.length] = new Option("Donggala", "Donggala");
                kotaSelect.options[kotaSelect.options.length] = new Option("Tentena", "Tentena");
                break;
            case "Sulawesi Tenggara":
                kotaSelect.options[kotaSelect.options.length] = new Option("Kendari", "Kendari");
                kotaSelect.options[kotaSelect.options.length] = new Option("Baubau", "Baubau");
                kotaSelect.options[kotaSelect.options.length] = new Option("Raha", "Raha");
                break;
            case "Sulawesi Utara":
                kotaSelect.options[kotaSelect.options.length] = new Option("Manado", "Manado");
                kotaSelect.options[kotaSelect.options.length] = new Option("Bitung", "Bitung");
                kotaSelect.options[kotaSelect.options.length] = new Option("Tomohon", "Tomohon");
                break;
            case "Sumatera Barat":
                kotaSelect.options[kotaSelect.options.length] = new Option("Padang", "Padang");
                kotaSelect.options[kotaSelect.options.length] = new Option("Bukittinggi", "Bukittinggi");
                kotaSelect.options[kotaSelect.options.length] = new Option("Pariaman", "Pariaman");
                kotaSelect.options[kotaSelect.options.length] = new Option("Padangpanjang", "Padangpanjang");
                break;
            case "Sumatera Selatan":
                kotaSelect.options[kotaSelect.options.length] = new Option("Palembang", "Palembang");
                kotaSelect.options[kotaSelect.options.length] = new Option("Prabumulih", "Prabumulih");
                kotaSelect.options[kotaSelect.options.length] = new Option("Lubuklinggau", "Lubuklinggau");
                kotaSelect.options[kotaSelect.options.length] = new Option("Pagar Alam", "Pagar Alam");
                break;
            case "Sumatera Utara":
                kotaSelect.options[kotaSelect.options.length] = new Option("Medan", "Medan");
                kotaSelect.options[kotaSelect.options.length] = new Option("Pematangsiantar", "Pematangsiantar");
                kotaSelect.options[kotaSelect.options.length] = new Option("Binjai", "Binjai");
                kotaSelect.options[kotaSelect.options.length] = new Option("Tebing Tinggi", "Tebing Tinggi");
                break;
            case "Yogyakarta":
                kotaSelect.options[kotaSelect.options.length] = new Option("Yogyakarta", "Yogyakarta");
                kotaSelect.options[kotaSelect.options.length] = new Option("Bantul", "Bantul");
                kotaSelect.options[kotaSelect.options.length] = new Option("Sleman", "Sleman");
                kotaSelect.options[kotaSelect.options.length] = new Option("Kulon Progo", "Kulon Progo");
                break;
            default:
                break;
        }
    }
</script>

<?php
include 'footer.php';
?>
