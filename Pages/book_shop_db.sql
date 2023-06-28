-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2020 at 08:31 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL,
  `AdminName` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `NRC` varchar(30) NOT NULL,
  `Phone` varchar(30) NOT NULL,
  `Position` varchar(20) NOT NULL,
  `Address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `AdminName`, `Email`, `Password`, `NRC`, `Phone`, `Position`, `Address`) VALUES
(2, 'Kadae Aung', 'ka@gmail.com', 'ka', '12/sfsf(N)342525', '32535353', 'Admin', 'yangon ');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `AuthorID` varchar(20) NOT NULL,
  `AuthorName` varchar(50) NOT NULL
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

CREATE TABLE `book` (
  `BookID` varchar(20) NOT NULL,
  `BookName` varchar(50) NOT NULL,
  `AuthorID` varchar(50) NOT NULL,
  `CategoryID` varchar(50) NOT NULL,
  `PublisherID` varchar(20) NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `BookImage` text NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`BookID`, `BookName`, `AuthorID`, `CategoryID`, `PublisherID`, `Price`, `Quantity`, `BookImage`, `Description`) VALUES
('B-000001', 'fsfsf', '', '', '', 34535, 324, '71BtngErC6L._SY355_.png', 'sfsfs'),
('B-000002', 'sdgfdsf', '', '', '', 4646, 34, '71BtngErC6L._SY355_.png', 'dyte'),
('B-000003', 'dfgdg', 'A-000001', 'C-000001', '', 23, 3, 'asset.jpeg', 'sfsf'),
('B-000004', 'sfsf', 'A-000001', 'C-000001', 'P-000001', 343, 243, 'asset.jpeg', 'sfsf'),
('B-000005', 'dgdg', 'A-000001', 'C-000001', 'P-000001', 3434, 33, 'Images/book1.jpg', 'dgdg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` varchar(10) NOT NULL,
  `CategoryName` varchar(20) NOT NULL
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

CREATE TABLE `customer` (
  `CustomerID` varchar(10) NOT NULL,
  `CustomerName` varchar(20) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `CustomerName`, `Email`, `Password`, `Phone`, `Address`) VALUES
('C-000001', 'sdgsg', 'sfsf@fhfh', 'sfsf', 'sfsf', 'sf');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `OrderID` varchar(10) NOT NULL,
  `BookID` varchar(10) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` varchar(10) NOT NULL,
  `OrderDate` date NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `TotalAmount` int(11) NOT NULL,
  `TotalQuantity` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `PaymentPlan` varchar(50) NOT NULL,
  `DeliveryOption` varchar(50) NOT NULL,
  `DeliveryPhone` varchar(50) NOT NULL,
  `DeliveryAddress` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `PublisherID` varchar(20) NOT NULL,
  `PublisherName` varchar(50) NOT NULL,
  `PublisherDate` varchar(120) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Phone` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`PublisherID`, `PublisherName`, `PublisherDate`, `Address`, `Email`, `Phone`) VALUES
('P-000001', 'su su', 'txtpublisherdate', 'txtaddress', 'txtemal', '0');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `PurchaseID` varchar(20) NOT NULL,
  `PurchaseDate` varchar(50) NOT NULL,
  `TotalAmount` int(11) NOT NULL,
  `TotalQuantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchasedetail`
--

CREATE TABLE `purchasedetail` (
  `PurchaseID` varchar(10) NOT NULL,
  `BookID` varchar(10) NOT NULL,
  `TotalQuantity` int(11) NOT NULL,
  `TotalPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `SupplierID` varchar(20) NOT NULL,
  `SupplierName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`AuthorID`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`BookID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`PublisherID`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`PurchaseID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`SupplierID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
