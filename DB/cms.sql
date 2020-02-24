-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 24, 2020 at 07:36 PM
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
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `updationDate` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `updationDate`) VALUES
(1, 'admin', 'f925916e2754e5e03f75dd58a5733251', '18-07-2019 14:18:16');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(255) DEFAULT NULL,
  `categoryDescription` longtext,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryName`, `categoryDescription`, `creationDate`, `updationDate`) VALUES
(1, 'E-commerce', 'E-commerce', '2019-07-28 06:10:55', '2019-08-06 04:49:25'),
(2, 'general', 'dsdas', '2019-06-10 10:54:06', '2019-08-06 04:49:40'),
(3, 'Projector', NULL, '2020-02-24 18:40:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `complaintremark`
--

DROP TABLE IF EXISTS `complaintremark`;
CREATE TABLE IF NOT EXISTS `complaintremark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complaintNumber` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remark` mediumtext NOT NULL,
  `remarkDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaintremark`
--

INSERT INTO `complaintremark` (`id`, `complaintNumber`, `status`, `remark`, `remarkDate`) VALUES
(1, 2, 'in process', 'Hi this for demo', '2019-07-01 07:29:19'),
(2, 9, 'in process', 'hiiiiiiiiiiiiiiiiiiii', '2019-07-01 18:37:59'),
(3, 3, 'in process', 'test', '2019-05-02 15:57:43'),
(4, 19, 'closed', 'case solved', '2019-06-11 11:18:33'),
(5, 1, 'closed', 'This sample text for testing', '2019-09-05 17:08:26'),
(6, 5, 'in process', 'test Data', '2019-06-24 07:26:17'),
(7, 23, 'in process', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2019-06-24 10:34:47'),
(8, 23, 'closed', 'Issue resolved ', '2019-06-24 10:37:08'),
(9, 2, 'closed', 'dfsfsf', '2019-08-06 02:37:57'),
(10, 25, 'closed', 'done', '2020-02-24 16:56:26');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stateName` varchar(255) DEFAULT NULL,
  `stateDescription` tinytext,
  `postingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `stateName`, `stateDescription`, `postingDate`, `updationDate`) VALUES
(3, 'Uttar Pradesh', 'UP', '2019-07-18 11:35:02', '2019-08-06 02:58:51'),
(4, 'Punjab', 'Punjab', '2019-07-18 11:35:58', '2019-08-06 02:59:03'),
(5, 'Haryana', 'Haryana', '2019-03-27 21:20:36', '2019-08-06 02:59:13'),
(6, 'Delhi', 'Delhi', '2019-07-11 06:54:12', '2019-08-06 02:59:29');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

DROP TABLE IF EXISTS `subcategory`;
CREATE TABLE IF NOT EXISTS `subcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryid` int(11) DEFAULT NULL,
  `subcategory` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `categoryid`, `subcategory`, `creationDate`, `updationDate`) VALUES
(1, 1, 'Online Shopping', '2019-03-28 07:11:07', '2019-08-06 04:51:21'),
(2, 1, 'E-wllaet', '2019-03-28 07:11:20', '2019-08-06 04:51:27'),
(3, 2, 'other', '2019-06-24 07:06:44', '2019-06-24 07:21:38');

-- --------------------------------------------------------

--
-- Table structure for table `tblcomplaints`
--

