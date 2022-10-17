<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 11/22/2016
 * Time: 1:29 PM
 */

namespace Api\Output\Mapper\RaceCards;

class TodaysTrainers extends \Api\Output\Mapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'trainer_uid' => 'trainer_uid',
            'trainer_name' => 'trainer_name',
            'style_name' => 'trainer_style_name',
            '(trim)trainer_courses' => 'number_of_runners_today',
            'wins' => 'last14_days.wins',
            'runs' => 'last14_days.runs',
            'places' => 'last14_days.places',
            '(intval)rides_since_win_flat' => 'since_a_win.flat.runs',
            '(intval)days_since_win_flat' => 'since_a_win.flat.days',
            '(intval)rides_since_win_jump' => 'since_a_win.jump.runs',
            '(intval)days_since_win_jump' => 'since_a_win.jump.days',
        ];
    }
}
