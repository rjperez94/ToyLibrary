-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2013 at 08:15 AM
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
-- Table structure for table `toys`
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
  PRIMARY KEY (`ToyID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `toys`
--

INSERT INTO `toys` (`ToyID`, `Toy`, `Brand`, `Dimensions`, `Category`, `Age`, `Price`, `ArriveDate`, `Gender`, `Image`) VALUES
('1G8T5610', 'LEGO Set 2012 Edition Release', 'Lego', '10x10x10', 'Building', 4.5, 1.00, '2012-10-25', 'BOTH', 'lego set 2012.jpg'),
('2HGT32W2', 'MECANNO Transformers Toyset for Kids', 'Mecanno', '15x10x8', 'Building', 7.0, 1.50, '2011-05-12', 'M', 'transformers-set.jpg'),
('BJT012', 'Figure of Eight Train Set - 43 pieces', 'Big Jigs', '', 'Building', 3.0, 1.00, '2013-05-07', 'BOTH', 'train-set.jpg'),
('E6081110', 'Megasaucer by EVENFLO', 'Evenflo', '', 'Interactive', 0.2, 0.95, '2013-05-07', 'BOTH', 'megasaucer.jpg'),
('TRIDO296', 'Dora With Handle Trike', '', '', 'Bike', 3.0, 2.00, '2013-05-07', 'F', 'dora-trike.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
