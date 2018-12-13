-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le :  jeu. 13 déc. 2018 à 14:37
-- Version du serveur :  5.7.21
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `T3_plantae`
--
CREATE DATABASE IF NOT EXISTS `T3_plantae` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `T3_plantae`;

-- --------------------------------------------------------

--
-- Structure de la table `BIOME`
--

DROP TABLE IF EXISTS `BIOME`;
CREATE TABLE `BIOME` (
  `idBiome` int(11) NOT NULL,
  `nameBiome` varchar(50) DEFAULT NULL,
  `airPolution` int(11) DEFAULT NULL,
  `animalDensity` int(11) DEFAULT NULL,
  `humidity` int(11) DEFAULT NULL,
  `insectDensity` int(11) DEFAULT NULL,
  `precipitationAverageAmount` int(11) DEFAULT NULL,
  `precipitationFrequency` int(11) DEFAULT NULL,
  `temperature` int(11) DEFAULT NULL,
  `vegetationDensity` int(11) DEFAULT NULL,
  `windForce` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `BIOME`
--

INSERT INTO `BIOME` (`idBiome`, `nameBiome`, `airPolution`, `animalDensity`, `humidity`, `insectDensity`, `precipitationAverageAmount`, `precipitationFrequency`, `temperature`, `vegetationDensity`, `windForce`) VALUES
(0, 'Prairie', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Desert', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `BIOMEEVENTLIST`
--

DROP TABLE IF EXISTS `BIOMEEVENTLIST`;
CREATE TABLE `BIOMEEVENTLIST` (
  `idBiome` int(11) NOT NULL,
  `idEvent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `BIOME_SEASONS`
--

DROP TABLE IF EXISTS `BIOME_SEASONS`;
CREATE TABLE `BIOME_SEASONS` (
  `idBiome` int(11) NOT NULL,
  `idSeason` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `COLOR`
--

DROP TABLE IF EXISTS `COLOR`;
CREATE TABLE `COLOR` (
  `idColor` int(11) NOT NULL,
  `label` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `DISPOSITION`
--

DROP TABLE IF EXISTS `DISPOSITION`;
CREATE TABLE `DISPOSITION` (
  `idDispo` int(11) NOT NULL,
  `labelDispo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `FLOWER`
--

DROP TABLE IF EXISTS `FLOWER`;
CREATE TABLE `FLOWER` (
  `idColor` int(11) DEFAULT NULL,
  `idPetal` int(11) DEFAULT NULL,
  `idForm` int(11) DEFAULT NULL,
  `idDispo` int(11) DEFAULT NULL,
  `idLeaf` int(11) DEFAULT NULL,
  `idFlower` int(11) NOT NULL,
  `family` varchar(20) DEFAULT NULL,
  `nameFr` varchar(20) DEFAULT NULL,
  `nameLatin` varchar(30) DEFAULT NULL,
  `inflorescence` int(11) DEFAULT NULL,
  `nbPetals` int(11) DEFAULT NULL,
  `formLeaves` int(11) DEFAULT NULL,
  `colorPetals` varchar(50) DEFAULT NULL,
  `population` int(11) DEFAULT NULL,
  `hasNectar` tinyint(1) DEFAULT NULL,
  `nectarQuantity` int(11) DEFAULT NULL,
  `diseaseResistance` int(11) DEFAULT NULL,
  `idealTemperature` int(11) DEFAULT NULL,
  `temperatureAmplitude` int(11) DEFAULT NULL,
  `insecticidePower` int(11) DEFAULT NULL,
  `seeds` int(11) DEFAULT NULL,
  `tubeLength` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `FLOWER`
--

INSERT INTO `FLOWER` (`idColor`, `idPetal`, `idForm`, `idDispo`, `idLeaf`, `idFlower`, `family`, `nameFr`, `nameLatin`, `inflorescence`, `nbPetals`, `formLeaves`, `colorPetals`, `population`, `hasNectar`, `nectarQuantity`, `diseaseResistance`, `idealTemperature`, `temperatureAmplitude`, `insecticidePower`, `seeds`, `tubeLength`) VALUES
(NULL, NULL, NULL, NULL, NULL, 0, 'liliacées', 'tulipe', 'tulipa clusiana', NULL, 5, NULL, 'jaune', 100, 1, NULL, NULL, 20, 10, 50, 50, 0),
(NULL, NULL, NULL, NULL, NULL, 10, ' Rosaceae', 'Rose Papa Meilland', 'Rosae', NULL, NULL, NULL, 'Rouge', 100, 1, NULL, 55, 22, 9, 55, 45, 0);

-- --------------------------------------------------------

--
-- Structure de la table `FORM`
--

DROP TABLE IF EXISTS `FORM`;
CREATE TABLE `FORM` (
  `idForm` int(11) NOT NULL,
  `labelForm` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `LEAF`
--

DROP TABLE IF EXISTS `LEAF`;
CREATE TABLE `LEAF` (
  `idForm` int(11) NOT NULL,
  `idDispo` int(11) NOT NULL,
  `idLeaf` int(11) NOT NULL,
  `form` int(11) DEFAULT NULL,
  `dispo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `MONTH`
--

DROP TABLE IF EXISTS `MONTH`;
CREATE TABLE `MONTH` (
  `idMonth` int(11) NOT NULL,
  `labelMonth` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `NECTAR`
--

DROP TABLE IF EXISTS `NECTAR`;
CREATE TABLE `NECTAR` (
  `idNectar` int(11) NOT NULL,
  `nameNectar` varchar(50) DEFAULT NULL,
  `overallQuality` int(11) DEFAULT NULL,
  `attractivePhytochemicalProp` int(11) DEFAULT NULL,
  `protectivePhytochemicalProp` int(11) DEFAULT NULL,
  `fructoseProp` int(11) DEFAULT NULL,
  `glucoseProp` int(11) DEFAULT NULL,
  `sucroseProp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `PETAL`
--

DROP TABLE IF EXISTS `PETAL`;
CREATE TABLE `PETAL` (
  `id_Couleur` int(11) NOT NULL,
  `idPetale` int(11) NOT NULL,
  `color` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `POLLINATOR`
--

DROP TABLE IF EXISTS `POLLINATOR`;
CREATE TABLE `POLLINATOR` (
  `idPollinator` int(11) NOT NULL,
  `namePollinator` varchar(50) DEFAULT NULL,
  `populationPollinator` int(11) DEFAULT NULL,
  `efficiency` int(11) DEFAULT NULL,
  `fructoseAttraction` int(11) DEFAULT NULL,
  `glucoseAttraction` int(11) DEFAULT NULL,
  `phytochemicalAttraction` int(11) DEFAULT NULL,
  `sucroseAttraction` int(11) DEFAULT NULL,
  `flowerMaxTubeLength` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `QUIZZ`
--

DROP TABLE IF EXISTS `QUIZZ`;
CREATE TABLE `QUIZZ` (
  `idQ` int(11) NOT NULL,
  `question` varchar(200) NOT NULL,
  `reponseJ` varchar(200) NOT NULL,
  `reponseF1` varchar(200) NOT NULL,
  `reponseF2` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `QUIZZ`
--

INSERT INTO `QUIZZ` (`idQ`, `question`, `reponseJ`, `reponseF1`, `reponseF2`) VALUES
(1, 'Quelle est la plage de température idéale d\'une tulipe ?', '10-30', '15-35', '5-24'),
(2, 'Quelles sont les principaux éléments d\'une fleur intéressant les pollinisateurs ?', 'Tige - Couleur - Odeur - Nectar', 'Nectar - Forme de la fleur - Feuilles', 'Odeur - Couleur - Feuilles - Nectar'),
(3, 'En moyenne, quel est le pourcentage de fleurs pollinisées par la faune ?', '90 %', '77%', '69%'),
(4, 'Quelles sont les principaux sucres composant un nectar ?', 'Fructose - Sucrose - Glucose', 'Saccharose - Amidon - Mannose', 'Saccharose - Mannose - Galactose'),
(5, 'Quels sont les principaux moyens de pollinisation des fleurs ?', 'Eau - Insectes - Vent', 'Autogamie - Eau - Vent', 'Autogamie - Insectes - Vent');

-- --------------------------------------------------------

--
-- Structure de la table `RANDOMEVENT`
--

DROP TABLE IF EXISTS `RANDOMEVENT`;
CREATE TABLE `RANDOMEVENT` (
  `idEvent` int(11) NOT NULL,
  `nameEvent` varchar(50) DEFAULT NULL,
  `labelEvent` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `SEASON`
--

DROP TABLE IF EXISTS `SEASON`;
CREATE TABLE `SEASON` (
  `humidityModifier` int(11) DEFAULT NULL,
  `insectDensityModifier` int(11) DEFAULT NULL,
  `precipitationAmountModifier` int(11) DEFAULT NULL,
  `precipitationFrequencyModifier` int(11) DEFAULT NULL,
  `temperatureModifier` int(11) DEFAULT NULL,
  `windForceModifier` int(11) DEFAULT NULL,
  `nameSeason` varchar(20) DEFAULT NULL,
  `idSeason` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `SEASONS_MONTHS`
--

DROP TABLE IF EXISTS `SEASONS_MONTHS`;
CREATE TABLE `SEASONS_MONTHS` (
  `idSeason` int(11) NOT NULL,
  `idMonth` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `BIOME`
--
ALTER TABLE `BIOME`
  ADD PRIMARY KEY (`idBiome`);

--
-- Index pour la table `BIOMEEVENTLIST`
--
ALTER TABLE `BIOMEEVENTLIST`
  ADD PRIMARY KEY (`idBiome`,`idEvent`),
  ADD KEY `FK_Event` (`idEvent`);

--
-- Index pour la table `BIOME_SEASONS`
--
ALTER TABLE `BIOME_SEASONS`
  ADD PRIMARY KEY (`idBiome`,`idSeason`),
  ADD KEY `FK_Season` (`idSeason`);

--
-- Index pour la table `COLOR`
--
ALTER TABLE `COLOR`
  ADD PRIMARY KEY (`idColor`);

--
-- Index pour la table `DISPOSITION`
--
ALTER TABLE `DISPOSITION`
  ADD PRIMARY KEY (`idDispo`);

--
-- Index pour la table `FLOWER`
--
ALTER TABLE `FLOWER`
  ADD PRIMARY KEY (`idFlower`) USING BTREE;

--
-- Index pour la table `FORM`
--
ALTER TABLE `FORM`
  ADD PRIMARY KEY (`idForm`);

--
-- Index pour la table `LEAF`
--
ALTER TABLE `LEAF`
  ADD PRIMARY KEY (`idForm`,`idDispo`,`idLeaf`),
  ADD KEY `FK_A_UNE_DISPOSITION` (`idDispo`);

--
-- Index pour la table `NECTAR`
--
ALTER TABLE `NECTAR`
  ADD PRIMARY KEY (`idNectar`);

--
-- Index pour la table `PETAL`
--
ALTER TABLE `PETAL`
  ADD PRIMARY KEY (`id_Couleur`,`idPetale`);

--
-- Index pour la table `POLLINATOR`
--
ALTER TABLE `POLLINATOR`
  ADD PRIMARY KEY (`idPollinator`);

--
-- Index pour la table `QUIZZ`
--
ALTER TABLE `QUIZZ`
  ADD PRIMARY KEY (`idQ`);

--
-- Index pour la table `RANDOMEVENT`
--
ALTER TABLE `RANDOMEVENT`
  ADD PRIMARY KEY (`idEvent`);

--
-- Index pour la table `SEASON`
--
ALTER TABLE `SEASON`
  ADD PRIMARY KEY (`idSeason`),
  ADD UNIQUE KEY `nom_season` (`nameSeason`,`idSeason`);

--
-- Index pour la table `SEASONS_MONTHS`
--
ALTER TABLE `SEASONS_MONTHS`
  ADD PRIMARY KEY (`idSeason`,`idMonth`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `QUIZZ`
--
ALTER TABLE `QUIZZ`
  MODIFY `idQ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `BIOMEEVENTLIST`
--
ALTER TABLE `BIOMEEVENTLIST`
  ADD CONSTRAINT `FK_Event` FOREIGN KEY (`idEvent`) REFERENCES `RANDOMEVENT` (`idEvent`) ON DELETE NO ACTION;

--
-- Contraintes pour la table `BIOME_SEASONS`
--
ALTER TABLE `BIOME_SEASONS`
  ADD CONSTRAINT `FK_Biome` FOREIGN KEY (`idBiome`) REFERENCES `BIOME` (`idBiome`) ON DELETE NO ACTION,
  ADD CONSTRAINT `FK_Season` FOREIGN KEY (`idSeason`) REFERENCES `SEASON` (`idSeason`) ON DELETE NO ACTION;

--
-- Contraintes pour la table `LEAF`
--
ALTER TABLE `LEAF`
  ADD CONSTRAINT `FK_A_UNE_DISPOSITION` FOREIGN KEY (`idDispo`) REFERENCES `DISPOSITION` (`idDispo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_EST_DE_FORME` FOREIGN KEY (`idForm`) REFERENCES `FORM` (`idForm`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `PETAL`
--
ALTER TABLE `PETAL`
  ADD CONSTRAINT `FK_EST_COLOREE` FOREIGN KEY (`id_Couleur`) REFERENCES `COLOR` (`idColor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
