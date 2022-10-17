<?php

namespace Api\Result\Results;

/**
 * Class SalesData
 *
 * @package Api\Result\Results
 */
class SalesData extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'sales' => 'Api\Output\Mapper\Results\SalesData',
            // We want the sales data to be returned in the exact same format as it
            // is returned in the sales data for the horse profile so we use that mapper.
            'sales.sales_info' => 'Api\Output\Mapper\HorseProfile\Sales'
        ];
    }
}
