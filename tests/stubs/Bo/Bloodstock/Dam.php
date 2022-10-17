<?php

namespace Tests\Stubs\Bo\Bloodstock;

class Dam extends \Bo\Bloodstock\Dam
{
    /**
     * @return \Tests\Stubs\Models\Bo\Bloodstock\Dam\RaceInstance
     */
    protected function getModelRaceInstance()
    {
        return new \Tests\Stubs\Models\Bo\Bloodstock\Dam\RaceInstance();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\Bloodstock\Dam\Horse
     */
    protected function getModelHorse()
    {
        return new \Tests\Stubs\Models\Bo\Bloodstock\Dam\Horse();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\Bloodstock\Dam\HorseRace
     */
    protected function getHorseRace()
    {
        return new \Tests\Stubs\Models\Bo\Bloodstock\Dam\HorseRace();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\Bloodstock\Dam\BloodstockSale
     */
    protected function getModelBloodstockSale()
    {
        return new \Tests\Stubs\Models\Bo\Bloodstock\Dam\BloodstockSale();
    }

    /**
     * @return \Tests\Stubs\DataProvider\Bo\Bloodstock\Dam\ProgenyResultsSeasons
     */
    public function getProgenyResultsSeasonsDataProvider()
    {
        return new \Tests\Stubs\DataProvider\Bo\Bloodstock\Dam\ProgenyResultsSeasons();
    }
}
