-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 16 nov. 2022 à 08:44
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données : `db_3d`
--

-- --------------------------------------------------------

--
-- Structure de la table `accessory`
--

CREATE TABLE `accessory` (
  `id` int(11) NOT NULL,
  `productType` varchar(255) NOT NULL,
  `material` varchar(255) NOT NULL,
  `idProduct` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `filament`
--

CREATE TABLE `filament` (
  `id` int(11) NOT NULL,
  `productType` varchar(255) NOT NULL,
  `filamentType` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `diameter` double NOT NULL,
  `tempFusion` double NOT NULL,
  `weight` double NOT NULL,
  `dimension` varchar(255) NOT NULL,
  `idProduct` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `follow`
--

CREATE TABLE `follow` (
  `idFollower` int(11) NOT NULL,
  `idFollowed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Structure de la table `groupuser`
--

CREATE TABLE `groupuser` (
  `idUser` int(11) NOT NULL,
  `idGroup` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `machine`
--

CREATE TABLE `machine` (
  `id` int(11) NOT NULL,
  `productType` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `heatingPlate` varchar(255) NOT NULL,
  `idProduct` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` double NOT NULL,
  `rating` double DEFAULT NULL,
  `image` text NOT NULL DEFAULT '\'assets/no_image.jpg\''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `rating`, `image`) VALUES
(1, 'Bobine verte ALL3D', 'Une bobine de filament de couleur verte', 29, 10, '\'assets/no_image.jpg\'');

-- --------------------------------------------------------

--
-- Structure de la table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `comm` varchar(300) NOT NULL,
  `rate` double DEFAULT NULL,
  `dateOfPub` date NOT NULL,
  `idUser` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `email`, `username`, `password`) VALUES
(1, 'jbropp@gmail.com', 'jbropp', '123');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `accessory`
--
ALTER TABLE `accessory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Index pour la table `filament`
--
ALTER TABLE `filament`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Index pour la table `follow`
--
ALTER TABLE `follow`
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
  ADD KEY `idProduct` (`idProduct`);

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
-- AUTO_INCREMENT pour la table `filament`
--
ALTER TABLE `filament`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fonctionnality`
--
ALTER TABLE `fonctionnality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `machine`
--
ALTER TABLE `machine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `accessory`
--
ALTER TABLE `accessory`
  ADD CONSTRAINT `accessory_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `product` (`id`);

--
-- Contraintes pour la table `filament`
--
ALTER TABLE `filament`
  ADD CONSTRAINT `filament_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `product` (`id`);

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
  ADD CONSTRAINT `machine_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `product` (`id`);

--
-- Contraintes pour la table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `utilisateur` (`id`);
COMMIT;
