-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 23, 2020 at 10:15 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id13284941_db_auth`
--
CREATE DATABASE IF NOT EXISTS `id13284941_db_auth` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id13284941_db_auth`;

-- --------------------------------------------------------

--
-- Table structure for table `dbAuth`
--

CREATE TABLE `dbAuth` (
  `id` int(11) NOT NULL,
  `cts` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT current_timestamp(),
  `uname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(250) NOT NULL,
  `fname` text CHARACTER SET utf8 NOT NULL,
  `addr1` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `mob` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dbAuth`
--

INSERT INTO `dbAuth` (`id`, `cts`, `uname`, `password`, `fname`, `addr1`, `email`, `mob`) VALUES
(10, '2020-04-21 19:31:19', 'Dhana1', '$2y$10$FlW..PNTx032S0/1B5YAvOC/m6StdcJkdT9RsSnOGGmLZAFIn6vOq', 'Dhanashri', '15, Spencer dock, Dublin1', 'dhanashribagul1995@gmail.com', '0895236521'),
(11, '2020-04-22 19:33:26', 'Dhanash1', '$2y$10$8zAFH14Etowjpddg6DDuceYJcHwP32u3VdTXGJYnn/EEn1LATDvu.', 'Dhanashri', '12,beresford , dublin2', 'dhanashri.bagul@hotmail.com', '0894034058');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `id` int(10) NOT NULL,
  `cts` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT current_timestamp(),
  `name` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `address` varchar(60) CHARACTER SET utf8 NOT NULL,
  `comment` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`id`, `cts`, `name`, `email`, `mobile`, `address`, `comment`) VALUES
(1, '2020-04-18 13:50:28', 'Trupti Ganesh Prabhu', 'trupti.gv@gmail.com', '9920317745', 'adsdas', 'ghh'),
(2, '2020-04-18 15:01:30', 'dhanashri', 'dhanashribagul1995@gmail.com', '0896325632', '15, Custom house,dublin1', 'pay on delivery'),
(3, '2020-04-18 22:13:19', 'dhanashri', 'dhanashribagul1995@gmail.com', '0896325632', '15, Custom house,dublin1', ''),
(4, '2020-04-19 22:37:01', 'dhanashri', 'dhanashribagul1995@gmail.com', '0896325632', '15, Custom house,dublin1', ''),
(5, '2020-04-21 03:08:01', 'Trupti Ganesh Prabhu', 'trupti.gv@gmail.com', '9920317745', 'adsdas', 'asdasdas'),
(6, '2020-04-21 03:10:57', 'Trupti Ganesh Prabhu', 'trupti.gv@gmail.com', '9920317745', 'adsdas', ''),
(7, '2020-04-21 03:13:20', 'Trupti Ganesh Prabhu', 'trupti.gv@gmail.com', '9920317745', 'adsdas', ''),
(8, '2020-04-21 03:19:40', 'Trupti Ganesh Prabhu', 'trupti.gv@gmail.com', '9920317745', 'adsdas', 'SasAS'),
(9, '2020-04-21 03:20:49', 'Trupti Ganesh Prabhu', 'trupti.gv@gmail.com', '9920317745', 'adsdas', ''),
(10, '2020-04-21 17:48:02', 'Trupti ABCD', 'ds@sdfds.com', '5657667766', 'asd, adasd, asd', 'asdas'),
(11, '2020-04-22 01:53:34', 'Dhanashri', 'dhanashribagul1995@gmail.com', '0895236521', '15, Spencer dock, Dublin1', ''),
(12, '2020-04-22 19:34:35', 'Dhanashri', 'dhanashribagul1995@gmail.com', '0895236521', '15, Spencer dock, Dublin1', ''),
(13, '2020-04-22 19:59:19', 'Dhanashri', 'dhanashribagul1995@gmail.com', '0895236521', '15, Spencer dock, Dublin1', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dbAuth`
--
ALTER TABLE `dbAuth`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `UNIQUE` (`uname`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dbAuth`
--
ALTER TABLE `dbAuth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
