<?php

namespace Bo\Bloodstock;

use Bo\Standart;
use Api\DataProvider\Bo\Bloodstock\Dam\ProgenyResultsSeasons;
use \Api\Constants\Horses as Constants;

/**
 * Class Dam
 * @package Bo\Bloodstock
 */
class Dam extends Standart
{
    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\Bloodstock\Dam\RaceInstance
     */
    protected function getModelRaceInstance()
    {
        return new \Models\Bo\Bloodstock\Dam\RaceInstance();
    }

    /**
     * @return array
     */
    public function getProgenyEntries()
    {
        return $this->getModelRaceInstance()->getProgenyEntries($this->request->getDamId());
    }

    /**
     * @return \Models\Bo\Bloodstock\Dam\Horse
     *
     * @codeCoverageIgnore
     */
    protected function getModelHorse()
    {
        return new \Models\Bo\Bloodstock\Dam\Horse();
    }

    /**
     * @return \Models\Bo\Bloodstock\Dam\HorseRace
     *
     * @codeCoverageIgnore
     */
    protected function getHorseRace()
    {
        return new \Models\Bo\Bloodstock\Dam\HorseRace();
    }

    /**
     * @return \Api\Row\Bloodstock\Dam\ProgenyResults[]
     */
    public function getProgenyResults()
    {
        return $this->getModelHorse()->getProgenyResults($this->request);
    }

    /**
     * @return \Api\Row\Bloodstock\Dam\ProgenyResults[]
     */
    public function getProgenyResultsSalesDefault()
    {
        $rows = $this->getModelHorse()->getProgenyResults($this->request);

        $flatKey = strtoupper(Constants::RACE_TYPE_FLAT_ALIAS);
        $jumpsKey = strtoupper(Constants::RACE_TYPE_JUMPS_ALIAS);

        $flatCount = empty($rows[$flatKey]) ? 0 : count($rows[$flatKey]);
        $jumpsCount = empty($rows[$jumpsKey]) ? 0 : count($rows[$jumpsKey]);

        if ($flatCount < 1 && $jumpsCount < 1) {
            $result = [];
        } else {
            $result = $flatCount >= $jumpsCount ? $rows[$flatKey] : $rows[$jumpsKey];
        }

        return $result;
    }

    /**
     * @return \Models\Bo\Bloodstock\Dam\BloodstockSale
     *
     * @codeCoverageIgnore
     */
    protected function getModelBloodstockSale()
    {
        return new \Models\Bo\Bloodstock\Dam\BloodstockSale();
    }

    /**
     * @return array
     */
    public function getProgenySales()
    {
        return $this->getModelBloodstockSale()->getProgenySales($this->request);
    }

    /**
     * @return ProgenyResultsSeasons
     */
    public function getProgenyResultsSeasonsDataProvider()
    {
        return new ProgenyResultsSeasons();
    }

    /**
     * @return \Phalcon\Mvc\Model\Row\General[]
     */
    public function getProgenyResultsSeasons()
    {
        return $this->getProgenyResultsSeasonsDataProvider()->getProgenyResultsSeasons($this->request->getDamId());
    }
}
