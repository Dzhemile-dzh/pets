<?php

declare(strict_types=1);

namespace Models\Bo\Ads;

use \Api\Constants\Horses as Constants;

/**
 * Class Horse
 *
 * @package Models\Bo\Ads
 */
class Horse extends \Models\Horse
{
    /**
     * @param int $raceId
     *
     * @return array|null
     */
    public function getWinnerAndRaceInfo(int $raceId): ?array
    {
        $res = $this->getReadConnection()->query(
            "SELECT
                horse.sire_uid
                , horse.dam_uid
                , horse.horse_uid
                , horse.breeder_uid
                , ri.race_type_code
                , ri.race_datetime
                , ri.race_instance_title
                , race_group_uid = CASE WHEN ri.race_group_uid = " . Constants::RACE_GROUP_LISTED_HANDICAPS . " THEN "
            . Constants::RACE_GROUP_LISTED . " ELSE ri.race_group_uid END
                , rip.prize_sterling
                , c.country_code
                , horse.horse_date_of_birth
                , hr.jockey_uid
                , horse.country_origin_code
                , rg.race_group_code
                , sell_attr = (SELECT raj.race_attrib_uid FROM race_attrib_join raj WHERE raj.race_instance_uid=:race_instance_uid: AND raj.race_attrib_uid = "
            . Constants::RACE_ATTRIB_SELL . ")
                , claim_attr = (SELECT raj.race_attrib_uid FROM race_attrib_join raj WHERE raj.race_instance_uid=:race_instance_uid: AND raj.race_attrib_uid = "
            . Constants::RACE_ATTRIB_CLAIM . ")
            FROM
                race_instance ri
            LEFT JOIN
                horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
            JOIN
                horse ON horse.horse_uid = hr.horse_uid
            JOIN
                race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
            JOIN
                course c ON c.course_uid = ri.course_uid
            LEFT JOIN
                race_instance_prize rip ON rip.race_instance_uid = ri.race_instance_uid
            LEFT JOIN
                race_group rg ON rg.race_group_uid = ri.race_group_uid
            WHERE
                ri.race_instance_uid = :race_instance_uid:
                AND ro.race_outcome_position = 1
                AND rip.position_no = 1
            ",
            [
                'race_instance_uid' => $raceId,
            ]
        );

        $resultCollection = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\Ads\WinnerAndRaceInfo(),
            $res
        );

        $result = $resultCollection->toArrayWithRows();

        return $result ? $result : null;
    }
}
