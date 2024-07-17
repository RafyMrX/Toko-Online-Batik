<?php
session_start(); // Mulai session (jika belum dimulai)

// Periksa apakah user sudah login, jika tidak, arahkan ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: user_login.php"); // Ganti dengan halaman login Anda
    exit(); // Pastikan keluar dari skrip setelah redirect
}

include 'koneksi/koneksi.php'; // Sesuaikan dengan lokasi file koneksi.php Anda

?>
	<footer style="border-top: 4px solid #d9b712;  background-color: #4d0000">
		<div class="container" style="padding-bottom: 50px;">
			<div class="row">
				<div class="col-md-4" style="color: #fff">
				<h3 style="color: #e78b00;"><b>Batik YOHAFA</b></h3>
					<p>Rajeg, Distrik Sindang Jaya , Jatiuwung, Kota Tangerang, BANTEN 15113</p>
					<p><i class="glyphicon glyphicon-earphone"></i> +62-895-138-73079</p>
					<p><i class="glyphicon glyphicon-envelope"></i> yohafa.batik@gmail.com</p>
					<p><i class=""></i> @BatikYOHAFA</p>
				</div>
				<div class="col-md-4">
					<h5 style="color: #d9b712;"><b>Menu</b></h5>
					<p ><a style="color: #fff;" href="produk.php"  style="color: #000">Produk</a></p>
					<p><a style="color: #fff;" href="about.php"  style="color: #000">Tentang kami</a></p>
					<p><a style="color: #fff;" href="manual.php"  style="color: #000">Cara Order</a></p>
				</div>

				<div class="col-md-4">
					
				</div>
			</div>

		</div>

		<div class="copy" style="background-color:#d9b712; padding: 5px; color: #fff; text-align: center;">
			<span>Copyright&copy; Kelompok 10 Pemweb</span>
		</div>
	</footer>

</body>
</html>
