<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 11/22/2016
 * Time: 1:33 PM
 */

namespace Api\DataProvider\Bo\RaceCards;

use Phalcon\Input\Request\Parameter\Validator\Date;

class TodaysTrainers extends \Phalcon\Mvc\DataProvider
{
    public function getTodaysTrainers()
    {
        $sql = "
            SELECT
                tr.trainer_name
                , tr.style_name
                , tr.trainer_uid
                , ss.trainer_courses
                , ss.trainer_uid
                , ss.wins
                , ss.places
                , ss.runs
                , ss.days_since_win_flat
                , ss.rides_since_win_flat
                , ss.days_since_win_jump
                , ss.rides_since_win_jump
            FROM ss_todays_trainers_newspaper ss
            JOIN trainer tr on tr.trainer_uid = ss.trainer_uid
            ORDER BY tr.search_name, tr.trainer_name
        ";

        $res = $this->query(
            $sql
        );
        return $res->toArrayWithRows();
    }
}
