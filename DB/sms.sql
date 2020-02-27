-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 27, 2020 at 08:01 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `mem_id`, `date_of_booking`, `start_time`, `end_time`, `place`, `fun_details`, `charges`, `fun_title`) VALUES
(10, 1, '2020-02-04 00:00:00', '2020-02-11 00:00:00', '2020-02-12 00:00:00', NULL, 'Ring Ceremony', 2000, ''),
(12, 1, '2020-02-13 00:00:00', '2020-02-13 00:00:00', '2020-02-14 00:00:00', NULL, 'marraige', 2000, ''),
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
(25, 1, '2020-02-26 16:25:32', '2020-02-26 16:25:00', '2020-02-26 17:25:00', 'Club House', 'evnbe iss', NULL, 'birthh'),
(26, 1, '2020-02-26 16:31:02', '2020-02-26 16:30:00', '2020-02-26 16:50:00', 'Garden', 'nbbb', NULL, 'll'),
(27, 1, '2020-02-27 12:43:42', '2020-02-27 00:43:00', '2020-02-27 12:43:00', 'Small Hall', 'test', NULL, 'test');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryName`, `categoryDescription`, `creationDate`, `updationDate`) VALUES
(1, 'E-commerce', 'E-commerce', '2019-07-28 06:10:55', '2019-08-06 04:49:25'),
(2, 'general', 'dsdas', '2019-06-10 10:54:06', '2019-08-06 04:49:40'),
(3, 'Projector', NULL, '2020-02-24 18:40:13', NULL),
(4, 'parth', NULL, '2020-02-25 12:46:40', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

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
(10, 25, 'closed', 'done', '2020-02-24 16:56:26'),
(11, 3, 'in process', 'dfdfsf', '2020-02-26 18:48:04'),
(12, 3, 'closed', 'dssd', '2020-02-26 18:48:13'),
(13, 7, 'in process', 'fewfwf', '2020-02-26 19:08:49'),
(14, 6, 'in process', 'hghhgjhg', '2020-02-27 07:50:46'),
(15, 6, 'in process', 'hghjgj', '2020-02-27 07:50:56'),
(16, 6, 'closed', 'closed', '2020-02-27 07:51:05');

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
  PRIMARY KEY (`fid`),
  KEY `wing_flat` (`block`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `flat`
--

INSERT INTO `flat` (`fid`, `block`, `flat_num`, `area`, `BHK`, `floor_no`, `price`, `uid`) VALUES
(21, 'B', 101, '500', '3', 2, 5000, 10),
(22, 'F', 105, '700', '4', 1, 7000, 11);

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
  PRIMARY KEY (`bid`),
  UNIQUE KEY `bill_date` (`bill_date`),
  KEY `flat_bill` (`fid`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `maintenance_bill`
--

INSERT INTO `maintenance_bill` (`bid`, `fid`, `bill_date`, `water_charges`, `property_tax`, `flat_charges`, `elec_charges`, `parking_charges`, `other`, `due_date`) VALUES
(18, 1, '0000-00-00', '12.00', '12.00', '7', '16.00', '96.00', '33.00', '2020-02-13'),
(36, 1, '2020-02-08', '12.00', '12.00', '98', '16.00', '25.00', '33.00', '2020-02-28'),
(37, 11, '2020-02-13', '500.00', '500.00', '1300', '1200.00', '100.00', '0.00', '2020-02-28'),
(38, 10, '2020-02-11', '500.00', '500.00', '1300', '1200.00', '100.00', '0.00', '2020-02-29');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

DROP TABLE IF EXISTS `notice`;
CREATE TABLE IF NOT EXISTS `notice` (
  `nid` int(10) NOT NULL AUTO_INCREMENT,
  `title` text,
  `descr` text,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`nid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`nid`, `title`, `descr`, `date`) VALUES
(2, 'this is cdemo', 'notive is', '2020-02-25 12:55:36'),
(3, 'Test', '<p><b>kvjhf</b></p><p><span style=\"background-color: rgb(255, 255, 0);\">hyhiyi</span></p>', '2020-02-26 17:09:53'),
(4, 'Event Reminder', '<p><br></p><blockquote class=\"blockquote\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</blockquote><h2>tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</h2><p>quis nostrud exercitation ullamco laboris nisi <u>ut </u>aliquip ex ea commodo</p><p><span style=\"font-family: Impact;\">consequat</span>. Duis aute irure dolor in reprehenderit in voluptate velit esse</p><p>cillum dolore eu fugiat nulla <b>pariatur</b>. Excepteur <span style=\"font-family: Helvetica;\">sint occaecat cupidatat</span> non</p><p>proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p> </p>', '2020-02-27 07:41:37');

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
(3, 1, 1, '', 'wetwetwe', '2017-03-30 17:07:51', 'closed', '2020-02-26 18:48:14'),
(4, 1, 1, '', 'fdsf,msd,f  f f', '2017-03-30 17:13:14', 'closed', '2019-06-24 10:29:37'),
(5, 1, 1, '', 'hfghfgh', '2017-03-30 17:14:55', 'in process', '2019-06-24 10:29:37'),
(6, 1, 1, '', 'hfghfgh', '2017-03-30 17:20:16', 'closed', '2020-02-27 07:51:05'),
(7, 1, 1, '', 'hfghfgh', '2017-03-30 17:20:56', 'in process', '2020-02-26 19:08:49'),
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
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(15) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullName`, `userEmail`, `password`, `contactNo`, `regDate`, `type`, `gender`, `dob`) VALUES
(1, 'Deepak', 'deepak@gmail.com', 'test', 1234567890, '2019-08-06 02:47:39', 'user', NULL, NULL),
(10, 'Parth Bhadreshkumar Patel', 'parthpatelvvn@gmail.com', 'test', 7567452930, '2020-02-25 20:49:32', 'admin', 'Male', NULL),
(11, 'XYZ', 'xyz@gmail.com', 'test', 54545456456, '2020-02-26 17:00:52', 'user', 'Male', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

DROP TABLE IF EXISTS `visitor`;
CREATE TABLE IF NOT EXISTS `visitor` (
  `vid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `cno` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `ref` int(11) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`vid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitor`
--

INSERT INTO `visitor` (`vid`, `name`, `cno`, `email`, `ref`, `time`) VALUES
(1, 'Parth Bhadreshkumar Patel', 'huyi', 'parthpatelvvn@gmail.com', NULL, '2020-02-27 07:28:03');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
