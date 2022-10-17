<?php

declare(strict_types=1);

namespace Api\DataProvider\Bo\Native\Results;

use Phalcon\Db\Sql\Builder;
use Api\Constants\Horses as Constants;
use Api\DataProvider\HorsesDataProvider;

/**
 * @package Api\DataProvider\Bo\Native\Results
 */
class ResultsList extends HorsesDataProvider
{
    /**
     * @param string $resultsDate
     *
     * @return array|null
     */
    public function getData(string $resultsDate): ?array
    {
        $builder = new Builder();
        //If a race is with race_group_code = H and there are >=16 runners we have to show first 4 positions
        //otherwise we have to show first 3
        $sqlGetPositonsToShow = "(SELECT CASE WHEN race_group_code = ".Constants::RACE_GROUP_CODE_HANDICAP." 
                                                    AND count(1)>=16 
                                              THEN 4 
                                              ELSE 3 
                                         END 
                                 FROM horse_race
                                    LEFT JOIN race_instance
                                      ON horse_race.race_instance_uid = race_instance.race_instance_uid
                                    LEFT JOIN race_group 
                                      ON race_group.race_group_uid = race_instance.race_group_uid
                                WHERE race_instance.race_instance_uid = ri.race_instance_uid 
                                    AND race_outcome_uid NOT IN (60,61,62)
                                GROUP BY race_group.race_group_code)";

        $builder->setSqlTemplate("

            SELECT
				query_position = CASE WHEN c.country_code IN ('GB','IRE') THEN 1 ELSE 2 END,
				
                c.course_uid,
                course_name = c.style_name,
                c.country_code AS course_country,
                ri.race_instance_uid,
                ri.race_status_code,
                ri.race_datetime,
                ri.pool_prize_sterling,
                card_details_available = /*{EXPRESSION(card_details_available)}*/,
                horse_name = CASE WHEN h.style_name IS null 
                                            THEN fhr.horse_name
                                            ELSE h.style_name
                                          END,
                ro.race_outcome_position as position,
                ro.race_outcome_code,
                rate = CASE WHEN o.odds_desc IS null 
                                            THEN fhr.starting_price
                                            ELSE o.odds_desc
                                          END,
                pric.rp_tv_text,
                ri.race_group_uid,
                race_class = attr.race_attrib_desc
            FROM race_instance ri
                INNER JOIN course c ON ri.course_uid = c.course_uid
                LEFT JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
                LEFT JOIN fast_race_instance fri ON fri.race_datetime = ri.race_datetime
                    AND c.course_name LIKE fri.course_name + '%%'
                LEFT JOIN horse h ON h.horse_uid = hr.horse_uid
                LEFT JOIN fast_horse_race fhr ON fhr.fast_race_instance_uid = fri.fast_race_instance_uid
                    AND fhr.horse_name = 
                                          CASE WHEN UPPER(h.style_name) IS NULL
                                            THEN fhr.horse_name
                                            ELSE h.style_name
                                          END
                INNER JOIN race_outcome ro ON ro.race_outcome_uid =
                                          CASE WHEN hr.final_race_outcome_uid > 0
                                            THEN hr.final_race_outcome_uid
                                            ELSE fhr.race_outcome_position
                                          END
                    AND ro.race_output_order <= CASE WHEN hr.final_race_outcome_uid > 0
                            THEN {$sqlGetPositonsToShow}
                            ELSE 3 
                        END
                LEFT JOIN odds o ON o.odds_uid = hr.starting_price_odds_uid
                LEFT JOIN pre_race_instance_comments pric 
                      ON pric.race_instance_uid = ri.race_instance_uid
                LEFT JOIN (
                    SELECT ral.race_attrib_code, raj.race_instance_uid, ral.race_attrib_desc
                    FROM race_attrib_join raj
                       LEFT JOIN race_attrib_lookup ral ON raj.race_attrib_uid = ral.race_attrib_uid
                    WHERE ral.race_attrib_desc IS NOT NULL 
                    AND ral.race_attrib_code IN (" . Constants::RACE_CLASS_SUB . ", " . Constants::RACE_CLASS . ")
                    ) attr ON attr.race_instance_uid = ri.race_instance_uid
                    AND (c.country_code = 'GB' AND attr.race_attrib_code = " . Constants::RACE_CLASS_SUB . "
                        OR c.country_code != 'GB' AND  attr.race_attrib_code = " . Constants::RACE_CLASS . ")
            WHERE ri.race_datetime BETWEEN :startDate AND :endDate
                AND ri.race_type_code != 'P'
                AND NOT (c.country_code = :country AND c.course_type_code = 'P')
                AND c.course_name NOT LIKE '%P-T-P%'
              AND NOT EXISTS (SELECT 1
                    FROM race_attrib_join raj
                    WHERE raj.race_instance_uid = ri.race_instance_uid 
                    --By a requirement, when we retrieve a list with races, we have to exclude those raceIDs which can be seen below this comment
                    AND raj.race_attrib_uid IN (432, 433)
                    --We must display all of the French courses even if they have race_attrib_uid equal to 422 and 433
                    AND c.course_uid NOT IN (".Constants::FRENCH_COURSES."))
            ORDER BY query_position, c.style_name, ri.race_datetime, position
            PLAN '(use optgoal allrows_dss)'
        ");

        $builder->expression(
            'card_details_available',
            'CASE
                    WHEN
                        EXISTS (
                            SELECT 1
                            FROM pre_horse_race phr
                            WHERE phr.race_instance_uid = ri.race_instance_uid AND phr.race_status_code = \'O\'
                        )
                    THEN 1 ELSE 0
                END'
        );

        $builder->setParam('startDate', date("Y-m-d H:i:s", strtotime($resultsDate . " 00:01:00")));
        $builder->setParam('endDate', date("Y-m-d H:i:s", strtotime($resultsDate . " 23:59:59")));
        $builder->setParam('country', Constants::COUNTRY_GB);

        $builder->build();

        $data = $this->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $result = $data->getGroupedResult(
            [
                'course_uid',
                'course_name',
                'course_country',
                'query_position',
                'races' => [
                    'race_instance_uid',
                    'race_datetime',
                    'race_status_code',
                    'card_details_available',
                    'rp_tv_text',
                    'race_group_uid',
                    'race_class',
                    'pool_prize_sterling',
                    'runners' => [
                        'race_outcome_code',
                        'horse_name',
                        'rate'
                    ]
                ]
            ]
        );

        return !empty($result) ? $result : null;
    }
}
