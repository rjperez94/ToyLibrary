-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2013 at 09:22 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `toylib`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
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
  PRIMARY KEY (`CustomerID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`CustomerID`, `FName`, `LName`, `Gender`, `EMail`, `HouseNo`, `Street`, `Suburb`, `City`, `Telephone`, `Mobile`, `Credit`, `Paid`, `Login`, `Password`) VALUES
(000001, 'Ron', 'Perz', 'M', 'rjperez@gmail.com', '12/24', 'Tawa St', 'Tawa', 'Wellington', '2328765', '0217465243', 15.00, '2013-05-07', '', 'qwertyuiop'),
(000002, 'Rick', 'Thomas', 'M', 'swag18_today@gmail.com', '39', 'The Drive', 'Tawa', 'Wellington', '2321300', '0276354987', 0.00, '2013-05-01', '', 'wasdjkl'),
(000003, 'Charlie', 'Johnson', 'M', 'cjohnson@xtra.co.nz', '2A', 'Fibe St', 'Mana', 'Porirua', '5427216', '0277625413', 20.00, '2013-05-12', '', 'qazwsxedc'),
(000004, 'Gary', 'Burrows', 'M', 'gburrows@hotmail.com', '37', 'The Drive', 'Tawa', 'Wellington', '2327635', '0211865354', 0.00, '2013-05-05', '', 'looklivepray'),
(000006, 'Ricky', 'Martin', 'M', 'rmartin@gmail.com', '12/10', 'Silver', 'Tawa', 'Wellington', '2327898', '0217845123', 0.00, '0000-00-00', 'rmartin', 'hello');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
