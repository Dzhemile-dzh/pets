<?php

declare(strict_types=1);

namespace Api\DataProvider\Bo\Native\Competitor;

use \Api\DataProvider\HorsesDataProvider;
use \Api\Input\Request\Horses\Native\Competitor\CompetitorDetails as Request;
use \Phalcon\Db\Sql\Builder;
use \Phalcon\Mvc\DataProvider;
use \Phalcon\Mvc\Model\Row;
use \Api\Row\RaceInstance as RiRow;
use \Api\Constants\Horses as Constants;
use PHPUnit\Framework\Constraint\Constraint;

/**
 * Class CompetitorDetails
 * @package Api\DataProvider\Bo\Native\Competitor
 */
class CompetitorDetails extends HorsesDataProvider
{
    /**
     * @param int $raceId
     *
     * @return bool
     */
    public function isRaceExists(int $raceId): bool
    {
        $sql = "SELECT 1 FROM race_instance ri WHERE ri.race_instance_uid = :raceId";
        $res = $this->query(
            $sql,
            ['raceId' => $raceId]
        );
        return ($res->count() > 0);
    }


    /**
     * @param int $horseId
     *
     * @return bool
     */
    public function isHorseExists(int $horseId): bool
    {
        $sql = "SELECT 1 FROM horse h WHERE h.horse_uid = :horseId";
        $res = $this->query(
            $sql,
            ['horseId' => $horseId]
        );
        return ($res->count() > 0);
    }

    /**
     * @param int $horseId
     * @param int $raceId
     *
     * @return bool
     */
    public function isHorseExistsInRace(int $horseId, int $raceId): bool
    {
        $sql = "SELECT 1 FROM pre_horse_race phr WHERE phr.horse_uid = :horseId AND phr.race_instance_uid = :raceId";
        $res = $this->query(
            $sql,
            ['horseId' => $horseId,
            'raceId' => $raceId]
        );
        return ($res->count() > 0);
    }


