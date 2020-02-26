-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2020 at 11:57 AM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `booking_id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `date_of_booking` datetime NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `place` varchar(55) DEFAULT NULL,
  `fun_details` varchar(300) DEFAULT NULL,
  `charges` float DEFAULT NULL,
  `fun_title` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `mem_id`, `date_of_booking`, `start_time`, `end_time`, `place`, `fun_details`, `charges`, `fun_title`) VALUES
(10, 1, '2020-02-04 00:00:00', '2020-02-11 00:00:00', '2020-02-12 00:00:00', NULL, 'Ring Ceremony', 2000, ''),
(11, 1, '2020-02-12 00:00:00', '2020-02-12 00:00:00', '2020-02-13 00:00:00', NULL, 'Marraige', 2000, ''),
(12, 1, '2020-02-13 00:00:00', '2020-02-13 00:00:00', '2020-02-14 00:00:00', NULL, 'marraige', 2000, ''),
(13, 1, '2020-02-19 00:00:00', '2020-02-19 00:00:00', '2020-02-20 00:00:00', NULL, 'birthday', 2000, ''),
(14, 1, '2020-02-16 00:00:00', '2020-02-16 00:00:00', '2020-02-17 00:00:00', NULL, 'birthday', 2000, ''),
(15, 2, '2020-02-10 00:00:00', '2020-02-09 03:30:00', '2020-02-09 05:30:00', NULL, 'Party', 2000, ''),
(16, 2, '2020-02-18 00:00:00', '2020-02-20 00:00:00', '2020-02-21 00:00:00', NULL, 'Party', 2000, ''),
(17, 2, '2020-02-17 00:00:00', '2020-02-17 00:00:00', '2020-02-18 00:00:00', NULL, 'Party', 2000, ''),
(18, 2, '2020-02-10 01:30:00', '2020-02-10 15:00:00', '2020-02-10 16:30:00', NULL, 'jdbx', 2000, ''),
(19, 2, '2020-01-27 00:00:00', '2020-01-27 00:00:00', '2020-01-28 00:00:00', NULL, 'test', 2000, ''),
(20, 2, '2020-02-14 10:00:00', '2020-02-14 07:30:00', '2020-02-14 11:30:00', NULL, 'jhkjh', 2000, ''),
(21, 2, '2020-02-04 00:00:00', '2020-02-04 02:30:00', '2020-02-05 02:30:00', NULL, 'jkhk', 2000, ''),
(22, 2, '2020-01-28 00:00:00', '2020-01-27 12:30:00', '2020-01-28 12:30:00', NULL, 'hgyyjh', 2000, ''),
(23, 1, '2020-02-26 15:30:06', '2020-03-05 15:03:00', '2020-03-07 15:03:00', 'Large Hall', 'bkj', NULL, 'kjhb'),
(24, 1, '2020-02-26 15:31:47', '2020-04-13 10:00:00', '2020-04-13 22:00:00', 'Garden', 'JOin the final death ceremony of me', NULL, 'Last Death');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD UNIQUE KEY `booking_id` (`booking_id`),
  ADD KEY `foke` (`mem_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
