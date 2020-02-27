-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2020 at 10:49 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
  `nid` int(10) NOT NULL,
  `title` text,
  `descr` text,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `isvoted` varchar(1) NOT NULL DEFAULT 'n'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`nid`, `title`, `descr`, `date`, `isvoted`) VALUES
(2, 'this is cdemo', 'notive is', '2020-02-25 12:55:36', 'n'),
(3, 'Test', '<p><b>kvjhf</b></p><p><span style="background-color: rgb(255, 255, 0);">hyhiyi</span></p>', '2020-02-26 17:09:53', 'n'),
(4, 'Event Reminder', '<p><br></p><blockquote class="blockquote">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</blockquote><h2>tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</h2><p>quis nostrud exercitation ullamco laboris nisi <u>ut </u>aliquip ex ea commodo</p><p><span style="font-family: Impact;">consequat</span>. Duis aute irure dolor in reprehenderit in voluptate velit esse</p><p>cillum dolore eu fugiat nulla <b>pariatur</b>. Excepteur <span style="font-family: Helvetica;">sint occaecat cupidatat</span> non</p><p>proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p> </p>', '2020-02-27 07:41:37', 'n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`nid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `nid` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
