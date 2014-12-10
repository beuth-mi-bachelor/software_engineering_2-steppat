-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Erstellungszeit: 10. Dez 2014 um 14:02
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
-- Daten für Tabelle `Comments`
--

INSERT INTO `Comments` (`id`, `text`, `user_id`, `idea_id`, `created_at`) VALUES
(1, 'fsdfsdfsdf', 35, 2, '2014-12-04 13:08:15'),
(2, 'fsdfsdfsdf', 35, 2, '2014-12-04 13:11:35'),
(3, 'Peter Pan', 35, 2, '2014-12-04 16:17:12'),
(4, 'Peter Pan', 35, 2, '2014-12-04 16:18:05'),
(5, 'sfskgÃ¶fsdg', 3, 2, '2014-12-05 10:45:05'),
(6, 'aaa', 3, 2, '2014-12-05 10:45:10');

--
-- Daten für Tabelle `Contest`
--

INSERT INTO `Contest` (`id`, `description`, `name`, `starts_at`, `ends_at`, `image_url`) VALUES
(1, 'ss', 'Test ', '2014-11-29 23:00:00', '2015-01-11 23:00:00', 'http://placehold.it/100x100'),
(2, 'dfsgdfhfdg dfg dfgh dfg dfgh\r\ndfgdfhgfdh\r\n\r\n\r\ndfgdfhdghdfghdg\r\nhd\r\nghfd\r\nghfdgfdfgdfgd', 'Test 2', '2014-10-31 23:00:00', '2014-11-29 23:00:00', 'http://placehold.it/100x100/333'),
(3, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et e', 'Gehhilfe 2.0', '2014-11-29 23:00:00', '2015-01-30 23:00:00', 'http://placehold.it/100x100'),
(4, 'fisdjgijsg\r\ndfgdfghdhgdh\r\n\r\ndghgfhgfh', 'PeterPan', '2017-03-07 23:00:00', '2028-03-03 23:00:00', 'http://placehold.it/100x100/db0000');

--
-- Daten für Tabelle `Idea`
--

INSERT INTO `Idea` (`id`, `contest_id`, `user_id`, `name`, `description`, `image_url`) VALUES
(1, 0, 35, 'haa 123456', 'dddddd\r\n\r\nbbbb', 'http://placehold.it/100x100/db0000'),
(2, 1, 0, 'idee 2', 'ddsdfgddss', 'http://placehold.it/100x100'),
(3, 1, 0, 'idee 3', 'gggg', 'http://placehold.it/100x100'),
(4, 1, 0, 'idee 4', 'rrrr', 'http://placehold.it/100x100'),
(5, 1, 3, 'halloooo', 'ddddggg', 'http://placehold.it/100x100'),
(6, 1, 3, 'halloooo', 'ddddggg', 'http://placehold.it/100x100'),
(7, 3, 4, 'LaufkrÃ¼cke 3.0', 'fspfiospgke', 'http://placehold.it/100x100/'),
(8, 1, 35, '123', 'dfmsdkgmdsg\r\nfdgfdgfdg', 'http://placehold.it/100x100/db0000'),
(9, 1, 35, '123', 'dfmsdkgmdsg\r\nfdgfdgfdg', 'http://placehold.it/100x100/db0000'),
(10, 1, 35, 'Test', 'afsidjfgdsg', 'http://placehold.it/100x100/');

--
-- Daten für Tabelle `User`
--

INSERT INTO `User` (`id`, `username`, `password`, `email`, `created_at`, `updated_at`, `hash`) VALUES
(1, 'test', '$2a$10$nDOBg4.nPRCn1CYdg4ZsTuDaTAY6MZl5LCgndu0HQCVSIKYZQ2r0a', 'mduve@designmail.net', '2014-12-10 12:51:06', '2014-12-10 12:51:06', 'nDOBg4.nPRCn1CYdg4ZsTw==');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
