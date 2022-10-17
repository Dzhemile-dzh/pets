<?php

namespace Api\Result\Bloodstock\Stallion;

/**
 * Class ProgenyStatisticsTop
 *
 * @package Api\Result\Bloodstock\Stallion
 */
class ProgenyStatisticsTop extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'progeny_statistics_top' => '\Api\Output\Mapper\Bloodstock\Stallion\ProgenyStatisticsTop',
        ];
    }
}
