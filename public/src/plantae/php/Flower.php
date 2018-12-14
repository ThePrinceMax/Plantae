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
        /**
         * @var Nectar
         */
		public $_nectar;
		private $_diseaseResistance;
		private $_tubeLenght;

		private $_idealTemperature;
		private $_temperatureAmplitude;
		private $_insecticidePower;
		private $_seeds;

		/// Constructeur de la classe Flower
		public function __construct($idFlower, $nameFlower, $population, $hasNectar, $nectar, $diseaseResistance, $idealTemperature, $temperatureAmplitude, $insecticidePower, $seeds)
		{
            $this->_idFlower = $idFlower;
            $this->_nameFlower = $nameFlower;
            $this->_population = $population;
            $this->_hasNectar = $hasNectar;
            $this->_nectar = $nectar;
            $this->_idealTemperature = $idealTemperature;
            $this->_temperatureAmplitude = $temperatureAmplitude;
            $this->_insecticidePower = $insecticidePower;
            $this->_seeds = $seeds;
		}

		public static function createFlowerFromBDD($idFlower){

            $result = GameBddRequests::getInstance()->getFlower($idFlower);

            $nameFlower = $result['nameFr'];
            $population = $result['population'];
            $hasNectar = $result['hasNectar'];

            $nectar = Nectar::createNectarFromBdd($idFlower);

            $diseaseResistance = $result['diseaseResistance'];
            $idealTemperature = $result['idealTemperature'];
            $temperatureAmplitude = $result['temperatureAmplitude'];
            $insecticidePower = $result['insecticidePower'];
            $seeds = $result['seeds'];

            return new Flower($idFlower, $nameFlower, $population, $hasNectar, $nectar, $diseaseResistance, $idealTemperature, $temperatureAmplitude, $insecticidePower, $seeds);

        }

		/// Crée une fleur avec des valeurs arbitraires (sans base de données)
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

		/// Retourne l'id de la fleur
		public function getIdFlower()
		{
			return $this->_idFlower;
		}

		/// Retourne la puissance de l'insecticide
		public function getNameFlower()
		{
			return $this->_nameFlower;
		}		

		/// Retourne la population
		public function getPopulation()
		{
			return $this->_population;
		}

		/// Retourne le nombre de graines
		public function getSeeds()
		{
			return $this->_seeds;
		}

		/// Retourne la temperature idéale
		public function getIdealTemperature()
		{
			return $this->_idealTemperature;
		}

        /// Récupère l'amplitude de temperature
        public function getTemperatureAmplitude()
        {
            return $this->_temperatureAmplitude;
        }

		/// Retourne la puissance de l'insecticide
		public function getInsecticidePower()
		{
			return $this->_insecticidePower;
		}

		/// Modifie la resistance aux maladies
		public function setDiseaseResistance($diseaseResistance)
		{
			if (is_int($diseaseResistance))
			{
				$this->_insecticidePower = $diseaseResistance;
			}
		}

		/// Modifie la temperature ideale
		public function setIdealTemperature($idealTemperature)
		{
			if (is_int($idealTemperature))
			{
				$this->_idealTemperature = $idealTemperature;
			}
		}

		/// Modifie la puissance de l'insecticide
		public function setInsecticidePower($insecticidePower)
		{
			if (is_int($insecticidePower))
			{
				$this->_insecticidePower = $insecticidePower;
			}
		}


		/// Modifie la population
		public function setPopulation($population)
		{
			if (is_int($population))
			{
				$this->_population = $population;
			}
		}

		/// Modifie le nombre de graines
		public function setSeeds($seeds)
		{
			if (is_int($seeds))
			{
				$this->_seeds = $seeds;
			}
		}

		/// Modifie l'amplitude de temperature
		public function increaseTemperatureAmplitude($temperatureAmplitude)
		{
			if (is_int($temperatureAmplitude))
			{
				$this->_temperatureAmplitude += $temperatureAmplitude;
			}
		}

		/// Modifie la presence/absence de nectar
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

		/// Supprime le nectar de la fleur
		public function closeNectar(){
            unset($this->_nectar);
        }
	}

?>