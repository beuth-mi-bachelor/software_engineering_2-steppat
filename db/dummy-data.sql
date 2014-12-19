-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Erstellungszeit: 19. Dez 2014 um 09:59
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
(1, 'nljhj#\r\n\r\njkhjkhjkhjk\r\n\r\njkhkhjkhk', 'Test Contest 1', '2014-12-11 23:00:00', '2014-12-24 23:00:00', 'http://placehold.it/100x100/'),
(2, 'sgdfgsfgdfgd\r\ndsgdfgdf\r\ngdfgdfgfdgdfg\r\ndfg\r\ndfgdfgdfgdfg', 'Test Contest 2', '2014-12-18 23:00:00', '2015-05-27 22:00:00', 'http://placehold.it/100x100/5e45d2');

--
-- Daten für Tabelle `Idea`
--

INSERT INTO `Idea` (`id`, `contest_id`, `user_id`, `name`, `description`, `image_url`) VALUES
(1, 1, 2, 'Test Idea 1 ', 'fgdfgdfg\r\n\r\n\r\nfgdfgfdgdf\r\n\r\n\r\nfdgfggdfgfdgfdgfdgfd', 'http://placehold.it/100x100/db0000'),
(2, 0, 1, 'Test Idea 2', 'jkjbjd\r\nvvvv\r\n\r\n\r\nvvvvv', 'http://placehold.it/100x100/db0000'),
(3, 1, 1, 'Test Idea 3', 'dfsdfds\r\nsdfdsfsdf\r\n\r\n\r\nsdfdsfdsfsdfsd', 'http://placehold.it/100x100/333');

--
-- Daten für Tabelle `Role`
--

INSERT INTO `Role` (`id`, `name`, `role`) VALUES
(1, 'Mitarbeiter', 0),
(2, 'Administrator', 99),
(3, 'Manager', 1);

--
-- Daten für Tabelle `User`
--

INSERT INTO `User` (`id`, `username`, `password`, `email`, `created_at`, `updated_at`, `hash`, `role_id`) VALUES
(1, 'user', '$2a$10$cG755c0sUFi0Wng38yCyqORZsZgVe0DNVujDnDe0ucSDu.vzDGhnK', 'user@test.de', '2014-12-12 19:08:00', '2014-12-12 19:08:00', 'cG755c0sUFi0Wng38yCyqQ==', 0),
(2, 'admin', '$2a$10$mOCn4QHgxucSbMtlQAWjiOCNot7ywOn2EtYjMl4qt3TfoLan4uFZu', 'admin@test.de', '2014-12-12 19:08:15', '2014-12-12 19:08:15', 'mOCn4QHgxucSbMtlQAWjiQ==', 99),
(4, 'manager', '$2a$10$e7DNATJ947CaiYazPMNYlOn9gt9XYOWOKWFkL1lmIcjwzTdMIKQTO', 'manager@test.de', '2014-12-12 20:04:17', '2014-12-12 20:04:17', 'e7DNATJ947CaiYazPMNYlQ==', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
