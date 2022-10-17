<?php
namespace Tests\Stubs\Bo\StakesData;

class Jockey extends \Bo\StakesData\Jockey
{
    /**
     * @return \Tests\Stubs\DataProvider\Bo\StakesData\Jockey
     */
    protected function getStakesDataJockeyDataProvider()
    {
        return new \Tests\Stubs\DataProvider\Bo\StakesData\Jockey();
    }
}
