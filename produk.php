<?php 


include 'koneksi/koneksi.php'; // Sesuaikan dengan lokasi file koneksi.php Anda

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Kami</title>
    <!-- Tambahkan link ke CSS Anda di sini -->
</head>
<body>
    <!-- Tambahkan kode untuk header (navbar, judul halaman, dll) di sini -->

    <div class="container">
        <h2 style="width: 100%; border-bottom: 4px solid #ff8680"><b>Produk Kami</b></h2>

        <div class="row">
            <?php 
            $result = mysqli_query($conn, "SELECT * FROM produk GROUP BY kode_produk");
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="image/produk/<?= $row['image']; ?>" >
                        <div class="caption">
                            <h3><?= $row['nama'];  ?></h3>
                            <h4>
                                <?php 
                                if(strpos($row['harga'], ",") === false){
                                    echo "Rp. ".number_format($row['harga'])."";
                                } else {
                                    $a = explode(",", $row['harga']);
                                    echo "Rp. ".number_format($a[0])." - ".number_format(end($a));  
                                }
                                ?> 
                            </h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="detail_produk.php?produk=<?= $row['kode_produk']; ?>" class="btn btn-warning btn-block">Detail</a> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
            }
            ?>
        </div>
    </div>

    <!-- Tambahkan kode untuk footer di sini -->
    <?php 
    include 'footer.php';
    ?>
</body>
</html>
