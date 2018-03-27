-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Po 26.Mar 2018, 23:31
-- Verzia serveru: 10.1.30-MariaDB
-- Verzia PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `laravel`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `media`
--

CREATE TABLE `media` (
  `m_id` int(11) NOT NULL,
  `date` int(11) NOT NULL DEFAULT '0',
  `title` varchar(256) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `media` varchar(128) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `type` varchar(128) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `url` varchar(512) CHARACTER SET utf8 COLLATE utf8_slovak_ci DEFAULT NULL,
  `title_EN` varchar(256) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `activated` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `media`
--

INSERT INTO `media` (`m_id`, `date`, `title`, `media`, `type`, `url`, `title_EN`, `activated`) VALUES
(1, 1413244800, 'Študenti z Bratislavy vyvinuli u nás prvú elektrickú motokáru', 'Hospodárske noviny', 'link', 'http://dennik.hnonline.sk/ekonomika-a-firmy/591621-studenti-z-bratislavy-vyvinuli-u-nas-prvu-elektricku-motokaru#.VETnmBjntpk.facebook', 'Students', 0),
(2, 1413763200, 'Prvá elektrická motokára na Slovensku vznikla v škole', 'Pravda', 'link', 'http://spravy.pravda.sk/ekonomika/clanok/333718-prva-elektricka-motokara-na-slovensku-vznikla-v-skole/', 'First ...', 0),
(3, 1453161600, 'Mladí vedci navrhli snímač akupunktúrnych bodov', 'Rádio Regina', 'link', 'http://reginazapad.rtvs.sk/clanky/deti/98134/mladi-vedci-navrhli-snimac-akupunkturnych-bodov', 'Mladí vedci navrhli snímač akupunktúrnych bodov', 0),
(4, 1484179200, 'Automobilová mechatronika (od 6:35 min)', 'VAT RTVS', 'link', 'https://www.rtvs.sk/televizia/archiv/11767/115433', 'Automobilová mechatronika (od 6:35 min)', 0),
(5, 1484784000, 'Prvý slovenský elektrický skúter (od 7:50 min)', 'VAT RTVS', 'link', 'https://www.rtvs.sk/televizia/archiv/11767/117377', 'Prvý slovenský elektrický skúter (od 7:50 min)', 0),
(6, 1447113600, 'Poodkryl tajomstvo', 'Šarm', 'server', NULL, 'Poodkryl tajomstvo', 0),
(7, 1459209600, 'Vďaka biomechatronikom z STU sa už akupunktúrne body neskryjú', 'Dennik N', 'both', 'http://science.dennikn.sk/clankyarozhovory/', 'Vďaka biomechatronikom z STU sa už akupunktúrne body neskryjú', 0);

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`m_id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `media`
--
ALTER TABLE `media`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
