-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 08, 2026 at 01:38 PM
-- Server version: 11.8.8-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u859704623_db_nirwana`
--

-- --------------------------------------------------------

--
-- Table structure for table `histori_kamar`
--

CREATE TABLE `histori_kamar` (
  `id_histori_kamar` int(255) NOT NULL,
  `id_laporan_keuangan` int(255) DEFAULT NULL,
  `id_rincian_pesanan` int(255) DEFAULT NULL,
  `id_nomor_kamar` int(255) DEFAULT NULL,
  `nama_tamu` varchar(255) DEFAULT NULL,
  `alamat_tamu` varchar(255) DEFAULT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `histori_kamar`
--

INSERT INTO `histori_kamar` (`id_histori_kamar`, `id_laporan_keuangan`, `id_rincian_pesanan`, `id_nomor_kamar`, `nama_tamu`, `alamat_tamu`, `check_in`, `check_out`) VALUES
(320, 255, 28, 13, 'Google', 'HUAWEI', '2026-07-18', '2026-07-19'),
(321, 255, 28, 15, 'Google', 'HUAWEI', '2026-07-18', '2026-07-19'),
(322, 256, 28, 21, 'Google', 'HUAWEI', '2026-07-18', '2026-07-19'),
(327, 259, 27, 3, 'Google', 'HUAWEI', '2026-07-15', '2026-07-16'),
(328, 259, 27, 7, 'Google', 'HUAWEI', '2026-07-15', '2026-07-16');

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(255) NOT NULL,
  `kode_kamar` varchar(255) DEFAULT NULL,
  `tarif_per_hari` bigint(255) DEFAULT NULL,
  `tipe_kamar` varchar(255) DEFAULT NULL,
  `before_10_persen` bigint(255) DEFAULT NULL,
  `after_10_persen` bigint(255) DEFAULT NULL,
  `rate_net` bigint(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `kode_kamar`, `tarif_per_hari`, `tipe_kamar`, `before_10_persen`, `after_10_persen`, `rate_net`) VALUES
(1, 'DLX', 300000, 'Deluxe', 397000, 357300, 289413),
(2, 'SPR', 280000, 'Superior', 369000, 332100, 269001),
(3, 'STD', 240000, 'Standart', 310000, 279000, 225990),
(4, 'HMSTY', 800000, 'Home Stay', NULL, NULL, NULL),
(5, 'BED', 60000, 'Ekstra Bed', NULL, NULL, NULL),
(6, 'FAST', 30000, 'Breakfast', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `laporan_keuangan`
--

CREATE TABLE `laporan_keuangan` (
  `id_laporan_keuangan` int(255) NOT NULL,
  `id_rincian_pesanan` int(255) DEFAULT NULL,
  `kode_kamar` varchar(255) DEFAULT NULL,
  `nama_tamu` varchar(255) DEFAULT NULL,
  `tipe_kamar` varchar(255) DEFAULT NULL,
  `jumlah_kamar_dipesan` int(255) DEFAULT NULL,
  `tarif_per_hari` bigint(255) DEFAULT NULL,
  `before_10_persen` bigint(255) DEFAULT NULL,
  `after_10_persen` bigint(255) DEFAULT NULL,
  `tanggal_dipesan` datetime DEFAULT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  `lama_inap` int(255) DEFAULT NULL,
  `biaya` bigint(255) DEFAULT NULL,
  `biaya_tambahan` bigint(255) DEFAULT NULL,
  `pajak` bigint(255) DEFAULT NULL,
  `total_diterima` bigint(255) DEFAULT NULL,
  `foto_ktp` varchar(255) DEFAULT NULL,
  `metode_pembayaran` varchar(255) DEFAULT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `status_pembayaran` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_keuangan`
--

