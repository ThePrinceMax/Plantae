<?php

namespace Game;
use PDO;

class GameBddRequests
{

    static $instance=null;
    private $db;

    public function __construct()
    {
        require_once "bdd.php";
        try {
            $this->db = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
        }
        catch( PDOException $e ) {
            echo 'Erreur : ' . $e->getMessage();
            exit;
        }
    }

    static function getInstance(){
        if(self::$instance == null){
            self::$instance = new GameBddRequests();

        }
        return self::$instance;
    }

    function getAllFlowers(){
        $flower = $this->db->query('SELECT idFlower, nameFr FROM FLOWER');
        $res = $flower->fetchAll();
        return $res;
    }

    function getAllBiomes(){
        $biome = $this->db->query('SELECT idBiome, nameBiome FROM BIOME');
        $res = $biome->fetchAll();
        return $res;
    }

    function getBiome($idBiome)
    {
        $biome = $this->db->prepare('SELECT idBiome, nameBiome, airPolution, animalDensity, humidity, 
                                            insectDensity, precipitationAverageAmount, precipitationFrequency, 
                                            temperature FROM BIOME WHERE idBiome = :idBiome ');
        $biome->bindValue(':idBiome', $idBiome, PDO::PARAM_INT);
        $biome->execute();
        $res = $biome->fetch();
        return $res;
    }

    function getBiomeEventsId($idBiome)
    {
        $biomeEventsId = $this->db->prepare('SELECT idEvent FROM BIOME_EVENTLIST WHERE idBiome = :idBiome ');
        $biomeEventsId->bindValue(':idBiome', $idBiome, PDO::PARAM_INT);
        $biomeEventsId->execute();
        $res = $biomeEventsId->fetchAll();
        return $res;
    }

    function getEvent($idEvent)
    {
        $event = $this->db->prepare('SELECT idEvent, nameEvent, temperatureMinCond, temperatureMaxCond,
                                            humidityMinCond, humidityMaxCond, airPolutionMinCond, airPolutionMaxCond, 
                                            activationProb, airPolutionModifier, animalDensityModifier, humidityModifier, 
                                            insectDensityModifier, precipitationAverageAmountModifier, precipitationFrequencyModifier, 
                                             temperatureModifier, flowerPopulationModifier, flowerSeedsModifier, pollinatorPopulationModifier FROM RANDOMEVENT WHERE idEvent = :idEvent ');
        $event->bindValue(':idEvent', $idEvent, PDO::PARAM_INT);
        $event->execute();
        $res = $event->fetch();
        return $res;
    }

    function getBiomeSeasonsId($idBiome)
    {
        $biomeSeasonsId = $this->db->prepare('SELECT idSeason FROM BIOME_SEASONS WHERE idBiome = :idBiome ');
        $biomeSeasonsId->bindValue(':idBiome', $idBiome, PDO::PARAM_INT);
        $biomeSeasonsId->execute();
        $res = $biomeSeasonsId->fetchAll();
        return $res;
    }

    function getSeason($idSeason)
    {
        $season = $this->db->prepare('SELECT humidityModifier, insectDensityModifier, precipitationAmountModifier, 
                                              precipitationFrequencyModifier, temperatureModifier, nameSeason, idSeason 
                                              FROM SEASON WHERE idSeason = :idSeason ');
        $season->bindValue(':idSeason', $idSeason, PDO::PARAM_INT);
        $season->execute();
        $res = $season->fetch();
        return $res;
    }

    function getSeasonMonthsId($idSeason)
    {
        echo "\n ID SAISON : ".$idSeason;
        $seasonMonthsId = $this->db->prepare('SELECT idMonth FROM SEASONS_MONTHS WHERE idSeason = :idSeason ');
        $seasonMonthsId->bindValue(':idSeason', $idSeason, PDO::PARAM_INT);
        echo "\nMONTHS IDs ====== ".$seasonMonthsId->execute();
        $res = $seasonMonthsId->fetchAll();
        foreach ($res as $row){
            echo "\nROW :".$row["idMonth"];
        }
        return $res;
    }

    function getMonth($idMonth)
    {
        $season = $this->db->prepare('SELECT idMonth, labelMonth FROM MONTH WHERE idMonth = :idMonth ');
        $season->bindValue(':idMonth', $idMonth, PDO::PARAM_INT);
        $season->execute();
        $res = $season->fetch();
        return $res;
    }

    function getBiomePollinatorsId($idBiome)
    {
        $biomePollinatorsId = $this->db->prepare('SELECT idPollinator FROM BIOME_POLLINATORS WHERE idBiome = :idBiome ');
        $biomePollinatorsId->bindValue(':idBiome', $idBiome, PDO::PARAM_INT);
        $biomePollinatorsId->execute();
        $res = $biomePollinatorsId->fetchAll();
        return $res;
    }

    function getPollinator($idPollinator)
    {
        $pollinator = $this->db->prepare('SELECT idPollinator, namePollinator, populationPollinator, efficiency, fructoseAttraction, 
                                                  glucoseAttraction, sucroseAttraction, temperatureTolerance 
                                                  FROM POLLINATOR WHERE idPollinator = :idPollinator ');
        $pollinator->bindValue(':idPollinator', $idPollinator, PDO::PARAM_INT);
        $pollinator->execute();
        $res = $pollinator->fetch();
        return $res;
    }

    function getNectar($idNectar)
    {
        $nectar = $this->db->prepare('SELECT idNectar, nameNectar, overallQuality, fructoseProp, 
                                              glucoseProp, sucroseProp FROM NECTAR WHERE idNectar = :idNectar ');
        $nectar->bindValue(':idNectar', $idNectar, PDO::PARAM_INT);
        $nectar->execute();
        $res = $nectar->fetch();
        return $res;
    }

    function getFlower($idFlower)
    {
        $flower = $this->db->prepare('SELECT idFlower, nameFr, 
                                                population, hasNectar,
                                               idealTemperature, temperatureAmplitude, insecticidePower, seeds 
                                               FROM FLOWER WHERE idFlower = :idFlower ');
        $flower->bindValue(':idFlower', $idFlower, PDO::PARAM_INT);
        $flower->execute();
        $res = $flower->fetch();
        return $res;
    }

}

?>