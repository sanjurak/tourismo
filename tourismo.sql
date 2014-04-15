-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 15, 2014 at 10:25 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table `accomodations`
--

INSERT INTO `accomodations` (`id`, `type`, `name`, `destination_id`, `created_at`, `updated_at`) VALUES
(1, 'hotel', 'Adonis', 15, '0000-00-00 00:00:00', '2014-03-30 21:44:50'),
(2, 'Apartman', 'Villa Maria', 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Villa', 'Madrid', 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Villa', 'Adonisus', 4, '2014-03-30 21:41:15', '2014-03-30 21:41:15'),
(6, 'Villa', 'jovana', 4, '2014-04-01 23:07:29', '2014-04-01 23:07:29'),
(8, 'hotel', 'kipar', 4, '2014-04-01 23:12:38', '2014-04-01 23:12:38'),
(12, 'hotel', 'Helios', 4, '2014-04-01 23:27:53', '2014-04-01 23:27:53'),
(17, 'Villa', 'Eugenija', 4, '2014-04-02 06:55:24', '2014-04-02 06:55:24'),
(19, 'bungalov', 'Sokole', 7, '2014-04-03 01:21:51', '2014-04-03 01:22:13'),
(25, 'hotel', 'Bela', 6, '2014-04-07 23:38:11', '2014-04-07 23:38:11'),
(26, 'Hostel', 'Kilo', 18, '2014-04-08 00:20:03', '2014-04-08 00:20:03'),
(27, 'Hotel', 'Barcelona', 19, '2014-04-15 19:51:53', '2014-04-15 19:51:53');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table `accomodation_units`
--

