-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2023 at 08:46 AM
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
(15, 'Vans Shoes Blue', '750000', 5, '1679751869_d826df3950d86b0cba28.jpg'),
(16, 'Converse High-Top ', '1500000', 45, '1679751977_1b6a2863cda26961d10a.jpg'),
(17, 'Sneakers', '750000', 15, '1679752272_e1578a1426d0468142ea.jpg'),
(18, 'Nike Air Shoes', '3500000', 5900, '1679752399_eaeb084d7bf939202156.jpg'),
(19, 'Jordans Shoes', '2500000', 567, '1679752460_99c52cdd586b127ad4ee.jpg'),
(20, 'Adidas Shoes', '2750000', 1000, '1679752495_3455d6786ed6893d3369.jpg'),
(21, 'Puma Shoes', '1750000', 345, '1679752563_e2c0ac0d5eb037e76a2e.jpg'),
(22, 'Nike Shoes', '3000000', 0, '1679752599_00eb6a2e4fbec28bf286.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
