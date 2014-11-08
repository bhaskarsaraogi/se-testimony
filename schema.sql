-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2012 at 03:09 PM
-- Server version: 5.1.53
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `se-testimony`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_settings`
--

CREATE TABLE IF NOT EXISTS `admin_settings` (
  `idadmin_settings` int(11) NOT NULL AUTO_INCREMENT,
  `setting` varchar(50) NOT NULL,
  `value` varchar(80) NOT NULL,
  PRIMARY KEY (`idadmin_settings`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `admin_settings`
--

INSERT INTO `admin_settings` (`idadmin_settings`, `setting`, `value`) VALUES
(3, 'site_name', 'Melange 2009'),
(4, 'year', '2009');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE IF NOT EXISTS `testimonials` (
  `idtestimonials` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(10000) NOT NULL,
  `testimonial_for` int(11) NOT NULL,
  `testimonial_by` int(11) NOT NULL,
  `is_approved` int(11) NOT NULL,
  `is_public` int(11) NOT NULL,
  PRIMARY KEY (`idtestimonials`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `testimonials`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `iduser_details` int(11) NOT NULL AUTO_INCREMENT,
  `user_master_iduser_details` int(11) NOT NULL,
  `id_number` varchar(20) DEFAULT NULL,
  `name` varchar(80) DEFAULT NULL,
  `nick` varchar(80) DEFAULT NULL,
  `dob` varchar(50) DEFAULT NULL,
  `hostel` varchar(3) DEFAULT NULL,
  `roomno` int(11) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `image_name` varchar(50) DEFAULT NULL,
  `image_thumb` varchar(50) DEFAULT NULL,
  `image_path` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`iduser_details`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=152 ;

--
-- Dumping data for table `user_details`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE IF NOT EXISTS `user_master` (
  `iduser_master` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(45) DEFAULT NULL,
  `user_password` varchar(60) DEFAULT NULL,
  `user_last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`iduser_master`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user_master`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE IF NOT EXISTS `user_roles` (
  `id_user_roles` int(11) NOT NULL AUTO_INCREMENT,
  `user_master_iduser_roles` int(11) NOT NULL,
  `user_role` int(11) NOT NULL,
  PRIMARY KEY (`id_user_roles`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id_user_roles`, `user_master_iduser_roles`, `user_role`) VALUES
(1, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_verify`
--

CREATE TABLE IF NOT EXISTS `user_verify` (
  `iduser_verify` int(11) NOT NULL AUTO_INCREMENT,
  `verification_key` varchar(16) DEFAULT NULL,
  `account_verified` int(11) NOT NULL,
  `user_master_iduser_master` int(11) NOT NULL,
  PRIMARY KEY (`iduser_verify`),
  KEY `fk_user_verify_user_master` (`user_master_iduser_master`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_verify`
--

INSERT INTO `user_verify` (`iduser_verify`, `verification_key`, `account_verified`, `user_master_iduser_master`) VALUES
(1, '4d3b8d5763d18fde', 1, 6);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
