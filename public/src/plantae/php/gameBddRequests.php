<?php

use PDO;

class requete
{

    function getNomFleur($idFleur)
    {
        $fleur = $bdd->query('SELECT nameFr FROM Fleur WHERE idFlower = :idFleur');
        $res = $fleur->fetch();
        return $res;
    }

    function getFlower($idFlower)
    {
        $flower = $bdd->query('SELECT * FROM FLOWER WHERE idFlower = :idFlower');
        $res = $flower->fetch();
        return $res;
    }

    function getBiome($idBiome)
    {
        $biome = $bdd->query('SELECT * FROM BIOME WHERE idBiome = :idBiome');
        return $biome->fetch();
    }

    function getMonth($idMonth){
        $month->query('SELECT * FROM MONTHS WHERE idMonth = :idMonth');
        return $month->fetch();
    }

    function getNectar($idNectar){
        $nectar->query('SELECT * FROM NECTAR WHERE idNectar = :idNectar');
        return $nectar->fetch();
    }

    function getPollinator($id){
        $nectar->query('SELECT * FROM NECTAR WHERE idNectar = :idNectar');
        return $nectar->fetch();
    }

    function getCouleur($idFleur)
    {
        $seeds = $bdd->query('SELECT label FROM Color WHERE id_couleur = (SELECT id_couleur FROM Fleur WHERE id_fleur = :idFleur');
        return $seeds->fetch();
    }

    function getDisposition($idFleur)
    {
        $seeds = $bdd->query('SELECT libelle_dispo FROM Disposition WHERE id_dispo = (SELECT id_dispo FROM Fleur WHERE id_fleur = :idFleur');
        return $seeds->fetch();
    }
}

?>