<?php
namespace Bo\StakesData;

use Bo\Standart;

class Jockey extends Standart
{
    /**
     * @return \Api\DataProvider\Bo\StakesData\Jockey
     */
    protected function getStakesDataJockeyDataProvider()
    {
        return new \Api\DataProvider\Bo\StakesData\Jockey();
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->getStakesDataJockeyDataProvider()->getJockeyData(
            $this->getRequest()->getJockeyId(),
            $this->getRequest()->getCourseId(),
            $this->getRequest()->getRaceType()
        );
    }

    /**
     * @return array
     */
    public function getCurrentSeason()
    {
        return $this->getStakesDataJockeyDataProvider()->getCurrentSeason(
            $this->getRequest()->getJockeyId(),
            $this->getRequest()->getCourseId(),
            $this->getRequest()->getRaceType()
        );
    }
}
