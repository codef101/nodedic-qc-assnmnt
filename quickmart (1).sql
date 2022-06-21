-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2022 at 03:06 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quickmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `knowledge`
--

CREATE TABLE `knowledge` (
  `id` int(11) NOT NULL,
  `phrase` text DEFAULT NULL,
  `response` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `knowledge`
--

INSERT INTO `knowledge` (`id`, `phrase`, `response`) VALUES
(1, 'good morning', 'Good morning to you. How may I help you?'),
(2, 'hello', 'Hello to you too. How may I help you?'),
(3, 'good afternoon', 'Good afternoon to you. How may I help you?'),
(4, 'good evening', 'Good evening to you. How may I help you?'),
(5, 'thank you', 'Welcome again.'),
(6, 'yes', 'Thank you'),
(7, 'hi', 'hi too. How may I help you Today ?'),
(8, 'hey', 'hey too. How may I help you Today ?'),
(9, 'available varieties of', '#v'),
(10, 'varieties of', '#v'),
(11, 'varieties', '#v'),
(12, 'available quantities of', '#q'),
(13, 'quantities of', '#q'),
(14, 'quantities', '#q'),
(15, 'quantities available', '#q'),
(16, 'varieties available', '#v'),
(17, 'prices of ', '#q'),
(20, 'prices', '#q');

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `id` int(50) NOT NULL,
  `varietyId` int(50) NOT NULL,
  `cost` bigint(20) NOT NULL,
  `qnty` varchar(100) NOT NULL,
  `descr` text NOT NULL,
  `isavailable` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`id`, `varietyId`, `cost`, `qnty`, `descr`, `isavailable`) VALUES
(2, 3, 10, '1 pen', 'smooth and fine', 1),
(3, 4, 65, '200 PAGES', 'LINED ', 1),
(7, 5, 120, '250g', 'powder washing saop', 1),
(8, 6, 1000, '1kg', 'powder washing soap', 1),
(9, 2, 100, '2kg', 'nil', 1),
(10, 1, 150, '3kg', 'nil', 1),
(11, 1, 100, '2kg', 'none', 1),
(12, 1, 150, '3kg', 'null', 1),
(13, 2, 50, '1kg', 'nil', 1),
(14, 2, 150, '3kg', 'nil', 1),
(15, 2, 200, '4kg', 'nil', 0),
(16, 8, 70, '1kg', 'Grade 1', 1),
(17, 8, 160, '2kg', 'grade 1', 1),
(18, 8, 300, '3kg', 'grade 1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`) VALUES
(3, 'UNGA'),
(7, 'Pen'),
(8, 'BOOKS'),
(9, 'soap'),
(20, 'sugar');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Role` int(1) NOT NULL DEFAULT 2,
  `Email` varchar(50) NOT NULL,
  `Phoneno` int(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `Name`, `Username`, `Role`, `Email`, `Phoneno`, `Password`) VALUES
(1, 'Bill Kelvin', '29540306007/2020', 2, 'kiggspremium@gmail.com', 710458538, '123456'),
(2, 'Bill Kelvin', '29540306007/2020', 2, 'kiggspremium@gmail.com', 710458538, '123456'),
(3, 'Bill Kelvin', 'BillKelvin', 1, 'KIPRUTOKELVIN20@GMAIL.COM', 710458538, '123456'),
(23, 'rael', 'rael', 2, 'rael@gmail.com', 1234567890, '1234'),
(24, 'samuel munyeke', 'munyekesam', 2, 'munyeke@gmail.com', 123444, '12345678'),
(25, 'sam', 'sam', 2, 'sam@gmail.com', 1234567890, '12345678'),
(26, 'samu', 'samu', 2, 'samu@gmail.com', 1234567890, '1234567'),
(27, 'kipruto kelvin', 'billkelvin', 2, 'user@gmail.com', 1234567890, '1234'),
(28, 'NAME', 'N', 1, 'admin@gmail.com', 0, '1234'),
(30, 'Cheruiyot', 'Arap', 2, 'arapcheruiyot@gmail.com', 725481520, '66746674');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `variety_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` enum('pending','delivered','completed','paid') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `variety_id`, `user_id`, `quantity`, `status`, `created_at`) VALUES
(15, 1, 23, 0, 'pending', '2022-06-21 12:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `variety`
--

CREATE TABLE `variety` (
  `id` int(50) NOT NULL,
  `productId` int(50) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `variety`
--

INSERT INTO `variety` (`id`, `productId`, `name`) VALUES
(1, 3, 'sembe'),
(2, 3, 'soko'),
(3, 7, 'obama smoothline'),
(4, 8, 'KASUKU'),
(5, 9, 'omo'),
(6, 9, 'sunlight'),
(8, 20, 'chemelil');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `knowledge`
--
ALTER TABLE `knowledge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variety`
--
ALTER TABLE `variety`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `knowledge`
--
ALTER TABLE `knowledge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `variety`
--
ALTER TABLE `variety`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
