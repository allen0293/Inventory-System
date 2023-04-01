-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2023 at 01:00 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invt_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `unit_price` float NOT NULL,
  `qnty` int(11) NOT NULL,
  `sold_qnty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invt_id`, `name`, `brand_name`, `unit_price`, `qnty`, `sold_qnty`) VALUES
(13, 'Milo', 'Brand X', 55, 33, 69),
(14, 'Bear Brand', 'Brand X', 20, 24, 55),
(15, 'Kalipso', 'Brand Y', 10, 79, 56),
(16, 'Kalipso', 'Brand X', 12, 48, 2),
(17, 'Kalipso', 'Brand Z', 10, 10, 2),
(18, 'Cup', 'Cupx', 10, 56, 5),
(20, 'Kalipso', 'Brand Z', 30, 50, 0),
(21, 'Cup', 'Brand Y', 20, 30, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pos`
--

CREATE TABLE `pos` (
  `pos_id` int(11) NOT NULL,
  `trans_id` int(11) NOT NULL,
  `invt_id` int(11) NOT NULL,
  `unit_price` float NOT NULL,
  `qnty` int(11) NOT NULL,
  `total` float NOT NULL,
  `date_process` datetime NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pos`
--

INSERT INTO `pos` (`pos_id`, `trans_id`, `invt_id`, `unit_price`, `qnty`, `total`, `date_process`, `status`) VALUES
(51, 10, 13, 50, 1, 50, '2022-10-26 12:49:44', 'completed'),
(52, 11, 13, 50, 4, 200, '2022-10-26 12:51:01', 'completed'),
(53, 11, 14, 20, 9, 180, '2022-10-26 12:51:23', 'completed'),
(54, 12, 13, 50, 5, 250, '2022-10-26 20:39:02', 'completed'),
(55, 12, 14, 20, 10, 200, '2022-10-26 20:39:09', 'completed'),
(56, 13, 13, 50, 2, 100, '2022-10-27 06:52:01', 'completed'),
(57, 13, 14, 20, 5, 100, '2022-10-27 06:52:07', 'completed'),
(58, 14, 13, 50.5, 1, 50.5, '2022-10-27 07:02:19', 'completed'),
(59, 15, 13, 50.5, 1, 50.5, '2022-10-27 07:04:47', 'completed'),
(60, 16, 13, 50.5, 1, 50.5, '2022-10-27 07:05:13', 'completed'),
(61, 17, 13, 50.5, 3, 151.5, '2022-10-27 07:11:42', 'completed'),
(62, 18, 13, 50.5, 5, 252.5, '2022-10-27 07:12:22', 'completed'),
(63, 19, 14, 20, 5, 100, '2022-10-28 13:22:06', 'completed'),
(64, 20, 13, 50.5, 2, 101, '2022-11-01 15:58:30', 'completed'),
(65, 21, 13, 50.5, 2, 101, '2022-11-02 09:03:56', 'completed'),
(66, 22, 14, 20, 2, 40, '2022-11-02 09:05:31', 'completed'),
(68, 22, 15, 10, 1, 10, '2022-11-02 09:10:41', 'completed'),
(69, 23, 15, 10, 4, 40, '2022-11-02 09:11:38', 'completed'),
(71, 24, 16, 12, 2, 24, '2022-11-06 15:12:07', 'completed'),
(72, 25, 14, 20, 3, 60, '2022-11-09 11:52:50', 'completed'),
(73, 26, 13, 55, 5, 275, '2022-11-12 13:40:54', 'completed'),
(74, 26, 14, 20, 3, 60, '2022-11-12 13:41:06', 'completed'),
(75, 27, 17, 10, 2, 20, '2022-11-13 17:35:19', 'completed'),
(76, 28, 15, 10, 1, 10, '2022-11-13 17:55:35', 'completed'),
(77, 29, 13, 55, 2, 110, '2022-11-14 08:58:21', 'completed'),
(78, 30, 13, 55, 5, 275, '2022-12-02 08:25:40', 'completed'),
(79, 31, 15, 10, 50, 500, '2022-12-03 07:49:52', 'completed'),
(80, 32, 13, 55, 2, 110, '2022-12-14 18:37:16', 'completed'),
(81, 32, 14, 20, 3, 60, '2022-12-14 18:37:22', 'completed'),
(82, 32, 18, 10, 5, 50, '2022-12-14 18:37:32', 'completed'),
(83, 33, 13, 55, 5, 275, '2023-01-04 07:59:04', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `trans_id` int(11) NOT NULL,
  `cash` int(11) NOT NULL,
  `total_amount` float NOT NULL,
  `trans_change` float NOT NULL,
  `trans_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`trans_id`, `cash`, `total_amount`, `trans_change`, `trans_date`) VALUES
(10, 50, 50, 0, '2022-10-26'),
(11, 400, 380, 20, '2022-10-26'),
(12, 500, 450, 50, '2022-10-26'),
(13, 200, 200, 0, '2022-10-27'),
(14, 100, 50.5, 49.5, '2022-10-27'),
(15, 60, 50.5, 9.5, '2022-10-27'),
(16, 100, 50.5, 49.5, '2022-10-27'),
(17, 155, 151.5, 3.5, '2022-10-27'),
(18, 255, 252.5, 2.5, '2022-10-27'),
(19, 100, 100, 0, '2022-10-28'),
(20, 105, 101, 4, '2022-11-01'),
(21, 105, 101, 4, '2022-11-02'),
(22, 50, 50, 0, '2022-11-02'),
(23, 50, 40, 10, '2022-11-02'),
(24, 25, 24, 1, '2022-11-06'),
(25, 60, 60, 0, '2022-11-09'),
(26, 340, 335, 5, '2022-11-12'),
(27, 20, 20, 0, '2022-11-13'),
(28, 10, 10, 0, '2022-11-13'),
(29, 110, 110, 0, '2022-11-14'),
(30, 300, 275, 25, '2022-12-02'),
(31, 500, 500, 0, '2022-12-03'),
(32, 250, 220, 30, '2022-12-14'),
(33, 300, 275, 25, '2023-01-04');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `recovery_key` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `recovery_key`) VALUES
(1, 'Admin', '$2y$10$Z8JbviRRkrMKChYkX8hdnu7k5lfSaNKEQcbKE.ItOzXInbwkDzyMS', '$2y$10$nWOH5WAwcQGQRikrsjt6GOxT/04Ckd7zXUyvX6P57bUjQ8vU6R6Q6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invt_id`);

--
-- Indexes for table `pos`
--
ALTER TABLE `pos`
  ADD PRIMARY KEY (`pos_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pos`
--
ALTER TABLE `pos`
  MODIFY `pos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
