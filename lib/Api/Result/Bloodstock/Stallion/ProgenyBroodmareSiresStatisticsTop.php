<?php

namespace Api\Result\Bloodstock\Stallion;

class ProgenyBroodmareSiresStatisticsTop extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'progeny_broodmare_sires_statistics_top' => '\Api\Output\Mapper\Bloodstock\Stallion\ProgenyBroodmareSiresStatisticsTop'
        ];
    }
}
