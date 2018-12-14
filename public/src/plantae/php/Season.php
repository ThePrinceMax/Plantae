<?php
	//use PDO;
	namespace Game;
	use Game\Month;

	class Season
	{

		/// Attributs de la classe saison
		private $_idSeason;

        /**
         * @return mixed
         */

		private $_nameSeason;
        /**
         * @var Month[]
         */
        private $_monthList;
        /**
         * @var Month
         */
        private $_currentMonth;
        private $_monthDuration;
		private $_humidityModifier;
		private $_insectDensityModifier;
		private $_precipitationAmountModifier;
		private $_precipitationFrequencyModifier;
		private $_temperatureModifier;
		private $_windForceModifier;

		/// Constructeur de la classe Season
		public function __construct($idSeason, $nameSeason, $monthList, $currentMonth, $monthDuration, $humidityModifier, $insectDensityModifier, $precipitationAmountModifier, $precipitationFrequencyModifier, $temperatureModifier)
		{
            $this->_idSeason = $idSeason;
            $this->_nameSeason = $nameSeason;
            $this->_monthList = $monthList;
            $this->_currentMonth = $currentMonth;
            $this->_monthDuration = $monthDuration;
            $this->_humidityModifier = $humidityModifier;
            $this->_insectDensityModifier = $insectDensityModifier;
            $this->_precipitationAmountModifier = $precipitationAmountModifier;
            $this->_precipitationFrequencyModifier = $precipitationFrequencyModifier;
            $this->_temperatureModifier = $temperatureModifier;
            $this->setBaseMonth();
		}

		public static function createSeasonFromBDD($idSeason){

            $monthList = array();
            $currentMonth = null;


            $result = gameBddRequests::getInstance()->getSeason($idSeason);
            $monthsId = gameBddRequests::getInstance()->getSeasonMonthsId($idSeason);



            $tempMonthList = array();

            foreach ($monthsId as $monthId){
                $tempMonthList[$monthId['idMonth']] = Month::createMonthFromBDD($monthId['idMonth']);
                //echo "==MOIS==".$monthId['idMonth'];
            }

            sort($tempMonthList);


            for($y = 0; $y < count($monthsId); $y++){
                $monthList[$y] = null;
                foreach ($tempMonthList as $row){
                    if($monthList[$y] == null){
                        $monthList[$y] = $row;
                        //echo "MONTH ".$monthList[$i].getMonthId();
                    }
                }
            }

            $currentMonth = $monthList[0];


            /*
            foreach ($monthsId as $monthId){
                $monthList[$monthId['idMonth']] = Month::createMonthFromBDD($monthId['idMonth']);
                if($currentMonth == null){
                    $currentMonth = $monthList[$monthId['idMonth']];
                }
            }
            foreach ($monthList as $month){
                if($month->getMonthId() < $currentMonth->getMonthId()){
                    $currentMonth = $month;
                }
            }*/

            $nameSeason = $result['nameSeason'];
            $humidityModifier = $result['humidityModifier'];
            $insectDensityModifier = $result['insectDensityModifier'];
            $precipitationAmountModifier = $result['precipitationAmountModifier'];
            $precipitationFrequencyModifier = $result['precipitationFrequencyModifier'];
            $temperatureModifier = $result['temperatureModifier'];

            $monthDuration = count($monthList);




            return new Season($idSeason, $nameSeason, $monthList, $currentMonth, $monthDuration, $humidityModifier, $insectDensityModifier, $precipitationAmountModifier, $precipitationFrequencyModifier, $temperatureModifier);

        }

        /// Crée une saison selon le numero de saison (pas de base de données)
        public static function createSeasonDebug($idSeason){
            $nameSeason = "";
            $monthList = array();
            $currentMonth = null;
            $monthDuration = 0;
            $humidityModifier = 0;
            $insectDensityModifier = 0;
            $precipitationAmountModifier = 0;
            $precipitationFrequencyModifier = 0;
            $temperatureModifier = 0;

            switch($idSeason){
                case 0:
                    $nameSeason = "Printemps";
                    $monthList[] = Month::createMonthDebug(2);
                    $monthList[] = Month::createMonthDebug(3);
                    $monthList[] = Month::createMonthDebug(4);

                    $currentMonth = $monthList[0];
                    $monthDuration = 3;
                    $humidityModifier = 0;
                    $insectDensityModifier = 50;
                    $precipitationAmountModifier = +10;
                    $precipitationFrequencyModifier = 25;
                    $temperatureModifier = 5;
                    break;
                case 1:
                    $nameSeason = "Ete";
                    $monthList[] = Month::createMonthDebug(5);
                    $monthList[] = Month::createMonthDebug(6);
                    $monthList[] = Month::createMonthDebug(7);

                    $currentMonth = $monthList[0];
                    $monthDuration = 3;
                    $humidityModifier = -10;
                    $insectDensityModifier = 10;
                    $precipitationAmountModifier = 20;
                    $precipitationFrequencyModifier = -25;
                    $temperatureModifier = 15;
                    break;
                case 2:
                    $nameSeason = "Automne";
                    $monthList[] = Month::createMonthDebug(8);
                    $monthList[] = Month::createMonthDebug(9);
                    $monthList[] = Month::createMonthDebug(10);

                    $currentMonth = $monthList[0];
                    $monthDuration = 3;
                    $humidityModifier = 15;
                    $insectDensityModifier = -15;
                    $precipitationAmountModifier = 30;
                    $precipitationFrequencyModifier = 25;
                    $temperatureModifier = 20;
                    break;
                case 3:
                    $nameSeason = "Hiver";
                    $monthList[] = Month::createMonthDebug(11);
                    $monthList[] = Month::createMonthDebug(0);
                    $monthList[] = Month::createMonthDebug(1);

                    $currentMonth = $monthList[0];
                    $monthDuration = 3;
                    $humidityModifier = 15;
                    $insectDensityModifier = -25;
                    $precipitationAmountModifier = 25;
                    $precipitationFrequencyModifier = 25;
                    $temperatureModifier = -15;
                    break;
            }

            return new Season($idSeason, $nameSeason, $monthList, $currentMonth, $monthDuration, $humidityModifier, $insectDensityModifier, $precipitationAmountModifier, $precipitationFrequencyModifier, $temperatureModifier);
        }

		/// Retourne la liste des mois
		public function getMonthList()
		{
			return $this->_monthList;
		}

        public function getCurrentMonth()
        {
            return $this->_currentMonth;
        }

        /// Set le mois actuel 
        public function setBaseMonth(){
            for($i = 0; $i < sizeof($this->_monthList); $i++){
                if($this->_monthList[$i]->getMonthId() <= $this->_currentMonth->getMonthId()){
                    $this->currentMonth = $this->_monthList[$i];
                }
            }
        }

        /// Set le mois actuel 
        public function nextMonth()
        {
            $nextMonthInList =0;
            for($i = 0; $i < sizeof($this->_monthList); $i++){
                if($this->_currentMonth == $this->_monthList[$i]){
                    if($i == sizeof($this->_monthList)-1){
                        $nextMonthInList = 0;
                    }
                    else{
                        $nextMonthInList = $i+1;
                    }
                }
            }
            $this->_currentMonth = $this->_monthList[$nextMonthInList];
            return $nextMonthInList;
        }

		/// Retourne le nom de la saison courant
		public function getSeason()
		{
			return $this->_nameSeason;
		}

		/// Retourne la durée du mois courant
		public function getMonthDuration()
		{
			return $this->_monthDuration;
		}

		/// Retourne le changement d'humidité
		public function getHumidityModifier()
		{
			return $this->_humidityModifier;
		}

		// Retourne le changement de densité d'insectes
		public function getInsectDensityModifier()
		{
			return $this->_insectDensityModifier;
		}

		/// Retourne le changement de quantité de precipitations
		public function getPrecipitationAmountModifier()
		{
			return $this->_precipitationAmountModifier;
		}

		/// Retourne le changement de frequence de precipitations
		public function getPrecipitationFrequencyModifier()
		{
			return $this->_precipitationFrequencyModifier;
		}

		/// Retourne le changement de temperature 
		public function getTemperatureModifier()
		{
			return $this->_temperatureModifier;
		}

		/// Retourne le changement de force du vent
		public function getWindForceModifier()
		{
			return $this->_windForceModifier;
		}

        public function getIdSeason()
        {
            return $this->_idSeason;
        }

        /// Supprime les mois de la saison
		public function closeSeason(){
            foreach($this->_monthList as $item){
                unset($item);
            }
        }
	}	
?>