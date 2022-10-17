<?php

namespace Models\Bo\Bloodstock\StallionStatistics;

use Api\Input\Request\Horses\Bloodstock\Statistics as Request;
use Models\Selectors;
use Phalcon\Db\Sql\Builder;
use Phalcon\Mvc\Model\Resultset\General as ResultSet;
use Phalcon\Mvc\Model\Row\General as Row;
use Phalcon\DI;
use Api\Constants\Horses as Constants;

/**
 * Class Horses
 *
 * @package Models\Bo\Bloodstock\StallionStatistics
 */
class Horses extends \Phalcon\Mvc\Model
{
    const STALLIONS_TMP_TABLE = '#bloodstockTopStallionsTMP';
    const GB_IRE_STATS_TABLE = 'sstats_horse_own_jock_train';
    const FOREIGN_STATS_TABLE = 'sstats_int_ratings';

    /**
     * Available county codes of euro stake category
     *
     * @var string
     */
    private static $euroStakesCountries = ['GB', 'IRE', 'FR', 'GER', 'ITY'];

    /**
     * Available county codes as sql part
     *
     * @var array
     */
    private static $countyFlagSql = [
        'IRE' => "v.country_flag = 'I'",
        'GB' => "v.country_flag = 'E'",
        'GB-IRE' => "v.country_flag IN ('E', 'I')",
        'Europe' => "v.country_flag IN ('E', 'I', 'F', 'G')",
        'USA' => "v.country_flag = 'A'",
        'All' => '1=1',

    ];

    /**
     * @param $countryFlag
     *
     * @return mixed
     * @throws \Api\Exception\ValidationError
     */
    private static function getSqlForCountryFlag($countryFlag)
    {
        if (isset(static::$countyFlagSql[$countryFlag])) {
            return static::$countyFlagSql[$countryFlag];
        } else {
            throw new \Api\Exception\ValidationError(12122);
        }
    }

    /**
     * @param array                $parameters
     * @param Request\TopStallions $request
     * @param string               $field
     *
     * @return string
     */
    private static function preparationForCountryOriginCode(
        array &$parameters,
        Request\TopStallions $request,
        $field = 'ssp.country_origin_code'
    ) {
        $countryOrigCodesConditions = "";
        if ($request->isParameterSet('countryOrigCodes')) {
            $countryOrigCodesConditions = "AND $field IN(:countryOrigCodes:)";
            $parameters['countryOrigCodes'] = $request->getCountryOrigCodes();
        }
        return $countryOrigCodesConditions;
    }

