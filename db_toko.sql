-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2023 at 10:06 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_toko`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `lihatPenjualan` (`barang` INT(11))   BEGIN
SELECT * FROM detail_transaksi where id_barang=barang;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `lihatTransaksi` (`tgl` DATE)   BEGIN
select * from transaksi where Tanggal_Transaksi=tgl;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `lihatTransaksiBarang` (`id_barang` INT(11))   BEGIN
select * from detail_transaksi where id_barang=id_barang;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectTransaksi` ()   BEGIN
SELECT transaksi.id_transaksi,detail_transaksi.id_barang, 
detail_transaksi.Jumlah, detail_transaksi.subtotal
from transaksi JOIN detail_transaksi on transaksi.id_transaksi=detail_transaksi.id_Transaksi
;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Tambah_Barang` (`name` VARCHAR(100), `hrg` INT(11), `stok` INT(11), `expired` DATE)   BEGIN
INSERT INTO barang set
nama_barang=name,
harga_barang=hrg,
stok_barang=stok,
kadaluarsa=expired;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `stok_barang` int(11) NOT NULL,
  `kadaluarsa` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga_barang`, `stok_barang`, `kadaluarsa`) VALUES
(1, 'komo ', 500, 16, '2024-01-07'),
(2, 'Taro', 500, 33, '2023-11-23'),
(4, 'Aqua cup', 500, 83, '2023-11-23'),
(5, 'Kopi cup', 500, 54, '2023-11-27'),
(6, 'Fullo', 500, 26, '2023-11-22'),
(7, 'chocolatos', 500, 100, '2023-11-22'),
(8, 'Tempe kotak', 2500, 28, '2023-11-16'),
(9, 'Tahu Kuning', 500, 40, '2024-12-30'),
(10, 'Tahu Putih', 500, 40, '2023-12-30'),
(11, 'Aqua Botol', 3000, 50, '2023-11-22'),
(12, 'lemineral Botol', 3500, 40, '2023-11-23'),
(13, 'Torpedo Gelas', 500, 31, '2024-11-28'),
(14, 'Ale-Ale ', 500, 48, '2022-11-30'),
(15, 'Choco Chip', 1000, 21, '2025-11-11'),
(16, 'rokok Surya 12', 24000, 20, '2023-11-16'),
(17, 'Rokok Malboro 12', 34000, 20, '2023-11-01'),
(18, 'Rokok Aspro 12', 15000, 22, '2023-11-14'),
(19, 'Rokok Djarum 12', 28000, 9, '2023-11-23'),
(20, 'Rokok Juara Filter 12', 22000, 10, '2023-11-29'),
(21, 'Sabun liveboi', 1500, 30, '2023-11-22'),
(22, 'Sabun Nuvo', 1800, 36, '2023-11-16'),
(23, 'Sabun Mandi Citra', 1600, 40, '2024-11-13'),
(24, 'Sabun Mandi Lux', 1700, 50, '2023-11-21'),
(25, 'Shampo Head & Shoulder Sub Zero', 16000, 20, '2023-11-20'),
(26, 'Shampo Head & Shoulder  Tebal & Kuat', 16500, 20, '2023-11-15'),
(27, 'Shampo Head & Shoulder anti-Apek', 17000, 19, '2022-11-24'),
(28, 'Shampo Head & Shoulder Lemon', 16500, 20, '2022-11-23'),
(29, 'Shampo Head & Shoulder hair retail', 18000, 10, '2023-11-15'),
(30, 'Kopi goodday choco chino', 1500, 60, '2023-11-22'),
(31, 'Kopi goodday vanilla', 1500, 60, '2023-11-22'),
(32, 'Kopi goodday Carebian', 1500, 60, '2024-11-14'),
(33, 'Kopi goodday ice cold', 1600, 60, '2023-11-29'),
(34, 'Kopi goodday chocochino&carebian', 1800, 48, '2022-11-23'),
(35, 'Kopi goodday original', 1500, 36, '2023-11-22'),
(36, 'Luwak White Coffe', 1400, 36, '2022-11-10'),
(37, 'cuka', 2500, 11, '2024-11-23');

--
-- Triggers `barang`
--
DELIMITER $$
CREATE TRIGGER `before_barang_update` BEFORE UPDATE ON `barang` FOR EACH ROW BEGIN
INSERT INTO log_harga
set id_barang=OLD.id_barang,
harga_baru=new.harga_barang,
harga_lama=old.harga_barang,
waktu_perubahan = NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barangterhapus`
--

CREATE TABLE `barangterhapus` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `kadaluarsa` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barangterhapus`
--

