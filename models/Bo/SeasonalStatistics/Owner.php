<?php

namespace Models\Bo\SeasonalStatistics;

use Api\Input\Request\Horses\SeasonalStatistics\Owner as Request;
use Api\Row\SeasonalStatistics\Owner as Row;
use Api\Row\SeasonalStatistics\Trainer as RowTrainer;
use Phalcon\Db\Sql\Builder;
use Phalcon\DI;

/**
 * Class Owner
 * @package Models\Bo\SeasonalStatistics
 */
class Owner extends \Models\Bo\SeasonalStatistics
{
    protected $alias = [
        'going_type_code' => 'ss',
        'distance_yard' => 'ss',
        'horse_age' => 'ss',
    ];

    /**
     * @param Request $request
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
                owner_style_name,
                owner_uid,
                top_trainer = null,
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
                winners = COUNT(DISTINCT winners_uid),
                runners = COUNT(DISTINCT runners_uid),
                placed = SUM(second_place) + SUM(third_place) + SUM(fourth_place)
            FROM (
                SELECT
                    ss.owner_style_name,
                    ss.owner_uid,
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
                    winners_uid = CASE WHEN ss.wins > 0 THEN ss.horse_uid END,
                    runners_uid = ss.horse_uid
                FROM
                    {$workHorseDb}..sstats_horse_own_jock_train ss
                WHERE
                    1 = 1
                    /*{WHERE}*/
                    AND ss.race_datetime BETWEEN :seasonStartDate AND :seasonEndDate
                    AND ss.race_type_code IN (:raceTypeCodes)
                    AND ss.country_code IN (:seasonCountries)
            ) t
            GROUP BY
                owner_style_name,
                owner_uid
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
                ss.owner_uid,
                ss.trainer_uid,
                ss.trainer_style_name,
                t.mirror_name,
                wins = SUM(ss.wins),
                runs = COUNT(ss.runs)
            FROM
                {$workHorseDb}..sstats_horse_own_jock_train ss
                JOIN trainer t ON t.trainer_uid = ss.trainer_uid
            WHERE
                ss.race_type_code IN (:raceTypeCodes)
                /*{WHERE}*/
            GROUP BY
                ss.owner_uid,
                ss.trainer_uid,
                ss.trainer_style_name,
                t.mirror_name
            ORDER BY
                5 DESC,
                6
            ");

        $this->setBuilderData($builder, $request, null, $request->getCountryCodes());

        $builder->build();

        $trainerResult = $this->query($builder->getSql(), $builder->getParams(), new RowTrainer(), false);
        $trainerResult = $trainerResult->toArrayWithRows('owner_uid', null, true);

        return $this->mergeTopTrainers(
            $result,
            $trainerResult
        );
    }

    /**
     * @param array $owners
     * @param array $trainers
     *
     * @return array
     */
    private function mergeTopTrainers($owners, $trainers)
    {
        foreach ($owners as $i => $owner) {
            if (array_key_exists($owner['owner_uid'], $trainers)) {
                $owners[$i]->top_trainer = !empty($trainers[$owner['owner_uid']][0])
                    ? $trainers[$owner['owner_uid']][0] : null;
            }
        }
        return $owners;
    }
}
