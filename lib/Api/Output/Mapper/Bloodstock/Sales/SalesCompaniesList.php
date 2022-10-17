<?php
namespace Api\Output\Mapper\Bloodstock\Sales;

use Api\Output\Mapper\HorsesMapper;

class SalesCompaniesList extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'venue_uid' => 'sale_co_uid',
            'venue_desc' => 'sale_co_name',
        ];
    }
}
