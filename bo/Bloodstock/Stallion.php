<?php
namespace Bo\Bloodstock;

use Bo\Profile;
use Api\DataProvider\Bo\Bloodstock\Stallion as DataProvider;

/**
 * Class Stallion
 * @package Bo\Bloodstock
 */
class Stallion extends Profile
{
    /**
     * @return DataProvider\ProgenyHorses
     *
     * @codeCoverageIgnore
     */
    protected function getProgenyHorsesDataProvider()
    {
        return new DataProvider\ProgenyHorses();
    }

    /**
     * @return DataProvider\ProgenyStatisticsGoingForm
     *
     * @codeCoverageIgnore
     */
    protected function getProgenyStatisticsGoingFormDataProvider()
    {
        return new DataProvider\ProgenyStatisticsGoingForm();
    }

    /**
     * @return DataProvider\ProgenyResults
     *
     * @codeCoverageIgnore
     */
    protected function getProgenyResultsDataProvider()
    {
        return new DataProvider\ProgenyResults($this->request);
    }

    /**
     * @return DataProvider\ProgenyEntries
     *
     * @codeCoverageIgnore
     */
    protected function getProgenyEntriesDataProvider()
    {
        return new DataProvider\ProgenyEntries($this->request->getStallionId());
    }

    /**
     * @return DataProvider\SeasonsAvailable
     *
     * @codeCoverageIgnore
     */
    protected function getSeasonsAvailableDataProvider()
    {
        return new DataProvider\SeasonsAvailable($this->request);
    }

    /**
     * @return DataProvider\ProgenyStatistics
     *
     * @codeCoverageIgnore
     */
    protected function getProgenyStatisticsDataProvider()
    {
        return new DataProvider\ProgenyStatistics();
    }

    /**
     * @return DataProvider\FeeHistory
     *
     * @codeCoverageIgnore
     */
    protected function getFeeHistoryDataProvider()
    {
        return new DataProvider\FeeHistory();
    }

    /**
     * @return DataProvider\ProgenyStatisticsTop
     *
     * @codeCoverageIgnore
     */
    protected function getProgenyStatisticsTopDataProvider()
    {
        return new DataProvider\ProgenyStatisticsTop();
    }

    /**
     * @return DataProvider\NickDescendants
     *
     * @codeCoverageIgnore
     */
    protected function getNickDescendantsDataProvider()
    {
        return new DataProvider\NickDescendants();
    }

    /**
     * @return DataProvider\ProgenySeason
     *
     * @codeCoverageIgnore
     */
    protected function getProgenySeasonDataProvider()
    {
        return new DataProvider\ProgenySeason();
    }

    /**
     * @return DataProvider\RaceInstance
     *
     * @codeCoverageIgnore
     */
    protected function getRaceInstanceDataProvider()
    {
        return new DataProvider\RaceInstance();
    }

    /**
     * @return DataProvider\ProgenySeason
     *
     * @codeCoverageIgnore
     */
    protected function getDataProviderDefaultInfo()
    {
        return $this->getProgenySeasonDataProvider();
    }

    /**
     * @return DataProvider\Horse
     *
     * @codeCoverageIgnore
     */
    protected function getHorseDataProvider()
    {
        return new DataProvider\Horse();
    }
}
