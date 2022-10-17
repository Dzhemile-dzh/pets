<?php

namespace Api\Result\Bloodstock\Stallion;

class ProgenyResults extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'progeny_results' => '\Api\Output\Mapper\Bloodstock\Stallion\ProgenyResults',
            'season_info' => '\Api\Output\Mapper\Bloodstock\Stallion\ProgenyResultsSeasonInfo'
        ];
    }
}
