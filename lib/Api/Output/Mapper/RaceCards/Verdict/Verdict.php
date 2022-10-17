<?php

namespace Api\Output\Mapper\RaceCards\Verdict;

/**
 * Class Verdict
 *
 * @package Api\Output\Mapper\RaceCards\Verdict
 */
class Verdict extends \Api\Output\Mapper\HorsesMapper
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
            '(nullIfStringEmpty)rp_verdict' => 'rp_verdict',
            '(nullIfStringEmpty)pre_race_instance_comments' => 'pre_race_instance_comments',
            'key_stats_str' => 'key_stats_str',
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_style_name,horse_country_origin_code' => 'horse_name',
            'course_uid' => 'course_uid',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(prepareToDiffusion)course_style_name' => 'diffusion_course_name',
            '(getCourseContinent)course_country_code' => 'course_region',
            'course_country_code' => 'course_country_code',
            '(getSilkImagePath)' => 'silk_image_path',
            'saddle_cloth_no' => 'start_number',
            '(dbYNFlagToBoolean)non_runner' => 'non_runner',
        ];
    }
}
