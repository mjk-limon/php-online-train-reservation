-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2019 at 01:41 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

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

CREATE TABLE `administration` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administration`
--

INSERT INTO `administration` (`admin_id`, `admin_name`, `admin_pass`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

CREATE TABLE `balance` (
  `id` int(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `balance` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `balance`
--

INSERT INTO `balance` (`id`, `username`, `userid`, `balance`) VALUES
(1, 'sajib', '1', 2200);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
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
  `accept` int(11) NOT NULL,
  `user` varchar(256) NOT NULL,
  `sit` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `scNumber`, `pnr`, `fname`, `lname`, `phone`, `email`, `dob`, `dest`, `depart`, `depDate`, `depTime`, `retTime`, `retDate`, `amount`, `seatNames`, `accept`, `user`, `sit`) VALUES
(21, 'GL 1233', '15GL 1233405504', 'Ananda ', 'Mahmud', '01963524446', 'ananda@gmail.com', '2019-07-28 15:39:55', 1, 2, '2019-07-29', '18:00:00', '', '', 3500, 'E1,E2,F1,F2,C2', 1, 'Joo', 5),
(22, 'H1930', '17H1930401104', 'sajib', 'ibrahim', '01963524446', 'sajib_mik@ymail.com', '2019-07-29 14:51:05', 10, 1, '2019-07-30', '18:00:00', '18:15:00', '2019-08-01', 1400, 'C1', 1, 'sajib', 1),
(23, 'H1930', '17H1930391193', 'sajib', 'ibrahim', '01963524446', 'sajib_mik@ymail.com', '2019-07-29 14:48:23', 10, 1, '2019-07-30', '18:00:00', '18:15:00', '2019-08-01', 1400, 'A1', 0, 'sajib', 1),
(33, 'GL 1230', '14GL 1230331133', 'sksojib', 'dsfsd', '20452445', 'ssk58021@gmail.com', '2019-07-30 11:36:11', 2, 1, '2019-07-29', '18:01:00', '', '', 700, 'A1', 0, 'sajib', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cus_id` int(11) NOT NULL,
  `cus_first_name` varchar(100) NOT NULL,
  `cus_last_name` varchar(100) NOT NULL,
  `cus_user_name` varchar(100) NOT NULL,
  `cus_pass` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cus_id`, `cus_first_name`, `cus_last_name`, `cus_user_name`, `cus_pass`, `email`) VALUES
(1, 'Ik Sajib', 'sajib', 'sajib', '123', 'sajib@gmail.com'),
(2, 'Md. Johir ', 'Rayhan', 'Johir', 'j123', 'jahir5090@gmail.com'),
(3, 'Ibrahim ', 'khalil', 'Ibrahim', 'iksajib', 'ibrahim@gmail.com'),
(4, 'Md. Kamal', 'Hossain', 'Kamal', 'k123', 'kamal@gmail.com'),
(5, 'Ananda ', 'Mahmud', 'Joo', 'a123', 'ananda@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `sms` varchar(500) NOT NULL,
  `adminPriority` tinyint(1) NOT NULL,
  `userPriority` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(44, 'sajib', 'Your Ticket Is Accepted For Bus Number GL 1230 For Date 2019-07-29 And PNR Is 14GL 1230391193', 1, 0),
(45, 'sajib', 'Your Ticket Is Accepted For Bus Number GL 1230 For Date 2019-07-29 And PNR Is 14GL 1230381183', 1, 0),
(46, 'sajib', 'Your Ticket Is Accepted For Bus Number GL 1230 For Date 2019-07-29 And PNR Is 14GL 1230371173', 1, 0),
(47, 'sajib', 'Your Ticket Is Accepted For Bus Number GL 1230 For Date 2019-07-29 And PNR Is 14GL 1230361163', 1, 0),
(48, 'sajib', 'Your Ticket Is Accepted For Bus Number GL 1230 For Date 2019-07-29 And PNR Is 14GL 1230351153', 1, 0),
(49, 'sajib', 'Your Ticket Is Accepted For Bus Number GL 1230 For Date 2019-07-29 And PNR Is 14GL 1230341143', 1, 0),
(50, 'sajib', 'Your Ticket Is Accepted For Bus Number GL 1230 For Date 2019-07-29 And PNR Is 14GL 1230331133', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `retlocation`
--

CREATE TABLE `retlocation` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `scName` varchar(255) NOT NULL,
  `scNumber` varchar(255) NOT NULL,
  `fromLoc` int(11) NOT NULL,
  `toLoc` int(11) NOT NULL,
  `depDate` date NOT NULL,
  `depTime` time NOT NULL,
  `retDate` date NOT NULL,
  `retTime` time NOT NULL,
  `seat` int(11) NOT NULL,
  `seatCost` int(11) NOT NULL,
  `cType` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `scName`, `scNumber`, `fromLoc`, `toLoc`, `depDate`, `depTime`, `retDate`, `retTime`, `seat`, `seatCost`, `cType`) VALUES
(1, 'Hanif', '14-9393', 1, 2, '2019-04-20', '10:00:00', '2019-04-30', '22:00:00', 35, 600, 1),
(3, 'Himachol ', '14-8003', 1, 5, '2019-04-25', '10:00:00', '2019-04-26', '22:00:00', 40, 380, 1),
(4, 'Ena', 'E1001', 1, 3, '2019-07-24', '08:15:14', '2019-07-26', '23:22:30', 40, 500, 1),
(5, 'hanif', 'ha1029', 1, 2, '2019-07-20', '12:30:00', '2019-07-20', '16:25:00', 27, 500, 1),
(6, 'Ena', 'e101', 1, 3, '2019-07-24', '13:00:00', '2019-07-26', '13:00:00', 40, 500, 1),
(7, 'Ena', 'E1230', 1, 3, '2019-07-24', '18:00:00', '2019-07-25', '18:00:00', 40, 500, 1),
(8, 'Eagle', 'Ea1230', 1, 10, '2019-07-25', '18:00:00', '2019-07-27', '18:00:00', 37, 600, 1),
(9, 'Eagle', 'Ea1231', 1, 10, '2019-07-25', '20:00:00', '2019-07-26', '20:00:00', 40, 600, 1),
(10, 'Sakura', 'SA1501', 1, 5, '2019-07-24', '08:00:00', '2019-07-25', '08:00:00', 28, 600, 1),
(11, 'Sakura', 'SA1502', 1, 5, '2019-07-25', '08:00:00', '2019-07-26', '08:00:00', 40, 600, 1),
(12, 'hanif', 'ha10290', 1, 3, '2019-07-27', '10:00:00', '2019-07-28', '12:00:00', 33, 550, 1),
(13, 'Hanif', 'H1250', 1, 10, '2019-07-29', '18:00:00', '2019-07-30', '18:00:00', 39, 700, 1),
(14, 'Golden Line ', 'GL 1230', 1, 2, '2019-07-29', '18:01:00', '2019-07-31', '20:00:00', 32, 700, 1),
(15, 'Golden Line ', 'GL 1233', 2, 1, '2019-07-29', '18:00:00', '2019-07-30', '20:00:00', 35, 700, 1),
(16, 'Shyamoli', 'Sh1001', 1, 2, '2019-07-31', '18:00:00', '2019-08-02', '20:00:00', 40, 700, 1),
(17, 'Hanif', 'H1930', 1, 10, '2019-07-30', '18:00:00', '2019-08-01', '18:15:00', 38, 700, 1),
(18, 'Shyamoli', 'Sh1912', 1, 2, '2019-07-31', '19:00:00', '2019-08-03', '19:00:00', 40, 700, 1),
(19, 'Shyamoli', 'Sh1901', 2, 1, '2019-07-31', '19:00:00', '2019-08-01', '19:00:00', 40, 700, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administration`
--
ALTER TABLE `administration`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `balance`
--
ALTER TABLE `balance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pnr` (`pnr`),
  ADD KEY `dest` (`dest`),
  ADD KEY `depart` (`depart`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_id`),
  ADD UNIQUE KEY `cus_user_name` (`cus_user_name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retlocation`
--
ALTER TABLE `retlocation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `toLoc` (`toLoc`),
  ADD KEY `fromLoc` (`fromLoc`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administration`
--
ALTER TABLE `administration`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `balance`
--
ALTER TABLE `balance`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `retlocation`
--
ALTER TABLE `retlocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
