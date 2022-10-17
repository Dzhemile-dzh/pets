<?php

namespace Api\Output\Mapper\Bloodstock\Stallion;

class ProgenyResults extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Output\Mapper\Methods\LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(dateISO8601)race_datetime' => 'race_datetime',
            'race_instance_uid' => 'race_instance_uid',
            'actual_race_class' => 'actual_race_class',
            'course_uid' => 'course_uid',
            'course_name' => 'course_name',
            '(getCourseContinent)country_code' => 'course_region',
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)style_name,country_origin_code' => 'horse_name',
            '(trim)country_code' => 'country_code',
            '(roundNullable)prize_money,2' => 'prize_money',
            '(roundNullable)prize_money_euro,2' => 'prize_money_euro',
            '(GetRaceDescriptionForForm)' => 'race_description',
            '(getDistanceInFurlong)' => 'distance_furlong',
            '(getNoOfRunners)' => 'no_of_runners',
            'race_outcome_position' => 'race_outcome_position',
            '(trim)race_outcome_code' => 'race_outcome_code',
            'official_rating_ran_off' => 'official_rating_ran_off',
            '(getTopSpeed)' => 'rp_topspeed',
            'rp_postmark' => 'rp_postmark',
            'going_type_code' => 'going_type_code',
            'course_rp_abbrev_3' => 'course_rp_abbrev_3'
        ];
    }
}
