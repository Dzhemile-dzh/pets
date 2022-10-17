<?php

namespace Api\Result\Races;

use Api\Result\Json as Result;

/**
 * Class Favourites
 * @package Api\Result\Races
 */
class Favourites extends Result
{
    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'races'=> 'Api\Output\Mapper\Races\Favourites',
        ];
    }
}