INSERT INTO `barangterhapus` (`id_barang`, `nama_barang`, `harga_barang`, `stok`, `kadaluarsa`) VALUES
(1, 'komo', 500, 15, '2024-01-07'),
(1, 'komo', 500, 15, '2024-01-07'),
(9, 'Tahu Kuning', 500, 40, '2022-11-30'),
(1, 'komo', 500, 20, '2024-01-07');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_Transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `Jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_Transaksi`, `id_barang`, `subtotal`, `Jumlah`) VALUES
(1, 11, 30000, 10),
(1, 14, 10000, 20),
(2, 6, 20000, 40),
(2, 15, 20000, 40),
(3, 5, 50000, 100),
(4, 11, 30000, 10),
(4, 32, 15000, 10),
(5, 11, 39000, 13),
(6, 32, 45000, 30),
(7, 17, 100000, 3),
(8, 16, 60000, 3),
(8, 5, 7000, 14),
(9, 14, 5000, 10),
(10, 6, 2000, 4),
(11, 7, 5500, 11),
(12, 1, 6500, 13),
(13, 32, 30000, 20),
(13, 11, 9000, 3),
(13, 5, 1000, 2),
(14, 11, 15000, 5),
(15, 6, 7500, 15),
(15, 6, 10000, 20),
(16, 11, 24000, 8),
(16, 7, 1000, 2),
(17, 20, 22000, 1),
(17, 23, 1600, 1),
(17, 24, 1700, 1),
(18, 11, 84000, 28),
(18, 14, 1000, 2),
(19, 22, 1800, 1),
(19, 5, 1000, 2),
(20, 11, 45000, 15),
(21, 16, 48000, 2),
(21, 15, 7000, 7),
(22, 18, 15000, 1),
(22, 19, 28000, 1),
(23, 14, 12500, 25),
(24, 11, 15000, 5),
(25, 5, 7500, 15),
(26, 12, 7000, 2),
(26, 14, 2500, 5),
(27, 11, 15000, 5),
(27, 5, 2000, 4),
(28, 15, 6000, 6),
(29, 17, 68000, 2),
(29, 32, 12000, 8),
(30, 21, 7500, 4),
(30, 8, 2000, 1),
(31, 4, 5000, 10),
(31, 1, 6000, 10),
(32, 2, 5000, 10),
(32, 1, 5400, 9),
(32, 6, 2500, 5),
(32, 8, 2000, 1),
(33, 2, 5000, 10),
(33, 1, 5400, 9),
(33, 6, 2500, 5),
(33, 8, 2000, 1),
(34, 18, 150000, 10),
(35, 13, 2500, 5),
(35, 2, 2500, 5),
(36, 1, 3000, 5),
(36, 5, 3500, 7),
(37, 2, 3000, 6),
(37, 5, 1500, 3),
(38, 1, 1000, 2),
(38, 2, 500, 1),
(39, 2, 2500, 5),
(39, 5, 3000, 6),
(39, 21, 9000, 6),
(40, 4, 1500, 3),
(41, 1, 2000, 4),
(41, 4, 2000, 4);

