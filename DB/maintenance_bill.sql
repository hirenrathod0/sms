-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2020 at 12:11 PM
-- Server version: 10.1.39-MariaDB
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
-- Table structure for table `maintenance_bill`
--

CREATE TABLE `maintenance_bill` (
  `bid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `bill_date` date NOT NULL,
  `water_charges` decimal(8,2) NOT NULL,
  `property_tax` decimal(8,2) NOT NULL,
  `flat_charges` decimal(10,0) NOT NULL,
  `elec_charges` decimal(8,2) NOT NULL,
  `parking_charges` decimal(8,2) NOT NULL,
  `other` decimal(8,2) NOT NULL,
  `due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `maintenance_bill`
--

INSERT INTO `maintenance_bill` (`bid`, `fid`, `bill_date`, `water_charges`, `property_tax`, `flat_charges`, `elec_charges`, `parking_charges`, `other`, `due_date`) VALUES
(18, 1, '0000-00-00', '12.00', '12.00', '7', '16.00', '96.00', '33.00', '2020-02-13'),
(23, 1, '2000-08-09', '0.00', '0.00', '0', '0.00', '0.00', '0.00', '2000-07-05'),
(36, 1, '2020-02-08', '12.00', '12.00', '98', '16.00', '25.00', '33.00', '2020-02-28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `maintenance_bill`
--
ALTER TABLE `maintenance_bill`
  ADD PRIMARY KEY (`bid`),
  ADD UNIQUE KEY `bill_date` (`bill_date`),
  ADD KEY `flat_bill` (`fid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `maintenance_bill`
--
ALTER TABLE `maintenance_bill`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
