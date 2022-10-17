<?php

namespace Models\Bo\SeasonalStatistics;

use Api\Input\Request\Horses\SeasonalStatistics\Horse as Request;
use DeepCopy\f006\B;
use Phalcon\Mvc\Model\Resultset\General as ResultSet;
use Api\Row\SeasonalStatistics\Horse as Row;
use Phalcon\Db\Sql\Builder;
use Phalcon\DI;
use \Api\Constants\Horses as Constants;

/**
 * Class Horse
 *
 * @package Models\Bo\SeasonalStatistics
 */
class Horse extends \Models\Bo\SeasonalStatistics
{
    protected $alias = [
        'going_type_code' => 'ss',
        'distance_yard' => 'ss',
        'horse_age' => 'ss',
        'race_group_uid' => 'ss',
    ];

    /**
     * @param Request $request
     *
     * @throws \Exception
     * @return array
     */
    public function getSeasonalStatistics(Request $request)
    {
        $builder = new Builder($request);
        $this->setBuilder($builder);
        $this->setRequest($request);

        $countryCodes = $request->getCountryCodes();

        $statsSql = $this->getStatsQuery($this->getSelectors()->getDb()->getWorkHorseDb(), $this->getSqlRate());

        $sql = "
            SELECT
                horse_style_name = h.style_name,
                h.horse_sex_code,
                country_code = h.country_origin_code,
                h.sire_uid,
                sire_style_name = s.style_name,
                sire_country_origin_code = s.country_origin_code,
                ht.trainer_uid,
                trainer_style_name = tr.style_name,
                t2.*
            FROM (
                    SELECT
                        horse_uid,
                        last_race_datetime = max(race_datetime),
                        horse_age = MAX(horse_age),
                        rpr = MAX(rpr),
                        wins = SUM(wins),
                        second_place = SUM(second_place),
                        third_place = SUM(third_place),
                        fourth_place = SUM(fourth_place),
                        runs = COUNT(runs),
                        winnings_pound = SUM(winnings_pound),
                        earnings_pound = SUM(earnings_pound),
                        net_win_prize = SUM(t.winnings_sterling),
                        net_total_prize = SUM(t.earnings_sterling),
                        winnings_euro = SUM(winnings_euro),
                        earnings_euro = SUM(earnings_euro),
                        stake = SUM(stake)
                    FROM (
                        /*{EXPRESSION(stats)}*/
                    ) t
                GROUP BY
                    horse_uid
                ) t2
                JOIN horse h ON h.horse_uid = t2.horse_uid
                JOIN horse s ON s.horse_uid = h.sire_uid
                LEFT JOIN horse_trainer ht ON ht.horse_uid = t2.horse_uid
                    AND ht.trainer_change_date = isnull(
                        (SELECT MIN(ht2.trainer_change_date)
                        FROM horse_trainer ht2
                        WHERE ht2.horse_uid = t2.horse_uid
                            AND (ht2.trainer_change_date > t2.last_race_datetime)), '1 jan 1900')
                LEFT JOIN trainer tr ON tr.trainer_uid = ht.trainer_uid
                WHERE 1 = 1
                    /*{EXPRESSION(winnersOnly)}*/
            ORDER BY
                earnings_pound DESC,
                winnings_pound DESC,
                wins DESC
        ";

        if ($request->isParameterProvided('raceGroupId')) {
            $builder->expression('winnersOnly', 'AND t2.wins > 0');
        }

        $builder->setSqlTemplate($sql);

        if ($request->getRaceType() == Constants::RACE_TYPE_JUMPS_ALIAS
            && count($countryCodes) == 2
            && in_array('GB', $countryCodes)
            && in_array('IRE', $countryCodes)
        ) {
            // For both country codes (GB and IRE) calculate the stats separately
            $seasons = $request->getSeasonData();

            $builderStats = new Builder($request);

            $builder1 = clone $builderStats;
            $builder2 = clone $builderStats;

            $this->setBuilderData($builder1, $request, $seasons, ['GB']);
            $this->setBuilderData($builder2, $request, $seasons, ['IRE']);

            $this->setRestrictions($request, $builder1);
            $this->setRestrictions($request, $builder2);

            $builder1->setSqlTemplate($statsSql);
            $builder2->setSqlTemplate($statsSql);

            $builderStats->unionAll([$builder1, $builder2]);

            $builder->expression('stats', $builderStats);
        } else {
            $this->setRestrictions($request);
            $this->setBuilderData($builder, $request, null, $countryCodes);
            $builder->expression('stats', $statsSql);
        }

        $builder->build();

        $result = $this->query($builder->getSql(), $builder->getParams(), new Row(), false);

        return $result->toArrayWithRows();
    }

    /**
     * @param string $workHorseDb
     * @param string $sqlRate
     *
     * @return string
     */
    private function getStatsQuery($workHorseDb, $sqlRate): string
    {
        return "
            SELECT
                ss.horse_uid,
                ss.race_datetime,
                ss.horse_age,
                ss.rpr,
                ss.wins,
                ss.second_place,
                ss.third_place,
                ss.fourth_place,
                ss.runs,
                winnings_pound = CASE WHEN ss.country_code='GB' THEN ss.winnings ELSE ss.winnings / {$sqlRate} END,
                earnings_pound = CASE WHEN ss.country_code='GB' THEN ss.earnings ELSE ss.earnings / {$sqlRate} END,
                winnings_euro = CASE WHEN ss.country_code='IRE' THEN ss.winnings ELSE ss.winnings * {$sqlRate} END,
                earnings_euro = CASE WHEN ss.country_code='IRE' THEN ss.earnings ELSE ss.earnings * {$sqlRate} END,
                ss.earnings,
                ss.winnings,
                ss.stake,
                ss.earnings_sterling,
                ss.winnings_sterling,
                ri.race_group_uid
            FROM
                {$workHorseDb}..sstats_horse_own_jock_train ss
                , race_instance ri
            WHERE
                /*{WHERE}*/
                AND ss.race_type_code IN (:raceTypeCodes)
                AND ri.race_instance_uid = ss.race_instance_uid
                AND ri.race_datetime = ss.race_datetime
                AND ri.race_type_code = ss.race_type_code
        ";
    }
}
