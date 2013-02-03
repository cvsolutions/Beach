-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Feb 02, 2013 alle 16:18
-- Versione del server: 5.5.25
-- Versione PHP: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `beach`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `beach_auth`
--

CREATE TABLE `beach_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `usermail` varchar(25) NOT NULL,
  `pwd` varchar(25) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `latitude` decimal(10,2) NOT NULL,
  `longitude` decimal(10,2) NOT NULL,
  `umbrellas` int(11) NOT NULL,
  `rows` int(11) NOT NULL,
  `language` int(11) NOT NULL,
  `policy` text NOT NULL,
  `entry` datetime NOT NULL,
  `role` varchar(10) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `beach_calendar`
--

CREATE TABLE `beach_calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(25) NOT NULL,
  `auth` int(11) NOT NULL,
  `umbrella` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `full_date` date NOT NULL,
  `availability` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `price_bed` decimal(10,2) NOT NULL,
  `publication` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `beach_facility`
--

CREATE TABLE `beach_facility` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `auth` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `beach_offers`
--

CREATE TABLE `beach_offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(255) NOT NULL,
  `auth` int(11) NOT NULL,
  `publication` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `beach_reservations`
--

CREATE TABLE `beach_reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reservation` varchar(255) NOT NULL,
  `code` varchar(25) NOT NULL,
  `auth` int(11) NOT NULL,
  `arrival` date NOT NULL,
  `departure` date NOT NULL,
  `customer` varchar(255) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `information` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` int(11) NOT NULL,
  `ip_address` varchar(25) NOT NULL,
  `entry` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `beach_story_reservations`
--

CREATE TABLE `beach_story_reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reservation` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `umbrella` varchar(255) NOT NULL,
  `facility` varchar(255) NOT NULL,
  `bed` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
