<?php

namespace Api\DataProvider\Bo\Results;

/**
 * Class PastWinners
 *
 * @package Api\DataProvider\Bo\Results
 */
class PastWinners extends \Phalcon\Mvc\DataProvider
{
    /**
     * @param $raceIds
     *
     * @return array
     */
    public function getPastWinners($raceIds)
    {
        if (empty($raceIds)) {
            throw new InternalServerError(3);
        }

        $ageSql = $this->getDI()->getShared('selectors')->getHorseAgeSQL(
            'h.horse_date_of_birth',
            'h.country_origin_code',
            'ri.race_datetime'
        );

        $sql = "
            SELECT 
                ri.race_datetime,
                ri.race_instance_uid,
                ri.lst_yr_race_instance_uid,
                hr.weight_carried_lbs,
                hr.rp_postmark,
                hr.weight_allowance_lbs,
                hr.draw,
                o.odds_desc,
                horse_style_name = h.style_name,
                h.country_origin_code,
                h.horse_uid,
                horse_age = {$ageSql},
                trainer_style_name = t.style_name,
                t.trainer_uid,
                jockey_style_name = j.style_name,
                j.jockey_uid,
                c.course_uid,
                c.course_name
            FROM race_instance ri
                INNER JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
                INNER JOIN horse h ON h.horse_uid = hr.horse_uid
                INNER JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
                    AND ro.race_outcome_code = '1'
                LEFT JOIN trainer t ON t.trainer_uid = hr.trainer_uid
                LEFT JOIN odds o ON o.odds_uid = hr.starting_price_odds_uid
                LEFT JOIN jockey j ON j.jockey_uid = hr.jockey_uid
                LEFT JOIN course c ON c.course_uid = ri.course_uid
            WHERE
                ri.race_instance_uid IN (:raceIds)
            ORDER BY ri.race_datetime DESC, h.style_name
        ";

        $res = $this->query(
            $sql,
            [
                'raceIds' => $raceIds
            ]
        );

        return $res->toArrayWithRows();
    }
}
