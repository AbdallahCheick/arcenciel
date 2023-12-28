-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 11 déc. 2023 à 07:29
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `arcenciel_database`
--

-- --------------------------------------------------------

--
-- Structure de la table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE IF NOT EXISTS `blogs` (
  `blog_id` int NOT NULL AUTO_INCREMENT,
  `blog_title` varchar(100) NOT NULL,
  `blog_img` varchar(1000) NOT NULL DEFAULT 'default.png',
  `blog_by` int NOT NULL,
  `blog_cat` int NOT NULL,
  `blog_date` date NOT NULL,
  `blog_content` longtext NOT NULL,
  PRIMARY KEY (`blog_id`),
  KEY `blog_by` (`blog_by`),
  KEY `blog_cat` (`blog_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `idmessage` int NOT NULL AUTO_INCREMENT,
  `nom_message` varchar(50) NOT NULL,
  `prenom_message` varchar(50) NOT NULL,
  `date_message` date NOT NULL,
  `email_message` tinytext NOT NULL,
  `cont_message` longtext NOT NULL,
  PRIMARY KEY (`idmessage`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  `cat_description` varchar(255) NOT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_name_unique` (`cat_name`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idUsers` int NOT NULL AUTO_INCREMENT,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `uidUsers` tinytext NOT NULL,
  `emailUsers` tinytext NOT NULL,
  `pwdUsers` longtext NOT NULL,
  `gender` char(1) NOT NULL,
  `bio` varchar(4000) DEFAULT NULL,
  `userImg` varchar(500) DEFAULT 'default.png',
  PRIMARY KEY (`idUsers`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------
DROP TABLE IF EXISTS `volontaires`;
CREATE TABLE IF NOT EXISTS `volontaires` (
  `idvolontaire` int NOT NULL AUTO_INCREMENT,
  `nom_volontaire` varchar(50) NOT NULL,
  `prenom_volontaire` varchar(50) NOT NULL,
  `email_volontaire` tinytext NOT NULL,
  `cont_volontaire` varchar(4000) DEFAULT NULL,
  `file_volontaire` varchar(500) DEFAULT 'default.png',
  PRIMARY KEY (`idvolontaire`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `photos`;
CREATE TABLE IF NOT EXISTS `photos` (
  `idphoto` int NOT NULL AUTO_INCREMENT,
  `namephoto` varchar(50) NOT NULL,
  `datephoto` date NOT NULL,
  `statut` int(2) NOT NULL,
  `imgphoto` varchar(500) DEFAULT 'default.png',
  PRIMARY KEY (`idphoto`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;


--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`blog_by`) REFERENCES `users` (`idUsers`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blogs_ibfk_2` FOREIGN KEY (`blog_cat`) REFERENCES `categories` (`cat_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
