<?php
	//use PDO;
    namespace Game;
    use Game\Flower;

	class Player
	{
		// Attributs de la classe joueur

        /**
         * @var Flower
         */
		public $_flower;
		private $_name;
		private $_id;
        private $_upgradePoints;
        private $_readyForNextTurn;


		public function __construct($id, $name, $flowerId)
        {
            $this->_name = $name;
            $this->_id = $id;
            //$this->_flower = Flower::createFlowerDebug($flowerId);
            $this->_flower = Flower::createFlowerFromBDD($flowerId);
            $this->_upgradePoints = 3;

        }

        public function ready(){
		    $this->_readyForNextTurn = true;
        }

        public function notReady(){
		    $this->_readyForNextTurn = false;
        }

        public function isReady(){
		    return $this->_readyForNextTurn;
        }

        public function addPoints($nbPoints){
		    $this->_upgradePoints += $nbPoints;
        }

        public function attributePointToOverallQuality(){
		    $this->_flower->_nectar->increaseOverallQuality();
		    $this->_upgradePoints--;
        }

        public function attributePointToGlucose(){
            $this->_flower->_nectar->increaseGlucose();
            $this->_upgradePoints--;
        }

        public function attributePointToFructose(){
            $this->_flower->_nectar->increaseFructose();
            $this->_upgradePoints--;
        }

        public function attributePointToSucrose(){
            $this->_flower->_nectar->increaseSucrose();
            $this->_upgradePoints--;
        }

        public function attributePointToTemperatureAmplitude(){
            $this->_flower->increaseTemperatureAmplitude(1);
            $this->_upgradePoints--;
        }


        public static function createPlayerDebug($id, $flowerId){
		  return new Player($id, 'Player'.$id, $flowerId);
        }

        public function getName(){
		    return $this->_name;
        }

        public function getUpgradePoints(){
		    return $this->_upgradePoints;
        }

        public function getId(){
		    return $this->_id;
        }

        public function closePlayer(){
		    $this->_flower->closeNectar();
		    unset($this->_flower);
        }


    }