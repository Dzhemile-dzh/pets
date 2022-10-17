<?php

namespace Api\Output\Mapper\RaceCards;

use \Api\Output\Mapper\HorsesMapper;

/**
 * Class PostPointerVerdict
 *
 * @package Api\Output\Mapper\RaceCards
 */
class PostPointerVerdict extends HorsesMapper
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
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(prepareToDiffusion)course_style_name' => 'diffusion_course_name',
            '(getCourseContinent)course_country_code' => 'course_region',
            'course_country_code' => 'course_country_code',
            'rp_verdict' => 'short_spotlight_verdict',
        ];
    }
}
