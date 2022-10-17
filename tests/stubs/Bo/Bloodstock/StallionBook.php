<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 5/18/2016
 * Time: 12:31 AM
 */

namespace Tests\Stubs\Bo\Bloodstock;

use Tests\Stubs\Models\Bo\Bloodstock\StallionBook as Bo;

class StallionBook extends \Bo\Bloodstock\StallionBook
{
     /**
     * @return \Tests\Stubs\Models\Bo\Bloodstock\StallionBook\RaceInstance
     */
    protected function getModelRaceInstance()
    {
        return new Bo\RaceInstance();
    }
}
