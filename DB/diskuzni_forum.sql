-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1:3308
-- Vytvořeno: Čtv 20. srp 2020, 12:22
-- Verze serveru: 8.0.18
-- Verze PHP: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `diskuzni_forum`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(32) COLLATE utf32_czech_ci NOT NULL,
  `Text` text COLLATE utf32_czech_ci NOT NULL,
  `Id_user` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf32 COLLATE=utf32_czech_ci;

--
-- Vypisuji data pro tabulku `article`
--

INSERT INTO `article` (`Id`, `Title`, `Text`, `Id_user`, `Timestamp`) VALUES
(1, 'testovaci', 'nějaký ten textíček', 1, '2020-07-30 13:05:53'),
(2, 'test insert', 'nejaký ten textík k insertu', 1, '2020-07-30 18:23:19'),
(3, 'test insert v2', 'nejaký ten textík k insertu', 1, '2020-07-30 18:23:51'),
(4, 'titlíček', 'nějaký ten hezký text', 1, '2020-08-20 11:41:03'),
(5, 'from web', 'ahhah', 1, '2020-08-20 11:55:17'),
(6, 'text z webíku', 'a co já jako s tím?', 1, '2020-08-20 11:55:36'),
(7, 'oh yeah', 'nějaký ten textíček pro textík', 1, '2020-08-20 12:15:04'),
(8, 'oh yeah', 'nějaký ten textíček pro textík', 1, '2020-08-20 12:15:09'),
(9, 'oh yeah', 'nějaký ten textíček pro textík', 1, '2020-08-20 12:15:10'),
(10, 'bude duplikace?', 'ahoj', 1, '2020-08-20 12:18:09'),
(11, '', '', 1, '2020-08-20 12:18:10'),
(12, '', '', 1, '2020-08-20 12:18:11'),
(13, '', '', 1, '2020-08-20 12:18:11'),
(14, '', '', 1, '2020-08-20 12:18:12'),
(15, '', '', 1, '2020-08-20 12:18:12'),
(16, 'neco;', 'někam', 1, '2020-08-20 12:19:15'),
(17, '', '', 1, '2020-08-20 12:19:17');

-- --------------------------------------------------------

--
-- Struktura tabulky `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Text` text COLLATE utf32_czech_ci NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Id_user` int(11) NOT NULL,
  `Id_article` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32 COLLATE=utf32_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(35) COLLATE utf32_czech_ci NOT NULL,
  `Surname` varchar(35) COLLATE utf32_czech_ci NOT NULL,
  `Email` varchar(255) COLLATE utf32_czech_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32 COLLATE=utf32_czech_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
