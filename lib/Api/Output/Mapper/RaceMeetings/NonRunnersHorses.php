<?php
namespace Api\Output\Mapper\RaceMeetings;

use Api\Output\Mapper\HorsesMapper;

class NonRunnersHorses extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            'horse_name' => 'horse_name',
            '(fixAroHorseName)horse_style_name,horse_country_origin_code' => 'horse_style_name',
            '(getSilkImagePath)' => 'silkUrl',
            'trainer_name' => 'trainer_name',
            'trainer_uid' => 'trainer_uid',
            'trainer_style_name' => 'trainer_style_name',
            'draw' => 'draw_number',
            'race_number' => 'race_number',
        ];
    }
}
