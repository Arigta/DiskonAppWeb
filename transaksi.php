<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Barang</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table {
            font-size: 12px;
        }



        /* Scrollable table */
        .table-container {
            max-height: 600px;
            overflow-y: auto;
        }

        /* Main content layout */
        .content-wrapper {
            display: flex;
            gap: 20px;
            height: calc(100vh - 100px);
        }

        .products-section {
            flex: 2;
            min-width: 0;
        }

        .order-section {
            flex: 1;
            min-width: 300px;
            border-left: 2px solid #dee2e6;
            padding-left: 20px;
            height: 100%;
        }

        .order-content {
            height: calc(100% - 40px); /* Adjust based on header height */
            overflow-y: auto;
        }

        .empty-order-message {
            color: #6c757d;
            text-align: center;
            padding: 20px;
            border: 1px dashed #dee2e6;
            border-radius: 4px;
            margin-top: 10px;
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
                <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                    <h3>Order Barang</h3>
                    <div>
                        <input type="text" id="search" class="form-control d-inline w-auto" placeholder="Cari barang...">
                    </div>
                </div>

                <!-- Content Wrapper -->
                <div class="content-wrapper mt-3">
                    <!-- Products Section -->
                    <div class="products-section">
                        <div class="table-container">
                            <table class="table table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="barang-table">
                                    <?php
                                    include 'koneksi.php';
                                    $result = $conn->query("SELECT * FROM barang");
                                    while ($row = $result->fetch_assoc()) :
                                    ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['idproduk']); ?></td>
                                            <td><?= htmlspecialchars($row['nama_produk']); ?></td>
                                            <td>Rp<?= number_format($row['harga'], 2); ?></td>
                                            <td><?= htmlspecialchars($row['stok']); ?></td>
                                            <td>
                                                <button class="btn btn-primary btn-sm order-btn"
                                                    data-id="<?= htmlspecialchars($row['idproduk']); ?>"
                                                    data-nama="<?= htmlspecialchars($row['nama_produk']); ?>"
                                                    data-harga="<?= htmlspecialchars($row['harga']); ?>">Order</button>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Order Summary Section -->
                    <div class="order-section">
                        <h4 class="border-bottom pb-2">Ringkasan Pembayaran</h4>
                        <div class="order-content">
                            <div id="order-summary">
                                <div class="empty-order-message" id="empty-order-message">
                                    Belum ada produk yang dipilih
                                </div>
                                <div class="table-container" id="order-details" style="display: none;">
                                    <table class="table table-bordered">
                                        <tbody id="order-table"></tbody>
                                    </table>
                                    <div class="d-flex justify-content-between mt-3">
                                        <button class="btn btn-secondary" id="reset-order">Reset</button>
                                        <button class="btn btn-success" id="confirm-order">Konfirmasi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
    const orderSummary = document.getElementById("order-summary");
    const orderTable = document.getElementById("order-table");
    const resetOrder = document.getElementById("reset-order");
    const emptyOrderMessage = document.getElementById("empty-order-message");
    const orderDetails = document.getElementById("order-details");

    const searchInput = document.getElementById('search');
    const tableBody = document.getElementById('barang-table');


    let orders = [];

    document.querySelectorAll(".order-btn").forEach(button => {
        button.addEventListener("click", function() {
            const id = this.dataset.id;
            const nama = this.dataset.nama;
            const harga = parseFloat(this.dataset.harga);

            let order = orders.find(o => o.id === id);
            if (order) {
                order.qty += 1;
                order.subtotal = order.qty * harga;
            } else {
                orders.push({
                    id,
                    nama,
                    harga,
                    qty: 1,
                    subtotal: harga
                });
            }

            updateOrderTable();
        });
    });

     // Tambahkan event listener untuk input
     searchInput.addEventListener('input', function () {
        const searchValue = searchInput.value.toLowerCase(); // Ambil nilai input dan ubah ke lowercase
        const rows = tableBody.getElementsByTagName('tr'); // Ambil semua baris dalam tabel

        // Looping melalui setiap baris di tabel
        for (let row of rows) {
            const cells = row.getElementsByTagName('td'); // Ambil semua kolom dalam baris
            let match = false;

            // Looping melalui setiap kolom untuk mencari nilai yang sesuai
            for (let cell of cells) {
                if (cell.textContent.toLowerCase().includes(searchValue)) {
                    match = true; // Jika nilai ditemukan, set match ke true
                    break;
                }
            }

            // Tampilkan atau sembunyikan baris berdasarkan hasil pencarian
            if (match) {
                row.style.display = ''; // Tampilkan baris
            } else {
                row.style.display = 'none'; // Sembunyikan baris
            }
        }
    });

    // Update the order table and recalculate totals
    function updateOrderTable() {
        orderTable.innerHTML = "";
        let totalDiskon = 0;
        let grandTotal = 0;

        if (orders.length > 0) {
            emptyOrderMessage.style.display = "none";
            orderDetails.style.display = "block";

            orders.forEach((order, index) => {
                let diskon = 0;
                if (order.qty >= 3 && order.qty < 10) {
                    diskon = order.subtotal * 0.05;
                } else if (order.qty >= 10) {
                    diskon = order.subtotal * 0.15;
                }

                const total = order.subtotal - diskon;
                totalDiskon += diskon;
                grandTotal += total;

                const row = `
                    <tr>
                        <td colspan="2"><strong>${order.nama}</strong></td>
                    </tr>
                    <tr>
                        <td>Qty</td>
                        <td>
                            <input type="number" class="form-control qty-input" 
                                   min="1"
                                   value="${order.qty}" 
                                   data-index="${index}">
                        </td>
                    </tr>
                    <tr>
                        <td>Subtotal</td>
                        <td>Rp${order.subtotal.toLocaleString()}</td>
                    </tr>
                    <tr>
                        <td>Diskon</td>
                        <td>-Rp${diskon.toLocaleString()}</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>Rp${total.toLocaleString()}</td>
                    </tr>
                `;
                orderTable.insertAdjacentHTML('beforeend', row);
            });

            const summaryRow = `
                <tr class="table-dark">
                    <td><strong>Total Diskon</strong></td>
                    <td><strong>-Rp${totalDiskon.toLocaleString()}</strong></td>
                </tr>
                <tr class="table-dark">
                    <td><strong>Grand Total</strong></td>
                    <td><strong>Rp${grandTotal.toLocaleString()}</strong></td>
                </tr>
            `;
            orderTable.insertAdjacentHTML('beforeend', summaryRow);
        } else {
            emptyOrderMessage.style.display = "block";
            orderDetails.style.display = "none";
        }
    }

    // Handle quantity change
    orderTable.addEventListener("input", function(e) {
        if (e.target && e.target.classList.contains("qty-input")) {
            const index = e.target.dataset.index;
            const newQty = parseInt(e.target.value);

            if (newQty > 0) {
                const order = orders[index];
                const harga = order.harga;
                order.qty = newQty;
                order.subtotal = newQty * harga;

                updateOrderTable();  // Recalculate the table
            }
        }
    });

    resetOrder.addEventListener("click", () => {
        orders = [];
        updateOrderTable();
    });

    document.getElementById("confirm-order").addEventListener("click", () => {
    if (orders.length === 0) {
        alert("Tidak ada produk yang diorder!");
        return;
    }

    fetch("proses_transaksi.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(orders)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Order berhasil dikonfirmasi!");
                orders = [];
                updateOrderTable();
                // Refresh halaman setelah order berhasil
                window.location.reload();
            } else {
                alert("Terjadi kesalahan saat menyimpan transaksi.");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Terjadi kesalahan saat memproses transaksi.");
        });
});
</script>

</body>

</html>