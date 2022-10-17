<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 11/17/2014
 * Time: 11:03 AM
 */
namespace Api\Output\Mapper\RaceCards\OfficialRating;

class LastRaces extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;
    use \Api\Row\Methods\GetDistanceInFurlong;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            "(dateISO8601)race_datetime" => "race_datetime",
            "race_type_code" => "race_type_code",
            "(setNullIfZero)rp_postmark" => "rp_postmark",
            'course_uid' => 'course_uid',
            "course_name" => "course_name",
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(stringToURLkey)course_name' => 'course_key',
            "course_country" => "course_country",
            "distance_yard" => "distance_yard",
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            "services_desc" => "services_desc",
            "race_outcome_code" => "race_outcome_code",
            "rp_topspeed" => "rp_topspeed",
            "comment" => "comment",
            "no_of_runners_calculated" => "no_of_runners_calculated",
            "official_rating" => "official_rating",
            "race_group_code" => "race_group_code",
        ];
    }
}
