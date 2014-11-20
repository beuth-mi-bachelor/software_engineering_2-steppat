-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Erstellungszeit: 20. Nov 2014 um 17:03
-- Server Version: 5.5.34
-- PHP-Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `se`
--

--
-- Daten für Tabelle `Contest`
--

INSERT INTO `Contest` (`id`, `description`, `name`, `starts_at`, `ends_at`, `image_url`) VALUES
(1, 'Test-Beschreibung', 'Test', '2014-11-12 23:00:00', '2014-11-27 23:00:00', 'http://placehold.it/100x100/'),
(2, 'dfsgdfhfdg dfg dfgh dfg dfgh\r\ndfgdfhgfdh\r\n\r\n\r\ndfgdfhdghdfghdg\r\nhd\r\nghfd\r\nghfdgfdfgdfgd', 'Test 2', '2014-10-31 23:00:00', '2014-11-29 23:00:00', 'http://placehold.it/100x100/333');

--
-- Daten für Tabelle `Idea`
--

INSERT INTO `Idea` (`id`, `contest_id`, `user_id`, `name`, `description`, `image_url`) VALUES
(0, 1, 1, 'Idee Test 1', 'Beschreibung hier\r\n\r\nund \r\n\r\nda und so', 'http://placehold.it/50x50/db0000'),
(1, 1, 1, 'Idee Test 2', 'Beschreibung hier\r\n\r\nund \r\n\r\nda und so', 'http://placehold.it/50x50/db0000');

--
-- Daten für Tabelle `User`
--

INSERT INTO `User` (`id`, `username`, `password`, `email`, `created_at`, `updated_at`) VALUES
(3, 'test', '098f6bcd4621d373cade4e832627b4f6', 'test@test.de', '2014-11-20 16:01:54', '2014-11-20 16:01:54');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
