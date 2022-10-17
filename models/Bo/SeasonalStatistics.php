<?php

namespace Models\Bo;

use Api\Input\Request\HorsesRequest as Request;
use Api\Mvc\DataProvider\BuilderBasedTemporaryTable as TmpBuilder;
use Phalcon\Db\Sql\Builder;
use Phalcon\DI;
use \Api\Constants\Horses as Constants;
use \Phalcon\Mvc\DataProvider;

/**
 * Class SeasonalStatistics
 *
 * @package Models\Bo
 */
class SeasonalStatistics extends DataProvider
{
    const DISTANCE_MAX = 9999;
    const DISTANCE_MAX_STUB = "null";
    const STATS_TMP_TABLE = 'stats_tmp';

    /**
     * @var Builder
     */
    private $builder;

    /**
     * A structure of this array has to be defined in the children classes.
     * Due this array we spot table aliases in the queries.
     *
     * @var array
     */
    protected $alias;

    /**
     * @var \Models\Selectors
     */
    private $selectors;

    /**
     * @var Request
     */
    private $request;

    /**
     * A list of static fields used in pre-aggregated tmp table
     *
     * @var array
     */
    protected $staticFields = [
        "ss.horse_uid",
        "ss.horse_style_name"
    ];

    /**
     * @return Builder
     */
    private function getBuilder(): Builder
    {
        return $this->builder;
    }

