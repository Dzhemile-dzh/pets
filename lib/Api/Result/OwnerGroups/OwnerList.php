<?php

namespace Api\Result\OwnerGroups;

use Api\Result\Json as Result;

/**
 * @package Api\Result\OwnerGroups
 */
class OwnerList extends Result
{
    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'owner_list' => 'Api\Output\Mapper\OwnerGroups\OwnerList'
        ];
    }
}
