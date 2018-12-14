-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le :  ven. 14 déc. 2018 à 18:52
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
-- Base de données :  `t3_plantae_princelle`
--
CREATE DATABASE IF NOT EXISTS `t3_plantae_princelle` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `t3_plantae_princelle`;

-- --------------------------------------------------------

--
-- Structure de la table `BIOME`
--

DROP TABLE IF EXISTS `BIOME`;
CREATE TABLE `BIOME` (
  `idBiome` int(11) NOT NULL,
  `nameBiome` varchar(35) CHARACTER SET latin1 DEFAULT NULL,
  `airPolution` int(11) DEFAULT NULL,
  `animalDensity` int(11) DEFAULT NULL,
  `humidity` int(11) DEFAULT NULL,
  `insectDensity` int(11) DEFAULT NULL,
  `precipitationAverageAmount` int(11) DEFAULT NULL,
  `precipitationFrequency` int(11) DEFAULT NULL,
  `temperature` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `BIOME`
--

INSERT INTO `BIOME` (`idBiome`, `nameBiome`, `airPolution`, `animalDensity`, `humidity`, `insectDensity`, `precipitationAverageAmount`, `precipitationFrequency`, `temperature`) VALUES
(0, 'Prairie', 15, 20, 50, 40, 40, 50, 15),
(1, 'Foret tropicale', 10, 50, 70, 60, 60, 65, 25),
(2, 'Foret temperee', 13, 40, 55, 50, 50, 55, 10),
(3, 'Toundra', 10, 25, 30, 30, 20, 35, 5),
(4, 'Savane', 10, 30, 25, 35, 40, 20, 18),
(5, 'Desert', 5, 5, 10, 30, 20, 30, 25);

-- --------------------------------------------------------

--
-- Structure de la table `BIOME_EVENTLIST`
--

DROP TABLE IF EXISTS `BIOME_EVENTLIST`;
CREATE TABLE `BIOME_EVENTLIST` (
  `idBiome` int(11) NOT NULL,
  `idEvent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `BIOME_EVENTLIST`
--

INSERT INTO `BIOME_EVENTLIST` (`idBiome`, `idEvent`) VALUES
(0, 0),
(1, 0),
(2, 0),
(0, 1),
(2, 1),
(4, 1),
(5, 1),
(2, 2),
(3, 2),
(5, 2),
(1, 3),
(4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `BIOME_POLLINATORS`
--

DROP TABLE IF EXISTS `BIOME_POLLINATORS`;
CREATE TABLE `BIOME_POLLINATORS` (
  `idBiome` int(11) NOT NULL,
  `idPollinator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `BIOME_POLLINATORS`
--

INSERT INTO `BIOME_POLLINATORS` (`idBiome`, `idPollinator`) VALUES
(0, 0),
(0, 1),
(0, 1),
(0, 2),
(0, 3),
(0, 4),
(1, 4),
(1, 1),
(1, 2),
(2, 0),
(2, 4),
(2, 2),
(3, 1),
(3, 4),
(4, 4),
(5, 4);

-- --------------------------------------------------------

--
-- Structure de la table `BIOME_SEASONS`
--

DROP TABLE IF EXISTS `BIOME_SEASONS`;
CREATE TABLE `BIOME_SEASONS` (
  `idBiome` int(11) NOT NULL,
  `idSeason` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `BIOME_SEASONS`
--

INSERT INTO `BIOME_SEASONS` (`idBiome`, `idSeason`) VALUES
(0, 0),
(1, 0),
(2, 0),
(3, 0),
(4, 0),
(5, 0),
(0, 1),
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(0, 2),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(0, 3),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3);

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
-- Structure de la table `FLOWER`
--

DROP TABLE IF EXISTS `FLOWER`;
CREATE TABLE `FLOWER` (
  `idFlower` int(11) NOT NULL,
  `nameFr` varchar(20) DEFAULT NULL,
  `family` varchar(20) DEFAULT NULL,
  `nameLatin` varchar(30) DEFAULT NULL,
  `inflorescence` int(11) DEFAULT NULL,
  `nbPetals` int(11) DEFAULT NULL,
  `colorPetals` varchar(50) DEFAULT NULL,
  `population` int(11) DEFAULT NULL,
  `hasNectar` tinyint(1) DEFAULT NULL,
  `idealTemperature` int(11) DEFAULT NULL,
  `temperatureAmplitude` int(11) DEFAULT NULL,
  `insecticidePower` int(11) DEFAULT NULL,
  `seeds` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `FLOWER`
--

INSERT INTO `FLOWER` (`idFlower`, `nameFr`, `family`, `nameLatin`, `inflorescence`, `nbPetals`, `colorPetals`, `population`, `hasNectar`, `idealTemperature`, `temperatureAmplitude`, `insecticidePower`, `seeds`) VALUES
(0, 'tulipe', 'liliacées', 'tulipa clusiana', NULL, 5, 'jaune', 95, 1, 20, 10, 50, 50),
(1, 'Lys', 'Liliaceae', 'Lylium longiflorum', NULL, 6, 'blanche', 96, 1, 0, 20, 50, 50),
(2, 'Jonquille', ' Amarylidacées', 'Narcissus jonquilla', NULL, 6, 'Jaune', 97, 1, 12, 3, 60, 40),
(3, 'Lotus', 'Nélumbonacées', 'Nelumbo nucifera', NULL, 13, 'blanc rosé', 98, 1, 33, 3, 45, 55),
(4, 'Sakura', 'Rosaceae', 'Prunus serulata', NULL, 5, 'rose', 99, 1, 12, 10, 50, 50),
(5, 'Iris versicolore', 'Iridaceae', 'Iris versicolor', NULL, 6, 'Violet', 100, 1, 10, 20, 40, 50),
(6, 'Jasmin', 'Oleaceae', 'Jasminum polyanthum', NULL, 5, 'blanc', 101, 1, 15, 5, 45, 55),
(7, 'Coquelicot', 'Papaveraceae', 'Papaver rhoeas', NULL, 4, 'rouge', 102, 1, 10, 5, 50, 50),
(8, 'Dahlia', 'Asteraceae', 'Dahlia pinnata', NULL, 9, 'rouge', 103, 1, 5, 10, 20, 50),
(9, 'Orchis papillon', 'Orchidaceae', 'Anacamptis papilionacea', NULL, 7, 'violet', 104, 1, 5, 5, 60, 50),
(10, 'Rose Papa Meilland', ' Rosaceae', 'Rosae', NULL, NULL, 'Rouge', 105, 1, 22, 9, 55, 45);

-- --------------------------------------------------------

--
-- Structure de la table `FLOWER_NECTAR`
--

DROP TABLE IF EXISTS `FLOWER_NECTAR`;
CREATE TABLE `FLOWER_NECTAR` (
  `idFlower` int(11) NOT NULL,
  `idNectar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `FLOWER_NECTAR`
--

INSERT INTO `FLOWER_NECTAR` (`idFlower`, `idNectar`) VALUES
(0, 0),
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `MONTH`
--

DROP TABLE IF EXISTS `MONTH`;
CREATE TABLE `MONTH` (
  `idMonth` int(11) NOT NULL,
  `labelMonth` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `MONTH`
--

INSERT INTO `MONTH` (`idMonth`, `labelMonth`) VALUES
(0, 'Janvier'),
(1, 'Février'),
(2, 'Mars'),
(3, 'Avril'),
(4, 'Mai'),
(5, 'Juin'),
(6, 'Juillet'),
(7, 'Août'),
(8, 'Septembre'),
(9, 'Octobre'),
(10, 'Novembre'),
(11, 'Decembre');

-- --------------------------------------------------------

--
-- Structure de la table `NECTAR`
--

DROP TABLE IF EXISTS `NECTAR`;
CREATE TABLE `NECTAR` (
  `idNectar` int(11) NOT NULL,
  `nameNectar` varchar(50) DEFAULT NULL,
  `overallQuality` int(11) DEFAULT NULL,
  `fructoseProp` int(11) DEFAULT NULL,
  `glucoseProp` int(11) DEFAULT NULL,
  `sucroseProp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `NECTAR`
--

INSERT INTO `NECTAR` (`idNectar`, `nameNectar`, `overallQuality`, `fructoseProp`, `glucoseProp`, `sucroseProp`) VALUES
(0, 'Nectar de tulipe', 20, 20, 40, 40),
(1, 'Nectar de Lys', 22, 50, 25, 25),
(2, 'Nectar de Jonquille', 25, 40, 30, 30),
(3, 'Nectar3', 24, 45, 15, 40),
(4, 'Nectar4', 26, 60, 10, 30),
(5, 'Nectar5', 23, 45, 5, 45),
(6, 'Nectar6', 25, 50, 25, 25),
(7, 'Nectar7', 25, 40, 30, 30),
(8, 'Nectar8', 25, 33, 33, 34),
(9, 'Nectar9', 15, 33, 33, 34),
(10, 'Nectar10', 25, 50, 25, 25);

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
  `sucroseAttraction` int(11) DEFAULT NULL,
  `temperatureTolerance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `POLLINATOR`
--

INSERT INTO `POLLINATOR` (`idPollinator`, `namePollinator`, `populationPollinator`, `efficiency`, `fructoseAttraction`, `glucoseAttraction`, `sucroseAttraction`, `temperatureTolerance`) VALUES
(0, 'Abeilles', 1000, 100, 80, 10, 10, 20),
(1, 'Papillons', 700, 100, 25, 50, 25, 10),
(2, 'Guêpes', 300, 90, 5, 35, 60, 25),
(3, 'Bourdons', 500, 120, 20, 30, 50, 15),
(4, 'Fourmis', 3000, 20, 20, 20, 60, 30);

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
  `temperatureMinCond` int(11) NOT NULL,
  `temperatureMaxCond` int(11) NOT NULL,
  `humidityMinCond` int(11) NOT NULL,
  `humidityMaxCond` int(11) NOT NULL,
  `airPolutionMinCond` int(11) NOT NULL,
  `airPolutionMaxCond` int(11) NOT NULL,
  `activationProb` int(11) NOT NULL,
  `airPolutionModifier` int(11) NOT NULL,
  `animalDensityModifier` int(11) NOT NULL,
  `humidityModifier` int(11) NOT NULL,
  `insectDensityModifier` int(11) NOT NULL,
  `precipitationAverageAmountModifier` int(11) NOT NULL,
  `precipitationFrequencyModifier` int(11) NOT NULL,
  `temperatureModifier` int(11) NOT NULL,
  `flowerPopulationModifier` int(11) NOT NULL,
  `flowerSeedsModifier` int(11) NOT NULL,
  `pollinatorPopulationModifier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `RANDOMEVENT`
--

INSERT INTO `RANDOMEVENT` (`idEvent`, `nameEvent`, `temperatureMinCond`, `temperatureMaxCond`, `humidityMinCond`, `humidityMaxCond`, `airPolutionMinCond`, `airPolutionMaxCond`, `activationProb`, `airPolutionModifier`, `animalDensityModifier`, `humidityModifier`, `insectDensityModifier`, `precipitationAverageAmountModifier`, `precipitationFrequencyModifier`, `temperatureModifier`, `flowerPopulationModifier`, `flowerSeedsModifier`, `pollinatorPopulationModifier`) VALUES
(0, 'Pluie', 1, 50, 30, 70, 0, 100, 50, 100, 100, 130, 110, 130, 130, 80, 110, 90, 100),
(1, 'Secheresse', 25, 50, 20, 50, 0, 100, 50, 100, 100, 70, 100, 60, 60, 140, 80, 100, 100),
(2, 'Blizzard', -20, 0, 10, 30, 0, 100, 50, 100, 100, 60, 80, 50, 50, 30, 50, 90, 90),
(3, 'Orage', 1, 30, 40, 80, 0, 100, 50, 100, 100, 80, 120, 140, 110, 40, 100, 100, 100);

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
  `nameSeason` varchar(20) DEFAULT NULL,
  `idSeason` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `SEASON`
--

INSERT INTO `SEASON` (`humidityModifier`, `insectDensityModifier`, `precipitationAmountModifier`, `precipitationFrequencyModifier`, `temperatureModifier`, `nameSeason`, `idSeason`) VALUES
(0, 50, 10, 25, 5, 'Printemps', 0),
(-10, 25, 20, -25, 15, 'Été', 1),
(15, -15, 30, 25, 20, 'Automne', 2),
(15, -25, 25, 25, -15, 'Hiver', 3);

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
-- Déchargement des données de la table `SEASONS_MONTHS`
--

INSERT INTO `SEASONS_MONTHS` (`idSeason`, `idMonth`) VALUES
(0, 2),
(0, 3),
(0, 4),
(1, 5),
(1, 6),
(1, 7),
(2, 8),
(2, 9),
(2, 10),
(3, 0),
(3, 1),
(3, 11);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `BIOME`
--
ALTER TABLE `BIOME`
  ADD PRIMARY KEY (`idBiome`);

--
-- Index pour la table `BIOME_EVENTLIST`
--
ALTER TABLE `BIOME_EVENTLIST`
  ADD PRIMARY KEY (`idBiome`,`idEvent`),
  ADD KEY `FK_Event` (`idEvent`);

--
-- Index pour la table `BIOME_POLLINATORS`
--
ALTER TABLE `BIOME_POLLINATORS`
  ADD KEY `FK_Pollinator` (`idPollinator`),
  ADD KEY `FK_BiomePolli` (`idBiome`);

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
-- Index pour la table `FLOWER`
--
ALTER TABLE `FLOWER`
  ADD PRIMARY KEY (`idFlower`) USING BTREE;

--
-- Index pour la table `FLOWER_NECTAR`
--
ALTER TABLE `FLOWER_NECTAR`
  ADD UNIQUE KEY `idFlower` (`idFlower`),
  ADD UNIQUE KEY `idNectar` (`idNectar`);

--
-- Index pour la table `NECTAR`
--
ALTER TABLE `NECTAR`
  ADD PRIMARY KEY (`idNectar`);

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
-- Contraintes pour la table `BIOME_EVENTLIST`
--
ALTER TABLE `BIOME_EVENTLIST`
  ADD CONSTRAINT `FK_Event` FOREIGN KEY (`idEvent`) REFERENCES `RANDOMEVENT` (`idEvent`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Fk_BiomeEvent` FOREIGN KEY (`idBiome`) REFERENCES `BIOME` (`idBiome`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `BIOME_POLLINATORS`
--
ALTER TABLE `BIOME_POLLINATORS`
  ADD CONSTRAINT `FK_BiomePolli` FOREIGN KEY (`idBiome`) REFERENCES `BIOME` (`idBiome`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Pollinator` FOREIGN KEY (`idPollinator`) REFERENCES `POLLINATOR` (`idPollinator`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `BIOME_SEASONS`
--
ALTER TABLE `BIOME_SEASONS`
  ADD CONSTRAINT `FK_Biome` FOREIGN KEY (`idBiome`) REFERENCES `BIOME` (`idBiome`) ON DELETE NO ACTION,
  ADD CONSTRAINT `FK_Season` FOREIGN KEY (`idSeason`) REFERENCES `SEASON` (`idSeason`) ON DELETE NO ACTION;

--
-- Contraintes pour la table `FLOWER_NECTAR`
--
ALTER TABLE `FLOWER_NECTAR`
  ADD CONSTRAINT `FK_FlowerNect` FOREIGN KEY (`idFlower`) REFERENCES `FLOWER` (`idFlower`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Nect` FOREIGN KEY (`idNectar`) REFERENCES `NECTAR` (`idNectar`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