INSERT INTO `laporan_keuangan` (`id_laporan_keuangan`, `id_rincian_pesanan`, `kode_kamar`, `nama_tamu`, `tipe_kamar`, `jumlah_kamar_dipesan`, `tarif_per_hari`, `before_10_persen`, `after_10_persen`, `tanggal_dipesan`, `check_in`, `check_out`, `lama_inap`, `biaya`, `biaya_tambahan`, `pajak`, `total_diterima`, `foto_ktp`, `metode_pembayaran`, `bukti_pembayaran`, `status_pembayaran`) VALUES
(255, 28, 'SPR', 'Google', 'Superior', 2, 280000, 369000, 332100, '2026-07-07 20:57:51', '2026-07-18', '2026-07-19', 1, 664200, 0, 126198, 538002, 'Foto_KTP_Google_2026-07-07_20-56-45.jpg', 'Cash', NULL, 1),
(256, 28, 'STD', 'Google', 'Standart', 1, 240000, 310000, 279000, '2026-07-07 20:57:51', '2026-07-18', '2026-07-19', 1, 279000, 0, 53010, 225990, 'Foto_KTP_Google_2026-07-07_20-56-45.jpg', 'Cash', NULL, 1),
(259, 27, 'DLX', 'Google', 'Deluxe', 2, 300000, 397000, 357300, '2026-07-08 14:08:19', '2026-07-15', '2026-07-16', 1, 714600, 0, 135774, 578826, 'Foto_KTP_Google_2026-07-07_20-56-45.jpg', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nomor_kamar`
--

CREATE TABLE `nomor_kamar` (
  `id_nomor_kamar` int(255) NOT NULL,
  `id_kamar` int(255) DEFAULT NULL,
  `nomor_kamar` int(255) DEFAULT NULL,
  `jenis_bed` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nomor_kamar`
--

INSERT INTO `nomor_kamar` (`id_nomor_kamar`, `id_kamar`, `nomor_kamar`, `jenis_bed`) VALUES
(1, 1, 1, NULL),
(2, 1, 2, NULL),
(3, 1, 3, NULL),
(4, 1, 4, NULL),
(5, 1, 5, NULL),
(6, 1, 6, NULL),
(7, 1, 7, NULL),
(8, 1, 8, NULL),
(9, 1, 9, NULL),
(10, 1, 10, NULL),
(11, 2, 11, NULL),
(12, 2, 12, NULL),
(13, 2, 13, NULL),
(14, 2, 14, NULL),
(15, 2, 15, NULL),
(16, 2, 16, NULL),
(17, 2, 17, NULL),
(18, 2, 18, NULL),
(19, 3, 19, NULL),
(20, 3, 20, NULL),
(21, 3, 21, NULL),
(22, 3, 22, NULL),
(23, 3, 23, NULL),
(24, 4, 24, NULL),
(25, 4, 25, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id_request` int(255) NOT NULL,
  `id_rincian_pesanan` int(255) DEFAULT NULL,
  `kode_request` varchar(255) DEFAULT NULL,
  `jumlah_request` int(255) DEFAULT NULL,
  `total_harga` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id_request`, `id_rincian_pesanan`, `kode_request`, `jumlah_request`, `total_harga`) VALUES
(77, 28, 'BED', 2, 120000),
(78, 28, 'FAST', 6, 180000),
(83, 27, 'BED', 2, 120000),
(84, 27, 'FAST', 3, 90000);

-- --------------------------------------------------------

--
-- Table structure for table `resi_manual`
--

CREATE TABLE `resi_manual` (
  `id_resi_manual` int(255) NOT NULL,
  `nama_tamu_resi_manual` varchar(255) DEFAULT NULL,
  `alamat_tamu_resi_manual` varchar(255) DEFAULT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  `jumlah_kamar_deluxe` int(255) DEFAULT NULL,
  `jumlah_kamar_superior` int(255) DEFAULT NULL,
  `jumlah_kamar_standart` int(255) DEFAULT NULL,
  `jumlah_homestay` int(255) DEFAULT NULL,
  `jumlah_ekstrabed` int(255) DEFAULT NULL,
  `jumlah_breakfast` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rincian_pesanan`
--

CREATE TABLE `rincian_pesanan` (
  `id_rincian_pesanan` int(255) NOT NULL,
  `nama_tamu` varchar(255) DEFAULT NULL,
  `no_wa_tamu` varchar(255) DEFAULT NULL,
  `total_kamar_dipesan` int(255) DEFAULT NULL,
  `total_request` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rincian_pesanan`
--

INSERT INTO `rincian_pesanan` (`id_rincian_pesanan`, `nama_tamu`, `no_wa_tamu`, `total_kamar_dipesan`, `total_request`) VALUES
(27, 'Google', '085766698404', 2, 210000),
(28, 'Google', '088975660188', 3, 300000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `histori_kamar`
--
ALTER TABLE `histori_kamar`
  ADD PRIMARY KEY (`id_histori_kamar`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `laporan_keuangan`
--
ALTER TABLE `laporan_keuangan`
  ADD PRIMARY KEY (`id_laporan_keuangan`);

--
-- Indexes for table `nomor_kamar`
--
ALTER TABLE `nomor_kamar`
  ADD PRIMARY KEY (`id_nomor_kamar`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id_request`);

--
-- Indexes for table `resi_manual`
--
ALTER TABLE `resi_manual`
  ADD PRIMARY KEY (`id_resi_manual`);

--
-- Indexes for table `rincian_pesanan`
--
ALTER TABLE `rincian_pesanan`
  ADD PRIMARY KEY (`id_rincian_pesanan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `histori_kamar`
--
ALTER TABLE `histori_kamar`
  MODIFY `id_histori_kamar` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=329;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `laporan_keuangan`
--
ALTER TABLE `laporan_keuangan`
  MODIFY `id_laporan_keuangan` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

--
-- AUTO_INCREMENT for table `nomor_kamar`
--
ALTER TABLE `nomor_kamar`
  MODIFY `id_nomor_kamar` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id_request` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `resi_manual`
--
ALTER TABLE `resi_manual`
  MODIFY `id_resi_manual` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rincian_pesanan`
--
ALTER TABLE `rincian_pesanan`
  MODIFY `id_rincian_pesanan` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
