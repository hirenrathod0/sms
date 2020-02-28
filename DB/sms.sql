-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 28, 2020 at 05:31 AM
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
(25, 1, '2020-02-26 16:25:32', '2020-02-26 16:25:00', '2020-02-26 17:25:00', 'Club House', 'evnbe iss', NULL, 'birthh'),
(26, 1, '2020-02-26 16:31:02', '2020-02-26 16:30:00', '2020-02-26 16:50:00', 'Garden', 'nbbb', NULL, 'll'),
(27, 11, '2020-02-28 07:51:39', '2020-02-28 20:51:00', '2020-02-28 09:53:00', 'Small Hall', 'Partyh', NULL, 'party');

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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `flat`
--

INSERT INTO `flat` (`fid`, `block`, `flat_num`, `area`, `BHK`, `floor_no`, `price`, `uid`) VALUES
(21, 'B', 101, '500', '3', 2, 5000, 1),
(22, 'f', 100, '1000', '3', 2, 1000, 11),
(23, 'c', 112, '1900', '2', 2, 10900, 12),
(26, 'A', 112, '1660', '4', 1, 14566, 24),
(27, 'e', 80, '1300', '2', 3, 1200, 25);

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
(23, 1, '2000-08-09', '0.00', '0.00', '0', '0.00', '0.00', '0.00', '2000-07-05', 1),
(36, 1, '2020-02-08', '12.00', '12.00', '98', '16.00', '25.00', '33.00', '2020-02-28', 1),
(41, 1, '2020-02-27', '100.00', '900.00', '1200', '2000.00', '400.00', '700.00', '2020-02-29', 1),
(44, 1, '2020-02-13', '1.00', '1.00', '1', '1.00', '1.00', '1.00', '2020-02-21', 0),
(47, 11, '2020-02-15', '5.00', '5.00', '5', '5.00', '5.00', '5.00', '2020-02-22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `meeting_attendance`
--

DROP TABLE IF EXISTS `meeting_attendance`;
CREATE TABLE IF NOT EXISTS `meeting_attendance` (
  `mid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pa` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meeting_attendance`
--

INSERT INTO `meeting_attendance` (`mid`, `uid`, `pa`) VALUES
(1, 1, 'p'),
(1, 2, 'p'),
(1, 10, 'p'),
(1, 11, 'p'),
(1, 13, 'p'),
(1, 25, 'p'),
(3, 1, 'a'),
(3, 2, 'a'),
(3, 10, 'p'),
(3, 11, 'p'),
(3, 13, 'p'),
(3, 25, 'p');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_detail`
--

DROP TABLE IF EXISTS `meeting_detail`;
CREATE TABLE IF NOT EXISTS `meeting_detail` (
  `meet_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `details` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `stime` datetime NOT NULL,
  `etime` datetime NOT NULL,
  `place` varchar(80) NOT NULL,
  `presentstatus` int(11) NOT NULL,
  PRIMARY KEY (`meet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meeting_detail`
--

INSERT INTO `meeting_detail` (`meet_id`, `title`, `details`, `date`, `stime`, `etime`, `place`, `presentstatus`) VALUES
(1, 'jsddj', 'askdakjsd', '2000-02-03', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 1),
(2, 'jhg', 'hgfh', '2020-02-12', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0),
(3, 'kskk', ':fun_details', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'place', 1),
(5, 'ddfgds', 'saadfc', '2020-02-28', '2020-03-03 09:50:00', '2020-03-11 09:35:00', 'Small Hall', 0),
(6, 'jhj', 'hgvjgvj', '2020-02-28', '2020-02-28 09:18:00', '2020-02-28 09:18:00', 'Large Hall', 0),
(7, 'ppp', 'sss', '2020-02-28', '2020-02-28 09:25:00', '2020-02-28 09:21:00', 'Small Hall', 0),
(8, 'bday party', 'look and fnd', '2020-02-28', '2020-02-28 10:40:00', '2020-02-28 10:36:00', 'Club House', 0);

-- --------------------------------------------------------

--
-- Table structure for table `member_detail`
--

DROP TABLE IF EXISTS `member_detail`;
CREATE TABLE IF NOT EXISTS `member_detail` (
  `uid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_detail`
--

INSERT INTO `member_detail` (`uid`, `name`, `birthdate`, `gender`) VALUES
(11, 'papu', '2020-02-05', 'Male');

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
  `isvoted` varchar(1) NOT NULL DEFAULT 'n',
  PRIMARY KEY (`nid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`nid`, `title`, `descr`, `date`, `isvoted`) VALUES
(2, 'this is cdemo', 'notive is', '2020-02-25 12:55:36', 'n'),
(3, 'Test', '<p><b>kvjhf</b></p><p><span style=\"background-color: rgb(255, 255, 0);\">hyhiyi</span></p>', '2020-02-26 17:09:53', 'n'),
(4, 'Event Reminder', '<p><br></p><blockquote class=\"blockquote\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</blockquote><h2>tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</h2><p>quis nostrud exercitation ullamco laboris nisi <u>ut </u>aliquip ex ea commodo</p><p><span style=\"font-family: Impact;\">consequat</span>. Duis aute irure dolor in reprehenderit in voluptate velit esse</p><p>cillum dolore eu fugiat nulla <b>pariatur</b>. Excepteur <span style=\"font-family: Helvetica;\">sint occaecat cupidatat</span> non</p><p>proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p> </p>', '2020-02-27 07:41:37', 'n'),
(5, '', '', '2020-02-27 23:26:08', 'n'),
(6, '', '', '2020-02-27 23:26:47', 'n'),
(7, '', '', '2020-02-27 23:27:51', 'n'),
(8, '', '', '2020-02-27 23:29:03', 'n'),
(9, '', '', '2020-02-28 00:14:55', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `notice_votes`
--

DROP TABLE IF EXISTS `notice_votes`;
CREATE TABLE IF NOT EXISTS `notice_votes` (
  `nid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `ans` varchar(1) NOT NULL,
  PRIMARY KEY (`nid`,`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice_votes`
--

INSERT INTO `notice_votes` (`nid`, `mid`, `ans`) VALUES
(2, 11, 'y'),
(3, 11, 'y'),
(4, 11, 'y');

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
(13, 'papu', 'papu@gmail.com', '1212', 1212, '2020-02-28 00:00:48', 'user', 'Male', '2020-12-31'),
(25, 'bhide', 'bhide@gmail.com', '1212121', 12123, '2020-02-28 00:16:38', 'user', 'Male', '2015-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `user_buffer`
--

DROP TABLE IF EXISTS `user_buffer`;
CREATE TABLE IF NOT EXISTS `user_buffer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullName` varchar(255) DEFAULT NULL,
  `userEmail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `contactNo` bigint(11) DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(15) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `fid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_buffer`
--

INSERT INTO `user_buffer` (`id`, `fullName`, `userEmail`, `password`, `contactNo`, `regDate`, `type`, `gender`, `dob`, `fid`) VALUES
(1, 'Deepak', 'patelpriyanshi0807@gmail.com', 'test', 1234567890, '2019-08-06 02:47:39', 'user', NULL, NULL, 0),
(10, 'Parth Bhadreshkumar Patel', 'parthpatelvvn@gmail.com', 'test', 7567452930, '2020-02-25 20:49:32', 'admin', 'Male', NULL, 0),
(11, 'XYZ', 'bhaktisanjaybhai@gmail.com', 'test', 54545456456, '2020-02-26 17:00:52', 'user', 'Male', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_detail`
--

DROP TABLE IF EXISTS `vehicle_detail`;
CREATE TABLE IF NOT EXISTS `vehicle_detail` (
  `uid` int(11) NOT NULL,
  `number` varchar(15) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_detail`
--

INSERT INTO `vehicle_detail` (`uid`, `number`, `type`) VALUES
(2, 'GJ12a122', 2),
(11, 'GJ12a1299', 2),
(2, 'GJ12ac1', 4),
(1, 'GJ12ac110', 2);

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitor`
--

INSERT INTO `visitor` (`vid`, `name`, `cno`, `email`, `ref`, `time`) VALUES
(1, 'Vedang', '99099990999', 'asdas@gmail.com', 10, '2020-02-27 05:25:18'),
(2, 'papu', '122', 'pintu', NULL, '2020-02-27 07:26:31'),
(3, 'papu', '1222', 'pintu', 11, '2020-02-27 07:28:26');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
