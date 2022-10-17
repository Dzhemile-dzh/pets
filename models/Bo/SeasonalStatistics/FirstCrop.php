<?php

namespace Models\Bo\SeasonalStatistics;

use Api\Input\Request\HorsesRequest as Request;
use Phalcon\Mvc\Model\Row\General as Row;
use Phalcon\DI;
use Phalcon\Db\Sql\Builder;
use Api\Mvc\DataProvider\BuilderBasedTemporaryTable as TmpBuilder;

/**
 * Class FirstCrop
 *
 * @package Models\Bo\SeasonalStatistics
 */
class FirstCrop extends \Models\Bo\SeasonalStatistics\Sire
{
    /**
     * @inheritDoc
     */
    protected $alias = [
        'going_type_code' => 'ss',
        'distance_yard' => 'ss',
    ];

    /**
     * @inheritDoc
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

        $builder = new Builder();
        $builder->expression("tmpTableSeasonalStats", $this->getTmpTableSeasonalStats()->getTemporaryTable());

        $euroExchange = $this->getSelectors()->getDb()->getEuroRateByYear(
            static::dateToYear($request->getSeasonDateBegin())
        );

        $this->setRestrictions($request);

        $builder->setSqlTemplate("
            SELECT
                sire_uid = h.horse_uid,
                sire = h.style_name,
                sire_country_origin_code = h.country_origin_code,
                weatherbys_uid = MAX(CONVERT(INT, ws.weatherbys_uid)),
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
                JOIN horse h ON h.horse_uid = t.sire_uid
                JOIN sire ON sire.sire_uid = h.horse_uid AND sire.first_season_yn = 'Y'
                LEFT JOIN weatherbys_stallions ws ON ws.year = year(getdate()) AND ws.sire_uid = h.horse_uid
            GROUP BY
                h.horse_uid,
                h.style_name,
                h.country_origin_code 
            ORDER BY 
                t.total_prize_money_pound DESC,
                t.total_prize_money_euro DESC,
                h.style_name
        ");

        $builder->build();

        $result = $this->query($builder->getSql(), $builder->getParams(), new Row(), false);

        return $result->toArrayWithRows();
    }
}
