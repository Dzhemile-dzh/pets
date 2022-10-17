<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 3/29/2016
 * Time: 3:37 PM
 */

namespace Api\Result\Bloodstock\Stallion;

class SaleStatistics extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'sale_statistics' => '\Api\Output\Mapper\Bloodstock\Stallion\SaleStatistics',
            'sale_statistics.colts' => '\Api\Output\Mapper\Bloodstock\Stallion\SaleStatisticsDescendants',
            'sale_statistics.fillies' => '\Api\Output\Mapper\Bloodstock\Stallion\SaleStatisticsDescendants',
            'overall' => '\Api\Output\Mapper\Bloodstock\Stallion\SaleStatistics',
            'overall.colts' => '\Api\Output\Mapper\Bloodstock\Stallion\SaleStatisticsDescendants',
            'overall.fillies' => '\Api\Output\Mapper\Bloodstock\Stallion\SaleStatisticsDescendants',
            'season_info' => '\Api\Output\Mapper\SeasonInfo\StallionSaleSeasonInfo',
        ];
    }
}