    /**
     * @param int $raceId
     *
     * @return RiRow|null
     *
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getCourseDetails(int $raceId): ?RiRow
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
            SELECT course_name 
            FROM race_instance ri
                JOIN course c ON c.course_uid = ri.course_uid
            WHERE
                ri.race_instance_uid = :raceId
        ");

        $builder->setParam('raceId', $raceId);

        $builder->setRow(new RiRow());

        $rtn = $this->queryBuilder($builder);

        return $rtn->getFirst() ?: null;
    }


    /**
     * @param int $horseId
     * @param int $raceId
     * @return Row|null
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getCompetitorDetails(int $horseId, int $raceId): ?Row
    {
        $builder = new Builder();

        $selectors = $this->getDI()->get('selectors');

        $ageSql = $selectors->getHorseAgeSQL(
            'h.horse_date_of_birth',
            'h.country_origin_code',
            'ri.race_datetime'
        );


        $furlongsSql = "
            CASE
                WHEN ROUND(CONVERT(FLOAT, ri.distance_yard) / 220, 0) < 6 THEN 5
                WHEN ROUND(CONVERT(FLOAT, ri.distance_yard) / 220, 0) = 17 THEN 16
                WHEN ROUND(CONVERT(FLOAT, ri.distance_yard) / 220, 0) = 19 THEN 18
                WHEN ROUND(CONVERT(FLOAT, ri.distance_yard) / 220, 0) > 19 THEN 20
                ELSE ROUND(CONVERT(FLOAT, ri.distance_yard) / 220, 0)
            END
        ";

        $builder->setSqlTemplate("
            SELECT
                t.trainer_uid,
                t.style_name as trainer_name,
                ri.race_instance_uid,
                c.country_code as course_country,

                o.owner_uid,
                o.style_name as owner_name,
                ri.race_status_code,
                ri.race_type_code,
                ri.race_datetime,
                ri.course_uid,
                ri.distance_yard,
                non_runner = CASE WHEN hr.final_race_outcome_uid IN  (" . Constants::NON_RUNNER_IDS . ") 
                                THEN 1 ELSE NULL END,
                race_type = CASE
                    WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                        THEN '" . Constants::RACE_TYPE_FLAT_ALIAS . "'
                    WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_JUMPS . ")
                        THEN '" . Constants::RACE_TYPE_JUMPS_ALIAS . "'
                END,

                h.horse_uid AS competitor_id,
                h.style_name AS competitor_name,
                h.horse_sex_code AS competitor_horse_sex_code,
                h.country_origin_code as horse_country_code,
                hc.rp_newspaper_output_desc AS competitor_horse_colour_code,
                h.horse_date_of_birth,
                h.horse_date_of_death,
                competitor_horse_age = {$ageSql},
                furlong = {$furlongsSql},
                saddle_cloth_no = CASE WHEN hr.saddle_cloth_no IS NULL THEN phr.saddle_cloth_no ELSE hr.saddle_cloth_no END,
                days_since_run = NULL,
                course_wins = NULL,
                distance_wins = NULL,
                course_and_distance_wins = NULL,
                beaten_favourite = 'N',
                tips_qty = null,
                reserve = phr.irish_reserve_yn,
                j_style_name = j.style_name,
                jp_style_name = jp.style_name,
                j_jockey_uid = j.jockey_uid,
                jp_jockey_uid = jp.jockey_uid,
                rp_postmark = phr.rp_postmark,
                
                b.style_name as breeder_name,

                rhc.rp_form_text,

                h_sire.horse_name,
                h_sire.country_origin_code,
                h_dam.horse_name, 
                h_dam.country_origin_code,

                h_sire.style_name AS sire_name,
                h_sire.country_origin_code AS sire_country_origin_code,
                s.avg_flat_win_dist_of_progeny AS sire_avg_flat_win_dist_of_progeny,
                h_dam.style_name AS dam_name,
                h_dam.country_origin_code AS dam_country_origin_code,
                h_dam_sire.style_name AS dam_sire_name,
                h_dam_sire.country_origin_code AS dam_sire_country_origin_code,
                ds.avg_flat_win_dist_of_progeny AS dam_sire_avg_flat_win_dist_of_progeny,
                comment = CASE WHEN EXISTS (
                        SELECT 1 FROM race_content_publish_time rcpt
                        WHERE rcpt.race_content_publish_race_uid = phrg.race_instance_uid
                        AND rcpt.race_content_publish_time <= GETDATE()
                        AND rcpt.race_content_type_uid = " . Constants::RACE_CONTENT_TYPE_TIPSTERS_VERDICTS . "
                    )
                    THEN phrg.varchar_255 ELSE NULL END ,
                CASE WHEN hr.extra_weight_lbs IS NOT NULL 
                        THEN hr.extra_weight_lbs ELSE phr.extra_weight_lbs 
                     END extra_weight_lbs,
                weight_carried_lbs = CASE WHEN hr.weight_carried_lbs IS NULL THEN phr.weight_carried_lbs ELSE hr.weight_carried_lbs END
            FROM race_instance ri
                LEFT JOIN pre_horse_race phr
                    ON phr.race_instance_uid = ri.race_instance_uid 
                        AND phr.horse_uid = :horseId
                        AND phr.race_status_code = (
                            CASE
                                WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                                    THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                                ELSE ri.race_status_code
                                END
                            )
                LEFT JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid AND hr.horse_uid = phr.horse_uid
                LEFT JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
                LEFT JOIN horse h ON h.horse_uid = phr.horse_uid
                LEFT JOIN horse_owner ho ON (ho.horse_uid = h.horse_uid) 
                    AND ISNULL(ho.owner_change_date,  '". Constants::EMPTY_DATE_AND_TIME . "') = '". Constants::EMPTY_DATE_AND_TIME . "'
                LEFT JOIN owner o ON o.owner_uid = ho.owner_uid
                LEFT JOIN horse_colour hc ON hc.horse_colour_code=h.horse_colour_code

                LEFT JOIN horse_trainer ht ON (ht.horse_uid = h.horse_uid)
                    AND ISNULL(ht.trainer_change_date,  '". Constants::EMPTY_DATE_AND_TIME . "') = '". Constants::EMPTY_DATE_AND_TIME . "'
                LEFT JOIN trainer t ON t.trainer_uid = ht.trainer_uid

                LEFT JOIN racing_horse_comments rhc ON rhc.horse_uid = h.horse_uid

                LEFT JOIN course c ON c.course_uid = ri.course_uid

                LEFT JOIN jockey j ON j.jockey_uid = hr.jockey_uid
                LEFT JOIN jockey jp ON jp.jockey_uid = phr.jockey_uid

                LEFT JOIN breeder b ON b.breeder_uid = h.breeder_uid

                LEFT JOIN sire s on h.sire_uid = s.sire_uid
                LEFT JOIN horse h_sire ON h.sire_uid = h_sire.horse_uid
                LEFT JOIN dam d on h.dam_uid = d.dam_uid
                LEFT JOIN horse h_dam ON h.dam_uid = h_dam.horse_uid
                LEFT JOIN horse h_dam_sire ON h_dam.sire_uid = h_dam_sire.horse_uid
                LEFT JOIN sire ds on h_dam.sire_uid = ds.sire_uid

                LEFT JOIN fast_race_instance fri ON fri.race_datetime = ri.race_datetime
                LEFT JOIN pre_horse_race_genlkup phrg
                    ON phrg.horse_uid = h.horse_uid
                        AND phrg.race_instance_uid = ri.race_instance_uid
                

            WHERE
                h.horse_uid = :horseId
                AND ri.race_instance_uid = :raceId
            PLAN '(use optgoal allrows_dss)'
        ");

        $builder->setParam('horseId', $horseId);
        $builder->setParam('raceId', $raceId);

        $rtn = $this->queryBuilder($builder);
        
        return $rtn->getFirst() ?: null;
    }


    /**
     * @param int $horseId
     * @param string $raceDate
     * @return array
     */
    public function getCompetitorResults(int $horseId, string $raceDate): array
    {
        $raceClassTableName = '#raceClassTable';
        $this->createTmpRaceClassTable($raceClassTableName, $horseId);
        $builder = new Builder();

        $builder->setSqlTemplate("
            SELECT
                ri.race_instance_uid,
                ri.race_datetime,
                rt.race_type_code,
                c.rp_abbrev_3,
                c.country_code,
                hr.weight_carried_lbs,
                ri.distance_yard,
                gt.services_desc as going_type_code,
                hr.official_rating_ran_off,
                hr.final_race_outcome_uid,
                ri.no_of_runners,
                odds.odds_desc,
                hr.rp_postmark,
                hr.rp_topspeed,
                ro.race_outcome_code,
                no_of_runners_calculated = (
                    SELECT COUNT(1) FROM horse_race hr1
                    WHERE
                        hr1.race_instance_uid = ri.race_instance_uid
                        AND hr1.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                ),
                actual_race_class = race_class.race_attrib_desc,
                raceOR = CASE
                            WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT_TURF . ")
                            THEN rh.current_official_turf_rating
                            WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_CHASE . ")
                            THEN rh.current_official_rating_chase
                            WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_HURDLE . ")
                            THEN rh.current_official_rating_hurdle
                            WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT_AW . ")
                            THEN rh.current_official_aw_rating
                         END,
                rip.prize_sterling as earnings,
                ri.race_group_uid
            FROM horse_race hr
                JOIN horse h ON h.horse_uid = hr.horse_uid
                JOIN race_instance ri ON hr.race_instance_uid = ri.race_instance_uid
                JOIN course c ON c.course_uid = ri.course_uid
                JOIN race_outcome ro ON hr.race_outcome_uid = ro.race_outcome_uid
                LEFT JOIN race_type rt ON rt.race_type_code = ri.race_type_code
                LEFT JOIN odds ON odds.odds_uid = hr.starting_price_odds_uid
                LEFT JOIN going_type gt ON ri.going_type_code = gt.going_type_code
                LEFT JOIN racing_horse rh ON rh.horse_uid = hr.horse_uid
                LEFT JOIN race_instance_prize rip ON rip.position_no = ro.race_outcome_position
                                                AND  rip.race_instance_uid = hr.race_instance_uid
                                                AND ro.race_outcome_uid = hr.final_race_outcome_uid
                                                AND hr.final_race_outcome_uid IN (" . Constants::WINNER_IDS . ")
                LEFT JOIN {$raceClassTableName} race_class ON race_class.race_instance_uid = ri.race_instance_uid
                                    AND (
                                            (c.country_code = '" . Constants::COUNTRY_GB . "' 
                                                AND race_class.race_attrib_code = " . Constants::RACE_CLASS_SUB . "
                                            )
                                        )
            WHERE h.horse_uid = :horseId
             AND ri.race_datetime < :raceDate
             AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
            ORDER BY ri.race_datetime DESC
            PLAN '(use optgoal allrows_dss)'
        ");

        $builder->setParam('horseId', $horseId);
        $builder->setParam('raceDate', $raceDate);

        $builder->build();

        $rtn = $this->query($builder->getSql(), $builder->getParams());

        $result = $rtn->toArrayWithRows();

        $this->dropTmpTable($raceClassTableName);

        return $result;
    }

    public function createTmpRaceClassTable($tableName, $horseId)
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
                SELECT ral.race_attrib_code,
                       raj.race_instance_uid,
                       ral.race_attrib_desc
                INTO {$tableName}
                FROM race_attrib_join raj
                   JOIN race_attrib_lookup ral ON raj.race_attrib_uid = ral.race_attrib_uid
                   JOIN horse_race hr ON hr.race_instance_uid = raj.race_instance_uid
                WHERE hr.horse_uid = :horseId
                AND ral.race_attrib_desc IS NOT NULL
                AND ral.race_attrib_code IN (" . Constants::RACE_CLASS_SUB . ", " . Constants::RACE_CLASS . ")");

        $builder->setParam('horseId', $horseId);

        $this->executeBuilder($builder);
    }

