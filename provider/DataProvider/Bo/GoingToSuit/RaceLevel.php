<?php

namespace Api\DataProvider\Bo\GoingToSuit;

use Api\Constants\Horses as Constants;
use Api\Input\Request\Horses\GoingToSuit as Request;

/**
 * Class RaceLevel
 *
 * @package Api\DataProvider\Bo\GoingToSuit
 */
class RaceLevel extends \Phalcon\Mvc\DataProvider
{
    /**
     * @param Request\RaceLevel $request
     *
     * @return mixed
     */
    public function getRaceLevel(Request\RaceLevel $request)
    {
        $raceDate = $request->getRaceDate();

        $sql = "
            SELECT
                ri.race_instance_uid
                , going_to_suit = 
                    CASE WHEN c.country_code in ('GB', 'IRE') 
                        AND ri.race_type_code in (
                        " . Constants::RACE_TYPE_FLAT_TURF . ",
                        " . Constants::RACE_TYPE_NH_FLAT . ",
                        " . Constants::RACE_TYPE_CHASE_TURF . ",
                        " . Constants::RACE_TYPE_HURDLE_TURF . ",
                        " . Constants::RACE_TYPE_HUNTER_CHASE . "
                        ) 
                    THEN 'Y' ELSE 'N' END 
            FROM race_instance ri
                INNER JOIN course c ON c.course_uid = ri.course_uid
            WHERE 
                ri.race_datetime BETWEEN :dateFrom: AND :dateTo: 
            ORDER BY 
                ri.race_datetime DESC
        ";

        $result = $this->query(
            $sql,
            [
                'dateFrom' => $raceDate . ' 01:01',
                'dateTo' => $raceDate . ' 23:59',
            ]
        );

        return $result->toArrayWithRows();
    }
}
