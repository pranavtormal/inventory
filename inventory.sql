-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2018 at 12:32 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `manufacture_details`
--

CREATE TABLE `manufacture_details` (
  `id` int(11) NOT NULL,
  `insert_time` datetime NOT NULL,
  `man_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manufacture_details`
--

INSERT INTO `manufacture_details` (`id`, `insert_time`, `man_name`) VALUES
(4, '2018-11-23 16:58:18', 'tata'),
(5, '2018-11-23 17:00:38', 'honda');

-- --------------------------------------------------------

--
-- Table structure for table `model_details`
--

CREATE TABLE `model_details` (
  `id` int(11) NOT NULL,
  `insert_time` datetime NOT NULL,
  `man_id` int(11) NOT NULL,
  `man_name` varchar(50) DEFAULT NULL,
  `model_name` varchar(50) NOT NULL,
  `regno` int(11) NOT NULL,
  `manyear` varchar(8) NOT NULL,
  `color` varchar(30) NOT NULL,
  `imgname` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model_details`
--

INSERT INTO `model_details` (`id`, `insert_time`, `man_id`, `man_name`, `model_name`, `regno`, `manyear`, `color`, `imgname`) VALUES
(24, '2018-11-23 16:58:54', 4, 'tata', 'nano', 123, '2014', 'red', ''),
(25, '2018-11-23 17:01:04', 5, 'honda', 'test', 452, '2017', 'pink', ''),
(26, '2018-11-23 17:01:41', 5, 'honda', 'test3', 98985645, '2017', 'green', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `manufacture_details`
--
ALTER TABLE `manufacture_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_details`
--
ALTER TABLE `model_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `manufacture_details`
--
ALTER TABLE `manufacture_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `model_details`
--
ALTER TABLE `model_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
