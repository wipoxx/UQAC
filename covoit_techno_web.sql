-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Lun 03 Avril 2017 à 16:57
-- Version du serveur :  5.6.33
-- Version de PHP :  7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `travelExpress`
--

-- --------------------------------------------------------

--
-- Structure de la table `preference`
--

CREATE TABLE `preference` (
  `IdPreference` int(11) NOT NULL,
  `Animaux` tinyint(1) NOT NULL,
  `Fumeur` tinyint(1) NOT NULL,
  `NbMaxBagages_Personne` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `preference`
--

INSERT INTO `preference` (`IdPreference`, `Animaux`, `Fumeur`, `NbMaxBagages_Personne`) VALUES
(1, 1, 1, 22),
(5, 1, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `idReservation` int(11) NOT NULL,
  `IdUsager` int(11) NOT NULL,
  `IdTrajet` int(11) NOT NULL,
  `NbPlaces` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `trajet`
--

CREATE TABLE `trajet` (
  `IdTrajet` int(11) NOT NULL,
  `idTrajetElementaire` int(11) NOT NULL,
  `idReservation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `trajetelementaire`
--

CREATE TABLE `trajetelementaire` (
  `IdTrajetElementaire` int(11) NOT NULL,
  `IdVoyage` int(11) NOT NULL,
  `NbPlaces` int(11) NOT NULL,
  `VilleDepart` varchar(100) NOT NULL,
  `HeureDepart` time NOT NULL,
  `VilleArrivee` varchar(100) NOT NULL,
  `HeureArrivee` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `trajetelementaire`
--

INSERT INTO `trajetelementaire` (`IdTrajetElementaire`, `IdVoyage`, `NbPlaces`, `VilleDepart`, `HeureDepart`, `VilleArrivee`, `HeureArrivee`) VALUES
(1, 1, 3, 'Chaumont', '09:30:00', 'Dijon', '11:00:00'),
(2, 1, 3, 'Dijon', '11:10:00', 'Besançon', '12:30:00'),
(3, 1, 3, 'Besançon', '12:30:00', 'Lons-Le-Saunier', '14:10:00'),
(4, 2, 3, 'Lons-Le-Saunier', '09:00:00', 'Besançon', '11:00:00'),
(5, 2, 3, 'Besançon', '11:10:00', 'Chaumont', '15:20:00'),
(6, 1, 3, 'Tamere', '06:00:00', 'Homer', '03:00:00'),
(7, 17, 3, 'Chaumont', '07:30:00', 'Dijon', '08:30:00'),
(8, 17, 3, 'Dijon', '08:30:00', 'Besançon', '09:30:00'),
(9, 17, 3, 'Besançon', '09:30:00', 'Lons-Le-Saunier', '11:30:00'),
(10, 17, 3, 'Lons-Le-Saunier', '11:30:00', 'Trépugnat', '12:00:00'),
(11, 18, 3, 'Chaumont', '07:30:00', 'Dijon', '08:30:00'),
(12, 18, 3, 'Dijon', '08:30:00', 'Besançon', '09:30:00'),
(13, 18, 3, 'Besançon', '09:30:00', 'Lons-Le-Saunier', '11:30:00'),
(14, 18, 3, 'Lons-Le-Saunier', '11:30:00', 'Trépugnat', '12:00:00'),
(15, 19, 3, 'Chaumont', '07:30:00', 'Dijon', '08:30:00'),
(16, 19, 3, 'Dijon', '08:30:00', 'Besançon', '09:30:00'),
(17, 19, 3, 'Besançon', '09:30:00', 'Lons-Le-Saunier', '11:30:00'),
(18, 19, 3, 'Lons-Le-Saunier', '11:30:00', 'Trépugnat', '12:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `usager`
--

CREATE TABLE `usager` (
  `IdUsager` int(11) NOT NULL COMMENT 'Id de l''usager',
  `PseudoUsager` varchar(100) NOT NULL,
  `NomUsager` varchar(100) DEFAULT NULL COMMENT 'Nom del''usager',
  `PrenomUsager` varchar(100) NOT NULL,
  `EmailUsager` varchar(100) DEFAULT NULL COMMENT 'Email de l''usager',
  `NumTelUsager` bigint(20) DEFAULT NULL COMMENT 'Numero de telephone (supposé sur plus de 10 digits)',
  `MdpUsager` varchar(16) DEFAULT NULL COMMENT 'Mot de passe du compte usager',
  `IdSession` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Table des usagers de l''application';

--
-- Contenu de la table `usager`
--

INSERT INTO `usager` (`IdUsager`, `PseudoUsager`, `NomUsager`, `PrenomUsager`, `EmailUsager`, `NumTelUsager`, `MdpUsager`, `IdSession`) VALUES
(1, 'jpLaMalice', 'Sartre', 'Jean-Paul', 'mail@mail.com', 0, 'mdpTropSecure', NULL),
(2, 'goIsEverything', 'Chaussette', 'Pape', 'papipou@bible.vati', 23, 'laFoi', NULL),
(3, '3evil5you', 'Morningstar', 'Lucifer', 'diable@enfer.me', 666, 'devil', NULL),
(21, 'iCantHearYou', 'van Beethoven', 'Ludwig', 'pompompompom@music.au', 1770, 'soGood', NULL),
(51, 'rezar', 'a', 'a', 'a@a.a', 1, '0cc175b9c0f1b6a8', NULL),
(52, 'aaaaa', 'a', 'a', 'a', 0, '0cc175b9c0f1b6a8', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `voyage`
--

CREATE TABLE `voyage` (
  `IdVoyage` int(11) NOT NULL,
  `IdUsager` int(11) NOT NULL COMMENT 'IdUsager du conducteur',
  `NbPlaces` int(11) NOT NULL,
  `IdPreference` int(11) NOT NULL,
  `DateDepart` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `voyage`
--

INSERT INTO `voyage` (`IdVoyage`, `IdUsager`, `NbPlaces`, `IdPreference`, `DateDepart`) VALUES
(1, 1, 3, 1, '2017-04-06'),
(2, 1, 1, 1, '2017-03-07'),
(3, 21, 3, 1, '2017-04-02'),
(4, 21, 3, 5, '2017-04-10'),
(5, 21, 3, 5, '2017-04-10'),
(6, 21, 3, 5, '2017-04-10'),
(7, 21, 3, 5, '2017-04-10'),
(8, 21, 3, 5, '2017-04-10'),
(9, 21, 3, 5, '2017-04-10'),
(10, 21, 3, 5, '2017-04-10'),
(11, 21, 3, 5, '2017-04-10'),
(12, 21, 3, 5, '2017-04-10'),
(13, 21, 3, 5, '2017-04-10'),
(14, 21, 3, 5, '2017-04-10'),
(15, 21, 3, 5, '2017-04-10'),
(16, 21, 3, 5, '2017-04-10'),
(17, 21, 3, 5, '2017-04-10'),
(18, 21, 3, 5, '2017-04-10'),
(19, 21, 3, 5, '2017-04-10');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `preference`
--
ALTER TABLE `preference`
  ADD PRIMARY KEY (`IdPreference`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`idReservation`) USING BTREE,
  ADD KEY `FK_trajet` (`IdTrajet`),
  ADD KEY `FK_Usager` (`IdUsager`) USING BTREE;

--
-- Index pour la table `trajet`
--
ALTER TABLE `trajet`
  ADD PRIMARY KEY (`IdTrajet`),
  ADD KEY `idTrajetElementaire` (`idTrajetElementaire`),
  ADD KEY `idReservation` (`idReservation`);

--
-- Index pour la table `trajetelementaire`
--
ALTER TABLE `trajetelementaire`
  ADD PRIMARY KEY (`IdTrajetElementaire`),
  ADD KEY `FK_trajetElem_voyage` (`IdVoyage`);

--
-- Index pour la table `usager`
--
ALTER TABLE `usager`
  ADD PRIMARY KEY (`IdUsager`);

--
-- Index pour la table `voyage`
--
ALTER TABLE `voyage`
  ADD PRIMARY KEY (`IdVoyage`),
  ADD KEY `FK_Voyage_Usager` (`IdUsager`),
  ADD KEY `fk_preference` (`IdPreference`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `preference`
--
ALTER TABLE `preference`
  MODIFY `IdPreference` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `idReservation` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `trajet`
--
ALTER TABLE `trajet`
  MODIFY `IdTrajet` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `trajetelementaire`
--
ALTER TABLE `trajetelementaire`
  MODIFY `IdTrajetElementaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `usager`
--
ALTER TABLE `usager`
  MODIFY `IdUsager` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id de l''usager', AUTO_INCREMENT=144;
--
-- AUTO_INCREMENT pour la table `voyage`
--
ALTER TABLE `voyage`
  MODIFY `IdVoyage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_Usager` FOREIGN KEY (`IdUsager`) REFERENCES `usager` (`IdUsager`),
  ADD CONSTRAINT `FK_trajet` FOREIGN KEY (`IdTrajet`) REFERENCES `trajet` (`IdTrajet`);

--
-- Contraintes pour la table `trajet`
--
ALTER TABLE `trajet`
  ADD CONSTRAINT `FK_Reservation` FOREIGN KEY (`idReservation`) REFERENCES `reservation` (`idReservation`),
  ADD CONSTRAINT `FK_TrajetElementaire` FOREIGN KEY (`idTrajetElementaire`) REFERENCES `trajetelementaire` (`IdTrajetElementaire`);

--
-- Contraintes pour la table `trajetelementaire`
--
ALTER TABLE `trajetelementaire`
  ADD CONSTRAINT `FK_trajetElem_voyage` FOREIGN KEY (`IdVoyage`) REFERENCES `voyage` (`IdVoyage`);

--
-- Contraintes pour la table `voyage`
--
ALTER TABLE `voyage`
  ADD CONSTRAINT `FK_Voyage_Usager` FOREIGN KEY (`IdUsager`) REFERENCES `usager` (`IdUsager`),
  ADD CONSTRAINT `fk_preference` FOREIGN KEY (`IdPreference`) REFERENCES `preference` (`IdPreference`);