--
-- Triggers `detail_transaksi`
--
DELIMITER $$
CREATE TRIGGER `update_stok_tansaksi` AFTER INSERT ON `detail_transaksi` FOR EACH ROW BEGIN
UPDATE barang set
stok_barang=stok_barang-new.Jumlah
where id_barang=new.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_transaksi` AFTER INSERT ON `detail_transaksi` FOR EACH ROW BEGIN
UPDATE transaksi set
Total_Pembelian=Total_Pembelian+new.subtotal
where id_transaksi=new.id_Transaksi;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `username`, `password`) VALUES
(1, 'Aris', '984b00ea54e771bae8746c37c7683d287b4b7f259f5c5193f0176654b534fe7c'),
(2, 'Ridwan', '4c36413ac2147963f358f296164e38405041b65a9d85fc7b04f80d84e627169c');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `log_harga`
--

CREATE TABLE `log_harga` (
  `id_log` int(11) NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `harga_lama` int(11) DEFAULT NULL,
  `harga_baru` int(11) DEFAULT NULL,
  `waktu_perubahan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_harga`
--

INSERT INTO `log_harga` (`id_log`, `id_barang`, `harga_lama`, `harga_baru`, `waktu_perubahan`) VALUES
(1, 1, 500, 600, '2023-01-01 07:18:03'),
(2, 18, 15000, 15000, '2023-01-01 07:54:15'),
(3, 4, 500, 500, '2023-01-01 08:46:59'),
(4, 1, 600, 600, '2023-01-01 08:56:15'),
(5, 2, 500, 500, '2023-01-08 13:56:20'),
(6, 1, 600, 600, '2023-01-08 13:56:20'),
(7, 6, 500, 500, '2023-01-08 13:56:20'),
(8, 8, 2000, 2000, '2023-01-08 13:56:20'),
(9, 2, 500, 500, '2023-01-08 13:58:22'),
(10, 1, 600, 600, '2023-01-08 13:58:22'),
(11, 6, 500, 500, '2023-01-08 13:58:22'),
(12, 8, 2000, 2000, '2023-01-08 13:58:22'),
(13, 18, 15000, 15000, '2023-01-08 15:15:11'),
(14, 13, 500, 500, '2023-01-08 15:17:05'),
(15, 2, 500, 500, '2023-01-08 15:17:05'),
(16, 16, 24000, 24000, '2023-01-08 15:44:41'),
(17, 16, 24000, 24000, '2023-01-08 15:45:14'),
(18, 1, 600, 600, '2023-01-08 15:45:47'),
(19, 27, 17000, 17000, '2023-01-08 15:46:00'),
(20, 28, 16500, 16500, '2023-01-08 15:46:17'),
(21, 37, 2500, 2500, '2023-01-08 15:46:24'),
(22, 1, 600, 600, '2023-01-08 15:48:06'),
(23, 5, 500, 500, '2023-01-08 15:48:06'),
(24, 6, 500, 500, '2023-01-08 16:39:18'),
(25, 6, 500, 500, '2023-01-08 16:39:22'),
(26, 6, 500, 500, '2023-01-08 16:39:28'),
(27, 6, 500, 500, '2023-01-08 16:39:52'),
(28, 1, 600, 0, '2023-01-08 16:40:07'),
(29, 1, 0, 500, '2023-01-08 16:40:15'),
(30, 8, 2000, 0, '2023-01-08 16:42:41'),
(31, 8, 0, 2500, '2023-01-08 16:43:19'),
(32, 1, 500, 500, '2023-01-08 16:43:54'),
(33, 1, 500, 500, '2023-01-08 16:45:11'),
(34, 1, 500, 500, '2023-01-08 16:45:18'),
(35, 1, 500, 500, '2023-01-08 16:46:07'),
(36, 1, 500, 500, '2023-01-08 16:46:32'),
(37, 1, 500, 500, '2023-01-08 16:47:04'),
(38, 1, 500, 500, '2023-01-08 16:47:10'),
(39, 1, 500, 500, '2023-01-08 16:47:17'),
(40, 1, 500, 1000, '2023-01-08 16:47:27'),
(41, 1, 1000, 500, '2023-01-08 16:47:35'),
(42, 2, 500, 500, '2023-01-08 17:20:16'),
(43, 5, 500, 500, '2023-01-08 17:20:16'),
(44, 1, 500, 500, '2023-01-08 17:21:01'),
(45, 2, 500, 500, '2023-01-08 17:21:01'),
(46, 9, 500, 500, '2023-01-09 04:42:26'),
(47, 10, 500, 500, '2023-01-09 04:42:48'),
(48, 1, 500, 500, '2023-01-09 04:43:19'),
(49, 2, 500, 500, '2023-01-09 04:43:28'),
(50, 2, 500, 500, '2023-01-09 04:46:21'),
(51, 5, 500, 500, '2023-01-09 04:46:21'),
(52, 21, 1500, 1500, '2023-01-09 04:46:21'),
(53, 17, 34000, 34000, '2023-01-09 06:30:14'),
(54, 1, 500, 500, '2023-01-09 06:30:38'),
(55, 4, 500, 500, '2023-01-09 06:31:32'),
(56, 18, 15000, 15000, '2023-01-24 21:07:50'),
(57, 18, 15000, 15000, '2023-01-24 21:09:10'),
(58, 1, 500, 500, '2023-01-24 21:10:42'),
(59, 4, 500, 500, '2023-01-24 21:10:42'),
(60, 1, 500, 500, '2023-01-24 21:14:14');

-- --------------------------------------------------------

--
-- Table structure for table `tambah_stok`
--

CREATE TABLE `tambah_stok` (
  `id_tambah_stok` int(11) NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `stok_tambahan` int(11) DEFAULT NULL,
  `waktu_penambahan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tambah_stok`
--

INSERT INTO `tambah_stok` (`id_tambah_stok`, `id_barang`, `stok_tambahan`, `waktu_penambahan`) VALUES
(1, 18, 10, '2023-01-01 07:54:15'),
(2, 16, 1, '0000-00-00 00:00:00'),
(3, 16, 9, '0000-00-00 00:00:00'),
(4, 1, 12, '0000-00-00 00:00:00'),
(5, 27, 9, '0000-00-00 00:00:00'),
(6, 28, 10, '0000-00-00 00:00:00'),
(7, 37, 1, '0000-00-00 00:00:00'),
(8, 1, 7, '0000-00-00 00:00:00'),
(9, 2, 20, '0000-00-00 00:00:00'),
(10, 17, 8, '0000-00-00 00:00:00'),
(11, 18, 10, '0000-00-00 00:00:00'),
(12, 18, 5, '0000-00-00 00:00:00');

--
-- Triggers `tambah_stok`
--
DELIMITER $$
CREATE TRIGGER `after_insert_tambah_stok` AFTER INSERT ON `tambah_stok` FOR EACH ROW BEGIN
UPDATE barang set
stok_barang=stok_barang+new.stok_tambahan
where id_barang=new.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `Total_Pembelian` int(11) NOT NULL,
  `Tanggal_Transaksi` date NOT NULL,
  `id_karyawan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `Total_Pembelian`, `Tanggal_Transaksi`, `id_karyawan`) VALUES
