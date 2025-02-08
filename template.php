<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Dashboard'; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
                /* Tabel lebih kecil */
                table {
            font-size: 12px;
        }
        table th, table td {
            padding: 4px;
        }

        /* Scrollable table */D
        .table-container {
            max-height: 400px; /* Sesuaikan tinggi maksimal */
            overflow-y: auto;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-md-block bg-dark text-white vh-100">
                <div class="position-sticky p-3">
                    <h4 class="text-center text-white mb-4">Menu</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="barang.php">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="transaksi.php">Order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="riwayat.php">History</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 ms-sm-auto px-md-4">
                <!-- Header -->
                <?php if (isset($header)) {
                    echo $header;
                } ?>

                <!-- Main Content -->
                <div class="py-3">
                    <?php if (isset($content)) {
                        echo $content;
                    } ?>
                </div>
                <!-- Footer -->
                
            </main>
            <footer class="bg-dark text-white text-center py-3 mt-auto">
                    <p class="mb-0">&copy; <?= date('Y'); ?> Your Company Name. All Rights Reserved.</p>
                </footer>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>