<?php

namespace Models\Bo\Results;

use Api\Constants\Horses as Constants;
use \Phalcon\Mvc\Model\Resultset\General;
use \Phalcon\Mvc\Model\Resultset\ResultsetException;
use \Phalcon\Mvc\Model\Row\General as RowGeneral;

/**
 * Class RaceAttribLookup
 *
 * @package Models\Bo\Results
 */
class RaceAttribLookup extends \Models\RaceAttribLookup
{
    /**
     * @param int $raceId
     *
     * @return \Phalcon\Mvc\ModelInterface
     * @throws ResultsetException
     */
    public function getRaceClass($raceId)
    {
        $sql = "
            SELECT
                ral.race_attrib_desc
            FROM race_attrib_join raj
            JOIN race_attrib_lookup ral ON raj.race_attrib_uid = ral.race_attrib_uid
            WHERE
                raj.race_instance_uid = :race_instance_uid
            AND ral.race_attrib_code = " . Constants::RACE_CLASS_SUB;

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'race_instance_uid' => $raceId
            ]
        );

        $classes = new General(
            null,
            new RowGeneral(),
            $res
        );

        return $classes->getFirst();
    }

    /**
     * @param int $raceId
     *
     * @return array
     * @throws ResultsetException
     */
    public function getRaceCategory($raceId)
    {
        $sql = "
            SELECT
                ral.race_attrib_desc
            FROM race_attrib_join raj
            JOIN race_attrib_lookup ral ON raj.race_attrib_uid = ral.race_attrib_uid
            WHERE
                raj.race_instance_uid = :race_instance_uid
            AND ral.race_attrib_code = " . Constants::RACE_ATTRIB_CATEGORY;

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'race_instance_uid' => $raceId
            ]
        );

        $categories = new General(
            null,
            new RowGeneral(),
            $res
        );

        return $categories->toArrayWithRows();
    }
}
