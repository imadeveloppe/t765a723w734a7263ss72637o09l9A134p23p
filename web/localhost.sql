-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Client: localhost:3306
-- Généré le: Jeu 23 Mars 2017 à 18:51
-- Version du serveur: 5.6.34
-- Version de PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `tawassol_codeigniter`
--

-- --------------------------------------------------------

--
-- Structure de la table `centre`
--

CREATE TABLE IF NOT EXISTS `centre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_rep` int(11) NOT NULL,
  `code` varchar(11) NOT NULL,
  `niveau` varchar(10) NOT NULL,
  `nom` varchar(200) CHARACTER SET utf8 NOT NULL,
  `ville` int(11) NOT NULL,
  `photo` varchar(200) CHARACTER SET utf8 NOT NULL,
  `tel` varchar(100) NOT NULL,
  `adress` varchar(300) NOT NULL,
  `about` text CHARACTER SET utf8 NOT NULL,
  `state` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pwd` varchar(300) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Contenu de la table `centre`
--

INSERT INTO `centre` (`id`, `id_rep`, `code`, `niveau`, `nom`, `ville`, `photo`, `tel`, `adress`, `about`, `state`, `email`, `pwd`, `time`) VALUES
(1, 10, '66c510', '1:2:3', 'Etablissement scolaire Al Jisr', 12, 'Screenshot_2017-01-09-13-46-25-12.png', 'faiqprof@gmail.com', '34 Boulevard Zerktouni', '', 1, '555555', 'b7c40b9c66bc88d38a59e554c639d743e77f1b65', 1487102669),
(2, 7, 'bfca3c', '1:3', 'School Amine', 5, '', 'baribiamine@gmail.com', 'Benimellal', '', 0, '0655159236', 'f756fd7f412df88deeba8c9e99ad2e2acd9a4cba', 1487103564),
(3, 7, '376704', '1:2:3', 'AMINE_SCHOOL', 5, 'logoEcole.png', 'baribiamine@gmail.com', 'beni mellal', '', 0, '000000', 'c984aed014aec7623a54f0591da07a85fd4b762d', 1487111848),
(4, 8, 'a402ea', '1:2:3', 'Etablissement_Adnane', 17, '', 'adnanebaribi@gmail.com', 'bab doukala', '', 0, '0662-828750', '1d1cd53036c744c95e4a454df8c1f7afdb9b7e83', 1487195964),
(5, 10, 'c7153c', '1:2:3', 'Etablissement Al Wifaq', 12, 'Screenshot_2017-01-09-13-46-42-1.png', 'faiqprof@gmail.com', '43 Bd Hassan 2', '', 0, '222222', '273a0c7bd3c679ba9a6f5d99078e36e85d02b952', 1487892084),
(6, 10, '33e9e1', '1:2:3', 'Etablissement Assaada', 12, '195556-1.jpg', 'faiqprof@gmail.com', '64 Quartier Saada', '', 0, '1111', '011c945f30ce2cbafc452f39840f025693339c42', 1488388795),
(7, 10, '6c624d', '1:2', 'sdasdasdasd', 4, '', 'dafad@awds.asd', 'ffafafaf', '', 0, '0987654321', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 1488644701),
(8, 10, '293895', '1:2:3', 'Etablissement Annajah Annajah Annajah Primaire', 12, '195556-12.jpg', 'faiqprof@gmail.com', '65 yggt', '', 0, '0606060611', 'f4bba770186ada4740778cef20e9da625b763755', 1488674641),
(9, 10, 'a36e63', '1:2:3', 'Etablissement Scolaire Taoufiq', 12, '', 'faiqprof@gmail.com', '23 Lot Economique', '', 1, '0624525252', '48058e0c99bf7d689ce71c360699a14ce2f99774', 1488936130),
(10, 10, '1f169d', '1:2:3', 'Etablissement Naoufal', 12, 'Screenshot_2017-01-09-13-46-25-13.png', 'faiqprof@gmail.com', '23 Bd Hassan 2', '', 0, '0677777777', 'fba9f1c9ae2a8afe7815c9cdd492512622a66302', 1489093476),
(11, 10, 'a8a91b', '1:2:3', 'Etablissement Amina', 12, 'Penguins.jpg', 'Faiqprof@gmail.com', 'Hgg', '', 0, '1212121212', '48058e0c99bf7d689ce71c360699a14ce2f99774', 1489157020),
(12, 10, 'd4cda3', '1:2:3', 'Etablissement Aya', 12, '', 'Faiqprof@gmail.com', 'Uhg', '', 0, '1313131313', 'f4ee7415066b23ed0c5555e3a10aa76726a995d7', 1489157215),
(13, 10, 'd8d10b', '1:2:3', 'Etablissement Exemple', 12, 'ABC.jpg', 'faiqprof@gmail.com', '65 Bd Hassan 2', '', 1, '0524322424', 'dea742e166979027ae70b28e0a9006fb1010e760', 1489261209),
(14, 18, 'f62c1e', '1:2:3', 'Annajah', 2, 'images_(2).png', 'Annajah2017@gmail.com', '34 Boulevard Zerktouni', '', 1, '0524888888', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1489313731),
(15, 11, '6c43f8', '1', 'amal', 18, 'téléchargement.png', 'aitmouna.b@gmail.com', '15 av najah', '', 0, '0666572573', '43123609a3232648db1c47c03632fb9f5c25ac85', 1489313779),
(16, 16, '35d159', '1', 'GRPE SCOLAIRE ALAMAL', 3, '396342.png', 'hilalzinbi@gmail.com', 'OULFA BD ZITOUNE', '', 1, '0522485757', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1489313898),
(17, 13, 'f9fe50', '1:2', 'AL ILM WA ALIMANE', 19, '2016-08-19_at_09-35-28.png', 'aymane.douslimane@gmail.com', 'AMAL 5 MASSIRA', '', 1, '0537292936', '2ea6201a068c5fa0eea5d81a3863321a87f8d533', 1489350228),
(18, 11, '0d171d', '1:2:3', 'Ossama', 4, '20170312_141437.jpg', 'Saidbouy822@gmail.com', 'Rue hassan2 numero120', '', 1, '0670050567', '5827cf6a9159e741551d5fdf1a1a285e0ff144b5', 1489524437),
(19, 15, '066c35', '1:2', 'mouna', 18, '5.jpg', 'aitmouna.b@gmail.com', '45 moukawama', 'école de réussite et de performance ', 1, '0655555555', '43123609a3232648db1c47c03632fb9f5c25ac85', 1489660503),
(20, 19, '2f1467', '1:2:3', 'Groupe scolaire des cerises ', 5, 'cherry-illustration-228279821.jpg', 'baribiamine@gmail.com', '23 bd Med V', '', 1, '0524332211', '52036e5a96b401419e3b870bb3859828b111afd2', 1489689814),
(21, 10, 'bc95de', '1:2:3', 'Etablissement Annajah', 5, '', 'hdhdg@ggdgdg.com', '65 Bd Hassan 2', '', 0, '0524987987', '48bc7c17608e8c39ee9b42c5ab15f2094d1f02c7', 1489763299),
(22, 10, '5e2c23', '1:2:3', 'Etablissement La Tumipe', 4, '', 'latulipe@gmail.com', '89 Bd Hassan 2', '', 0, '0522345677', '48bc7c17608e8c39ee9b42c5ab15f2094d1f02c7', 1489763935),
(23, 10, '6d0b8c', '1:2', 'Etablissement Adnane', 12, 'Screenshot_2017-01-09-13-46-25-15.png', 'faiqprof@gmail.com', '54 gfgyh', '', 1, '0524111111', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 1489953125),
(24, 10, '9f8014', '1:2', 'Test Etablissement', 98, '', 'dafad@awds.asd', 'jgdh dgqjhwgdwjhd ', '', 0, '0987723456789', '88ea39439e74fa27c09a4fc0bc8ebe6d00978392', 1489958343),
(25, 10, 'bca161', '1:2', 'Test Etablissement', 98, '', 'dafad@awds.asd', 'jgdh dgqjhwgdwjhd ', '', 0, '0987723456789', '88ea39439e74fa27c09a4fc0bc8ebe6d00978392', 1489958413),
(26, 10, '683e54', '1:2', 'Test Etablissement', 98, '', 'dafad@awds.asd', 'jgdh dgqjhwgdwjhd ', '', 0, '0987723456789', '88ea39439e74fa27c09a4fc0bc8ebe6d00978392', 1489958476),
(27, 10, '593212', '1', 'Etablissement Annassr', 39, '', 'asdas@sfaf.ff', 'test', '', 0, '09878877876', '601f1889667efaebb33b8c12572835da3f027f78', 1489958700),
(28, 10, 'a9ae8d', '1', 'ttfwqetf qtwfetzqwef ', 48, '', 'te@re.ee', 'dfgzh', '', 0, '0987656777765', '601f1889667efaebb33b8c12572835da3f027f78', 1489958952),
(29, 13, '77dca6', '2:3', 'GS AHL HSAINE', 23, '', 'fdouslimane@gmail.com ', 'Karia', '', 1, '0661680650', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1490138613),
(30, 14, '45a61b', '2:3', 'ETABTEST', 20, '20170228_1404351.jpg', 'elhadim_br@yahoo.fr', '22 yassmina', '', 1, '0612345678', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 1490177683),
(31, 13, 'f0dc3c', '1:2', 'Firdaws', 27, '', 'fdouslimane@gmail.com ', 'Khemisset', '', 1, '0637351925', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1490287807);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `idClient` int(11) NOT NULL AUTO_INCREMENT,
  `idCentre` int(11) NOT NULL,
  `nom` varchar(200) CHARACTER SET utf8 NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `niveau` int(11) NOT NULL,
  `classe` int(11) NOT NULL,
  `groupe` int(11) NOT NULL,
  `nomParent` varchar(200) CHARACTER SET utf8 NOT NULL,
  `email` varchar(200) NOT NULL,
  `telParent` varchar(100) NOT NULL,
  `adresseMac` varchar(200) NOT NULL,
  `token` text NOT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`idClient`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=89 ;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`idClient`, `idCentre`, `nom`, `fname`, `lname`, `niveau`, `classe`, `groupe`, `nomParent`, `email`, `telParent`, `adresseMac`, `token`, `state`) VALUES
(45, 6, 'Hggg Hggf', 'Hggg', 'Hggf', 1, 1, 1, 'Hgf hfdx', '', '6565656565', '6fb017f7-1d08-0ef2-3519-550715611958', '', 1),
(66, 17, 'Asmae Douslimane', 'Asmae', 'Douslimane', 1, 5, 1, 'Aymane', '', '0661680650', '2154b5ca-471e-87b2-3563-160824098308', 'eo4edslfQ_8:APA91bGkW_3Jzllg8OlAdJdAypDQ8RrRd3oXw3Yn8yVBP10PwmjgvvyngreI6ghdMw-Gqi0nbh2pT-Efy9nNdhM0FiwX-GhhFDFcsdj4D7kEw9MjyP65z5L0ibaPhZnnnLjX8SAYsH_i', 1),
(67, 17, 'Aymane Douslimane', 'Aymane', 'Douslimane', 1, 6, 2, 'Aymane', '', '0661680650', '2154b5ca-471e-87b2-3563-160824098308', 'eo4edslfQ_8:APA91bGkW_3Jzllg8OlAdJdAypDQ8RrRd3oXw3Yn8yVBP10PwmjgvvyngreI6ghdMw-Gqi0nbh2pT-Efy9nNdhM0FiwX-GhhFDFcsdj4D7kEw9MjyP65z5L0ibaPhZnnnLjX8SAYsH_i', 1),
(69, 13, 'Ossama Bouykba', 'Ossama', 'Bouykba', 1, 1, 1, 'Bouykba said', '', '0699905169', '66e2452e-d482-5ad0-3570-910770977398', '', 1),
(71, 20, 'Salmane Baribi', 'Salmane', 'Baribi', 1, 1, 1, 'Baribi amine', '', '0655159236', '18bac352-31ca-d326-3564-550702675688', '', 1),
(72, 19, 'Nada Ait mouna', 'Nada', 'Ait mouna', 1, 1, 1, 'Ait Mouna Brahim', '', '0666572573', 'e3c55c74-eeca-5410-3590-640747903078', '', 1),
(74, 20, 'Salmane Collège', 'Salmane', 'Collège', 2, 1, 1, 'Baribi amine', '', '0655159236', '18bac352-31ca-d326-3564-550702675688', '', 1),
(76, 9, 'Imad Ghanimi', 'Imad', 'Ghanimi', 1, 1, 1, 'Lhaj imad', '', '0699955119', '0391bd6c-1eb0-1a12-3353-120089105422', '', 1),
(86, 23, 'Khg Uhff', 'Khg', 'Uhff', 1, 1, 1, 'Jgf', '', '65546553488', '097d11ea-302d-84ff-4359-838070557707', '', 1),
(87, 23, 'Mini Fq', 'Mini', 'Fq', 1, 4, 1, 'Mini Parent', '', '065475479778', 'be95feab-4103-4d15-3537-380628891088', 'd0M_zUcH4-s:APA91bFufpbFur-jetmX1IqF4dHDalg3dG900nlKww6pgNvKWnYz0gPkan1l75O-rjYRVY5pUEJgGN5QwybudhzZx1T3KGyF1LuQANOOA07EWDjoC01uUPA_Aq-Tp6kgn_mMj2ELi68K', 1),
(88, 23, 'Ilham Rifki', 'Ilham', 'Rifki', 1, 4, 1, 'Hassan Rifki', '', '0654213874', 'bd797f5d-69b9-d547-3583-160680586178', 'eZyUlfUDoXQ:APA91bFpnJ5ZZFf1kdsZz4DlA65CHxaYhgZbcCDO0Yp_SqK57jS0fj5S0XxFxxfvG-5qaVEn6NmOhov16dUey4ZiFEUnu-uF1yYpq54EoZr5g2jJ6lDNLrbI33iGIpqxNl_ooDHP_NIM', 1);

-- --------------------------------------------------------

--
-- Structure de la table `matieres`
--

CREATE TABLE IF NOT EXISTS `matieres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(200) CHARACTER SET utf8 NOT NULL,
  `niveau` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1256 AUTO_INCREMENT=71 ;

--
-- Contenu de la table `matieres`
--

