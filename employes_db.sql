-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 28 avr. 2025 à 19:35
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `employes.db`
--

-- --------------------------------------------------------

--
-- Structure de la table `employés`
--

CREATE TABLE `employés` (
  `ID` int(11) NOT NULL,
  `Nom_utilisateur` varchar(255) NOT NULL,
  `motdepasse` varchar(255) NOT NULL,
  `paie` decimal(10,2) DEFAULT 0.00,
  `conges` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `employés`
--

INSERT INTO `employés` (`ID`, `Nom_utilisateur`, `motdepasse`, `paie`, `conges`) VALUES
(1, 'admin', 'admin123', 5000.00, 5),
(2, 'employe1', '1234', 2000.00, 6),
(3, 'employe2', '1234', 8000.00, 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `employés`
--
ALTER TABLE `employés`
  ADD PRIMARY KEY (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
