<?php

namespace Api\Result\Bloodstock\Statistics;

/**
 * Class Rating
 *
 * @package Api\Result\Bloodstock\Statistics
 */
class Rating extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'rating_statistic' => '\Api\Output\Mapper\Bloodstock\Statistics\Rating',
        ];
    }
}
