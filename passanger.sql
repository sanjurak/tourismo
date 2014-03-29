-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 24, 2014 at 06:25 PM
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
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `passanger`
--

INSERT INTO `passanger` (`id`, `name`, `surname`, `gender`, `address`, `tel`, `mob`, `passport`, `birth_date`, `updated_at`, `created_at`) VALUES
(1, 'Marko', 'Andjelkovic', 'm', 'Blv. Nemanjica 59/9', '018532677', '0631046701', NULL, NULL, '2014-03-20 23:44:10', '0000-00-00 00:00:00'),
(2, 'Sanja', 'Bogdanović Dinić', 'f', 'Somborska 123', NULL, NULL, NULL, NULL, '2014-03-20 23:44:10', '0000-00-00 00:00:00'),
(3, 'afsj', 'fkjs', 'm', 'safsgds egsfsd sfd', NULL, NULL, NULL, NULL, '2014-03-20 23:44:10', '0000-00-00 00:00:00'),
(4, 'afhadbdf', 'asdgadsgewag', 'm', 'abddgweg eagfawef ', NULL, NULL, NULL, NULL, '2014-03-20 23:44:10', '0000-00-00 00:00:00'),
(5, 'htesheash', 'hreaherh', 'm', 'aerhrea rwagerga', NULL, NULL, NULL, NULL, '2014-03-20 23:44:10', '0000-00-00 00:00:00'),
(6, 'asgeaw are', 'aregrawhtnae', 'm', 'areearjaerj reaherh', NULL, NULL, NULL, NULL, '2014-03-20 23:44:10', '0000-00-00 00:00:00'),
(7, 'reaheraja', 'aerhraeharea', 'm', 'arhereah reahsreah raghh', NULL, NULL, NULL, NULL, '2014-03-20 23:44:10', '0000-00-00 00:00:00'),
(8, 'arhaehre', 'ahraeh', 'm', 'arehaeh', NULL, NULL, NULL, NULL, '2014-03-20 23:44:10', '0000-00-00 00:00:00'),
(9, 'test', 'test', 'm', 'test', NULL, NULL, NULL, NULL, '2014-03-20 23:44:10', '0000-00-00 00:00:00'),
(10, 'test1', 'test', 'm', 'test', NULL, NULL, NULL, NULL, '2014-03-20 23:44:10', '0000-00-00 00:00:00'),
(11, 'test2', 'test', 'm', 'test', NULL, NULL, NULL, NULL, '2014-03-20 23:44:10', '0000-00-00 00:00:00'),
(12, 'prvi', 'putnik', 'm', 'dodat iz forme', '', '', '', '0000-00-00', '2014-03-20 22:57:57', '2014-03-20 22:57:57'),
(13, 'drugi', 'putnik', 'm', 'dodat iz forme', '', '', '', '0000-00-00', '2014-03-20 23:00:47', '2014-03-20 23:00:47'),
(14, 'treci', 'putnik', 'f', 'dodat iz forme', '', '', '', '0000-00-00', '2014-03-20 23:02:55', '2014-03-20 23:02:55'),
(15, 'test', 'putnik', 'm', 'iz forme', '', '', '', '0000-00-00', '2014-03-20 23:05:38', '2014-03-20 23:05:38'),
(16, 'test', 'test', 'm', 'iz forme', '', '', '', '0000-00-00', '2014-03-20 23:07:33', '2014-03-20 23:07:33');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
