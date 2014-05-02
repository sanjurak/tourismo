-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2014 at 11:07 PM
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
CREATE DATABASE IF NOT EXISTS `clocktraveltourismo` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `clocktraveltourismo`;

-- --------------------------------------------------------

--
-- Table structure for table `accomodations`
--

CREATE TABLE IF NOT EXISTS `accomodations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `destination_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dst_id_ind` (`destination_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;


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
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `accommodations_id` (`accommodations_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `current` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE IF NOT EXISTS `destinations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `town` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `updated_at` date DEFAULT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Table structure for table `excursion`
--

CREATE TABLE IF NOT EXISTS `excursion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `excursionItem` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `priceDin` float NOT NULL,
  `priceEur` float NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

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
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`pib`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `passanger`
--

CREATE TABLE IF NOT EXISTS `passanger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jmbg` char(13) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `gender` set('m','f') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'm',
  `address` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mob` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport` char(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `jmbg` (`jmbg`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `passangers`
--

CREATE TABLE IF NOT EXISTS `passangers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `passanger_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pass_rsrv_id_ind` (`reservation_id`),
  KEY `pass_id_ind` (`passanger_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

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
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reservation_number` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `travel_deal_id` int(11) NOT NULL,
  `reservation_date` date NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `travel_date` date NOT NULL,
  `nights_num` int(2) NOT NULL,
  `passanger_id` int(11) NOT NULL,
  `price_total_din` decimal(12,2) DEFAULT NULL,
  `price_total_eur` decimal(12,2) DEFAULT NULL,
  `status` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `discount` decimal(12,2) DEFAULT NULL,
  `discounter_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clock_index` int(2) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `note_internal` text COLLATE utf8_unicode_ci,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `internal` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reservation_number` (`reservation_number`),
  KEY `rsrv_pass_id_ind` (`passanger_id`),
  KEY `travel_deal_id` (`travel_deal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_excursion`
--

CREATE TABLE IF NOT EXISTS `reservation_excursion` (
  `destinationId` int(11) NOT NULL,
  `excursionId` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reservationId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `destinationId` (`destinationId`,`excursionId`,`id`),
  KEY `reservationId` (`reservationId`),
  KEY `ExcID` (`excursionId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_numbers`
--

CREATE TABLE IF NOT EXISTS `reservation_numbers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `internalNum` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_prices`
--

CREATE TABLE IF NOT EXISTS `reservation_prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `priceItem` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `priceDin` float NOT NULL,
  `priceEur` float NOT NULL,
  `reservationId` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`reservationId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `travel_deals`
--

CREATE TABLE IF NOT EXISTS `travel_deals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `organizer_id` int(9) NOT NULL,
  `destination_id` int(11) NOT NULL,
  `transportation` set('bus','avio','voz','sopstveni','brod') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'bus',
  `service` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `price_din` decimal(11,2) DEFAULT NULL,
  `price_eur` decimal(11,2) DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `accomodation_unit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `travel_deal_cat_id_ind` (`category_id`),
  KEY `travel_deal_org_id_ind` (`organizer_id`),
  KEY `travel_deal_dest_id_ind` (`destination_id`),
  KEY `accomodation_unit_id` (`accomodation_unit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

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
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `remember_token` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `role_id`, `name`, `surname`, `created_at`, `updated_at`, `remember_token`) VALUES
('andjelko', '$2y$10$/872CarBbCWQ1TWH07RmJ.4qnei47k9pf03SyyhDWkOSmHQSP1LpO', 1, 'Marko', 'Andjelkovic', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '');

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
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`passanger_id`) REFERENCES `passanger` (`id`),
  ADD CONSTRAINT `traveldealfk` FOREIGN KEY (`travel_deal_id`) REFERENCES `travel_deals` (`id`);

--
-- Constraints for table `reservation_excursion`
--
ALTER TABLE `reservation_excursion`
  ADD CONSTRAINT `res_exc_id` FOREIGN KEY (`reservationId`) REFERENCES `reservations` (`id`),
  ADD CONSTRAINT `dest_exc_id` FOREIGN KEY (`destinationId`) REFERENCES `destinations` (`id`),
  ADD CONSTRAINT `exc_id` FOREIGN KEY (`excursionId`) REFERENCES `excursion` (`id`);

--
-- Constraints for table `travel_deals`
--
ALTER TABLE `travel_deals`
  ADD CONSTRAINT `accUnitsfk` FOREIGN KEY (`accomodation_unit_id`) REFERENCES `accomodation_units` (`id`),
  ADD CONSTRAINT `travel_deals_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `travel_deals_ibfk_2` FOREIGN KEY (`organizer_id`) REFERENCES `organizers` (`pib`),
  ADD CONSTRAINT `travel_deals_ibfk_3` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
