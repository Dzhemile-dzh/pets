<?php
namespace Api\Result\Bloodstock\Dam;

use Api\Result\Json as Result;

class ProgenyResultsSeasons extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'progeny_results_seasons' => '\Api\Output\Mapper\Bloodstock\Dam\ProgenyResultsSeasons'
        ];
    }
}
