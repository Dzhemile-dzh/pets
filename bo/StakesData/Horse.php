<?php
namespace Bo\StakesData;

use Bo\Standart;
use Api\DataProvider\Bo\StakesData\Horse as HorseDataSet;

class Horse extends Standart
{
    /**
     * @return array
     */
    public function getData()
    {
        return $this->getHorseDataSet()->getHorseData(
            $this->getRequest()->getHorseId(),
            $this->getRequest()->getCourseId(),
            $this->getRequest()->getRaceType()
        );
    }

    /**
     * @return array
     */
    public function getCurrentSeason()
    {
        return $this->getHorseDataSet()->getCurrentSeason(
            $this->getRequest()->getHorseId(),
            $this->getRequest()->getCourseId(),
            $this->getRequest()->getRaceType()
        );
    }

    /**
     * @return HorseDataSet
     */
    protected function getHorseDataSet()
    {
        return new HorseDataSet();
    }
}
