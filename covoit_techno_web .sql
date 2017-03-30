-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 30 Mars 2017 à 18:57
-- Version du serveur :  10.1.19-MariaDB
-- Version de PHP :  5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `covoit_techno_web`
--

-- --------------------------------------------------------

--
-- Structure de la table `composetrajet`
--

CREATE TABLE `composetrajet` (
  `IdTrajet` int(11) NOT NULL,
  `IdTrajetElementaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etape`
--

CREATE TABLE `etape` (
  `IdEtape` int(11) NOT NULL,
  `VilleEtape` varchar(100) NOT NULL,
  `HeureArrivee` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Heure d''arrivee dans la ville, le depart se fait 10 min apres',
  `IdTrajetElementaire` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `IdUsager` int(11) NOT NULL,
  `IdTrajet` int(11) NOT NULL,
  `NbPlace` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `trajet`
--

CREATE TABLE `trajet` (
  `IdTrajet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `trajetelementaire`
--

CREATE TABLE `trajetelementaire` (
  `IdTrajetElementaire` int(11) NOT NULL,
  `IdVoyage` int(11) NOT NULL,
  `IdEtapeDep` int(11) NOT NULL,
  `IdEtapeArr` int(11) NOT NULL,
  `NbPlaces` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Index pour les tables exportées
--

--
-- Index pour la table `composetrajet`
--
ALTER TABLE `composetrajet`
  ADD PRIMARY KEY (`IdTrajet`,`IdTrajetElementaire`),
  ADD KEY `FK_trajetelem_compose` (`IdTrajetElementaire`);

--
-- Index pour la table `etape`
--
ALTER TABLE `etape`
  ADD PRIMARY KEY (`IdEtape`),
  ADD KEY `fk_etape_trajetelem` (`IdTrajetElementaire`);

--
-- Index pour la table `preference`
--
ALTER TABLE `preference`
  ADD PRIMARY KEY (`IdPreference`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`IdUsager`,`IdTrajet`),
  ADD KEY `FK_trajet` (`IdTrajet`);

--
-- Index pour la table `trajet`
--
ALTER TABLE `trajet`
  ADD PRIMARY KEY (`IdTrajet`);

--
-- Index pour la table `trajetelementaire`
--
ALTER TABLE `trajetelementaire`
  ADD PRIMARY KEY (`IdTrajetElementaire`),
  ADD KEY `FK_trajetElem_voyage` (`IdVoyage`),
  ADD KEY `fk_etapeDep` (`IdEtapeDep`),
  ADD KEY `fk_etapeArr` (`IdEtapeArr`);

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
-- AUTO_INCREMENT pour la table `etape`
--
ALTER TABLE `etape`
  MODIFY `IdEtape` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `preference`
--
ALTER TABLE `preference`
  MODIFY `IdPreference` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `trajet`
--
ALTER TABLE `trajet`
  MODIFY `IdTrajet` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `trajetelementaire`
--
ALTER TABLE `trajetelementaire`
  MODIFY `IdTrajetElementaire` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `usager`
--
ALTER TABLE `usager`
  MODIFY `IdUsager` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id de l''usager';
--
-- AUTO_INCREMENT pour la table `voyage`
--
ALTER TABLE `voyage`
  MODIFY `IdVoyage` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `composetrajet`
--
ALTER TABLE `composetrajet`
  ADD CONSTRAINT `FK_trajet_compose` FOREIGN KEY (`IdTrajet`) REFERENCES `trajet` (`IdTrajet`),
  ADD CONSTRAINT `FK_trajetelem_compose` FOREIGN KEY (`IdTrajetElementaire`) REFERENCES `trajetelementaire` (`IdTrajetElementaire`);

--
-- Contraintes pour la table `etape`
--
ALTER TABLE `etape`
  ADD CONSTRAINT `fk_etape_trajetelem` FOREIGN KEY (`IdTrajetElementaire`) REFERENCES `trajetelementaire` (`IdTrajetElementaire`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_Usager` FOREIGN KEY (`IdUsager`) REFERENCES `usager` (`IdUsager`),
  ADD CONSTRAINT `FK_trajet` FOREIGN KEY (`IdTrajet`) REFERENCES `trajet` (`IdTrajet`);

--
-- Contraintes pour la table `trajetelementaire`
--
ALTER TABLE `trajetelementaire`
  ADD CONSTRAINT `FK_trajetElem_voyage` FOREIGN KEY (`IdVoyage`) REFERENCES `voyage` (`IdVoyage`),
  ADD CONSTRAINT `fk_etapeArr` FOREIGN KEY (`IdEtapeArr`) REFERENCES `etape` (`IdEtape`),
  ADD CONSTRAINT `fk_etapeDep` FOREIGN KEY (`IdEtapeDep`) REFERENCES `etape` (`IdEtape`);

--
-- Contraintes pour la table `voyage`
--
ALTER TABLE `voyage`
  ADD CONSTRAINT `FK_Voyage_Usager` FOREIGN KEY (`IdUsager`) REFERENCES `usager` (`IdUsager`),
  ADD CONSTRAINT `fk_preference` FOREIGN KEY (`IdPreference`) REFERENCES `preference` (`IdPreference`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
