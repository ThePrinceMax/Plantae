<?php

namespace Game;
	//use PDO;
class RandomEvent{

    private $_name;
    private $_id;

    private $_temperatureMinCond;
    private $_temperatureMaxCond;
    private $_humidityMinCond;
    private $_humidityMaxCond;
    private $_airPolutionMinCond;
    private $_airPolutionMaxCond;

    private $_ActivationProb;

    private $_airPolutionModifier;
    private $_animalDensityModifier;
    private $_humidityModifier;
    private $_insectDensityModifier;
    private $_precipitationAverageAmountModifier;
    private $_precipitationFrequencyModifier;
    private $_temperatureModifier;

    private $_flowerPopulationModifier;
    private $_flowerSeedsModifier;

    private $_pollinatorPopulationModifier;

    public function __construct($id, $name, $temperatureMinCond, $temperatureMaxCond, $humidityMinCond,
                                $humidityMaxCond, $airPolutionMinCond, $airPolutionMaxCond, $activationProb,
                                $airPolutionModifier, $animalDensityModifier, $humidityModifier, $insectDensityModifier,
                                $precipitationAverageAmountModifier, $precipitationFrequencyModifier, $temperatureModifier,
                                $flowerPopulationModifier, $flowerSeedsModifier, $pollinatorPopulationModifier)
    {
        $this->_name = $name;
        $this->_id = $id;

        $this->_temperatureMinCond = $temperatureMinCond;
        $this->_temperatureMaxCond = $temperatureMaxCond;
        $this->_humidityMinCond = $humidityMinCond;
        $this->_humidityMaxCond = $humidityMaxCond;
        $this->_airPolutionMinCond = $airPolutionMinCond;
        $this->_airPolutionMaxCond = $airPolutionMaxCond;

        $this->_ActivationProb = $activationProb;

        $this->_airPolutionModifier = $airPolutionModifier;
        $this->_animalDensityModifier = $animalDensityModifier;
        $this->_humidityModifier = $humidityModifier;
        $this->_insectDensityModifier = $insectDensityModifier;
        $this->_precipitationAverageAmountModifier = $precipitationAverageAmountModifier;
        $this->_precipitationFrequencyModifier = $precipitationFrequencyModifier;
        $this->_temperatureModifier = $temperatureModifier;

        $this->_flowerPopulationModifier = $flowerPopulationModifier;
        $this->_flowerSeedsModifier = $flowerSeedsModifier;

        $this->_pollinatorPopulationModifier = $pollinatorPopulationModifier;
    }

    /*
    public static function createBiomeFromBDD($idEvent){

        $result = GameBddRequests::getEvent($idEvent);

        $name = $result[0];
        $id =;

        $temperatureMinCond =;
        $temperatureMaxCond =;
        $humidityMinCond =;
        $humidityMaxCond =;
        $airPolutionMinCond =;
        $airPolutionMaxCond =;

        $activationProb =;

        $airPolutionModifier =;
        $animalDensityModifier =;
        $humidityModifier =;
        $insectDensityModifier =;
        $precipitationAverageAmountModifier =;
        $precipitationFrequencyModifier =;
        $temperatureModifier =;

        $flowerPopulationModifier =;
        $flowerSeedsModifier =;

        $pollinatorPopulationModifier =;

        return new RandomEvent($id, $name, $temperatureMinCond, $temperatureMaxCond, $humidityMinCond,
            $humidityMaxCond, $airPolutionMinCond, $airPolutionMaxCond, $activationProb,
            $airPolutionModifier, $animalDensityModifier, $humidityModifier, $insectDensityModifier,
            $precipitationAverageAmountModifier, $precipitationFrequencyModifier, $temperatureModifier,
            $flowerPopulationModifier, $flowerSeedsModifier, $pollinatorPopulationModifier);
    }
    */