    /**
     * @param Request\TopStallions $request
     *
     * @return array
     */
    private function getSQLFilters(Request\TopStallions $request)
    {
        $category = $request->getCategory();
        $selectors = DI::getDefault()->getShared('selectors');

        switch ($category) {
            case 'Worldwide G1':
                $season = (object)$this->getSeasonByYear($request->getSeason(), Constants::SEASON_TYPE_CODE_FLAT);
                $raceTypeCodes = $selectors->getRaceTypeCode(Constants::RACE_TYPE_FLAT_ALIAS);

                $sql = "
                    AND ss.race_type_code IN (:raceTypeCodes:)
                    AND EXISTS (
                        SELECT 1 FROM race_group rg
                        WHERE rg.race_group_uid = ss.race_group_uid
                            AND rg.race_group_desc in ('Group 1','Grade 1','Grade 1 Handicap')
                )";
                $params = [
                    'seasonStartDate' => $season->season_start_date,
                    'seasonEndDate' => $season->season_end_date,
                    'raceTypeCodes' => $raceTypeCodes
                ];
                break;

            case 'Euro Stakes':
                $season = (object)$this->getSeasonByYear($request->getSeason(), Constants::SEASON_TYPE_CODE_FLAT);
                $raceTypeCodes = $selectors->getRaceTypeCode(Constants::RACE_TYPE_FLAT_ALIAS);

                $sql = ' AND ss.race_type_code IN (:raceTypeCodes:)
                         AND ss.race_group_uid NOT IN (0, 6)
                         AND ss.country_code in (:countryCodes:)';
                $params = [
                    'seasonStartDate' => $season->season_start_date,
                    'seasonEndDate' => $season->season_end_date,
                    'raceTypeCodes' => $raceTypeCodes,
                    'countryCodes' => static::$euroStakesCountries,
                ];
                break;

            case 'Jumps':
                $season = (object)$this->getSeasonByYear($request->getSeason(), Constants::SEASON_TYPE_CODE_JUMPS);
                $raceTypeCodes = $selectors->getJumpsTypeCodesKeys();

                $sql = ' AND ss.race_type_code IN (:raceTypeCodes:)';
                $params = [
                    'seasonStartDate' => $season->season_start_date,
                    'seasonEndDate' => $season->season_end_date,
                    'raceTypeCodes' => $raceTypeCodes
                ];
                break;

            case 'Flat':
                $season = (object)$this->getSeasonByYear($request->getSeason(), Constants::SEASON_TYPE_CODE_FLAT);
                $raceTypeCodes = $selectors->getRaceTypeCode(Constants::RACE_TYPE_FLAT_ALIAS);

                $sql = ' AND ss.race_type_code IN (:raceTypeCodes:)';
                $params = [
                    'seasonStartDate' => $season->season_start_date,
                    'seasonEndDate' => $season->season_end_date,
                    'raceTypeCodes' => $raceTypeCodes
                ];
                break;

            case 'All-weather':
                $season = (object)$this->getSeasonByYear($request->getSeason(), Constants::SEASON_TYPE_CODE_FLAT);
                $raceTypeCodes = $selectors->getRaceTypeCode(Constants::RACE_TYPE_FLAT_ALIAS, 'aw');

                $sql = ' AND ss.race_type_code IN (:raceTypeCodes:)';
                $params = [
                    'seasonStartDate' => $season->season_start_date,
                    'seasonEndDate' => $season->season_end_date,
                    'raceTypeCodes' => $raceTypeCodes
                ];
                break;

            case 'First Crop':
                $season = (object)$this->getSeasonByYear($request->getSeason(), Constants::SEASON_TYPE_CODE_FLAT);

                if (strval($request->getSeason()) === $this->dateToYear("now")) {
                    $sql = "
                            AND EXISTS (
                                SELECT 1 FROM sire s WHERE s.sire_uid = ss.sire_uid AND s.first_season_yn = 'Y'
                            )
                        ";
                } else {
                    $sql = '
                        AND ' . strval($request->getSeason()) . ' - ss.horse_age = (
                            SELECT MIN(snf.year) + 1
                            FROM stallion_nomination_fees snf
                            WHERE snf.horse_uid = ss.sire_uid
                        )
                    ';
                }
                $params = [
                    'seasonStartDate' => $season->season_start_date,
                    'seasonEndDate' => $season->season_end_date,
                ];
                break;

            case '2yo':
                $season = (object)$this->getSeasonByYear($request->getSeason(), Constants::SEASON_TYPE_CODE_FLAT);

                $sql = ' AND ss.horse_age = :horseAge:';
                $params = [
                    'seasonStartDate' => $season->season_start_date,
                    'seasonEndDate' => $season->season_end_date,
                    'horseAge' => 2
                ];
                break;

            default:
                // It's just for compatibility the structure
                $sql = ' AND 1 != 1';
                $params = [
                    'seasonStartDate' => '1990-01-01',
                    'seasonEndDate' => '1990-01-01'
                ];
        }

        return [
            $sql,
            $params
        ];
    }

