<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 8/10/2016
 * Time: 4:07 PM
 */

namespace Api\Result\Bloodstock\SalesStatistics;

class Vendors extends \Api\Result\Json
{
    protected function getMappers()
    {
        return [
            'vendors.overall' => '\Api\Output\Mapper\Bloodstock\SalesStatistics\VendorsOverall',
            'vendors.vendors' => '\Api\Output\Mapper\Bloodstock\SalesStatistics\Vendors',
            'vendors.vendors.entities' => '\Api\Output\Mapper\Bloodstock\SalesStatistics\VendorsEntities',
        ];
    }
}
