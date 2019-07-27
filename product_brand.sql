-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2019 at 06:06 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cosmetic-mobile`
--

-- --------------------------------------------------------

--
-- Table structure for table `product_brand`
--

CREATE TABLE `product_brand` (
  `brand_id` int(20) NOT NULL,
  `brand_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_logo` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_brand`
--

INSERT INTO `product_brand` (`brand_id`, `brand_name`, `brand_logo`) VALUES
(1, 'Kanebo Lunasol', 'http://192.168.1.173/webService/brand_logo/lunasol.png'),
(2, 'Too Faced', 'http://192.168.1.173/webService/brand_logo/toofaced.png'),
(3, 'Tom Ford', 'http://192.168.1.173/webService/brand_logo/tomford.png'),
(4, 'Anastasia Beverly Hills', 'http://192.168.1.173/webService/brand_logo/anastasia.png'),
(5, 'Charlotte Tilbury', 'http://192.168.1.173/webService/brand_logo/charolotte.png'),
(6, 'Nars', 'http://192.168.1.173/webService/brand_logo/nars.png'),
(7, 'Majolica Majorca', 'http://192.168.1.173/webService/brand_logo/majolica.png'),
(8, 'LANCÔME', 'http://192.168.1.173/webService/brand_logo/lancome.png'),
(9, 'Maybelline', 'http://192.168.1.173/webService/brand_logo/Maybelline-logo.png'),
(10, 'Rimmel London', 'http://192.168.1.173/webService/brand_logo/rimmel.png'),
(11, 'Covergirl', 'http://192.168.1.173/webService/brand_logo/covergirl.png'),
(12, 'L\'Oreal', 'http://192.168.1.173/webService/brand_logo/loreal.png'),
(13, 'Bourjois', 'http://192.168.1.173/webService/brand_logo/bourjois.png'),
(14, 'Dior', 'http://192.168.1.173/webService/brand_logo/dior.jpg'),
(15, 'Stila Cosmetics', 'http://192.168.1.173/webService/brand_logo/stila.png'),
(16, 'Etude House', 'http://192.168.1.173/webService/brand_logo/etude.png'),
(17, 'NYX', 'http://192.168.1.173/webService/brand_logo/nyx.png'),
(18, 'Urban decay', 'http://192.168.1.173/webService/brand_logo/urbandecay.jpg'),
(19, 'Laura Mercier', 'http://192.168.1.173/webService/brand_logo/lauramercier.png'),
(20, 'Hourglass', 'http://192.168.1.173/webService/brand_logo/hourglass.png'),
(21, 'Bobbi Brown', 'http://192.168.1.173/webService/brand_logo/bobbibrown.png'),
(22, 'Chanel', 'http://192.168.1.173/webService/brand_logo/chanel.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product_brand`
--
ALTER TABLE `product_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product_brand`
--
ALTER TABLE `product_brand`
  MODIFY `brand_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
