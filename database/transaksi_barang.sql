-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 25 Feb 2025 pada 04.07
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transaksi_barang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `idproduk` int NOT NULL,
  `nama_produk` varchar(30) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`idproduk`, `nama_produk`, `harga`, `stok`) VALUES
(1, 'Minyak Goreng 2 Literg', 24000.00, 49),
(2, 'Gula Pasir 2kg', 30000.00, 51),
(3, 'Beras 5kg', 30000.00, 54),
(4, 'Tisu 1 dus ', 28000.00, 58),
(5, 'Buku tulis 1 dus 23 pack', 1300000.00, 60),
(6, 'Kripik Kentang 2kg', 45000.00, 63),
(7, 'Mie Instan 1 dus 23 pcs', 150000.00, 63),
(8, 'Ikan Kaleng 1 dus 12 pcs', 80000.00, 62),
(9, 'susu kaleng ', 12000.00, 63),
(10, 'Snack Coklat 2 kg', 9000.00, 40);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `idtransaksi` int NOT NULL,
  `idproduk` int NOT NULL,
  `nama_produk` varchar(30) NOT NULL,
  `jumlah` int NOT NULL,
  `sub_total` double NOT NULL,
  `diskon` decimal(10,0) NOT NULL,
  `total_harga` decimal(10,0) NOT NULL,
  `jumlah_bayar` decimal(10,0) NOT NULL,
  `kembalian` decimal(10,0) NOT NULL,
  `tanggal_transaksi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`idtransaksi`, `idproduk`, `nama_produk`, `jumlah`, `sub_total`, `diskon`, `total_harga`, `jumlah_bayar`, `kembalian`, `tanggal_transaksi`) VALUES
(1, 1, 'Minyak Gore 2 Liter', 1, 0, 0, 24000, 0, 0, '2025-01-27 08:41:07'),
(2, 1, 'Minyak Gore 2 Liter', 2, 0, 2400, 45600, 0, 0, '2025-01-27 08:43:57'),
(3, 1, 'Minyak Gore 2 Liter', 2, 0, 2400, 45600, 0, 0, '2025-01-27 08:47:00'),
(4, 1, 'Minyak Gore 2 Liter', 2, 0, 2400, 45600, 0, 0, '2025-01-27 08:50:04'),
(5, 1, 'Minyak Gore 2 Liter', 2, 0, 2400, 45600, 0, 0, '2025-01-27 08:54:29'),
(6, 1, 'Minyak Gore 2 Liter', 2, 0, 2400, 45600, 0, 0, '2025-01-27 08:55:17'),
(7, 1, 'Minyak Gore 2 Liter', 1, 0, 0, 24000, 0, 0, '2025-01-27 08:56:12'),
(8, 1, 'Minyak Gore 2 Liter', 10, 0, 36000, 204000, 0, 0, '2025-01-27 08:56:38'),
(9, 1, 'Minyak Gore 2 Liter', 10, 0, 36000, 204000, 0, 0, '2025-01-27 08:59:35'),
(10, 1, 'Minyak Gore 2 Liter', 10, 0, 36000, 204000, 0, 0, '2025-01-27 08:59:58'),
(11, 1, 'Minyak Gore 2 Liter', 0, 0, 0, 0, 0, 0, '2025-01-27 09:00:57'),
(12, 2, 'Gula Pasir 2k', 3, 90000, 4500, 85500, 0, 0, '2025-01-27 17:01:28'),
(13, 1, 'Minyak Gore 2 Liter', 2, 48000, 2400, 45600, 0, 0, '2025-01-28 07:46:32'),
(14, 1, 'Minyak Gore 2 Liter', 2, 48000, 2400, 45600, 0, 0, '2025-01-28 08:21:20'),
(15, 2, 'Gula Pasir 2kg', 2, 60000, 3000, 57000, 0, 0, '2025-01-28 08:21:20'),
(16, 3, 'Beras 5kg', 2, 60000, 3000, 57000, 0, 0, '2025-01-28 08:21:20'),
(17, 4, 'Tisu 1 dus ', 2, 56000, 2800, 53200, 0, 0, '2025-01-28 08:21:20'),
(18, 1, 'Minyak Gore 2 Liter', 111, 2664000, 399600, 2264400, 0, 0, '2025-01-28 09:17:06'),
(19, 1, 'Minyak Gore 2 Liter', 1, 24000, 0, 24000, 0, 0, '2025-01-28 09:36:39'),
(20, 2, 'Gula Pasir 2kg', 1, 30000, 0, 30000, 0, 0, '2025-01-28 09:42:11'),
(21, 1, 'Minyak Gore 2 Liter', 1, 24000, 0, 24000, 0, 0, '2025-01-28 14:21:45'),
(22, 1, 'Minyak Gore 2 Liter', 1, 24000, 0, 24000, 0, 0, '2025-01-28 14:23:05'),
(23, 3, 'Beras 5kg', 1, 30000, 0, 30000, 0, 0, '2025-01-28 14:23:35'),
(24, 3, 'Beras 5kg', 1, 30000, 0, 30000, 0, 0, '2025-01-28 14:23:39'),
(25, 2, 'Gula Pasir 2kg', 3, 90000, 4500, 85500, 0, 0, '2025-01-28 14:24:02'),
(26, 3, 'Beras 5kg', 4, 120000, 6000, 114000, 0, 0, '2025-01-28 14:24:02'),
(27, 4, 'Tisu 1 dus ', 1, 28000, 0, 28000, 0, 0, '2025-01-28 14:24:02'),
(28, 5, 'Buku tulis 1 dus 23 pack', 3, 3900000, 195000, 3705000, 0, 0, '2025-01-28 14:24:02'),
(29, 10, 'Snack Coklat 2 kg', 20, 180000, 27000, 153000, 0, 0, '2025-01-28 15:12:39'),
(30, 1, 'Minyak Goreng 2 Liter', 1, 23000, 0, 23000, 0, 0, '2025-01-29 07:56:03'),
(31, 2, 'Gula Pasir 2kg', 1, 30000, 0, 30000, 0, 0, '2025-01-29 07:56:03'),
(32, 3, 'Beras 5kg', 1, 30000, 0, 30000, 0, 0, '2025-01-29 07:56:03'),
(33, 4, 'Tisu 1 dus ', 1, 28000, 0, 28000, 0, 0, '2025-01-29 07:56:03'),
(34, 5, 'Buku tulis 1 dus 23 pack', 1, 1300000, 0, 1300000, 0, 0, '2025-01-29 07:56:03'),
(35, 6, 'Kripik Kentang 2kg', 1, 45000, 0, 45000, 0, 0, '2025-01-29 07:56:03'),
(36, 7, 'Mie Instan 1 dus 23 pcs', 1, 150000, 0, 150000, 0, 0, '2025-01-29 07:56:03'),
(37, 8, 'Ikan Kaleng 1 dus 12 pcs', 1, 80000, 0, 80000, 0, 0, '2025-01-29 07:56:03'),
(38, 9, 'susu kaleng ', 1, 12000, 0, 12000, 0, 0, '2025-01-29 07:56:03'),
(39, 10, 'Snack Coklat 2 kg', 1, 9000, 0, 9000, 0, 0, '2025-01-29 07:56:03'),
(40, 8, 'Ikan Kaleng 1 dus 12 pcs', 1, 80000, 0, 80000, 0, 0, '2025-01-29 07:56:25'),
(41, 2, 'Gula Pasir 2kg', 1, 30000, 0, 30000, 0, 0, '2025-01-29 07:56:54'),
(42, 1, 'Minyak Goreng 2 Literg', 3, 6900000, 345000, 6555000, 0, 0, '2025-02-08 03:47:52'),
(43, 10, 'Snack Coklat 2 kg', 3, 2700000, 135000, 2565000, 0, 0, '2025-02-08 03:57:34'),
(44, 1, 'Minyak Goreng 2 Literg', 10, 240000, 36000, 204000, 0, 0, '2025-02-08 08:34:21'),
(45, 2, 'Gula Pasir 2kg', 5, 150000, 7500, 142500, 0, 0, '2025-02-08 08:34:21'),
(46, 3, 'Beras 5kg', 2, 60000, 0, 60000, 0, 0, '2025-02-08 08:34:21'),
(47, 4, 'Tisu 1 dus ', 3, 8400000, 420000, 7980000, 0, 0, '2025-02-08 08:41:35'),
(48, 3, 'Beras 5kg', 1, 30000, 0, 30000, 0, 0, '2025-02-25 03:52:55'),
(49, 4, 'Tisu 1 dus ', 1, 28000, 0, 28000, 0, 0, '2025-02-25 03:52:55'),
(50, 1, 'Minyak Goreng 2 Literg', 1, 24000, 0, 24000, 900000, 876000, '2025-02-25 04:02:08');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`idproduk`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idtransaksi`),
  ADD KEY `idproduk` (`idproduk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `idproduk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `idtransaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`idproduk`) REFERENCES `barang` (`idproduk`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
