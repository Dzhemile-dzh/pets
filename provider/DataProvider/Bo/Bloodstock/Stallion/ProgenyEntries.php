<?php

namespace Api\DataProvider\Bo\Bloodstock\Stallion;

use Phalcon\Mvc\DataProvider;
use Api\Input\Request\Horses\Bloodstock\Stallion\ProgenyEntries as Request;
use Models\Selectors;
use Api\Constants\Horses as Constants;

class ProgenyEntries extends DataProvider
{
    /**
     * @param Request   $request
     * @param Selectors $selectors
     *
     * @return \Api\Row\Bloodstock\Stallion\ProgenyEntries[]|null
     */
    public function getProgenyEntries(Request $request, Selectors $selectors)
    {
        $ageSql = $selectors->getHorseAgeSQL('h.horse_date_of_birth', 'h.country_origin_code', 'ri.race_datetime');
        $bindParams = ['horseId' => $request->getStallionId()];

        if ($request->getRaceType() == 'big-races') {
            $whereSql = $selectors->getBigRaceSql('ri.race_group_uid', 'ri.race_type_code', 'rip.prize_sterling');
        } else {
            $whereSql = 'ri.race_type_code IN (:raceTypeCodes:)';
            $bindParams = array_merge($bindParams, ['raceTypeCodes' => $request->getRaceTypeCodes()]);
        }

        $sql = "
            SELECT
                ri.race_instance_uid
                , ri.race_datetime
                , ri.distance_yard
                , ri.race_instance_title
                , ri.race_status_code
                , rip.prize_sterling
                , c.course_name
                , c.course_uid
                , course_style_name = c.style_name
                , pri.no_of_runners
                , h.style_name
                , h.country_origin_code
                , h.horse_uid
                , dam_style_name = dam.style_name
                , dam_country_origin_code = dam.country_origin_code
                , dam_horse_uid = dam.horse_uid
                , aa.rp_ages_allowed_desc
                , ri.race_type_code
                , rg.race_group_code
                , rg.race_group_desc
                , actual_race_class = (
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
                )
                , horse_age = %s
            FROM
                horse h
                JOIN 
                    pre_horse_race phr ON h.horse_uid = phr.horse_uid
                JOIN 
                    race_instance ri ON ri.race_instance_uid = phr.race_instance_uid
                      AND ri.race_status_code = phr.race_status_code
                JOIN 
                    course c ON c.course_uid = ri.course_uid
                JOIN 
                    horse dam ON dam.horse_uid = h.dam_uid
                JOIN 
                    pre_race_instance pri ON pri.race_instance_uid = ri.race_instance_uid
                      AND pri.race_status_code = ri.race_status_code
                LEFT JOIN
                    race_instance_prize rip ON rip.race_instance_uid = ri.race_instance_uid AND rip.position_no = 1
                LEFT JOIN
                    ages_allowed aa ON aa.ages_allowed_uid = ri.ages_allowed_uid
                LEFT JOIN
                    race_group rg ON rg.race_group_uid = ri.race_group_uid
            WHERE
                h.sire_uid = :horseId:
                AND NOT EXISTS (
                        SELECT 1 FROM race_attrib_lookup ral, race_attrib_join raj
                        WHERE raj.race_instance_uid = ri.race_instance_uid
                            AND raj.race_attrib_uid = ral.race_attrib_uid
                            AND ral.race_attrib_uid IN (:exclude1:, :exclude2:)
                        )
                AND %s
            ORDER BY
                ri.race_datetime
            PLAN '(use optgoal allrows_dss)(nl_join (i_scan h)(i_scan phr)(i_scan ri)(i_scan c)(i_scan dam))'
        ";

        $result = $this->query(
            sprintf($sql, $ageSql, $whereSql),
            array_merge(
                $bindParams,
                [
                    'exclude1' => Constants::INCOMPLETE_CARD_ATTRIBUTE_ID,
                    'exclude2' => Constants::INCOMPLETE_RACE_ATTRIBUTE_ID
                ]
            ),
            new \Api\Row\Bloodstock\Stallion\ProgenyEntries()
        );

        return $result->toArrayWithRows() ?: null;
    }
}
