-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 02, 2017 at 10:17 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `KTownCarShareDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `Cars`
--

CREATE TABLE `Cars` (
  `VIN` int(11) NOT NULL,
  `make` varchar(50) NOT NULL,
  `model` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dailyFee` decimal(7,2) NOT NULL,
  `carCondition` enum('damaged','normal','not running') NOT NULL,
  `imageLink` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Cars`
--

INSERT INTO `Cars` (`VIN`, `make`, `model`, `year`, `address`, `dailyFee`, `carCondition`, `imageLink`) VALUES
(3420, 'Hyundai', 'Sonata', 2010, '100 John Counter Blvd.', '200.00', 'normal', 'img/car.png'),
(10123, 'Toyota', 'Camry', 2016, '25 Union St.', '250.00', 'normal', 'img/booking.png');

-- --------------------------------------------------------

--
-- Table structure for table `KTCSMembers`
--

CREATE TABLE `KTCSMembers` (
  `memberNum` int(11) NOT NULL,
  `memberName` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `licenseNum` varchar(13) NOT NULL,
  `membershipFee` decimal(5,2) NOT NULL,
  `creditCardNumber` char(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `KTCSMembers`
--

INSERT INTO `KTCSMembers` (`memberNum`, `memberName`, `password`, `address`, `email`, `licenseNum`, `membershipFee`, `creditCardNumber`) VALUES
(1, 'Vinith Suriyakumar', 'qthrive', 'Blah', 'suriyaku@gmail.com', '3213', '500.25', '0000000000000'),
(2, 'Christina Yan', 'swiss', '', 'tyanners96@hotmail.com', '1234567890', '0.00', '1111111111111111'),
(3, 'Ramy H Ayash', 'roast', 'Dundas Street West', 'wheelin@hotmail.com', '7839293028', '500.00', '1010101010101010');

-- --------------------------------------------------------

--
-- Table structure for table `ParkingLocations`
--

CREATE TABLE `ParkingLocations` (
  `address` varchar(255) NOT NULL,
  `numSpaces` int(11) NOT NULL,
  `imageLink` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ParkingLocations`
--

INSERT INTO `ParkingLocations` (`address`, `numSpaces`, `imageLink`) VALUES
('25 Lower Union Street', 24, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Cars`
--
ALTER TABLE `Cars`
  ADD PRIMARY KEY (`VIN`);

--
-- Indexes for table `KTCSMembers`
--
ALTER TABLE `KTCSMembers`
  ADD PRIMARY KEY (`memberNum`);

--
-- Indexes for table `ParkingLocations`
--
ALTER TABLE `ParkingLocations`
  ADD PRIMARY KEY (`address`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `KTCSMembers`
--
ALTER TABLE `KTCSMembers`
  MODIFY `memberNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
