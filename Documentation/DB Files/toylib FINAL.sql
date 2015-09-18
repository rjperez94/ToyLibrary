-- phpMyAdmin SQL Dump
-- version 4.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2013 at 07:42 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `toylib`
--
CREATE DATABASE IF NOT EXISTS `toylib` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `toylib`;

-- --------------------------------------------------------

--
-- Table structure for table `loaned`
--
-- Creation: May 16, 2013 at 07:37 AM
--

DROP TABLE IF EXISTS `loaned`;
CREATE TABLE IF NOT EXISTS `loaned` (
  `LoanID` smallint(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `ToyID` varchar(8) NOT NULL,
  `CustomerID` smallint(6) unsigned zerofill NOT NULL,
  `Due` date NOT NULL,
  `ReturnDay` datetime NOT NULL,
  `OutDate` datetime NOT NULL,
  PRIMARY KEY (`LoanID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- RELATIONS FOR TABLE `loaned`:
--   `CustomerID`
--       `members` -> `CustomerID`
--   `ToyID`
--       `toys` -> `ToyID`
--

--
-- Dumping data for table `loaned`
--

INSERT INTO `loaned` (`LoanID`, `ToyID`, `CustomerID`, `Due`, `ReturnDay`, `OutDate`) VALUES
(000001, '1G8T5610', 000001, '2013-10-10', '2013-06-29 16:39:46', '2013-05-02 09:00:00'),
(000002, '2HGT32W2', 000002, '2013-05-02', '2013-05-13 21:48:34', '2013-03-07 10:00:00'),
(000003, 'BJT012', 000003, '2013-04-25', '2013-05-13 00:00:00', '2013-04-18 10:00:00'),
(000004, '1G8T5610', 000006, '2013-05-30', '2013-06-29 15:25:39', '2013-05-02 10:00:00'),
(000005, 'TRIDO296', 000002, '2013-07-11', '2013-06-29 16:40:02', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--
-- Creation: May 16, 2013 at 07:38 AM
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `CustomerID` smallint(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `FName` varchar(20) NOT NULL,
  `LName` varchar(20) NOT NULL,
  `Gender` enum('M','F') NOT NULL,
  `EMail` varchar(35) NOT NULL,
  `HouseNo` varchar(7) NOT NULL,
  `Street` varchar(30) NOT NULL,
  `Suburb` varchar(15) NOT NULL,
  `City` varchar(15) NOT NULL,
  `Telephone` varchar(7) NOT NULL,
  `Mobile` varchar(10) NOT NULL,
  `Credit` decimal(5,2) NOT NULL,
  `Paid` date NOT NULL,
  `Login` varchar(16) NOT NULL,
  `Password` varchar(16) NOT NULL,
  PRIMARY KEY (`CustomerID`),
  UNIQUE KEY `Login` (`Login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`CustomerID`, `FName`, `LName`, `Gender`, `EMail`, `HouseNo`, `Street`, `Suburb`, `City`, `Telephone`, `Mobile`, `Credit`, `Paid`, `Login`, `Password`) VALUES
(000001, 'Ron', 'Perz', 'M', 'rjperez@gmail.com', '12/24', 'Tawa St', 'Tawa', 'Wellington', '2328765', '0217465243', 15.00, '2013-05-07', 'test1', 'qwertyuiop'),
(000002, 'Rick', 'Thomas', 'M', 'swag18_today@gmail.com', '39', 'The Drive', 'Tawa', 'Wellington', '2321300', '0276354987', 0.00, '2013-05-01', 'test2', 'wasdjkl'),
(000003, 'Charlie', 'Johnson', 'M', 'cjohnson@xtra.co.nz', '2A', 'Fibe St', 'Mana', 'Porirua', '5427216', '0277625413', 20.00, '2013-05-12', 'test3', 'qazwsxedc'),
(000004, 'Gary', 'Burrows', 'M', 'gburrows@hotmail.com', '37', 'The Drive', 'Tawa', 'Wellington', '2327635', '0211865354', 0.00, '2013-05-05', 'test4', 'looklivepray'),
(000006, 'Ricky', 'Martin', 'M', 'rmartin@gmail.com', '12/10', 'Silver', 'Tawa', 'Wellington', '2327898', '0217845123', 0.00, '0000-00-00', 'rmartin', 'hello'),
(000007, 'Rich', 'Eminem', 'M', 'qwerty@testy.com', '32', 'Test', 'Tawa', 'Wellington', '2342123', '0218476531', 0.00, '0000-00-00', 'rjperez', 'ilovepapa');

-- --------------------------------------------------------

--
-- Table structure for table `toys`
--
-- Creation: May 16, 2013 at 07:38 AM
--

DROP TABLE IF EXISTS `toys`;
CREATE TABLE IF NOT EXISTS `toys` (
  `ToyID` varchar(8) NOT NULL,
  `Toy` varchar(40) NOT NULL,
  `Brand` varchar(10) NOT NULL,
  `Dimensions` varchar(8) NOT NULL,
  `Category` varchar(20) NOT NULL,
  `Age` float(4,1) NOT NULL,
  `Price` decimal(5,2) NOT NULL,
  `ArriveDate` date NOT NULL,
  `Gender` enum('M','F','BOTH') NOT NULL,
  `Image` varchar(20) NOT NULL,
  `Status` enum('IN','OUT','OVERDUE','RESERVED') NOT NULL,
  PRIMARY KEY (`ToyID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `toys`
--

INSERT INTO `toys` (`ToyID`, `Toy`, `Brand`, `Dimensions`, `Category`, `Age`, `Price`, `ArriveDate`, `Gender`, `Image`, `Status`) VALUES
('1G8T5610', 'LEGO Set 2012 Edition Release', 'Lego', '10x10x10', 'Building', 4.5, 1.00, '2012-10-25', 'BOTH', 'lego set 2012.jpg', 'IN'),
('2HGT32W2', 'MECANNO Transformers Toyset for Kids', 'Mecanno', '15x10x8', 'Building', 7.0, 1.50, '2011-05-12', 'M', 'transformers-set.jpg', 'IN'),
('BJT012', 'Figure of Eight Train Set - 43 pieces', 'Big Jigs', '', 'Building', 3.0, 1.00, '2013-05-07', 'BOTH', 'train-set.jpg', 'IN'),
('E6081110', 'Megasaucer by EVENFLO', 'Evenflo', '', 'Interactive', 0.2, 0.95, '2013-05-07', 'BOTH', 'megasaucer.jpg', 'IN'),
('TRIDO296', 'Dora With Handle Trike', '', '', 'Bike', 3.0, 2.00, '2013-05-07', 'F', 'dora-trike.jpg', 'IN');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
