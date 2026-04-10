-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 10 avr. 2026 à 12:27
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `food_lovers`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Cuisine Marocain9'),
(2, 'Desserts'),
(3, 'pizza'),
(5, 'kjsnajdn');

-- --------------------------------------------------------

--
-- Structure de la table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `ingredients` text NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `recipes`
--

INSERT INTO `recipes` (`id`, `title`, `ingredients`, `description`, `user_id`, `category_id`, `created_at`) VALUES
(2, 'Tajine de poulet', 'Poulet, citron confit, olives, ail, oignon, ?pices', 'Un d?licieux tajine marocain mijot? avec des saveurs traditionnelles.', 4, 2, '2026-04-08 22:52:13'),
(3, 'LADANwertyuiop[]', 'Poulet, citron confit, olives, ail, oignon, ?pices', 'Un d?licieux tajine marocain mijot? avec des saveurs traditionnelles.', 4, 2, '2026-04-08 22:54:10'),
(7, 'hsajdgsajydasjkda', 'adxbsadad', 'asjdkhasiuhduias', 2, 2, '2026-04-09 15:17:22'),
(8, 'u', 'dmandkjashdkjashdkhasDJ', 'JNSADOJHASKI', 6, 5, '2026-04-09 15:19:02'),
(9, 'wertyuio99', 'qjhdbjhsvdjh', 'q,mdnqjkwdhuq', 6, 2, '2026-04-09 15:39:18');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','cuisinier') DEFAULT 'cuisinier',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(2, 'admin', 'admin@foodlovers.com', '$2y$10$QhYMoNhcmg2hDOXgJzpzqeSApdR6Urw5vIB8XgpiZjZMJjvg2mpC6', 'admin', '2026-04-07 20:49:09'),
(3, 'kamal', 'kamal@gmail.com', '$2y$10$tEmYrVIG8h3TtAcfVRhmWOyYd9v6oe9KPneRCqDgDvhQ4fAS4aFBe', 'cuisinier', '2026-04-08 15:12:51'),
(4, 'ayman', 'ayman@gmail.com', '$2y$10$BEWRS3quiGD74OKk5qV51.RVjRa/4iFxErm2y6wHnUFa2hfRUIqEO', 'cuisinier', '2026-04-08 15:13:05'),
(6, 'laila', 'laila@gmail.com', '$2y$10$RXpiRXrugKyQCS96kxgZEe/1d3/MZYvcvq4ykNM5GBy0vbXeqYrBm', 'cuisinier', '2026-04-09 14:54:05');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `recipes_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
