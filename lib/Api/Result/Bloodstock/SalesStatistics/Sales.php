<?php

/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 8/3/2016
 * Time: 11:36 AM
 */

namespace Api\Result\Bloodstock\SalesStatistics;

class Sales extends \Api\Result\Json
{
    protected function getMappers()
    {
        return [
            'sales.days'      => '\Api\Output\Mapper\Bloodstock\SalesStatistics\SalesDay',
            'sales.overall'   => '\Api\Output\Mapper\Bloodstock\SalesStatistics\Sales',
            'sales.colts'     => '\Api\Output\Mapper\Bloodstock\SalesStatistics\Sales',
            'sales.fillies'   => '\Api\Output\Mapper\Bloodstock\SalesStatistics\Sales',
        ];
    }
}
