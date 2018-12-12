<?php

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




}