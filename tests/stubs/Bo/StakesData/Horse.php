<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 1/12/2017
 * Time: 6:44 PM
 */

namespace Tests\Stubs\Bo\StakesData;

class Horse extends \Bo\StakesData\Horse
{
    protected function getHorseDataSet()
    {
        return new \Tests\Stubs\DataProvider\Bo\StakesData\Horse();
    }
}
