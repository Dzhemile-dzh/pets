<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 11/22/2016
 * Time: 1:33 PM
 */

namespace Api\DataProvider\Bo\RaceCards;

class TodaysJockeys extends \Phalcon\Mvc\DataProvider
{
    public function getTodaysJockeys()
    {
        $sql = "
            SELECT
                ss.jockey_type
                , j.style_name
                , j.jockey_uid
                , ss.jockey_low_wt_st
                , ss.jockey_low_wt_lb
                , ss.jockey_courses
                , ss.wins
                , ss.runs
                , ss.strike_rate
                , ss.days_since_win
                , ss.rides_since_win
            FROM ss_todays_jockeys_newspaper ss
            JOIN jockey j on j.jockey_uid = ss.jockey_uid
            ORDER BY j.search_name, j.jockey_name
        ";

        $res = $this->query(
            $sql
        );
        return $res->toArrayWithRows();
    }
}
