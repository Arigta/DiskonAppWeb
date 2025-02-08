<?php
$title = "Edit Produk";
$header = '';

// Database connection
include 'koneksi.php';

// Periksa apakah parameter id tersedia
if (isset($_GET['id'])) {
    $idproduk = $_GET['id'];

    // Query untuk mengambil data berdasarkan ID
    $query = "SELECT * FROM barang WHERE idproduk = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $idproduk);
    $stmt->execute();
    $result = $stmt->get_result();

    // Periksa apakah data ditemukan
    if ($result->num_rows > 0) {
        $barang = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    echo "ID tidak ditemukan.";
    exit;
}

// Konten form edit
$content = '
<form method="POST" action="update_barang.php" class="p-4 border rounded shadow-sm bg-white">
    <h4 class="mb-4 text-center">Edit Barang</h4>
    
    <input type="hidden" name="idproduk" value="' . $barang['idproduk'] . '">
    
    <div class="mb-3">
        <label for="nama_produk" class="form-label">Nama Produk:</label>
        <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="' . htmlspecialchars($barang['nama_produk']) . '" required>
    </div>
    
    <div class="mb-3">
        <label for="harga" class="form-label">Harga:</label>
        <input type="number" step="0.01" class="form-control" id="harga" name="harga" value="' . $barang['harga'] . '" required>
    </div>
    
    <div class="mb-3">
        <label for="stok" class="form-label">Stok:</label>
        <input type="number" class="form-control" id="stok" name="stok" value="' . $barang['stok'] . '" required>
    </div>
    
    <div class="text-center">
        <button type="submit" class="btn btn-primary w-100">Update Barang</button>
    </div>
</form>
';

include 'template.php';
?>
