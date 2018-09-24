-- *******************************************************************************************************************
-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 27 Mai 2018 à 19:03
-- Version du serveur :  5.6.37
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tawassol_codeigniter_dev`
--

-- --------------------------------------------------------

--
-- Structure de la table `absence_retard`
--

CREATE TABLE IF NOT EXISTS `absence_retard` (
  `id` int(11) NOT NULL,
  `niveau` int(11) NOT NULL,
  `idcentre` int(11) NOT NULL,
  `idProf` int(11) NOT NULL,
  `classe` int(11) NOT NULL,
  `groupe` int(11) NOT NULL,
  `matiere` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  `state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `absence_retard_detail`
--

CREATE TABLE IF NOT EXISTS `absence_retard_detail` (
  `id` int(11) NOT NULL,
  `id_absence` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  `absence` int(11) NOT NULL,
  `retard` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `absence_retard`
--
ALTER TABLE `absence_retard`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `absence_retard_detail`
--
ALTER TABLE `absence_retard_detail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `absence_retard`
--
ALTER TABLE `absence_retard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `absence_retard_detail`
--
ALTER TABLE `absence_retard_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
