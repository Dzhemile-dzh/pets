<?php

namespace Models\Bo\RaceCards;

use \Api\Constants\Horses as Constants;

/**
 * Class Jockey
 *
 * @package Models\Bo\RaceCards
 */
class Jockey extends \Models\Jockey
{
    /**
     * @param $raceId
     *
     * @return array
     * @throws \Exception
     */
    public function getJockeyIdsForStatistics($raceId)
    {
        $sql = "
            SELECT jockey.jockey_uid
            FROM race_instance
            JOIN pre_horse_race ON
                pre_horse_race.race_instance_uid = race_instance.race_instance_uid
                AND pre_horse_race.race_status_code =
                (
                    CASE
                        WHEN race_instance.race_status_code IN (" . Constants::RACE_STATUS_RESULTS . ","
            . Constants::RACE_STATUS_ABANDONED . ")
                        THEN " . Constants::RACE_STATUS_OVERNIGHT . " ELSE race_instance.race_status_code
                    END
                )
            JOIN jockey ON pre_horse_race.jockey_uid = jockey.jockey_uid
            WHERE
                race_instance.race_instance_uid = :raceId


        ";

        $res = $this->getReadConnection()->query(
            $sql,
            ['raceId' => $raceId]
        );

        $jockeys = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return $jockeys->getField('jockey_uid');
    }
}
