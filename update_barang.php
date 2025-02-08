<?php
// Koneksi ke database
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idproduk = $_POST['idproduk'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Query untuk mengupdate data
    $query = "UPDATE barang SET nama_produk = ?, harga = ?, stok = ? WHERE idproduk = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sdii', $nama_produk, $harga, $stok, $idproduk);

    if ($stmt->execute()) {
        // Redirect ke halaman utama setelah berhasil diupdate
        header("Location: barang.php");
    } else {
        echo "Gagal mengupdate data: " . $conn->error;
    }
}
?>
