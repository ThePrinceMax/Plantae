<?php
	namespace Game;

	//use PDO;

	class Flower
	{

		/*
		* Attributs de la classe fleur : id, nom, population, presence de nectar (et quantité), resistance aux maladies,
		* sa temperature idéale, une amplitude de temperatures ou elle est relativement resistante, puissance face aux 
		* insecticides et nombre de graines
		*/
		private $_idFlower;
		private $_nameFlower;
		private $_population;
		private $_hasNectar;
		public $_nectar;
		private $_diseaseResistance;

		private $_idealTemperature;
		private $_temperatureAmplitude;
		private $_insecticidePower;
		private $_seeds;

		//Constructeur de la classe Flower
		public function __construct($idFlower, $nameFlower, $population, $hasNectar, $nectarId, $idealTemperature, $temperatureAmplitude, $insecticidePower, $seeds)
		{
            $this->_idFlower = $idFlower;
            $this->_nameFlower = $nameFlower;
            $this->_population = $population;
            $this->_hasNectar = $hasNectar;
            $this->_nectar = Nectar::createNectarDebug($nectarId);
            $this->_idealTemperature = $idealTemperature;
            $this->_temperatureAmplitude = $temperatureAmplitude;
            $this->_insecticidePower = $insecticidePower;
            $this->_seeds = $seeds;
		}

/*		public static function createFlowerFromBDD($idFlower, $bdd){
            echo "Flower";
            $nameFlower = "";
            $population = 0;
            $hasNectar = False;
            $nectarQuantity = 0;
            $diseaseResistance = 0;
            $idealTemperature = 0;
            $temperatureAmplitude = 0;
            $insecticidePower = 0;
            $seeds = 0;

            // Recuperation selon l'id
            try
            {
                $requete = $bdd->query("SELECT nom_fr, population, hasNectar, nectarQuantity, diseaseResistance, idealTemperature
					temperatureAmplitude, insecticidePower, seeds " .
                    "FROM Fleur " .
                    "WHERE id_fleur = :idFlower");

                $result = $requete->fetch();

                $nameFlower = $result[0];
                $population = $result[1];
                $hasNectar = $result[2];
                $nectarQuantity = $result[3];
                $diseaseResistance = $result[4];
                $idealTemperature = $result[5];
                $temperatureAmplitude = $result[6];
                $insecticidePower = $result[7];
                $seeds = $result[8];
            }
            catch(Exception $e)
            {
                echo "Erreur : " . $e->getMessage();
            }

            return new Flower($idFlower, $nameFlower, $population, $hasNectar, $nectarQuantity, $diseaseResistance, $idealTemperature, $temperatureAmplitude, $insecticidePower, $seeds);

        }*/

        public static function createFlowerDebug($idFlower){
            $nameFlower = "";
            $population = 0;
            $hasNectar = False;
            $nectarId = 0;
            $idealTemperature = 0;
            $temperatureAmplitude = 0;
            $insecticidePower = 0;
            $seeds = 0;

		    switch($idFlower){
                case 0:
                    $nameFlower = "Tulipe";
                    $population = 100;
                    $hasNectar = True;
                    $nectarId = 0;
                    $idealTemperature = 20;
                    $temperatureAmplitude = 10;
                    $insecticidePower = 50;
                    $seeds = 50;
            }

            return new Flower($idFlower, $nameFlower, $population, $hasNectar, $nectarId ,$idealTemperature, $temperatureAmplitude, $insecticidePower, $seeds);
        }

		// Retourne l'id de la fleur
		public function getIdFlower()
		{
			return $this->_idFlower;
		}

		// Retourne la puissance de l'insecticide
		public function getNameFlower()
		{
			return $this->_nameFlower;
		}		

		// Retourne la population
		public function getPopulation()
		{
			return $this->_population;
		}

		// Retourne le nombre de graines
		public function getSeeds()
		{
			return $this->_seeds;
		}

		// Retourne la temperature idéale
		public function getIdealTemperature()
		{
			return $this->_idealTemperature;
		}

        // Récupère l'amplitude de temperature
        public function getTemperatureAmplitude()
        {
            return $this->_temperatureAmplitude;
        }

		// Retourne la puissance de l'insecticide
		public function getInsecticidePower()
		{
			return $this->_insecticidePower;
		}

		// Modifie la resistance aux maladies
		public function setDiseaseResistance($diseaseResistance)
		{
			if (is_int($diseaseResistance))
			{
				$this->_insecticidePower = $diseaseResistance;
			}
		}

		// Modifie la temperature ideale
		public function setIdealTemperature($idealTemperature)
		{
			if (is_int($idealTemperature))
			{
				$this->_idealTemperature = $idealTemperature;
			}
		}

		// Modifie la puissance de l'insecticide
		public function setInsecticidePower($insecticidePower)
		{
			if (is_int($insecticidePower))
			{
				$this->_insecticidePower = $insecticidePower;
			}
		}


		// Modifie la population
		public function setPopulation($population)
		{
			if (is_int($population))
			{
				$this->_population = $population;
			}
		}

		// Modifie le nombre de graines
		public function setSeeds($seeds)
		{
			if (is_int($seeds))
			{
				$this->_seeds = $seeds;
			}
		}

		// Modifie l'amplitude de temperature
		public function increaseTemperatureAmplitude($temperatureAmplitude)
		{
			if (is_int($temperatureAmplitude))
			{
				$this->_temperatureAmplitude += $temperatureAmplitude;
			}
		}

		// Modifie la presence/absence de nectar
		public function setNectar($nectar){
			if (is_bool($nectar)){
				if ($nectar == true){
					$nectar = false;
				}
				else {
					$nectar = true;
				}
				return $nectar;
			}
		}

		public function closeNectar(){
            unset($this->_nectar);
        }
	}

?>