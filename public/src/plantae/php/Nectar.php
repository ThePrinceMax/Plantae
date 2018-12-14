<?php
    namespace Game;
	class Nectar 
	{
		/*
		* Attributs de la classe Nectar : id, nom, quantité totale, proportion de fructose, sucrose, glucose, phytochimie
		*/
		private $_idNectar;
		private $_nameNectar;
		private $_overallQuality;
		private $_fructoseProp;
		private $_sucroseProp;
		private $_glucoseProp;

		//Constructeur de la classe Nectar
		private function __construct($id, $name, $quality, $fructoseProp, $sucroseProp, $glucoseProp)
		{
			$propCose = $fructoseProp + $glucoseProp + $sucroseProp;
			if ($propCose == 100)
			{
				$this->_idNectar = $id;
				$this->_nameNectar = $name;
				$this->_overallQuality = $quality;
				$this->_fructoseProp = $fructoseProp;
				$this->_sucroseProp = $sucroseProp;
				$this->_glucoseProp = $glucoseProp;
				echo "Nectar created";
			}
			else {
				echo "Proportion de fructose/glucose/sucrose ou de protecPhytochemicalProp/attractivePhytoProp incorrecte : somme doit être egale à 100";
			}
		}

		public static function createNectarFromBdd($idNectar){

		    $result = GameBddRequests::getInstance()->getNectar($idNectar);

            $nameNectar = $result['nameNectar'];
            $overallQuality = $result['overallQuality'];
            $fructoseProp = $result['fructoseProp'];
            $sucroseProp = $result['sucroseProp'];
            $glucoseProp = $result['glucoseProp'];
            return new Nectar($idNectar, $nameNectar, $overallQuality, $fructoseProp, $sucroseProp, $glucoseProp);
        }

		/// Crée un nectar avec des valeurs arbitraires (pas de base de données)
		public static function createNectarDebug($idNectar){
            $nameNectar = "";
            $overallQuality = 0;
            $fructoseProp = 0;
            $sucroseProp = 0;
            $glucoseProp = 0;

		    switch($idNectar){
                case(0):
                    $idNectar = 0;
                    $nameNectar = "Nectar de tulipe";
                    $overallQuality = 25;
                    $fructoseProp = 33;
                    $sucroseProp = 33;
                    $glucoseProp = 34;
            }
            return new Nectar($idNectar, $nameNectar, $overallQuality, $fructoseProp, $sucroseProp, $glucoseProp);
        }

		/// Fonction retournant le nombre en format pourcentage
		public function percent($number)
		{
    		return $number * 100 ;
		}

		/// Getter et setter pour l'id
		public function getIdNectar()
		{
			return $this->_idNectar;
		}

		public function setIdNectar($id)
		{
			if (is_int($id))
			{
				$this->_idNectar = $id;
			}
		}

		/// Getter et setter pour le nom
		public function getNameNectar()
		{
			return $this->_nameNectar;
		}

		public function setNameNectar($name)
		{
			if (is_string($name))
			{
				$this->_nameNectar = $name;
			}
		}

		/// Getter et setter pour la qualité
		public function getOverallQuality()
		{
			return $this->_overallQuality;
		}

		/// Getter pour la proportion de fructose
		public function getFructose()
		{
			return $this->_fructoseProp;
		}

		/// Getter pour la proportion de glucose
		public function getGlucose()
		{
			return $this->_glucoseProp;
		}

		/// Getter pour la proportion de sucrose
		public function getSucrose()
		{
			return $this->_sucroseProp;
		}

		/// Augmente proportion de fructose
		public function increaseFructose()
		{
			$this->_fructoseProp += 2;
			$this->_glucoseProp-- ;
			$this->_sucroseProp-- ;
		}

		/// Augmente proportion de glucose
		public function increaseGlucose()
		{
			$this->_glucoseProp +=2;
			$this->_fructoseProp-- ;
			$this->_sucroseProp-- ;
		}

		/// Augmente proportion de sucrose
		public function increaseSucrose()
		{
			$this->_sucroseProp += 2;
			$this->_fructoseProp--;
			$this->_glucoseProp--;
		}

		/// Augmente la qualité
		public function increaseOverallQuality()
		{
			$this->_overallQuality++;
		}

		/// Diminue proportion de fructose
		public function decreaseFructose()
		{
			$this->_fructoseProp -= 2;
			$this->_glucoseProp++ ;
			$this->_sucroseProp++ ;
		}

		/// Diminue proportion de glucose
		public function decreaseGlucose()
		{
			$this->_glucoseProp -=2;
			$this->_fructoseProp++ ;
			$this->_sucroseProp++ ;
		}

		/// Diminue proportion de sucrose
		public function decreaseSucrose()
		{
			$this->_sucroseProp -= 2;
			$this->_fructoseProp++;
			$this->_glucoseProp++;
		}

		/// Diminue la qualité
		public function decreaseOverallQuality()
		{
			$this->_overallQuality--;
		}
	}