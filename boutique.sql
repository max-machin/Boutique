-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 02 avr. 2022 à 13:23
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
-- Base de données : `boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `bags`
--

DROP TABLE IF EXISTS `bags`;
CREATE TABLE IF NOT EXISTS `bags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity_product` int(11) NOT NULL DEFAULT '1',
  `id_color` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bags`
--

INSERT INTO `bags` (`id`, `id_user`, `id_product`, `quantity_product`, `id_color`) VALUES
(7, 18, 2, 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'makeup'),
(2, 'skincare');

-- --------------------------------------------------------

--
-- Structure de la table `colors`
--

DROP TABLE IF EXISTS `colors`;
CREATE TABLE IF NOT EXISTS `colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `colors`
--

INSERT INTO `colors` (`id`, `id_product`, `name`, `code`) VALUES
(4, 2, 'marron', '582900 '),
(2, 2, 'rouge', 'BB0B0B'),
(3, 2, 'bordeaux', '6d071a '),
(5, 2, 'violet', '723E64'),
(7, 2, 'grenat', '8B0000');

-- --------------------------------------------------------

--
-- Structure de la table `commands`
--

DROP TABLE IF EXISTS `commands`;
CREATE TABLE IF NOT EXISTS `commands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_command` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity_product` int(11) NOT NULL,
  `id_color` int(11) DEFAULT NULL,
  `price` float NOT NULL,
  `total_price` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `promo` int(11) DEFAULT NULL,
  `adresse_livraison` varchar(255) NOT NULL,
  `adresse_facturation` varchar(255) NOT NULL,
  `price_livraison` float DEFAULT NULL,
  `mode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commands`
--

INSERT INTO `commands` (`id`, `id_command`, `id_user`, `id_product`, `quantity_product`, `id_color`, `price`, `total_price`, `date`, `promo`, `adresse_livraison`, `adresse_facturation`, `price_livraison`, `mode`) VALUES
(72, 1, 13, 3, 1, NULL, 40, 40, '2022-03-13 22:31:20', NULL, '10 Rue Beauvau 13001 Marseille', 'Cooker_13@outlook.fr', 7.99, 'express'),
(73, 2, 13, 2, 2, 3, 15, 30, '2022-03-13 23:01:55', NULL, '10 Rue Beauvau 13001 Marseille', 'Cooker_13@outlook.fr', NULL, NULL),
(74, 2, 13, 2, 4, 5, 15, 60, '2022-03-13 23:01:55', NULL, '10 Rue Beauvau 13001 Marseille', 'Cooker_13@outlook.fr', NULL, NULL),
(75, 2, 13, 2, 2, 4, 15, 30, '2022-03-13 23:01:55', NULL, '10 Rue Beauvau 13001 Marseille', 'Cooker_13@outlook.fr', NULL, NULL),
(76, 3, 13, 2, 3, 2, 15, 45, '2022-03-14 20:38:58', 15, '10 Rue Beauvau 13001 Marseille', 'Cooker_13@outlook.fr', NULL, NULL),
(77, 3, 13, 3, 1, NULL, 40, 40, '2022-03-14 20:38:58', 15, '10 Rue Beauvau 13001 Marseille', 'Cooker_13@outlook.fr', NULL, NULL),
(78, 4, 13, 2, 1, 4, 15, 15, '2022-04-01 15:19:27', NULL, '10 rue beauvau 13001 Marseille', 'b@a.com', 7.99, 'express'),
(79, 4, 13, 2, 1, 2, 15, 15, '2022-04-01 15:19:27', NULL, '10 rue beauvau 13001 Marseille', 'b@a.com', 7.99, 'express'),
(80, 5, 13, 2, 5, 2, 15, 75, '2022-04-01 17:38:56', 15, '10 rue beauvau 13001 Marseille', 'b@a.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `comment` text NOT NULL,
  `note` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `relation_comment_product` (`id_product`),
  KEY `relation_user_comment` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `id_user`, `id_product`, `comment`, `note`, `date`) VALUES
(4, 13, 2, 'wesh\r\n', 5, '2022-02-28 12:48:39'),
(8, 13, 2, 'Sa marche ou quoi?\r\n', 5, '2022-02-28 11:56:10'),
(30, 14, 2, 'Je suis l\'admin et je commente des choses parceque je suis l\'admin', 5, '2022-02-28 15:43:07'),
(32, 17, 4, 'Ca bavouille', 4, '2022-03-02 11:11:29'),
(35, 13, 2, 'Test de note', 3, '2022-03-10 16:13:35'),
(36, 18, 2, 'ok', 4, '2022-04-01 14:08:57'),
(37, 13, 3, 'Je commente', 4, '2022-04-02 11:38:05');

-- --------------------------------------------------------

--
-- Structure de la table `concours`
--

