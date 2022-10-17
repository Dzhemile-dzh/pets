<?php

namespace Models\Bo\RaceCards;

use \Api\Constants\Horses as Constants;

/**
 * Class Horse
 *
 * @package Models\Bo\RaceCards
 */
class Horse extends \Models\Horse
{

    /**
     * @param $raceId
     *
     * @return array
     * @throws \Exception
     */
    public function getHorseIdsForStatistics($raceId)
    {
        $sql = "
            SELECT pre_horse_race.horse_uid
            FROM race_instance
            JOIN pre_horse_race ON
                pre_horse_race.race_instance_uid = race_instance.race_instance_uid
                AND pre_horse_race.race_status_code =
                (
                    CASE
                        WHEN race_instance.race_status_code IN (" . Constants::RACE_STATUS_RESULTS . ","
            . Constants::RACE_STATUS_ABANDONED . ")
                        THEN " . Constants::RACE_STATUS_OVERNIGHT . " 
                        ELSE race_instance.race_status_code
                    END
                )
            WHERE
                race_instance.race_instance_uid = :raceId
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            ['raceId' => $raceId]
        );

        $horses = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return $horses->getField('horse_uid');
    }

    /**
     * @param $raceIds
     * @return array
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getLongHandicapPerRaces($raceIds)
    {
        $sql = "
            SELECT
                   pri.race_instance_uid,
                   h.horse_uid,
                   h.style_name,
                   h.country_origin_code,
                   phr.weight_carried_lbs,
                   pri.weights_raised_lbs,
                   extra_weight_lbs = cast(isnull(phr3.extra_weight_lbs, 0) as int) - cast(isnull(phr.extra_weight_lbs, 0) as int),
                   phr.saddle_cloth_no,
                   horse_age = year(pri.race_datetime) - year(h.horse_date_of_birth),
                   pri.minimum_weight_lbs,
                   pri.three_yo_min_weight_lbs
            FROM  horse h,
                  pre_horse_race phr,
                  pre_race_instance pri,
                  pre_horse_race phr3,
                  course c
            WHERE pri.race_instance_uid IN (:raceIds)
            AND   pri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
            AND   phr.race_instance_uid = pri.race_instance_uid
            AND   phr.race_status_code =
                  CASE 
                      WHEN c.country_code = 'IRE' 
                      THEN " . Constants::RACE_STATUS_3DAYS . " 
                      ELSE " . Constants::RACE_STATUS_4DAYS . "
                  END
            AND   phr3.race_instance_uid = phr.race_instance_uid
            AND   phr3.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
            AND   phr3.horse_uid = phr.horse_uid
            AND   h.horse_uid = phr.horse_uid
            AND   c.course_uid = pri.course_uid
            ORDER BY phr.saddle_cloth_no
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            ['raceIds' => $raceIds]
        );

        $horses = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return $horses->getGroupedResult(
            [
                'race_instance_uid',
                'handicap' => [
                    'horse_uid',
                    'style_name',
                    'country_origin_code',
                    'weight_carried_lbs',
                    'weights_raised_lbs',
                    'extra_weight_lbs',
                    'saddle_cloth_no',
                    'horse_age',
                    'minimum_weight_lbs',
                    'three_yo_min_weight_lbs'
                ]
            ],
            ['race_instance_uid', 'horse_uid']
        );
    }

    public function getLongHandicap($raceId)
    {
        $sql = "
            SELECT
                   h.horse_uid,
                   h.style_name,
                   h.country_origin_code,
                   phr.weight_carried_lbs,
                   pri.weights_raised_lbs ,
                   extra_weight_lbs = cast(isnull(phr3.extra_weight_lbs, 0) as int) - cast(isnull(phr.extra_weight_lbs, 0) as int),
                   phr.saddle_cloth_no,
                   horse_age = year(pri.race_datetime) - year(h.horse_date_of_birth),
                   pri.minimum_weight_lbs,
                   pri.three_yo_min_weight_lbs
            FROM  horse h,
                  pre_horse_race phr,
                  pre_race_instance pri,
                  pre_horse_race phr3,
                  course c
            WHERE pri.race_instance_uid = :raceId
            AND   pri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
            AND   phr.race_instance_uid = pri.race_instance_uid
            AND   phr.race_status_code =
                  CASE 
                      WHEN c.country_code = 'IRE' 
                      THEN " . Constants::RACE_STATUS_3DAYS . " 
                      ELSE " . Constants::RACE_STATUS_4DAYS . "
                  END
            AND   phr3.race_instance_uid = phr.race_instance_uid
            AND   phr3.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
            AND   phr3.horse_uid = phr.horse_uid
            AND   h.horse_uid = phr.horse_uid
            AND   c.course_uid = pri.course_uid
            ORDER BY phr.saddle_cloth_no
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            ['raceId' => $raceId]
        );

        $horses = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return $horses->toArrayWithRows();
    }
}
