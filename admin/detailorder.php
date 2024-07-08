<?php 
include 'header.php';
$invoices = $_GET['inv'];
$d_order = mysqli_query($conn, "SELECT * FROM produksi WHERE invoice = '$invoices'");
$t_order = mysqli_fetch_assoc($d_order);

$sortage = mysqli_query($conn, "SELECT * FROM produksi where cek = '1'");
$cek_sor = mysqli_num_rows($sortage);

// customer
$cs = mysqli_query($conn, "SELECT * FROM customer WHERE kode_customer = '".$t_order['kode_customer']."'");
$t_cs = mysqli_fetch_assoc($cs);
?>

<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Daftar Pesanan</b></h2>
	<br>
	<h5 class="bg-success" style="padding: 7px; width: 710px; font-weight: bold;"><marquee>Lakukan Reload Setiap Masuk Halaman ini, untuk menghindari terjadinya kesalahan data dan informasi</marquee></h5>
	<a href="produksi.php" class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i> Reload</a>
	<br>
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">No</th>
				<th scope="col">Invoice</th>
				<th scope="col">Kode Customer</th>
				<th scope="col">Status</th>
				<th scope="col">Tanggal</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>

			<?php 
			$result = mysqli_query($conn, "SELECT DISTINCT invoice, kode_customer, status, kode_produk, qty,terima,tolak, cek FROM produksi group by invoice");
			$no = 1;
			$array = 0;
			while($row = mysqli_fetch_assoc($result)){
				$kodep = $row['kode_produk'];
				$inv = $row['invoice'];
				?>

				<tr>
					<td><?= $no; ?></td>
					<td><?= $row['invoice']; ?></td>
					<td><?= $row['kode_customer']; ?></td>
					<?php if($row['terima'] == 1){ ?>
						<td style="color: green;font-weight: bold;">Pesanan Diterima (Siap Kirim)
							<?php
						}else if($row['tolak'] == 1){
							?>
							<td style="color: red;font-weight: bold;">Pesanan Ditolak
								<?php 
							}else{
								?>
								<td style="color: warning;font-weight: bold;">Pesanan Baru

									<?php
								}
								?>


							</td>
							<td>2020/26-01</td>
							<td>
								<?php if( $row['terima']==0 && $row['tolak']==0){ ?>
									<a href="proses/terima.php?inv=<?= $row['invoice']; ?>&kdp=<?= $row['kode_produk']; ?>" class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Terima</a> 
									<a href="proses/tolak.php?inv=<?= $row['invoice']; ?>" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menolak ?')"><i class="glyphicon glyphicon-remove-sign"></i> Tolak</a> 
								<?php } ?>

								<a href="detailorder.php?inv=<?= $row['invoice']; ?>&cs=<?= $row['kode_customer']; ?>" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-eye-open"></i> Detail Pesanan</a>
							</td>
						</tr>
						<?php
						$no++; 
					}
					?>

				</tbody>
			</table>





			<button type="hidden" data-toggle="modal" data-target="#myModal" id="btn" style="background-color: #fff; border: #fff;">
			</button>
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<a href="m_produk.php" class="btn btn-default close"></a>
							<span style="margin-right: 200px;" class="modal-title" id="myModalLabel">#<?= $t_order['invoice']; ?></span>
							<span class="modal-title text-right">Batas Pembayaran : <?php echo $t_order['tanggal']; ?></span>
						</div>
						<div class="modal-body">
							<h4>Data Customer</h4>
							<table class="table table-striped">
								<tr>
									<td>Invoice</td>
									<td><?= $t_order['invoice']; ?></td>
								</tr>
								<tr>
									<td>Kode Customer</td>
									<td><?= $t_order['kode_customer']; ?></td>
								</tr>
								<tr>
									<td>Nama</td>
									<td><?= $t_cs['nama']; ?></td>
								</tr>
								<tr>
									<td>Alamat</td>
									<td><?php echo  $t_order['alamat'].",".$t_order['kota']." ".$t_order['provinsi'].",".$t_order['kode_pos']; ?></td>
								</tr>
								<tr>
									<td>No Telp</td>
									<td><?= $t_cs['telp']; ?></td>
								</tr>
							</table>
							<hr>
							<h4>Ekspedisi/Pengiriman</h4>
							<table class="table table-striped">
								<tr>
									<th>Ekspedisi</th>
									<th>Paket Ekspedisi</th>
								</tr>
								<tr>
									<td><?= strtoupper($t_order['ekspedisi']);  ?></td>
									<td><?= $t_order['paket_ekspedisi'];  ?></td>
								</tr>
							</table>
							<hr>
							<h4>List Order</h4>
							<table class="table table-striped">
								<tr>
									<th>No</th>
									<th>Kode Produk</th>
									<th>Nama Produk</th>
									<th>Ukuran</th>
									<th>Harga</th>
									<th>qty</th>
									<th>Subtotal</th>
								</tr>
								<?php 
								$order = mysqli_query($conn, "SELECT * FROM produksi WHERE invoice = '$invoices'");
								$no = 1;
								$grand = 0;
								while ($list = mysqli_fetch_assoc($order)) {
									?>
									<tr>
										<td><?= $no;  ?></td>
										<td><?= $list['kode_produk']; ?></td>
										<td><?= $list['nama_produk']; ?></td>
										<td><?= strtoupper($list['ukuran']); ?></td>
										<td><?= number_format($list['harga'], 0, ".", "."); ?></td>
										<td><?= number_format($list['harga'] * $list['qty'], 0, ".", "."); ?></td>

									</tr>
									<?php 
									$sub = $list['harga'] * $list['qty'];
									$grand += $sub;
									$no++;
									$grands = $list['grand_total'];
									$tf = $list['images'];
									$ong = $list['ongkir'];
								}
								?>
								<tr>
									<td colspan="7" class="text-right alert alert-warning"><b>Grand Total = <?= number_format($grand+$ong, 0, ".", ".");  ?></b></td>
								</tr>
								<tr>
									<td colspan="7" class="text-right alert alert-success"><b>Nominal yang  dibayar = <?= number_format($grands+$ong, 0, ".", ".");  ?></b></td>
								</tr>
							</table>
							<hr>
							<h4>Bukti Transfer</h4>
							<?php 
							if(!empty($tf)){
								?>

								<img src="image/tf/<?php echo $tf; ?>" width="300">

								<?php
							}else{
								?>

								<p>Tidak Ada Bukti Transfer yang di upload</p>
								<?php
							}
							?>
						</div>
						<div class="modal-footer">
							<a href="produksi.php" class="btn btn-default">Close</a>
						</div>
					</div>
				</div>
			</div>


		</div>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<script type="text/javascript">
			$( document ).ready(function() {
				$( "#btn" ).click();
			});
		</script>

		<?php 
		include 'footer.php';
		?>