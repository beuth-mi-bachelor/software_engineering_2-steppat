-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Erstellungszeit: 21. Nov 2014 um 09:29
-- Server Version: 5.5.38
-- PHP-Version: 5.6.2

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
(1, 'ss', 'Test ', '2014-11-29 23:00:00', '2015-01-11 23:00:00', 'http://placehold.it/100x100'),
(2, 'dfsgdfhfdg dfg dfgh dfg dfgh\r\ndfgdfhgfdh\r\n\r\n\r\ndfgdfhdghdfghdg\r\nhd\r\nghfd\r\nghfdgfdfgdfgd', 'Test 2', '2014-10-31 23:00:00', '2014-11-29 23:00:00', 'http://placehold.it/100x100/333'),
(3, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et e', 'Gehhilfe 2.0', '2014-11-29 23:00:00', '2015-01-30 23:00:00', 'http://placehold.it/100x100');

--
-- Daten für Tabelle `Idea`
--

INSERT INTO `Idea` (`id`, `contest_id`, `user_id`, `name`, `description`, `image_url`) VALUES
(1, 1, 0, 'haa', 'dddddd', 'http://placehold.it/100x100'),
(2, 1, NULL, 'idee 2', 'ddsdfgddss', 'http://placehold.it/100x100'),
(3, 1, NULL, 'idee 3', 'gggg', 'http://placehold.it/100x100'),
(4, 1, NULL, 'idee 4', 'rrrr', 'http://placehold.it/100x100'),
(5, 1, 3, 'halloooo', 'ddddggg', 'http://placehold.it/100x100'),
(6, 1, 3, 'halloooo', 'ddddggg', 'http://placehold.it/100x100');

--
-- Daten für Tabelle `User`
--

INSERT INTO `User` (`id`, `username`, `password`, `email`, `created_at`, `updated_at`) VALUES
(3, 'test', '098f6bcd4621d373cade4e832627b4f6', 'test@test.de', '2014-11-20 16:01:54', '2014-11-20 16:01:54');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
