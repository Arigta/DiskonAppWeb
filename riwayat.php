<?php
// Set judul halaman
$title = "History";

// Header untuk halaman
$header = '
<div class="d-flex justify-content-between align-items-center py-3 border-bottom">
    <h3>Riwayat Transaksi</h3>
    <button onclick="printTable()" class="btn btn-success">Print</button>
</div>';

// Konten utama halaman
ob_start();
include 'koneksi.php';

// Query untuk mengambil semua data transaksi (default urutan terbaru)
$result = $conn->query("SELECT * FROM transaksi ORDER BY tanggal_transaksi DESC");

// Tampilkan tabel riwayat transaksi
echo '
<div class="table-responsive mt-4" style="max-height: 500px; overflow-y: auto;">
    <table class="table table-striped table-bordered" id="transactionTable">
        <thead class="table-dark">
            <tr>
                <th onclick="sortTable()">ID Transaksi</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
                <th>Diskon</th>
                <th>Total Harga</th>
                <th>Jumlah Bayar</th>
                <th>Kembalian</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>';
        
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['idtransaksi']}</td>
            <td>{$row['nama_produk']}</td>
            <td>{$row['jumlah']}</td>
            <td>Rp" . number_format($row['sub_total'], 2) . "</td>
            <td>Rp" . number_format($row['diskon'], 2) . "</td>
            <td>Rp" . number_format($row['total_harga'], 2) . "</td>
            <td>Rp" . number_format($row['jumlah_bayar'], 2) . "</td>
            <td>Rp" . number_format($row['kembalian'], 2) . "</td>
            <td>{$row['tanggal_transaksi']}</td>
          </tr>";
}

echo '</tbody>
    </table>
</div>';

$content = ob_get_clean();

// Sertakan template untuk menampilkan halaman
include 'template.php';
?>

<script>
let ascending = true; // Variabel untuk menentukan urutan naik/turun

function printTable() {
    let printContent = document.getElementById("transactionTable").outerHTML;
    let originalContent = document.body.innerHTML;
    document.body.innerHTML = "<h2>Riwayat Transaksi</h2><br>" + printContent;
    window.print();
    document.body.innerHTML = originalContent;
}

function sortTable() {
    let table = document.getElementById("transactionTable");
    let rows = [...table.rows].slice(1); // Ambil semua baris kecuali header

    rows.sort((a, b) => {
        return ascending 
            ? a.cells[0].innerText - b.cells[0].innerText
            : b.cells[0].innerText - a.cells[0].innerText;
    });

    ascending = !ascending; // Balik arah sorting untuk klik berikutnya

    rows.forEach(row => table.appendChild(row)); // Tambahkan kembali baris yang sudah diurutkan
}
</script>
