-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 28, 2020 at 08:52 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

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
-- Table structure for table `flat`
--

DROP TABLE IF EXISTS `flat`;
CREATE TABLE IF NOT EXISTS `flat` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `block` varchar(50) DEFAULT NULL,
  `flat_num` int(11) NOT NULL,
  `area` varchar(50) DEFAULT NULL,
  `BHK` varchar(10) DEFAULT NULL,
  `floor_no` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `owner` varchar(50) DEFAULT NULL,
  `ownercno` varchar(15) DEFAULT NULL,
  `owneremail` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`fid`),
  KEY `wing_flat` (`block`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `flat`
--

INSERT INTO `flat` (`fid`, `block`, `flat_num`, `area`, `BHK`, `floor_no`, `price`, `uid`, `owner`, `ownercno`, `owneremail`) VALUES
(21, 'B', 101, '500', '3', 2, 5000, 10, NULL, NULL, NULL),
(22, 'F', 105, '800', '4', 1, 7000, 11, NULL, NULL, NULL),
(23, 'T', 777, '777', '7', 2, 200, 15, NULL, NULL, NULL),
(24, 'M', 222, '1500', '1', 2, 5000, NULL, NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
