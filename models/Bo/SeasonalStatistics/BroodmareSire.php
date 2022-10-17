<?php

namespace Models\Bo\SeasonalStatistics;

use Api\Input\Request\HorsesRequest as Request;
use Phalcon\Mvc\Model\Row\General as Row;
use Phalcon\Db\Sql\Builder;
use Api\Mvc\DataProvider\BuilderBasedTemporaryTable as TmpBuilder;
use Phalcon\DI;

/**
 * Class BroodmareSire
 * @package Models\Bo\SeasonalStatistics
 */
class BroodmareSire extends \Models\Bo\SeasonalStatistics\Sire
{
    /**
     * @inheritDoc
     */
    protected $staticFields = "
          ss.dam_uid
        , ss.horse_uid
        , ss.horse_style_name
        , ss.country_origin_code
        , ss.sire_uid";

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

        $builder->setSqlTemplate("
            SELECT
                dam_sire_uid = ds.horse_uid,
                dam_sire = ds.style_name,
                dam_sire_country_origin_code = ds.country_origin_code,
                weatherbys_uid = MAX(ws.weatherbys_uid),
                weatherbys_api_uid = MAX(CONVERT(INT, ws.weatherbys_uid)),   
                wins = SUM(t.no_of_wins),
                seconds = SUM(t.no_of_2nds),
                thirds = SUM(t.no_of_3rds),
                fourths = SUM(t.no_of_4ths),
                runs = SUM(t.no_of_runs),
                rate_euro = {$euroExchange},
                win_prize_money_euro = ISNULL(SUM(t.win_prize_money_euro),0),
                win_prize_money_pound = ISNULL(SUM(t.win_prize_money_pound),0),
                total_prize_money_euro = ISNULL(SUM(t.total_prize_money_euro),0),
                total_prize_money_pound = ISNULL(SUM(t.total_prize_money_pound),0),
                runners = COUNT(*),
                winners = SUM(CASE WHEN t.no_of_wins > 0 THEN 1 ELSE 0 END),
                stakes_wins = SUM(t.no_of_st_wins),
                stakes_winner = SUM(CASE WHEN t.no_of_st_wins > 0 THEN 1 ELSE 0 END),
                stakes_runner = SUM(CASE WHEN t.no_of_st_runs > 0 THEN 1 ELSE 0 END)
            FROM
                /*{EXPRESSION(tmpTableSeasonalStats)}*/ t
                JOIN horse d ON d.horse_uid = t.dam_uid
                JOIN horse ds ON ds.horse_uid = d.sire_uid
                LEFT JOIN weatherbys_stallions ws
                    ON ws.year = year(getdate()) AND ws.sire_uid = ds.horse_uid
            WHERE
                1 = 1
                /*{WHERE}*/
            GROUP BY
                ds.horse_uid,
                ds.style_name,
                ds.country_origin_code
            ORDER BY 
                t.total_prize_money_pound DESC,
                t.total_prize_money_euro DESC,
                ds.style_name
        ");

        $builder->build();

        $result = $this->query($builder->getSql(), $builder->getParams(), new Row(), false);

        return $result->toArrayWithRows();
    }

    /**
     * @param int $progenyPerformersLimit
     * @return array
     * @throws \Api\Exception\InternalServerError
     */
    public function getProgenyPerformers(int $progenyPerformersLimit)
    {
        $tableName = $this->getTmpTableSeasonalStats()->getTemporaryTable();
        $builder = new Builder();

        $builder->setParam('progenyPerformersLimit', $progenyPerformersLimit);

        $builder->setSqlTemplate("
            SELECT
                dam_sire_uid = ds.horse_uid
                , t.horse_uid
                , horse_style_name = t.horse_style_name
                , horse_country_origin_code = t.country_origin_code
                , sire_uid = s.horse_uid
                , sire_style_name = s.style_name
                , sire_country_origin_code = s.country_origin_code
                , rp_postmark = MAX(t.rpr)
                , rp_postmark = MAX(t.rpr)
            FROM
                {$tableName} t
                JOIN horse s ON s.horse_uid = t.sire_uid
                JOIN horse d ON d.horse_uid = t.dam_uid
                JOIN horse ds ON ds.horse_uid = d.sire_uid
            GROUP BY
                ds.horse_uid
                , t.horse_uid
                , t.horse_style_name
                , t.country_origin_code
                , s.horse_uid
                , s.style_name
                , s.country_origin_code
            ORDER BY
                ds.horse_uid
                , 8 DESC
                , t.horse_style_name ASC
        ");

        $builder->build();

        $result = $this->query($builder->getSql(), $builder->getParams(), new Row(), false);

        return $result->toArrayWithRows('dam_sire_uid', null, true);
    }
}
