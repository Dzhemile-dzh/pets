<?php

declare(strict_types=1);

namespace Api\DataProvider\Bo\Native\Results;

use Phalcon\Db\Sql\Builder;
use Api\DataProvider\HorsesDataProvider;
use Api\Constants\Horses as Constants;
use Phalcon\Mvc\Model\Row;

/**
 * @package Api\DataProvider\Bo\Native\Results
 */
class DateMenu extends HorsesDataProvider
{
    /**
     * @return Row
     */
    public function getData()
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            select getdate() as date
        ");


        $builder->build();

        $data = $this->query(
            $builder->getSql()
        );

        $result = $data->toArrayWithRows();

        return !empty($result) ? current($result) : null;
    }

    public function getAvailable() : array
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT count(1) race_count, convert(CHAR(10), race_date, 23) unique_race_date FROM (
                SELECT
                convert(DATE, race_datetime, 365) race_date FROM race_instance ri
                LEFT JOIN course c ON c.course_uid = ri.course_uid
                WHERE race_status_code = 'R'
                AND race_datetime BETWEEN dateadd(DAY, -5, convert(CHAR(10), getdate(), 23)) AND getdate()
                AND (
                    NOT EXISTS (Select 1 from race_attrib_join where race_instance_uid=ri.race_instance_uid 
                                AND race_attrib_uid IN (".Constants::INCOMPLETE_CARD_ATTRIBUTE_ID.", ".Constants::INCOMPLETE_RACE_ATTRIBUTE_ID.")) OR c.course_uid IN (". Constants::FRENCH_COURSES .")
                )
              ) tmp
              GROUP BY race_date 
              ORDER BY race_date DESC
        ");

        $builder->build();

        $data = $this->query(
            $builder->getSql()
        );

        $result = $data->toArrayWithRows();

        return $result;
    }
}
