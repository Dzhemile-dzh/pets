<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/31/2016
 * Time: 2:27 PM
 */

namespace Tests\Stubs\Bo\GoingToSuit;

class RaceLevel extends \Bo\GoingToSuit\RaceLevel
{
    protected function getRaceLevelDataSet()
    {
        return new \Tests\Stubs\DataProvider\Bo\GoingToSuit\RaceLevel();
    }
}
