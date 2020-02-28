-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 28, 2020 at 12:08 AM
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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `userEmail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `contactNo` bigint(11) DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(15) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullName`, `userEmail`, `password`, `contactNo`, `regDate`, `type`, `gender`, `dob`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', 9874563210, '2017-03-28 11:44:52', 'admin', NULL, NULL),
(2, 'Deepak', 'deepak@gmail.com', 'test', 1234567890, '2019-08-06 02:47:39', 'user', NULL, NULL),
(10, 'Parth Bhadreshkumar Patel', 'parthpatelvvn@gmail.com', 'test', 7567452930, '2020-02-25 20:49:32', 'admin', 'Male', NULL),
(11, 'Hiren Rathod', 'h.rathod5005@gmail.com', 'admin', 7043815495, '2020-02-27 05:18:30', 'user', 'Male', NULL),
(12, 'Hiren Rathod', 'h.rathod5005@gmail.com', '213213', 7043815495, '2020-02-28 00:08:15', 'user', 'Male', '2024-01-01'),
(13, 'papu', 'papu@gmail.com', '1212', 1212, '2020-02-28 00:00:48', 'user', 'Male', '2020-12-31');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