    /**
     * @param Request\TopStallions $request
     *
     * @return array
     */
    public function getTopStallions(Request\TopStallions $request)
    {
        $parameters = ['season' => $request->getSeason(), 'category' => $request->getCategory()];

        $sql = "SELECT
                       ssp.style_name
                      ,ssp.country_origin_code
                      ,ssp.horse_uid
                      ,no_of_wins = SUM(ssp.no_of_wins)
                      ,no_of_runs = SUM(ssp.no_of_runs)
                      ,no_of_2nds = SUM(ssp.no_of_2nds)
                      ,no_of_3rds = SUM(ssp.no_of_3rds)
                      ,no_of_4ths = SUM(ssp.no_of_4ths)
                      ,win_prize_money = SUM(ssp.win_prize_money)
                      ,total_prize_money = SUM(ssp.total_prize_money)
                      ,no_of_winners = SUM(ssp.no_of_winners)
                      ,no_of_runners = SUM(ssp.no_of_runners)
                 FROM ss_stal_proj ssp
                WHERE ssp.season = :season:
                  AND ssp.category IN (:category:)
                  " . static::preparationForCountryOriginCode($parameters, $request) . "
                GROUP BY
                     ssp.style_name
                    ,ssp.country_origin_code
                    ,ssp.horse_uid
                ORDER BY
                    total_prize_money DESC
                    ,no_of_winners DESC
                    ,no_of_runners ASC";


        $result = $this->getReadConnection()->query($sql, $parameters);

        $resultSet = new ResultSet(null, new Row(), $result);

        return $resultSet->toArrayWithRows();
    }

    /**
     * @param Request\Yearlings $request
     *
     * @return array
     */
    public function getYearlings(Request\Yearlings $request)
    {
        $euroExchange = 1;

        if ($request->isParameterSet('countryFlag') && $request->isParameterSet('saleYear')) {
            switch ($request->getCountryFlag()) {
                case 'Europe':
                    $countryCode = 'EUR';
                    break;
                case 'USA':
                    $countryCode = 'USA';
                    break;
                case 'ALL':
                    $countryCode = 'GNS';
                    break;
                default:
                    $countryCode = 'EUR';
            }

            $sql = "SELECT exchange_rate FROM country_currencies WHERE country_code = '{$countryCode}' AND year = :year:";
            $result = $this->getReadConnection()->query($sql, ['year' => $request->getSaleYear()]);
            $resultSet = new ResultSet(null, new Row(), $result);
            $exchangeEuroResult = $resultSet->getFirst();

            if (!empty($exchangeEuroResult->exchange_rate)) {
                $euroExchange = $exchangeEuroResult->exchange_rate;
            }
        }

        $sql = "SELECT
                   sale_year = YEAR(bs.sale_date)
                  ,bs.sire_name
                  ,h.style_name
                  ,h.country_origin_code
                  ,h.horse_uid
                  ,bs.horse_sex
                  ,bs.buyer_detail
                  ,bs.price
                  ,exchange_rate_db = {$euroExchange}
                  ,exchange_rate = ISNULL(cc.exchange_rate, 1)
                  ,v.currency_code
                  ,c.cur_code
               FROM
                  bloodstock_sale bs,
                  horse h,
                  venue v,
                  country_currencies cc,
                  currencies c
               WHERE bs.sale_date BETWEEN :saleDateFrom: AND :saleDateTo:
                  AND bs.sale_date <= GETDATE()
                  AND bs.horse_age = 1
                  AND bs.sire_name IS NOT NULL
                  AND v.venue_uid = bs.venue_uid
                  AND h.horse_uid = bs.sire_uid
                  AND RTRIM(cc.country_code) =
                         CASE WHEN v.country_flag = 'I' AND YEAR(bs.sale_date) < 2002
                                THEN 'IRE'
                                ELSE  CASE WHEN v.country_flag = 'F' AND YEAR(bs.sale_date) < 2002
                                            THEN 'FR'
                                            ELSE  CASE
                                                    WHEN v.currency_code = 'GNS' THEN 'GB'
                                                    WHEN v.currency_code = 'USD' THEN 'USA'
                                                    WHEN v.currency_code = 'JPY' THEN 'JPN'
                                                    WHEN v.currency_code = 'GBP' THEN 'GB'
                                                    ELSE v.currency_code
                                                  END
                                      END
                         END
                  AND c.cur_uid = cc.cur_uid
                  AND RTRIM(c.cur_code) = {$this->getDI()->getShared('selectors')->getCurrencySqlCriteria('bs.sale_date')}
                  AND cc.year = YEAR(bs.sale_date)
                  AND " . static::getSqlForCountryFlag($request->getCountryFlag()) . "
              ORDER BY
                horse_uid,
                horse_sex,
                price";

        $result = $this->getReadConnection()->query(
            $sql,
            [
                'saleDateFrom' => $request->getSaleYear() . '-01-01 00:00:00',
                'saleDateTo' => $request->getSaleYear() . '-12-31 23:59:59'
            ]
        );
        $resultSet = new ResultSet(null, new Row(), $result);

        return $resultSet->toArrayWithRows();
    }

