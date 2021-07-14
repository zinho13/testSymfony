-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 14 juil. 2021 à 12:59
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_ingenodev`
--

-- --------------------------------------------------------

--
-- Structure de la table `code_postal`
--

DROP TABLE IF EXISTS `code_postal`;
CREATE TABLE IF NOT EXISTS `code_postal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `code_postal`
--

INSERT INTO `code_postal` (`id`, `libelle`, `created_at`, `updated_at`) VALUES
(1, '101', '2021-07-13 05:25:12', '2021-07-13 05:25:12'),
(2, '102', '2021-07-13 05:27:10', '2021-07-13 05:27:10'),
(8, '103', '2021-07-13 10:44:51', '2021-07-13 10:44:51');

-- --------------------------------------------------------

--
-- Structure de la table `dirigeant`
--

DROP TABLE IF EXISTS `dirigeant`;
CREATE TABLE IF NOT EXISTS `dirigeant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `dirigeant`
--

INSERT INTO `dirigeant` (`id`, `nom`, `prenom`, `sexe`, `email`, `created_at`, `updated_at`) VALUES
(1, 'NAMBININTSOA', 'alain zinho', 'Homme', 'nalainzinho12@gmail.com', '2021-07-13 11:41:59', '2021-07-13 11:42:45'),
(2, 'Blaise', 'rayan', 'Homme', 'blaiserayan4@gmail.com', '2021-07-13 22:03:00', '2021-07-13 22:03:00');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210712215639', '2021-07-12 21:56:55', 505);

-- --------------------------------------------------------

--
-- Structure de la table `societe`
--

DROP TABLE IF EXISTS `societe`;
CREATE TABLE IF NOT EXISTS `societe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_postal_id` int(11) DEFAULT NULL,
  `ville_id` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_19653DBDB2B59251` (`code_postal_id`),
  KEY `IDX_19653DBDA73F0036` (`ville_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `societe`
--

INSERT INTO `societe` (`id`, `code_postal_id`, `ville_id`, `nom`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'MADISCO', 'lorem ipsum dolor', '2021-07-13 12:19:44', '2021-07-13 21:35:46'),
(2, 2, 2, 'MADADEV', 'lorem kely', '2021-07-13 13:03:05', '2021-07-13 21:37:43'),
(3, 1, 1, 'ZiDev', 'lorem', '2021-07-13 19:39:18', '2021-07-13 21:37:59'),
(4, 1, 1, 'nextA', 'lorem ip', '2021-07-14 05:14:40', '2021-07-14 05:14:40');

-- --------------------------------------------------------

--
-- Structure de la table `societe_type_societe`
--

DROP TABLE IF EXISTS `societe_type_societe`;
CREATE TABLE IF NOT EXISTS `societe_type_societe` (
  `societe_id` int(11) NOT NULL,
  `type_societe_id` int(11) NOT NULL,
  PRIMARY KEY (`societe_id`,`type_societe_id`),
  KEY `IDX_FB9E3F15FCF77503` (`societe_id`),
  KEY `IDX_FB9E3F15E1F4A326` (`type_societe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `societe_type_societe`
--

INSERT INTO `societe_type_societe` (`societe_id`, `type_societe_id`) VALUES
(1, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `type_societe`
--

DROP TABLE IF EXISTS `type_societe`;
CREATE TABLE IF NOT EXISTS `type_societe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_societe`
--

INSERT INTO `type_societe` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'SARL', '2021-07-13 11:16:22', '2021-07-13 11:16:22'),
(2, 'EURL', '2021-07-13 11:17:03', '2021-07-13 11:17:03'),
(3, 'SELARL', '2021-07-13 11:18:16', '2021-07-13 11:18:16'),
(4, 'SA', '2021-07-13 11:18:39', '2021-07-13 11:18:46');

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

DROP TABLE IF EXISTS `ville`;
CREATE TABLE IF NOT EXISTS `ville` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_postal_id` int(11) DEFAULT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_43C3D9C3B2B59251` (`code_postal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`id`, `code_postal_id`, `libelle`, `created_at`, `updated_at`) VALUES
(1, 1, 'Antananarivo', '2021-07-13 10:22:01', '2021-07-13 10:22:01'),
(2, 2, 'Itaosy', '2021-07-13 10:37:57', '2021-07-13 10:37:57'),
(3, 1, 'Analamahitsy', '2021-07-13 21:38:35', '2021-07-13 21:38:35'),
(4, 2, 'Ampitatafika', '2021-07-13 21:38:57', '2021-07-13 21:38:57'),
(5, 8, 'inconue', '2021-07-13 21:39:35', '2021-07-13 21:39:35');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `societe`
--
ALTER TABLE `societe`
  ADD CONSTRAINT `FK_19653DBDA73F0036` FOREIGN KEY (`ville_id`) REFERENCES `ville` (`id`),
  ADD CONSTRAINT `FK_19653DBDB2B59251` FOREIGN KEY (`code_postal_id`) REFERENCES `code_postal` (`id`);

--
-- Contraintes pour la table `societe_type_societe`
--
ALTER TABLE `societe_type_societe`
  ADD CONSTRAINT `FK_FB9E3F15E1F4A326` FOREIGN KEY (`type_societe_id`) REFERENCES `type_societe` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_FB9E3F15FCF77503` FOREIGN KEY (`societe_id`) REFERENCES `societe` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `ville`
--
ALTER TABLE `ville`
  ADD CONSTRAINT `FK_43C3D9C3B2B59251` FOREIGN KEY (`code_postal_id`) REFERENCES `code_postal` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
