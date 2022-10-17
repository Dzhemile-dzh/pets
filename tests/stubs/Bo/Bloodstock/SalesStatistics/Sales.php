<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 8/5/2016
 * Time: 3:39 PM
 */

namespace Tests\Stubs\Bo\Bloodstock\SalesStatistics;

use Tests\Stubs\DataProvider\Bo\Bloodstock\SalesStatistics\Sales as SalesDataSet;

class Sales extends \Bo\Bloodstock\SalesStatistics\Sales
{
    protected function getSalesDataSet()
    {
        return new SalesDataSet();
    }
}
