<?php

namespace Tests\Stubs\Bo;

class JockeyProfile extends \Bo\Profile\Jockey
{
    /**
     * @return \Tests\Stubs\Models\Bo\JockeyProfile\RaceInstance
     */
    protected function getModelRaceInstance()
    {
        return new \Tests\Stubs\Models\Bo\JockeyProfile\RaceInstance();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\JockeyProfile\Statistics
     */

    protected function getModelStatistics()
    {
        return new \Tests\Stubs\Models\Bo\JockeyProfile\Statistics();
    }


    /**
     * @return \Tests\Stubs\Models\Bo\JockeyProfile\Jockey
     */
    protected function getModelJockey()
    {
        return new \Tests\Stubs\Models\Bo\JockeyProfile\Jockey();
    }
    /**
     * @return \Models\Season
     *
     * @codeCoverageIgnore
     */
    public function getModelSeason()
    {
        return new \Tests\Stubs\Models\Season;
    }

    /**
     * @return \Tests\Stubs\Models\HorseRace
     */
    protected function getModelHorseRace()
    {
        return new \Tests\Stubs\Models\HorseRace();
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
