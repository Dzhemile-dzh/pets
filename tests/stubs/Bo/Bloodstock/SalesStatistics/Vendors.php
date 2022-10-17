<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 8/11/2016
 * Time: 5:15 PM
 */

namespace Tests\Stubs\Bo\Bloodstock\SalesStatistics;

use Tests\Stubs\DataProvider\Bo\Bloodstock\SalesStatistics\Vendors as VendorsDataSet;

class Vendors extends \Bo\Bloodstock\SalesStatistics\Vendors
{
    protected function getVendorsDataSet()
    {
        return new VendorsDataSet();
    }
}
