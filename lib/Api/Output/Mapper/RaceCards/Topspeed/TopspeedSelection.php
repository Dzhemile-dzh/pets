<?php
namespace Api\Output\Mapper\RaceCards\Topspeed;

class TopspeedSelection extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)style_name,country_origin_code' => 'horse_name',
            'selection_type_uid' => 'selection_type_uid'
        ];
    }
}
