<?php
namespace Bo\Profile;

use Bo\Profile;
use Models\Bo\Selectors\Profile\Distance;

/**
 * Class Jockey Profile
 *
 * @package Bo\Profile
 */
class Jockey extends Profile
{
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
     * @throws \Api\Exception\InternalServerError
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
     * @return \Models\Bo\JockeyProfile\RaceInstance
     */
    protected function getModelRaceInstance()
    {
        return new \Models\Bo\JockeyProfile\RaceInstance();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\JockeyProfile\Statistics
     */
    protected function getModelStatistics()
    {
        return new \Models\Bo\JockeyProfile\Statistics();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\JockeyProfile\Jockey
     */
    protected function getModelJockey()
    {
        return new \Models\Bo\JockeyProfile\Jockey();
    }

    /**
     * @return array|null
     */
    public function getLast14Days()
    {
        $races = $this->getModelRaceInstance()->getLast14Days($this->request->getJockeyId());

        if (is_null($races)) {
            return null;
        }
        $this->addVideoDetails($races);

        return array_values($races);
    }

    /**
     * @return array
     */
    public function getSinceAWin()
    {
        return (Object) $this->getModelRaceInstance()->getSinceAWin($this->request->getJockeyId());
    }

    /**
     *
     * @return array
     * @throws \Exception
     */
    public function getHorses()
    {
        return $this->getModelRaceInstance()->getHorses($this->request);
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Api\DataProvider\Bo\Profile\Jockey\DefaultInfo
     */
    public function getDataProviderDefaultInfo()
    {
        return new \Api\DataProvider\Bo\Profile\Jockey\DefaultInfo();
    }

    /**
     *
     * @return array
     * @throws \Exception
     */
    public function getStatisticalSummary()
    {
        return $this->getModelRaceInstance()->getStatisticalSummary($this->request);
    }

    /**
     * @return array
     */
    public function getBookedRides()
    {
        return $this->getModelRaceInstance()->getBookedRides($this->request->getJockeyId());
    }

    /**
     * @return array|null
     */
    public function getBigRaceWins()
    {
        $races = $this->getModelRaceInstance()->getBigRaceWins($this->request->getJockeyId());

        if (is_null($races)) {
            return null;
        }
        $this->addVideoDetails($races);

        return array_values($races);
    }

    /**
     * @return \Phalcon\Mvc\ModelInterface
     * @throws \Api\Exception\NotFound
     */
    public function getJockey()
    {
        $jockey = $this->getModelJockey()->getJockey($this->request);
        if (!empty($jockey)) {
            $jockey->jockey_last_14_days = $this->getModelHorseRace()->getJockeyStatsLast14Days(
                $this->request->getJockeyId()
            );
            if (empty($jockey->jockey_last_14_days) || $jockey->jockey_last_14_days->runs == 0) {
                $jockey->jockey_last_14_days = null;
            }

            $jockey->since_a_win = $this->getSinceAWin();
        } else {
            throw new \Api\Exception\NotFound(6108);
        }
        return $jockey;
    }
}
