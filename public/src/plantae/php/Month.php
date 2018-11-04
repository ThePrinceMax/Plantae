<?php
/**
 * Created by PhpStorm.
 * User: loicl
 * Date: 01/11/2018
 * Time: 12:02
 */
    namespace Game;

    class Month{

        private $_idMonth;
        private $_nameMonth;


        public function __construct($idMonth, $monthName)
        {
            $this->_idMonth = $idMonth;
            $this->_nameMonth = $monthName;
        }

        /*public function createMonthFromBDD($idMonth, $bdd){
        }*/

        public static function createMonthDebug($idMonth){
            $monthName = "";
            switch($idMonth){
                case 0:
                    $monthName = "Janvier";
                    break;
                case 1:
                    $monthName = "Fevrier";
                    break;
                case 2:
                    $monthName = "Mars";
                    break;
                case 3:
                    $monthName = "Avril";
                    break;
                case 4:
                    $monthName = "Mai";
                    break;
                case 5:
                    $monthName = "Juin";
                    break;
                case 6:
                    $monthName = "Juillet";
                    break;
                case 7:
                    $monthName = "Aout";
                    break;
                case 8:
                    $monthName = "Septembre";
                    break;
                case 9:
                    $monthName = "Octobre";
                    break;
                case 10:
                    $monthName = "Novembre";
                    break;
                case 11:
                    $monthName = "Decembre";
                    break;
            }
            return new Month($idMonth, $monthName);
        }

        public function getMonthId(){
            return $this->_idMonth;

        }

        public function getMonthName(){
            return $this->_nameMonth;
        }

    }