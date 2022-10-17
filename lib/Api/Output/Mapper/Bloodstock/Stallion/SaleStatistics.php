<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 3/29/2016
 * Time: 3:32 PM
 */

namespace Api\Output\Mapper\Bloodstock\Stallion;

class SaleStatistics extends \Api\Output\Mapper\HorsesMapper
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
            'colts' => 'colts',
            'fillies' => 'fillies',
        ];
    }
}
