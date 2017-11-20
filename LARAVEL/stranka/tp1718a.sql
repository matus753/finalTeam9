-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Po 20.Nov 2017, 22:08
-- Verzia serveru: 10.1.22-MariaDB
-- Verzia PHP: 7.1.4

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
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `media` varchar(50) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `url` varchar(200) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `file` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `title_EN` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `media`
--

INSERT INTO `media` (`id`, `date`, `title`, `media`, `type`, `url`, `file`, `title_EN`) VALUES
(1, '2014-10-14', 'Študenti z Bratislavy vyvinuli u nás prvú elektrickú motokáru', 'Hospodárske noviny', 'link', 'http://dennik.hnonline.sk/ekonomika-a-firmy/591621-studenti-z-bratislavy-vyvinuli-u-nas-prvu-elektricku-motokaru#.VETnmBjntpk.facebook', '', 'Students from Bratislava have developed the first electric kart in our country'),
(2, '2014-10-20', 'Prvá elektrická motokára na Slovensku vznikla v škole', 'Pravda', 'link', 'http://spravy.pravda.sk/ekonomika/clanok/333718-prva-elektricka-motokara-na-slovensku-vznikla-v-skole/', '', 'The first electric kart in Slovakia was set up in the school'),
(3, '2015-11-10', 'Poodkryl tajomstvo', 'Šarm', 'server', '', 'sarm201546.pdf', 'He uncovered a secret'),
(4, '2016-01-19', 'Mladí vedci navrhli snímač akupunktúrnych bodov', 'Rádio Regina', 'link', 'http://reginazapad.rtvs.sk/clanky/deti/98134/mladi-vedci-navrhli-snimac-akupunkturnych-bodov', '', 'Young scientists have designed an acupuncture point reader'),
(5, '2016-03-29', 'Vďaka biomechatronikom z STU sa už akupunktúrne body neskryjú', 'Dennik N', 'both', 'http://science.dennikn.sk/clankyarozhovory/\r\nnezivapriroda/\r\ntechnika/6196vdakaslovenskymbiomechatronikomsauzakupunkturnebodyneskryju', 'science20162903.pdf', 'Thanks to biomechatronics from STU, acupuncture points are no longer hidden'),
(6, '2017-01-12', 'Automobilová mechatronika (od 6:35 min)', 'VAT RTVS', 'link', 'https://www.rtvs.sk/televizia/archiv/11767/115433', '', 'Automobile Mechatronics (from 6:35 min)'),
(7, '2017-01-19', 'Prvý slovenský elektrický skúter (od 7:50 min)', 'VAT RTVS', 'link', 'https://www.rtvs.sk/televizia/archiv/11767/117377', '', 'First Slovak electric scooter (from 7:50 min)');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `nakupy`
--

