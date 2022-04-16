-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 16, 2022 at 02:35 PM
-- Server version: 10.5.12-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id18780969_traversa`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `c_id` int(25) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_email` varchar(255) NOT NULL,
  `c_phone` varchar(255) NOT NULL,
  `c_service` varchar(255) NOT NULL,
  `c_amt` varchar(255) NOT NULL,
  `c_discount` varchar(255) NOT NULL,
  `c_total` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`c_id`, `c_name`, `c_email`, `c_phone`, `c_service`, `c_amt`, `c_discount`, `c_total`, `date`) VALUES
(1, 'Rajesh', 'rajesh@gmail.com', '7044159363', 'Web Designing Services', '15000', '10', '13500', '2022-04-14 00:00:00'),
(2, 'James', 'james@gmail.com', '7044159364', 'Web Designing Services', '15000', '10', '13500', '2022-04-14 00:00:00'),
(3, 'Rakesh Uddin', 'rakesh@gmail.com', '7044159364', 'Cyber Security Services', '16000', '5', '15200', '2022-04-14 00:00:00'),
(9, 'John Doe', 'asd@zxc.com', '786345', 'Web Designing Services', '15000', '10', '13500', '2022-04-14 15:28:04'),
(10, 'Sam T', 'sam@gmail.com', '9833220011', 'Cyber Security Services', '16000', '5', '15200', '2022-04-15 01:01:54'),
(11, 'Rajesh ', 'rajesh.cristiano@gmail.com', '70441', 'Digital Marketing Services', '15500', '20', '12400', '2022-04-15 03:06:15'),
(12, 'Rakesh', 'rajesh.cristiano@gmail.com', '7044159363', 'Web Designing Services', '15000', '13', '13050', '2022-04-15 03:54:25'),
(13, 'Rajesh', 'kokings1317@gmail.com', '7044159364', 'Software Development Services', '25000', '18', '20500', '2022-04-14 23:34:21'),
(14, 'Rajesh', 'kokings1317@gmail.com', '7044159364', 'Software Development Services', '25000', '18', '20500', '2022-04-14 23:34:35'),
(15, 'James', 'kokings1317@gmail.com', '786345', 'Cyber Security Services', '16000', '7', '14880', '2022-04-14 23:47:50'),
(16, 'Niladri Shankar Paul', 'niladripaul12@gmail.com', '+919804974487', 'Digital Marketing Services', '15500', '20', '12400', '2022-04-15 07:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `s_id` int(25) NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `s_amt` varchar(255) NOT NULL,
  `s_discount` varchar(255) NOT NULL,
  `c_id` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`s_id`, `s_name`, `s_amt`, `s_discount`, `c_id`) VALUES
(1, 'Web Designing Services', '15000', '13', 0),
(2, 'Digital Marketing Services', '15500', '20', 0),
(3, 'Cyber Security Services', '16000', '7', 0),
(5, 'Software Development Services', '25000', '18', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `c_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `s_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
