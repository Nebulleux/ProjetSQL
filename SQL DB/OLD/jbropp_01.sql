-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 09 nov. 2022 à 09:56
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `jbropp_01`
--

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `catégorie` varchar(255) NOT NULL,
  `libellé` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `poids` varchar(255) NOT NULL,
  `couleur` varchar(255) NOT NULL,
  `dimensions` varchar(255) NOT NULL,
  `diamètre_filament` varchar(255) NOT NULL,
  `précision` varchar(255) NOT NULL,
  `temperature_transi_vitreuse` varchar(255) NOT NULL,
  `temperature_point_de_fusion` text NOT NULL,
  `prix_HT` int(11) NOT NULL,
  `image` text NOT NULL,
  `rate` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `catégorie`, `libellé`, `description`, `poids`, `couleur`, `dimensions`, `diamètre_filament`, `précision`, `temperature_transi_vitreuse`, `temperature_point_de_fusion`, `prix_HT`, `image`, `rate`) VALUES
(1, 'bobine', 'PLA', 'Constituant une valeur sûre à prix serré, cette bobine de PLA rouge conviendra parfaitement pour les usages de prototypage rapide et pièces esthétiques. A la recherche dun PLA de bonne qualité, abordable et fabriqué en Europe ? Cette gamme est faite pour ', '1kg', 'rouge', '21x9x20', '1.75mm', '0.05mm', '55-60°C', '150-180°C', 15, 'https://www.filimprimante3d.fr/3886-thickbox_default/fil-dailyfil-pla-500g-175-mm-rouge.jpg', NULL),
(2, 'bobine', 'ABS', 'Constituant une valeur sûre à prix serré, cette bobine d ABS verte conviendra parfaitement pour les usages de prototypage rapide et pièces esthétiques. A la recherche dun PLA de bonne qualité, abordable et fabriqué en Europe ? Cette gamme est faite pour v', '1kg', 'vert', '21x9x20', '2.85mm', '0.05mm', '55-60°C', '150-180°C', 16, 'https://www.filimprimante3d.fr/5153-thickbox_default/filament-50g-dailyfil-abs-285-mm-vert.jpg', NULL),
(3, 'bobine', 'PETG', 'Constituant une valeur sûre à prix serré, cette bobine de PETG bleue conviendra parfaitement pour les usages de prototypage rapide et pièces esthétiques. A la recherche dun PLA de bonne qualité, abordable et fabriqué en Europe ? Cette gamme est faite pour', '500g', 'bleu', '21x9x20', '1.75mm', '0.05mm', '55-60°C', '150-180°C', 17, 'https://www.filimprimante3d.fr/5612-thickbox_default/petg-bleu-175-mm-verbatim-1kg.jpg', NULL),
(4, 'machine', 'imprimante 3D Ultimaker S5', 'L Ultimaker S5 est une imprimante de bureau performante présentant un grand volume d impression (330 x 240 x 300 mm), une fiabilité renforcée ainsi que de nouvelles fonctionnalités pour une expérience utilisateur intuitive.\r\nElle offre des possibilités d ', '18kg', 'blanc', '33x24x30', '', '', '', '', 4900, 'https://www.erm-fabtest.com/180-large_default/ultimaker-s5.jpg', NULL),
(12, 'template', 'template', 'template', 'template', 'template', 'template', 'template', 'template', 'template', 'template', 1200, 'template', NULL),
(14, 'Machine', 'gf', 'gf', '5', 'vert', '7x45x4', 'fggg', 'fgjhyg', 'guyggk', 'gkgkkggk', 75, 'kggkukug', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `rating`
--

CREATE TABLE `rating` (
  `id_rating` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `rate` double DEFAULT NULL,
  `comment` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `login` varchar(25) NOT NULL,
  `password` varchar(30) NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `login`, `password`, `profile_pic`, `admin`) VALUES
(1, '', 'jbropp', 'ae', 'assets/2.jpg', 1),
(2, '', 'yanis', 'yanis', NULL, 0),
(4, 'jb@grossesalope.fr', 'JbLaLope', '12', NULL, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id_rating`),
  ADD KEY `id_user` (`id_user`,`id_product`),
  ADD KEY `id_product` (`id_product`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `rating`
--
ALTER TABLE `rating`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