    /**
     * @param Builder $builder
     */
    protected function setBuilder(Builder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @return array
     */
    public function getStaticFields()
    {
        return $this->staticFields;
    }

    /**
     * @return \Models\Selectors
     */
    public function getSelectors()
    {
        if (!$this->selectors) {
            $this->selectors = DI::getDefault()->getShared('selectors');
        }
        return $this->selectors;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param Request $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @param string $date
     *
     * @return string
     */
    public static function dateToYear($date)
    {
        return (new \DateTime($date))->format('Y');
    }

    /**
     * @param Request $request
     * @param Builder|null $builder
     */
    protected function setRestrictions(Request $request, Builder $builder = null)
    {
        foreach ($request->getParameters() as $name => $parameter) {
            if ($request->isParameterSet($name)) {
                if (!$builder) {
                    $builder = $this->getBuilder();
                }
                $methodName = 'process' . ucfirst($name);
                if (method_exists($this, $methodName)) {
                    $this->{$methodName}($builder);
                }
            }
        }
    }

    /**
     * @param Builder $builder
     */
    protected function processGoing(Builder $builder): void
    {
        $builder->where("{$this->alias['going_type_code']}.going_type_code IN (:going)");
        $builder->setParam('going', $this->getRequest()->getGoing());
    }

    /**
     * @param Builder $builder
     * @throws \Exception
     */
    protected function processJumpsCode(Builder $builder): void
    {
        $builder->setParam(
            'raceTypeCodes',
            $this->getSelectors()->getJumpsTypeCodes(strtoupper($this->getRequest()->getJumpsCode()))
        );
    }

    /**
     * @param Builder $builder
     */
    protected function processDistance(Builder $builder): void
    {
        $distance = $this->getRequest()->getDistance();
        if (!empty($distance)) {
            list($start, $end) = explode('-', $distance) + [1 => static::DISTANCE_MAX];
            if ($end === static::DISTANCE_MAX_STUB) {
                $end = static::DISTANCE_MAX;
            }

            $builder->where("{$this->alias['distance_yard']}.distance_yard BETWEEN :distanceStart AND :distanceEnd");
            $builder
                ->setParam('distanceStart', (int)$start)
                ->setParam('distanceEnd', (int)$end);
        }
    }

    /**
     * @param Builder $builder
     */
    protected function processRaceGroupId(Builder $builder): void
    {
        $builder->where('ss.race_group_uid IN (:raceGroupId)');
        $builder->setParam('raceGroupId', $this->getRequest()->getRaceGroupId());
    }

    /**
     * @param Builder $builder
     */
    protected function processAge(Builder $builder): void
    {
        $age = $this->getRequest()->getAge();
        $comparison = strpos($age, '+') ? '>=' : '=';

        $builder->where("{$this->alias['horse_age']}.horse_age {$comparison} :age");
        $builder->setParam('age', (int)$age);
    }

    /**
     * Set restriction by first crop parameter
     * @throws \Exception
     */
    protected function processFirstCrop(Builder $builder): void
    {
        if (!$this->getRequest()->getFirstCrop()) {
            return;
        }
        if (static::dateToYear($this->getRequest()->getSeasonDateEnd()) === static::dateToYear("now")) {
            $builder->where("EXISTS (
                SELECT 1 FROM sire s WHERE s.sire_uid = ss.sire_uid AND s.first_season_yn = 'Y'
                )");
        } else {
            $builder->where(
                static::dateToYear($this->getRequest()->getSeasonDateBegin()) . " - ss.horse_age = (
                        SELECT MIN(snf.year) + 1
                        FROM stallion_nomination_fees snf
                        WHERE snf.horse_uid = ss.sire_uid
                    )"
            );
        }
    }

    /**
     * Set restriction by G1 Winner parameter
     */
    protected function processG1Winner(Builder $builder): void
    {
        $builder->where("EXISTS (
            SELECT 1 FROM race_group rg
            WHERE rg.race_group_uid = ss.race_group_uid
                AND rg.race_group_desc in ('Group 1','Grade 1','Grade 1 Handicap'))");
    }

    /**
     * @codeCoverageIgnore
     *
     * @return string
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     * @throws \Exception
     */
    protected function getSqlRate(): string
    {
        $dbSelectors = $this->getSelectors()->getDb();

        $yearBegin = static::dateToYear($this->getRequest()->getSeasonDateBegin());
        $yearEnd = static::dateToYear($this->getRequest()->getSeasonDateEnd());

        $euroExchangeBegin = $dbSelectors->getEuroRateByYear($yearBegin);
        $euroExchangeEnd = $dbSelectors->getEuroRateByYear($yearEnd);

        return "CASE WHEN year(ss.race_datetime) = {$yearBegin} THEN {$euroExchangeBegin} ELSE {$euroExchangeEnd} END";
    }

    /**
     * @throws \Api\Exception\InternalServerError
     * @throws \Exception
     * @return TmpBuilder|null
     */
    protected function createStatsTmpTable():? TmpBuilder
    {
        $request = $this->getRequest();

        $builder = $this->builder = new Builder($request);

        $workHorseDb  = $this->getSelectors()->getDb()->getWorkHorseDb();
        $staticFields = $this->getStaticFields();
        $countryCodes = $request->getCountryCodes();
        $incEuroRaces = $request->isParameterProvided('incEuroRaces') ? $request->getIncEuroRaces() : false;

        $tableName = "INTO " . TmpBuilder::TEMPLATE_FOR_TABLE_NAME;

        $sql = "
            SELECT
                {$staticFields}
                , horse_age = MAX(ss.horse_age)
                , no_of_wins = SUM(ss.wins)
                , no_of_2nds = SUM(ss.second_place)
                , no_of_3rds = SUM(ss.third_place)
                , no_of_4ths = SUM(ss.fourth_place)
                , no_of_runs = COUNT(ss.runs)
                , win_prize_money_euro = SUM(CASE WHEN ss.country_code = 'IRE' THEN ss.winnings ELSE 0 END)
                , win_prize_money_pound = SUM(CASE WHEN ss.country_code = 'GB' THEN ss.winnings ELSE 0 END)
                , total_prize_money_euro = SUM(CASE WHEN ss.country_code = 'IRE' THEN ss.earnings ELSE 0 END)
                , total_prize_money_pound = SUM(CASE WHEN ss.country_code = 'GB' THEN ss.earnings ELSE 0 END)  
                , net_win_prize_money = isnull(SUM(ss.winnings_sterling), 0)  
                , net_total_prize_money = isnull(SUM(ss.earnings_sterling), 0)  
                , no_of_st_wins = SUM(CASE WHEN ss.race_group_uid IN (1, 2, 3, 4, 5, 7, 8, 9, 11, 12, 13, 14, 15, 16) THEN ss.wins ELSE 0 END)
                , no_of_st_runs = SUM(CASE WHEN ss.race_group_uid IN (1, 2, 3, 4, 5, 7, 8, 9, 11, 12, 13, 14, 15, 16) THEN 1 ELSE 0 END)
                , rpr = MAX(rpr)
                /*{COLUMNS}*/
            {$tableName}
            FROM
                {$workHorseDb}..sstats_horse_own_jock_train ss
                /*{JOINS}*/
            WHERE
                ss.race_type_code IN (:raceTypeCodes)
                /*{WHERE}*/
            GROUP BY
                {$staticFields}
        ";

        // Prepare separate SQL for international races
        $intSql = "
            SELECT
                {$staticFields}
                , horse_age = MAX(ss.horse_age)
                , no_of_wins = SUM(ss.wins)
                , no_of_2nds = SUM(ss.second_place)
                , no_of_3rds = SUM(ss.third_place)
                , no_of_4ths = SUM(ss.fourth_place)
                , no_of_runs = COUNT(ss.runs)
                , win_prize_money_euro = 0
                , win_prize_money_pound = SUM(ss.winnings)
                , total_prize_money_euro = 0
                , total_prize_money_pound = SUM(ss.earnings)  
                , net_win_prize_money = isnull(SUM(ss.winnings), 0)  
                , net_total_prize_money = isnull(SUM(ss.earnings), 0)  
                , no_of_st_wins = SUM(CASE WHEN ss.race_group_uid IN (1, 2, 3, 4, 5, 7, 8, 9, 11, 12, 13, 14, 15, 16) THEN ss.wins ELSE 0 END)
                , no_of_st_runs = SUM(CASE WHEN ss.race_group_uid IN (1, 2, 3, 4, 5, 7, 8, 9, 11, 12, 13, 14, 15, 16) THEN 1 ELSE 0 END)
                , rpr = MAX(rpr)
                /*{COLUMNS}*/
            FROM
                {$workHorseDb}..sstats_int_ratings ss
                /*{JOINS}*/
            WHERE
                ss.race_type_code IN (:raceTypeCodes)
                /*{WHERE}*/
            GROUP BY
                {$staticFields}
        ";

        if ($request->getRaceType() == Constants::RACE_TYPE_JUMPS_ALIAS
            && count($countryCodes) == 2
            && in_array('GB', $countryCodes)
            && in_array('IRE', $countryCodes)
        ) {
            // For both country codes (GB and IRE) calculate the stats separately
            $seasons = $request->getSeasonData();

            $builder1 = clone $builder;
            $builder2 = clone $builder;

            $this->setBuilderParams($builder1, $request, $seasons, ['GB'], $sql);
            $this->setBuilderParams($builder2, $request, $seasons, ['IRE'], str_replace($tableName, null, $sql));

            // Check whether data is required for other european courses
            if ($incEuroRaces === true) {
                $builder3 = clone $builder;

                $this->setBuilderParams(
                    $builder3,
                    $request,
                    $seasons,
                    Constants::CONTINENT_COUNTRY_GROUPS['Europe'],
                    $intSql
                );

                $builder->unionAll([$builder1, $builder2, $builder3]);
            } else {
                $builder->unionAll([$builder1, $builder2]);
            }
        } else {
            // Check whether data is required for other european courses
            if ($incEuroRaces === true) {
                $builder1 = clone $builder;
                $builder2 = clone $builder;

                $this->setBuilderParams($builder1, $request, null, $countryCodes, $sql);
                $this->setBuilderParams(
                    $builder2,
                    $request,
                    null,
                    Constants::CONTINENT_COUNTRY_GROUPS['Europe'],
                    $intSql
                );

                $builder->unionAll([$builder1, $builder2]);
            } else {
                $this->setBuilderParams($builder, $request, null, $countryCodes, $sql);
            }
        }

        return new TmpBuilder($builder, self::STATS_TMP_TABLE);
    }

    /**
     * @param string $tableName
     */
    protected function createStatsTmpIndex(string $tableName): void
    {
        $sql = "CREATE INDEX {$tableName}_idx ON {$tableName} (sire_uid, rpr)";
        $this->execute($sql, null, false);
    }

    /**
     * @param Builder $builder
     * @param Request $request
     * @param array|null $seasons
     * @param array $countryCodes
     * @param string $sql
     */
    private function setBuilderParams(Builder $builder, Request $request, array $seasons = null, array $countryCodes, string $sql): void
    {
        $this->setRestrictions($request, $builder);
        $this->setBuilderData($builder, $request, $seasons, $countryCodes);
        $builder->setSqlTemplate($sql);
    }

    /**
     * @param Builder $builder
     * @param Request $request
     * @param array|null $seasons
     * @param array $countryCodes
     */
    protected function setBuilderData(Builder $builder, Request $request, array $seasons = null, array $countryCodes)
    {
        $builder->where("ss.race_datetime BETWEEN :seasonStartDate AND :seasonEndDate");
        $builder->where("AND ss.country_code IN (:seasonCountries)");

        $builder->setParam('raceTypeCodes', $request->getRaceTypeCodes());

        if ($seasons && (is_array($countryCodes) && count($countryCodes) > 0)) {
            $country = $countryCodes[0];
            $builder
                ->setParam('seasonStartDate', $seasons[$country]->season_start_date)
                ->setParam('seasonEndDate', $seasons[$country]->season_end_date)
                ->setParam('seasonCountries', $country);
        } else {
            $builder
                ->setParam('seasonStartDate', $request->GetSeasonDateBegin())
                ->setParam('seasonEndDate', $request->GetSeasonDateEnd())
                ->setParam('seasonCountries', $countryCodes);
        }
    }
}
