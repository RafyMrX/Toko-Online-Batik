<?php 
include '../koneksi/koneksi.php';

$hal = $_GET['hal'];
$kode_cs = $_GET['kd_cs'];
$kode_produk = $_GET['produk'];
$ukuran = $_GET['ukuran'];
$berat = $_GET['berat'];

if (isset($_GET['jml'])) {
    $qty = $_GET['jml'];
}

$result = mysqli_query($conn, "SELECT * FROM produk WHERE kode_produk = '$kode_produk'");
$row = mysqli_fetch_assoc($result);

$nama_produk = $row['nama'];

// Ambil daftar harga dan ukuran dari produk
$harga_list = explode(',', $row['harga']);
$ukuran_list = explode(',', $row['ukuran']);

// Temukan indeks ukuran yang sesuai
$ukuran_index = array_search($ukuran, $ukuran_list);

if ($ukuran_index === false) {
    echo "
    <script>
    alert('Ukuran tidak ditemukan!');
    window.location = '../detail_produk.php?produk=" . $kode_produk . "';
    </script>
    ";
    die;
}

// Ambil harga berdasarkan indeks ukuran yang ditemukan
$harga = intval($harga_list[$ukuran_index]);

// Periksa apakah produk sudah ada di keranjang
$cek = mysqli_query($conn, "SELECT * FROM keranjang WHERE kode_produk = '$kode_produk' AND kode_customer = '$kode_cs' AND ukuran = '$ukuran'");
$row1 = mysqli_fetch_assoc($cek);
$jml = mysqli_num_rows($cek);

if ($jml > 0) {
    $set = $row1['qty'] + $qty;
    $update = mysqli_query($conn, "UPDATE keranjang SET qty = '$set' WHERE kode_produk = '$kode_produk' AND kode_customer = '$kode_cs' AND ukuran = '$ukuran'");
    if ($update) {
        echo "
        <script>
        alert('BERHASIL DITAMBAHKAN KE KERANJANG');
        window.location = '../detail_produk.php?produk=" . $kode_produk . "';
        </script>
        ";
        die;
    }
} else {
    // Jika tidak ada, lakukan insert ke keranjang
    $insert = mysqli_query($conn, "INSERT INTO keranjang (kode_customer, kode_produk, nama_produk, qty, harga, berat, ukuran) VALUES ('$kode_cs', '$kode_produk', '$nama_produk', '$qty', '$harga', '$berat', '$ukuran')");
    if ($insert) {
        echo "
        <script>
        alert('BERHASIL DITAMBAHKAN KE KERANJANG');
        window.location = '../detail_produk.php?produk=" . $kode_produk . "';
        </script>
        ";
        die;
    }
}

// Jika ada kesalahan dalam query atau operasi lainnya
echo "
<script>
alert('GAGAL DITAMBAHKAN KE KERANJANG');
window.location = '../detail_produk.php?produk=" . $kode_produk . "';
</script>
";
die;

?>
