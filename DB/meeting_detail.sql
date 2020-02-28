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
-- Table structure for table `meeting_detail`
--

CREATE TABLE `meeting_detail` (
  `meet_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `details` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `stime` datetime NOT NULL,
  `etime` datetime NOT NULL,
  `presentstatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meeting_detail`
--

INSERT INTO `meeting_detail` (`meet_id`, `title`, `details`, `date`, `stime`, `etime`, `presentstatus`) VALUES
(1, 'jsddj', 'askdakjsd', '2000-02-03', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, 'jhg', 'hgfh', '2020-02-12', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meeting_detail`
--
ALTER TABLE `meeting_detail`
  ADD PRIMARY KEY (`meet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meeting_detail`
--
ALTER TABLE `meeting_detail`
  MODIFY `meet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
