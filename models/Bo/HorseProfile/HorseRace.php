<?php

namespace Models\Bo\HorseProfile;

use Api\Constants\Horses as Constants;
use Phalcon\Db\Sql\Builder;
use Phalcon\Mvc\Model\Resultset\ResultsetException;

/**
 * Class HorseRace
 *
 * @package Models\Bo\HorseProfile
 */
class HorseRace extends \Models\HorseRace
{
    /**
     * @param int $horseUid
     * @param $returnP2P
     *
     * @return \Phalcon\Mvc\Model\Resultset\General
     * @throws ResultsetException
     */
    public function getLifetimeRecordsData(int $horseUid, $returnP2P)
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
            SELECT
                ro.race_outcome_position,
                win_prize_sterling = CONVERT(money, isnull(
                    CASE WHEN ro.race_outcome_position = 1
                        THEN CASE WHEN c.country_code = 'IRE'
                            THEN rip.prize_euro_gross / CASE WHEN cc.exchange_rate = 0 THEN 1 ELSE cc.exchange_rate END
                            ELSE rip.prize_sterling END
                        ELSE 0 END, 0)),
                prize_sterling = CONVERT(money, isnull(
                    CASE WHEN c.country_code = 'IRE'
                        THEN rip.prize_euro_gross / CASE WHEN cc.exchange_rate = 0 THEN 1 ELSE cc.exchange_rate END
                        ELSE rip.prize_sterling END, 0)),
                net_win_prize = CONVERT(money, isnull(
                    CASE WHEN ro.race_outcome_position = 1
                    THEN rip.prize_sterling
                    ELSE 0
                    END, 0)),
                net_total_prize = rip.prize_sterling,
                win_prize_euro = isnull(
                    CASE WHEN c.country_code = 'IRE' AND ro.race_outcome_position = 1
                        THEN rip.prize_euro_gross
                        ELSE 0 END, 0),
                prize_euro = isnull(CASE WHEN c.country_code = 'IRE'
                        THEN rip.prize_euro_gross END, 0),
                usd_win_prize = CONVERT(money, isnull(
                    CASE WHEN ro.race_outcome_position = 1
                        THEN rip.prize_sterling * cc_usd.exchange_rate
                        ELSE 0
                    END, 0)),
                usd_total_prize = CONVERT(money, isnull(rip.prize_sterling * cc_usd.exchange_rate, 0)),                        
                hr.rp_topspeed,
                hr.rp_postmark,
                rh.current_official_turf_rating,
                rh.current_official_aw_rating,
                rh.current_official_rating_hurdle,
                rh.current_official_rating_chase,
                ri.race_type_code,
                ri.race_group_uid,
                ri.race_datetime,
                c.country_code,
                stake = (
                    CASE WHEN ro.race_outcome_position = 1 THEN
                        CASE WHEN hr.final_race_outcome_uid = 71
                            THEN (o.odds_value / 2) - 0.50
                            ELSE o.odds_value END
                        ELSE - 1
                    END)
            FROM horse_race hr
                JOIN race_instance ri ON hr.race_instance_uid = ri.race_instance_uid
                JOIN course c ON ri.course_uid = c.course_uid
                JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
                    AND ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_AND_VOID_CODES . ")
                JOIN season s ON ri.race_datetime BETWEEN s.season_start_date AND s.season_end_date
                    AND s.season_type_code = (
                        CASE WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ") 
                            THEN '" . Constants::SEASON_TYPE_CODE_FLAT . "'
                            ELSE CASE 
                                WHEN c.country_code = 'IRE' 
                                THEN '" . Constants::SEASON_TYPE_CODE_JUMPS_IRE . "'
                                ELSE '" . Constants::SEASON_TYPE_CODE_JUMPS . "'
                            END
                        END)
                LEFT JOIN racing_horse rh ON rh.horse_uid = hr.horse_uid
                LEFT JOIN race_instance_prize rip ON rip.race_instance_uid = hr.race_instance_uid
                    AND rip.position_no = ro.race_outcome_position
                LEFT JOIN odds o ON hr.starting_price_odds_uid = o.odds_uid
                LEFT JOIN country_currencies cc ON cc.country_code = 'EUR'
                    AND year(ri.race_datetime) = cc.year
                LEFT JOIN country_currencies cc_usd ON cc_usd.country_code = 'USA'
                    AND year(ri.race_datetime) = cc_usd.year
            WHERE
                hr.horse_uid = :horseUid
                AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                /*{WHERE}*/
            PLAN '(use optgoal allrows_dss)(use merge_join off)(nl_join (i_scan hr)(i_scan ri))'
        ");

