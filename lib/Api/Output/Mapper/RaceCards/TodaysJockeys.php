<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 11/22/2016
 * Time: 1:29 PM
 */

namespace Api\Output\Mapper\RaceCards;

class TodaysJockeys extends \Api\Output\Mapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'jockey_uid' => 'jockey_uid',
            'style_name' => 'jockey_name',
            'jockey_low_wt_st' => 'lowest_riding_weight_stone',
            'jockey_low_wt_lb' => 'lowest_riding_weight_pounds',
            '(trim)jockey_courses' => 'course_and_rides_today',
            '(boolval)jockey_type' => 'apprentice_conditional',
            'wins' => 'season.wins',
            'runs' => 'season.runs',
            'strike_rate' => 'season.strike_rate',
            '(intval)rides_since_win' => 'since_a_win.rides_since_win',
            '(intval)days_since_win' => 'since_a_win.days_since_win',
        ];
    }
}