DROP TABLE IF EXISTS `tblcomplaints`;
CREATE TABLE IF NOT EXISTS `tblcomplaints` (
  `complaintNumber` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `subcategory` varchar(255) DEFAULT NULL,
  `complaintType` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `noc` varchar(255) DEFAULT NULL,
  `complaintDetails` mediumtext,
  `complaintFile` varchar(255) DEFAULT NULL,
  `regDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) DEFAULT NULL,
  `lastUpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`complaintNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcomplaints`
--

INSERT INTO `tblcomplaints` (`complaintNumber`, `userId`, `category`, `subcategory`, `complaintType`, `state`, `noc`, `complaintDetails`, `complaintFile`, `regDate`, `status`, `lastUpdationDate`) VALUES
(1, 1, 1, 'E-wllaet', 'General Query', 'Punjab', 'test demo', 'test demo test demo test demotest demotest demotest demotest demotest demotest demotest demotest demo', '', '2017-03-30 16:52:40', 'closed', '2019-06-24 10:29:37'),
(2, 1, 1, 'Online SHopping', 'General Query', 'Punjab', 'testing', 'sample text for demo', '', '2017-03-30 17:05:56', 'closed', '2019-08-06 02:37:57'),
(3, 1, 1, 'Online SHopping', ' Complaint', 'Punjab', 'ferwekt lwentgwewt', 'wetwetwe', '', '2017-03-30 17:07:51', 'in process', '2017-05-02 15:57:43'),
(4, 1, 1, 'E-wllaet', 'General Query', 'Haryana', 'lkdlsfklsdf', 'fdsf,msd,f  f f', '', '2017-03-30 17:13:14', 'closed', '2019-06-24 10:29:37'),
(5, 1, 1, 'E-wllaet', ' Complaint', 'Punjab', 'bgfhfgh', 'hfghfgh', '', '2017-03-30 17:14:55', 'in process', '2019-06-24 10:29:37'),
(6, 1, 1, 'E-wllaet', ' Complaint', 'Punjab', 'bgfhfgh', 'hfghfgh', '', '2017-03-30 17:20:16', NULL, '2019-06-24 10:29:37'),
(7, 1, 1, 'E-wllaet', ' Complaint', 'Punjab', 'bgfhfgh', 'hfghfgh', '', '2017-03-30 17:20:56', NULL, '2019-06-24 10:29:37'),
(8, 1, 1, 'E-wllaet', ' Complaint', 'Punjab', 'bgfhfgh', 'hfghfgh', '', '2017-03-30 17:23:05', NULL, '2019-06-24 10:29:37'),
(9, 1, 1, 'E-wllaet', ' Complaint', 'Punjab', 'bgfhfgh', 'hfghfgh', '', '2017-03-30 17:25:09', 'in process', '2019-06-24 10:29:37'),
(10, 1, 1, 'E-wllaet', ' Complaint', 'Punjab', 'bgfhfgh', 'hfghfgh', '', '2017-03-30 17:27:24', NULL, '2019-06-24 10:29:37'),
(11, 1, 1, 'Online SHopping', 'General Query', 'Haryana', 'dsflsdlflsdf', 'fsdfsdfsdf', '', '2017-03-30 17:36:32', NULL, '2019-06-24 10:29:37'),
(12, 1, 1, 'Online SHopping', 'General Query', 'Haryana', 'dsflsdlflsdf', 'fsdfsdfsdf', '', '2017-03-30 17:37:09', NULL, '2019-06-24 10:29:37'),
(13, 1, 1, 'Online SHopping', 'General Query', 'Haryana', 'dsflsdlflsdf', 'fsdfsdfsdf', '', '2017-03-30 17:39:57', NULL, '2019-06-24 10:29:37'),
(14, 1, 1, 'Online SHopping', ' Complaint', 'Haryana', 'vcxvxcvxcv', 'cvcx', '', '2017-03-30 17:41:19', NULL, '2019-06-24 10:29:37'),
(15, 1, 1, 'E-wllaet', 'General Query', 'Punjab', 'dsfsd', 'fsdfsdf', '', '2017-03-30 17:42:38', NULL, '0000-00-00 00:00:00'),
(16, 1, 1, 'E-wllaet', 'General Query', 'Punjab', 'dsfsd', 'fsdfsdf', '', '2017-03-31 01:54:07', NULL, '0000-00-00 00:00:00'),
(17, 5, 1, 'E-wllaet', ' Complaint', 'fsdfs', 'regarding refund', 'test test', '', '2017-06-11 10:57:49', NULL, '0000-00-00 00:00:00'),
(18, 5, 1, 'Online SHopping', ' Complaint', 'Uttar Pradesh', 'yhytr', 'rtytry', '', '2017-06-11 11:08:47', NULL, '2019-06-24 10:29:37'),
(19, 6, 1, 'Online SHopping', ' Complaint', 'Uttar Pradesh', 'regarding refund', 'Test@123 dfds fsd fs gs gsd g sg g g sgstwerwe ewtw tw', '', '2017-06-11 11:15:24', 'closed', '2019-06-24 10:29:37'),
(20, 1, 1, 'E-wllaet', 'General Query', 'fsdfs', 'sdgsdg', 'gdgsdgsd', '', '2018-05-24 18:26:23', NULL, '0000-00-00 00:00:00'),
(21, 1, 1, 'Online SHopping', 'General Query', 'Uttar Pradesh', 'csdf', 'fsdfs', '', '2018-05-24 18:26:55', NULL, '0000-00-00 00:00:00'),
(22, 1, 1, 'Online SHopping', 'General Query', 'Uttar Pradesh', 'csdf', 'fsdfs', '', '2018-05-24 18:27:02', NULL, '0000-00-00 00:00:00'),
(23, 1, 1, 'E-wllaet', ' Complaint', 'Delhi', 'This is sample text for testing.', 'This is sample text for testing.', '2a09969b-c3d5-467b-82b0-2cf5aeb903eb_200x200.png', '2019-06-24 10:31:19', 'closed', '2019-06-24 10:37:09'),
(24, 2, 1, 'Online Shopping', 'General Query', 'Haryana', 'fdgd', 'fgdfgdgd', '', '2019-08-06 02:48:57', NULL, NULL),
(25, 2, 2, '', 'General Query', '', 'Hiren Rathod', 'lloopop', '', '2020-02-24 16:55:21', 'closed', '2020-02-24 16:56:26'),
(28, 2, 3, NULL, NULL, NULL, 'LOOP', 'ORRRR', NULL, '2020-02-24 19:10:45', NULL, NULL),
(29, 2, 3, NULL, NULL, NULL, 'LOOP', 'ORRRR', NULL, '2020-02-24 19:12:15', NULL, NULL),
(30, 2, 1, NULL, NULL, NULL, 'pppppp', 'lll', NULL, '2020-02-24 19:12:24', NULL, NULL),
(31, 2, 1, NULL, NULL, NULL, 'll', 'opopopoo', NULL, '2020-02-24 19:13:41', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

DROP TABLE IF EXISTS `userlog`;
CREATE TABLE IF NOT EXISTS `userlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `userip` binary(16) NOT NULL,
  `loginTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logout` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(27, 2, 'deepak@gmail.com', 0x3a3a3100000000000000000000000000, '2019-08-06 02:47:52', '', 1),
(28, 2, 'deepak@gmail.com', 0x3a3a3100000000000000000000000000, '2019-08-06 02:54:39', '25-02-2020 12:45:11 AM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullName` varchar(255) DEFAULT NULL,
  `userEmail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `contactNo` bigint(11) DEFAULT NULL,
  `address` tinytext,
  `State` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `pincode` int(6) DEFAULT NULL,
  `userImage` varchar(255) DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullName`, `userEmail`, `password`, `contactNo`, `address`, `State`, `country`, `pincode`, `userImage`, `regDate`, `updationDate`, `status`) VALUES
(1, 'Amandeep Singh', 'aman@gmail.com', 'f925916e2754e5e03f75dd58a5733251', 9874563210, 'Shakarpur', 'Uttar Pradesh', 'India', 110092, '6e8024ec26c292f258ec30f01e0392dc.png', '2017-03-28 11:44:52', '2019-08-06 02:57:08', 1),
(2, 'Deepak', 'deepak@gmail.com', '498b5924adc469aa7b660f457e0fc7e5', 1234567890, 'Faridabad', 'Haryana', 'India', 112266, '2ec5514b65bdb23768402fdc9382e502.jpg', '2019-08-06 02:47:39', '2019-08-06 02:56:59', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
