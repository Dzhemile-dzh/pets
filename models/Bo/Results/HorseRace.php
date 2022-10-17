<?php

namespace Models\Bo\Results;

use Api\Constants\Horses as Constants;
use Phalcon\Db\Sql\Builder;
use \Phalcon\Mvc\Model\Resultset\General;
use Phalcon\Mvc\Model\Resultset\ResultsetException;
use \Phalcon\Mvc\Model\Row;
use \Api\Row\Results\Horse;
use \Api\DataProvider\Factory\TmpResultsTables;
use \Models\Selectors;
use Phalcon\DI;

/**
 * Class HorseRace
 *
 * @package Models\Bo\Results
 */
class HorseRace extends \Models\HorseRace
{
    /**
     * @var TmpResultsTables
     */
    private $factoryTmpResultTables;

    /**
     * @param TmpResultsTables $factory
     */
    public function setFactoryTmpResultTables(TmpResultsTables $factory)
    {
        $this->factoryTmpResultTables = $factory;
    }

    /**
     * @return TmpResultsTables
     */
    public function getFactoryTmpResultTables()
    {
        return $this->factoryTmpResultTables;
    }

    /**
     * @param $raceId
     * @param Selectors $selectors
     * @param bool $additionalFields
     * @return array
     * @throws ResultsetException
     */
    public function fetchResultsByRace($raceId, Selectors $selectors, bool $additionalFields)
    {
        $tmpTableName = $this->getFactoryTmpResultTables()->getHorseRaceInstance($raceId, $additionalFields);
        $ageSql = $selectors->getHorseAgeSQL(
            'h.horse_date_of_birth',
            'h.country_origin_code',
            'hr.race_datetime'
        );

        $sql = "
            SELECT
                h.horse_uid,
                h.style_name AS horse_style_name,
                h.country_origin_code AS horse_country_origin_code,
                horse_age = {$ageSql},
                j.style_name AS jockey_style_name,
                j.aka_style_name AS jockey_aka_style_name,
                j.jockey_uid,
                t.style_name AS trainer_style_name,
                t.mirror_name AS trainer_mirror_name,
                t.trainer_uid,
                -- We have different alias for same field
                -- because addHorsePositioning trait requires final/original race_outcome_position
                final_ro.race_outcome_position AS final_race_outcome_position,
                orig_ro.race_outcome_position  AS orig_race_outcome_position,
                rtrim(final_ro.race_outcome_code) AS final_race_outcome_code,
                final_ro.race_outcome_desc AS final_race_outcome_desc,
                final_ro.race_outcome_joint_yn AS final_race_outcome_joint_yn,
                final_ro.race_output_order AS final_race_output_order,
                orig_ro.race_output_order AS orig_race_output_order,
                hr.race_outcome_uid,
                hr.final_race_outcome_uid,
                dth.rp_distance_desc,
                dth.distance_value AS dth_distance_value,
                hr.draw,
                hr.weight_carried_lbs,
                hr.extra_weight_lbs,
                hr.over_weight_lbs,
                hr.out_of_handicap_lbs,
                odds.odds_desc,
                odds.odds_value,
                odds.favourite_flag,
                fav_1st = 0,
                joint_1st_fav = 0,
                fav_2nd = 0,
                joint_2nd_fav = 0,
                hr.official_rating_ran_off,
                o.owner_uid,
                o.style_name AS owner_style_name,
                hr.rp_owner_choice,
                b.style_name AS breeder_style_name,
                hrc.rp_close_up_comment,
                hr.rp_betting_movements,
                hhg.rp_horse_head_gear_code,
                hhg.horse_head_gear_desc,
                first_time_yn = isnull(hhg.first_time_yn, 'N'),
                hr.dist_to_horse_in_front_uid,
                hr.distance_to_winner_uid,
                hr.saddle_cloth_no,
                aa.rp_ages_allowed_desc,
                hr.rp_postmark,
                hr.rp_topspeed,
                hr.starting_price_odds_uid,
                -- additional SQL to select current_official_rating based on race_type_code
                %s
                h.horse_sex_code,
                -- additional sql to select horse_sex_desc from horse_sex table
                %s
                h.horse_date_of_birth,
                h.date_gelded,
                h.horse_colour_code,
                hc.horse_colour_desc,
                hc.rp_newspaper_output_desc,
                hr.race_datetime,
                dat.no_of_fences,
                -- additional SQL to determine new_trainer_races_count
                %s
                hr.weight_allowance_lbs,
                hr.disqualification_uid,
                h.sire_uid,
                hr.race_type_code,
                h.dam_uid,
                hr.distance_yard,
                sire.avg_flat_win_dist_of_progeny AS sire_avg_flat_wdp,
                sire.avg_jump_win_dist_of_progeny AS sire_avg_jump_wdp,
                first_season_sire_id = NULL,
                horse_sire.country_origin_code AS horse_sire_country,
                horse_sire.style_name AS horse_sire_style_name,
                horse_dam.country_origin_code AS horse_dam_country,
                horse_dam.style_name AS horse_dam_style_name,
                horse_dam_sire.style_name AS horse_dam_sire_style_name,
                horse_dam_sire.horse_uid AS horse_dam_sire_horse_uid,
                horse_dam_sire.sire_uid AS dam_sire_sire_uid,
                horse_dam_sire.dam_uid AS dam_sire_dam_uid,
                horse_dam_sire.country_origin_code AS dam_sire_country_origin_code,
                dam_sire.avg_flat_win_dist_of_progeny AS dam_sire_avg_flat_wdp,
                dam_sire.avg_jump_win_dist_of_progeny AS dam_sire_avg_jump_wdp,
                hrn.notes, 
                owner_group_uid =  NULL,
                is_wind_surgery_first_time = NULL,
                is_wind_surgery_second_time = NULL,
                dtw_sum_distance_value = (
                    SELECT SUM(dth2.distance_value)
                    FROM horse_race hr2
                        , race_outcome ro2
                        , dist_to_horse dth2
                    WHERE
                        dth2.dist_to_horse_uid = hr2.dist_to_horse_in_front_uid
                        AND ro2.race_outcome_uid = hr2.race_outcome_uid
                        -- additional sql to include non runners
                        %s
                        AND hr2.race_instance_uid = hr.race_instance_uid
                        AND ro2.race_output_order <= orig_ro.race_output_order
                        AND orig_ro.race_output_order BETWEEN 1 AND 50
                ),
                wfa_adjustment = NULL
            FROM {$tmpTableName} hr
                INNER JOIN horse h ON h.horse_uid = hr.horse_uid
                INNER JOIN race_outcome final_ro ON (final_ro.race_outcome_uid = hr.final_race_outcome_uid
                            -- additional sql to include non runners
                            %s
                            )
                INNER JOIN race_outcome orig_ro ON (orig_ro.race_outcome_uid = hr.race_outcome_uid
                            -- additional sql to include non runners
                            %s
                            )
                LEFT JOIN sire ON sire.sire_uid = h.sire_uid
                -- additional sql to join horse_sex and racing_horse tables
                %s
                LEFT JOIN horse horse_sire ON horse_sire.horse_uid = h.sire_uid
                LEFT JOIN horse horse_dam ON horse_dam.horse_uid = h.dam_uid
                LEFT JOIN horse horse_dam_sire ON horse_dam_sire.horse_uid = horse_dam.sire_uid
                LEFT JOIN sire dam_sire ON sire.sire_uid = dam_sire.sire_uid
                LEFT JOIN jockey j ON j.jockey_uid = hr.jockey_uid
                LEFT JOIN trainer t ON t.trainer_uid = hr.trainer_uid
                LEFT JOIN dist_to_horse dth ON dth.dist_to_horse_uid = hr.dist_to_horse_in_front_uid
                LEFT JOIN odds ON odds.odds_uid = hr.starting_price_odds_uid
                LEFT JOIN owner o ON o.owner_uid = hr.owner_uid
                LEFT JOIN breeder b ON b.breeder_uid = h.breeder_uid
                LEFT JOIN horse_race_comments hrc ON hrc.race_instance_uid = hr.race_instance_uid
                            AND hrc.horse_uid = hr.horse_uid
                LEFT JOIN horse_head_gear hhg ON hhg.horse_head_gear_uid = hr.horse_head_gear_uid
                LEFT JOIN ages_allowed aa ON aa.ages_allowed_uid = hr.ages_allowed_uid
                LEFT JOIN dist_ave_time dat ON
                    dat.course_uid = hr.course_uid
                    AND dat.race_type_code = hr.race_type_code
                    AND dat.distance_yard = hr.distance_yard
                    AND
                    (
                        dat.straight_round_jubilee_code = hr.straight_round_jubilee_code
                        OR (dat.straight_round_jubilee_code IS NULL
                        AND hr.straight_round_jubilee_code IS NULL)
                    )
                LEFT JOIN horse_colour hc ON hc.horse_colour_code = h.horse_colour_code
                LEFT JOIN horse_race_notes hrn ON hrn.race_instance_uid = hr.race_instance_uid AND hrn.horse_uid = hr.horse_uid AND hrn.notes_type_code = " . Constants::NOTES_TYPE_CODE_HORSE_BANS . "
            ORDER BY
                (CASE WHEN hr.disqualification_uid IS NULL THEN orig_ro.race_output_order
                    ELSE hr.disqualification_uid END),
                (CASE WHEN dth.rp_distance_desc = " . Constants::DIST_TO_HORSE_DHT . " THEN 1 ELSE 0 END),
                dth.distance_value DESC,
                final_ro.race_output_order,
                final_ro.race_outcome_position
            PLAN '(use optgoal allrows_dss)"
            . "(use merge_join off)"
            . "(nl_join (i_scan orig_ro)(nl_join (t_scan hr)(i_scan final_ro)))'                
        ";

        if ($additionalFields) {
            $nonRunnerSql1      = null;
            $nonRunnerSql2      = null;
            $nonRunnerSql3      = null;
            $additionalSelect1 = "current_official_rating = CASE
                                    WHEN hr.race_type_code IN (" . Constants::RACE_TYPE_FLAT_TURF . ")
                                    THEN rh.current_official_turf_rating
                                    WHEN hr.race_type_code IN (" . Constants::RACE_TYPE_CHASE . ")
                                    THEN rh.current_official_rating_chase
                                    WHEN hr.race_type_code IN (" . Constants::RACE_TYPE_HURDLE . ")
                                    THEN rh.current_official_rating_hurdle
                                    WHEN hr.race_type_code IN (" . Constants::RACE_TYPE_FLAT_AW . ")
                                    THEN rh.current_official_aw_rating
                                 END,";

            $additionalSelect2  = 'hs.horse_sex_desc,';
            $additionalSelect3  = 'new_trainer_races_count = null,';
            //            TODO:: Fix the new_trainer_races_count (currently returning wrong data)
            //              Commenting this bit because there will be a ticket logged to fix this and this code could be useful
            //            $additionalSelect3  = "new_trainer_races_count = (
            //                SELECT
            //                    (
            //                        SELECT COUNT(1) + 1
            //                        FROM horse_race hr3
            //                        WHERE hr3.horse_uid = ht.horse_uid
            //                            AND hr3.trainer_uid = ht.trainer_uid
            //                            AND hr3.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
            //                            AND hr3.race_instance_uid != " . $raceId . "
            //                    )
            //                FROM horse_trainer ht
            //                WHERE
            //                    ht.horse_uid = hr.horse_uid
            //                    AND ht.trainer_change_date = isnull(
            //                        (
            //                            SELECT MIN(hti.trainer_change_date)
            //                            FROM horse_trainer hti
            //                            WHERE hti.horse_uid = ht.horse_uid AND hti.trainer_change_date > hr.race_datetime
            //                         ),
            //                         '1900-01-01 00:00:00.0'
            //                    )
            //                    AND EXISTS (
            //                        SELECT 1 FROM horse_race hr4
            //                        WHERE
            //                            hr4.horse_uid = ht.horse_uid
            //                            AND hr4.trainer_uid != ht.trainer_uid
            //                            AND hr4.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
            //                    )
            //                HAVING
            //                    (
            //                        SELECT COUNT(1) FROM horse_race hr5
            //                        WHERE
            //                            hr5.horse_uid = ht.horse_uid
            //                            AND hr5.trainer_uid = ht.trainer_uid
            //                            AND hr5.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
            //                    ) < 2
            //            ),";

            $additionalJoins    = 'LEFT JOIN horse_sex hs ON h.horse_sex_code = hs.horse_sex_code
                                    LEFT JOIN racing_horse rh ON rh.horse_uid = hr.horse_uid';
        } else {
            $additionalSelect1  = null;
            $additionalSelect2  = null;
            $additionalSelect3  = null;
            $additionalJoins    = null;
            $nonRunnerSql1      = 'AND ro2.race_outcome_code NOT IN (' . Constants::NON_RUNNER_CODES . ')';
            $nonRunnerSql2      = 'AND final_ro.race_outcome_code NOT IN (' . Constants::NON_RUNNER_CODES . ')';
            $nonRunnerSql3      = 'AND orig_ro.race_outcome_code NOT IN (' . Constants::NON_RUNNER_CODES . ')';
        }

        // we need to keep the order of the sql we want to replace - every %s is ordered according to below order
        $raceResult = $this->getReadConnection()->query(
            sprintf(
                $sql,
                $additionalSelect1,
                $additionalSelect2,
                $additionalSelect3,
                $nonRunnerSql1,
                $nonRunnerSql2,
                $nonRunnerSql3,
                $additionalJoins
            ),
        );

        $raceResult = new General(
            null,
            new Horse(),
            $raceResult
        );

        return $raceResult->toArrayWithRows();
    }

