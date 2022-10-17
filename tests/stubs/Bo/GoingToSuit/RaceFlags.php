<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 5/8/2017
 * Time: 12:27 PM
 */

namespace Tests\Stubs\Bo\GoingToSuit;

class RaceFlags extends \Bo\GoingToSuit\RaceFlags
{
    protected function getGoingToSuitDataSet()
    {
        return new \Tests\Stubs\DataProvider\Bo\GoingToSuit\RaceFlags();
    }
}
