<?php

namespace Api\Result\OwnerGroups;

use Api\Result\Json as Result;

/**
 * @package Api\Result\OwnerGroups
 */
class Splash extends Result
{
    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'splash' => 'Api\Output\Mapper\OwnerGroups\Splash'
        ];
    }
}
