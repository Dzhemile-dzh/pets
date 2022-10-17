<?php

namespace Models\Bo\RaceCards;

use \Api\Constants\Horses as Constants;

/**
 * Class PreHorseRace
 *
 * @package Models\Bo\RaceCards
 */
class PreHorseRace extends \Models\PreHorseRace
{
    /**
     * @param $raceId
     * @param \Models\Selectors $selectors
     * @return array
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getTopspeedHorses($raceId, \Models\Selectors $selectors)
    {

        $ageSql = $selectors->getHorseAgeSQL(
            'horse.horse_date_of_birth',
            'horse.country_origin_code',
            'race_instance.race_datetime'
        );

        $sql = "
            SELECT
                horse.style_name AS horse_style_name,
                horse.country_origin_code AS horse_country_origin_code,
                pre_horse_race.weight_carried_lbs,
                race_instance.race_status_code,
                race_instance.race_type_code,
                horse.horse_uid,
                horse_age = %s,
                pre_horse_race.rp_topspeed - pre_rfu_horse_stats.wfa_allow AS rp_topspeed_old,
                postdata_results_new.num_topspeed_best_rating rp_topspeed,
                pre_horse_race.rp_postmark,
                pre_horse_race.rp_pm_chars,
                race_instance.race_datetime,
                pre_rfu_horse_stats.adjustment,
                isnull(pre_rfu_horse_stats.wfa_allow,0) as wfa_allow,
                isnull(pre_rfu_horse_stats.topspeed_wfa_allow,0) as topspeed_wfa_allow,
                course.country_code,
                course.course_name,
                course.course_uid,
                going_type.rp_going_type_desc,
                race_instance.distance_yard,
                race_group.race_group_code,
                pre_horse_race.extra_weight_lbs,
                ht.trainer_uid,
                race_instance.race_instance_uid
            FROM pre_horse_race
            JOIN race_instance ON
                race_instance.race_instance_uid = pre_horse_race.race_instance_uid
                AND pre_horse_race.race_status_code = (
                    CASE 
                        WHEN race_instance.race_status_code = " . Constants::RACE_STATUS_RESULTS . " 
                        THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                        ELSE race_instance.race_status_code 
                    END
                    )
            JOIN horse ON horse.horse_uid = pre_horse_race.horse_uid
            LEFT JOIN horse_trainer ht ON ht.horse_uid = horse.horse_uid
                AND  ht.trainer_change_date = '" . Constants::EMPTY_DATE ."' 
            LEFT JOIN going_type ON going_type.going_type_code = race_instance.going_type_code
            JOIN course ON course.course_uid = race_instance.course_uid
            LEFT JOIN pre_rfu_horse_stats ON
                pre_rfu_horse_stats.race_instance_uid = pre_horse_race.race_instance_uid
                AND pre_rfu_horse_stats.horse_uid = pre_horse_race.horse_uid
            LEFT JOIN postdata_results_new ON
                postdata_results_new.race_instance_uid = pre_horse_race.race_instance_uid
                AND postdata_results_new.horse_uid = pre_horse_race.horse_uid
            LEFT JOIN race_group ON
                race_instance.race_group_uid = race_group.race_group_uid

            WHERE
                pre_horse_race.race_instance_uid = :raceId:

            ORDER BY
                postdata_results_new.num_topspeed_best_rating DESC,
                pre_horse_race.saddle_cloth_no
        ";

        $res = $this->getReadConnection()->query(
            sprintf($sql, $ageSql),
            [
                'raceId' => $raceId,
            ]
        );

        $collection = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\HorseRace(),
            $res
        );

        return $collection->toArrayWithRows();
    }
}
