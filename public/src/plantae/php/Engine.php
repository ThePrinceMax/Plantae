<?php

    namespace Game;

	//use PDO;

	class Engine
	{
        /**
         * @var Player
         */
	    public $_creator;
        /**
         * @var Player
         */
		public $_player;
        /**
         * @var Ai
         */
		public $_ai;
        /**
         * @var Biome
         */
		private $_biome;

        /**
         * @var RandomEvent[]
         */
		private $_eventList;

		/**
         * @var RandomEvent
         */
		public $_currentEvent;

        private $_turnsCounter;
		private $_maxTurns;
		private $_engineID;
		private $_isPVP;
		private $_gameFull;
		
		public function __construct($creatorId, $flowerID, $biomeID, $engineID, $isPVP, $maxTurns/*,  $bdd*/)
		{

		    if($isPVP){
		        $this->_isPVP = true;
                $this->_gameFull = false;
            }
            else{
                $this->_isPVP = false;
                $this->_gameFull = true;

            }
			echo "engine creation";
			$this->_creator = Player::createPlayerDebug($creatorId, $flowerID);
			$this->_engineID = $engineID;
			//$this->_biome = $this->biomeLoader($biomeID);
            $this->_biome = Biome::createBiomeFromBDD($biomeID);
            $this->_biome->setBaseSeason();
			//$this->_eventList = $this->eventLoaderDebug($biomeID);
			$this->_eventList = $this->eventLoaderBdd($biomeID);
            $this->_currentEvent = null;
			$this->_turnsCounter = 0;
			$this->_maxTurns = $maxTurns;

			echo "engine created";
		}

		public function eventLoaderDebug($biomeID){
		    $eventIDList= array();
		    switch($biomeID){
                case 0:
                    $eventIDList[] = 0;
                    $eventIDList[] = 1;
            }

            $eventList = array();
		    foreach ($eventIDList as $eventID){
		        $eventList[] = RandomEvent::createEventDebug($eventID);
            }
            return $eventList;

        }

        public function eventLoaderBdd($biomeID){
            $eventIDList= GameBddRequests::getInstance()->getBiomeEventsId($biomeID);

            $eventList = array();
            foreach ($eventIDList as $eventID){
                $eventList[] = RandomEvent::createEventFromBDD($eventID);
            }
            return $eventList;
        }

        public function triggerEvent(){
		    $this->_currentEvent = null;

		    $eventTriggered = false;

		    $temperatureWeight = 35;
		    $humidityWeight = 35;
		    $airPolutionWeight = 30;

		    foreach ($this->_eventList as $item){
		        echo $item->getName();

		        if($eventTriggered == false){
                    $eventTriggerWeight = 0;

                    if($this->_biome->getTemperature() >= $item->getTemperatureMinCond() && $this->_biome->getTemperature() <= $item->getTemperatureMaxCond()){
                        $eventTriggerWeight += $temperatureWeight;
                    }
                    if ($this->_biome->getHumidity()  >= $item->getHumidityMinCond() && $this->_biome->getHumidity()  <= $item->getHumidityMaxCond()){
                        $eventTriggerWeight += $humidityWeight;
                    }
                    if ($this->_biome->getAirPolution()  >= $item->getAirPolutionMinCond() && $this->_biome->getAirPolution()  <= $item->getAirPolutionMaxCond()){
                        $eventTriggerWeight += $airPolutionWeight;
                    }

                    // probaEvent         | 100%
                    // eventTriggerScale  | $eventTriggerWeight

                    $eventTriggerScale =  intdiv($eventTriggerWeight * $item->getActivationProb(),100);

                    echo "EVENT SCALE: ".$eventTriggerScale;

                    $numberRolled = mt_rand(0,100);
                    echo "NUMBER ROLLED: ".$numberRolled;



                    if($numberRolled <= $eventTriggerScale){
                        $eventTriggered = true;
                        $this->_currentEvent = $item;
                    }

                }

            }
            return $eventTriggered;
        }

        public function applyEventEffects(){

		    echo $this->_currentEvent->getName();

		    // vacAct | 100
            // val    | pourcentVale
            echo "APPLY EVENT";
            $this->_biome->setAirPolution(intdiv($this->_currentEvent->getAirPolutionModifier() * $this->_biome->getAirPolution(), 100));
            $this->_biome->setAnimalDensity(intdiv($this->_currentEvent->getAnimalDensityModifier() * $this->_biome->getAnimalDensity(), 100));
            $this->_biome->setHumidity(intdiv($this->_currentEvent->getHumidityModifier() * $this->_biome->getHumidity(), 100));
            $this->_biome->setInsectDensity(intdiv($this->_currentEvent->getInsectDensityModifier() * $this->_biome->getInsectDensity(), 100));
            $this->_biome->setPrecipitationAverageAmount(intdiv($this->_currentEvent->getPrecipitationAverageAmountModifier() * $this->_biome->getPrecipitationAverageAmount(), 100));
            $this->_biome->setPrecipitationFrequency(intdiv($this->_currentEvent->getPrecipitationFrequencyModifier() * $this->_biome->getPrecipitationFrequency(), 100));
            $this->_biome->setTemperature(intdiv($this->_currentEvent->getTemperatureModifier() * $this->_biome->getTemperature(), 100));
            $this->_creator->_flower->setPopulation(intdiv($this->_currentEvent->getFlowerPopulationModifier() * $this->_creator->_flower->getPopulation(), 100));
            $this->_creator->_flower->setSeeds(intdiv($this->_currentEvent->getFlowerSeedsModifier() * $this->_creator->_flower->getSeeds(), 100));

            if($this->isPVP()){
                $this->_player->_flower->setPopulation(intdiv($this->_currentEvent->getFlowerPopulationModifier() * $this->_player->_flower->getPopulation(), 100));
                $this->_player->_flower->setSeeds(intdiv($this->_currentEvent->getFlowerSeedsModifier() * $this->_player->_flower->getSeeds(), 100));

            }
            else{
                $this->_ai->_flower->setPopulation(intdiv($this->_currentEvent->getFlowerPopulationModifier() * $this->_ai->_flower->getPopulation(), 100));
                $this->_ai->_flower->setSeeds(intdiv($this->_currentEvent->getFlowerSeedsModifier() * $this->_ai->_flower->getSeeds(), 100));

            }

            foreach ($this->_biome->_pollinisators as $pollinator){
                $pollinator->setPopulation(intdiv($pollinator->getPopulation() * $this->_currentEvent->getPollinatorPopulationModifier(), 100));
            }

        }

		public static function enginePVP($creatorId, $flowerId, $biomeId, $engineID, $maxTurns){

		    return new Engine($creatorId, $flowerId, $biomeId, $engineID, true , $maxTurns );

        }

        public static function engineSolo($creatorId, $flowerId, $biomeId, $engineID, $maxTurns){
		    $engine = new Engine($creatorId, $flowerId, $biomeId, $engineID, false, $maxTurns);
            $flower = mt_rand(0,10);
		    $engine->_ai = Ai::createAiDebug(0,$flower);
		    echo "Partie solo créé";
		    return $engine;
        }

        public function winCheck(){ // On vérifie la condition de victoire de la partie
		    $winner = -1;
		    if($this->_isPVP){
                if($this->creatorStillAlive() && $this->playerStillAlive() && $this->_turnsCounter == $this->_maxTurns){
                    $winner = $this->populationTest();
                }
                else if(!$this->creatorStillAlive()){
                    $winner = $this->_player->getId();
                }
                else if (!$this->playerStillAlive()){
                    $winner = $this->_creator->getId();
                }
            }
            else{
                if($this->creatorStillAlive() && $this->aiStillAlive() && $this->_turnsCounter == $this->_maxTurns){
                    $winner = $this->populationTest();
                }
                else if(!$this->creatorStillAlive()){
                    $winner = -2;
                }
                else if (!$this->aiStillAlive()){
                    $winner = $this->_creator->getId();
                }
            }

            return $winner;
        }

        public function creatorStillAlive(){ //On vérifie si le créateur a encore des graines ou des fleures en vie
		    $alive = false;
            if($this->_creator->_flower->getPopulation()>0 || $this->_creator->_flower->getSeeds() > 0){
                $alive = true;
            }
            return $alive;
        }

        public function playerStillAlive(){ //On vérifie si le joueur a encore des graines ou des fleures
		    $alive = false;
		    if($this->_player->_flower->getPopulation()>0 || $this->_player->_flower->getSeeds() > 0){
		        $alive = true;
            }
            return $alive;
        }

        public function aiStillAlive(){
            $alive = false;
            if($this->_ai->_flower->getPopulation()>0 || $this->_ai->_flower->getSeeds() > 0){
                $alive = true;
            }
            return $alive;
        }

        public function populationTest(){ //Le joueur gagant est celui qui a la population la plus élevée
            $winner = -1;
            if($this->_isPVP){
                if($this->_creator->_flower->getPopulation() > $this->_player->_flower->getPopulation() ){
                    $winner = $this->_creator->getId();
                }
                else if ($this->_player->_flower->getPopulation() > $this->_creator->_flower->getPopulation()){
                    $winner = $this->_player->getId();
                }
                else if( $this->_creator->_flower->getPopulation() == $this->_player->_flower->getPopulation()){
                    $winner = 0;
                }
            }
            else{
                if($this->_creator->_flower->getPopulation() > $this->_ai->_flower->getPopulation() ){
                    $winner = $this->_creator->getId();
                }
                else if ($this->_ai->_flower->getPopulation() > $this->_creator->_flower->getPopulation()){
                    $winner = -2;
                }
                else if( $this->_creator->_flower->getPopulation() == $this->_ai->_flower->getPopulation()){
                    $winner = 0;
                }
            }


            return $winner;
        }

        public function nextTurn(){
            $nextTurnDone = false;
            if($this->_isPVP){
                if($this->_turnsCounter<$this->_maxTurns){
                    if($this->_turnsCounter % 3){
                        $this->givePoints();
                    }
                    $this->_biome->resetBiomeParam();
                    $this->_biome->nextSeason();
                    $this->_biome->applySeasonEffects();
                    $eventTriggered = $this->triggerEvent();

                    if($eventTriggered){
                        $this->applyEventEffects();
                    }

                    $this->grainesGermes($this->_creator->_flower);
                    $this->grainesGermes($this->_player->_flower);

                    $this->polliniser($this->_creator->_flower);
                    $this->polliniser($this->_player->_flower);

                    $this->reproductionPollinisateur();


                    $this->mortaliteFleur($this->_creator->_flower);
                    $this->mortaliteFleur($this->_player->_flower);

                    $this->mortalitePollinisateur();

                    $this->_turnsCounter++;
                    $nextTurnDone = true;
                }
            }

            else{
                echo "nextTurnSOLO\n";
                if($this->_turnsCounter<$this->_maxTurns){
                    if($this->_turnsCounter % 3){
                        echo "GIVEPOINTS\n";
                        $this->givePoints();
                        echo "GIVEPOINTSDONE\n";

                    }
                    echo "NEXT\n";
                    $this->_biome->resetBiomeParam();
                    $this->_biome->nextSeason();
                    $this->_biome->applySeasonEffects();

                    $eventTriggered = $this->triggerEvent();

                    if($eventTriggered){
                        $this->applyEventEffects();
                    }

                    echo "NEXTDONE\n";
                    $this->grainesGermes($this->_creator->_flower);
                    $this->grainesGermes($this->_ai->_flower);

                    $this->polliniser($this->_creator->_flower);
                    $this->polliniser($this->_ai->_flower);

                    $this->reproductionPollinisateur();


                    $this->mortaliteFleur($this->_creator->_flower);
                    $this->mortaliteFleur($this->_ai->_flower);

                    $this->mortalitePollinisateur();

                    $this->_turnsCounter++;
                    $nextTurnDone = true;
                    $this->_ai->randomAttribute();
                }
            }
            echo "NEXTURNDONE\n";
            return $nextTurnDone;
        }

        public function givePoints(){
		    if($this->_isPVP){
                $this->_player->addPoints(intdiv($this->_player->_flower->getPopulation(), 100));
                $this->_creator->addPoints(intdiv($this->_creator->_flower->getPopulation(), 100));
            }
            else{
                $this->_ai->addPoints(intdiv($this->_ai->_flower->getPopulation(), 100));
                $this->_creator->addPoints(intdiv($this->_creator->_flower->getPopulation(), 100));
            }

        }

        /**
         * @param $flower Flower
         */
        public function polliniser($flower){
            $popFleurAPolliniser = $flower->getPopulation();
            $fleursPollinisee = 0;
            $popFleurAPolliniser = $popFleurAPolliniser - intdiv((100-$flower->_nectar->getOverallQuality()), 2);
            foreach($this->_biome->_pollinisators as $pollinator){ //25% de la pop ne sera pas attiré par les fleurs
                if($pollinator->getTemperatureTolerance()-15 < $this->_biome->getTemperature()){
                    $pollinatorPop =$pollinator->getPopulation();
                    $pollinatorPopSucrose = intdiv($pollinator->getSucroseAttraction()*$pollinatorPop, 100);
                    $pollinatorPopGlucose = intdiv($pollinator->getGlucoseAttraction()*$pollinatorPop, 100);
                    $pollinatorPopFructose = intdiv($pollinator->getFructoseAttraction()*$pollinatorPop, 100);
                    $fleursPotentiellementPollinisee = 0;
                    $fleursPotentiellementPollinisee += intdiv($popFleurAPolliniser*100, $pollinatorPopSucrose);
                    $fleursPotentiellementPollinisee += intdiv($popFleurAPolliniser*100, $pollinatorPopGlucose);
                    $fleursPotentiellementPollinisee += intdiv($popFleurAPolliniser*100, $pollinatorPopFructose);
                    $fleursPollinisee += intdiv($pollinator->getEfficiency()*$fleursPotentiellementPollinisee, 100);
                }
            }
            if($fleursPollinisee > $flower->getPopulation()){
                $fleursPollinisee = $flower->getPopulation();
            }
            $flower->setSeeds($flower->getSeeds()+$fleursPollinisee*2);


        }

        /**
         * @param $flower Flower
         */
        public function grainesGermes($flower){
            if($this->_biome->getTemperature() > $flower->getIdealTemperature()-$flower->getTemperatureAmplitude()){
                $flower->setPopulation($flower->getPopulation() + intdiv(50*$flower->getSeeds(), 100));
                $flower->setSeeds($flower->getSeeds()-intdiv(75*$flower->getSeeds(), 100));
            }
        }

        /**
         * @param $flower Flower
         */
        public function mortaliteFleur($flower){
            $flowerKilledByAnimal = intdiv($flower->getPopulation()*intdiv($this->_biome->getAnimalDensity(), 4), 100) ;
            $flowerKilledByInsect = intdiv($flower->getPopulation()*intdiv($this->_biome->getInsectDensity(), 2), 100) ;

            if($flower->getPopulation()-($flowerKilledByAnimal+$flowerKilledByInsect) >0){
                $flower->setPopulation($flower->getPopulation()- ($flowerKilledByAnimal+$flowerKilledByInsect));
            }
            else{
                $flower ->setPopulation(0);
            }
        }

        public function mortalitePollinisateur(){
            foreach($this->_biome->_pollinisators as $pollinator){
                $pollinator->setPopulation($pollinator->getPopulation()
                    - intdiv($pollinator->getPopulation()*intdiv($this->_biome->getInsectDensity(), 4), 100)) ;
            }
        }

        public function reproductionPollinisateur(){
            foreach($this->_biome->_pollinisators as $pollinator){
                $pollinator->setPopulation($pollinator->getPopulation()
                    +intdiv($pollinator->getPopulation()*50, 100)) ;
            }
        }

        public function sendInfoToCreator(){
            $array = [
                'nbTurns' => $this->_maxTurns,
                'turn' => $this->_turnsCounter,
                'pname' => $this->_creator->getName(),
                'pupgradePoints' => $this->_creator->getUpgradePoints(),
                'fnameFlower' => $this->_creator->_flower->getNameFlower(),
                'fpopulation' => $this->_creator->_flower->getPopulation(),
                'fseeds' => $this->_creator->_flower->getSeeds(),
		        'fidealTemperature' => $this->_creator->_flower->getIdealTemperature(),
		        'ftemperatureAmplitude' => $this->_creator->_flower->getTemperatureAmplitude(),
                'nquality' => $this->_creator->_flower->_nectar->getOverallQuality(),
                'nfructoseProp' => $this->_creator->_flower->_nectar->getFructose(),
                'nsucroseProp' => $this->_creator->_flower->_nectar->getSucrose(),
                'nglucoseProp' => $this->_creator->_flower->_nectar->getGlucose(),
                'bnameBiome' => $this->_biome->_nameBiome,
                'snameSeason' => $this->_biome->_currentSeason->getSeason(),
                'mnameMonth' => $this->_biome->_currentSeason->getCurrentMonth()->getMonthName(),
            ];

            if($this->_currentEvent != null){
                $array['currentEvent'] = utf8_encode($this->_currentEvent->getName());
            }

            if($this->_player != null){
                $array['opponentPopulation'] = $this->_player->_flower->getPopulation();
            }
            else if($this->_ai != null){
                $array['opponentPopulation'] = $this->_ai->_flower->getPopulation();
            }

		    return $array;
        }

        public function sendInfoToPlayer(){
            $array = [
                'nbTurns' => $this->_maxTurns,
                'turn' => $this->_turnsCounter,
                'pname' => $this->_player->getName(),
                'pupgradePoints' => $this->_player->getUpgradePoints(),
                'fnameFlower' => $this->_player->_flower->getNameFlower(),
                'fpopulation' => $this->_player->_flower->getPopulation(),
                'fseeds' => $this->_player->_flower->getSeeds(),
                'fidealTemperature' => $this->_player->_flower->getIdealTemperature(),
                'nquality' => $this->_player->_flower->_nectar->getOverallQuality(),
                'ftemperatureAmplitude' => $this->_player->_flower->getTemperatureAmplitude(),
                'nfructoseProp' => $this->_player->_flower->_nectar->getFructose(),
                'nsucroseProp' => $this->_player->_flower->_nectar->getSucrose(),
                'nglucoseProp' => $this->_player->_flower->_nectar->getGlucose(),
                'bnameBiome' => $this->_biome->_nameBiome,
                'snameSeason' => $this->_biome->_currentSeason->getSeason(),
                'mnameMonth' => $this->_biome->_currentSeason->getCurrentMonth()->getMonthName(),
            ];

            if($this->_currentEvent != null){
                $array['currentEvent'] = utf8_encode($this->_currentEvent->getName());
            }

            if($this->_creator != null){
                $array['opponentPopulation'] = $this->_creator->_flower->getPopulation();
            }

            return $array;
        }

        public function sendAiInfo(){
            $array = [
                'pname' => $this->_ai->getName(),
                'pupgradePoints' => $this->_ai->getUpgradePoints(),
                'fnameFlower' => $this->_ai->_flower->getNameFlower(),
                'fpopulation' => $this->_ai->_flower->getPopulation(),
                'fseeds' => $this->_ai->_flower->getSeeds(),
                'fidealTemperature' => $this->_ai->_flower->getIdealTemperature(),
                'ftemperatureAmplitude' => $this->_ai->_flower->getTemperatureAmplitude(),
                'nfructoseProp' => $this->_ai->_flower->_nectar->getFructose(),
                'nsucroseProp' => $this->_ai->_flower->_nectar->getSucrose(),
                'nglucoseProp' => $this->_ai->_flower->_nectar->getGlucose(),
                'bnameBiome' => $this->_biome->_nameBiome,
                'snameSeason' => $this->_biome->_currentSeason->getSeason(),
                'mnameMonth' => $this->_biome->_currentSeason->getCurrentMonth()->getMonthName(),
            ];

            if($this->_currentEvent != null){
                $array['currentEvent'] = utf8_encode($this->_currentEvent->getName());
            }

            if($this->_ai != null){
                $array['opponentPopulation'] = $this->_ai->_flower->getPopulation();
            }

            return $array;
        }

        public function joinGame($playerId, $flowerId){
            if($this->_isPVP){
                $this->_player = Player::createPlayerDebug($playerId, $flowerId);
                $this->_gameFull = true;
            }
        }

		private function biomeLoader($biomeID) {
			if($biomeID == 0){
			    return Biome::createBiomeDebug(0);
            }
		    //return new Biome($biomeID);
		}

		public function getId(){
            return $this->_engineID;
        }

        public function getMaxTurns(){
            return $this->_maxTurns;
        }

        public function getTurn(){
            return $this->_turnsCounter;
        }

		public function closeEngine(){
            if($this->isPVP()){
                $this->_biome->closeBiome();
                $this->_creator->closePlayer();
                if($this->_player != null){
                    $this->_player->closePlayer();

                }
            }
            else{
                $this->_biome->closeBiome();
                $this->_creator->closePlayer();
                $this->_ai->closeAi();
            }

        }

        public function isGameFull(){
            return $this->_gameFull;
        }

        public function isPVP(){
            return $this->_isPVP;
        }
		
	}