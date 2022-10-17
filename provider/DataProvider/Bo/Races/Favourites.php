<?php

declare(strict_types=1);

namespace Api\DataProvider\Bo\Races;

use Api\Constants\Horses as Constants;
use Api\DataProvider\HorsesDataProvider;
use Phalcon\Db\Sql\Builder;

/**
 * @package Api\DataProvider\Bo
 */
class Favourites extends HorsesDataProvider
{
    /**
     * @param string $date
     * @return array
     */
    public function getDateRaces(String $date): array
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
        SELECT ri.race_instance_uid FROM race_instance ri
        WHERE ri.race_datetime BETWEEN :dayStart and :dayEnd
        AND ri.race_status_code NOT IN  (" . Constants::RACE_STATUS_RESULTS . ", " . Constants::RACE_STATUS_ABANDONED . ") 
        AND NOT EXISTS (
            SELECT 1
            FROM race_attrib_join raj
            WHERE raj.race_instance_uid = ri.race_instance_uid
            AND raj.race_attrib_uid IN (:incompleteAttribs))
    ");

        $builder
            ->setParam('dayStart', $date . ' 00:00:00')
            ->setParam('dayEnd', $date . ' 23:59:59')
            ->setParam('incompleteAttribs', Constants::INCOMPLETE_ATTRIB_ARRAY);

        $builder->build();

        $data = $this->query(
            $builder->getSql(),
            $builder->getParams()
        );
        return $data->toArrayWithRows('race_instance_uid');
    }
}
