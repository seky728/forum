-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1:3308
-- Vytvořeno: Pát 30. říj 2020, 09:23
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
  `Title` text CHARACTER SET utf32 COLLATE utf32_czech_ci NOT NULL,
  `Text` text COLLATE utf32_czech_ci NOT NULL,
  `Id_user` int(11) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf32 COLLATE=utf32_czech_ci;

--
-- Vypisuji data pro tabulku `article`
--

INSERT INTO `article` (`Id`, `Title`, `Text`, `Id_user`, `Timestamp`) VALUES
(8, 'oh yeah', 'nějaký ten textíček pro textík', 1, '2020-08-20 12:15:09'),
(10, 'bude duplikace?', 'ahoj', 1, '2020-08-20 12:18:09'),
(16, 'neco;', 'někam', 1, '2020-08-20 12:19:15'),
(18, 'test nový model', 'nějaký ten fajn příspěvek', 1, '2020-08-25 11:38:18'),
(19, 'test', 'test', 1, '2020-08-25 13:17:51'),
(20, 'test', 'test', 1, '2020-08-25 13:17:54'),
(21, 'test', 'test', 1, '2020-08-25 13:17:59'),
(22, 'wtf', 'wtf', 1, '2020-08-25 13:18:22'),
(23, 'wtf', 'wtf', 1, '2020-08-25 13:18:25'),
(24, '', '', 1, '2020-08-25 13:21:50'),
(25, 'ahoj', 'ahoj', 1, '2020-08-25 13:22:19'),
(26, 'test po přihlášení', 'hello there', 1, '2020-09-18 07:39:06'),
(27, 'another one', 'ahoj tu', 1, '2020-09-18 07:43:35'),
(28, 'sdklh', 'kjk', 1, '2020-09-18 07:45:17'),
(33, 'ahoj', 'jak je', 1, '2020-10-15 13:08:47'),
(34, 'ahoj', 'ahoj', 1, '2020-10-20 08:11:00'),
(35, 'ahoj', 'ahoj', 1, '2020-10-20 08:11:10'),
(36, 'ahoj', 'ahoj', 1, '2020-10-20 08:11:49'),
(37, 'ahoj', 'ahoj', 1, '2020-10-20 08:12:20'),
(38, '<br> nějaký ten tučný text</br>', '<br> nějaký ten tučný text</br>', 1, '2020-10-20 08:12:26'),
(39, '&lt;br&gt; nějaký ten tučný text&lt;/br&gt;', '&lt;br&gt; nějaký ten tučný text&lt;/br&gt;', 1, '2020-10-20 08:18:30'),
(44, '<br> nějaký ten tučný text</br>', '<br> nějaký ten tučný text</br>', 1, '2020-10-20 08:27:16'),
(47, 'pošli tohle', 'a to s tímhle', 1, '2020-10-20 08:36:50'),
(48, '<br> nějaký ten tučný text</br><div class=\"helloThere\">neměl by tu být div class \"hello There\"</div>', '<br> nějaký ten tučný text</br>', 1, '2020-10-27 17:40:06'),
(49, '1', '1', 1, '2020-10-27 18:11:42'),
(50, '2', '2', 1, '2020-10-27 18:11:45'),
(51, '3', '3', 1, '2020-10-27 18:11:50'),
(52, '4', '4', 1, '2020-10-27 18:11:52'),
(53, '5', '5', 1, '2020-10-27 18:11:54'),
(54, '6', '6', 1, '2020-10-27 18:11:56'),
(55, '7', '7', 1, '2020-10-27 18:11:58'),
(56, '8', '8', 1, '2020-10-27 18:12:19'),
(57, '9', '9', 1, '2020-10-27 18:12:21'),
(58, '10', '10', 1, '2020-10-27 19:11:26');

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
  PRIMARY KEY (`Id`),
  KEY `Id_article` (`Id_article`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf32 COLLATE=utf32_czech_ci;

--
-- Vypisuji data pro tabulku `comments`
--

INSERT INTO `comments` (`Id`, `Text`, `Timestamp`, `Id_user`, `Id_article`) VALUES
(36, 'na h', '2020-10-15 13:11:23', 1, 33),
(37, 'na h', '2020-10-15 13:11:42', 1, 33),
(38, 'na h', '2020-10-15 13:11:44', 1, 33),
(39, 'na h', '2020-10-15 13:11:45', 1, 33),
(40, 'na h', '2020-10-15 13:11:47', 1, 33),
(41, 'na h', '2020-10-15 13:11:48', 1, 33),
(42, 'fuck you', '2020-10-17 15:58:22', 5, 33),
(43, '&lt;br&gt; nějaký ten tučný text&lt;/br&gt;', '2020-10-20 08:15:47', 1, 38),
(44, '&lt;br&gt; nějaký ten tučný text&lt;/br&gt;', '2020-10-20 08:15:58', 1, 38),
(45, '&lt;br&gt; nějaký ten tučný text&lt;/br&gt;', '2020-10-20 08:18:18', 1, 38),
(46, 'poslední příspěvek', '2020-10-27 19:37:37', 1, 8),
(47, 'hahah', '2020-10-30 09:14:11', 1, 55);

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
  `User_name` varchar(32) COLLATE utf32_czech_ci NOT NULL,
  `Password` text COLLATE utf32_czech_ci NOT NULL,
  `Rights` int(11) NOT NULL DEFAULT '3',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf32 COLLATE=utf32_czech_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`Id`, `Name`, `Surname`, `Email`, `User_name`, `Password`, `Rights`) VALUES
(1, 'admin', 'admin', 'admin@admin.cz', 'admin', 'admin', 0),
(2, 'Pepa', 'Novák', 'pepik@seznam.cz', 'pepenus', 'pepa', 3),
(5, 'test1', 'test1', 'test1', 'test1', 'test1', 2),
(6, 'test2ad', 'test2ad', 'test2ad', 'test2ad', 'test2ad', 3);

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`Id_article`) REFERENCES `article` (`Id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
