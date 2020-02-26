-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 26, 2020 at 10:58 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `mem_id` int(11) NOT NULL,
  `date_of_booking` datetime NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `place` varchar(55) DEFAULT NULL,
  `fun_details` varchar(300) DEFAULT NULL,
  `charges` float DEFAULT NULL,
  `fun_title` varchar(200) NOT NULL,
  PRIMARY KEY (`booking_id`),
  UNIQUE KEY `booking_id` (`booking_id`),
  KEY `foke` (`mem_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

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
(23, 1, '2020-02-26 16:21:08', '2020-02-26 16:21:00', '2020-02-26 16:55:00', 'Large Hall', 'nbjbjj ', NULL, 'jxxhbh'),
(24, 1, '2020-02-26 16:25:10', '2020-02-26 16:25:00', '2020-02-26 17:25:00', 'Club House', 'evnbe iss', NULL, 'birthh'),
(25, 1, '2020-02-26 16:25:32', '2020-02-26 16:25:00', '2020-02-26 17:25:00', 'Club House', 'evnbe iss', NULL, 'birthh');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
