<?php

declare(strict_types=1);

namespace Api\DataProvider\Bo\Native\Cards\NextRace;

use Api\DataProvider\HorsesDataProvider;
use Phalcon\Db\Sql\Builder;
use Phalcon\Mvc\Model\Row;
use Api\Constants\Horses as Constants;

/**
 * @package Bo\Native\Cards
 */
class Data extends HorsesDataProvider
{
    /**
     * @param string $date
     *
     * @return Row
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getData(string $date): ?Row
    {
        $dateEnd = new \DateTime($date);
        $dateEnd->add(new \DateInterval('P14D'));

        $builder = new Builder();
        $builder->setSqlTemplate("
        SELECT TOP 1
            ri.race_instance_uid,
            ri.race_datetime
        FROM
         race_instance ri 
            LEFT JOIN course c ON ri.course_uid = c.course_uid
        WHERE c.country_code IN ('" . CONSTANTS::COUNTRY_GB . "','" . CONSTANTS::COUNTRY_IRE . "')
            AND ri.race_type_code NOT IN ('" . CONSTANTS::COURSE_TYPE_P2P_CODE ."')
            AND ri.race_status_code = " . CONSTANTS::RACE_STATUS_OVERNIGHT ."
            AND ri.race_datetime > getDate()
        ORDER BY ri.race_datetime
        ");

        $rtn = $this->queryBuilder($builder)->getFirst();
        return $rtn ? $rtn : null;
    }
}
