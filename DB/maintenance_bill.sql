-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 28, 2020 at 12:23 AM
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
-- Table structure for table `maintenance_bill`
--

DROP TABLE IF EXISTS `maintenance_bill`;
CREATE TABLE IF NOT EXISTS `maintenance_bill` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL,
  `bill_date` date NOT NULL,
  `water_charges` decimal(8,2) NOT NULL,
  `property_tax` decimal(8,2) NOT NULL,
  `flat_charges` decimal(10,0) NOT NULL,
  `elec_charges` decimal(8,2) NOT NULL,
  `parking_charges` decimal(8,2) NOT NULL,
  `other` decimal(8,2) NOT NULL,
  `due_date` date NOT NULL,
  `ispaid` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bid`),
  UNIQUE KEY `bill_date` (`bill_date`),
  KEY `flat_bill` (`fid`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `maintenance_bill`
--

INSERT INTO `maintenance_bill` (`bid`, `fid`, `bill_date`, `water_charges`, `property_tax`, `flat_charges`, `elec_charges`, `parking_charges`, `other`, `due_date`, `ispaid`) VALUES
(18, 1, '0000-00-00', '12.00', '12.00', '7', '16.00', '96.00', '33.00', '2020-02-13', 0),
(23, 1, '2000-08-09', '0.00', '0.00', '0', '0.00', '0.00', '0.00', '2000-07-05', 0),
(36, 1, '2020-02-08', '12.00', '12.00', '98', '16.00', '25.00', '33.00', '2020-02-28', 0),
(41, 1, '2020-02-27', '100.00', '900.00', '1200', '2000.00', '400.00', '700.00', '2020-02-29', 0),
(44, 1, '2020-02-13', '1.00', '1.00', '1', '1.00', '1.00', '1.00', '2020-02-21', 0),
(47, 11, '2020-02-15', '5.00', '5.00', '5', '5.00', '5.00', '5.00', '2020-02-22', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
