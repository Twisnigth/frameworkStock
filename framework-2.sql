-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 19 mai 2025 à 18:00
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `framework`
--

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `quantite` int(11) NOT NULL DEFAULT 0,
  `prix_ht` float NOT NULL,
  `prix_ttc` float NOT NULL,
  `taux_tva` float NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `zone_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `quantite`, `prix_ht`, `prix_ttc`, `taux_tva`, `image`, `zone_id`) VALUES
(1, 'Ordinateur portable XPS 15', 25, 1200, 1440, 20, '1747668828_Capture d’écran 2025-05-19 à 17.33.28.png', 1),
(2, 'Écran 27 pouces 4K', 15, 350, 420, 20, '1747668888_Capture d’écran 2025-05-19 à 17.34.33.png', 1),
(3, 'Clavier mécanique RGB', 50, 80, 96, 20, '1747669849_Capture d’écran 2025-05-19 à 17.50.25.png', 2),
(4, 'Souris sans fil ergonomique', 30, 45, 54, 20, '1747669898_Capture d’écran 2025-05-19 à 17.51.22.png', 2),
(5, 'Casque audio Bluetooth', 20, 120, 144, 20, '1747669943_Capture d’écran 2025-05-19 à 17.52.13.png', 3),
(6, 'Disque SSD 1To', 40, 100, 120, 20, '1747670004_Capture d’écran 2025-05-19 à 17.53.04.png', 3),
(7, 'Carte graphique RTX 3080', 10, 800, 960, 20, '1747670084_Capture d’écran 2025-05-19 à 17.54.33.png', 4);

-- --------------------------------------------------------

--
-- Structure de la table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `student`
--

INSERT INTO `student` (`id`, `nom`, `prenom`, `email`) VALUES
(1, 'pd', 'caca', 'caca@p');

-- --------------------------------------------------------

--
-- Structure de la table `zone`
--

CREATE TABLE `zone` (
  `id` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `rue` varchar(255) NOT NULL,
  `code_postal` varchar(10) NOT NULL,
  `ville` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `zone`
--

INSERT INTO `zone` (`id`, `libelle`, `rue`, `code_postal`, `ville`) VALUES
(1, 'Zone A - Entrepôt principal', '12 rue de l\'Industrie', '75001', 'Paris'),
(2, 'Zone B - Stockage sécurisé', '45 avenue des Champs', '75008', 'Paris'),
(3, 'Zone C - Produits fragiles', '8 boulevard Haussmann', '75009', 'Paris'),
(4, 'Zone D - Stockage temporaire', '23 rue du Commerce', '69001', 'Lyon');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produit_zone` (`zone_id`);

--
-- Index pour la table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `zone`
--
ALTER TABLE `zone`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `zone`
--
ALTER TABLE `zone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `fk_produit_zone` FOREIGN KEY (`zone_id`) REFERENCES `zone` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
