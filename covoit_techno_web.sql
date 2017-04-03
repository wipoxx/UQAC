-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Lun 03 Avril 2017 à 16:35
-- Version du serveur :  5.6.33
-- Version de PHP :  7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `travelExpress`
--

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

--
-- Index pour les tables exportées
--

--
-- Index pour la table `trajetelementaire`
--
ALTER TABLE `trajetelementaire`
  ADD PRIMARY KEY (`IdTrajetElementaire`),
  ADD KEY `FK_trajetElem_voyage` (`IdVoyage`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `trajetelementaire`
--
ALTER TABLE `trajetelementaire`
  MODIFY `IdTrajetElementaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `trajetelementaire`
--
ALTER TABLE `trajetelementaire`
  ADD CONSTRAINT `FK_trajetElem_voyage` FOREIGN KEY (`IdVoyage`) REFERENCES `voyage` (`IdVoyage`);