INSERT INTO `matieres` (`id`, `intitule`, `niveau`) VALUES
(1, 'العربية', 1),
(2, 'التربية الإسلامية', 1),
(3, 'الاجتماعيات', 1),
(4, 'Français', 1),
(6, 'الرياضيات', 1),
(7, 'Maths', 1),
(8, 'النشاط العلمي', 1),
(9, 'Informatique', 1),
(10, 'Education physique et sportive', 1),
(11, 'الأمازيغية', 1),
(12, 'التربية الفنية', 1),
(13, 'التربية التشكيلية', 1),
(14, 'Education artistique', 1),
(15, 'Education musicale', 1),
(16, 'Théâtre', 1),
(19, 'Anglais', 1),
(23, 'Éveil scientifique', 1),
(24, 'العربية', 2),
(25, 'التربية الإسلامية', 2),
(26, 'الاجتماعيات', 2),
(27, 'Français', 2),
(28, 'Anglais', 2),
(29, 'الرياضيات', 2),
(30, 'Maths', 2),
(31, 'علوم الحياة والارض', 2),
(32, 'Sciences de la vie et de la terre', 2),
(33, 'العلوم الفيزيائية', 2),
(34, 'Sciences physiques', 2),
(35, 'Informatique', 2),
(36, 'Education physique et sportive', 2),
(37, 'Initiation à la technologie', 2),
(38, 'التربية الأسرية', 2),
(39, 'التربية الفنية', 2),
(40, 'التربية التشكيلية', 2),
(41, 'Education artistique', 2),
(42, 'Education musicale', 2),
(43, 'Théâtre', 2),
(44, 'التربية الإسلامية', 3),
(45, 'اللغة العربية', 3),
(46, 'الفلسفة', 3),
(48, 'Maths', 3),
(49, 'Langue Française', 3),
(50, 'Langue anglaise', 3),
(51, 'Langue espagnole', 3),
(52, 'Langue allemande', 3),
(53, 'Informatique', 3),
(54, 'Education physique et sportive', 3),
(55, 'التاريخ و الجغرافيا', 3),
(56, 'الرياضيات', 3),
(57, 'علوم الحياة والأرض', 3),
(58, 'الفيزياء والكيمياء', 3),
(59, 'Langue italienne', 3),
(60, 'Sciences de la vie et de la terre', 3),
(61, 'Physique chimie', 3),
(62, 'الثقافة الفنية', 3),
(63, 'التوثيق', 3),
(64, 'الترجمة', 3),
(65, 'Comptabilité et Maths financière', 3),
(66, 'Economie générale et statistiques', 3),
(67, 'Organisation des entreprises', 3),
(68, 'Droit', 3),
(69, 'Informatique de gestion', 3),
(70, 'Sciences de l''ingénieur', 3);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `idMessage` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` varchar(40) NOT NULL,
  `from` varchar(20) NOT NULL,
  `idFrom` int(11) NOT NULL,
  `idCentre` int(11) NOT NULL,
  `niveau` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `destination` text NOT NULL,
  `matiere` varchar(100) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `align` varchar(10) NOT NULL,
  `file` text CHARACTER SET utf8 NOT NULL,
  `typeFile` varchar(100) NOT NULL,
  `time` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `vu` text NOT NULL,
  PRIMARY KEY (`idMessage`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=559 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`idMessage`, `categorie`, `from`, `idFrom`, `idCentre`, `niveau`, `type`, `destination`, `matiere`, `content`, `align`, `file`, `typeFile`, `time`, `state`, `vu`) VALUES
(18, 'parent', 'prof', 2, 9, 1, 'groupe', '1-1', 'التربية الإسلامية', 'البحث عن مواضيع', 'left', '14871128252.jpg', 'image', 1487112825, 1, '2'),
(19, 'parent', 'prof', 2, 3, 1, 'groupe', '1-1', 'العربية', 'الصورة الرمزية', 'left', '14871130422.jpg', 'image', 1487113042, 1, '2'),
(20, 'parent', 'prof', 2, 3, 1, 'groupe', '1-1', 'الاجتماعيات', 'المشاركات الجديده', 'left', '14871133272.jpg', 'image', 1487113327, 1, '2'),
(21, 'parent', 'prof', 2, 3, 1, 'groupe', '1-1', 'النشاط العلمي', 'برنامج رائع', 'left', '14871134212.jpg', 'image', 1487113421, 1, '2'),
(22, 'parent', 'prof', 2, 3, 1, 'groupe', '1-1', 'النشاط العلمي', 'رقم الحصة', 'left', '14871135452.jpg', 'image', 1487113545, 1, '2'),
(42, 'parent', 'prof', 2, 3, 1, 'parent', '3,2', 'النشاط العلمي', 'Merci d''avance', 'left', '14871595402.jpg', 'image', 1487159540, 1, '3,2'),
(80, 'parent', 'prof', 5, 1, 3, 'groupe', '5-1', 'Organisation des entreprises', 'Lycée.&nbsp;<div>Classes non abrégés. ..!</div>', 'left', '', '', 1487214592, 1, ''),
(83, 'parent', 'prof', 5, 1, 3, 'groupe', '11-1', 'Comptabilité et Maths financière', 'Jhh', 'left', '', '', 1487221138, 1, '7'),
(84, 'parent', 'prof', 5, 1, 3, 'groupe', '11-1', 'Organisation des entreprises', 'Kkk', 'left', '', '', 1487221178, 1, '7'),
(89, 'parent', 'prof', 2, 3, 1, 'parent', '2,3', 'النشاط العلمي', 'Merci', 'left', '', '', 1487258895, 1, '3,2'),
(90, 'parent', 'prof', 2, 3, 1, 'groupe', '1-1,2-2', 'التربية التشكيلية', 'Je suis à votre disposition', 'left', '14872598292.jpg', 'image', 1487259829, 1, '3,2'),
(91, 'parent', 'prof', 2, 3, 1, 'groupe', '1-1,2-2', 'التربية التشكيلية', 'Je suis à votre disposition', 'left', '14872598672.jpg', 'image', 1487259867, 1, '2,3'),
(113, 'parent', 'centre', 1, 1, 1, 'parent', '6', '', '<p>Bonjour Nizar.</p>\r\n<p>Merci.&nbsp;</p>\r\n<p>&nbsp;</p>', 'left', '', '', 1487353342, 1, '6'),
(114, 'parent', 'centre', 1, 1, 1, 'parent', '6', '', '<p>Jointe&nbsp;</p>', 'left', '', '', 1487353394, 1, '6'),
(116, 'parent', 'centre', 1, 1, 1, 'parent', '6', '', '<p>Kg jfff</p>', 'left', 'Screenshot_2016-04-06-00-27-291.png', 'image', 1487353807, 1, '6'),
(119, 'parent', 'prof', 5, 1, 3, 'groupe', '11-1', 'Comptabilité et Maths financière', 'V', 'left', '', '', 1487367526, 1, '7'),
(124, 'parent', 'prof', 1, 1, 1, 'parent', '1,6', 'Informatique', '<p dir="rtl">السلام عليكم&nbsp;</p>', 'left', '', '', 1487430803, 1, '1,6'),
(125, 'parent', 'prof', 3, 1, 1, 'parent', '1', 'Éveil scientifique', 'Eveil', 'left', '', '', 1487431328, 1, '1'),
(126, 'parent', 'prof', 1, 1, 1, 'parent', '1,6', 'Informatique', '<p dir="rtl"><div style="text-align: center;"><b style="color: rgb(20, 24, 36); font-size: 14px;">الحاج عدنان</b><span style="color: rgb(20, 24, 36); font-size: 14px;">&nbsp;&nbsp;</span></div><div>كيف حالك ؟&nbsp;</div><div>الصحة لابأس &nbsp;؟&nbsp;</div><div><br></div></p>', 'left', '', '', 1487441457, 1, '1,6'),
(133, 'parent', 'prof', 1, 1, 1, 'parent', '6,1', 'Informatique', 'Kg jgg', 'left', '14874727921.jpg', 'image', 1487472793, 1, '1,6'),
(143, 'parent', 'prof', 2, 3, 1, 'groupe', '1-1', 'التربية التشكيلية', 'Veuillez vous présenter à l administration de l établissement s il vous plaît', 'left', '14876677022.jpg', 'image', 1487667702, 1, '2'),
(144, 'parent', 'prof', 2, 3, 1, 'groupe', '1-1', 'التربية التشكيلية', 'Veuillez vous présenter à l administration de l établissement s il vous plaît', 'left', '14876680562.jpg', 'image', 1487668056, 1, '2'),
(153, 'parent', 'centre', 1, 1, 1, 'parent', '1', '', '<p>Ecole test</p>', 'left', '', '', 1487770149, 1, '1'),
(154, 'parent', 'prof', 5, 1, 3, 'groupe', '11-1', 'Economie générale et statistiques', '<p>Faiq lycee</p>', 'left', '', '', 1487770785, 1, '7'),
(155, 'prof', 'centre', 1, 1, 3, 'all', 'all', '', '<p dir="rtl" style="text-align: center;"><span style="color: #ff0000;"><strong>الإعداد لامتحانات الأسدس الأول</strong></span></p>\r\n<p dir="rtl"><strong>&nbsp;</strong>السادة الأساتذة</p>\r\n<p dir="rtl">في إطار الإعداد لامتحانات الأسدس الأول، ندعو هيئة تدريس المستوى الإبتدائي للإجتماع يوم السبت 2 يناير على الساعة 9 صباحا.</p>\r\n<p dir="rtl" style="text-align: right;">حضوركم ضروري ومؤكد.</p>', 'left', '', '', 1487771082, 1, '5'),
(161, 'parent', 'centre', 1, 1, 1, 'parent', '1,11', '', '', 'left', '', '', 1487791102, 1, '11,1'),
(166, 'parent', 'centre', 1, 1, 1, 'parent', '5,8', '', '<p dir="rtl">عمل ممتاز.</p>\r\n<p dir="rtl">&nbsp;</p>', 'left', '', '', 1487872595, 1, '5'),
(167, 'parent', 'prof', 5, 1, 3, 'groupe', '5-1', 'Economie générale et statistiques', 'Ssssss', 'left', '', '', 1487887009, 1, ''),
(168, 'parent', 'prof', 5, 1, 3, 'groupe', '11-1', 'Economie générale et statistiques', 'Pppppppp', 'left', '', '', 1487887131, 1, '7'),
(169, 'parent', 'centre', 1, 1, 3, 'groupe', '11-1', '', '<p>Dddd</p>', 'left', '', '', 1487889605, 1, ''),
(170, 'parent', 'prof', 1, 1, 1, 'groupe', '1-1', 'Informatique', 'Uhggg', 'left', '', '', 1487890785, 1, '12,9'),
(217, 'parent', 'centre', 5, 5, 1, 'parent', '20', '', '<p>Test</p>', 'left', 'Screenshot_2016-05-09-00-27-43.png', 'image', 1488317325, 1, '20'),
(218, 'parent', 'centre', 5, 5, 1, 'all', 'all', '', '<p>Bienvenue &agrave; tous les parents du primaire.</p>\r\n<p>Merci de choisir tawassolApp.</p>', 'left', '', '', 1488374232, 1, '27'),
(220, 'parent', 'prof', 18, 5, 1, 'groupe', '1-1,3-1', 'Informatique', 'Révision informatique&nbsp;', 'left', '', '', 1488378236, 1, '27'),
(221, 'prof', 'centre', 5, 5, 1, 'matiere', '9', '', '<p>Prof informatique</p>', 'left', '', '', 1488378352, 1, '18'),
(222, 'parent', 'prof', 18, 5, 1, 'groupe', '1-1', 'Informatique', 'Bonjour&nbsp;<div>Test.</div><div><br></div>', 'left', '148837898518.jpg', 'image', 1488378986, 1, '27'),
(223, 'parent', 'prof', 18, 5, 1, 'groupe', '1-1', 'Informatique', 'Essaiiiii', 'left', '', '', 1488379446, 1, ''),
(224, 'parent', 'prof', 18, 5, 1, 'groupe', '1-1', 'Informatique', 'Cours de soutien.&nbsp;<div>Merci.&nbsp;</div>', 'left', '', '', 1488380386, 1, '27'),
(225, 'parent', 'prof', 18, 5, 1, 'groupe', '1-1', 'Informatique', 'Dfghkl', 'left', '', '', 1488380528, 1, '27'),
(226, 'parent', 'prof', 18, 5, 1, 'groupe', '1-1', 'Informatique', 'Pppppp', 'left', '', '', 1488380954, 1, '27'),
(227, 'parent', 'prof', 18, 5, 1, 'groupe', '1-1,1-2,3-1,3-2,3-3', 'Informatique', 'Gggg', 'left', '', '', 1488381025, 1, '27'),
(228, 'prof', 'centre', 5, 5, 1, 'all', 'all', '', '<p>Bienvenue &agrave; tous les enseignants du primaire&nbsp;</p>', 'left', '', '', 1488381392, 1, '18,8'),
(229, 'parent', 'prof', 18, 5, 1, 'groupe', '1-1', 'Informatique', 'Bonjour&nbsp;', 'left', '', '', 1488383188, 1, '27'),
(231, 'prof', 'centre', 5, 5, 1, 'all', 'all', '', '<p>Profs du primaire&nbsp;</p>', 'left', '', '', 1488383764, 1, '8'),
(232, 'parent', 'prof', 12, 5, 3, 'groupe', '10-1', 'Comptabilité et Maths financière', 'Ly', 'left', '', '', 1488383840, 1, ''),
(233, 'prof', 'centre', 5, 5, 3, 'all', 'all', '', '<p>Juste lycee</p>', 'left', '', '', 1488383900, 1, ''),
(238, 'parent', 'centre', 6, 6, 3, 'all', 'all', '', '<p>Lycee</p>', 'left', '', '', 1488390701, 1, ''),
(239, 'parent', 'centre', 6, 6, 3, 'all', 'all', '', '<p>Lycee 2</p>', 'left', '', '', 1488390805, 1, ''),
(242, 'prof', 'centre', 6, 6, 2, 'all', 'all', '', '<p>Prof coll&egrave;ge</p>', 'left', '', '', 1488391032, 1, '20'),
(243, 'prof', 'centre', 6, 6, 3, 'all', 'all', '', '<p>Prof lycee</p>', 'left', '', '', 1488391084, 1, '21'),
(245, 'parent', 'prof', 21, 6, 3, 'groupe', '11-1', 'Organisation des entreprises', 'Logos lycee', 'left', '', '', 1488391304, 1, '31'),
(246, 'parent', 'centre', 6, 6, 1, 'parent', '29', '', '<p>Ayaaaaaa</p>', 'left', '', '', 1488391389, 1, ''),
(247, 'parent', 'prof', 21, 6, 3, 'groupe', '11-1', 'Organisation des entreprises', 'Hcc', 'left', '', '', 1488392703, 1, ''),
(255, 'prof', 'centre', 6, 6, 2, 'all', 'all', '', '<p>Uhhj</p>', 'left', '', '', 1488408152, 1, '20'),
(257, 'parent', 'centre', 6, 6, 1, 'classe', '1', '', '<p>Message depuis &eacute;cole &agrave; toute la classe 1 AP.</p>\r\n<p>Merci beaucoup.&nbsp;</p>', 'left', '', '', 1488477582, 1, '33,36'),
(258, 'parent', 'prof', 19, 6, 1, 'groupe', '1-1', 'Français', '- Révision conjugaison.&nbsp;<div>- Révision grammaire.&nbsp;</div><div>- Aussi l''orthographe&nbsp;</div>', 'left', '148847802319.jpg', 'image', 1488478023, 1, '33,36'),
(261, 'prof', 'centre', 6, 6, 1, 'matiere', '4', '', '<p>Prof fran&ccedil;ais</p>', 'left', '', '', 1488486557, 1, '19'),
(264, 'prof', 'centre', 6, 6, 1, 'all', 'all', '', '<p dir="rtl">السادة الأشراف.&nbsp;</p>\r\n<p dir="rtl">هعاا ناا تتاا تتغ .</p>', 'left', '', '', 1488486864, 1, '19'),
(270, 'parent', 'prof', 19, 6, 1, 'groupe', '1-1,1-2', 'Français', '<p>Hggg</p>', 'left', '', '', 1488572248, 1, '33,36'),
(271, 'prof', 'centre', 6, 6, 1, 'all', 'all', '', '<p>test</p>', 'left', '', '', 1488634993, 1, ''),
(272, 'prof', 'centre', 6, 6, 2, 'all', 'all', '', '<p>test</p>', 'left', '', '', 1488635066, 1, '20'),
(274, 'parent', 'centre', 6, 6, 1, 'all', 'all', '', '<p dir="rtl" style="text-align: center;"><span style="color: #ff0000;"><strong>إخبار بامتحانات المراقبة المستمرة</strong></span></p>\n<p dir="rtl">نحيط الأمهات والآباء والأولياء الأعزاء علما أن امتحانات المراقبة المستمرة الأولى ستجرى في الفترة الممتدة من 20 إلى 27 يناير.<br /> لذلك وجب الإعداد بشكل جيد لبلوغ النتائج المرجوة.</p>', 'left', '', '', 1488640235, 1, '33'),
(275, 'parent', 'centre', 6, 6, 1, 'all', 'all', '', '<div style="text-align: left;">\n<p style="text-align: center;"><span style="color: #ff0000;"><strong>Pr&eacute;paration aux contr&ocirc;les continus</strong></span></p>\n<p><strong>&nbsp;</strong>Chers parents</p>\n<p>Nous portons &agrave; votre connaissance que les contr&ocirc;les continus auront lieu du 20 au 27 Janvier.</p>\n<p>Une bonne pr&eacute;paration s&rsquo;impose pour un meilleur r&eacute;sultat.</p>\n</div>', 'left', '', '', 1488640303, 1, ''),
(276, 'parent', 'centre', 6, 6, 1, 'all', 'all', '', '<div style="text-align: left;">\n<p style="text-align: center;"><span style="color: #ff0000;"><strong>Comportement inadmissible</strong></span></p>\n<p><strong>&nbsp;</strong>Madame, Monsieur</p>\n<p>Nous portons &agrave; votre connaissance que l&rsquo;&eacute;l&egrave;ve Oussama Saad, lors de la s&eacute;ance de Maths du 14 F&eacute;vrier, s&rsquo;est conduit de mani&egrave;re inacceptable.<br />Suite &agrave; ce comportement, nous vous prions de se rendre &agrave; l&rsquo;&eacute;tablissement dans les plus brefs d&eacute;lais.</p>\n</div>', 'left', '', '', 1488640365, 1, '33'),
(277, 'parent', 'centre', 6, 6, 1, 'all', 'all', '', '<div style="text-align: left;">\n<p style="text-align: center;"><span style="color: #ff0000;"><strong>Comportement inadmissible</strong></span></p>\n<p><strong>&nbsp;</strong>Madame, Monsieur</p>\n<p>Nous portons &agrave; votre connaissance que l&rsquo;&eacute;l&egrave;ve Oussama Saad, lors de la s&eacute;ance de Maths du 14 F&eacute;vrier, s&rsquo;est conduit de mani&egrave;re inacceptable.<br />Suite &agrave; ce comportement, nous vous prions de se rendre &agrave; l&rsquo;&eacute;tablissement dans les plus brefs d&eacute;lais.</p>\n</div>', 'left', '', '', 1488640787, 1, '33'),
(278, 'parent', 'centre', 6, 6, 2, 'all', 'all', '', '<div style="text-align: left;">\n<p style="text-align: center;"><span style="color: #ff0000;"><strong>Pr&eacute;paration aux contr&ocirc;les continus</strong></span></p>\n<p><strong>&nbsp;</strong>Chers parents</p>\n<p>Nous portons &agrave; votre connaissance que les contr&ocirc;les continus auront lieu du 20 au 27 Janvier.</p>\n<p>Une bonne pr&eacute;paration s&rsquo;impose pour un meilleur r&eacute;sultat.</p>\n</div>', 'left', '', '', 1486141686, 1, '34'),
(279, 'parent', 'prof', 20, 6, 2, 'groupe', '1-1', 'Maths', 'Hff', 'left', '', '', 1488644072, 1, '34'),
(280, 'parent', 'prof', 20, 6, 2, 'groupe', '1-1', 'Maths', 'Bonjour Monsieur Jean Paul&nbsp;', 'left', '', '', 1488644361, 1, '34'),
(281, 'parent', 'centre', 6, 6, 2, 'all', 'all', '', '<p>test</p>', 'left', '', '', 1488648092, 1, '34'),
(282, 'parent', 'prof', 20, 6, 2, 'groupe', '1-1,2-1,2-2', 'Maths', '<p dir="rtl">خنتاا</p>', 'left', '', '', 1488651291, 1, '34'),
(283, 'parent', 'prof', 20, 6, 2, 'groupe', '1-1', 'Maths', 'Bonjour Monsieur&nbsp;', 'left', '', '', 1488652195, 1, '34'),
(284, 'parent', 'prof', 20, 6, 2, 'groupe', '1-1', 'Maths', 'Hdhgdbwgg', 'left', '148865376120.jpg', 'image', 1488653761, 1, '34'),
(285, 'parent', 'prof', 20, 6, 2, 'groupe', '1-1', 'الرياضيات', '<p dir="rtl">مرحبا&nbsp;</p>', 'left', '', '', 1488654630, 1, '34'),
(286, 'parent', 'prof', 2, 3, 1, 'groupe', '1-1', 'العربية', 'Slm', 'left', '', '', 1488657431, 1, '2'),
(287, 'parent', 'prof', 2, 3, 1, 'groupe', '1-1,1-2,2-2', 'التربية الإسلامية', 'Merci', 'left', '', '', 1488657537, 1, '3,2'),
(288, 'parent', 'prof', 2, 3, 1, 'groupe', '1-2,1-1,2-2', 'الاجتماعيات', 'Merci beaucoup pour votre retour', 'left', '', '', 1488657615, 1, '3,2'),
(289, 'prof', 'centre', 3, 3, 1, 'all', 'all', '', '<p>Merci d''avance</p>', 'left', '', '', 1488657910, 1, '2,24,31'),
(291, 'parent', 'prof', 20, 6, 2, 'groupe', '1-1,2-1', 'Maths', 'Uggui', 'left', '', '', 1488668951, 1, '34'),
(292, 'parent', 'prof', 24, 3, 1, 'groupe', '1-1', 'العربية', 'Salam', 'left', '', '', 1488672552, 1, '4,2'),
(293, 'prof', 'centre', 6, 6, 2, 'all', 'all', '', '<p>Bonjour tous les profs</p>', 'left', '', '', 1488673059, 1, '20'),
(294, 'prof', 'centre', 6, 6, 2, 'all', 'all', '', '<p dir="rtl" style="text-align: right;">السلام عليكم جميع الأساتذة.&nbsp;</p>\r\n<p dir="rtl" style="text-align: right;">و مرحبا بكم في منتديات.&nbsp;</p>', 'left', '', '', 1488673155, 1, '20'),
(295, 'prof', 'centre', 3, 3, 1, 'all', 'all', '', '<p style="text-align: center;"><span style="color: #ff0000;">Veuillez vous pr&eacute;senter &agrave; l administration</span></p>', 'left', '', '', 1488674136, 1, '24,2,31'),
(298, 'parent', 'centre', 8, 8, 1, 'all', 'all', '', '<p style="text-align: center;"><span style="color: #ff0000;"><strong>إخبار </strong></span></p>\r\n<p dir="rtl" style="text-align: right;">نحيط الأمهات والآباء والأولياء الأعزاء علما أن المؤسسة ستنظم لقاء تواصليا مع هيئة تدريس الإبتدائي وذلك يوم السبت 15 أبريل ابتداء من الساعة التاسعة صباحا.</p>\r\n<p dir="rtl" style="text-align: right;">حضوركم ضروري ومؤكد لإغناء هذا اللقاء الهام.</p>', 'left', '', '', 1488715953, 1, '38'),
(303, 'parent', 'centre', 8, 8, 1, 'all', 'all', '', '<p><strong><span style="color: #ff0000;">Vacance scolaire</span><br /> </strong>A l&rsquo;occasion de la f&ecirc;te du sacrifice, les cours seront suspendus du dimanche 20 Septembre au Mercredi 23 Septembre.<br /> Les cours reprendront le jeudi 24 Septembre.<br /> Bonne f&ecirc;te &agrave; tous&nbsp;!</p>', 'left', '', '', 1488717240, 1, '38'),
(307, 'parent', 'prof', 27, 8, 1, 'groupe', '4-1', 'Maths', '<p><strong>R&eacute;vision<br /></strong>- Je fais mes devoirs (voir le porte-documents)<br />- J&rsquo;apprends la table de multiplication&nbsp;: de 1 &agrave; 9</p>', 'left', '', '', 1488719512, 1, '38'),
(309, 'prof', 'centre', 8, 8, 1, 'all', 'all', '', '<p style="text-align: left;"><strong><span style="color: #ff0000;">Pr&eacute;paration &agrave; la nouvelle ann&eacute;e scolaire</span><br /> </strong>Pour entreprendre une bonne pr&eacute;paration &agrave; la nouvelle ann&eacute;e scolaire, nous invitons le corps enseignant du primaire &agrave; une r&eacute;union le Samedi 2 Septembre &agrave; 9 heures.Votre pr&eacute;sence est capitale.</p>', 'left', '', '', 1488720573, 1, '27,28,32'),
(311, 'parent', 'prof', 29, 8, 3, 'groupe', '11-1', 'Economie générale et statistiques', 'Essai', 'left', '', '', 1488725325, 1, '39'),
(314, 'parent', 'prof', 20, 6, 2, 'groupe', '1-1,2-1,2-2', 'الرياضيات', '<p dir="rtl">ااااا</p>', 'left', '', '', 1488730769, 1, ''),
(315, 'parent', 'prof', 2, 3, 1, 'groupe', '1-1,2-2,1-2', 'التربية الفنية', 'Je suis en vacances', 'left', '14887434602.jpg', 'image', 1488743461, 1, '3,2'),
(316, 'parent', 'prof', 2, 3, 1, 'groupe', '1-1,2-2,1-2', 'التربية الفنية', 'Je suis en vacances', 'left', '14887435132.jpg', 'image', 1488743513, 1, '3,2'),
(317, 'parent', 'prof', 24, 3, 1, 'groupe', '1-1,1-2', 'العربية', 'Teste', 'left', '', '', 1488744444, 1, '2'),
(318, 'parent', 'prof', 2, 3, 1, 'groupe', '1-2,2-2,1-1', 'التربية الإسلامية', 'Teste app active', 'left', '', '', 1488748689, 1, '3,2'),
(319, 'parent', 'prof', 2, 3, 1, 'groupe', '1-2,2-2,1-1', 'الاجتماعيات', 'Teste app fermé', 'left', '', '', 1488748737, 1, '3,2'),
(320, 'parent', 'prof', 2, 3, 1, 'groupe', '1-1,2-2,1-2', 'التربية الفنية', 'Je', 'left', '', '', 1488748843, 1, '3,2'),
(331, 'parent', 'prof', 27, 8, 1, 'groupe', '4-1', 'الرياضيات', '<p dir="rtl" style="text-align: center;"><strong><span style="color: #ff0000;">واجبات منزلية</span></strong></p>\r\n<p dir="rtl">- أراجع جيدا دروس الأعداد العشرية و المثلثات.<br />- أنجز تمارين الكراسة، صفحة 82 رقم 1 و 2.</p>', 'left', '20170305_221552-11.jpg', 'image', 1488758569, 1, '38'),
(332, 'parent', 'centre', 8, 8, 1, 'all', 'all', '', '<p>Bonjour&nbsp;</p>', 'left', '', '', 1488767059, 1, '38'),
(335, 'prof', 'centre', 8, 8, 1, 'all', 'all', '', '<p>Prof pi&egrave;ce jointe.&nbsp;</p>', 'left', '104321.png', 'image', 1488806015, 1, '27,32'),
(345, 'parent', 'centre', 8, 8, 3, 'all', 'all', '', '<p>Parent tous lycee</p>', 'left', '', '', 1488815078, 1, '39'),
(346, 'prof', 'centre', 8, 8, 3, 'all', 'all', '', '<p>Prof lycee</p>', 'left', '', '', 1488815202, 1, '29'),
(347, 'parent', 'prof', 29, 8, 3, 'groupe', '11-1', 'Economie générale et statistiques', 'Khgcc', 'left', '', '', 1488815280, 1, '39'),
(348, 'parent', 'centre', 8, 8, 2, 'all', 'all', '', '<p>parents coll&eacute;ge</p>', 'left', '', '', 1488829965, 1, '42'),
(349, 'parent', 'centre', 8, 8, 2, 'all', 'all', '', '<p>p. jointe</p>', 'left', 'Ecole.png', 'image', 1488830035, 1, '42'),
(350, 'parent', 'prof', 20, 6, 2, 'groupe', '1-1,2-1,2-2', 'الرياضيات', 'Gggh', 'left', '', '', 1488838607, 1, ''),
(351, 'parent', 'prof', 27, 8, 1, 'groupe', '4-1', 'Maths', 'Gggg khggg edg', 'left', '', '', 1488839494, 1, '38'),
(352, 'parent', 'prof', 31, 3, 1, 'groupe', '2-1', 'النشاط العلمي', 'Salam', 'left', '148884057231.jpg', 'image', 1488840573, 1, '41'),
(353, 'parent', 'prof', 2, 3, 1, 'groupe', '1-1,1-2,2-2', 'التربية التشكيلية', 'انجاز التمرين 5، الصفحة 44', 'left', '', '', 1488884674, 1, '3,2'),
(354, 'parent', 'prof', 2, 3, 1, 'groupe', '1-1,1-2,2-2', 'التربية التشكيلية', 'انجاز التمرين 5، الصفحة 44', 'left', '14888851992.jpg', 'image', 1488885199, 1, '2,3'),
(355, 'parent', 'prof', 2, 3, 1, 'groupe', '1-1,1-2,2-2', 'التربية التشكيلية', 'انجاز التمرين 5، الصفحة 44', 'left', '14888852112.jpg', 'image', 1488885211, 1, '2,3'),
(356, 'parent', 'prof', 2, 3, 1, 'groupe', '1-1,1-2,2-2', 'التربية التشكيلية', 'انجاز التمرين 5، الصفحة 44', 'left', '14888852142.jpg', 'image', 1488885214, 1, '2,3'),
(357, 'parent', 'prof', 2, 3, 1, 'groupe', '1-1,1-2,2-2', 'التربية التشكيلية', 'انجاز التمرين 5، الصفحة 44', 'left', '14888852512.jpg', 'image', 1488885251, 1, '2,3'),
(358, 'parent', 'prof', 2, 3, 1, 'groupe', '1-1,1-2,2-2', 'التربية التشكيلية', 'انجاز التمرين 5، الصفحة 44', 'left', '14888852532.jpg', 'image', 1488885253, 1, '2,3'),
(359, 'parent', 'prof', 2, 3, 1, 'groupe', '1-1,1-2,2-2', 'العربية', 'Merci', 'left', '14888856392.jpg', 'image', 1488885639, 1, '2,3'),
(360, 'parent', 'prof', 2, 3, 1, 'groupe', '1-1,1-2,2-2', 'العربية', 'Merci', 'left', '14888857472.jpg', 'image', 1488885747, 1, '3,2'),
(361, 'parent', 'prof', 2, 3, 1, 'groupe', '1-1,1-2,2-2', 'العربية', 'Merci', 'left', '14888860242.jpg', 'image', 1488886024, 1, '2,3'),
(362, 'parent', 'prof', 2, 3, 1, 'groupe', '1-1,1-2,2-2', 'العربية', 'Merci', 'left', '14888860542.jpg', 'image', 1488886054, 1, '2,3'),
(363, 'parent', 'prof', 2, 3, 1, 'groupe', '1-1,1-2,2-2', 'العربية', 'Merci', 'left', '14888861042.jpg', 'image', 1488886104, 1, '2,3'),
(364, 'parent', 'prof', 27, 8, 1, 'groupe', '4-1', 'Maths', 'Matière&nbsp;', 'left', '', '', 1488886786, 1, '38'),
(365, 'parent', 'centre', 8, 8, 1, 'all', 'all', '', '<p style="text-align: left;"><strong><span style="color: #ff0000;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Vacance scolaire</span><br /> <br /></strong>A l&rsquo;occasion de la f&ecirc;te du sacrifice, les cours seront suspendus du dimanche 20 Septembre au Mercredi 23 Septembre.<br /> Les cours reprendront le jeudi 24 Septembre.<br /> Bonne f&ecirc;te &agrave; tous&nbsp;!</p>', 'left', '', '', 1488933211, 1, '38'),
(366, 'parent', 'centre', 8, 8, 1, 'all', 'all', '', '<p style="text-align: center;"><span style="color: #ff0000;"><strong>Vacance scolaire</strong></span></p>\r\n<p>A l&rsquo;occasion de la f&ecirc;te du sacrifice, les cours seront suspendus du dimanche 20 Septembre au Mercredi 23 Septembre.<br />Les cours reprendront le jeudi 24 Septembre.<br />Bonne f&ecirc;te &agrave; tous&nbsp;!</p>', 'left', '', '', 1488933388, 1, '38'),
(367, 'parent', 'centre', 8, 8, 1, 'all', 'all', '', '<p><span style="color: #ff0000;"><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; test</strong></span></p>\r\n<p>sdfsdfsdfsdfs sdf f dff</p>\r\n<p>fsdf dfdsf fd&nbsp;</p>\r\n<p>&nbsp;</p>', 'left', '', '', 1488934198, 1, '38'),
(373, 'parent', 'centre', 9, 9, 1, 'parent', '44', '', '<p>retard</p>', 'left', '', '', 1488943161, 1, '44'),
(375, 'parent', 'prof', 2, 3, 1, 'groupe', '1-1', 'الاجتماعيات', 'Je vous présenter notre page', 'left', '14889819942.jpg', 'image', 1488981995, 1, '2'),
(376, 'parent', 'prof', 20, 6, 2, 'groupe', '1-1,2-1,2-2', 'Maths', '<p dir="rtl">ههابببتننللل</p>', 'left', '', '', 1489013415, 1, ''),
(377, 'parent', 'centre', 10, 10, 2, 'groupe', '1-1', '', '<p>Bonjour Said</p>', 'left', '', '', 1489093755, 1, '46'),
(385, 'parent', 'prof', 31, 3, 1, 'groupe', '2-1', 'النشاط العلمي', 'hhhhh', 'left', '', '', 1489103361, 1, '41'),
(392, 'parent', 'centre', 13, 13, 1, 'groupe', '1-1,1-2', '', '<p><span style="color: #ff0000;"><strong>Merci de votre pr&eacute;sence.</strong></span><br /><span style="color: #ff0000;"><strong>merci 1000 fois.</strong></span></p>', 'left', '', '', 1489265570, 1, '54,55,56,53,51,50,52,59,58'),
(394, 'parent', 'prof', 41, 13, 1, 'groupe', '1-1', 'Français', '<p>R&eacute;vision ....</p>', 'left', '', '', 1489266768, 1, '55,56,50,51,52,53,54,58,59'),
(395, 'prof', 'centre', 13, 13, 1, 'matiere', '4', '', '<p>R&eacute;union Samedi &agrave; 9h pour ....</p>', 'left', '', '', 1489267110, 1, '41,45'),
(396, 'parent', 'prof', 42, 13, 1, 'groupe', '1-1', 'النشاط العلمي', 'Faite', 'left', '148931127942.jpg', 'image', 1489311279, 1, '56,52,54,55,50,58,59'),
(397, 'parent', 'prof', 43, 13, 1, 'groupe', '1-1', 'العربية', 'انجاز تمرين التراكيب رقم 2 الصفحة 25', 'left', '', '', 1489311327, 1, '52,55,50,54,56,59,58'),
(398, 'parent', 'prof', 44, 13, 1, 'groupe', '1-1', 'الاجتماعيات', '<p dir="rtl">السلام عليكم، تقديم العروض يوم الجمعة&nbsp;</p>', 'left', '', '', 1489311384, 1, '52,55,50,56,54,59,58'),
(399, 'parent', 'prof', 47, 13, 1, 'groupe', '1-1', 'Maths', 'Les contrôles sont prévus le 23/3/2017<div>Bonne réception&nbsp;</div>', 'left', '', '', 1489311434, 1, '52,55,56,50,59,54,58'),
(400, 'parent', 'prof', 46, 13, 1, 'groupe', '1-1,1-2,2-1,3-1,4-3', 'الرياضيات', 'Je suis votre nouveau prof&nbsp;', 'left', '148931145646.jpg', 'image', 1489311456, 1, '59,52,56,50,55,58,54,51'),
(401, 'parent', 'prof', 45, 13, 1, 'groupe', '1-1', 'Français', 'Faire les exercices 1et 2 p23', 'left', '', '', 1489311468, 1, '52,50,56,55,58,54,59'),
(402, 'parent', 'prof', 48, 13, 1, 'groupe', '1-1', 'Education physique et sportive', 'Merci d''inciter vogre dnfant á faire ses devoirs', 'left', '', '', 1489311632, 1, '52,50,56,55,58,59'),
(403, 'prof', 'centre', 13, 13, 1, 'all', 'all', '', '<p>Bonjour messieurs.</p>\r\n<p>Est ce que vous avez bien dormi ?</p>', 'left', '', '', 1489312448, 1, '48,44,47,45,43,46,42'),
(426, 'parent', 'prof', 46, 13, 1, 'groupe', '1-1', 'Maths', 'Essai tawassol', 'left', '', '', 1489319127, 0, ''),
(428, 'parent', 'prof', 56, 17, 1, 'groupe', '4-1,4-2,4-3', 'Informatique', 'Reste informatique<div>Test23&nbsp;</div>', 'left', '', '', 1489351606, 1, ''),
(429, 'parent', 'centre', 17, 17, 1, 'parent', '67', '', '<div style="text-align: left;">\r\n<p style="text-align: center;"><span style="color: #ff0000;"><strong>Pr&eacute;paration aux contr&ocirc;les continus</strong></span></p>\r\n<br />\r\n<p>Chers parents<br /> Nous portons &agrave; votre connaissance que les contr&ocirc;les continus auront lieu du 20 au 27 Janvier.<br /> Une bonne pr&eacute;paration s&rsquo;impose pour un meilleur r&eacute;sultat.</p>\r\n</div>', 'left', '', '', 1489352601, 1, '67'),
(430, 'parent', 'centre', 17, 17, 1, 'parent', '66,67', '', '<div style="text-align: left;">\r\n<p style="text-align: center;"><span style="color: #ff0000;"><strong>Comportement inadmissible</strong></span></p>\r\n<br />\r\n<p><strong>&nbsp;</strong>Nous portons &agrave; votre connaissance que l&rsquo;&eacute;l&egrave;ve Oussama Saad, lors de la s&eacute;ance de Maths du 14 F&eacute;vrier, s&rsquo;est conduit de mani&egrave;re inacceptable.<br /> Suite &agrave; ce comportement, nous vous prions de se rendre &agrave; l&rsquo;&eacute;tablissement dans les plus brefs d&eacute;lais.</p>\r\n</div>', 'left', '', '', 1489352850, 1, '66,67'),
(431, 'prof', 'centre', 17, 17, 1, 'prof', '56', '', '<p dir="rtl" style="text-align: center;"><span style="color: #ff0000;"><strong>الإعداد لامتحانات الأسدس الأول</strong></span></p>\r\n<p>&nbsp;</p>\r\n<p dir="rtl"><strong>&nbsp;</strong>السادة الأساتذة</p>\r\n<p>&nbsp;</p>\r\n<p dir="rtl">في إطار الإعداد لامتحانات الأسدس الأول، ندعو هيئة تدريس المستوى الإبتدائي للإجتماع يوم السبت 2 يناير على الساعة 9 صباحا.</p>\r\n<p>&nbsp;</p>\r\n<p dir="rtl" style="text-align: right;">حضوركم ضروري ومؤكد.</p>', 'left', '', '', 1489352998, 1, '56'),
(432, 'parent', 'prof', 56, 17, 1, 'groupe', '5-1,6-2', 'Informatique', 'Jfufufufufuf', 'left', '', '', 1489353093, 1, '67,66'),
(433, 'parent', 'centre', 9, 9, 1, 'parent', '70', '', '<p>Bonjour Douaa</p>', 'left', '', '', 1489699037, 1, '70'),
(434, 'parent', 'centre', 9, 9, 1, 'parent', '70', '', '<p>Bonjour Douaa</p>', 'left', '', '', 1489699077, 1, '70'),
(435, 'parent', 'centre', 20, 20, 1, 'all', 'all', '', '<div style="text-align: left;">\r\n<p style="text-align: center;"><span style="color: #ff0000;"><strong>Pr&eacute;paration aux contr&ocirc;les continus</strong></span></p>\r\n<br />\r\n<p>Chers parents<br /> Nous portons &agrave; votre connaissance que les contr&ocirc;les continus auront lieu du 20 au 27 Janvier.<br /> Une bonne pr&eacute;paration s&rsquo;impose pour un meilleur r&eacute;sultat.</p>\r\n</div>', 'left', '', '', 1489699646, 1, '71'),
(436, 'parent', 'centre', 20, 20, 1, 'all', 'all', '', '<div style="text-align: left;">\r\n<p style="text-align: center;"><span style="color: #ff0000;"><strong>Sortie de divertissement</strong></span></p>\r\n<br />\r\n<p>Chers parents<br /> Nous portons &agrave; votre connaissance que notre &eacute;tablissement organise, le vendredi 14 Avril, une sortie de divertissement au Cascade d&rsquo;Ouzoud.<br /> La cotisation est fix&eacute;e &agrave; 150 dh.<br /> Le dernier d&eacute;lai de participation est le 10 Avril.</p>\r\n</div>', 'left', '', '', 1489699900, 1, '71'),
(437, 'parent', 'centre', 20, 20, 1, 'all', 'all', '', '<div style="text-align: left;">\r\n<p style="text-align: center;"><span style="color: #ff0000;"><strong>Comportement inadmissible</strong></span></p>\r\n<br />\r\n<p><strong>&nbsp;</strong>Nous portons &agrave; votre connaissance que l&rsquo;&eacute;l&egrave;ve Oussama Saad, lors de la s&eacute;ance de Maths du 14 F&eacute;vrier, s&rsquo;est conduit de mani&egrave;re inacceptable.<br /> Suite &agrave; ce comportement, nous vous prions de se rendre &agrave; l&rsquo;&eacute;tablissement dans les plus brefs d&eacute;lais.</p>\r\n</div>', 'left', '', '', 1489700788, 1, '71'),
(438, 'parent', 'centre', 19, 19, 1, 'all', 'all', '', '<p>bien venu cher &eacute;l&egrave;ve dans notre espace num&eacute;rique</p>', 'left', '', '', 1489704792, 1, '72'),
(439, 'parent', 'centre', 19, 19, 1, 'all', 'all', '', '<p>سيدتي، سيدي تنظم إدارة المؤسسة خرجة ترفيهية إلى منتجع إفران وذلك يوم الجمعة 14 أبريل. حدد ثمن الرحلة في 150 درهم. آخر أجل للأداء هو 10 أبريل.</p>', 'left', '8.png', 'image', 1489705132, 1, '72'),
(440, 'parent', 'centre', 9, 9, 1, 'parent', '73', '', '<p>Bonjour Mini</p>', 'left', '', '', 1489713595, 1, '73'),
(441, 'parent', 'centre', 9, 9, 1, 'parent', '73', '', '<p>P.jointd 1</p>', 'left', 'images_(1).png', 'image', 1489713820, 1, '73'),
(442, 'parent', 'centre', 20, 20, 2, 'all', 'all', '', '<div style="text-align: left;">\r\n<p style="text-align: center;"><span style="color: #ff0000;"><strong>Sortie de divertissement</strong></span></p>\r\n<br />\r\n<p>Chers parents<br /> Nous portons &agrave; votre connaissance que notre &eacute;tablissement organise, le vendredi 14 Avril, une sortie de divertissement au Cascade d&rsquo;Ouzoud.<br /> La cotisation est fix&eacute;e &agrave; 150 dh.<br /> Le dernier d&eacute;lai de participation est le 10 Avril.</p>\r\n</div>', 'left', '', '', 1489780081, 1, '74'),
(443, 'parent', 'centre', 20, 20, 1, 'all', 'all', '', '<div style="text-align: left;">\r\n<p style="text-align: center;"><span style="color: #ff0000;"><strong>Comportement inadmissible</strong></span></p>\r\n<br />\r\n<p><strong>&nbsp;</strong>Nous portons &agrave; votre connaissance que l&rsquo;&eacute;l&egrave;ve Oussama Saad, lors de la s&eacute;ance de Maths du 14 F&eacute;vrier, s&rsquo;est conduit de mani&egrave;re inacceptable.<br /> Suite &agrave; ce comportement, nous vous prions de se rendre &agrave; l&rsquo;&eacute;tablissement dans les plus brefs d&eacute;lais.</p>\r\n</div>', 'left', '1489780115468-622815342.jpg', 'image', 1489780269, 1, '71'),
(444, 'parent', 'centre', 20, 20, 1, 'all', 'all', '', '<div style="text-align: left;">\r\n<p style="text-align: center;"><span style="color: #ff0000;"><strong>Comportement inadmissible</strong></span></p>\r\n<br />\r\n<p><strong>&nbsp;</strong>Nous portons &agrave; votre connaissance que l&rsquo;&eacute;l&egrave;ve Oussama Saad, lors de la s&eacute;ance de Maths du 14 F&eacute;vrier, s&rsquo;est conduit de mani&egrave;re inacceptable.<br /> Suite &agrave; ce comportement, nous vous prions de se rendre &agrave; l&rsquo;&eacute;tablissement dans les plus brefs d&eacute;lais.</p>\r\n</div>', 'left', '1489780115468-6228153421.jpg', 'image', 1489780365, 1, '71'),
(445, 'parent', 'centre', 1, 1, 1, 'parent', '76', '', '<p>Push notification 001</p>', 'left', '', '', 1489797920, 1, ''),
(448, 'parent', 'centre', 1, 1, 1, 'groupe', '1-1', '', '<p>Push notification 002</p>', 'left', '', '', 1489798676, 1, ''),
(449, 'parent', 'centre', 1, 1, 1, 'classe', '1', '', '<p>Push notification 003</p>', 'left', '', '', 1489798706, 1, ''),
(450, 'parent', 'centre', 1, 1, 1, 'all', 'all', '', '<p>Push notification 004</p>', 'left', '', '', 1489798807, 1, ''),
(451, 'parent', 'centre', 1, 1, 1, 'all', 'all', '', '<p>Push notification 006</p>', 'left', '', '', 1489798881, 1, '76'),
(452, 'parent', 'centre', 1, 1, 1, 'groupe', '1-1', '', '<p>tetst</p>', 'left', '', '', 1489799019, 1, ''),
(453, 'parent', 'centre', 1, 1, 1, 'groupe', '1-1', '', '<p>test msg groupe</p>', 'left', '', '', 1489799290, 1, ''),
(454, 'parent', 'centre', 1, 1, 1, 'classe', '1', '', '<p>test message classe</p>', 'left', '', '', 1489799321, 1, ''),
(455, 'parent', 'centre', 1, 1, 1, 'groupe', '2-1', '', '<p>zezrt</p>', 'left', '', '', 1489799342, 1, ''),
(456, 'parent', 'centre', 1, 1, 1, 'classe', '2', '', '<p>jzg</p>', 'left', '', '', 1489799355, 1, ''),
(457, 'parent', 'centre', 1, 1, 1, 'all', 'all', '', '<p>teset</p>', 'left', '', '', 1489799369, 1, ''),
(458, 'parent', 'centre', 1, 1, 1, 'all', 'all', '', '<p>test all</p>', 'left', '', '', 1489799400, 1, ''),
(459, 'parent', 'prof', 57, 1, 1, 'groupe', '1-1', 'Français', '<p>test message prof</p>', 'left', '', '', 1489800467, 1, ''),
(460, 'parent', 'prof', 57, 1, 1, 'groupe', '1-1', 'Français', '<p>auto envoi</p>', 'left', '', '', 1489800975, 1, ''),
(461, 'parent', 'prof', 57, 1, 1, 'groupe', '1-1', 'الرياضيات', '<p>Bla Bla bla prof...</p>', 'left', '', '', 1489801319, 1, '76'),
(462, 'parent', 'prof', 57, 1, 1, 'groupe', '1-1', 'الرياضيات', '<p>Salut tous les parent nous somme heureux de vous acceuire dans notre eatblisssement</p>', 'left', '', '', 1489801623, 1, '76'),
(463, 'prof', 'centre', 1, 1, 1, 'prof', '57', '', '<p>test notif push 001</p>', 'left', '', '', 1489832611, 1, ''),
(464, 'parent', 'centre', 1, 1, 1, 'all', 'all', '', '<p>test notif push 001</p>', 'left', '', '', 1489832648, 1, ''),
(465, 'parent', 'centre', 1, 1, 1, 'all', 'all', '', '<p>test notif push 001</p>', 'left', '', '', 1489832704, 1, ''),
(466, 'parent', 'centre', 1, 1, 1, 'all', 'all', '', '<p>test notif push 001</p>', 'left', '', '', 1489832873, 1, ''),
(467, 'parent', 'centre', 1, 1, 1, 'all', 'all', '', '<p>test notif push 001</p>', 'left', '', '', 1489832881, 1, ''),
(468, 'prof', 'centre', 1, 1, 1, 'matiere', '6', '', '<p>test notif push 002</p>', 'left', '', '', 1489832918, 1, ''),
(469, 'prof', 'centre', 1, 1, 1, 'matiere', '6', '', '<p>test notif push 002</p>', 'left', '', '', 1489832961, 1, ''),
(470, 'prof', 'centre', 1, 1, 1, 'matiere', '6', '', '<p>test notif push 002</p>', 'left', '', '', 1489833099, 1, ''),
(471, 'prof', 'centre', 1, 1, 1, 'groupe', '1-1', '', '<p>test notif push 003</p>', 'left', '', '', 1489833127, 1, ''),
(472, 'prof', 'centre', 1, 1, 1, 'groupe', '1-1', '', '<p>test notif push 003</p>', 'left', '', '', 1489833435, 1, ''),
(473, 'prof', 'centre', 1, 1, 1, 'classe', '1', '', '<p>test notif push 004</p>', 'left', '', '', 1489833463, 1, ''),
(474, 'prof', 'centre', 1, 1, 1, 'classe', '1', '', '<p>test notif push 004</p>', 'left', '', '', 1489833671, 1, ''),
(475, 'prof', 'centre', 1, 1, 1, 'classe', '1', '', '<p>test</p>', 'left', '', '', 1489833695, 1, ''),
(476, 'prof', 'centre', 1, 1, 1, 'classe', '1', '', '<p>test</p>', 'left', '', '', 1489833737, 1, ''),
(477, 'prof', 'centre', 1, 1, 1, 'all', 'all', '', '<p>tous</p>', 'left', '', '', 1489833760, 1, ''),
(478, 'prof', 'centre', 1, 1, 1, 'all', 'all', '', '<p>tous</p>', 'left', '', '', 1489833777, 1, ''),
(479, 'prof', 'centre', 1, 1, 1, 'all', 'all', '', '<p>tous</p>', 'left', '', '', 1489833910, 1, ''),
(480, 'prof', 'centre', 1, 1, 2, 'all', 'all', '', '<p>ztrrd</p>', 'left', '', '', 1489833963, 1, ''),
(481, 'prof', 'centre', 1, 1, 2, 'all', 'all', '', '<p>ztrrd</p>', 'left', '', '', 1489833997, 1, ''),
(482, 'prof', 'centre', 1, 1, 3, 'all', 'all', '', '<p>lycee</p>', 'left', '', '', 1489834020, 1, ''),
(483, 'prof', 'centre', 1, 1, 1, 'all', 'all', '', '<p>primaire</p>', 'left', '', '', 1489834046, 1, ''),
(484, 'prof', 'centre', 1, 1, 1, 'classe', '2', '', '<p>test</p>', 'left', '', '', 1489834064, 1, ''),
(485, 'prof', 'centre', 1, 1, 1, 'matiere', '3', '', '<p>test</p>', 'left', '', '', 1489834082, 1, ''),
(486, 'prof', 'centre', 1, 1, 1, 'classe', '1,2,3', '', '<p>trdt</p>', 'left', '', '', 1489834099, 1, ''),
(487, 'prof', 'centre', 1, 1, 1, 'matiere', '2,6', '', '<p>test</p>', 'left', '', '', 1489834123, 1, ''),
(488, 'prof', 'centre', 1, 1, 1, 'matiere', '6,7,4', '', '<p>test</p>', 'left', '', '', 1489834144, 1, ''),
(489, 'parent', 'prof', 57, 1, 1, 'groupe', '1-1', 'الرياضيات', 'The first time in the&nbsp;', 'left', '', '', 1489834238, 1, ''),
(490, 'prof', 'centre', 1, 1, 1, 'all', 'all', '', '<p>test 0020</p>', 'left', '', '', 1489834647, 1, ''),
(491, 'prof', 'centre', 1, 1, 1, 'all', 'all', '', '<p>test 0020</p>', 'left', '', '', 1489834662, 1, ''),
(494, 'parent', 'prof', 46, 13, 1, 'groupe', '1-1', 'الرياضيات', 'Exercice n 3 page 53', 'left', '', '', 1489865346, 0, ''),
(495, 'parent', 'centre', 20, 20, 1, 'all', 'all', '', '<div style="text-align: left;">\r\n<p style="text-align: center;"><span style="color: #ff0000;"><strong>Sortie de divertissement</strong></span></p>\r\n<br />\r\n<p>Chers parents<br /> Nous portons &agrave; votre connaissance que notre &eacute;tablissement organise, le vendredi 14 Avril, une sortie de divertissement au Cascade d&rsquo;Ouzoud.<br /> La cotisation est fix&eacute;e &agrave; 150 dh.<br /> Le dernier d&eacute;lai de participation est le 10 Avril.</p>\r\n</div>', 'left', '', '', 1489872145, 1, '71'),
(496, 'parent', 'centre', 1, 1, 1, 'parent', '76', '', '<p>Notif</p>', 'left', '', '', 1489874429, 1, ''),
(497, 'parent', 'centre', 1, 1, 1, 'parent', '76', '', '<p>Essai notif l''inauguration, je vais m''en fous de votre part de march&eacute; de l''emploi</p>', 'left', '', '', 1489874491, 1, ''),
(498, 'prof', 'centre', 1, 1, 1, 'all', 'all', '', '<p>Prof notif de la semaine prochaine</p>', 'left', '', '', 1489874612, 1, ''),
(500, 'parent', 'prof', 57, 1, 1, 'groupe', '1-1', 'Français', 'And then we have been&nbsp;', 'left', '', '', 1489920426, 1, ''),
(501, 'prof', 'centre', 1, 1, 1, 'all', 'all', '', '<p>test 001</p>', 'left', '', '', 1489921142, 1, ''),
(502, 'prof', 'centre', 1, 1, 1, 'all', 'all', '', '<p>test 001</p>', 'left', '', '', 1489921157, 1, ''),
(503, 'prof', 'centre', 1, 1, 1, 'all', 'all', '', '<p>test 001</p>', 'left', '', '', 1489921177, 1, ''),
(504, 'prof', 'centre', 1, 1, 1, 'all', 'all', '', '<p>test 001</p>', 'left', '', '', 1489921257, 1, ''),
(505, 'prof', 'centre', 1, 1, 1, 'all', 'all', '', '<p>test 001</p>', 'left', '', '', 1489921262, 1, ''),
(506, 'prof', 'centre', 1, 1, 1, 'all', 'all', '', '<p>test 001</p>', 'left', '', '', 1489921299, 1, ''),
(507, 'prof', 'centre', 1, 1, 1, 'all', 'all', '', '<p>test 001</p>', 'left', '', '', 1489921330, 1, ''),
(508, 'prof', 'centre', 1, 1, 1, 'all', 'all', '', '<p>test 001</p>', 'left', '', '', 1489921338, 1, ''),
(509, 'prof', 'centre', 1, 1, 1, 'all', 'all', '', '<p>test 001</p>', 'left', '', '', 1489921349, 1, ''),
(510, 'prof', 'centre', 1, 1, 1, 'all', 'all', '', '<p>test 001</p>', 'left', '', '', 1489921422, 1, ''),
(511, 'prof', 'centre', 1, 1, 1, 'all', 'all', '', '<p>test 001</p>', 'left', '', '', 1489921434, 1, ''),
(512, 'prof', 'centre', 1, 1, 1, 'all', 'all', '', '<p>test 001</p>', 'left', '', '', 1489921444, 1, ''),
(513, 'prof', 'centre', 1, 1, 1, 'all', 'all', '', '<p>test 001</p>', 'left', '', '', 1489921463, 1, ''),
(514, 'parent', 'centre', 9, 9, 1, 'all', 'all', '', '<p>Bienvenu.....</p>', 'left', '', '', 1489937119, 1, '77,79,80'),
(515, 'parent', 'centre', 9, 9, 1, 'all', 'all', '', '<p>test</p>', 'left', '', '', 1489939262, 1, '79'),
(516, 'parent', 'centre', 20, 20, 1, 'all', 'all', '', '<p>HELLO</p>', 'left', '', '', 1489939492, 1, ''),
(517, 'parent', 'centre', 20, 20, 1, 'parent', '71', '', '<p>hihi</p>', 'left', '', '', 1489939593, 1, ''),
(518, 'parent', 'centre', 9, 9, 1, 'all', 'all', '', '<h2 class="content-header-title">Communiquer avec les parents</h2>', 'left', '', '', 1489939832, 1, '80,79,76'),
(519, 'parent', 'prof', 33, 9, 1, 'groupe', '1-1', 'Français', '<p>test</p>', 'left', '', '', 1489943438, 1, ''),
(520, 'parent', 'prof', 34, 9, 1, 'groupe', '1-1', 'Maths', 'Bonjour Monsieur&nbsp;', 'left', '', '', 1489944131, 1, ''),
(521, 'parent', 'prof', 34, 9, 1, 'groupe', '1-1', 'Maths', 'Merci&nbsp;', 'left', '', '', 1489944176, 1, ''),
(522, 'parent', 'prof', 59, 9, 1, 'groupe', '1-1', 'Education physique et sportive', 'Hgff', 'left', '', '', 1489945888, 1, ''),
(523, 'parent', 'prof', 59, 9, 1, 'groupe', '1-1', 'Education physique et sportive', 'Jffjk', 'left', '', '', 1489946695, 1, ''),
(524, 'parent', 'prof', 33, 9, 1, 'groupe', '1-1', 'Français', 'Hhhg', 'left', '148994778233.jpg', 'image', 1489947782, 1, ''),
(525, 'parent', 'prof', 33, 9, 1, 'groupe', '1-1', 'Français', 'Je c', 'left', '148994805833.jpg', 'image', 1489948058, 1, ''),
(526, 'prof', 'centre', 9, 9, 1, 'all', 'all', '', '<p>test</p>', 'left', '', '', 1489948879, 1, '38,33'),
(527, 'parent', 'prof', 38, 9, 1, 'groupe', '1-1', 'Anglais', 'Hdhxxkc', 'left', '', '', 1489949242, 1, ''),
(528, 'parent', 'prof', 38, 9, 1, 'groupe', '1-1', 'Anglais', 'Jhvh', 'left', '', '', 1489949417, 1, ''),
(529, 'parent', 'centre', 23, 23, 1, 'parent', '81', '', '<p>Bonjour ilham</p>', 'left', '', '', 1489953527, 1, '81'),
(530, 'parent', 'prof', 60, 23, 1, 'groupe', '4-1', 'Français', 'Ostad', 'left', '', '', 1489953962, 0, ''),
(531, 'prof', 'centre', 23, 23, 1, 'all', 'all', '', '<p>Bonjour prof</p>', 'left', '', '', 1489954167, 1, '60,61,63,64'),
(534, 'parent', 'centre', 23, 23, 1, 'classe', '4', '', '<p>Chers parents<br />Bienvenus sur TawassolApp</p>', 'left', '', '', 1490196072, 1, '82,87,88'),
(535, 'parent', 'prof', 63, 23, 1, 'groupe', '4-1', 'الرياضيات', '<p dir="rtl">-أراجع دروس الأعداد العشرية&nbsp;<div>-أنجز تمارين الكراسة، صفحة 82 رقم 1.</div></p>', 'left', '', '', 1490196199, 1, '82,87,88'),
(536, 'parent', 'centre', 23, 23, 1, 'classe', '4', '', '<div style="text-align: left;">\r\n<p style="text-align: left;">Nous portons &agrave; votre connaissance que les contr&ocirc;les continus auront lieu du 20 au 27 Janvier.<br /> Une bonne pr&eacute;paration s&rsquo;impose pour un meilleur r&eacute;sultat.</p>\r\n</div>', 'left', '', '', 1490196335, 1, '82,87,88'),
(537, 'parent', 'prof', 64, 23, 1, 'groupe', '4-1', 'Français', 'Je révise le passé simple des verbes du 1er groupe.', 'left', '', '', 1490196549, 1, '82,87,88'),
(539, 'prof', 'centre', 23, 23, 1, 'all', 'all', '', '<p>salut profs</p>', 'left', '', '', 1490197012, 1, '63,64'),
(541, 'parent', 'centre', 23, 23, 1, 'classe', '4', '', '<div style="text-align: left;">\r\n<p style="text-align: left;">Une sortie de divertissement sera organis&eacute;e le vendredi 14 Avril au Cascade d&rsquo;Ouzoud.<br /> La cotisation est fix&eacute;e &agrave; 150 dh.<br /> Le dernier d&eacute;lai de participation est le 10 Avril.</p>\r\n</div>', 'left', '', '', 1490197391, 1, '82,87,88'),
(547, 'parent', 'centre', 23, 23, 1, 'parent', '87', '', '<p>bonjour mini</p>', 'left', '', '', 1490279776, 1, '87'),
(548, 'parent', 'centre', 23, 23, 1, 'parent', '87', '', '<p>test 2</p>', 'left', '', '', 1490279920, 1, '87'),
(553, 'prof', 'centre', 23, 23, 1, 'matiere', '7', '', '<p>maths admi</p>', 'left', '', '', 1490280458, 1, '63'),
(554, 'prof', 'centre', 23, 23, 1, 'matiere', '7', '', '<p>p, joint amth</p>', 'left', 'Sans_titre3.png', 'image', 1490280510, 1, '63'),
(555, 'parent', 'centre', 23, 23, 1, 'parent', '88', '', '<p>kkkk</p>', 'left', 'Sans_titre4.png', 'image', 1490282219, 1, '88'),
(556, 'parent', 'prof', 64, 23, 1, 'groupe', '4-1', 'Français', 'Frrrrrr', 'left', '149028255764.jpg', 'image', 1490282557, 1, '88'),
(557, 'parent', 'centre', 23, 23, 1, 'parent', '88', '', '<p>ddfdsf</p>', 'left', 'Carte_de_visite.docx', 'notImage', 1490282694, 1, '88'),
(558, 'parent', 'prof', 56, 17, 1, 'groupe', '5-1,5-2', 'Informatique', 'Jfufududufuf', 'left', '', '', 1490290854, 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `modeles_messages`
--

CREATE TABLE IF NOT EXISTS `modeles_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) CHARACTER SET latin1 NOT NULL,
  `align` varchar(10) CHARACTER SET latin1 NOT NULL,
  `title` varchar(400) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- Contenu de la table `modeles_messages`
