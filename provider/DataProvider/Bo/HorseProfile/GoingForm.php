<?php

namespace Api\DataProvider\Bo\HorseProfile;

use Api\Constants\Horses as Constants;

/**
 * Class GoingForm
 *
 * @package Api\DataProvider\Bo\HorseProfile
 */
class GoingForm extends \Phalcon\Mvc\DataProvider
{
    /**
     * @param array $horseIds
     *
     * @return array
     */
    public function getGoingForm(array $horseIds, $prefix)
    {
        switch ($prefix) {
            case 'detailed':
                $sub = "WHEN ri.going_type_code IN ('HY', 'SH')                 THEN 'heavy'
                        WHEN ri.going_type_code IN ('S', 'VS', 'Y')             THEN 'soft'";
                break;
            default:
                $sub = "WHEN ri.going_type_code IN ('HY', 'SH', 'S', 'VS', 'Y')     THEN 'heavy_soft'";
        }

        $sql = "
        SELECT
            horse_uid
            , going_group
            , rp_postmark
            , race_instance_uid
            , race_datetime
            , course_uid
            , course_name
            , rp_abbrev_3
            , distance_yard
            , race_type_code
            , weight_carried_lbs
            , race_outcome_position
            , race_outcome_form_char
            , no_of_runners = (
                SELECT COUNT(*)
                FROM horse_race
                WHERE race_instance_uid = t.race_instance_uid
                    AND final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . "))
            , rp_topspeed
            , runs = COUNT(*)
            , wins = SUM(win)
        FROM (
            SELECT
                hr.horse_uid
                , win = CASE WHEN ro.race_outcome_position = 1 THEN 1 ELSE 0 END
                , going_group = CASE
                    {$sub}
                    WHEN ri.going_type_code IN ('GS', 'GY')     THEN 'good_to_soft'
                    WHEN ri.going_type_code IN ('G')            THEN 'good'
                    WHEN ri.going_type_code IN ('GF')           THEN 'good_to_firm'
                    WHEN ri.going_type_code IN ('HD', 'F')      THEN 'firm'
                END
                , ro.race_outcome_position
                , ro.race_outcome_form_char
                , hr.rp_postmark
                , hr.rp_topspeed
                , hr.weight_carried_lbs
                , ri.race_type_code
                , ri.race_instance_uid
                , ri.race_datetime
                , ri.distance_yard
                , c.course_uid
                , c.course_name
                , c.rp_abbrev_3
            FROM horse_race hr
            JOIN race_outcome ro ON hr.final_race_outcome_uid = ro.race_outcome_uid
                AND ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
            JOIN race_instance ri ON hr.race_instance_uid = ri.race_instance_uid
            JOIN going_type gt ON gt.going_type_code = ri.going_type_code
            JOIN course c ON c.course_uid = ri.course_uid
            WHERE
                hr.horse_uid IN(:horseUids:)
                AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                AND ri.race_type_code <> " . Constants::RACE_TYPE_P2P . "
            ) t
        WHERE
            going_group IS NOT NULL
        GROUP BY
            horse_uid
            , going_group
        ";

        $result = $this->query($sql, ['horseUids' => $horseIds]);
        $dataSet = $result->toArrayWithRows();

        return $dataSet;
    }
}
