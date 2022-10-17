<?php

namespace Api\DataProvider\Bo;

use Api\DataProvider\HorsesDataProvider;
use Api\Exception\ValidationError;

/**
 * Class LastYearRaces
 *
 * @package Api\DataProvider\Bo
 */
class LastYearRaces extends HorsesDataProvider
{
    /**
     * The max limit for past races
     */
    const PAST_RACES_TOP_LIMIT = 15;

    /**
     * @param int $racesLimit
     *
     * @return string
     * @throws ValidationError
     */
    public function getSQL($racesLimit)
    {
        if ($racesLimit < 1 || $racesLimit > self::PAST_RACES_TOP_LIMIT) {
            throw new ValidationError(1016);
        }

        $baseSql = "
            SELECT
                root_uid = rir.race_instance_uid,
                ri1.race_instance_uid,
                ri1.race_datetime
            FROM race_instance ri1
                LEFT JOIN race_instance rir ON 1=1
            WHERE 
                1=1
                ";
        $itemSql = "
            AND race_instance_uid IN (:raceIDs)
            AND rir.race_instance_uid = ri{$racesLimit}.race_instance_uid";

        for ($i = $racesLimit - 1; $i > 0; $i--) {
            $next = $i + 1;
            $itemSql =
                "AND EXISTS (
                    SELECT 1
                    FROM race_instance ri{$next}
                    WHERE (ri{$i}.race_instance_uid = ri{$next}.lst_yr_race_instance_uid 
                        OR ri{$i}.race_instance_uid = ri{$next}.race_instance_uid)
                        {$itemSql}
                    ) ";
        }
        $planSql = "
            PLAN '(use optgoal allrows_dss)(also_enforce(i_scan ri{$racesLimit}))'";

        return $baseSql . $itemSql . $planSql;
    }

    /**
     * @param int[] $raceIDs
     * @param int   $racesLimit
     *
     * @return array
     * @throws ValidationError
     */
    public function getPastRacesGrouped($raceIDs, $racesLimit)
    {
        if (empty($raceIDs)) {
            return [];
        }

        $rows = $this->query(
            $this->getSQL($racesLimit),
            [
                'raceIDs' => $raceIDs
            ]
        );

        $structure = [
            'root_uid',
            'races' => [
                'race_instance_uid',
                'race_datetime'
            ]
        ];
        $keys = [
            'root_uid',
            'race_instance_uid'
        ];

        return $rows->getGroupedResult($structure, $keys);
    }

    /**
     * @param int[] $raceIDs
     * @param int   $racesLimit
     *
     * @return array
     * @throws ValidationError
     */
    public function getPastRacesIDs($raceIDs, $racesLimit)
    {
        if (empty($raceIDs)) {
            return [];
        }

        $rows = $this->query(
            $this->getSQL($racesLimit),
            [
                'raceIDs' => $raceIDs
            ]
        );

        return $rows->toArrayWithRows('race_instance_uid');
    }
}