    /**
     * @param string $tableName
     */
    private function dropTmpTable(string $tableName)
    {
        $sql = "
            IF OBJECT_ID('{$tableName}') IS NOT NULL
            DROP TABLE {$tableName}
        ";
        $this->execute($sql);
    }

    public function getJockeyInfo(int $jockeyId)
    {
        $builder = new Builder();

        $builder->setSqlTemplate("

            SELECT
                j.jockey_uid,
                SUM(CASE WHEN hr.final_race_outcome_uid IN (1,71) THEN 1 ELSE 0 END) wins,
                COUNT(t.trainer_uid) runs,
                SUM(CASE WHEN hr.final_race_outcome_uid IN (1,71) THEN o.odds_value ELSE -1 END) profit
            FROM race_instance ri
            JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
            JOIN horse h ON h.horse_uid = hr.horse_uid
            JOIN jockey j ON j.jockey_uid = hr.jockey_uid
            JOIN course c ON c.course_uid = ri.course_uid
            JOIN trainer t ON t.trainer_uid = hr.trainer_uid
            JOIN race_outcome ro ON ro.race_outcome_uid=hr.race_outcome_uid
            JOIN race_outcome ro2 ON ro2.race_outcome_uid=hr.final_race_outcome_uid
            LEFT JOIN odds o ON o.odds_uid = hr.starting_price_odds_uid
            WHERE
                hr.jockey_uid = :jockeyId
                AND ri.race_datetime BETWEEN  dateadd(day,-14,current_date()) AND current_date()
                AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
             GROUP BY j.jockey_uid
        ");

        $builder->setParam('jockeyId', $jockeyId);

        $builder->build();

        $data = $this->query(
            $builder->getSql(),
            $builder->getParams()
        );

        return $data->getFirst() ?: null;
    }

    /**
     *
     * @param int $horseId
     * @param string $raceDate
     *
     * @return arrow
     *
     */
    public function getWinningRaces(int $horseId, string $raceDate) : ?array
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
                SELECT ri_c.distance_yard,ri_c.course_uid
                 FROM horse_race hr_c
                    LEFT JOIN race_instance ri_c ON hr_c.race_instance_uid = ri_c.race_instance_uid
                  WHERE hr_c.final_race_outcome_uid IN (" . Constants::WINNER_IDS . ")
                                  AND ri_c.race_datetime <:raceDate
                                  AND hr_c.horse_uid = :horseId
        ");

        $builder->setParam('horseId', $horseId);
        $builder->setParam('raceDate', $raceDate);

        $builder->build();

        $data = $this->query(
            $builder->getSql(),
            $builder->getParams()
        );


        return $data->count() > 0 ? $data->toArrayWithRows() : null;
    }

