<?php

namespace Api\DataProvider\Bo;

use Api\Constants\Horses as Constants;
use Phalcon\Mvc\DataProvider;
use Phalcon\DI;
use Phalcon\Mvc\Model\Row;
use Models\Selectors;

abstract class StakesData extends DataProvider
{
    /**
     * @var array
     */
    protected $mapIntervals = [
        'last_7_days' => 'P7D',
        'last_14_days' => 'P14D',
        'last_month' => 'P1M',
        'last_3_months' => 'P3M',
        'last_6_months' => 'P6M'
    ];

    /**
     * @return string
     */
    abstract protected function getEntityName();

    /**
     * @return string
     */
    protected function getSqlForRaceType()
    {
        return "
            CASE
                WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                    THEN '" . Constants::RACE_TYPE_FLAT_ALIAS . "'
                WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_JUMPS . ")
                    THEN '" . Constants::RACE_TYPE_JUMPS_ALIAS . "'
            END";
    }

    /**
     * @param string $section
     *
     * @return string
     */
    protected function getSql($section)
    {
        return "
            SELECT
                section = '{$section}'
                , wins = SUM(CASE WHEN hr.final_race_outcome_uid IN(1, 71) THEN 1 ELSE 0 END)
                , runs = COUNT(*)
                , stake = " . DI::getDefault()->getShared('selectors')->getSqlForStake() . "
            FROM
                race_instance ri
            JOIN
                horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
            LEFT JOIN
                odds ON odds.odds_uid = hr.starting_price_odds_uid
            WHERE
                --horse>>hr.horse_uid = :horseUid:
                --jockey>>hr.jockey_uid = :jockeyUid:
                --trainer>>hr.trainer_uid = :trainerUid:
                AND ri.race_type_code <> " . Constants::RACE_TYPE_P2P . "
                AND ri.race_datetime BETWEEN :dateStart{$section}: AND :dateEnd:
                AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                %s
            GROUP BY
                --horse>>hr.horse_uid
                --jockey>>hr.jockey_uid
                --trainer>>hr.trainer_uid
        ";
    }

    /**
     * @param array    $params
     * @param array    $where
     * @param Row|null $rowObject
     *
     * @return array
     */
    protected function getData(array $params, array $where, Row $rowObject = null)
    {
        $sql = [];

        foreach ($this->mapIntervals as $key => $interval) {
            $subSql = $this->getSql($key);

            $sql[] = sprintf($subSql, count($where) ? (' AND ' . implode(' AND ', $where)) : '');

            $params['dateStart' . $key] = (new \DateTime())->sub(new \DateInterval($interval))->format("Y-m-d h:i:s");
        }
        $params['dateEnd'] = (new \DateTime())->format("Y-m-d h:i:s");

        $sql = implode(' UNION ', $sql);

        $result = $this->query(
            Selectors::purgeQuery($sql, $this->getEntityName()),
            $params,
            $rowObject
        );

        return $result->toArrayWithRows('section') + [
                'last_7_days' => null,
                'last_14_days' => null,
                'last_month' => null,
                'last_3_months' => null,
                'last_6_months' => null
            ];
    }

    /**
     * @param array    $params
     * @param array    $where
     * @param Row|null $rowObject
     *
     * @return array
     */
    protected function getCurrentSeasonData(array $params, array $where, Row $rowObject = null)
    {
        $sql = "
            SELECT
                race_type = {$this->getSqlForRaceType()}
                , wins = SUM(CASE WHEN hr.final_race_outcome_uid IN(1, 71) THEN 1 ELSE 0 END)
                , runs = COUNT(*)
                , stake = " . DI::getDefault()->getShared('selectors')->getSqlForStake() . "
            FROM
                race_instance ri
            JOIN
                horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
            JOIN
                course c ON c.course_uid = ri.course_uid
            LEFT JOIN
                odds ON odds.odds_uid = hr.starting_price_odds_uid
            JOIN
                season s ON s.current_season_yn = 'Y' AND s.season_type_code = (
                    CASE WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                        THEN '" . Constants::SEASON_TYPE_CODE_FLAT . "'
                        ELSE
                            CASE c.country_code WHEN 'GB'
                                THEN '" . Constants::SEASON_TYPE_CODE_JUMPS . "'
                                ELSE '" . Constants::SEASON_TYPE_CODE_JUMPS_IRE . "'
                            END
                    END
                )
            WHERE
                --horse>>hr.horse_uid = :horseUid:
                --jockey>>hr.jockey_uid = :jockeyUid:
                --trainer>>hr.trainer_uid = :trainerUid:
                AND ri.race_datetime BETWEEN s.season_start_date AND s.season_end_date
                AND ri.race_type_code <> " . Constants::RACE_TYPE_P2P . "
                AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                %s
            GROUP BY
                {$this->getSqlForRaceType()}
            ";

        $sql = sprintf($sql, count($where) ? (' AND ' . implode(' AND ', $where)) : '');

        $result = $this->query(
            Selectors::purgeQuery($sql, $this->getEntityName()),
            $params,
            $rowObject
        );

        return $result->toArrayWithRows('race_type') +
            [
                Constants::RACE_TYPE_FLAT_ALIAS => null,
                Constants::RACE_TYPE_JUMPS_ALIAS => null
            ];
    }
}
