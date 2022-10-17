<?php

namespace Tests\Stubs\Bo;

use \Tests\Stubs\Models\Bo\OwnerProfile as OwnerProfileStub;

/**
 * Class OwnerProfile
 *
 * @package Tests\Stubs\Bo
 */
class OwnerProfile extends \Bo\Profile\Owner
{

    /**
     * @return OwnerProfileStub\RaceInstance
     */
    protected function getModelRaceInstance()
    {
        return new OwnerProfileStub\RaceInstance();
    }

    /**
     * @return OwnerProfileStub\Statistics
     */
    protected function getModelStatistics()
    {
        return new OwnerProfileStub\Statistics();
    }

    /**
     * @return OwnerProfileStub\Owner
     */
    protected function getModelOwner()
    {
        return new OwnerProfileStub\Owner();
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
     * @return array
     */
    public function getSeasonDefaultValues()
    {

        $data = [
            'raceType' => 'flat',
            'countryCode' => 'GB',
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
