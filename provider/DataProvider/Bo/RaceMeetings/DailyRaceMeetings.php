<?php

namespace Api\DataProvider\Bo\RaceMeetings;

use Phalcon\Db\Sql\Builder;
use Phalcon\Mvc\Model\Resultset;
use Api\Constants\Horses as Constants;
use Api\Row\DailyRaceMeetings as DailyMeetings;
use Phalcon\Mvc\Model\Row\General;

/**
 * Class DailyRaceMeetings
 *
 * @package Api\DataProvider\Bo\RaceMeetings
 */
class DailyRaceMeetings extends \Models\RaceInstance
{
    /**
     * @param string $meetingDate
     * @return array
     * @throws Resultset\ResultsetException
     */
    public function getDailyMeetings(string $meetingDate)
    {
        $tmpTableName = '#tmp_main';

        $this->createTmpTableMain($meetingDate, $tmpTableName);

        $builder = new Builder();
        $builder->setSqlTemplate(
            "
            SELECT
                m.course_uid,
                md.meeting_date,
                md.meeting_abandoned,
                m.formbook_yn,
                CASE
                    WHEN c2.course_type_code IS NOT NULL THEN c2.course_type_code
                    ELSE m.course_type_code
                END course_type_code,
                m.aw_surface_type,
                cards_order = null,
                complete_card = null,
                country_code = m.country_code,
                m.course_name,
                course_style_name = m.style_name,
                course_teaser_suffix = null,
                md.rails,
                m.rp_abbrev_3,
                rp_meeting_order = null,
                md.stalls_position,
                digital_colour = mdc.meeting_digital_number,
                straight_round_jubilee_code = null,
                digital_order = mdc.meeting_digital_order,
                early_complete_card = null,
                has_finished_race = 0,
                mc.meeting_number,
                CASE
                    WHEN c2.course_uid IS NOT NULL
                    AND c2.course_uid != m.course_uid THEN c2.course_uid
                END mixed_course_uid,
                pre_going_desc = pmd.going_desc,
                going_desc = md.going_desc,
                pre_weather_desc = pmd.weather_details,
                
                --Races
                m.race_instance_uid,
                m.race_group_uid,
                rg.race_group_code,
                race_class = null,
                count_runners = null,
                race_country_code = m.country_code,
                declared_runners = m.no_of_runners,
                m.distance_yard,
                duplicate_race = null,
                m.early_closing_race_yn,
                m.race_status_code,
                m.no_of_runners,
                fast_result = 0,
                free_to_air = t.free_to_air_yn,
                clt.hours_difference,
                m.race_datetime,
                rtrim(official_rating_band_desc) as official_rating_band_desc,
                perform_race_uid_atr = null,
                perform_race_uid_ruk = null,
                m.race_instance_title,
                rs.race_selection_type,
                m.race_type_code,
                m.rp_abbrev_3 as race_rp_abbrev,
                aa.rp_ages_allowed_desc,
                m.rp_confirmed,
                m.rp_tv_text,
                scoop6_race = rs.race_selection_type,
                h_ts_spotlight.style_name AS verdict,
                m.straight_round_jubilee_code as straight_round_jubilee_code_race,
                prize = CASE WHEN m.country_code = '" . Constants::COUNTRY_IRE . "' THEN rip.prize_euro ELSE rip.prize_sterling END,
                rg.race_group_desc,
                min_weight = m.minimum_weight_lbs,
                weight_adjustment =
                        CASE WHEN m.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ") THEN 140 ELSE 168 END,
                race_runners = null,
                m.pool_prize_sterling
            FROM {$tmpTableName} m
            LEFT JOIN course c2 ON -- Mixed meeting checking
                        m.rp_abbrev_3 = c2.rp_abbrev_3
                        AND m.country_code = c2.country_code
                        AND c2.course_uid = 31
                        AND EXISTS (
                            SELECT 1
                            FROM race_instance ri2
                            WHERE CONVERT(VARCHAR, ri2.race_datetime, 101) = m.race_date
                                AND ri2.course_uid != m.course_uid
                                AND ri2.course_uid = c2.course_uid
                                AND ri2.race_status_code = m.race_status_code
                            )
                            
            LEFT JOIN meeting_digital_colours mdc ON mdc.course_uid = m.course_uid
                AND mdc.meeting_date = :meetingDate
            LEFT JOIN meeting_colours mc ON mc.course_uid = m.course_uid
                AND mc.meeting_date = :meetingDate
            LEFT JOIN meeting_details md
                ON (md.course_uid = m.course_uid AND DATEDIFF(dd, md.meeting_date, m.race_datetime) = 0)
            LEFT JOIN pre_meeting_details pmd ON
                pmd.course_uid = m.course_uid
                AND pmd.meeting_date = :meetingDate
            LEFT JOIN course_local_time clt ON
                clt.course_uid = m.course_uid AND m.race_datetime BETWEEN clt.date_from AND clt.date_to
            LEFT JOIN official_rating_band orb ON orb.official_rating_band_uid = m.official_rating_band_uid
            LEFT JOIN race_selection rs ON m.race_instance_uid = rs.race_instance_uid
            LEFT JOIN ages_allowed aa ON aa.ages_allowed_uid = m.ages_allowed_uid
            LEFT JOIN tvchannel t ON t.tvchannel_name = m.rp_tv_text
            LEFT JOIN race_group rg ON rg.race_group_uid = m.race_group_uid
            LEFT JOIN race_instance_prize rip
                ON rip.race_instance_uid = m.race_instance_uid AND rip.position_no = 1
            LEFT JOIN tipster_selection ts_spotlight ON
                ts_spotlight.race_instance_uid = m.race_instance_uid
                AND ts_spotlight.newspaper_uid = 1
            LEFT JOIN horse h_ts_spotlight ON
                h_ts_spotlight.horse_uid = ts_spotlight.horse_uid
            ORDER BY
            (
                    CASE
                        WHEN m.country_code IN (
                            'GB',
                            'IRE'
                        )
                        AND m.race_status_code != " . Constants::RACE_STATUS_ABANDONED . " THEN 0
                        WHEN m.country_code IN (
                            'GB',
                            'IRE'
                        )
                        AND m.race_status_code = " . Constants::RACE_STATUS_ABANDONED . "  THEN 2
                        WHEN m.country_code = 'ARO' THEN 3
                        ELSE 1
                    END
                ),
                m.race_datetime,
                m.rp_abbrev_3
            PLAN '(use optgoal allrows_dss)'
        "
        );

        $builder->setParam('meetingDate', $meetingDate);
        $builder->build();

        $result = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $collection = new Resultset\General(
            null,
            new DailyMeetings(),
            $result
        );

        $result = $collection->getGroupedResult(
            [
                'course_uid',
                'meeting_date',
                'meeting_abandoned',
                'course_type_code',
                'aw_surface_type',
                'cards_order',
                'complete_card',
                'country_code',
                'course_name',
                'course_style_name',
                'course_teaser_suffix',
                'rails',
                'rp_abbrev_3',
                'rp_meeting_order',
                'stalls_position',
                'digital_colour',
                'straight_round_jubilee_code',
                'digital_order',
                'early_complete_card',
                'has_finished_race',
                'meeting_number',
                'mixed_course_uid',
                'pre_going_desc',
                'going_desc',
                'pre_weather_desc',
                'races' => [
                    'race_instance_uid',
                    'course_uid',
                    'formbook_yn',
                    'count_runners',
                    'race_country_code',
                    'declared_runners',
                    'distance_yard',
                    'duplicate_race',
                    'early_closing_race_yn',
                    'race_status_code',
                    'race_class',
                    'race_group_uid',
                    'race_group_code',
                    'no_of_runners',
                    'fast_result',
                    'free_to_air',
                    'hours_difference',
                    'race_datetime',
                    'official_rating_band_desc',
                    'perform_race_uid_atr',
                    'perform_race_uid_ruk',
                    'race_instance_title',
                    'race_selection_type',
                    'race_type_code',
                    'race_rp_abbrev',
                    'rp_ages_allowed_desc',
                    'rp_confirmed',
                    'rp_tv_text',
                    'scoop6_race',
                    'verdict',
                    'straight_round_jubilee_code_race',
                    'prize',
                    'race_group_desc',
                    'weight_adjustment',
                    'min_weight',
                    'race_runners',
                    'pool_prize_sterling'
                ]
            ],
            ['course_uid', 'race_instance_uid']
        );

        $this->deleteTable($tmpTableName);
        return $result;
    }

