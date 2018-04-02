-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Hostiteľ: localhost
-- Čas generovania: St 28.Mar 2018, 21:06
-- Verzia serveru: 10.0.34-MariaDB-0ubuntu0.16.04.1
-- Verzia PHP: 7.0.28-0ubuntu0.16.04.1

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
-- Štruktúra tabuľky pre tabuľku `deletor`
--

CREATE TABLE `deletor` (
  `del_id` int(11) NOT NULL,
  `type` varchar(16) NOT NULL,
  `path` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 1, '1c45daad2f90da4d20ecdc65b860b6fb', 'fsadfsad', 'sdfsdfs', '<p>fgsdfgsd</p>', '<p>gdfgsdfgsdf</p>'),
(2, 1, 'f012edbe512e0f5a68b1898f3704ec41', 'fsadfsa', 'fasdfsadfas', '<p><img src="http://127.0.0.1:8000/storage/documents/de146af47c4ebf868a294c652643f831/f012edbe512e0f5a68b1898f3704ec41/rYTAKEgOslfB6mndFRXVnXyfBG888peKkk5hqk4x.jpeg" style="width: 1118px;"><br></p>', '<p><img src="http://127.0.0.1:8000/storage/documents/de146af47c4ebf868a294c652643f831/f012edbe512e0f5a68b1898f3704ec41/FP535Emw31Ls9ozNfoXh2qRXMZel9Qr3VBk7MI6Y.png" style="width: 303px;"><br></p>');

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
(1, 'de146af47c4ebf868a294c652643f831', 'asdfas', 'sdffgsdf');

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
(1, '4afc150660d57b636b3f7ffe50df483a', 'BJCIo1EOtNjtLZNVsM1JVb3bEIdSRdLabstQBFEf.zip', 'water.jpg.zip'),
(2, 'f012edbe512e0f5a68b1898f3704ec41', 'rYTAKEgOslfB6mndFRXVnXyfBG888peKkk5hqk4x.jpeg', 'banana.jpg'),
(3, 'f012edbe512e0f5a68b1898f3704ec41', 'FP535Emw31Ls9ozNfoXh2qRXMZel9Qr3VBk7MI6Y.png', 'monkey1.png'),
(4, 'f012edbe512e0f5a68b1898f3704ec41', 'ppf1TLZ3EbJzbeyO78v5LhTXHk12hce2G391ccXF.zip', 'water.jpg.zip'),
(5, 'd05f0119291eff3ea78e407e6a1016c2', 'yqdK3aufD5plUiATg1mZRw6YmkrmuiiP94EdG8Dg.jpeg', 'path.jpg'),
(6, 'd05f0119291eff3ea78e407e6a1016c2', 'xnfdIYoLibCCQ5sXpN7doBdPGOK1dpVXBrtXTGfh.zip', 'water.jpg.zip');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `events`
--

