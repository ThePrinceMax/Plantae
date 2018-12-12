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

    function getFlower($idFlower)
    {
        $flower = $this->db->query('SELECT * FROM FLOWER WHERE idFlower = :idFlower');
        $res = $flower->fetch();
        return $res;
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

    function getNameFlower($arrayFlower){
        echo $arrayFlower[7];
    }

    function getPopulationFlower($arrayFlower){
        echo $arrayFlower[13];
    }

    function getFamilyFlower($arrayFlower){
        echo $arrayFlower[6];
    }

    function getHasNectarFlower($arrayFlower){
        echo $arrayFlower[14];
    }
    function getBiome($idBiome)
    {
        $biome = $bdd->query('SELECT * FROM BIOME WHERE idBiome = :idBiome');
        return $biome->fetch();
    }

    function getMonth($idMonth){
        $month = $bdd->query('SELECT * FROM MONTH WHERE idMonth = :idMonth');
        return $month->fetch();
    }

    function getLabelMonth($arrayMonth){
        echo $arrayMonth[1];
    }

    function getNectar($idNectar){
        $nectar = $bdd->query('SELECT * FROM NECTAR WHERE idNectar = :idNectar');
        return $nectar->fetch();
    }

    function getPollinator($idPollinator){
        $pollinator = $bdd->query('SELECT * FROM Pollinator WHERE idPollinator = :idPollinator');
        return $pollinator->fetch();
    }

    function getLeaf($idLeaf){
        $leaf = $bdd->query('SELECT * FROM Leaf WHERE idLeaf = :idLeaf');
        return $leaf->fetch();
    }

    function getPetal($idPetal){
        $petal = $bdd->query('SELECT * FROM Petal WHERE idPetal = :idPetal');
        return $leaf->fetch();
    }
    function getCouleur($idFleur)
    {
        $seeds = $bdd->query('SELECT label FROM Color WHERE idColor = (SELECT idColor FROM Flower WHERE idFlower = :idFleur');
        return $seeds->fetch();
    }

    function getDisposition($idFleur)
    {
        $seeds = $bdd->query('SELECT labelDispo FROM Disposition WHERE idDispo = (SELECT idDispo FROM Flower WHERE idFlower = :idFleur');
        return $seeds->fetch();
    }
}

?>