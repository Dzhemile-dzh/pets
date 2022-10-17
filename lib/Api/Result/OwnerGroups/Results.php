<?php

namespace Api\Result\OwnerGroups;

use Api\Result\Json as Result;

/**
 * Class Results
 *
 * @package Api\Result\OwnerGroups
 */
class Results extends Result
{
    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'results' => 'Api\Output\Mapper\OwnerGroups\Results\Races',
            'results.runners' => 'Api\Output\Mapper\OwnerGroups\Results\Runners'
        ];
    }
}
