<?php 
include 'header.php';

if (isset($_GET['page'])) {
    $kode = $_GET['kode'];
    $result = mysqli_query($conn, "DELETE FROM customer WHERE kode_customer = '$kode'");

    if ($result) {
        echo "
        <script>
        alert('DATA BERHASIL DIHAPUS');
        window.location = 'm_customer.php';
        </script>
        ";
    }
}
?>

<style type="text/css">
    body, html {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
        background: url('path/to/electronics-theme-background.jpg') no-repeat center center fixed;
        background-size: cover;
        color: #333;
    }

    .container {
        flex: 1;
        padding: 20px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    table {
        border-collapse: collapse;
        width: 100%;
        margin: 20px 0;
        background-color: white;
        border-radius: 10px;
        overflow: hidden;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #007BFF; /* Blue header background */
        color: white; /* White text */
        text-align: center; /* Center align text */
    }

    tr:hover {
        background-color: #b2ebf2; /* Light blue hover effect */
    }

    .btn {
        margin: 5px;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }

    h2 {
        width: 100%;
        border-bottom: 4px solid gray;
        padding-bottom: 5px;
    }

    footer {
        background-color: #fff;
        padding: 10px;
        text-align: center;
        width: 100%;
    }
</style>

<div class="container">
    <h2><b>Data Customer</b></h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Kode Customer</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $result = mysqli_query($conn, "SELECT * FROM customer ORDER BY kode_customer ASC");
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <th scope="row"><?php echo $no; ?></th>
                    <td><?= htmlspecialchars($row['kode_customer']); ?></td>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= htmlspecialchars($row['email']); ?></td>
                    <td>
                        <a href="m_customer.php?kode=<?php echo $row['kode_customer'];?>&page=del" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data ?')">
                            <i class="glyphicon glyphicon-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php 
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>

<?php 
include 'footer.php';
?>
