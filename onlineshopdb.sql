-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 17, 2019 at 02:35 PM
-- Server version: 5.7.24-log
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineshopdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productid` tinyint(2) NOT NULL,
  `productname` varchar(30) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` double(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productid`, `productname`, `product_image`, `product_price`) VALUES
(108, 'qn', 'uploads/canh-dep-tuyet-mi-o-sa-pa.jpg', 1111111111),
(111, 'qweqwe', 'uploads/aaaa.jpg', 2345252);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` mediumint(6) UNSIGNED NOT NULL,
  `firs_tname` varchar(30) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `passwords` char(60) NOT NULL,
  `registration_date` datetime NOT NULL,
  `user_level` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `firs_tname`, `last_name`, `email`, `passwords`, `registration_date`, `user_level`) VALUES
(24, 'nguyen', 'quang', 'quangdn9@admin.com', '$2y$10$nAgR5gBy95czOlZ4izOct.AdHCLuKfhGmyVn8qCNJHm4UTRZrM4BS', '2019-09-16 00:00:00', 2),
(25, 'nam', 'ngo duc', 'nam@gmail.com', '$2y$10$MQ/rezUnJU5C3WuO/LTCl.wC1z5od.XguEh9934AtSOxGsfv4tIwu', '2019-10-17 12:45:31', 1),
(26, 'tuan', 'ngo duc', 'nam1@gmail.com', '$2y$10$dTJBhiX/j64nMBH8cJLcn.oq8.tPje1XOTsAxkrqKMbbaf7NOuwU.', '2019-10-17 12:47:19', 1),
(27, 'Quangnq', 'Quảng', 'quangdn98@gmail.com', '$2y$10$YA7lEK.khT6b3AerrdOfd.qpNT6ETg6VcaHL2D443djaY3vDprQ7e', '2019-10-17 12:50:07', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productid` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` mediumint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