        if (!$returnP2P) {
            $builder->where("AND ri.race_type_code != " . Constants::RACE_TYPE_P2P);
        }

        $builder->setParam('horseUid', $horseUid);

        $builder->build();

        $res = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        return new \Phalcon\Mvc\Model\Resultset\General(null, new \Api\Row\HorseRace(), $res);
    }

    /**
     * @param int $horseUid
     * @param $returnP2P
     *
     * @return \Phalcon\Mvc\Model\Resultset\General
     * @throws ResultsetException
     */
    public function getHorseRacesForPlacings(int $horseUid, $returnP2P)
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
            SELECT
                race_outcome.race_outcome_position,
                race_outcome.race_outcome_form_char,
                race_instance.race_type_code,
                race_instance.race_datetime,
                disqualification.disqualification_desc,
                season.season_start_date
            FROM horse_race
            JOIN race_instance ON horse_race.race_instance_uid = race_instance.race_instance_uid
            JOIN course ON race_instance.course_uid = course.course_uid
            JOIN race_outcome ON race_outcome.race_outcome_uid = horse_race.final_race_outcome_uid
                AND race_outcome.race_outcome_code NOT IN (" . Constants::NON_RUNNER_AND_VOID_CODES . ")
            JOIN season ON
                season.season_start_date <= race_instance.race_datetime AND
                season.season_end_date >= race_instance.race_datetime AND
                season.season_type_code = (
                    CASE 
                        WHEN race_instance.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                        THEN '" . Constants::SEASON_TYPE_CODE_FLAT . "'
                        ELSE '" . Constants::SEASON_TYPE_CODE_JUMPS . "'
                    END
                )
            LEFT JOIN disqualification ON disqualification.disqualification_uid = horse_race.disqualification_uid
            WHERE
                horse_race.horse_uid = :horseUid
                AND race_instance.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                /*{WHERE}*/
            ORDER BY race_instance.race_datetime DESC
        ");

        if (!$returnP2P) {
            $builder->where("AND race_instance.race_type_code != " . Constants::RACE_TYPE_P2P);
        }

        $builder->setParam('horseUid', $horseUid);

        $builder->build();

        $res = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        return new \Phalcon\Mvc\Model\Resultset\General(null, new \Api\Row\HorseRace(), $res);
    }

    /**
     * @param array $jockeyIds
     *
     * @return array
     * @throws ResultsetException
     */
    public function getJockeyStats14Days(array $jockeyIds)
    {
        $sql = "
            SELECT
                hr.jockey_uid,
                runs = COUNT(*),
                wins = ISNULL(SUM(CASE WHEN hr.final_race_outcome_uid IN (1,71) THEN 1 ELSE 0 END),0)
            FROM
                race_instance ri
                , horse_race hr
            WHERE
                hr.race_instance_uid = ri.race_instance_uid
                AND hr.jockey_uid IN (:jockeyIds)
                AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                AND ri.race_datetime > DATEADD(DAY, - 14, GETDATE())
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
            GROUP BY hr.jockey_uid
            PLAN '(use optgoal allrows_dss)'
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            ['jockeyIds' => $jockeyIds]
        );

        $stats = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\Horse\Entries(),
            $res
        );

        return $stats->toArrayWithRows('jockey_uid');
    }

    /**
     * @throws ResultsetException
     */
    public function getSurfaceRecordsRunsWins(int $horseUid, $returnP2P): array
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
                    SELECT t.surface_desc, t.surface_code , MAX(runs) AS runs, MAX(wins) AS wins
                    FROM (
                            SELECT
                                sl.*,
                                COUNT(hr.horse_uid) runs,
                                SUM(CASE WHEN ro.race_outcome_position = 1 THEN 1 ELSE 0 END) wins
                            FROM race_attrib_lookup ral 
                            JOIN race_attrib_join raj ON raj.race_attrib_uid = ral.race_attrib_uid
                            JOIN horse_race hr ON hr.race_instance_uid = raj.race_instance_uid
                            JOIN surface_lookup sl ON sl.surface_desc = ral.race_attrib_desc
                            JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
                            JOIN race_instance ri ON ri.race_instance_uid = hr.race_instance_uid
                            WHERE ral.race_attrib_code = 'Surface'
                            AND hr.horse_uid = :horseUid
                            /*{WHERE}*/ 
                            GROUP BY sl.surface_code 
                            UNION ALL
                            SELECT 
                                sl.*,
                                runs = null,
                                SUM(CASE WHEN ro.race_outcome_position = 1 THEN 1 ELSE 0 END) wins
                            FROM race_attrib_lookup ral 
                            JOIN race_attrib_join raj ON raj.race_attrib_uid = ral.race_attrib_uid
                            JOIN horse_race hr ON hr.race_instance_uid = raj.race_instance_uid
                            JOIN surface_lookup sl ON sl.surface_desc = ral.race_attrib_desc
                            JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
                            JOIN race_instance ri ON ri.race_instance_uid = hr.race_instance_uid
                            WHERE ral.race_attrib_code = 'Surface'
                            AND hr.horse_uid = :horseUid
                            AND sl.surface_desc != ral.race_attrib_desc ) AS t 
                    GROUP by t.surface_desc,t.surface_code
                    ORDER BY t.surface_code 
        ");

        if (!$returnP2P) {
            $builder->where("ri.race_type_code != " . Constants::RACE_TYPE_P2P);
        }

        $builder->setParam('horseUid', $horseUid);

        $builder->build();

        $res = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return $result->toArrayWithRows();
    }


    /**
     * @param int $horseId
     *
     * @return array
     * @throws ResultsetException
     */
    public function getPreviousTrainers(int $horseId)
    {
        $sql = "
                SELECT
                    ht.trainer_uid
                    , ht.trainer_change_date
                    , trainer_style_name = t.style_name 
                    , trainer_search_name = t.mirror_name 
                    , trainer_ptp_type_code = t.ptp_type_code
                FROM horse_trainer ht
                LEFT JOIN trainer t ON t.trainer_uid = ht.trainer_uid
                WHERE
                  ht.horse_uid = :horseId
                  AND ht.trainer_change_date > '1900'
                ORDER BY
                  ht.trainer_change_date DESC
              ";

        $res = $this->getReadConnection()->query(
            $sql,
            ['horseId' => $horseId]
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return $result->toArrayWithRows();
    }

    /**
     * @param int $horseId
     *
     * @return array
     * @throws ResultsetException
     */
    public function getPreviousOwners(int $horseId)
    {
        $sql = "
                SELECT TOP 5
                    ho.owner_uid
                    , ho.owner_change_date
                    , owner_style_name = o.style_name 
                    , owner_search_name = o.search_name
                    , owner_ptp_type_code = o.ptp_type_code
                FROM
                    horse_owner ho
                    LEFT JOIN owner o ON o.owner_uid = ho.owner_uid
                WHERE
                    ho.horse_uid = :horseId
                    AND ho.owner_change_date > '1900-01-01 00:00:00.0'
                ORDER BY
                    ho.owner_change_date DESC
              ";

        $res = $this->getReadConnection()->query(
            $sql,
            ['horseId' => $horseId]
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return $result->toArrayWithRows();
    }
}