    /**
     * We create temp table that will contain all required tables for our races
     * because in this way we will avoid doing so much join if we have no records at all
     * and also we will join rest of the table only to records for our race not for all records
     *
     * @param string $meetingDate
     * @param string $tableName
     */
    private function createTmpTableMain(string $meetingDate, string $tableName)
    {
        $builder = new Builder();

        $surfaceTable = '#surfaceTable';

        $this->createTmpTableSurface($meetingDate, $surfaceTable);

        $builder->setSqlTemplate(
            "
                SELECT
                    c.course_uid,
                    c.course_type_code,
                    country_code = RTRIM(c.country_code),
                    c.course_name,
                    c.style_name,
                    c.rp_abbrev_3,
                    ri.straight_round_jubilee_code,
                    ri.race_instance_uid,
                    no_of_runners = pri.no_of_runners,
                    pric.rp_confirmed,
                    pric.rp_tv_text,
                    ri.formbook_yn,
                    ri.distance_yard,
                    pri.early_closing_race_yn,
                    ri.race_status_code,
                    ri.race_datetime,
                    race_date = CONVERT(VARCHAR, ri.race_datetime, 101),
                    ri.race_instance_title,
                    ri.race_type_code,
                    ri.official_rating_band_uid,
                    ri.ages_allowed_uid,
                    ri.minimum_weight_lbs,
                    s.aw_surface_type,
                    race_group_uid,
                    ri.pool_prize_sterling
                INTO {$tableName}        
                FROM race_instance ri
                    INNER JOIN course c ON c.course_uid = ri.course_uid
                    INNER JOIN pre_race_instance pri ON pri.race_instance_uid = ri.race_instance_uid
                        AND pri.race_status_code = (
                            CASE
                                WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                                    THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                                ELSE ri.race_status_code
                                END
                            )
                    LEFT JOIN pre_race_instance_comments pric ON pric.race_instance_uid = ri.race_instance_uid
                    LEFT JOIN {$surfaceTable} s ON ri.course_uid = s.course_uid
                WHERE
                    CONVERT(varchar(10), ri.race_datetime, 23) = :meetingDate:
                    "
        );

        $builder->setParam('meetingDate', $meetingDate);

        $builder->build();

        $this->getReadConnection()->execute(
            $builder->getSql(),
            $builder->getParams()
        );

        $this->deleteTable($surfaceTable);
    }

