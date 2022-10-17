<?php

namespace Models\Bo\Bloodstock\Dam;

use Api\Constants\Horses as Constants;

/**
 * Class HorseRace
 *
 * @package Models\Bo\Bloodstock\Dam
 */
class HorseRace extends \Models\HorseRace
{
    public function getTopRprYards($horseId, $bestRpr)
    {
        $sql = "
                SELECT MAX(ri.distance_yard) dst_yard
                FROM horse_race hr, race_instance ri
                WHERE hr.horse_uid = :horseId
                    AND hr.rp_postmark = :rp_postmark
                    AND ri.race_instance_uid = hr.race_instance_uid
                    AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                    AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                ";
        $res = $this->getReadConnection()->query(
            $sql,
            [
                'horseId' => $horseId,
                'rp_postmark' => $bestRpr
            ]
        );

        $resultCollection = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );
        $result = $resultCollection->toArrayWithRows();
        return count($result) ? $result[0]->dst_yard : null;
    }
}