DROP TABLE IF EXISTS `concours`;
CREATE TABLE IF NOT EXISTS `concours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `concours`
--

INSERT INTO `concours` (`id`, `email`, `prenom`, `adresse`) VALUES
(1, 'b@a.com', 'aze', 'aze aze aze'),
(11, 'max.machin@laplateforme.io', 'max', '10 rue beauvau 13001 Marseille'),
(10, 'aze@o.com', 'a', 'a a a');

-- --------------------------------------------------------

--
-- Structure de la table `deliveries`
--

DROP TABLE IF EXISTS `deliveries`;
CREATE TABLE IF NOT EXISTS `deliveries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mode` varchar(255) NOT NULL,
  `delai` varchar(80) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `deliveries`
--

INSERT INTO `deliveries` (`id`, `mode`, `delai`, `price`) VALUES
(3, 'domicile', '7.14 jours', 4.99),
(4, 'express', '24.48 H', 7.99),
(5, 'relais-colis', '14 jours', 2.99);

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

DROP TABLE IF EXISTS `favoris`;
CREATE TABLE IF NOT EXISTS `favoris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `fav` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=167 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`id`, `id_product`, `id_user`, `fav`) VALUES
(165, 2, 13, '1');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `url_image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `relation_img_product` (`id_product`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `id_product`, `url_image`) VALUES
(1, 2, 'lipgloss4.jpeg'),
(2, 2, 'lipgloss3.jpeg'),
(3, 3, 'cream1.jpeg'),
(4, 3, 'cream2.jpeg'),
(5, 5, 'lotion3.jpeg'),
(6, 5, 'lotion5.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `price` float NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_sous_categorie` int(11) NOT NULL,
  `tags` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `relation_product_cat` (`id_categorie`),
  KEY `relation_product_sous_cat` (`id_sous_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `id_categorie`, `id_sous_categorie`, `tags`) VALUES
(2, 'lipgloss', 'glossy glossy', 15, 1, 7, 'gloss,sparkle, lips, dewy'),
(3, 'cream', 'like a \"cream fouettée\"', 40, 2, 1, 'shower,face,primer, moisturizer, moisturizing'),
(4, 'snail saliva', 'bave d\'escargot', 33, 2, 2, 'hydrate, hydrating, dewy, face, serum'),
(5, 'lotion tonique', 'Sa vend des lotions pour payer les cautions', 25, 2, 3, 'face, lotion, daronne à l\'abri ');

-- --------------------------------------------------------

--
-- Structure de la table `sous_categories`
--

DROP TABLE IF EXISTS `sous_categories`;
CREATE TABLE IF NOT EXISTS `sous_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categorie` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `relation_sous_cat` (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sous_categories`
--

INSERT INTO `sous_categories` (`id`, `id_categorie`, `name`) VALUES
(1, 2, 'mosturizer'),
(2, 2, 'serum'),
(3, 2, 'lotion'),
(4, 2, 'cleanser'),
(5, 1, 'face'),
(6, 1, 'eyes'),
(7, 1, 'lips');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `prenom`, `nom`, `password`) VALUES
(1, 'admin@gmail.com', 'admin', 'admin', '$2y$10$Y761JaL5y.o6n0KAZKLPU.SLABNfAcSWEliCNDHFEQ4rF8i503UY6'),
(13, 'b@a.com', 'Max', 'Machin', '$2y$10$YaB7vgszSzxM/ibC7UAxb.cFwIv0/w5/m6UaflH1DQf8uLKf81sE2'),
(14, 'a@a.com', 'Laura', 'Laura', '$2y$10$uMHlkNCyPyQLaPfAqVMidOOFs51VHDD9i26Z6O2mXXuQ5Pw/KJGL6'),
(15, 'Cooker_13@outlook.fr', 'max', 'max', '$2y$10$NzwEl64Xo/UgsfHRQOSnIOlxxu9iODLfM/hzRBoeskoVpDNcjllxa'),
(16, 'max.machin@laplateforme.io', 'max', 'max', '$2y$10$7Dxahhl6qQ2f7ue5QZMt0eGW7jMABNtKZrefoFIM49LLlJGVofLHy'),
(17, 'laura.savickaite@laplateforme.io', 'laura', 'laura', '$2y$10$FOvApXNg9OmENOm73OSpb.m7SKVXWcQjsuUQ6kMUZF1MK0IjU6BgC'),
(18, 'a@gmail.com', 'aze', 'Machin', '$2y$10$PevD5.6PjdVQ9qwGDK0XzuUnlkFQ8hJruN9kd7.Lm/G.ox2Rtg4ES');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `relation_comment_product` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `relation_user_comment` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `relation_img_product` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`);

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `relation_product_cat` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `relation_product_sous_cat` FOREIGN KEY (`id_sous_categorie`) REFERENCES `sous_categories` (`id`);

--
-- Contraintes pour la table `sous_categories`
--
ALTER TABLE `sous_categories`
  ADD CONSTRAINT `relation_sous_cat` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
