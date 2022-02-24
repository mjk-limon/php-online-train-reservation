-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 21, 2020 at 04:21 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sas`
--

-- --------------------------------------------------------

--
-- Table structure for table `administration`
--

DROP TABLE IF EXISTS `administration`;
CREATE TABLE IF NOT EXISTS `administration` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(100) NOT NULL,
  `admin_pass` varchar(100) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administration`
--

INSERT INTO `administration` (`admin_id`, `admin_name`, `admin_pass`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

DROP TABLE IF EXISTS `balance`;
CREATE TABLE IF NOT EXISTS `balance` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `balance` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `balance`
--

INSERT INTO `balance` (`id`, `username`, `userid`, `balance`) VALUES
(1, 'sajib', '1', 4800),
(2, 'Josim', '9', 2750),
(3, 'Hasib', '10', 2900),
(4, 'Riaz', '11', 2900),
(5, 'xy', '12', 2040);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scNumber` varchar(256) NOT NULL,
  `pnr` varchar(256) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dob` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dest` int(11) NOT NULL,
  `depart` int(11) NOT NULL,
  `depDate` date NOT NULL,
  `depTime` time NOT NULL,
  `retTime` varchar(30) DEFAULT NULL,
  `retDate` varchar(30) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `seatNames` varchar(900) NOT NULL,
  `seatNamesDown` varchar(900) DEFAULT NULL,
  `accept` int(11) NOT NULL,
  `user` varchar(256) NOT NULL,
  `sit` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pnr` (`pnr`),
  KEY `dest` (`dest`),
  KEY `depart` (`depart`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `scNumber`, `pnr`, `fname`, `lname`, `phone`, `email`, `dob`, `dest`, `depart`, `depDate`, `depTime`, `retTime`, `retDate`, `amount`, `seatNames`, `seatNamesDown`, `accept`, `user`, `sit`) VALUES
(37, 'GL 1230', '20GL 1230381183', 'sajib', 'IK', '01917743300', 'sajib@gmail.com', '2019-07-31 12:59:30', 8, 1, '2019-07-31', '08:00:00', '08:00:00', '2019-08-01', 500, 'B1', NULL, 1, 'sajib', 1),
(40, 'E1230', '25E1230401104', 'Hasib', 'Khan', '01917743300', 'hasib@gmail.com', '2019-07-31 16:59:13', 3, 1, '2019-08-01', '18:10:00', '', '', 600, 'D4', NULL, 1, 'Hasib', 1),
(41, 'E1230', '25E1230391193', 'Riaz', 'Uddin', '01917743300', 'riaz@gmail.com', '2019-08-01 05:47:01', 3, 1, '2019-08-01', '18:10:00', '', '', 600, 'B1', NULL, 1, 'Riaz', 1),
(43, 'E1230', '28E1230401104', 'xy', 'Khan', '01917743300', 'xy@gmail.com', '2019-08-05 09:30:26', 2, 1, '2019-08-04', '18:01:00', '18:00:00', '2019-08-05', 1200, 'A1', NULL, 1, 'xy', 1),
(44, '148003', '30148003402204', 'Md Jahid Khan', 'Limon', '01956758055', 'mjk.limon@gmail.com', '2019-08-07 10:06:46', 2, 1, '2019-08-08', '10:00:00', '22:00:00', '2019-08-09', 1920, 'A1,A2', 'B3,B4', 0, 'xy', 2),
(45, '148003', '30148003381183', 'dyrt', 'ytyt', '018929982', 'uuu@gmail.com', '2019-08-07 19:20:43', 2, 1, '2019-08-08', '10:00:00', '22:00:00', '2019-08-09', 960, 'B1', 'B1', 1, 'xy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `cus_id` int(11) NOT NULL AUTO_INCREMENT,
  `cus_first_name` varchar(100) NOT NULL,
  `cus_last_name` varchar(100) NOT NULL,
  `cus_user_name` varchar(100) NOT NULL,
  `cus_pass` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`cus_id`),
  UNIQUE KEY `cus_user_name` (`cus_user_name`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_id`, `cus_first_name`, `cus_last_name`, `cus_user_name`, `cus_pass`, `email`) VALUES
(5, 'Kamal', 'Mahmud', 'kamal', 'k123', 'kamal@ymail.com'),
(8, 'Md. Jamal', 'Uddin', 'Jamal', 'j123', 'jamal@gmail.com'),
(9, 'MD. Josim', 'Uddin', 'Josim', 'j12345678', 'josim@gmail.com'),
(10, 'Md. Hasib', 'Khan', 'Hasib', 'h12345678', 'hasib@gmail.com'),
(11, 'Md. Alomgir', 'Hossain', 'Alomgir', 'alom12345678', 'alomgir@gmail.com'),
(12, 'Md. xy', 'Khan', 'xy', 'xy12345678', 'xy@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `Name`) VALUES
(1, 'Dhaka'),
(2, 'Chittagong'),
(3, 'Sayadpur'),
(4, 'Rangpur'),
(5, 'Sayadpur'),
(6, 'Khulna'),
(7, 'Jesshor'),
(8, 'Rajshahi'),
(9, 'Mymensingh'),
(10, 'Sylhet'),
(11, 'Tangail'),
(12, 'Faridpur'),
(13, 'Naugon'),
(14, 'Cumilla');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `sms` varchar(500) NOT NULL,
  `adminPriority` tinyint(1) NOT NULL,
  `userPriority` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `user`, `sms`, `adminPriority`, `userPriority`) VALUES
(1, 'shamim', 'Your Ticket Is Accepted For Bus Number 1212 For Date 2019-03-21 And PNR Is 1112124224', 1, 1),
(2, 'shamim', 'Your Ticket Is Accepted For Bus Number 1212 For Date 2019-03-21 And PNR Is 1112122222', 1, 1),
(3, 'shamim', 'Your Ticket Is Accepted For Bus Number 4545 For Date 2019-03-23 And PNR Is 144545122221', 1, 1),
(4, 'shamim', 'Your Ticket Is Accepted For Bus Number 4545 For Date 2019-03-23 And PNR Is 144545102201', 1, 1),
(5, 'shamim', 'Your Ticket Is Accepted For Bus Number 4545 For Date 2019-03-23 And PNR Is 1445458228', 1, 1),
(9, 'shamim', 'Your Ticket Is Accepted For Bus Number 4545 For Date 2019-04-23 And PNR Is 1445456226', 1, 1),
(10, 'shamim', 'Your Ticket Is Accepted For Train Number 4545 For Date 2019-04-23 And PNR Is 1445454224', 1, 1),
(11, 'shamim', 'Your Ticket Is Accepted For Bus Number 123456 For Date 2019-04-15 And PNR Is 15123456402204', 1, 1),
(12, 'shamim', 'Your Ticket Is Accepted For Bus Number 123456 For Date 2019-04-15 And PNR Is 17123456402204', 1, 1),
(13, 'shamim', 'Your Ticket Is Accepted For Bus Number 456789 For Date 2019-04-15 And PNR Is 17456789383383', 1, 0),
(14, 'shamim', 'Your Ticket Is Accepted For Train Number  For Date 2019-04-15 And PNR Is 16105501', 1, 0),
(15, 'shamim', 'Your Ticket Is Accepted For Train Number 701 For Date 2019-04-15 And PNR Is 167015555', 1, 0),
(16, 'shamim', 'Your Ticket Is Accepted For Bus Number 123456 For Date 2019-04-15 And PNR Is 15123456388883', 1, 0),
(17, 'shamim', 'Your Ticket Is Accepted For Bus Number 123456 For Date 2019-04-15 And PNR Is 15123456308803', 1, 0),
(18, 'shamim', 'Your Ticket Is Accepted For Bus Number 14-9393 For Date 2019-04-20 And PNR Is 114-9393403304', 1, 0),
(19, 'shamim', 'Your Ticket Is Accepted For Bus Number 14-9393 For Date 2019-04-20 And PNR Is 114-9393371173', 1, 0),
(20, 'shamim', 'Your Ticket Is Accepted For Bus Number 14-9393 For Date 2019-04-20 And PNR Is 114-9393361163', 1, 0),
(21, 'shamim', 'Your Ticket Is Accepted For Train Number 702 For Date 2019-04-20 And PNR Is 270250022005', 1, 0),
(22, 'shamim', 'Your Ticket Is Accepted For Train Number 702 For Date 2019-04-20 And PNR Is 270249822894', 1, 0),
(23, 'shamim', 'Your Ticket Is Accepted For Bus Number ha1029 For Date 2019-07-15 And PNR Is 5ha1029404404', 1, 0),
(24, 'shamim', 'Your Ticket Is Accepted For Bus Number ha1029 For Date 2019-07-15 And PNR Is 5ha1029365563', 1, 0),
(25, 'shamim', 'Your Ticket Is Accepted For Bus Number ha1029 For Date 2019-07-20 And PNR Is 5ha1029312213', 1, 0),
(26, 'sajib', 'Your Ticket Is Accepted For Bus Number ha1029 For Date 2019-07-20 And PNR Is 5ha1029292292', 1, 1),
(27, 'Johir', 'Your Ticket Is Accepted For Bus Number Ea1230 For Date 2019-07-25 And PNR Is 8Ea1230402204', 1, 0),
(28, 'Johir', 'Your Ticket Is Accepted For Bus Number SA1501 For Date 2019-07-24 And PNR Is 10SA1501402204', 1, 0),
(29, 'Kamal', 'Your Ticket Is Accepted For Bus Number SA1501 For Date 2019-07-24 And PNR Is 10SA1501381183', 1, 0),
(30, 'Johir', 'Your Ticket Is Accepted For Bus Number SA1501 For Date 2019-07-24 And PNR Is 10SA1501371173', 1, 0),
(31, 'Johir', 'Your Ticket Is Accepted For Bus Number SA1501 For Date 2019-07-24 And PNR Is 10SA1501363363', 1, 0),
(32, 'Johir', 'Your Ticket Is Accepted For Bus Number SA1501 For Date 2019-07-24 And PNR Is 10SA1501333333', 1, 0),
(33, 'Johir', 'Your Ticket Is Accepted For Bus Number SA1501 For Date 2019-07-24 And PNR Is 10SA1501302203', 1, 0),
(34, 'sajib', 'Your Ticket Is Accepted For Bus Number ha10290 For Date 2019-07-27 And PNR Is 12ha10290402204', 1, 1),
(35, 'sajib', 'Your Ticket Is Accepted For Bus Number ha10290 For Date 2019-07-27 And PNR Is 12ha10290381183', 1, 1),
(36, 'sajib', 'Your Ticket Is Accepted For Bus Number ha10290 For Date 2019-07-27 And PNR Is 12ha10290373373', 1, 1),
(37, 'sajib', 'Your Ticket Is Accepted For Bus Number ha10290 For Date 2019-07-27 And PNR Is 12ha10290341143', 1, 1),
(38, 'sajib', 'Your Ticket Is Accepted For Bus Number Ea1230 For Date 2019-07-25 And PNR Is 8Ea1230381183', 1, 1),
(39, 'Kamal', 'Your Ticket Is Accepted For Bus Number H1250 For Date 2019-07-28 And PNR Is 13H1250401104', 1, 0),
(40, 'sajib', 'Your Ticket Is Accepted For Bus Number GL 1230 For Date 2019-07-29 And PNR Is 14GL 1230401104', 1, 1),
(41, 'Joo', 'Your Ticket Is Accepted For Bus Number GL 1233 For Date 2019-07-29 And PNR Is 15GL 1233405504', 1, 1),
(42, 'sajib', 'Your Ticket Is Accepted For Bus Number H1930 For Date 2019-07-30 And PNR Is 17H1930401104', 1, 1),
(43, 'sajib', 'Your Ticket Is Accepted For Bus Number H1930 For Date 2019-07-30 And PNR Is 17H1930391193', 1, 1),
(44, 'sajib', 'Your Ticket Is Accepted For Bus Number GL 1230 For Date 2019-07-29 And PNR Is 14GL 1230391193', 1, 1),
(45, 'sajib', 'Your Ticket Is Accepted For Bus Number GL 1230 For Date 2019-07-29 And PNR Is 14GL 1230381183', 1, 1),
(46, 'sajib', 'Your Ticket Is Accepted For Bus Number GL 1230 For Date 2019-07-29 And PNR Is 14GL 1230371173', 1, 1),
(47, 'sajib', 'Your Ticket Is Accepted For Bus Number GL 1230 For Date 2019-07-29 And PNR Is 14GL 1230361163', 1, 1),
(48, 'sajib', 'Your Ticket Is Accepted For Bus Number GL 1230 For Date 2019-07-29 And PNR Is 14GL 1230351153', 1, 1),
(49, 'sajib', 'Your Ticket Is Accepted For Bus Number GL 1230 For Date 2019-07-29 And PNR Is 14GL 1230341143', 1, 1),
(50, 'sajib', 'Your Ticket Is Accepted For Bus Number GL 1230 For Date 2019-07-29 And PNR Is 14GL 1230331133', 1, 1),
(51, 'sajib', 'Your Ticket Is Accepted For Bus Number GL 1230 For Date 2019-07-29 And PNR Is 14GL 1230321123', 1, 1),
(52, 'sajib', 'Your Ticket Is Accepted For Bus Number GL 1230 For Date 2019-07-31 And PNR Is 20GL 1230401104', 1, 0),
(53, 'sajib', 'Your Ticket Is Accepted For Bus Number GL 1230 For Date 2019-07-31 And PNR Is 20GL 1230391193', 1, 0),
(54, 'sajib', 'Your Ticket Is Accepted For Bus Number GL 1230 For Date 2019-07-31 And PNR Is 20GL 1230381183', 1, 0),
(55, 'sajib', 'Your Ticket Is Accepted For Bus Number GL 1230 For Date 2019-07-31 And PNR Is 20GL 1230371173', 1, 0),
(56, 'Josim', 'Your Ticket Is Accepted For Bus Number GL1910 For Date 2019-08-01 And PNR Is 24GL1910401104', 1, 0),
(57, 'Hasib', 'Your Ticket Is Accepted For Bus Number E1230 For Date 2019-08-01 And PNR Is 25E1230401104', 1, 0),
(58, 'Riaz', 'Your Ticket Is Accepted For Bus Number E1230 For Date 2019-08-01 And PNR Is 25E1230391193', 1, 1),
(59, 'Alomgir', 'Your Ticket Is Accepted For Bus Number Eag1312 For Date 2019-08-03 And PNR Is 27Eag131240044004', 1, 1),
(60, 'xy', 'Your Ticket Is Accepted For Bus Number E1230 For Date 2019-08-04 And PNR Is 28E1230401104', 1, 0),
(61, 'xy', 'Your Ticket Is Accepted For Bus Number E1230 For Date 2019-08-06 And PNR Is 29E1230401104', 1, 0),
(62, 'xy', 'Your Ticket Is Accepted For Bus Number 148003 For Date 2019-08-08 And PNR Is 30148003401104', 1, 0),
(63, 'xy', 'Your Ticket Is Accepted For Bus Number 148003 For Date 2019-08-08 And PNR Is 30148003391193', 1, 0),
(64, 'xy', 'Your Ticket Is Accepted For Bus Number 148003 For Date 2019-08-08 And PNR Is 30148003400004', 1, 0),
(65, 'xy', 'Your Ticket Is Accepted For Bus Number 148003 For Date 2019-08-08 And PNR Is 30148003401104', 1, 0),
(66, 'xy', 'Your Ticket Is Accepted For Bus Number 148003 For Date 2019-08-08 And PNR Is 30148003401104', 1, 0),
(67, 'xy', 'Your Ticket Is Accepted For Bus Number 148003 For Date 2019-08-08 And PNR Is 30148003402204', 1, 0),
(68, 'xy', 'Your Ticket Is Accepted For Bus Number 148003 For Date 2019-08-08 And PNR Is 30148003381183', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(90) NOT NULL,
  `amount` int(5) NOT NULL,
  `acnumber` varchar(20) NOT NULL,
  `trxn_id` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `amount`, `acnumber`, `trxn_id`, `status`) VALUES
(1, 'xy', 2000, '01956758055', 'a1b2c3d4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `retlocation`
--

DROP TABLE IF EXISTS `retlocation`;
CREATE TABLE IF NOT EXISTS `retlocation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retlocation`
--

INSERT INTO `retlocation` (`id`, `Name`) VALUES
(1, 'Dhaka'),
(2, 'Chittagong'),
(3, 'Sylhet'),
(4, 'Barisal'),
(5, 'Noakhali'),
(6, 'Gazipur'),
(7, 'Cumiila'),
(8, 'Faridpur'),
(9, 'Mymensingh'),
(10, 'Khulna');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scName` varchar(255) NOT NULL,
  `scNumber` varchar(255) NOT NULL,
  `scType` varchar(10) NOT NULL,
  `fromLoc` int(11) NOT NULL,
  `toLoc` int(11) NOT NULL,
  `depDate` date NOT NULL,
  `depTime` time NOT NULL,
  `retDate` date NOT NULL,
  `retTime` time NOT NULL,
  `seat` int(11) NOT NULL,
  `seatCost` int(11) NOT NULL,
  `cType` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `toLoc` (`toLoc`),
  KEY `fromLoc` (`fromLoc`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `scName`, `scNumber`, `scType`, `fromLoc`, `toLoc`, `depDate`, `depTime`, `retDate`, `retTime`, `seat`, `seatCost`, `cType`) VALUES
(25, 'Ena', 'E1230', '1', 1, 3, '2019-08-01', '18:10:00', '2019-08-03', '18:10:00', 38, 600, 1),
(26, 'Ena', 'Ea1231', '1', 10, 1, '2019-08-02', '18:15:00', '2019-08-04', '18:10:00', 40, 600, 1),
(27, 'Eagle', 'Eag1312', '2', 1, 10, '2019-08-03', '18:00:00', '2019-08-04', '18:00:00', 0, 600, 1),
(28, 'Ena', 'E1230', '1', 1, 2, '2019-08-04', '18:01:00', '2019-08-05', '18:00:00', 39, 600, 1),
(29, 'Eagle', 'E1230', '1', 1, 3, '2019-08-06', '18:00:00', '2019-08-07', '18:00:00', 39, 600, 1),
(30, 'Hanif Enterprise', '148003', '2', 1, 2, '2019-08-08', '10:00:00', '2019-08-09', '22:00:00', 37, 480, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`dest`) REFERENCES `retlocation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`depart`) REFERENCES `location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`fromLoc`) REFERENCES `location` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`toLoc`) REFERENCES `retlocation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
