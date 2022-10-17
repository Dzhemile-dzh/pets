<?php
namespace Bo\StakesData;

use Bo\Standart;

class Trainer extends Standart
{
    /**
     * @return \Api\DataProvider\Bo\StakesData\Trainer
     */
    protected function getStakesDataTrainerDataProvider()
    {
        return new \Api\DataProvider\Bo\StakesData\Trainer();
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->getStakesDataTrainerDataProvider()->getTrainerData(
            $this->getRequest()->getTrainerId(),
            $this->getRequest()->getCourseId(),
            $this->getRequest()->getRaceType()
        );
    }

    /**
     * @return array
     */
    public function getCurrentSeason()
    {
        return $this->getStakesDataTrainerDataProvider()->getCurrentSeason(
            $this->getRequest()->getTrainerId(),
            $this->getRequest()->getCourseId(),
            $this->getRequest()->getRaceType()
        );
    }
}
