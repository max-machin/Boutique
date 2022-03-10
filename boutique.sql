-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 10 mars 2022 à 13:33
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
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

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
(2, 2, 'red', 'BB0B0B'),
(3, 2, 'bordeaux', '6d071a '),
(5, 2, 'violet', '723E64'),
(7, 2, 'darkred', '8B0000');

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
  `price` float NOT NULL,
  `total_price` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `promo` int(11) DEFAULT NULL,
  `adresse_livraison` varchar(255) NOT NULL,
  `adresse_facturation` varchar(255) NOT NULL,
  `id_color` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commands`
--

INSERT INTO `commands` (`id`, `id_command`, `id_user`, `id_product`, `quantity_product`, `price`, `total_price`, `date`, `promo`, `adresse_livraison`, `adresse_facturation`, `id_color`) VALUES
(1, 1, 13, 2, 2, 15, 30, '2022-03-05 15:25:58', NULL, '', '', NULL),
(2, 1, 13, 3, 4, 40, 160, '2022-03-05 15:25:58', NULL, '', '', NULL),
(33, 4, 13, 3, 1, 40, 40, '2022-03-05 17:08:24', NULL, '', '', NULL),
(34, 4, 13, 2, 3, 15, 45, '2022-03-05 17:08:24', NULL, '', '', NULL),
(51, 5, 13, 2, 4, 15, 60, '2022-03-09 20:30:16', 15, '10 Rue Beauvau 13001 Marseille', 'Cooker_13@outlook.fr', 5),
(52, 5, 13, 3, 1, 40, 40, '2022-03-09 20:30:16', 15, '10 Rue Beauvau 13001 Marseille', 'Cooker_13@outlook.fr', NULL),
(53, 5, 13, 2, 5, 15, 75, '2022-03-09 20:30:16', 15, '10 Rue Beauvau 13001 Marseille', 'Cooker_13@outlook.fr', 7),
(54, 6, 13, 2, 4, 15, 60, '2022-03-09 21:39:20', NULL, '10 Rue Beauvau 13001 Marseille', 'Cooker_13@outlook.fr', 5),
(55, 6, 13, 3, 4, 40, 160, '2022-03-09 21:39:20', NULL, '10 Rue Beauvau 13001 Marseille', 'Cooker_13@outlook.fr', NULL),
(56, 7, 1, 2, 1, 15, 15, '2022-03-10 10:46:25', NULL, '10 Rue Beauvau 13001 Marseille', 'Cooker_13@outlook.fr', 2),
(57, 7, 1, 3, 1, 40, 40, '2022-03-10 10:46:26', NULL, '10 Rue Beauvau 13001 Marseille', 'Cooker_13@outlook.fr', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `id_user`, `id_product`, `comment`, `note`, `date`) VALUES
(4, 13, 2, 'wesh\r\n', 5, '2022-02-28 12:48:39'),
(8, 13, 2, 'Sa marche ou quoi?\r\n', 5, '2022-02-28 11:56:10'),
(30, 14, 2, 'Je suis l\'admin et je commente des choses parceque je suis l\'admin', 5, '2022-02-28 15:43:07'),
(32, 17, 4, 'Ca bavouille', 4, '2022-03-02 11:11:29'),
(34, 13, 2, 'izerfnerigherg', 1, '2022-03-08 15:47:12');

-- --------------------------------------------------------

--
-- Structure de la table `deliveries`
--

DROP TABLE IF EXISTS `deliveries`;
CREATE TABLE IF NOT EXISTS `deliveries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL,
  `address_delevery` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`id`, `id_product`, `id_user`, `fav`) VALUES
(88, 2, 13, '1'),
(85, 3, 13, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `id_product`, `url_image`) VALUES
(1, 2, 'balm.jpeg'),
(2, 2, 'balm_.jpeg'),
(3, 3, 'cream1.jpeg'),
(4, 3, 'cream2.jpeg');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `id_categorie`, `id_sous_categorie`, `tags`) VALUES
(2, 'lipgloss', 'glossy glossy', 15, 1, 7, 'gloss,sparkle, lips, dewy'),
(3, 'cream', 'like a \"cream fouettée\"', 40, 2, 1, 'shower,face,primer, moisturizer, moisturizing'),
(4, 'snail saliva', 'bave d\'escargot', 33, 2, 2, 'hydrate, hydrating, dewy, face, serum');

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `prenom`, `nom`, `password`) VALUES
(1, 'admin@gmail.com', 'admin', 'admin', '$2y$10$Y761JaL5y.o6n0KAZKLPU.SLABNfAcSWEliCNDHFEQ4rF8i503UY6'),
(13, 'b@a.com', 'Max', 'Machin', '$2y$10$LpmzxRasxvRHBuv2P5vH9uNcPEEw3smd6XBc32by4rSALYcmknH1m'),
(14, 'a@a.com', 'Laura', 'Laura', '$2y$10$uMHlkNCyPyQLaPfAqVMidOOFs51VHDD9i26Z6O2mXXuQ5Pw/KJGL6'),
(15, 'Cooker_13@outlook.fr', 'max', 'max', '$2y$10$NzwEl64Xo/UgsfHRQOSnIOlxxu9iODLfM/hzRBoeskoVpDNcjllxa'),
(16, 'max.machin@laplateforme.io', 'max', 'max', '$2y$10$v3ciHfPyXuWtXO/rNd/lR.5nXnYHH48dqecyD8CVARl.df6ABYlZy'),
(17, 'laura.savickaite@laplateforme.io', 'laura', 'laura', '$2y$10$FOvApXNg9OmENOm73OSpb.m7SKVXWcQjsuUQ6kMUZF1MK0IjU6BgC');

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
