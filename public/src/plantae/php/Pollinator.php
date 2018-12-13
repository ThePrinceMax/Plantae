<?php
    namespace Game;
	//use PDO;

	class pollinator 
	{
		/*
		Attributs de la classe pollinator : id, nom, efficacité, population et différentes attractions
		*/
		private $_namePollinator ;
		private $_idPollinator ;
		private $_efficiency ;
		private $_population ;
		private $_temperatureTolerance;
		private $_fructoseAttraction ;
		private $_glucoseAttraction ; 
		private $_sucroseAttraction ;


		/// Constructeur de la classe pollinator
		public function __construct($namePollinator , $idPollinator , $efficiency , $population ,$temperatureTolerance,$fructoseAttraction , $glucoseAttraction , $sucroseAttraction)
		{
            $this->_namePollinator = $namePollinator;
            $this->_idPollinator = $idPollinator;
            $this->_efficiency = $efficiency;
            $this->_population = $population;
            $this->_temperatureTolerance = $temperatureTolerance;
            $this->_fructoseAttraction = $fructoseAttraction;
            $this->_glucoseAttraction = $glucoseAttraction;
            $this->_sucroseAttraction = $sucroseAttraction;
		}

		/*public function createPollinatorFromBDD($idPollinator, $bdd){
            echo "Pollinisateur";
            $namePollinator = "";
            $efficiency = 0;
            $population = 0;
            $phytochemicalAttraction = 0;
            $fructoseAttraction = 0;
            $glucoseAttraction = 0;
            $sucroseAttraction = 0;

            try
            {
                $requete = $bdd->query("SELECT nom_pollinator, population_pol, efficiency, phytochemicalAttraction, 
					fructoseAttraction, glucoseAttraction, sucroseAttraction " .
                    "FROM Pollinator " .
                    "WHERE id_pollinator = :idPollinator");

                $result = $requete->fetch();

                $namePollinator = $result[0];
                $population = $result[1];
                $efficiency = $result[2];
                $phytochemicalAttraction = $result[3];
                $fructoseAttraction = $result[4];
                $glucoseAttraction = $result[5];
                $sucroseAttraction = $result[6];
            }
            catch(Exception $e)
            {
                echo "Erreur : " . $e->getMessage();
            }

            return new Pollinator($namePollinator , $idPollinator , $efficiency , $population , $phytochemicalAttraction , $fructoseAttraction , $glucoseAttraction , $sucroseAttraction);
        }*/

		/// Crée un pollinisateur avec des valeurs arbitraires (sans base de données)
        public static function createPollinatorDebug($idPollinator){
            $namePollinator = "";
            $efficiency = 0;
            $population = 0;
            $temperatureTolerance = 0;
            $fructoseAttraction = 0;
            $glucoseAttraction = 0;
            $sucroseAttraction = 0;

            switch($idPollinator){
                case 0:
                    $namePollinator = "Abeilles";
                    $efficiency = 100;
                    $population = 1000;
                    $temperatureTolerance = 20;
                    $fructoseAttraction = 70;
                    $glucoseAttraction = 15;
                    $sucroseAttraction = 15;
            }

            return new Pollinator($namePollinator , $idPollinator , $efficiency , $population ,$temperatureTolerance, $fructoseAttraction , $glucoseAttraction , $sucroseAttraction);

        }

		/// Getter et setter pour l'id
		public function getIdPollinator()
		{
			return $this->_idPollinator;
		}

		public function setIdPollinator($idPollinator)
		{
			if (is_int($idPollinator))
			{
				$this->_idPollinator = $idPollinator;
			}
		}

		/// Getter et setter pour le nom
		public function getNamePollinator()
		{
			return $this->_namePollinator;
		}

		public function setNamePollinator($namePollinator)
		{
			if (is_string($namePollinator))
			{
				$this->_namePollinator = $namePollinator;
			}
		} 

		/// Getter et setter pour l'efficacité
		public function getEfficiency()
		{
			return $this->_efficiency;
		}

		public function setEfficiency($efficiency)
		{
			if (is_int($efficiency))
			{
				$this->_efficiency = $efficiency;
			}
		}

		public function getTemperatureTolerance(){
            return $this->_temperatureTolerance;
        }

		/// Getter et setter pour la population
		public function getPopulation()
		{
			return $this->_population;
		}

		public function setPopulation($population)
		{
			if (is_int($population))
			{
				$this->_population = $population;
			}
		}

		/// Getter et setter pour l'attraction niveau fructose
		public function getFructoseAttraction()
		{
			return $this->_fructoseAttraction;
		}

		public function setFructoseAttraction($fructoseAt)
		{
			if (is_int($fructoseAt))
			{
				$this->_fructoseAttraction = $fructoseAt;
			}
		}

		/// Getter et setter pour l'attraction niveau glucose
		public function getGlucoseAttraction()
		{
			return $this->_glucoseAttraction;
		}

		public function setGlucoseAttraction($glucoseAt)
		{
			if (is_int($glucoseAt))
			{
				$this->_glucoseAttraction = $glucoseAt;
			}
		}

		/// Getter et setter pour l'attraction niveau sucrose
		public function getSucroseAttraction()
		{
			return $this->_sucroseAttraction;
		}

		public function setSucroseAttraction($sucroseAt)
		{
			if (is_int($sucroseAt))
			{
				$this->_sucroseAttraction = $sucroseAt;
			}
		}

	} 
?>