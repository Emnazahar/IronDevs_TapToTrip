-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 10 mars 2022 à 06:03
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `userwvol`
--

-- --------------------------------------------------------

--
-- Structure de la table `attraction`
--

CREATE TABLE `attraction` (
  `id` int(11) NOT NULL,
  `nom` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lieu` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `attraction`
--

INSERT INTO `attraction` (`id`, `nom`, `lieu`, `description`) VALUES
(2, 'Disney', 'Paris', 'hghsghghshsghsyt'),
(3, 'Province d\'Anvers', 'Paris', 'ghgsfgshsfhbvfhagagloremgfafdaghagfqbshsjh'),
(6, 'Madrid', 'Espagne', 'hghsh,shgjshs'),
(8, 'alhambra', 'jhgsjs', 'GFHGDDHGHT'),
(9, 'Province d\'Anvers', 'hsh', 'jjshvnsb'),
(12, 'hjhg', 'hjhd', 'kjgdhd');

-- --------------------------------------------------------

--
-- Structure de la table `billet`
--

CREATE TABLE `billet` (
  `id` int(11) NOT NULL,
  `vol_billet_id` int(11) DEFAULT NULL,
  `num` int(11) NOT NULL,
  `date` date NOT NULL,
  `destination` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `billet`
--

INSERT INTO `billet` (`id`, `vol_billet_id`, `num`, `date`, `destination`, `categorie`, `prix`, `user_id`) VALUES
(1, 3, 69, '2023-01-18', 'ghhhhhh', 'Fhhhhhhhhhhh', 99, 2);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `boitevitesse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `boitevitesse`) VALUES
(19, 'suv25', 'manuelle'),
(20, 'pickup', 'manuelle'),
(21, 'bus', 'auto'),
(22, 'limo', 'auto');

-- --------------------------------------------------------

--
-- Structure de la table `chambre`
--

