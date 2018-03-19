-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Hostiteľ: localhost
-- Čas generovania: Út 26.Sep 2017, 17:07
-- Verzia serveru: 5.7.17-0ubuntu0.16.04.1
-- Verzia PHP: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `zaver`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `consultation`
--

CREATE TABLE `consultation` (
  `id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `day` int(11) NOT NULL,
  `duration` float NOT NULL,
  `note` varchar(64) COLLATE utf8_slovak_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `consultation`
--

INSERT INTO `consultation` (`id`, `person_id`, `start_time`, `day`, `duration`, `note`) VALUES
(1, 1, '15:00:00', 4, 2, 'Konzultácie k IIA'),
(2, 3, '07:00:00', 5, 3, 'konzultácia k OS v AB150'),
(3, 50, '09:00:00', 4, 2, 'konzultácie pre BP a DP'),
(4, 50, '12:00:00', 4, 4, 'konzultácie pre BP a DP'),
(10, 11, '15:30:00', 3, 0.5, 'konz test2'),
(12, 51, '10:00:00', 3, 0.5, 'konz test 7'),
(13, 52, '12:00:00', 3, 0.5, 'konz test 5'),
(14, 52, '11:00:00', 3, 0.5, 'konz test 7'),
(15, 51, '15:00:00', 3, 0.5, 'konz test 8'),
(16, 52, '13:30:00', 3, 0.5, 'konz test 9'),
(17, 51, '13:30:00', 3, 0.5, 'konz test 10');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `group`
--

CREATE TABLE `group` (
  `idGroups` int(1) NOT NULL DEFAULT '0',
  `code` varchar(4) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `group`
--

INSERT INTO `group` (`idGroups`, `code`, `name`) VALUES
(1, 'OAMM', 'Oddelenie aplikovanej mechaniky a mechatroniky'),
(2, 'OIKR', 'Oddelenie informačných, komunikačných a riadiacich systémov'),
(3, 'OAEM', 'Oddelenie elektroniky, mikropočítačov a PLC systémov'),
(4, 'OEAP', 'Oddelenie E-mobility, automatizácie a pohonov');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `lecture`
--

CREATE TABLE `lecture` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `start_time` time NOT NULL,
  `day` int(11) NOT NULL,
  `students` int(11) NOT NULL DEFAULT '0',
  `percentage` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `lecture`
--

INSERT INTO `lecture` (`id`, `subject_id`, `person_id`, `type_id`, `room_id`, `start_time`, `day`, `students`, `percentage`) VALUES
(1, 3, 58, 1, 2, '08:00:00', 1, 20, 0),
(2, 4, 58, 2, 3, '09:00:00', 5, 19, 0),
(3, 3, 36, 2, 3, '11:00:00', 5, 0, 0),
(4, 3, 18, 2, 3, '09:00:00', 3, 0, 0),
(5, 7, 50, 1, 1, '08:00:00', 2, 15, 0),
(6, 7, 16, 2, 12, '15:00:00', 3, 0, 0),
(7, 7, 15, 2, 13, '15:00:00', 3, 0, 0),
(10, 7, 16, 2, 12, '17:00:00', 3, 0, 0),
(11, 7, 42, 2, 13, '17:00:00', 3, 0, 0),
(12, 7, 50, 1, 1, '13:00:00', 3, 25, 0),
(13, 7, 42, 2, 12, '08:00:00', 4, 0, 0),
(14, 7, 15, 2, 13, '08:00:00', 4, 0, 0),
(15, 3, 18, 2, 3, '11:00:00', 3, 0, 0),
(16, 2, 4, 1, 1, '08:00:00', 4, 0, 0),
(17, 2, 18, 2, 3, '13:00:00', 2, 0, 0),
(18, 2, 18, 2, 3, '16:00:00', 2, 0, 0),
(19, 2, 30, 2, 3, '07:00:00', 1, 0, 0),
(20, 2, 46, 2, 3, '16:00:00', 3, 0, 0),
(21, 2, 30, 2, 3, '13:00:00', 4, 0, 0),
(22, 2, 30, 2, 3, '16:00:00', 4, 0, 0),
(23, 5, 20, 1, 12, '08:00:00', 2, 0, 0),
(24, 5, 48, 2, 9, '13:00:00', 1, 0, 0),
(25, 5, 48, 2, 9, '15:00:00', 1, 0, 0),
(26, 5, 48, 2, 9, '13:00:00', 2, 0, 0),
(27, 5, 48, 2, 9, '15:00:00', 2, 0, 0),
(28, 10, 38, 1, 6, '09:00:00', 1, 0, 0),
(29, 10, 38, 2, 6, '11:00:00', 1, 0, 0),
(30, 1, 27, 1, 14, '14:00:00', 1, 0, 0),
(31, 1, 44, 2, 8, '13:00:00', 2, 0, 0),
(32, 4, 6, 1, 15, '09:00:00', 2, 0, 0),
(33, 4, 6, 2, 6, '11:00:00', 2, 0, 0),
(34, 4, 6, 2, 6, '13:00:00', 2, 0, 0),
(35, 4, 6, 2, 6, '15:00:00', 2, 0, 0),
(41, 9, 3, 1, 5, '07:00:00', 1, 0, 0),
(42, 11, 40, 1, 16, '08:00:00', 2, 0, 0),
(43, 11, 40, 2, 16, '11:00:00', 2, 0, 0),
(44, 15, 47, 1, 17, '08:00:00', 4, 0, 0),
(45, 15, 7, 2, 4, '12:00:00', 1, 0, 0),
(46, 15, 23, 2, 4, '13:00:00', 2, 0, 0),
(47, 15, 23, 2, 4, '15:00:00', 2, 0, 0),
(48, 15, 7, 2, 4, '09:00:00', 3, 0, 0),
(49, 15, 23, 2, 4, '11:00:00', 3, 0, 0),
(50, 14, 7, 1, 18, '08:00:00', 3, 0, 0),
(51, 14, 26, 2, 7, '15:00:00', 3, 0, 0),
(52, 14, 1, 2, 7, '17:00:00', 3, 15, 0),
(53, 14, 1, 2, 7, '13:00:00', 4, 5, 0),
(54, 14, 1, 2, 7, '15:00:00', 4, 0, 0),
(55, 13, 11, 1, 19, '13:00:00', 3, 0, 0),
(56, 13, 31, 2, 19, '16:00:00', 3, 0, 0),
(57, 12, 40, 1, 16, '08:00:00', 4, 0, 0),
(58, 12, 40, 2, 10, '10:00:00', 4, 0, 0),
(59, 18, 40, 1, 26, '08:00:00', 5, 0, 0),
(60, 18, 40, 2, 26, '11:00:00', 5, 0, 0),
(61, 17, 2, 1, 25, '08:00:00', 5, 0, 0),
(62, 16, 31, 1, 24, '08:00:00', 1, 0, 0),
(63, 16, 31, 2, 24, '11:00:00', 1, 0, 0),
(64, 19, 9, 1, 20, '09:00:00', 1, 0, 0),
(65, 19, 5, 2, 15, '13:00:00', 2, 0, 0),
(66, 19, 5, 2, 15, '15:00:00', 2, 0, 0),
(67, 21, 35, 1, 23, '13:00:00', 3, 0, 0),
(68, 21, 13, 2, 20, '15:00:00', 1, 0, 0),
(70, 21, 45, 2, 20, '08:00:00', 4, 0, 0),
(71, 22, 34, 1, 21, '11:00:00', 1, 0, 0),
(72, 22, 34, 2, 21, '14:00:00', 1, 0, 0),
(73, 22, 34, 2, 21, '13:00:00', 4, 0, 0),
(74, 22, 34, 2, 21, '15:00:00', 4, 0, 0),
(75, 20, 32, 1, 20, '11:00:00', 1, 0, 0),
(76, 20, 32, 2, 22, '13:00:00', 3, 0, 0),
(77, 23, 10, 1, 22, '09:00:00', 1, 0, 0),
(78, 23, 10, 2, 22, '11:00:00', 1, 0, 0),
(79, 24, 9, 1, 21, '09:00:00', 3, 0, 0),
(80, 24, 5, 2, 15, '11:00:00', 3, 0, 0),
(81, 25, 32, 1, 22, '13:00:00', 4, 0, 0),
(82, 25, 32, 2, 22, '15:00:00', 4, 0, 0),
(86, 9, 51, 2, 18, '16:00:00', 5, 0, 0),
(90, 9, 6, 2, 24, '15:00:00', 4, 0, 0),
(91, 9, 5, 2, 14, '10:00:00', 2, 0, 0),
(93, 9, 12, 1, 14, '11:00:00', 2, 0, 0),
(94, 9, 1, 2, 13, '07:00:00', 2, 0, 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `lecture_type`
--

CREATE TABLE `lecture_type` (
  `id` int(11) NOT NULL,
  `type` varchar(10) COLLATE utf8_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `lecture_type`
--

INSERT INTO `lecture_type` (`id`, `type`) VALUES
(1, 'Prednáška'),
(2, 'Cvičenie');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `person`
--

CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `person_type` int(11) NOT NULL,
  `title1` varchar(16) DEFAULT NULL,
  `name` varchar(32) NOT NULL,
  `surname` varchar(32) NOT NULL,
  `title2` varchar(16) DEFAULT NULL,
  `idGroup` int(1) DEFAULT NULL,
  `ldap` varchar(32) DEFAULT NULL,
  `google` varchar(64) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `person`
--

INSERT INTO `person` (`id`, `person_type`, `title1`, `name`, `surname`, `title2`, `idGroup`, `ldap`, `google`, `active`) VALUES
(1, 1, 'Ing.', 'Peter', 'Balko', '', 2, 'balko', 'x2', 1),
(2, 1, 'Ing.', 'Richard', 'Balogh', 'PhD.', 3, 'balogh', '', 1),
(3, 1, 'Ing.', 'Igor', 'Bélai', 'PhD.', 3, 'belai', '', 1),
(4, 1, 'Ing.', 'Pavol', 'Bisták', 'PhD.', 4, 'bistak', '', 1),
(5, 1, 'Ing.', 'Martin', 'Bugár', 'PhD.', 4, 'bugar', '', 1),
(6, 1, 'Ing.', 'Ján', 'Cigánek', 'PhD.', 2, 'ciganek', '', 0),
(7, 1, 'Doc. Ing. ', 'Peter', 'Drahoš', 'PhD.', 3, 'drahos', '', 1),
(8, 1, 'Ing.', 'Branislav', 'Dvorščák', '', 2, 'dvorscak', '', 1),
(9, 1, 'Prof. Ing. ', 'Viktor', 'Ferencey', 'PhD.', 4, 'ferencey', '', 1),
(10, 1, 'Ing.', 'Róbert', 'Fric', 'PhD.', 1, 'fric', '', 0),
(11, 1, 'Doc. Ing. ', 'Peter', 'Fuchs', 'PhD.', 3, 'fuchs', '', 1),
(12, 1, 'Ing.', 'Gabriel', 'Gálik', '', 1, 'galik', '', 1),
(13, 1, 'Ing.', 'Vladimír', 'Goga', 'PhD.', 1, 'goga', '', 1),
(14, 1, 'Ing.', 'Roman', 'Gogola', '', 1, 'gogola', '', 1),
(15, 1, 'Ing.', 'Alojz', 'Gomola', '', 4, 'gomola', '', 1),
(16, 1, 'Ing.', 'Miroslav', 'Gula', '', 2, 'xgulam', '', 1),
(17, 1, 'Ing.', 'Peter', 'Guzmický', '', 2, 'guzmicky', '', 1),
(18, 1, 'Ing.', 'Oto', 'Haffner', '', 2, 'haffner', '', 1),
(19, 1, 'Ing.', 'Juraj', 'Hrabovský', 'PhD.', 1, 'hrabovsky', '', 1),
(20, 1, 'Prof. Ing. ', 'Mikuláš', 'Huba', 'PhD.', 4, 'huba', '', 1),
(21, 1, 'Ing.', 'Tomáš', 'Huba', '', 2, 'hubat', '', 1),
(22, 1, 'Ing.', 'Mária', 'Hypiusová', 'PhD.', 2, 'hypiusova', '', 1),
(23, 1, 'Ing.', 'Štefan', 'Chamraz', 'PhD.', 3, 'chamraz', '', 1),
(24, 1, 'Ing.', 'Jakub', 'Jakubec', '', 1, 'jakubec', '', 1),
(25, 1, 'Ing.', 'Zoltán', 'Janík', '', 2, 'janik', '', 1),
(26, 1, 'Ing.', 'Michal', 'Kocúr', '', 2, 'kocur', '', 1),
(27, 1, 'Prof. Ing. ', 'Štefan', 'Kozák', 'PhD.', 2, 'kozak', '', 1),
(28, 1, 'Doc. Ing. ', 'Alena', 'Kozáková', 'PhD.', 2, 'kozakova', '', 1),
(29, 1, 'Ing.', 'Róbert', 'Krasňanský', '', 2, 'krasnansky', '', 1),
(30, 1, 'Ing.', 'Erik', 'Kučera', '', 2, 'kucera', '', 1),
(31, 1, 'Ing.', 'Marek', 'Kukučka', 'PhD.', 3, 'kukucka', '', 1),
(32, 1, 'Doc. Ing. ', 'Vladimír', 'Kutiš', 'PhD.', 1, 'kutis', '', 1),
(33, 1, 'Ing.', 'Tomáš', 'Malatinec', '', 4, 'malatinec', '', 1),
(34, 1, 'Ing.', 'Juraj', 'Matej', 'PhD.', 1, 'matej', '', 1),
(35, 1, 'Prof. Ing. ', 'Justín', 'Murín', 'DrSc.', 1, 'murin', '', 1),
(36, 1, 'Ing.', 'Filip', 'Noge', '', 2, 'noge', '', 1),
(37, 1, 'Ing.', 'Martin', 'Nováček', '', 3, 'novacek', '', 1),
(38, 1, 'Ing.', 'Jakub', 'Osuský', 'PhD.', 2, 'osusky', '', 1),
(39, 1, 'Ing.', 'Juraj', 'Paulech', 'PhD.', 1, 'paulech', '', 1),
(40, 1, 'Doc. Ing. ', 'Peter', 'Podhoranský', 'PhD.', 3, 'podhoransky', '', 1),
(41, 1, 'Ing.', 'Vladimír', 'Popelka', '', 4, 'popelka', '', 1),
(42, 1, 'Ing.', 'Anton', 'Pytel', '', 2, 'pytel', '', 1),
(43, 1, 'Ing.', 'Eduard', 'Ribar', '', 1, 'ribar', '', 1),
(44, 1, 'Doc. Ing. ', 'Danica', 'Rosinová', 'PhD.', 2, 'rosinova', '', 1),
(45, 2, 'Ing.', 'Tibor', 'Sedlár', '', 1, 'sedlar', '', 1),
(46, 1, 'Ing.', 'Dávid', 'Soós', '', 4, 'soos', '', 1),
(47, 1, 'Doc. Ing. ', 'Ján', 'Šturcel', 'PhD.', 3, 'sturcel', '', 1),
(48, 1, 'Ing.', 'Peter', 'Ťapák', 'PhD.', 4, 'tapak', '', 1),
(49, 1, 'Ing.', 'Peter', 'Valach', '', 2, 'valach', '', 1),
(50, 2, 'Doc. Ing. ', 'Katarína', 'Žáková', 'PhD.', 2, 'zakova', '', 1),
(51, 2, 'Bc.', 'Matej', 'Rábek', '', 4, 'xrabek', '', 1),
(52, 2, '', 'Peter', 'Sabol', '', 1, 'xsabolp', '', 1),
(53, 2, '', 'tt', 'ss', '', 2, 'xsalak', '', 1),
(56, 1, 'prof.ing.doc.xml', 'aa', 'aa', 'PhD.', 1, 'aa', '', 0),
(57, 1, 'asd', 'avc', 'avc', 'asd', 1, 'sad', 'asd', 1),
(58, 3, 'Bc.', 'Helmut', 'Posch', '', 1, 'xposch', '', 1),
(59, 1, 'test', 'test', 'test', 'test', 1, 'adas', '', 1),
(60, 1, 's', 'sssssssssss', 'sssssssssssss', '', 1, 'ssssssssss', 'sssssss@ssss.ss', 1),
(61, 2, 'skoro ', 'Stevo', 'Majiros', 'Bc', 1, 'xmajiros', NULL, 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `person_type`
--

CREATE TABLE `person_type` (
  `id` int(11) NOT NULL,
  `rola` varchar(15) COLLATE utf8_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `person_type`
--

INSERT INTO `person_type` (`id`, `rola`) VALUES
(1, 'učiteľ'),
(2, 'admin'),
(3, 'veduci');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `room` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `room`
--

INSERT INTO `room` (`id`, `room`) VALUES
(1, 'CD150'),
(2, 'DE35'),
(3, 'D405'),
(4, 'D520'),
(5, 'D601'),
(6, 'T015'),
(7, 'D422'),
(8, 'T004'),
(9, 'D406'),
(10, 'B206'),
(11, 'C802'),
(12, 'D010a'),
(13, 'D010b'),
(14, 'CD35'),
(15, 'T014'),
(16, 'B223'),
(17, 'AB150'),
(18, 'C517'),
(19, 'B004'),
(20, 'A801'),
(21, 'A806'),
(22, 'A711'),
(23, 'B704'),
(24, 'B102'),
(25, 'D519'),
(26, 'B003');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note` varchar(64) COLLATE utf8_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `schedule_lecture`
--

CREATE TABLE `schedule_lecture` (
  `lecture_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `code` varchar(16) NOT NULL,
  `name` varchar(64) NOT NULL,
  `acronym` varchar(8) NOT NULL,
  `lectureDuration` int(1) NOT NULL DEFAULT '2',
  `exceriseDuration` int(1) NOT NULL DEFAULT '2',
  `color` varchar(7) NOT NULL DEFAULT '#00D000',
  `term` varchar(1) NOT NULL,
  `year` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `subject`
--

INSERT INTO `subject` (`id`, `code`, `name`, `acronym`, `lectureDuration`, `exceriseDuration`, `color`, `term`, `year`, `active`) VALUES
(1, '123', 'adsadas', 'sadas', 2, 2, '#FFCCDD', 'S', 1, 1),
(2, '38111_3I', 'Multimédiá ', 'MM', 2, 3, '#E391AF', 'S', 1, 1),
(3, '37148_3I', 'Multimédiá v riadení ', 'MMVR', 3, 2, '#91E3C5', 'S', 2, 1),
(4, '38158_3I', 'Projektovanie komplexných mechatronických systémov', 'PKMS', 2, 2, '#E3BF91', 'S', 2, 1),
(5, ' 33171_3B', 'Nelineárne systémy', 'NLS', 3, 2, '#98BF49', 'S', 1, 1),
(6, '37181_3I', 'Riadenie zložitých systémov    ', 'RZS', 3, 2, '#BF7049', 'S', 1, 1),
(7, 'Tp1718', 'Testpredmetu1617', 'tp78', 2, 2, '#FFCCDD', 'S', 2, 1),
(9, '38176_3B', 'Automatizácia 2  ', 'A2', 2, 2, '#FFD700', 'S', 2, 1),
(10, '38159-3I', 'PLC systémy v mechatronike ', 'PLCSM', 2, 2, '#ADD8E6', 'S', 2, 1),
(11, '35382-3I', 'Rádiová komunikácia', 'RK', 3, 2, '#F0E68C', 'S', 2, 1),
(12, '32357-3B', 'Mikrovlnná technika a rádiokomunikácie', 'MTR', 2, 2, '#00FFFF', 'S', 2, 1),
(13, '35361-3I', 'Signálové procesory', 'SP', 3, 2, '#FFA500', 'W', 1, 1),
(14, '38174-3B', 'Priemyselné komunikačné zbernice', 'PKZ', 2, 2, '#FFC0CB', 'S', 1, 1),
(15, '30117-3B', 'Prvky riadiacich systémov', 'PRS', 3, 2, '#87CEEB', 'S', 1, 1),
(16, '11', 'Telemedicínska technika', 'TmT', 3, 2, '#A6D490', 'S', 1, 1),
(17, '22', 'Senzorové systémy CIM', 'SSCIM', 3, 2, '#BE90D4', 'S', 1, 1),
(18, '33', 'Záznam signálov', 'ZS', 3, 2, '#9790D4', 'S', 2, 1),
(19, '33', 'Pohonné jednotky automobilov', 'PJA', 2, 2, '#90CDD4', 'S', 1, 1),
(20, '51', 'Multifyzikálne procesy v mechatronike', 'MFPM', 2, 3, '#D46A8F', 'S', 1, 1),
(21, '52', 'Mechanika', 'MECH', 2, 2, '#CFB4BD', 'S', 1, 1),
(22, '53', 'Stavba automobilov', 'STAU', 2, 2, '#F20A5B', 'S', 1, 1),
(23, '54', 'Konštruovanie vyššími CAD systémami', 'KVCADS', 2, 2, '#119992', 'S', 1, 1),
(24, '55', 'Nekonvenčné pohony automobilov', 'NPA', 2, 2, '#7D9669', 'W', 1, 1),
(25, '56', 'Počítačové riešenie polí', 'PRP', 2, 2, '#8A822B', 'W', 2, 1),
(26, '123', 'adsadas', 'sadas', 2, 2, '#FFCCD1', 'W', 2, 1),
(27, 'asd', 'sad', 'ad', 10, 2, '', 'W', 1, 1),
(28, 'Tp1718', 'Testpredmetu1718', 'tp78', 2, 2, '#FFCCDD', 'W', 2, 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `year`
--

CREATE TABLE `year` (
  `id` int(11) NOT NULL,
  `year` varchar(11) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `year`
--

INSERT INTO `year` (`id`, `year`, `active`) VALUES
(1, '2015/2016', 0),
(2, '2016/2017', 0),
(7, '2017/2018', 1),
(8, '2014/2015', 0);

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `consultation`
--
ALTER TABLE `consultation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexy pre tabuľku `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`idGroups`);

--
-- Indexy pre tabuľku `lecture`
--
ALTER TABLE `lecture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_id` (`person_id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexy pre tabuľku `lecture_type`
--
ALTER TABLE `lecture_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ldap` (`ldap`),
  ADD KEY `idGroup` (`idGroup`),
  ADD KEY `person_type` (`person_type`);

--
-- Indexy pre tabuľku `person_type`
--
ALTER TABLE `person_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Indexy pre tabuľku `schedule_lecture`
--
ALTER TABLE `schedule_lecture`
  ADD UNIQUE KEY `lecture_id` (`lecture_id`,`schedule_id`),
  ADD KEY `schedule_id` (`schedule_id`);

--
-- Indexy pre tabuľku `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `year` (`year`);

--
-- Indexy pre tabuľku `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `year` (`year`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `consultation`
--
ALTER TABLE `consultation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pre tabuľku `lecture`
--
ALTER TABLE `lecture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT pre tabuľku `lecture_type`
--
ALTER TABLE `lecture_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pre tabuľku `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT pre tabuľku `person_type`
--
ALTER TABLE `person_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pre tabuľku `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT pre tabuľku `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pre tabuľku `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT pre tabuľku `year`
--
ALTER TABLE `year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `consultation`
--
ALTER TABLE `consultation`
  ADD CONSTRAINT `consultation_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Obmedzenie pre tabuľku `lecture`
--
ALTER TABLE `lecture`
  ADD CONSTRAINT `lecture_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lecture_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lecture_ibfk_3` FOREIGN KEY (`type_id`) REFERENCES `lecture_type` (`id`),
  ADD CONSTRAINT `lecture_ibfk_4` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Obmedzenie pre tabuľku `person`
--
ALTER TABLE `person`
  ADD CONSTRAINT `person_ibfk_1` FOREIGN KEY (`idGroup`) REFERENCES `group` (`idGroups`) ON UPDATE CASCADE,
  ADD CONSTRAINT `person_ibfk_2` FOREIGN KEY (`person_type`) REFERENCES `person_type` (`id`) ON UPDATE CASCADE;

--
-- Obmedzenie pre tabuľku `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `person` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Obmedzenie pre tabuľku `schedule_lecture`
--
ALTER TABLE `schedule_lecture`
  ADD CONSTRAINT `schedule_lecture_ibfk_1` FOREIGN KEY (`lecture_id`) REFERENCES `lecture` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_lecture_ibfk_2` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
