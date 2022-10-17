<?php

namespace Tests\Stubs\Bo\Bloodstock\Statistics;

use Tests\Stubs\Models\Bo\Bloodstock\StallionStatistics as Bo;

class Rating extends \Bo\Bloodstock\Statistics\Rating
{

    /**
     * @return \Tests\Stubs\Models\Bo\Bloodstock\StallionStatistics\RaceInstance
     */
    protected function getModelRaceInstance()
    {
        return new Bo\RaceInstance();
    }

    public function getModelSelectors()
    {
        $selectors = new \Models\Selectors();
        $selectors->setDb(new \Tests\Stubs\Models\Bo\Selectors\Database());
        return $selectors;
    }
}
