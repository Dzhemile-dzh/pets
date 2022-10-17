<?php

namespace Api\Result\OwnerGroups;

use Api\Result\Json as Result;

/**
 * Class HorseList
 *
 * @package Api\Result\OwnerGroups
 */
class HorseList extends Result
{
    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'horse_list' => 'Api\Output\Mapper\OwnerGroups\HorseList'
        ];
    }
}