    /**
     * We create temp table to store aw_surface_type for all courses that we have on this date
     *
     * @param string $meetingDate
     * @param string $tableName
     */
    private function createTmpTableSurface($meetingDate, $tableName)
    {
        $builder = new Builder();

        $builder->setSqlTemplate(
            "
                            SELECT 
                                MAX(ral.race_attrib_desc) as aw_surface_type,
                                ri.course_uid
                             INTO {$tableName}
                            FROM race_instance ri
                                JOIN race_attrib_join raj ON raj.race_instance_uid = ri.race_instance_uid
                                    AND raj.race_attrib_uid BETWEEN 402 AND 411
                                JOIN race_attrib_lookup ral ON raj.race_attrib_uid = ral.race_attrib_uid
                                    AND ri.race_type_code IN (" . Constants::RACE_TYPE_AW . ")
                            WHERE 
                             CONVERT(varchar(10), ri.race_datetime, 23) = :meetingDate:
                            GROUP BY ri.course_uid"
        );

        $builder->setParam('meetingDate', $meetingDate);

        $builder->build();

        $this->getReadConnection()->execute(
            $builder->getSql(),
            $builder->getParams()
        );
    }

    /**
     * @param array $raceIds
     * @return array
     * @throws Resultset\ResultsetException
     */
    public function getNoOfRunnersPerRace(array $raceIds)
    {
        $builder = new Builder();
        $builder->setSqlTemplate(
            "
            SELECT
                ri.race_instance_uid,
                count(1) as runners_count,
                SUM (CASE WHEN phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                            AND (phr.doubtful_runner IS NULL OR phr.doubtful_runner != 'Y')
                            AND (phr.non_runner IS NULL OR phr.non_runner != 'Y')
                            AND (phr.irish_reserve_yn IS NULL OR phr.irish_reserve_yn != 'Y')
                           THEN 1 ELSE 0 END) no_of_runners
            FROM
                race_instance ri
                JOIN pre_horse_race phr
                      ON  phr.race_instance_uid = ri.race_instance_uid
                        AND phr.race_status_code =
                            CASE WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                                 THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                                 ELSE ri.race_status_code
                             END
            WHERE
                ri.race_instance_uid IN (:raceIds)
            GROUP BY
                ri.race_instance_uid
        "
        );

        $builder->setParam('raceIds', $raceIds);
        $builder->build();

        $result = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $collection = new Resultset\General(
            null,
            new General(),
            $result
        );

        $result = $collection->toArrayWithRows('race_instance_uid');

        return $result;
    }

