<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/4/2016
 * Time: 9:24 AM
 */

namespace Api\DataProvider\Bo\Bloodstock\SalesStatistics;

use Api\Input\Request\Horses\Bloodstock\SalesStatistics\Sires as RequestSires;

class Sires extends \Phalcon\Mvc\DataProvider
{
    public function getSires(RequestSires $request)
    {
        $currencySqlCriteria = $this->getDI()->getShared('selectors')->getCurrencySqlCriteria();

        $sql = "
        SELECT
            sale_year = YEAR(bs.sale_date),
            bs.sire_name,
            sire_uid = s.horse_uid,
            sire_style_name = s.style_name,
            bs.sire_country_origin_code,
            hs.horse_sex_flag,
            bs.buyer_detail,
            bs.price,
            exchange_rate = ISNULL(cc.exchange_rate,  1),
            v.currency_code,
            c.cur_code
        FROM bloodstock_sale bs
            INNER JOIN horse s ON s.horse_uid = bs.sire_uid
            INNER JOIN horse_sex hs ON bs.horse_sex = hs.horse_sex_code
            INNER JOIN venue v ON v.venue_uid = bs.venue_uid
            INNER JOIN currencies c ON c.cur_code = {$currencySqlCriteria}
            LEFT JOIN country_currencies cc ON cc.cur_uid = c.cur_uid
        WHERE
            bs.venue_uid = :venueId:
            AND bs.sale_date BETWEEN :startDate: AND :endDate:
            AND cc.year = YEAR(bs.sale_date)
        ORDER BY
            bs.sire_name,
            bs.horse_sex,
            bs.price
        ";

        $result = $this->query($sql, [
            'venueId' => $request->getVenueId(),
            'startDate' => $request->getStartDate(),
            'endDate' => $request->getEndDate(),
        ]);

        $rows = $result->toArrayWithRows();
        return $rows;
    }
}
