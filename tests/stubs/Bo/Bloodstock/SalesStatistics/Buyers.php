<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 8/9/2016
 * Time: 6:10 PM
 */

namespace Tests\Stubs\Bo\Bloodstock\SalesStatistics;

use Tests\Stubs\DataProvider\Bo\Bloodstock\SalesStatistics\Buyers as BuyersDataSet;

class Buyers extends \Bo\Bloodstock\SalesStatistics\Buyers
{
    protected function getBuyersDataSet()
    {
        return new BuyersDataSet();
    }
}
