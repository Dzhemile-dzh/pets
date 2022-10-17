<?php
namespace Api\DataProvider\Bo\Bloodstock\Sales\Catalogue;

use Api\DataProvider\HorsesDataProvider;
use Api\Input\Request\Horses\Bloodstock\Sales\CataloguePreviouslySold;

class PreviouslySold extends HorsesDataProvider
{
    /**
     * @param CataloguePreviouslySold $request
     *
     * @return \Phalcon\Mvc\Model\Row\General[]
     */
    public function getPreviouslySold(CataloguePreviouslySold $request)
    {
        $venueId = $request->getVenueId();
        $fromDate = $request->getStartDate();
        $toDate = $request->getEndDate();

        $currencySqlCriteria = $this->getDI()->getShared('selectors')->getCurrencySqlCriteria('bsprev.sale_date');
        $currencySqlField = $this->getDI()->getShared('selectors')->getCurrencySqlField('bsd.sale_date');

        $result = $this->query(
            "SELECT
                current_lot_number = bs.lot_no
                , current_lot_letter = bs.lot_letter
                , previous_lot_number = bsprev.lot_no
                , previous_lot_letter = bsprev.lot_letter
                , bs.horse_name
                , bs.horse_country_origin_code
                , horse_year_of_born = (YEAR(bs.sale_date) - bs.horse_age)
                , colour = bs.horse_first_colour_code
                , bsprev.horse_sex
                , sire_uid = s.horse_uid
                , sire_style_name = s.style_name
                , dam_uid = d.horse_uid
                , dam_style_name = d.style_name
                , bsprev.price
                , price_gbp = bsprev.price / cc.exchange_rate
                , bsd.sale_name
                , current_seller_name = bs.seller_name
                , previous_seller_name = bsprev.seller_name
                , bsprev.buyer_detail
                , bs.venue_uid
                , bs.sale_date 
                , currency = {$currencySqlField}
            FROM
                bloodstock_sale bs
            JOIN
                bloodstock_sale bsprev ON (
                    bsprev.sire_uid = bs.sire_uid
                    AND bsprev.dam_uid = bs.dam_uid
                )
            JOIN
                bloodstock_sale_date bsd ON (bsd.venue_uid = bsprev.venue_uid AND bsd.sale_date = bsprev.sale_date)
            JOIN
                venue v ON v.venue_uid = bsprev.venue_uid
            LEFT JOIN
                horse s ON s.horse_uid = bsprev.sire_uid
            LEFT JOIN
                horse d ON d.horse_uid = bsprev.dam_uid
            LEFT JOIN
                currencies c ON c.cur_code = {$currencySqlCriteria}
            LEFT JOIN
                country_currencies cc ON cc.cur_uid = c.cur_uid AND cc.year = YEAR(bs.sale_date)
            WHERE
                bs.sale_date BETWEEN :fromDate: AND :toDate:
                AND bs.venue_uid = :venueId:
                AND bsprev.sale_date < :fromDate:
                AND (YEAR(bs.sale_date) - bs.horse_age = YEAR(bsprev.sale_date) - bsprev.horse_age)
            ORDER BY
                bs.lot_no, bsprev.sale_date DESC
            ",
            [
                'venueId' => $venueId,
                'fromDate' => $fromDate . ' 00:00:00',
                'toDate' => $toDate . ' 23:59:00',
            ]
        );

        return $result->toArrayWithRows();
    }
}
