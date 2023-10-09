-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 29 sep. 2023 à 17:01
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
-- Base de données : `projet dwwm`
--

-- --------------------------------------------------------

--
-- Structure de la table `age`
--

CREATE TABLE `age` (
  `id` int(11) NOT NULL,
  `age` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `age`
--

INSERT INTO `age` (`id`, `age`) VALUES
(1, '0-5'),
(2, '5-10'),
(3, '10-15'),
(4, '15-20'),
(5, '20-25'),
(6, '25-30');

-- --------------------------------------------------------

--
-- Structure de la table `couleur`
--

CREATE TABLE `couleur` (
  `id` int(11) NOT NULL,
  `couleur` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `couleur`
--

INSERT INTO `couleur` (`id`, `couleur`) VALUES
(1, 'Gris'),
(2, 'Marron'),
(3, 'Noir'),
(14, 'Blanc');

-- --------------------------------------------------------

--
-- Structure de la table `espece`
--

CREATE TABLE `espece` (
  `id` int(11) NOT NULL,
  `espece` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `espece`
--

INSERT INTO `espece` (`id`, `espece`) VALUES
(1, 'Chien'),
(2, 'Chat'),
(14, 'Cheval');

-- --------------------------------------------------------

--
-- Structure de la table `paire`
--

CREATE TABLE `paire` (
  `id` int(11) NOT NULL,
  `ID_U` varchar(50) NOT NULL,
  `ID_M` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `paire`
--

INSERT INTO `paire` (`id`, `ID_U`, `ID_M`) VALUES
(86, 'Jim', 'Boby');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `role` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `age` varchar(50) NOT NULL,
  `espece` varchar(50) NOT NULL,
  `couleur` varchar(50) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `role`, `password`, `email`, `age`, `espece`, `couleur`, `image`, `description`) VALUES
(45, 'Test', '', 'test', 'test@gmail.com', '5-10', 'Chat', 'Noir', 'images/65169bd7c772d_chat_noir1.jpg', 'test'),
(48, 'Boby', '', 'test', 'boby@gmail.com', '0-5', 'Chien', 'Blanc', 'images/65169bc2521d2_chien_blanc.jpg', 'test'),
(49, 'Toby', '', 'test', 'toby@gmail.com', '0-5', 'Chien', 'Blanc', 'images/65169c00e35d0_chien_blanc2.jpg', 'test'),
(50, 'Peter', '', 'test', 'peter@gmail.com', '15-20', 'Cheval', 'Marron', 'images/65169c4b320c5_cheval_marron.jpg', 'test');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `age`
--
ALTER TABLE `age`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `couleur`
--
ALTER TABLE `couleur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `espece`
--
ALTER TABLE `espece`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paire`
--
ALTER TABLE `paire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `age`
--
ALTER TABLE `age`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `couleur`
--
ALTER TABLE `couleur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `espece`
--
ALTER TABLE `espece`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `paire`
--
ALTER TABLE `paire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
