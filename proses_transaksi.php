

<?php

// Koneksi ke database
include 'koneksi.php';

// Ambil data JSON dari request POST
$data = json_decode(file_get_contents('php://input'), true);

// Periksa apakah data valid
if ($data && is_array($data)) {
    // Mulai transaksi
    $conn->begin_transaction();

    try {
        // Loop untuk menyimpan setiap transaksi
        foreach ($data as $order) {
            $idproduk = $order['id'];
            $nama_produk = $order['nama'];
            $jumlah = $order['qty'];
            $sub_total = $order['subtotal'];
            $diskon = 0;

            // Hitung diskon berdasarkan qty
            if ($jumlah >= 3 && $jumlah < 10) {
                $diskon = $sub_total * 0.05;
            } elseif ($jumlah >= 10) {
                $diskon = $sub_total * 0.15;
            }

            $total_harga = $sub_total - $diskon;

            // Cek stok produk terlebih dahulu
            $check_stmt = $conn->prepare("SELECT stok FROM barang WHERE idproduk = ?");
            $check_stmt->bind_param("i", $idproduk);
            $check_stmt->execute();
            $result = $check_stmt->get_result();
            $row = $result->fetch_assoc();
            $stok = $row['stok'];

            // Periksa apakah stok mencukupi
            if ($stok < $jumlah) {
                throw new Exception("Stok untuk produk '$nama_produk' tidak mencukupi. Stok tersedia: $stok");
            }

            // Jika stok mencukupi, kurangi stok
            $new_stok = $stok - $jumlah;
            $update_stmt = $conn->prepare("UPDATE barang SET stok = ? WHERE idproduk = ?");
            $update_stmt->bind_param("ii", $new_stok, $idproduk);
            if (!$update_stmt->execute()) {
                throw new Exception("Error saat mengurangi stok produk: " . $update_stmt->error);
            }

            // Query untuk memasukkan data transaksi ke database
            $stmt = $conn->prepare("INSERT INTO transaksi (idproduk, nama_produk, jumlah, sub_total, diskon, total_harga) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssiiid", $idproduk, $nama_produk, $jumlah, $sub_total, $diskon, $total_harga);

            // Eksekusi query
            if (!$stmt->execute()) {
                throw new Exception("Error saat menyimpan data transaksi: " . $stmt->error);
            }
        }

        // Commit transaksi
        $conn->commit();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        // Rollback jika ada error
        $conn->rollback();
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Data tidak valid']);
}