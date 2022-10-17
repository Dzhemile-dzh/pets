<?php
namespace Api\Result\StakesData;

use Api\Result\Json as Result;

class Horse extends Result
{
    protected function getMappers()
    {
        return [
            'last_7_days' => '\Api\Output\Mapper\StakesData\Horse',
            'last_14_days' => '\Api\Output\Mapper\StakesData\Horse',
            'last_month' => '\Api\Output\Mapper\StakesData\Horse',
            'last_3_months' => '\Api\Output\Mapper\StakesData\Horse',
            'last_6_months' => '\Api\Output\Mapper\StakesData\Horse',
            'current_season.flat' => '\Api\Output\Mapper\StakesData\Horse',
            'current_season.jumps' => '\Api\Output\Mapper\StakesData\Horse',
        ];
    }
}
