<?php

	//use PDO;
    namespace Game;
    use Game\Season;

	class Biome 
	{
		/**
         * @var Season[]
         */
		private $_seasonList;

        /**
         * @var Season
         */
		public $_currentSeason;
        /**
         * @var Pollinator[]
         */
		public $_pollinisators;
		private $_airPolution;
		private $_animalDensity;
		private $_humidity;
		private $_insectDensity;
		private $_precipitationAverageAmount;
		private $_precipitationFrequency;
		private $_temperature;

        private $_baseAirPolution;
        private $_baseAnimalDensity;
        private $_baseHumidity;
        private $_baseInsectDensity;
        private $_basePrecipitationAverageAmount;
        private $_basePrecipitationFrequency;
        private $_baseTemperature;

		// Constructeur de la classe Biome
		private function __construct($idBiome, $nameBiome, $seasonList	, $currentSeason,$pollinator, $airPolution,	$animalDensity,	$humidity,	$insectDensity,	$precipitationAverageAmount,	$precipitationFrequency,	$temperature)
		{
		    $this->_idBiome = $idBiome;
		    $this->_nameBiome = $nameBiome;
		    $this->_seasonList = $seasonList;
		    $this->_currentSeason = $currentSeason;
		    $this->_pollinisators = $pollinator;

		    $this->_airPolution = $airPolution;
		    $this->_animalDensity = $animalDensity;
		    $this->_humidity = $humidity;
		    $this->_insectDensity = $insectDensity;
		    $this->_precipitationAverageAmount = $precipitationAverageAmount;
		    $this->_precipitationFrequency = $precipitationFrequency;
		    $this->_temperature = $temperature;


            $this->_baseAirPolution = $this->_airPolution;
            $this->_baseAnimalDensity = $this->_animalDensity;
            $this->_baseHumidity = $this->_humidity;
            $this->_baseInsectDensity = $this->_insectDensity;
            $this->_basePrecipitationAverageAmount = $this->_precipitationAverageAmount;
            $this->_basePrecipitationFrequency = $this->_precipitationFrequency;
            $this->_baseTemperature = $this->_temperature;
		}

		public static function createBiomeFromBDD($idBiome){
            $nameBiome = "";
            $seasonList = array();
            $currentSeason = null;
            $pollinator = array();
            $airPolution = 0;
            $animalDensity = 0;
            $humidity = 0;
            $insectDensity = 0;
            $precipitationAverageAmount = 0;
            $precipitationFrequency = 0;
            $temperature = 0;

            $result = gameBddRequests::getBiome($idBiome);

            $nameBiome = $result[0];
            $airPolution = $result[1];
            $animalDensity = $result[2];
            $humidity = $result[3];
            $insectDensity = $result[4];
            $precipitationAverageAmount = $result[5];
            $precipitationFrequency = $result[6];
            $temperature = $result[7];
            $vegetationDensity = $result[8];
            $windForce = $result[9];

            return new Biome($idBiome, $nameBiome, $airPolution, $animalDensity, $humidity, $insectDensity, $precipitationAverageAmount, $precipitationFrequency,$temperature,	$vegetationDensity,$windForce);
        }

        public static function createBiomeDebug($idBiome){
            $nameBiome = "";
            $seasonList = array();
            $currentSeason = null;
            $pollinator = array();
            $airPolution = 0;
            $animalDensity = 0;
            $humidity = 0;
            $insectDensity = 0;
            $precipitationAverageAmount = 0;
            $precipitationFrequency = 0;
            $temperature = 0;
		    switch($idBiome){
                case 0:
                    $nameBiome = "Prairie";
                    $seasonList[] = Season::createSeasonDebug(0);
                    $seasonList[] = Season::createSeasonDebug(1);
                    $seasonList[] = Season::createSeasonDebug(2);
                    $seasonList[] = Season::createSeasonDebug(3);
                    $currentSeason = $seasonList[3];
                    $pollinator[] = Pollinator::createPollinatorDebug(0);
                    $airPolution = 15;
                    $animalDensity = 20;
                    $humidity = 50;
                    $insectDensity = 40;
                    $precipitationAverageAmount = 40;
                    $precipitationFrequency = 50;
                    $temperature = 15;
            }

            return new Biome($idBiome, $nameBiome,$seasonList, $currentSeason, $pollinator,$airPolution, $animalDensity, $humidity, $insectDensity, $precipitationAverageAmount, $precipitationFrequency,$temperature);
        }

        public function nextSeason(){
            $nextSeasonInList = 0;
            if($this->_currentSeason->nextMonth() ==0){
                for($i = 0; $i < sizeof($this->_seasonList); $i++){
                    if($this->_currentSeason == $this->_seasonList[$i]){
                        if($i == sizeof($this->_seasonList)-1){
                            $nextSeasonInList = 0;
                        }
                        else{
                            $nextSeasonInList = $i+1;
                        }
                    }
                }
                $this->_currentSeason = $this->_seasonList[$nextSeasonInList];
            }
        }

        public function setBaseSeason(){
            for($i = 0; $i < sizeof($this->_seasonList); $i++){
                if($this->_seasonList[$i]->getCurrentMonth()->getMonthId() <= $this->_currentSeason->getCurrentMonth()->getMonthId()){
                    $this->_currentSeason = $this->_seasonList[$i];
                }
            }
        }

        public function resetBiomeParam(){
            $this->_airPolution = $this->_baseAirPolution;
            $this->_animalDensity = $this->_baseAnimalDensity;
            $this->_humidity = $this->_baseHumidity;
            $this->_insectDensity = $this->_baseInsectDensity;
            $this->_precipitationAverageAmount = $this->_basePrecipitationAverageAmount;
            $this->_precipitationFrequency = $this->_basePrecipitationFrequency;
            $this->_temperature = $this->_baseTemperature;

        }

        public function seasonEffectCalculator(){
            $seasonLenghtIsEven = false;
            $seasonMiddle = 0;
            if($this->_currentSeason->getMonthDuration()%2 == 0){ //Il n'y a pas de mois du milieu, la saison a un nombre pair de mois
                $seasonLenghtIsEven = true;
                $seasonMiddle = intdiv($this->_currentSeason->getMonthDuration(), 2);
            }
            else{ //le mois du milieu de la saison correspond a un nombre entier, la saison a un nombre impair de mois
                $seasonMiddle = intdiv($this->_currentSeason->getMonthDuration(), 2) + 1;
            }

            if($seasonLenghtIsEven){
                if($this->_currentSeason->getMonthList() < $seasonMiddle){

                }
            }
            else{

            }
            



        }

        public function applySeasonEffects(){
            $this->_airPolution += $this->_currentSeason->getHumidityModifier();
            $this->_humidity += $this->_currentSeason->getHumidityModifier();
            $this->_insectDensity += $this->_currentSeason->getInsectDensityModifier();
            $this->_precipitationAverageAmount += $this->_currentSeason->getPrecipitationAmountModifier();
            $this->_precipitationFrequency += $this->_currentSeason->getPrecipitationFrequencyModifier();
            $this->_temperature += $this->_currentSeason->getTemperatureModifier();
        }


		// Getter pour le nom
		public function getNameBiome()
		{
			return $this->_nameBiome;
		}


		// Getter pour l'id
		public function getIdBiome()
		{
			return $this->_idBiome;
		}


		// Getter / Setter pour la pollution de l'air
		public function getAirPolution()
		{
			return $this->_airPolution;
		}
		public function setAirPolution($airPolution)
		{
			if (is_int($airPolution))
			{
				$this->_airPolution = $airPolution;
			}
		}


		// Getter / Setter pour la densité animale
		public function getAnimalDensity()
		{
			return $this->_animalDensity;
		}
		public function setAnimalDensity($animalDensity)
		{
			if (is_int($animalDensity))
			{
				$this->_animalDensity = $animalDensity;
			}
		}


		// Getter / Setter pour l'humidité
		public function getHumidity()
		{
			return $this->_humidity;
		}
		public function setHumidity($humidity)
		{
			if (is_int($humidity))
			{
				$this->_humidity = $humidity;
			}
		}


		// Getter / Setter pour la densité des insectes
		public function getInsectDensity()
		{
			return $this->_insectDensity;
		}
		public function setInsectDensity($insectDensity)
		{
			if (is_int($insectDensity))
			{
				$this->_insectDensity = $insectDensity;
			}
		}


		// Getter / Setter pour la quantité moyenne de precipitations
		public function getPrecipitationAverageAmount()
		{
			return $this->_precipitationAverageAmount;
		}
		public function setPrecipitationAverageAmount($precipitationAverageAmount)
		{
			if (is_int($precipitationAverageAmount))
			{
				$this->_precipitationAverageAmount = $precipitationAverageAmount;
			}
		}


		// Getter / Setter pour la frequence des precipitations
		public function getPrecipitationFrequency()
		{
			return $this->_precipitationFrequency;
		}
		public function setPrecipitationFrequency($precipitationFrequency)
		{
			if (is_int($precipitationFrequency))
			{
				$this->_precipitationFrequency = $precipitationFrequency;
			}
		}


		// Getter / Setter pour la temperature
		public function getTemperature()
		{
			return $this->_temperature;
		}
		public function setTemperature($temperature)
		{
			if (is_int($temperature))
			{
				$this->_temperature = $temperature;
			}
		}

		public function closeBiome(){
            foreach ($this->_seasonList as $item){
                $item->closeSeason();
                unset($item);
            }
            foreach ($this->_pollinisators as $item){
                unset($item);
            }

        }

	}
