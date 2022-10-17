<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 7/7/2016
 * Time: 6:09 PM
 */

namespace Tests\Stubs\Bo;

use Tests\Stubs\Models\Bo\HorseTracker as Model;

class HorseTracker extends \Bo\HorseTracker
{
    protected function getModelRaceInstance()
    {
        return new Model\RaceInstance();
    }

    protected function getModelHorse()
    {
        return new Model\Horse();
    }
}
