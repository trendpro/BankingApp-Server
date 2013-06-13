-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 06, 2012 at 09:53 AM
-- Server version: 5.5.24
-- PHP Version: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `equityserverdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE IF NOT EXISTS `administrators` (
  `Username` varchar(50) NOT NULL,
  `National_ID_No` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`Username`, `National_ID_No`, `Password`, `Name`) VALUES
('Admin', '28581269', 'pass', 'Gideon Kitili'),
('Amir', '28591268', 'pass', 'Admin Amir');

-- --------------------------------------------------------

--
-- Table structure for table `adverts`
--

CREATE TABLE IF NOT EXISTS `adverts` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `Advert` varchar(100) NOT NULL,
  `Ad_URL` varchar(100) NOT NULL,
  `ad_category` varchar(50) NOT NULL,
  PRIMARY KEY (`ad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `adverts`
--

INSERT INTO `adverts` (`ad_id`, `Advert`, `Ad_URL`, `ad_category`) VALUES
(1, 'Apply for wakulima loan now!', 'http://equitybank.co.ke/cat/loans', 'g'),
(2, 'Just another ad', 'no_url', '1a'),
(3, 'Wanawake financial schemes', 'http://equity.co.ke/?=ytyuuedhf74846ddhchdyr', '2a'),
(4, 'Student loans', 'no_url', 'g'),
(5, 'Start ups financing', 'http://equity.ck.ke/corporate', 'g'),
(6, 'My not unique ad', 'http://equity.co.ug', '3a');

-- --------------------------------------------------------

--
-- Table structure for table `all_share_listings`
--

