-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2019 at 08:22 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reset`
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
(11, 'hasan', '22', 3600),
(12, 'yakub', '24', 800),
(13, 'Jahir', '25', 3000),
(14, 'Jobbar', '26', 1200),
(15, 'Resat', '27', 1000),
(16, 'resat', '0', 0),
(17, 'resat', '0', 0),
(18, 'rmiyan', '30', 2000),
(19, 'shihab', '31', 0);

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
  `dob` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
  `sit` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `scNumber`, `pnr`, `fname`, `lname`, `phone`, `email`, `dob`, `dest`, `depart`, `depDate`, `depTime`, `retTime`, `retDate`, `amount`, `seatNames`, `seatNamesDown`, `accept`, `user`, `sit`) VALUES
(1, 'H1201', '47H1201401104', 'Abdul', 'Jobbar', '01917743300', 'jobbar@gmail.com', '2019-08-26 19:20:51', 11, 1, '2019-08-28', '18:00:00', '19:00:00', '2019-08-30', 2000, 'F1', 'C2', 1, 'Jobbar', 1),
(3, 'H1011', '59H1011401104', 'Yakub', 'Abullah', '01917743300', 'yakub@gmail.com', '2019-08-27 10:52:55', 6, 1, '2019-08-29', '07:00:00', '07:00:00', '2019-08-31', 1400, 'D1', 'B2', 1, 'yakub', 1),
(4, 'Sa1901', '61Sa1901401104', 'Resat', 'Miyan', '01917743300', 'resat@gmail.com', '2019-10-02 07:40:07', 11, 1, '2019-10-04', '20:30:00', '20:10:00', '2019-10-05', 2000, 'D1', 'G1', 1, 'Resat', 1),
(5, 'Sa1901', '61Sa1901392293', 'sonia', 'akter', '01942432941', 'it.soniaakter@gmail.com', '2019-10-15 05:20:27', 11, 1, '2019-10-16', '20:30:00', '', '', 2000, 'B1,B2', '', 1, 'rmiyan', 2);

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
(22, 'Md. Hasan', 'Khan', 'hasan', 'hasan12345', 'hasan@gmail.com'),
(24, 'Md. Yakub', 'Abdullah', 'yakub', 'y12345678', 'yakub@gmail.com'),
(25, 'Md. Jahir ', 'Raihan', 'Jahir', 'j12345678', 'jahir5090@gmail.com'),
(26, 'Md. Abdul', 'Jobbar', 'Jobbar', 'j12345678', 'jobbar@gmail.com'),
(27, 'Resat', 'Miyan', 'Resat', 're12345678', 'resat@gmail.com'),
(30, 'resat', 'miyan', 'rmiyan', '123456789', 'mdresatbhuiyan@gmail.com'),
(31, 'shihab', 'mollah', 'shihab', '123456789', 'rmiyan');

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
(5, 'Cox\'s Bazar'),
(6, 'Khulna'),
(7, 'Jesshor'),
(8, 'Rajshahi'),
(9, 'Mymensingh'),
(10, 'Sylhet'),
(11, 'Tangail'),
(12, 'Faridpur'),
(13, 'Naogaon'),
(14, 'Cumilla'),
(15, 'Barisal'),
(16, 'Noakhali');

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
(85, 'sajib', 'Your Ticket Is Accepted For Bus Number E1331 For Date 2019-08-19 And PNR Is 38E1331401104', 1, 1),
(86, 'hasan', 'Your Ticket Is Accepted For Bus Number E1230 For Date 2019-08-19 And PNR Is 36E1230401104', 1, 0),
(87, 'sajib', 'Your Ticket Is Accepted For Bus Number GL1011 For Date 2019-08-21 And PNR Is 41GL1011401104', 1, 1),
(88, 'sajib', 'Your Ticket Is Accepted For Bus Number H1101 For Date 2019-08-23 And PNR Is 43H1101401104', 1, 1),
(89, 'sajib', 'Your Ticket Is Accepted For Bus Number H1101 For Date 2019-08-23 And PNR Is 43H1101391193', 1, 1),
(90, 'sajib', 'Your Ticket Is Accepted For Bus Number h1910 For Date 2019-08-25 And PNR Is 44h1910401104', 1, 1),
(91, 'sajib', 'Your Ticket Is Accepted For Bus Number h1910 For Date 2019-08-25 And PNR Is 44h1910391193', 1, 1),
(92, 'sajib', 'Your Ticket Is Accepted For Bus Number h1910 For Date 2019-08-25 And PNR Is 44h1910381183', 1, 1),
(93, 'yakub', 'Your Ticket Is Accepted For Bus Number E1230 For Date 2019-08-27 And PNR Is 46E1230401104', 1, 1),
(94, 'yakub', 'Your Ticket Is Accepted For Bus Number H1201 For Date 2019-08-28 And PNR Is 47H1201401104', 1, 1),
(95, 'yakub', 'Your Ticket Is Accepted For Bus Number E1230 For Date 2019-08-27 And PNR Is 46E1230412214', 1, 1),
(96, 'yakub', 'Your Ticket Is Accepted For Bus Number H1201 For Date 2019-08-28 And PNR Is 47H1201401104', 1, 1),
(97, 'yakub', 'Your Ticket Is Accepted For Bus Number E1230 For Date 2019-08-29 And PNR Is 52E1230401104', 1, 1),
(98, 'yakub', 'Your Ticket Is Accepted For Bus Number H1201 For Date 2019-08-28 And PNR Is 47H1201391193', 1, 1),
(101, 'yakub', 'Your ticket for Bus number H1202 For Date 2019-08-26 is accepted !', 1, 1),
(102, 'yakub', 'Your ticket for Bus number H1201 For Date 2019-08-28 is awating for confirmation', 1, 1),
(103, 'root', 'Your ticket for Bus number  For Date 1970-01-01 is cancelled !', 1, 0),
(104, 'yakub', 'Your ticket for Bus number H1201 for Date 2019-08-28 and PNR 47H1201391193  is awating for confirmation', 1, 1),
(105, 'yakub', 'Your ticket for Bus number H1201 For Date 2019-08-26 and PNR 47H1201391193 is cancelled !', 1, 1),
(106, 'yakub', 'Your ticket for Bus number H1201 for Date 2019-08-28 and PNR 47H1201391193  is awating for confirmation', 1, 1),
(107, 'yakub', 'Your ticket for Bus number H1201 for Date 2019-08-28 and PNR 47H1201391193  is awating for confirmation', 1, 1),
(108, 'yakub', 'Your ticket for Bus number H1201 For Date 2019-08-26 and PNR 47H1201391193 is cancelled !', 1, 1),
(109, 'yakub', 'Your ticket for Bus number H1201 for Date 2019-08-28 and PNR 47H1201391193  is awating for confirmation', 1, 1),
(110, 'yakub', 'Your ticket for Bus number H1201 for Date 2019-08-26 and PNR 47H1201391193 is accepted !', 1, 1),
(111, 'yakub', 'Your ticket for Bus number H1201 for Date 2019-08-28 and PNR 47H1201381183  is awating for confirmation', 1, 1),
(112, 'yakub', 'Your ticket for Bus number H1201 for Date 2019-08-26 and PNR 47H1201381183 is accepted !', 1, 1),
(113, 'yakub', 'Your ticket for Bus number H1201 For Date 2019-08-26 and PNR 47H1201381183 is cancelled !', 1, 0),
(114, 'yakub', 'Your ticket for Bus number H1201 For Date 2019-08-26 and PNR 47H1201391193 is cancelled !', 1, 0),
(115, 'yakub', 'Your ticket for Bus number H1202 For Date 2019-08-26 and PNR 51H1202401104 is cancelled !', 1, 0),
(116, 'yakub', 'Your ticket for Bus number E1230 For Date 2019-08-26 and PNR 52E1230401104 is cancelled !', 1, 0),
(117, 'yakub', 'Your ticket for Bus number H1201 For Date 2019-08-26 and PNR 47H1201401104 is cancelled !', 1, 0),
(118, 'Jobbar', 'Your ticket for Bus number H1201 for Date 2019-08-28 and PNR 47H1201401104  is wating for confirmation', 1, 1),
(119, 'Jobbar', 'Your ticket for Bus number H1201 for Date 2019-08-27 and PNR 47H1201401104 is accepted !', 1, 1),
(120, 'yakub', 'Your ticket for Bus number E1230 for Date 2019-08-29 and PNR 52E1230401104  is wating for confirmation', 1, 0),
(121, 'yakub', 'Your ticket for Bus number E1230 For Date 2019-08-27 and PNR 52E1230401104 is cancelled !', 1, 0),
(122, 'yakub', 'Your ticket for Bus number H1011 for Date 2019-08-29 and PNR 59H1011401104  is wating for confirmation', 1, 0),
(123, 'yakub', 'Your ticket for Bus number H1011 for Date 2019-08-27 and PNR 59H1011401104 is accepted !', 1, 0),
(124, 'Resat', 'Your ticket for Bus number Sa1901 for Date 2019-10-04 and PNR 61Sa1901401104  is wating for confirmation', 1, 1),
(125, 'Resat', 'Your ticket for Bus number Sa1901 for Date 2019-10-02 and PNR 61Sa1901401104 is accepted !', 1, 1),
(126, 'rmiyan', 'Your ticket for Train number Sa1901 for Date 2019-10-16 and PNR 61Sa1901392293  is wating for confirmation', 1, 0),
(127, 'rmiyan', 'Your ticket for Train number Sa1901 for Date 2019-10-15 and PNR 61Sa1901392293 is accepted !', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` varchar(90) NOT NULL,
  `amount` int(5) NOT NULL,
  `acnumber` varchar(20) NOT NULL,
  `trxn_id` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `amount`, `acnumber`, `trxn_id`, `status`) VALUES
