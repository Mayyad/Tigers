-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 21, 2016 at 12:03 AM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cafeteria_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories_tb`
--

CREATE TABLE IF NOT EXISTS `categories_tb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `categories_tb`
--

INSERT INTO `categories_tb` (`id`, `name`, `status`) VALUES
(1, 'Hot Drinks', 1),
(2, 'Cold Drinks', 1);

-- --------------------------------------------------------

--
-- Table structure for table `check_tb`
--

CREATE TABLE IF NOT EXISTS `check_tb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` int(1) NOT NULL,
  `total_price` int(10) NOT NULL,
  `roomNo` int(5) NOT NULL,
  `time` varchar(12) NOT NULL,
  `notice` varchar(255) NOT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `orders_tb`
--

CREATE TABLE IF NOT EXISTS `orders_tb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `check_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `amount` int(5) NOT NULL,
  `totalPrice` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `products_tb`
--

CREATE TABLE IF NOT EXISTS `products_tb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` int(5) NOT NULL,
  `status` int(1) NOT NULL,
  `prod_pic` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `cat_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `products_tb`
--

INSERT INTO `products_tb` (`id`, `name`, `price`, `status`, `prod_pic`, `cat_id`) VALUES
(1, 'Tea', 5, 1, '3.jpg', 1),
(2, 'Orange', 10, 1, '1.jpg', 2),
(3, 'coffee', 7, 1, '4.jpg', 1),
(4, 'Coktil', 15, 0, '2.jpg', 2),
(6, 'yanson', 220, 1, '1455874719_3.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rooms_tb`
--

CREATE TABLE IF NOT EXISTS `rooms_tb` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `rooms_tb`
--

INSERT INTO `rooms_tb` (`id`, `name`, `status`) VALUES
(1, '1001', 1),
(3, '1010', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_tb`
--

CREATE TABLE IF NOT EXISTS `users_tb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `roomNo` int(5) NOT NULL,
  `ext` int(10) NOT NULL,
  `pic_path` varchar(255) NOT NULL,
  `type` int(1) NOT NULL,
  `secret` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users_tb`
--

INSERT INTO `users_tb` (`id`, `name`, `pass`, `mail`, `roomNo`, `ext`, `pic_path`, `type`, `secret`) VALUES
(1, 'Mina', '202cb962ac59075b964b07152d234b70', 'eng.mina23@gmail.com', 1, 2257172, '1.png', 1, 'mina'),
(2, 'M.Ayad', '202cb962ac59075b964b07152d234b70', 'ayad@gmail.com', 3, 2215487, '2.png', 2, 'ahmed'),
(3, 'Blocked User', '202cb962ac59075b964b07152d234b70', 'block@gmail.com', 1, 1000367976, '3.png', 3, 'mohamed');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
