<?php

namespace Api\DataProvider\Bo\OwnerGroups;

use Api\Constants\Horses as Constants;
use Api\DataProvider\HorsesDataProvider;
use Api\Input\Request\Horses\OwnerGroups\DailyStats as Request;

/**
 * Class DailyStats
 *
 * @package Api\DataProvider\Bo\OwnerGroups
 */
class DailyStats extends HorsesDataProvider
{
    /**
     * @param Request $request
     *
     * @return array|null
     */
    public function getData(Request $request): ?array
    {
        $this->execute(
            "IF OBJECT_ID('tempdb..#tt') IS NOT NULL DROP TABLE #tt"
        );

        $sql = "
            SELECT ri.race_datetime AS date, 
                   co.course_name                                           AS course, 
                   co.country_code                                          AS cntry, 
                   ri.distance_yard / 1760                                  AS m, 
                   (ri.distance_yard%1760) / 220                            AS f, 
                   ri.distance_yard%220                                     AS yd, 
                   ri.going_type_code                                       AS going, 
                   ww.horse_name                                            AS winner, 
                   ho.horse_name, 
                   ho.horse_uid, 
                   CASE 
                     WHEN hr.horse_uid = hw.horse_uid THEN 
                     (SELECT dt.distance_value 
                      FROM   dist_to_horse dt 
                     INNER JOIN horse_race hrd 
                             ON hrd.race_instance_uid 
                                = hr.race_instance_uid 
                     INNER JOIN race_outcome rod 
                             ON rod.race_outcome_uid = hrd.final_race_outcome_uid 
                                                            WHERE  rod.race_outcome_uid = 2 
                                                                   AND 
                     hrd.dist_to_horse_in_front_uid = dt.dist_to_horse_uid) 
                     ELSE (SELECT Sum(dtf.distance_value) 
                           FROM   dist_to_horse dtf 
                                  INNER JOIN horse_race hrd 
                                          ON hrd.race_instance_uid = hr.race_instance_uid 
                                  INNER JOIN race_outcome rod 
                                          ON rod.race_outcome_uid = 
                                             hrd.final_race_outcome_uid 
                           WHERE  hrd.dist_to_horse_in_front_uid = dtf.dist_to_horse_uid 
                                  AND rod.race_outcome_position <= ro.race_outcome_position) 
                   END                                                      AS 
                   dist_to_winner, 
                   Datepart(yy, ho.horse_date_of_birth)                     AS yob, 
                   Datediff(yy, ho.horse_date_of_birth, ri.race_datetime)   AS age, 
                   ho.horse_sex_code                                        AS sex, 
                   hs.style_name                                            AS sire, 
                   hd.style_name                                            AS dam, 
                   hr.weight_carried_lbs                                    AS wght_lbs, 
                   hhg.rp_horse_head_gear_code                              AS headgear, 
                   ri.race_instance_title                                   AS title, 
                   rt.race_type_desc                                        AS Code, 
                   rg.race_group_desc                                       AS Type, 
                   ro.race_outcome_desc                                     fin_pos, 
                   rip.prize_euro_gross                                     AS EUROS, 
                   rip.prize_sterling                                       AS STERLING, 
                   ri.winners_time_secs                                     AS time , 
                   ri.winners_time_secs - dat.average_time_sec              AS diff, 
                   jo.jockey_name                                           AS jockey, 
                   tr.trainer_name                                          AS trainer, 
                   hr.official_rating_ran_off                               AS official_or, 
                   hr.rp_postmark                                           AS RPR, 
                   hrc.rp_close_up_comment,  
                   ri.race_datetime 
            INTO   #tt 
            FROM   horse_to_follow ht 
                   INNER JOIN horse ho 
                           ON ho.horse_uid = ht.horse_uid 
                   INNER JOIN horse_race hr 
                           ON hr.horse_uid = ho.horse_uid 
                   LEFT JOIN horse hs 
                          ON hs.horse_uid = ho.sire_uid 
                   LEFT JOIN horse hd 
                          ON hd.horse_uid = ho.dam_uid 
                   LEFT JOIN trainer tr 
                          ON tr.trainer_uid = hr.trainer_uid 
                   LEFT JOIN jockey jo 
                          ON jo.jockey_uid = hr.jockey_uid 
                   LEFT JOIN horse_head_gear hhg 
                          ON hhg.horse_head_gear_uid = hr.horse_head_gear_uid 
                   INNER JOIN race_instance ri 
                           ON ri.race_instance_uid = hr.race_instance_uid 
                   INNER JOIN course co 
                           ON co.course_uid = ri.course_uid 
                   INNER JOIN race_outcome ro 
                           ON ro.race_outcome_uid = hr.final_race_outcome_uid 
                   INNER JOIN race_group rg 
                           ON rg.race_group_uid = ri.race_group_uid 
                   INNER JOIN race_type rt 
                           ON rt.race_type_code = ri.race_type_code 
                   LEFT JOIN race_instance_prize rip 
                          ON rip.race_instance_uid = ri.race_instance_uid 
                             AND rip.position_no = ro.race_outcome_position 
                   LEFT JOIN horse_race_comments hrc 
                          ON hrc.horse_uid = ho.horse_uid 
                             AND hrc.race_instance_uid = ri.race_instance_uid 
                   INNER JOIN horse_race hw 
                           ON hw.race_instance_uid = hr.race_instance_uid 
                              AND hw.final_race_outcome_uid IN (:winnerIds) 
                   INNER JOIN horse ww 
                           ON ww.horse_uid = hw.horse_uid 
                   LEFT JOIN dist_ave_time dat 
                          ON dat.course_uid = ri.course_uid 
                             AND dat.race_type_code = 
                             CASE 
                              WHEN ri.race_type_code = " . Constants::RACE_TYPE_HUNTER_CHASE . " 
                                THEN " . Constants::RACE_TYPE_CHASE_TURF . " 
                                ELSE ri.race_type_code 
                              END 
                             AND dat.distance_yard = ri.distance_yard 
                             AND Isnull(dat.straight_round_jubilee_code, '*') = 
                                 Isnull(ri.straight_round_jubilee_code, '*') 
            WHERE  to_follow_uid = (:coolmoreId)
                   AND ri.race_status_code = (:resultStatus)
                   AND ri.race_datetime > (:dateFrom)
                   AND hr.final_race_outcome_uid NOT IN (:nonRunnerIds) 
            ORDER  BY ri.race_datetime, 
                      co.course_name 
        ";

        $this->execute(
            $sql,
            [
                'dateFrom' => $request->getDate(),
                'nonRunnerIds' => Constants::NON_RUNNER_IDS_ARRAY,
                'resultStatus' => Constants::RACE_STATUS_RESULTS_STR,
                'coolmoreId' => Constants::COOLMORE_HORSE_TO_FOLLOW_ID,
                'winnerIds' => Constants::WINNER_IDS_ARRAY,
            ]
        );

        $result = $this->query("SELECT * FROM #tt");

        return $result->toArrayWithRows('horse_uid');
    }
}
