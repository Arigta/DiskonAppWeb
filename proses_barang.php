<?php
include 'koneksi.php';

$nama_produk = $_POST['nama_produk'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

// Gunakan prepared statement untuk keamanan
$stmt = $conn->prepare("INSERT INTO barang (nama_produk, harga, stok) VALUES (?, ?, ?)");
$stmt->bind_param("sdi", $nama_produk, $harga, $stok);

if ($stmt->execute()) {
    // Jika berhasil, arahkan ke barang.php
    header("Location: barang.php?status=success");
    exit(); // Pastikan untuk menghentikan script setelah header
} else {
    // Jika terjadi kesalahan, tampilkan pesan error
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
