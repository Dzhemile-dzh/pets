<?php

declare(strict_types=1);

namespace Api\DataProvider\Bo\Native\Cards\DateMenu;

use Api\DataProvider\HorsesDataProvider;
use Api\Input\Request\Horses\Native\Cards\BigRaces as Request;
use Phalcon\Db\Sql\Builder;
use Phalcon\Mvc\Model\Row;

/**
 * @package Api\DataProvider\Bo\Native\Cards\DateMenu
 */
class DatesWithRaces extends HorsesDataProvider
{
    /**
     * @param string $dateStart
     * @param string $dateEnd
     *
     * @return array
     */
    public function getData(string $dateStart, string $dateEnd): array
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
                SELECT 
                    COUNT(ri.race_instance_uid) race_count,
                    CONVERT(CHAR(10), ri.race_datetime, 104)  race_date
                FROM 
                    race_instance ri
                WHERE  
                    ri.race_datetime BETWEEN :raceDateStart AND :raceDateEnd
                    AND ri.race_type_code != 'P'
                    AND ri.race_status_code != 'A'
                GROUP BY CONVERT(CHAR(10), ri.race_datetime, 104)
                ORDER BY CONVERT(CHAR(10), ri.race_datetime, 104)
        ");
        $builder->setParam('raceDateStart', $dateStart)
            ->setParam('raceDateEnd', $dateEnd);

        $rtn =  $this->queryBuilder($builder);
        return $rtn->toArrayWithRows('race_date');
    }
}