(1, 40000, '2022-11-17', 1),
(2, 40000, '2022-11-09', 1),
(3, 50000, '2022-11-23', 1),
(4, 45000, '2022-11-23', 1),
(5, 39000, '2022-11-23', 2),
(6, 45000, '2022-11-23', 1),
(7, 100000, '2022-11-16', 2),
(8, 67000, '2022-11-09', 1),
(9, 5000, '2022-11-16', 2),
(10, 2000, '2022-11-16', 2),
(11, 5500, '2022-11-16', 1),
(12, 6500, '2022-11-22', 1),
(13, 40000, '2022-11-10', 1),
(14, 15000, '2023-11-15', 1),
(15, 17500, '2022-11-30', 1),
(16, 25000, '2022-11-30', 1),
(17, 25300, '2022-11-30', 2),
(18, 85000, '2022-11-23', 1),
(19, 2800, '2022-11-29', 1),
(20, 45000, '2022-11-28', 1),
(21, 55000, '2022-11-09', 1),
(22, 43000, '2022-11-30', 1),
(23, 12500, '2022-11-30', 1),
(24, 15000, '2022-11-08', 2),
(25, 7500, '2022-11-30', 1),
(26, 9500, '2022-11-23', 2),
(27, 17000, '2022-11-29', 1),
(28, 6000, '2022-11-29', 1),
(29, 80000, '2022-11-23', 2),
(30, 9500, '2022-11-30', 1),
(31, 11000, '2023-01-01', 1),
(32, 14900, '2023-01-08', 2),
(33, 14900, '2023-01-08', 2),
(34, 150000, '2023-01-08', 2),
(35, 5000, '2023-01-08', 2),
(36, 6500, '2023-01-08', 1),
(37, 4500, '2023-01-09', 1),
(38, 1500, '2023-01-09', 1),
(39, 14500, '2023-01-09', 1),
(40, 1500, '2023-01-09', 2),
(41, 4000, '2023-01-25', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD KEY `id_Transasksi` (`id_Transaksi`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_harga`
--
ALTER TABLE `log_harga`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `tambah_stok`
--
ALTER TABLE `tambah_stok`
  ADD PRIMARY KEY (`id_tambah_stok`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `log_harga`
--
ALTER TABLE `log_harga`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `tambah_stok`
--
ALTER TABLE `tambah_stok`
  MODIFY `id_tambah_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_Transaksi`) REFERENCES `transaksi` (`id_transaksi`);

--
-- Constraints for table `log_harga`
--
ALTER TABLE `log_harga`
  ADD CONSTRAINT `log_harga_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Constraints for table `tambah_stok`
--
ALTER TABLE `tambah_stok`
  ADD CONSTRAINT `tambah_stok_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
