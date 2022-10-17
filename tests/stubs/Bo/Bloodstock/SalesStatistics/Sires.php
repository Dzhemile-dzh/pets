<?php

/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/5/2016
 * Time: 11:08 AM
 */

namespace Tests\Stubs\Bo\Bloodstock\SalesStatistics;

use Tests\Stubs\DataProvider\Bo\Bloodstock\SalesStatistics\Sires as SireDataSet;

class Sires extends \Bo\Bloodstock\SalesStatistics\Sires
{
    protected function getSireDataSet()
    {
        return new SireDataSet();
    }
}
