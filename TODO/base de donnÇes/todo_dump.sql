-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 05 Juin 2013 à 16:52
-- Version du serveur: 5.5.31
-- Version de PHP: 5.4.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `todo`
--

-- --------------------------------------------------------

--
-- Structure de la table `multitache`
--

CREATE TABLE IF NOT EXISTS `multitache` (
  `idUser` int(255) NOT NULL,
  `idTodo` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `multitache`
--

INSERT INTO `multitache` (`idUser`, `idTodo`) VALUES
(8, 42),
(7, 39),
(8, 39),
(6, 40),
(8, 42),
(7, 39),
(8, 39),
(6, 40),
(8, 42),
(11, 45),
(11, 46),
(13, 48);

-- --------------------------------------------------------

--
-- Structure de la table `todo`
--

CREATE TABLE IF NOT EXISTS `todo` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `resume` varchar(600) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `limite` date NOT NULL,
  `priorite` int(1) NOT NULL,
  `idProprietaire` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Contenu de la table `todo`
--

INSERT INTO `todo` (`id`, `titre`, `resume`, `limite`, `priorite`, `idProprietaire`) VALUES
(40, 'test du r&eacute;sum&eacute;', 'c''est un test pour les '' et les &quot;', '2013-05-22', 1, 6),
(41, 'Finir le projet JAVA', 'java', '2013-06-10', 5, 8),
(46, 'concert', 'aller au concert', '2014-09-24', 3, 14),
(47, 'wouf', 'sortir e berger allemand', '2013-06-05', 5, 13),
(48, 'coiffeur', 'Se coiffer les cheveux de maniere &eacute;l&eacute;gante', '2013-06-09', 5, 15),
(49, 'Winner', 'battre alexis et devenir major de promo', '2013-06-22', 5, 9),
(50, 'apple', 'r&eacute;parrer mon iphone', '2013-06-25', 1, 9),
(51, 'tache', 'tache', '2013-04-29', 3, 16);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mdp` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `mdp`, `mail`, `admin`) VALUES
(5, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 1),
(6, 'remy', '27152949302e3bd0d681a6f0548912b9', 'devhdmail@gmail.com', 0),
(8, 'vincent', 'b15ab3f829f0f897fe507ef548741afb', 'dejonckheere.vincent@gmail.com', 0),
(9, 'antoine', '0e5091a25295e44fea9957638527301f', 'antoine@antoine.com', 0),
(11, 'dylan', '4f97319b308ed6bd3f0c195c176bbd77', 'dylan@dylan.com', 0),
(13, 'maxime', 'b238c13e822536cad3ac57a2280fbf45', 'maxime@maxime.com', 0),
(14, 'alexandre', '3d65fd70d95a4edfe9555d0ebeca2b17', 'alex@alex.com', 0),
(15, 'kivin', '409225ec4ba2f694b3cd903a2b05a387', 'kivin@kivin.com', 0),
(16, 'test', '098f6bcd4621d373cade4e832627b4f6', 't@t', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
