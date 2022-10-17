<?php

namespace Api\DataProvider\Bo\Bloodstock\Stallion;

use Api\Constants\Horses as Constants;
use Phalcon\Mvc\DataProvider;

class RaceInstance extends DataProvider
{
    public function getDefaultRaceType($stallionId)
    {
        static $result = [];
        if (!array_key_exists($stallionId, $result)) {
            $rows = $this->query(
                "
            SELECT
                " . Constants::RACE_TYPE_FLAT_ALIAS . " = SUM(CASE WHEN ri.race_type_code IN ("
                . Constants::RACE_TYPE_FLAT . ") THEN 1 END)
                , " . Constants::RACE_TYPE_JUMPS_ALIAS . " = SUM(CASE WHEN ri.race_type_code IN ("
                . Constants::RACE_TYPE_JUMPS . ") THEN 1 END)
            FROM
                race_instance ri
            JOIN
                pre_horse_race phr ON ri.race_instance_uid = phr.race_instance_uid
                    AND ri.race_status_code = phr.race_status_code
            JOIN
                horse h ON h.horse_uid = phr.horse_uid AND h.sire_uid = :horseId:
            ",
                ['horseId' => $stallionId]
            );

            $raceCodes = $rows->getFirst();
            $result[$stallionId] = $raceCodes[Constants::RACE_TYPE_FLAT_ALIAS]
            > $raceCodes[Constants::RACE_TYPE_JUMPS_ALIAS]
                ? Constants::RACE_TYPE_FLAT_ALIAS
                : Constants::RACE_TYPE_JUMPS_ALIAS;
        }
        return $result[$stallionId];
    }
}