(18, 'Jahir', 3000, '01715698808', '2s3b4a5', 1),
(17, 'yakub', 3000, '01963524446', '2c4r5d3a', 1),
(16, 'sajib', 3000, '01684942794', '5c7s3f8d9a', 1),
(15, 'sajib', 2000, '01963524446', '8s6k5D6r', 1),
(14, 'sajib', 1000, '01963524446', '1c4d5g6s', 1),
(13, 'hasan', 3000, '01945567822', '1c3b4s5s', 1),
(12, 'hasan', 2000, '01715698808', '1a2b3c4d', 1),
(11, 'sajib', 3000, '01963524446', '2s3b4a5', 1),
(19, 'yakub', 200, '01963524446', '1a2b3c4d', 1),
(20, 'yakub', 1000, '01684942794', '2c4r5d3a', 1),
(21, 'yakub', 2000, '01945567822', '2s3b4a5', 1),
(22, 'yakub', 3000, '01715698808', '1c3b4s5s', 1),
(23, 'Jobbar', 3000, '01684942794', '2c4r5d3a', 1),
(24, 'Jobbar', 200, '01963524446', '2c4r5d3a', 1),
(25, 'yakub', 1400, '01715698808', '4r6t7y8f', 1),
(26, 'Resat', 3000, '01963524446', '1a2b3c4d', 1),
(27, 'rmiyan', 4000, '01942432941', '6JE4DZ1VQ', 1);

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
(6, 'Jesshor'),
(7, 'Cumilla'),
(8, 'Faridpur'),
(9, 'Mymensingh'),
(10, 'Khulna'),
(11, 'Cox\'s Bazar'),
(12, 'Rajshahi'),
(13, 'Naogaon'),
(14, 'Tangail'),
(15, 'Rangpur'),
(16, 'Sayadpur');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
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
  `cType` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `scName`, `scNumber`, `scType`, `fromLoc`, `toLoc`, `depDate`, `depTime`, `retDate`, `retTime`, `seat`, `seatCost`, `cType`) VALUES
