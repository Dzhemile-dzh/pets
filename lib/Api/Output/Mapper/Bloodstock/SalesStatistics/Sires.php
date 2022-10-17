<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/4/2016
 * Time: 2:59 PM
 */

namespace Api\Output\Mapper\Bloodstock\SalesStatistics;

class Sires extends \Api\Output\Mapper\HorsesMapper
{
    use \RP\Util\Math\GetPercent;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'sire_uid' => 'sire_uid',
            'sire_name' => 'sire_name',
            'sire_style_name' => 'sire_style_name',
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
