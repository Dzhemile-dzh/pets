<?php

namespace Api\Output\Mapper\RaceCards;

use \Api\Output\Mapper\HorsesMapper;

/**
 * Class KeyStats
 *
 * @package Api\Output\Mapper\RaceCards
 */
class KeyStats extends HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;
    use \Api\Output\Mapper\Methods\LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'key_stats_str' => 'key_stats_str',
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_style_name,horse_country_origin_code' => 'horse_name',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(getCourseContinent)course_country_code' => 'course_region',
            '(prepareToDiffusion)course_style_name' => 'diffusion_course_name',
            'course_country_code' => 'course_country_code',
            '(getSilkImagePath)' => 'silk_image_path',
        ];
    }
}
