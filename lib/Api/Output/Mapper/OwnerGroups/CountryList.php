<?php

namespace Api\Output\Mapper\OwnerGroups;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class HorseList
 *
 * @package Api\Output\Mapper\OwnerGroups
 */
class CountryList extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            'country_code' => 'country_code',
            'country_desc' => 'country_desc'
        ];
    }
}
