<?php

namespace Models\Bo\SeasonalStatistics;

use Api\Input\Request\HorsesRequest as Request;
use Phalcon\Mvc\Model\Row\General as Row;
use Phalcon\DI;
use Phalcon\Db\Sql\Builder;
use Api\Mvc\DataProvider\BuilderBasedTemporaryTable as TmpBuilder;

/**
 * Class Sire
 * @package Models\Bo\SeasonalStatistics
 */
class Sire extends \Models\Bo\SeasonalStatistics
{
    /**
     * A structure of this array has to be defined in the children classes.
     * Due this array we spot table aliases in the queries.
     *
     * @var array
     */
    protected $alias = [
        'going_type_code' => 'ss',
        'distance_yard' => 'ss',
        'race_group_uid' => 'ss',
        'horse_age' => 'ss',
    ];

    /**
     * A list of static fields used in pre-aggregated tmp table
     *
     * @var string
     */
    protected $staticFields = "
          ss.sire_uid
        , ss.horse_uid
        , ss.horse_style_name
        , ss.country_origin_code
        , ss.dam_uid";

    /*
     * @var TmpBuilder
     */
    private $tmpTableSeasonalStats;

    /**
     * @return TmpBuilder|null
     * @throws \Api\Exception\InternalServerError
     */
    public function getTmpTableSeasonalStats(): ?TmpBuilder
    {
        if (!isset($this->tmpTableSeasonalStats)) {
            $this->tmpTableSeasonalStats = $this->createStatsTmpTable();
            $this->createStatsTmpIndex($this->tmpTableSeasonalStats->getTemporaryTable());
        }
        return $this->tmpTableSeasonalStats;
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Api\Exception\InternalServerError
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     * @throws \Exception
     */
    public function getSeasonalStatistics(Request $request)
    {
        $this->setRequest($request);

        $builder = new Builder($request);
        $builder->expression("tmpTableSeasonalStats", $this->getTmpTableSeasonalStats()->getTemporaryTable());

        $euroExchange = $this->getSelectors()->getDb()->getEuroRateByYear(
            static::dateToYear($request->getSeasonDateBegin())
        );

        $this->setRestrictions($request);

        $this->addRaceGroupParams($builder);

        $builder->setSqlTemplate("
            SELECT
                sire_uid = s.horse_uid,
                sire = s.style_name,
                sire_country_origin_code = s.country_origin_code,
                weatherbys_uid = MAX(ws.weatherbys_uid),
                weatherbys_api_uid = MAX(CONVERT(INT, ws.weatherbys_uid)),   
                rate_euro = {$euroExchange},
                wins = SUM(t.no_of_wins),
                seconds = SUM(t.no_of_2nds),
                thirds = SUM(t.no_of_3rds),
                fourths = SUM(t.no_of_4ths),
                runs = SUM(t.no_of_runs),
                win_prize_money_euro = ISNULL(SUM(t.win_prize_money_euro),0),
                win_prize_money_pound = ISNULL(SUM(t.win_prize_money_pound),0),
                total_prize_money_euro = ISNULL(SUM(t.total_prize_money_euro),0),
                total_prize_money_pound = ISNULL(SUM(t.total_prize_money_pound),0),
                net_win_prize_money = ISNULL(SUM(t.net_win_prize_money), 0),
                net_total_prize_money = ISNULL(SUM(t.net_total_prize_money), 0),
                runners = COUNT(*),
                winners = SUM(CASE WHEN t.no_of_wins > 0 THEN 1 ELSE 0 END),
                stakes_wins = SUM(t.no_of_st_wins),
                stakes_winner = SUM(CASE WHEN t.no_of_st_wins > 0 THEN 1 ELSE 0 END),
                stakes_runner = SUM(CASE WHEN t.no_of_st_runs > 0 THEN 1 ELSE 0 END)
            FROM
                /*{EXPRESSION(tmpTableSeasonalStats)}*/ t
                JOIN horse s ON s.horse_uid = t.sire_uid
                LEFT JOIN weatherbys_stallions ws ON ws.year = year(getdate()) AND ws.sire_uid = s.horse_uid
            WHERE
                1 = 1
                /*{WHERE}*/
            GROUP BY
                s.horse_uid,
                s.style_name,
                s.country_origin_code 
            ORDER BY 
                t.total_prize_money_pound DESC,
                t.total_prize_money_euro DESC,
                s.style_name
        ");

        $builder->build();

        $result = $this->query($builder->getSql(), $builder->getParams(), new Row(), false);

        return $result->toArrayWithRows();
    }

    /**
     * @param int $progenyPerformersLimit
     * @return array
     * @throws \Api\Exception\InternalServerError
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     * @throws \Exception
     */
    public function getProgenyPerformers(int $progenyPerformersLimit)
    {
        $tableName = $this->getTmpTableSeasonalStats()->getTemporaryTable();
        $builder = new Builder();

        //  Multiply by 2 to avoid cutting the same rpr values per sire
        $progenyPerformersLimit = intval($progenyPerformersLimit) * 2;

        $this->addRaceGroupParams($builder);
        $builder->setParam('progenyPerformersLimit', $progenyPerformersLimit);

        $builder->setSqlTemplate("
            SELECT
                t.sire_uid
                , t.horse_uid
                , horse_style_name = t.horse_style_name
                , horse_country_origin_code = t.country_origin_code
                , dam_sire_uid = ds.horse_uid
                , dam_sire_style_name = ds.style_name
                , dam_sire_country_origin_code = ds.country_origin_code
                , rp_postmark = max(t.rpr)
            FROM
                {$tableName} t
                LEFT JOIN horse d ON d.horse_uid = t.dam_uid
                LEFT JOIN horse ds ON ds.horse_uid = d.sire_uid
            WHERE 
                EXISTS (
                    SELECT 1 
                    FROM {$tableName} t2
                    WHERE 
                        t2.sire_uid = t.sire_uid
                        AND t2.rpr >= t.rpr
                    GROUP BY t2.sire_uid 
                    HAVING COUNT(*) <= :progenyPerformersLimit
                )
                /*{WHERE}*/
            GROUP BY
                t.sire_uid
                , t.horse_uid
                , t.horse_style_name
                , t.country_origin_code
                , ds.horse_uid
                , ds.style_name
                , ds.country_origin_code
            ORDER BY
                t.sire_uid
                , 8 DESC
                , t.horse_style_name ASC
        ");

        $builder->build();

        $result = $this->query($builder->getSql(), $builder->getParams(), new Row(), false);

        return $result->toArrayWithRows('sire_uid', null, true);
    }
    /**
     * @throws \Exception
     */
    private function addRaceGroupParams(Builder $builder)
    {
        if ($this->getRequest()->isParameterProvided('raceGroupId')) {
            $builder->setParam('raceGroupId', $this->getRequest()->getRaceGroupId());
            $builder->setParam('seasonStartDate', $this->getRequest()->getSeasonDateBegin());
            $builder->where("
                EXISTS (
                    SELECT 1
                    FROM
                        horse_race hr
                        , race_instance ri
                        , horse h
                    WHERE
                        hr.race_instance_uid = ri.race_instance_uid
                        AND h.horse_uid = hr.horse_uid
                        AND hr.final_race_outcome_uid IN (1, 71)
                        AND ri.race_group_uid IN (:raceGroupId)
                        AND h.sire_uid = t.sire_uid
                        AND hr.horse_uid = t.horse_uid
                        AND ri.race_datetime > :seasonStartDate
                )");
        }
    }
}