CREATE TABLE `events` (
  `e_id` int(11) NOT NULL,
  `name_sk` varchar(128) NOT NULL,
  `name_en` varchar(128) DEFAULT NULL,
  `text_sk` varchar(2048) DEFAULT NULL,
  `text_en` varchar(2048) DEFAULT NULL,
  `url` varchar(512) DEFAULT NULL,
  `place` varchar(64) DEFAULT NULL,
  `date` int(11) NOT NULL,
  `time` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `events`
--

INSERT INTO `events` (`e_id`, `name_sk`, `name_en`, `text_sk`, `text_en`, `url`, `place`, `date`, `time`) VALUES
(1, 'Veľký piatok', 'Good Friday', 'Sviatok, máme voľno', 'No school, just coding at home', 'http://www.velkypiatok.com', 'Všade', 1522368000, '8:00');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `functions`
--

CREATE TABLE `functions` (
  `f_id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `functions`
--

INSERT INTO `functions` (`f_id`, `title`) VALUES
(1, 'riaditeľ ústavu'),
(2, 'vedúci oddelenia'),
(3, 'zástupca vedúceho oddelenia'),
(4, 'zástupca riaditeľa ústavu pre rozvoj ústavu'),
(5, 'zástupca riaditeľa ústavu pre vedeckú činnosť'),
(6, 'zástupca riaditeľa ústavu pre pedagogickú činnosť');

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

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `media_files`
--

CREATE TABLE `media_files` (
  `mf_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `file_name` varchar(128) NOT NULL,
  `hash_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(525, 12, 1, 2018, 1, 14),
(541, 1, 1, 2018, 3, 1),
(542, 1, 1, 2018, 3, 2),
(543, 1, 1, 2018, 3, 5),
(544, 1, 1, 2018, 3, 6),
(545, 1, 1, 2018, 3, 7),
(546, 1, 1, 2018, 3, 8),
(547, 1, 1, 2018, 3, 9),
(548, 1, 1, 2018, 3, 12),
(549, 1, 1, 2018, 3, 13),
(550, 1, 1, 2018, 3, 14),
(551, 1, 1, 2018, 3, 15),
(552, 1, 1, 2018, 3, 16),
(553, 1, 1, 2018, 3, 19),
(554, 1, 1, 2018, 3, 20),
(555, 1, 1, 2018, 3, 21),
(556, 1, 1, 2018, 3, 22),
(557, 1, 1, 2018, 3, 23),
(565, 1, 1, 2018, 3, 26),
(566, 1, 1, 2018, 3, 27),
(567, 1, 1, 2018, 3, 28),
(568, 1, 1, 2018, 3, 29),
(569, 1, 1, 2018, 3, 30),
(629, 4, 2, 2018, 3, 5),
(630, 4, 2, 2018, 3, 6),
(631, 4, 2, 2018, 3, 7),
(632, 4, 2, 2018, 3, 8),
(633, 5, 2, 2018, 3, 5),
(634, 5, 2, 2018, 3, 6),
(635, 5, 2, 2018, 3, 7),
(636, 5, 2, 2018, 3, 8),
(637, 5, 3, 2018, 3, 9),
(649, 6, 3, 2018, 3, 1),
(650, 6, 3, 2018, 3, 2),
(651, 6, 3, 2018, 3, 5),
(652, 6, 3, 2018, 3, 6),
(653, 6, 3, 2018, 3, 7),
(654, 6, 3, 2018, 3, 8),
(655, 6, 3, 2018, 3, 9),
(656, 6, 3, 2018, 3, 12),
(657, 6, 3, 2018, 3, 13),
(658, 6, 3, 2018, 3, 14),
(659, 6, 3, 2018, 3, 15),
(660, 6, 3, 2018, 3, 16),
(661, 6, 4, 2018, 3, 19),
(662, 6, 4, 2018, 3, 20),
(663, 6, 4, 2018, 3, 21),
(664, 6, 4, 2018, 3, 22),
(665, 6, 4, 2018, 3, 23),
(666, 7, 2, 2018, 3, 5),
(667, 7, 2, 2018, 3, 6),
(668, 7, 2, 2018, 3, 7);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `news`
--

CREATE TABLE `news` (
  `n_id` int(11) NOT NULL,
  `hash_id` varchar(32) NOT NULL,
  `title_en` varchar(256) CHARACTER SET ucs2 COLLATE ucs2_slovak_ci NOT NULL,
  `title_sk` varchar(256) CHARACTER SET ucs2 COLLATE ucs2_slovak_ci NOT NULL,
  `image_hash_name` varchar(128) CHARACTER SET utf8 DEFAULT NULL,
  `preview_sk` varchar(1024) CHARACTER SET utf8 NOT NULL,
  `preview_en` varchar(1024) CHARACTER SET utf8 NOT NULL,
  `editor_content_sk` longtext CHARACTER SET utf8,
  `editor_content_en` longtext CHARACTER SET utf8,
  `date_created` int(11) NOT NULL,
  `date_expiration` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '0 - Propagácia, 1 - Oznamy, 2 - Zo života fakulty'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `news`
--

INSERT INTO `news` (`n_id`, `hash_id`, `title_en`, `title_sk`, `image_hash_name`, `preview_sk`, `preview_en`, `editor_content_sk`, `editor_content_en`, `date_created`, `date_expiration`, `type`) VALUES
(1, '57dc309931519c635af6b0769979f998', 'Testing', 'Testovačka', NULL, 'Lorem ipsum dolor sit amet, pri meliore veritus id, usu laoreet convenire petentium ad. Ea has ornatus sensibus, ne mel stet corrumpit delicatissimi. Suas veri nulla vis id, no mutat iriure scaevola sed, ut sit labitur similique. Probo euripidis neglegentur ad nam, vitae mucius quo te. Eos ex ipsum fastidii accumsan, facilisis ullamcorper usu te, vel te decore admodum. Nisl praesent eloquentiam mei te.', 'Lorem ipsum dolor sit amet, pri meliore veritus id, usu laoreet convenire petentium ad. Ea has ornatus sensibus, ne mel stet corrumpit delicatissimi. Suas veri nulla vis id, no mutat iriure scaevola sed, ut sit labitur similique. Probo euripidis neglegentur ad nam, vitae mucius quo te. Eos ex ipsum fastidii accumsan, facilisis ullamcorper usu te, vel te decore admodum. Nisl praesent eloquentiam mei te.', '<h1 style="text-align: center; ">Lorem Ipsum</h1><p style="text-align: left;">Lorem ipsum dolor sit amet, pri meliore veritus id, usu laoreet convenire petentium ad. Ea has ornatus sensibus, ne mel stet corrumpit delicatissimi. Suas veri nulla vis id, no mutat iriure scaevola sed, ut sit labitur similique. Probo euripidis neglegentur ad nam, vitae mucius quo te. Eos ex ipsum fastidii accumsan, facilisis ullamcorper usu te, vel te decore admodum. Nisl praesent eloquentiam mei te.</p><p style="text-align: left;"><br></p><p style="text-align: left;">An cum equidem voluptaria, eos epicurei interesset necessitatibus ut, error corpora consulatu et mei. Mel modus ornatus percipitur id, idque animal fastidii cu mei. Ea vel nisl consetetur, cu scripta tritani quo, vim ne sonet quaestio. Nostro tritani nec te, nostro definiebas et vel.</p><p style="text-align: left;"><br></p><p style="text-align: left;"><img src="http://127.0.0.1:8000/storage/news/57dc309931519c635af6b0769979f998/1h7jPLFuZnMthft5renGqd2i4dqDwc0UVUmH4ASm.png" style="width: 303px;"></p><p style="text-align: left;"><br></p><ol><li style="text-align: left;">A</li><li style="text-align: left;">B</li><li style="text-align: left;">C</li></ol><p style="text-align: left;"><a href="http://www.google.com" target="_blank">Text to display</a><br></p>', '<h1 style="font-family: "Open Sans", sans-serif; text-align: center;">Lorem Ipsum</h1><p>Lorem ipsum dolor sit amet, pri meliore veritus id, usu laoreet convenire petentium ad. Ea has ornatus sensibus, ne mel stet corrumpit delicatissimi. Suas veri nulla vis id, no mutat iriure scaevola sed, ut sit labitur similique. Probo euripidis neglegentur ad nam, vitae mucius quo te. Eos ex ipsum fastidii accumsan, facilisis ullamcorper usu te, vel te decore admodum. Nisl praesent eloquentiam mei te.</p><p><br></p><p>An cum equidem voluptaria, eos epicurei interesset necessitatibus ut, error corpora consulatu et mei. Mel modus ornatus percipitur id, idque animal fastidii cu mei. Ea vel nisl consetetur, cu scripta tritani quo, vim ne sonet quaestio. Nostro tritani nec te, nostro definiebas et vel.</p><p><br></p><p><img src="http://127.0.0.1:8000/storage/news/57dc309931519c635af6b0769979f998/1h7jPLFuZnMthft5renGqd2i4dqDwc0UVUmH4ASm.png" style="width: 303px;"></p><p><br></p><ol><li style="text-align: left;">A</li><li style="text-align: left;">B</li><li style="text-align: left;">C</li></ol><p><a href="http://www.google.com/" target="_blank">Text to display</a></p>', 1521879232, 1522454400, 0);

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
(53, 'aaa@gggg.vvv', 'SK'),
(58, 'fasdfas@dsfasd.com', 'EN'),
(59, 'ffff@gds.com', 'SK'),
(60, 'sadf@ggg.com', 'SK');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `news_dl_files`
--

CREATE TABLE `news_dl_files` (
  `nf_id` int(11) NOT NULL,
  `hash_id` varchar(64) NOT NULL,
  `file_hash` varchar(64) NOT NULL,
  `file_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `news_dl_files`
--

INSERT INTO `news_dl_files` (`nf_id`, `hash_id`, `file_hash`, `file_name`) VALUES
(1, '88c34e316e747060197a919e7e16153c', 'QHyJvCm5S257Ll6EFxS9kKmvschFGsiTjspUqMCQ.zip', 'water.jpg.zip'),
(2, '88c34e316e747060197a919e7e16153c', 'E12BesmmAvMkGMnh8bF9u50ZePabpWilAaPGsRyY.zip', 'water.jpg.zip'),
(3, '1b068e8e05de8dd674ea6c89ac96e27a', 'XjsVZQ4BXbEdC4a1Nzn3D9bu0eltHrabzHJfGyyQ.zip', 'water.jpg.zip'),
(4, '1b068e8e05de8dd674ea6c89ac96e27a', '7vqhfLdVIQRizWdQQbvY9mbXAHzzRMnUyv5zYjgN.zip', 'water.jpg.zip'),
(5, 'e5aa955cc8ad5a47b77d165944288e33', 'r9QlMd9NefeOQWsduSEzs8i01Q4cwBuHuNDSLuR1.zip', 'water.jpg.zip'),
(6, '21e23d8ca9bd3fd80bfa0260cbf051fd', 'U5JUdx8ZxyDmXGcI8ESsXAM7buaxKz4gxFjyn0yT.zip', 'water.jpg.zip');

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

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `photo_gallery`
--

CREATE TABLE `photo_gallery` (
  `pg_id` int(11) NOT NULL,
  `title_SK` varchar(128) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `title_EN` varchar(128) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `folder` varchar(64) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `date` int(11) NOT NULL,
  `activated` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `project`
--

CREATE TABLE `project` (
  `pr_id` int(11) NOT NULL,
  `projectType` varchar(128) COLLATE utf8_slovak_ci NOT NULL,
  `number` varchar(32) COLLATE utf8_slovak_ci NOT NULL,
  `titleSK` varchar(512) COLLATE utf8_slovak_ci NOT NULL,
  `titleEN` varchar(512) COLLATE utf8_slovak_ci DEFAULT NULL,
  `duration` varchar(32) COLLATE utf8_slovak_ci DEFAULT NULL,
  `coordinator` varchar(128) COLLATE utf8_slovak_ci DEFAULT NULL,
  `partners` varchar(1024) COLLATE utf8_slovak_ci DEFAULT NULL,
  `web` varchar(512) COLLATE utf8_slovak_ci DEFAULT NULL,
  `internalCode` varchar(16) COLLATE utf8_slovak_ci DEFAULT NULL,
  `annotationSK` mediumtext COLLATE utf8_slovak_ci,
  `annotationEN` mediumtext COLLATE utf8_slovak_ci,
  `activated` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `project`
--

INSERT INTO `project` (`pr_id`, `projectType`, `number`, `titleSK`, `titleEN`, `duration`, `coordinator`, `partners`, `web`, `internalCode`, `annotationSK`, `annotationEN`, `activated`) VALUES
(1, 'VEGA', '1/0937/14', 'Pokročilé metódy nelineárneho modelovania a riadenia mechatronických systémov', 'Advanced methods for nonlinear modeling and control of mechatronic systems', '2014-2017', '19', NULL, NULL, '1425', 'Projekt sa zameriava na rozvoj metód nelineárneho riadenia a ich aplikácií. Zahrňuje metódy algebrického a diferenciálneho prístupu k návrhu nelineárnych systémov, riadenie časovo oneskorených (time delayed) systémov a systémov s obmedzeniami uvažovaných ako súčasť hybridných, autonómnych a inteligentných systémov, metódy simulácie, modelovania a automatizovaného návrhu s využitím podporných numerických a symbolických metód a programov. Venuje sa formulácii riešených problémov v rámci vnorených (embedded) systémov a PLC, spracovaniu signálov, zohľadneniu aspektov riadenia cez Internet, mobilné a rádiové siete, identifikácii a kompenzácii nelinearít, integrácii jednotlivých prístupov pri implementácii a fyzickej realizácii konkrétnych algoritmov a štruktúr riadenia. Pôjde najmä o riadenie mechatronických, robotických a ďalších systémov s dominantnými nelinearitami.', 'The project focuses on development of nonlinear control methods and their applications. It includes algebraic and differential approach to nonlinear control, control of time-delayed and constrained systems considered as a part of hybrid autonomous intelligent systems, simulations modeling and automatized design based on numeric and symbolic computer aided methods. It is dealing with formulation of solved problems within the embedded systems and PLCs, with signal processing, control via Internet, mobile and radio networks, with identification and compensation of nonlinearities, integration of particular approaches in implementing and physically accomplishing particular algorithms and structures. Thereby, one considers especially mechatronic and robotic systems and other systems with dominating nonlinear behavior.', 1),
(2, 'VEGA', '1/0228/14', 'Modelovanie termohydraulických a napätostných pomerov vo vybraných komponentoch tlakovodných jadrových reaktorov', 'Modelling of thermohydraulic and stress conditions in selected components of NPP with pressurized water reactor', '2014-2016', '30', NULL, NULL, '1435', 'Cieľom predkladaného projektu je tvorba matematických modelov vybraných komponentov jadrových zariadení tlakovodného jadrového reaktora ako sú palivová kazeta, aktívna zóna ako aj celý jadrový reaktor. Tieto komponenty budú analyzované z pohľadu termohydrauliky ako aj z pohľadu mechanického (napätostného) namáhania. Takto získané numerické výsledky budú konfrontované s dostupnými experimentálnymi údajmi daných zariadení, pričom cieľom má byť zvyšovanie bezpečnosti prevádzky týchto zariadení. Pri tvorbe jednotlivých matematických modelov budú použité moderné numerické metódy, ako sú Computational Fluid Dynamics (CFD) a Metóda Konečných Prvkov (MKP), ktoré sú implementované v programoch ANSYS CFX a ANSYS Multiphysics. Súčasťou predkladaného projektu bude realizácia prepojenia matematických modelov termohydrauliky a mechanického namáhania, ktoré bude realizované tak, aby jednotlivé fyzikálne domény boli priamo previazané. Výstupom projektu okrem matematických modelov budú aj vedecké a odborné články a príspevky.', 'The aim of this project is to create mathematical models of selected components of nuclear power plants like fuel assembly, the active zone as well as a nuclear reactor itself considering pressurized water reactor. These components will be analyzed in terms of thermo-hydraulics and mechanical point of view (stress loading). Obtained numerical results will be confronted with available experimental data to increase operational safety of these devices. In the process of developing the mathematical models modern numerical methods such as Computational Fluid Dynamics (CFD) and Finite Element Method (FEM) will be used. These methods are implemented in programs ANSYS CFX and ANSYS Multiphysics. The proposed project will interconnect the thermo-hydraulic and mechanical mathematical models, which will be implemented so that the individual physical domains were directly connected. The outcome of the project will be the mathematical models and also scientific and technical papers and conference contributions.', 1),
(3, 'VEGA', '1/0453/15', 'Výskum stiesneného krútenia uzatvorených prierezov', 'Research of nonuniform torsion of cross-sections', '2015-2017', '32', NULL, NULL, '1479', '"Podstatou projektu je skúmanie účinkov stiesneného krútenia v nosníkoch s uzatvoreným tenkostenným prierezom numerickými metódami ako aj experimentálnym meraním na fyzikálnych modeloch. Bude vytvorený nový 3D nosníkový konečný prvok so zahrnutím stiesneného krútenia uzatvorených prierezov, kde sa uplatní deformačný účinok sekundárneho krútiaceho momentu. Matica tuhosti a hmotnosti bude zostavená pre homogénny materiál ako aj pre kompozitné nosníky s pozdĺžnou premenlivosťou materiálových vlastností.\r\nOdvodené vzťahy a rovnice budú implementované do počítačového programu pre elastostatickú a modálnu analýzu s uvažovaním stiesneného krútenia. Bude navrhnuté a vyrobené meracie zariadenie, ktorým sa budú verifikovať výsledky teoretických výpočtov novým konečným prvkom. Predpokladá sa, že výsledky riešenia projektu prispejú ku zmene tvrdenia normy EC 3, podľa ktorej vplyv stiesneného krútenia možno pri nosníkoch uzatvoreného prierezu zanedbať. Výsledky nášho výskumu majú za cieľ zvýšiť bezpečnosť projektovania mechanických sústav."', 'The project aim is to examine the effects of non-uniform torsion in thin-walled beams with closed cross-section by numerical methods and experimental measurements on physical models. A 3D beam finite element will be created including the non-uniform torsion with the secondary torsion moment deformation effect. The stiffness and mass matrix will be prepared for a homogeneous material as well as for composite beams with longitudinal variation of material properties. Derived relations and equations will be implemented in the computer programs for elastic-static and modal analyses. Measurement equipment will be designed, by which the results of theoretical calculations by the new finite elements will be verified. It is expected that the results of the project will contribute to review the arguments of the Eurocode 3, according to which the effect of non-uniform torsion can be neglected in the closed cross-section beams. The results of the project are intended to enhance the safety of the beam structures design.', 1),
(4, 'KEGA', '035STU-4/2014', 'Návrh virtuálneho laboratória pre implementáciu pokrocilých metodík výucby v novom študijnom programe Elektromobilita', 'Development of virtual laboratory for implementation of advanced methods of teaching in the new study program Electromobility', '2014-2016', '12', '1709', NULL, NULL, '"Projekt je zameraný na vybudovanie moderného špecializovaného virtuálneho laboratória pre pripravovaný študijný program Elektromobilita. V projekte sú navrhnuté pokročilé metódy výučby, ktoré integrujú tvorivú implementáciu teoretických poznatkov priamo do virtuálneho modelovania a simulovania mechatronických systémov v inteligentných vozidlách s elektrickým pohonom, t.j. elektromobiloch.\r\nPre podporu špecializovaného vzdelávania a novú metodológiu v študijnom programe Elektromobilita bude v projekte spracovaná nová moderná študijná literatúra a vybudované Špecializované virtuálne laboratórium s inovatívnym vybavením pre teoretickú i praktickú výučbu predmetov v tomto študijnom programe. Všetky predmety programu Elektromobilita sú zamerané na virtuálne prototypovanie smart mechatronických systémov používaných v elektromobiloch s náväznosťou na nové systémy pohonu dopravných prostriedkov s využitím virtuálneho prototypovania.\r\nSúčasťou projektu bude spracovanie študijných materiálov, vedeckých monografií, tvorba inovatívnej web stránky, publikovanie v odborných časopisoch a účasť na vedeckých konferenciách. Špecializované virtuálne laboratórium bude vybavené mechatronickými učebnými modulmi pre výučbu a štúdium sofistikovaných technológií."', 'The project aim it to build a modern specialized virtual laboratory for prepared study program Electromobility. In this project, advanced teaching methods are proposed that integrate theoretical knowledge into practical application directly into mechatronic systems in vehicles with electric drive (electric vehicles). To promote specialized training and a new methodology in the study program Electromobility, the project will support processing of a new modern study literature and creating a dedicated virtual laboratory with innovative facilities for theoretical and practical training courses in this program of study. These courses aim at smart mechatronic systems used in electromobility systems with links to the new drive systems of vehicles using virtual prototyping. The project includes new study materials processing, writing scientific monographs, creating innovative websites, publications in peer-reviewed journals and participation in scientific conferences. Dedicated virtual laboratory will be equipped with educational mechatronic modules for teaching and learning sophisticated technology.', 1),
(5, 'KEGA', '032STU-4/2013', 'Online laboratórium pre výucbu predmetov automatického riadenia', 'Online laboratory for teaching automation control subjects', '1.1.2013-31.12.2015', '40', NULL, NULL, '1719', '"Projekt sa zameriava na tvorbu interaktívnych znovupoužiteľných vzdelávacích objektov pre zvolené segmenty teórie automatického riadenia, na budovanie širšej škály experimentov ilustrujúcich aplikáciu študovaných teoretických prístupov na riešenie praktických problémov, ktoré umožňujú a podporujú nadobúdanie vedomostí, zručností, návykov a postojov v kvázi-autentickom prostredí.\r\nProjekt má za cieľ podporovať využitie nielen proprietárnych, ale aj open technológií, ktoré prinášajú viaceré výhody v oblasti šírenia výsledkov a nesporne aj po finančnej stránke. Snahou je uľahčiť prístup k laboratórnym experimentom v rámci rôznych foriem vzdelávania (denných, dištančných, resp. elektronických foriem)."', '"The project is focussed on development of interactive reusable learning objects for chosen segments of automatic control, on building broader spectrum of experiments illustrating application of studied\r\ntheoretical approaches onto practical problems enabling and supporting acquisition of knowledge, skills, habits and attitudes in an quasi-authentic environment.\r\nThe project is going to support the use of not only proprietary but also open technologies that bring various advantages in the area of results dissemination and from the financial point of view as well. Our aim is to facilitate approach to laboratory experiments for students in daily or distance form of education."', 1),
(6, 'KEGA', '030STU-4/2015', 'Multimediálna podpora vzdelávania v mechatronike', 'Multimedial education in mechatronics', '2015-2017', '41', NULL, 'http://uamt.fei.stuba.sk/KEGA_MM/', '1723', 'Svetovým trendom v oblasti modernej a bezbariérovej výučby sú jej interaktívne formy na báze internetu, videa, audiovizuálnych pomôcok a vzdialených laboratórií (on-line vzdelávanie), ktoré sa uplatňujú nielen v dištančnom vzdelávaní, ale aj v prezenčnej forme vzdelávanie s podporou nových technológií (technology augmented classroom teaching). Popri slide-show prezentáciách a edukačných miniaplikáciách (dynamické web stránky, flash animácie, Java Applets a pod.) preferujú svetové výskumné univerzity vývoj a tvorbu edukačných videí, ktorých cieľovou skupinou sú poslucháči konkrétneho predmetu (kurzu). Edukačné videá sú voľne dostupné a umožňujú študentom sledovať výklad danej problematiky kdekoľvek a kedykoľvek. Návrh a realizácia zrozumiteľného a zaujímavo podaného edukačného videa z technickej oblasti je komplexná úloha, ktorá si vyžaduje synergiu odborných, pedagogických a umeleckých kvalít jeho tvorcov. Projekt je zameraný na multimediálnu podporu vzdelávania v oblasti mechatroniky, s dôrazom na poznatky z aplikovanej informatiky, automatizácie a príbuzných vedných disciplín. Cieľom projektu je vybudovanie multimediálneho laboratória na tvorbu kvalitných edukačných videomateriálov pre prezenčnú aj dištančnú formu univerzitného vzdelávania v oblasti mechatroniky a vytvorenie a otestovanie viacerých modulov takýchto materiálov. Výstupy projektu budú ďalej využiteľné pre účely vzdelávania odborníkov z praxe vrámci celoživotného vzdelávania, a tiež popularizácie mechatroniky a automatizácie u širokej verejnosti a žiakov stredných škôl - potenciálnych študentov vysokých škôl technického zamerania.', '"Presently, interactive education forms based on exploitation of Internet, video, audiovisual aids and remote laboratories (on-line education) are world trends in modern and barrier-free education;\r\nit is applied not only in distance education but in the attendance teaching as technology augmented classroom teaching. Along with slide-shows and educational miniapplications (dynamic websites,\r\nflash animations, Java Applets etc.) research universities usually prefer to develop their own education videos targeted to the audience in a single course. Education videos are freely available and enable the students to follow the explanatory discourse on the subject topic anytime and anywhere. Design and realization of a comprehensible and interesting educational video on a technological field is a quite complex task requiring synergy of technical, educational and artistic qualities of its creators. The project deals with the multimedia support of education in mechatronics engineering, with the focus on applied informatics, automation and related fields. The objective of the project is to build a multimedia laboratory for creating high-quality educational videomaterial for both distance and attendance education in mechatronics engineering. Project outcomes will be further employed in life-long education of practitioners, and for popularization of mechatronics and automation among the public and potential university students of technology."', 1),
(7, 'KEGA', '011STU-4/2015', 'Elektronické pedagogicko-experimentálne laboratóriá mechatroniky', 'Electronic educational-experimental laboratories of Mechatronics', '2015-2017', '10', NULL, 'http://uamt.fei.stuba.sk/kega/', '1724', '"Projekt sa zaoberá vytvorením modernej vedomostnej a experimentálnej základne pre výučbu mechatroniky s dôrazom na jej elektronické súčasti. Vzhľadom na to, že mechatronika integruje viaceré oblasti poznania a ich spojením vytvára synergický efekt, budú v rámci projektu budú vypracované nové metódy a formy vo výučbe, ktoré študentom umožnia získať nové poznatky s praktickou skúsenosťou s využívaním moderných elektronických prvkov a systémov, ktoré tvoria neoddeliteľnú súčasť komplexných mechatronických systémov v oblasti výrobkov spotrebnej elektroniky, energetiky, automobilovej techniky a v zdravotníctve.\r\nPodnetnou výzvou pre podanie projektu bol vznik nových študijných programoch""""Automobilová mechatronika"""" (Bc. program) a """"Aplikovaná mechatronika a elektromobilita"""" (Ing. program). Pre tieto študijné programy budú vytvorené elektronické učebné texty pre 7 predmetov.\r\nZa účelom ďalšieho zvyšovania kvality výučby a výskumu sa plánuje v rámci v rámci riešenia projektu vytvoriť 5 nových experimentálnych pracovísk podľa najnovších trendov v elektronike, snímacej technike a riadiacich systémoch, ktoré budú mať viacúčelové využitie v priamej pedagogike, v individuálnych a tímových študentských projektoch ako aj pri výskumnej a vývojovej činnosti ústavu.\r\nCieľom projektu je zvýšiť odborné kompetencie študentov, učiteľov a výskumných pracovníkov a všetkých zúčastnených v týchto oblastiach: moderné senzory a MEMS, aktuátory na báze smart materiálov, elektrické trakčné pohony, mikroradiče a DSP pre vstavané riadiace systémy a spracovanie signálov, návrh riadiacich algoritmov a ich programovanie, elektronika a integrované obvody (ASICs) pre mechatroniku. Ďalším dôležitým sub-cieľom riešenej problematiky je získať široké kompetencie v komunikačných systémoch pre rôzne aplikačné oblasti mechatronických systémov najmä v automobilovom priemysle.\r\nNavrhovaný projekt bude podporovaný prostredníctvom moderných audiovizuálnych systémov, prostredníctvom web stránky a videí s multimediálnym spracovaním."', 'The project deals with the creation of modern knowledge and experimental basis for education in Mechatronics Engineering with the emphasis on electronic components. Due to the fact that mechatronics integrates several fields of knowledge and their junction yields a synergy effect, new methods and forms of eduation will be elaborated within the project allowing students to acquire new knowledge combined with practical experience in using modern electronic components and systems; such systems are integral parts of complex pervasive mechatronic systems (in consumer electronics, energy and automotive industries, healthcare). Inspiration for elaboration of the proposed project was launching of new study programs ""Automotive Mechatronics"" (Bachelor degree), and ""Applied Mechatronics and Electromobility"" (Master degree). For these study programs electronic textbooks for 7 subjects will be created. To further increase quality of education and research, 5 new experimental workplaces are planned to be created within the project to according to the latest development trends electronics, sensing technology and control systems having multi-purpose exploitation in direct teaching, individual and team projects as well as in research and development activities of the Institute. The objective of the project is to increase professional competences of students, teachers and researchers, and all involved in the areas: advanced sensors and MEMS, smart materials based actuators, electric traction motors, microcontrollers and digital signal processors (DSP´s) for embedded control systems and signal processing, design of control algorithms and their programming, electronics and integrated circuits (ASICs) for mechatronics. Another important sub-objective is to acquire wide competences in communication systems for various application areas of mechatronic systems, in particular in automotive industry. Modern audiovisual systems, web pages and multimedia processed videos will be widely used to support project results.', 1),
(8, 'APVV', 'APVV-0246-12', 'Pokročilé metódy modelovania a simulácie SMART mechatronických systémov', 'Advanced Methods and Simulations of SMART Mechatronic Systems', '1.10.2013-30.9.2016', '32', NULL, NULL, 'AK14', 'V prvej fáze riešenia projektu bude kladený dôraz na materiálové, technické a prístrojové zabezpečenie experimentálnych častí, ktoré budú v projekte riešené. V tejto fáze takisto budú odvodené MKP rovnice pre 3D-FGM nosníky ako aj multifyzikálne modely pre SMA. Súčasťou prvej fázy riešenia projektu bude taktiež začatá príprava fyzikálnych experimentov za účelom verifikácie matematických modelov FGM a SMA systémov. V nasledovnom období riešenia projektu bude vykonaná verifikácia matematických modelov na vybraných experimentálnych vzorkách, ktoré boli dôsledne experimentálne analyzované z hľadiska materiálového zloženia. Výsledky experimentálnych meraní na SMA aktuátore budú využité v nasledovnom období riešenia projektu pri návrhu a realizácii alternatívneho spôsobu uchytenia SMA aktuátora. Bude nasledovať vytvorenie nelineárneho modelu aktuátora SMA a návrhu nových metód syntézy zameraných na riadenie polohy a potlačenie dominantných porúch. V tomto období budú súčasne prebiehať výskumné práce na teoretickom odvodení MKP rovníc pre FGM škrupinu a jej spojenia s 3D-FGM nosníkovým prvkom do kombinovaného nosníkovo-škrupinového MEMSu. V záverečnej fáze projektu bude kladený dôraz jednak na verifikáciu odvodených MKP rovníc pre nosníkovo-škrupinový MEMS pomocou fyzikálneho experimentu ako aj na riadenie SMA aktuátora konvenčnými a inteligentnými metódami riadenia.', 'In the first phase, attention will be given to the material, technical and equipment set-up required for the first set experiments. At the same time, the FGM-beam FEM equations will be derived and SMA models designed. In addition, the first sets of experiments will be used for the verification of numerical models of 3D-FGM and SMA systems. A complex verification of numerical models will take place on selected samples whose chemistry has been consistently analyzed. Results of SMA actuator measurements will be used in the consecutive stages of the project in the design and application of alternative anchoring for SMA actuators. Next the nonlinear model of SMA actuator and new methods of synthesis focused on position control and error elimination will be proposed. This research will take place in parallel with the theoretical analysis and FEM equations derivation of FGM shells. In the tp1718a stage, emphasis will be given to both the verification of the derived FGM beam-shell equations by real sample measurements and the control of the SMA actuator by conventional and intelligent methods.', 1),
(9, 'APVV', 'APVV-0343-12', 'Počítačová podpora návrhu robustných nelineárnych regulátorov', 'Computer aided robust nonlinear control design', '1.10.2013-31.3.2017', '19', NULL, NULL, 'AK29', 'Projekt sa zaoberá vypracovaním podporného počítačového systému na návrh robustných nelineárnych regulátorov s obmedzeniami vo verzii pre Matlab/Simulink a web a vytvorením integrovaného elektronického prostredia v LMS Moodle, ktoré ho spája s webovou stránkou projektu, s elearningovými modulmi a s prístupom k vzdialeným experimentom umožňujúcim jeho overenie online. Systém je založený na novej metóde návrhu regulátorov vychádzajúcej s obmedzovania odchýlok od požadovaných tvarov vstupných a výstupných, resp. stavových veličín. Táto integruje výsledky viacerých doteraz izolovaných prístupov k návrhu regulátorov - tradičnú teóriu PID regulátorov, moderný stavový prístup s teóriou pozorovateľov, časovo optimálne riadenie, nelineárne systémy a riadenie systémov s veľkým dopravným oneskorením a robustný návrh regulátorov. Vyvíjaný systém bude vhodný pre širokú triedu neurčitých a nelineárnych objektov, ktoré predstavujú väčšinu bežných aplikácií v praxi. Systém bude pozostávať z centrálnej pracovnej stanice umožňujúcej dostatočne rýchle generovanie tzv. portrétu správania riadeného objektu s uvažovaným typom regulátora, z úložiska vytvorených portrétov správania a z grafických staníc, ktoré umožnia na základe špecifikácie neurčitých parametrov riadeného objektu a zadaných kvalitatívnych požiadaviek na riadené procesy určiť optimálne nastavenie regulátora zaručujúce pre zadané požiadavky dosiahnutie najvyššej možnej dynamiky prechodových dejov aj pri zohľadnení neurčitostí.', 'The project deals with development and introduction into practice of the computer aided system for design of robust constrained nonlinear control (in versions for Matlab/Simulink and web) and of the integrated electronic environment in LMS Moodle interconnecting the system with the project web page, with the elearning modules and with access to remote experiments enabling its online verification. The system will be based on a new robust control method based on constraining deviations from required shapes of the input, output, or state variables. This is holistically integrating several up to now isolated control design approaches - the traditional PID control, modern state & disturbance observer approach, minimum time control, nonlinear control, control of systems with long dead time and robust control. The developed system is intended for a broad class of uncertain and nonlinear plants that represent a majority of all applications in practice. The system will consist of a central work station enabling a sufficiently fast generation of the so called performance portrait of given plant with a considered type of control, from a repository of generated performance portraits and from graphical terminals enabling by means of specifying parameters of given plant and the required shape-related performance measures to determine the optimal controller tuning guaranteeing the fastest possible transients responses in the control loop under consideration of the given uncertainties.', 1),
(10, 'APVV', 'APVV-0772-12', 'Moderné metódy riadenia s využitím FPGA štruktúr', 'Advanced control methods based on FPGA structures', '1.10.2013-30.9.2017', '28', NULL, NULL, 'AK39', 'Projekt rieši aktuálne otázky výskumu a vývoja moderných metód riadenia s využitím hardvérových realizácií konvenčných (PID) ako aj moderných (optimálne, robustné, prediktívne) algoritmov riadenia pre procesy s rýchlou dynamikou. V súčasnosti dominujú vo výskume a implementácii moderných riadiacich systémov tieto smery: riešenia na báze mikroprocesorov (softvérový prístup), jednoúčelové riešenia ASIC a riešenia na báze programovateľných hradlových polí (Field Programmable Gate Arrays, FPGA), ktoré predstavujú konfigurovateľné obvody vysokého stupňa integrácie (VLSI) schopné integrovať rôzne logické a riadiace funkcie. Hardvérové implementácie algoritmov riadenia sú v porovnaní so softvérovými realizáciami vo všeobecnosti o niekoľko rádov rýchlejšie, pretože spracovanie v nich prebieha paralelne, navyše sú kompaktnejšie a vo všeobecnosti lacnejšie. Hlavným cieľom projektu je výskum a vývoj algoritmov na báze FPGA štruktúr, ktorý bude skúmaný na vývojových FPGA systémoch a verifikovaný na fyzikálnych laboratórnych modeloch s rýchlou dynamikou.', 'The project deals with research and development of advanced control methods based on HW implementation of conventional (PID) as well as modern optimal, robust and predictive algorithms applicable in control of plants with fast dynamics. Predominating approaches in the research of modern control systems implementation are microprocessor-based solutions (software approach), ASIC (dedicated approach) and the FPGA based approach. Field Programmable Gate Arrays (FPGA) are configurable circuits of very-large-scale-integration (VLSI) able to integrate various logical and control functions. In general, HW implementations of control algorithms are faster by several orders compared with SW implementations due to parallel processing of information; moreover they are more compact and also less expensive. The main objective of the project is research and development of FPGA-based control algorithms. Their research and development will be studied on available FPGA development kits and verified on laboratory plants with fast dynamics.', 1),
(11, 'APVV', 'APVV-14-0613', 'Širokopásmový MEMS detektor terahertzového žiarenia', 'Broadband MEMS detector of terahertz radiaton', '2015 - 2018', '30', NULL, NULL, NULL, NULL, 'The project is aimed on research and development of new types of broadband detectors for terahertz frequency range. This new type of detector is designed in a concept of micro-electro-mechanical system and uses the bolometric sensing principle. The design construction of the detector consists of a microbolometric sensing device coupled to a broadband antenna. Thermal conversion of the incident THz radiation takes place on a thin polyimide membrane which enables (a) to achieve high thermal conversion efficiency and (b) to design detectors with balanced amplitude characteristics even at high frequency range. The proposed MEMS detector concept will be optimized by a sophisticated process of modeling and simulation in direct mutual iteration with experimental analysis of functionality and detection capability. The completion of the project will be given by the developed state-of-the-art methodology of characterization, broadband THz detection and simulation of the MEMS detector device applicable in the research and education.', 1),
(12, 'International', 'SK06-II-01-004', 'Podpora medzinárodnej mobility medzi STU Bratislava, NTNU Trondheim a Universität Liechtenstein', 'Support of international mobilites between STU Bratislava, NTNU Trondheim, and Universität Liechtenstein', '2.6.2015 - 30.9.2016', '19', 'Norwegian University of Science and Technology Trondheim (prof. Skogestad, prof. Johansen, prof. Hovd)|Universität Liechtenstein, Liechtenstein (prof. Droege)', NULL, NULL, 'Projekt rieši aktuálne otázky výskumu a vývoja moderných metód riadenia s využitím hardvérových realizácií konvenčných (PID) ako aj moderných (optimálne, robustné, prediktívne) algoritmov riadenia pre procesy s rýchlou dynamikou. V súčasnosti dominujú vo výskume a implementácii moderných riadiacich systémov tieto smery: riešenia na báze mikroprocesorov (softvérový prístup), jednoúčelové riešenia ASIC a riešenia na báze programovateľných hradlových polí (Field Programmable Gate Arrays, FPGA), ktoré predstavujú konfigurovateľné obvody vysokého stupňa integrácie (VLSI) schopné integrovať rôzne logické a riadiace funkcie. Hardvérové implementácie algoritmov riadenia sú v porovnaní so softvérovými realizáciami vo všeobecnosti o niekoľko rádov rýchlejšie, pretože spracovanie v nich prebieha paralelne, navyše sú kompaktnejšie a vo všeobecnosti lacnejšie. Hlavným cieľom projektu je výskum a vývoj algoritmov na báze FPGA štruktúr, ktorý bude skúmaný na vývojových FPGA systémoch a verifikovaný na fyzikálnych laboratórnych modeloch s rýchlou dynamikou.', 'The aim of the project is to support international mobility of students, PhD students, and staff members of four participating faculties of STU in Bratislava with partners from NTNU Trondheim and Universität Liechtenstein. It will initiate academic cooperation between the University of Liechtenstein and STU Bratislava in construction, architecture, and space planning, focusing on the use of alternative energy sources in operation of buildings, including computer-aided simulations of energy needs and internal environment, and spatial planning of rural settlements as well. The project also contributes to further strengthening of already existing cooperation between NTNU Trondheim and faculties of STU in Bratislava in the field of advanced methods of automatic control and to progress of inter-faculty cooperation at STU in Bratislava.', 1),
(13, 'other', 'TB', 'Softvérové riadenie smerovej dynamiky vozidla UGV 6x6', 'Softvérové riadenie smerovej dynamiky vozidla UGV 6x6', '2015', '8', NULL, NULL, '7506', NULL, NULL, 1),
(14, 'other', 'VW', 'Predlžovanie životnosti akumulátorového systému', 'Predlžovanie životnosti akumulátorového systému', '2015', '8', NULL, NULL, '7509', NULL, NULL, 1),
(15, 'other', 'MV', 'REST platforma pre online riadenie experimentov', 'REST Platform for Online Control of Experiments', '2015', '16', NULL, NULL, '1361', '"Tento projekt je súčasťou rozsiahlejšieho cieľa o vytvorenie univerzálneho protokolu pre vzdialené riadenie reálnych sústav a tiež balíka softvérových nástrojov na jeho implementáciu. Hlavným cieľom celého úsilia je zjednodušiť a urýchliť budovanie modulárnych online laboratórií.\r\nÚlohami projektu sú návrh a vytvorenie nástroaj pre vzdialený prístup k softvéru Scilab, zavŕšenie implementácie podobného nástroja určeného pre softvérový balík Matlab/Simulink, a návrh a čiastočná implementácia mechatronického systému, ktorý bude v budúcnosti slúžiť na demonštráciu spomenutých nástrojov a následne ako učebná pomôcka."', 'The project is a part of an extensive endeavor to create universal protocol for remote control of real plants, and a suite of software tools to implement this protocol. The main objective of this whole endeavor is to simplify and accelerate implementation of modular online laboratories. Tasks of this project include design and implementation of a software tool for remote access to Scilab, completion of implementation of a similar tool for Matlab/Simulink, and design and partial implementation of a mechatronic system which will serve for demonstration of mentioned tools and later on as teaching aid.', 1);

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
  `ldapLogin` varchar(64) COLLATE utf8_slovak_ci DEFAULT NULL,
  `photo` varchar(128) COLLATE utf8_slovak_ci DEFAULT NULL,
  `room` varchar(128) COLLATE utf8_slovak_ci DEFAULT NULL,
  `phone` varchar(16) COLLATE utf8_slovak_ci DEFAULT NULL,
  `department` varchar(32) COLLATE utf8_slovak_ci DEFAULT NULL,
  `staffRole` varchar(32) COLLATE utf8_slovak_ci DEFAULT NULL,
  `roles` mediumtext COLLATE utf8_slovak_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_slovak_ci DEFAULT NULL,
  `web` varchar(128) COLLATE utf8_slovak_ci DEFAULT NULL,
  `activated` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `staff`
--

INSERT INTO `staff` (`s_id`, `name`, `surname`, `title1`, `title2`, `ldapLogin`, `photo`, `room`, `phone`, `department`, `staffRole`, `roles`, `email`, `web`, `activated`) VALUES
(1, 'Vladislav', 'Bača', 'Ing.', NULL, NULL, 'baca.jpg', 'T005', '264', 'OEMP', 'doktorand', '', '', '', 1),
(2, 'Peter', 'Balko', 'Ing.', NULL, NULL, NULL, 'D 102', '395', 'OIKR', 'doktorand', '', '', '', 1),
(3, 'Richard', 'Balogh', 'Ing.', ' PhD.', NULL, 'balogh.jpg', 'D110', '411', 'OEMP', 'teacher', '', '', '', 1),
(4, 'Igor', 'Bélai', 'Ing.', ' PhD.', NULL, NULL, 'D 126', '478', 'OEMP', 'teacher', '', '', '', 1),
(5, 'Katarína', 'Beringerová', NULL, NULL, NULL, NULL, 'A 705', '672', 'AHU', 'teacher', '', '', '', 1),
(6, 'Pavol', 'Bisták', 'Ing.', ' PhD.', 'bistak', 'bistak.jpg', 'D 120', '695', 'OEAP', 'teacher', '', '', '', 1),
(7, 'Dmitrii', 'Borkin', 'Ing.', NULL, NULL, NULL, 'D 102', '395', 'OIKR', 'doktorand', '', '', '', 1),
(8, 'Martin', 'Bugár', 'Ing.', ' PhD.', NULL, NULL, 'A 708', '579', 'OEAP', 'teacher', '', '', '', 1),
(9, 'Ján', 'Cigánek', 'Ing.', ' PhD.', NULL, NULL, 'D 104', '686', 'OIKR', 'teacher', '', '', '', 1),
(10, 'Peter', 'Drahoš', 'doc. Ing.', ' PhD.', NULL, NULL, 'D 118', '669', 'OEMP', 'teacher', '', '', '', 1),
(11, 'František', 'Erdödy', NULL, NULL, NULL, 'erdody.jpg', 'A S39', '818', 'AHU', 'teacher', '', '', '', 1),
(12, 'Viktor', 'Ferencey', 'prof. Ing.', ' PhD.', NULL, 'ferencey.jpg', 'A 802', '438', 'OEAP', 'teacher', '', '', '', 1),
(13, 'Peter', 'Fuchs', 'doc. Ing.', ' PhD.', NULL, NULL, 'B S05', '826', 'OEMP', 'researcher', '', '', '', 1),
(14, 'Gabriel', 'Gálik', 'Ing.', NULL, NULL, NULL, 'A 706', '559', 'OAMM', 'researcher', '', '', '', 1),
(15, 'Vladimír', 'Goga', 'doc. Ing.', ' PhD.', NULL, NULL, 'A 702', '687', 'OAMM', 'teacher', '', '', '', 1),
(16, 'Miroslav', 'Gula', 'Ing.', NULL, 'xgulam', 'gula.jpg', 'D 103', '628', 'OIKR', 'doktorand', '', '', '', 1),
(17, 'Oto', 'Haffner', 'Ing.', ' PhD.', NULL, 'haffner.jpg', 'D 125', '315', 'OIKR ', 'teacher', '', '', '', 1),
(18, 'Juraj', 'Hrabovský', 'Ing.', ' PhD.', NULL, NULL, 'A 706', '559', 'OAMM', 'teacher', '', '', '', 1),
(19, 'Mikuláš', 'Huba', 'prof. Ing.', 'PhD.', NULL, NULL, 'D 112', '771', 'OEAP', 'teacher', '[]', NULL, NULL, 1),
(20, 'Mária', 'Hypiusová', 'Ing.', ' PhD.', NULL, NULL, 'D 122', '193', 'OIKR', 'teacher', '', '', '', 1),
(21, 'Štefan', 'Chamraz', 'Ing.', ' PhD.', NULL, NULL, 'D 107', '848', 'OEMP', 'teacher', '', '', '', 1),
(22, 'Jakub', 'Jakubec', 'Ing.', ' PhD.', NULL, NULL, 'A 707', '452', 'OAMM ', 'researcher', '', '', '', 1),
(23, 'Igor', 'Jakubička', 'Ing.', NULL, NULL, 'jakubicka.jpg', 'T005', '264', 'OEMP', 'doktorand', '', '', '', 1),
(24, 'Katarína', 'Kermietová', NULL, NULL, NULL, NULL, 'D 116', '598', 'AHU', 'teacher', '', '', '', 1),
(25, 'Ivan', 'Klimo', 'Ing.', NULL, NULL, NULL, 'D 101', '509', 'OEMP', 'doktorand', '', '', '', 1),
(26, 'Michal', 'Kocúr', 'Ing.', ' PhD.', 'xkocurm2', 'kocur.jpg', 'D 104', '686', 'OIKR ', 'teacher', '', '', '', 1),
(27, 'Štefan', 'Kozák', 'prof. Ing.', 'PhD.', NULL, 'default_male_img.png', 'D 115', '281', 'OEMP', 'teacher', '[]', NULL, NULL, 1),
(28, 'Alena', 'Kozáková', 'doc. Ing.', ' PhD.', NULL, NULL, 'D 111', '563', 'OIKR', 'teacher', '', '', '', 1),
(29, 'Erik', 'Kučera', 'Ing.', ' PhD.', NULL, NULL, 'D 125', '315', 'OIKR ', 'teacher', '', '', '', 1),
(30, 'Vladimír', 'Kutiš', 'doc. Ing.', ' PhD.', NULL, 'kutis.jpg', 'A 701', '562', 'OAMM ', 'teacher', '', '', '', 1),
(31, 'Alek', 'Lichtman', 'Ing.', NULL, NULL, NULL, 'D 101', '509', 'OEMP', 'doktorand', '', '', '', 1),
(32, 'Justín', 'Murín', 'prof. Ing.', 'DrSc.', NULL, 'default_male_img.png', 'A 704', '611', 'OAMM', 'teacher', '[]', NULL, NULL, 1),
(33, 'Jakub', 'Osuský', 'Ing.', ' PhD.', NULL, 'osusky.jpg', 'D 123', '356', 'OIKR ', 'teacher', '', '', '', 1),
(34, 'Tomáš', 'Paciga', 'Ing.', NULL, NULL, NULL, 'A 707', '452', 'OAMM', 'doktorand', '', '', '', 1),
(35, 'Juraj', 'Paulech', 'Ing.', ' PhD.', NULL, 'paulech.jpg', 'A 701', '562', 'OAMM', 'teacher', '', '', '', 1),
(36, 'Matej', 'Rábek', 'Ing.', NULL, 'xrabek', 'rabek.jpg', 'D 103', '628', 'OIKR', 'doktorand', '', '', '', 1),
(37, 'Tibor', 'Sedlár', 'Ing. ', NULL, NULL, NULL, 'A 803', '399', 'OAMM', 'teacher', '', '', '', 1),
(38, 'Erich', 'Stark', 'Ing.', NULL, NULL, 'stark.jpg', 'C 014', '', 'OIKR', 'doktorand', '', '', '', 1),
(39, 'Peter', 'Ťapák', 'Ing.', ' PhD.', NULL, NULL, 'D 121', '569', 'OEAP', 'teacher', '', '', '', 1),
(40, 'Katarína', 'Žáková', 'doc. Ing.', 'PhD.', 'zakova', 'default_male_img.png', 'D 119', '742', 'OIKR', 'teacher', '[]', NULL, NULL, 1),
(41, 'Danica', 'Rosinová', 'doc. Ing.', ' PhD.', NULL, 'rosinova.jpg', 'D 111', '563', 'OIKR', 'teacher', '', '', '', 1),
(42, 'Admin', 'Admin', NULL, NULL, 'xdzacovsky', NULL, '', NULL, '', '', '', '', '', 1),
(43, 'Laravel', 'Laravel', 'Prof.', 'PhD.', 'xtrocha', NULL, '456', '123', 'ABC', 'developer', '["admin"]', '', '', 1),
(44, 'Tester', 'Tester', NULL, NULL, 'xtester', NULL, NULL, NULL, 'AHU', 'doktorand', '["hr"]', NULL, NULL, 1),
(51, 'Tester2', 'Tester2', NULL, NULL, NULL, NULL, NULL, NULL, 'AHU', 'doktorand', '[]', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `staff_function`
--

CREATE TABLE `staff_function` (
  `id` int(11) NOT NULL,
  `id_staff` int(4) NOT NULL,
  `id_func` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `staff_function`
--

INSERT INTO `staff_function` (`id`, `id_staff`, `id_func`) VALUES
(23, 51, 1),
(24, 51, 2),
(25, 51, 3),
(26, 50, 4),
(27, 50, 5),
(28, 50, 6),
(29, 19, 1),
(30, 32, 5),
(31, 27, 4),
(32, 40, 6),
(33, 51, 2);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `subjects`
--

CREATE TABLE `subjects` (
  `sub_id` int(11) NOT NULL,
  `abbrev` varchar(16) COLLATE utf8_slovak_ci NOT NULL,
  `title` varchar(256) COLLATE utf8_slovak_ci NOT NULL,
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

--
-- Sťahujem dáta pre tabuľku `subjects_files`
--

INSERT INTO `subjects_files` (`sf_id`, `hash_id`, `hash_name`, `file_name`) VALUES
(1, '4a8cbb44c6945d3e04a251921db8bf65', 'AJqU9M6nhYt8aqosjlBbjG1puLNMItsQd78uLlrj.zip', 'water.jpg.zip'),
(2, '4a8cbb44c6945d3e04a251921db8bf65', 'iRzzLse8CkzKTRwwkqqkcA6uIHuJZ6CUE2HyUfce.png', 'monkey1.png'),
(3, '4a8cbb44c6945d3e04a251921db8bf65', 'lEi6cF2FJPLIcWKfnDLKL34AfaUxnQZdSt79mXyx.jpeg', 'test.jpg');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `subjects_info`
--

CREATE TABLE `subjects_info` (
  `si_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `info_sk` longtext,
  `info_en` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `subjects_info`
--

INSERT INTO `subjects_info` (`si_id`, `sub_id`, `info_sk`, `info_en`) VALUES
(1, 1, '<p>gdfgsdf</p>', NULL);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `subjects_staff_rel`
--

CREATE TABLE `subjects_staff_rel` (
  `sus_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `subjects_staff_rel`
--

INSERT INTO `subjects_staff_rel` (`sus_id`, `sub_id`, `s_id`) VALUES
(1, 1, 51),
(2, 2, 51),
(3, 3, 51);

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
(1, 1, 'd70db01e7a2a4897ebbeceac5a23d6ee', 'jajaja', 'ajajaja', '<p>ddfasddf</p>', '<p>fadsassdfa</p>');

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
  `title_SK` varchar(256) COLLATE utf8_slovak_ci NOT NULL,
  `title_EN` varchar(256) COLLATE utf8_slovak_ci NOT NULL,
  `url` varchar(512) COLLATE utf8_slovak_ci NOT NULL,
  `type_sk` varchar(64) COLLATE utf8_slovak_ci NOT NULL,
  `type_en` varchar(64) COLLATE utf8_slovak_ci NOT NULL
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
(6, 'Inžinierska informatika v mechatronike - Ing. ŠP Aplikovaná mechatronika a elektromobilita ', 'Engineering informatics in mechatronics - Engineering SP Applied mechatronics and electromobility', 'CLwEjKN9ixg', 'Propagačné videá', 'Promotional videos'),
(7, 'Ústav automobilovej mechatroniky FEI STU ', 'Department of automobile mechatronics FEI STU', 'IiNXYgbOKxw', 'Propagačné videá', 'Promotional videos'),
(8, 'videjo', 'videjo in ingliš', '57BJvTZK6Vc', 'Naše laboratóriá', 'Our laboratories'),
(9, 'FPFA', 'FPGA', 'xEkg96rcwsE', 'Predmety', 'Subjects');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `deletor`
--
ALTER TABLE `deletor`
  ADD PRIMARY KEY (`del_id`);

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
-- Indexy pre tabuľku `functions`
--
ALTER TABLE `functions`
  ADD PRIMARY KEY (`f_id`);

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
  ADD PRIMARY KEY (`n_id`);

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
-- Indexy pre tabuľku `staff_function`
--
ALTER TABLE `staff_function`
  ADD PRIMARY KEY (`id`);

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
-- Indexy pre tabuľku `subjects_info`
--
ALTER TABLE `subjects_info`
  ADD PRIMARY KEY (`si_id`);

--
-- Indexy pre tabuľku `subjects_staff_rel`
--
ALTER TABLE `subjects_staff_rel`
  ADD PRIMARY KEY (`sus_id`);

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
-- AUTO_INCREMENT pre tabuľku `deletor`
--
ALTER TABLE `deletor`
  MODIFY `del_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pre tabuľku `documents`
--
ALTER TABLE `documents`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pre tabuľku `documents_categories`
--
ALTER TABLE `documents_categories`
  MODIFY `dc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pre tabuľku `documents_files`
--
ALTER TABLE `documents_files`
  MODIFY `df_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pre tabuľku `events`
--
ALTER TABLE `events`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pre tabuľku `functions`
--
ALTER TABLE `functions`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pre tabuľku `media`
--
ALTER TABLE `media`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pre tabuľku `media_files`
--
ALTER TABLE `media_files`
  MODIFY `mf_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pre tabuľku `nepritomnosti`
--
ALTER TABLE `nepritomnosti`
  MODIFY `at_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=669;
--
-- AUTO_INCREMENT pre tabuľku `news`
--
ALTER TABLE `news`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pre tabuľku `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT pre tabuľku `news_dl_files`
--
ALTER TABLE `news_dl_files`
  MODIFY `nf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pre tabuľku `photos`
--
ALTER TABLE `photos`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pre tabuľku `photo_gallery`
--
ALTER TABLE `photo_gallery`
  MODIFY `pg_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pre tabuľku `project`
--
ALTER TABLE `project`
  MODIFY `pr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pre tabuľku `staff`
--
ALTER TABLE `staff`
  MODIFY `s_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT pre tabuľku `staff_function`
--
ALTER TABLE `staff_function`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
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
-- AUTO_INCREMENT pre tabuľku `subjects_info`
--
ALTER TABLE `subjects_info`
  MODIFY `si_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pre tabuľku `subjects_staff_rel`
--
ALTER TABLE `subjects_staff_rel`
  MODIFY `sus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pre tabuľku `subjects_subcategories`
--
ALTER TABLE `subjects_subcategories`
  MODIFY `ss_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
