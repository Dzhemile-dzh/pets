<?php

namespace Api\Output\Mapper\RaceCards;

class PastWinners extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'course_uid' => 'course_uid',
            '(stringToURLkey)course_name' => 'course_key',
            '(trim)course_name' => 'course_name',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'race_instance_uid' => 'race_instance_uid',
            'lst_yr_race_instance_uid' => 'lst_yr_race_instance_uid',
            '(setNullIfZero)weight_carried_lbs' => 'weight_carried_lbs',
            'weight_allowance_lbs' => 'weight_allowance_lbs',
            'draw' => 'draw',
            '(setNullIfZero)rp_postmark' => 'rp_postmark',
            'odds_desc' => 'odds_desc',
            '(fixAroHorseName)horse_style_name,country_origin_code' => 'horse_style_name',
            'country_origin_code' => 'country_origin_code',
            'horse_id' => 'horse_id',
            'age' => 'age',
            'trainer_style_name' => 'trainer_style_name',
            'trainer_uid' => 'trainer_uid',
            'jockey_style_name' => 'jockey_style_name',
            'jockey_uid' => 'jockey_uid',
        ];
    }
}
