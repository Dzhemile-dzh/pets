<?php

namespace Api\Result\OwnerGroups;

use Api\Result\Json as Result;

/**
 * Class HorseList
 *
 * @package Api\Result\OwnerGroups
 */
class CountryList extends Result
{
    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'country_list' => 'Api\Output\Mapper\OwnerGroups\CountryList'
        ];
    }
}
