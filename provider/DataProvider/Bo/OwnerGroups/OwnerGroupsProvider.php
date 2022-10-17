<?php

namespace Api\DataProvider\Bo\OwnerGroups;

use Api\DataProvider\HorsesDataProvider;
use Api\Constants\Horses as Constants;
use Api\Mvc\DataProvider\BuilderBasedTemporaryTable as TmpBuilder;
use Phalcon\Db\Sql\Builder;

/**
 * Class OwnerGroupsProvider
 * @package Api\DataProvider\Bo\OwnerGroups
 */
class OwnerGroupsProvider extends HorsesDataProvider
{

    const TEMP_TABLE_UNIQUE_RUNNERS = "UniqueRunners";

    /**
     * Temporary table object for today races
     *
     * @var TmpBuilder|null
     */
    private $tmpTableUniqueRunners = null;

    /**
     * @return TmpBuilder|null
     * @throws \Exception
     */
    public function getTmpTableUniqueRunners(array $runnersIds): TmpBuilder
    {
        if (!isset($this->tmpTableUniqueRunners)) {
            $this->tmpTableUniqueRunners = $this->createUniqueRunnersTemporaryTable($runnersIds);
        }

        return $this->tmpTableUniqueRunners;
    }

    /**
     * @param array $runnersIds
     * @return array|null
     * @throws \Exception
     */
    public function getBlackTypeRunners(array $runnersIds): ?array
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
            SELECT
                t.horse_uid
                , position = (
                    SELECT ro2.race_outcome_position 
                    FROM race_outcome ro2, horse_race hr2 
                    WHERE hr2.race_instance_uid = t.race_instance_uid
                        AND t.horse_uid = hr2.horse_uid
                        AND hr2.final_race_outcome_uid = ro2.race_outcome_uid
                )
                , race_group_uid = (
                    SELECT race_group_uid FROM race_instance ri2
                    WHERE ri2.race_instance_uid = t.race_instance_uid
                )
                , no_of_runners = (
                    SELECT COUNT(1)
                    FROM horse_race hr2
                    WHERE hr2.race_instance_uid = t.race_instance_uid
                )
            FROM 
                (
                    SELECT
                        hr.horse_uid
                        , race_instance_uid = MAX(ri.race_instance_uid)
                    FROM 
                        horse_race hr
                        JOIN race_instance ri ON ri.race_instance_uid = hr.race_instance_uid
                        JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
                    WHERE
                        ri.race_group_uid IN (:raceGroups)
                        AND ro.race_outcome_position BETWEEN 1 AND 4
                        AND hr.final_race_outcome_uid NOT IN (:nonRunners)
                        AND hr.horse_uid IN (:runnersId)
                    GROUP BY hr.horse_uid
                ) t 
            ");

        $builder
            ->setParam("raceGroups", Constants::$groupClassRaces)
            ->setParam("nonRunners", Constants::$nonRunnersIds)
            ->setParam("runnersId", $runnersIds);

        $result = $this->queryBuilder($builder);

        return $result->toArrayWithRows('horse_uid');
    }

    /**
     * @param array $runnersIds
     * @return TmpBuilder
     */
    public function createUniqueRunnersTemporaryTable(array $runnersIds): TmpBuilder
    {
        $builder = new Builder();

        $sql = null;
        foreach ($runnersIds as $runnersId) {
            $sql = $sql . sprintf(
                "SELECT horse_uid = %d\n" . (isset($sql) ? "UNION\n" : "INTO " . TmpBuilder::TEMPLATE_FOR_TABLE_NAME . "\nUNION\n"),
                $runnersId
            );
        }

        $builder->setSqlTemplate(substr($sql, 0, strrpos($sql, "UNION") - 1));

        return new TmpBuilder($builder, self::TEMP_TABLE_UNIQUE_RUNNERS);
    }
}
