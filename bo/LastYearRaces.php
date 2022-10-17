<?php

namespace Bo;

use \Api\DataProvider\Bo as DataProvider;

/**
 * Class LastYearRaces
 *
 * @package Bo
 */
class LastYearRaces extends Standart
{
    /**
     * Past races chain limit
     */
    const LIMIT = 10;

    /**
     * Race Id
     *
     * @var int[]|null
     */
    private $raceIDs = null;

    /**
     * Data provider
     *
     * @var DataProvider|null
     */
    private $dataProvider = null;

    /**
     * @param int[]        $raceIds
     * @param DataProvider $dataProvider
     *
     * @throws \Api\Exception\InternalServerError
     */
    public function __construct($raceIds, $dataProvider = null)
    {
        if (is_null($raceIds)) {
            throw new \Api\Exception\InternalServerError(3);
        }
        $this->raceIDs = $raceIds;

        if (is_null($dataProvider)) {
            $dataProvider = $this->createDataProvider();
        }
        $this->setDataProvider($dataProvider);
    }

    /**
     * @param DataProvider\LastYearRaces $dataProvider
     */
    protected function setDataProvider($dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * @return DataProvider\LastYearRaces|null
     */
    protected function getDataProvider()
    {
        return $this->dataProvider;
    }

    /**
     * @return DataProvider\LastYearRaces
     */
    protected function createDataProvider()
    {
        return new DataProvider\LastYearRaces();
    }

    /**
     * @param int|null $limit
     *
     * @return array
     * @throws \Api\Exception\ValidationError
     */
    public function getPastRacesGrouped($limit = null)
    {
        return $this->getDataProvider()->getPastRacesGrouped($this->raceIDs, $this->getLimit($limit));
    }

    /**
     * @param int|null $limit
     *
     * @return array
     * @throws \Api\Exception\ValidationError
     */
    public function getPastRacesIDs($limit = null)
    {
        return $this->getDataProvider()->getPastRacesIDs($this->raceIDs, $this->getLimit($limit));
    }

    /**
     * @param int|null $limit
     *
     * @return string
     * @throws \Api\Exception\ValidationError
     */
    public function getPastRacesSQL($limit = null)
    {
        return $this->getDataProvider()->getSQL($this->getLimit($limit));
    }

    /**
     * @param int|null $limit
     *
     * @return int
     */
    private function getLimit($limit)
    {
        return (is_null($limit)) ? static::LIMIT : $limit;
    }
}