INSERT INTO `accomodation_units` (`id`, `name`, `capacity`, `number`, `accommodations_id`, `created_at`, `updated_at`) VALUES
(1, 'soba', 2, 5, 1, '2014-03-28 00:00:00', '2014-03-28 00:00:00'),
(3, 'soba', 3, 4, 17, '2014-04-02 06:55:24', '2014-04-03 00:26:05'),
(4, 'soba', 5, 2, 17, '2014-04-02 06:55:24', '2014-04-03 00:26:05'),
(5, 'apartman', 4, 2, 17, '2014-04-02 06:55:24', '2014-04-03 00:26:05'),
(8, 'soba', 3, 3, 2, '2014-04-03 01:15:48', '2014-04-03 01:15:48'),
(9, 'soba', 2, 2, 3, '2014-04-03 01:17:02', '2014-04-03 01:17:02'),
(10, 'soba', 3, 2, 3, '2014-04-03 01:17:02', '2014-04-03 01:17:02'),
(11, 'apartman', 4, 1, 3, '2014-04-03 01:17:02', '2014-04-03 01:17:02'),
(12, 'soba', 2, 4, 4, '2014-04-03 01:19:34', '2014-04-03 01:20:03'),
(13, 'soba', 2, 2, 19, '2014-04-03 01:21:51', '2014-04-03 01:21:51'),
(24, 'soba', 2, 10, 25, '2014-04-07 23:38:11', '2014-04-07 23:38:11'),
(25, 'SOBA', 3, 5, 25, '2014-04-07 23:38:11', '2014-04-07 23:38:11'),
(26, 'soba', 7, 5, 26, '2014-04-08 00:20:03', '2014-04-08 00:20:03'),
(27, 'Soba', 2, 1, 27, '2014-04-15 19:51:53', '2014-04-15 19:51:53');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `current`, `created_at`, `updated_at`) VALUES
(1, 'Leto 2014', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Uskrs 2014', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Prvi maj 2014', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Izleti 2014', 1, '2014-04-06 21:34:42', '2014-04-06 21:34:42'),
(5, 'Leto 2013', 1, '2014-04-06 21:38:12', '2014-04-06 21:38:12'),
(6, 'Leto 2012', 1, '2014-04-06 21:42:18', '2014-04-06 21:42:18'),
(7, 'Zimovanje 2015', 1, '2014-04-07 20:04:36', '2014-04-07 20:04:36'),
(8, 'Zimovanje 2012', 1, '2014-04-07 20:07:10', '2014-04-07 20:07:10'),
(9, 'Prolece 2014', 1, '2014-04-07 21:15:34', '2014-04-07 21:15:34'),
(10, 'Prolece 2015', 1, '2014-04-07 21:16:01', '2014-04-07 21:16:01'),
(11, 'Prvi maj 2013', 1, '2014-04-07 21:17:31', '2014-04-07 21:17:31'),
(12, 'Jesen 2014', 1, '2014-04-07 22:00:32', '2014-04-07 22:00:32'),
(13, 'Prolecne radosti', 1, '2014-04-08 00:18:36', '2014-04-08 00:18:36');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id`, `country`, `town`, `description`, `updated_at`, `created_at`) VALUES
(4, 'Grčka', 'Lefkada', 'Lefkada island', '2014-03-23 20:34:43', '0000-00-00 00:00:00'),
(5, 'Italija', 'Firenca', 'The city of Florence is bla bla bla', '2014-03-21 23:53:49', '0000-00-00 00:00:00'),
(6, 'Španija', 'Malaga', 'Malaga is bla bla bla', '2014-03-22 11:14:41', '0000-00-00 00:00:00'),
(7, 'Nemačka', 'Berlin', 'Opis  Nemacke i Berlina', '2014-03-30 19:08:32', '2014-03-22 23:40:57'),
(8, 'Francuska', 'Avinjon', 'Vinogradi, dvorci i ostali', '2014-03-23 13:42:27', '2014-03-22 23:43:19'),
(14, 'grcka', 'solun', 'opis', '2014-03-27 23:02:14', '2014-03-27 23:02:14'),
(15, 'Grcka', 'Atina', 'opis', '2014-03-27 23:11:25', '2014-03-27 23:11:25'),
(16, 'Grcks', 'Jerosinos', 'opis', '2014-03-27 23:22:00', '2014-03-27 23:22:00'),
(17, 'Hrvatska', 'Pula', NULL, '2014-04-07 22:26:57', '2014-04-07 22:26:57'),
(18, 'Madjarska', 'Budimpesta', NULL, '2014-04-08 00:19:17', '2014-04-08 00:19:17'),
(19, 'Španija', 'Barselona', NULL, '2014-04-15 19:50:59', '2014-04-15 19:50:59');

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
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
(0, NULL, '', '', NULL, NULL, NULL, '2014-04-07 23:23:07', '2014-04-07 23:23:07'),
(100659874, NULL, 'Clock Travel', 'clocktravel@nekimail.com', NULL, NULL, NULL, '2014-04-15 19:50:30', '2014-04-15 19:50:30'),
(112233445, '', 'Oktopod tours', 'oktopod@tours.com', '', '', 'www.oktopod.rs', '0000-00-00 00:00:00', '2014-03-28 22:27:05'),
(123456789, '123456789876', 'Rapsody Travel', 'rapsody@travel.com', 'Bulevar OK 34', 'Empty', 'www.rapsody.rs', '0000-00-00 00:00:00', '2014-03-30 10:17:15'),
(314263746, 'Empty', 'Argus Tours', 'argus@tours.com', 'Ulica la la la', 'Empty', 'www.argus.com', '0000-00-00 00:00:00', '2014-03-30 12:39:00'),
(444555687, NULL, 'EUROturs Travel', 'euroturs@travel', NULL, NULL, NULL, '2014-04-07 22:07:44', '2014-04-07 22:07:44'),
(444555999, NULL, 'EURO Travel', 'euro@travel', NULL, NULL, NULL, '2014-04-07 22:08:37', '2014-04-07 22:08:37'),
(543677722, NULL, 'Sun Travel', 'sun@travel', NULL, NULL, NULL, '2014-04-07 22:05:37', '2014-04-07 22:05:37'),
(567812349, NULL, 'Fun Travel', 'fun@travel', NULL, NULL, NULL, '2014-04-07 22:02:09', '2014-04-07 22:02:09'),
(987654123, NULL, 'Guliver', 'guliver@guliver.com', NULL, NULL, NULL, '2014-04-07 21:59:20', '2014-04-07 21:59:20'),
(987654321, NULL, 'Galileo Turs', 'galileo@galileo.turs', NULL, NULL, NULL, '2014-04-07 21:58:19', '2014-04-07 21:58:19');

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
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `jmbg` (`jmbg`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `passanger`
--

INSERT INTO `passanger` (`id`, `jmbg`, `name`, `surname`, `gender`, `address`, `tel`, `mob`, `passport`, `birth_date`, `created_at`, `updated_at`) VALUES
(1, '1410985735066', 'Sanja', 'Bogdanovic', 'f', 'Somborska', '1234567', '1234567', '123444', '1985-10-14', '2014-03-23 20:38:05', '2014-03-30 12:31:46'),
(2, '1203198000033', 'Jelena', 'Petrovic', 'f', 'Ulica', '', '', '1234', '1980-03-12', '2014-03-30 12:30:52', '2014-03-30 12:30:52');

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
  `reservation_number` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `travel_deal_id` int(11) NOT NULL,
  `reservation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `internal` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reservation_number` (`reservation_number`),
  KEY `rsrv_pass_id_ind` (`passanger_id`),
  KEY `travel_deal_id` (`travel_deal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `reservation_number`, `travel_deal_id`, `reservation_date`, `start_date`, `end_date`, `travel_date`, `nights_num`, `passanger_id`, `price_total_din`, `price_total_eur`, `status`, `discount`, `discounter_name`, `clock_index`, `note`, `note_internal`, `created_at`, `updated_at`, `internal`) VALUES
