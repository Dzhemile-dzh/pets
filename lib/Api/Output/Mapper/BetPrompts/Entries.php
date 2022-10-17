<?php

namespace Api\Output\Mapper\BetPrompts;

class Entries extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;
    use \Api\Output\Mapper\Methods\LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(dateISO8601)race_datetime' => 'race_datetime',
            'race_instance_uid' => 'race_uid',
            'race_instance_title' => 'race_instance_title',
            'declared_runners' => 'declared_runners',
            'race_group_desc' => 'race_group_desc',
            'perform_race_uid_atr' => 'perform_race_uid_atr',
            'perform_race_uid_ruk' => 'perform_race_uid_ruk',
            '(fixAroHorseName)horse_name,horse_country_origin_code' => 'horse_name',
            'horse_uid' => 'horse_uid',
            'saddle_cloth_no' => 'start_number',
            '(removeDotFromAwCourse)course_name' => 'course_style_name',
            '(getCourseContinent)country_code' => 'course_region',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            'course_uid' => 'course_uid',
            '(trim)country_code' => 'course_country_code',
            '(getSilkImagePath)' => 'silk_image_path',
            '(dbYNFlagToBoolean)non_runner' => 'non_runner'
        ];
    }
}
