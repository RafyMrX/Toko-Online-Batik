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

if($eror === 4){
	echo "
	<script>
	alert('TIDAK ADA GAMBAR YANG DI PILIH');
	window.location = '../tm_produk.php';
	</script>
	";
	die;
}

$ekstensiGambar = array('jpg','jpeg','png');
$ekstensiGambarValid = explode(".", $nama_gambar);
$ekstensiGambarValid = strtolower(end($ekstensiGambarValid));

if(!in_array($ekstensiGambarValid, $ekstensiGambar)){
	echo "
	<script>
	alert('EKSTENSI GAMBAR HARUS JPG, JPEG, PNG');
	window.location = '../tm_produk.php';
	</script>
	";
	die;
}

if($size_gambar > 1000000){
	echo "
	<script>
	alert('UKURAN GAMBAR TERLALU BESAR');
	window.location = '../tm_produk.php';
	</script>
	";
	die;
}

$namaGambarBaru = uniqid();
$namaGambarBaru.=".";
$namaGambarBaru.=$ekstensiGambarValid;


if (move_uploaded_file($tmp_file, "../admin/image/tf/".$namaGambarBaru)) {

	$result = mysqli_query($conn, "UPDATE produksi SET images = '$namaGambarBaru' WHERE invoice = '$inv' and kode_customer = '$kd'");

	if($result){
			unset($_SESSION['inv']);
			unset($_SESSION['cek']);
			$_SESSION['msg'] = true;
			header('location:../selesai.php');
	}else{
		echo "salah";
	}

}

 ?>