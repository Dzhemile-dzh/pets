<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 8/10/2016
 * Time: 3:22 PM
 */

namespace Api\DataProvider\Bo\Bloodstock\SalesStatistics;

use Api\Input\Request\Horses\Bloodstock\SalesStatistics as Request;
use Phalcon\DI;
use Phalcon\Mvc\Model\Row;

class Vendors extends \Phalcon\Mvc\DataProvider
{
    /**
     * @param Request\Vendors $request
     *
     * @return array
     */
    public function getVendors(Request\Vendors $request)
    {
        $selectors = $this->getDI()->getShared('selectors');

        $currencySqlCriteria = $selectors->getCurrencySqlCriteria();

        $sql = "
            SELECT
                bs.sale_date
                , bs.buyer_detail
                , bs.search_buyer_detail
                , bs.seller_name
                , bs.search_seller_name
                , bs.price
                , bs.lot_no
                , bs.lot_letter

                , h.horse_uid
                , bs.horse_name
                , horse_style_name = h.style_name
                , bs.horse_first_colour_code
                , bs.horse_sex
                , bs.horse_age

                , h.dam_uid
                , bs.dam_name
                , dam_style_name = d.style_name
                , h.sire_uid
                , bs.sire_name
                , sire_style_name = s.style_name
                , sire_of_dam_uid = sd.horse_uid
                , bs.sire_of_dam_name
                , sire_of_dam_style_name = sd.style_name
                , c.cur_code
                , currency_code = v.currency_code
                , cc.exchange_rate
            FROM
                bloodstock_sale bs
                INNER JOIN venue v ON v.venue_uid = bs.venue_uid
                INNER JOIN currencies c ON c.cur_code = {$currencySqlCriteria}
                LEFT JOIN country_currencies cc ON cc.cur_uid = c.cur_uid AND cc.year = year(bs.sale_date)
                LEFT JOIN horse h ON h.horse_name = UPPER(bs.horse_name) AND h.country_origin_code = bs.horse_country_origin_code
                LEFT JOIN horse d ON d.horse_uid = h.dam_uid
                LEFT JOIN horse sd ON sd.horse_uid = d.sire_uid
                LEFT JOIN horse s ON s.horse_uid = h.sire_uid
            WHERE
                bs.sale_date BETWEEN :startDate: AND :endDate:
                AND v.venue_uid = :venueId:
            ORDER BY
                search_seller_name
                , price
            PLAN '(use optgoal allrows_dss)(use merge_join off)'
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
