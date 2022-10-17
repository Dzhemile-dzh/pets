<?php

namespace Api\Output\Mapper\LookupTable;

/**
 * @package Api\Output\Mapper\LookupTable
 */
class SalesVenues extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @inheritdoc
     */
    protected function getMap()
    {
        return [
            'venue_uid' => 'venue_uid',
            'venue_desc' => 'venue_desc',
            'currency_code' => 'currency_code',
            'country_flag' => 'country_flag',
        ];
    }
}
