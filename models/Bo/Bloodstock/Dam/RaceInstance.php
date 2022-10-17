<?php

namespace Models\Bo\Bloodstock\Dam;

use Api\Constants\Horses as Constants;

class RaceInstance extends \Models\RaceInstance
{
    /**
     * @param int $damId
     *
     * @return array
     */
    public function getProgenyEntries($damId)
    {
        $sql = "
            SELECT
                race_instance.race_instance_uid,
                race_instance.race_datetime,
                race_instance.distance_yard,
                race_instance.race_instance_title,
                race_instance.race_status_code,
                race_instance_prize.prize_sterling,
                course.course_name,
                course.course_uid,
                course.style_name as course_style_name,
                going_type.rp_going_type_desc,
                pre_race_instance.no_of_runners,
                horse.style_name,
                horse.horse_uid,
                horse.country_origin_code

            FROM race_instance
            JOIN pre_horse_race
                ON race_instance.race_instance_uid = pre_horse_race.race_instance_uid
                AND race_instance.race_status_code = pre_horse_race.race_status_code
            JOIN course ON course.course_uid = race_instance.course_uid
            JOIN horse ON horse.horse_uid = pre_horse_race.horse_uid
            JOIN pre_race_instance
                ON pre_race_instance.race_instance_uid = race_instance.race_instance_uid
                AND pre_race_instance.race_status_code = race_instance.race_status_code
            LEFT JOIN going_type ON going_type.going_type_code = race_instance.going_type_code
            LEFT JOIN race_instance_prize
                ON race_instance_prize.race_instance_uid = race_instance.race_instance_uid
                AND race_instance_prize.position_no = 1
            WHERE
                horse.dam_uid = :damId:
                AND NOT EXISTS (
                        SELECT 1 FROM race_attrib_lookup ral, race_attrib_join raj
                        WHERE raj.race_instance_uid = race_instance.race_instance_uid
                            AND raj.race_attrib_uid = ral.race_attrib_uid
                            AND ral.race_attrib_uid IN (:exclude1:, :exclude2:)
                        )
            ORDER BY race_instance.race_datetime
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'damId' => $damId,
                'exclude1' => Constants::INCOMPLETE_CARD_ATTRIBUTE_ID,
                'exclude2' => Constants::INCOMPLETE_RACE_ATTRIBUTE_ID
            ]
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\Bloodstock\Dam\ProgenyEntries(),
            $res
        );

        return $result->toArrayWithRows();
    }
}
