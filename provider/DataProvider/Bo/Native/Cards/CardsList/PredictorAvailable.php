<?php

declare(strict_types=1);

namespace Api\DataProvider\Bo\Native\Cards\CardsList;

use Api\DataProvider\HorsesDataProvider;
use Api\Input\Request\Horses\Native\Cards\CardsList as Request;
use Phalcon\Db\Sql\Builder;

/**
 * @package Api\DataProvider\Bo\Native\Cards
 */
class PredictorAvailable extends HorsesDataProvider
{
    /**
     * @param int $raceId
     *
     * @return bool
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function isAvailableByRace(int $raceId): bool
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
            SELECT COUNT(*)
            FROM
                postdata_results_new pd
            WHERE pd.race_instance_uid = :raceId        
        ");

        $builder
            ->setParam('raceId', $raceId);

        $data = $this->queryBuilder($builder);

        return $data->getFirst()->computed > 0;
    }
}