    /**
     * @param Request\TopSires $request
     *
     * @return array
     * @throws \Exception
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getTopSires(Request\TopSires $request)
    {
        $builder = new Builder();
        $selectors = $this->getDI()->getShared('selectors');

        $seasonType = $request->getRaceType();
        $raceTypes = $selectors->getRaceTypeCode($seasonType);
        $seasonTypeCode = $seasonType == Constants::RACE_TYPE_FLAT_ALIAS
            ? Constants::SEASON_TYPE_CODE_FLAT
            : Constants::SEASON_TYPE_CODE_JUMPS;

        if ($seasonTypeCode == Constants::SEASON_TYPE_CODE_JUMPS && ($request->isParameterProvided('jumpsCode'))) {
            $raceTypes = $this->getActualJumpsCodes($request, $selectors, $seasonType);
        }

        $season = (object)$this->getSeasonByYear($request->getSeason(), $seasonTypeCode);

        $builder
            ->setParam('seasonStartDate', $season->season_start_date)
            ->setParam('seasonEndDate', $season->season_end_date)
            ->setParam('raceTypes', $raceTypes);

        $builder->setSqlTemplate("
            SELECT
                h.horse_uid
                , h.style_name
                , h.sire_uid
                , sire_name = sire.style_name
                , sire_country_origin_code = sire.country_origin_code
                , t.rp_postmark
                , t.race_datetime
            FROM (
                SELECT
                    hr.horse_uid
                    , rp_postmark = MAX(hr.rp_postmark)
                    , race_datetime = MAX(ri.race_datetime)
                FROM
                    race_instance ri
                    JOIN horse_race hr ON ri.race_instance_uid = hr.race_instance_uid
                    INNER JOIN course c ON c.course_uid = ri.course_uid
                WHERE
                    hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                    AND c.country_code IN('GB', 'IRE')
                    AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                    AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                    AND ri.race_type_code IN (:raceTypes)
                    AND ri.race_datetime BETWEEN :seasonStartDate AND :seasonEndDate
                GROUP BY hr.horse_uid
                ) t
                JOIN horse h ON h.horse_uid = t.horse_uid
                INNER JOIN horse sire ON h.sire_uid = sire.horse_uid
            ORDER BY
                 sire_uid
                , horse_uid
        ");

        $builder->build();

        $result = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $resultSet = new ResultSet(null, new Row(), $result);

        return $resultSet->toArrayWithRows();
    }

    /**
     * @param int    $seasonYear
     * @param string $seasonTypeCode
     *
     * @return mixed
     */
    private function getSeasonByYear(int $seasonYear, string $seasonTypeCode)
    {
        $sql = "
            SELECT season_start_date, season_end_date
            FROM season
            WHERE YEAR(season_start_date) = :seasonYear
              AND season_type_code = :seasonTypeCode
        ";

        $result = $this->getReadConnection()->query(
            $sql,
            [
                'seasonYear' => $seasonYear,
                'seasonTypeCode' => $seasonTypeCode
            ]
        );

        return $result->fetch();
    }


