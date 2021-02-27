-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 27 fév. 2021 à 18:56
-- Version du serveur :  8.0.23
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `smile-it`
--

-- --------------------------------------------------------

--
-- Structure de la table `devices`
--

DROP TABLE IF EXISTS `devices`;
CREATE TABLE IF NOT EXISTS `devices` (
  `ID_Device` int NOT NULL AUTO_INCREMENT,
  `DeviceName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DeviceMac` varchar(17) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID_Device`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `devices`
--

INSERT INTO `devices` (`ID_Device`, `DeviceName`, `DeviceMac`) VALUES
(7, 'Samsung TéléCran 3000', 'B0:5A:DA:FA:BE:61'),
(8, 'Panasonic', '50:01:D9:75:D3:BI'),
(9, 'Samsung Led TéléCran 3000', '50:01:D9:75:D3:BI');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210226083652', '2021-02-26 08:37:57', 205),
('DoctrineMigrations\\Version20210227115706', '2021-02-27 11:58:04', 244);

-- --------------------------------------------------------

--
-- Structure de la table `responses`
--

DROP TABLE IF EXISTS `responses`;
CREATE TABLE IF NOT EXISTS `responses` (
  `ID_Response` int NOT NULL AUTO_INCREMENT,
  `ResponseValue` int DEFAULT NULL,
  `ResponseDate` date DEFAULT NULL,
  `ResponseTime` time DEFAULT NULL,
  `ID_Device` int DEFAULT NULL,
  PRIMARY KEY (`ID_Response`),
  KEY `ID_Device` (`ID_Device`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `responses`
--

INSERT INTO `responses` (`ID_Response`, `ResponseValue`, `ResponseDate`, `ResponseTime`, `ID_Device`) VALUES
(4, NULL, NULL, NULL, 7),
(5, 1, '2021-02-27', '18:38:56', 8),
(6, NULL, NULL, NULL, 9);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `responses`
--
ALTER TABLE `responses`
  ADD CONSTRAINT `FK_315F9F945333E6A0` FOREIGN KEY (`ID_Device`) REFERENCES `devices` (`ID_Device`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
