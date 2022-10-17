<?php

namespace Api\DataProvider\Validator;

/**
 * Class ResultsRaceIdLimitedDate
 *
 * @package Api\DataProvider
 */
class ResultsRaceIdLimitedDate extends \Api\DataProvider\HorsesDataProvider
{
    /**
     * @param int $raceId
     *
     * @return \Phalcon\Mvc\Model\Row|null
     */
    public function getRaceInfo($raceId)
    {
        $sql = "
            SELECT
                race_datetime
            FROM
                race_instance
            WHERE
                race_instance_uid = :raceId:
        ";

        $res = $this->query(
            $sql,
            [
                'raceId' => $raceId
            ]
        );

        return ($res->getFirst()) ? : null;
    }
}
