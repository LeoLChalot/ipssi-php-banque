-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 13 oct. 2024 à 20:53
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `banque`
--

-- --------------------------------------------------------

--
-- Structure de la table `administration`
--

DROP TABLE IF EXISTS `administration`;
CREATE TABLE IF NOT EXISTS `administration` (
  `adminId` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `mdp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`adminId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `clientId` varchar(40) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mdp` varchar(150) NOT NULL,
  `dateCreation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`clientId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`clientId`, `nom`, `prenom`, `telephone`, `email`, `mdp`, `dateCreation`) VALUES
('1\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0', 'Dupont', 'Jean', '0601020304', 'jean.dupont@example.com', 'mot_de_pass', '2024-10-10 14:26:35'),
('2\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0', 'Martin', 'Claire', '0605060708', 'claire.martin@example.com', 'mot_de_pass', '2024-10-10 14:26:35'),
('670bdbd2326d1', 'Larou-Chalot', 'Léo', '0749538494', 'l.larouchalot@gmail.com', '$2y$10$fOqlCDSaMdGi1MdqtLPRg.PznA0BNNpzX2UCK32K6uUrpaeyEM1y2', '2024-10-13 14:40:18');

-- --------------------------------------------------------

--
-- Structure de la table `comptebancaire`
--

DROP TABLE IF EXISTS `comptebancaire`;
CREATE TABLE IF NOT EXISTS `comptebancaire` (
  `compteId` varchar(40) NOT NULL,
  `numeroCompte` varchar(50) NOT NULL,
  `solde` decimal(10,2) DEFAULT '0.00',
  `typeDeCompte` enum('Courant','Epargne','Entreprise') NOT NULL,
  `dateOuverture` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `clientId` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`compteId`),
  UNIQUE KEY `numeroCompte` (`numeroCompte`),
  KEY `clientId` (`clientId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `comptebancaire`
--

INSERT INTO `comptebancaire` (`compteId`, `numeroCompte`, `solde`, `typeDeCompte`, `dateOuverture`, `clientId`) VALUES
('1\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0', 'FR76123456789012', 1500.50, 'Courant', '2024-10-10 14:26:36', '1\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0'),
('2\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0', 'FR76876543210987', 2500.00, 'Epargne', '2024-10-10 14:26:36', '2\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0'),
('670bfa12f3328', 'FR68776158457521', 2700.00, 'Courant', '2024-10-13 16:49:22', '670bdbd2326d1'),
('670c22e2bb6f4', 'FR68890624316226', 2000.00, 'Courant', '2024-10-13 19:43:30', '670bdbd2326d1'),
('670c2433cfe27', 'FR68092999789417', 2000.00, 'Courant', '2024-10-13 19:49:07', '670bdbd2326d1');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comptebancaire`
--
ALTER TABLE `comptebancaire`
  ADD CONSTRAINT `comptebancaire_ibfk_1` FOREIGN KEY (`clientId`) REFERENCES `client` (`clientId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
