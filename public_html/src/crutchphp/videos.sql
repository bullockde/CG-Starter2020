-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Oct 26, 2016 at 01:44 AM
-- Server version: 5.1.73-cll
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `taconycd_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
      `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
      `title` varchar(255) DEFAULT NULL,
      `location` varchar(255) DEFAULT NULL,
      `duration` varchar(255) DEFAULT NULL,
      `created` DATETIME on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
      `heading` varchar(200) DEFAULT NULL,
      `excerpt` varchar(250) DEFAULT NULL,
      `content` varchar(800) DEFAULT NULL,
      `overlay` int(11) NULL DEFAULT '1',
      `button_text` varchar(200) DEFAULT NULL,
      `button_link` varchar(200) DEFAULT NULL,
      `widget` varchar(500) DEFAULT NULL,
      `priority` int(11) NULL DEFAULT '0',
      `board_id` int(11) NULL DEFAULT '0'
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
