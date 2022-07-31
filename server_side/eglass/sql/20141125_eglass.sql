-- phpMyAdmin SQL Dump
-- version 3.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 25, 2014 at 05:52 PM
-- Server version: 5.6.14
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eglass`
--

-- --------------------------------------------------------

--
-- Table structure for table `settingsconfig`
--

CREATE TABLE IF NOT EXISTS `settingsconfig` (
  `sc_id` int(10) NOT NULL AUTO_INCREMENT,
  `sc_site_title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `sc_last_updated` datetime NOT NULL,
  PRIMARY KEY (`sc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settingsconfig`
--

INSERT INTO `settingsconfig` (`sc_id`, `sc_site_title`, `sc_last_updated`) VALUES
(1, 'eGlass', '2013-03-10 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sysuser`
--

CREATE TABLE IF NOT EXISTS `sysuser` (
  `sysuser_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `sysuser_login` varchar(50) NOT NULL,
  `sysuser_password` varchar(50) DEFAULT NULL,
  `sysuser_role` bigint(10) DEFAULT '1',
  `sysuser_email` varchar(50) DEFAULT NULL,
  `sysuser_secretques_id` bigint(5) NOT NULL DEFAULT '0',
  `sysuser_secretans` varchar(255) DEFAULT NULL,
  `sysuser_failurecount` int(5) NOT NULL DEFAULT '0',
  `sysuser_lasttry_date` timestamp NULL DEFAULT NULL,
  `sysuser_status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  `is_validated` enum('yes','no') NOT NULL DEFAULT 'no',
  `confirmation_code` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`sysuser_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sysuser`
--

INSERT INTO `sysuser` (`sysuser_id`, `sysuser_login`, `sysuser_password`, `sysuser_role`, `sysuser_email`, `sysuser_secretques_id`, `sysuser_secretans`, `sysuser_failurecount`, `sysuser_lasttry_date`, `sysuser_status`, `created_date`, `updated_date`, `is_deleted`, `is_validated`, `confirmation_code`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'admin@test.com', 0, NULL, 0, '2013-12-06 01:41:57', 'active', '2013-12-05 06:00:00', '2014-02-17 21:41:51', 'no', 'yes', 'asdfasdf');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
