<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Api\Row\Methods;

trait GetDistanceDescription
{
    /**
     * @param $distance_value       string
     * @param $dtw_count_horse_race integer
     *
     * @return string
     */
    private function getDescription($distance_dsc)
    {
        $textIn = [
            "1/2",
            "1/4",
            "3/4",
            ' ',
        ];
        $textOut = [
            '&frac12;',
            '&frac14;',
            '&frac34;',
            ''
        ];

        $result = trim(str_replace($textIn, $textOut, $distance_dsc));

        return $result;
    }

}
