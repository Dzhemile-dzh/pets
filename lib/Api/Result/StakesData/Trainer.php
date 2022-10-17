<?php
namespace Api\Result\StakesData;

use Api\Result\Json as Result;

class Trainer extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'last_7_days' => '\Api\Output\Mapper\StakesData\Trainer',
            'last_14_days' => '\Api\Output\Mapper\StakesData\Trainer',
            'last_month' => '\Api\Output\Mapper\StakesData\Trainer',
            'last_3_months' => '\Api\Output\Mapper\StakesData\Trainer',
            'last_6_months' => '\Api\Output\Mapper\StakesData\Trainer',
            'current_season.flat' => '\Api\Output\Mapper\StakesData\Trainer',
            'current_season.jumps' => '\Api\Output\Mapper\StakesData\Trainer',
        ];
    }
}
