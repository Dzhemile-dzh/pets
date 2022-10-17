<?php

namespace Tests\Stubs\Bo;

class TrainerProfile extends \Bo\Profile\Trainer
{

    /**
     * @return \Tests\Stubs\Models\Bo\TrainerProfile\RaceInstance
     */
    protected function getModelRaceInstance()
    {
        return new \Tests\Stubs\Models\Bo\TrainerProfile\RaceInstance();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\TrainerProfile\Statistics
     */

    protected function getModelStatistics()
    {
        return new \Tests\Stubs\Models\Bo\TrainerProfile\Statistics();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\TrainerProfile\Trainer
     */
    protected function getModelTrainer()
    {
        return new \Tests\Stubs\Models\Bo\TrainerProfile\Trainer();
    }

    /**
     * @return \Tests\Stubs\Models\HorseRace
     */
    protected function getModelHorseRace()
    {
        return new \Tests\Stubs\Models\Bo\TrainerProfile\HorseRace();
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
     * @return array
     */
    public function getSeasonDefaultValues()
    {

        $data = [
            'seasonYearBegin' => 2015,
            'seasonYearEnd' => 2015,
            'raceType' => 'flat',
            'countryCode' => 'GB',
            'statisticsType' => 'course'
        ];

        return $data;
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
