<?php

namespace Models\Bo\RaceCards;

use Models\Selectors;
use Api\Row\Results\Horse;
use Api\Constants\Horses as Constants;
use \Api\Exception\NotFound;
use Phalcon\Db\Sql\Builder;
use Phalcon\Mvc\Model\Row\General as GeneralRow;
use Phalcon\Mvc\Model\Resultset\General as GeneralCollection;
use Phalcon\Mvc\Model\Row\General;

/**
 * Class Runners
 *
 * @package Models\Bo\RaceCards
 */
class Runners extends RaceInstance
{
    use \Api\Bo\Traits\FinalRaceCheck;

    /**
     * Going type codes
     */
    const SLOW_GROUND_FLAT_WINS = "'GS', 'S', 'GY', 'HO', 'HY', 'SH', 'VS', 'Y', 'YS'";
    const SLOW_GROUND_JUMPS_WINS = "'S', 'HO', 'HY', 'SH', 'VS', 'YS'";
    const FAST_GROUND_WINS = "'GF', 'F', 'HD'";

    /**
     * Temporary table name
     */
    const TMP_TABLE_NAME = '#tmp_name';

    /**
     * @param $raceIds
     * @param Selectors $selectors
     * @param $includeFinishedRaces
     * @param $groupByRaceId
     * @param $getAdditionalData - used to get horse spotlight, sex and colour data
     * @return array
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getRunners(
        $raceIds,
        Selectors $selectors,
        bool $getAdditionalData,
        bool $includeFinishedRaces,
        $groupByRaceId = false
    ) {
        $builder = new Builder();

        $ageSql = $selectors->getHorseAgeSQL(
            'h.horse_date_of_birth',
            'h.country_origin_code',
            'ri.race_datetime'
        );

        $this->createTmpTableMain($raceIds, $ageSql, $includeFinishedRaces);
        $sql = "
              SELECT     
                m.saddle_cloth_no,
                m.draw,
                m.race_type_code,
                m.race_status_code,
                m.distance_yard,
                m.track_code,
                m.course_uid,
                m.course_country_code,
                m.straight_round_jubilee_code,
                o.owner_uid,
                br.breeder_uid,
                br.style_name,
                owner_name = o.style_name,
                m.eliminator_no,
                m.horse_uid,
                m.horse_name,
                m.country_origin_code,
                m.race_instance_uid,
                m.race_datetime,
                hhg.rp_horse_head_gear_code,
                hhg.horse_head_gear_desc,
                hhg.first_time_yn,
                m.extra_weight_lbs,
                m.horse_age,
                m.weight_carried_lbs,
                m.official_rating,
                official_rating_today = null,
                m.jockey_uid,
                jockey_name = j.style_name,
                j.aka_style_name,
                m.weight_allowance_lbs,
                t.trainer_uid,
                trainer_style_name = t.style_name,
                short_trainer_name = t.mirror_name,
                trainer_search_name = t.mirror_name,
                trainer_ptp_type_code = t.ptp_type_code,
                trainer_country_code = t.country_code,  
                m.rp_postmark,
                pd.num_topspeed_best_rating,
                m.rp_topspeed,
                m.rp_owner_choice,
                m.non_runner,
                m.irish_reserve_yn,
                m.allowance,
                m.extra_weight,
                m.horse_colour_code,
                m.horse_sex_code,
                -- additional SQL for horse sex and colour
                %s
                m.sire_id,
                m.sire_name,
                m.sire_country,
                first_season_sire_id = NULL,
                m.dam_id,
                m.dam_name,
                m.dam_country,
                damsire_id = hdamsire.horse_uid ,
                damsire_name = hdamsire.style_name,
                damsire_country = hdamsire.country_origin_code,
                -- additional SQL for long spotlight
                %s
               -- additional SQL for short spotlight
                %s
                diomed = phrg.varchar_255,
                current_official_rating = (
                        CASE
                            WHEN rg.race_group_code = " . Constants::RACE_GROUP_CODE_HANDICAP
            . " AND m.race_type_code = " . Constants::RACE_TYPE_NH_FLAT . " THEN 0
                            WHEN rg.race_group_code = " . Constants::RACE_GROUP_CODE_HANDICAP
            . " AND m.race_type_code = " . Constants::RACE_TYPE_FLAT_AW . " THEN rh.current_official_aw_rating
                            WHEN rg.race_group_code = " . Constants::RACE_GROUP_CODE_HANDICAP
            . " AND m.race_type_code = " . Constants::RACE_TYPE_FLAT_TURF . " THEN rh.current_official_turf_rating
                            WHEN rg.race_group_code = " . Constants::RACE_GROUP_CODE_HANDICAP
            . " AND m.race_type_code IN (" . Constants::RACE_TYPE_CHASE . " ) THEN rh.current_official_rating_chase
                            WHEN rg.race_group_code = " . Constants::RACE_GROUP_CODE_HANDICAP
            . " AND m.race_type_code = " . Constants::RACE_TYPE_HURDLE_TURF . " THEN rh.current_official_rating_hurdle
                        END
                ),
                figures = (
                    CASE
                        WHEN m.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ") THEN rihc.irb_flat_form_string
                        ELSE rihc.irb_jump_form_string
                    END
                ),
                figures_calculated = NULL,
                lh_weight_carried_lbs = NULL,
                out_of_handicap = NULL,
                beaten_favourite = 'N',
                forecast_odds_value = odf.odds_value,
                forecast_odds_desc = odf.odds_desc,
                course_and_distance_wins = (
                    CASE WHEN m.course_country_code in (". Constants::COUNTRIES_FOR_DISTANCE. ") 
                    THEN 0 ELSE NULL END),
                course_wins = (
                    CASE WHEN m.course_country_code IN (". Constants::COUNTRIES_FOR_DISTANCE. ") 
                    THEN 0 ELSE NULL END),
                distance_wins = (
                    CASE WHEN m.course_country_code in (". Constants::COUNTRIES_FOR_DISTANCE. ") 
                    THEN 0 ELSE NULL END),
                m.running_conditions,
                m.date_gelded,
                gelding_first_time = 0,
                rp_postmark_improver = 'N',    
                owner_group_uid = null,
                m.race_group_uid,
                m.early_closing_race_yn,
                trainer_stylename = t.style_name,
                official_rating_horse = CASE
                    WHEN
                               m.early_closing_race_yn = 'Y'
                        AND rg.race_group_code != " . Constants::RACE_GROUP_CODE_HANDICAP . "
                        AND m.course_country_code IN ('" . Constants::COUNTRY_GB . "', '" . Constants::COUNTRY_IRE . "')
                    THEN
                    CASE
                        WHEN m.race_type_code = " . Constants::RACE_TYPE_FLAT_AW . " THEN rh.current_official_aw_rating
                        WHEN m.race_type_code IN (" . Constants::RACE_TYPE_CHASE_TURF . ", " . Constants::RACE_TYPE_HUNTER_CHASE . ") THEN rh.current_official_rating_chase
                        WHEN m.race_type_code = " . Constants::RACE_TYPE_HURDLE_TURF . " THEN rh.current_official_rating_hurdle
                        WHEN m.race_type_code = " . Constants::RACE_TYPE_FLAT_TURF . " THEN rh.current_official_turf_rating
                    END
                ELSE NULL END,
                handicap_first_time =
                        CASE WHEN rg.race_group_code = 'H'
                            AND NOT EXISTS (
                                SELECT 1
                                FROM
                                   horse_race hr1
                                   JOIN race_instance ri1 ON ri1.race_instance_uid = hr1.race_instance_uid
                                   JOIN race_group rg1 ON rg1.race_group_uid = ri1.race_group_uid
                                WHERE
                                   hr1.horse_uid = m.horse_uid
                                   AND hr1.race_outcome_uid NOT IN  ( " . Constants::NON_RUNNER_IDS . ")
                                     AND (
                                        (m.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                                            AND ri1.race_type_code IN (" . Constants::RACE_TYPE_FLAT . "))
                                        OR
                                        (m.race_type_code NOT IN (" . Constants::RACE_TYPE_FLAT . ")
                                            AND ri1.race_type_code = m.race_type_code)
                                    )
                                   AND rg1.race_group_code =  " . Constants::RACE_GROUP_CODE_HANDICAP . "
                                   AND ri1.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                        ) THEN 'Y' ELSE 'N' END,
                is_jockey_first_time = (
                            CASE
                                WHEN
                                    EXISTS (
                                        SELECT 1 FROM horse_race hr
                                        WHERE
                                            hr.horse_uid = m.horse_uid
                                            AND hr.race_outcome_uid NOT IN (60, 61, 62)
                                            AND hr.jockey_uid = m.jockey_uid
                                            AND hr.race_instance_uid != m.race_instance_uid
                                    )
                                    OR
                                    1 > (
                                        SELECT count(hr.horse_uid)
                                        FROM horse_race hr
                                        WHERE
                                            hr.horse_uid = m.horse_uid
                                            AND hr.race_instance_uid != m.race_instance_uid
                                    )
                                THEN 'N' ELSE 'Y'
                            END
                        ),
                rg.race_group_code,    
                m.horse_date_of_birth,
                phrg.int_1 star_rating,
                jockey_last_14_days = NULL,
                m.new_trainer_races_count,
                ten_to_follow_horse = htf.horse_uid,
                htf.reasoning,
                plus10_horse = 'N',
                yearling_bonus_horse = 'N',
                is_wind_surgery_first_time = null,
                is_wind_surgery_second_time = null,
                selection_cnt = null,
                trainer_rtf=null,
                unadjusted_rp_postmark = 
                    CASE
                        WHEN m.race_type_code = " . Constants::RACE_TYPE_FLAT_TURF . " THEN rh.rf_flat
                        WHEN m.race_type_code = " . Constants::RACE_TYPE_FLAT_AW . " THEN rh.rf_awflat
                        WHEN m.race_type_code IN (" . Constants::RACE_TYPE_CHASE_TURF . ", " . Constants::RACE_TYPE_HUNTER_CHASE . ") THEN rh.rf_chase
                        WHEN m.race_type_code = " . Constants::RACE_TYPE_NH_FLAT . " THEN rh.rf_bumper
                        WHEN m.race_type_code = " . Constants::RACE_TYPE_HURDLE_TURF . " THEN 
                            CASE 
                                WHEN substring(rf_hurdle_char, char_length(rf_hurdle_char), 1) = 'f' 
                                THEN 0 
                                ELSE rh.rf_hurdle 
                            END
                    END
             FROM " . self::TMP_TABLE_NAME . " m
                    LEFT JOIN racing_horse_comments rihc ON rihc.horse_uid = m.horse_uid
                    LEFT JOIN racing_horse rh ON rh.horse_uid = m.horse_uid
                    LEFT JOIN jockey j ON j.jockey_uid = m.jockey_uid
                    LEFT JOIN horse hdamsire ON hdamsire.horse_uid = m.dam_sire_uid
                    LEFT JOIN horse_head_gear hhg ON hhg.horse_head_gear_uid = m.horse_head_gear_uid
                    LEFT JOIN horse hbreeder ON hbreeder.horse_uid = m.horse_uid
                    %s
                    LEFT JOIN postdata_results_new pd ON pd.race_instance_uid = m.race_instance_uid
                            AND pd.horse_uid = m.horse_uid
                    LEFT JOIN pre_horse_race_comments phrc ON phrc.race_instance_uid = m.race_instance_uid
                        AND phrc.horse_uid = m.horse_uid
                    LEFT JOIN pre_horse_race_genlkup phrg ON phrg.race_instance_uid = m.race_instance_uid
                        AND phrg.horse_uid = m.horse_uid
                    LEFT JOIN horse_owner ho ON ho.horse_uid = m.horse_uid AND
                            ho.owner_change_date = isnull(
                            (
                                SELECT MIN(hoi.owner_change_date)
                                FROM horse_owner hoi
                                WHERE hoi.horse_uid = ho.horse_uid AND hoi.owner_change_date >= m.race_datetime
                            ),
                            CONVERT(DATETIME, '1 jan 1900')
                        )
                    LEFT JOIN owner o ON o.owner_uid = ho.owner_uid
                    LEFT JOIN odds odf ON m.forecast_sp_uid = odf.odds_uid
                        AND odf.odds_desc != 'No Odds'
                    LEFT JOIN horse_trainer ht ON ht.horse_uid = m.horse_uid
                        AND  ht.trainer_change_date = '1900' 
                    LEFT JOIN trainer t ON t.trainer_uid = ht.trainer_uid
                    LEFT JOIN race_group rg ON rg.race_group_uid = m.race_group_uid
                    LEFT JOIN horse_to_follow htf ON htf.horse_uid = m.horse_uid 
                        AND htf.to_follow_uid = " . Constants::TEN_TO_FOLLOW_HORSE_FOLLOW_ID ."
                    LEFT JOIN breeder br ON br.breeder_uid = hbreeder.breeder_uid
             /*{WHERE}*/
            ORDER BY m.race_datetime, m.saddle_cloth_no, m.horse_name
            PLAN '(use optgoal allrows_dss)'
        ";

