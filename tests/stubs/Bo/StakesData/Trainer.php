<?php
namespace Tests\Stubs\Bo\StakesData;

class Trainer extends \Bo\StakesData\Trainer
{
    /**
     * @return \Tests\Stubs\DataProvider\Bo\StakesData\Trainer
     */
    protected function getStakesDataTrainerDataProvider()
    {
        return new \Tests\Stubs\DataProvider\Bo\StakesData\Trainer();
    }
}
