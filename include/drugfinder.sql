-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2014 at 02:13 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `adminId` int(10) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `category` varchar(10) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`adminId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `firstName`, `lastName`, `phoneNumber`, `emailAddress`, `category`, `dateAdded`) VALUES
(1, 'Timothy', 'Mubiru', '256701313574', 'mubstimor@gmail.com', 'NDA', '2014-03-31 10:21:24'),
(2, 'Willy', 'Chongomweru', '256779787092', 'willychongs@yahoo.com', 'NMS', '2014-05-10 05:04:44');

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
(1, 'mubstimor', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'willy', '81dc9bdb52d04dc20036dbd8313ed055');

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
  `license` varchar(15) NOT NULL DEFAULT 'Valid',
  `whoAdded` int(6) NOT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`clinicId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `clinic`
--

INSERT INTO `clinic` (`clinicId`, `clinicName`, `clinicEmail`, `address`, `contactNumber`, `latitude`, `longitude`, `license`, `whoAdded`, `dateAdded`) VALUES
(1, 'Mutungi Clinic Kamwokya', 'mutungiclinic@gmail.com', 'Plot 64, Kanjokya Street', '256779787098', '0.03223', '32.121', 'Valid', 1, '2014-03-31 10:26:13'),
(2, 'Buwekula Pharmacy', 'buwekulaph@yahoo.com', 'Plot 73, Kiwafu', '256777922794', '0.0374', '33.2934', 'Valid', 1, '2014-04-19 04:04:55'),
(3, 'First Pharmacy', 'first-pharmacy@gmail.com', 'Wandegeya, Makerere', '256778901294', '33.02342', '0.43122', 'Valid', 1, '2014-05-11 11:57:37');

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
(1, 1, '   800 for full dosage   ', 'Available', '2014-05-04 05:22:20');

-- --------------------------------------------------------

--
-- Table structure for table `clinic_license`
--

CREATE TABLE IF NOT EXISTS `clinic_license` (
  `clinicId` int(10) NOT NULL,
  `startDate` varchar(16) NOT NULL,
  `endDate` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clinic_license`
--

INSERT INTO `clinic_license` (`clinicId`, `startDate`, `endDate`) VALUES
(1, '2013-03-17', '2015-03-17'),
(2, '2014-02-17', '2015-04-10'),
(3, '05/11/2014', '05/11/2015');

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
(2, 'buwekula', 'dc3934fed3ec1704d320323067373b23'),
(3, 'wakula', '4f85042787a396b7cc617c914246a075');

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
(1, 'Panadol', 'Its a pain killer & reliever', '1x2 for children, 2x3 for adults', 1, '2014-04-05 04:47:08');

-- --------------------------------------------------------

--
-- Table structure for table `drug_distribution`
--

CREATE TABLE IF NOT EXISTS `drug_distribution` (
  `distributionId` int(10) NOT NULL AUTO_INCREMENT,
  `drugId` int(14) NOT NULL,
  `serialNumber` varchar(30) NOT NULL,
  `clinicId` int(10) NOT NULL,
  `carton_quantity` int(15) NOT NULL,
  PRIMARY KEY (`distributionId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `drug_distribution`
--

INSERT INTO `drug_distribution` (`distributionId`, `drugId`, `serialNumber`, `clinicId`, `carton_quantity`) VALUES
(1, 1, 'hceuerhjvktrer', 2, 30),
(2, 1, 'hceuerhjvktrer', 1, 50);

-- --------------------------------------------------------

--
-- Table structure for table `drug_stock`
--

CREATE TABLE IF NOT EXISTS `drug_stock` (
  `drugId` int(13) NOT NULL,
  `serialNumber` varchar(30) NOT NULL,
  `expiryDate` varchar(16) NOT NULL,
  `carton_quantity` int(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drug_stock`
--

INSERT INTO `drug_stock` (`drugId`, `serialNumber`, `expiryDate`, `carton_quantity`) VALUES
(1, 'hceuerhjvktrer', '2015-09-23', 250);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