--

INSERT INTO `modeles_messages` (`id`, `type`, `align`, `title`, `content`) VALUES
(49, 'ecole-to-prof', 'left', 'Préparation à la nouvelle année scolaire', '<p style="text-align: center;"><span style="color: #ff0000;"><strong>Pr&eacute;paration &agrave; la nouvelle ann&eacute;e scolaire</strong></span></p>\n<p><strong>&nbsp;</strong>Mes dames, demoiselles et messieurs</p>\n<p>Pour entreprendre une bonne pr&eacute;paration &agrave; la nouvelle ann&eacute;e scolaire, nous invitons le corps enseignant du primaire &agrave; une r&eacute;union le Samedi 2 Septembre &agrave; 9 heures.<br />Votre pr&eacute;sence est capitale.</p>'),
(50, 'ecole-to-prof', 'left', 'الإعداد لامتحانات الأسدس الأول', '<p dir="rtl" style="text-align: center;"><span style="color: #ff0000;"><strong>الإعداد لامتحانات الأسدس الأول</strong></span></p>\n<p dir="rtl"><strong>&nbsp;</strong>السادة الأساتذة</p>\n<p dir="rtl">في إطار الإعداد لامتحانات الأسدس الأول، ندعو هيئة تدريس المستوى الإبتدائي للإجتماع يوم السبت 2 يناير على الساعة 9 صباحا.</p>\n<p dir="rtl" style="text-align: right;">حضوركم ضروري ومؤكد.</p>'),
(51, 'prof-to-parent', 'left', 'تمارين داعمة في مادة الرياضيات', '<p dir="rtl" style="text-align: center;"><span style="color: #ff00ff;"><strong>تمارين داعمة في مادة الرياضيات</strong></span></p>\n<p dir="rtl"><strong>&nbsp;</strong>أنجز التمارين التالية :</p>\n<p dir="rtl">كراسة الرياضيات.</p>\n<p dir="rtl">درس المستقيم والقطعة.</p>\n<p dir="rtl">ص 65.</p>\n<p dir="rtl">تمارين 2 و3.</p>'),
(52, 'prof-to-parent', 'left', 'استعداد للمراقبة المستمرة في مادة اللغة العربية', '<p dir="rtl" style="text-align: center;"><span style="color: #0000ff;"><strong>استعداد للمراقبة المستمرة في مادة اللغة العربية</strong></span></p>\n<p dir="rtl" style="text-align: right;"><strong>&nbsp;</strong>استعدادا للمراقبة المستمرة في مادة اللغة العربية، أراجع الدروس التالية:</p>\n<p dir="rtl">- التراكيب: كان وأخواتها</p>\n<p dir="rtl">- الصرف والتحويل: الضمائر المتصلة والضمائر المنفصلة</p>\n<p dir="rtl" style="text-align: right;">- الإملاء: الهمزة المتوسطة على الواو وعلى الياء</p>\n<p dir="rtl">&nbsp;</p>'),
(53, 'prof-to-parent', 'left', 'Exercices de renforcement en Maths', '<p style="text-align: center;"><span style="color: #ff00ff;"><strong>Exercices de renforcement en Maths</strong></span></p>\n<p><strong>&nbsp;</strong>- J&rsquo;apprends la table de multiplication&nbsp;: de 1 &agrave; 9</p>\n<p>- Je fais mes devoirs de (voir le porte-documents)</p>\n<p>- Je fais l&rsquo;exercice N&deg;4 - Page 60 du manuel scolaire des Maths</p>'),
(54, 'prof-to-parent', 'left', 'Préparation aux contrôles continus', '<p style="text-align: center;"><span style="color: #ff00ff;"><strong>Pr&eacute;paration aux contr&ocirc;les continus</strong></span></p>\n<p>&nbsp;En pr&eacute;paration aux contr&ocirc;les continus, je r&eacute;vise&nbsp;les le&ccedil;ons suivantes&nbsp;:</p>\n<ul>\n<li>Grammaire&nbsp;: les d&eacute;terminants et les adverbes</li>\n<li>Conjugaison&nbsp;: l&rsquo;imparfait et le futur des verbes du 1<sup>er</sup> et 2<sup>&egrave;me</sup></li>\n<li>Vocabulaire&nbsp;: les mots g&eacute;n&eacute;riques</li>\n<li>Orthographe&nbsp;: les homophones grammaticaux (ces/ses &ndash; mes/mais)</li>\n</ul>'),
(63, 'ecole-to-prof', 'left', 'Evaluation des résultats scolaires', '<p style="text-align: center;"><strong><span style="color: #ff0000;">Evaluation des r&eacute;sultats scolaires</span></strong></p>\n<p>Mes dames, demoiselles et messieurs<br /> A l&rsquo;issu des examens du 1<sup>er</sup> semestre et pour &eacute;valuer les performances des &eacute;l&egrave;ves, nous invitons le corps enseignant du primaire &agrave; une r&eacute;union le Samedi 2 F&eacute;vrier &agrave; 9 heures.<br /> Votre pr&eacute;sence est capitale.</p>'),
(65, 'ecole-to-parent', 'left', 'Préparation aux contrôles continus', '<p style="text-align: center;"><span style="color: #ff0000;"><strong>Pr&eacute;paration aux contr&ocirc;les continus</strong></span></p>\n<p>Chers parents<br /> Nous portons &agrave; votre connaissance que les contr&ocirc;les continus auront lieu du 20 au 27 Janvier.<br /> Une bonne pr&eacute;paration s&rsquo;impose pour un meilleur r&eacute;sultat.</p>'),
(66, 'ecole-to-parent', 'left', 'إخبار بامتحانات المراقبة المستمرة الأولى', '<p style="text-align: center;"><strong><span style="color: #ff0000;">إخبار بامتحانات المراقبة المستمرة الأولى</span><br /> <br /> </strong></p>\n<p dir="rtl">نحيط الأمهات والآباء والأولياء الأعزاء علما أن امتحانات المراقبة المستمرة الأولى ستجرى في الفترة الممتدة من 20 إلى 27 يناير.<br /> لذلك وجب الإعداد بشكل جيد لبلوغ النتائج المرجوة.</p>'),
(67, 'ecole-to-parent', 'left', 'إشعار بسلوك غير مقبول', '<p style="text-align: center;"><span style="color: #ff0000;"><strong>إشعار بسلوك غير مقبول</strong></span></p>\n<p dir="rtl"><strong><br /> </strong>سيدتي، سيدي<br /> يؤسفنا إخباركم أن التلميذ أسامة سعد، أثناء حصة الرياضيات بتاريخ 14 فبراير، قد صدر منه سلوك غير مقبول وتصرف يستدعي التبرير.<br /> لذلك، ندعوكم للإلتحاق بالمؤسسة في أقرب الآجال لمعالجة الموضوع.</p>'),
(68, 'ecole-to-parent', 'left', 'Comportement inadmissible', '<p style="text-align: center;"><span style="color: #ff0000;"><strong>Comportement inadmissible</strong></span></p>\n<p><strong>&nbsp;</strong>Nous portons &agrave; votre connaissance que l&rsquo;&eacute;l&egrave;ve Oussama Saad, lors de la s&eacute;ance de Maths du 14 F&eacute;vrier, s&rsquo;est conduit de mani&egrave;re inacceptable.<br /> Suite &agrave; ce comportement, nous vous prions de se rendre &agrave; l&rsquo;&eacute;tablissement dans les plus brefs d&eacute;lais.</p>'),
(69, 'ecole-to-parent', 'left', 'رحلة ترفيهية', '<p style="text-align: center;"><span style="color: #ff0000;"><strong>رحلة ترفيهية</strong></span>&nbsp;</p>\n<p dir="rtl">سيدتي، سيدي<br /> تنظم إدارة المؤسسة خرجة ترفيهية إلى منتجع إفران وذلك يوم الجمعة 14 أبريل.<br /> حدد ثمن الرحلة في 150 درهم.<br /> آخر أجل للأداء هو 10 أبريل.</p>'),
(70, 'ecole-to-parent', 'left', 'Sortie de divertissement', '<p style="text-align: center;"><span style="color: #ff0000;"><strong>Sortie de divertissement</strong></span></p>\n<p>Chers parents<br /> Nous portons &agrave; votre connaissance que notre &eacute;tablissement organise, le vendredi 14 Avril, une sortie de divertissement au Cascade d&rsquo;Ouzoud.<br /> La cotisation est fix&eacute;e &agrave; 150 dh.<br /> Le dernier d&eacute;lai de participation est le 10 Avril.</p>');

