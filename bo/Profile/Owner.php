<?php

namespace Bo\Profile;

use Bo\Profile;
use Api\Input\Request\Parameter\Calculate;

class Owner extends Profile
{
    /**
     * @var bool
     */
    private static $isLifeTimeData = false;

    /**
     * @param boolean $flag
     */
    public static function isLifeTimeData($flag)
    {
        self::$isLifeTimeData = (bool)$flag;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Selectors
     */
    protected function getModelSelectors()
    {
        return $this->getModelSelectorsForMan();
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getStatistics()
    {
        $selectors = $this->getModelSelectors();
        return $this->getModelStatistics()->getStatistics(
            $this->request,
            $selectors
        );
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\OwnerProfile\Statistics
     */
    protected function getModelStatistics()
    {
        return new \Models\Bo\OwnerProfile\Statistics();
    }

    /**
     * @return array
     */
    public function getEntries()
    {
        return $this->getModelRaceInstance()->getEntries(
            $this->request->getOwnerId()
        );
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\OwnerProfile\RaceInstance
     */
    protected function getModelRaceInstance()
    {
        return new \Models\Bo\OwnerProfile\RaceInstance();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\OwnerProfile\Owner
     */
    protected function getModelOwner()
    {
        return new \Models\Bo\OwnerProfile\Owner();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Api\DataProvider\Bo\Profile\DefaultInfo
     */
    public function getDataProviderDefaultInfo()
    {
        if (self::$isLifeTimeData) {
            return new \Api\DataProvider\Bo\Profile\Owner\StatisticalSummary\DefaultInfo();
        } else {
            return new \Api\DataProvider\Bo\Profile\Owner\DefaultInfo();
        }
    }

    /**
     * @return array
     */
    public function getBigRaceWins()
    {
        $races = $this->getModelRaceInstance()->getBigRaceWins($this->request->getOwnerId());

        if (is_null($races)) {
            return null;
        }
        $this->addVideoDetails($races);

        return array_values($races);
    }

    /**
     *
     * @return array
     */
    public function getLast14Days()
    {
        $races = $this->getModelRaceInstance()->getLast14Days($this->request->getOwnerId());

        if (is_null($races)) {
            return null;
        }

        $raceIds = array_map(
            function ($race) {
                return $race->race_instance_uid;
            },
            $races
        );

        return array_values(
            $this->combineRacesWithVideoDetails($races, $this->fetchVideoProvidersByRaceIds($raceIds))
        );
    }

    /**
     * @return array|null
     */
    public function getLast14DaysForm()
    {
        $owner = $this->getModelOwner()->getOwner($this->request);
        if (!empty($owner)) {
            return $this->getModelHorseRace()->getStatsLast14Days(
                $this->request->getOwnerId(),
                'owner'
            );
        } else {
            return null;
        }
    }

    /**
     *
     * @return object
     */
    public function getSinceAWin()
    {
        return (Object)$this->getModelRaceInstance()->getSinceAWin(
            $this->request->getOwnerId()
        );
    }

    /**
     *
     * @throws \Exception
     */
    public function getStatisticalSummary()
    {
        return $this->getModelRaceInstance()->getStatisticalSummary($this->request);
    }

    /**
     *
     * @return \stdClass
     * @throws \Exception
     */
    public function getHorses()
    {
        $bo = $this->getModelRaceInstance();
        $horses = null;
        try {
            $horses = $bo->getHorses($this->request);
            $season = (Object)[
                'seasonYearBegin' => $this->request->getSeasonYearBegin(),
                'raceType' => $this->request->getRaceType(),
                'countryCode' => $this->request->getCountryCode(),
            ];
        } catch (\Api\Exception\NotFound $e) {
            $selectors = $this->getModelSelectors();
            $date = $selectors->getDb()->getCurrentSeasonDateBegin(Calculate\RaceType::DEFAULT_RACE_TYPE_CODE);

            $season = (Object)[
                'seasonYearBegin' => (int)(new \DateTime($date))->format('Y'),
                'raceType' => $selectors->getRaceTypeByRaceTypeCode(Calculate\RaceType::DEFAULT_RACE_TYPE_CODE),
                'countryCode' => Calculate\CountryCode::DEFAULT_COUNTRY_CODE,
            ];
        }
        return (Object)[
            'horses' => $horses,
            'season_info' => $season
        ];
    }

    /**
     *
     * @return array
     * @throws \Exception
     */
    public function getOwner()
    {
        $owner = $this->getModelOwner()->getOwner($this->request);
        if (!empty($owner)) {
            $owner->owner_last_14_days = $this->getModelHorseRace()
                ->getOwnerStatsLast14Days($this->request->getOwnerId());
            if (empty($owner->owner_last_14_days) || $owner->owner_last_14_days->runs == 0) {
                $owner->owner_last_14_days = null;
            }
            $owner->since_a_win = $this->getSinceAWin();
        }
        return $owner;
    }

    /**
     * @return array|null
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getResults()
    {
        $races = $this->getModelRaceInstance()->getResults($this->request);

        if (is_null($races)) {
            return null;
        }
        $this->addVideoDetails($races);

        return $races;
    }
}
