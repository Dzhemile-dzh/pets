<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 3/30/2016
 * Time: 11:22 AM
 */

namespace Api\Output\Mapper\Bloodstock\Stallion;

class SaleStatisticsDescendants extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'sale_year' => 'sale_year',
            'median' => 'median',
            'price_max' => 'price_max',
            'price_min' => 'price_min',
            'price_average' => 'price_average',
            'total_count' => 'total_count',
            'sales_count' => 'sales_count',
            'offered_count' => 'offered_count',
            'buyers_count' => 'byers_count',
            '(getPercent)sales_count,offered_count' => 'sold_percent',
        ];
    }
}
