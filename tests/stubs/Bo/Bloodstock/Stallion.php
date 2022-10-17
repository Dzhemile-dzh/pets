<?php

namespace Tests\Stubs\Bo\Bloodstock;

use Tests\Stubs\Models\Bo\Bloodstock\Stallion as Bo;

class Stallion extends \Bo\Bloodstock\Stallion
{
    use \Tests\Stubs\Bo\Methods\ProfileInitAdditionalParams;
    /**
     * @return \Tests\Stubs\Models\Bo\Bloodstock\Stallion\Horse
     */
    protected function getModelHorse()
    {
        return new Bo\Horse();
    }

    /**
     * @return \Tests\Stubs\Models\Bo\Bloodstock\Stallion\RaceInstance
     */
    protected function getModelRaceInstance()
    {
        return new Bo\RaceInstance();
    }

    /**
     * @return Bo\Season
     */
    protected function getModelSeason()
    {
        return new Bo\Season();
    }

    /**
     * @return Bo\Statistics
     */
    protected function getModelStatistics()
    {
        return new Bo\Statistics();
    }
}
