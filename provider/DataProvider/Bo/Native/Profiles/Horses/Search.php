<?php

declare(strict_types=1);

namespace Api\DataProvider\Bo\Native\Profiles\Horses;

use Phalcon\Db\Sql\Builder;
use Api\Constants\Horses as Constants;
use Api\DataProvider\HorsesDataProvider;

/**
 * @package Api\DataProvider\Bo\Native\Results
 */
class Search extends HorsesDataProvider
{
    /**
     * @param string $name
     * @param int $maxRows
     *
     * @return array|null
     */
    public function getData(string $name, int $maxRows): ?array
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
                SELECT
                  TOP :maxRows
                  country_origin_code as detail,
                  YEAR (horse_date_of_birth) as start_date,
                  horse_uid as id,
                  misc = null,
                  style_name as name
                FROM horse
                WHERE
                    horse_name like :horseName
        ");

        $builder->setParam('horseName', $name . '%');
        $builder->setParam('maxRows', $maxRows);

        $builder->build();

        $data = $this->query(
            $builder->getSql(),
            $builder->getParams()
        );

        return $data->toArrayWithRows();
    }

    /**
     * @param string $name
     *
     * @return int
     */
    public function getDataCount(string $name): int
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
                SELECT
                  count(*) as c
                FROM horse
                WHERE
                    horse_name like :horseName
        ");

        $builder->setParam('horseName', $name . '%');

        $builder->build();

        $data = $this->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $result = $data->toArrayWithRows();
        return $result[0]->c;
    }
}
