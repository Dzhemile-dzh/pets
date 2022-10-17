<?php

namespace Api\Output\Mapper\RaceCards;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class NapsTable
 *
 * @package Api\Output\Mapper\RaceCards
 */
class NapsTable extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            'horse_style_name' => 'horse_style_name',
            '(dateISO8601)nap_time' => 'race_datetime',
            'course' => 'course',
            'newspaper' => 'newspaper',
            'tipster' => 'tipster',
            'level_stake' => 'level_stake',
            'naps_count' => 'naps_count',
            'race_instance_uid' => 'race_instance_uid',
            'course_uid' => 'course_uid',
            'course_name' => 'course_name',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(getSilkImagePath)' => 'silk_image_path',
            'naps_table_outcome' => 'naps_table_outcome',
            'odds_desc' => 'odds_desc',
        ];
    }
}
