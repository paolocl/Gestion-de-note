-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 29 Décembre 2015 à 17:52
-- Version du serveur: 5.5.46-0ubuntu0.14.04.2
-- Version de PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `ecole`
--

-- --------------------------------------------------------

--
-- Structure de la table `eleves`
--

CREATE TABLE IF NOT EXISTS `eleves` (
  `eId` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `cid` int(11) NOT NULL,
  PRIMARY KEY (`eId`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `eleves`
--

INSERT INTO `eleves` (`eId`, `prenom`, `nom`, `cid`) VALUES
(8, 'George', 'Barrere', 10),
(9, 'Sigmound', 'Freud', 7),
(10, 'Edmound', 'Rostande', 7),
(11, 'Jean', 'ValJean', 7),
(12, 'Edgar Allan', 'Poe', 5),
(13, 'John', 'Doe', 9),
(14, 'hello', 'Kitty', 10),
(15, 'edouard', 'jean', 4),
(16, 'henry', 'huite', 4),
(17, 'henry', 'yan', 4),
(18, 'henry', 'yan', 3),
(23, 'Doe', 'John', 9);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `eleves`
--
ALTER TABLE `eleves`
  ADD CONSTRAINT `FK_ELEVES_CLASSES` FOREIGN KEY (`cid`) REFERENCES `classes` (`cid`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
