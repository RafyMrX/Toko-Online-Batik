<?php 
include '../koneksi/koneksi.php';

$hal = $_GET['hal'];
$kode_cs = $_GET['kd_cs'];
$kode_produk = $_GET['produk'];
$ukuran = $_GET['ukuran'];
$harga = $_GET['harga'];
$berat = $_GET['berat'];
$qty = isset($_GET['jml']) ? $_GET['jml'] : 1; // Default qty to 1 if not set

// Fetch product details
$result = mysqli_query($conn, "SELECT * FROM produk WHERE kode_produk = '$kode_produk'");
$row = mysqli_fetch_assoc($result);

$nama_produk = $row['nama'];

// Check if the product already exists in the cart
$cek = mysqli_query($conn, "SELECT * FROM keranjang WHERE kode_produk = '$kode_produk' AND kode_customer = '$kode_cs' AND ukuran = '$ukuran'");
$jml = mysqli_num_rows($cek);
$row1 = mysqli_fetch_assoc($cek);

if ($jml > 0) {
    // Product already exists in cart, update quantity
    $set = $row1['qty'] + $qty;
    $update = mysqli_query($conn, "UPDATE keranjang SET qty = '$set' WHERE kode_produk = '$kode_produk' AND kode_customer = '$kode_cs' AND ukuran = '$ukuran'");
    
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
