-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Vært: 127.0.0.1
-- Genereringstid: 06. 01 2015 kl. 08:39:14
-- Serverversion: 5.6.20
-- PHP-version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sikkerhed`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `phpro_users`
--

CREATE TABLE IF NOT EXISTS `phpro_users` (
`phpro_user_id` int(11) NOT NULL,
  `phpro_username` varchar(20) COLLATE latin1_danish_ci NOT NULL,
  `phpro_password` char(40) COLLATE latin1_danish_ci NOT NULL,
  `brugertype` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_danish_ci AUTO_INCREMENT=6 ;

--
-- Data dump for tabellen `phpro_users`
--

INSERT INTO `phpro_users` (`phpro_user_id`, `phpro_username`, `phpro_password`, `brugertype`) VALUES
(4, 'User1', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2),
(5, 'User2', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1);

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `phpro_users`
--
ALTER TABLE `phpro_users`
 ADD PRIMARY KEY (`phpro_user_id`), ADD UNIQUE KEY `phpro_username` (`phpro_username`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `phpro_users`
--
ALTER TABLE `phpro_users`
MODIFY `phpro_user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
