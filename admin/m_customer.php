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
        background-color: #aec6cf; /* Pastel blue background */
    }

    .container {
        flex: 1;
        padding: 0px; /* Add padding for better spacing */
    }

    table {
        border-collapse: collapse;
        width: 100%;
        margin: 20px 0;
    }
    th, td {
        padding: 12px;
        text-align: left;
        border: 1px solid #ddd;
    }
    th {
        background-color: #a9a9a9; /* Lighter blue for header */
        color: #006064; /* Darker text for contrast */
    }
    tr:hover {
        background-color: #b2ebf2; /* Hover effect */
    }
</style>

<div class="container">
    <h2 style="width: 100%; border-bottom: 4px solid gray; padding-bottom: 5px;"><b>Data Customer</b></h2>
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
