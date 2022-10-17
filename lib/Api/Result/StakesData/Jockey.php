<?php
namespace Api\Result\StakesData;

use Api\Result\Json as Result;

class Jockey extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'last_7_days' => '\Api\Output\Mapper\StakesData\Jockey',
            'last_14_days' => '\Api\Output\Mapper\StakesData\Jockey',
            'last_month' => '\Api\Output\Mapper\StakesData\Jockey',
            'last_3_months' => '\Api\Output\Mapper\StakesData\Jockey',
            'last_6_months' => '\Api\Output\Mapper\StakesData\Jockey',
            'current_season.flat' => '\Api\Output\Mapper\StakesData\Jockey',
            'current_season.jumps' => '\Api\Output\Mapper\StakesData\Jockey',
        ];
    }
}
