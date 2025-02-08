<?php
// Set judul halaman
$title = "History";

// Header untuk halaman
$header = '
<div class="d-flex justify-content-between align-items-center py-3 border-bottom">
    <h3>Riwayat Transaksi</h3>
</div>';

// Konten utama halaman
ob_start(); // Mulai output buffering untuk menangkap konten
include 'koneksi.php';

// Pagination konfigurasi
$limit = 10; // Jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Halaman saat ini
$offset = ($page - 1) * $limit; // Offset untuk query

// Hitung total data
$total_query = $conn->query("SELECT COUNT(*) AS total FROM transaksi");
$total_data = $total_query->fetch_assoc()['total'];
$total_pages = ceil($total_data / $limit);

// Query untuk mengambil data transaksi dengan limit dan offset
$result = $conn->query("SELECT * FROM transaksi LIMIT $limit OFFSET $offset");

// Tampilkan tabel riwayat transaksi
echo '
<div class="table-responsive mt-4">
    <table class="table table-striped table-bordered">
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

// Tombol pagination
echo '<div class="d-flex justify-content-between align-items-center mt-3">';
if ($page > 1) {
    $prev_page = $page - 1;
    echo "<a href='?page=$prev_page' class='btn btn-outline-primary'>Sebelumnya</a>";
} else {
    echo "<button class='btn btn-outline-secondary' disabled>Sebelumnya</button>";
}

if ($page < $total_pages) {
    $next_page = $page + 1;
    echo "<a href='?page=$next_page' class='btn btn-outline-primary ms-auto'>Berikutnya</a>";
} else {
    echo "<button class='btn btn-outline-secondary ms-auto' disabled>Berikutnya</button>";
}
echo '</div>';

$content = ob_get_clean(); // Tangkap konten tabel ke dalam variabel $content

// Sertakan template untuk menampilkan halaman
include 'template.php';
?>
