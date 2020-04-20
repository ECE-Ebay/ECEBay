-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 20 avr. 2020 à 15:48
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `test_items`
--

-- --------------------------------------------------------

--
-- Structure de la table `carte_banquaire`
--

DROP TABLE IF EXISTS `carte_banquaire`;
CREATE TABLE IF NOT EXISTS `carte_banquaire` (
  `id_membre` int(11) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adresse` text NOT NULL,
  `ville` text NOT NULL,
  `numtel` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `numerocarte` varchar(255) NOT NULL,
  `nomcarte` varchar(255) NOT NULL,
  `moicarte` varchar(255) NOT NULL,
  `anneecarte` varchar(255) NOT NULL,
  `cvv` varchar(255) NOT NULL,
  `argent` float NOT NULL,
  PRIMARY KEY (`id_membre`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `carte_banquaire`
--

INSERT INTO `carte_banquaire` (`id_membre`, `prenom`, `nom`, `email`, `adresse`, `ville`, `numtel`, `zip`, `numerocarte`, `nomcarte`, `moicarte`, `anneecarte`, `cvv`, `argent`) VALUES
(8, 'Laure', 'Setbon', 'laure.setbon@edu.ece.fr', '3 bis rue de la Citadelle', 'Pontoise', '0666666666', '95300', '1111222233334444', 'Setbon Laure', '02', '2021', '123', 999945),
(12, 'Laure', 'Setbon', 'laure.setbon@edu.ece.fr', '3 bis rue de la Citadelle', 'Pontoise', '0666666666', '95300', '1111222233334444', 'Setbon Laure', '02', '2021', '123', 999608),
(14, 'Tom', 'Setbon', 'machin.truc@gmail', '3 bis rue de la Citadelle', 'Pontoise', '0666666666', '95300', '1111222233334444', 'Tom', '02', '2021', '123', 1000000),
(15, 'Laure', 'Setbon', 'laure.setbon@edu.ece.fr', '3 bis rue de la Citadelle', 'Pontoise', '0666666666', '95300', '1111222233334444', 'Setbon Laure', '02', '2021', '123', 1000000);

-- --------------------------------------------------------

--
-- Structure de la table `enchere`
--

DROP TABLE IF EXISTS `enchere`;
CREATE TABLE IF NOT EXISTS `enchere` (
  `id_item` int(11) NOT NULL,
  `date_debut` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_fin` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `enchere`
--

INSERT INTO `enchere` (`id_item`, `date_debut`, `date_fin`) VALUES
(36, '2020-04-19 13:39:48', '2021-01-01 02:02:26'),
(36, '2020-04-19 13:43:34', '2021-01-01 01:01:15'),
(37, '2020-04-19 16:14:09', '2020-04-19 20:30:42'),
(38, '2020-04-19 17:36:21', '2020-04-19 21:41:50'),
(39, '2020-04-19 17:38:52', '2020-04-19 21:45:36'),
(40, '2020-04-19 17:41:35', '2020-04-19 21:45:15'),
(40, '2020-04-19 17:43:49', '2020-04-19 21:50:22'),
(41, '2020-04-19 17:44:30', '2020-04-19 21:44:14'),
(42, '2020-04-19 17:51:15', '2020-04-19 21:51:49'),
(43, '2020-04-19 17:53:14', '2020-04-19 21:55:00'),
(44, '2020-04-19 18:06:18', '2020-04-19 22:15:00'),
(45, '2020-04-19 18:47:03', '2020-04-19 22:52:31'),
(46, '2020-04-19 18:55:12', '2020-04-19 22:59:22'),
(47, '2020-04-19 19:17:14', '2020-04-19 23:23:51'),
(48, '2020-04-19 19:34:31', '2020-04-19 23:38:02'),
(49, '2020-04-19 19:43:37', '2020-04-19 23:46:13'),
(50, '2020-04-19 20:13:16', '2020-04-20 00:15:50'),
(51, '2020-04-19 20:27:22', '2020-04-20 00:27:20'),
(52, '2020-04-19 20:32:20', '2020-04-20 00:33:59'),
(54, '2020-04-19 23:10:58', '2020-04-20 01:11:27'),
(55, '2020-04-19 23:13:01', '2020-04-20 01:15:40'),
(56, '2020-04-20 12:12:15', '2020-04-20 14:12:58'),
(57, '2020-04-20 15:35:45', '2020-04-20 17:35:32'),
(58, '2020-04-20 15:37:06', '2020-04-20 17:40:24');

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `id_vendeur` int(11) NOT NULL,
  `marque` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `categorie` int(11) NOT NULL,
  `prix_initial` float NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `statut` int(11) NOT NULL,
  `id_acheteur` int(11) NOT NULL,
  `type_vente` int(11) NOT NULL,
  `modele` varchar(255) NOT NULL,
  PRIMARY KEY (`id_item`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `items`
--

INSERT INTO `items` (`id_item`, `id_vendeur`, `marque`, `description`, `categorie`, `prix_initial`, `date`, `statut`, `id_acheteur`, `type_vente`, `modele`) VALUES
(1, 4, 'peugeot', 'cool', 2, 5000, '2020-04-16 00:00:00', 0, 1, 1, 'aucune idée'),
(27, 11, 'marque6', 'km ', 1, 2, '2020-04-19 16:20:47', 0, 0, 1, 'modele6'),
(4, 4, 'marque1', 'jdfbwdojfb', 1, 2, '2020-04-18 21:28:30', 0, 0, 1, 'modele1'),
(56, 11, 'marque1', 'jh', 1, 2, '2020-04-20 14:11:58', 1, 0, 1, 'modele1'),
(24, 11, 'marque1', ' lh ', 1, 2, '2020-04-19 16:19:17', 0, 0, 1, 'zef'),
(23, 11, 'marque1', ' lh ', 1, 2, '2020-04-19 16:17:36', 0, 0, 1, 'zef'),
(57, 11, 'marque1', 'iuh', 1, 4, '2020-04-20 17:35:31', 1, 0, 1, 'modele1'),
(10, 4, 'marque6', 'JYFXIYT', 2, 5, '2020-04-18 22:14:06', 0, 0, 2, 'modele6'),
(19, 11, 'marque1', 'mjmjob ', 1, 2, '2020-04-19 15:07:51', 0, 0, 3, 'modele6'),
(13, 4, 'qejgb', 'qzrgljb', 1, 3, '2020-04-18 22:18:53', 0, 0, 1, 'zef'),
(37, 11, 'marque6', 'fcikkkn', 1, 2, '2020-04-19 20:13:42', 1, 0, 1, 'modele6'),
(18, 4, 'qejgb', 'kn ', 1, 2, '2020-04-19 11:31:36', 0, 0, 2, 'modele6'),
(17, 4, 'f', 'eg', 1, 2, '2020-04-18 22:57:24', 0, 0, 1, 'sdf'),
(28, 11, 'marque6', 'km ', 1, 2, '2020-04-19 16:28:17', 0, 0, 1, 'modele6'),
(29, 11, 'marque6', 'km ', 1, 2, '2020-04-19 16:29:04', 0, 0, 1, 'modele6'),
(30, 11, 'marque6', 'km ', 1, 2, '2020-04-19 16:32:16', 0, 0, 1, 'modele6'),
(31, 11, 'marque6', 'km ', 1, 2, '2020-04-19 16:32:26', 0, 0, 1, 'modele6'),
(32, 11, 'marque6', 'km ', 1, 2, '2020-04-19 16:32:50', 0, 0, 1, 'modele6'),
(33, 11, 'marque6', 'km ', 1, 2, '2020-04-19 16:34:05', 0, 0, 1, 'modele6'),
(34, 11, 'qejgb', 'mkj ', 1, 5, '2020-04-19 16:36:27', 0, 0, 1, 'zef'),
(35, 11, 'marque1', 'kj ', 1, 2, '2020-04-19 17:24:05', 0, 0, 1, 'modele1'),
(36, 11, 'marque1', 'kj ', 1, 2, '2020-04-19 17:39:26', 1, 0, 1, 'modele1'),
(38, 12, 'qejgb', 'qzibqpufb', 1, 40, '2020-04-19 21:35:50', 1, 0, 1, 'yfxlyfvl'),
(39, 12, 'marque1', 'LHVL', 1, 4, '2020-04-19 21:38:36', 1, 0, 1, 'modele1'),
(40, 12, 'marque1', 'F', 1, 3, '2020-04-19 21:41:15', 1, 0, 1, 'modele1'),
(41, 12, 'marque1', 'F', 1, 3, '2020-04-19 21:44:14', 1, 0, 1, 'modele1'),
(42, 12, 'marque1', 'jl', 1, 2, '2020-04-19 21:50:49', 1, 0, 1, 'modele1'),
(43, 11, 'marque1', 'ohho', 1, 3, '2020-04-19 21:53:00', 1, 0, 1, 'modele1'),
(44, 11, 'marque1', 'lihv', 1, 2, '2020-04-19 22:06:00', 1, 0, 1, 'modele1'),
(45, 11, 'marque1', 'fr', 1, 2, '2020-04-19 22:46:31', 1, 0, 1, 'modele1'),
(46, 11, 'marque1', 'lmkn', 1, 2, '2020-04-19 22:54:22', 1, 0, 1, 'modele1'),
(47, 11, 'marque6', 'j', 1, 2, '2020-04-19 23:16:51', 1, 12, 1, 'zef'),
(48, 11, 'f', 'k', 1, 3, '2020-04-19 23:34:02', 1, 0, 1, 'sdf'),
(49, 11, 'marque1', 'b', 1, 3, '2020-04-19 23:43:13', 1, 8, 1, 'modele1'),
(50, 11, 'marque1', 'HG', 1, 2, '2020-04-20 00:12:50', 1, 0, 1, 'modele1'),
(51, 11, 'marque1', 'j', 1, 2, '2020-04-20 00:25:20', 1, 0, 1, 'modele1'),
(52, 11, 'marque1', 'k', 1, 2, '2020-04-20 00:31:58', 1, 0, 1, 'modele1'),
(53, 11, 'marque1', 'dfg', 1, 2, '2020-04-20 01:06:50', 0, 0, 1, 'modele1'),
(54, 11, 'marque1', 'k', 1, 2, '2020-04-20 01:10:27', 1, 0, 1, 'modele1'),
(55, 11, 'marque1', 'KN', 1, 2, '2020-04-20 01:12:40', 1, 8, 1, 'modele1'),
(58, 11, 'marque1', 'OIJ', 1, 3, '2020-04-20 17:36:24', 1, 12, 1, 'modele6');

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

DROP TABLE IF EXISTS `membres`;
CREATE TABLE IF NOT EXISTS `membres` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `motdepasse` text NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id_utilisateur`, `pseudo`, `mail`, `motdepasse`) VALUES
(12, 'laure', 'laure.setbon@gmail.com', '403926033d001b5279df37cbbe5287b7c7c267fa'),
(13, 'tomtom95', 'thomas.setbon@gmail.com', '403926033d001b5279df37cbbe5287b7c7c267fa'),
(11, 'pikachu', 'pikachu.test@edu.ece.fr', '403926033d001b5279df37cbbe5287b7c7c267fa'),
(10, 'lahkyk', 'laure.setbon@edu.ece.fr', '403926033d001b5279df37cbbe5287b7c7c267fa'),
(14, 'destructeur_des_mondes', 'machin.truc@gmail.com', '403926033d001b5279df37cbbe5287b7c7c267fa'),
(15, 'lqmof', 'truc.machin@gmail.com', '403926033d001b5279df37cbbe5287b7c7c267fa');

-- --------------------------------------------------------

--
-- Structure de la table `offre_enchere`
--

DROP TABLE IF EXISTS `offre_enchere`;
CREATE TABLE IF NOT EXISTS `offre_enchere` (
  `id_offre` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) NOT NULL,
  `id_acheteur` int(11) NOT NULL,
  `offre` float NOT NULL,
  PRIMARY KEY (`id_offre`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `offre_enchere`
--

INSERT INTO `offre_enchere` (`id_offre`, `id_item`, `id_acheteur`, `offre`) VALUES
(1, 36, 8, 5),
(2, 36, 11, 5),
(3, 36, 11, 2),
(4, 36, 8, 67),
(5, 37, 8, 2),
(6, 37, 12, 500),
(7, 37, 12, 40),
(8, 37, 8, 60),
(9, 44, 8, 34),
(10, 44, 12, 123),
(11, 45, 12, 23),
(12, 45, 8, 234),
(13, 47, 8, 156),
(14, 47, 12, 234),
(15, 48, 12, 23),
(16, 48, 8, 25),
(17, 49, 8, 21),
(18, 49, 12, 19),
(19, 55, 12, 34),
(20, 55, 8, 234),
(21, 58, 8, 234),
(22, 58, 12, 567);

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE IF NOT EXISTS `photos` (
  `id_item` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_url` varchar(255) NOT NULL,
  `id_photo` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_photo`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `photos`
--

INSERT INTO `photos` (`id_item`, `name`, `file_url`, `id_photo`) VALUES
(19, '2.png', 'photos/2.png', 21),
(4, '5d128574e07000fefcbfd8efc5a4d24faad1058a_hq.jpg', 'photos/5d128574e07000fefcbfd8efc5a4d24faad1058a_hq.jpg', 2),
(4, '5d128574e07000fefcbfd8efc5a4d24faad1058a_hq.jpg', 'photos/5d128574e07000fefcbfd8efc5a4d24faad1058a_hq.jpg', 3),
(4, 'tumblr_n2v6qjUVO81rw7u8ro3_500.png', 'photos/tumblr_n2v6qjUVO81rw7u8ro3_500.png', 4),
(10, 'tumblr_n2v6qjUVO81rw7u8ro3_500.png', 'photos/tumblr_n2v6qjUVO81rw7u8ro3_500.png', 5),
(11, '49.jpg', 'photos/49.jpg', 6),
(12, '49.jpg', 'photos/49.jpg', 7),
(13, '49.jpg', 'photos/49.jpg', 8),
(19, '1.png', 'photos/1.png', 20),
(18, '6.png', 'photos/6.png', 19),
(18, '37.png', 'photos/37.png', 18),
(1, 'tumblr_n2v6qjUVO81rw7u8ro2_500.png', 'photos/tumblr_n2v6qjUVO81rw7u8ro2_500.png', 12),
(1, 'tobeno__hatchling_fakemon_by_smiley_fakemon_d94g3br-pre.png', 'photos/tobeno__hatchling_fakemon_by_smiley_fakemon_d94g3br-pre.png', 13),
(1, 'squirtle_redesign_by_devildman_dd7zwyv-pre.jpg', 'photos/squirtle_redesign_by_devildman_dd7zwyv-pre.jpg', 14),
(17, 'tumblr_n2v6qjUVO81rw7u8ro2_500.png', 'photos/tumblr_n2v6qjUVO81rw7u8ro2_500.png', 15),
(17, 'tobeno__hatchling_fakemon_by_smiley_fakemon_d94g3br-pre.png', 'photos/tobeno__hatchling_fakemon_by_smiley_fakemon_d94g3br-pre.png', 16),
(17, 'squirtle_redesign_by_devildman_dd7zwyv-pre.jpg', 'photos/squirtle_redesign_by_devildman_dd7zwyv-pre.jpg', 17),
(20, '27.png', 'photos/27.png', 22),
(21, '27.png', 'photos/27.png', 23),
(22, '27.png', 'photos/27.png', 24),
(23, '27.png', 'photos/27.png', 25),
(24, '27.png', 'photos/27.png', 26),
(25, '27.png', 'photos/27.png', 27),
(26, '27.png', 'photos/27.png', 28),
(27, '1.png', 'photos/1.png', 29),
(28, '1.png', 'photos/1.png', 30),
(29, '1.png', 'photos/1.png', 31),
(30, '1.png', 'photos/1.png', 32),
(31, '1.png', 'photos/1.png', 33),
(32, '1.png', 'photos/1.png', 34),
(33, '1.png', 'photos/1.png', 35),
(34, '4.png', 'photos/4.png', 36),
(35, '24.png', 'photos/24.png', 37),
(36, '24.png', 'photos/24.png', 38),
(37, '1.png', 'photos/1.png', 39),
(38, '9d1ee25f5f219d563c1435229c0721ab9535c600_hq.jpg', 'photos/9d1ee25f5f219d563c1435229c0721ab9535c600_hq.jpg', 40),
(39, '5.png', 'photos/5.png', 41),
(40, '1.png', 'photos/1.png', 42),
(41, '1.png', 'photos/1.png', 43),
(42, '5.png', 'photos/5.png', 44),
(43, '5d128574e07000fefcbfd8efc5a4d24faad1058a_hq.jpg', 'photos/5d128574e07000fefcbfd8efc5a4d24faad1058a_hq.jpg', 45),
(44, '1.png', 'photos/1.png', 46),
(45, '1.png', 'photos/1.png', 47),
(46, '6.png', 'photos/6.png', 48),
(47, '008___pholge_by_pokeluka-d5gvj44.png', 'photos/008___pholge_by_pokeluka-d5gvj44.png', 49),
(48, '14.png', 'photos/14.png', 50),
(49, '15.png', 'photos/15.png', 51),
(50, '007___finniped_by_pokeluka-d5gviru.png', 'photos/007___finniped_by_pokeluka-d5gviru.png', 52),
(51, '4.png', 'photos/4.png', 53),
(52, '3.png', 'photos/3.png', 54),
(53, '11.png', 'photos/11.png', 55),
(54, 'fakemon_commission___aron_by_devildman_ddn4aw5-pre.jpg', 'photos/fakemon_commission___aron_by_devildman_ddn4aw5-pre.jpg', 56),
(55, '1.png', 'photos/1.png', 57),
(56, '1.png', 'photos/1.png', 58),
(57, '19.png', 'photos/19.png', 59),
(58, '3.png', 'photos/3.png', 60);

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

DROP TABLE IF EXISTS `vendeur`;
CREATE TABLE IF NOT EXISTS `vendeur` (
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `imgfond_nom` varchar(255) NOT NULL,
  `imgfond_url` varchar(255) NOT NULL,
  `imgprofil_nom` varchar(255) NOT NULL,
  `imgprofil_url` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vendeur`
--

INSERT INTO `vendeur` (`id_utilisateur`, `nom`, `prenom`, `imgfond_nom`, `imgfond_url`, `imgprofil_nom`, `imgprofil_url`) VALUES
(6, 'e', 'e', '1.png', 'photos/1.png', '2.png', 'photos/2.png'),
(9, 'Setbon', 'e', 'fakemon___steel_eeveelution_by_devildman_dd1fpy2-pre.jpg', 'photos/fakemon___steel_eeveelution_by_devildman_dd1fpy2-pre.jpg', 'fakemon___pikosan_bayleef_by_devildman_dcmzudm-pre.jpg', 'photos/fakemon___pikosan_bayleef_by_devildman_dcmzudm-pre.jpg'),
(11, 'ketchum', 'ash', '2.png', 'photos/2.png', '9.png', 'photos/9.png'),
(13, 'Setbon', 'e', '14.png', 'photos/14.png', '16.png', 'photos/16.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
