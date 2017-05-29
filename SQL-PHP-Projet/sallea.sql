-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 29 Mai 2017 à 09:47
-- Version du serveur :  10.1.21-MariaDB
-- Version de PHP :  7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `sallea`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id_avis` int(3) NOT NULL,
  `id_membre` int(3) NOT NULL,
  `id_salle` int(3) NOT NULL,
  `commentaire` text NOT NULL,
  `note` int(2) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `avis`
--

INSERT INTO `avis` (`id_avis`, `id_membre`, `id_salle`, `commentaire`, `note`, `date_enregistrement`) VALUES
(23, 6, 12, 'Excellent', 5, '2017-05-24 14:31:45'),
(24, 7, 12, 'Bien mais pas top. ', 2, '2017-05-24 14:33:12'),
(25, 7, 18, 'Manque de place', 3, '2017-05-24 14:33:24'),
(26, 7, 21, 'Bien situé!', 4, '2017-05-24 14:33:47'),
(27, 7, 22, 'La présence d&#039;un dinosaure a perturbé la réunion. ', 3, '2017-05-24 14:34:32');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(3) NOT NULL,
  `id_membre` int(3) NOT NULL,
  `id_produit` int(3) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(3) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(60) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `civilite` enum('m','f') NOT NULL,
  `statut` int(1) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `civilite`, `statut`, `date_enregistrement`) VALUES
(6, 'admin ', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', 'admin@admin.fr', 'f', 1, '2017-05-22 12:08:01'),
(7, 'Nour', 'ccbc1770bb10486495d127a7d65c252b', 'Nour', 'Nour', 'nour@nour.fr', 'f', 0, '2017-05-22 12:17:53'),
(8, 'Chloe', 'chloe', 'Chloe', 'Chloe', 'chloe@chloe.fr', 'f', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(3) NOT NULL,
  `id_salle` int(3) NOT NULL,
  `date_arrivee` date NOT NULL,
  `date_depart` date NOT NULL,
  `prix` int(3) NOT NULL,
  `etat` enum('libre','reservation') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `id_salle`, `date_arrivee`, `date_depart`, `prix`, `etat`) VALUES
(18, 14, '2017-06-01', '2017-06-07', 2000, 'libre'),
(19, 12, '2017-07-01', '2017-07-07', 500, 'libre'),
(20, 12, '2017-05-26', '2017-05-29', 550, 'libre'),
(21, 23, '2017-07-26', '2017-07-29', 3000, 'libre'),
(22, 22, '2017-05-26', '2017-06-26', 6000, 'libre'),
(23, 23, '2017-10-26', '2017-10-28', 200, 'libre'),
(24, 23, '2017-12-05', '2017-12-15', 1000, 'libre'),
(25, 22, '2017-10-26', '2017-12-15', 10000, 'libre'),
(26, 21, '2017-11-10', '2017-11-20', 1000, 'libre'),
(27, 21, '2017-11-10', '2017-11-20', 7000, 'libre'),
(28, 19, '2017-06-26', '2017-06-27', 100, 'libre'),
(29, 16, '2017-06-26', '2017-06-27', 200, 'libre'),
(30, 14, '2017-06-26', '2017-06-27', 500, 'libre'),
(31, 18, '2017-06-26', '2017-06-29', 600, 'libre'),
(32, 13, '2017-10-12', '2017-10-20', 1200, 'libre'),
(33, 16, '2017-07-26', '2017-07-29', 367, 'libre'),
(34, 19, '2017-08-26', '2017-08-30', 234, 'libre'),
(35, 17, '2017-09-09', '2017-09-27', 564, 'libre'),
(36, 16, '2017-09-10', '2017-09-11', 45, 'libre'),
(37, 18, '2017-06-26', '2017-06-27', 56, 'libre'),
(38, 17, '2017-10-26', '2017-11-09', 698, 'libre'),
(39, 13, '2017-11-10', '2017-11-20', 509, 'libre');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `id_salle` int(3) NOT NULL,
  `titre` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(200) NOT NULL,
  `pays` varchar(20) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `cp` int(5) NOT NULL,
  `capacite` int(3) NOT NULL,
  `categories` enum('reunion','bureau','formation') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `salle`
--

INSERT INTO `salle` (`id_salle`, `titre`, `description`, `photo`, `pays`, `ville`, `adresse`, `cp`, `capacite`, `categories`) VALUES
(12, 'Bureau Monet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '/SQL-PHP-Projet/photo/Bureau Monet_1.jpg', 'france', 'paris', '82 Avenue Denfert-Rochereau', 75014, 50, 'bureau'),
(13, 'Salle Cézanne', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '/SQL-PHP-Projet/photo/Salle Cézanne_2.jpg', 'france', 'lyon', '191 Rue Vendôme', 69003, 100, 'reunion'),
(14, 'Salle Renoir ', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', '/SQL-PHP-Projet/photo/Salle Renoir _3.png', 'france', 'marseille', '27 Avenue de la Timone', 13010, 200, 'formation'),
(15, 'Salle Van Gogh', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '/SQL-PHP-Projet/photo/Salle Van Gogh_4.jpg', 'france', 'bordeaux', '26 Rue Tourat', 33000, 80, 'reunion'),
(16, 'Salle Duchamp', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '/SQL-PHP-Projet/photo/Salle Duchamp_5.jpg', 'france', 'paris', '36 Rue Notre Dame des Victoires', 75002, 210, 'reunion'),
(17, 'Bureau Basile', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', '/SQL-PHP-Projet/photo/Bureau Basile_6.jpeg', 'france', 'lyon', '211 Rue Vendôme', 69003, 25, 'bureau'),
(18, 'Salle Klee', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '/SQL-PHP-Projet/photo/Salle Klee_7.jpg', 'france', 'marseille', '5 Rue Grignan', 13006, 250, 'formation'),
(19, 'Salle Rubens', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '/SQL-PHP-Projet/photo/Salle Rubens_8.jpeg', 'france', 'bordeaux', '94 Rue Sainte-Catherine', 33000, 90, 'reunion'),
(20, 'Salle Monet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '/SQL-PHP-Projet/photo/Salle Monet_9.jpeg', 'france', 'paris', '138 Boulevard du Montparnasse', 75014, 60, 'formation'),
(21, 'Bureau Pollock', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '/SQL-PHP-Projet/photo/Bureau Pollock_10.jpg', 'france', 'lyon', '8 Rue de la Bombarde', 69005, 10, 'bureau'),
(22, 'Salle Kandinsky', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', '/SQL-PHP-Projet/photo/Salle Kandinsky_11.jpg', 'france', 'marseille', '84 Boulevard des Dames', 13002, 130, 'reunion'),
(23, 'Bureau Breton', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '/SQL-PHP-Projet/photo/Bureau Breton_12.jpg', 'france', 'bordeaux', '90 Boulevard Jules Simon', 33100, 5, 'bureau');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id_avis`),
  ADD KEY `id_membre` (`id_membre`),
  ADD KEY `id_salle` (`id_salle`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `id_membre` (`id_membre`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `id_salle` (`id_salle`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`id_salle`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id_avis` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `id_salle` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
