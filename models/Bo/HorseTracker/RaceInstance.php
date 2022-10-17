<?php

namespace Models\Bo\HorseTracker;

use Api\Constants\Horses as Constants;
use Api\Input\Request\Horses\HorseTracker as Request;
use Phalcon\Mvc\Model\Resultset\General as ResultSet;
use Phalcon\Mvc\Model\Row\General as Row;
use Phalcon\DI;

class RaceInstance extends \Models\RaceInstance
{
    /**
     * @param Request\Entries $request
     *
     * @return array
     */
    public function getEntries(Request\Entries $request)
    {

        $ageSql = DI::getDefault()->getShared('selectors')->getHorseAgeSQL(
            'h.horse_date_of_birth',
            'h.country_origin_code'
        );
        $ugcDb = DI::getDefault()->getShared('selectors')->getDb()->getUgcDb();

        $sql = "
            SELECT
                h.horse_uid
                , h.horse_name
                , horse_style_name = h.style_name
                , horse_country_origin_code = h.country_origin_code
                , dam_uid = h.dam_uid
                , sire_uid = h.sire_uid
                , dam_style_name = h_d.style_name
                , sire_style_name = h_s.style_name
                , dam_horse_name = h_d.horse_name
                , sire_horse_name = h_s.horse_name
                , horse_age = {$ageSql}
                , ri.race_instance_uid
                , ri.race_datetime
                , ri.race_status_code
                , ri.race_instance_title
                , ri.distance_yard
                , rg.race_group_code
                , rg.race_group_desc
                , phr.saddle_cloth_no
                , phr.running_conditions
                , phr.rp_postmark
                , phr.rp_owner_choice
                , c.course_name
                , c.course_uid
                , course_style_name = c.style_name
                , j.jockey_uid
                , jockey_style_name = j.style_name
                , ho.owner_uid
                , o.owner_name
                , ht.trainer_uid
                , t.trainer_name
                , race_class = (
                    SELECT ral.race_attrib_desc
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
                , big_race_entry = CASE 
                    WHEN ri.race_group_uid IN (1, 2, 3, 4, 7, 8, 9) OR rip.prize_sterling >= 60000.00 
                    THEN 'Y' ELSE 'N' END
                , declared = (
                    CASE WHEN EXISTS (
                                SELECT pri1.race_instance_uid
                                FROM
                                    pre_race_instance pri1
                                    INNER JOIN pre_horse_race phr1 ON phr1.race_instance_uid = pri1.race_instance_uid
                                    INNER JOIN race_instance ri1 ON ri1.race_instance_uid = pri1.race_instance_uid
                                WHERE
                                    pri1.race_instance_uid = phr.race_instance_uid
                                    AND phr1.horse_uid = phr.horse_uid
                                    AND ri1.race_type_code != " . Constants::RACE_TYPE_P2P . "
                                    AND phr1.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                                    AND pri1.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                                )
                        THEN 1
                        ELSE 0
                    END
                )
            FROM race_instance ri
                JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid
                JOIN pre_horse_race phr ON ri.race_instance_uid = phr.race_instance_uid 
                    AND phr.race_status_code = ri.race_status_code
                JOIN course c ON ri.course_uid = c.course_uid
                JOIN horse h ON h.horse_uid = phr.horse_uid
                LEFT JOIN jockey j ON phr.jockey_uid = j.jockey_uid
                LEFT JOIN horse_owner ho ON ho.horse_uid = phr.horse_uid AND ho.owner_change_date = '1900-01-01 00:00:00'
                LEFT JOIN horse_trainer ht ON ht.horse_uid = phr.horse_uid AND ht.trainer_change_date = '1900-01-01 00:00:00'
                LEFT JOIN owner o ON ho.owner_uid = o.owner_uid
                LEFT JOIN trainer t ON ht.trainer_uid = t.trainer_uid
                LEFT JOIN race_instance_prize rip ON rip.race_instance_uid = ri.race_instance_uid AND rip.position_no = 1
                LEFT JOIN horse h_s ON h_s.horse_uid = h.sire_uid
                LEFT JOIN horse h_d ON h_d.horse_uid = h.dam_uid
            WHERE
                ri.race_datetime >= CONVERT(DATETIME, CONVERT(DATE, GETDATE()))
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND EXISTS (
                  SELECT 1 
                  FROM {$ugcDb}..organiser_horses uoh 
                  WHERE phr.horse_uid = uoh.horse_uid 
                  AND reg_uid = :userId: AND alert_me = 'Y'
                )
            ORDER BY 
                ri.race_datetime
                , h.horse_name
            PLAN'(use optgoal allrows_dss)(use merge_join off)'
            ";

        $res = $this->getReadConnection()->query($sql, ['userId' => $request->getUserId()]);

        $resultSet = new ResultSet(null, new Row(), $res);

        $raceResult = $resultSet->getGroupedResult(
            [
                'horse_uid',
                'horse_name',
                'horse_style_name',
                'horse_country_origin_code',
                'horse_age',
                'sire_uid',
                'sire_horse_name',
                'sire_style_name',
                'dam_uid',
                'dam_horse_name',
                'dam_style_name',

                'races' => [
                    'race_instance_uid',
                    'race_datetime',
                    'race_status_code',
                    'race_instance_title',
                    'distance_yard',
                    'race_group_code',
                    'race_group_desc',
                    'saddle_cloth_no',
                    'running_conditions',
                    'rp_postmark',
                    'rp_owner_choice',
                    'course_name',
                    'course_uid',
                    'course_style_name',
                    'jockey_uid',
                    'jockey_style_name',
                    'owner_uid',
                    'owner_name',
                    'trainer_uid',
                    'trainer_name',
                    'race_class',
                    'big_race_entry',
                    'declared'
                ]
            ]
        );

        return $raceResult;
    }
}
