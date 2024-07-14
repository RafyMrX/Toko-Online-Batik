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

    if ($update) {
        echo "
        <script>
        alert('BERHASIL DITAMBAHKAN KE KERANJANG');
        window.location = '../detail_produk.php?produk=".$kode_produk."';
        </script>
        ";
        exit; // Exit script after redirection
    } else {
        echo "
        <script>
        alert('GAGAL UPDATE KERANJANG');
        window.location = '../detail_produk.php?produk=".$kode_produk."';
        </script>
        ";
        exit; // Exit script after redirection
    }
} else {
    // Product not yet in cart, insert new entry
    $insert = mysqli_query($conn, "INSERT INTO keranjang (kode_customer, kode_produk, nama_produk, qty, harga, berat, ukuran) 
                                   VALUES ('$kode_cs', '$kode_produk', '$nama_produk', '$qty', '$harga', '$berat', '$ukuran')");
    
    if ($insert) {
        echo "
        <script>
        alert('BERHASIL DITAMBAHKAN KE KERANJANG');
        window.location = '../detail_produk.php?produk=".$kode_produk."';
        </script>
        ";
        exit; // Exit script after redirection
    } else {
        echo "
        <script>
        alert('GAGAL MENAMBAHKAN KE KERANJANG');
        window.location = '../detail_produk.php?produk=".$kode_produk."';
        </script>
        ";
        exit; // Exit script after redirection
    }
}
?>
