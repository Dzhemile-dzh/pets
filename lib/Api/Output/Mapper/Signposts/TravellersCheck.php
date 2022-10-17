<?php

namespace Api\Output\Mapper\Signposts;

class TravellersCheck extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;
    use \Api\Output\Mapper\Methods\LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(fixAroHorseName)horse_name,horse_country_origin_code' => 'horse_name',
            'horse_uid' => 'horse_uid',
            '(dbYNFlagToBoolean)non_runner' => 'non_runner',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'race_instance_uid' => 'race_uid',
            'race_instance_title' => 'race_instance_title',
            'declared_runners' => 'declared_runners',
            'race_group_desc' => 'race_group_desc',
            'perform_race_uid_atr' => 'perform_race_uid_atr',
            'perform_race_uid_ruk' => 'perform_race_uid_ruk',
            'trainer_name' => 'trainer_name',
            'trainer_uid' => 'trainer_uid',
            'trainer_location' => 'trainer_location',
            '(removeDotFromAwCourse)course_name' => 'course_style_name',
            '(getCourseContinent)country_code' => 'course_region',
            'course_uid' => 'course_uid',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(trim)country_code' => 'course_country_code',
            'dist_out' => 'dist_out',
            'trav_out' => 'trav_out',
            'trav_wins' => 'wins',
            'trav_runs' => 'runs',
            'trav_perc' => 'percentage',
            'all_out' => 'all_out',
            '(getSilkImagePath)' => 'silk_image_path',
        ];
    }
}
