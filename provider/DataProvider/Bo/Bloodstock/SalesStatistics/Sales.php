<?php

/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 8/2/2016
 * Time: 5:37 PM
 */

namespace Api\DataProvider\Bo\Bloodstock\SalesStatistics;

use Api\Input\Request\Horses\Bloodstock\SalesStatistics as Request;
use Phalcon\DI;
use Phalcon\Mvc\Model\Row;

class Sales extends \Phalcon\Mvc\DataProvider
{
    public function getSales(Request\Sales $request)
    {
        $selectors = $this->getDI()->getShared('selectors');

        $currencySqlField = $selectors->getCurrencySqlField();
        $currencySqlCriteria = $selectors->getCurrencySqlCriteria();

        $sql = "
            SELECT
                sale_date = CONVERT(varchar, bs.sale_date, 101),
                bs.buyer_detail,
                bs.price,
                cc.exchange_rate,
                bs.horse_sex,
                hs.horse_sex_flag,
                bs.horse_age,
                c.cur_code,
                currency_code = {$currencySqlField}
            FROM
                bloodstock_sale bs
                INNER JOIN horse_sex hs ON hs.horse_sex_code = bs.horse_sex
                INNER JOIN venue v ON v.venue_uid = bs.venue_uid
                INNER JOIN currencies c ON c.cur_code = {$currencySqlCriteria}
                INNER JOIN country_currencies cc ON cc.cur_uid = c.cur_uid AND cc.year = year(bs.sale_date)
            WHERE
                bs.sale_date BETWEEN :startDate: AND :endDate:
                AND v.venue_uid = :venueId:
            ORDER BY sale_date, price
        ";

        $result = $this->query($sql, [
            'startDate' => $request->getStartDate(),
            'endDate'   => $request->getEndDate(),
            'venueId'   => $request->getVenueId()
        ]);

        $rows = $result->toArrayWithRows();
        return $rows;
    }
}