CREATE TABLE `nakupy` (
  `id` int(11) NOT NULL,
  `purchase` varchar(50) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `message` varchar(5000) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `nakupy`
--

INSERT INTO `nakupy` (`id`, `purchase`, `message`) VALUES
(1, 'Skuskasa sa as fas dafemily', 'agrkkjagvaergvaervaeraas savavaas aas erfad fa egar yulaer vvaer grveavarjas knzbakks sa asas sa'),
(3, 'asd', 'fasfasf'),
(4, 'safaf', 'Hdnxmmska'),
(5, 'banany', 'Ahoj ;) wa fr'),
(7, 'Lorem text', '<div>Čo je to Lorem Ipsum?</div><div>Lorem Ipsum je fiktívny text, používaný pri návrhu tlačovín a typografie. Lorem Ipsum je štandardným výplňovým textom už od 16. storočia, keď neznámy tlačiar zobral sadzobnicu plnú tlačových znakov a pomiešal ich, aby tak vytvoril vzorkovú knihu. Prežil nielen päť storočí, ale aj skok do elektronickej sadzby, a pritom zostal v podstate nezmenený. Spopularizovaný bol v 60-tych rokoch 20.storočia, vydaním hárkov Letraset, ktoré obsahovali pasáže Lorem Ipsum, a neskôr aj publikačným softvérom ako Aldus PageMaker, ktorý obsahoval verzie Lorem Ipsum.</div><div><br></div><div>Prečo ho používame?</div><div>Je dávno známe, že ak je zrozumiteľný obsah stránky, na ktorej rozloženie sa čitateľ díva, jeho pozornosť je rozptýlená. Dôvodom použitia Lorem Ipsum je fakt, že má viacmenej normálne rozloženie písmen, takže oproti použitiu \'Sem editorov webových stránok už používajú Lorem Ipsum ako predvolený výplňový text a keď dáte na internete vyhľadávať \'lorem ipsum\', objavíte mnoho webových stránok v rannom štádiu ich vzniku. V minulých rokoch sa objavilo mnoho verzií tohto textu, niekedy náhodou, niekedy úmyselne (pridaný humor a podobne).</div><div><br></div><div><br></div><div>Odkiaľ pochádza?</div><div>Napriek všeobecnému presvedčeniu nie je Lorem Ipsum len náhodný text. Jeho korene sú v časti klasickej latinskej literatúry z roku 45 pred n.l., takže má viac ako 2000 rokov. Richard McClintock, profesor latinčiny na Hampden-Sydney College vo Virgínii, hľadal je dno z menej určitých latinských slov, consectetur, z pasáže Lorem Ipsum, a ako vyhľadával výskyt tohto slova v klasickej literatúre, objavil jeho nepochybný zdroj. Lorem Ipsum pochádza z odsekov 1.10.32 a 1.10.33 Cicerovho diela \"De finibus bonorum et malorum\" (O najvyššom dobre a zle), napísaného v roku 45 pred n.l. Táto kniha je pojednaním o teórii etiky, a bola veľmi populárna v renesancii. Prvý riadok Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", je z riadku v odseku 1.10.32.</div><div><br></div><div>Štandardný úsek Lorem Ipsum, používaný od 16. storočia, je pre zaujímavosť uvedený nižšie. Odseky 1.10.32 a 1.10.33 z \"De finibus bonorum et malorum\" od Cicera tu sú tiež uvedené v ich presnom pôvodnom tvare, doplnené anglickými verziami z roku 1914, v preklade H. Rackhama.</div><div><br></div><div>Kde ho môžem získať?</div><div>Existuje mnoho podôb pasáží Lorem Ipsum, ale väčšina trpela rôznymi zmenami, vložením humoru, alebo náhodných slov, ktoré nevyzerajú ani trocha dôveryhodne. Ak sa chystáte použiť pasáž z Lorem Ipsum, mali by ste sa presvedčiť, že uprostred textu nie je skrytá žiadna časť, ktorá by vás mohla priviesť do nepríjemnej situácie. Všetky generátory Lorem Ipsum na internete opakujú vopred definované časti textu, takže náš generátor je prvým skutočným generátorom na internete. Používa slovník viac ako 200 latinských slov, a kombinuje ich niekoľkými modelovými vetnými štruktúrami, takže generuje Lorem Ipsum, ktoré vyzerá hodnoverne. Vygenerované Lorem Ipsum je týmto spôsobom vždy bez opakujúcich sa častí, bez vtipov a nenáležitých výrazov, atď.</div>');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `nepritomnosti`
--

CREATE TABLE `nepritomnosti` (
  `id` int(11) NOT NULL,
  `id_zamestnanca` int(11) NOT NULL,
  `id_typu` int(11) NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `nepritomnosti`
--

INSERT INTO `nepritomnosti` (`id`, `id_zamestnanca`, `id_typu`, `datum`) VALUES
(1, 1, 1, '2017-05-16'),
(2, 1, 1, '2017-05-17'),
(3, 2, 3, '2017-05-10'),
(4, 2, 3, '2017-05-11'),
(5, 5, 3, '2017-05-04'),
(6, 5, 3, '2017-05-09'),
(7, 5, 3, '2017-05-11'),
(8, 5, 3, '2017-05-16'),
(9, 7, 3, '2017-05-09'),
(10, 7, 3, '2017-05-16'),
(11, 7, 3, '2017-05-19'),
(12, 6, 2, '2017-05-09'),
(13, 6, 2, '2017-05-16'),
(14, 8, 2, '2017-05-05'),
(15, 8, 2, '2017-05-12'),
(16, 9, 2, '2017-05-03'),
(17, 9, 2, '2017-05-09'),
(18, 9, 2, '2017-05-10'),
(19, 42, 3, '2017-05-08'),
(20, 42, 3, '2017-05-09'),
(21, 42, 3, '2017-05-10'),
(22, 10, 2, '2017-05-06'),
(23, 10, 2, '2017-05-13'),
(24, 10, 2, '2017-05-20'),
(25, 42, 2, '2017-05-22'),
(26, 42, 2, '2017-05-23'),
(27, 42, 2, '2017-05-24'),
(28, 12, 2, '2017-05-01'),
(29, 12, 2, '2017-05-02'),
(30, 12, 2, '2017-05-03'),
(31, 4, 4, '2017-05-03'),
(32, 4, 4, '2017-05-09'),
(33, 4, 4, '2017-05-10'),
(34, 4, 4, '2017-05-16'),
(35, 1, 1, '2017-05-02'),
(36, 2, 1, '2017-05-02'),
(37, 2, 4, '2017-05-05'),
(38, 3, 4, '2017-05-07'),
(39, 3, 3, '2017-05-18'),
(40, 3, 3, '2017-05-19'),
(41, 4, 5, '2017-05-21'),
(42, 4, 5, '2017-05-22'),
(43, 4, 5, '2017-05-23'),
(44, 4, 5, '2017-05-24'),
(45, 4, 5, '2017-05-25'),
(46, 7, 5, '2017-05-13'),
(47, 11, 4, '2017-05-11'),
(48, 11, 4, '2017-05-12'),
(49, 11, 4, '2017-05-13'),
(50, 13, 3, '2017-05-04'),
(51, 13, 5, '2017-05-09'),
(52, 14, 3, '2017-05-04'),
(53, 15, 4, '2017-05-06'),
(54, 33, 5, '2017-05-12'),
(55, 16, 1, '2017-05-20'),
(56, 16, 1, '2017-05-21'),
(57, 19, 1, '2017-05-15'),
(58, 19, 1, '2017-05-16'),
(59, 19, 1, '2017-05-17'),
(60, 19, 1, '2017-05-18'),
(61, 19, 1, '2017-05-19'),
(62, 22, 1, '2017-05-07'),
(63, 22, 1, '2017-05-08'),
(64, 22, 1, '2017-05-09'),
(65, 25, 1, '2017-05-10'),
(66, 25, 1, '2017-05-11'),
(67, 2, 1, '2017-05-14'),
(68, 2, 1, '2017-05-15'),
(69, 42, 3, '2017-05-05'),
(70, 42, 3, '2017-05-12'),
(71, 26, 5, '2017-05-30'),
(72, 26, 5, '2017-05-31');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title_en` varchar(100) NOT NULL,
  `title_sk` varchar(100) NOT NULL,
  `content_en` varchar(1000) NOT NULL,
  `content_sk` varchar(1000) NOT NULL,
  `date_created` date NOT NULL,
  `date_expiration` date NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '0 - Propagácia, 1 - Oznamy, 2 - Zo života fakulty'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `news`
--

INSERT INTO `news` (`id`, `title_en`, `title_sk`, `content_en`, `content_sk`, `date_created`, `date_expiration`, `type`) VALUES
(1, 'English Title', 'Slovenský Nadpis', 'English Content', 'Slovenský Obsah', '2017-05-24', '2017-05-31', 1),
(2, 'English Title1', 'Slovenský Nadpis1', 'English Content1English Content1English Content1English Content1English Content1English Content1English Content1English Content1English Content1English Content1English Content1English Content1English Content1', 'Slovenský Obsah1Slovenský Obsah1Slovenský Obsah1Slovenský Obsah1Slovenský Obsah1Slovenský Obsah1Slovenský Obsah1Slovenský Obsah1Slovenský Obsah1Slovenský Obsah1Slovenský Obsah1Slovenský Obsah1Slovenský Obsah1Slovenský Obsah1', '2017-05-23', '2017-05-31', 2),
(3, 'English Title2', 'Slovenský Nadpis2', 'English Content2', 'Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2', '2017-05-22', '2017-05-31', 0),
(4, 'English Title3', 'Slovenský Nadpis3', 'English Content3', 'Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3', '2017-05-18', '2017-05-31', 1),
(5, 'English Title4', 'Slovenský Nadpis4', 'English Content4', 'Slovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský Obsah4', '2017-05-14', '2017-05-23', 0),
(6, 'English Title', 'Slovenský Nadpis', 'English Content', 'Slovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský Obsah', '2017-05-05', '2017-05-09', 2),
(7, 'English Title', 'svk prazdny content', 'English Content', '', '2017-05-24', '2017-05-31', 1),
(8, 'title_en', 'title_sk', 'content_en', 'content_sk', '2017-05-25', '2017-05-31', 1),
(9, 'test', 'test', 'test', 'test', '2017-05-25', '2017-06-03', 1),
(10, 'Bitch', 'Ivo', 'Yeah hi is dick', 'ivo zase premiestnil footer a mam tam error', '2017-05-25', '2017-05-29', 1),
(11, 'English Title', 'Slovenský Nadpis', 'English Content', 'Slovenský Obsah', '2017-05-24', '2017-05-31', 1),
(12, 'English Title1', 'Slovenský Nadpis1', 'English Content1English Content1English Content1English Content1English Content1English Content1English Content1English Content1English Content1English Content1English Content1English Content1English Content1', 'Slovenský Obsah1Slovenský Obsah1Slovenský Obsah1Slovenský Obsah1Slovenský Obsah1Slovenský Obsah1Slovenský Obsah1Slovenský Obsah1Slovenský Obsah1Slovenský Obsah1Slovenský Obsah1Slovenský Obsah1Slovenský Obsah1Slovenský Obsah1', '2017-05-23', '2017-05-31', 2),
(13, 'English Title2', 'Slovenský Nadpis2', 'English Content2', 'Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2Slovenský Obsah2', '2017-05-22', '2017-05-31', 0),
(14, 'English Title3', 'Slovenský Nadpis3', 'English Content3', 'Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3Slovenský Obsah3', '2017-05-18', '2017-05-31', 1),
(15, 'English Title4', 'Slovenský Nadpis4', 'English Content4', 'Slovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský Obsah4', '2017-05-14', '2017-05-23', 0),
(16, 'English Title', 'Slovenský Nadpis', 'English Content', 'Slovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský ObsahSlovenský Obsah', '2017-05-05', '2017-05-09', 2),
(17, 'English Title', 'svk prazdny content', 'English Content', '', '2017-05-24', '2017-05-31', 1),
(18, 'title_en', 'title_sk', 'content_en', 'content_sk', '2017-05-25', '2017-05-31', 1),
(19, 'test', 'test', 'test', 'test', '2017-05-25', '2017-06-03', 1),
(20, 'Bitch', 'Ivo', 'Yeah hi is dick', 'ivo zase premiestnil footer a mam tam error', '2017-05-25', '2017-05-29', 1),
(21, 'EN title both', 'SK titulok oboje', 'EN content both', 'SK content oboje', '2017-05-26', '2017-06-04', 1),
(22, 'EN title both', 'SK titulok oboje', 'EN content both', 'SK content oboje', '2017-05-26', '2017-06-04', 1),
(23, 'EN title both', 'SK titulok oboje', 'EN content both', 'SK content oboje', '2017-05-26', '2017-06-04', 1),
(24, 'tp1718a en title', 'tp1718a sk title', 'tp1718a en content', 'tp1718a sk content', '2017-05-26', '2017-06-04', 1),
(25, 'en tp1718a tp1718a title', 'sk tp1718a tp1718a title', 'en tp1718a tp1718a content', 'sk tp1718a tp1718a content', '2017-05-26', '2017-06-04', 1),
(26, 'gjdgjdtjdt', 'srjsjdj', 'jdgjdtjdtyjdtyj', 'dyjdyjdjd', '2017-05-26', '2017-06-04', 1),
(27, 'prop', 'prop', 'prop', 'prop', '2017-05-26', '2017-06-04', 1),
(28, 'tututyutyu', 'tyutyutyuty', 'tyututyu', 'utyututyu', '2017-05-26', '2017-06-04', 3),
(29, 'tututyutyu', 'tyutyutyuty', 'tyututyu', 'utyututyu', '2017-05-26', '2017-06-04', 0),
(30, 'tututyutyu', 'tyutyutyuty', 'tyututyu', 'utyututyu', '2017-05-26', '2017-06-04', 0),
(31, 'ghfhfghfgh', 'fghfghfgh', 'fghfghfghfgh', 'fhfghfghf', '2017-05-26', '2017-06-04', 2),
(32, 'News', 'Aktualita sk', 'en en en ', 'sk sk sk sk ', '2017-05-29', '2017-05-31', 0),
(33, 'test en', 'test sk', 'text en', 'text sk', '2017-05-29', '2017-05-31', 1),
(34, 'News test', 'Dalsia skuska noviniek', 'dôlkjsfdklsj ', 'aaaaaaaaaaaa', '2017-05-29', '2017-06-01', 2),
(35, '', 'Toto by sa nemalo stat', '', 'iba sk', '2017-05-29', '2017-06-02', 2),
(36, '', 'Toto by sa nemalo stat', '', 'iba sk', '2017-05-29', '2017-06-02', 2),
(37, '', 'Pridavam aktualitu aj ked som odhlaseny', '', 'a nikto mi v tom nezabrani, ', '2017-05-29', '2017-06-03', 2);

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
-- Štruktúra tabuľky pre tabuľku `photo_gallery`
--

CREATE TABLE `photo_gallery` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `title_SK` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `title_EN` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `folder` varchar(50) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `photo` varchar(30) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `photo_gallery`
--

INSERT INTO `photo_gallery` (`id`, `date`, `title_SK`, `title_EN`, `folder`, `photo`) VALUES
(1, '2017-02-07', 'Deň otvorených dverí na ÚAMT FEI STU', 'Open day at UAMT FEI STU', 'event001', '_MG_5627.JPG'),
(3, '2017-02-07', 'Deň otvorených dverí na ÚAMT FEI STU', 'Open day at UAMT FEI STU', 'event001', '_MG_5635.JPG'),
(4, '2017-02-07', 'Deň otvorených dverí na ÚAMT FEI STU', 'Open day at UAMT FEI STU', 'event001', '_MG_5728.JPG'),
(5, '2017-02-07', 'Deň otvorených dverí na ÚAMT FEI STU', 'Open day at UAMT FEI STU', 'event001', 'DSCN8589.JPG'),
(6, '2017-02-07', 'Deň otvorených dverí na ÚAMT FEI STU', 'Open day at UAMT FEI STU', 'event001', '_MG_5688.JPG'),
(7, '2017-02-07', 'Deň otvorených dverí na ÚAMT FEI STU', 'Open day at UAMT FEI STU', 'event001', '_MG_5674.JPG'),
(8, '2015-09-25', 'Noc výskumníkov', 'Night of researchers', 'event002', '2015-09-25-6460.jpg'),
(9, '2015-09-25', 'Noc výskumníkov', 'Night of researchers', 'event002', '2015-09-25-6465.jpg'),
(10, '2015-09-25', 'Noc výskumníkov', 'Night of researchers', 'event002', '2015-09-25-6470.jpg'),
(11, '2015-09-25', 'Noc výskumníkov', 'Night of researchers', 'event002', '2015-09-25-6471.jpg'),
(12, '2015-09-25', 'Noc výskumníkov', 'Night of researchers', 'event002', '2015-09-25-6476.jpg'),
(13, '2015-09-25', 'Noc výskumníkov', 'Night of researchers', 'event002', '2015-09-25-6477.jpg'),
(14, '2015-09-25', 'Noc výskumníkov', 'Night of researchers', 'event002', '2015-09-25-6483.jpg'),
(15, '2015-09-25', 'Noc výskumníkov', 'Night of researchers', 'event002', '2015-09-25-6535.jpg'),
(16, '2015-09-25', 'Noc výskumníkov', 'Night of researchers', 'event002', '2015-09-25-6557.jpg'),
(17, '2015-09-25', 'Noc výskumníkov', 'Night of researchers', 'event002', '2015-09-25-6568.jpg'),
(18, '2015-09-25', 'Noc výskumníkov', 'Night of researchers', 'event002', '13 Meranie 01_0.JPG');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
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
  `annotationEN` varchar(5000) COLLATE utf8_slovak_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `project`
--

INSERT INTO `project` (`id`, `projectType`, `number`, `titleSK`, `titleEN`, `duration`, `coordinator`, `partners`, `web`, `internalCode`, `annotationSK`, `annotationEN`) VALUES
(1, 'VEGA', '1/0937/14 ', 'Pokročilé metódy nelineárneho modelovania a riadenia mechatronických systémov \r\n', 'Advanced methods for nonlinear modeling and control of mechatronic systems \r\n', '2014-2017', 'prof. Ing. Mikuláš Huba, PhD. ', '', NULL, '1425', 'Projekt sa zameriava na rozvoj metód nelineárneho riadenia a ich aplikácií. Zahrňuje metódy algebrického a diferenciálneho prístupu k návrhu nelineárnych systémov, riadenie časovo oneskorených (time delayed) systémov a systémov s obmedzeniami uvažovaných ako súčasť hybridných, autonómnych a inteligentných systémov, metódy simulácie, modelovania a automatizovaného návrhu s využitím podporných numerických a symbolických metód a programov. Venuje sa formulácii riešených problémov v rámci vnorených (embedded) systémov a PLC, spracovaniu signálov, zohľadneniu aspektov riadenia cez Internet, mobilné a rádiové siete, identifikácii a kompenzácii nelinearít, integrácii jednotlivých prístupov pri implementácii a fyzickej realizácii konkrétnych algoritmov a štruktúr riadenia. Pôjde najmä o riadenie mechatronických, robotických a ďalších systémov s dominantnými nelinearitami.', 'The project focuses on development of nonlinear control methods and their applications. It includes algebraic and differential approach to nonlinear control, control of time-delayed and constrained systems considered as a part of hybrid autonomous intelligent systems, simulations modeling and automatized design based on numeric and symbolic computer aided methods. It is dealing with formulation of solved problems within the embedded systems and PLCs, with signal processing, control via Internet, mobile and radio networks, with identification and compensation of nonlinearities, integration of particular approaches in implementing and physically accomplishing particular algorithms and structures. Thereby, one considers especially mechatronic and robotic systems and other systems with dominating nonlinear behavior.'),
(2, 'VEGA', '1/0228/14', 'Modelovanie termohydraulických a napätostných pomerov vo vybraných komponentoch tlakovodných jadrových reaktorov ', 'Modelling of thermohydraulic and stress conditions in selected components of NPP with pressurized water reactor ', '2014-2016', 'doc. Ing. Vladimír Kutiš, PhD. ', '', '', '1435', 'Cieľom predkladaného projektu je tvorba matematických modelov vybraných komponentov jadrových zariadení tlakovodného jadrového reaktora ako sú palivová kazeta, aktívna zóna ako aj celý jadrový reaktor. Tieto komponenty budú analyzované z pohľadu termohydrauliky ako aj z pohľadu mechanického (napätostného) namáhania. Takto získané numerické výsledky budú konfrontované s dostupnými experimentálnymi údajmi daných zariadení, pričom cieľom má byť zvyšovanie bezpečnosti prevádzky týchto zariadení. Pri tvorbe jednotlivých matematických modelov budú použité moderné numerické metódy, ako sú Computational Fluid Dynamics (CFD) a Metóda Konečných Prvkov (MKP), ktoré sú implementované v programoch ANSYS CFX a ANSYS Multiphysics. Súčasťou predkladaného projektu bude realizácia prepojenia matematických modelov termohydrauliky a mechanického namáhania, ktoré bude realizované tak, aby jednotlivé fyzikálne domény boli priamo previazané. Výstupom projektu okrem matematických modelov budú aj vedecké a odborné články a príspevky.', 'The aim of this project is to create mathematical models of selected components of nuclear power plants like fuel assembly, the active zone as well as a nuclear reactor itself considering pressurized water reactor. These components will be analyzed in terms of thermo-hydraulics and mechanical point of view (stress loading). Obtained numerical results will be confronted with available experimental data to increase operational safety of these devices. In the process of developing the mathematical models modern numerical methods such as Computational Fluid Dynamics (CFD) and Finite Element Method (FEM) will be used. These methods are implemented in programs ANSYS CFX and ANSYS Multiphysics. The proposed project will interconnect the thermo-hydraulic and mechanical mathematical models, which will be implemented so that the individual physical domains were directly connected. The outcome of the project will be the mathematical models and also scientific and technical papers and conference contributions.'),
(3, 'VEGA', '1/0453/15', 'Výskum stiesneného krútenia uzatvorených prierezov ', 'Research of nonuniform torsion of cross-sections ', '2015-2017 ', 'prof. Ing. Justín Murín, DrSc. ', NULL, NULL, '1479', '\"Podstatou projektu je skúmanie účinkov stiesneného krútenia v nosníkoch s uzatvoreným tenkostenným prierezom numerickými metódami ako aj experimentálnym meraním na fyzikálnych modeloch. Bude vytvorený nový 3D nosníkový konečný prvok so zahrnutím stiesneného krútenia uzatvorených prierezov, kde sa uplatní deformačný účinok sekundárneho krútiaceho momentu. Matica tuhosti a hmotnosti bude zostavená pre homogénny materiál ako aj pre kompozitné nosníky s pozdĺžnou premenlivosťou materiálových vlastností.\r\nOdvodené vzťahy a rovnice budú implementované do počítačového programu pre elastostatickú a modálnu analýzu s uvažovaním stiesneného krútenia. Bude navrhnuté a vyrobené meracie zariadenie, ktorým sa budú verifikovať výsledky teoretických výpočtov novým konečným prvkom. Predpokladá sa, že výsledky riešenia projektu prispejú ku zmene tvrdenia normy EC 3, podľa ktorej vplyv stiesneného krútenia možno pri nosníkoch uzatvoreného prierezu zanedbať. Výsledky nášho výskumu majú za cieľ zvýšiť bezpečnosť projektovania mechanických sústav.\"\r\n', 'The project aim is to examine the effects of non-uniform torsion in thin-walled beams with closed cross-section by numerical methods and experimental measurements on physical models. A 3D beam finite element will be created including the non-uniform torsion with the secondary torsion moment deformation effect. The stiffness and mass matrix will be prepared for a homogeneous material as well as for composite beams with longitudinal variation of material properties. Derived relations and equations will be implemented in the computer programs for elastic-static and modal analyses. Measurement equipment will be designed, by which the results of theoretical calculations by the new finite elements will be verified. It is expected that the results of the project will contribute to review the arguments of the Eurocode 3, according to which the effect of non-uniform torsion can be neglected in the closed cross-section beams. The results of the project are intended to enhance the safety of the beam structures design.\r\n'),
(4, 'KEGA\r\n', '035STU-4/2014', 'Návrh virtuálneho laboratória pre implementáciu pokrocilých metodík výucby v novom študijnom programe Elektromobilita \r\n', 'Development of virtual laboratory for implementation of advanced methods of teaching in the new study program Electromobility \r\n', '2014-2016', 'prof. Ing. Viktor Ferencey, PhD. \r\n', '1709', '', NULL, '\"Projekt je zameraný na vybudovanie moderného špecializovaného virtuálneho laboratória pre pripravovaný študijný program Elektromobilita. V projekte sú navrhnuté pokročilé metódy výučby, ktoré integrujú tvorivú implementáciu teoretických poznatkov priamo do virtuálneho modelovania a simulovania mechatronických systémov v inteligentných vozidlách s elektrickým pohonom, t.j. elektromobiloch.\r\nPre podporu špecializovaného vzdelávania a novú metodológiu v študijnom programe Elektromobilita bude v projekte spracovaná nová moderná študijná literatúra a vybudované Špecializované virtuálne laboratórium s inovatívnym vybavením pre teoretickú i praktickú výučbu predmetov v tomto študijnom programe. Všetky predmety programu Elektromobilita sú zamerané na virtuálne prototypovanie smart mechatronických systémov používaných v elektromobiloch s náväznosťou na nové systémy pohonu dopravných prostriedkov s využitím virtuálneho prototypovania.\r\nSúčasťou projektu bude spracovanie študijných materiálov, vedeckých monografií, tvorba inovatívnej web stránky, publikovanie v odborných časopisoch a účasť na vedeckých konferenciách. Špecializované virtuálne laboratórium bude vybavené mechatronickými učebnými modulmi pre výučbu a štúdium sofistikovaných technológií.\"\r\n', 'The project aim it to build a modern specialized virtual laboratory for prepared study program Electromobility. In this project, advanced teaching methods are proposed that integrate theoretical knowledge into practical application directly into mechatronic systems in vehicles with electric drive (electric vehicles). To promote specialized training and a new methodology in the study program Electromobility, the project will support processing of a new modern study literature and creating a dedicated virtual laboratory with innovative facilities for theoretical and practical training courses in this program of study. These courses aim at smart mechatronic systems used in electromobility systems with links to the new drive systems of vehicles using virtual prototyping. The project includes new study materials processing, writing scientific monographs, creating innovative websites, publications in peer-reviewed journals and participation in scientific conferences. Dedicated virtual laboratory will be equipped with educational mechatronic modules for teaching and learning sophisticated technology.\r\n'),
(5, 'KEGA', '032STU-4/2013', 'Online laboratórium pre výucbu predmetov automatického riadenia \r\n', 'Online laboratory for teaching automation control subjects \r\n', '1.1.2013-31.12.2015', 'doc. Ing. Katarína Žáková, PhD. ', '', NULL, '1719', '\"Projekt sa zameriava na tvorbu interaktívnych znovupoužiteľných vzdelávacích objektov pre zvolené segmenty teórie automatického riadenia, na budovanie širšej škály experimentov ilustrujúcich aplikáciu študovaných teoretických prístupov na riešenie praktických problémov, ktoré umožňujú a podporujú nadobúdanie vedomostí, zručností, návykov a postojov v kvázi-autentickom prostredí.\r\nProjekt má za cieľ podporovať využitie nielen proprietárnych, ale aj open technológií, ktoré prinášajú viaceré výhody v oblasti šírenia výsledkov a nesporne aj po finančnej stránke. Snahou je uľahčiť prístup k laboratórnym experimentom v rámci rôznych foriem vzdelávania (denných, dištančných, resp. elektronických foriem).\"\r\n', '\"The project is focussed on development of interactive reusable learning objects for chosen segments of automatic control, on building broader spectrum of experiments illustrating application of studied\r\ntheoretical approaches onto practical problems enabling and supporting acquisition of knowledge, skills, habits and attitudes in an quasi-authentic environment.\r\nThe project is going to support the use of not only proprietary but also open technologies that bring various advantages in the area of results dissemination and from the financial point of view as well. Our aim is to facilitate approach to laboratory experiments for students in daily or distance form of education.\"\r\n'),
(6, 'KEGA', '030STU-4/2015', 'Multimediálna podpora vzdelávania v mechatronike ', 'Multimedial education in mechatronics ', '2015-2017', 'doc. Ing. Danica Rosinová, PhD. ', NULL, 'http://uamt.fei.stuba.sk/KEGA_MM/', '1723', 'Svetovým trendom v oblasti modernej a bezbariérovej výučby sú jej interaktívne formy na báze internetu, videa, audiovizuálnych pomôcok a vzdialených laboratórií (on-line vzdelávanie), ktoré sa uplatňujú nielen v dištančnom vzdelávaní, ale aj v prezenčnej forme vzdelávanie s podporou nových technológií (technology augmented classroom teaching). Popri slide-show prezentáciách a edukačných miniaplikáciách (dynamické web stránky, flash animácie, Java Applets a pod.) preferujú svetové výskumné univerzity vývoj a tvorbu edukačných videí, ktorých cieľovou skupinou sú poslucháči konkrétneho predmetu (kurzu). Edukačné videá sú voľne dostupné a umožňujú študentom sledovať výklad danej problematiky kdekoľvek a kedykoľvek. Návrh a realizácia zrozumiteľného a zaujímavo podaného edukačného videa z technickej oblasti je komplexná úloha, ktorá si vyžaduje synergiu odborných, pedagogických a umeleckých kvalít jeho tvorcov. Projekt je zameraný na multimediálnu podporu vzdelávania v oblasti mechatroniky, s dôrazom na poznatky z aplikovanej informatiky, automatizácie a príbuzných vedných disciplín. Cieľom projektu je vybudovanie multimediálneho laboratória na tvorbu kvalitných edukačných videomateriálov pre prezenčnú aj dištančnú formu univerzitného vzdelávania v oblasti mechatroniky a vytvorenie a otestovanie viacerých modulov takýchto materiálov. Výstupy projektu budú ďalej využiteľné pre účely vzdelávania odborníkov z praxe vrámci celoživotného vzdelávania, a tiež popularizácie mechatroniky a automatizácie u širokej verejnosti a žiakov stredných škôl - potenciálnych študentov vysokých škôl technického zamerania.', '\"Presently, interactive education forms based on exploitation of Internet, video, audiovisual aids and remote laboratories (on-line education) are world trends in modern and barrier-free education;\r\nit is applied not only in distance education but in the attendance teaching as technology augmented classroom teaching. Along with slide-shows and educational miniapplications (dynamic websites,\r\nflash animations, Java Applets etc.) research universities usually prefer to develop their own education videos targeted to the audience in a single course. Education videos are freely available and enable the students to follow the explanatory discourse on the subject topic anytime and anywhere. Design and realization of a comprehensible and interesting educational video on a technological field is a quite complex task requiring synergy of technical, educational and artistic qualities of its creators. The project deals with the multimedia support of education in mechatronics engineering, with the focus on applied informatics, automation and related fields. The objective of the project is to build a multimedia laboratory for creating high-quality educational videomaterial for both distance and attendance education in mechatronics engineering. Project outcomes will be further employed in life-long education of practitioners, and for popularization of mechatronics and automation among the public and potential university students of technology.\"'),
(7, 'KEGA', '011STU-4/2015 ', 'Elektronické pedagogicko-experimentálne laboratóriá mechatroniky \r\n', 'Electronic educational-experimental laboratories of Mechatronics \r\n', '2015-2017', 'doc. Ing. Peter Drahoš, PhD. \r\n', NULL, 'http://uamt.fei.stuba.sk/kega/\r\n', '1724', '\"Projekt sa zaoberá vytvorením modernej vedomostnej a experimentálnej základne pre výučbu mechatroniky s dôrazom na jej elektronické súčasti. Vzhľadom na to, že mechatronika integruje viaceré oblasti poznania a ich spojením vytvára synergický efekt, budú v rámci projektu budú vypracované nové metódy a formy vo výučbe, ktoré študentom umožnia získať nové poznatky s praktickou skúsenosťou s využívaním moderných elektronických prvkov a systémov, ktoré tvoria neoddeliteľnú súčasť komplexných mechatronických systémov v oblasti výrobkov spotrebnej elektroniky, energetiky, automobilovej techniky a v zdravotníctve.\r\nPodnetnou výzvou pre podanie projektu bol vznik nových študijných programoch\"\"\"\"Automobilová mechatronika\"\"\"\" (Bc. program) a \"\"\"\"Aplikovaná mechatronika a elektromobilita\"\"\"\" (Ing. program). Pre tieto študijné programy budú vytvorené elektronické učebné texty pre 7 predmetov.\r\nZa účelom ďalšieho zvyšovania kvality výučby a výskumu sa plánuje v rámci v rámci riešenia projektu vytvoriť 5 nových experimentálnych pracovísk podľa najnovších trendov v elektronike, snímacej technike a riadiacich systémoch, ktoré budú mať viacúčelové využitie v priamej pedagogike, v individuálnych a tímových študentských projektoch ako aj pri výskumnej a vývojovej činnosti ústavu.\r\nCieľom projektu je zvýšiť odborné kompetencie študentov, učiteľov a výskumných pracovníkov a všetkých zúčastnených v týchto oblastiach: moderné senzory a MEMS, aktuátory na báze smart materiálov, elektrické trakčné pohony, mikroradiče a DSP pre vstavané riadiace systémy a spracovanie signálov, návrh riadiacich algoritmov a ich programovanie, elektronika a integrované obvody (ASICs) pre mechatroniku. Ďalším dôležitým sub-cieľom riešenej problematiky je získať široké kompetencie v komunikačných systémoch pre rôzne aplikačné oblasti mechatronických systémov najmä v automobilovom priemysle.\r\nNavrhovaný projekt bude podporovaný prostredníctvom moderných audiovizuálnych systémov, prostredníctvom web stránky a videí s multimediálnym spracovaním.\"\r\n', 'The project deals with the creation of modern knowledge and experimental basis for education in Mechatronics Engineering with the emphasis on electronic components. Due to the fact that mechatronics integrates several fields of knowledge and their junction yields a synergy effect, new methods and forms of eduation will be elaborated within the project allowing students to acquire new knowledge combined with practical experience in using modern electronic components and systems; such systems are integral parts of complex pervasive mechatronic systems (in consumer electronics, energy and automotive industries, healthcare). Inspiration for elaboration of the proposed project was launching of new study programs \"\"Automotive Mechatronics\"\" (Bachelor degree), and \"\"Applied Mechatronics and Electromobility\"\" (Master degree). For these study programs electronic textbooks for 7 subjects will be created. To further increase quality of education and research, 5 new experimental workplaces are planned to be created within the project to according to the latest development trends electronics, sensing technology and control systems having multi-purpose exploitation in direct teaching, individual and team projects as well as in research and development activities of the Institute. The objective of the project is to increase professional competences of students, teachers and researchers, and all involved in the areas: advanced sensors and MEMS, smart materials based actuators, electric traction motors, microcontrollers and digital signal processors (DSP´s) for embedded control systems and signal processing, design of control algorithms and their programming, electronics and integrated circuits (ASICs) for mechatronics. Another important sub-objective is to acquire wide competences in communication systems for various application areas of mechatronic systems, in particular in automotive industry. Modern audiovisual systems, web pages and multimedia processed videos will be widely used to support project results.\r\n'),
(8, 'APVV', 'APVV-0246-12 ', 'Pokročilé metódy modelovania a simulácie SMART mechatronických systémov \r\n', 'Advanced Methods and Simulations of SMART Mechatronic Systems \r\n', '1.10.2013-30.9.2016', 'prof. Ing. Justín Murín, DrSc. \r\n', NULL, NULL, 'AK14', 'V prvej fáze riešenia projektu bude kladený dôraz na materiálové, technické a prístrojové zabezpečenie experimentálnych častí, ktoré budú v projekte riešené. V tejto fáze takisto budú odvodené MKP rovnice pre 3D-FGM nosníky ako aj multifyzikálne modely pre SMA. Súčasťou prvej fázy riešenia projektu bude taktiež začatá príprava fyzikálnych experimentov za účelom verifikácie matematických modelov FGM a SMA systémov. V nasledovnom období riešenia projektu bude vykonaná verifikácia matematických modelov na vybraných experimentálnych vzorkách, ktoré boli dôsledne experimentálne analyzované z hľadiska materiálového zloženia. Výsledky experimentálnych meraní na SMA aktuátore budú využité v nasledovnom období riešenia projektu pri návrhu a realizácii alternatívneho spôsobu uchytenia SMA aktuátora. Bude nasledovať vytvorenie nelineárneho modelu aktuátora SMA a návrhu nových metód syntézy zameraných na riadenie polohy a potlačenie dominantných porúch. V tomto období budú súčasne prebiehať výskumné práce na teoretickom odvodení MKP rovníc pre FGM škrupinu a jej spojenia s 3D-FGM nosníkovým prvkom do kombinovaného nosníkovo-škrupinového MEMSu. V záverečnej fáze projektu bude kladený dôraz jednak na verifikáciu odvodených MKP rovníc pre nosníkovo-škrupinový MEMS pomocou fyzikálneho experimentu ako aj na riadenie SMA aktuátora konvenčnými a inteligentnými metódami riadenia.\r\n', 'In the first phase, attention will be given to the material, technical and equipment set-up required for the first set experiments. At the same time, the FGM-beam FEM equations will be derived and SMA models designed. In addition, the first sets of experiments will be used for the verification of numerical models of 3D-FGM and SMA systems. A complex verification of numerical models will take place on selected samples whose chemistry has been consistently analyzed. Results of SMA actuator measurements will be used in the consecutive stages of the project in the design and application of alternative anchoring for SMA actuators. Next the nonlinear model of SMA actuator and new methods of synthesis focused on position control and error elimination will be proposed. This research will take place in parallel with the theoretical analysis and FEM equations derivation of FGM shells. In the tp1718a stage, emphasis will be given to both the verification of the derived FGM beam-shell equations by real sample measurements and the control of the SMA actuator by conventional and intelligent methods.\r\n'),
(9, 'APVV', 'APVV-0343-12 ', 'Počítačová podpora návrhu robustných nelineárnych regulátorov \r\n', 'Computer aided robust nonlinear control design \r\n', '1.10.2013-31.3.2017', 'prof. Ing. Mikuláš Huba, PhD. \r\n', NULL, NULL, 'AK29', 'Projekt sa zaoberá vypracovaním podporného počítačového systému na návrh robustných nelineárnych regulátorov s obmedzeniami vo verzii pre Matlab/Simulink a web a vytvorením integrovaného elektronického prostredia v LMS Moodle, ktoré ho spája s webovou stránkou projektu, s elearningovými modulmi a s prístupom k vzdialeným experimentom umožňujúcim jeho overenie online. Systém je založený na novej metóde návrhu regulátorov vychádzajúcej s obmedzovania odchýlok od požadovaných tvarov vstupných a výstupných, resp. stavových veličín. Táto integruje výsledky viacerých doteraz izolovaných prístupov k návrhu regulátorov - tradičnú teóriu PID regulátorov, moderný stavový prístup s teóriou pozorovateľov, časovo optimálne riadenie, nelineárne systémy a riadenie systémov s veľkým dopravným oneskorením a robustný návrh regulátorov. Vyvíjaný systém bude vhodný pre širokú triedu neurčitých a nelineárnych objektov, ktoré predstavujú väčšinu bežných aplikácií v praxi. Systém bude pozostávať z centrálnej pracovnej stanice umožňujúcej dostatočne rýchle generovanie tzv. portrétu správania riadeného objektu s uvažovaným typom regulátora, z úložiska vytvorených portrétov správania a z grafických staníc, ktoré umožnia na základe špecifikácie neurčitých parametrov riadeného objektu a zadaných kvalitatívnych požiadaviek na riadené procesy určiť optimálne nastavenie regulátora zaručujúce pre zadané požiadavky dosiahnutie najvyššej možnej dynamiky prechodových dejov aj pri zohľadnení neurčitostí.\r\n', 'The project deals with development and introduction into practice of the computer aided system for design of robust constrained nonlinear control (in versions for Matlab/Simulink and web) and of the integrated electronic environment in LMS Moodle interconnecting the system with the project web page, with the elearning modules and with access to remote experiments enabling its online verification. The system will be based on a new robust control method based on constraining deviations from required shapes of the input, output, or state variables. This is holistically integrating several up to now isolated control design approaches - the traditional PID control, modern state & disturbance observer approach, minimum time control, nonlinear control, control of systems with long dead time and robust control. The developed system is intended for a broad class of uncertain and nonlinear plants that represent a majority of all applications in practice. The system will consist of a central work station enabling a sufficiently fast generation of the so called performance portrait of given plant with a considered type of control, from a repository of generated performance portraits and from graphical terminals enabling by means of specifying parameters of given plant and the required shape-related performance measures to determine the optimal controller tuning guaranteeing the fastest possible transients responses in the control loop under consideration of the given uncertainties.\r\n'),
(10, 'APVV', 'APVV-0772-12 ', 'Moderné metódy riadenia s využitím FPGA štruktúr \r\n', 'Advanced control methods based on FPGA structures \r\n', '1.10.2013-30.9.2017', 'doc. Ing. Alena Kozáková, PhD. \r\n', NULL, NULL, 'AK39', 'Projekt rieši aktuálne otázky výskumu a vývoja moderných metód riadenia s využitím hardvérových realizácií konvenčných (PID) ako aj moderných (optimálne, robustné, prediktívne) algoritmov riadenia pre procesy s rýchlou dynamikou. V súčasnosti dominujú vo výskume a implementácii moderných riadiacich systémov tieto smery: riešenia na báze mikroprocesorov (softvérový prístup), jednoúčelové riešenia ASIC a riešenia na báze programovateľných hradlových polí (Field Programmable Gate Arrays, FPGA), ktoré predstavujú konfigurovateľné obvody vysokého stupňa integrácie (VLSI) schopné integrovať rôzne logické a riadiace funkcie. Hardvérové implementácie algoritmov riadenia sú v porovnaní so softvérovými realizáciami vo všeobecnosti o niekoľko rádov rýchlejšie, pretože spracovanie v nich prebieha paralelne, navyše sú kompaktnejšie a vo všeobecnosti lacnejšie. Hlavným cieľom projektu je výskum a vývoj algoritmov na báze FPGA štruktúr, ktorý bude skúmaný na vývojových FPGA systémoch a verifikovaný na fyzikálnych laboratórnych modeloch s rýchlou dynamikou.\r\n', 'The project deals with research and development of advanced control methods based on HW implementation of conventional (PID) as well as modern optimal, robust and predictive algorithms applicable in control of plants with fast dynamics. Predominating approaches in the research of modern control systems implementation are microprocessor-based solutions (software approach), ASIC (dedicated approach) and the FPGA based approach. Field Programmable Gate Arrays (FPGA) are configurable circuits of very-large-scale-integration (VLSI) able to integrate various logical and control functions. In general, HW implementations of control algorithms are faster by several orders compared with SW implementations due to parallel processing of information; moreover they are more compact and also less expensive. The main objective of the project is research and development of FPGA-based control algorithms. Their research and development will be studied on available FPGA development kits and verified on laboratory plants with fast dynamics.\r\n'),
(11, 'APVV', 'APVV-14-0613 ', 'Širokopásmový MEMS detektor terahertzového žiarenia \r\n', 'Broadband MEMS detector of terahertz radiaton \r\n', '2015 - 2018', 'doc. Ing. Vladimír Kutiš, PhD. \r\n', NULL, NULL, NULL, NULL, 'The project is aimed on research and development of new types of broadband detectors for terahertz frequency range. This new type of detector is designed in a concept of micro-electro-mechanical system and uses the bolometric sensing principle. The design construction of the detector consists of a microbolometric sensing device coupled to a broadband antenna. Thermal conversion of the incident THz radiation takes place on a thin polyimide membrane which enables (a) to achieve high thermal conversion efficiency and (b) to design detectors with balanced amplitude characteristics even at high frequency range. The proposed MEMS detector concept will be optimized by a sophisticated process of modeling and simulation in direct mutual iteration with experimental analysis of functionality and detection capability. The completion of the project will be given by the developed state-of-the-art methodology of characterization, broadband THz detection and simulation of the MEMS detector device applicable in the research and education.\r\n'),
(12, 'International', 'SK06-II-01-004', 'Podpora medzinárodnej mobility medzi STU Bratislava, NTNU Trondheim a Universität Liechtenstein \r\n', 'Support of international mobilites between STU Bratislava, NTNU Trondheim, and Universität Liechtenstein \r\n', '2.6.2015 - 30.9.2016', 'zodpovedný za ÚAMT - prof. Ing. Mikuláš Huba, PhD. \r\n', 'Norwegian University of Science and Technology Trondheim (prof. Skogestad, prof. Johansen, prof. Hovd)|Universität Liechtenstein, Liechtenstein (prof. Droege)\r\n', NULL, NULL, 'Projekt rieši aktuálne otázky výskumu a vývoja moderných metód riadenia s využitím hardvérových realizácií konvenčných (PID) ako aj moderných (optimálne, robustné, prediktívne) algoritmov riadenia pre procesy s rýchlou dynamikou. V súčasnosti dominujú vo výskume a implementácii moderných riadiacich systémov tieto smery: riešenia na báze mikroprocesorov (softvérový prístup), jednoúčelové riešenia ASIC a riešenia na báze programovateľných hradlových polí (Field Programmable Gate Arrays, FPGA), ktoré predstavujú konfigurovateľné obvody vysokého stupňa integrácie (VLSI) schopné integrovať rôzne logické a riadiace funkcie. Hardvérové implementácie algoritmov riadenia sú v porovnaní so softvérovými realizáciami vo všeobecnosti o niekoľko rádov rýchlejšie, pretože spracovanie v nich prebieha paralelne, navyše sú kompaktnejšie a vo všeobecnosti lacnejšie. Hlavným cieľom projektu je výskum a vývoj algoritmov na báze FPGA štruktúr, ktorý bude skúmaný na vývojových FPGA systémoch a verifikovaný na fyzikálnych laboratórnych modeloch s rýchlou dynamikou.\r\n', 'The aim of the project is to support international mobility of students, PhD students, and staff members of four participating faculties of STU in Bratislava with partners from NTNU Trondheim and Universität Liechtenstein. It will initiate academic cooperation between the University of Liechtenstein and STU Bratislava in construction, architecture, and space planning, focusing on the use of alternative energy sources in operation of buildings, including computer-aided simulations of energy needs and internal environment, and spatial planning of rural settlements as well. The project also contributes to further strengthening of already existing cooperation between NTNU Trondheim and faculties of STU in Bratislava in the field of advanced methods of automatic control and to progress of inter-faculty cooperation at STU in Bratislava.\r\n'),
(13, 'other', 'TB ', 'Softvérové riadenie smerovej dynamiky vozidla UGV 6x6 \r\n', 'Softvérové riadenie smerovej dynamiky vozidla UGV 6x6 \r\n', '2015', 'Ing. Martin Bugár, PhD. \r\n', NULL, NULL, '7506', NULL, NULL),
(14, 'other', 'VW ', 'Predlžovanie životnosti akumulátorového systému \r\n', 'Predlžovanie životnosti akumulátorového systému \r\n', '2015', 'Ing. Martin Bugár, PhD. \r\n', NULL, NULL, '7509', NULL, NULL),
(15, 'other', 'MV ', 'REST platforma pre online riadenie experimentov \r\n', 'REST Platform for Online Control of Experiments \r\n', '2015', 'Ing. Miroslav Gula \r\n', NULL, NULL, '1361', '\"Tento projekt je súčasťou rozsiahlejšieho cieľa o vytvorenie univerzálneho protokolu pre vzdialené riadenie reálnych sústav a tiež balíka softvérových nástrojov na jeho implementáciu. Hlavným cieľom celého úsilia je zjednodušiť a urýchliť budovanie modulárnych online laboratórií.\r\nÚlohami projektu sú návrh a vytvorenie nástroaj pre vzdialený prístup k softvéru Scilab, zavŕšenie implementácie podobného nástroja určeného pre softvérový balík Matlab/Simulink, a návrh a čiastočná implementácia mechatronického systému, ktorý bude v budúcnosti slúžiť na demonštráciu spomenutých nástrojov a následne ako učebná pomôcka.\"\r\n', 'The project is a part of an extensive endeavor to create universal protocol for remote control of real plants, and a suite of software tools to implement this protocol. The main objective of this whole endeavor is to simplify and accelerate implementation of modular online laboratories. Tasks of this project include design and implementation of a software tool for remote access to Scilab, completion of implementation of a similar tool for Matlab/Simulink, and design and partial implementation of a mechatronic system which will serve for demonstration of mentioned tools and later on as teaching aid.\r\n');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `staff`
--

CREATE TABLE `staff` (
  `id` int(4) NOT NULL,
  `name` varchar(50) COLLATE utf8_slovak_ci NOT NULL,
  `surname` varchar(60) COLLATE utf8_slovak_ci NOT NULL,
  `title1` varchar(20) COLLATE utf8_slovak_ci DEFAULT NULL,
  `title2` varchar(20) COLLATE utf8_slovak_ci DEFAULT NULL,
  `ldapLogin` varchar(30) COLLATE utf8_slovak_ci DEFAULT NULL,
  `photo` varchar(30) COLLATE utf8_slovak_ci DEFAULT NULL,
  `room` varchar(50) COLLATE utf8_slovak_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_slovak_ci DEFAULT NULL,
  `department` varchar(30) COLLATE utf8_slovak_ci NOT NULL,
  `staffRole` varchar(40) COLLATE utf8_slovak_ci NOT NULL,
  `function` varchar(120) COLLATE utf8_slovak_ci DEFAULT NULL,
  `role` varchar(10) COLLATE utf8_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `staff`
--

INSERT INTO `staff` (`id`, `name`, `surname`, `title1`, `title2`, `ldapLogin`, `photo`, `room`, `phone`, `department`, `staffRole`, `function`, `role`) VALUES
(1, 'Vladislav', 'Bača', 'Ing.', NULL, NULL, 'baca.jpg', 'T005', '264', 'OEMP', 'doktorand', NULL, '10000'),
(2, 'Peter', 'Balko', 'Ing.', NULL, NULL, NULL, 'D 102', '395', 'OIKR', 'doktorand', NULL, '10000'),
(3, 'Richard', 'Balogh', 'Ing.', ' PhD.', NULL, 'balogh.jpg', 'D110', '411', 'OEMP', 'teacher', 'zástupca vedúceho oddelenia', '10000'),
(4, 'Igor', 'Bélai', 'Ing.', ' PhD.', NULL, NULL, 'D 126', '478', 'OEMP', 'teacher', NULL, '10000'),
(5, 'Katarína', 'Beringerová', NULL, NULL, NULL, NULL, 'A 705', '672', 'AHU', 'teacher', NULL, '10000'),
(6, 'Pavol', 'Bisták', 'Ing.', ' PhD.', 'bistak', 'bistak.jpg', 'D 120', '695', 'OEAP', 'teacher', NULL, '10011'),
(7, 'Dmitrii', 'Borkin', 'Ing.', NULL, NULL, NULL, 'D 102', '395', 'OIKR', 'doktorand', NULL, '10000'),
(8, 'Martin', 'Bugár', 'Ing.', ' PhD.', NULL, NULL, 'A 708', '579', 'OEAP', 'teacher', NULL, '10000'),
(9, 'Ján', 'Cigánek', 'Ing.', ' PhD.', NULL, NULL, 'D 104', '686', 'OIKR', 'teacher', NULL, '10000'),
(10, 'Peter', 'Drahoš', 'doc. Ing.', ' PhD.', NULL, NULL, 'D 118', '669', 'OEMP', 'teacher', NULL, '10000'),
(11, 'František', 'Erdödy', NULL, NULL, NULL, 'erdody.jpg', 'A S39', '818', 'AHU', 'teacher', NULL, '10000'),
(12, 'Viktor', 'Ferencey', 'prof. Ing.', ' PhD.', NULL, 'ferencey.jpg', 'A 802', '438', 'OEAP', 'teacher', 'zástupca vedúceho oddelenia', '10000'),
(13, 'Peter', 'Fuchs', 'doc. Ing.', ' PhD.', NULL, NULL, 'B S05', '826', 'OEMP', 'researcher', NULL, '10000'),
(14, 'Gabriel', 'Gálik', 'Ing.', NULL, NULL, NULL, 'A 706', '559', 'OAMM', 'researcher', NULL, '11000'),
(15, 'Vladimír', 'Goga', 'doc. Ing.', ' PhD.', NULL, NULL, 'A 702', '687', 'OAMM', 'teacher', NULL, '10000'),
(16, 'Miroslav', 'Gula', 'Ing.', NULL, 'xgulam', 'gula.jpg', 'D 103', '628', 'OIKR', 'doktorand', NULL, '11001'),
(17, 'Oto', 'Haffner', 'Ing.', ' PhD.', NULL, 'haffner.jpg', 'D 125', '315', 'OIKR ', 'teacher', NULL, '10010'),
(18, 'Juraj', 'Hrabovský', 'Ing.', ' PhD.', NULL, NULL, 'A 706', '559', 'OAMM', 'teacher', NULL, '10000'),
(19, 'Mikuláš', 'Huba', 'prof. Ing.', ' PhD.', NULL, 'huba.jpg', 'D 112', '771', 'OEAP', 'teacher', 'riaditeľ ústavu; vedúci oddelenia', '10000'),
(20, 'Mária', 'Hypiusová', 'Ing.', ' PhD.', NULL, NULL, 'D 122', '193', 'OIKR', 'teacher', NULL, '10000'),
(21, 'Štefan', 'Chamraz', 'Ing.', ' PhD.', NULL, NULL, 'D 107', '848', 'OEMP', 'teacher', NULL, '10000'),
(22, 'Jakub', 'Jakubec', 'Ing.', ' PhD.', NULL, NULL, 'A 707', '452', 'OAMM ', 'researcher', NULL, '10000'),
(23, 'Igor', 'Jakubička', 'Ing.', NULL, NULL, 'jakubicka.jpg', 'T005', '264', 'OEMP', 'doktorand', NULL, '10000'),
(24, 'Katarína', 'Kermietová', NULL, NULL, NULL, NULL, 'D 116', '598', 'AHU', 'teacher', 'zástupca vedúceho oddelenia', '10000'),
(25, 'Ivan', 'Klimo', 'Ing.', NULL, NULL, NULL, 'D 101', '509', 'OEMP', 'doktorand', NULL, '10000'),
(26, 'Michal', 'Kocúr', 'Ing.', ' PhD.', 'xkocurm2', 'kocur.jpg', 'D 104', '686', 'OIKR ', 'teacher', NULL, '10000'),
(27, 'Štefan', 'Kozák', 'prof. Ing.', ' PhD.', NULL, 'kozak.jpg', 'D 115', '281', 'OEMP', 'teacher', 'zástupca riaditeľa ústavu pre rozvoj ústavu; vedúci oddelenia', '10000'),
(28, 'Alena', 'Kozáková', 'doc. Ing.', ' PhD.', NULL, NULL, 'D 111', '563', 'OIKR', 'teacher', NULL, '10000'),
(29, 'Erik', 'Kučera', 'Ing.', ' PhD.', NULL, NULL, 'D 125', '315', 'OIKR ', 'teacher', NULL, '11000'),
(30, 'Vladimír', 'Kutiš', 'doc. Ing.', ' PhD.', NULL, 'kutis.jpg', 'A 701', '562', 'OAMM ', 'teacher', 'zástupca vedúceho oddelenia', '10000'),
(31, 'Alek', 'Lichtman', 'Ing.', NULL, NULL, NULL, 'D 101', '509', 'OEMP', 'doktorand', NULL, '10000'),
(32, 'Justín', 'Murín', 'prof. Ing.', ' DrSc.', NULL, 'murin.jpg', 'A 704', '611', 'OAMM', 'teacher', 'zástupca riaditeľa ústavu pre vedeckú činnosť; vedúci oddelenia', '10000'),
(33, 'Jakub', 'Osuský', 'Ing.', ' PhD.', NULL, 'osusky.jpg', 'D 123', '356', 'OIKR ', 'teacher', NULL, '10000'),
(34, 'Tomáš', 'Paciga', 'Ing.', NULL, NULL, NULL, 'A 707', '452', 'OAMM', 'doktorand', NULL, '10000'),
(35, 'Juraj', 'Paulech', 'Ing.', ' PhD.', NULL, 'paulech.jpg', 'A 701', '562', 'OAMM', 'teacher', NULL, '10100'),
(36, 'Matej', 'Rábek', 'Ing.', NULL, 'xrabek', 'rabek.jpg', 'D 103', '628', 'OIKR', 'doktorand', NULL, '11001'),
(37, 'Tibor', 'Sedlár', 'Ing. ', NULL, NULL, NULL, 'A 803', '399', 'OAMM', 'teacher', NULL, '10000'),
(38, 'Erich', 'Stark', 'Ing.', NULL, NULL, 'stark.jpg', 'C 014', '', 'OIKR', 'doktorand', NULL, '10000'),
(39, 'Peter', 'Ťapák', 'Ing.', ' PhD.', NULL, NULL, 'D 121', '569', 'OEAP', 'teacher', NULL, '10000'),
(40, 'Katarína', 'Žáková', 'doc. Ing.', ' PhD.', 'zakova', 'zakova.jpg', 'D 119', '742', 'OIKR', 'teacher', 'zástupca riaditeľa ústavu pre pedagogickú činnosť; zástupca vedúceho oddelenia', '10001'),
(41, 'Danica', 'Rosinová', 'doc. Ing.', ' PhD.', NULL, 'rosinova.jpg', 'D 111', '563', 'OIKR', 'teacher', 'vedúci oddelenia\r\n', '10000'),
(42, 'Admin', 'Admin', NULL, NULL, 'xdzacovsky', NULL, '', NULL, '', '', NULL, '10001');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `typ_nepritomnosti`
--

CREATE TABLE `typ_nepritomnosti` (
  `id` int(11) NOT NULL,
  `nazov` varchar(80) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `skratka` varchar(10) NOT NULL,
  `farba` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `typ_nepritomnosti`
--

INSERT INTO `typ_nepritomnosti` (`id`, `nazov`, `skratka`, `farba`) VALUES
(1, 'pracovná neschopnosť', 'PN', '#ffb861'),
(2, 'dovolenka', 'D', '#00cdcd'),
(3, 'plánovaná dovolenka', 'PD', '#cd0000'),
(4, 'návšteva lekára', 'NL', '#c6fd06'),
(5, 'práca z domu', 'HO', '#70a78f');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `url`
--

CREATE TABLE `url` (
  `id` int(11) NOT NULL,
  `page` varchar(10) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `category` varchar(255) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sťahujem dáta pre tabuľku `url`
--

INSERT INTO `url` (`id`, `page`, `category`, `url`) VALUES
(8, 'pedagogika', 'George', 'http://147.175.98.125/tp1718aMy/pedagogika.php'),
(10, 'pedagogika', 'Bpoa', 'http://147.175.98.125/phpmyadmin/index.php?db=tp1718a&amp;table=nakupy&amp;target=sql.php&amp;token=2276c350aa94603a988c550a376f15aa'),
(12, 'pedagogika', 'ads', 'https://bootsnipp.com/snippets/featured/checkboxradio-css-only'),
(15, 'pedagogika', 'emily', 'https://is.stuba.sk/auth/posta/email.pl?eid=7191816;fid=552063;on=0');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `video_gallery`
--

CREATE TABLE `video_gallery` (
  `id` int(11) NOT NULL,
  `title_SK` varchar(100) COLLATE utf8_slovak_ci NOT NULL,
  `title_EN` varchar(100) COLLATE utf8_slovak_ci NOT NULL,
  `url` varchar(70) COLLATE utf8_slovak_ci NOT NULL,
  `type` varchar(20) COLLATE utf8_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `video_gallery`
--

INSERT INTO `video_gallery` (`id`, `title_SK`, `title_EN`, `url`, `type`) VALUES
(1, 'Vzdialené experimenty - podpora pre vzdelávanie', 'Remote experiments - support for education', 'https://www.youtube.com/watch?v=Z0zBwR_MKOI', 'Naše laboratóriá'),
(2, 'Multimédiá a telematika pre mobilné platformy - voliteľný predmet v inžinierskom štúdiu FEI STU', 'Multimedia and telematics for mobile platforms - elective eourse in the FEI STU engineering study', 'https://www.youtube.com/watch?v=NKZmJB0PW3k', 'Predmety'),
(3, 'Študuj mechatroniku a budeš úspešný!', 'Study mechatronics and you will be successful!', 'https://www.youtube.com/watch?v=vCYq4JspSCI', 'Propagačné videá'),
(4, 'Mechatronické kresliace rameno mScara - Makeblock mDrawBot kit ', 'mScara mechatronic drawing arm - Makeblock mDrawBot kit', 'https://www.youtube.com/watch?v=qmijnl8jwaw', 'Naše zariadenie'),
(5, 'Riadenie modelu výrobného systému cez PLC', 'Managing the production system model via the PLC', 'https://www.youtube.com/watch?v=ymqYxRYt5sY', 'Naše zariadenie'),
(6, 'Inžinierska informatika v mechatronike - Ing. ŠP Aplikovaná mechatronika a elektromobilita ', 'Engineering informatics in mechatronics - Engineering SP Applied mechatronics and electromobility', 'https://www.youtube.com/watch?v=CLwEjKN9ixg', 'Propagačné videá'),
(7, 'Ústav automobilovej mechatroniky FEI STU ', 'Department of automobile mechatronics FEI STU', 'https://www.youtube.com/watch?v=IiNXYgbOKxw', 'Propagačné videá'),
(8, 'videjo', 'videjo in ingliš', 'https://www.youtube.com/watch?v=57BJvTZK6Vc', 'Naše laboratóriá'),
(9, 'FPFA', 'FPGA', 'https://www.youtube.com/watch?v=xEkg96rcwsE', 'Predmety');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `nakupy`
--
ALTER TABLE `nakupy`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `nepritomnosti`
--
ALTER TABLE `nepritomnosti`
  ADD PRIMARY KEY (`id`);

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
-- Indexy pre tabuľku `photo_gallery`
--
ALTER TABLE `photo_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `typ_nepritomnosti`
--
ALTER TABLE `typ_nepritomnosti`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `url`
--
ALTER TABLE `url`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `video_gallery`
--
ALTER TABLE `video_gallery`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pre tabuľku `nakupy`
--
ALTER TABLE `nakupy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pre tabuľku `nepritomnosti`
--
ALTER TABLE `nepritomnosti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT pre tabuľku `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT pre tabuľku `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT pre tabuľku `photo_gallery`
--
ALTER TABLE `photo_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pre tabuľku `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT pre tabuľku `typ_nepritomnosti`
--
ALTER TABLE `typ_nepritomnosti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pre tabuľku `url`
--
ALTER TABLE `url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pre tabuľku `video_gallery`
--
ALTER TABLE `video_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
