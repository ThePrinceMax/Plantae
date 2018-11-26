<?php

namespace Game;
use PDO;

class GameBddRequest
{
    function getFlower($idFlower)
    {
        $flower = $bdd->query('SELECT * FROM FLOWER WHERE idFlower = :idFlower');
        $res = $flower->fetch();
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