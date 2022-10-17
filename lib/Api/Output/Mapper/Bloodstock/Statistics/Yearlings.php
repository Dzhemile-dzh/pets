<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 5/13/2016
 * Time: 2:28 PM
 */

namespace Api\Output\Mapper\Bloodstock\Statistics;

class Yearlings extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'median' => 'median',
            'price_average' => 'price_average',
            'price_top' => 'price_top',
            'sales_count' => 'sales_count',
            'offered_count' => 'offered_count',
            'percent_clearance_rate' => 'percent_clearance_rate',
        ];
    }
}
