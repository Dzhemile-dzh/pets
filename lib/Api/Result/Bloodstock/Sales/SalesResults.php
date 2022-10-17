<?php

namespace Api\Result\Bloodstock\Sales;

class SalesResults extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'sales_results' => '\Api\Output\Mapper\Bloodstock\Sales\SalesResults',
            'sales_results.entered_races' => '\Api\Output\Mapper\Bloodstock\Sales\EnteredRaces',
        ];
    }
}
