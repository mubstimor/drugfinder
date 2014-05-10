-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2014 at 10:22 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `drugfinder`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `ndaAdminId` int(10) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ndaAdminId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ndaAdminId`, `firstName`, `lastName`, `phoneNumber`, `emailAddress`, `dateAdded`) VALUES
(1, 'Timothy', 'Mubiru', '256701313574', 'mubstimor@gmail.com', '2014-03-31 10:21:24');

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE IF NOT EXISTS `admin_login` (
  `adminId` int(20) NOT NULL,
  `userName` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`adminId`, `userName`, `password`) VALUES
(1, 'mubstimor', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `clinic`
--

CREATE TABLE IF NOT EXISTS `clinic` (
  `clinicId` int(15) NOT NULL AUTO_INCREMENT,
  `clinicName` text NOT NULL,
  `clinicEmail` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `contactNumber` varchar(15) NOT NULL,
  `latitude` varchar(15) NOT NULL,
  `longitude` varchar(15) NOT NULL,
  `whoAdded` int(6) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`clinicId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `clinic`
--

INSERT INTO `clinic` (`clinicId`, `clinicName`, `clinicEmail`, `address`, `contactNumber`, `latitude`, `longitude`, `whoAdded`, `dateAdded`) VALUES
(1, 'Mutungi Clinic Kamwokya', 'mutungiclinic@gmail.com', 'Plot 64, Kanjokya Street', '256779787098', '0.03223', '32.121', 1, '2014-03-31 10:26:13'),
(2, 'Buwekula Pharmacy', 'buwekulaph@yahoo.com', 'Plot 73, Kiwafu', '256777922794', '0.0374', '33.2934', 1, '2014-04-19 04:04:55');

-- --------------------------------------------------------

--
-- Table structure for table `clinic_drug`
--

CREATE TABLE IF NOT EXISTS `clinic_drug` (
  `clinicId` int(20) NOT NULL,
  `drugId` int(10) NOT NULL,
  `dosagePrice` text NOT NULL,
  `availability` varchar(12) NOT NULL DEFAULT 'Available',
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clinic_drug`
--

INSERT INTO `clinic_drug` (`clinicId`, `drugId`, `dosagePrice`, `availability`, `dateAdded`) VALUES
(1, 1, '700 for a full dosage', 'Available', '2014-04-05 04:47:08');

-- --------------------------------------------------------

--
-- Table structure for table `clinic_login`
--

CREATE TABLE IF NOT EXISTS `clinic_login` (
  `clinicId` int(20) NOT NULL,
  `userName` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clinic_login`
--

INSERT INTO `clinic_login` (`clinicId`, `userName`, `password`) VALUES
(1, 'timoh', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'buwekula', 'dc3934fed3ec1704d320323067373b23');

-- --------------------------------------------------------

--
-- Table structure for table `drug`
--

CREATE TABLE IF NOT EXISTS `drug` (
  `drugId` int(20) NOT NULL AUTO_INCREMENT,
  `drugName` varchar(50) NOT NULL,
  `drugDescription` text NOT NULL,
  `prescription` text NOT NULL,
  `whoAdded` int(10) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`drugId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `drug`
--

INSERT INTO `drug` (`drugId`, `drugName`, `drugDescription`, `prescription`, `whoAdded`, `dateAdded`) VALUES
(1, 'Panadol', 'Its a pain killer', '1x2 for children, 2x3 for adults', 1, '2014-04-05 04:47:08');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