CREATE TABLE IF NOT EXISTS `all_share_listings` (
  `Share_Listing_ID` int(10) NOT NULL AUTO_INCREMENT,
  `Company_Name` varchar(50) NOT NULL,
  `Category` varchar(20) NOT NULL,
  `Last_Traded_Price` double(12,2) NOT NULL,
  `Previous_Price` double(12,2) NOT NULL,
  `Change` double(12,2) NOT NULL,
  PRIMARY KEY (`Share_Listing_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `all_share_listings`
--

INSERT INTO `all_share_listings` (`Share_Listing_ID`, `Company_Name`, `Category`, `Last_Traded_Price`, `Previous_Price`, `Change`) VALUES
(1, 'Toonga, Inc.', 'Software', 128.90, 128.67, 1.23),
(2, 'Google,Inc.', 'Software', 67.89, 76.90, -19.98),
(3, 'Facebook,Inc', 'Software', 58.90, 75.89, -656.98),
(4, 'Microsoft Corp.', 'Software', 127.89, 123.89, 2.87),
(5, 'Safricom Ltd', 'Telecom', 123.45, 564.89, 1.90),
(6, 'Cannonical', 'Other', 127.89, 123.89, 1.67),
(7, 'Sony, Inc', 'Entertainment', 123.45, 75.89, 1.68),
(8, 'Nation Media', 'Media', 123.87, 135.90, 2.34),
(9, 'D & G,Inc', 'Fashion', 78.99, 78.67, 4.40),
(10, 'AT & T', 'Telecom', 67.89, 68.09, 4.89),
(11, 'Sasini Tea, ltd', 'Food', 67.95, 57.90, 5.40),
(12, 'East African Breweries', 'Food', 67.98, 68.89, 5.34),
(13, 'Nokia Inc', 'Software', 95.78, 97.45, 3.07),
(14, 'SamSung', 'Telecom', 86.50, 85.45, -4.51);

-- --------------------------------------------------------

--
-- Table structure for table `exchange_rates`
--

CREATE TABLE IF NOT EXISTS `exchange_rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Currency` varchar(20) NOT NULL,
  `Buying_Rate` double(20,2) NOT NULL,
  `Selling_Rate` double(20,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `exchange_rates`
--

INSERT INTO `exchange_rates` (`id`, `Currency`, `Buying_Rate`, `Selling_Rate`) VALUES
(1, 'USD', 84.78, 85.98),
(2, 'Canadian $', 76.98, 78.89),
(3, 'TZ SH', 23.89, 34.54),
(4, 'UG SH', 54.78, 54.78),
(5, 'SA Rand', 56.87, 56.89),
(6, 'Indian Rupee', 56.89, 56.89),
(7, 'GBP', 120.89, 120.00),
(8, 'Duesch', 78.09, 78.90),
(9, 'Franc', 67.98, 67.89),
(10, 'Yen', 56.89, 57.09),
(11, 'Aus Dollar', 57.90, 60.00),
(12, 'New ZL Dollar', 78.90, 87.90);

-- --------------------------------------------------------

--
-- Table structure for table `fixed_deposit_rates`
--

CREATE TABLE IF NOT EXISTS `fixed_deposit_rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Range_From` int(20) NOT NULL,
  `Range_To` int(20) NOT NULL,
  `One_Month_Pa` decimal(10,2) NOT NULL,
  `Three_Month_Pa` double(10,2) NOT NULL,
  `Six_Month_Pa` decimal(10,2) NOT NULL,
  `One_Year_Pa` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `fixed_deposit_rates`
--

INSERT INTO `fixed_deposit_rates` (`id`, `Range_From`, `Range_To`, `One_Month_Pa`, `Three_Month_Pa`, `Six_Month_Pa`, `One_Year_Pa`) VALUES
(1, 0, 500000, 2.45, 2.34, 4.34, 3.22),
(2, 500000, 750000, 3.22, 3.22, 3.22, 3.22),
(3, 750000, 1000000, 3.22, 3.22, 3.22, 3.22),
(4, 1000000, 1500000, 3.22, 3.22, 3.22, 3.22),
(5, 1500000, 1750000, 3.22, 3.22, 3.22, 3.22),
(6, 1750000, 2000000, 3.22, 3.22, 3.22, 3.22),
(7, 2000000, 2500000, 3.22, 3.22, 3.22, 3.22),
(8, 2500000, 3000000, 3.22, 3.22, 3.22, 3.22);

-- --------------------------------------------------------

--
-- Table structure for table `my_portfolio`
--

CREATE TABLE IF NOT EXISTS `my_portfolio` (
  `Portfolio_ID` int(10) NOT NULL AUTO_INCREMENT,
  `Share_Listing_ID` varchar(10) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `No_Of_Shares` int(20) NOT NULL,
  `Company_Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Portfolio_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `my_portfolio`
--

INSERT INTO `my_portfolio` (`Portfolio_ID`, `Share_Listing_ID`, `Email`, `No_Of_Shares`, `Company_Name`) VALUES
(10, '1', 'n@gmail.com', 2000, '1'),
(11, '2', 'n@gmail.com', 2000, '1'),
(12, '3', 'n@gmail.com', 2000, '1'),
(13, '4', 'n@gmail.com', 2000, '1'),
(14, '5', 'n@gmail.com', 2000, '1'),
(15, '6', 'n@gmail.com', 2000, '1'),
(16, '7', 'n@gmail.com', 2000, '1'),
(17, '8', 'n@gmail.com', 2000, '1'),
(18, '9', 'n@gmail.com', 2000, '1'),
(19, '10', 'n@gmail.com', 2000, '1');

-- --------------------------------------------------------

--
-- Table structure for table `my_watchlist`
--

CREATE TABLE IF NOT EXISTS `my_watchlist` (
  `Watchlist_ID` int(10) NOT NULL AUTO_INCREMENT,
  `Share_Listing_ID` varchar(20) NOT NULL,
  `Email` varchar(20) NOT NULL,
  PRIMARY KEY (`Watchlist_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `my_watchlist`
--

INSERT INTO `my_watchlist` (`Watchlist_ID`, `Share_Listing_ID`, `Email`) VALUES
(1, '1', 'n@gmail.com'),
(2, '2', 'n@gmail.com'),
(3, '3', 'n@gmail.com'),
(4, '4', 'n@gmail.com'),
(5, '5', 'n@gmail.com'),
(6, '6', 'n@gmail.com'),
(7, '7', 'n@gmail.com'),
(8, '8', 'n@gmail.com'),
(9, '9', 'n@gmail.com'),
(10, '10', 'n@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users_android`
--

CREATE TABLE IF NOT EXISTS `users_android` (
  `Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Date_Of_Birth` date NOT NULL,
  `Gender` varchar(10) NOT NULL,
  PRIMARY KEY (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_android`
--

INSERT INTO `users_android` (`Name`, `Email`, `Password`, `Date_Of_Birth`, `Gender`) VALUES
('Gideon', 'n@gmail.com', 'pass', '1990-10-05', 'Male');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
