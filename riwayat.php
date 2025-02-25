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
ob_start(); // Mulai output buffering untuk menangkap konten
include 'koneksi.php';

// Query untuk mengambil semua data transaksi   
$result = $conn->query("SELECT * FROM transaksi");

// Tampilkan tabel riwayat transaksi
echo '
<div class="table-responsive mt-4" style="max-height: 500px; overflow-y: auto;">
    <table class="table table-striped table-bordered" id="transactionTable">
        <thead class="table-dark">
            <tr>
                <th>ID Transaksi</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
                <th>Diskon</th>
                <th>Total Harga</th>
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
            <td>{$row['tanggal_transaksi']}</td>
          </tr>";
}

echo '</tbody>
    </table>
</div>';

$content = ob_get_clean(); // Tangkap konten tabel ke dalam variabel $content

// Sertakan template untuk menampilkan halaman
include 'template.php';

?>

<script>
function printTable() {
    var printContent = document.getElementById("transactionTable").outerHTML;
    var originalContent = document.body.innerHTML;
    document.body.innerHTML = "<h2>Riwayat Transaksi</h2>" + '<br>' + printContent + '<footer class="bg-dark text-white text-center py-3">';
    window.print();
    document.body.innerHTML = originalContent;
}
</script>
