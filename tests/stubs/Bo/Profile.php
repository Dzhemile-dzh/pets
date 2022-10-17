<?php

namespace Tests\Stubs\Bo;

class Profile extends \Bo\Profile
{

    /**
     * @return array
     */
    public function getSeasonInfo()
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

    public function getDataProviderDefaultInfo()
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
