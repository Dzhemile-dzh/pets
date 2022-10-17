<?php

namespace Bo\Bloodstock\Statistics;

use Models\Bo\Bloodstock\StallionStatistics as Bo;

/**
 * Class Rating
 * @package Bo\Bloodstock\Statistics
 */
class Rating extends \Bo\Standart
{
    /**
     * @return Bo\RaceInstance
     *
     * @codeCoverageIgnore
     */
    protected function getModelRaceInstance()
    {
        return new Bo\RaceInstance();
    }

    /**
     * @return array
     */
    public function getRatingStatistic()
    {
        return $this->getModelRaceInstance()->getRatingStatistic($this->request, $this->getModelSelectors());
    }
}
