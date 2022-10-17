<?php

namespace Bo;

use \Api\DataProvider\Bo as DataProvider;

/**
 * Class VideoProviders
 *
 * @package Bo
 */
class VideoProviders extends Standart
{
    /**
     * Array of races IDs
     *
     * @var array
     */
    private $raceIDs = array();

    /**
     * Data provider
     *
     * @var DataProvider|null
     */
    private $dataProvider = null;

    /**
     * @param array        $raceIDs
     * @param DataProvider $dataProvider
     *
     * @throws \Api\Exception\InternalServerError
     */
    public function __construct($raceIDs, $dataProvider = null)
    {
        if (empty($raceIDs)) {
            throw new \Api\Exception\InternalServerError(3);
        }
        $this->raceIDs = $raceIDs;

        if (is_null($dataProvider)) {
            $dataProvider = $this->createDataProvider();
        }
        $this->setDataProvider($dataProvider);
    }

    /**
     * @param DataProvider\VideoProviders $dataProvider
     */
    protected function setDataProvider($dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * @return DataProvider\VideoProviders|null
     */
    protected function getDataProvider()
    {
        return $this->dataProvider;
    }

    /**
     * @return DataProvider\VideoProviders
     */
    protected function createDataProvider()
    {
        return new DataProvider\VideoProviders();
    }

    /**
     * @return array
     */
    public function getDetails()
    {
        return $this->getDataProvider()->getDetails($this->raceIDs);
    }
}
