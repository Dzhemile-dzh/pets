<?php

namespace Models\Bo\Bloodstock\Dam;

/**
 * Class BloodstockSale
 *
 * @package Models\Bo\Bloodstock\Dam
 */
class BloodstockSale extends \Models\BloodstockSale
{
    /**
     * @param \Api\Input\Request\Horses\Bloodstock\Dam\ProgenySales $request
     *
     * @return array
     */
    public function getProgenySales(\Api\Input\Request\Horses\Bloodstock\Dam\ProgenySales $request)
    {
        $sql = "
            SELECT
                bs.sale_date
                , bs.lot_no
                , horse_name = h.style_name
                , horse_sale_name = bs.horse_name
                , h.horse_uid
                , bs.horse_age
                , bs.seller_name
                , horse_yob = (YEAR (bs.sale_date) - bs.horse_age)
                , bs.horse_first_colour_code
                , bs.horse_second_colour_code
                , bs.horse_sex
                , bs.horse_country_origin_code
                , sire_uid = sire.horse_uid
                , sire_name = sire.style_name
                , bs.sire_country_origin_code
                , dam_uid = dam.horse_uid
                , dam_name = dam.style_name
                , bs.dam_country_origin_code
                , sire_of_dam_uid = sire_dam.horse_uid
                , sire_of_dam_name = sire_dam.style_name
                , sire_of_dam_country_code = sire_dam.country_origin_code
                , bs.buyer_detail
                , bs.price
                , price_gbp = CASE WHEN bs.price > 0 
                    THEN
                        CONVERT(INT, bs.price / cc.exchange_rate)
                    ELSE
                        bs.price
                END
                , v.venue_desc
                , v.venue_uid
                , currency = {$this->getDI()->getShared('selectors')->getCurrencySqlField('bsd.sale_date')}
            FROM
                bloodstock_sale bs
            JOIN
                bloodstock_sale_date bsd ON (bsd.sale_date = bs.sale_date AND bsd.venue_uid = bs.venue_uid)
            JOIN
                venue v ON (v.venue_uid = bsd.venue_uid)
            LEFT JOIN horse h ON h.sire_uid = bs.sire_uid AND h.dam_uid = bs.dam_uid
                AND bs.horse_age = YEAR(bs.sale_date) - YEAR(h.horse_date_of_birth)
                AND 1 = (SELECT COUNT(h1.horse_uid) FROM horse h1 WHERE h1.horse_uid = h.horse_uid)
            JOIN
                horse dam ON bs.dam_uid = dam.horse_uid
            LEFT JOIN
                horse sire ON bs.sire_uid = sire.horse_uid
            LEFT JOIN
                horse sire_dam ON dam.sire_uid = sire_dam.horse_uid
            LEFT JOIN
                currencies c ON c.cur_code = {$this->getDI()->getShared('selectors')->getCurrencySqlCriteria('bsd.sale_date')}
            LEFT JOIN
                country_currencies cc ON cc.cur_uid = c.cur_uid AND cc.year = YEAR(bs.sale_date)
            WHERE
                dam.horse_uid = :damId:
                AND bs.sale_date BETWEEN :startDate: AND :endDate:
            ORDER BY
                bs.sale_date DESC,
                bs.price DESC";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'damId' => $request->getDamId(),
                'startDate' => $request->getStartDate(),
                'endDate' => $request->getEndDate(),
            ]
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return $result->toArrayWithRows();
    }
}
