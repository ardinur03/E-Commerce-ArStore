-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2023 at 09:21 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` decimal(12,0) NOT NULL,
  `stok` int(10) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama`, `harga`, `stok`, `gambar`) VALUES
(14, 'Nike Running Shoes', '2250000', 231, '1679751124_861c0fefbf91e2014766.jpg'),
(15, 'Vans Shoes Blue', '750000', 0, '1679751869_d826df3950d86b0cba28.jpg'),
(16, 'Converse High-Top ', '1500000', 45, '1679751977_1b6a2863cda26961d10a.jpg'),
(17, 'Sneakers', '750000', 11, '1679752272_e1578a1426d0468142ea.jpg'),
(18, 'Nike Air Shoes', '3500000', 5896, '1679752399_eaeb084d7bf939202156.jpg'),
(19, 'Jordans Shoes', '2500000', 567, '1679752460_99c52cdd586b127ad4ee.jpg'),
(20, 'Adidas Shoes', '2750000', 1000, '1679752495_3455d6786ed6893d3369.jpg'),
(21, 'Puma Shoes', '1750000', 345, '1679752563_e2c0ac0d5eb037e76a2e.jpg'),
(22, 'Nike Shoes', '3000000', 1, '1679752599_00eb6a2e4fbec28bf286.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `jual`
--

CREATE TABLE `jual` (
  `no_transaksi` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `jumlah_jual` int(11) NOT NULL,
  `harga_jual` decimal(12,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jual`
--

INSERT INTO `jual` (`no_transaksi`, `barang_id`, `jumlah_jual`, `harga_jual`) VALUES
(30, 15, 2, '750000'),
(31, 15, 2, '750000'),
(42, 15, 1, '750000');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_penjualan`
--

CREATE TABLE `transaksi_penjualan` (
  `no_transaksi` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `total_transaksi` decimal(12,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_penjualan`
--

INSERT INTO `transaksi_penjualan` (`no_transaksi`, `tanggal`, `nama`, `no_hp`, `alamat`, `kecamatan`, `kota`, `total_transaksi`) VALUES
(30, '2023-04-03', 'a', '23', 'a', 'a', 'a', '1500000'),
(31, '2023-04-03', 'b', '12', 's', 'd', 'a', '1500000'),
(32, '2023-04-03', 'a', '2', 'sd', 'as', 'a', '1500000'),
(33, '2023-04-03', 'ds', 'ds', 'ds', 'ds', 'ds', '1500000'),
(34, '2023-04-03', 'ds', 'ds', 'ds', 'd', 'ds', '1500000'),
(35, '2023-04-03', 'sa', 'sa', 'sa', 'sa', 'sa', '1500000'),
(36, '2023-04-03', 'd', 'ds', 'sd', 'ds', 'ds', '1500000'),
(37, '2023-04-03', 'dsd', 'ds', 'dd', 'd', 'd', '1500000'),
(38, '2023-04-03', 'ds', 'ds', 'ds', 'ds', 'ds', '1500000'),
(39, '2023-04-03', 'd', 'ds', 'ds', 'd', 'ds', '1500000'),
(40, '2023-04-03', 'ads', 'da', 'das', 'ds', 'ds', '7500000'),
(41, '2023-04-03', 'a', 'a', 'a', 'ds', 'sd', '6000000'),
(42, '2023-04-03', 'ad', '23', 'ad', 'asd', 'da', '750000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `jual`
--
ALTER TABLE `jual`
  ADD KEY `barang_id` (`barang_id`),
  ADD KEY `no_transaksi` (`no_transaksi`);

--
-- Indexes for table `transaksi_penjualan`
--
ALTER TABLE `transaksi_penjualan`
  ADD PRIMARY KEY (`no_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `transaksi_penjualan`
--
ALTER TABLE `transaksi_penjualan`
  MODIFY `no_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jual`
--
ALTER TABLE `jual`
  ADD CONSTRAINT `jual_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `jual_ibfk_2` FOREIGN KEY (`no_transaksi`) REFERENCES `transaksi_penjualan` (`no_transaksi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
