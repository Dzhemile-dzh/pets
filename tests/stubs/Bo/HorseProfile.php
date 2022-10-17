<?php

namespace Tests\Stubs\Bo;

/**
 * Class HorseProfile
 *
 * @package Tests\Stubs\Bo
 */
class HorseProfile extends \Bo\Profile\Horse
{
    /**
     * @return \Tests\Stubs\Models\Bo\HorseProfile\RaceInstance
     */
    protected function getModelRaceInstance()
    {
        return new \Tests\Stubs\Models\Bo\HorseProfile\RaceInstance();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\HorseProfile\Horse
     */
    protected function getModelHorse()
    {
        return new \Tests\Stubs\Models\Bo\HorseProfile\Horse();
    }

    /**
     * @return \Tests\Stubs\Models\PostdataResultsNew
     */
    protected function getModelPostdataResultsNew()
    {
        return new \Tests\Stubs\Models\PostdataResultsNew();
    }

    /**
     * @return  \Tests\Stubs\Models\Bo\HorseProfile\HorseRace
     */
    protected function getModelHorseRace()
    {
        return new \Tests\Stubs\Models\Bo\HorseProfile\HorseRace();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\HorseProfile\PreHorseRace
     */
    protected function getModelPreHorseRace()
    {
        return new \Tests\Stubs\Models\Bo\HorseProfile\PreHorseRace();
    }

    /**
     * @return \Tests\Stubs\Models\Season
     */
    public function getModelSeason()
    {
        return new \Tests\Stubs\Models\Season();
    }

    /**
     * @param array $raceIDs
     *
     * @return VideoProviders
     */
    protected function getVideoProviders($raceIDs)
    {
        return new \Tests\Stubs\Bo\VideoProviders($raceIDs);
    }
}
