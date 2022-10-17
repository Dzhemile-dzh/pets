<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 8/9/2016
 * Time: 11:21 AM
 */

namespace Api\Result\Bloodstock\SalesStatistics;

class Buyers extends \Api\Result\Json
{
    protected function getMappers()
    {
        return [
            'buyers.overall' => '\Api\Output\Mapper\Bloodstock\SalesStatistics\BuyersOverall',
            'buyers.buyers' => '\Api\Output\Mapper\Bloodstock\SalesStatistics\Buyers',
            'buyers.buyers.entities' => '\Api\Output\Mapper\Bloodstock\SalesStatistics\BuyersEntities',
        ];
    }
}
