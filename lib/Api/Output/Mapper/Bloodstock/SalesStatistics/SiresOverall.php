<?php
namespace Api\Output\Mapper\Bloodstock\SalesStatistics;

use RP\Util\Math\GetPercent;
use Api\Output\Mapper\HorsesMapper;

class SiresOverall extends HorsesMapper
{
    use GetPercent;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'median' => 'median',
            'price_max' => 'price_max',
            'price_min' => 'price_min',
            'price_average' => 'price_average',
            'price_total' => 'price_total',
            'total_count' => 'total_count',
            'sales_count' => 'sales_count',
            'offered_count' => 'offered_count',
            'buyers_count' => 'buyers_count',
            'cur_code' => 'currency_code',
            '(getPercent)sales_count,offered_count' => 'sold_percent',
            'colts' => 'colts',
            'fillies' => 'fillies',
        ];
    }
}
