<?php

declare(strict_types=1);

namespace Api\DataProvider\Bo\Native\Cards;

use Phalcon\Mvc\Model\Row;
use Api\DataProvider\HorsesDataProvider;
use Phalcon\Mvc\Model\Resultset\ResultsetException;

/**
 * @package Api\DataProvider\Bo\Native\Cards
 */
class BetToView extends HorsesDataProvider
{
    /**
     * @param int $raceId
     *
     * @return Row
     * @throws ResultsetException
     */
    public function getData(int $raceId): Row
    {
        $sql = "
            SELECT TOP 1
                pr.perform_race_uid
            FROM race_instance ri
                LEFT JOIN perform_race pr ON  pr.race_instance_uid = ri.race_instance_uid
            WHERE ri.race_instance_uid = :raceId
        ";

        return $this->query($sql, ['raceId' => $raceId])->getFirst();
    }
}
