<?php 
session_start();
include '../koneksi/koneksi.php';

$nama_gambar = $_FILES['image']['name'];
$size_gambar = $_FILES['image']['size'];
$tmp_file = $_FILES['image']['tmp_name'];
$eror = $_FILES['image']['error'];
$type = $_FILES['image']['type'];
$inv = $_POST['inv'];
$kd = $_POST['cs'];

// Cek apakah ada gambar yang dipilih
if($eror === 4){
	$_SESSION['error'] = "TIDAK ADA GAMBAR YANG DIPILIH";
	header('location:../tm_produk.php');
	exit;
}

// Validasi ekstensi gambar
$ekstensiGambar = ['jpg', 'jpeg', 'png'];
$ekstensiGambarValid = pathinfo($nama_gambar, PATHINFO_EXTENSION);

if(!in_array(strtolower($ekstensiGambarValid), $ekstensiGambar)){
	$_SESSION['error'] = "EKSTENSI GAMBAR HARUS JPG, JPEG, PNG";
	header('location:../tm_produk.php');
	exit;
}

// Validasi ukuran gambar (maksimal 1 MB)
if($size_gambar > 1000000){
	$_SESSION['error'] = "UKURAN GAMBAR TERLALU BESAR (Maksimal 1MB)";
	header('location:../tm_produk.php');
	exit;
}

// Generate nama unik untuk gambar
$namaGambarBaru = uniqid() . '.' . $ekstensiGambarValid;

// Upload gambar ke direktori
if (move_uploaded_file($tmp_file, "../admin/image/tf/".$namaGambarBaru)) {
	// Update database dengan nama gambar baru
	$result = mysqli_query($conn, "UPDATE produksi SET images = '$namaGambarBaru' WHERE invoice = '$inv' and kode_customer = '$kd'");

	if($result){
		unset($_SESSION['inv']);
		unset($_SESSION['cek']);
		$_SESSION['msg'] = true; // Menandakan sukses
		header('location:../selesai.php');
		exit;
	} else {
		echo "Gagal melakukan update database";
	}
} else {
	$_SESSION['error'] = "GAGAL UPLOAD GAMBAR";
	header('location:../tm_produk.php');
	exit;
}
?>
