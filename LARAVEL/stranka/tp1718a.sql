-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Hostiteľ: localhost
-- Čas generovania: Ne 11.Mar 2018, 20:28
-- Verzia serveru: 10.0.34-MariaDB-0ubuntu0.16.04.1
-- Verzia PHP: 7.0.25-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `tp1718a`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `documents`
--

CREATE TABLE `documents` (
  `d_id` int(11) NOT NULL,
  `dc_id` int(11) NOT NULL,
  `hash_name` varchar(64) NOT NULL,
  `name_sk` varchar(64) NOT NULL,
  `name_en` varchar(64) NOT NULL,
  `text_en` longtext,
  `text_sk` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `documents`
--

INSERT INTO `documents` (`d_id`, `dc_id`, `hash_name`, `name_sk`, `name_en`, `text_en`, `text_sk`) VALUES
(20, 28, '228fed74c4e664ad1ee8d29376e40e23', 'aaaaaaaaaaaaa', 'ffaaaaaaaaaaaaaaaaaaa', NULL, NULL),
(21, 29, 'cfa79772df0d4ff87f9b18b45859edb7', 'ffffffffffffff', 'rrrrrrrrr', NULL, NULL);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `documents_categories`
--

CREATE TABLE `documents_categories` (
  `dc_id` int(11) NOT NULL,
  `hash_name` varchar(64) NOT NULL,
  `name_sk` varchar(64) NOT NULL,
  `name_en` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `documents_categories`
--

INSERT INTO `documents_categories` (`dc_id`, `hash_name`, `name_sk`, `name_en`) VALUES
(28, '05ca45fd83cec7138418ded7bf8ca1e1', 'fasdfsa', 'fasdfsa'),
(29, '3e6d323002fccd92b892c8a154de2e0a', 'dfasdfasdf', 'dfasdfas');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `documents_files`
--

CREATE TABLE `documents_files` (
  `df_id` int(11) NOT NULL,
  `hash_id` varchar(64) NOT NULL,
  `file_hash` varchar(64) NOT NULL,
  `file_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `documents_files`
--

INSERT INTO `documents_files` (`df_id`, `hash_id`, `file_hash`, `file_name`) VALUES
(20, '3529c0392287d1d4d71df25ca4044428', 'RIPcS7uOhhzGPmALHHIBERjtbjptQ5xttjs5lV4r.png', 'monkey1.png');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `events`
--

CREATE TABLE `events` (
  `e_id` int(11) NOT NULL,
  `name_sk` varchar(128) NOT NULL,
  `name_en` varchar(128) DEFAULT NULL,
  `text_sk` mediumtext,
  `text_en` mediumtext,
  `url` varchar(512) DEFAULT NULL,
  `place` varchar(64) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `time` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `events`
--

INSERT INTO `events` (`e_id`, `name_sk`, `name_en`, `text_sk`, `text_en`, `url`, `place`, `date`, `time`) VALUES
(2, 'fasdfasd', 'fasdfasdfasdfasdf', 'fdfasdfasfdasfsa', 'dfasdfsadfs', 'http://www.google.com', 'fasdfasdfsad', 1519801728, '15:45'),
(3, 'Fakultná prehliadka prác ŠVOČ', 'Fakultná prehliadka prác ŠVOČ', 'Tu je nejaký popis k udalosti. Môže byť dlhší/kratší ...', 'This is ...', '', 'FEI', 1524009600, '8:00'),
(4, 'Veľký piatok', NULL, NULL, NULL, 'http://www.gmail.com', NULL, 1522368000, NULL),
(5, 'Deň pracovného pokoja', 'Day', NULL, NULL, '', NULL, 1525737600, NULL),
(6, 'Veľkonočný pondelok', NULL, NULL, NULL, '', NULL, 1522627200, NULL),
(7, 'Deň pracovného pokoja', NULL, 'Deň pracovného pokoja', NULL, '', NULL, 1525132800, NULL);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `media`
--

CREATE TABLE `media` (
  `m_id` int(11) NOT NULL,
  `date` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `media` varchar(50) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `url` varchar(200) CHARACTER SET utf8 COLLATE utf8_slovak_ci DEFAULT NULL,
  `title_EN` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `activated` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `media`
--

INSERT INTO `media` (`m_id`, `date`, `title`, `media`, `type`, `url`, `title_EN`, `activated`) VALUES
(35, 1517574124, 'test files', 'test files', 'server', NULL, 'test files', 0),
(36, 1517574150, 'test url', 'test url', 'link', 'www.google.com', 'test url', 0),
(37, 1517574172, 'test both', 'test both', 'both', 'www.google.com', 'test both', 0),
(38, 1517576250, 'test bad url', 'test bad url', 'link', 'www.google.com', 'test bad url', 0),
(39, 1517576329, 'fsdafsa', 'dfasdfas', 'link', 'www.google.com', 'dfasdfas', 0),
(40, 1517576429, 'fsadfsad', 'fsadfsadfas', 'link', 'http://www.google.com', 'dsfsadfas', 0),
(41, 1517582317, 'fasdfas', 'dafsadfsadf', 'server', NULL, 'asdfasdfsadf', 0),
(42, 1517582332, 'dfasdfasdfas', 'fdfdfdfd', 'server', NULL, 'dfsdfsdfsdfs', 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `media_files`
--

CREATE TABLE `media_files` (
  `mf_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `file_name` varchar(64) NOT NULL,
  `hash_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `media_files`
--

INSERT INTO `media_files` (`mf_id`, `m_id`, `file_name`, `hash_name`) VALUES
(28, 35, 'test2.jpg', 'ciBNG7Wg0j7j2qKygVK6CzZdIFnRGIFKWiEYu3qU.jpeg'),
(29, 35, 'water.jpg', 'GoPQ96aDoSH446QNTkHM30cCuOeVAcfUzXvvX038.jpeg'),
(30, 37, 'banana.jpg', '8gHQgysawrEnB6U7C1YG1egONMPwNg2ITygMv5q1.jpeg'),
(31, 37, 'path.jpg', 'MvfkUvTT6b7mf54HuUx2QqGAYIzdJ0BWv4WEE493.jpeg'),
(32, 41, 'test2.jpg', 'kFqwy9wvJcomxcfjIm9qDKEGJY6qWyq0PGTFFv4u.jpeg'),
(33, 42, 'monkey1.png', 'tK4wS367vkAC5ke4yiIHNRrDsZeKUguWOasHRb5V.png');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `nepritomnosti`
--

CREATE TABLE `nepritomnosti` (
  `at_id` int(11) NOT NULL,
  `id_zamestnanca` int(11) NOT NULL,
  `id_typu` int(11) NOT NULL,
  `rok` int(11) NOT NULL,
  `mesiac` int(11) NOT NULL,
  `den` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `nepritomnosti`
--

INSERT INTO `nepritomnosti` (`at_id`, `id_zamestnanca`, `id_typu`, `rok`, `mesiac`, `den`) VALUES
(511, 7, 1, 2018, 1, 10),
(512, 6, 1, 2018, 1, 11),
(513, 5, 1, 2018, 1, 12),
(515, 4, 1, 2018, 1, 13),
(516, 3, 1, 2018, 1, 14),
(517, 4, 1, 2018, 1, 14),
(518, 5, 1, 2018, 1, 14),
(519, 6, 1, 2018, 1, 14),
(520, 7, 1, 2018, 1, 14),
(521, 8, 1, 2018, 1, 14),
(522, 9, 1, 2018, 1, 14),
(523, 10, 1, 2018, 1, 14),
(524, 11, 1, 2018, 1, 14),
(525, 12, 1, 2018, 1, 14);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `hash_id` varchar(32) NOT NULL,
  `title_en` varchar(256) CHARACTER SET ucs2 COLLATE ucs2_slovak_ci NOT NULL,
  `title_sk` varchar(256) CHARACTER SET ucs2 COLLATE ucs2_slovak_ci NOT NULL,
  `image_hash_name` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `preview_sk` text CHARACTER SET utf8 NOT NULL,
  `preview_en` text CHARACTER SET utf8 NOT NULL,
  `editor_content_sk` longtext CHARACTER SET utf8,
  `editor_content_en` longtext CHARACTER SET utf8,
  `date_created` int(11) NOT NULL,
  `date_expiration` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '0 - Propagácia, 1 - Oznamy, 2 - Zo života fakulty'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `news`
--

INSERT INTO `news` (`id`, `hash_id`, `title_en`, `title_sk`, `image_hash_name`, `preview_sk`, `preview_en`, `editor_content_sk`, `editor_content_en`, `date_created`, `date_expiration`, `type`) VALUES
(13, '5a8f078aeb130', 'fasdfasdfas', 'fasdfsadfsd', '4esFpnICWHayHXTlezG8nvcyCkrdt3gckufgNXWQ.jpeg', 'dfasdfsadfas', 'fsadfasdf', '<p>dfasdfasdfasdfsadfasf</p>', NULL, 1519323389, 1519257600, 0),
(22, '5a95692a76446', 'sdfnsajdnfsjkdfn', 'njdnfjasndfjanj', 'V1dKtKa7Erw4XglkFhxuDwHetySAtuvRsrqytM4q.jpeg', 'dfmnsdfaskjfsj', 'dsnfsjknfkjsdnkjfs', '<p>fasdfasdfasdfasf<img src="/storage/news/5a95692a76446/U5agRsfHJtYcP6dn71LI48U8aSou8mwTYAZfT5zj.png" style="width: 303px;"></p>', NULL, 1519741280, 1519741280, 0),
(23, '5a9658ae53370', 'monin', 'asdfasdfasdfsafdasfs', 'GvDfKdn9dZYuhTub24OPnbPpnFGrZz3hJYUDSgbQ.jpeg', 'n', 'jnijnijn', '<p>osadmfomsaokdmfsa<b>fasdfsadfasdfas</b><img src="/storage/news/5a9658ae53370/RTvmy9RXyK1hEqXFHK9zNHg0Rmod4v7JnGCgMpnV.png" style="width: 669px;"></p>', NULL, 1519802591, 1519802591, 2);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `lang` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`, `lang`) VALUES
(17, 'michal.kocur@stuba.sk', 'SK'),
(53, 'aaa@gggg.vvv', 'SK');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `news_dl_files`
--

CREATE TABLE `news_dl_files` (
  `nf_id` int(11) NOT NULL,
  `n_id` int(11) NOT NULL,
  `file_hash` varchar(64) NOT NULL,
  `file_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `news_dl_files`
--

INSERT INTO `news_dl_files` (`nf_id`, `n_id`, `file_hash`, `file_name`) VALUES
(10, 1, 'la2cZufNyyqe7NIDnTR7RZO7TIRfl9f2WmWs12US.jpeg', 'monkey.jpg'),
(11, 1, 'nPORTnsw3VWILBz2qWbWAtKs30tAFQIcFcgVBxQw.png', 'monkey1.png'),
(12, 1, '24PtSET961Cmh16RHveuCgsItsaL3DKTb0igwZjp.jpeg', 'path.jpg'),
(13, 1, 'FFrBFvFGSjBlSoQR05X0bDkwP3Lrdn6J5cH9NGUw.jpeg', 'success.jpg'),
(14, 1, 'KbcXAUgKr6yjWgmnBOkgnxAUMnVOP4kSP3FMqkXC.jpeg', 'test.jpg'),
(16, 13, 'hDfmGfYIzaHOVRfcBXZLcG0sJFqjNHTQACFNaKIG.jpeg', 'test.jpg'),
(17, 13, '4kQZRwl2sDC6V5YbddfKnTEVG2fwf8Kdpxps81FG.jpeg', 'test2.jpg');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `photos`
--

CREATE TABLE `photos` (
  `p_id` int(11) NOT NULL,
  `pg_id` int(11) NOT NULL,
  `file_name` varchar(128) NOT NULL,
  `hash_name` varchar(128) NOT NULL,
  `date_added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `photos`
--

INSERT INTO `photos` (`p_id`, `pg_id`, `file_name`, `hash_name`, `date_added`) VALUES
(17, 29, '13 Meranie 01_0.JPG', 'LjUiDnAoWo4OhI4zjlK49a53LnW9xYFbEd4NDVKK.jpeg', 1517944493),
(18, 29, '2015-09-25-6460.jpg', 'dj4xNjOp204P9JwDOMiNExHqH31mwSv3GE4s06GB.jpeg', 1517944493),
(19, 29, '2015-09-25-6465.jpg', 'aHs9FjkdXBN9qXel9jVL9knchkP7mh681jvQ3rJ8.jpeg', 1517944494),
(20, 29, '2015-09-25-6470.jpg', 'dXz9IxRDgX2RuImdEbibRJlU6ACfNPZEs7D9BtHr.jpeg', 1517944494),
(21, 29, '2015-09-25-6471.jpg', 'JdBqHoIU5gAOcrfbrSo1IibiM3LGlT1h1SyhFFtT.jpeg', 1517944494),
(22, 29, '2015-09-25-6476.jpg', '3B1TAb5b8WAANjgfNDclWZ40CSXWqQw3dr4UxbhO.jpeg', 1517944494),
(23, 29, '2015-09-25-6477.jpg', 'ZbuF9on5MprL2DrGKfrEWiYCXG04CL9sh9rOKneg.jpeg', 1517944494),
(24, 29, '2015-09-25-6483.jpg', 'bFW3RgqhJtm2qkxFHLbxuka7LTMc6BaRedk5xpCy.jpeg', 1517944494),
(25, 29, '2015-09-25-6535.jpg', 'BIY3STljtbU6RN5TvNTF9yLWy6Qy0s80tDGkYAQb.jpeg', 1517944495),
(26, 29, '2015-09-25-6557.jpg', 'p8sqHJ8rDnLXvmbOP3clhTeJ7K0fEQBAKfgot5NV.jpeg', 1517944495),
(27, 29, '2015-09-25-6568.jpg', 'OiESwYwy9esJz5iGO3s2IdNT0Jw6PWm4ykVqgpzY.jpeg', 1517944495),
(28, 28, '_MG_5627.JPG', 'q0n70NjfFdmgC2tjnO7FhHzK7ngwnpia8pcuHDtW.jpeg', 1517944518),
(29, 28, '_MG_5635.JPG', 'HPGfmePjyP5iFjvve60Vp7PEgd5mzxsBNxO0ErDP.jpeg', 1517944518),
(30, 28, '_MG_5674.JPG', 'aGrEbacRWSKnCugeMeMMklQ7NcWGkdbS5phAYZX8.jpeg', 1517944520),
(31, 28, '_MG_5688.JPG', 'ZOcctbRL9cdlFkhV400scMQTdnlbiqy7MO3NBnfR.jpeg', 1517944520),
(32, 28, '_MG_5728.JPG', 'YVdurCscVZlu3oI5Sw0AeV3Bx7pVQ5nJDKnoEyc6.jpeg', 1517944520),
(33, 28, 'DSCN8589.JPG', 'owhmhJ8PdJ5QvPYORJqjq7Ff4bMTxHpB01JQUGQT.jpeg', 1517944520);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `photo_gallery`
--

CREATE TABLE `photo_gallery` (
  `pg_id` int(11) NOT NULL,
  `title_SK` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `title_EN` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `folder` varchar(50) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `date` int(11) NOT NULL,
  `activated` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `photo_gallery`
--

INSERT INTO `photo_gallery` (`pg_id`, `title_SK`, `title_EN`, `folder`, `date`, `activated`) VALUES
(28, 'Deň otvorených dverí na ÚAMT FEI STU', 'Open day at UAMT FEI STU', '77c563ff2d64fe252c2b9b938b1f5b07', 1517938634, 1),
(29, 'Noc výskumníkov', 'Night of researchers', 'a667b8cbcad152b2b1d2730e102f3727', 1517938727, 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `project`
--

CREATE TABLE `project` (
  `pr_id` int(11) NOT NULL,
  `projectType` varchar(100) COLLATE utf8_slovak_ci NOT NULL,
  `number` varchar(30) COLLATE utf8_slovak_ci NOT NULL,
  `titleSK` varchar(500) COLLATE utf8_slovak_ci NOT NULL,
  `titleEN` varchar(500) COLLATE utf8_slovak_ci DEFAULT NULL,
  `duration` varchar(30) COLLATE utf8_slovak_ci DEFAULT NULL,
  `coordinator` varchar(150) COLLATE utf8_slovak_ci DEFAULT NULL,
  `partners` varchar(1000) COLLATE utf8_slovak_ci DEFAULT NULL,
  `web` varchar(500) COLLATE utf8_slovak_ci DEFAULT NULL,
  `internalCode` varchar(15) COLLATE utf8_slovak_ci DEFAULT NULL,
  `annotationSK` varchar(5000) COLLATE utf8_slovak_ci DEFAULT NULL,
  `annotationEN` varchar(5000) COLLATE utf8_slovak_ci DEFAULT NULL,
  `activated` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `project`
--

INSERT INTO `project` (`pr_id`, `projectType`, `number`, `titleSK`, `titleEN`, `duration`, `coordinator`, `partners`, `web`, `internalCode`, `annotationSK`, `annotationEN`, `activated`) VALUES
(1, 'VEGA', '1/0937/14 ', 'Pokročilé metódy nelineárneho modelovania a riadenia mechatronických systémov \r\n', 'Advanced methods for nonlinear modeling and control of mechatronic systems \r\n', '2014-2017', 'prof. Ing. Mikuláš Huba, PhD. ', '', NULL, '1425', 'Projekt sa zameriava na rozvoj metód nelineárneho riadenia a ich aplikácií. Zahrňuje metódy algebrického a diferenciálneho prístupu k návrhu nelineárnych systémov, riadenie časovo oneskorených (time delayed) systémov a systémov s obmedzeniami uvažovaných ako súčasť hybridných, autonómnych a inteligentných systémov, metódy simulácie, modelovania a automatizovaného návrhu s využitím podporných numerických a symbolických metód a programov. Venuje sa formulácii riešených problémov v rámci vnorených (embedded) systémov a PLC, spracovaniu signálov, zohľadneniu aspektov riadenia cez Internet, mobilné a rádiové siete, identifikácii a kompenzácii nelinearít, integrácii jednotlivých prístupov pri implementácii a fyzickej realizácii konkrétnych algoritmov a štruktúr riadenia. Pôjde najmä o riadenie mechatronických, robotických a ďalších systémov s dominantnými nelinearitami.', 'The project focuses on development of nonlinear control methods and their applications. It includes algebraic and differential approach to nonlinear control, control of time-delayed and constrained systems considered as a part of hybrid autonomous intelligent systems, simulations modeling and automatized design based on numeric and symbolic computer aided methods. It is dealing with formulation of solved problems within the embedded systems and PLCs, with signal processing, control via Internet, mobile and radio networks, with identification and compensation of nonlinearities, integration of particular approaches in implementing and physically accomplishing particular algorithms and structures. Thereby, one considers especially mechatronic and robotic systems and other systems with dominating nonlinear behavior.', 1),
(2, 'VEGA', '1/0228/14', 'Modelovanie termohydraulických a napätostných pomerov vo vybraných komponentoch tlakovodných jadrových reaktorov ', 'Modelling of thermohydraulic and stress conditions in selected components of NPP with pressurized water reactor ', '2014-2016', 'doc. Ing. Vladimír Kutiš, PhD. ', '', '', '1435', 'Cieľom predkladaného projektu je tvorba matematických modelov vybraných komponentov jadrových zariadení tlakovodného jadrového reaktora ako sú palivová kazeta, aktívna zóna ako aj celý jadrový reaktor. Tieto komponenty budú analyzované z pohľadu termohydrauliky ako aj z pohľadu mechanického (napätostného) namáhania. Takto získané numerické výsledky budú konfrontované s dostupnými experimentálnymi údajmi daných zariadení, pričom cieľom má byť zvyšovanie bezpečnosti prevádzky týchto zariadení. Pri tvorbe jednotlivých matematických modelov budú použité moderné numerické metódy, ako sú Computational Fluid Dynamics (CFD) a Metóda Konečných Prvkov (MKP), ktoré sú implementované v programoch ANSYS CFX a ANSYS Multiphysics. Súčasťou predkladaného projektu bude realizácia prepojenia matematických modelov termohydrauliky a mechanického namáhania, ktoré bude realizované tak, aby jednotlivé fyzikálne domény boli priamo previazané. Výstupom projektu okrem matematických modelov budú aj vedecké a odborné články a príspevky.', 'The aim of this project is to create mathematical models of selected components of nuclear power plants like fuel assembly, the active zone as well as a nuclear reactor itself considering pressurized water reactor. These components will be analyzed in terms of thermo-hydraulics and mechanical point of view (stress loading). Obtained numerical results will be confronted with available experimental data to increase operational safety of these devices. In the process of developing the mathematical models modern numerical methods such as Computational Fluid Dynamics (CFD) and Finite Element Method (FEM) will be used. These methods are implemented in programs ANSYS CFX and ANSYS Multiphysics. The proposed project will interconnect the thermo-hydraulic and mechanical mathematical models, which will be implemented so that the individual physical domains were directly connected. The outcome of the project will be the mathematical models and also scientific and technical papers and conference contributions.', 1),
(3, 'VEGA', '1/0453/15', 'Výskum stiesneného krútenia uzatvorených prierezov ', 'Research of nonuniform torsion of cross-sections ', '2015-2017 ', 'prof. Ing. Justín Murín, DrSc. ', NULL, NULL, '1479', '"Podstatou projektu je skúmanie účinkov stiesneného krútenia v nosníkoch s uzatvoreným tenkostenným prierezom numerickými metódami ako aj experimentálnym meraním na fyzikálnych modeloch. Bude vytvorený nový 3D nosníkový konečný prvok so zahrnutím stiesneného krútenia uzatvorených prierezov, kde sa uplatní deformačný účinok sekundárneho krútiaceho momentu. Matica tuhosti a hmotnosti bude zostavená pre homogénny materiál ako aj pre kompozitné nosníky s pozdĺžnou premenlivosťou materiálových vlastností.\r\nOdvodené vzťahy a rovnice budú implementované do počítačového programu pre elastostatickú a modálnu analýzu s uvažovaním stiesneného krútenia. Bude navrhnuté a vyrobené meracie zariadenie, ktorým sa budú verifikovať výsledky teoretických výpočtov novým konečným prvkom. Predpokladá sa, že výsledky riešenia projektu prispejú ku zmene tvrdenia normy EC 3, podľa ktorej vplyv stiesneného krútenia možno pri nosníkoch uzatvoreného prierezu zanedbať. Výsledky nášho výskumu majú za cieľ zvýšiť bezpečnosť projektovania mechanických sústav."\r\n', 'The project aim is to examine the effects of non-uniform torsion in thin-walled beams with closed cross-section by numerical methods and experimental measurements on physical models. A 3D beam finite element will be created including the non-uniform torsion with the secondary torsion moment deformation effect. The stiffness and mass matrix will be prepared for a homogeneous material as well as for composite beams with longitudinal variation of material properties. Derived relations and equations will be implemented in the computer programs for elastic-static and modal analyses. Measurement equipment will be designed, by which the results of theoretical calculations by the new finite elements will be verified. It is expected that the results of the project will contribute to review the arguments of the Eurocode 3, according to which the effect of non-uniform torsion can be neglected in the closed cross-section beams. The results of the project are intended to enhance the safety of the beam structures design.\r\n', 1),
(4, 'KEGA\r\n', '035STU-4/2014', 'Návrh virtuálneho laboratória pre implementáciu pokrocilých metodík výucby v novom študijnom programe Elektromobilita \r\n', 'Development of virtual laboratory for implementation of advanced methods of teaching in the new study program Electromobility \r\n', '2014-2016', 'prof. Ing. Viktor Ferencey, PhD. \r\n', '1709', '', NULL, '"Projekt je zameraný na vybudovanie moderného špecializovaného virtuálneho laboratória pre pripravovaný študijný program Elektromobilita. V projekte sú navrhnuté pokročilé metódy výučby, ktoré integrujú tvorivú implementáciu teoretických poznatkov priamo do virtuálneho modelovania a simulovania mechatronických systémov v inteligentných vozidlách s elektrickým pohonom, t.j. elektromobiloch.\r\nPre podporu špecializovaného vzdelávania a novú metodológiu v študijnom programe Elektromobilita bude v projekte spracovaná nová moderná študijná literatúra a vybudované Špecializované virtuálne laboratórium s inovatívnym vybavením pre teoretickú i praktickú výučbu predmetov v tomto študijnom programe. Všetky predmety programu Elektromobilita sú zamerané na virtuálne prototypovanie smart mechatronických systémov používaných v elektromobiloch s náväznosťou na nové systémy pohonu dopravných prostriedkov s využitím virtuálneho prototypovania.\r\nSúčasťou projektu bude spracovanie študijných materiálov, vedeckých monografií, tvorba inovatívnej web stránky, publikovanie v odborných časopisoch a účasť na vedeckých konferenciách. Špecializované virtuálne laboratórium bude vybavené mechatronickými učebnými modulmi pre výučbu a štúdium sofistikovaných technológií."\r\n', 'The project aim it to build a modern specialized virtual laboratory for prepared study program Electromobility. In this project, advanced teaching methods are proposed that integrate theoretical knowledge into practical application directly into mechatronic systems in vehicles with electric drive (electric vehicles). To promote specialized training and a new methodology in the study program Electromobility, the project will support processing of a new modern study literature and creating a dedicated virtual laboratory with innovative facilities for theoretical and practical training courses in this program of study. These courses aim at smart mechatronic systems used in electromobility systems with links to the new drive systems of vehicles using virtual prototyping. The project includes new study materials processing, writing scientific monographs, creating innovative websites, publications in peer-reviewed journals and participation in scientific conferences. Dedicated virtual laboratory will be equipped with educational mechatronic modules for teaching and learning sophisticated technology.\r\n', 1),
(5, 'KEGA', '032STU-4/2013', 'Online laboratórium pre výucbu predmetov automatického riadenia \r\n', 'Online laboratory for teaching automation control subjects \r\n', '1.1.2013-31.12.2015', 'doc. Ing. Katarína Žáková, PhD. ', '', NULL, '1719', '"Projekt sa zameriava na tvorbu interaktívnych znovupoužiteľných vzdelávacích objektov pre zvolené segmenty teórie automatického riadenia, na budovanie širšej škály experimentov ilustrujúcich aplikáciu študovaných teoretických prístupov na riešenie praktických problémov, ktoré umožňujú a podporujú nadobúdanie vedomostí, zručností, návykov a postojov v kvázi-autentickom prostredí.\r\nProjekt má za cieľ podporovať využitie nielen proprietárnych, ale aj open technológií, ktoré prinášajú viaceré výhody v oblasti šírenia výsledkov a nesporne aj po finančnej stránke. Snahou je uľahčiť prístup k laboratórnym experimentom v rámci rôznych foriem vzdelávania (denných, dištančných, resp. elektronických foriem)."\r\n', '"The project is focussed on development of interactive reusable learning objects for chosen segments of automatic control, on building broader spectrum of experiments illustrating application of studied\r\ntheoretical approaches onto practical problems enabling and supporting acquisition of knowledge, skills, habits and attitudes in an quasi-authentic environment.\r\nThe project is going to support the use of not only proprietary but also open technologies that bring various advantages in the area of results dissemination and from the financial point of view as well. Our aim is to facilitate approach to laboratory experiments for students in daily or distance form of education."\r\n', 1),
(6, 'KEGA', '030STU-4/2015', 'Multimediálna podpora vzdelávania v mechatronike ', 'Multimedial education in mechatronics ', '2015-2017', 'doc. Ing. Danica Rosinová, PhD. ', NULL, 'http://uamt.fei.stuba.sk/KEGA_MM/', '1723', 'Svetovým trendom v oblasti modernej a bezbariérovej výučby sú jej interaktívne formy na báze internetu, videa, audiovizuálnych pomôcok a vzdialených laboratórií (on-line vzdelávanie), ktoré sa uplatňujú nielen v dištančnom vzdelávaní, ale aj v prezenčnej forme vzdelávanie s podporou nových technológií (technology augmented classroom teaching). Popri slide-show prezentáciách a edukačných miniaplikáciách (dynamické web stránky, flash animácie, Java Applets a pod.) preferujú svetové výskumné univerzity vývoj a tvorbu edukačných videí, ktorých cieľovou skupinou sú poslucháči konkrétneho predmetu (kurzu). Edukačné videá sú voľne dostupné a umožňujú študentom sledovať výklad danej problematiky kdekoľvek a kedykoľvek. Návrh a realizácia zrozumiteľného a zaujímavo podaného edukačného videa z technickej oblasti je komplexná úloha, ktorá si vyžaduje synergiu odborných, pedagogických a umeleckých kvalít jeho tvorcov. Projekt je zameraný na multimediálnu podporu vzdelávania v oblasti mechatroniky, s dôrazom na poznatky z aplikovanej informatiky, automatizácie a príbuzných vedných disciplín. Cieľom projektu je vybudovanie multimediálneho laboratória na tvorbu kvalitných edukačných videomateriálov pre prezenčnú aj dištančnú formu univerzitného vzdelávania v oblasti mechatroniky a vytvorenie a otestovanie viacerých modulov takýchto materiálov. Výstupy projektu budú ďalej využiteľné pre účely vzdelávania odborníkov z praxe vrámci celoživotného vzdelávania, a tiež popularizácie mechatroniky a automatizácie u širokej verejnosti a žiakov stredných škôl - potenciálnych študentov vysokých škôl technického zamerania.', '"Presently, interactive education forms based on exploitation of Internet, video, audiovisual aids and remote laboratories (on-line education) are world trends in modern and barrier-free education;\r\nit is applied not only in distance education but in the attendance teaching as technology augmented classroom teaching. Along with slide-shows and educational miniapplications (dynamic websites,\r\nflash animations, Java Applets etc.) research universities usually prefer to develop their own education videos targeted to the audience in a single course. Education videos are freely available and enable the students to follow the explanatory discourse on the subject topic anytime and anywhere. Design and realization of a comprehensible and interesting educational video on a technological field is a quite complex task requiring synergy of technical, educational and artistic qualities of its creators. The project deals with the multimedia support of education in mechatronics engineering, with the focus on applied informatics, automation and related fields. The objective of the project is to build a multimedia laboratory for creating high-quality educational videomaterial for both distance and attendance education in mechatronics engineering. Project outcomes will be further employed in life-long education of practitioners, and for popularization of mechatronics and automation among the public and potential university students of technology."', 1),
(7, 'KEGA', '011STU-4/2015 ', 'Elektronické pedagogicko-experimentálne laboratóriá mechatroniky \r\n', 'Electronic educational-experimental laboratories of Mechatronics \r\n', '2015-2017', 'doc. Ing. Peter Drahoš, PhD. \r\n', NULL, 'http://uamt.fei.stuba.sk/kega/\r\n', '1724', '"Projekt sa zaoberá vytvorením modernej vedomostnej a experimentálnej základne pre výučbu mechatroniky s dôrazom na jej elektronické súčasti. Vzhľadom na to, že mechatronika integruje viaceré oblasti poznania a ich spojením vytvára synergický efekt, budú v rámci projektu budú vypracované nové metódy a formy vo výučbe, ktoré študentom umožnia získať nové poznatky s praktickou skúsenosťou s využívaním moderných elektronických prvkov a systémov, ktoré tvoria neoddeliteľnú súčasť komplexných mechatronických systémov v oblasti výrobkov spotrebnej elektroniky, energetiky, automobilovej techniky a v zdravotníctve.\r\nPodnetnou výzvou pre podanie projektu bol vznik nových študijných programoch""""Automobilová mechatronika"""" (Bc. program) a """"Aplikovaná mechatronika a elektromobilita"""" (Ing. program). Pre tieto študijné programy budú vytvorené elektronické učebné texty pre 7 predmetov.\r\nZa účelom ďalšieho zvyšovania kvality výučby a výskumu sa plánuje v rámci v rámci riešenia projektu vytvoriť 5 nových experimentálnych pracovísk podľa najnovších trendov v elektronike, snímacej technike a riadiacich systémoch, ktoré budú mať viacúčelové využitie v priamej pedagogike, v individuálnych a tímových študentských projektoch ako aj pri výskumnej a vývojovej činnosti ústavu.\r\nCieľom projektu je zvýšiť odborné kompetencie študentov, učiteľov a výskumných pracovníkov a všetkých zúčastnených v týchto oblastiach: moderné senzory a MEMS, aktuátory na báze smart materiálov, elektrické trakčné pohony, mikroradiče a DSP pre vstavané riadiace systémy a spracovanie signálov, návrh riadiacich algoritmov a ich programovanie, elektronika a integrované obvody (ASICs) pre mechatroniku. Ďalším dôležitým sub-cieľom riešenej problematiky je získať široké kompetencie v komunikačných systémoch pre rôzne aplikačné oblasti mechatronických systémov najmä v automobilovom priemysle.\r\nNavrhovaný projekt bude podporovaný prostredníctvom moderných audiovizuálnych systémov, prostredníctvom web stránky a videí s multimediálnym spracovaním."\r\n', 'The project deals with the creation of modern knowledge and experimental basis for education in Mechatronics Engineering with the emphasis on electronic components. Due to the fact that mechatronics integrates several fields of knowledge and their junction yields a synergy effect, new methods and forms of eduation will be elaborated within the project allowing students to acquire new knowledge combined with practical experience in using modern electronic components and systems; such systems are integral parts of complex pervasive mechatronic systems (in consumer electronics, energy and automotive industries, healthcare). Inspiration for elaboration of the proposed project was launching of new study programs ""Automotive Mechatronics"" (Bachelor degree), and ""Applied Mechatronics and Electromobility"" (Master degree). For these study programs electronic textbooks for 7 subjects will be created. To further increase quality of education and research, 5 new experimental workplaces are planned to be created within the project to according to the latest development trends electronics, sensing technology and control systems having multi-purpose exploitation in direct teaching, individual and team projects as well as in research and development activities of the Institute. The objective of the project is to increase professional competences of students, teachers and researchers, and all involved in the areas: advanced sensors and MEMS, smart materials based actuators, electric traction motors, microcontrollers and digital signal processors (DSP´s) for embedded control systems and signal processing, design of control algorithms and their programming, electronics and integrated circuits (ASICs) for mechatronics. Another important sub-objective is to acquire wide competences in communication systems for various application areas of mechatronic systems, in particular in automotive industry. Modern audiovisual systems, web pages and multimedia processed videos will be widely used to support project results.\r\n', 0),
(8, 'APVV', 'APVV-0246-12 ', 'Pokročilé metódy modelovania a simulácie SMART mechatronických systémov \r\n', 'Advanced Methods and Simulations of SMART Mechatronic Systems \r\n', '1.10.2013-30.9.2016', 'prof. Ing. Justín Murín, DrSc. \r\n', NULL, NULL, 'AK14', 'V prvej fáze riešenia projektu bude kladený dôraz na materiálové, technické a prístrojové zabezpečenie experimentálnych častí, ktoré budú v projekte riešené. V tejto fáze takisto budú odvodené MKP rovnice pre 3D-FGM nosníky ako aj multifyzikálne modely pre SMA. Súčasťou prvej fázy riešenia projektu bude taktiež začatá príprava fyzikálnych experimentov za účelom verifikácie matematických modelov FGM a SMA systémov. V nasledovnom období riešenia projektu bude vykonaná verifikácia matematických modelov na vybraných experimentálnych vzorkách, ktoré boli dôsledne experimentálne analyzované z hľadiska materiálového zloženia. Výsledky experimentálnych meraní na SMA aktuátore budú využité v nasledovnom období riešenia projektu pri návrhu a realizácii alternatívneho spôsobu uchytenia SMA aktuátora. Bude nasledovať vytvorenie nelineárneho modelu aktuátora SMA a návrhu nových metód syntézy zameraných na riadenie polohy a potlačenie dominantných porúch. V tomto období budú súčasne prebiehať výskumné práce na teoretickom odvodení MKP rovníc pre FGM škrupinu a jej spojenia s 3D-FGM nosníkovým prvkom do kombinovaného nosníkovo-škrupinového MEMSu. V záverečnej fáze projektu bude kladený dôraz jednak na verifikáciu odvodených MKP rovníc pre nosníkovo-škrupinový MEMS pomocou fyzikálneho experimentu ako aj na riadenie SMA aktuátora konvenčnými a inteligentnými metódami riadenia.\r\n', 'In the first phase, attention will be given to the material, technical and equipment set-up required for the first set experiments. At the same time, the FGM-beam FEM equations will be derived and SMA models designed. In addition, the first sets of experiments will be used for the verification of numerical models of 3D-FGM and SMA systems. A complex verification of numerical models will take place on selected samples whose chemistry has been consistently analyzed. Results of SMA actuator measurements will be used in the consecutive stages of the project in the design and application of alternative anchoring for SMA actuators. Next the nonlinear model of SMA actuator and new methods of synthesis focused on position control and error elimination will be proposed. This research will take place in parallel with the theoretical analysis and FEM equations derivation of FGM shells. In the tp1718a stage, emphasis will be given to both the verification of the derived FGM beam-shell equations by real sample measurements and the control of the SMA actuator by conventional and intelligent methods.\r\n', 1),
(9, 'APVV', 'APVV-0343-12 ', 'Počítačová podpora návrhu robustných nelineárnych regulátorov \r\n', 'Computer aided robust nonlinear control design \r\n', '1.10.2013-31.3.2017', 'prof. Ing. Mikuláš Huba, PhD. \r\n', NULL, NULL, 'AK29', 'Projekt sa zaoberá vypracovaním podporného počítačového systému na návrh robustných nelineárnych regulátorov s obmedzeniami vo verzii pre Matlab/Simulink a web a vytvorením integrovaného elektronického prostredia v LMS Moodle, ktoré ho spája s webovou stránkou projektu, s elearningovými modulmi a s prístupom k vzdialeným experimentom umožňujúcim jeho overenie online. Systém je založený na novej metóde návrhu regulátorov vychádzajúcej s obmedzovania odchýlok od požadovaných tvarov vstupných a výstupných, resp. stavových veličín. Táto integruje výsledky viacerých doteraz izolovaných prístupov k návrhu regulátorov - tradičnú teóriu PID regulátorov, moderný stavový prístup s teóriou pozorovateľov, časovo optimálne riadenie, nelineárne systémy a riadenie systémov s veľkým dopravným oneskorením a robustný návrh regulátorov. Vyvíjaný systém bude vhodný pre širokú triedu neurčitých a nelineárnych objektov, ktoré predstavujú väčšinu bežných aplikácií v praxi. Systém bude pozostávať z centrálnej pracovnej stanice umožňujúcej dostatočne rýchle generovanie tzv. portrétu správania riadeného objektu s uvažovaným typom regulátora, z úložiska vytvorených portrétov správania a z grafických staníc, ktoré umožnia na základe špecifikácie neurčitých parametrov riadeného objektu a zadaných kvalitatívnych požiadaviek na riadené procesy určiť optimálne nastavenie regulátora zaručujúce pre zadané požiadavky dosiahnutie najvyššej možnej dynamiky prechodových dejov aj pri zohľadnení neurčitostí.\r\n', 'The project deals with development and introduction into practice of the computer aided system for design of robust constrained nonlinear control (in versions for Matlab/Simulink and web) and of the integrated electronic environment in LMS Moodle interconnecting the system with the project web page, with the elearning modules and with access to remote experiments enabling its online verification. The system will be based on a new robust control method based on constraining deviations from required shapes of the input, output, or state variables. This is holistically integrating several up to now isolated control design approaches - the traditional PID control, modern state & disturbance observer approach, minimum time control, nonlinear control, control of systems with long dead time and robust control. The developed system is intended for a broad class of uncertain and nonlinear plants that represent a majority of all applications in practice. The system will consist of a central work station enabling a sufficiently fast generation of the so called performance portrait of given plant with a considered type of control, from a repository of generated performance portraits and from graphical terminals enabling by means of specifying parameters of given plant and the required shape-related performance measures to determine the optimal controller tuning guaranteeing the fastest possible transients responses in the control loop under consideration of the given uncertainties.\r\n', 1),
(10, 'APVV', 'APVV-0772-12 ', 'Moderné metódy riadenia s využitím FPGA štruktúr \r\n', 'Advanced control methods based on FPGA structures \r\n', '1.10.2013-30.9.2017', 'doc. Ing. Alena Kozáková, PhD. \r\n', NULL, NULL, 'AK39', 'Projekt rieši aktuálne otázky výskumu a vývoja moderných metód riadenia s využitím hardvérových realizácií konvenčných (PID) ako aj moderných (optimálne, robustné, prediktívne) algoritmov riadenia pre procesy s rýchlou dynamikou. V súčasnosti dominujú vo výskume a implementácii moderných riadiacich systémov tieto smery: riešenia na báze mikroprocesorov (softvérový prístup), jednoúčelové riešenia ASIC a riešenia na báze programovateľných hradlových polí (Field Programmable Gate Arrays, FPGA), ktoré predstavujú konfigurovateľné obvody vysokého stupňa integrácie (VLSI) schopné integrovať rôzne logické a riadiace funkcie. Hardvérové implementácie algoritmov riadenia sú v porovnaní so softvérovými realizáciami vo všeobecnosti o niekoľko rádov rýchlejšie, pretože spracovanie v nich prebieha paralelne, navyše sú kompaktnejšie a vo všeobecnosti lacnejšie. Hlavným cieľom projektu je výskum a vývoj algoritmov na báze FPGA štruktúr, ktorý bude skúmaný na vývojových FPGA systémoch a verifikovaný na fyzikálnych laboratórnych modeloch s rýchlou dynamikou.\r\n', 'The project deals with research and development of advanced control methods based on HW implementation of conventional (PID) as well as modern optimal, robust and predictive algorithms applicable in control of plants with fast dynamics. Predominating approaches in the research of modern control systems implementation are microprocessor-based solutions (software approach), ASIC (dedicated approach) and the FPGA based approach. Field Programmable Gate Arrays (FPGA) are configurable circuits of very-large-scale-integration (VLSI) able to integrate various logical and control functions. In general, HW implementations of control algorithms are faster by several orders compared with SW implementations due to parallel processing of information; moreover they are more compact and also less expensive. The main objective of the project is research and development of FPGA-based control algorithms. Their research and development will be studied on available FPGA development kits and verified on laboratory plants with fast dynamics.\r\n', 1),
(11, 'APVV', 'APVV-14-0613 ', 'Širokopásmový MEMS detektor terahertzového žiarenia \r\n', 'Broadband MEMS detector of terahertz radiaton \r\n', '2015 - 2018', 'doc. Ing. Vladimír Kutiš, PhD. \r\n', NULL, NULL, NULL, NULL, 'The project is aimed on research and development of new types of broadband detectors for terahertz frequency range. This new type of detector is designed in a concept of micro-electro-mechanical system and uses the bolometric sensing principle. The design construction of the detector consists of a microbolometric sensing device coupled to a broadband antenna. Thermal conversion of the incident THz radiation takes place on a thin polyimide membrane which enables (a) to achieve high thermal conversion efficiency and (b) to design detectors with balanced amplitude characteristics even at high frequency range. The proposed MEMS detector concept will be optimized by a sophisticated process of modeling and simulation in direct mutual iteration with experimental analysis of functionality and detection capability. The completion of the project will be given by the developed state-of-the-art methodology of characterization, broadband THz detection and simulation of the MEMS detector device applicable in the research and education.\r\n', 1),
(12, 'International', 'SK06-II-01-004', 'Podpora medzinárodnej mobility medzi STU Bratislava, NTNU Trondheim a Universität Liechtenstein \r\n', 'Support of international mobilites between STU Bratislava, NTNU Trondheim, and Universität Liechtenstein \r\n', '2.6.2015 - 30.9.2016', 'zodpovedný za ÚAMT - prof. Ing. Mikuláš Huba, PhD. \r\n', 'Norwegian University of Science and Technology Trondheim (prof. Skogestad, prof. Johansen, prof. Hovd)|Universität Liechtenstein, Liechtenstein (prof. Droege)\r\n', NULL, NULL, 'Projekt rieši aktuálne otázky výskumu a vývoja moderných metód riadenia s využitím hardvérových realizácií konvenčných (PID) ako aj moderných (optimálne, robustné, prediktívne) algoritmov riadenia pre procesy s rýchlou dynamikou. V súčasnosti dominujú vo výskume a implementácii moderných riadiacich systémov tieto smery: riešenia na báze mikroprocesorov (softvérový prístup), jednoúčelové riešenia ASIC a riešenia na báze programovateľných hradlových polí (Field Programmable Gate Arrays, FPGA), ktoré predstavujú konfigurovateľné obvody vysokého stupňa integrácie (VLSI) schopné integrovať rôzne logické a riadiace funkcie. Hardvérové implementácie algoritmov riadenia sú v porovnaní so softvérovými realizáciami vo všeobecnosti o niekoľko rádov rýchlejšie, pretože spracovanie v nich prebieha paralelne, navyše sú kompaktnejšie a vo všeobecnosti lacnejšie. Hlavným cieľom projektu je výskum a vývoj algoritmov na báze FPGA štruktúr, ktorý bude skúmaný na vývojových FPGA systémoch a verifikovaný na fyzikálnych laboratórnych modeloch s rýchlou dynamikou.\r\n', 'The aim of the project is to support international mobility of students, PhD students, and staff members of four participating faculties of STU in Bratislava with partners from NTNU Trondheim and Universität Liechtenstein. It will initiate academic cooperation between the University of Liechtenstein and STU Bratislava in construction, architecture, and space planning, focusing on the use of alternative energy sources in operation of buildings, including computer-aided simulations of energy needs and internal environment, and spatial planning of rural settlements as well. The project also contributes to further strengthening of already existing cooperation between NTNU Trondheim and faculties of STU in Bratislava in the field of advanced methods of automatic control and to progress of inter-faculty cooperation at STU in Bratislava.\r\n', 1),
(13, 'other', 'TB ', 'Softvérové riadenie smerovej dynamiky vozidla UGV 6x6 \r\n', 'Softvérové riadenie smerovej dynamiky vozidla UGV 6x6 \r\n', '2015', 'Ing. Martin Bugár, PhD. \r\n', NULL, NULL, '7506', NULL, NULL, 1),
(14, 'other', 'VW ', 'Predlžovanie životnosti akumulátorového systému \r\n', 'Predlžovanie životnosti akumulátorového systému \r\n', '2015', 'Ing. Martin Bugár, PhD. \r\n', NULL, NULL, '7509', NULL, NULL, 1),
(15, 'other', 'MV ', 'REST platforma pre online riadenie experimentov \r\n', 'REST Platform for Online Control of Experiments \r\n', '2015', 'Ing. Miroslav Gula \r\n', NULL, NULL, '1361', '"Tento projekt je súčasťou rozsiahlejšieho cieľa o vytvorenie univerzálneho protokolu pre vzdialené riadenie reálnych sústav a tiež balíka softvérových nástrojov na jeho implementáciu. Hlavným cieľom celého úsilia je zjednodušiť a urýchliť budovanie modulárnych online laboratórií.\r\nÚlohami projektu sú návrh a vytvorenie nástroaj pre vzdialený prístup k softvéru Scilab, zavŕšenie implementácie podobného nástroja určeného pre softvérový balík Matlab/Simulink, a návrh a čiastočná implementácia mechatronického systému, ktorý bude v budúcnosti slúžiť na demonštráciu spomenutých nástrojov a následne ako učebná pomôcka."\r\n', 'The project is a part of an extensive endeavor to create universal protocol for remote control of real plants, and a suite of software tools to implement this protocol. The main objective of this whole endeavor is to simplify and accelerate implementation of modular online laboratories. Tasks of this project include design and implementation of a software tool for remote access to Scilab, completion of implementation of a similar tool for Matlab/Simulink, and design and partial implementation of a mechatronic system which will serve for demonstration of mentioned tools and later on as teaching aid.\r\n', 1),
(16, 'VEGA', 'test2', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `staff`
--

CREATE TABLE `staff` (
  `s_id` int(4) NOT NULL,
  `name` varchar(64) COLLATE utf8_slovak_ci DEFAULT NULL,
  `surname` varchar(64) COLLATE utf8_slovak_ci DEFAULT NULL,
  `title1` varchar(32) COLLATE utf8_slovak_ci DEFAULT NULL,
  `title2` varchar(32) COLLATE utf8_slovak_ci DEFAULT NULL,
  `ldapLogin` varchar(32) COLLATE utf8_slovak_ci DEFAULT NULL,
  `photo` varchar(128) COLLATE utf8_slovak_ci DEFAULT NULL,
  `room` varchar(128) COLLATE utf8_slovak_ci DEFAULT NULL,
  `phone` varchar(16) COLLATE utf8_slovak_ci DEFAULT NULL,
  `department` varchar(32) COLLATE utf8_slovak_ci DEFAULT NULL,
  `staffRole` varchar(32) COLLATE utf8_slovak_ci DEFAULT NULL,
  `function` varchar(256) COLLATE utf8_slovak_ci DEFAULT NULL,
  `roles` mediumtext COLLATE utf8_slovak_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_slovak_ci DEFAULT NULL,
  `web` varchar(128) COLLATE utf8_slovak_ci DEFAULT NULL,
  `activated` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `staff`
--

INSERT INTO `staff` (`s_id`, `name`, `surname`, `title1`, `title2`, `ldapLogin`, `photo`, `room`, `phone`, `department`, `staffRole`, `function`, `roles`, `email`, `web`, `activated`) VALUES
(1, 'Vladislav', 'Bača', 'Ing.', NULL, NULL, 'baca.jpg', 'T005', '264', 'OEMP', 'doktorand', NULL, '', '', '', 1),
(2, 'Peter', 'Balko', 'Ing.', NULL, NULL, NULL, 'D 102', '395', 'OIKR', 'doktorand', NULL, '', '', '', 1),
(3, 'Richard', 'Balogh', 'Ing.', ' PhD.', NULL, 'balogh.jpg', 'D110', '411', 'OEMP', 'teacher', 'zástupca vedúceho oddelenia', '', '', '', 1),
(4, 'Igor', 'Bélai', 'Ing.', ' PhD.', NULL, NULL, 'D 126', '478', 'OEMP', 'teacher', NULL, '', '', '', 1),
(5, 'Katarína', 'Beringerová', NULL, NULL, NULL, NULL, 'A 705', '672', 'AHU', 'teacher', NULL, '', '', '', 1),
(6, 'Pavol', 'Bisták', 'Ing.', ' PhD.', 'bistak', 'bistak.jpg', 'D 120', '695', 'OEAP', 'teacher', NULL, '', '', '', 1),
(7, 'Dmitrii', 'Borkin', 'Ing.', NULL, NULL, NULL, 'D 102', '395', 'OIKR', 'doktorand', NULL, '', '', '', 1),
(8, 'Martin', 'Bugár', 'Ing.', ' PhD.', NULL, NULL, 'A 708', '579', 'OEAP', 'teacher', NULL, '', '', '', 1),
(9, 'Ján', 'Cigánek', 'Ing.', ' PhD.', NULL, NULL, 'D 104', '686', 'OIKR', 'teacher', NULL, '', '', '', 1),
(10, 'Peter', 'Drahoš', 'doc. Ing.', ' PhD.', NULL, NULL, 'D 118', '669', 'OEMP', 'teacher', NULL, '', '', '', 1),
(11, 'František', 'Erdödy', NULL, NULL, NULL, 'erdody.jpg', 'A S39', '818', 'AHU', 'teacher', NULL, '', '', '', 1),
(12, 'Viktor', 'Ferencey', 'prof. Ing.', ' PhD.', NULL, 'ferencey.jpg', 'A 802', '438', 'OEAP', 'teacher', 'zástupca vedúceho oddelenia', '', '', '', 1),
(13, 'Peter', 'Fuchs', 'doc. Ing.', ' PhD.', NULL, NULL, 'B S05', '826', 'OEMP', 'researcher', NULL, '', '', '', 1),
(14, 'Gabriel', 'Gálik', 'Ing.', NULL, NULL, NULL, 'A 706', '559', 'OAMM', 'researcher', NULL, '', '', '', 1),
(15, 'Vladimír', 'Goga', 'doc. Ing.', ' PhD.', NULL, NULL, 'A 702', '687', 'OAMM', 'teacher', NULL, '', '', '', 1),
(16, 'Miroslav', 'Gula', 'Ing.', NULL, 'xgulam', 'gula.jpg', 'D 103', '628', 'OIKR', 'doktorand', NULL, '', '', '', 1),
(17, 'Oto', 'Haffner', 'Ing.', ' PhD.', NULL, 'haffner.jpg', 'D 125', '315', 'OIKR ', 'teacher', NULL, '', '', '', 1),
(18, 'Juraj', 'Hrabovský', 'Ing.', ' PhD.', NULL, NULL, 'A 706', '559', 'OAMM', 'teacher', NULL, '', '', '', 1),
(19, 'Mikuláš', 'Huba', 'prof. Ing.', ' PhD.', NULL, 'huba.jpg', 'D 112', '771', 'OEAP', 'teacher', 'riaditeľ ústavu; vedúci oddelenia', '', '', '', 1),
(20, 'Mária', 'Hypiusová', 'Ing.', ' PhD.', NULL, NULL, 'D 122', '193', 'OIKR', 'teacher', NULL, '', '', '', 1),
(21, 'Štefan', 'Chamraz', 'Ing.', ' PhD.', NULL, NULL, 'D 107', '848', 'OEMP', 'teacher', NULL, '', '', '', 1),
(22, 'Jakub', 'Jakubec', 'Ing.', ' PhD.', NULL, NULL, 'A 707', '452', 'OAMM ', 'researcher', NULL, '', '', '', 1),
(23, 'Igor', 'Jakubička', 'Ing.', NULL, NULL, 'jakubicka.jpg', 'T005', '264', 'OEMP', 'doktorand', NULL, '', '', '', 1),
(24, 'Katarína', 'Kermietová', NULL, NULL, NULL, NULL, 'D 116', '598', 'AHU', 'teacher', 'zástupca vedúceho oddelenia', '', '', '', 1),
(25, 'Ivan', 'Klimo', 'Ing.', NULL, NULL, NULL, 'D 101', '509', 'OEMP', 'doktorand', NULL, '', '', '', 1),
(26, 'Michal', 'Kocúr', 'Ing.', ' PhD.', 'xkocurm2', 'kocur.jpg', 'D 104', '686', 'OIKR ', 'teacher', NULL, '', '', '', 1),
(27, 'Štefan', 'Kozák', 'prof. Ing.', ' PhD.', NULL, 'kozak.jpg', 'D 115', '281', 'OEMP', 'teacher', 'zástupca riaditeľa ústavu pre rozvoj ústavu; vedúci oddelenia', '', '', '', 1),
(28, 'Alena', 'Kozáková', 'doc. Ing.', ' PhD.', NULL, NULL, 'D 111', '563', 'OIKR', 'teacher', NULL, '', '', '', 1),
(29, 'Erik', 'Kučera', 'Ing.', ' PhD.', NULL, NULL, 'D 125', '315', 'OIKR ', 'teacher', NULL, '', '', '', 1),
(30, 'Vladimír', 'Kutiš', 'doc. Ing.', ' PhD.', NULL, 'kutis.jpg', 'A 701', '562', 'OAMM ', 'teacher', 'zástupca vedúceho oddelenia', '', '', '', 1),
(31, 'Alek', 'Lichtman', 'Ing.', NULL, NULL, NULL, 'D 101', '509', 'OEMP', 'doktorand', NULL, '', '', '', 1),
(32, 'Justín', 'Murín', 'prof. Ing.', ' DrSc.', NULL, 'murin.jpg', 'A 704', '611', 'OAMM', 'teacher', 'zástupca riaditeľa ústavu pre vedeckú činnosť; vedúci oddelenia', '', '', '', 1),
(33, 'Jakub', 'Osuský', 'Ing.', ' PhD.', NULL, 'osusky.jpg', 'D 123', '356', 'OIKR ', 'teacher', NULL, '', '', '', 1),
(34, 'Tomáš', 'Paciga', 'Ing.', NULL, NULL, NULL, 'A 707', '452', 'OAMM', 'doktorand', NULL, '', '', '', 1),
(35, 'Juraj', 'Paulech', 'Ing.', ' PhD.', NULL, 'paulech.jpg', 'A 701', '562', 'OAMM', 'teacher', NULL, '', '', '', 1),
(36, 'Matej', 'Rábek', 'Ing.', NULL, 'xrabek', 'rabek.jpg', 'D 103', '628', 'OIKR', 'doktorand', NULL, '', '', '', 1),
(37, 'Tibor', 'Sedlár', 'Ing. ', NULL, NULL, NULL, 'A 803', '399', 'OAMM', 'teacher', NULL, '', '', '', 1),
(38, 'Erich', 'Stark', 'Ing.', NULL, NULL, 'stark.jpg', 'C 014', '', 'OIKR', 'doktorand', NULL, '', '', '', 1),
(39, 'Peter', 'Ťapák', 'Ing.', ' PhD.', NULL, NULL, 'D 121', '569', 'OEAP', 'teacher', NULL, '', '', '', 1),
(40, 'Katarína', 'Žáková', 'doc. Ing.', ' PhD.', 'zakova', 'zakova.jpg', 'D 119', '742', 'OIKR', 'teacher', 'zástupca riaditeľa ústavu pre pedagogickú činnosť; zástupca vedúceho oddelenia', '', '', '', 1),
(41, 'Danica', 'Rosinová', 'doc. Ing.', ' PhD.', NULL, 'rosinova.jpg', 'D 111', '563', 'OIKR', 'teacher', 'vedúci oddelenia\r\n', '', '', '', 1),
(42, 'Admin', 'Admin', NULL, NULL, 'xdzacovsky', NULL, '', NULL, '', '', NULL, '', '', '', 1),
(43, 'Laravel', 'Laravel', 'Prof.', 'PhD.', 'xtrocha', NULL, '456', '123', 'ABC', 'developer', 'develop', '', '', '', 1),
(55, 'aaaa', 'aaa', 'aaaa', 'aaaa', 'xaaa', 'default_male_img.png', 'aaaa', 'aaaaa', 'AHU', 'doktorand', 'aaaaa', '', 'aaa@aaa', 'http://aaaa.com', 1),
(56, 'bbb', 'bbbová', 'bbb', 'bbb', 'xss', 'default_female_img.png', 'bbb', 'bbbbbb', 'AHU', 'doktorand', 'bbb', '["admin"]', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `subjects`
--

CREATE TABLE `subjects` (
  `sub_id` int(11) NOT NULL,
  `abbrev` varchar(20) COLLATE utf8_slovak_ci NOT NULL,
  `title` varchar(500) COLLATE utf8_slovak_ci NOT NULL,
  `hash_name` varchar(128) COLLATE utf8_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `subjects`
--

INSERT INTO `subjects` (`sub_id`, `abbrev`, `title`, `hash_name`) VALUES
(1, 'I-ASRAV', 'Automatizované systémy riadenia automobilových výrob', '0c923a6d87fddabcd4f5cb5b2f3a58b2'),
(2, 'I-AMS', 'Autonómne mechatronické systémy', '157f9ba36dd25159c9829cd1f12ebb36'),
(3, 'I-CSPMS', 'CAD  systémy a projektovanie mechatronických systémov', 'b723af648c5a822be03eec592673651d'),
(4, 'I-CAEMS', 'CAE mechatronických systémov', ''),
(5, 'B-DAVIS', 'Databázové a vizualizačné systémy', ''),
(6, 'B-DYMES', 'Dynamika mechatronických systémov', ''),
(7, 'B-ELSA', 'Elektronické systémy automobilov', ''),
(8, 'B-KSS', 'Komunikačné systémy a siete', ''),
(9, 'B-MECH', 'Mechanika', ''),
(10, 'B-MSBEZ', 'Mechatronické systémy bezpečnosti automobilov a elektromobilov', ''),
(11, 'I-MEMSISA', 'MEMS - inteligentné senzory a aktuátory', ''),
(12, 'I-MKP', 'Metóda konečných prvkov', ''),
(13, 'I-MCR', 'Metódy číslicového riadenia', ''),
(14, 'I-MVI', 'Metódy vypočtovej inteligencie', ''),
(15, 'B-MIPS', 'Mikropočítačové systémy', ''),
(16, 'I-MRNMS', 'Modelovanie a riadenie nelineárnych mechatronických systémov', ''),
(17, 'B-MSLAB', 'Modelovanie a simulácia v prostredí Matlab', ''),
(18, 'I-MPM', 'Multifyzikálne procesy v mechatronike', ''),
(19, 'I-MTMP', 'Multimédiá a telematika pre mobilné platformy', ''),
(20, 'B-NAVEZ', 'Návrh elektronických zariadení', ''),
(21, 'I-NPAE', 'Nekonvenčné pohony automobilov a elektromobilov', ''),
(22, 'I-OPM', 'Optimalizácia procesov v mechatronike', ''),
(23, 'I-OSA', 'Osvetlovacie systémy automobilov', ''),
(24, 'B-PLCM', 'PLC systémy v mechatronike', ''),
(25, 'I-PHSMA', 'Pneumatické a hydraulické systémy v mechatronických aplikáciách', ''),
(26, 'I-PSZE', 'Pohonné systémy  a zdroje v elektromobiloch', ''),
(27, 'I-PMRMS', 'Pokročilé metódy riadenia mechatronických systémov', ''),
(28, 'B-PROPA', 'Procesy pohybu automobilov', ''),
(29, 'B-PASME', 'Prvky a systémy v mechatronike', ''),
(30, 'B-SENSAK', 'Senzorové systémy a aktuátory', ''),
(31, 'I-SMA', 'Servopohony pre mechatronické aplikácie', ''),
(32, 'B-SMS', 'Smart mechatronické systémy', ''),
(33, 'B-SAEMOB', 'Stavba automobilov a elektromobilov', ''),
(34, 'B-SAR1', 'Systémy automatického riadenia 1', ''),
(35, 'B-SAR2', 'Systémy automatického riadenia 2', ''),
(36, 'I-TDIAG', 'Technická diagnostika', ''),
(37, 'I-TSAE', 'Transmisné systémy automobilov a elektromobilov', ''),
(38, 'B-UIE', 'Úvod do inžinierstva', ''),
(39, 'B-VIPROT', 'Virtuálne prototypovanie', ''),
(40, 'I-VPPMS', 'Vývojové programové prostredia  pre mechatronické systémy', ''),
(41, 'B-WEBTE1', 'Webové technológie 1', ''),
(42, 'B-WEBTE2', 'Webové technológie 2', '');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `subjects_files`
--

CREATE TABLE `subjects_files` (
  `sf_id` int(11) NOT NULL,
  `hash_id` varchar(128) NOT NULL,
  `hash_name` varchar(128) NOT NULL,
  `file_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `subjects_subcategories`
--

CREATE TABLE `subjects_subcategories` (
  `ss_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `hash_name` varchar(128) NOT NULL,
  `name_sk` varchar(256) NOT NULL,
  `name_en` varchar(256) NOT NULL,
  `text_en` longtext,
  `text_sk` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `subjects_subcategories`
--

INSERT INTO `subjects_subcategories` (`ss_id`, `sub_id`, `hash_name`, `name_sk`, `name_en`, `text_en`, `text_sk`) VALUES
(2, 1, '0c923a6d87fddabcd4f5cb5b2f3a58b2', 'sddsd', 'sddssd', NULL, NULL),
(3, 1, '0c923a6d87fddabcd4f5cb5b2f3a58b2', 'fgsdfgsd', 'gfsdfgds', '<p>fgsdfgsd</p>', NULL),
(4, 2, '157f9ba36dd25159c9829cd1f12ebb36', 'sfdgsdf', 'dsfgsdfgs', NULL, NULL),
(5, 3, 'b723af648c5a822be03eec592673651d', 'ffffvd', 'vvfds', NULL, NULL),
(6, 2, '157f9ba36dd25159c9829cd1f12ebb36', 'dfbsdbsdbfsd', 'bfsdfbsdfbsdfbvdf', '<p>vsdfvsdfvsdfbsdfbsdfvdsfv</p>', NULL),
(7, 3, 'b723af648c5a822be03eec592673651d', 'fd sf', 'fds sd', NULL, '<p>&nbsp;sdf sd</p>'),
(8, 1, '0c923a6d87fddabcd4f5cb5b2f3a58b2', 'sdcs', 'cdscsdcs', NULL, NULL);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `typ_nepritomnosti`
--

CREATE TABLE `typ_nepritomnosti` (
  `t_id` int(11) NOT NULL,
  `nazov` varchar(80) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `skratka` varchar(10) NOT NULL,
  `farba` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `typ_nepritomnosti`
--

INSERT INTO `typ_nepritomnosti` (`t_id`, `nazov`, `skratka`, `farba`) VALUES
(1, 'pracovná neschopnosť', 'PN', '#9f8bed'),
(2, 'dovolenka', 'D', '#00cdcd'),
(3, 'plánovaná dovolenka', 'PD', '#ffd446'),
(4, 'návšteva lekára', 'NL', '#c6fd06'),
(5, 'práca z domu', 'HO', '#70a78f');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `video_gallery`
--

CREATE TABLE `video_gallery` (
  `v_id` int(11) NOT NULL,
  `title_SK` varchar(100) COLLATE utf8_slovak_ci NOT NULL,
  `title_EN` varchar(100) COLLATE utf8_slovak_ci NOT NULL,
  `url` varchar(70) COLLATE utf8_slovak_ci NOT NULL,
  `type_sk` varchar(20) COLLATE utf8_slovak_ci NOT NULL,
  `type_en` varchar(20) COLLATE utf8_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `video_gallery`
--

INSERT INTO `video_gallery` (`v_id`, `title_SK`, `title_EN`, `url`, `type_sk`, `type_en`) VALUES
(1, 'Vzdialené experimenty - podpora pre vzdelávanie', 'Remote experiments - support for education', 'Z0zBwR_MKOI', 'Naše laboratóriá', 'Our laboratories'),
(2, 'Multimédiá a telematika pre mobilné platformy - voliteľný predmet v inžinierskom štúdiu FEI STU', 'Multimedia and telematics for mobile platforms - elective eourse in the FEI STU engineering study', 'NKZmJB0PW3k', 'Predmety', 'Subjects'),
(3, 'Študuj mechatroniku a budeš úspešný!', 'Study mechatronics and you will be successful!', 'vCYq4JspSCI', 'Propagačné videá', 'Promotional videos'),
(4, 'Mechatronické kresliace rameno mScara - Makeblock mDrawBot kit ', 'mScara mechatronic drawing arm - Makeblock mDrawBot kit', 'qmijnl8jwaw', 'Naše zariadenie', 'Our facility'),
(5, 'Riadenie modelu výrobného systému cez PLC', 'Managing the production system model via the PLC', 'ymqYxRYt5sY', 'Naše zariadenie', 'Our facility'),
(6, 'Inžinierska informatika v mechatronike - Ing. ŠP Aplikovaná mechatronika a elektromobilita ', 'Engineering informatics in mechatronics - Engineering SP Applied mechatronics and electromobility', 'CLwEjKN9ixg', 'Propagačné videá', 'Our facility'),
(7, 'Ústav automobilovej mechatroniky FEI STU ', 'Department of automobile mechatronics FEI STU', 'IiNXYgbOKxw', 'Propagačné videá', 'Promotional videos'),
(8, 'videjo', 'videjo in ingliš', '57BJvTZK6Vc', 'Naše laboratóriá', 'Our laboratories'),
(9, 'FPFA', 'FPGA', 'xEkg96rcwsE', 'Predmety', 'Subjects');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexy pre tabuľku `documents_categories`
--
ALTER TABLE `documents_categories`
  ADD PRIMARY KEY (`dc_id`);

--
-- Indexy pre tabuľku `documents_files`
--
ALTER TABLE `documents_files`
  ADD PRIMARY KEY (`df_id`);

--
-- Indexy pre tabuľku `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexy pre tabuľku `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexy pre tabuľku `media_files`
--
ALTER TABLE `media_files`
  ADD PRIMARY KEY (`mf_id`);

--
-- Indexy pre tabuľku `nepritomnosti`
--
ALTER TABLE `nepritomnosti`
  ADD PRIMARY KEY (`at_id`);

--
-- Indexy pre tabuľku `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexy pre tabuľku `news_dl_files`
--
ALTER TABLE `news_dl_files`
  ADD PRIMARY KEY (`nf_id`);

--
-- Indexy pre tabuľku `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexy pre tabuľku `photo_gallery`
--
ALTER TABLE `photo_gallery`
  ADD PRIMARY KEY (`pg_id`);

--
-- Indexy pre tabuľku `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`pr_id`);

--
-- Indexy pre tabuľku `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexy pre tabuľku `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexy pre tabuľku `subjects_files`
--
ALTER TABLE `subjects_files`
  ADD PRIMARY KEY (`sf_id`);

--
-- Indexy pre tabuľku `subjects_subcategories`
--
ALTER TABLE `subjects_subcategories`
  ADD PRIMARY KEY (`ss_id`);

--
-- Indexy pre tabuľku `typ_nepritomnosti`
--
ALTER TABLE `typ_nepritomnosti`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexy pre tabuľku `video_gallery`
--
ALTER TABLE `video_gallery`
  ADD PRIMARY KEY (`v_id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `documents`
--
ALTER TABLE `documents`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pre tabuľku `documents_categories`
--
ALTER TABLE `documents_categories`
  MODIFY `dc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT pre tabuľku `documents_files`
--
ALTER TABLE `documents_files`
  MODIFY `df_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pre tabuľku `events`
--
ALTER TABLE `events`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pre tabuľku `media`
--
ALTER TABLE `media`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT pre tabuľku `media_files`
--
ALTER TABLE `media_files`
  MODIFY `mf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT pre tabuľku `nepritomnosti`
--
ALTER TABLE `nepritomnosti`
  MODIFY `at_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=526;
--
-- AUTO_INCREMENT pre tabuľku `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT pre tabuľku `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT pre tabuľku `news_dl_files`
--
ALTER TABLE `news_dl_files`
  MODIFY `nf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pre tabuľku `photos`
--
ALTER TABLE `photos`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT pre tabuľku `photo_gallery`
--
ALTER TABLE `photo_gallery`
  MODIFY `pg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT pre tabuľku `project`
--
ALTER TABLE `project`
  MODIFY `pr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pre tabuľku `staff`
--
ALTER TABLE `staff`
  MODIFY `s_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT pre tabuľku `subjects`
--
ALTER TABLE `subjects`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT pre tabuľku `subjects_files`
--
ALTER TABLE `subjects_files`
  MODIFY `sf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pre tabuľku `subjects_subcategories`
--
ALTER TABLE `subjects_subcategories`
  MODIFY `ss_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pre tabuľku `typ_nepritomnosti`
--
ALTER TABLE `typ_nepritomnosti`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pre tabuľku `video_gallery`
--
ALTER TABLE `video_gallery`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
