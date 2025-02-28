<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_produk = $_GET['id'];

    // Hapus data barang berdasarkan ID
    $query = "DELETE FROM barang WHERE idproduk = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_produk);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }

    $stmt->close();
}
$conn->close();
?>
