-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 26 nov. 2022 à 19:33
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
-- Base de données : `db_3d`
--

-- --------------------------------------------------------

--
-- Structure de la table `accessory`
--

CREATE TABLE `accessory` (
  `id` int(11) NOT NULL,
  `productType` int(11) NOT NULL,
  `material` varchar(255) NOT NULL,
  `idProduct` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `accessorytype`
--

CREATE TABLE `accessorytype` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `filament`
--

CREATE TABLE `filament` (
  `id` int(11) NOT NULL,
  `productType` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `diameter` double NOT NULL,
  `tempFusion` double NOT NULL,
  `weight` double NOT NULL,
  `dimension` varchar(255) NOT NULL,
  `idProduct` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `filamenttype`
--

CREATE TABLE `filamenttype` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `follow`
--

CREATE TABLE `follow` (
  `id` int(11) NOT NULL,
  `idFollower` int(11) NOT NULL,
  `idFollowed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `follow`
--

INSERT INTO `follow` (`id`, `idFollower`, `idFollowed`) VALUES
(1, 74, 2),
(6, 1, 2),
(8, 1, 1),
(10, 1, 74);

-- --------------------------------------------------------

--
-- Structure de la table `fonctionnality`
--

CREATE TABLE `fonctionnality` (
  `id` int(11) NOT NULL,
  `idGroup` int(11) NOT NULL,
  `description` varchar(300) NOT NULL,
  `droit` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `id` int(11) NOT NULL,
  `Label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id`, `Label`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Structure de la table `groupuser`
--

CREATE TABLE `groupuser` (
  `idUser` int(11) NOT NULL,
  `idGroup` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `groupuser`
--

INSERT INTO `groupuser` (`idUser`, `idGroup`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `machine`
--

CREATE TABLE `machine` (
  `id` int(11) NOT NULL,
  `productType` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `heatingPlate` varchar(255) NOT NULL,
  `idProduct` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `machinetype`
--

CREATE TABLE `machinetype` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `rating` double DEFAULT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `rating`, `image`) VALUES
(1, 'cailloux', 'gros caillou', 3000, 5, NULL),
(2, 'Gel amincissant', 'Pour les bg', 20, NULL, NULL),
(3, 'Capote granola', 'délicieux surtout au gouter', 2, NULL, NULL),
(4, 'Cette bobine est verte', 'oui', 29, NULL, 'assets/bobine1.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `comm` varchar(300) NOT NULL,
  `rate` double DEFAULT NULL,
  `dateOfPub` datetime NOT NULL DEFAULT current_timestamp(),
  `idUser` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `rating`
--

INSERT INTO `rating` (`id`, `comm`, `rate`, `dateOfPub`, `idUser`, `idProduct`) VALUES
(1, 'C\'est nul bouuu', 2, '2022-11-17 00:00:00', 1, 1),
(2, 'Cest bien', 4, '2022-11-17 00:00:00', 2, 1),
(4, 'Ca pue sa mere ', 0, '2022-11-17 00:00:00', 2, 2),
(7, 'super', 5, '0000-00-00 00:00:00', 2, 2),
(8, 'C\'est vraiment agrébale', 2, '2022-11-17 00:00:00', 2, 3),
(9, 'WOW', 5, '2022-11-24 00:00:00', 74, 1),
(10, 'wwwwww', 4, '2022-11-24 00:00:00', 74, 1),
(11, 'XCA', 5, '2022-11-26 00:00:00', 1, 1),
(12, 'caca ', 8, '2022-11-26 00:00:00', 1, 1),
(13, ' caca', 5, '2022-11-26 00:00:00', 1, 1),
(14, ' ok', 5, '2022-11-26 00:00:00', 1, 1),
(15, ' ok', 5, '2022-11-26 00:00:00', 1, 1),
(16, ' pi', 5, '2022-11-26 00:00:00', 1, 4),
(17, ' pk pas', 2, '2022-11-26 00:52:12', 1, 2),
(18, ' pas fou', 3, '2022-11-26 07:51:45', 1, 4),
(19, ' très beau caillou', 4, '2022-11-26 08:00:26', 2, 1),
(20, ' caca', 2, '2022-11-26 18:39:29', 1, 1),
(21, ' caca', 2, '2022-11-26 18:40:01', 1, 1),
(22, ' caca', 2, '2022-11-26 18:41:31', 1, 1),
(23, ' caca', 2, '2022-11-26 18:47:40', 1, 1),
(24, ' intj', 2, '2022-11-26 19:00:33', 1, 1),
(25, ' ouy', 3, '2022-11-26 19:19:20', 1, 4),
(26, ' groccaca', 5, '2022-11-26 19:20:32', 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `email`, `username`, `password`, `image`) VALUES
(1, 'jbropp@gmail.com', 'jbropp', '123', NULL),
(2, 'yanis', 'yanis', 'yanis', NULL),
(3, 'abdel@gmail.com', 'abdel', 'abdel', NULL),
(74, 'JB', 'JB', 'JB', 'assets/pp/MFRbpf84_400x400.jpg'),
(75, 'jojo', 'jojo', 'jojo', 'assets/pp/s3.png'),
(76, 'ya', 'ya', 'ya', 'assets/pp/b55e2ae28ba7e0766c4dc6101b5687fc.jpg'),
(77, 'caca', 'caca', 'ccaca', 'assets/pp/s0.png'),
(78, 'jojol', 'jojol', 'jojol', 'assets/pp/s0.png'),
(79, 'koko', 'koko', 'koko', 'assets/pp/s0.png'),
(80, 'loo', 'oll', 'loo', 'assets/pp/s3.png'),
(81, 'jbropp@gmail.com', 'x', 'x', 'assets/pp/FgKFpGuXgAEj6Vi.jpg'),
(82, '123', '123', '123', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `accessory`
--
ALTER TABLE `accessory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productType` (`productType`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Index pour la table `accessorytype`
--
ALTER TABLE `accessorytype`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `filament`
--
ALTER TABLE `filament`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productType` (`productType`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Index pour la table `filamenttype`
--
ALTER TABLE `filamenttype`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idFollower` (`idFollower`),
  ADD KEY `idFollowed` (`idFollowed`);

--
-- Index pour la table `fonctionnality`
--
ALTER TABLE `fonctionnality`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idGroup` (`idGroup`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupuser`
--
ALTER TABLE `groupuser`
  ADD KEY `idGroup` (`idGroup`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `machine`
--
ALTER TABLE `machine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productType` (`productType`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Index pour la table `machinetype`
--
ALTER TABLE `machinetype`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProduct` (`idProduct`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `accessory`
--
ALTER TABLE `accessory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `accessorytype`
--
ALTER TABLE `accessorytype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `filament`
--
ALTER TABLE `filament`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `filamenttype`
--
ALTER TABLE `filamenttype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `fonctionnality`
--
ALTER TABLE `fonctionnality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `machine`
--
ALTER TABLE `machine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `machinetype`
--
ALTER TABLE `machinetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `accessory`
--
ALTER TABLE `accessory`
  ADD CONSTRAINT `accessory_ibfk_1` FOREIGN KEY (`productType`) REFERENCES `accessorytype` (`id`),
  ADD CONSTRAINT `accessory_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `product` (`id`);

--
-- Contraintes pour la table `filament`
--
ALTER TABLE `filament`
  ADD CONSTRAINT `filament_ibfk_1` FOREIGN KEY (`productType`) REFERENCES `filamenttype` (`id`),
  ADD CONSTRAINT `filament_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `product` (`id`);

--
-- Contraintes pour la table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `follow_ibfk_1` FOREIGN KEY (`idFollower`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `follow_ibfk_2` FOREIGN KEY (`idFollowed`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `fonctionnality`
--
ALTER TABLE `fonctionnality`
  ADD CONSTRAINT `fonctionnality_ibfk_1` FOREIGN KEY (`idGroup`) REFERENCES `groupe` (`id`);

--
-- Contraintes pour la table `groupuser`
--
ALTER TABLE `groupuser`
  ADD CONSTRAINT `groupuser_ibfk_1` FOREIGN KEY (`idGroup`) REFERENCES `groupe` (`id`),
  ADD CONSTRAINT `groupuser_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `machine`
--
ALTER TABLE `machine`
  ADD CONSTRAINT `machine_ibfk_1` FOREIGN KEY (`productType`) REFERENCES `machinetype` (`id`),
  ADD CONSTRAINT `machine_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `product` (`id`);

--
-- Contraintes pour la table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `utilisateur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
