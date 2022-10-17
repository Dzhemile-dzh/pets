<?php

namespace Api\Result\OwnerGroups;

use Api\Result\Json as Result;

/**
 * Class ResultsNoOwnerFilter
 * @package Api\Result\OwnerGroups
 */
class ResultsNoOwnerFilter extends Result
{
    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'results' => 'Api\Output\Mapper\OwnerGroups\Results\Races',
            'results.runners' => 'Api\Output\Mapper\OwnerGroups\Results\Runners',
            'results.runners.sales_info' => 'Api\Output\Mapper\HorseProfile\Sales'
        ];
    }
}
