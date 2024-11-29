<?php 
include 'header.php';
?>

<style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh; /* Membuat body minimal 100% tinggi viewport */
        background: url('path/to/electronics-theme-background.jpg') no-repeat center center fixed;
        background-size: cover;
        color: #333;
    }
    .container {
        flex: 1; /* Mengizinkan konten mengisi ruang yang tersisa */
        margin-top: 0px;
        background: rgba(255, 255, 255, 0.9);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }
    table {
        background-color: white; /* Warna latar tabel */
        border-radius: 10px; /* Sudut melengkung */
        overflow: hidden; /* Menghindari overflow */
    }
    th {
        background-color: #007BFF; /* Warna header tabel */
        color: white;
        text-align: center;
    }
    td {
        text-align: center;
        vertical-align: middle;
    }
    .btn {
        margin: 5px;
    }
    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: white;
    }
    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
    }
    footer {
        background-color: #fff; /* Contoh warna footer */
        padding: 10px; /* Padding footer */
        text-align: center; /* Tengah */
        width: 100%; /* Lebar penuh */
    }
</style>

<div class="container">
    <h2 style="width: 100%; border-bottom: 4px solid gray"><b>Master Produk</b></h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Kode Produk</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Image</th>
                <th scope="col">Harga</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $result = mysqli_query($conn, "SELECT * FROM produk");
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $row['kode_produk']; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><img src="../image/produk/<?= $row['image']; ?>" width="100"></td>
                    <td>
                        <?php 
                        if (strpos($row['harga'], ",") == false) {
                            echo "Rp." . $row['harga'];
                        } else {
                            $a = explode(",", $row['harga']);
                            echo "Rp." . $a[0] . " - " . end($a);  
                        }
                        ?>
                    </td>
                    <td>
                        <a href="edit_produk.php?kode=<?= $row['kode_produk']; ?>" class="btn btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                        <a href="proses/del_produk.php?kode=<?= $row['kode_produk']; ?>" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
                </tr>
            <?php
                $no++; 
            }
            ?>
        </tbody>
    </table>
    <a href="tm_produk.php" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Produk</a>
</div>

<?php 
include 'footer.php';
?>
