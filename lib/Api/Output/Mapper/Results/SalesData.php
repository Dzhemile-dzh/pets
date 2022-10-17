<?php

namespace Api\Output\Mapper\Results;

class SalesData extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            'style_name' => 'horse_name',
            'sales_info' => 'sales_info'
        ];
    }
}
