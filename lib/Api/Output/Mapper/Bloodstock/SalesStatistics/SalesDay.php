<?php

/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 8/3/2016
 * Time: 11:36 AM
 */

namespace Api\Output\Mapper\Bloodstock\SalesStatistics;

class SalesDay extends \Api\Output\Mapper\HorsesMapper
{
    use \RP\Util\Math\GetPercent;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(dateISO8601)sale_date' => 'sale_date',
            'median' => 'median',
            'price_max' => 'price_max',
            'price_min' => 'price_min',
            'price_average' => 'price_average',
            'price_total' => 'price_total',
            'cur_code' => 'currency_code',
            'total_count' => 'total_count',
            'sales_count' => 'sales_count',
            'offered_count' => 'offered_count',
            'buyers_count' => 'byers_count',
            '(getPercent)sales_count,offered_count' => 'sold_percent',
        ];
    }
}
