<?php 
include 'header.php';

// pesanan baru 
$result1 = mysqli_query($conn, "SELECT DISTINCT invoice FROM produksi WHERE terima = 0 AND tolak = 0");
$jml1 = mysqli_num_rows($result1);

// pesanan dibatalkan/ditolak
$result2 = mysqli_query($conn, "SELECT DISTINCT invoice FROM produksi WHERE tolak = 1");
$jml2 = mysqli_num_rows($result2);

// pesanan diterima
$result3 = mysqli_query($conn, "SELECT DISTINCT invoice FROM produksi WHERE terima = 1");
$jml3 = mysqli_num_rows($result3);
?>

<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            background-color: #FFFFFF; /* Warna perak */
            color: #000000; /* Warna hitam pekat untuk teks */
        }
        .container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center; /* Center content */
        }
        .row {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
            width: 100%; /* Full width for proper spacing */
        }
        .col-md-4 {
            flex: 1;
            margin: 10px;
        }
        .box {
            background-color: #87CEFA;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            color: #000000; /* Warna hitam pekat untuk teks di dalam kotak */
        }
        .box.red {
            background-color: #FF0000;
        }
        .box.green {
            background-color: #00FF7F;
        }
        .chart-container {
            position: relative;
            height: 40vh;
            width: 80vw; /* Adjust width for better appearance */
            margin: 20px auto; /* Center the chart */
        }
        @media print {
            .print {
                display: none;
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="box">
                    <h4>PESANAN BARU</h4>
                    <h4 style="font-size: 36pt;"><b><?= htmlspecialchars($jml1); ?></b></h4>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box red">
                    <h4>PESANAN DIBATALKAN</h4>
                    <h4 style="font-size: 36pt;"><b><?= htmlspecialchars($jml2); ?></b></h4>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box green">
                    <h4>PESANAN DITERIMA</h4>
                    <h4 style="font-size: 36pt;"><b><?= htmlspecialchars($jml3); ?></b></h4>
                </div>
            </div>
        </div>

        <div class="chart-container">
            <canvas id="orderChart"></canvas>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script>
        const ctx = document.getElementById('orderChart').getContext('2d');
        const orderChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Pesanan'],
                datasets: [
                    {
                        label: 'Pesanan Baru',
                        data: [<?= $jml1; ?>],
                        backgroundColor: '#87CEFA'
                    },
                    {
                        label: 'Pesanan Dibatalkan',
                        data: [<?= $jml2; ?>],
                        backgroundColor: '#FF0000'
                    },
                    {
                        label: 'Pesanan Diterima',
                        data: [<?= $jml3; ?>],
                        backgroundColor: '#00FF7F'
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Pesanan'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
