-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 08, 2023 at 09:03 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reservasiMenu`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idKeranjang` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `catatan` text NOT NULL,
  `idOngkir` int(11) NOT NULL,
  `metodePembayaran` int(1) NOT NULL,
  `statusPembayaran` int(1) NOT NULL DEFAULT 0,
  `buktiPembayaran` text DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `opsi` varchar(20) NOT NULL,
  `idKhusus` varchar(29) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `idUser`, `idKeranjang`, `alamat`, `catatan`, `idOngkir`, `metodePembayaran`, `statusPembayaran`, `buktiPembayaran`, `tanggal`, `jam`, `opsi`, `idKhusus`, `createdAt`, `updatedAt`) VALUES
(1, 3, 14, 'Jl. Apa', 'Biasa', 2, 2, 0, NULL, '2023-06-08', '12:00:00', 'Delivery', '3-20230608131621', '2023-06-08 06:16:21', NULL),
(2, 3, 15, 'Jl. Apa', 'Biasa', 2, 2, 0, NULL, '2023-06-08', '12:00:00', 'Delivery', '3-20230608131621', '2023-06-08 06:16:21', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
