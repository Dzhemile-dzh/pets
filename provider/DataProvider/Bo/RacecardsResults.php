<?php

declare(strict_types=1);

namespace Api\DataProvider\Bo;

use Api\DataProvider\HorsesDataProvider;
use Api\Input\Request\Horses\RacecardsResults as Request;
use Phalcon\Db\Sql\Builder;

/**
 * This is used to check what race status we are at to then determine which tables we want to use to retrieve
 * the rest of the data - ie. pre_horse_race or horse_race
 * Class RacecardsResults
 * @package Api\DataProvider\Bo
 */
class RacecardsResults extends HorsesDataProvider
{
    /**
     * @param $raceUid
     * @return array
     */
    public function getRaceStatusCodeAndRaceDatetime($raceUid): array
    {

        $builder = new Builder();
        $builder->setSqlTemplate("SELECT race_status_code, race_datetime FROM race_instance WHERE race_instance_uid = :raceUid");

        $builder
            ->setParam('raceUid', $raceUid);

        $builder->build();

        $data = $this->query(
            $builder->getSql(),
            $builder->getParams()
        );

        return $data->toArray();
    }
}
