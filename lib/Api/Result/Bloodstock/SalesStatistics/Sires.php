<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/4/2016
 * Time: 2:57 PM
 */

namespace Api\Result\Bloodstock\SalesStatistics;

class Sires extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'overall' => '\Api\Output\Mapper\Bloodstock\SalesStatistics\SiresOverall',
            'sires' => '\Api\Output\Mapper\Bloodstock\SalesStatistics\Sires',
            'sires.colts' => '\Api\Output\Mapper\Bloodstock\SalesStatistics\SiresChildren',
            'sires.fillies' => '\Api\Output\Mapper\Bloodstock\SalesStatistics\SiresChildren',
        ];
    }
}
