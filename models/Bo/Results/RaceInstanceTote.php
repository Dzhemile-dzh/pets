<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 02.10.2014
 * Time: 13:52
 */

namespace Models\Bo\Results;

class RaceInstanceTote extends \Models\RaceInstanceTote
{

    /**
     * @param int|array $raceId
     *
     * @return array|null|string
     */
    public function getRuleFourByRaceId(array $raceId)
    {
        $sql = "SELECT race_instance_uid, rule4_text
                FROM race_instance_tote
                WHERE race_instance_uid IN (:race_instance_uid:)";

        $res = $this->getReadConnection()->query(
            $sql,
            ['race_instance_uid' => $raceId]
        );

        $resultCollection = new \Phalcon\Mvc\Model\Resultset\General(null, new \Phalcon\Mvc\Model\Row(), $res);

        $resultArray = $resultCollection->toArrayWithRows('race_instance_uid');

        return $resultArray;
    }
}
