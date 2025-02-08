<?php
$title = "Produk";

$header = '
<div class="d-flex justify-content-between align-items-center py-3 border-bottom">
    <h3>Data Barang</h3>
    <div>
        <input type="text" id="search" class="form-control d-inline w-auto" placeholder="Cari barang...">
        <button class="btn btn-primary ms-2" onclick="window.location.href=\'tambah_barang.php\'">Tambah Barang</button>
    </div>
</div>';

// Database connection
include 'koneksi.php';

// Query untuk mengambil semua data barang
$result = $conn->query("SELECT * FROM barang");

// Konten tabel
$content = '
<div class="table-responsive mt-4" style="max-height: 500px; overflow-y: auto;">
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
        <tbody id="barang-table">';

while ($row = $result->fetch_assoc()) {
    $content .= "<tr>
        <td>{$row['idproduk']}</td>
        <td>{$row['nama_produk']}</td>
        <td>Rp" . number_format($row['harga'], 2) . "</td>
        <td>{$row['stok']}</td>
        <td>
            <a href='edit_barang.php?id={$row['idproduk']}' class='btn btn-warning btn-sm'>Edit</a>
    
        </td>
    </tr>";
}

$content .= '
        </tbody>
    </table>
</div>';

// Fungsi pencarian
$content .= '
<script>
    // Search functionality
    document.getElementById("search").addEventListener("input", function() {
        const searchValue = this.value.toLowerCase();
        const tableRows = document.querySelectorAll("#barang-table tr");
        tableRows.forEach(row => {
            const rowText = row.textContent.toLowerCase();
            row.style.display = rowText.includes(searchValue) ? "" : "none";
        });
    });
</script>';

include 'template.php';
?>