(47, 'Hanif', 'H1201', '1', 1, 11, '2019-08-28', '18:00:00', '2019-08-30', '19:00:00', 39, 1000, 1),
(48, 'Ena', 'E1231', '1', 10, 1, '2019-08-28', '18:00:00', '2019-08-30', '17:00:00', 40, 700, 1),
(50, 'Hanif', 'H1310', '2', 5, 1, '2019-08-29', '19:00:00', '2019-08-30', '19:00:00', 40, 700, 1),
(51, 'Hanif', 'H1202', '1', 1, 11, '2019-08-28', '18:00:00', '2019-08-29', '18:00:00', 40, 1000, 1),
(52, 'Eagle', 'E1230', '1', 1, 10, '2019-08-29', '16:00:00', '2019-08-30', '16:00:00', 40, 1000, 1),
(53, 'Ena', 'E1513', '1', 1, 2, '2019-08-28', '17:30:00', '2019-08-30', '17:00:00', 40, 1000, 1),
(54, 'Ena', 'E1315', '2', 1, 2, '2019-08-28', '16:00:00', '2019-08-31', '16:00:00', 40, 700, 1),
(55, 'Ena', 'E1290', '2', 2, 1, '2019-08-28', '18:00:00', '2019-08-30', '17:00:00', 40, 700, 1),
(56, 'Shohag ', 'Sh1010', '1', 1, 11, '2019-08-28', '20:00:00', '2019-08-30', '20:00:00', 40, 1200, 1),
(57, 'Eagle', 'E1210', '2', 1, 6, '2019-08-29', '12:00:00', '2019-08-30', '12:00:00', 40, 700, 1),
(58, 'Eagle', 'E1910', '2', 7, 1, '2019-08-29', '18:00:00', '2019-08-30', '18:00:00', 40, 700, 1),
(59, 'Hanif', 'H1011', '2', 1, 6, '2019-08-29', '07:00:00', '2019-08-31', '07:00:00', 39, 700, 1),
(60, 'Ena', 'E1011', '1', 1, 1, '2019-08-30', '18:00:00', '2019-08-30', '18:00:00', 500, 20, 1),
(61, 'Shohag ', 'Sa1901', '1', 1, 11, '2019-10-16', '20:30:00', '2019-10-17', '20:10:00', 37, 1000, 1),
(62, 'Shohag ', 'Sa1901', '1', 1, 11, '2019-10-17', '20:30:00', '2019-10-18', '20:10:00', 39, 1000, 1),
(63, 'Shohag ', 'Sa1901', '1', 1, 11, '2019-10-18', '20:30:00', '2019-10-19', '20:10:00', 39, 1000, 1);

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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
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
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `retlocation`
--
ALTER TABLE `retlocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

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
