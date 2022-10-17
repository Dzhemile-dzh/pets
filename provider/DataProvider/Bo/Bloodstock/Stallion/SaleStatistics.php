<?php
namespace Api\DataProvider\Bo\Bloodstock\Stallion;

use Phalcon\DI;
use Phalcon\Mvc\DataProvider;
use Api\Input\Request\HorsesRequest;

class SaleStatistics extends DataProvider
{
    protected $conditions = [
        'country' => [
            'IRE' => "v.country_flag = 'I'",
            'GB' => "v.country_flag = 'E'",
            'GB-IRE' => "v.country_flag IN ('E', 'I')",
            'Europe' => "v.country_flag IN ('E', 'I', 'F', 'G')",
            'USA' => "v.country_flag = 'A'",
            'All' => '1=1',
        ],
        'horse' => [
            'foals' => 'bs.horse_age = 0',
            'yearlings' => 'bs.horse_age = 1',
            '2yo' => 'bs.horse_age = 2',
            '3yo' => 'bs.horse_age = 3',
            '4yo' => 'bs.horse_age = 4',
            'older' => 'bs.horse_age > 4',
            'mares' => "bs.horse_sex = 'M'",
        ],
    ];

    /**
     * @param HorsesRequest $request
     *
     * @return \Api\Row\Bloodstock\Stallion\SaleStatistics[]
     */
    public function getSaleStatistics(HorsesRequest $request)
    {
        $currencySqlCriteria = DI::getDefault()->getShared('selectors')->getCurrencySqlCriteria();

        $sql = "
        SELECT
            sale_year = YEAR(bs.sale_date)
            , hs.horse_sex_flag
            , bs.buyer_detail
            , bs.price
            , exchange_rate = ISNULL(cc.exchange_rate,  1)
            , v.currency_code
            , c.cur_code
            , total_count = NULL
            , colts = NULL
            , fillies = NULL
            , median = NULL
            , price_max = NULL
            , price_min = NULL
            , price_average = NULL
            , sales_count = NULL
            , offered_count = NULL
            , byers_count = NULL
            , withdraws_count = NULL
            , prices = NULL
        FROM
            horse h
        JOIN
            bloodstock_sale bs ON h.horse_uid = bs.sire_uid
        JOIN
            horse_sex hs ON bs.horse_sex = hs.horse_sex_code
        JOIN
            venue v ON v.venue_uid = bs.venue_uid
        JOIN
            currencies c ON c.cur_code = {$currencySqlCriteria}
        LEFT JOIN
            country_currencies cc ON cc.cur_uid = c.cur_uid
        WHERE
            h.horse_uid = :horseId:
            AND bs.sale_date >= h.horse_date_of_birth
            AND cc.year = YEAR(bs.sale_date)
            AND {$this->conditions['horse'][$request->getHorseRestriction()]}
            AND {$this->conditions['country'][$request->getCountryFlag()]}
        ORDER BY
            sale_year DESC,
            horse_sex,
            price
        ";

        $result = $this->query(
            $sql,
            [
                'horseId' => $request->getStallionId()
            ],
            new \Api\Row\Bloodstock\Stallion\SaleStatistics()
        );

        return $result->toArrayWithRows();
    }

    /**
     * @param HorsesRequest $request
     *
     * @return bool
     */
    public function checkExistenceOfSaleStatistics(HorsesRequest $request)
    {
        $currencySqlCriteria = DI::getDefault()->getShared('selectors')->getCurrencySqlCriteria();

        $result = $this->query(
            "
            SELECT
                statisticsExist = (
                    CASE WHEN EXISTS (
                        SELECT
                            1
                        FROM horse h
                            INNER JOIN bloodstock_sale bs ON h.horse_uid = bs.sire_uid
                            INNER JOIN horse_sex hs ON bs.horse_sex = hs.horse_sex_code
                            INNER JOIN venue v ON v.venue_uid = bs.venue_uid
                            INNER JOIN currencies c ON c.cur_code = {$currencySqlCriteria}
                        WHERE
                            h.horse_uid = :horseId:
                            AND bs.sale_date >= h.horse_date_of_birth
                            AND {$this->conditions['horse'][$request->getHorseRestriction()]}
                            AND {$this->conditions['country'][$request->getCountryFlag()]}
                    )
                    THEN 'Y'
                    ELSE 'N'
                    END
                )
            ",
            ['horseId' => $request->getStallionId()]
        );

        return $result->getFirst()->statisticsExist == 'Y';
    }
}
