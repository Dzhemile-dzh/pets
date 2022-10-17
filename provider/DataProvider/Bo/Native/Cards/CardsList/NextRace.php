<?php

declare(strict_types=1);

namespace Api\DataProvider\Bo\Native\Cards\CardsList;

use Api\DataProvider\HorsesDataProvider;
use Api\Input\Request\Horses\Native\Cards\CardsList as Request;
use Phalcon\Db\Sql\Builder;

/**
 * @package Api\DataProvider\Bo\Native\Cards
 */
class NextRace extends HorsesDataProvider
{
    /**
     * @return bool
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function isAvailable(): bool
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
                SELECT TOP 1
                   nr.next_race_uid race_id
                FROM ss_next_race nr
                INNER JOIN race_instance ri ON (nr.next_race_uid = ri.race_instance_uid)
                INNER JOIN course c ON (c.course_uid = ri.course_uid)
                WHERE
                    nr.festival_type = 'd2d'
                ORDER BY nr.next_race_number
        ");

        $data = $this->queryBuilder($builder);

        $res = $data->getFirst();

        return (!empty($res));
    }
}
