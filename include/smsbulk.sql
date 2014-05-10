-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2013 at 06:51 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `smsbulk`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `accountId` int(10) NOT NULL AUTO_INCREMENT,
  `clientId` int(14) NOT NULL,
  `accountBalance` int(16) NOT NULL,
  `addedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`accountId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE IF NOT EXISTS `administrator` (
  `administratorId` int(5) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `email` varchar(35) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `password` int(30) NOT NULL,
  `registrationDate` date NOT NULL,
  PRIMARY KEY (`administratorId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `clientId` int(10) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `userName` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `registrationDate` date NOT NULL,
  PRIMARY KEY (`clientId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`clientId`, `firstName`, `lastName`, `email`, `phoneNumber`, `userName`, `password`, `registrationDate`) VALUES
(1, 'Timothy', 'Mubiru', 'mubstimor@gmail.com', '256701313574', 'timoh', '81dc9bdb52d04dc20036dbd8313ed055', '2013-10-07');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `contactId` int(10) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `clientId` int(10) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`contactId`),
  KEY `fk1` (`clientId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contactId`, `firstName`, `lastName`, `phoneNumber`, `clientId`, `dateAdded`) VALUES
(2, 'Jonathan', 'Mukiibi', '256701898263', 1, '2013-10-09 06:07:40'),
(5, 'Farooq', 'Seruwu', '256703645800', 1, '2013-10-09 12:28:30');

-- --------------------------------------------------------

--
-- Table structure for table `debt`
--

CREATE TABLE IF NOT EXISTS `debt` (
  `debtId` int(15) NOT NULL AUTO_INCREMENT,
  `clientId` int(10) NOT NULL,
  `debtAmount` varchar(10) NOT NULL,
  `creditAmount` varchar(10) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`debtId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `groupId` int(10) NOT NULL AUTO_INCREMENT,
  `groupName` text NOT NULL,
  `clientId` int(10) NOT NULL,
  `registrationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`groupId`),
  UNIQUE KEY `clientId` (`clientId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`groupId`, `groupName`, `clientId`, `registrationDate`) VALUES
(1, 'customers', 1, '2013-10-08 09:59:07');

-- --------------------------------------------------------

--
-- Table structure for table `groupmember`
--

CREATE TABLE IF NOT EXISTS `groupmember` (
  `gpmemberId` int(10) NOT NULL AUTO_INCREMENT,
  `contactId` int(10) NOT NULL,
  `groupId` int(10) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`gpmemberId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `groupmember`
--

INSERT INTO `groupmember` (`gpmemberId`, `contactId`, `groupId`, `dateAdded`) VALUES
(2, 2, 1, '2013-10-09 06:07:40'),
(5, 5, 1, '2013-10-09 12:28:42');

-- --------------------------------------------------------

--
-- Table structure for table `group_message`
--

CREATE TABLE IF NOT EXISTS `group_message` (
  `gmsgId` int(15) NOT NULL AUTO_INCREMENT,
  `messageId` int(10) NOT NULL,
  `groupId` int(10) NOT NULL,
  PRIMARY KEY (`gmsgId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `group_message`
--

INSERT INTO `group_message` (`gmsgId`, `messageId`, `groupId`) VALUES
(1, 2, 1),
(2, 3, 1),
(3, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `individual_message`
--

CREATE TABLE IF NOT EXISTS `individual_message` (
  `pmsgId` int(15) NOT NULL AUTO_INCREMENT,
  `messageId` int(10) NOT NULL,
  `contactNumber` varchar(15) NOT NULL,
  `dateSent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pmsgId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `individual_message`
--

INSERT INTO `individual_message` (`pmsgId`, `messageId`, `contactNumber`, `dateSent`) VALUES
(1, 5, '', '0000-00-00 00:00:00'),
(2, 6, '256703645800', '2013-10-09 15:30:57'),
(3, 7, '', '2013-10-09 15:52:11'),
(4, 8, '', '2013-10-09 15:55:35'),
(5, 9, '', '2013-10-09 15:55:54'),
(6, 10, '', '2013-10-09 15:56:32'),
(7, 11, '', '2013-10-09 16:00:57'),
(8, 12, '', '2013-10-09 16:01:07'),
(9, 13, '256701898263', '2013-10-09 16:30:03'),
(10, 13, '256703645800', '2013-10-09 16:30:03');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `messageId` int(15) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `sendDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `noOfReceivers` int(14) NOT NULL,
  `clientId` int(10) NOT NULL,
  PRIMARY KEY (`messageId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`messageId`, `message`, `sendDate`, `noOfReceivers`, `clientId`) VALUES
(1, 'sending', '2013-10-09 13:48:22', 1, 1),
(2, 'sending first group message', '2013-10-09 13:52:11', 1, 1),
(3, 'checking receiver count', '2013-10-09 13:54:53', 2, 1),
(4, 'I understand that long messages are composed of multiple individual SMSs and will therefore cost more credits than standard messages', '2013-10-09 14:06:28', 2, 1),
(5, 'helo ssebo', '2013-10-09 15:29:52', 1, 1),
(6, 'hello mt sir I understand that long messages are composed of multiple individual SMSs and will therefore cost more credits than standard messages', '2013-10-09 15:30:57', 1, 1),
(7, 'testing', '2013-10-09 15:52:11', 1, 1),
(8, 'testing', '2013-10-09 15:55:35', 1, 1),
(9, 'testing', '2013-10-09 15:55:54', 1, 1),
(10, 'testing', '2013-10-09 15:56:32', 1, 1),
(11, 'testing', '2013-10-09 16:00:57', 1, 1),
(12, '', '2013-10-09 16:01:07', 1, 1),
(13, 'yhelloooooo', '2013-10-09 16:30:03', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_made`
--

CREATE TABLE IF NOT EXISTS `payment_made` (
  `paymentId` int(15) NOT NULL AUTO_INCREMENT,
  `clientId` int(10) NOT NULL,
  `amount` varchar(10) NOT NULL,
  `dateOfPayment` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`paymentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`clientId`) REFERENCES `client` (`clientId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
