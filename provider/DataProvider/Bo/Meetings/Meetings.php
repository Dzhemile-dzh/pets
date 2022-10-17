<?php

declare(strict_types=1);

namespace Api\DataProvider\Bo\Meetings;

use Api\Constants\Horses as Constants;
use Api\DataProvider\HorsesDataProvider;
use Api\Input\Request\Horses\Meetings as Request;
use Phalcon\Db\Sql\Builder;

/**
 * @package Api\DataProvider\Bo
 */
class Meetings extends HorsesDataProvider
{
    /**
     * @param string $raceDate
     *
     * @return array
     */
    public function getMeetingsData(string $raceDate): array
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT 
                   meetingId = null,
                   rp_meeting_order = null,
                   ri.race_instance_title,
                   ri.race_instance_uid,
                   ri.early_closing_race_yn,
                   ri.race_datetime,
                   ri.race_group_uid,
                   rg.race_group_desc,
                   ri.race_type_code,
                   ri.distance_yard,
                   ri.race_status_code,
                   ri.pool_prize_sterling,
                   fri.fast_race_instance_uid,
                   c.course_uid,
                   c.style_name,
                   c.course_name,
                   c.country_code,
                   c.course_type_code,
                   pmd.weather_details,
                   going_desc = (CASE 
                                     WHEN ri.race_status_code
                                        NOT IN  (" . Constants::RACE_STATUS_ABANDONED . "," . Constants::RACE_STATUS_RESULTS . ")
                                     THEN pmd.going_desc
                                     WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                                     THEN md.going_desc 
                                 END),
                   mixed_course_uid = CASE WHEN c2.course_uid IS NOT NULL AND c2.course_uid != c.course_uid THEN c2.course_uid END,
                   clt.hours_difference,
                   -- calculate the number of runners depending on the status of the race --
                   no_of_runners =
                            CASE
                                WHEN pri.race_status_code IN 
                                    (" . Constants::RACE_STATUS_CALENDAR
                                    . "," . Constants::RACE_STATUS_6DAYS
                                    . "," . Constants::RACE_STATUS_5DAYS
                                    . "," . Constants::RACE_STATUS_4DAYS
                                    . "," . Constants::RACE_STATUS_3DAYS . ")
                                THEN 
                                    CASE
                                        WHEN pric.rp_confirmed IS NULL
                                        THEN pri.no_of_runners ELSE pric.rp_confirmed 
                                    END
                                WHEN ri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                                THEN
                                    (SELECT
                                        COUNT(*)
                                FROM
                                    pre_horse_race phr
                                WHERE phr.race_instance_uid = ri.race_instance_uid
                                    AND phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                                    AND (phr.doubtful_runner IS NULL OR phr.doubtful_runner != 'Y')
                                    AND (phr.non_runner IS NULL OR phr.non_runner != 'Y')
                                    AND (phr.irish_reserve_yn IS NULL OR phr.irish_reserve_yn != 'Y')
                                )
                            ELSE ri.no_of_runners
                            END,
                   sumNonRunners = (CASE
                                        WHEN ri.race_status_code in (" . Constants::RACE_STATUS_OVERNIGHT
                                    . "," . Constants::RACE_STATUS_RESULTS . ")
                                        THEN
                                            (SELECT COUNT(*)
                                             FROM pre_horse_race phr
                                             WHERE phr.race_instance_uid = ri.race_instance_uid
                                             AND phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                                             AND (phr.non_runner = 'Y'))
                                        ELSE 0
                                    END),
                   md.jackpot_text,
                   md.placepot_text,
                   md.quadpot_text,
                   tote.tote_win_money,
                   tote.tote_place_1_money,
                   tote.tote_place_2_money,
                   tote.tote_place_3_money,
                   tote.tote_place_4_money,
                   tote.computer_strght_frcst_money,
                   tote.tricast_money,
                   tote.tote_trio_money,
                   tote.rule4_value,
                   tote.rule4_text,
                   aa.rp_ages_allowed_desc,
                   official_rating_band_desc,
                   gt.going_type_desc,
                   pric.rp_tv_text,
                   perform_race_uid_atr = 
                       CASE WHEN ri.race_status_code != " . Constants::RACE_STATUS_RESULTS . " THEN (
                        SELECT MAX(perform_race_uid)
                        FROM perform_race
                        WHERE perform_race.race_instance_uid = ri.race_instance_uid AND isATR = 1
                        ) 
                        ELSE null
                        END,
                    perform_race_uid_ruk = 
                        CASE WHEN ri.race_status_code  != " . Constants::RACE_STATUS_RESULTS . " THEN (
                            SELECT MAX(perform_race_uid)
                            FROM perform_race
                            WHERE perform_race.race_instance_uid = ri.race_instance_uid AND isATR IS NULL
                        ) 
                        ELSE null
                        END,
                   surface = (
                            SELECT DISTINCT
                                ral.race_attrib_desc
                            FROM
                                race_attrib_join raj,
                                race_attrib_lookup ral
                            WHERE
                                raj.race_attrib_uid = ral.race_attrib_uid
                                AND raj.race_instance_uid = ri.race_instance_uid
                                AND raj.race_attrib_uid IN (" . Constants::SURFACE_RACES_ATTRIBS . ")
                            ),
                   race_class = (
                            SELECT DISTINCT ral.race_attrib_desc
                            FROM race_attrib_join raj, race_attrib_lookup ral
                            WHERE ri.race_instance_uid = raj.race_instance_uid
                                AND raj.race_attrib_uid = ral.race_attrib_uid
                                AND ral.race_attrib_code = (
                                  CASE WHEN c.country_code = 'GB'
                                   THEN " . Constants::RACE_CLASS_SUB . "
                                   ELSE " . Constants::RACE_CLASS . "
                                    END
                                  )
                              )
            FROM race_instance ri
            INNER JOIN course c ON ri.course_uid = c.course_uid
            INNER JOIN meeting_details md ON md.course_uid = c.course_uid
                AND  DATEDIFF(DD, md.meeting_date, ri.race_datetime) = 0
            LEFT JOIN pre_meeting_details pmd ON pmd.course_uid = c.course_uid
                AND DATEDIFF(DD, pmd.meeting_date, ri.race_datetime) = 0
            LEFT JOIN pre_race_instance pri ON pri.race_instance_uid = ri.race_instance_uid
                AND pri.race_status_code = (
                        CASE
                            WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                            THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                            ELSE ri.race_status_code
                        END)
            LEFT JOIN ages_allowed aa ON aa.ages_allowed_uid = ri.ages_allowed_uid
            LEFT JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid
            LEFT JOIN official_rating_band orb ON orb.official_rating_band_uid = ri.official_rating_band_uid
            LEFT JOIN race_instance_tote tote ON ri.race_instance_uid = tote.race_instance_uid
            LEFT JOIN going_type gt ON ri.going_type_code = gt.going_type_code
            LEFT JOIN pre_race_instance_comments pric ON pric.race_instance_uid = ri.race_instance_uid
            LEFT JOIN fast_race_instance fri ON fri.race_datetime = ri.race_datetime
                    AND c.course_name LIKE fri.course_name + '%%'
                    AND EXISTS (
                            SELECT 1 FROM fast_horse_race WHERE fast_race_instance_uid = fri.fast_race_instance_uid
                        )
            LEFT JOIN course c2 ON -- mixed meeting check
                c.rp_abbrev_3 = c2.rp_abbrev_3
                AND c.country_code = c2.country_code
                AND c2.course_uid IN (" . Constants::MIXED_COURSES_IDS . ")
                AND EXISTS(
                    SELECT
                        1
                    FROM
                        race_instance ri2
                    WHERE
                        ri2.race_datetime BETWEEN :dayStart AND :dayEnd
                        AND DAY(ri2.race_datetime)= DAY(ri.race_datetime)
                        AND ri2.course_uid != c.course_uid
                        AND ri2.course_uid = c2.course_uid
                )
            LEFT JOIN course_local_time clt ON clt.course_uid = ri.course_uid 
                AND ri.race_datetime BETWEEN clt.date_from AND clt.date_to
            WHERE ri.race_datetime BETWEEN :dayStartWide AND :dayEndWide
            AND(
                datediff(
                    day,
                    dateadd(
                        MINUTE,
                        isnull(
                            clt.hours_difference,
                            0
                        )* 60,
                        ri.race_datetime
                    ),
                    :meetingDate
                )= 0
                OR datediff(
                    day,
                    ri.race_datetime,
                    :meetingDate
                )= 0
            )
            AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
            AND (NOT EXISTS (
                        SELECT 1
                        FROM race_attrib_join raj
                        WHERE
                            raj.race_instance_uid = ri.race_instance_uid
                            AND raj.race_attrib_uid IN (:incompleteAttribs)
                    )
                    OR c.course_uid IN (" . Constants::FRENCH_COURSES . "))
            ORDER BY race_datetime
        ");

        $builder
            ->setParam('dayStartWide', date("Y-m-d H:i:s", strtotime($raceDate . " 00:00:00 -12 hours")))
            ->setParam('dayEndWide', date("Y-m-d H:i:s", strtotime($raceDate . " 23:59:59 +12 hours")))
            ->setParam('meetingDate', $raceDate)
            ->setParam('dayStart', $raceDate . ' 00:00:00')
            ->setParam('dayEnd', $raceDate . ' 23:59:59')
            ->setParam('incompleteAttribs', Constants::INCOMPLETE_ATTRIB_ARRAY);

        $builder->build();

        $data = $this->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $result = $data->getGroupedResult(
            [
                'meetingId',
                'rp_meeting_order',
                'style_name',
                'course_name',
                'course_uid',
                'mixed_course_uid',
                'country_code',
                'course_type_code',
                'weather_details',
                'races' => [
                    'race_status_code',
                    'race_instance_uid',
                    'fast_race_instance_uid',
                    'race_instance_title',
                    'race_group_uid',
                    'race_group_desc',
                    'race_type_code',
                    'early_closing_race_yn',
                    'perform_race_uid_atr',
                    'perform_race_uid_ruk',
                    'going_type_desc',
                    'sumNonRunners',
                    'going_desc',
                    'race_datetime',
                    'surface',
                    'race_class',
                    'rp_ages_allowed_desc',
                    'no_of_runners',
                    'official_rating_band_desc',
                    'race_datetime',
                    'rp_tv_text',
                    'distance_yard',
                    'hours_difference',
                    'pool_prize_sterling'
                ]
            ]
        );

        $groupedByRaceStatus = $data->getGroupedResult(
            [
                'race_status_code',
                'races' =>
                    [
                        'race_instance_uid',
                    ]
            ],
            [
                'race_status_code',
                'race_instance_uid'
            ]
        );

        return [
            'meetings'=> $result,
            'racesByRaceStatus' => $groupedByRaceStatus
        ];
    }
}
