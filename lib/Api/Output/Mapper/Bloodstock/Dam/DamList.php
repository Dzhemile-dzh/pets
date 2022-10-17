<?php
namespace Api\Output\Mapper\Bloodstock\Dam;

use Api\Output\Mapper;

class DamList extends Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'dam_uid',
            'style_name' => 'dam_name',
            '(trim)country_origin_code' => 'country_code',
            '(dateISO8601)horse_date_of_birth' => 'date_of_birth',
            '(dateISO8601)horse_date_of_death' => 'date_of_death'
        ];
    }
}
