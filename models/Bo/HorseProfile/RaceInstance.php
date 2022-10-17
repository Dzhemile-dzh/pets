<?php

namespace Models\Bo\HorseProfile;

use Api\Constants\Horses as Constants;
use Phalcon\Db\Sql\Builder;
use Phalcon\Mvc\Model\Resultset\General as General;
use Api\Input\Request\HorsesRequest as Request;

/**
 * Class RaceInstance
 *
 * @package Models\Bo\HorseProfile
 */
class RaceInstance extends \Models\RaceInstance
{
    /**
     * Additional requirements for entries: https://racingpost.atlassian.net/browse/AD-1534
     *
     * @param Request $request
     * @param $returnP2P
     *
     * @return array
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getEntries(Request $request, $returnP2P)
    {
        $builder = new Builder($request);
        $entriesType = $request->getEntriesType();

        switch ($entriesType) {
            case 'entries':
                $builder->columns('aa.rp_ages_allowed_desc');
                $builder->columns('ri.race_type_code');
                $builder->columns('ri.race_group_uid');
                $builder->columns('c.country_code');
                $builder->columns(
                    "
                        race_class = 
                        (SELECT DISTINCT ral.race_attrib_desc
                            FROM race_attrib_join raj, race_attrib_lookup ral
                            WHERE ri.race_instance_uid = raj.race_instance_uid
                            AND raj.race_attrib_uid = ral.race_attrib_uid
                            AND ral.race_attrib_code = (
                                CASE WHEN c.country_code = 'GB'
                                THEN 'Class_subset'
                                ELSE 'Class'
                                END
                        )
                    )"
                );

                $builder->columns(
                    "
                        surface = (
                        SELECT DISTINCT ral.race_attrib_desc
                            FROM race_attrib_join raj, race_attrib_lookup ral
                            WHERE ri.race_instance_uid = raj.race_instance_uid
                            AND raj.race_attrib_uid = ral.race_attrib_uid
                            AND ral.race_attrib_code = 'Surface'
                            )
                        "
                );

                $builder->leftjoin('ages_allowed aa ON aa.ages_allowed_uid = ri.ages_allowed_uid');

                $builder->where(
                    'NOT EXISTS(
                                SELECT 1 FROM race_attrib_lookup ral, race_attrib_join raj
                                WHERE raj.race_instance_uid = ri.race_instance_uid
                                    AND raj.race_attrib_uid = ral.race_attrib_uid
                                    AND ral.race_attrib_uid IN (:exclude1, :exclude2)
                                )'
                );
                $builder
                    ->setParam('exclude1', Constants::INCOMPLETE_CARD_ATTRIBUTE_ID)
                    ->setParam('exclude2', Constants::INCOMPLETE_RACE_ATTRIBUTE_ID);
                break;

            case 'overview':
                $builder->where(
                    'NOT EXISTS(
                        SELECT 1 FROM race_attrib_lookup ral, race_attrib_join raj
                        WHERE raj.race_instance_uid = ri.race_instance_uid
                            AND raj.race_attrib_uid = ral.race_attrib_uid
                            AND ral.race_attrib_uid IN (:exclude1, :exclude2)
                        )'
                );

                $builder
                    ->setParam('exclude1', Constants::INCOMPLETE_CARD_ATTRIBUTE_ID)
                    ->setParam('exclude2', Constants::INCOMPLETE_RACE_ATTRIBUTE_ID);
                break;

            case 'entriesAll':
                $builder->columns('c.rp_abbrev_3');
                $builder->columns(
                    'local_meeting_race_datetime =
                    dateadd(MINUTE, isnull(clt.hours_difference, 0)  * 60, ri.race_datetime)'
                );
                $builder->columns('clt.hours_difference');
                $builder->leftJoin(
                    'course_local_time clt ON clt.course_uid = ri.course_uid
                    AND ri.race_datetime BETWEEN clt.date_from AND clt.date_to'
                );
        }

        $builder->setSqlTemplate(
            "
            SELECT
                ri.race_instance_uid
                , ri.race_datetime
                , c.course_name
                , c.course_type_code
                , c.course_uid
                , course_style_name = c.style_name
                , ri.race_instance_title
                , ri.race_status_code
                , ri.distance_yard
                , phr.saddle_cloth_no
                , phr.rp_postmark
                , j.jockey_uid
                , jockey_style_name = j.style_name
                , jockey_ptp_type_code = j.ptp_type_code
                , phr.running_conditions
                , phr.rp_owner_choice
                , ho.owner_uid
                , num_overnight_races = (
                    SELECT COUNT(*) 
                    FROM race_instance
                        INNER JOIN pre_horse_race pre_hr ON ri.race_instance_uid = pre_hr.race_instance_uid
                    WHERE 
                        pre_hr.race_status_code = CASE WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . " 
                            THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                            ELSE ri.race_status_code 
                        END
                        AND race_datetime BETWEEN
                            CONVERT(DATETIME, CONVERT(VARCHAR, ri.race_datetime, 101) + ' 00:00')
                            AND CONVERT(DATETIME, CONVERT(VARCHAR, ri.race_datetime, 101) + ' 23:59')
                        AND pre_hr.horse_uid = :horseId
                ) 
                /*{COLUMNS}*/
            FROM race_instance ri
                JOIN pre_horse_race phr ON ri.race_instance_uid = phr.race_instance_uid
                    AND phr.race_status_code = ri.race_status_code
                JOIN course c ON ri.course_uid = c.course_uid
                LEFT JOIN jockey j ON phr.jockey_uid = j.jockey_uid
                LEFT JOIN horse_owner ho ON ho.horse_uid = phr.horse_uid
                    AND isnull(ho.owner_change_date, '" . Constants::EMPTY_DATE . "') = '" . Constants::EMPTY_DATE . "'
                /*{JOINS}*/    
            WHERE
                ri.race_datetime >= CONVERT(DATETIME, CONVERT(DATE, GETDATE()))
                AND phr.horse_uid = :horseId
                /*{WHERE}*/
            ORDER BY ri.race_datetime
        "
        );

        if (!$returnP2P) {
            $builder->where("AND ri.race_type_code != " . Constants::RACE_TYPE_P2P);
        }

        $builder->build();

        $result = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $result = new General(
            null,
            new \Api\Row\HorseProfile\RaceInstance(),
            $result
        );
        $out = $result->toArrayWithRows();

        return empty($out) ? null : $out;
    }

    /**
     * @param int   $horseUid
     * @param array $raceTypeCodes
     *
     * @return array
     */
    public function getStatistics($horseUid, array $raceTypeCodes)
    {
        $groups = [
            'course' => [
                'course_name, course_uid, course_type_code, course_style_name, course_comment',
                'course_name, course_uid, course_type_code, course_style_name, course_comment',
            ],
            'distance' => 'distance_yard',
            'going' => 'going_type_desc',
            'month' => 'race_datetime_month, month_name',
            'jockey' => 'jockey_style_name, jockey_uid, jockey_short_name, jockey_ptp_type_code',
            'class' => ['actual_race_class', 'actual_race_class', ''],
        ];

        $result = [];

        foreach ($groups as $groupName => $fields) {
            $where = "AND c.country_code IN ('GB', 'IRE')";
            if (is_array($fields)) {
                $selectField = $fields[0];
                $groupField = $fields[1];
                if (isset($fields[2])) {
                    $where = $fields[2];
                }
            } else {
                $selectField = $fields;
                $groupField = $fields;
            }
            $sql = "
                SELECT
                    {$selectField},
                    count(1) AS starts_number,
                    SUM(CASE WHEN race_outcome_position = 1 THEN 1 ELSE 0 END) AS place_1st_number,
                    SUM(CASE WHEN race_outcome_position = 2 THEN 1 ELSE 0 END) AS place_2nd_number,
                    SUM(CASE WHEN race_outcome_position = 3 THEN 1 ELSE 0 END) AS place_3rd_number,
                    CONVERT(money, isnull(SUM(win_prize), 0)) win_prize,
                    CONVERT(money, isnull(SUM(total_prize), 0)) total_prize,
                    CONVERT(money, isnull(SUM(euro_win_prize), 0)) euro_win_prize,
                    CONVERT(money, isnull(SUM(euro_total_prize), 0)) euro_total_prize,
                    CASE WHEN MAX(rp_topspeed) > 0 THEN MAX(rp_topspeed) ELSE NULL END AS best_rp_topspeed,
                    MAX(rp_postmark) AS best_rp_postmark,
                    CONVERT(money, isnull(SUM(t.net_total_prize), 0)) net_total_prize,
                    CONVERT(money, isnull(SUM(t.net_win_prize), 0)) net_win_prize
                FROM
                (
                    SELECT
                        c.course_uid,
                        c.course_name,
                        c.course_type_code,
                        c.style_name as course_style_name,
                        ISNULL(cc.rp_flat_course_comment, cc.rp_jump_course_comment) as course_comment,
                        ri.distance_yard,
                        MONTH(ri.race_datetime) AS race_datetime_month,
                        DATENAME(MONTH, ri.race_datetime) AS month_name,
                        gt.going_type_desc,
                        j.jockey_uid,
                        j.style_name AS jockey_style_name,
                        j.ptp_type_code AS jockey_ptp_type_code,
                        j.aka_style_name AS jockey_short_name,
                        (
                            SELECT race_attrib_lookup.race_attrib_desc
                            FROM race_attrib_join
                            LEFT JOIN race_attrib_lookup ON
                                race_attrib_join.race_attrib_uid = race_attrib_lookup.race_attrib_uid
                                AND (
                                  c.country_code = 'GB'
                                    AND race_attrib_lookup.race_attrib_code = " . Constants::RACE_CLASS_SUB . "
                                  OR c.country_code != 'GB'
                                    AND race_attrib_lookup.race_attrib_code = " . Constants::RACE_CLASS . "
                                )
                            WHERE
                                race_attrib_join.race_instance_uid = ri.race_instance_uid
                                AND race_attrib_lookup.race_attrib_desc IS NOT NULL
                        ) AS actual_race_class,
                        ro.race_outcome_position,
                        win_prize = CASE WHEN ro.race_outcome_position = 1
                                    THEN CASE WHEN c.country_code = 'IRE'
                                        THEN rip.prize_euro_gross / CASE WHEN ccr.exchange_rate = 0 THEN 1 ELSE ccr.exchange_rate END
                                        ELSE rip.prize_sterling END
                                    ELSE 0 END,
                        total_prize = CASE WHEN c.country_code = 'IRE'
                                    THEN rip.prize_euro_gross / CASE WHEN ccr.exchange_rate = 0 THEN 1 ELSE ccr.exchange_rate END
                                    ELSE rip.prize_sterling END,
                        euro_win_prize = CASE WHEN c.country_code = 'IRE' AND ro.race_outcome_position = 1
                                        THEN rip.prize_euro_gross
                                        ELSE 0 END,
                        euro_total_prize = CASE WHEN c.country_code = 'IRE' THEN rip.prize_euro_gross END,
                        hr.rp_topspeed,
                        hr.rp_postmark,
                        net_total_prize = rip.prize_sterling,
                        net_win_prize = CONVERT(money, isnull(
                          CASE WHEN ro.race_outcome_position = 1
                            THEN rip.prize_sterling
                            ELSE 0
                          END, 0)
                        )
                    FROM race_instance ri
                    JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
                    JOIN course c ON ri.course_uid = c.course_uid
                    JOIN course_comments cc ON cc.course_uid = ri.course_uid
                    JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid 
                        AND ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_AND_VOID_CODES . ")
                    LEFT JOIN jockey j ON j.jockey_uid = hr.jockey_uid
                    LEFT JOIN race_instance_prize rip ON rip.race_instance_uid = hr.race_instance_uid
                        AND rip.position_no = ro.race_outcome_position
                    LEFT JOIN going_type gt ON gt.going_type_code = ri.going_type_code
                    LEFT JOIN country_currencies ccr ON ccr.country_code = 'EUR' 
                        AND year(ri.race_datetime) = ccr.year
                    WHERE
                        hr.horse_uid = :horseUid
                        AND ri.race_type_code IN (:raceTypeCodes)
                        AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                        {$where}
                ) t

                GROUP BY {$groupField}
                ORDER BY {$groupField}
            ";

            $res = $this->getReadConnection()->query(
                $sql,
                [
                    'horseUid' => $horseUid,
                    'raceTypeCodes' => $raceTypeCodes
                ]
            );

            $resultCollection = new General(
                null,
                new \Api\Row\Horse\Statistics(),
                $res
            );
            $result[$groupName] = $resultCollection->toArrayWithRows();
        }

        return $result;
    }

    /**
     * @param boolean $ptpGbFlag
     * @param boolean $returnP2P
     *
     * @return array
     */
    public function getForm($ptpGbFlag = false, $returnP2P = false)
    {
        return $this->getFormOrWinsOrMyRatings(
            null,
            'form',
            $ptpGbFlag,
            null,
            false,
            '',
            $returnP2P
        );
    }

    /**
     * @param       $horseUid
     * @param array    $raceUids
     *
     * @return array
     */
    public function getRaceTactics($horseUid, array $raceUids)
    {
        $sql = "
            SELECT
                hra.race_instance_uid
                , hra.horse_uid
                , ra.predicted_yn
                , ra.runner_attrib_type
                , ra.runner_attrib_description
            FROM horse_race_attribs hra
              JOIN runner_attribs ra ON ra.runner_attrib_uid = hra.runner_attrib_uid
            WHERE hra.horse_uid = :horseUid
              AND hra.race_instance_uid IN (:raceUids)
        ";

        $result = $this->getReadConnection()->query(
            $sql,
            [
                'horseUid' => $horseUid,
                'raceUids' => $raceUids
            ]
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\RaceInstance(),
            $result
        );

        return $result->toArrayWithRows('race_instance_uid');
    }

    /**
     * @return array
     */
    public function getWins()
    {
        return $this->getFormOrWinsOrMyRatings(null, 'wins');
    }

    /**
     * @return array
     */
    public function getMyRatings()
    {
        return $this->getFormOrWinsOrMyRatings(null, 'my_ratings');
    }

    /**
     * @param int    $horseUid
     * @param string $noteTypeCode
     * @return array
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getNotes(int $horseUid, string $noteTypeCode)
    {

        $sql = "
            SELECT
                hr.horse_uid,
                h.horse_name,
                h.style_name horse_style_name,
                h.country_origin_code,
                ri.race_instance_uid race_id,
                ri.race_datetime race_date,
                c.course_uid,
                c.course_name course_name,
                c.course_type_code,
                c.style_name course_style_name,
                ri.distance_yard,
                ri.race_instance_title race_title,
                ri.going_type_code,
                hr.rp_postmark,
                hrn.notes_type_code,
                hrn.notes notes
            FROM race_instance ri
                INNER JOIN horse_race hr ON ri.race_instance_uid = hr.race_instance_uid
                INNER JOIN horse h ON h.horse_uid = hr.horse_uid
                INNER JOIN course c ON c.course_uid = ri.course_uid
                INNER JOIN horse_race_notes hrn
                  ON hrn.race_instance_uid = hr.race_instance_uid
                  AND hrn.horse_uid = hr.horse_uid
                INNER JOIN race_outcome ro
                  ON ro.race_outcome_uid = hr.final_race_outcome_uid
                  AND ro.race_outcome_code NOT IN (:nonRunnerCodes)
            WHERE hr.horse_uid = :horseUid
                AND ri.race_type_code != :p2pRaceType
                AND hrn.notes_type_code = :noteType
            ORDER BY ri.race_datetime DESC
        ";

        $result = $this->getReadConnection()->query(
            $sql,
            [
                'horseUid' => $horseUid,
                'noteType' => $noteTypeCode,
                'nonRunnerCodes' => Constants::NON_RUNNER_CODES_ARRAY,
                'p2pRaceType' => Constants::RACE_TYPE_P2P_STR
            ]
        );

        $result = new General(
            null,
            new \Api\Row\RaceInstance(),
            $result
        );

        return $result->toArrayWithRows();
    }

    /**
     * @param int $horseId
     *
     * @return array
     */
    public function getStableTourQuotes($horseId)
    {
        $result = $this->getReadConnection()->query(
            "
            SELECT
                h.horse_uid
                , horse_name = h.style_name
                , hn.notes
            FROM
                horse_notes hn
            JOIN horse h ON hn.horse_uid = h.horse_uid
            WHERE
                hn.notes_type_code IN (" . Constants::NOTES_TYPE_CODE_STABLE_TOUR_FLAT . ", "
            . Constants::NOTES_TYPE_CODE_STABLE_TOUR_JUMPS . ", " . Constants::NOTES_TYPE_CODE_WEEKENDER_STABLE_TOUR . ")
                AND hn.horse_uid = :horse_id
        ",
            [
                'horse_id' => $horseId
            ]
        );

        $result = new General(
            null,
            new \Api\Row\RaceInstance(),
            $result
        );

        return $result->toArrayWithRows();
    }
}
