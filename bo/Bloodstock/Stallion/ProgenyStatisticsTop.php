<?php

namespace Bo\Bloodstock\Stallion;

use Bo\Bloodstock\Stallion;

/**
 * Class ProgenyStatisticsTop
 * @package Bo\Bloodstock\Stallion
 */
class ProgenyStatisticsTop extends Stallion
{
    /**
     * @return \Phalcon\Mvc\Model\Row[]|null
     */
    public function getRows()
    {
        $category = $this->request->getCategory();

        if ($category == 'Worldwide G1') {
            $progeny = $this->getProgenyStatisticsTopDataProvider()->getWorldwideG1Progeny($this->request);
        } elseif ($category == 'Euro Stakes') {
            $progeny = $this->getProgenyStatisticsTopDataProvider()->getEuroStakesProgeny($this->request);
        } else {
            $progeny = $this->getProgenyStatisticsTopDataProvider()->findTopProgeny(
                $this->request,
                $this->getModelSelectors(),
                $category
            );
        }

        return empty($progeny) ? null : $progeny;
    }

    /**
     * @return null|\Phalcon\Mvc\Model\Row[]
     */
    public function getProgenyBroodmareSires()
    {
        $progeny = $this->getProgenyStatisticsTopDataProvider()->findTopProgeny(
            $this->request,
            $this->getModelSelectors(),
            'broodmare-sires'
        );

        return empty($progeny) ? null : $progeny;
    }
}
