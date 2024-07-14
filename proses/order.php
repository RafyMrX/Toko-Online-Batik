<?php 
session_start();

include '../koneksi/koneksi.php';

$kd_cs = $_POST['kode_cs'];
$nama = $_POST['nama'];
$prov = $_POST['prov'];
$kota = $_POST['kot'];
$tipe = $_POST['tipe'];
$alamat = $_POST['almt'];
$kopos = $_POST['kopos'];

$ekspedisi = $_POST['ekspedisi'];
$paket = $_POST['paket'];
$ongkir = $_POST['ongkir'];
$etd = $_POST['estimasi'];

// Mendapatkan tanggal dan waktu saat ini
$tanggal = date('Y-m-d H:i:s'); // Format tanggal MySQL
$t = date('Y-m-d'); // Format tanggal hanya tanggal

// Membuat format invoice baru
$kode = mysqli_query($conn, "SELECT invoice FROM produksi ORDER BY invoice DESC");
$data = mysqli_fetch_assoc($kode);
$num = substr($data['invoice'], 3, 4);
$add = (int) $num + 1;
if(strlen($add) == 1){
	$format = "INV000".$add;
}else if(strlen($add) == 2){
	$format = "INV00".$add;
}else if(strlen($add) == 3){
	$format = "INV0".$add;
}else{
	$format = "INV".$add;
}

// Memproses keranjang belanja
$keranjang = mysqli_query($conn, "SELECT * FROM keranjang WHERE kode_customer = '$kd_cs'");
$a = 0;
while($row = mysqli_fetch_assoc($keranjang)){
	$kd_produk = $row['kode_produk'];
	$nama_produk = $row['nama_produk'];
	$qty = $row['qty'];
	$harga = $row['harga'];
	$berat = $row['berat'];
	$ukuran = $row['ukuran'];
	$status = "Pesanan Baru";

	$sub = $row['harga'] * $row['qty'];
	$a += $sub;

	// Memasukkan data pesanan ke tabel produksi
$order = mysqli_query($conn, "INSERT INTO produksi VALUES('', '$format', '$kd_cs', '$kd_produk', '$nama_produk', '$qty', '$harga', '$ukuran', '$status', '$tanggal', '$prov', '$kota', '$alamat', '$kopos', '$ekspedisi', '$paket', '$ongkir', '$etd', '0', '0', '0', '0', '$t', '$time', '$t')");
}

// Menyimpan invoice ke dalam session untuk digunakan di halaman selesai.php
$_SESSION['inv'] = $format;
$_SESSION['cek'] = true;

// Menambahkan nilai acak untuk total pembayaran agar unik
$nominal = $a;
$sub = substr($nominal,-3);
$sub2 = substr($nominal,-2);
$sub3 = substr($nominal,-1);
 
$total =  rand(0, 999);
$total2 =  rand(0, 99);
$total3 =  rand(0, 9);

				if($sub==0){
					$hasil =  $nominal + $total; 

				}if($sub2 == 0){
					$hasil = $nominal + $total2; 

				}if($sub3 == 0){
					$hasil = $nominal + $total3; 

				}



$update = mysqli_query($conn, "UPDATE produksi set grand_total = '$hasil' where kode_customer = '$kd_cs' and timess = '$time'");


$del_keranjang = mysqli_query($conn,"DELETE FROM keranjang WHERE kode_customer = '$kd_cs'");

if($del_keranjang){
	header("location:../selesai.php");
}



?>