    public function getTrainerInfo(int $trainerId)
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
            SELECT
                t.trainer_uid,
                SUM(CASE WHEN hr.final_race_outcome_uid IN (1,71) THEN 1 ELSE 0 END) wins,
                COUNT(t.trainer_uid) runs,
                SUM(CASE WHEN hr.final_race_outcome_uid IN (1,71) THEN o.odds_value ELSE -1 END) profit
            FROM race_instance ri
            JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
            JOIN horse h ON h.horse_uid = hr.horse_uid
            JOIN jockey j ON j.jockey_uid = hr.jockey_uid
            JOIN course c ON c.course_uid = ri.course_uid
            JOIN trainer t ON t.trainer_uid = hr.trainer_uid
            JOIN race_outcome ro ON ro.race_outcome_uid=hr.race_outcome_uid
            JOIN race_outcome ro2 ON ro2.race_outcome_uid=hr.final_race_outcome_uid
            LEFT JOIN odds o ON o.odds_uid = hr.starting_price_odds_uid
            WHERE
                t.trainer_uid = :trainerId
                AND ri.race_datetime BETWEEN  dateadd(day,-14,current_date()) AND current_date()
                AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
             GROUP BY t.trainer_uid
        ");

        $builder->setParam('trainerId', $trainerId);

        $builder->build();

        $data = $this->query(
            $builder->getSql(),
            $builder->getParams()
        );

        return $data->getFirst() ?: null;
    }
}
