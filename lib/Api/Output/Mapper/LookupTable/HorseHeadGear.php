<?php

namespace Api\Output\Mapper\LookupTable;

/**
 * @package Api\Output\Mapper\LookupTable
 */
class HorseHeadGear extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @inheritdoc
     */
    protected function getMap()
    {
        return [
            'horse_head_gear_uid'       => 'horse_head_gear_uid',
            'horse_head_gear_code'      => 'horse_head_gear_code',
            'horse_head_gear_desc'      => 'horse_head_gear_desc',
            'blinkers_yn'               => 'blinkers_yn',
            'visors_yn'                 => 'visors_yn',
            'first_time_yn'             => 'first_time_yn',
            'rp_horse_head_gear_code'   => 'rp_horse_head_gear_code',
        ];
    }
}
