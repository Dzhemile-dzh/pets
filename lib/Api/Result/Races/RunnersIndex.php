<?php

namespace Api\Result\Races;

use Api\Result\Json as Result;

/**
 * Class Favourites
 * @package Api\Result\Races
 */
class RunnersIndex extends Result
{
    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'runners_index.runners'=> 'Api\Output\Mapper\Races\RunnersIndex',
        ];
    }
}
