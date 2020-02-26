-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 26, 2020 at 07:37 AM
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
-- Table structure for table `tblcomplaints`
--

DROP TABLE IF EXISTS `tblcomplaints`;
CREATE TABLE IF NOT EXISTS `tblcomplaints` (
  `complaintNumber` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `complaintTitle` varchar(50) NOT NULL,
  `complaintDetails` varchar(250) DEFAULT NULL,
  `regDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) DEFAULT NULL,
  `lastUpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`complaintNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcomplaints`
--

INSERT INTO `tblcomplaints` (`complaintNumber`, `userId`, `category`, `complaintTitle`, `complaintDetails`, `regDate`, `status`, `lastUpdationDate`) VALUES
(1, 1, 1, '', 'test demo test demo test demotest demotest demotest demotest demotest demotest demotest demotest demo', '2017-03-30 16:52:40', 'closed', '2019-06-24 10:29:37'),
(2, 1, 1, '', 'sample text for demo', '2017-03-30 17:05:56', 'closed', '2019-08-06 02:37:57'),
(3, 1, 1, '', 'wetwetwe', '2017-03-30 17:07:51', 'in process', '2017-05-02 15:57:43'),
(4, 1, 1, '', 'fdsf,msd,f  f f', '2017-03-30 17:13:14', 'closed', '2019-06-24 10:29:37'),
(5, 1, 1, '', 'hfghfgh', '2017-03-30 17:14:55', 'in process', '2019-06-24 10:29:37'),
(6, 1, 1, '', 'hfghfgh', '2017-03-30 17:20:16', NULL, '2019-06-24 10:29:37'),
(7, 1, 1, '', 'hfghfgh', '2017-03-30 17:20:56', NULL, '2019-06-24 10:29:37'),
(8, 1, 1, '', 'hfghfgh', '2017-03-30 17:23:05', NULL, '2019-06-24 10:29:37'),
(9, 1, 1, '', 'hfghfgh', '2017-03-30 17:25:09', 'in process', '2019-06-24 10:29:37'),
(10, 1, 1, '', 'hfghfgh', '2017-03-30 17:27:24', NULL, '2019-06-24 10:29:37'),
(11, 1, 1, '', 'fsdfsdfsdf', '2017-03-30 17:36:32', NULL, '2019-06-24 10:29:37'),
(12, 1, 1, '', 'fsdfsdfsdf', '2017-03-30 17:37:09', NULL, '2019-06-24 10:29:37'),
(13, 1, 1, '', 'fsdfsdfsdf', '2017-03-30 17:39:57', NULL, '2019-06-24 10:29:37'),
(14, 1, 1, '', 'cvcx', '2017-03-30 17:41:19', NULL, '2019-06-24 10:29:37'),
(18, 5, 1, '', 'rtytry', '2017-06-11 11:08:47', NULL, '2019-06-24 10:29:37'),
(19, 6, 1, '', 'Test@123 dfds fsd fs gs gsd g sg g g sgstwerwe ewtw tw', '2017-06-11 11:15:24', 'closed', '2019-06-24 10:29:37'),
(23, 1, 1, '', 'This is sample text for testing.', '2019-06-24 10:31:19', 'closed', '2019-06-24 10:37:09'),
(24, 2, 1, '', 'fgdfgdgd', '2019-08-06 02:48:57', NULL, NULL),
(25, 2, 2, '', 'lloopop', '2020-02-24 16:55:21', 'closed', '2020-02-24 16:56:26'),
(28, 2, 3, '', 'ORRRR', '2020-02-24 19:10:45', NULL, NULL),
(29, 2, 3, '', 'ORRRR', '2020-02-24 19:12:15', NULL, NULL),
(30, 2, 1, '', 'lll', '2020-02-24 19:12:24', NULL, NULL),
(31, 2, 1, '', 'opopopoo', '2020-02-24 19:13:41', NULL, NULL),
(32, 2, 3, 'fe', 'regr', '2020-02-26 07:28:18', NULL, NULL),
(33, 2, 1, 'egreh', 'trhrth', '2020-02-26 07:29:08', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
