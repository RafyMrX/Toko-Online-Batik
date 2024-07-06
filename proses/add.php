<?php 
include '../koneksi/koneksi.php';

$hal = $_GET['hal'];
$kode_cs = $_GET['kd_cs'];
$kode_produk = $_GET['produk'];
$ukuran = $_GET['ukuran'];
$harga = $_GET['harga'];
$berat = $_GET['berat'];
if(isset($_GET['jml'])){
	$qty = $_GET['jml'];
}


$result = mysqli_query($conn, "SELECT * FROM produk WHERE kode_produk = '$kode_produk'");
$row = mysqli_fetch_assoc($result);

$nama_produk = $row['nama'];

$result1 = mysqli_query($conn, "SELECT k.id_keranjang as keranjang, k.kode_produk as kd, k.nama_produk as nama, k.qty as jml, p.image as gambar, k.harga as harga, k.ukuran as ukuran FROM keranjang k join produk p on k.kode_produk=p.kode_produk WHERE kode_customer = '$kode_cs'");
$row1 = mysqli_fetch_assoc($result1);

$kd = $row['kode_produk'];
	$cek = mysqli_query($conn, "SELECT * from keranjang where kode_produk = '$kode_produk' and kode_customer = '$kode_cs' and ukuran = '$ukuran'");
	$jml = mysqli_num_rows($cek);
	$row1 = mysqli_fetch_assoc($cek);

if($ukuran == $row1['ukuran'] || $jml > 0){
		$set = $row1['qty']+$qty;
		$update = mysqli_query($conn, "UPDATE keranjang SET qty = '$set' WHERE kode_produk = '$kode_produk' and kode_customer = '$kode_cs' and ukuran = '$ukuran' ");
		if($update){
			echo "
			<script>
			alert('BERHASIL DITAMBAHKAN KE KERANJANG');
			window.location = '../detail_produk.php?produk=".$kode_produk."';
			</script>
			";
			die;
		}
}else{
	$insert = mysqli_query($conn, "INSERT INTO keranjang VALUES('','$kode_cs','$kd','$nama_produk', '$qty', '$harga', '$berat','$ukuran')");
		if($insert){
			echo "
			<script>
			alert('BERHASIL DITAMBAHKAN KE KERANJANG');
			window.location = '../detail_produk.php?produk=".$kode_produk."';
			</script>
			";
			die;
		}
}

	









?>