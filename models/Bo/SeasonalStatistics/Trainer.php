<?php

namespace Models\Bo\SeasonalStatistics;

use Api\Exception\InternalServerError;
use Api\Input\Request\Horses\SeasonalStatistics\Trainer as Request;
use Api\Row\SeasonalStatistics\Trainer as Row;
use Api\Constants\Horses as Constants;
use Exception;
use Phalcon\Db\Sql\Builder;
use Phalcon\DI;
use Phalcon\Mvc\Model\Resultset\ResultsetException;

/**
 * Class Trainer
 * @package Models\Bo\SeasonalStatistics
 */
class Trainer extends \Models\Bo\SeasonalStatistics
{
    protected $alias = [
        'going_type_code' => 'ss',
        'distance_yard' => 'ss',
        'horse_age' => 'ss',
    ];

    /**
     * @param Request $request
     * @return array
     * @throws InternalServerError
     * @throws ResultsetException
     * @throws Exception
     */
    public function getSeasonalStatistics(Request $request): array
    {
        $builder = new Builder($request);
        $this->setBuilder($builder);
        $this->setRequest($request);

        $this->setRestrictions($request);

        $sqlRate = $this->getSqlRate();
        $workHorseDb = $this->getSelectors()->getDb()->getWorkHorseDb();

        $builder->setSqlTemplate("
            SELECT
                trainer_style_name = t.style_name,
                t.surname,
                t.mirror_name,
                t.country_code,
                top_jockey = null,
                t2.*
            FROM (
                SELECT
                    trainer_uid,
                    jockeys = null,
                    wins = SUM(wins),
                    second_place = SUM(second_place),
                    third_place = SUM(third_place),
                    fourth_place = SUM(fourth_place),
                    placed = SUM(second_place) + SUM(third_place) + SUM(fourth_place),
                    runs = COUNT(runs),
                    winnings_pound = SUM(winnings_pound),
                    earnings_pound = SUM(earnings_pound),
                    winnings_euro = SUM(winnings_euro),
                    earnings_euro = SUM(earnings_euro),
                    stake = SUM(stake),
                    class1to3Wins = SUM(class1to3Wins),
                    class1to3Runs = SUM(class1to3Runs),
                    class4to6Wins = SUM(class4to6Wins),
                    class4to6Runs = SUM(class4to6Runs),
                    winners = COUNT(DISTINCT winner_uid),
                    runners = COUNT(DISTINCT runner_uid)
                FROM (
                    SELECT
                        ss.trainer_uid,
                        ss.country_code,
                        ss.wins,
                        ss.second_place,
                        ss.third_place,
                        fourth_place,
                        ss.runs,
                        winnings_pound = CASE WHEN ss.country_code='GB' THEN ss.winnings ELSE ss.winnings / {$sqlRate} END,
                        earnings_pound = CASE WHEN ss.country_code='GB' THEN ss.earnings ELSE ss.earnings / {$sqlRate} END,
                        winnings_euro = CASE WHEN ss.country_code='IRE' THEN ss.winnings ELSE ss.winnings * {$sqlRate} END,
                        earnings_euro = CASE WHEN ss.country_code='IRE' THEN ss.earnings ELSE ss.earnings * {$sqlRate} END,
                        ss.stake,
                        ss.class1to3Wins,
                        ss.class1to3Runs,
                        ss.class4to6Wins,
                        ss.class4to6Runs,
                        winner_uid = CASE WHEN ss.wins > 0 THEN ss.horse_uid END,
                        runner_uid = ss.horse_uid
                    FROM
                        {$workHorseDb}..sstats_horse_own_jock_train ss
                    WHERE
                        1 = 1
                        /*{WHERE}*/
                        AND ss.race_type_code IN (:raceTypeCodes)
                        AND NOT EXISTS (
                            SELECT 1 
                            FROM race_attrib_join 
                            WHERE race_instance_uid = ss.race_instance_uid 
                            AND race_attrib_uid = " . Constants::RACE_ATTRIB_RACING_LEAGUE . ")
                ) t
                GROUP BY
                    trainer_uid
            ) t2
            JOIN trainer t ON t.trainer_uid = t2.trainer_uid
            ORDER BY
                earnings_pound DESC,
                winnings_pound DESC,
                wins DESC
        ");

        $this->setBuilderData($builder, $request, null, $request->getCountryCodes());

        $builder->build();

        $result = $this->query($builder->getSql(), $builder->getParams(), new Row(), false);
        $result = $result->toArrayWithRows();

        $builder = new Builder($request);

        $builder->setSqlTemplate("
            SELECT
                ss.trainer_uid,
                j.jockey_uid,
                j.style_name,
                j.aka_style_name,
                wins = COUNT(CASE WHEN ss.wins > 0 then ss.horse_uid END),
                rides = COUNT(ss.horse_uid)
            FROM
                {$workHorseDb}..sstats_horse_own_jock_train ss
                JOIN jockey j ON j.jockey_uid = ss.jockey_uid
            WHERE
                ss.race_type_code IN (:raceTypeCodes)
                /*{WHERE}*/
            GROUP BY
                ss.trainer_uid,
                j.jockey_uid,
                j.style_name,
                j.aka_style_name
            ORDER BY
                5 DESC,
                6
        ");

        $this->setBuilderData($builder, $request, null, $request->getCountryCodes());

        $builder->build();

        $jockeysResult = $this->query($builder->getSql(), $builder->getParams(), new Row(), false);
        $jockeysResult = $jockeysResult->toArrayWithRows('trainer_uid', null, true);

        return $this->mergeJockeys(
            $result,
            $jockeysResult
        );
    }

    /**
     * @param array $trainers
     * @param array $jockeys
     *
     * @return array
     */
    private function mergeJockeys($trainers, $jockeys)
    {
        foreach ($trainers as $i => $trainer) {
            if (array_key_exists($trainer['trainer_uid'], $jockeys) &&
                !empty($jockeys[$trainer['trainer_uid']][0])) {
                $trainers[$i]->top_jockey = $jockeys[$trainer['trainer_uid']][0];
            } else {
                $trainers[$i]->top_jockey = null;
            }
        }
        return $trainers;
    }
}
