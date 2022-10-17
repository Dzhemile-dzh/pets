<?php

namespace Api\Output\Mapper\RaceCards\Verdict;

/**
 * Class TipsterVerdict
 *
 * @package Api\Output\Mapper\RaceCards\Verdict
 */
class TipsterVerdict extends \Api\Output\Mapper\HorsesMapper
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
            'verdict' => 'verdict',
            'newspaper_uid' => 'newspaper_uid',
            'newspaper_name' => 'newspaper_name',
            'tipster_uid' => 'tipster_uid',
            'tipster_name' => 'tipster_name',
            '(dateISO8601)expire_on' => 'expire_on',
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_name,country_origin_code' => 'horse_name',
            'course_uid' => 'course_uid',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(getCourseContinent)country_code' => 'course_region',
            '(prepareToDiffusion)course_style_name' => 'diffusion_course_name',
            'course_country_code' => 'course_country_code',
            '(getSilkImagePath)' => 'silk_image_path',
            '(nullIfStringEmpty)selection_desc' => 'selection_desc',
            'saddle_cloth_no' => 'start_number',
            '(dbYNFlagToBoolean)non_runner' => 'non_runner',
        ];
    }
}
