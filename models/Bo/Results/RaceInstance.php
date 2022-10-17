<?php

namespace Models\Bo\Results;

use Api\Constants\Horses as Constants;
use Phalcon\Mvc\Model;
use Phalcon\Db\Column;
use Phalcon\Db\Sql\Builder;
use Phalcon\Mvc\Model\MetaData;
use Phalcon\Mvc\Model\Resultset\General as ResultSet;
use Phalcon\Mvc\Model\Row\General as GeneralRow;
use Phalcon\Mvc\Model\Row\General as Row;

/**
 * Class RaceInstance
 *
 * @package Models\Bo\Results
 */
class RaceInstance extends \Models\RaceInstance
{
    /**
     * @var \Api\DataProvider\Factory\TmpResultsTables
     */
    private $factoryTmpResultTables;

    /**
     * @param \Api\DataProvider\Factory\TmpResultsTables $factory
     */
    public function setFactoryTmpResultTables(\Api\DataProvider\Factory\TmpResultsTables $factory)
    {
        $this->factoryTmpResultTables = $factory;
    }

    /**
     * @return \Api\DataProvider\Factory\TmpResultsTables
     */
    public function getFactoryTmpResultTables()
    {
        return $this->factoryTmpResultTables;
    }

    /**
     * @param $raceId
     * @return array
     * @throws Model\Resultset\ResultsetException
     */
    public function getStatistic($raceId)
    {
        $statistic = $this->getReadConnection()->query(
            "SELECT
                ri.race_instance_uid,
                ri.winners_time_secs,
                ri.course_uid,
                ri.no_of_runners,
                dat.average_time_sec,
                total_sp = NULL, 
                o.odds_value,
                no_of_runners_calculated = NULL,
                c.country_code
            FROM
                race_instance ri
            JOIN
                horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
            LEFT JOIN
                odds o ON o.odds_uid = hr.starting_price_odds_uid
            JOIN course c ON c.course_uid = ri.course_uid 
            LEFT JOIN dist_ave_time dat ON dat.course_uid = ri.course_uid
                AND dat.race_type_code = 
                    CASE
                        WHEN ri.race_type_code = " . Constants::RACE_TYPE_HUNTER_CHASE . "
                        THEN " . Constants::RACE_TYPE_CHASE_TURF . "
                        ELSE ri.race_type_code
                    END
                AND dat.distance_yard = ri.distance_yard
                AND isnull(dat.straight_round_jubilee_code, '*') = isnull(ri.straight_round_jubilee_code, '*')
            WHERE
                ri.race_instance_uid = :race_instance_uid
                AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
            ",
            ['race_instance_uid' => $raceId]
        );

        $statistic = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row(),
            $statistic
        );

