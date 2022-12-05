-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 02, 2022 at 07:33 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_message`
--

DROP TABLE IF EXISTS `admin_message`;
CREATE TABLE IF NOT EXISTS `admin_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_message`
--

INSERT INTO `admin_message` (`id`, `name`, `email`, `message`) VALUES
(1, 'Amolak Rathod', 'amolakrathod472002@gmail.com', '\r\n        \r\n\r\n\r\n\r\n      sorry not available');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

DROP TABLE IF EXISTS `form`;
CREATE TABLE IF NOT EXISTS `form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `textdata` varchar(100) NOT NULL,
  `date` varchar(10) NOT NULL,
  `status` varchar(1) NOT NULL,
  `typecat` varchar(30) NOT NULL,
  `price` int(10) NOT NULL,
  `b_Cancel_Request` int(1) NOT NULL,
  `payment_orderid` varchar(30) NOT NULL,
  `payment_status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id`, `user_id`, `firstname`, `lastname`, `email`, `textdata`, `date`, `status`, `typecat`, `price`, `b_Cancel_Request`, `payment_orderid`, `payment_status`) VALUES
(18, 6, 'Amolak', 'Rathod', 'xyz12@gmail.com', '              Mohen Greenwwods \r\n\r\n\r\n', '', 'Y', '', 1236, 0, 'order_181122022', 1),
(19, 6, 'Amolak', 'Rathod', 'xyz12@gmail.com', '              Mohen Greenwwods \r\n\r\n\r\n', '', 'Y', '', 700, 1, 'order_191122022', 1),
(20, 6, 'Amolak', 'Rathod', 'xyz12@gmail.com', '              Mohen Greenwwods \r\n\r\n\r\n', '', 'Y', '', 987, 0, '', 0),
(21, 6, 'Amolak', 'Rathod', 'xyz12@gmail.com', '              Mohen Greenwwods \r\n\r\n\r\n', '', 'Y', '', 0, 0, '', 0),
(26, 6, 'AMOLAK', 'RATHOD', 'xyz12@gmail.com', '              Power House Health Club \r\n\r\n\r\n', '', 'Y', '', 0, 0, '', 0),
(32, 6, 'Amolak', 'Rathod', 'xyz12@gmail.com', '              Rainy Resort and Water Park \r\n\r\n\r\n', '', 'Y', '', 0, 0, '', 0),
(33, 6, 'Amolak', 'Rathod', 'xyz12@gmail.com', '              Rainy Resort and Water Park \r\n\r\n\r\n', '', 'Y', '', 0, 0, '', 0),
(36, 6, 'Amolak', 'Rathod', 'xyz12@gmail.com', '              Unique Looks \r\n\r\n\r\n', '', 'Y', 'One Time service', 0, 0, '', 0),
(35, 6, 'Amolak', 'Rathod', 'xyz12@gmail.com', '              Rainy Resort and Water Park \r\n\r\n\r\n', '', 'Y', 'Monthly service', 0, 0, '', 0),
(37, 6, 'Amolak', 'Rathod', 'xyz12@gmail.com', '              Unique Looks \r\n\r\n\r\n', '', 'Y', 'One Time service', 0, 0, '', 0),
(38, 2, 'ramjan', 'Rathod', 'amolak@gmail.com', '              AUTHENTIC HARDCORE GYM \r\n\r\n\r\n', '', 'N', 'Monthly service', 300, 1, 'order_191122022', 1);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(2, 'amolak', 'amolak@gmail.com', '4c56ff4ce4aaf9573aa5dff913df997a', 'user'),
(3, 'myself', 'ram@gmail.com', '4c56ff4ce4aaf9573aa5dff913df997a', 'user'),
(4, 'XYZ', 'xyz@gmail.com', '4c56ff4ce4aaf9573aa5dff913df997a', 'admin'),
(5, 'amolak', 'amolak123@gmail.com', '4c56ff4ce4aaf9573aa5dff913df997a', 'user'),
(6, 'abc xyz', 'xyz12@gmail.com', '4c56ff4ce4aaf9573aa5dff913df997a', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