CREATE TABLE `chambre` (
  `id` int(11) NOT NULL,
  `nbrlits` int(11) NOT NULL,
  `type_ch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `chambre`
--

INSERT INTO `chambre` (`id`, `nbrlits`, `type_ch`, `prix`) VALUES
(1, 4, 'Chambre Double', 20),
(2, 3, 'Chambre Double', 250);

-- --------------------------------------------------------

--
-- Structure de la table `compte_bancaire`
--

CREATE TABLE `compte_bancaire` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `solde` double NOT NULL,
  `numcarte` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_public_key` varchar(700) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_secret_key` varchar(700) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `compte_bancaire`
--

INSERT INTO `compte_bancaire` (`id`, `user_id`, `solde`, `numcarte`, `stripe_public_key`, `stripe_secret_key`) VALUES
(1, 1, 22366, '4242424242424242', 'pk_test_51Kao2yJHMgjwaX7mcFIDadh6h868Yew4JGxZMpgBHz4A9iNlCFSizBjbYw0s4JmgKwYc0zlHjGaWEeS6wSR8xpPs00h8P6TQWz', 'sk_test_51Kao2yJHMgjwaX7m2YbDRpOIQuhCtM7Vg41h1ekpdZhKSSb6E2OMGhaeNNlK5oN3NMSaqOFBVmYIpIv7JHWXvLIu00WVi8WGjF'),
(2, 2, 585655, '4242424242424242', 'pk_test_51Kao2yJHMgjwaX7mcFIDadh6h868Yew4JGxZMpgBHz4A9iNlCFSizBjbYw0s4JmgKwYc0zlHjGaWEeS6wSR8xpPs00h8P6TQWz', 'sk_test_8547UYHT5855');

-- --------------------------------------------------------

--
-- Structure de la table `hotel`
--

CREATE TABLE `hotel` (
  `id` int(11) NOT NULL,
  `nom_h` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_etoiles` int(11) NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_h` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chambre_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `hotel`
--

INSERT INTO `hotel` (`id`, `nom_h`, `nb_etoiles`, `adresse`, `description_h`, `chambre_id`) VALUES
(16, 'test', 3, 'hammamet', 'kjtkrlbgtlkn', 1),
(17, 'test', 2, 'sousse', 'mgmgmggm', 2),
(18, 'test', 4, 'hammamet', 'aaaaaa', 1),
(19, 'aa', 3, 'sousse', 'intégration esprit libertad saint patrick', 1),
(20, 'test', 3, 'ghazela', 'bbbb', 2),
(21, 'nikomha', 2, 'ariana soghra', 'aaaaaaaa', 2),
(22, 'test', 2, 'hammamet', 'intégration esprit libertad saint patrick', 2);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `attractions_id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `attractions_id`, `nom`) VALUES
(2, 6, '9d18e9f669e1353a15eeeea309c53ea0.jpeg'),
(10, 3, 'c56ddc12be3dedfcdf2dc6777bc266bc.jpeg'),
(11, 2, 'df9da663ab4e4f06e2b7171d81e989a9.jpeg'),
(12, 2, 'f8037764936e3a3f88e2d82b894fbc72.jpeg'),
(13, 2, '8d2a83bf78f022aa9a0163c202f9430a.jpeg'),
(14, 2, 'f05aab12becba63f4cef2778fe2b52b8.jpeg'),
(19, 8, 'cdb0b05d438ad580a52a884109d09e5a.jpeg'),
(20, 8, '901e5ef0f7f058b4f5b43933f3709deb.jpeg'),
(21, 8, '211ec9bcdc137a6f9072f5691549054e.jpeg'),
(22, 9, '1108266d2776e71fd77195db833120ad.jpeg'),
(24, 2, 'aa21b345002b22ec17a708180041d504.jpeg'),
(26, 2, '380fe4b82ffd377b58807e170f954280.jpeg'),
(31, 2, 'a5972c6dd25b92029c8fe6c9233d9fea.jpeg'),
(36, 12, '83ed271971a17971d1101758b1974048.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `transport`
--

CREATE TABLE `transport` (
  `id` int(11) NOT NULL,
  `matricule` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marque` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modele` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nbsiege` int(11) DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `prix` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `transport`
--

INSERT INTO `transport` (`id`, `matricule`, `image`, `marque`, `modele`, `nbsiege`, `categorie_id`, `user_id`, `prix`) VALUES
(28, 'tn-1235', 'fiatPanda.PNG', 'fiat', 'panda', 5, 19, 2, 500),
(29, 'TN-0698', 'kiaSportage.PNG', 'kia', 'sportage', 5, 19, 2, 5546),
(30, 'TN-665', 'Capture.PNG', 'renault', '206', 4, 20, 1, 250),
(36, 'fr111', 'landTrek.PNG', 'fiat', 'panda', 5, 19, 2, 700),
(37, 'tn-888', 'kiaSportage.PNG', 'kia', 'sportage', 4, 19, 2, 4000),
(40, 'jhdgjd', '244398492_3099431973603210_374605567167080755_n.jpg', 'dghjdgj', 'dhgjdjg', 5, 19, NULL, 99);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numtel` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirm_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `activation_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_token` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `state`, `email`, `nom`, `prenom`, `numtel`, `roles`, `password`, `confirm_password`, `is_verified`, `activation_token`, `reset_token`) VALUES
(1, 0, 'yasmine.laabidi2000@gmail.com', 'yasmine', 'labidi', '27952264', '[]', '$2y$13$Zf89HahzDLZjlHMe8YG5yOb.P9p4OE60SE08Yb0m5IndpuXzqoMva', 'yassmine9', 0, NULL, NULL),
(2, 0, 'jalel.medsalah@esprit.tn', 'Aziz', 'Shaba', '28719338', '[]', '$2y$13$piExeZUysXQnw/5hhdk3gu9BKaKOzwIEgQjxb2Xw4LG7zLfIhSGU.', 'makchme5thou', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `vol`
--

CREATE TABLE `vol` (
  `id` int(11) NOT NULL,
  `num_vol` int(11) NOT NULL,
  `date` date NOT NULL,
  `heure_dep` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `heure_arrive` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `origine` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `vol`
--

INSERT INTO `vol` (`id`, `num_vol`, `date`, `heure_dep`, `heure_arrive`, `origine`) VALUES
(3, 6969, '2026-09-17', '13h', '12h', 'aa');

-- --------------------------------------------------------

--
-- Structure de la table `voyage_organise`
--

CREATE TABLE `voyage_organise` (
  `id` int(11) NOT NULL,
  `attraction_id` int(11) DEFAULT NULL,
  `destination` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duree` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `programme` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `voyage_organise`
--

INSERT INTO `voyage_organise` (`id`, `attraction_id`, `destination`, `duree`, `programme`, `image`, `hotel`, `prix`) VALUES
(2, 2, 'France', '3jours / 2nuits', 'jour 1 : .......\r\njour 2 :.....', '124b756dc4183d3d89f491867da6c2a8.jpeg', 'Novotel Wavre Brussels East  - 4*', 3900),
(3, 3, 'Belgique', '6jours / 5nuits', 'hhsgh', 'e4b345ce14c7f31f715f0c0e7de745d1.webp', 'Novotel Wavre', 3200),
(5, 6, 'Espagne', '521', 'jhs,sn,', '68239310db7db0d6affd0495bb1a158d.jpeg', 'Novotel Wavre Brussels East  - 4*', 2564);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `attraction`
--
ALTER TABLE `attraction`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `billet`
--
ALTER TABLE `billet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1F034AF6FFECE74E` (`vol_billet_id`),
  ADD KEY `FK_1F034AF6A76ED395` (`user_id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `chambre`
--
ALTER TABLE `chambre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `compte_bancaire`
--
ALTER TABLE `compte_bancaire`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_50BC21DEA76ED395` (`user_id`);

--
-- Index pour la table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3535ED99B177F54` (`chambre_id`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E01FBE6A69F373B3` (`attractions_id`);

--
-- Index pour la table `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_66AB212EBCF5E72D` (`categorie_id`),
  ADD KEY `IDX_66AB212EA76ED395` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- Index pour la table `vol`
--
ALTER TABLE `vol`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `voyage_organise`
--
ALTER TABLE `voyage_organise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_22CA7F323C216F9D` (`attraction_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `attraction`
--
ALTER TABLE `attraction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `billet`
--
ALTER TABLE `billet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `chambre`
--
ALTER TABLE `chambre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `compte_bancaire`
--
ALTER TABLE `compte_bancaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `transport`
--
ALTER TABLE `transport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `vol`
--
ALTER TABLE `vol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `voyage_organise`
--
ALTER TABLE `voyage_organise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `billet`
--
ALTER TABLE `billet`
  ADD CONSTRAINT `FK_1F034AF6A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_1F034AF6FFECE74E` FOREIGN KEY (`vol_billet_id`) REFERENCES `vol` (`id`);

--
-- Contraintes pour la table `compte_bancaire`
--
ALTER TABLE `compte_bancaire`
  ADD CONSTRAINT `FK_50BC21DEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `FK_3535ED99B177F54` FOREIGN KEY (`chambre_id`) REFERENCES `chambre` (`id`);

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_E01FBE6A69F373B3` FOREIGN KEY (`attractions_id`) REFERENCES `attraction` (`id`);

--
-- Contraintes pour la table `transport`
--
ALTER TABLE `transport`
  ADD CONSTRAINT `FK_66AB212EBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `IDX_66AB212EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `voyage_organise`
--
ALTER TABLE `voyage_organise`
  ADD CONSTRAINT `FK_22CA7F323C216F9D` FOREIGN KEY (`attraction_id`) REFERENCES `attraction` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
