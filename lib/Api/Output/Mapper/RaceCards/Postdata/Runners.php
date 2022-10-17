<?php
/**
 * Created by PhpStorm.
 * User: oleg_symonchuk
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\RaceCards\Postdata;

class Runners extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)style_name,country_origin_code' => 'horse_name',
            '(setNullIfZero)rp_postmark' => 'rp_postmark',
            'num_topspeed_best_rating' => 'num_topspeed_best_rating',
            'official_rating' => 'official_rating',
            'official_rating_today' => 'official_rating_today',
            'trainer_form_output' => 'trainer_form_output',
            'going_output' => 'going_output',
            'distance_output' => 'distance_output',
            'course_output' => 'course_output',
            'draw_output' => 'draw_output',
            'ability_output' => 'ability_output',
            'recent_form_output' => 'recent_form_output',
            'saddle_cloth_no' => 'start_number',
            'lh_weight_carried_lbs' => 'lh_weight_carried_lbs',
            'out_of_handicap' => 'out_of_handicap',
            'trainer_record_output' => 'trainer_record_output',
            'jockey_no_wins_flag' => 'jockey_no_wins_flag',
            'group_race' => 'group_race',
        ];
    }
}
