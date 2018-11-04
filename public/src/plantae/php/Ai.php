<?php

namespace Game;

class Ai
{
    // Attributs de la classe joueur

    public $_flower;
    private $_name;
    private $_id;
    private $_upgradePoints;

    public function __construct($id, $name, $flowerId)
    {
        $this->_name = $name;
        $this->_id = $id;
        $this->_flower = Flower::createFlowerDebug($flowerId);
        $this->_upgradePoints = 3;

    }

    public function addPoints($nbPoints){
        $this->_upgradePoints += $nbPoints;
    }

    public function randomAttribute(){
        while($this->_upgradePoints > 0){
            $this->attributePointToOverallQuality();
            /*
            $field = mt_rand(0,4);
            switch (($field)){
                case 0:
                    $this->attributePointToOverallQuality();
                    break;
                case 1:
                    $this->attributePointToFructose();
                    break;
                case 2:
                    $this->attributePointToGlucose();
                    break;
                case 3:
                    $this->attributePointToSucrose();
                    break;
                case 4:
                    $this->attributePointToTemperatureAmplitude();
                    break;
            }*/
        }
        echo ("AI UPGRADED FIELDS");
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


    public static function createAiDebug($id, $flowerId){
        return new Ai($id, 'Ai'.$id, $flowerId);
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

    public function closeAi(){
        $this->_flower->closeNectar();
        unset($this->_flower);
    }





}