-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2020 at 04:56 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `book_shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `AdminID` int(11) NOT NULL AUTO_INCREMENT,
  `AdminName` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `NRC` varchar(30) NOT NULL,
  `Phone` varchar(30) NOT NULL,
  `Position` varchar(20) NOT NULL,
  `Address` varchar(50) NOT NULL,
  PRIMARY KEY (`AdminID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `AuthorID` varchar(20) NOT NULL,
  `AuthorName` varchar(50) NOT NULL,
  PRIMARY KEY (`AuthorID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`AuthorID`, `AuthorName`) VALUES
('A-000001', 'Steve'),
('authorid', 'authorname');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `BookID` varchar(20) NOT NULL,
  `BookName` varchar(50) NOT NULL,
  `AuthorName` varchar(50) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `BookImage` text NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`BookID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `CategoryID` varchar(10) NOT NULL,
  `CategoryName` varchar(20) NOT NULL,
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`) VALUES
('C-000001', 'Horror');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `CustomerID` varchar(10) NOT NULL,
  `CustomerName` varchar(20) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Address` varchar(50) NOT NULL,
  PRIMARY KEY (`CustomerID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE IF NOT EXISTS `orderdetail` (
  `OrderID` varchar(10) NOT NULL,
  `BookID` varchar(10) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `OrderID` varchar(10) NOT NULL,
  `OrderDate` date NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `TotalAmount` int(11) NOT NULL,
  `TotalQuantity` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `PaymentPlan` varchar(50) NOT NULL,
  `DeliveryOption` varchar(50) NOT NULL,
  `DeliveryPhone` varchar(50) NOT NULL,
  `DeliveryAddress` varchar(50) NOT NULL,
  PRIMARY KEY (`OrderID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE IF NOT EXISTS `publisher` (
  `PublisherID` varchar(20) NOT NULL,
  `PublisherName` varchar(50) NOT NULL,
  `PublisherDate` varchar(120) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Phone` int(20) NOT NULL,
  PRIMARY KEY (`PublisherID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE IF NOT EXISTS `purchase` (
  `PurchaseID` varchar(20) NOT NULL,
  `PurchaseDate` varchar(50) NOT NULL,
  `TotalAmount` int(11) NOT NULL,
  `TotalQuantity` int(11) NOT NULL,
  PRIMARY KEY (`PurchaseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchasedetail`
--

CREATE TABLE IF NOT EXISTS `purchasedetail` (
  `PurchaseID` varchar(10) NOT NULL,
  `BookID` varchar(10) NOT NULL,
  `TotalQuantity` int(11) NOT NULL,
  `TotalPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `StaffID` varchar(20) NOT NULL,
  `StaffName` varchar(50) NOT NULL,
  `Position` varchar(30) NOT NULL,
  PRIMARY KEY (`StaffID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `SupplierID` varchar(20) NOT NULL,
  `SupplierName` varchar(50) NOT NULL,
  PRIMARY KEY (`SupplierID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