    /**
     * @param string $date
     * @param bool $returnP2P
     *
     * @return array
     */
    public function getResultsDateRunners($date, $returnP2P = true)
    {
        $builder = new Builder();

        $builder->setSqlTemplate(
            "
            SELECT
                t.*,
                h.horse_uid,
                h.style_name horse_style_name,
                h.horse_name,
                h.country_origin_code,
                b.style_name breeder_style_name,
                hc.rp_newspaper_output_desc,
                h.sire_uid,
                h.dam_uid,
                sire.avg_flat_win_dist_of_progeny AS sire_avg_flat_wdp,
                sire.avg_jump_win_dist_of_progeny AS sire_avg_jump_wdp,
                horse_sire.country_origin_code AS horse_sire_country,
                horse_sire.style_name AS horse_sire_style_name,

                horse_dam.country_origin_code AS horse_dam_country,
                horse_dam.style_name AS horse_dam_style_name,

                horse_dam_sire.style_name AS horse_dam_sire_style_name,
                horse_dam_sire.horse_uid AS horse_dam_sire_horse_uid,
                horse_dam_sire.sire_uid AS dam_sire_sire_uid,
                horse_dam_sire.dam_uid AS dam_sire_dam_uid,
                horse_dam_sire.country_origin_code AS dam_sire_country_origin_code,
                dam_sire.avg_flat_win_dist_of_progeny AS dam_sire_avg_flat_wdp,
                dam_sire.avg_jump_win_dist_of_progeny AS dam_sire_avg_jump_wdp,
                joint_2nd_fav = 0,
                fav_2nd = 0,
                each_way_placed = 'N'
            FROM
                (
                    SELECT
                         ri.race_instance_uid,
                         ri.race_status_code,
                         ri.race_type_code,
                         race_outcome_code = rtrim(ro.race_outcome_code),
                         ro.race_outcome_desc,
                         ro.race_outcome_position,
                         ro.race_outcome_joint_yn,
                         ro.race_output_order,
                         ro.race_outcome_uid,
                         orig_race_output_order = orig_ro.race_output_order,
                         hr.horse_uid,
                         hr.weight_allowance_lbs,
                         hr.rp_owner_choice,
                         hr.disqualification_uid,
                         j.jockey_uid,
                         j.style_name jockey_style_name,
                         o.odds_desc,
                         o.favourite_flag,
                         o.odds_value,
                         o.favourite_flag,
                         t.trainer_uid,
                         t.style_name trainer_style_name,
                         ow.style_name owner_style_name,
                         ow.owner_uid,
                         c.course_uid,
                         dth.rp_distance_desc,
                         dth.distance_desc,
                         dth.distance_value AS dth_distance_value,
                         first_time_yn = isnull(hhg.first_time_yn, 'N'),
                         dtw_sum_distance_value = (
                             SELECT SUM(dth2.distance_value)
                             FROM horse_race hr2
                                 , race_outcome ro2
                                 , dist_to_horse dth2
                             WHERE
                                 dth2.dist_to_horse_uid = hr2.dist_to_horse_in_front_uid
                                 AND ro2.race_outcome_uid = hr2.race_outcome_uid
                                 AND ro2.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
                                 AND hr2.race_instance_uid = hr.race_instance_uid
                                 AND ro2.race_output_order <= orig_ro.race_output_order
                                 AND orig_ro.race_output_order BETWEEN 1 AND 50
                         ),
                         hr.saddle_cloth_no,
                         hr.saddle_cloth_letter,
                         hr.draw
                     FROM horse_race hr
                     INNER JOIN race_instance ri ON ri.race_instance_uid  = hr.race_instance_uid
                        AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                     INNER JOIN race_outcome ro ON (ro.race_outcome_uid = hr.final_race_outcome_uid
                         AND ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . "))
                     INNER JOIN race_outcome orig_ro ON (orig_ro.race_outcome_uid = hr.race_outcome_uid
                         AND orig_ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . "))
                     LEFT JOIN course c ON ri.course_uid = c.course_uid
                     LEFT JOIN jockey j ON j.jockey_uid = hr.jockey_uid
                     LEFT JOIN odds o ON o.odds_uid = hr.starting_price_odds_uid
                     LEFT JOIN trainer t ON t.trainer_uid = hr.trainer_uid
                     LEFT JOIN dist_to_horse dth ON dth.dist_to_horse_uid = hr.dist_to_horse_in_front_uid
                     LEFT JOIN owner ow ON ow.owner_uid = hr.owner_uid
                     LEFT JOIN horse_head_gear hhg ON hhg.horse_head_gear_uid = hr.horse_head_gear_uid
                     WHERE
                        /*{WHERE}*/
                        ri.race_datetime BETWEEN :start_date: AND :end_date:
                    ) t
                JOIN horse h ON h.horse_uid = t.horse_uid
                LEFT JOIN breeder b ON b.breeder_uid = h.breeder_uid
                LEFT JOIN sire ON sire.sire_uid = h.sire_uid
                LEFT JOIN horse horse_sire ON horse_sire.horse_uid = h.sire_uid
                LEFT JOIN horse horse_dam ON horse_dam.horse_uid = h.dam_uid
                LEFT JOIN horse horse_dam_sire ON horse_dam_sire.horse_uid = horse_dam.sire_uid
                LEFT JOIN sire dam_sire ON sire.sire_uid = dam_sire.sire_uid
                LEFT JOIN horse_colour hc ON hc.horse_colour_code = h.horse_colour_code
                ORDER BY
                    t.race_instance_uid,
                    t.race_output_order,
                    t.dth_distance_value DESC,
                    t.race_outcome_joint_yn DESC,
                    t.saddle_cloth_no
                PLAN'(use optgoal allrows_dss)'"
        );

        $builder
            ->setParam('start_date', $date . ' 00:00:00')
            ->setParam('end_date', $date . ' 23:59:59');

        if (!$returnP2P) {
            $builder->where("ri.race_type_code != '" . Constants::COURSE_TYPE_P2P_CODE . "'");
        }

        $builder->build();

        $raceResult = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $raceResult = new General(
            null,
            new Horse(),
            $raceResult
        );
        return $raceResult->toArrayWithRows('race_instance_uid', null, true);
    }

    /**
     * @throws ResultsetException
     */
    public function getResultsDateRunnersById($raceId, $returnP2P = true): array
    {
        $builder = new Builder();

        $builder->setSqlTemplate(
            "
            SELECT
                t.*,
                h.horse_uid,
                h.style_name horse_style_name,
                h.horse_name,
                h.country_origin_code,
                b.style_name breeder_style_name,
                hc.rp_newspaper_output_desc,
                h.sire_uid,
                h.dam_uid,
                sire.avg_flat_win_dist_of_progeny AS sire_avg_flat_wdp,
                sire.avg_jump_win_dist_of_progeny AS sire_avg_jump_wdp,
                horse_sire.country_origin_code AS horse_sire_country,
                horse_sire.style_name AS horse_sire_style_name,

                horse_dam.country_origin_code AS horse_dam_country,
                horse_dam.style_name AS horse_dam_style_name,

                horse_dam_sire.style_name AS horse_dam_sire_style_name,
                horse_dam_sire.horse_uid AS horse_dam_sire_horse_uid,
                horse_dam_sire.sire_uid AS dam_sire_sire_uid,
                horse_dam_sire.dam_uid AS dam_sire_dam_uid,
                horse_dam_sire.country_origin_code AS dam_sire_country_origin_code,
                dam_sire.avg_flat_win_dist_of_progeny AS dam_sire_avg_flat_wdp,
                dam_sire.avg_jump_win_dist_of_progeny AS dam_sire_avg_jump_wdp,
                joint_2nd_fav = 0,
                fav_2nd = 0,
                each_way_placed = 'N'
            FROM
                (
                    SELECT
                         ri.race_instance_uid,
                         ri.race_status_code,
                         ri.race_type_code,
                         race_outcome_code = rtrim(ro.race_outcome_code),
                         ro.race_outcome_desc,
                         ro.race_outcome_position,
                         ro.race_outcome_joint_yn,
                         ro.race_output_order,
                         ro.race_outcome_uid,
                         orig_race_output_order = orig_ro.race_output_order,
                         hr.horse_uid,
                         hr.weight_allowance_lbs,
                         hr.rp_owner_choice,
                         hr.disqualification_uid,
                         j.jockey_uid,
                         j.style_name jockey_style_name,
                         o.odds_desc,
                         o.favourite_flag,
                         o.odds_value,
                         o.favourite_flag,
                         t.trainer_uid,
                         t.style_name trainer_style_name,
                         ow.style_name owner_style_name,
                         ow.owner_uid,
                         c.course_uid,
                         dth.rp_distance_desc,
                         dth.distance_desc,
                         dth.distance_value AS dth_distance_value,
                         first_time_yn = isnull(hhg.first_time_yn, 'N'),
                         dtw_sum_distance_value = (
                             SELECT SUM(dth2.distance_value)
                             FROM horse_race hr2
                                 , race_outcome ro2
                                 , dist_to_horse dth2
                             WHERE
                                 dth2.dist_to_horse_uid = hr2.dist_to_horse_in_front_uid
                                 AND ro2.race_outcome_uid = hr2.race_outcome_uid
                                 AND ro2.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
                                 AND hr2.race_instance_uid = hr.race_instance_uid
                                 AND ro2.race_output_order <= orig_ro.race_output_order
                                 AND orig_ro.race_output_order BETWEEN 1 AND 50
                         ),
                         hr.saddle_cloth_no,
                         hr.saddle_cloth_letter,
                         hr.draw
                     FROM horse_race hr
                     INNER JOIN race_instance ri ON ri.race_instance_uid  = hr.race_instance_uid
                        AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                     INNER JOIN race_outcome ro ON (ro.race_outcome_uid = hr.final_race_outcome_uid
                         AND ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . "))
                     INNER JOIN race_outcome orig_ro ON (orig_ro.race_outcome_uid = hr.race_outcome_uid
                         AND orig_ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . "))
                     LEFT JOIN course c ON ri.course_uid = c.course_uid
                     LEFT JOIN jockey j ON j.jockey_uid = hr.jockey_uid
                     LEFT JOIN odds o ON o.odds_uid = hr.starting_price_odds_uid
                     LEFT JOIN trainer t ON t.trainer_uid = hr.trainer_uid
                     LEFT JOIN dist_to_horse dth ON dth.dist_to_horse_uid = hr.dist_to_horse_in_front_uid
                     LEFT JOIN owner ow ON ow.owner_uid = hr.owner_uid
                     LEFT JOIN horse_head_gear hhg ON hhg.horse_head_gear_uid = hr.horse_head_gear_uid
                     WHERE
                        /*{WHERE}*/
                        ri.race_instance_uid = :raceId
                    ) t
                JOIN horse h ON h.horse_uid = t.horse_uid
                LEFT JOIN breeder b ON b.breeder_uid = h.breeder_uid
                LEFT JOIN sire ON sire.sire_uid = h.sire_uid
                LEFT JOIN horse horse_sire ON horse_sire.horse_uid = h.sire_uid
                LEFT JOIN horse horse_dam ON horse_dam.horse_uid = h.dam_uid
                LEFT JOIN horse horse_dam_sire ON horse_dam_sire.horse_uid = horse_dam.sire_uid
                LEFT JOIN sire dam_sire ON sire.sire_uid = dam_sire.sire_uid
                LEFT JOIN horse_colour hc ON hc.horse_colour_code = h.horse_colour_code
                ORDER BY
                    t.race_instance_uid,
                    t.race_output_order,
                    t.dth_distance_value DESC,
                    t.race_outcome_joint_yn DESC,
                    t.saddle_cloth_no
                PLAN'(use optgoal allrows_dss)'"
        );

        $builder
            ->setParam('raceId', $raceId);

        if (!$returnP2P) {
            $builder->where("ri.race_type_code != '" . Constants::COURSE_TYPE_P2P_CODE . "'");
        }

        $builder->build();

        $raceResult = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $raceResult = new General(
            null,
            new Horse(),
            $raceResult
        );
        return $raceResult->toArrayWithRows('race_instance_uid', null, true);
    }

    /**
     * @param array $horseUids
     *
     * @return General
     */
    public function getHorseRacesToCalculatePrevAndNextRaces(array $horseUids)
    {
        $res = $this->getReadConnection()->query(
            "SELECT
                r.race_instance_uid,
                r.race_datetime,
                hr.horse_uid,
                r.course_uid,
                c.course_name
            FROM
                horse_race hr
            JOIN
                race_instance r ON hr.race_instance_uid = r.race_instance_uid
            JOIN
                course c ON c.course_uid = r.course_uid
            WHERE
                hr.horse_uid IN (:horseUids)
                AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                AND (c.course_type_code != '" . Constants::COURSE_TYPE_P2P_CODE . "' OR c.country_code != 'GB')
                AND r.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
            ",
            [
                'horseUids' => $horseUids
            ]
        );

        return new General(null, new Row(), $res);
    }

    /**
     * @param int[] $raceIds
     * @param bool  $nonRunnersFlag
     *
     * @return array
     */
    public function getHorseOwnerGroups(array $raceIds, bool $nonRunnersFlag = true): array
    {
        $nonRunnersExclusionSQL = ($nonRunnersFlag) ? 'NOT' : '';
        // we need coolMoreOwnerGroupsIDS as an array with only the values from the constants to use in the SQL
        // to exclude/include horses depending on the IDS.
        $coolMoreOwnerGroupsIDS = array_values(Constants::COOLMORE_OWNER_GROUPS_TO_HORSE_IDS);

        $res = $this->getReadConnection()->query(
            "
                SELECT
                    hr.horse_uid,
                    owner_group_uid = rc.rabbah_uid,
                    to_follow_uid = null
                FROM horse_race hr
                    INNER JOIN rabbah_config rc ON rc.owner_uid = hr.owner_uid
                    INNER JOIN horse_to_follow htf ON htf.horse_uid = hr.horse_uid
                        AND htf.to_follow_uid = rc.to_follow_uid
                WHERE hr.race_instance_uid IN (:raceId)
                    AND hr.final_race_outcome_uid {$nonRunnersExclusionSQL} IN (" . Constants::NON_RUNNER_IDS . ")
                    AND htf.to_follow_uid NOT IN (:coolMoreOwnerGroupsIDS)
                UNION
                SELECT
                       hr.horse_uid,
                       owner_group_uid = null,
                       htf.to_follow_uid
                FROM horse_race hr
                       INNER JOIN horse_to_follow htf ON htf.horse_uid = hr.horse_uid
                WHERE hr.race_instance_uid IN (:raceId)
                    AND hr.final_race_outcome_uid {$nonRunnersExclusionSQL} IN (" . Constants::NON_RUNNER_IDS . ")
                    AND htf.to_follow_uid IN (:coolMoreOwnerGroupsIDS)
            ",
            [
                'raceId' => $raceIds,
                'coolMoreOwnerGroupsIDS' => $coolMoreOwnerGroupsIDS
            ]
        );

        $groups = new General(
            null,
            new Horse(),
            $res
        );

        return $groups->toArrayWithRows('horse_uid', null, true);
    }

    /**
     * @param $raceId
     * @param $horseId
     * @return array|null
     * @throws ResultsetException
     */
    public function getDistanceToWinnerValue($raceId)
    {
        $sql =
            "SELECT 
              dth.distance_value, 
              hr.horse_uid
            FROM horse_race hr
                INNER JOIN race_outcome ro ON ro.race_outcome_uid = hr.race_outcome_uid
                INNER JOIN dist_to_horse dth ON dth.dist_to_horse_uid = hr.dist_to_horse_in_front_uid
            WHERE hr.race_instance_uid = (:raceId)
              AND ro.race_output_order BETWEEN 1 AND 50
            ORDER BY ro.race_output_order
            ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'raceId' => $raceId,
            ]
        );

        $collection = new General(null, new Row(), $res);
        $result = $collection->toArrayWithRows('horse_uid');

        return $result ?? null;
    }


    /**
     * @param $disqualificationUid
     * @return mixed
     */
    public function getDisqualificationData($disqualificationUid)
    {
        $sql =
            "SELECT *
            FROM disqualification
            WHERE disqualification_uid = " . $disqualificationUid ."
            ";

        $res = $this->getReadConnection()->query($sql);
        $collection = new General(null, new Row(), $res);
        $result = $collection->toArrayWithRows();

        return $result;
    }

    /**
     * This query is used to retrieve first time gelding data for post race data joining horse_race table
     *
     * @param  $raceId
     * @return mixed
     */
    public function getGeldingFirstTimeRunnersForResults($raceId)
    {
        $sql = "
            SELECT DISTINCT
                h.horse_uid
            FROM horse h
                INNER JOIN horse_race hr ON hr.horse_uid = h.horse_uid
                INNER JOIN race_instance ri ON ri.race_instance_uid = hr.race_instance_uid
            WHERE
                ri.race_instance_uid = (:raceId)
                AND  h.date_gelded IS NOT NULL
                AND  ri.race_datetime > h.date_gelded 
                AND NOT EXISTS (
                    SELECT 1 FROM
                        horse_race hr
                        INNER JOIN race_instance ri2 ON ri2.race_instance_uid = hr.race_instance_uid
                    WHERE h.horse_uid = hr.horse_uid
                        AND ri2.race_datetime > h.date_gelded
                        AND ri2.race_datetime < ri.race_datetime
                        AND hr.final_race_outcome_uid NOT IN (".Constants::NON_RUNNER_IDS.")
                    )
            ";


        $res = $this->getReadConnection()->query(
            $sql,
            [
                'raceId' => $raceId
            ]
        );
        $collection = new General(null, new Row(), $res);

        return $collection->toArrayWithRows('horse_uid');
    }

    public function getResultsDateRunnersIndex($date, Selectors $selectors): array
    {
        $ageSql = $selectors->getHorseAgeSQL(
            'h.horse_date_of_birth',
            'h.country_origin_code',
            'getdate()'
        );
        $builder = new Builder();

        $builder->setSqlTemplate(
            "
            	SELECT 
            	   ri.race_status_code,
            	   phr.horse_uid,
            	   h.horse_name,
                   horse_style_name = h.style_name ,
            	   horse_age = {$ageSql},
                   phr.saddle_cloth_no,
                   h.country_origin_code,
                   phr.draw,
                   ho.owner_uid,
                   phr.non_runner,
                   days_since_last_run = null,
                   days_since_last_run_flat = null,
                   days_since_last_run_jumps = null,
                   days_since_last_run_ptp = null,
                   local_meeting_race_datetime = dateadd(MINUTE, isnull(clt.hours_difference, 0)  * 60, ri.race_datetime),
                   clt.hours_difference,
                   ri.course_uid,
                   c1.course_name,
                   course_style_name = c1.style_name,
                   race_date = ri.race_datetime,
                   ri.race_instance_uid,
                   j.jockey_uid,
                   jockey_style_name = j.style_name,
                   phr.weight_allowance_lbs,
            	   phr.rp_owner_choice ,
                   ht.trainer_uid,
                   trainer_style_name = t.style_name,
                   o1.owner_uid,   
                   expected_weight_carried_lbs = phr.weight_carried_lbs,   
            	   phr.weight_carried_lbs,   
                   phr.rp_postmark,
                   ri.race_type_code,
            	   ri.race_group_uid,
                   c1.country_code as course_country_code,
                   '' odds_desc ,
                   hn.notes,
                   figures = (
                                  CASE
                                      WHEN ri.race_type_code IN ('F','X') THEN rihc.irb_flat_form_string
                                      ELSE rihc.irb_jump_form_string
                                  END
                              ),
                   figures_calculated = NULL,
            	   final_race_outcome_uid = null,
                   '' race_outcome_code,
                   '' race_outcome_desc,
                   race_outcome_position = 0,
                   '' race_outcome_joint_yn,
                   race_output_order = 0,
                   race_outcome_uid = null,
                   orig_race_output_order = 0,
            	   forecast_odds_value = null,
                   forecast_odds_desc = null,
            	   phr.extra_weight_lbs
            FROM race_instance ri 
            INNER JOIN pre_horse_race phr ON phr.race_instance_uid = ri.race_instance_uid
            INNER JOIN horse h ON h.horse_uid = phr.horse_uid
            INNER JOIN course c1 ON c1.course_uid = ri.course_uid
            INNER JOIN horse_owner ho ON ho.horse_uid = phr.horse_uid
            INNER JOIN horse_trainer ht ON ht.horse_uid = phr.horse_uid
            INNER JOIN trainer t ON t.trainer_uid = ht.trainer_uid
            INNER JOIN owner o1 ON o1.owner_uid = ho.owner_uid
            LEFT JOIN horse_notes hn ON hn.horse_uid = phr.horse_uid and hn.notes_type_code IN ('F','G', 'W')
            LEFT JOIN racing_horse_comments rihc ON rihc.horse_uid = phr.horse_uid
            LEFT JOIN jockey j ON j.jockey_uid = phr.jockey_uid
            LEFT JOIN course_local_time clt ON clt.course_uid = ri.course_uid 
                 AND ri.race_datetime BETWEEN clt.date_from AND clt.date_to
            WHERE ri.race_datetime BETWEEN :start_date: AND :end_date:   
            AND  phr.race_status_code = ri.race_status_code
            AND  ho.owner_change_date = isnull(
                                               (SELECT MIN(hoi.owner_change_date)
                                                FROM horse_owner hoi
                                                WHERE hoi.horse_uid = ho.horse_uid
                                                 AND hoi.owner_change_date >= ri.race_datetime)
                                             , CONVERT(DATETIME, '1 jan 1900')
                                             )	
            AND ht.trainer_change_date = isnull(
                                              (SELECT MIN(hti.trainer_change_date)
                                               FROM horse_trainer hti
                                               WHERE hti.horse_uid = ht.horse_uid 
                                               AND hti.trainer_change_date > ri.race_datetime), CONVERT(DATETIME, '1 jan 1900')) 
             AND ri.race_status_code != " . Constants::RACE_STATUS_ABANDONED . "
             AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
             AND ri.race_datetime >= CAST(GETDATE() AS DATE)
            UNION ALL
            	SELECT 
            	   ri.race_status_code,
            	   hr.horse_uid,
            	   h.horse_name,
                   horse_style_name = h.style_name ,
            	   horse_age = {$ageSql},
                   hr.saddle_cloth_no,
                   h.country_origin_code,
                   hr.draw,
                   ho.owner_uid,
                   '' non_runner,
                   days_since_last_run = null,
                   days_since_last_run_flat = null,
                   days_since_last_run_jumps = null,
                   days_since_last_run_ptp = null,
                   local_meeting_race_datetime = dateadd(MINUTE, isnull(clt.hours_difference, 0)  * 60, ri.race_datetime),
                   clt.hours_difference,
                   ri.course_uid,
                   course_name = null,
                   course_style_name = c1.style_name,
                   race_date = ri.race_datetime,
                   ri.race_instance_uid,
                   j.jockey_uid,
                   jockey_style_name = j.style_name,
                   hr.weight_allowance_lbs,
                   hr.rp_owner_choice ,
                   ht.trainer_uid,
                   trainer_style_name = t.style_name,
                   o1.owner_uid,
                   expected_weight_carried_lbs = 0,
            	   hr.weight_carried_lbs,
                   hr.rp_postmark,
                   ri.race_type_code,
            	   ri.race_group_uid ,
                   c1.country_code as course_country_code,
                   odf.odds_desc ,
                   hn.notes,
                   figures = null,
                   figures_calculated = null,
            	   hr.final_race_outcome_uid,
                   ro.race_outcome_code,
                   ro.race_outcome_desc,
                   ro.race_outcome_position,
                   ro.race_outcome_joint_yn,
                   ro.race_output_order,
                   ro.race_outcome_uid,
                   orig_race_output_order = orig_ro.race_output_order,
            	   forecast_odds_value = odf.odds_value,
                   forecast_odds_desc = odf.odds_desc,
                   hr.extra_weight_lbs
            FROM race_instance ri 
            INNER JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
            INNER JOIN horse h ON h.horse_uid = hr.horse_uid
            INNER JOIN course c1 ON c1.course_uid = ri.course_uid
            INNER JOIN horse_owner ho ON ho.horse_uid = hr.horse_uid
            INNER JOIN horse_trainer ht ON ht.horse_uid = hr.horse_uid
            INNER JOIN trainer t ON t.trainer_uid = ht.trainer_uid
            INNER JOIN owner o1 ON o1.owner_uid = ho.owner_uid
            LEFT JOIN horse_notes hn ON hn.horse_uid = hr.horse_uid and hn.notes_type_code IN ('F','G', 'W')
            INNER JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
            INNER JOIN race_outcome orig_ro ON orig_ro.race_outcome_uid = hr.race_outcome_uid
            LEFT JOIN racing_horse_comments rihc ON rihc.horse_uid = hr.horse_uid
            LEFT JOIN jockey j ON j.jockey_uid = hr.jockey_uid
            LEFT JOIN course_local_time clt ON clt.course_uid = ri.course_uid 
                 AND ri.race_datetime BETWEEN clt.date_from AND clt.date_to
            LEFT JOIN odds odf ON hr.starting_price_odds_uid = odf.odds_uid
                  AND odf.odds_desc != 'No Odds'
            WHERE 
                  ri.race_datetime BETWEEN :start_date: AND :end_date:   
            AND   ho.owner_change_date = isnull(
                                               (SELECT MIN(hoi.owner_change_date)
                                                FROM horse_owner hoi
                                                WHERE hoi.horse_uid = ho.horse_uid
                                                 AND hoi.owner_change_date >= ri.race_datetime)
                                             , CONVERT(DATETIME, '1 jan 1900')
                                             )	
            AND   ht.trainer_change_date = isnull(
                                              (SELECT MIN(hti.trainer_change_date)
                                               FROM horse_trainer hti
                                               WHERE hti.horse_uid = ht.horse_uid 
                                               AND hti.trainer_change_date > ri.race_datetime), CONVERT(DATETIME, '1 jan 1900')) 
            AND ri.race_status_code != " . Constants::RACE_STATUS_ABANDONED . "	
            AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
            ORDER BY h.style_name
            PLAN'(use optgoal allrows_dss)'"
        );

        $builder
            ->setParam('start_date', $date . ' 00:00:00')
            ->setParam('end_date', $date . ' 23:59:59');

        $builder->build();

        $raceResult = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $raceResult = new General(
            null,
            new Horse(),
            $raceResult
        );
        return $raceResult->toArrayWithRows("horse_uid");
    }
}
