<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 2/26/2015
 * Time: 11:07 AM
 */

namespace Tests\Stubs\Models\Bo\RaceMeetings;

class CourseRecords extends \Tests\Stubs\Models\CourseRecords
{
    /**
     * @param int $courseId
     * @param array $raceTypeCodes
     *
     * @return array
     */
    public function getStandardTimesRecords($courseId, array $raceTypeCodes)
    {
        $data = [
            '15,F,X' => [
                \Phalcon\Mvc\Model\Row\General::createFromArray([
                    "race_type_code" => "F",
                    "straight_round_jubilee_code" => null,
                    "race_date" => "Sep 11 2009 12:00AM",
                    "horse_name" => "Sand Vixen",
                    "distance_yards" => 1100,
                    "time_secs" => 58.1,
                    "rp_ages_allowed_desc" => "2yo",
                    "no_of_fences" => null,
                    "average_time_sec" => 57.9
                ]),
                \Phalcon\Mvc\Model\Row\General::createFromArray([
                    "race_type_code" => "F",
                    "straight_round_jubilee_code" => null,
                    "race_date" => "Aug 14 2010 12:00AM",
                    "horse_name" => "Tabaret",
                    "distance_yards" => 1100,
                    "time_secs" => 57.31,
                    "rp_ages_allowed_desc" => "3yo+",
                    "no_of_fences" => null,
                    "average_time_sec" => 57.9
                ]),
                \Phalcon\Mvc\Model\Row\General::createFromArray([
                    "race_type_code" => "F",
                    "straight_round_jubilee_code" => null,
                    "race_date" => "Sep 13 2014 12:00AM",
                    "horse_name" => "Muthmir",
                    "distance_yards" => 1240,
                    "time_secs" => 65.38,
                    "rp_ages_allowed_desc" => "3yo+",
                    "no_of_fences" => null,
                    "average_time_sec" => 66.2
                ]),
            ],
            '15,H,Y,C,U,Z,B,W' => [
                \Phalcon\Mvc\Model\Row\General::createFromArray([
                    "race_type_code" => "C",
                    "straight_round_jubilee_code" => null,
                    "race_date" => "Jan 28 1989 12:00AM",
                    "horse_name" => "Itsgottabealright",
                    "distance_yards" => 3630,
                    "time_secs" => 231.9,
                    "rp_ages_allowed_desc" => "3yo+",
                    "no_of_fences" => 12,
                    "average_time_sec" => 238
                ]),
                \Phalcon\Mvc\Model\Row\General::createFromArray([
                    "race_type_code" => "H",
                    "straight_round_jubilee_code" => null,
                    "race_date" => "Feb 24 1993 12:00AM",
                    "horse_name" => "Good For A Loan",
                    "distance_yards" => 3630,
                    "time_secs" => 226.6,
                    "rp_ages_allowed_desc" => "3yo+",
                    "no_of_fences" => 8,
                    "average_time_sec" => 231
                ]),
            ],
        ];
        $key = $courseId . ',' . implode(',', $raceTypeCodes);
        return $data[$key];
    }
}