        $additionalSelectSql = null;
        $additionJoinsSql    = null;
        $longSpotlightSql    = 'longSpotlight = phrc.rp_current_spotlight,';
        $shortSpotlightSql   = 'shortSpotlight = phrg.varchar_255,';

        // This is used for cases where we want the spotlight populated only depending on the tipsters and the publish time
        if ($getAdditionalData) {
            $additionalSelectSql    = "hs.horse_sex_desc,hc.horse_colour_desc,";

            $longSpotlightSql =
                "longSpotlight = CASE WHEN EXISTS (
                                SELECT 1 FROM race_content_publish_time rcpt
                                WHERE rcpt.race_content_publish_race_uid = m.race_instance_uid
                                AND rcpt.race_content_publish_time <= GETDATE()
                                AND rcpt.race_content_type_uid = " . Constants::RACE_CONTENT_TYPE_TIPSTERS_VERDICTS . "
                            )
                    THEN phrc.rp_current_spotlight ELSE NULL END,";

            $shortSpotlightSql =
                "shortSpotlight = CASE WHEN EXISTS (
                                SELECT 1 FROM race_content_publish_time rcpt
                                WHERE rcpt.race_content_publish_race_uid = m.race_instance_uid
                                AND rcpt.race_content_publish_time <= GETDATE()
                                AND rcpt.race_content_type_uid = " . Constants::RACE_CONTENT_TYPE_TIPSTERS_VERDICTS . "
                            )
                    THEN phrg.varchar_255 ELSE NULL END,";

            $additionJoinsSql = "LEFT JOIN horse_sex hs ON hs.horse_sex_code = m.horse_sex_code
                                    LEFT JOIN horse_colour hc ON hc.horse_colour_code = m.horse_colour_code";
        }
        $sql = sprintf($sql, $additionalSelectSql, $longSpotlightSql, $shortSpotlightSql, $additionJoinsSql);

        $builder->setSqlTemplate($sql);

        $builder->build();

        $data = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );
        $collection = new GeneralCollection(null, new Horse(), $data);

        if ($groupByRaceId == false) {
            $result =  $collection->toArrayWithRows('horse_uid');

            $fieldsToPopulate = array(
                'horsesRacesSinceLastSurgery',
                'wfaPerAge',
                'horseYearlingAndPlus10',
                'jockeyStatistics'
            );

            $this->populateExtraFields($result, $fieldsToPopulate);
        } else {
            $result =  $collection->toArrayWithRows('race_instance_uid', null, true);
        }
        $this->dropTmpTable(self::TMP_TABLE_NAME);

        return $result;
    }

    /**
     * We create temp table that will contain all required tables for our races
     * because in this way we will avoid doing so much join if we have no records at all
     * and also we will join rest of the table only to records for our race not for all records
     *
     * @param $raceIds
     * @param string $tableName
     * @param string $ageSql
     * @param bool $includeFinishedRaces
     */
    public function createTmpTableMain($raceIds, string $ageSql, bool $includeFinishedRaces)
    {
        $builder = new Builder();

        $builder->setSqlTemplate("SELECT
        phr.saddle_cloth_no,
        phr.draw,
        ri.race_type_code,
        ri.going_type_code,
        phr.race_status_code,
        ri.distance_yard,
        ri.track_code,
        ri.course_uid,
        course_country_code = c.country_code,
        ri.straight_round_jubilee_code,
        phr.eliminator_no,
        h.horse_uid,
        horse_name = h.style_name,
        h.country_origin_code,
        ri.race_instance_uid,
        ri.race_datetime,
        phr.extra_weight_lbs,
        phr.weight_carried_lbs,
        phr.official_rating,
        phr.weight_allowance_lbs,
        phr.rp_postmark,
        phr.rp_owner_choice,
        phr.rp_topspeed,
        phr.non_runner,
        irish_reserve_yn = (
            CASE
                WHEN isnull(rtrim(phr.irish_reserve_yn),'N') = 'N' THEN 'N'
                ELSE rtrim(phr.irish_reserve_yn)
            END
        ),
        allowance = (CASE WHEN phr.weight_allowance_lbs < 1 THEN NULL ELSE phr.weight_allowance_lbs END),
        extra_weight = (CASE WHEN phr.extra_weight_lbs < 1 THEN NULL ELSE phr.extra_weight_lbs END),
        h.horse_colour_code,
        h.horse_sex_code,
        horse_age = {$ageSql},
        sire_id = hsire.horse_uid,
        sire_name = hsire.style_name,
        sire_country = hsire.country_origin_code,
        dam_id = hdam.horse_uid,
        dam_name = hdam.style_name,
        dam_country = hdam.country_origin_code,
        dam_sire_uid = hdam.sire_uid,
        course_and_distance_wins = (CASE WHEN c.country_code IN (". Constants::COUNTRIES_FOR_DISTANCE. ") THEN 0 ELSE NULL END),
        course_wins = (CASE WHEN c.country_code IN (". Constants::COUNTRIES_FOR_DISTANCE. ") THEN 0 ELSE NULL END),
        distance_wins = (CASE WHEN c.country_code IN (". Constants::COUNTRIES_FOR_DISTANCE. ") THEN 0 ELSE NULL END),
        phr.running_conditions,
        h.date_gelded,
        
        phr.jockey_uid,
        phr.forecast_sp_uid,
        phr.horse_head_gear_uid,
        ri.race_group_uid,
        ri.early_closing_race_yn,
        h.horse_date_of_birth,
        h.sire_uid,
        new_trainer_races_count = (
                SELECT
                    (
                        SELECT COUNT(1) + 1
                        FROM horse_race hr
                        WHERE hr.horse_uid = ht.horse_uid
                            AND hr.trainer_uid = ht.trainer_uid
                            AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                            AND hr.race_instance_uid != ri.race_instance_uid
                    )
                FROM horse_trainer ht
                WHERE
                    ht.horse_uid = phr.horse_uid
                    AND ht.trainer_change_date = isnull(
                        (
                            SELECT MIN(hti.trainer_change_date)
                            FROM horse_trainer hti
                            WHERE hti.horse_uid = ht.horse_uid AND hti.trainer_change_date > ri.race_datetime
                         ),
                         '1900-01-01 00:00:00.0'
                    )
                    AND EXISTS (
                        SELECT 1 FROM horse_race hr
                        WHERE
                            hr.horse_uid = ht.horse_uid
                            AND hr.trainer_uid != ht.trainer_uid
                            AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                    )
                HAVING
                    (
                        SELECT COUNT(1) FROM horse_race hr
                        WHERE
                            hr.horse_uid = ht.horse_uid
                            AND hr.trainer_uid = ht.trainer_uid
                            AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                    ) < 2
            )
        INTO " . self::TMP_TABLE_NAME . "      
        FROM
                race_instance ri
                INNER JOIN pre_horse_race phr ON phr.race_instance_uid = ri.race_instance_uid
                INNER JOIN horse h ON h.horse_uid = phr.horse_uid
                INNER JOIN horse hsire ON hsire.horse_uid = h.sire_uid
                INNER JOIN horse hdam ON hdam.horse_uid = h.dam_uid
                INNER JOIN course c ON c.course_uid = ri.course_uid
        WHERE
                phr.race_status_code = (
                    CASE
                        WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                        THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                        ELSE ri.race_status_code
                    END)
        AND ri.race_instance_uid in (:raceIds)
        /*{WHERE}*/
        PLAN '(use optgoal allrows_dss)'");

        $builder->setParam('raceIds', $raceIds);
        if (!$includeFinishedRaces) {
            $builder->where("ri.race_status_code != '" . Constants::RACE_STATUS_RESULTS_STR ."'");
        }

        $builder->build();

        $this->getReadConnection()->execute(
            $builder->getSql(),
            $builder->getParams()
        );
    }

    /**
     * We need to get and add values for jockey_wins, jockey_runs, plus10_horse, yearling_bonus_horse,
     * is_wind_surgery_first_time, is_wind_surgery_second_time, wfa_adjustment and going_winner
     *
     * We don't get them with the main SQL because they use some aggregation functions that are expensive to be executed
     * for every row, so we make separate SQL to take them for all runners at once
     * @param array $runners
     * @param array $fieldsToPopulate Array including fields that are to be populated
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function populateExtraFields(array &$runners, $fieldsToPopulate)
    {

        if (!empty($runners)) {
            // We create a temporary table for horse races information that we need
            // because it is used multiple times in other queries
            $tmpHorseRacesTable = '#tmpHorseRaces';
            $this->createTmpTableHorseRaces($tmpHorseRacesTable);


            // we add a couple of checks below, based on $fieldsToPopulate to refrain from populating not needed fields.
            if (in_array('horsesRacesSinceLastSurgery', $fieldsToPopulate)) {
                $tmpLastSurgeryTable = '#tmpLastSurgery';
                $this->createTmpTableLastSurgery($tmpLastSurgeryTable);

                $horsesRacesSinceLastSurgery = $this->countRacesAfterSurgery(
                    $tmpLastSurgeryTable,
                    $tmpHorseRacesTable
                );
                $this->dropTmpTable($tmpLastSurgeryTable);
            };

            if (in_array('wfaPerAge', $fieldsToPopulate)) {
                // It is safe to provide date of first runner because all runs are from same day and we want only
                // the date not the time
                $wfaPerAge = $this->getWfaPerAges(current($runners)->race_datetime);
            }

            if (in_array('horseYearlingAndPlus10', $fieldsToPopulate)) {
                $horseYearingAndPlus10 = $this->getHorseYearlingAndPlus10();
                $horseGoingWinners = $this->getGoingWinner(
                    $tmpHorseRacesTable
                );
            }

            if (in_array('jockeyStatistics', $fieldsToPopulate)) {
                $jockeyStatistics = $this->getJockeyStatistics($runners);
            }
            $this->dropTmpTable($tmpHorseRacesTable);

            // Add all new fields to $runners
            foreach ($runners as $runner) {
                $id = $runner['horse_uid'];

                if (isset($horseYearingAndPlus10[$id])) {
                    $runner->plus10_horse = $horseYearingAndPlus10[$id]['plus10_horse'] > 0 ? 'Y' : 'N';
                    $runner->yearling_bonus_horse = $horseYearingAndPlus10[$id]['yearling_bonus_horse'] > 0 ? 'Y' : 'N';
                }
                $runner->jockey_wins = $jockeyStatistics[$runner['jockey_uid']]['jockey_wins'] ?? 0;
                $runner->jockey_runs = $jockeyStatistics[$runner['jockey_uid']]['jockey_runs'] ?? 0;

                if (isset($horsesRacesSinceLastSurgery[$id])) {
                    $runner->is_wind_surgery_first_time = $horsesRacesSinceLastSurgery[$id]['race_count'] == 1 ? 'Y' : 'N';
                    $runner->is_wind_surgery_second_time = $horsesRacesSinceLastSurgery[$id]['race_count'] == 2 ? 'Y' : 'N';
                }

                $race_type = $runner->race_type_code;

                if (in_array($race_type, Constants::RACE_TYPE_FLAT_ARRAY)) {
                    $race_type = Constants::COURSE_TYPE_FLAT_CODE;
                }

                $furlongs = round($runner->distance_yard/220);
                if ($furlongs < 6) {
                    $furlongs = 5;
                } elseif ($furlongs == 17) {
                    $furlongs = 16;
                } elseif ($furlongs == 19) {
                    $furlongs = 18;
                } elseif ($furlongs > 19) {
                    $furlongs = 20;
                }

                $runner->wfa_adjustment = $wfaPerAge[$runner->horse_age]->distances[$furlongs]->race_type[$race_type]->weight_allowance_lbs ?? 0;

                $runner->going_winner = isset($horseGoingWinners[$id]) ? 'Y' : 'N';
            }
        }
    }

    /**
     * We get statistics for runs and wins per jockeys
     *
     * @param array $runners
     * @return array
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    private function getJockeyStatistics(array $runners): array
    {
        $jockeyIds = array_map(function ($horse) {
            return $horse['jockey_uid'];
        }, $runners);

        $builder = new Builder();

        $builder->setSqlTemplate("
                        SELECT
                            hr.jockey_uid,
                            jockey_runs = COUNT(1),
                            jockey_wins = ISNULL(SUM(CASE WHEN hr.final_race_outcome_uid IN (1,71) THEN 1 ELSE 0 END),0)
                        FROM
                            race_instance ri
                            JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
                        WHERE
                            hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                            AND ri.race_datetime > DATEADD(DAY, - 14, GETDATE())
                            AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                            AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                            AND hr.jockey_uid IN (:jockeyIds)
                        GROUP BY hr.jockey_uid");

        $builder->setParam('jockeyIds', $jockeyIds);

        $builder->build();

        $data = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );
        $collection = new GeneralCollection(null, new General(), $data);

        return $collection->toArrayWithRows('jockey_uid');
    }

    /**
     * Create a temporary table for horse races for all races of provided horses before current race
     *
     * @param array $horseIds
     * @param string $raceDate
     * @param string $tableName
     */
    private function createTmpTableHorseRaces(string $tableName)
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
                                SELECT
                                    ri.going_type_code,
                                    hr.final_race_outcome_uid,
                                    hr.race_outcome_uid,
                                    hr.horse_uid,
                                    hr.race_instance_uid,
                                    ri.race_datetime,
                                    hr.jockey_uid,
                                    ri.race_status_code,
                                    ri.race_type_code
                                INTO {$tableName}
                                FROM
                                race_instance ri
                                    JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
                                    JOIN " . self::TMP_TABLE_NAME . " m ON m.horse_uid = hr.horse_uid
                                WHERE ri.race_datetime < m.race_datetime
                                    ");

        $builder->build();

        $this->getReadConnection()->execute(
            $builder->getSql(),
            $builder->getParams()
        );
    }

    /**
     * Create a temporary table with information for last surgeries for all Horses that are provided
     *
     * @param array $horseIds
     * @param string $raceDate
     * @param string $tableName
     */
    private function createTmpTableLastSurgery(string $tableName)
    {
        $builder = new Builder();

        $builder->setSqlTemplate("SELECT
                                    hma.horse_uid,
                                    MAX(hma.information_receipt_date) as information_receipt_date
                                    INTO {$tableName}
                                FROM
                                    horse_medical_attributes hma
                                    JOIN " . self::TMP_TABLE_NAME . " m ON m.horse_uid = hma.horse_uid
                                WHERE
                                    hma.medical_type_uid = " . CONSTANTS::WIND_SURGERY_UID . "
                                    AND hma.information_receipt_date < m.race_datetime
                                    GROUP BY hma.horse_uid");

        $builder->build();

        $this->getReadConnection()->execute(
            $builder->getSql(),
            $builder->getParams()
        );
    }

    /**
     * We need to get race counts for every horse that participate after their last surgery.
     * This information is used to calculate some other fields that are part of our response
     * @param string $lastSurgeryTable
     * @param string $horseRacesTable
     * @return array
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    private function countRacesAfterSurgery(
        string $lastSurgeryTable,
        string $horseRacesTable
    ): array {
        $builder = new Builder();

        $builder->setSqlTemplate("
                                  SELECT COUNT(1) as race_count,
                                        main.horse_uid,
                                        main.information_receipt_date
                                  FROM
                                    (
                                    SELECT
                                        lst.horse_uid,
                                        lst.information_receipt_date
                                        FROM 
                                         {$lastSurgeryTable} lst 
                                        JOIN {$horseRacesTable} hrt ON lst.horse_uid = hrt.horse_uid
                                        WHERE
                                         hrt.race_datetime > lst.information_receipt_date
                                            AND hrt.race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                                  UNION ALL
                                    SELECT
                                       lst.horse_uid,
                                        lst.information_receipt_date
                                  FROM
                                    {$lastSurgeryTable} lst
                                    ) main
                                    GROUP BY main.horse_uid, main.information_receipt_date");

        $builder->build();

        $data = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $collection = new GeneralCollection(null, new General(), $data);

        return $collection->toArrayWithRows('horse_uid');
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
        $this->getReadConnection()->execute($sql, null, null, false);
    }

    /**
     * @param string $raceDate
     * @return array
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getWfaPerAges(string $raceDate): array
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
                                    SELECT weight_allowance_lbs, age, distance_furlongs, race_type_code = '" . Constants::COURSE_TYPE_FLAT_CODE . "'
                                    FROM flat_weight_for_age
                                    WHERE
                                        month = MONTH(:raceDate)
                                        AND weight_allowance_lbs != 0
                                        AND CONVERT(int, month_half_1_or_2) = (
                                            CASE MONTH(:raceDate)
                                                WHEN 2 THEN CASE WHEN DAY(:raceDate) < 15 THEN 1 ELSE 2 END
                                                ELSE CASE WHEN DAY(:raceDate) < 16 THEN 1 ELSE 2 END
                                            END
                                        )
                                    UNION
                                    SELECT weight_allowance_lbs, age, distance_furlongs, race_type_code
                                    FROM jump_weight_for_age
                                    WHERE
                                        month = MONTH(:raceDate)
                                        AND weight_allowance_lbs != 0
                                        ");

        $builder->setParam('raceDate', $raceDate);

        $builder->build();

        $data = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );
        $collection = new GeneralCollection(null, new General(), $data);

        $result = $collection->getGroupedResult([
            'age',
            'distances' => [
                'distance_furlongs',
                'race_type' => [
                    'race_type_code',
                    'weight_allowance_lbs'
                ]
            ]
        ], ['age', 'distance_furlongs', 'race_type_code']);

        return $result;
    }

    /**
     * @param array $horseIds
     * @param int $raceId
     * @return array
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    private function getHorseYearlingAndPlus10(): array
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
                                   SELECT m.horse_uid, 
                                   yearling_bonus_horse = SUM ( CASE 
                                                          WHEN raj.race_attrib_uid = 413 AND htf.to_follow_uid = 18
                                                          THEN 1 ELSE 0 
                                                          END ),
                                   plus10_horse = SUM ( CASE 
                                                          WHEN raj.race_attrib_uid = 481 AND htf.to_follow_uid = 59
                                                          THEN 1 ELSE 0 
                                                          END )
                                  
                                FROM
                                    " . self::TMP_TABLE_NAME . " m
                                    JOIN horse_to_follow htf ON htf.horse_uid = m.horse_uid
                                    JOIN race_attrib_join raj ON m.race_instance_uid = raj.race_instance_uid
                                GROUP BY m.horse_uid
                                    ");


        $builder->build();

        $data = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $collection = new GeneralCollection(null, new General(), $data);

        return $collection->toArrayWithRows('horse_uid');
    }

    /**
     * Get count of races with the same going type code as current race where horse is winner
     *
     * @param array $horseIds
     * @param string $goingTypeCode
     * @param string $horseRacesTable
     * @return array
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    private function getGoingWinner(string $horseRacesTable): array
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
                                   SELECT COUNT(1) as winner_count, hrt.horse_uid
                                    FROM {$horseRacesTable} hrt
                                    JOIN " . self::TMP_TABLE_NAME . " m ON m.horse_uid = hrt.horse_uid
                                        AND hrt.going_type_code = m.going_type_code
                                    WHERE
                                      hrt.final_race_outcome_uid IN (" . Constants::WINNER_IDS . ")
                                    GROUP BY hrt.horse_uid
                                    ");

        $builder->build();

        $data = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $collection = new GeneralCollection(null, new General(), $data);

        return $collection->toArrayWithRows('horse_uid');
    }
    /**
     * @param $ids
     * @return array
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getFirstSeasonSire($ids)
    {
        $builder = new Builder();


        $builder->setSqlTemplate("
            SELECT
            h.horse_uid,
            to_follow_uid
            FROM horse h
            LEFT JOIN horse_to_follow htf
            ON htf.horse_uid = h.sire_uid
            WHERE h.horse_uid IN (:horsesUid) 
            AND to_follow_uid IN (
            " . Constants::FIRST_SEASON_NORTHERN_HEMISPHERE_FOLLOW_UID . ", 
            " . Constants::FIRST_SEASON_SOUTHERN_HEMISPHERE_FOLLOW_UID . "
            )
            ORDER BY to_follow_uid
        ");

        $builder->setParam('horsesUid', $ids);
        $builder->build();

        $data = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );
        $collection = new GeneralCollection(null, new Horse(), $data);

        return $collection->getGroupedResult(
            [
                'horse_uid',
                'first_season_sire_ids' => [
                    'to_follow_uid'
                ]
            ],
            ['horse_uid', 'to_follow_uid']
        );
    }

    /**
     * @param $raceId
     * @return array
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getHorseOwnerGroups($raceIds)
    {
        // we need coolMoreOwnerGroupsIDS as an array with only the values from the constants to use in the SQL
        // to exclude/include horses depending on the IDS.
        $coolMoreOwnerGroupsIDS = array_values(Constants::COOLMORE_OWNER_GROUPS_TO_HORSE_IDS);
        $res = $this->getReadConnection()->query(
            "
                SELECT
                    phr.horse_uid,
                    owner_group_uid = rc.rabbah_uid,
                    to_follow_uid = null
                FROM pre_horse_race phr
                    INNER JOIN race_instance ri ON ri.race_instance_uid = phr.race_instance_uid
                    INNER JOIN horse_owner ho ON ho.horse_uid = phr.horse_uid AND
                        ho.owner_change_date = isnull(
                                (
                                SELECT
                                    MIN(hoi.owner_change_date)
                                FROM horse_owner hoi
                                WHERE hoi.horse_uid = ho.horse_uid
                                    AND hoi.owner_change_date >= ri.race_datetime
                                ),
                            CONVERT(DATETIME, '" . Constants::EMPTY_DATE . "')
                        )
                    INNER JOIN rabbah_config rc ON rc.owner_uid = ho.owner_uid
                    INNER JOIN horse_to_follow htf ON htf.horse_uid = phr.horse_uid
                        AND htf.to_follow_uid = rc.to_follow_uid
                WHERE phr.race_instance_uid IN (:raceIds)
                    AND htf.to_follow_uid NOT IN (:coolMoreOwnerGroupsIDS)
                    AND phr.race_status_code = (
                        CASE 
                            WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                            THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                            ELSE ri.race_status_code
                        END
                    )
                    -- we need this union because we do not always have records in rabbah_config table for
                   -- coolmore horses and to take all of them we need to get records from horse_to_follow not from rabbah_config
                UNION
                 SELECT
                    phr.horse_uid,
                    owner_group_uid = null,
                    htf.to_follow_uid
                    FROM pre_horse_race phr
                        INNER JOIN race_instance ri ON ri.race_instance_uid = phr.race_instance_uid
                        INNER JOIN horse_to_follow htf ON htf.horse_uid = phr.horse_uid
                    WHERE phr.race_instance_uid IN (:raceIds)
                        AND phr.race_status_code = (
                            CASE 
                                WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                                THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                                ELSE ri.race_status_code
                            END
                        )
                        AND htf.to_follow_uid IN (:coolMoreOwnerGroupsIDS)

            ",
            [
                'raceIds' => $raceIds,
                'coolMoreOwnerGroupsIDS' => $coolMoreOwnerGroupsIDS
            ]
        );
        $groups = new GeneralCollection(null, new GeneralRow(), $res);

        return $groups->toArrayWithRows('horse_uid', null, true);
    }

    /**
     * This query is used to retrieve first time gelding data for pre race data joining pre_horse_race table
     *
     * @param array $raceIds
     * @return array
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getGeldingFirstTimeRunners($raceIds)
    {
        $sql = "
            SELECT DISTINCT
                h.horse_uid
            FROM horse h
                INNER JOIN pre_horse_race phr ON phr.horse_uid = h.horse_uid
                INNER JOIN race_instance ri ON ri.race_instance_uid = phr.race_instance_uid
            WHERE
                ri.race_instance_uid IN (:raceIds)
                AND  h.date_gelded IS NOT NULL
                AND NOT EXISTS (
                    SELECT 1 FROM
                        horse_race hr2
                        INNER JOIN race_instance ri2 ON ri2.race_instance_uid = hr2.race_instance_uid
                    WHERE h.horse_uid = hr2.horse_uid
                        AND ri2.race_datetime > h.date_gelded
                        AND ri2.race_datetime < ri.race_datetime
                        AND hr2.final_race_outcome_uid NOT IN (:nonRunners)
                    )
            ";


        $res = $this->getReadConnection()->query(
            $sql,
            [
                'raceIds' => $raceIds,
                'nonRunners' => Constants::NON_RUNNER_IDS_ARRAY,
            ]
        );
        $collection = new GeneralCollection(null, new GeneralRow(), $res);

        return $collection->toArrayWithRows('horse_uid');
    }

    /**
     * @param $horseIds
     * @param $raceDate
     *
     * @return array
     */
    public function getDaysSinceLastRun($horseIds, $raceDate)
    {
        $sql = "
            SELECT
                t2.horse_uid,
                t2.race_type_code,
                days_since_run = MIN(t2.days_since_run)
            FROM
                (
                    SELECT
                        t.horse_uid,
                        race_type_code = (
                            CASE
                                WHEN t.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ") THEN '" . Constants::RACE_TYPE_FLAT_ALIAS . "'
                                WHEN t.race_type_code IN (" . Constants::RACE_TYPE_JUMPS . ") THEN '" . Constants::RACE_TYPE_JUMPS_ALIAS . "'
                                WHEN t.race_type_code = " . Constants::RACE_TYPE_P2P . " THEN 'ptp'
                            END
                        ),
                        days_since_run = datediff(DAY, ISNULL(MAX(race_datetime), %s), %s)
                    FROM
                        (
                            SELECT
                                hr.horse_uid,
                                ri.race_datetime,
                                ri.race_type_code
                            FROM
                                race_instance ri,
                                horse_race hr
                            WHERE
                                ri.race_instance_uid = hr.race_instance_uid
                                AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                                AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                                AND hr.horse_uid IN (:horseIds)
                        ) t
                    GROUP BY t.horse_uid, t.race_type_code
                ) t2
            GROUP BY t2.horse_uid, t2.race_type_code
            ORDER BY t2.horse_uid
        ";

        $raceDate = $this->getReadConnection()->escapeString($raceDate);
        $sql = sprintf($sql, $raceDate, $raceDate);

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'horseIds' => $horseIds,
            ]
        );

        $collection = new GeneralCollection(null, new GeneralRow(), $res);

        return $collection->toArrayWithRows('horse_uid', null, true);
    }

    /**
     * @param $horseUids
     * @param $raceType
     * @param $raceDatetime
     *
     * @return array
     */
    public function getHorseForms($horseUids, $raceType, $raceDatetime)
    {
        $sql = "
            SELECT hr.horse_uid,
            ri.distance_yard,
            ri.straight_round_jubilee_code,
            ri.track_code,
            ri.course_uid,
            ri.race_type_code,
            c.country_code
            FROM
                race_instance ri
                JOIN horse_race hr ON ri.race_instance_uid = hr.race_instance_uid
                JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
                JOIN course c ON c.course_uid = ri.course_uid
            WHERE
                ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                AND   ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
                AND   hr.horse_uid IN(:horseUids)
                AND ri.race_datetime < :raceDatetime
                AND ri.race_type_code %s IN (" . Constants::RACE_TYPE_FLAT . ")
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND ri.race_type_code IS NOT NULL
                AND ro.race_outcome_position = 1
            ORDER BY hr.horse_uid
        ";

        if (strpos(Constants::RACE_TYPE_FLAT, $raceType) !== false) {
            $sql = sprintf($sql, '');
        } else {
            $sql = sprintf($sql, 'NOT');
        }

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'horseUids' => $horseUids,
                'raceDatetime' => $raceDatetime,
            ]
        );

        $result = new GeneralCollection(null, new GeneralRow(), $res);

        return $result->toArrayWithRows('horse_uid', null, true);
    }

    /**
     * @param $horseUids
     * @param $raceIds
     * @return array
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getHorseFormsPerRaces($horseUids, $raceIds)
    {
        $sql = "
            SELECT hr.horse_uid,
            ri.distance_yard,
            ri.straight_round_jubilee_code,
            ri.track_code,
            ri.course_uid,
            ri.race_type_code,
            c.country_code
            FROM
                race_instance ri
                JOIN horse_race hr ON ri.race_instance_uid = hr.race_instance_uid
                JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
                JOIN course c ON c.course_uid = ri.course_uid
                JOIN (
                     SELECT
                            ri2.race_instance_uid,
                            horse_uid,
                            race_datetime,
                            race_type_code
                     FROM race_instance ri2
                         JOIN pre_horse_race phr ON ri2.race_instance_uid = phr.race_instance_uid
                         JOIN course c2 ON c2.course_uid = ri2.course_uid
                            AND phr.race_status_code = (
                                    CASE
                                        WHEN ri2.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                                        THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                                        ELSE ri2.race_status_code
                                    END)
                     WHERE ri2.race_instance_uid IN (:raceIds)
                        AND c2.country_code IN (". Constants::COUNTRIES_FOR_DISTANCE. ")
                        AND NOT EXISTS (
                            SELECT 1 
                            FROM race_attrib_join 
                            WHERE race_instance_uid = ri2.race_instance_uid 
                              AND race_attrib_uid IN (" . Constants::INCOMPLETE_CARD_ATTRIBUTE_ID . "," . Constants::INCOMPLETE_RACE_ATTRIBUTE_ID . "))
                        
                     ) ri_current ON ri_current.horse_uid = hr.horse_uid
            WHERE
                ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                AND   ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
                AND   hr.horse_uid IN (:horseUids)
                AND ri.race_datetime < ri_current.race_datetime
                AND (
                    (ri_current.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                        AND ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . "))
                    OR
                    (ri_current.race_type_code NOT IN (" . Constants::RACE_TYPE_FLAT . ")
                        AND ri.race_type_code NOT IN (" . Constants::RACE_TYPE_FLAT . "))
                )
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND ri.race_type_code IS NOT NULL
                AND ro.race_outcome_position = 1
            ORDER BY hr.horse_uid
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'horseUids' => $horseUids,
                'raceIds' => $raceIds
            ]
        );

        $result = new GeneralCollection(null, new GeneralRow(), $res);

        return $result->toArrayWithRows('horse_uid', null, true);
    }

    /**
     * @param $horseUids
     * @param $raceType
     * @param $raceDatetime
     *
     * @return array
     */
    public function getBeatenFavourites($horseUids, $raceType, $raceDatetime)
    {
        $sql = "
            SELECT hr.horse_uid
            FROM
                race_instance ri
                JOIN horse_race hr ON ri.race_instance_uid = hr.race_instance_uid
                JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
                JOIN odds o  ON o.odds_uid = hr.starting_price_odds_uid
            WHERE
                ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                AND   ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
                AND   hr.horse_uid IN(:horseUids)
                AND ri.race_datetime = (
                    SELECT MAX(ri2.race_datetime)
                    FROM race_instance ri2
                        JOIN horse_race hr2 ON ri2.race_instance_uid = hr2.race_instance_uid
                        JOIN race_outcome ro2 ON ro2.race_outcome_uid = hr2.final_race_outcome_uid
                    WHERE
                        ri2.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                        AND ro2.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
                        AND hr2.horse_uid = hr.horse_uid
                        AND ri2.race_type_code %s IN (" . Constants::RACE_TYPE_FLAT . ")
                        AND ri2.race_datetime < :raceDatetime
                )
                AND ri.race_type_code %s IN (" . Constants::RACE_TYPE_FLAT . ")
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND ri.race_type_code IS NOT NULL
                AND o.favourite_flag IN (" . Constants::FAVOURITE_FLAG_CODES . ")
                AND ro.race_outcome_position != 1
            ORDER BY hr.horse_uid
        ";

        //Get flat and jump as array and get what we need
        $flatBeatenFaouritesSQL = sprintf($sql, '', '');
        $jumpBeatenFaouritesSQL = sprintf($sql, 'NOT', 'NOT');

        $params = [
            'horseUids' => $horseUids,
            'raceDatetime' => $raceDatetime,
        ];

        $key = 'horse_uid';

        if (!empty($raceType)) {
            if (strpos(Constants::RACE_TYPE_FLAT, $raceType) !== false) {
                $result = $this->getArrayWithKeysFromSql($flatBeatenFaouritesSQL, $params, $key);
            } else {
                $result= $this->getArrayWithKeysFromSql($jumpBeatenFaouritesSQL, $params, $key);
            }
        } else {
            $result[Constants::RACE_TYPE_FLAT_ALIAS] = $this->getArrayWithKeysFromSql($flatBeatenFaouritesSQL, $params, $key);
            $result[Constants::RACE_TYPE_JUMPS_ALIAS] = $this->getArrayWithKeysFromSql($jumpBeatenFaouritesSQL, $params, $key);
        }

        return $result;
    }

    private function getArrayWithKeysFromSql($sql, $params, $key)
    {
        $res = $this->getReadConnection()->query(
            $sql,
            $params
        );

        $res  = new GeneralCollection(null, new GeneralRow(), $res);

        return $res->toArrayWithRows($key);
    }

    /**
     * Fetch RP Ratings improver data for each runner in a given race
     *
     * @param array $horseIds
     * @param string $raceDate
     * @param string $raceType
     *
     * @return array
     */
    public function fetchImproverData($raceIds)
    {
        $sql = "
            SELECT
                hr.horse_uid,
                date_diff = datediff(DAY, ri.race_datetime, getdate()),
                ri.race_type_code,
                hr.rp_postmark
            FROM race_instance ri
                JOIN horse_race hr ON ri.race_instance_uid = hr.race_instance_uid
                JOIN (
                     SELECT
                            ri2.race_instance_uid,
                            horse_uid,
                            race_datetime,
                            race_type_code
                     FROM race_instance ri2
                         LEFT JOIN pre_horse_race phr2 ON ri2.race_instance_uid = phr2.race_instance_uid
                     WHERE ri2.race_instance_uid IN (:raceIds)
                     ) ri_current ON ri_current.horse_uid = hr.horse_uid
                JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
                JOIN odds o ON o.odds_uid = hr.starting_price_odds_uid
            WHERE ri.race_datetime < ri_current.race_datetime
                AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                AND 
                (
                    (ri_current.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                        AND ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . "))
                    OR
                    (ri_current.race_type_code NOT IN (" . Constants::RACE_TYPE_FLAT . ")
                        AND ri.race_type_code IN (" . Constants::RACE_TYPE_JUMPS . "))
                )
                AND ro.race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
            GROUP BY
                hr.horse_uid,
                ri.race_datetime,
                datediff(DAY, ri.race_datetime, getdate()),
                ri.race_type_code,
                ro.race_outcome_code,
                ri.distance_yard,
                isnull(o.favourite_flag, 'qq'),
                ri.straight_round_jubilee_code,
                ri.track_code,
                ri.course_uid,
                hr.rp_postmark
            ORDER BY
                horse_uid,
                ri.race_datetime DESC
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'raceIds' => $raceIds,
            ]
        );

        $collection = new GeneralCollection(null, new GeneralRow(), $res);

        return $collection->toArrayWithRows('horse_uid', null, true);
    }

    /**
     * @param array $horseUids
     *
     * @return array
     */
    public function getGoingPerformance(array $horseUids)
    {
        $sql = "
            SELECT
                hr.horse_uid,
                slow_ground_flat_wins = SUM(
                    CASE WHEN ri.going_type_code IN (" . self::SLOW_GROUND_FLAT_WINS . ")
                        AND ri.race_type_code = " . Constants::RACE_TYPE_FLAT_TURF . "
                    THEN 1 ELSE 0 END
                ),
                slow_ground_jumps_wins = SUM(
                    CASE WHEN ri.going_type_code IN (" . self::SLOW_GROUND_JUMPS_WINS . ")
                        AND ri.race_type_code IN ("
            . Constants::RACE_TYPE_HUNTER_CHASE . ", "
            . Constants::RACE_TYPE_NH_FLAT . ", "
            . Constants::RACE_TYPE_CHASE_TURF . ", "
            . Constants::RACE_TYPE_HURDLE_TURF . ")
                    THEN 1 ELSE 0 END
                ),
                fast_ground_wins = SUM(
                    CASE WHEN ri.going_type_code IN (" . self::FAST_GROUND_WINS . ") AND ri.race_type_code IN ("
            . Constants::RACE_TYPE_FLAT_TURF . ", "
            . Constants::RACE_TYPE_HUNTER_CHASE . ", "
            . Constants::RACE_TYPE_NH_FLAT . ", "
            . Constants::RACE_TYPE_CHASE_TURF . ", "
            . Constants::RACE_TYPE_HURDLE_TURF . ")
                    THEN 1 ELSE 0 END
                )
            FROM
                race_instance ri
                JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
                JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid
            WHERE
                hr.final_race_outcome_uid IN (1, 71)
                AND hr.horse_uid IN (:horseIds)
            GROUP BY hr.horse_uid
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'horseIds' => $horseUids
            ]
        );

        $result = new GeneralCollection(null, new GeneralRow(), $res);

        return $result->toArrayWithRows('horse_uid');
    }

    /**
     * @param array $horses
     *
     * @return array
     */
    public function getPreviousTrainers(array $horses)
    {
        $sql = "
                SELECT
                    ht.horse_uid
                    , ht.trainer_uid
                    , ht.trainer_change_date
                    , trainer_search_name = t.mirror_name 
                    , trainer_ptp_type_code = t.ptp_type_code
                FROM horse_trainer ht
                LEFT JOIN trainer t ON t.trainer_uid = ht.trainer_uid
                WHERE
                    ht.horse_uid IN (:horses)
                    AND ht.trainer_change_date > '1900'
                    AND ht.trainer_change_date = (
                        SELECT MAX(ht2.trainer_change_date) FROM horse_trainer ht2
                        WHERE ht2.horse_uid = ht.horse_uid 
                    )
                ORDER BY
                    ht.horse_uid
                    , ht.trainer_change_date DESC
              ";

        $res = $this->getReadConnection()->query(
            $sql,
            ['horses' => $horses]
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return $result->toArrayWithRows('horse_uid');
    }

    /**
     * Method used to get tipster data for racecards-results.
     * @param int $raceId
     * @return mixed
     */
    public function getTipsterData($raceId)
    {
        $builder = new Builder();

        $builder->setSqlTemplate(
            "
            SELECT
              np.newspaper_name,
              np.newspaper_uid,
              ts.horse_uid,
              selection_type = st.selection_type_code,
              tipster_name = '' 
            FROM tipster_selection ts
            JOIN newspapers np ON ts.newspaper_uid = np.newspaper_uid
            JOIN selection_type st ON ts.selection_type_uid = st.selection_type_uid
            JOIN race_content_publish_time rcpt 
                 ON rcpt.race_content_publish_race_uid = ts.race_instance_uid
                 AND rcpt.race_content_publish_time <= GETDATE()
                 AND rcpt.race_content_type_uid = " . Constants::RACE_CONTENT_TYPE_TIPSTERS_VERDICTS . "
            WHERE 
            /*{WHERE}*/
            AND np.sort_order is not null
            "
        );

        if (is_array($raceId)) {
            $builder->where("ts.race_instance_uid in (:raceId)");
        } else {
            $builder->where("ts.race_instance_uid = :raceId");
        }

        $builder
            ->setParam('raceId', $raceId);

        $builder->build();

        $result = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $result
        );
        return $result->toArrayWithRows();
    }

    /**
     * Method used to get premium tipster data for racecards-results.
     * @param int $raceId
     * @return mixed
     */
    public function getPremiumTipsterData($raceId)
    {
        $builder = new Builder();

        $builder->setSqlTemplate(
            "
            SELECT
              np.newspaper_name,
              np.newspaper_uid,
              vs.horse_uid,
              selection_type = '',
              rt.tipster_name
            FROM pre_race_tipster_verdicts prtv
            JOIN newspapers np ON prtv.newspaper_uid = np.newspaper_uid
            JOIN verdict_selection vs ON vs.tipster_uid = prtv.tipster_uid
              AND vs.race_instance_uid = prtv.race_instance_uid
              AND vs.newspaper_uid = prtv.newspaper_uid
            JOIN rp_tipsters rt ON prtv.tipster_uid = rt.tipster_uid
            JOIN race_content_publish_time rcpt 
                ON rcpt.race_content_publish_race_uid = prtv.race_instance_uid
                AND rcpt.race_content_publish_time <= GETDATE()
                AND rcpt.race_content_type_uid = " . Constants::RACE_CONTENT_TYPE_TIPSTERS_VERDICTS . "
            WHERE prtv.race_instance_uid = :raceId
            AND np.sort_order is null
            "
        );

        $builder
            ->setParam('raceId', $raceId);

        $builder->build();

        $result = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $result
        );
        return $result->toArrayWithRows();
    }

    public function getSelectionsCount(array $raceIds)
    {
        $builder = new Builder();


        $builder->setSqlTemplate(
            "
                SELECT COUNT(1) as selection_count
                    , h.horse_uid
                FROM newspapers np
                    JOIN rp_tipsters rpt ON (np.newspaper_uid = rpt.newspaper_uid)
                    JOIN race_instance ri ON ri.race_instance_uid IN (:raceIds)
                    JOIN course c ON c.course_uid = ri.course_uid
                    JOIN tipster_selection_box tsb ON np.newspaper_uid = tsb.newspaper_uid
                        AND tsb.active_flag = 'Y'
                    JOIN tipster_selection ts ON (np.newspaper_uid = ts.newspaper_uid
                            AND ts.race_instance_uid = ri.race_instance_uid
                            AND ts.tipster_uid = rpt.tipster_uid)
                    JOIN horse h ON (h.horse_uid = ts.horse_uid)
                WHERE tsb.country_code = c.country_code
                    AND np.sort_order IS NOT NULL
                GROUP BY h.horse_uid
            "
        );

        $builder
            ->setParam('raceIds', $raceIds);

        $builder->build();

        $result = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );


        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $result
        );

        return $result->toArrayWithRows('horse_uid');
    }

    public function createTmpTableForResultsPopulateExtraFields($raceIds)
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
            SELECT
                h.horse_uid,
                ri.race_datetime
            INTO " . self::TMP_TABLE_NAME . "
            FROM race_instance ri
                JOIN pre_horse_race phr ON phr.race_instance_uid = ri.race_instance_uid
                JOIN horse h ON h.horse_uid = phr.horse_uid
            WHERE
                ri.race_instance_uid in (:raceIds)
             AND
                ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
             AND
                phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
            ");

        $builder->setParam('raceIds', $raceIds);

        $builder->build();

        $this->getReadConnection()->execute(
            $builder->getSql(),
            $builder->getParams()
        );
    }

    public function getSalesData($raceId)
    {
        $sql =
            "
               SELECT
                    h.horse_uid,
                    h.style_name
                FROM horse h
                    JOIN pre_horse_race phr ON phr.horse_uid = h.horse_uid
                    JOIN race_instance ri ON ri.race_instance_uid = phr.race_instance_uid
                WHERE
                    ri.race_instance_uid = :raceId
                AND
                    phr.race_status_code = (
                    CASE
                        WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                        THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                        ELSE ri.race_status_code
                    END)
            ";

        $params = [
            'raceId' => $raceId,
        ];

        $results = $this->getReadConnection()->query($sql, $params);

        $result = new \Phalcon\Mvc\Model\Resultset\General(null, new GeneralRow(), $results);

        return $result->toArrayWithRows('horse_uid');
    }
}
