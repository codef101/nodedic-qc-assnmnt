-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2022 at 12:06 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

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
(1, 'good morning', 'Good morning to you'),
(2, 'hello', 'Hello to you'),
(3, 'good afternoon', 'Good afternoon to you'),
(4, 'good evening', 'Good evening to you'),
(5, 'what is the cost of', 'The cost of');

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `id` int(50) NOT NULL,
  `varietyId` int(50) NOT NULL,
  `cost` bigint(20) NOT NULL,
  `qnty` varchar(100) NOT NULL,
  `descr` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`id`, `varietyId`, `cost`, `qnty`, `descr`) VALUES
(1, 1, 55, '1kg', 'maize cooking flour grade 1'),
(2, 3, 10, '1 pen', 'smooth and fine'),
(3, 4, 65, '200 PAGES', 'LINED '),
(4, 4, 65, '200 PAGES', 'LINED '),
(5, 4, 65, '200 PAGES', 'LINED '),
(6, 1, 3, '40', 'NIL'),
(7, 5, 120, '250g', 'powder washing saop'),
(8, 6, 1000, '1ky=g', 'powder washing soap');

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
(5, 'luca'),
(7, 'Pen'),
(8, 'BOOKS'),
(9, 'soap'),
(10, 'salt'),
(11, 'phone'),
(12, 'chair'),
(13, 'miti'),
(14, 'doho'),
(15, 'opop'),
(16, 'runi'),
(17, 'uini'),
(18, 'ertyui'),
(19, '0987654');

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
  `Password` varchar(50) NOT NULL,
  `Confirmpassword` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `Name`, `Username`, `Role`, `Email`, `Phoneno`, `Password`, `Confirmpassword`) VALUES
(1, 'Bill Kelvin', '29540306007/2020', 2, 'kiggspremium@gmail.com', 710458538, '123456', '123456'),
(2, 'Bill Kelvin', '29540306007/2020', 2, 'kiggspremium@gmail.com', 710458538, '123456', '123456'),
(3, 'Bill Kelvin', 'BillKelvin', 1, 'KIPRUTOKELVIN20@GMAIL.COM', 710458538, '123456', '123456'),
(23, 'rael', 'rael', 2, 'rael@gmail.com', 1234567890, '1234', '1234'),
(24, 'samuel munyeke', 'munyekesam', 2, 'munyeke@gmail.com', 123444, '12345678', '123456789'),
(25, 'sam', 'sam', 2, 'sam@gmail.com', 1234567890, '12345678', '12345678'),
(26, 'samu', 'samu', 2, 'samu@gmail.com', 1234567890, '1234567', '1234567'),
(27, 'kipruto kelvin', 'billkelvin', 2, 'user@gmail.com', 1234567890, '123456789', '123456789'),
(28, 'NAME', 'N', 2, 'J@1', 0, '123456', '123456'),
(29, 'trial', 'trial', 2, 'trial@gmail.com', 1234567890, '123456', '123456');

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
(7, 9, 'aerial');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `variety`
--
ALTER TABLE `variety`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
