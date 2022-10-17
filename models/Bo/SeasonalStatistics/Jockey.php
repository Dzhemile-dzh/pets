<?php

namespace Models\Bo\SeasonalStatistics;

use Phalcon\Db\Sql\Builder;
use Api\Row\SeasonalStatistics\Jockey as Row;
use Api\Input\Request\Horses\SeasonalStatistics\Jockey as Request;

/**
 * @package Models\Bo\SeasonalStatistics
 */
class Jockey extends \Models\Bo\SeasonalStatistics
{
    protected $alias = [
        'going_type_code' => 'ss',
        'distance_yard' => 'ss',
        'horse_age' => 'ss',
    ];

    /**
     * @param Request $request
     *
     * @return array
     * @throws \Api\Exception\InternalServerError
     * @throws \Api\Exception\ValidationError
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     * @throws \Exception
     */
    public function getSeasonalStatistics(Request $request)
    {
        $builder = new Builder($request);
        $this->setBuilder($builder);
        $this->setRequest($request);

        $this->setRestrictions($request);

        $sqlRate = $this->getSqlRate();
        $workHorseDb = $this->getSelectors()->getDb()->getWorkHorseDb();

        $builder->setSqlTemplate("
            SELECT
                jockey_style_name = j.style_name,
                j.surname,
                j.aka_style_name,
                apprenctice_status = CASE WHEN j.flat_jockey_type_code = 'A' THEN 'Y' ELSE 'N' END,
                conditional_status = CASE WHEN j.jump_jockey_type_code = 'C' THEN 'Y' ELSE 'N' END,
                a.country_code,
                t2.*
            FROM (
                SELECT
                    jockey_uid,
                    wins = SUM(wins),
                    second_place = SUM(second_place),
                    third_place = SUM(third_place),
                    fourth_place = SUM(fourth_place),
                    runs = COUNT(runs),
                    winnings_pound = SUM(winnings_pound),
                    earnings_pound = SUM(earnings_pound),
                    winnings_euro = SUM(winnings_euro),
                    earnings_euro = SUM(earnings_euro),
                    stake = SUM(stake),
                    favourite_runs = SUM(favourite_runs),
                    favourite_wins = SUM(favourite_wins)
                FROM (
                    SELECT
                        ss.jockey_uid,
                        ss.wins,
                        ss.second_place,
                        ss.third_place,
                        ss.fourth_place,
                        ss.runs,
                        winnings_pound = CASE WHEN ss.country_code='GB' THEN ss.winnings ELSE ss.winnings / {$sqlRate} END,
                        earnings_pound = CASE WHEN ss.country_code='GB' THEN ss.earnings ELSE ss.earnings / {$sqlRate} END,
                        winnings_euro = CASE WHEN ss.country_code='IRE' THEN ss.winnings ELSE ss.winnings * {$sqlRate} END,
                        earnings_euro = CASE WHEN ss.country_code='IRE' THEN ss.earnings ELSE ss.earnings * {$sqlRate} END,
                        ss.stake,
                        ss.favourite_runs,
                        ss.favourite_wins
                    FROM
                        {$workHorseDb}..sstats_horse_own_jock_train ss
                    WHERE
                        1 = 1
                        /*{WHERE}*/
                        AND ss.race_type_code IN (:raceTypeCodes)
                ) t
                GROUP BY
                    jockey_uid
            ) t2
            INNER JOIN jockey j ON j.jockey_uid = t2.jockey_uid
            LEFT JOIN address a ON j.address_uid = a.address_uid
            ORDER BY
                earnings_pound DESC,
                winnings_pound DESC,
                wins DESC
        ");

        $this->setBuilderData($builder, $request, null, $request->getCountryCodes());

        $builder->build();

        $result = $this->query($builder->getSql(), $builder->getParams(), new Row(), false);

        return $result->toArrayWithRows();
    }
}