    public static function createEventDebug($idEvent){
        $name = "";
        $id = 0;

        $temperatureMinCond = 0;
        $temperatureMaxCond = 0;
        $humidityMinCond = 0;
        $humidityMaxCond = 0;
        $airPolutionMinCond = 0;
        $airPolutionMaxCond = 0;

        $activationProb = 0;

        $airPolutionModifier = 0;
        $animalDensityModifier = 0;
        $humidityModifier = 0;
        $insectDensityModifier = 0;
        $precipitationAverageAmountModifier = 0;
        $precipitationFrequencyModifier = 0;
        $temperatureModifier = 0;

        $flowerPopulationModifier = 0;
        $flowerSeedsModifier = 0;

        $pollinatorPopulationModifier = 0;

        switch($idEvent){
            case 0:
                $name = "Pluie";
                $id = 0;
                $temperatureMinCond =1;
                $temperatureMaxCond =50;
                $humidityMinCond =30;
                $humidityMaxCond =70;
                $airPolutionMinCond =0;
                $airPolutionMaxCond =100;

                $activationProb =50;

                $airPolutionModifier =100;
                $animalDensityModifier =100;
                $humidityModifier =130;
                $insectDensityModifier =110;
                $precipitationAverageAmountModifier =130;
                $precipitationFrequencyModifier = 130;
                $temperatureModifier = 80;

                $flowerPopulationModifier =110;
                $flowerSeedsModifier =90;

                $pollinatorPopulationModifier = 100;
                break;

            case 1:
                $name = "Secheresse";
                $id = 1;
                $temperatureMinCond =25;
                $temperatureMaxCond =50;
                $humidityMinCond =20;
                $humidityMaxCond =50;
                $airPolutionMinCond =0;
                $airPolutionMaxCond =100;

                $activationProb =50;

                $airPolutionModifier =100;
                $animalDensityModifier =100;
                $humidityModifier =70;
                $insectDensityModifier =100;
                $precipitationAverageAmountModifier =60;
                $precipitationFrequencyModifier = 60;
                $temperatureModifier = 140;

                $flowerPopulationModifier =80;
                $flowerSeedsModifier =100;

                $pollinatorPopulationModifier = 100;
                break;
        }

        return new RandomEvent($id, $name, $temperatureMinCond, $temperatureMaxCond, $humidityMinCond,
            $humidityMaxCond, $airPolutionMinCond, $airPolutionMaxCond, $activationProb,
            $airPolutionModifier, $animalDensityModifier, $humidityModifier, $insectDensityModifier,
            $precipitationAverageAmountModifier, $precipitationFrequencyModifier, $temperatureModifier,
            $flowerPopulationModifier, $flowerSeedsModifier, $pollinatorPopulationModifier);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return mixed
     */
    public function getTemperatureMinCond()
    {
        return $this->_temperatureMinCond;
    }

    /**
     * @return mixed
     */
    public function getTemperatureMaxCond()
    {
        return $this->_temperatureMaxCond;
    }

    /**
     * @return mixed
     */
    public function getHumidityMinCond()
    {
        return $this->_humidityMinCond;
    }

    /**
     * @return mixed
     */
    public function getHumidityMaxCond()
    {
        return $this->_humidityMaxCond;
    }

    /**
     * @return mixed
     */
    public function getAirPolutionMinCond()
    {
        return $this->_airPolutionMinCond;
    }

    /**
     * @return mixed
     */
    public function getAirPolutionMaxCond()
    {
        return $this->_airPolutionMaxCond;
    }

    /**
     * @return mixed
     */
    public function getActivationProb()
    {
        return $this->_ActivationProb;
    }

    /**
     * @return mixed
     */
    public function getAirPolutionModifier()
    {
        return $this->_airPolutionModifier;
    }

    /**
     * @return mixed
     */
    public function getAnimalDensityModifier()
    {
        return $this->_animalDensityModifier;
    }

    /**
     * @return mixed
     */
    public function getHumidityModifier()
    {
        return $this->_humidityModifier;
    }

    /**
     * @return mixed
     */
    public function getInsectDensityModifier()
    {
        return $this->_insectDensityModifier;
    }

    /**
     * @return mixed
     */
    public function getPrecipitationAverageAmountModifier()
    {
        return $this->_precipitationAverageAmountModifier;
    }

    /**
     * @return mixed
     */
    public function getPrecipitationFrequencyModifier()
    {
        return $this->_precipitationFrequencyModifier;
    }

    /**
     * @return mixed
     */
    public function getTemperatureModifier()
    {
        return $this->_temperatureModifier;
    }

    /**
     * @return mixed
     */
    public function getFlowerPopulationModifier()
    {
        return $this->_flowerPopulationModifier;
    }

    /**
     * @return mixed
     */
    public function getFlowerSeedsModifier()
    {
        return $this->_flowerSeedsModifier;
    }

    /**
     * @return mixed
     */
    public function getPollinatorPopulationModifier()
    {
        return $this->_pollinatorPopulationModifier;
    }


}