    /**
     * @param array $raceIds
     * @return array
     * @throws Resultset\ResultsetException
     */
    public function getPerformRace(array $raceIds)
    {
        $builder = new Builder();
        $builder->setSqlTemplate(
            "
                    SELECT MAX(perform_race_uid) as max_performance,
                    race_instance_uid,
                    ISNULL(isATR, 2) as atr
                    FROM perform_race
                    WHERE race_instance_uid IN (:raceIds)
                        AND (isATR = 1 OR isATR IS NULL)
                    GROUP BY
                        race_instance_uid,
                        isATR
        "
        );

        $builder->setParam('raceIds', $raceIds);
        $builder->build();

        $result = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $collection = new Resultset\General(
            null,
            new General(),
            $result
        );

        $result = $collection->getGroupedResult(
            [
                'race_instance_uid',
                'performance' => [
                    'atr',
                    'max_performance'
                ]
            ],
            ['race_instance_uid', 'atr']
        );

        return $result;
    }

    /**
     * @param array $raceIds
     * @return array
     * @throws Resultset\ResultsetException
     */
    public function getRacesAttributes(array $raceIds)
    {
        $builder = new Builder();
        $builder->setSqlTemplate(
            "
            SELECT
              race_attrib_desc,
              rtrim(race_attrib_code) as race_attrib_code,
              raj.race_attrib_uid,
              race_instance_uid
            FROM race_attrib_join raj
            JOIN race_attrib_lookup ral ON ral.race_attrib_uid = raj.race_attrib_uid
            WHERE race_instance_uid IN (:raceIds)
            "
        );

        $builder->setParam('raceIds', $raceIds);
        $builder->build();

        $res = $this->getReadConnection()->query($builder->getSql(), $builder->getParams());


        $result = new Resultset\General(
            null,
            new General(),
            $res
        );

        $result = $result->getGroupedResult(
            [
                'race_instance_uid',
                'attribs' => [
                    'race_attrib_code',
                    'race_attrib_desc',
                    'race_attrib_uid'
                ]
            ],
            ['race_instance_uid', 'race_attrib_code']
        );

        return $result;
    }

    /**
     * @param string $raceDate
     * @param int $requestedCourse
     * @return array|Resultset\General
     * @throws Resultset\ResultsetException
     */
    public function getCourses(string $raceDate, ?int $requestedCourse)
    {
        $builder = new Builder();
        $builder->setSqlTemplate(
            "
            SELECT
                    c.course_uid,
                    c.course_type_code,
                    country_code = RTRIM(c.country_code),
                    c.course_name,
                    c.style_name,
                    c.rp_abbrev_3,
                    top_trainers = null                 
                FROM race_instance ri
                    INNER JOIN course c ON c.course_uid = ri.course_uid
                WHERE
                    CONVERT(varchar(10), ri.race_datetime, 23) = :raceDate:
                    /*{WHERE}*/
            "
        );

        $builder->setParam('raceDate', $raceDate);

        if (!is_null($requestedCourse)) {
            $builder->where('c.course_uid = :courseUid');
            $builder->setParam('courseUid', $requestedCourse);
        }

        $builder->build();

        $res = $this->getReadConnection()->query($builder->getSql(), $builder->getParams());

        $result = new Resultset\General(
            null,
            new General(),
            $res
        );

        $result = $result->toArrayWithRows('course_uid');

        return $result;
    }
}
