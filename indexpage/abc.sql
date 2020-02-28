-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 10, 2018 at 09:10 AM
-- Server version: 5.5.16
-- PHP Version: 5.4.0beta2-dev

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `abc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adminid` varchar(200) DEFAULT NULL,
  `adminname` varchar(200) DEFAULT NULL,
  `dutyfromtime` time DEFAULT NULL,
  `dutyuptotime` time DEFAULT NULL,
  `contactno1` varchar(200) DEFAULT NULL,
  `contactno2` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `adminid`, `adminname`, `dutyfromtime`, `dutyuptotime`, `contactno1`, `contactno2`, `address`) VALUES
(2, '11', '11', '00:00:11', '00:00:11', '11', '11', '11');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bookcode` varchar(200) DEFAULT NULL,
  `bookname` varchar(200) DEFAULT NULL,
  `bookpublication` varchar(200) DEFAULT NULL,
  `bookauthor` varchar(200) DEFAULT NULL,
  `bookedition` varchar(200) DEFAULT NULL,
  `department` varchar(200) DEFAULT NULL,
  `price` int(200) DEFAULT NULL,
  `totalstock` varchar(200) DEFAULT NULL,
  `remainingstock` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bookcode` (`bookcode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `bookcode`, `bookname`, `bookpublication`, `bookauthor`, `bookedition`, `department`, `price`, `totalstock`, `remainingstock`) VALUES
(2, '56585', 'n', 'nnj', 'nj', 'njk', 'nk', 50, '50', '1561'),
(4, '32', 'pizz', 'kk', 'kll;k', 'lklkl', 'mm@', 1, '12', '12');

-- --------------------------------------------------------

--
-- Table structure for table `book_issue_data`
--

CREATE TABLE IF NOT EXISTS `book_issue_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bookcode` varchar(200) NOT NULL,
  `erno` varchar(200) DEFAULT NULL,
  `faculty_id` varchar(200) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `mobileno` varchar(200) DEFAULT NULL,
  `bookname` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `book_issue_data`
--

INSERT INTO `book_issue_data` (`id`, `bookcode`, `erno`, `faculty_id`, `issue_date`, `return_date`, `mobileno`, `bookname`) VALUES
(1, '2', '113', '22', '2018-12-12', '2018-12-12', '98756', ''),
(2, '25', '112', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dailyfed`
--

CREATE TABLE IF NOT EXISTS `dailyfed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sr` varchar(200) DEFAULT NULL,
  `fedname` varchar(200) DEFAULT NULL,
  `feddesc` varchar(300) DEFAULT NULL,
  `department` varchar(200) DEFAULT NULL,
  `semester` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `dailyfed`
--

INSERT INTO `dailyfed` (`id`, `sr`, `fedname`, `feddesc`, `department`, `semester`) VALUES
(1, '1', 'xyz', 'TechPi', 'ce', '4');

-- --------------------------------------------------------

--
-- Table structure for table `donar`
--

CREATE TABLE IF NOT EXISTS `donar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `donarname` varchar(200) DEFAULT NULL,
  `bookname` varchar(200) NOT NULL,
  `department` varchar(200) DEFAULT NULL,
  `bookpublication` varchar(200) DEFAULT NULL,
  `bookedition` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `contactno` varchar(200) DEFAULT NULL,
  `totalnoofbooks` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `donar`
--

INSERT INTO `donar` (`id`, `donarname`, `bookname`, `department`, `bookpublication`, `bookedition`, `address`, `date`, `contactno`, `totalnoofbooks`) VALUES
(1, 'hj', 'bjhb', 'bjbj', 'jbbj', 'jbjb', 'surat', '2018-02-21', '6365', '56');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE IF NOT EXISTS `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objectuno` varchar(200) DEFAULT NULL,
  `objecttype` varchar(200) DEFAULT NULL,
  `objectname` varchar(200) DEFAULT NULL,
  `price` int(200) DEFAULT NULL,
  `yearofbuying` year(4) DEFAULT NULL,
  `suppliername` varchar(200) DEFAULT NULL,
  `contactno1` int(12) DEFAULT NULL,
  `contactno2` int(12) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `totalstock` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `objectuno`, `objecttype`, `objectname`, `price`, `yearofbuying`, `suppliername`, `contactno1`, `contactno2`, `address`, `totalstock`) VALUES
(2, '55', 'hh', 'hkh', 300, 2014, 'hh', 968698, 68698, 'jhhgjh', '20'),
(3, '54', 'hkjhk', 'iouiou', 75, 2000, 'iuiu', 36568, 86986, 'jkhuh', '536'),
(4, '1', 'mkl', 'kjklj', 20, 2012, 'bj', 1111, 22222, '', '12');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(0, 'TechPi', 'techpi8084'),
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `notify`
--

CREATE TABLE IF NOT EXISTS `notify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `erno` varchar(200) DEFAULT NULL,
  `studentname` varchar(200) DEFAULT NULL,
  `contactno` varchar(200) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `bookname` varchar(200) DEFAULT NULL,
  `message` varchar(200) DEFAULT NULL,
  `lastdate` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `notify`
--

INSERT INTO `notify` (`id`, `erno`, `studentname`, `contactno`, `email`, `bookname`, `message`, `lastdate`) VALUES
(2, '112', 'bhakti', NULL, NULL, NULL, NULL, NULL),
(3, '10', 'xeuv', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projectreport`
--

CREATE TABLE IF NOT EXISTS `projectreport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sr` varchar(200) DEFAULT NULL,
  `department` varchar(200) DEFAULT NULL,
  `projectdefinationrank1` varchar(200) DEFAULT NULL,
  `studentname1` varchar(200) DEFAULT NULL,
  `erno1` varchar(200) DEFAULT NULL,
  `projectdefinationrank2` varchar(200) DEFAULT NULL,
  `studentname2` varchar(200) DEFAULT NULL,
  `erno2` varchar(200) DEFAULT NULL,
  `projectdefinationrank3` varchar(200) DEFAULT NULL,
  `studentname3` varchar(200) DEFAULT NULL,
  `erno3` varchar(200) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `projectreport`
--

INSERT INTO `projectreport` (`id`, `sr`, `department`, `projectdefinationrank1`, `studentname1`, `erno1`, `projectdefinationrank2`, `studentname2`, `erno2`, `projectdefinationrank3`, `studentname3`, `erno3`, `year`) VALUES
(1, '1', 'ce', 'hello', 'bhakti', '', '', '', '', '', '', '', 0000);

-- --------------------------------------------------------

--
-- Table structure for table `return_data`
--

CREATE TABLE IF NOT EXISTS `return_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_id` varchar(200) DEFAULT NULL,
  `erno` varchar(200) DEFAULT NULL,
  `s_name` varchar(200) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `original_return_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `bookcode` varchar(200) DEFAULT NULL,
  `fine` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `return_data`
--

INSERT INTO `return_data` (`id`, `faculty_id`, `erno`, `s_name`, `issue_date`, `original_return_date`, `return_date`, `bookcode`, `fine`) VALUES
(1, NULL, '116', NULL, NULL, NULL, NULL, '116', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_id` varchar(200) DEFAULT NULL,
  `faculty_name` varchar(200) DEFAULT NULL,
  `department` varchar(200) DEFAULT NULL,
  `dept_password` varchar(200) DEFAULT NULL,
  `designation` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `faculty_id`, `faculty_name`, `department`, `dept_password`, `designation`) VALUES
(1, '123', 'bhakti', 'ce', '125', 'bhakti');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `erno` varchar(200) DEFAULT NULL,
  `studentname` varchar(200) DEFAULT NULL,
  `department` varchar(200) DEFAULT NULL,
  `semester` varchar(200) DEFAULT NULL,
  `addmissionyear` year(4) DEFAULT NULL,
  `contactno1` int(12) DEFAULT NULL,
  `contactno2` int(12) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `erno`, `studentname`, `department`, `semester`, `addmissionyear`, `contactno1`, `contactno2`, `address`) VALUES
(3, '10', ',nk', 'nmn,', '5', 2015, 1515, 15348, 'hjbj');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
