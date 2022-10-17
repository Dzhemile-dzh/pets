<?php
/**
 * Created by PhpStorm.
 * User: oleg_symonchuk
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\RaceCards\RunnersIndex;

class Runners extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;
    use \Api\Methods\TenToFollowHorse;

    protected function getMap()
    {
        return [
            '(fixAroHorseName)style_name,country_origin_code' => 'style_name',
            '(trim)runners_index_outcome' => 'runners_index_outcome',
            '(trim)odds_desc' => 'odds_desc',
            'course_uid' => 'course_uid',
            'rp_abbrev_3' => 'rp_abbrev_3',
            'course_name' => 'course_name',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            'jockey_uid' => 'jockey_uid',
            'jockey_style_name' => 'jockey_style_name',
            'owner_uid' => 'owner_uid',
            'owner_style_name' => 'owner_style_name',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(stringToURLkey)course_name' => 'course_key',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'race_instance_uid' => 'race_instance_uid',
            'race_status_code' => 'race_status_code',
            '(isTenToFollowHorse)ten_to_follow_horse,reasoning,race_type_code' => 'ten_to_follow_horse',
            'horse_uid' => 'horse_uid',
        ];
    }
}