    /**
     * @param Request\TopStallions $request
     *
     * @return mixed
     */
    public function createStallionsTmpTable(Request\TopStallions $request)
    {
        list($sqlFilters, $params) = $this->getSQLFilters($request);

        $workHorseDb = $this->getWorkHorseDb();
        $tmpTable = 'INTO ' . static::STALLIONS_TMP_TABLE;

        $sql = "
            SELECT
                 ss.sire_uid
                , ss.horse_uid
                , ss.horse_style_name
                , ss.country_origin_code
                , ss.dam_uid
                , horse_age = MAX(ss.horse_age)
                , rpr = MAX(ss.rpr)
            %s
            FROM
                %s..%s ss
            WHERE
                ss.race_datetime BETWEEN :%s: AND :%s:
                AND ss.wins > 0
                {$sqlFilters}
            GROUP BY
                 ss.sire_uid
                , ss.horse_uid
                , ss.horse_style_name
                , ss.country_origin_code
                , ss.dam_uid
        ";

        $sql =
            sprintf(
                $sql,
                $tmpTable,
                $workHorseDb,
                static::GB_IRE_STATS_TABLE,
                'seasonStartDate',
                'seasonEndDate'
            )
            . 'UNION ALL' .
            sprintf(
                $sql,
                '', // Do not insert tmp table in union
                $workHorseDb,
                static::FOREIGN_STATS_TABLE,
                'seasonStartDate',
                'seasonEndDate'
            );

        $result = $this->getReadConnection()->execute(
            $sql,
            $params,
            null,
            false
        );
        if ($result == false) {
            return $result;
        }

        $sql = "CREATE INDEX "
            . static::STALLIONS_TMP_TABLE . "_idx ON "
            . static::STALLIONS_TMP_TABLE . "(sire_uid, horse_uid, rpr)";
        $result = $this->getReadConnection()->execute($sql, null, null, false);

        return $result;
    }


    /**
     * @param int $progenyPerformersLimit
     *
     * @return array
     */
    public function getStallionProgenyPerformers($progenyPerformersLimit)
    {
        //  Multiply by 2 to avoid cutting the same rpr values per sire
        $progenyPerformersLimit = intval($progenyPerformersLimit) * 2;

        $sql = "
            SELECT
                t.sire_uid
                , t.horse_uid
                , horse_style_name = t.horse_style_name
                , horse_country_origin_code = t.country_origin_code
                , dam_sire_uid = ds.horse_uid
                , dam_sire_style_name = ds.style_name
                , dam_sire_country_origin_code = ds.country_origin_code
                , rpr = max(t.rpr)
            FROM
                " . static::STALLIONS_TMP_TABLE . " t
                    LEFT JOIN horse d ON d.horse_uid = t.dam_uid
                    LEFT JOIN horse ds ON ds.horse_uid = d.sire_uid
                WHERE EXISTS (
                        SELECT 1 FROM " . static::STALLIONS_TMP_TABLE . "  t2
                        WHERE t2.sire_uid = t.sire_uid
                            AND t2.rpr >= t.rpr
                        GROUP BY t2.sire_uid 
                        HAVING COUNT(*) <= {$progenyPerformersLimit})
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
        ";

        $result = $this->getReadConnection()->query($sql);
        $result = new ResultSet(null, new Row(), $result);

        return $result->toArrayWithRows('sire_uid', null, true);
    }

    /**
     * Check and drop tmp table in DB
     *
     * @param string $tableName
     */
    private function dropTmpTable($tableName)
    {
        $sql = "
            IF OBJECT_ID('{$tableName}') IS NOT NULL
            DROP TABLE {$tableName}
        ";
        $this->getReadConnection()->execute($sql, null, null, false);
    }

    /**
     * Drop all temporary tables used by this response
     */
    public function dropStallionsTmpTables()
    {
        $this->dropTmpTable(static::STALLIONS_TMP_TABLE);
    }

    /**
     * @return string DB name for work's horse
     */
    private function getWorkHorseDb()
    {
        return DI::getDefault()->getShared('selectors')->getDb()->getWorkHorseDb();
    }

    /**
     * @param string $date
     *
     * @return string
     */
    private function dateToYear($date)
    {
        return (new \DateTime($date))->format('Y');
    }

    /**
     * @param Request   $request
     * @param Selectors $selectors
     * @param string    $seasonType
     *
     * @return array
     * @throws \Exception
     */
    private function getActualJumpsCodes(Request $request, Selectors $selectors, string $seasonType)
    {
        foreach ($request->getJumpsCode() as $jumpsType) {
            foreach ($selectors->getRaceTypeCode($seasonType, $jumpsType) as $item) {
                $jumpsCodes[] = $item;
            }
        }

        return $jumpsCodes;
    }
}
