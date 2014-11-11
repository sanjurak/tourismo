-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 11, 2014 at 05:30 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tourismo`
--

-- --------------------------------------------------------

--
-- Table structure for table `excursion_payments`
--

CREATE TABLE IF NOT EXISTS `excursion_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `passanger_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `exchange_rate` decimal(7,2) NOT NULL,
  `amount_din` decimal(11,2) DEFAULT NULL,
  `amount_eur_din` decimal(11,2) DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `passanger_id` (`passanger_id`),
  KEY `reservation_id` (`reservation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `excursion_payments`
--

INSERT INTO `excursion_payments` (`id`, `passanger_id`, `reservation_id`, `date`, `exchange_rate`, `amount_din`, `amount_eur_din`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 223, 265, '2014-11-11', '121.56', '0.00', '2431.20', '', 1, '2014-11-11 17:03:40', '2014-11-11 17:03:40');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `excursion_payments`
--
ALTER TABLE `excursion_payments`
  ADD CONSTRAINT `exc_paym_rsrv_id` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`),
  ADD CONSTRAINT `exc_paym_psg_id` FOREIGN KEY (`passanger_id`) REFERENCES `passanger` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