(1, '1/2014', 5, '2014-04-04 22:27:53', '2014-05-01', '2014-05-05', '2014-05-01', 3, 2, '3456.00', '30.00', 'Aktivna', NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reservation_excursion`
--

CREATE TABLE IF NOT EXISTS `reservation_excursion` (
  `destinationId` int(11) NOT NULL,
  `excursionId` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `destinationId` (`destinationId`,`excursionId`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_numbers`
--

CREATE TABLE IF NOT EXISTS `reservation_numbers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `internalNum` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`reservationId`)
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
  `transportation` set('bus','avio','voz','sopstveni','brod') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'bus',
  `service` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `price_din` decimal(11,2) DEFAULT NULL,
  `price_eur` decimal(11,2) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `accomodation_unit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `travel_deal_cat_id_ind` (`category_id`),
  KEY `travel_deal_org_id_ind` (`organizer_id`),
  KEY `travel_deal_dest_id_ind` (`destination_id`),
  KEY `accomodation_unit_id` (`accomodation_unit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table `travel_deals`
--

INSERT INTO `travel_deals` (`id`, `category_id`, `organizer_id`, `destination_id`, `transportation`, `service`, `price_din`, `price_eur`, `created_at`, `updated_at`, `accomodation_unit_id`) VALUES
(5, 1, 112233445, 7, 'bus', 'Polupansion', '34500.00', '300.00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 5),
(7, 2, 314263746, 7, 'bus', 'hb', '15400.00', '130.00', '2014-04-06 13:19:50', '2014-04-06 13:19:50', 13),
(8, 1, 123456789, 15, 'bus', 'pp', '3500.00', '300.00', '2014-04-06 13:24:35', '2014-04-06 13:24:35', 1),
(9, 3, 314263746, 6, 'bus', 'pp', '30000.00', '270.00', '2014-04-06 13:25:42', '2014-04-06 13:25:42', 9),
(21, 2, 112233445, 6, '', 'pp', '45000.00', '400.00', '2014-04-06 19:24:00', '2014-04-06 19:24:00', 11),
(22, 1, 123456789, 15, 'bus', 'pp', '35000.00', '300.00', '2014-04-06 19:35:27', '2014-04-06 19:35:27', 1),
(23, 3, 112233445, 7, '', 'pp', '23456.00', '200.00', '2014-04-06 20:17:33', '2014-04-06 20:17:33', 13),
(24, 11, 123456789, 15, 'bus', 'pp', '23456.00', '180.00', '2014-04-07 21:18:42', '2014-04-07 21:18:42', 1),
(25, 4, 444555999, 7, 'bus', 'hb', '35600.00', '320.00', '2014-04-07 22:10:50', '2014-04-07 22:10:50', 13),
(26, 13, 123456789, 18, 'bus', 'pp', '17500.00', '130.00', '2014-04-08 00:20:38', '2014-04-08 00:20:38', 26);

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
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`passanger_id`) REFERENCES `passanger` (`id`),
  ADD CONSTRAINT `traveldealfk` FOREIGN KEY (`travel_deal_id`) REFERENCES `travel_deals` (`id`);

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
