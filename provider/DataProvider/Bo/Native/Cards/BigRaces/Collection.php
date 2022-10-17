<?php

declare(strict_types=1);

namespace Api\DataProvider\Bo\Native\Cards\BigRaces;

use Api\DataProvider\HorsesDataProvider;
use Api\Input\Request\Horses\Native\Cards\BigRaces as Request;
use Phalcon\Db\Sql\Builder;
use Phalcon\Mvc\Model\Row;

/**
 * @package Bo\Native\Cards
 */
class Collection extends HorsesDataProvider
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function getData(Request $request): array
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
                SELECT 
                    c.course_uid course_id,
                    c.style_name course_name,
                    c.country_code course_country,
                    
                    ri.race_instance_uid race_id,
                    ri.race_datetime race_date,
                    ri.race_instance_title race_title
                FROM
                    course c
                    INNER JOIN race_instance ri ON ri.course_uid = c.course_uid
                    INNER JOIN pre_race_instance pri ON 
                        pri.race_instance_uid = ri.race_instance_uid
                        AND ri.race_status_code = pri.race_status_code
                WHERE
                    ri.race_status_code NOT IN ('A','R')                    
                    AND pri.no_of_runners > 0
                    AND pri.early_closing_race_yn = 'Y'
                    AND ri.race_datetime > :raceDate
                ORDER BY
                    ri.race_datetime
        ");
        $builder->setParam('raceDate', $request->getRaceDate() . ' 00:00:00');

        $rtn =  $this->queryBuilder($builder);
        return $rtn->toArrayWithRows();
    }
}
