<?php

namespace Api\Result\RaceCards;

/**
 * Class SalesData
 *
 * @package Api\Result\RaceCards
 */
class SalesData extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'sales' => 'Api\Output\Mapper\RaceCards\SalesData',
            // We want the sales data to be returned in the exact same format as it
            // is returned in the sales data for the horse profile so we use that mapper.
            'sales.sales_info' => 'Api\Output\Mapper\HorseProfile\Sales'
        ];
    }
}
