-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 07 fév. 2022 à 10:52
-- Version du serveur : 5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `biblioDB2`
--

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `summary` varchar(1000) NOT NULL,
  `release_date` date NOT NULL,
  `category` varchar(50) NOT NULL,
  `for_child` tinyint(1) NOT NULL,
  `aivalable` tinyint(1) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `summary`, `release_date`, `category`, `for_child`, `aivalable`, `client_id`) VALUES
(2, 'Azincourt par temps de Pluie', 'Jean Teulé', 'Azincourt, un joli nom de village..', '2022-02-03', 'broché', 0, 1, 1),
(5, 'Les Royaumes de Feu', 'Tui T. Sutherland', 'La jeune reine Avalanche est sur le pied de guerre : une horde de dragons de clans inconnus ...', '2022-02-03', 'roman jeunesse', 1, 0, NULL),
(6, 'Largo Winch T.22', 'Eric Giacommeti', 'Bd', '2022-02-24', 'Bande dessiné', 0, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `books_clients`
--

CREATE TABLE `books_clients` (
  `books_id` int(11) NOT NULL,
  `clients_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `borrow`
--

CREATE TABLE `borrow` (
  `id` int(11) NOT NULL,
  `books_id` int(11) DEFAULT NULL,
  `clients_id` int(11) DEFAULT NULL,
  `date_loan` datetime NOT NULL,
  `date_rendered` datetime DEFAULT NULL,
  `date_rendred_max` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `borrow`
--

INSERT INTO `borrow` (`id`, `books_id`, `clients_id`, `date_loan`, `date_rendered`, `date_rendred_max`) VALUES
(1, 2, 2, '2022-02-04 08:30:01', NULL, '2022-02-19 08:30:01'),
(2, 6, 7, '2022-02-04 08:35:09', NULL, '2022-02-19 08:35:09');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `birth_date` date NOT NULL,
  `adress` varchar(95) NOT NULL,
  `city` varchar(35) NOT NULL,
  `mail` varchar(62) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `first_name`, `last_name`, `birth_date`, `adress`, `city`, `mail`, `phone`) VALUES
(1, 'Leboiteux', 'Romain', '1980-06-01', '171 rue Anthime Renard', 'Préaux', 'toto@gmail.com', '0684133956'),
(2, 'fortier', 'Emilie', '1983-03-20', '171 rue Anthime Renard', 'Préaux', 'tata@gmail.com', '0600000000'),
(7, 'vieuxbled', 'David', '2017-01-01', 'hjhkk', 'jkjkjkj', 'toto3@gmail.com', '060300000');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220201145655', '2022-02-01 14:57:14', 33),
('DoctrineMigrations\\Version20220203094827', '2022-02-03 09:48:43', 176),
('DoctrineMigrations\\Version20220203125627', '2022-02-03 12:56:46', 294),
('DoctrineMigrations\\Version20220207103200', '2022-02-07 10:32:11', 37),
('DoctrineMigrations\\Version20220207105127', '2022-02-07 10:51:39', 129);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `FK_client_id` (`client_id`);

--
-- Index pour la table `books_clients`
--
ALTER TABLE `books_clients`
  ADD PRIMARY KEY (`books_id`,`clients_id`),
  ADD KEY `IDX_9BAA8E77DD8AC20` (`books_id`),
  ADD KEY `IDX_9BAA8E7AB014612` (`clients_id`);

--
-- Index pour la table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_55DBA8B07DD8AC20` (`books_id`),
  ADD KEY `IDX_55DBA8B0AB014612` (`clients_id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `books_clients`
--
ALTER TABLE `books_clients`
  ADD CONSTRAINT `FK_9BAA8E77DD8AC20` FOREIGN KEY (`books_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `FK_9BAA8E7AB014612` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`);

--
-- Contraintes pour la table `borrow`
--
ALTER TABLE `borrow`
  ADD CONSTRAINT `FK_55DBA8B07DD8AC20` FOREIGN KEY (`books_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `FK_55DBA8B0AB014612` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
