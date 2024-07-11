-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 11 juil. 2024 à 17:21
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
-- Base de données : `jungpal`
--

-- --------------------------------------------------------

--
-- Structure de la table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `party` varchar(3) DEFAULT NULL,
  `garden` varchar(3) DEFAULT NULL,
  `cleaning` varchar(3) DEFAULT NULL,
  `rooms` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `size` decimal(10,2) DEFAULT NULL,
  `internet` varchar(3) DEFAULT NULL,
  `deposit` decimal(10,2) DEFAULT NULL,
  `campus_time` int(11) DEFAULT NULL,
  `visible` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ads`
--

INSERT INTO `ads` (`id`, `party`, `garden`, `cleaning`, `rooms`, `price`, `size`, `internet`, `deposit`, `campus_time`, `visible`, `user_id`) VALUES
(32, 'no', 'no', 'no', 4, 340.00, 14.00, 'yes', 680.00, 42, 1, 12),
(33, 'yes', 'yes', 'yes', 3, 300.00, 10.00, 'no', 600.00, 0, 1, 13),
(35, 'yes', 'no', 'no', 3, 320.00, 15.00, 'yes', 640.00, 18, 1, 14);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `gender`, `dob`, `address`, `city`, `postal_code`, `email`, `password`) VALUES
(12, 'Léon', 'Goretzka', 'Male', '1995-02-06', 'Allianz Arena', 'Munich', '80', 'leon.goretzka@gmail.com', '08'),
(13, 'Joshua', 'Kimmich', 'Male', '1995-02-06', 'Allianz Arena', 'munich', '80', 'joshua.kimmich@gmail.com', '06'),
(14, 'Manuel', 'Neuer', 'Male', '1986-03-27', 'Allianz Arena', 'Munich', '80', 'manuel.neuer@gmail.com', '01');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ads`
--
ALTER TABLE `ads`
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
-- AUTO_INCREMENT pour la table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
