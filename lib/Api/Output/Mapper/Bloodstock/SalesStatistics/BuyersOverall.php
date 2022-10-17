<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 8/9/2016
 * Time: 12:21 PM
 */

namespace Api\Output\Mapper\Bloodstock\SalesStatistics;

class BuyersOverall extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'buyer_detail' => 'buyer_detail',
            'median' => 'median',
            'price_max' => 'price_max',
            'price_min' => 'price_min',
            'price_average' => 'price_average',
            'price_total' => 'price_total',
            'sales_count' => 'sales_count',
            'cur_code' => 'currency_code',
        ];
    }
}
