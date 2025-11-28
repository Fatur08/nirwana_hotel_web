-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2025 at 02:26 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_nirwana`
--

-- --------------------------------------------------------

--
-- Table structure for table `histori_kamar`
--

CREATE TABLE `histori_kamar` (
  `id_histori_kamar` int(255) NOT NULL,
  `id_laporan_keuangan` int(255) DEFAULT NULL,
  `id_nomor_kamar` int(255) DEFAULT NULL,
  `nama_tamu` varchar(255) DEFAULT NULL,
  `nomor_ktp_tamu` int(255) DEFAULT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(255) NOT NULL,
  `kode_kamar` varchar(255) DEFAULT NULL,
  `tarif_per_hari` bigint(255) DEFAULT NULL,
  `tipe_kamar` varchar(255) DEFAULT NULL,
  `before_10%` bigint(255) DEFAULT NULL,
  `after_10%` bigint(255) DEFAULT NULL,
  `rate_net` bigint(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `kode_kamar`, `tarif_per_hari`, `tipe_kamar`, `before_10%`, `after_10%`, `rate_net`) VALUES
(1, 'DLX', 300000, 'Deluxe', 397000, 357300, 289413),
(2, 'SPR', 280000, 'Superior', 369000, 332100, 269001),
(3, 'STD', 240000, 'Standar', 310000, 279000, 225990);

-- --------------------------------------------------------

--
-- Table structure for table `laporan_keuangan`
--

CREATE TABLE `laporan_keuangan` (
  `id_laporan_keuangan` int(255) NOT NULL,
  `kode_kamar` varchar(255) DEFAULT NULL,
  `nama_tamu` varchar(255) DEFAULT NULL,
  `tipe_kamar` varchar(255) DEFAULT NULL,
  `jumlah_kamar_dipesan` int(255) DEFAULT NULL,
  `tarif_per_hari` bigint(255) DEFAULT NULL,
  `before_10%` bigint(255) DEFAULT NULL,
  `after_10%` bigint(255) DEFAULT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  `lama_inap` int(255) DEFAULT NULL,
  `biaya` bigint(255) DEFAULT NULL,
  `biaya_tambahan` bigint(255) DEFAULT NULL,
  `pajak` bigint(255) DEFAULT NULL,
  `diskon` bigint(255) DEFAULT NULL,
  `total_diterima` bigint(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nomor_kamar`
--

CREATE TABLE `nomor_kamar` (
  `id_nomor_kamar` int(255) NOT NULL,
  `id_kamar` int(255) DEFAULT NULL,
  `nomor_kamar` int(255) DEFAULT NULL,
  `status_dipesan` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nomor_kamar`
--

INSERT INTO `nomor_kamar` (`id_nomor_kamar`, `id_kamar`, `nomor_kamar`, `status_dipesan`) VALUES
(1, 1, 1, 0),
(2, 1, 2, 0),
(3, 1, 3, 0),
(4, 1, 4, 0),
(5, 1, 5, 0),
(6, 1, 6, 0),
(7, 2, 1, 0),
(8, 2, 2, 0),
(9, 2, 3, 0),
(10, 2, 4, 0),
(11, 2, 5, 0),
(12, 2, 6, 0),
(13, 2, 7, 0),
(14, 3, 1, 0),
(15, 3, 2, 0),
(16, 3, 3, 0),
(17, 3, 4, 0),
(18, 3, 5, 0);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `histori_kamar`
--
ALTER TABLE `histori_kamar`
  MODIFY `id_histori_kamar` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `laporan_keuangan`
--
ALTER TABLE `laporan_keuangan`
  MODIFY `id_laporan_keuangan` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nomor_kamar`
--
ALTER TABLE `nomor_kamar`
  MODIFY `id_nomor_kamar` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
