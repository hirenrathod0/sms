-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2020 at 04:05 AM
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
-- Table structure for table `meeting_attendance`
--

CREATE TABLE `meeting_attendance` (
  `mid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pa` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meeting_attendance`
--

INSERT INTO `meeting_attendance` (`mid`, `uid`, `pa`) VALUES
(1, 1, ''),
(1, 1, ''),
(1, 1, ''),
(1, 1, ''),
(1, 1, ''),
(1, 1, ''),
(1, 1, ''),
(1, 1, ''),
(1, 1, ''),
(1, 1, ''),
(1, 1, ''),
(1, 1, ''),
(1, 1, ''),
(1, 1, ''),
(1, 1, ''),
(1, 1, ''),
(1, 1, ''),
(1, 1, ''),
(1, 1, ''),
(1, 1, ''),
(1, 1, ''),
(2, 1, ''),
(2, 1, ''),
(2, 1, ''),
(2, 1, ''),
(2, 1, ''),
(2, 1, ''),
(2, 1, ''),
(2, 1, ''),
(2, 1, ''),
(2, 1, ''),
(2, 1, ''),
(2, 1, ''),
(2, 1, ''),
(2, 1, ''),
(2, 1, ''),
(2, 1, ''),
(2, 1, ''),
(2, 1, ''),
(2, 1, ''),
(2, 1, ''),
(2, 1, '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
