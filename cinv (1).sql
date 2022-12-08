-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2022 at 02:12 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinv`
--

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(20) NOT NULL,
  `item` varchar(50) NOT NULL,
  `qun` int(10) NOT NULL,
  `price` float NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `item`, `qun`, `price`, `status`) VALUES
(89, 'car', 4, 35, 1),
(94, 'bat', 8, 12, 1),
(95, 'lemon', 0, 22, 1),
(96, 'ram', 0, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_data`
--

CREATE TABLE `purchase_data` (
  `id` int(30) NOT NULL,
  `master_id` int(30) NOT NULL,
  `item_id` int(30) NOT NULL,
  `item_price` float NOT NULL,
  `item_qun` int(30) NOT NULL,
  `item_amt` float NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_data`
--

INSERT INTO `purchase_data` (`id`, `master_id`, `item_id`, `item_price`, `item_qun`, `item_amt`, `status`) VALUES
(53, 12, 84, 44, 3, 132, 1),
(54, 12, 83, 52452, 3, 157356, 1),
(55, 555554, 85, 120, 100, 12000, 1),
(56, 555554, 84, 44, 100, 4400, 1),
(57, 12, 89, 35, 2, 70, 1),
(58, 12, 94, 12, 3, 36, 1),
(59, 22222, 94, 12, 2, 24, 1),
(60, 22222, 94, 12, 1, 12, 1),
(61, 22222, 89, 35, 2, 70, 1),
(62, 2223, 94, 12, 2, 24, 1),
(63, 3, 96, 100, 2, 200, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_master`
--

CREATE TABLE `purchase_master` (
  `id` int(20) NOT NULL,
  `rno` int(30) NOT NULL,
  `date` date NOT NULL,
  `vendor_id` int(20) NOT NULL,
  `final_amount` float NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_master`
--

INSERT INTO `purchase_master` (`id`, `rno`, `date`, `vendor_id`, `final_amount`, `status`) VALUES
(40, 12, '2022-10-28', 24, 157594, 1),
(41, 555554, '2022-09-22', 26, 16400, 1),
(43, 22222, '2022-11-09', 27, 106, 1),
(44, 2223, '2022-10-28', 27, 24, 1),
(45, 3, '2022-10-28', 30, 200, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sale_data`
--

CREATE TABLE `sale_data` (
  `id` int(20) NOT NULL,
  `sale_id` int(20) NOT NULL,
  `item_id` int(20) NOT NULL,
  `item_price` int(20) NOT NULL,
  `item_qun` int(20) NOT NULL,
  `item_amt` float NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale_data`
--

INSERT INTO `sale_data` (`id`, `sale_id`, `item_id`, `item_price`, `item_qun`, `item_amt`, `status`) VALUES
(28, 333, 94, 1200, 2, 2400, 1),
(29, 216525, 94, 1200, 4, 4800, 1),
(30, 3321, 96, 200, 2, 400, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sale_master`
--

CREATE TABLE `sale_master` (
  `id` int(30) NOT NULL,
  `rno` int(30) NOT NULL,
  `date` date NOT NULL,
  `client` varchar(50) NOT NULL,
  `ph` int(20) NOT NULL,
  `add` varchar(50) NOT NULL,
  `amount` float NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale_master`
--

INSERT INTO `sale_master` (`id`, `rno`, `date`, `client`, `ph`, `add`, `amount`, `status`) VALUES
(25, 333, '2022-10-27', 'Adani', 1236547891, 'new york', 2400, 1),
(26, 216525, '2022-10-27', 'Adani', 1236547891, 'mumbai', 4800, 1),
(27, 3321, '2022-10-27', 'Mukesh Ambani', 1236547891, 'mumbai', 400, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(20) NOT NULL,
  `vendor` varchar(50) NOT NULL,
  `contact` int(15) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `vendor`, `contact`, `address`) VALUES
(27, 'kunti', 1234567893, 'ranchi'),
(28, 'shyam', 1234567899, 'mumbai'),
(30, 'rahul', 1234567891, 'delhi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item` (`item`);

--
-- Indexes for table `purchase_data`
--
ALTER TABLE `purchase_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_master`
--
ALTER TABLE `purchase_master`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rno` (`rno`);

--
-- Indexes for table `sale_data`
--
ALTER TABLE `sale_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_master`
--
ALTER TABLE `sale_master`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rno` (`rno`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendor` (`vendor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `purchase_data`
--
ALTER TABLE `purchase_data`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `purchase_master`
--
ALTER TABLE `purchase_master`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `sale_data`
--
ALTER TABLE `sale_data`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sale_master`
--
ALTER TABLE `sale_master`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
