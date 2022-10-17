<?php
namespace Api\Output\Mapper\Bloodstock\Sales;

use Api\Output\Mapper\HorsesMapper;

class Catalogue extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'venue_uid' => 'venue_uid',
            'sale_name' => 'sale_name',
            '(dateISO8601)sale_date' => 'sale_date',
            '(dateISO8601)sale_end_date' => 'sale_end_date',
            'sale_co' => 'sale_co',
            'abbrev_name' => 'abbrev_name',
            'total_lots' => 'total_lots',
        ];
    }
}