        return $statistic->toArrayWithRows();
    }

    /**
     * @param $raceId
     * @return array|null
     * @throws Model\Resultset\ResultsetException
     */
    public function getOddsValue($raceId)
    {
        $oddsValue = $this->getReadConnection()->query(
            "SELECT o.odds_value FROM race_instance ri
              LEFT JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
              LEFT JOIN odds o ON o.odds_uid = hr.starting_price_odds_uid
            WHERE ri.race_instance_uid  = :race_instance_uid  
            ",
            ['race_instance_uid' => $raceId]
        );

        $oddsValue = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\RaceInstance(),
            $oddsValue
        );

        return $oddsValue->toArrayWithRows() ?? null;
    }

    /**
     * @param array $raceIdArray
     *
     * @return array
     */
    public function getTote(array $raceIdArray)
    {

        $sql = "
            SELECT
                race_instance.race_instance_uid,
                race_instance_tote.tote_currency_code,
                race_instance_tote.rule4_value,
                race_instance.race_status_code,
                course.country_code course_country_code,
                DATEDIFF(DAY, '2000-01-21', race_instance.race_datetime) AS days_diff,
                race_instance.race_comments,
                race_instance_tote.tote_deadheat_text,
                race_instance_tote.tote_win_money,
                race_instance_tote.tote_place_1_money,
                race_instance_tote.tote_place_2_money,
                race_instance_tote.tote_place_3_money,
                race_instance_tote.tote_place_4_money,
                race_instance_tote.tote_dual_forecast_money,
                race_instance_tote.computer_strght_frcst_money,
                race_instance_tote.tricast_money,
                race_instance_tote.tote_trio_money,
                race_instance_tote.trio_text,
                meeting_details.jackpot_text,
                meeting_details.placepot_text,
                meeting_details.quadpot_text,
                race_instance_tote.rule4_text,
                race_instance_tote.selling_details_text,
                scoop6_dividend = null
            FROM race_instance_tote
            JOIN race_instance ON race_instance_tote.race_instance_uid  = race_instance.race_instance_uid
            JOIN course ON race_instance.course_uid = course.course_uid
            LEFT JOIN meeting_details ON
                (meeting_details.course_uid = course.course_uid
                AND  DATEDIFF(DD, meeting_details.meeting_date, race_instance.race_datetime) = 0)
            WHERE
                race_instance.race_instance_uid IN (:raceIdArray)";

        $res = $this->getReadConnection()->query(
            $sql,
            ['raceIdArray' => $raceIdArray]
        );
        $resultCollection = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row(),
            $res
        );

        $result =  $resultCollection->toArrayWithRows('race_instance_uid');

        $scoopSQL = "
            SELECT
                ri.race_instance_uid,
                scoop6_dividend
            FROM race_instance ri
            JOIN scoop6_dividends sd ON DATEDIFF(DD, ri.race_datetime, sd.scoop6_datetime) = 0
            INNER JOIN race_selection rs ON ri.race_instance_uid = rs.race_instance_uid
            WHERE rs.race_selection_type = 'S6'
            AND ri.race_instance_uid IN (:raceIdArray)
        ";

        $res = $this->getReadConnection()->query(
            $scoopSQL,
            ['raceIdArray' => $raceIdArray]
        );
        $scoopCollection = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row(),
            $res
        );
        $scoopArray =  $scoopCollection->toArrayWithRows('race_instance_uid');

        foreach ($result as $raceId => $race) {
            $race->scoop6_dividend = $scoopArray[$raceId]->scoop6_dividend ?? null;
        }
        return $result;
    }

    /**
     * @param $date
     *
     * @return array
     */
    public function getFastResultsByDate($date)
    {

        $sql = "
            SELECT
              ri.race_instance_uid,
              ri.race_datetime race_date,
              c.course_name course_name,
              c.country_code course_country,
              fri.fast_race_instance_uid,
              fri.course_name fast_crs_name,
              fri.no_of_runners runners_count,
              fri.tote_win_money,
              fri.dual_forecast,
              fri.csf,
              fri.tricast,
              fri.placepot,
              fri.miscellaneous,
              fhr.race_outcome_position r_outcome_pos,
              fhr.horse_name horse_style_name,
              fhr.starting_price odds_desc

            FROM fast_race_instance fri
            INNER JOIN fast_horse_race fhr ON  fri.fast_race_instance_uid = fhr.fast_race_instance_uid
            INNER JOIN course c ON UPPER(c.course_name) + ' (' + c.country_code + ')'  LIKE UPPER(fri.course_name) + '%'
            INNER JOIN race_instance ri ON ri.race_datetime > :start_date
                AND ri.course_uid = c.course_uid
                AND ri.race_datetime = fri.race_datetime
            INNER JOIN race_group rg  ON ri.race_group_uid = rg.race_group_uid
            WHERE fri.race_datetime BETWEEN :start_date AND :end_date
            ORDER BY ri.race_datetime, fhr.race_outcome_position
        ";

        $params["start_date"] = $date . " 00:00:00";
        $params["end_date"] = $date . " 23:59:59";

        $results = $this->getReadConnection()->query($sql, $params);

        $res = new Model\Resultset\General(null, new Model\Row(), $results);

        return $res->toArrayWithRows('race_instance_uid');
    }

    /**
     * @param string $date
     * @param bool   $showAllRaces
     * @param bool   $returnP2P
     *
     * @return array
     */
    public function getRaceListByDate($date, $showAllRaces, $returnP2P)
    {
        $sql = "
            SELECT
                tmp.*,
                ri.rp_analysis,
                gt.going_type_desc,
                cc.rp_admission_prices,
                total_sp = null
            FROM
                (
                SELECT
                    ri.race_instance_uid,
                    ri.race_datetime,
                    ri.race_instance_title,
                    ri.alt_race_title,
                    ri.formbook_yn,
                    ri.going_type_code,
                    race_class = null,
                    aw_surface_type = null,
                    ri.race_type_code,
                    ri.distance_yard r_dist,
                    aa.rp_ages_allowed_desc,
                    ri.race_status_code r_status,
                    c.course_uid  crs_id,
                    CASE WHEN c2.course_uid IS NOT NULL AND c2.course_uid != c.course_uid
                        THEN c2.course_uid END mixed_crs_id,
                    c.course_name course_name,
                    c.style_name course_style_name,
                    c.mnemonic mnemonic,
                    CASE WHEN c.mnemonic != c2.mnemonic THEN 1 ELSE NULL END replaced_aw,
                    CASE WHEN ri.race_status_code = " . Constants::RACE_STATUS_ABANDONED . " THEN 1 ELSE 0 END abandoned,
                    c.rp_abbrev_3,
                    rtrim(c.country_code) course_country,
                    c.course_type_code,
                    c3dg.graphic_name,
                    c3dg.graphic_height,
                    cc.rp_flat_course_comment,
                    cc.rp_jump_course_comment,
                    md.going_desc,
                    md.weather_cond,
                    CASE WHEN mdc.meeting_digital_order IS NULL THEN 1 ELSE 0 END additional_ordering,
                    ri.no_of_runners,
                        (
                        SELECT COUNT(1)
                        FROM horse_race hr2
                        WHERE hr2.race_instance_uid = ri.race_instance_uid
                            AND hr2.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                        ) AS no_of_runners_calculated,
                    md.stalls_position,
                    CASE WHEN c.country_code = 'IRE' THEN rip.prize_euro ELSE rip.prize_sterling END prize,
                    ri.pool_prize_sterling,
                    NULL totes,
                    ri.winners_time_secs winner_time,
                    diff_to_standard_time_sec = ri.winners_time_secs - dat.average_time_sec,
                    sel.race_selection_type scoop,
                    rg.race_group_desc,
                    rg.race_group_code,
                    (CASE WHEN c.country_code IN ('GB', 'IRE') THEN 1 ELSE 0 END) is_gb_or_ire,
                    (CASE WHEN EXISTS (
                        SELECT phr.horse_uid
                        FROM pre_horse_race phr
                        WHERE phr.race_instance_uid = ri.race_instance_uid
                            AND phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . ") THEN 1 ELSE 0 END
                     ) has_details,
                    ri.rp_omitted_fences,
                    dat.no_of_fences,
                    srjc.straight_round_jubilee_code,
                    srjc.straight_round_jubilee_desc,
                    srjc.rp_straight_round_jubilee_desc,
                    is_worldwide_stake = CASE WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                        AND ri.race_group_uid IN (1, 2, 3, 4, 5, 7, 8, 9, 11, 12, 13) THEN 1 ELSE 0 END,
                    horse_eyecatcher.horse_uid AS eyecatcher_horse_uid,
                    horse_eyecatcher.style_name AS eyecatcher_style_name,
                    horse_eyecatcher.country_origin_code AS eyecatcher_country_code,
                    CONVERT(VARCHAR(1000), hrn_eyecatcher.notes) AS eyecatcher_notes,
                    horse_star_performer.horse_uid AS star_performer_horse_uid,
                    horse_star_performer.style_name AS star_performer_style_name,
                    horse_star_performer.country_origin_code AS star_performer_country_code,
                    CONVERT(VARCHAR(1000), hrn_star_performer.notes) AS star_performer_notes,
                    fri.fast_race_instance_uid,
                    orb.official_rating_band_desc,
                    c3.country_desc,
                    md.wind,
                    pric.rp_tv_text
                FROM
                    course c
                    INNER JOIN race_instance ri ON ri.course_uid = c.course_uid
                        AND ri.race_datetime BETWEEN :start_date AND :end_date
                        %s
                    LEFT JOIN course_3d_graphics c3dg ON c3dg.course_uid = c.course_uid
                        AND c3dg.course_type_code = c.course_type_code
                    LEFT JOIN course_comments cc ON cc.course_uid = c.course_uid
                    LEFT JOIN meeting_details md ON md.course_uid = ri.course_uid
                        AND md.meeting_date BETWEEN convert(SMALLDATETIME, :date)
                        AND convert(SMALLDATETIME, :date)
                    LEFT JOIN meeting_digital_colours mdc ON mdc.course_uid = c.course_uid
                        AND mdc.meeting_date BETWEEN convert(DATETIME, :date) AND convert(DATETIME, :date)
                    LEFT JOIN course c2 ON -- Mixed meeting checking
                        c.rp_abbrev_3 = c2.rp_abbrev_3
                        AND c.country_code = c2.country_code
                        AND c2.course_uid IN (" . Constants::MIXED_COURSES_IDS . ")
                        AND EXISTS (
                            SELECT 1
                            FROM race_instance ri2
                            WHERE ri2.race_datetime BETWEEN :start_date AND :end_date
                                AND ri2.course_uid != c.course_uid
                                AND ri2.course_uid = c2.course_uid
                            )
                    LEFT JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid
                    LEFT JOIN ages_allowed aa ON aa.ages_allowed_uid = ri.ages_allowed_uid
                    LEFT JOIN race_instance_prize rip
                        ON rip.race_instance_uid = ri.race_instance_uid AND rip.position_no = 1
                    LEFT JOIN race_selection sel ON (ri.race_instance_uid = sel.race_instance_uid)
                    LEFT JOIN dist_ave_time dat ON dat.course_uid = ri.course_uid
                        AND dat.race_type_code = 
                            CASE
                                WHEN ri.race_type_code = " . Constants::RACE_TYPE_HUNTER_CHASE . "
                                THEN " . Constants::RACE_TYPE_CHASE_TURF . "
                                ELSE ri.race_type_code
                            END
                        AND dat.distance_yard = ri.distance_yard
                        AND isnull(dat.straight_round_jubilee_code, '-') = isnull(ri.straight_round_jubilee_code, '-')
                    LEFT JOIN straight_round_jubilee srjc
                        ON ri.straight_round_jubilee_code = srjc.straight_round_jubilee_code
                    LEFT JOIN horse_race_notes AS hrn_eyecatcher
                        ON hrn_eyecatcher.race_instance_uid = ri.race_instance_uid
                        AND hrn_eyecatcher.notes_type_code = " . Constants::NOTES_TYPE_CODE_EYECATCHER . "
                    LEFT JOIN horse_race_notes AS hrn_star_performer
                        ON hrn_star_performer.race_instance_uid = ri.race_instance_uid
                        AND hrn_star_performer.notes_type_code = " . Constants::NOTES_TYPE_CODE_STAR_PERFORMER . "
                    LEFT JOIN horse AS horse_eyecatcher ON horse_eyecatcher.horse_uid = hrn_eyecatcher.horse_uid
                    LEFT JOIN horse AS horse_star_performer
                        ON horse_star_performer.horse_uid = hrn_star_performer.horse_uid
                    LEFT JOIN fast_race_instance AS fri ON ri.race_datetime = fri.race_datetime
                        AND c.course_name + ' (' + c.country_code + ')' LIKE fri.course_name + '%%'
                        AND EXISTS (
                            SELECT 1 FROM fast_horse_race WHERE fast_race_instance_uid = fri.fast_race_instance_uid
                        )
                    LEFT JOIN official_rating_band orb ON orb.official_rating_band_uid = ri.official_rating_band_uid
                    LEFT JOIN country c3 ON c.country_code = c3.country_code
                    LEFT JOIN pre_race_instance_comments pric 
                      ON pric.race_instance_uid = ri.race_instance_uid
                %s
                ) tmp
                JOIN race_instance ri ON tmp.race_instance_uid = ri.race_instance_uid
                LEFT JOIN course_comments cc ON cc.course_uid = tmp.crs_id
                LEFT JOIN going_type gt ON tmp.going_type_code = gt.going_type_code
            ORDER BY
                tmp.abandoned,
                tmp.additional_ordering,
                tmp.is_gb_or_ire DESC,
                tmp.race_datetime,
                tmp.rp_abbrev_3
            PLAN'(use optgoal allrows_dss)'
            ";

        $params["date"] = $date;
        $params["start_date"] = $date . ' 00:00:00';
        $params["end_date"] = $date . ' 23:59:59';

        $whereSql = null;
        $ptpSql = null;
        if (!$showAllRaces) {
            $whereSql = 'WHERE
                            NOT EXISTS (
                               SELECT 1 FROM race_attrib_join
                               WHERE race_instance_uid = ri.race_instance_uid AND race_attrib_uid = 432
                            )
                            OR c.course_uid IN (' . Constants::FRENCH_COURSES . ')';
        }

        if (!$showAllRaces || !$returnP2P) {
            $ptpSql = 'AND ri.race_type_code != ' . Constants::RACE_TYPE_P2P;
        }

        $res = $this->getReadConnection()->query(
            sprintf($sql, $ptpSql, $whereSql),
            $params
        );
        $races = new ResultSet(null, new \Api\Row\RaceInstance(), $res);

        $races = $races->toArrayWithRows('race_instance_uid');

        // Check that races were actually found - https://racingpost.atlassian.net/browse/AD-1784
        if (!empty($races)) {
            $stakeSQL = "
                SELECT 
                    ri.race_instance_uid, 
                    stake = SUM((1 / (o.odds_value + 1)) * 100) + 0.5
                FROM 
                    race_instance ri 
                    JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
                    JOIN odds o ON o.odds_uid = hr.starting_price_odds_uid
                        AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                WHERE 
                    ri.race_instance_uid IN (:raceIds)
                GROUP BY ri.race_instance_uid
            ";

            $stakes = $this->getReadConnection()->query(
                $stakeSQL,
                [
                    'raceIds' => array_keys($races)
                ]
            );

            $stakes = new ResultSet(null, new Model\Row\General(), $stakes);

            $stakes = $stakes->toArrayWithRows('race_instance_uid');

            $attribSQL = "
                SELECT 
                    raj.race_instance_uid,
                    ral.race_attrib_desc,
                    raj.race_attrib_uid,
                    ral.race_attrib_code
                FROM
                    race_attrib_lookup ral 
                    JOIN race_attrib_join raj ON raj.race_attrib_uid = ral.race_attrib_uid
                WHERE
                    raj.race_instance_uid IN (:raceIds)
            ";

            $attributes = $this->getReadConnection()->query(
                $attribSQL,
                [
                    'raceIds' => array_keys($races)
                ]
            );

            $attributes = new ResultSet(null, new Model\Row\General(), $attributes);

            $attributes = $attributes->getGroupedResult(
                [
                    'race_instance_uid',
                    'attributes' => [
                        'race_attrib_desc',
                        'race_attrib_uid',
                        'race_attrib_code'
                    ]
                ],
                [
                    'race_instance_uid',
                    'race_attrib_uid'
                ]
            );

            foreach ($races as $raceId => $race) {
                $race->total_sp = $stakes[$raceId]->stake ?? null;
                foreach ($attributes[$raceId]->attributes ?? [] as $attr) {
                    if (($race->course_country == Constants::COUNTRY_GB && trim($attr->race_attrib_code) == Constants::RACE_CLASS_SUB_STR)
                        || $attr->race_attrib_code == Constants::RACE_CLASS) {
                        $race->race_class = $attr->race_attrib_desc;
                    }
                    if (in_array($race->race_type_code, Constants::RACE_TYPE_FLAT_AW_ARRAY)
                        && in_array($attr->race_attrib_uid, Constants::SURFACE_RACES_ATTRIBS_ARR)) {
                        $race->aw_surface_type = $attr->race_attrib_desc;
                    }
                }
            }
        }

        return $races;
    }

    /**
     * @param int $raceId
     * @param bool $includeNonRunners
     *
     * @return mixed
     * @throws Model\Resultset\ResultsetException
     */
    public function getRaceInfo(int $raceId, bool $includeNonRunners)
    {
        $tmpTableName = $this->getFactoryTmpResultTables()->getHorseRaceInstance($raceId, $includeNonRunners);

        $sql = "
            SELECT
                ri.course_uid,
                ri.race_instance_title,
                ri.race_datetime,
                ri.race_start_datetime,
                ri.pool_prize_sterling,
                clt.hours_difference,
                ri.race_type_code,
                rg.race_group_desc,
                rg.race_group_uid,
                rg.race_group_code,
                ri.distance_yard,
                ri.rp_omitted_fences,
                ri.early_closing_race_yn,
                ri.rp_analysis,
                c.course_name,
                c.style_name AS course_style_name,
                c.country_code,
                official_rating_band.official_rating_band_desc,
                srj.straight_round_jubilee_code,
                srj.straight_round_jubilee_desc,
                srj.rp_straight_round_jubilee_desc,
                going_type.going_type_desc,
                rtrim(going_type.going_type_code) going_type_code,

                md.meeting_name,
                md.meeting_date,
                md.going_desc,
                md.stalls_position,
                md.misc_text,
                md.weather_cond,
                md.rails,
                md.wind,
                md.meeting_abandoned,
                md.abandoned_reason,
                md.jackpot_text,
                md.placepot_text,
                md.quadpot_text,
                t.number_of_fences,
                dist_ave_time.no_of_fences AS dist_number_of_fences,
                ages_allowed.rp_ages_allowed_desc,

                he.horse_uid AS eyecatcher_horse_uid,
                he.style_name AS eyecatcher_style_name,
                he.country_origin_code AS eyecatcher_country_code,
                hrn_eyecatcher.notes AS eyecatcher_notes,
                hsp.horse_uid AS star_performer_horse_uid,
                hsp.style_name AS star_performer_style_name,
                hsp.country_origin_code AS star_performer_country_code,
                hrn_star_performer.notes AS star_performer_notes,
                ri.race_comments,
                ri.start_flag_yn,
                ri.race_status_code,
                ri.race_instance_uid,
                rit.tote_deadheat_text,
                rit.tote_win_money,
                rit.tote_currency_code,
                rit.tote_place_1_money,
                rit.tote_place_2_money,
                rit.tote_place_3_money,
                rit.tote_place_4_money,
                rit.tote_dual_forecast_money,
                rit.computer_strght_frcst_money,
                rit.tricast_money,
                rit.tote_trio_money,
                rit.trio_text,
                rit.rule4_text,
                rit.rule4_value,
                rit.selling_details_text,
                ral.race_attrib_desc,
                aw_surface_type = null,
                country.country_desc,
                race_surface = null
            FROM {$tmpTableName} ri
            JOIN course c ON ri.course_uid = c.course_uid
            LEFT JOIN race_attrib_join raj ON raj.race_instance_uid = ri.race_instance_uid
                AND raj.race_attrib_uid IN (" . CONSTANTS::SURFACE_RACES_ATTRIBS. ")
            LEFT JOIN race_attrib_lookup ral ON raj.race_attrib_uid = ral.race_attrib_uid 
            LEFT JOIN course_local_time clt ON clt.course_uid = ri.course_uid
                AND ri.race_datetime BETWEEN clt.date_from AND clt.date_to
            LEFT JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid
            LEFT JOIN official_rating_band
                ON ri.official_rating_band_uid = official_rating_band.official_rating_band_uid
            LEFT JOIN straight_round_jubilee srj ON ri.straight_round_jubilee_code = srj.straight_round_jubilee_code
            LEFT JOIN going_type ON going_type.going_type_code = ri.going_type_code
            LEFT JOIN meeting_details md
                ON (md.course_uid = ri.course_uid AND DATEDIFF(dd, md.meeting_date, ri.race_datetime) = 0)
            LEFT JOIN dist_ave_time ON
                dist_ave_time.course_uid = ri.course_uid AND
                dist_ave_time.race_type_code = ri.race_type_code AND
                dist_ave_time.distance_yard = ri.distance_yard AND
                (
                    dist_ave_time.straight_round_jubilee_code = ri.straight_round_jubilee_code
                    OR (dist_ave_time.straight_round_jubilee_code IS NULL AND ri.straight_round_jubilee_code IS NULL)
                )
            LEFT JOIN horse_race_notes AS hrn_eyecatcher ON
                hrn_eyecatcher.race_instance_uid = ri.race_instance_uid AND
                hrn_eyecatcher.horse_uid = ri.horse_uid AND
                hrn_eyecatcher.notes_type_code = " . Constants::NOTES_TYPE_CODE_EYECATCHER . "
            LEFT JOIN horse_race_notes AS hrn_star_performer ON
                hrn_star_performer.race_instance_uid = ri.race_instance_uid AND
                hrn_star_performer.horse_uid = ri.horse_uid AND
                hrn_star_performer.notes_type_code = " . Constants::NOTES_TYPE_CODE_STAR_PERFORMER . "
            LEFT JOIN horse he ON he.horse_uid = hrn_eyecatcher.horse_uid
            LEFT JOIN horse hsp ON hsp.horse_uid = hrn_star_performer.horse_uid
            LEFT JOIN ages_allowed ON ages_allowed.ages_allowed_uid = ri.ages_allowed_uid
            LEFT JOIN race_instance_tote rit ON ri.race_instance_uid = rit.race_instance_uid
            JOIN country ON country.country_code = c.country_code
            LEFT JOIN ext_race_instance eri ON eri.race_instance_uid = ri.race_instance_uid
                AND ri.race_type_code = " . Constants::RACE_TYPE_HUNTER_CHASE . "
            LEFT JOIN track t ON t.track_uid = eri.track_uid
            PLAN '(use optgoal allrows_dss)(nl_join (t_scan ri)(i_scan hrn_eyecatcher))'
         ";

        $res = $this->getReadConnection()->query($sql);
        $generalInfoCollection = new ResultSet(null, new Row(), $res);
        $generalInfo = $generalInfoCollection->getFirst();

        return $generalInfo ? $generalInfo : null;
    }

    /**
     * @param $raceId
     * @return array|null
     * @throws Model\Resultset\ResultsetException
     */
    public function getRaceIds($raceId)
    {
        $tmpTableName = $this->getFactoryTmpResultTables()->getCourseRaceTime($raceId);

        $sql = "
            SELECT
              ri.race_instance_uid,
              ri.race_datetime,
              ri.real_race_datetime
            FROM
              {$tmpTableName} ri
            ORDER BY
              ri.race_datetime
        ";

        $res = $this->getReadConnection()->query($sql);
        $collection = new ResultSet(null, new Row(), $res);
        $res = $collection->toArrayWithRows();

        return $res ?? null;
    }

    /**
     * @param $date
     * @param array $courseIDs
     * @return array
     * @throws Model\Resultset\ResultsetException
     */
    public function getDividends($date, array $courseIDs)
    {
        $result = $this->getReadConnection()->query(
            "SELECT
                ri.course_uid
                , ri.race_instance_uid
                , ri.race_datetime
                , ri.race_type_code
                , flat_or_jumps = CASE
                    WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                    THEN 'F'
                    ELSE
                        CASE WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_JUMPS . ") THEN 'J' END
                END
                , race_double = CASE
                    WHEN COUNT(CASE
                                WHEN hr.final_race_outcome_uid IN (1, 71)
                                THEN hr.saddle_cloth_no ELSE NULL
                                END) != 0
                    THEN
                        SUM(CASE WHEN hr.final_race_outcome_uid IN (1, 71) THEN hr.saddle_cloth_no ELSE 0 END)
                        / COUNT(CASE WHEN hr.final_race_outcome_uid IN (1, 71) THEN hr.saddle_cloth_no ELSE NULL END)
                    ELSE
                        0
                    END
                , race_win_dist = MAX(isnull(
                    CASE WHEN hr.final_race_outcome_uid IN (2, 72)
                    THEN
                        (SELECT SUM(dth.distance_value)
                          FROM horse_race hr2, race_outcome second_ro, race_outcome ro, dist_to_horse dth
                          WHERE hr2.race_instance_uid = ri.race_instance_uid
                            AND ro.race_outcome_uid = hr2.race_outcome_uid
                            AND second_ro.race_outcome_uid = hr.race_outcome_uid
                            AND ro.race_output_order <= second_ro.race_output_order
                            AND dth.dist_to_horse_uid = hr2.dist_to_horse_in_front_uid)
                    ELSE
                        NULL
                    END
                    , 0))
                , dht = SUM(
                    CASE WHEN hr.final_race_outcome_uid IN (71, 72)  
                    THEN 1 
                    ELSE 0 
                    END
                )
                , horses_run = SUM(
                    CASE WHEN hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                    THEN 1
                    ELSE 0
                    END
                )
                , finishing_horses = SUM(
                    CASE WHEN hr.final_race_outcome_uid NOT IN (" . Constants::RACE_OUTCOME_UID_NON_FINISHERS . ")
                    THEN 1
                    ELSE 0
                    END
                )
                , non_runners = SUM(
                    CASE WHEN hr.final_race_outcome_uid IN (" . Constants::NON_RUNNER_IDS . ")
                    THEN 1
                    ELSE 0
                    END
                )
                , race_sp = SUM(
                    CASE WHEN hr.final_race_outcome_uid IN (1, 71)
                    THEN
                        (SELECT round(o.odds_value, 1) FROM odds o WHERE o.odds_uid = hr.starting_price_odds_uid)
                    ELSE
                        NULL
                    END
                )
                , race_sp_count = SUM(
                    CASE WHEN hr.final_race_outcome_uid IN (1, 71)
                    THEN
                        (SELECT 1 FROM odds o WHERE o.odds_uid = hr.starting_price_odds_uid)
                    ELSE
                        0
                    END
                )
                , race_favs_pos = (
                    SELECT
                        ro.race_outcome_position
                    FROM
                        race_outcome ro
                    WHERE
                        ro.race_outcome_uid = (
                            SELECT
                                MIN(hr2.final_race_outcome_uid)
                            FROM
                                horse_race hr2, odds o2
                            WHERE
                                hr2.race_instance_uid = ri.race_instance_uid
                                AND o2.odds_uid = hr2.starting_price_odds_uid
                                AND o2.favourite_flag IN (" . Constants::FAVOURITE_FLAG_CODES . ")
                                AND hr2.saddle_cloth_no = (
                                    SELECT
                                        MIN(hr3.saddle_cloth_no)
                                    FROM
                                        horse_race hr3, odds o3
                                    WHERE
                                        hr3.race_instance_uid = ri.race_instance_uid
                                        AND o3.odds_uid = hr3.starting_price_odds_uid
                                        AND o3.favourite_flag IN (" . Constants::FAVOURITE_FLAG_CODES . ")
                                )
                        )
                )
                , race_favs_count = (
                    SELECT
                        COUNT(ro1.race_outcome_position)
                    FROM
                        horse_race hr1, race_outcome ro1
                    WHERE
                        hr1.race_instance_uid = ri.race_instance_uid
                        AND ro1.race_outcome_uid = hr1.final_race_outcome_uid
                        AND ro1.race_outcome_position = (
                            SELECT
                                ro.race_outcome_position
                            FROM
                                race_outcome ro
                            WHERE
                                ro.race_outcome_uid = (
                                    SELECT
                                        MIN(hr4.final_race_outcome_uid)
                                    FROM
                                        horse_race hr4, odds o4
                                    WHERE
                                        hr4.race_instance_uid = ri.race_instance_uid
                                        AND o4.odds_uid = hr4.starting_price_odds_uid
                                        AND o4.favourite_flag IN (" . Constants::FAVOURITE_FLAG_CODES . ")
                                        AND hr4.saddle_cloth_no = (
                                            SELECT
                                                MIN(hr5.saddle_cloth_no)
                                            FROM
                                                horse_race hr5, odds o5
                                            WHERE
                                                hr5.race_instance_uid = ri.race_instance_uid
                                                AND o5.odds_uid = hr5.starting_price_odds_uid
                                                AND o5.favourite_flag IN (" . Constants::FAVOURITE_FLAG_CODES . ")
                                        )
                                )
                        )
                )
            FROM
                race_instance ri
                JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
            WHERE
                ri.race_datetime BETWEEN :start_date AND :end_date
                AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                AND ri.course_uid IN (:courseIDs)
            GROUP BY
                ri.course_uid
                , ri.race_instance_uid
                , ri.race_datetime
                , ri.race_type_code
            ",
            [
                'start_date' => $date . ' 00:00:00',
                'end_date' => $date . ' 23:59:59',
                'courseIDs' => $courseIDs,
            ]
        );

        $racesResult = new Model\Resultset\General(null, new Model\Row(), $result);
        $races = $racesResult->toArrayWithRows('course_uid', null, true);

        $result = $this->getReadConnection()->query(
            "SELECT
                course_uid
                , betting_man
                , analysis_man
                , close_up_man
            FROM
              meeting_details
            WHERE
                datediff(DAY, meeting_date, :start_date) = 0
                AND course_uid IN (:courseIDs)
            ",
            [
                'start_date' => $date . ' 00:00:00',
                'courseIDs' => $courseIDs,
            ]
        );

        $meetingResult = new Model\Resultset\General(null, new Model\Row(), $result);

        return [
            'races' => $races,
            'meeting' => $meetingResult->toArrayWithRows('course_uid', null, true)
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\Results\Search $request
     * @param int                                      $rowsLimit
     *
     * @return array
     */
    public function getSearchResult(\Api\Input\Request\Horses\Results\Search $request, $rowsLimit = 101)
    {
        $rowsLimit = (int)$rowsLimit;

        $sql = "
                SELECT DISTINCT TOP {$rowsLimit}
                    ri.race_instance_uid,
                    ri.race_instance_title,
                    ri.race_datetime,
                    ri.formbook_yn,
                    ri.race_status_code r_status,
                    ri.no_of_runners,
                    (
                      SELECT count(1)
                      FROM horse_race hr2
                      JOIN race_outcome ro2 ON ro2.race_outcome_uid = hr2.final_race_outcome_uid
                        AND ro2.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
                      WHERE hr2.race_instance_uid = ri.race_instance_uid


                    ) AS no_of_runners_calculated,
                    rtrim(c.country_code) course_country,
                    c.country_code,
                    c.course_uid,
                    c.course_name,
                    c.style_name as course_style_name,
                    CAST(ri.race_datetime AS DATE) date_sort
                FROM race_instance ri
                    JOIN course c ON ri.course_uid = c.course_uid
                    LEFT JOIN race_attrib_join raj ON raj.race_instance_uid = ri.race_instance_uid
                    LEFT JOIN race_attrib_lookup ral
                      ON raj.race_attrib_uid = ral.race_attrib_uid
                      AND ral.race_attrib_code = CASE WHEN c.country_code = 'GB' THEN 'Class_subset'  ELSE 'Class' END
                WHERE ri.race_datetime BETWEEN :start_date: AND :end_date:
                    AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                    AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                    AND c.course_type_code != '" . Constants::COURSE_TYPE_P2P_CODE . "'
                    AND (ral.race_attrib_desc != '' OR c.country_code != 'GB')
                    AND (NOT EXISTS (
                            SELECT 1 FROM race_attrib_join
                            WHERE race_instance_uid = ri.race_instance_uid AND race_attrib_uid = 432
                        )
                        OR
                        (EXISTS (
                            SELECT 1 FROM race_attrib_join
                             WHERE race_instance_uid = ri.race_instance_uid AND race_attrib_uid = 432)
                         AND c.course_uid in (" . Constants::FRENCH_COURSES . "))
                        )
        ";
        $param = [
            'start_date' => (!is_null($request->getStartDate()) ?
                    $request->getStartDate() : $request->getSearchDefaultStartDate()) . ' 00:00:00',
            'end_date' => $request->getEndDate() . ' 23:59:59'
        ];
        if (!is_null($request->getRaceTitle())) {
            $sql .= ' AND UPPER(ri.race_instance_title) LIKE :race_title: ';
            $param['race_title'] = '%'
                . strtoupper(mb_substr($request->getRaceTitle(), 0, 100, "utf-8")) . '%';
        }
        if (!is_null($request->getCountryCode())) {
            $sql .= ' AND c.country_code = :country_code: ';
            $param['country_code'] = $request->getCountryCode();
        }
        if (!is_null($request->getCourseId())) {
            $sql .= ' AND c.course_uid in (:course_id:) ';
            $param['course_id'] = $request->getCourseId();
        }
        $sql .= ' ORDER BY
                    date_sort DESC,
                    c.course_name,
                    ri.race_datetime DESC';

        $res = $this->getReadConnection()->query($sql, $param);

        $collection = new ResultSet(null, new Row(), $res);

        return $collection->toArrayWithRows();
    }

    /**
     * @param integer $raceId
     *
     * @return array
     */
    public function getDbi($raceId)
    {
        $tmpTableName = $this->getFactoryTmpResultTables()->getHorseRaceInstance($raceId);

        $sql = "
            SELECT
                ri.race_type_code
                , country_code = c.country_code
                , runner_cnt = COUNT(ri.horse_uid)
                , draw_cnt = SUM(CASE WHEN ISNULL(ri.draw, 0) > 0 THEN 1 ELSE 0 END)
            FROM
                {$tmpTableName} ri
                , course c
            WHERE ri.course_uid = c.course_uid
            GROUP BY ri.race_type_code, c.country_code
        ";

        $res = $this->getReadConnection()->query($sql);
        $collection = new ResultSet(null, new Row(), $res);

        $result = null;
        $raceResult = $collection->toArrayWithRows();

        if (!empty($raceResult)) {
            $raceType = $raceResult[0]->race_type_code;
            $countryCode = trim($raceResult[0]->country_code);
            $runnersCnt = $raceResult[0]->runner_cnt;
            $drawCnt = $raceResult[0]->draw_cnt;

            if (strpos(Constants::RACE_TYPE_FLAT, $raceType) !== false
                && $countryCode == Constants::COUNTRY_GB
                && $runnersCnt > 8
                && $drawCnt > 0
            ) {
                $lowInit = (int)floor(round(($runnersCnt * 1.0) / 3.0, 0));
                $highInit = $runnersCnt - $lowInit;

                $sql = "
                CREATE TABLE #stalls (
                    draw INT NOT NULL,
                    num NUMERIC(5,0) IDENTITY
                )
                ";
                $this->getReadConnection()->query($sql, null, null, false);

                $sql = "
                INSERT INTO
                    #stalls
                SELECT
                    hr.draw
                FROM
                    {$tmpTableName} hr
                WHERE
                    hr.draw IS NOT NULL 
                ORDER BY draw
                ";
                $this->getReadConnection()->query($sql, null, null, false);

                $sql = "SELECT draw FROM #stalls WHERE num = :lowInit";
                $res = $this->getReadConnection()->query($sql, ['lowInit' => $lowInit]);
                $collection = new ResultSet(null, new Row(), $res);

                $low = ($collection->count() > 0) ? $collection->toArrayWithRows()[0]->draw : 0;

                $sql = "SELECT draw FROM #stalls WHERE num = :highInit";
                $res = $this->getReadConnection()->query($sql, ['highInit' => $highInit]);
                $collection = new ResultSet(null, new Row(), $res);

                $high = ($collection->count() > 0) ? $collection->toArrayWithRows()[0]->draw : 0;

                if ($low == 0) {
                    $low = $lowInit;
                }
                if ($high == 0) {
                    $high = $highInit;
                }

                $sql = "
                SELECT
                    hr.horse_uid
                    , hr.draw
                    , position =  CASE
                                    WHEN ro.race_outcome_form_char LIKE '[FUCPROBS]' OR ro.race_outcome_position = 0
                                        THEN 99
                                        ELSE ro.race_outcome_position
                                  END
                    , percent = CONVERT(DECIMAL(8, 3), 100.000 / (o.odds_value + 1.000)) -- SP%
                FROM
                    {$tmpTableName} hr
                    , odds o
                    , race_outcome ro
                WHERE
                    hr.starting_price_odds_uid = o.odds_uid AND
                    hr.final_race_outcome_uid = ro.race_outcome_uid
                ORDER BY ro.race_output_order
                ";

                $res = $this->getReadConnection()->query($sql);
                $collection = new ResultSet(null, new Row(), $res);
                $sp = $collection->toArrayWithRows();

                $result['sp'] = $sp;
                $result['attributes'] = [
                    'lowInit' => $lowInit,
                    'highInit' => $highInit,
                    'low' => $low,
                    'high' => $high,
                    'runnersCnt' => $runnersCnt,
                ];

                $this->getReadConnection()->execute("IF OBJECT_ID('#stalls') IS NOT NULL DROP TABLE #stalls");
            }
        }
        return $result;
    }

    /**
     * @param \Api\Input\Request\Horses\Results\WinningTimes $request
     *
     * @return array
     */
    public function getWinningTimes(\Api\Input\Request\Horses\Results\WinningTimes $request)
    {
        $sql = "
        SELECT t.*,
            time_comparison = (CASE
                WHEN t.standard_time > 0 AND ISNULL(t.winners_time_secs, -1) >= 0
                THEN t.winners_time_secs - t.standard_time
                ELSE NULL END),
            winners_time_secs_per_furlong = NULL,
            time_comparison_per_furlong = NULL,
            rp_going_correction_desc = NULL
        FROM
            (SELECT
                ri.race_instance_uid,
                ri.race_type_code,
                ri.winners_time_secs,
                ri.rp_going_correction,
                ri.distance_yard,
                ri.race_datetime,
                standard_time = (
                    SELECT ISNULL(average_time_sec, 0)
                    FROM dist_ave_time dat
                    WHERE
                        dat.course_uid = ri.course_uid
                        AND dat.race_type_code = (
                            CASE
                                WHEN ri.race_type_code = " . Constants::RACE_TYPE_HUNTER_CHASE . "
                                THEN " . Constants::RACE_TYPE_CHASE_TURF . "
                                ELSE ri.race_type_code
                            END)
                        AND dat.distance_yard = ri.distance_yard
                        AND ISNULL(dat.straight_round_jubilee_code, '*') = ISNULL(ri.straight_round_jubilee_code, '*')

                ),
                g.rp_going_type_desc,
                rp_topspeed = (CASE WHEN ISNULL(hr.rp_topspeed, 0) > 0 THEN hr.rp_topspeed  ELSE NULL END),
                rp_postmark = (CASE WHEN ISNULL(hr.rp_postmark, 0) > 0 THEN hr.rp_postmark ELSE NULL END),
                h.style_name horse_style_name,
                h.country_origin_code,
                h.horse_uid
            FROM course c
                 JOIN race_instance ri ON ri.course_uid = c.course_uid
                 LEFT JOIN going_type g ON g.going_type_code = ri.going_type_code
                 JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
                 JOIN horse h ON h.horse_uid = hr.horse_uid
            WHERE c.course_uid = :course_id
                AND   ri.race_datetime BETWEEN :start_race_date AND :end_race_date
                AND   hr.final_race_outcome_uid IN (1,71)
                AND   c.course_name NOT LIKE '%P-T-P%') t
            ORDER BY t.race_datetime

        ";

        $params["start_race_date"] = $request->getRaceDate() . " 00:00:00";
        $params["end_race_date"] = $request->getRaceDate() . " 23:59:59";
        $params["course_id"] = $request->getCourseId();

        $result = $this->getReadConnection()->query($sql, $params);

        $res = new Model\Resultset\General(null, new Model\Row(), $result);

        return $res->toArrayWithRows();
    }

    /**
     * @param $raceId
     * @return array
     */
    public function getResultsSalesData($raceId)
    {
        $sql =
            "
               SELECT
                    ri.race_instance_uid,
                    h.horse_uid,
                    h.style_name
                FROM horse h
                    JOIN horse_race hr ON hr.horse_uid = h.horse_uid
                    JOIN race_instance ri ON ri.race_instance_uid = hr.race_instance_uid
                WHERE
                    ri.race_instance_uid = :raceId
                    AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                    AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
            ";

        $params = [
            'raceId' => $raceId,
        ];

        $results = $this->getReadConnection()->query($sql, $params);

        $result = new \Phalcon\Mvc\Model\Resultset\General(null, new GeneralRow(), $results);

        return $result->toArrayWithRows('horse_uid');
    }
}
