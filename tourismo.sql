-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 24, 2014 at 12:21 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tourismo`
--
CREATE DATABASE IF NOT EXISTS `tourismo` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `tourismo`;

-- --------------------------------------------------------

--
-- Table structure for table `accomodations`
--

CREATE TABLE IF NOT EXISTS `accomodations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `destination_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dst_id_ind` (`destination_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `accomodations`
--

INSERT INTO `accomodations` (`id`, `type`, `name`, `destination_id`, `created_at`, `updated_at`) VALUES
(1, 'hotel', 'Adonis', 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Apartman', 'Villa Maria', 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Villa', 'Madrid', 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `accomodation_units`
--

CREATE TABLE IF NOT EXISTS `accomodation_units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'soba',
  `capacity` int(2) NOT NULL,
  `number` int(3) NOT NULL,
  `accommodations_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `accommodations_id` (`accommodations_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `current` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `current`, `created_at`, `updated_at`) VALUES
(1, 'Leto 2014', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Uskrs 2014', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Prvi maj 2014', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE IF NOT EXISTS `destinations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `town` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id`, `country`, `town`, `description`, `updated_at`, `created_at`) VALUES
(4, 'Grčka', 'Lefkada', 'Lefkada island', '2014-03-23 20:34:43', '0000-00-00 00:00:00'),
(5, 'Italija', 'Firenca', 'The city of Florence is bla bla bla', '2014-03-21 23:53:49', '0000-00-00 00:00:00'),
(6, 'Španija', 'Malaga', 'Malaga is bla bla bla', '2014-03-22 11:14:41', '0000-00-00 00:00:00'),
(7, 'Nemacka', 'Berlin', 'Opis  Nemacke i Berlina', '2014-03-23 13:43:49', '2014-03-22 23:40:57'),
(8, 'Francuska', 'Avinjon', 'Vinogradi, dvorci i ostali', '2014-03-23 13:42:27', '2014-03-22 23:43:19');

-- --------------------------------------------------------

--
-- Table structure for table `organizers`
--

CREATE TABLE IF NOT EXISTS `organizers` (
  `pib` int(9) NOT NULL,
  `mat_br` char(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `web` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`pib`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `organizers`
--

INSERT INTO `organizers` (`pib`, `mat_br`, `name`, `email`, `address`, `phone`, `web`, `created_at`, `updated_at`) VALUES
(112233445, '', 'Oktopod tours', 'oktopod@tours.com', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123456789, '123456789876', 'Rapsody Travel', 'rapsody@travel.com', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(314263746, '', 'Argus Tours', 'argus@tours.com', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `passanger`
--

CREATE TABLE IF NOT EXISTS `passanger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `gender` set('m','f') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'm',
  `address` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mob` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport` char(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `passanger`
--

INSERT INTO `passanger` (`id`, `name`, `surname`, `gender`, `address`, `tel`, `mob`, `passport`, `birth_date`, `created_at`, `updated_at`) VALUES
(1, 'Sanja', 'Bogdanovic', 'f', 'Somborska', '1234567', '1234567', '123444', '0000-00-00', '2014-03-23 20:38:05', '2014-03-23 20:38:05');

-- --------------------------------------------------------

--
-- Table structure for table `passangers`
--

CREATE TABLE IF NOT EXISTS `passangers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `passanger_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pass_rsrv_id_ind` (`reservation_id`),
  KEY `pass_id_ind` (`passanger_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL DEFAULT '0',
  `payment_type` set('kes','cek','kartica','virman') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'kes',
  `card_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `passanger_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `exchange_rate` decimal(7,2) NOT NULL,
  `amount_din` decimal(11,2) DEFAULT NULL,
  `amount_eur_din` decimal(11,2) DEFAULT NULL,
  `payment_method` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `fiscal_slip` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reservation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `travel_date` date NOT NULL,
  `nights_num` int(2) NOT NULL,
  `passanger_id` int(11) NOT NULL,
  `price_total_din` decimal(12,2) DEFAULT NULL,
  `price_total_eur` decimal(12,2) DEFAULT NULL,
  `discount` decimal(12,2) DEFAULT NULL,
  `discounter_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clock_index` int(2) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `note_internal` text COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rsrv_pass_id_ind` (`passanger_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `travel_deals`
--

CREATE TABLE IF NOT EXISTS `travel_deals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `organizer_id` int(9) NOT NULL,
  `destination_id` int(11) NOT NULL,
  `accomodation_id` int(11) NOT NULL,
  `transportation` set('bus','avio','voz','sopstveni','brod') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'bus',
  `service` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `price_din` decimal(11,2) DEFAULT NULL,
  `price_eur` decimal(11,2) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `travel_deal_cat_id_ind` (`category_id`),
  KEY `travel_deal_org_id_ind` (`organizer_id`),
  KEY `travel_deal_dest_id_ind` (`destination_id`),
  KEY `travel_deal_accom_id_ind` (`accomodation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `travel_deals`
--

INSERT INTO `travel_deals` (`id`, `category_id`, `organizer_id`, `destination_id`, `accomodation_id`, `transportation`, `service`, `price_din`, `price_eur`, `created_at`, `updated_at`) VALUES
(1, 1, 112233445, 4, 1, 'bus', 'Polupansion', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 112233445, 5, 2, 'bus', 'HB', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 123456789, 6, 3, 'avio', 'PP', '0.00', '0.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 2, 123456789, 4, 2, 'bus', 'PP', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `name` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `role_id`, `name`, `surname`, `created_at`, `updated_at`) VALUES
('andjelko', '$2y$10$/872CarBbCWQ1TWH07RmJ.4qnei47k9pf03SyyhDWkOSmHQSP1LpO', 1, 'Marko', 'Andjelkovic', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('pera', 'pera', 0, 'Petar', 'Petrovic', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('sanjurak', 'sanjurak', 0, 'Sanja', 'Bogdanović Dinić', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accomodations`
--
ALTER TABLE `accomodations`
  ADD CONSTRAINT `accomodations_ibfk_1` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`);

--
-- Constraints for table `accomodation_units`
--
ALTER TABLE `accomodation_units`
  ADD CONSTRAINT `accidfk` FOREIGN KEY (`accommodations_id`) REFERENCES `accomodations` (`id`);

--
-- Constraints for table `passangers`
--
ALTER TABLE `passangers`
  ADD CONSTRAINT `passangers_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`),
  ADD CONSTRAINT `passangers_ibfk_2` FOREIGN KEY (`passanger_id`) REFERENCES `passanger` (`id`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`passanger_id`) REFERENCES `passanger` (`id`);

--
-- Constraints for table `travel_deals`
--
ALTER TABLE `travel_deals`
  ADD CONSTRAINT `travel_deals_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `travel_deals_ibfk_2` FOREIGN KEY (`organizer_id`) REFERENCES `organizers` (`pib`),
  ADD CONSTRAINT `travel_deals_ibfk_3` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`),
  ADD CONSTRAINT `travel_deals_ibfk_4` FOREIGN KEY (`accomodation_id`) REFERENCES `accomodations` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
