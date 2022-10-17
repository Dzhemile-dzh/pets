<?php
namespace Api\Output\Mapper\Signposts;

use Api\Output\Mapper\HorsesMapper;

class FirstTimeBlinkers extends HorsesMapper
{
    use \Api\Output\Mapper\Methods\LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_name' => 'horse_name',
            'horse_uid' => 'horse_uid',
            '(dbYNFlagToBoolean)non_runner' => 'non_runner',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'race_instance_uid' => 'race_uid',
            'race_instance_title' => 'race_instance_title',
            'declared_runners' => 'declared_runners',
            'race_group_desc' => 'race_group_desc',
            'perform_race_uid_atr' => 'perform_race_uid_atr',
            'perform_race_uid_ruk' => 'perform_race_uid_ruk',
            'course_style_name' => 'course_style_name',
            '(getCourseContinent)country_code' => 'course_region',
            'course_uid' => 'course_uid',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(trim)country_code' => 'course_country_code',
            'rp_postmark' => 'rp_postmark',
            '(getSilkImagePath)' => 'silk_image_path',
            '(dbYNFlagToBoolean)first_time_blinkers' =>'first_time_blinkers',
            '(dbYNFlagToBoolean)first_time_visor' => 'first_time_visor',
            '(dbYNFlagToBoolean)first_time_hood' => 'first_time_hood',
            '(dbYNFlagToBoolean)first_tongue_tie' => 'first_tongue_tie',
        ];
    }
}
