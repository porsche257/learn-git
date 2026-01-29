-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2025 at 08:01 PM
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
-- Database: `kakai_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `subject` enum('topup','payment','account','promotion','other') NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `phone`, `subject`, `message`, `created_at`) VALUES
(1, 'tanathorn', 'tanathorn08@gmail.com', '082-458-8951', 'topup', 'ee', '2025-10-07 17:55:49');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_name` varchar(100) DEFAULT NULL,
  `uid` varchar(50) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `package` varchar(100) NOT NULL,
  `payment` varchar(50) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `game_name`, `uid`, `username`, `package`, `payment`, `order_date`, `created_at`) VALUES
(1, 1, NULL, '11', 'c5t4b0', '50 เพชร - 20 บาท', 'truemoney', '2025-10-07 00:02:53', '2025-10-08 00:21:23'),
(2, 1, NULL, '11', 'c5t4b0', '50 เพชร - 20 บาท', 'truemoney', '2025-10-07 00:06:00', '2025-10-08 00:21:23'),
(3, 1, NULL, '11', 'adfd', '100 เพชร - 40 บาท (ลด 10%)', 'truemoney', '2025-10-07 00:06:32', '2025-10-08 00:21:23'),
(4, 1, NULL, '11', 's65123402049', '310 เพชร - 120 บาท (ลด 15%)', 'truemoney', '2025-10-07 00:07:24', '2025-10-08 00:21:23'),
(5, 1, NULL, '11', 'c5t4b0', '50 เพชร - 20 บาท', 'truemoney', '2025-10-07 14:40:47', '2025-10-08 00:21:23'),
(6, 1, 'Free Fire', '11', 'c5t4b0', '50 เพชร - 20 บาท', 'truemoney', '2025-10-07 14:47:26', '2025-10-08 00:21:23'),
(7, 1, 'ROV', '11', 'tanathorn08@gmail.com', '50 เพชร - 20 บาท', 'truemoney', '2025-10-07 14:48:05', '2025-10-08 00:21:23'),
(8, 1, 'ROV', '11', '', '90คูปอง 25บาท', 'promptpay', '2025-10-07 14:59:17', '2025-10-08 00:21:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'adfd', 'tanathorn08@gmail.com', '$2y$10$OqZAtw5rWCVXCLuNp4T01eQa8ib4dRs8CasifNtvrlnz36e2jbQN.'),
(2, '675041900092@mail.rmutk.ac.th', '675041900092@mail.rmutk.ac.th', '$2y$10$DDyMsqY3pHgJ1fQm4gA.HuuBySnzF0Bc3OMKmAfy.7ioO83UhfzTW'),
(3, 'bom', 'bom7@gmail.com', '$2y$10$lJbvAp9Riv4hAB17DlH8T.idD4DsZYbbTR3nd..WhXPKjXuReIx2W'),
(4, 'bom55', 'bom55@gmail.com', '$2y$10$FRxmOBD8KlDWMWLSHC40c.61xvOx0PHi9O2s8shEwQDWJXA7USfbS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
