<?php
$title = "Tambah Produk";
$header = '
';
$content = '
<form method="POST" action="proses_barang.php" class="p-4 border rounded shadow-sm bg-white">
    <h4 class="mb-4 text-center">Tambah Barang</h4>
    
    <div class="mb-3">
        <label for="nama_produk" class="form-label">Nama Produk:</label>
        <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Masukkan nama produk" required>
    </div>
    
    <div class="mb-3">
        <label for="harga" class="form-label">Harga:</label>
        <input type="number" step="0.01" class="form-control" id="harga" name="harga" placeholder="Masukkan harga" required>
    </div>
    
    <div class="mb-3">
        <label for="stok" class="form-label">Stok:</label>
        <input type="number" class="form-control" id="stok" name="stok" placeholder="Masukkan jumlah stok" required>
    </div>
    
    <div class="text-center">
        <button type="submit" class="btn btn-primary w-100">Tambah Barang</button>
    </div>
</form>
';

include 'template.php';
?>