-- --------------------------------------------------------

--
-- Structure de la table `probleme`
--

CREATE TABLE IF NOT EXISTS `probleme` (
  `idProbleme` int(11) NOT NULL AUTO_INCREMENT,
  `from` varchar(20) NOT NULL,
  `idFrom` int(11) NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `file` text CHARACTER SET utf8 NOT NULL,
  `state` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`idProbleme`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `probleme`
--

INSERT INTO `probleme` (`idProbleme`, `from`, `idFrom`, `content`, `file`, `state`, `time`) VALUES
(3, 'centre', 1, 'école al jisr\r\npb rezrtert.', 'img.png', 0, 1487280061),
(4, 'Representant', 10, 'Rep mhamed', '', 0, 1487294414),
(10, 'centre', 9, 'kjhjj', '', 1, 1488943333);

-- --------------------------------------------------------

--
-- Structure de la table `prof`
--

CREATE TABLE IF NOT EXISTS `prof` (
  `idProf` int(11) NOT NULL AUTO_INCREMENT,
  `idCentre` int(11) NOT NULL,
  `nom` varchar(100) CHARACTER SET utf8 NOT NULL,
  `matieres` varchar(200) NOT NULL,
  `classe` varchar(100) NOT NULL,
  `niveau` varchar(10) NOT NULL,
  `photo` text CHARACTER SET utf8 NOT NULL,
  `tel` varchar(12) NOT NULL,
  `about` text CHARACTER SET utf8 NOT NULL,
  `fidele` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pwd` varchar(200) NOT NULL,
  `token` text NOT NULL,
  PRIMARY KEY (`idProf`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Contenu de la table `prof`
--

INSERT INTO `prof` (`idProf`, `idCentre`, `nom`, `matieres`, `classe`, `niveau`, `photo`, `tel`, `about`, `fidele`, `state`, `email`, `pwd`, `token`) VALUES
(7, 3, 'COLLEGE AMINE_prof', '24,25,26,28', '1:1,2:3,3:6', '2', '', '', '', 0, 1, '222222', '273a0c7bd3c679ba9a6f5d99078e36e85d02b952', ''),
(20, 6, 'Omar Mehdi', '29,30', '1:1,2:1,2:2', '2', '', '', '', 1, 1, '333', '43814346e21444aaf4f70841bf7ed5ae93f55a9d', ''),
(21, 6, 'Adam Yacoubi', '66,67', '11:1', '3', '', '', '', 1, 1, '5555555555', 'b7c40b9c66bc88d38a59e554c639d743e77f1b65', ''),
(23, 1, 'dwqdq qwdwq', '', '1:1', '2', '', '', '', 0, 1, '1234567890', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a', ''),
(25, 6, 'test prof', '31', '1:1', '2', '', '', '', 1, 1, '1111111111', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', ''),
(26, 6, 'jffy jffhdf', '40', '1:1', '2', '', '', '', 1, 1, '9999999999', '1f5523a8f535289b3401b29958d01b2966ed61d2', ''),
(27, 8, 'Ahmed Alaoui', '6,7', '4:1', '1', '', '', '', 1, 1, '0611223344', 'eb0df20ea58784518a9b84de863684b03846808d', ''),
(28, 8, 'Malika Zidoune', '1', '4:1', '1', '', '', '', 1, 1, '0707070710', 'fccca1b9e331e308d22de015fffb0feabc29b9fe', ''),
(29, 8, 'Brahim Salaki', '66,65', '11:1', '3', '', '', '', 1, 1, '0644444444', '59497f56ded94bfad6332878d3a59450dd58f6b1', ''),
(32, 8, 'Mohamed Ali', '23', '4:1,5:1,6:1,3:1', '1', '', '', '', 1, 1, '0622332233', '42cfe854913594fe572cb9712a188e829830291f', ''),
(33, 9, 'Leila Alaoui', '4', '1:1,1:2,4:1,4:2', '1', '', '', '', 1, 1, '0644332222', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 'cRA-3fuEQ2Y:APA91bEzRYP1nE13XAeIrH7N-5qRRHPEgACoJUr0lvLqdBwVCJWiW46YeoLAUvPVf-bSZD3rI35ETK-Kg6GaNK4Aowdm8gw8pHfuqy6gxIeNvDDdcaDrBNHoBXIg2X_P5uvufJNcBMR3'),
(34, 9, 'Ali Hassan', '7,6', '1:1,1:2,2:1,4:1,4:2,1:3', '1', '', '', '', 0, 1, '0655555555', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 'cRA-3fuEQ2Y:APA91bEzRYP1nE13XAeIrH7N-5qRRHPEgACoJUr0lvLqdBwVCJWiW46YeoLAUvPVf-bSZD3rI35ETK-Kg6GaNK4Aowdm8gw8pHfuqy6gxIeNvDDdcaDrBNHoBXIg2X_P5uvufJNcBMR3'),
(37, 6, 'Ugf Hgff', '2', '1:2,2:3', '1', '', '', '', 0, 1, '3536545454', '13f566a247aaf7dfd9cf0c8fa1ac5b140045f10a', ''),
(38, 9, 'Hassa Hossam', '19', '1:1,3:2,4:1,4:2,4:3,5:1', '1', '', '', '', 1, 1, '0633111111', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', 'ebvZVIPx8JI:APA91bEUCGPM2FxkYgJjXIgb-VO1NfYFyyQ-PbczJOdT4aRAz5ycNUGeY68kuI23xn5DTh1-lEL9P0uJN-7h2wI3hZCYanrVW8kEhiII0Y3ObEdqEUHrJqeYxxcnk11Yi3ZrXKlCvg60'),
(39, 11, 'Trd Jioyf', '9', '4:1', '1', '', '', '', 1, 1, '0999999999', '1f5523a8f535289b3401b29958d01b2966ed61d2', ''),
(40, 9, 'said said', '1,8', '1:2', '1', '', '', '', 0, 1, '0623234155', '1a911315ce82b6fcb4f7bc225084c01da0892e90', ''),
(42, 13, 'Said Tawassol', '8', '1:1,2:1', '1', '', '', '', 0, 1, '0670050567', '5827cf6a9159e741551d5fdf1a1a285e0ff144b5', ''),
(43, 13, 'Amine Prof', '1', '1:1', '1', '', '', '', 0, 1, '0655159236', 'f756fd7f412df88deeba8c9e99ad2e2acd9a4cba', ''),
(44, 13, 'Abderrazak Tanan', '3', '1:1', '1', '', '', '', 0, 1, '0671013420', 'dd3e509bb175922117b99282622ece8b866fefb7', ''),
(45, 13, 'Brahim Elhadim', '4,7', '1:1,2:2', '1', '', '', '', 0, 1, '0668642848', 'fb0bcd3b91d61bae8a596d947890a0a026739db4', ''),
(46, 13, 'Brahim Ait mouna', '6,7', '1:1,2:1,3:1,4:3,1:2', '1', '', '', '', 0, 1, '0666572573', '43123609a3232648db1c47c03632fb9f5c25ac85', ''),
(47, 13, 'Farid Tawassol', '6,7', '1:1,4:2,6:1', '1', '', '', '', 1, 1, '0666666666', '7c4a8d09ca3762af61e59520943dc26494f8941b', ''),
(48, 13, 'Hilal Zinbi', '10,7', '1:1,6:1', '1', '', '', '', 0, 1, '0661627510', '222e09ddfe052c6cb6ccb64dc917b89c1f54285f', ''),
(56, 17, 'Fatima  zahra Ait-tiga', '9', '2:1,3:1,4:1,5:1,6:1,2:2,3:2,4:2,5:2,6:2,4:3', '1', '', '', '', 0, 1, '0637351925', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'dLOFBp5Whis:APA91bEuYK3FgwRZpvRkDnEYtRVyBW-poOeW3gljpWDiG4HMVB-MKUqRlOUEMV2VV8bQHmbWANBZFvMAQNLNk4Zy8YzdjVgAgLrt_yI05aPzPgo9S65kLcrWdrMy9bryfQRXV__n7wUC'),
(57, 1, 'prof professeur', '4,6', '1:1', '1', '', '', '', 0, 1, '0699955119', '78a9e1ae09d296096899efeb97d3146c290c2e01', 'e57032Kt42c:APA91bG428uhhbOZ6z7PFNMws-v3euv28gHvTFXjnblPcQ3tS925w9xfGhScz5Nag05nPrOzTVYLM7QrolM7dqasCf6gJ2LFTrKmC1V7jcrR1j9-XBJV7_SK0pvLyVxB3AL6z2337vbV'),
(61, 23, 'osstad Tawil', '4', '4:1,4:2,5:1,5:2', '1', '', '', '', 1, 1, '0524222222', '273a0c7bd3c679ba9a6f5d99078e36e85d02b952', 'cRA-3fuEQ2Y:APA91bEzRYP1nE13XAeIrH7N-5qRRHPEgACoJUr0lvLqdBwVCJWiW46YeoLAUvPVf-bSZD3rI35ETK-Kg6GaNK4Aowdm8gw8pHfuqy6gxIeNvDDdcaDrBNHoBXIg2X_P5uvufJNcBMR3'),
(62, 23, 'amal sanhaji', '8', '4:1', '1', '', '', '', 1, 1, '0624553311', '3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d', ''),
(63, 23, 'Ahmed Alaoui', '6,7', '4:1,4:2,6:1,6:2', '1', '', '', '', 1, 1, '0622444444', '42cfe854913594fe572cb9712a188e829830291f', 'fsKHNp-6i0w:APA91bFlylbaufSTRp15ztituT68w2J7N3fH9XEtvVxC73BRbMOMJP9pelIMewTYCpn42Q4Z61glU5cSW3bvorr0yGEQ8KnykMmNE_EVJBulpYNgp0FqO0y-9zG3E-TET7gXp-d6_Wn2'),
(64, 23, 'Salwa Sanhaji', '4', '4:1', '1', '', '', '', 1, 1, '0633555555', '42cfe854913594fe572cb9712a188e829830291f', 'e10b9vkpyQQ:APA91bFBlmxvykuyUy_9sUjawJS1SSy-aIdWrCOCVzFeGIWtnTnys4fFC7Y7CHflQq3mv9_b5L5QSqg1Cjy6vQydATVoFeFOxIkwA8GDAAaMJ3ZvSIyZYObrIyF5f9Uf7WP6PnPbbYFr');

-- --------------------------------------------------------

--
-- Structure de la table `representant`
--

CREATE TABLE IF NOT EXISTS `representant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(11) NOT NULL,
  `nom` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ville` varchar(200) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `pwd` varchar(400) NOT NULL,
  `token` text NOT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `representant`
--

INSERT INTO `representant` (`id`, `code`, `nom`, `ville`, `tel`, `pwd`, `token`, `state`) VALUES
(8, '94cc2c', 'Adnane Baribi', '17', '0662828750', '81ca33ab1766c0893a450c9680b2bcd6319a9712', '', 1),
(9, 'fe4a0a', 'Soufiane Baribi', '2', '0668962669', 'aeb54d13ec1e549e863db14fc01472bdde0fc7c0', '', 1),
(10, '5605cf', 'M''hamed Faiq', '12', '0661610105', 'b9d5bc7856e7358f04a4f9b06d7e7c638127300c', 'dAGhhCKdJzk:APA91bFKNyg0301AwkCT68mMMyaW7x_czsYalwULTl-c6QzbEaJT_8sDZ0Om6cFSqQveMl67ulpelY2F8yof3nlMbxxBO1o7F18dA_o67RH3utMVC2qI4JIIXxRSOLPA65SkW2AetmqK', 1),
(11, 'a85a11', 'Mr. Said', '4', '0611111111', '5827cf6a9159e741551d5fdf1a1a285e0ff144b5', '', 1),
(12, '0b36f1', 'Mr. Abd Elhaq', '11', '0622222222', '06abff85c9d0f31cd3eb058430b28ae64de72e66', '', 1),
(13, '4098e8', 'Mr. Farid', '19', '0633333333', 'bc4947ea0d7a8baa9457c16666440f410e8ff5b8', '', 1),
(14, 'f987be', 'Mr. Brahim', '20', '0644444444', 'a9d74076f053d13e16e951c801384af685e2f622', '', 1),
(15, '827c9e', 'Ait mouna Brahim', '18', '0655555555', 'ba21ff57b11697ae8b6aba6ec3cf76e1bc5c38fb', '', 1),
(16, '90de14', 'Mr. Hilal', '21', '0666666666', '222e09ddfe052c6cb6ccb64dc917b89c1f54285f', '', 1),
(18, 'de895b', 'Mr. Abderrazaq', '15', '0688888888', '923ca2b4bcf11dbce113092622554dc90b9d4f15', '', 1),
(19, '022d53', 'Baribi Amine', '5', '0655159236', '23bc6df7647b818d79ce7fc43fa0f460c188205a', '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `settingcentre`
--

CREATE TABLE IF NOT EXISTS `settingcentre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idCentre` int(11) NOT NULL,
  `matieres` varchar(200) NOT NULL,
  `appellationClasses` int(11) NOT NULL,
  `appellationGroupe` int(11) NOT NULL,
  `classes` varchar(200) NOT NULL,
  `niveau` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Contenu de la table `settingcentre`
--

INSERT INTO `settingcentre` (`id`, `idCentre`, `matieres`, `appellationClasses`, `appellationGroupe`, `classes`, `niveau`) VALUES
(1, 1, '1,2,3,4,6,7,8,9,10,12,14,19,23', 1, 2, '5,5,5,5,5,5', 1),
(2, 1, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 2),
(3, 1, '44,45,46,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70', 1, 1, '3,3,2,2,2,2,2,2,2,2,2', 3),
(4, 2, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 1),
(5, 2, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 3),
(6, 3, '1,2,3,4,6,7,8,9,10,11,12,13,14,15,19,23', 3, 1, '2,3,4,4,2,2', 1),
(7, 3, '24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43', 2, 1, '2,3,6', 2),
(8, 3, '', 1, 2, '3,4,2,8,3,4,3,2,5,2,4', 3),
(9, 4, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 1),
(10, 4, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 2),
(11, 4, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 3),
(12, 5, '1,2,3,4,6,7,8,9,10,12,13,19,23', 1, 2, '4,3,3,6,4,6', 1),
(13, 5, '24,27,32,33', 1, 1, '4,6,5', 2),
(14, 5, '45,56,57,58,65,67', 1, 2, '5,4,4,5,5,4,5,4,5,5,5', 3),
(15, 6, '1,2,3,4,6,7,8,9,10,12,19,23', 1, 1, '4,5,4,6,5,5', 1),
(16, 6, '24,25,26,27,28,29,30,31,32,33,34,35,36,37,39,40,41', 1, 1, '5,4,4', 2),
(17, 6, '44,45,46,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70', 1, 1, '5,4,3,3,3,3,3,3,3,3,7', 3),
(18, 7, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 1),
(19, 7, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 2),
(20, 8, '1,2,3,4,6,7,8,9,10,11,12,13,14,15,16,19,23', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 1),
(21, 8, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 2),
(22, 8, '60,64,65,66', 1, 1, '1,1,1,1,1,1,1,1,1,1,4', 3),
(23, 9, '1,2,3,4,6,7,8,9,10,11,12,13,14,15,16,19,23', 1, 1, '5,5,5,5,5,5', 1),
(24, 9, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 2),
(25, 9, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 3),
(26, 10, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 1),
(27, 10, '24,25,26,27,28,29,30,31,32,33,34,35,36,37', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 2),
(28, 10, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 3),
(29, 11, '1,2,8,9,11,14,15', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 1),
(30, 11, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 2),
(31, 11, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 3),
(32, 12, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 1),
(33, 12, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 2),
(34, 12, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 3),
(35, 13, '1,2,3,4,6,7,8,9,10,11,19,23', 1, 1, '4,3,6,3,3,4', 1),
(36, 13, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 2),
(37, 13, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 3),
(38, 14, '1,2,3,4,6,7,8,9,10,11,12,13,14,15,16,19,23', 1, 1, '4,4,6,6,5,5', 1),
(39, 14, '24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43', 1, 1, '4,4,3', 2),
(40, 14, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 3),
(41, 15, '1,2,4,6,7,8,9,10,12,19', 1, 1, '3,2,2,4,5,1', 1),
(42, 16, '1,2,3,4,6,7,8,9,12,13,14', 2, 2, '2,1,3,1,1,1', 1),
(43, 17, '1,2,3,4,6,7,8,9,10,13,15,19,23', 3, 2, '2,2,2,3,2,2', 1),
(44, 17, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 2),
(45, 18, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 2),
(46, 18, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 3),
(47, 19, '1,2,4,6,7,8,9,10,11,12,13,19', 1, 1, '3,3,3,2,2,2', 1),
(48, 19, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 2),
(49, 20, '1,2,3,4,6,7,8,9,10,12,13,14,15,16,19,23', 1, 1, '3,3,2,3,3,2', 1),
(50, 20, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 2),
(51, 20, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 3),
(52, 21, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 1),
(53, 21, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 2),
(54, 21, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 3),
(55, 22, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 1),
(56, 22, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 2),
(57, 22, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 3),
(58, 23, '1,2,3,4,6,7,8,9,10,11,12,14,19,23', 1, 1, '5,5,5,5,5,5', 1),
(59, 23, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 2),
(60, 26, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 1),
(61, 26, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 2),
(62, 27, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 1),
(63, 28, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 1),
(64, 29, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 2),
(65, 29, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 3),
(66, 30, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 1),
(67, 31, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 1),
(68, 31, '', 1, 1, '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', 2);

-- --------------------------------------------------------

--
-- Structure de la table `superadmin`
--

CREATE TABLE IF NOT EXISTS `superadmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `pwd` varchar(400) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `superadmin`
--

INSERT INTO `superadmin` (`id`, `nom`, `tel`, `pwd`) VALUES
(1, 'Super Admin', 'superadmin', '8e67bb26b358e2ed20fe552ed6fb832f397a507d'),
(2, 'Root', '0699955119', '78a9e1ae09d296096899efeb97d3146c290c2e01');

-- --------------------------------------------------------

--
-- Structure de la table `villes`
--

CREATE TABLE IF NOT EXISTS `villes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(400) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=123 ;

--
-- Contenu de la table `villes`
--

INSERT INTO `villes` (`id`, `intitule`) VALUES
(2, 'Marrakech'),
(4, 'Agadir'),
(5, 'Beni Mellal'),
(9, 'Tanger'),
(10, 'Fés'),
(11, 'Safi'),
(12, 'Youssoufia'),
(15, 'Tetouan'),
(16, 'Meknes'),
(17, 'Essaouira'),
(18, 'Ouarzazate'),
(19, 'Rabat'),
(20, 'Settat'),
(21, 'Casa 1'),
(22, 'El Harhoura'),
(23, 'Salé'),
(24, 'Skhirat'),
(25, 'Temara'),
(26, 'Tifelt'),
(27, 'Khemissat'),
(28, 'Kénitra'),
(29, 'Mehdia'),
(30, 'Moulay Bousselham'),
(31, 'Sidi Kacem'),
(32, 'Sidi Slimane'),
(33, 'Sidi Yahya El Gharb'),
(34, 'Guelmim'),
(35, 'Es-Semara'),
(36, 'Tan-Tan'),
(37, 'Tata'),
(38, 'Assa Zag'),
(39, 'Ait Baha'),
(41, 'Merzouga'),
(42, 'Mirleft'),
(43, 'Taghazout'),
(44, 'Taroudant'),
(45, 'Tiznit'),
(47, 'Zagora'),
(48, 'Ait Melloul'),
(49, 'Sidi Ifni'),
(50, 'Tikiouine'),
(51, 'Azilal'),
(52, 'Fquih Ben Saleh'),
(53, 'Bin El Ouidane'),
(54, 'Laâyoune'),
(55, 'Boujdour'),
(56, 'Tarfaya'),
(57, 'Al Haouz'),
(58, 'Ben Guerir'),
(59, 'Chichaoua'),
(60, 'Kelaat Es-Sraghna'),
(61, 'Tamensourt'),
(62, 'Dakhla'),
(63, 'Lagouira'),
(64, 'Aousserd'),
(65, 'Boulmane'),
(66, 'Imouzzer'),
(67, 'Moulay Yaacoub'),
(68, 'Outat El Haj'),
(69, 'Sefrou'),
(70, 'Azemmour'),
(71, 'Bir Jdid'),
(72, 'El Jadida'),
(73, 'Jemaat Shaim'),
(74, 'El Oualidiya'),
(75, 'Ouled Frej'),
(76, 'Sebt Gzoula'),
(77, 'Sidi Bennour'),
(78, 'Khemis Zmamra'),
(79, 'Had Soualem'),
(80, 'Sidi Bouzid'),
(81, 'Sidi Smail'),
(82, 'El Hajeb'),
(83, 'Errachidia'),
(84, 'Ifrane'),
(85, 'Khėnifra'),
(86, 'Azrou'),
(87, 'Midelt'),
(88, 'Rissani'),
(89, 'Goulmima'),
(90, 'Arfoud'),
(91, 'Oujda'),
(92, 'Berkane'),
(93, 'Nador'),
(94, 'Jrada'),
(95, 'Taourirt'),
(96, 'Saidia'),
(97, 'Selouane'),
(98, 'Al Hoceima'),
(99, 'Taounate'),
(100, 'Taza'),
(101, 'Guercif'),
(102, 'Assilah'),
(103, 'Chefchaouen'),
(104, 'Ksar El Kebir'),
(105, 'Ksar Esseghir'),
(106, 'Larache'),
(107, 'Martil'),
(108, 'Ouazzane'),
(109, 'Tamouda Bay'),
(110, 'Mdiq'),
(111, 'Fnideq'),
(112, 'Mohammedia'),
(113, 'Khouribga'),
(114, 'Amizmiz'),
(115, 'Tamesna'),
(116, 'Er-rich'),
(117, 'Figuig'),
(118, 'Inezgane'),
(119, 'Immouzzar Kandar'),
(120, 'Tinjdad'),
(121, 'Kelaat Mgouna'),
(122, 'Tinghir');
--
-- Base de données: `tawassol_wp606`
--

-- --------------------------------------------------------

--
-- Structure de la table `magasins`
--

CREATE TABLE IF NOT EXISTS `magasins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `departement` varchar(10) CHARACTER SET utf8 NOT NULL,
  `region` int(11) NOT NULL,
  `nom_departement` varchar(250) CHARACTER SET utf8 NOT NULL,
  `chaine` varchar(100) CHARACTER SET utf8 NOT NULL,
  `nom` varchar(300) CHARACTER SET utf8 NOT NULL,
  `adresse` varchar(300) CHARACTER SET utf8 NOT NULL,
  `codepostal` varchar(10) CHARACTER SET utf8 NOT NULL,
  `ville` varchar(40) CHARACTER SET utf8 NOT NULL,
  `logo` text CHARACTER SET utf8 NOT NULL,
  `location` varchar(400) CHARACTER SET utf8 NOT NULL,
  `lat` varchar(100) NOT NULL,
  `lng` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=157 ;

--
-- Contenu de la table `magasins`
--

INSERT INTO `magasins` (`id`, `departement`, `region`, `nom_departement`, `chaine`, `nom`, `adresse`, `codepostal`, `ville`, `logo`, `location`, `lat`, `lng`) VALUES
(2, '15', 1, 'Cantal', 'INTERSPORT', 'INTERSPORT AURILLAC', '109 avenue du general leclerc ', '15000', '3', '', '109 Avenue du GÃ©nÃ©ral Leclerc, Aurillac, France', '44.9114556', '2.4434192'),
(3, '15', 1, 'Cantal', 'INTERSPORT', 'INTERSPORT LE LIORAN', 'Prairie des sagnes ', '15300', '55', '', '', '', ''),
(4, '38', 1, 'Isère', '', '7 LAUX SKI', 'Le pleynet  ', '38580', '48', '', 'Le Pleynet, La Ferriere, France', '45.272203', '6.055841'),
(5, '38', 1, 'Isère', '', 'CYCLES & SPORTS', 'Place du docteur faure ', '38520', '15', '', '', '', ''),
(6, '38', 1, 'Isère', 'INTERSPORT', 'INTERSPORT LES 2 ALPES', '72  avenue de la muzelle  ', '38860', '58', '', '', '', ''),
(7, '38', 1, 'Isère', 'INTERSPORT', 'INTERSPORT VIENNE', 'Rue edouard girerd ', '38200', '114', '', 'Rue Edouard Girerd, Vienne, France', '45.5056236', '4.8539713'),
(8, '38', 1, 'Isère', '', 'LA CABANE A SKI', 'Chemin des jeux  rÃ©sidence les myrtilles ', '38114', '81', '', '', '', ''),
(9, '38', 1, 'Isère', '', 'MILOU SPORT', '126 avenue de la muzelle ', '38860', '63', '', '', '', ''),
(10, '38', 1, 'Isère', '', 'SO DIFFUSION', '274 route montgolfier  ', '38140', '90', '', '274 Route Montgolfier, Rives, France', '45.3650783', '5.4919416'),
(11, '38', 1, 'Isère', 'SPORT 2000', 'SPORT 2000 LOULOU SPORT', '9 allee de la blache ', '38350', '1', '', '', '', ''),
(12, '42', 1, 'Loire', '', 'G2ROUES', '34 rue georges plasse ', '42300', '91', '', '34 Rue Georges Plasse, Roanne, France', '46.0334635', '4.0587866'),
(13, '43', 1, 'Haute-Loire', 'INTERSPORT', 'INTERSPORT BRIOUDE', 'Route de clermont ', '43100', '31', '', 'Route de Clermont, Cohade, France', '45.3267018', '3.3684798'),
(14, '69', 1, 'Rhône', '', 'ESPRIT MONTAGNE', '169 rue de thizy ', '69400', '115', '', '169 Rue de Thizy, Villefranche-sur-SaÃ´ne, France', '45.986422', '4.7159763'),
(15, '74', 1, 'Haute-Savoie', '', 'ABSOLUT SPORT', '159 promenade du festival  ', '74110', '5', '', '159 Promenade du Festival, Avoriaz, Morzine, France', '46.1915663', '6.7764648'),
(16, '74', 1, 'Haute-Savoie', '', 'ID SKI', '655 route notre dame de la gorge ', '74170', '60', '', '655 Route de Notre Dame de la Gorge, Les Contamines-Montjoie, France', '45.8170257', '6.7280624'),
(17, '74', 1, 'Haute-Savoie', 'INTERSPORT', 'INTERSPORT CLUSES', '125 place charles de gaulle   ', '74300', '30', '', '125 Place Charles de Gaulle, Cluses, France', '46.0607166', '6.5795492'),
(18, '74', 1, 'Haute-Savoie', '', 'JOLY POTTUZ SPORTS', '25 route du val d''arly ', '74120', '88', '', '25 Route du Val d''Arly, Praz-sur-Arly, France', '45.8377035', '6.5712548'),
(19, '74', 1, 'Haute-Savoie', '', 'LAC ET MONTAGNE SPORTS', '306 route d''ardent  ', '74110', '78', '', '306 Route d''Ardent, Montriond, France', '46.21435', '6.760976'),
(20, '74', 1, 'Haute-Savoie', '', 'NEIGE & MONTAGNE', 'Place de la gare ', '74340', '99', '', 'Rue de la Gare, SamoÃ«ns, France', '46.0833915', '6.7222648'),
(21, '74', 1, 'Haute-Savoie', '', 'PHILIPPE SPORTS', '920 route de la turche ', '74260', '64', '', '920 Route de la Turche, Les Gets, France', '46.1492919', '6.6646279'),
(22, '74', 1, 'Haute-Savoie', '', 'ROCHE SPORTS', '246 route du telepherique ', '74120', '75', '', '246 Route du TÃ©lÃ©phÃ©rique, MegÃ¨ve, France', '45.8496862', '6.6150644'),
(23, '74', 1, 'Haute-Savoie', 'SKISET', 'SKI SET PRAZ DE LYS', 'Le chevaly  ', '74440', '57', '', 'Residence Le Chevaly, Praz De Lys, Taninges, France', '46.1479436', '6.5934075'),
(24, '74', 1, 'Haute-Savoie', '', 'SKI TOUT SCHUSS', '224 chemin des hameaux du lay ', '74170', '62', '', '224 Chemin des Hameaux du Lay, Les Contamines-Montjoie, France', '45.8110752', '6.7248146'),
(25, '74', 1, 'Haute-Savoie', '', 'SPORT 4807', '148 route de notre dame de la gorge ', '74170', '61', '', '148 Route de Notre Dame de la Gorge, Les Contamines-Montjoie, France', '45.8213904', '6.726974'),
(26, '74', 1, 'Haute-Savoie', '', 'TABERLET SPORT', '151 rte du telepherique ', '74110', '79', '', '151 Route du TÃ©lÃ©phÃ©rique, Morzine, France', '46.1799494', '6.7035999'),
(27, '74', 1, 'Haute-Savoie', 'INTERSPORT', 'INTERSPORT LA CLUSAZ ', '100 route des grandes alpes ', '74220', '47', '', '100 Route des Grandes Alpes, La Clusaz, France', '45.9066536', '6.4294405'),
(28, '25', 2, 'Doubs', '', 'SPORT ET NEIGE', '7 rue mervil  ', '25300', '86', '', '7 Rue Mervil, Pontarlier, France', '46.9024512', '6.3321085'),
(29, '39', 2, 'Jura', '', 'AMONT SPORT', '188 rue des couenneaux ', '39220', '11', '', '188 Rue des Couenneaux, Bois-d''Amont, France', '46.5377277', '6.1368703'),
(30, '39', 2, 'Jura', 'SPORT 2000', 'SPORT 2000 LES ROUSSES', '384 rue pasteur ', '39220', '68', '', '384 Rue Pasteur, Les Rousses, France', '46.484064', '6.0602171'),
(31, '71', 2, 'Saône-et-Loire', 'SPORT 2000', 'SPORT 2000 MACON', '240 allee joanny mommessin lotissement grange st pierre ', '71850', '27', 'logo_1486407812.jpg', '240 Rue Joanny Mommessin, Charnay-lÃ¨s-MÃ¢con, France', '46.312055', '4.8123198'),
(32, '71', 2, 'Saône-et-Loire', '', 'ARMELLE AND CO', 'Galerie marchande intermarche ', '71800', '113', '', '', '', ''),
(33, '71', 2, 'Saône-et-Loire', '', 'JS SPORT', '32 rue de la republique ', '71700', '107', '', '32 Rue de la RÃ©publique, Tournus, France', '46.5629322', '4.9118443'),
(34, '73', 2, 'Savoie', '', 'COURCHEVEL RACING CENTER', 'Rue des envers la gria', '73120', '94', '', '', '', ''),
(35, '73', 2, 'Savoie', '', 'FAVRE SPORTS', 'Avenue des chasse forets  ', '73710', '87', '', '', '', ''),
(36, '73', 2, 'Savoie', '', 'FRANCIS BLANC SPORT', 'Rue des maquis ', '73120', '33', '', '', '', ''),
(37, '73', 2, 'Savoie', '', 'GILBERT SPORTS', 'Immeuble le marquis  courchevel 1650', '73120', '98', '', 'Courchevel 1650 (Moriond), Saint-Bon-Tarentaise, France', '45.4175283', '6.6540352'),
(38, '73', 2, 'Savoie', 'INTERSPORT', 'INTERSPORT COURCHEVEL 1850', 'Rue park city la cristal de roche', '73120', '32', '', '', '', ''),
(39, '73', 2, 'Savoie', 'INTERSPORT', 'INTERSPORT CREST VOLAND', '460 route d''entre deux villes ', '73590', '35', '', '', '', ''),
(40, '73', 2, 'Savoie', 'INTERSPORT', 'INTERSPORT DOUCY', 'Doucy combelouviere ', '73260', '49', '', 'Doucy-CombelouviÃ¨re, La LÃ©chÃ¨re, France', '45.4989269', '6.4546448'),
(41, '73', 2, 'Savoie', 'INTERSPORT', 'INTERSPORT LA PLAGNE', 'Bellecote ', '73120', '51', '', 'Spa Bellecote, MÃ¢cot-la-Plagne, France', '45.512821', '6.6956'),
(42, '73', 2, 'Savoie', 'INTERSPORT', 'INTERSPORT LE PONT DE BEAUVOISIN', 'Zi la baronnie ', '73330', '56', '', '', '', ''),
(43, '73', 2, 'Savoie', 'INTERSPORT', 'INTERSPORT LES TOVETS', 'Courchevel village centre commercial cap saint louis', '73120', '34', '', '', '', ''),
(44, '73', 2, 'Savoie', '', 'L''ETERLOU SPORT', 'Place de la madeleine ', '73130', '103', '', 'Place de la madeleine st fr', '48.8700777', '2.324007'),
(45, '73', 2, 'Savoie', '', 'MOULIN SPORTS', 'Pre catin ', '73480', '13', '', '', '', ''),
(46, '73', 2, 'Savoie', '', 'LA BOUTIQUE SPORTWEAR ', 'Quartier croisette lac du lou/chaviere ', '73440', '66', '', '', '', ''),
(47, '73', 2, 'Savoie', 'SKISET', 'SKISET AIME 2000 PLAGNE', 'Galerie commerciale aime 2000 ', '73210', '85', '', '', '', ''),
(48, '73', 2, 'Savoie', 'SPORT 2000', 'SPORT 2000', 'Avenue de chasse foret ', '73710', '87', 'logo_1486407710.jpg', 'Avenue de Chasseforet, Pralognan-la-Vanoise, France', '45.381084', '6.721608'),
(49, '73', 2, 'Savoie', '', 'SNOW SPORTS', 'Centre commercial les bruyeres  immeuble aconit', '73440', '66', '', '', '', ''),
(50, '73', 2, 'Savoie', '', 'SPORT 1850', 'Centre commercial les bruyeres ', '73440', '66', '', '', '', ''),
(51, '73', 2, 'Savoie', 'SPORT 2000', 'SPORT 2000 BOZEL', 'Immeuble les soldanelles ', '73350', '17', '', '', '', ''),
(52, '73', 2, 'Savoie', '', 'VALMO SPORT', 'Hameau du morel ', '73260', '111', '', '', '', ''),
(53, '73', 2, 'Savoie', '', 'BELVEDERE SPORTS', 'Montee du crey ', '73350', '24', '', 'MontÃ©e du Crey, Champagny-en-Vanoise, France', '45.4552209', '6.6949332'),
(54, '73', 2, 'Savoie', '', 'LA FOIRE A LA POLAIRE', 'Avenue de la vallee d''or ', '73450', '110', '', 'Avenue de la VallÃ©e d''Or, Valloire, France', '45.166152', '6.434864'),
(55, '73', 2, 'Savoie', 'INTERSPORT', 'INTERSPORT LANS LE BOURG', '74 rue du mont cenis ', '73480', '53', '', '74 Rue du Mont-Cenis, Lanslebourg-Mont-Cenis, France', '45.2850579', '6.8785563'),
(56, '73', 2, 'Savoie', '', 'MONTCHAVIN SPORT', 'Montchavin ', '73210', '10', '', 'Montchavin, Bellentre, France', '45.559913', '6.737101'),
(57, '73', 2, 'Savoie', '', 'BRID SHOP', 'Passage de l''olympe ', '73570', '19', '', 'Route de l''Olympe, Brides-les-Bains, France', '45.4510663', '6.5665232'),
(58, '56', 3, 'Morbihan', '', 'ENDURANCE SHOP', '23 rue marcelin berthelot ', '56000', '112', '', '23 Impasse Marcelin Berthelot, Vannes, France', '47.6642904', '-2.7892594'),
(59, '56', 3, 'Morbihan', 'INTERSPORT', 'INTERSPORT VANNES', '33 rue theophraste renaudot zone commerciale kerlann', '56000', '112', '', '33 Rue ThÃ©ophraste Renaudot, Vannes, France', '47.6623248', '-2.7866218'),
(60, '28', 4, 'Eure-et-Loir', 'INTERSPORT', 'INTERSPORT CHARTRES LUCE', 'Centre commercial geant rue de touraine', '28110', '73', '', 'Rue de Touraine, LucÃ©, France', '48.4345049', '1.4469238'),
(61, '45', 4, 'Loiret', 'INTERSPORT', 'INTERSPORT BEAUGENCY', '1 rue du clos de bordeaux ', '45190', '105', '', '', '', ''),
(62, '45', 4, 'Loiret', 'SPORT 2000', 'SPORT 2000 BAULE', 'Les coutumes ', '45130', '9', 'logo_1486407745.jpg', '', '', ''),
(63, '57', 5, 'Moselle', '', 'LECLERC SPORTS SARREBOURG', '19 route de luneville ', '57400', '100', '', '19 Rue de LunÃ©ville, Sarrebourg, France', '48.7331815', '7.0432877'),
(64, '67', 5, 'Bas-Rhin', 'SPORT 2000', 'SPORT 2000 ILLKIRCH', 'Rue de l''industrie ', '67400', '46', '', 'Rue de l''Industrie, Illkirch-Graffenstaden, France', '48.5328616', '7.7320579'),
(65, '68', 5, 'Haut-Rhin', '', 'O''SOMMET', '20 rue du muhlele ', '68140', '44', '', '20 Rue du Muhlele, Gunsbach, France', '48.0425882', '7.172192'),
(66, '68', 5, 'Haut-Rhin', '', 'TWINNER SIERENTZ', '18 rue du capitaine dreyfus ', '68510', '102', '', '', '', ''),
(67, '59', 6, 'Nord', '', 'UNIVERS RUNNING', 'Dispeo-groupe3si rue du trieu du quesnoy', '59390', '106', '', '', '', ''),
(68, '59', 6, 'Nord', 'TERRES ET EAUX', 'TERRES & EAUX', '52 rue de l industrie ', '59113', '101', '', '52 Rue de l''Industrie, Seclin, France', '50.5498438', '3.0512384'),
(69, '62', 6, 'Pas-de-Calais', '', 'TOP PERFORMANCE', '8 rue du bois ', '62840', '54', '', '8 Rue du Bois, Laventie, France', '50.608832', '2.7966611'),
(70, '75', 7, 'Paris', '', 'SPORT NATION', '79 bis boulevard de picpus  ', '75012', '82', '', '79 Bis Boulevard de Picpus, Paris, France', '48.8471692', '2.3986718'),
(71, '78', 7, 'Yvelines', 'INTERSPORT', 'INTERSPORT BOIS D''ARCY', 'Centre commercial leclerc 13 avenue jean jaures', '78390', '12', '', '', '', ''),
(72, '91', 7, 'Essonne', '', 'CUSTOM HORSE', '2 allÃ©e de coquerive cc du moulin des fontaines', '91150', '39', '', '2 Rue de Coquerive, Ã‰tampes, France', '48.4321876', '2.1710607'),
(73, '91', 7, 'Essonne', 'INTERSPORT', 'INTERSPORT FRANCE', 'Tiers payeur pour le compte du destinataire 2 rue victor hugo bp 500', '91164', '70', '', '2 Rue Victor Hugo, Longjumeau, France', '48.7041195', '2.2976957'),
(74, '93', 7, 'Seine-Saint-Denis', '', 'HARDLOOP', '67 rue des sorins ', '93100', '77', '', '67 Rue des Sorins, Montreuil, France', '48.8581816', '2.4259183'),
(75, '14', 8, 'Calvados', 'SPORT 2000', 'SPORT 2000 DIVES ', 'Boulevard maurice thorez centre commercial super u', '14160', '36', 'logo_1486407725.jpg', 'Sport 2000 Dives sur Mer, Dives-sur-Mer, France', '49.277926', '-0.103768'),
(76, '27', 8, 'Eure', 'INTERSPORT', 'INTERSPORT VERNON SAINT-MARCEL', 'Rue louis bleriot ', '27950', '95', '', 'Intersport, Rue Louis BlÃ©riot, Saint-Marcel, France', '49.09961', '1.459358'),
(77, '76', 8, 'Seine-Maritime', 'INTERSPORT', 'INTERSPORT ROUEN', '24-26 rue du grand pont ', '76000', '93', '', 'Intersport, Rue Grand Pont, Rouen, France', '49.439088', '1.092629'),
(78, '77', 8, 'Seine-et-Marne', 'INTERSPORT', 'INTERSPORT NEMOURS', '113 route de moret za les hauteurs du loing', '77140', '80', '', 'Intersport Nemours, Route de Moret, Nemours, France', '48.2794411', '2.6975819'),
(79, '16', 9, 'Charente', 'INTERSPORT', 'INTERSPORT CHAMPNIERS', 'Lieu dit plantier de denat zac des montagnes ouest', '16430', '25', '', '', '', ''),
(80, '16', 9, 'Charente', 'INTERSPORT', 'INTERSPORT SOYAUX & COGNAC', '13 rue de l''anisserie ', '16100', '28', '', '13 Rue de l''Anisserie, ChÃ¢teaubernard, France', '45.6835547', '-0.3076482'),
(81, '19', 9, 'Corrèze', 'INTERSPORT', 'INTERSPORT TULLE', 'Zone de mulatet  ', '19000', '108', '', '', '', ''),
(82, '19', 9, 'Corrèze', 'INTERSPORT', 'INTERSPORT BRIVE', 'Zac de mazeaud ', '19100', '20', '', '', '', ''),
(83, '33', 9, 'Gironde', 'INTERSPORT', 'INTERSPORT MERIADECK', 'Rue claude bonnier centre commercial  meriadeck  ', '33092', '14', '', 'Rue Claude Bonnier, Bordeaux, France', '44.8380001', '-0.5851673'),
(84, '33', 9, 'Gironde', 'INTERSPORT', 'INTERSPORT PESSAC', 'Avenue de tuileranne centre commercial geant casino', '33600', '84', '', '', '', ''),
(85, '33', 9, 'Gironde', 'INTERSPORT', 'INTERSPORT SAINT MEDARD', 'Lieu dit gajac   route de lacanau ', '33160', '96', '', 'Route de Lacanau, Saint-MÃ©dard-en-Jalles, France', '44.9120451', '-0.7639324'),
(86, '64', 9, 'Pyrénées-Atlantiques', '', 'EUROSKI', 'Esplanade du valentin  ', '64440', '43', '', '', '', ''),
(87, '64', 9, 'Pyrénées-Atlantiques', 'INTERSPORT', 'INTERSPORT LONS', 'Avenue andre marie ampere centre commercial le meridien', '64140', '71', '', 'Avenue AndrÃ© Marie AmpÃ¨re, Lons, France', '43.312322', '-0.426562'),
(88, '64', 9, 'Pyrénées-Atlantiques', 'INTERSPORT', 'INTERSPORT PAU', 'Boulevard du commandant mouchotte  centre commercial le hameau ', '64000', '83', '', '', '', ''),
(89, '87', 9, 'Haute-Vienne', 'INTERSPORT', 'INTERSPORT LIMOGES', '1 rue frederic bastiat ', '87280', '69', '', '1 Rue FrÃ©dÃ©ric Bastiat, Limoges, France', '45.8833994', '1.2881061'),
(90, '09', 10, 'Ariège', '', 'GLISSE ET MONTAGNE ANA', '8 rue gaspard astrie ', '09110', '6', '', '8 Rue Gaspard Astrie, Ax-les-Thermes, France', '42.7203188', '1.8378737'),
(91, '12', 10, 'Aveyron', 'INTERSPORT', 'INTERSPORT RODEZ', 'Parc des moutiers 5 avenue de l''entreprise ', '12000', '92', '', 'Avenue de l''Entreprise, Rodez, France', '44.3638364', '2.5714291'),
(92, '31', 10, 'Haute-Garonne', 'SPORT 2000', 'SPORT 2000', '4 rue de la poste ', '31800', '104', 'logo_1486407506.jpg', '', '', ''),
(93, '31', 10, 'Haute-Garonne', '', 'IRUN ', '101 avenue de l''europe bÃ¢timent a, cellule 3', '31620', '21', '', '101 Avenue de l''Europe, Castelnau-d''EstrÃ©tefonds, France', '43.7686821', '1.3699181'),
(94, '31', 10, 'Haute-Garonne', '', 'ALL MOUNTAIN', '38 allees d''etigny ', '31110', '7', '', '', '', ''),
(95, '31', 10, 'Haute-Garonne', 'SPORT 2000', 'SPORT 2000 SAINT GAUDENS', '4 rue de la poste ', '31800', '104', 'logo_1486407756.jpg', '', '', ''),
(96, '32', 10, 'Gers', 'INTERSPORT', 'INTERSPORT AUCH', 'Rue franÃ§ois mauriac zac clarac', '32000', '2', '', 'Rue FranÃ§ois Mauriac, Auch, France', '43.6657776', '0.591136'),
(97, '65', 10, 'Hautes-Pyrénées', '', 'LA MARMOTTE SPORTS', '16 place des badalans ', '65510', '72', '', '16 Place des Badalans, Loudenvielle, France', '42.7961476', '0.408979'),
(98, '65', 10, 'Hautes-Pyrénées', '', 'LE ROND POINT SPORT', '15 avenue du tourmalet  ', '65200', '50', '', '', '', ''),
(99, '65', 10, 'Hautes-Pyrénées', 'SPORT & LOISIRS', 'SPORT & LOISIRS IBOS', 'Centre commercial le meridien route de pau', '65420', '45', '', '', '', ''),
(100, '65', 10, 'Hautes-Pyrénées', 'SPORT 2000', 'SPORT 2000 CAUTERETS', '10 avenue du mamelon vert ', '65110', '22', 'logo_1486407491.jpg', '10 Avenue du Mamelon Vert, Cauterets, France', '42.888638', '-0.1163823'),
(101, '66', 10, 'Pyrénées-Orientales', 'INTERSPORT', 'INTERSPORT LES ANGLES', 'Avenue de mont louis  ', '66210', '59', '', 'Avenue de Mont Louis, Les Angles, France', '42.5718002', '2.0723647'),
(102, '66', 10, 'Pyrénées-Orientales', '', 'PASSION MONTAGNE', '54 avenue emmanuel brousse    ', '66120', '40', '', '54 Avenue Emmanuel Brousse, Font-Romeu-Odeillo-Via, France', '42.505155', '2.0406307'),
(103, '66', 10, 'Pyrénées-Orientales', 'SPORT 2000', 'SPORT 2000 EGAT', 'Rond point de lâ€™egat rn10', '66120', '38', 'logo_1486407458.jpg', '', '', ''),
(104, '66', 10, 'Pyrénées-Orientales', '', 'LES OLYMPIADES', '10 avenue de mont louis ', '66210', '59', '', '10 Avenue de Mont Louis, Les Angles, France', '42.5766841', '2.0706914'),
(105, '81', 10, 'Tarn', 'SPORT 2000', 'SPORT 2000 BOUT DU PONT', 'Rond point la richarde ', '81660', '16', 'logo_1486407471.jpg', 'Rue de la Richarde, Bout-du-Pont-de-Larn, France', '43.4982476', '2.3896002'),
(106, '44', 11, 'Loire-Atlantique', '', 'ACCASTILLAGE DIFFUSION', 'Avenue des lions ', '44800', '97', '', 'Avenue des Lions, Saint-Herblain, France', '47.2484858', '-1.6194535'),
(107, '44', 11, 'Loire-Atlantique', 'INTERSPORT', 'INTERSPORT CLISSON', 'Rue de la fontaine calin zac du moulin cÃ¢lin', '44190', '29', '', 'Rue de la Fontaine Calin, Clisson, France', '47.0966938', '-1.2823627'),
(108, '44', 11, 'Loire-Atlantique', 'INTERSPORT', 'INTERSPORT BASSE GOULAINE', 'Centre commercial pole sud 1 rue de terre adelie', '44115', '8', '', '1 Rue de Terre AdÃ©lie, Basse-Goulaine, France', '47.18818', '-1.473265'),
(109, '44', 11, 'Loire-Atlantique', 'INTERSPORT', 'INTERSPORT REZE', '10 rond point de la corbinerie ', '44400', '89', '', '10 Rond-Point de la Corbinerie, RezÃ©, France', '47.160994', '-1.548077'),
(110, '85', 11, 'Vendée', 'INTERSPORT', 'INTERSPORT CHALLANS', '166 rue carnot bp 427', '85300', '23', '', 'Picard, 166 Rue Carnot, Challans, France', '46.8515899', '-1.8898823'),
(111, '85', 11, 'Vendée', 'INTERSPORT', 'INTERSPORT LUCON', 'Zone d''argÃ©lique route de fontenay le comte', '85400', '74', '', 'Intersport, LuÃ§on, France', '46.4597166', '-1.1300904'),
(112, '85', 11, 'Vendée', 'INTERSPORT', 'INTERSPORT LES HERBIERS', 'Centre commercial hyper u avenue de la maine', '85504', '65', '', 'Intersport, Avenue de la Maine, Les Herbiers, France', '46.8729265', '-1.0282231'),
(113, '05', 12, 'Hautes-Alpes', '', 'ESPACE MONTAGNE', '339 route des maisons blanches lieudit les preyts ', '05100', '18', '', 'ESPACE MONTAGNE BRIANÃ‡ON, Route des Maisons Blanches, BrianÃ§on, France', '', ''),
(114, '05', 12, 'Hautes-Alpes', 'GO SPORT', 'GO SPORT BRIANCON', '2 avenue dauphine ', '05100', '18', '', 'GO Sport, Avenue du DauphinÃ©, BrianÃ§on, France', '44.903031', '6.631541'),
(115, '05', 12, 'Hautes-Alpes', 'INTERSPORT', 'INTERSPORT GAP', 'Boulevard d''orient  zone tokoro', '05000', '42', 'logo_1486658318.jpg', 'Intersport, Boulevard d''Orient, Gap, France', '44.5640245', '6.0998895'),
(116, '05', 12, 'Hautes-Alpes', 'INTERSPORT', 'INTERSPORT LA SALLE LES ALPES', '3 Place du Vernay', '05240', '52', 'logo_1486658305.jpg', '3 Place du Vernay, 05240 La Salle-les-Alpes, France', '44.9449441', '6.5616151'),
(117, '05', 12, 'Hautes-Alpes', 'INTERSPORT', 'INTERSPORT MONTGENEVRE', 'Rue des montagnards ', '05100', '76', 'logo_1486658283.jpg', 'Rue des Montagnards, MontgenÃ¨vre, France', '44.929915', '6.718876'),
(118, '05', 12, 'Hautes-Alpes', 'SKISET', 'SKI SET LES ORRES', 'Galerie commerciale ', '05200', '67', '', '', '', ''),
(120, '05', 12, 'Hautes-Alpes', 'SPORT 2000', 'SPORT 2000 CHANTEMERLE', 'Place du TÃ©lÃ©phÃ©rique', '05330', '26', 'logo_1486407434.jpg', 'Place du TÃ©lÃ©phÃ©rique, 05330 Saint-Chaffrey, France', '44.9333822', '6.5875119'),
(121, '06', 12, 'Alpes-Maritimes', 'INTERSPORT', 'INTERSPORT AURON ', 'Place auron et plateau de chastellares  boulevard d''orient ', '06660', '4', 'logo_1486658272.jpg', 'Auron Est, Saint-Ã‰tienne-de-TinÃ©e, France', '', ''),
(122, '06', 12, 'Alpes-Maritimes', 'SPORT 2000', 'SPORT 2000 BLANCHE NEIGE', ' Avenue de Valberg', '06470', '109', 'logo_1486407424.jpg', 'Sport 2000 Blanche Neige Sport, Avenue de Valberg, PÃ©one, France', '44.094586', '6.931627'),
(154, '', 20, '', '', 'test', 'pariis', '40000', '4', '', 'Toulouse, France', '', ''),
(155, '', 6, '', '', 'test1', 'pariis', '1111', '119', '', 'Strasbourg, France', '', ''),
(156, '', 6, '', '', 'test2', 'pariis', '05330', '119', '', 'Strasbourg, France', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `resgions_magasins`
--

CREATE TABLE IF NOT EXISTS `resgions_magasins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region` varchar(400) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `resgions_magasins`
--

INSERT INTO `resgions_magasins` (`id`, `region`) VALUES
(1, 'Auvergne-RhÃ´ne-Alpes'),
(2, 'Bourgogne-Franche-ComtÃ©'),
(3, 'Bretagne'),
(4, 'Centre-Val de Loire'),
(5, 'Grand Est'),
(6, 'Hauts-de-France'),
(7, 'ÃŽle-de-France'),
(8, 'Normandie'),
(9, 'Nouvelle-Aquitaine'),
(10, 'Occitanie'),
(11, 'Pays de la Loire'),
(12, 'Provence-Alpes-CÃ´te d''Azur');

-- --------------------------------------------------------

--
-- Structure de la table `villes_magasins`
--

CREATE TABLE IF NOT EXISTS `villes_magasins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ville` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=116 ;

--
-- Contenu de la table `villes_magasins`
--

INSERT INTO `villes_magasins` (`id`, `ville`) VALUES
(1, 'Alpes du grand serre'),
(2, 'Auch'),
(3, 'Aurillac'),
(4, 'Auron'),
(5, 'Avoriaz'),
(6, 'Ax-les-thermes'),
(7, 'Bagneres de luchon'),
(8, 'Basse goulaine'),
(9, 'Baule'),
(10, 'Bellentre'),
(11, 'Bois d''amont'),
(12, 'Bois d''arcy'),
(13, 'Bonneval sur arc'),
(14, 'Bordeaux'),
(15, 'Bourg d''oisan'),
(16, 'Bout du pont de l''arn'),
(17, 'Bozel'),
(18, 'Briancon'),
(19, 'Brides les bains'),
(20, 'Brive la gaillarde'),
(21, 'Castelnau d estretefonds '),
(22, 'Cauterets'),
(23, 'Challans'),
(24, 'Champagny en vanoise'),
(25, 'Champniers'),
(26, 'Chantemerle'),
(27, 'Charney les macon'),
(28, 'Chateau bernard'),
(29, 'Clisson'),
(30, 'Cluses'),
(31, 'Cohade'),
(32, 'Courchevel'),
(33, 'Courchevel 1650'),
(34, 'Courchevel village'),
(35, 'Crest voland'),
(36, 'Dives sur mer'),
(37, 'Draguignan'),
(38, 'Egat'),
(39, 'Etampes'),
(40, 'Font romeu'),
(41, 'Gannat'),
(42, 'Gap'),
(43, 'Gourette'),
(44, 'Gunsbach'),
(45, 'Ibos'),
(46, 'Illkirch grafenstaden'),
(47, 'La clusaz'),
(48, 'La ferriere'),
(49, 'La lechere'),
(50, 'La mongie'),
(51, 'La plagne'),
(52, 'La salle les alpes'),
(53, 'Lanslebourg mont cenis'),
(54, 'Laventie'),
(55, 'Le lioran'),
(56, 'Le pont de beauvoisin'),
(57, 'Le praz de lys'),
(58, 'Les 2 alpes'),
(59, 'Les angles'),
(60, 'Les contamines monjoie'),
(61, 'Les contamines montjoie'),
(62, 'Les contamines-montjoie'),
(63, 'Les deux alpes'),
(64, 'Les gets'),
(65, 'Les herbiers'),
(66, 'Les menuires'),
(67, 'Les orres'),
(68, 'Les rousses'),
(69, 'Limoges'),
(70, 'Longjumeau'),
(71, 'Lons'),
(72, 'Loudenvielle'),
(73, 'Luce'),
(74, 'Lucon'),
(75, 'Megeve'),
(76, 'Montgenevre'),
(77, 'Montreuil'),
(78, 'Montriond'),
(79, 'Morzine'),
(80, 'Nemours'),
(81, 'Ozen oisans'),
(82, 'Paris'),
(83, 'Pau'),
(84, 'Pessac'),
(85, 'Plagne aime 2000'),
(86, 'Pontarlier'),
(87, 'Pralognan la vanoise'),
(88, 'Praz sur arly'),
(89, 'Reze'),
(90, 'Rives'),
(91, 'Roanne'),
(92, 'Rodez'),
(93, 'Rouen'),
(94, 'Saint bon tarentaise'),
(95, 'Saint marcel'),
(96, 'Saint medard en jalles'),
(97, 'Saint-herblain'),
(98, 'Saintbontarentaise'),
(99, 'Samoens'),
(100, 'Sarrebourg'),
(101, 'Seclin'),
(102, 'Sierentz'),
(103, 'St francois longchamp'),
(104, 'St gaudens'),
(105, 'Tavers'),
(106, 'Toufflers'),
(107, 'Tournus'),
(108, 'Tulle'),
(109, 'Valberg'),
(110, 'Valloire'),
(111, 'Valmorel'),
(112, 'Vannes'),
(113, 'Varennes sous dun'),
(114, 'Vienne'),
(115, 'Villefranche sur saÃ´ne');

-- --------------------------------------------------------

--
-- Structure de la table `wpqw_commentmeta`
--

CREATE TABLE IF NOT EXISTS `wpqw_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `wpqw_comments`
--

CREATE TABLE IF NOT EXISTS `wpqw_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_author_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`),
  KEY `comment_author_email` (`comment_author_email`(10))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `wpqw_comments`
--

INSERT INTO `wpqw_comments` (`comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`) VALUES
(1, 1, 'A WordPress Commenter', 'wapuu@wordpress.example', 'https://wordpress.org/', '', '2017-01-14 12:47:28', '2017-01-14 12:47:28', 'Hi, this is a comment.\nTo get started with moderating, editing, and deleting comments, please visit the Comments screen in the dashboard.\nCommenter avatars come from <a href="https://gravatar.com">Gravatar</a>.', 0, '1', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `wpqw_links`
--

CREATE TABLE IF NOT EXISTS `wpqw_links` (
  `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_target` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_visible` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_notes` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_rss` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `wpqw_options`
--

CREATE TABLE IF NOT EXISTS `wpqw_options` (
  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `option_value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `autoload` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=128 ;

--
-- Contenu de la table `wpqw_options`
--

INSERT INTO `wpqw_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'siteurl', 'http://tawassolapp.com/wp', 'yes'),
(2, 'home', 'http://tawassolapp.com/wp', 'yes'),
(3, 'blogname', 'My Blog', 'yes'),
(4, 'blogdescription', 'My WordPress Blog', 'yes'),
(5, 'users_can_register', '0', 'yes'),
(6, 'admin_email', 'admin@tawassolapp.com', 'yes'),
(7, 'start_of_week', '1', 'yes'),
(8, 'use_balanceTags', '0', 'yes'),
(9, 'use_smilies', '1', 'yes'),
(10, 'require_name_email', '1', 'yes'),
(11, 'comments_notify', '1', 'yes'),
(12, 'posts_per_rss', '10', 'yes'),
(13, 'rss_use_excerpt', '0', 'yes'),
(14, 'mailserver_url', 'mail.example.com', 'yes'),
(15, 'mailserver_login', 'login@example.com', 'yes'),
(16, 'mailserver_pass', 'password', 'yes'),
(17, 'mailserver_port', '110', 'yes'),
(18, 'default_category', '1', 'yes'),
(19, 'default_comment_status', 'open', 'yes'),
(20, 'default_ping_status', 'open', 'yes'),
(21, 'default_pingback_flag', '1', 'yes'),
(22, 'posts_per_page', '10', 'yes'),
(23, 'date_format', 'F j, Y', 'yes'),
(24, 'time_format', 'g:i a', 'yes'),
(25, 'links_updated_date_format', 'F j, Y g:i a', 'yes'),
(26, 'comment_moderation', '0', 'yes'),
(27, 'moderation_notify', '1', 'yes'),
(28, 'permalink_structure', '/%year%/%monthnum%/%day%/%postname%/', 'yes'),
(29, 'rewrite_rules', 'a:89:{s:11:"^wp-json/?$";s:22:"index.php?rest_route=/";s:14:"^wp-json/(.*)?";s:33:"index.php?rest_route=/$matches[1]";s:21:"^index.php/wp-json/?$";s:22:"index.php?rest_route=/";s:24:"^index.php/wp-json/(.*)?";s:33:"index.php?rest_route=/$matches[1]";s:47:"category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?category_name=$matches[1]&feed=$matches[2]";s:42:"category/(.+?)/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?category_name=$matches[1]&feed=$matches[2]";s:23:"category/(.+?)/embed/?$";s:46:"index.php?category_name=$matches[1]&embed=true";s:35:"category/(.+?)/page/?([0-9]{1,})/?$";s:53:"index.php?category_name=$matches[1]&paged=$matches[2]";s:17:"category/(.+?)/?$";s:35:"index.php?category_name=$matches[1]";s:44:"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?tag=$matches[1]&feed=$matches[2]";s:39:"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?tag=$matches[1]&feed=$matches[2]";s:20:"tag/([^/]+)/embed/?$";s:36:"index.php?tag=$matches[1]&embed=true";s:32:"tag/([^/]+)/page/?([0-9]{1,})/?$";s:43:"index.php?tag=$matches[1]&paged=$matches[2]";s:14:"tag/([^/]+)/?$";s:25:"index.php?tag=$matches[1]";s:45:"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_format=$matches[1]&feed=$matches[2]";s:40:"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_format=$matches[1]&feed=$matches[2]";s:21:"type/([^/]+)/embed/?$";s:44:"index.php?post_format=$matches[1]&embed=true";s:33:"type/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?post_format=$matches[1]&paged=$matches[2]";s:15:"type/([^/]+)/?$";s:33:"index.php?post_format=$matches[1]";s:48:".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$";s:18:"index.php?feed=old";s:20:".*wp-app\\.php(/.*)?$";s:19:"index.php?error=403";s:18:".*wp-register.php$";s:23:"index.php?register=true";s:32:"feed/(feed|rdf|rss|rss2|atom)/?$";s:27:"index.php?&feed=$matches[1]";s:27:"(feed|rdf|rss|rss2|atom)/?$";s:27:"index.php?&feed=$matches[1]";s:8:"embed/?$";s:21:"index.php?&embed=true";s:20:"page/?([0-9]{1,})/?$";s:28:"index.php?&paged=$matches[1]";s:41:"comments/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?&feed=$matches[1]&withcomments=1";s:36:"comments/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?&feed=$matches[1]&withcomments=1";s:17:"comments/embed/?$";s:21:"index.php?&embed=true";s:44:"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?s=$matches[1]&feed=$matches[2]";s:39:"search/(.+)/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?s=$matches[1]&feed=$matches[2]";s:20:"search/(.+)/embed/?$";s:34:"index.php?s=$matches[1]&embed=true";s:32:"search/(.+)/page/?([0-9]{1,})/?$";s:41:"index.php?s=$matches[1]&paged=$matches[2]";s:14:"search/(.+)/?$";s:23:"index.php?s=$matches[1]";s:47:"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?author_name=$matches[1]&feed=$matches[2]";s:42:"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?author_name=$matches[1]&feed=$matches[2]";s:23:"author/([^/]+)/embed/?$";s:44:"index.php?author_name=$matches[1]&embed=true";s:35:"author/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?author_name=$matches[1]&paged=$matches[2]";s:17:"author/([^/]+)/?$";s:33:"index.php?author_name=$matches[1]";s:69:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$";s:80:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]";s:64:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$";s:80:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]";s:45:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$";s:74:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true";s:57:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$";s:81:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]";s:39:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$";s:63:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]";s:56:"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$";s:64:"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]";s:51:"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$";s:64:"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]";s:32:"([0-9]{4})/([0-9]{1,2})/embed/?$";s:58:"index.php?year=$matches[1]&monthnum=$matches[2]&embed=true";s:44:"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$";s:65:"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]";s:26:"([0-9]{4})/([0-9]{1,2})/?$";s:47:"index.php?year=$matches[1]&monthnum=$matches[2]";s:43:"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?year=$matches[1]&feed=$matches[2]";s:38:"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?year=$matches[1]&feed=$matches[2]";s:19:"([0-9]{4})/embed/?$";s:37:"index.php?year=$matches[1]&embed=true";s:31:"([0-9]{4})/page/?([0-9]{1,})/?$";s:44:"index.php?year=$matches[1]&paged=$matches[2]";s:13:"([0-9]{4})/?$";s:26:"index.php?year=$matches[1]";s:58:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:68:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:88:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:83:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:83:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:64:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:53:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/embed/?$";s:91:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&embed=true";s:57:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/trackback/?$";s:85:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&tb=1";s:77:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:97:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&feed=$matches[5]";s:72:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:97:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&feed=$matches[5]";s:65:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/page/?([0-9]{1,})/?$";s:98:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&paged=$matches[5]";s:72:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/comment-page-([0-9]{1,})/?$";s:98:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&cpage=$matches[5]";s:61:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)(?:/([0-9]+))?/?$";s:97:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&page=$matches[5]";s:47:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:57:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:77:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:72:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:72:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:53:"[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:64:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$";s:81:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&cpage=$matches[4]";s:51:"([0-9]{4})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$";s:65:"index.php?year=$matches[1]&monthnum=$matches[2]&cpage=$matches[3]";s:38:"([0-9]{4})/comment-page-([0-9]{1,})/?$";s:44:"index.php?year=$matches[1]&cpage=$matches[2]";s:27:".?.+?/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:37:".?.+?/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:57:".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:33:".?.+?/attachment/([^/]+)/embed/?$";s:43:"index.php?attachment=$matches[1]&embed=true";s:16:"(.?.+?)/embed/?$";s:41:"index.php?pagename=$matches[1]&embed=true";s:20:"(.?.+?)/trackback/?$";s:35:"index.php?pagename=$matches[1]&tb=1";s:40:"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:47:"index.php?pagename=$matches[1]&feed=$matches[2]";s:35:"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$";s:47:"index.php?pagename=$matches[1]&feed=$matches[2]";s:28:"(.?.+?)/page/?([0-9]{1,})/?$";s:48:"index.php?pagename=$matches[1]&paged=$matches[2]";s:35:"(.?.+?)/comment-page-([0-9]{1,})/?$";s:48:"index.php?pagename=$matches[1]&cpage=$matches[2]";s:24:"(.?.+?)(?:/([0-9]+))?/?$";s:47:"index.php?pagename=$matches[1]&page=$matches[2]";}', 'yes'),
(30, 'hack_file', '0', 'yes'),
(31, 'blog_charset', 'UTF-8', 'yes'),
(32, 'moderation_keys', '', 'no'),
(33, 'active_plugins', 'a:0:{}', 'yes'),
(34, 'category_base', '', 'yes'),
(35, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(36, 'comment_max_links', '2', 'yes'),
(37, 'gmt_offset', '0', 'yes'),
(38, 'default_email_category', '1', 'yes'),
(39, 'recently_edited', '', 'no'),
(40, 'template', 'twentyseventeen', 'yes'),
(41, 'stylesheet', 'twentyseventeen', 'yes'),
(42, 'comment_whitelist', '1', 'yes'),
(43, 'blacklist_keys', '', 'no'),
(44, 'comment_registration', '0', 'yes'),
(45, 'html_type', 'text/html', 'yes'),
(46, 'use_trackback', '0', 'yes'),
(47, 'default_role', 'subscriber', 'yes'),
(48, 'db_version', '38590', 'yes'),
(49, 'uploads_use_yearmonth_folders', '1', 'yes'),
(50, 'upload_path', '', 'yes'),
(51, 'blog_public', '1', 'yes'),
(52, 'default_link_category', '2', 'yes'),
(53, 'show_on_front', 'posts', 'yes'),
(54, 'tag_base', '', 'yes'),
(55, 'show_avatars', '1', 'yes'),
(56, 'avatar_rating', 'G', 'yes'),
(57, 'upload_url_path', '', 'yes'),
(58, 'thumbnail_size_w', '150', 'yes'),
(59, 'thumbnail_size_h', '150', 'yes'),
(60, 'thumbnail_crop', '1', 'yes'),
(61, 'medium_size_w', '300', 'yes'),
(62, 'medium_size_h', '300', 'yes'),
(63, 'avatar_default', 'mystery', 'yes'),
(64, 'large_size_w', '1024', 'yes'),
(65, 'large_size_h', '1024', 'yes'),
(66, 'image_default_link_type', 'none', 'yes'),
(67, 'image_default_size', '', 'yes'),
(68, 'image_default_align', '', 'yes'),
(69, 'close_comments_for_old_posts', '0', 'yes'),
(70, 'close_comments_days_old', '14', 'yes'),
(71, 'thread_comments', '1', 'yes'),
(72, 'thread_comments_depth', '5', 'yes'),
(73, 'page_comments', '0', 'yes'),
(74, 'comments_per_page', '50', 'yes'),
(75, 'default_comments_page', 'newest', 'yes'),
(76, 'comment_order', 'asc', 'yes'),
(77, 'sticky_posts', 'a:0:{}', 'yes'),
(78, 'widget_categories', 'a:2:{i:2;a:4:{s:5:"title";s:0:"";s:5:"count";i:0;s:12:"hierarchical";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}', 'yes'),
(79, 'widget_text', 'a:0:{}', 'yes'),
(80, 'widget_rss', 'a:0:{}', 'yes'),
(81, 'uninstall_plugins', 'a:0:{}', 'no'),
(82, 'timezone_string', '', 'yes'),
(83, 'page_for_posts', '0', 'yes'),
(84, 'page_on_front', '0', 'yes'),
(85, 'default_post_format', '0', 'yes'),
(86, 'link_manager_enabled', '0', 'yes'),
(87, 'finished_splitting_shared_terms', '1', 'yes'),
(88, 'site_icon', '0', 'yes'),
(89, 'medium_large_size_w', '768', 'yes'),
(90, 'medium_large_size_h', '0', 'yes'),
(91, 'initial_db_version', '38590', 'yes'),
(92, 'wpqw_user_roles', 'a:5:{s:13:"administrator";a:2:{s:4:"name";s:13:"Administrator";s:12:"capabilities";a:61:{s:13:"switch_themes";b:1;s:11:"edit_themes";b:1;s:16:"activate_plugins";b:1;s:12:"edit_plugins";b:1;s:10:"edit_users";b:1;s:10:"edit_files";b:1;s:14:"manage_options";b:1;s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:6:"import";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:8:"level_10";b:1;s:7:"level_9";b:1;s:7:"level_8";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;s:12:"delete_users";b:1;s:12:"create_users";b:1;s:17:"unfiltered_upload";b:1;s:14:"edit_dashboard";b:1;s:14:"update_plugins";b:1;s:14:"delete_plugins";b:1;s:15:"install_plugins";b:1;s:13:"update_themes";b:1;s:14:"install_themes";b:1;s:11:"update_core";b:1;s:10:"list_users";b:1;s:12:"remove_users";b:1;s:13:"promote_users";b:1;s:18:"edit_theme_options";b:1;s:13:"delete_themes";b:1;s:6:"export";b:1;}}s:6:"editor";a:2:{s:4:"name";s:6:"Editor";s:12:"capabilities";a:34:{s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;}}s:6:"author";a:2:{s:4:"name";s:6:"Author";s:12:"capabilities";a:10:{s:12:"upload_files";b:1;s:10:"edit_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:4:"read";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;s:22:"delete_published_posts";b:1;}}s:11:"contributor";a:2:{s:4:"name";s:11:"Contributor";s:12:"capabilities";a:5:{s:10:"edit_posts";b:1;s:4:"read";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;}}s:10:"subscriber";a:2:{s:4:"name";s:10:"Subscriber";s:12:"capabilities";a:2:{s:4:"read";b:1;s:7:"level_0";b:1;}}}', 'yes'),
(93, 'fresh_site', '1', 'yes'),
(94, 'widget_search', 'a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(95, 'widget_recent-posts', 'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}', 'yes'),
(96, 'widget_recent-comments', 'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}', 'yes'),
(97, 'widget_archives', 'a:2:{i:2;a:3:{s:5:"title";s:0:"";s:5:"count";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}', 'yes'),
(98, 'widget_meta', 'a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(99, 'sidebars_widgets', 'a:5:{s:19:"wp_inactive_widgets";a:0:{}s:9:"sidebar-1";a:6:{i:0;s:8:"search-2";i:1;s:14:"recent-posts-2";i:2;s:17:"recent-comments-2";i:3;s:10:"archives-2";i:4;s:12:"categories-2";i:5;s:6:"meta-2";}s:9:"sidebar-2";a:0:{}s:9:"sidebar-3";a:0:{}s:13:"array_version";i:3;}', 'yes'),
(100, 'widget_pages', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(101, 'widget_calendar', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(102, 'widget_tag_cloud', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(103, 'widget_nav_menu', 'a:1:{s:12:"_multiwidget";i:1;}', 'yes'),
(104, 'cron', 'a:3:{i:1486039648;a:1:{s:16:"wp_version_check";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}}i:1486039653;a:2:{s:17:"wp_update_plugins";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:16:"wp_update_themes";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}}s:7:"version";i:2;}', 'yes'),
(105, 'theme_mods_twentyseventeen', 'a:1:{s:18:"custom_css_post_id";i:-1;}', 'yes'),
(113, '_transient_is_multi_author', '0', 'yes'),
(115, '_site_transient_update_themes', 'O:8:"stdClass":4:{s:12:"last_checked";i:1486030775;s:7:"checked";a:3:{s:13:"twentyfifteen";s:3:"1.7";s:15:"twentyseventeen";s:3:"1.1";s:13:"twentysixteen";s:3:"1.3";}s:8:"response";a:0:{}s:12:"translations";a:0:{}}', 'no'),
(116, '_site_transient_update_plugins', 'O:8:"stdClass":4:{s:12:"last_checked";i:1486030774;s:8:"response";a:0:{}s:12:"translations";a:0:{}s:9:"no_update";a:2:{s:19:"akismet/akismet.php";O:8:"stdClass":6:{s:2:"id";s:2:"15";s:4:"slug";s:7:"akismet";s:6:"plugin";s:19:"akismet/akismet.php";s:11:"new_version";s:3:"3.2";s:3:"url";s:38:"https://wordpress.org/plugins/akismet/";s:7:"package";s:54:"https://downloads.wordpress.org/plugin/akismet.3.2.zip";}s:9:"hello.php";O:8:"stdClass":6:{s:2:"id";s:4:"3564";s:4:"slug";s:11:"hello-dolly";s:6:"plugin";s:9:"hello.php";s:11:"new_version";s:3:"1.6";s:3:"url";s:42:"https://wordpress.org/plugins/hello-dolly/";s:7:"package";s:58:"https://downloads.wordpress.org/plugin/hello-dolly.1.6.zip";}}}', 'no'),
(122, '_site_transient_update_core', 'O:8:"stdClass":4:{s:7:"updates";a:1:{i:0;O:8:"stdClass":10:{s:8:"response";s:6:"latest";s:8:"download";s:65:"https://downloads.wordpress.org/release/fr_FR/wordpress-4.7.2.zip";s:6:"locale";s:5:"fr_FR";s:8:"packages";O:8:"stdClass":5:{s:4:"full";s:65:"https://downloads.wordpress.org/release/fr_FR/wordpress-4.7.2.zip";s:10:"no_content";b:0;s:11:"new_bundled";b:0;s:7:"partial";b:0;s:8:"rollback";b:0;}s:7:"current";s:5:"4.7.2";s:7:"version";s:5:"4.7.2";s:11:"php_version";s:5:"5.2.4";s:13:"mysql_version";s:3:"5.0";s:11:"new_bundled";s:3:"4.7";s:15:"partial_version";s:0:"";}}s:12:"last_checked";i:1486030774;s:15:"version_checked";s:5:"4.7.2";s:12:"translations";a:0:{}}', 'no'),
(123, 'auto_core_update_notified', 'a:4:{s:4:"type";s:7:"success";s:5:"email";s:21:"admin@tawassolapp.com";s:7:"version";s:5:"4.7.2";s:9:"timestamp";i:1485918225;}', 'no'),
(126, '_site_transient_timeout_theme_roots', '1486032574', 'no'),
(127, '_site_transient_theme_roots', 'a:3:{s:13:"twentyfifteen";s:7:"/themes";s:15:"twentyseventeen";s:7:"/themes";s:13:"twentysixteen";s:7:"/themes";}', 'no');

-- --------------------------------------------------------

--
-- Structure de la table `wpqw_postmeta`
--

CREATE TABLE IF NOT EXISTS `wpqw_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `wpqw_postmeta`
--

INSERT INTO `wpqw_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1, 2, '_wp_page_template', 'default');

-- --------------------------------------------------------

--
-- Structure de la table `wpqw_posts`
--

CREATE TABLE IF NOT EXISTS `wpqw_posts` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_excerpt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `post_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `post_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `to_ping` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pinged` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`(191)),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `wpqw_posts`
--

INSERT INTO `wpqw_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(1, 1, '2017-01-14 12:47:28', '2017-01-14 12:47:28', 'Welcome to WordPress. This is your first post. Edit or delete it, then start writing!', 'Hello world!', '', 'publish', 'open', 'open', '', 'hello-world', '', '', '2017-01-14 12:47:28', '2017-01-14 12:47:28', '', 0, 'http://tawassolapp.com/wp/?p=1', 0, 'post', '', 1),
(2, 1, '2017-01-14 12:47:28', '2017-01-14 12:47:28', 'This is an example page. It''s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:\n\n<blockquote>Hi there! I''m a bike messenger by day, aspiring actor by night, and this is my website. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin'' caught in the rain.)</blockquote>\n\n...or something like this:\n\n<blockquote>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</blockquote>\n\nAs a new WordPress user, you should go to <a href="http://tawassolapp.com/wp/wp-admin/">your dashboard</a> to delete this page and create new pages for your content. Have fun!', 'Sample Page', '', 'publish', 'closed', 'open', '', 'sample-page', '', '', '2017-01-14 12:47:28', '2017-01-14 12:47:28', '', 0, 'http://tawassolapp.com/wp/?page_id=2', 0, 'page', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `wpqw_term_relationships`
--

CREATE TABLE IF NOT EXISTS `wpqw_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `wpqw_term_relationships`
--

INSERT INTO `wpqw_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `wpqw_term_taxonomy`
--

CREATE TABLE IF NOT EXISTS `wpqw_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `wpqw_term_taxonomy`
--

INSERT INTO `wpqw_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `wpqw_termmeta`
--

CREATE TABLE IF NOT EXISTS `wpqw_termmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`meta_id`),
  KEY `term_id` (`term_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `wpqw_terms`
--

CREATE TABLE IF NOT EXISTS `wpqw_terms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  KEY `slug` (`slug`(191)),
  KEY `name` (`name`(191))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `wpqw_terms`
--

INSERT INTO `wpqw_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'Uncategorized', 'uncategorized', 0);

-- --------------------------------------------------------

--
-- Structure de la table `wpqw_usermeta`
--

CREATE TABLE IF NOT EXISTS `wpqw_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=15 ;

--
-- Contenu de la table `wpqw_usermeta`
--

INSERT INTO `wpqw_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'nickname', 'admin'),
(2, 1, 'first_name', ''),
(3, 1, 'last_name', ''),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'comment_shortcuts', 'false'),
(7, 1, 'admin_color', 'fresh'),
(8, 1, 'use_ssl', '0'),
(9, 1, 'show_admin_bar_front', 'true'),
(10, 1, 'locale', ''),
(11, 1, 'wpqw_capabilities', 'a:1:{s:13:"administrator";b:1;}'),
(12, 1, 'wpqw_user_level', '10'),
(13, 1, 'dismissed_wp_pointers', ''),
(14, 1, 'show_welcome_panel', '1');

-- --------------------------------------------------------

--
-- Structure de la table `wpqw_users`
--

CREATE TABLE IF NOT EXISTS `wpqw_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`),
  KEY `user_email` (`user_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `wpqw_users`
--

INSERT INTO `wpqw_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'admin', '$P$BnQRMpenFBSARUwrQBBS9fxA2p8yzA/', 'admin', 'admin@tawassolapp.com', '', '2017-01-14 12:47:28', '', 0, 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
