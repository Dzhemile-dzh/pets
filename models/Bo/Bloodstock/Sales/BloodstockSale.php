<?php

namespace Models\Bo\Bloodstock\Sales;

use Phalcon\Mvc\Model\Resultset\General as ResultSet;
use Phalcon\Mvc\Model\Row;
use \Api\Constants\Horses as Constants;

class BloodstockSale extends \Models\BloodstockSale
{
    public function getCatalogueSires($request)
    {
        $res = $this->getReadConnection()->query(
            "
                SELECT
                    t.*
                    , st.stud_name
                    , stud_fee = snf.nomination_fee
                    , stud_fee_gbp = CASE WHEN cc.exchange_rate IS NULL THEN NULL ELSE snf.nomination_fee / cc.exchange_rate END
                    , c.cur_code
                FROM (
                    SELECT
                        sire_uid = h.horse_uid
                        , bs.sire_name
                        , sire_style_name = h.style_name
                        , total_lots = COUNT(bs.lot_no)
                        , total_lots_fillies = COUNT(
                                CASE bs.horse_sex 
                                WHEN '" . Constants::HORSE_SEX_CODE_FILLY . "'
                                THEN 1 ELSE NULL 
                                END
                            )
                        , total_lots_colts = COUNT(
                                CASE bs.horse_sex 
                                WHEN '" . Constants::HORSE_SEX_CODE_COLT . "'  
                                THEN 1 
                                WHEN '" . Constants::HORSE_SEX_CODE_GELDING . "'  
                                THEN 1 
                                ELSE NULL 
                                END
                            )
                    FROM
                        bloodstock_sale bs
                    JOIN
                        horse h ON h.horse_uid = bs.sire_uid
                    WHERE
                        bs.sale_date BETWEEN :startDate: AND :endDate:
                        AND bs.venue_uid = :venueId:
                    GROUP BY
                        h.horse_uid
                        , bs.sire_name
                        , h.style_name
                ) t
                LEFT JOIN
                    stallion_nomination_fees snf ON (snf.horse_uid = t.sire_uid AND snf.year = :year:)
                LEFT JOIN
                    stud st ON st.stud_uid = snf.stud_uid
                LEFT JOIN
                    country_currencies cc ON cc.cur_uid = snf.cur_uid AND cc.year = :year:
                LEFT JOIN
                    currencies c ON c.cur_uid = cc.cur_uid
            ",
            [
                'venueId' => $request->getVenueId(),
                'startDate' => $request->getStartDate(),
                'endDate' => $request->getEndDate(),
                'year' => idate('Y', strtotime($request->getStartDate()))
            ]
        );

        $resultSet = new ResultSet(null, new Row(), $res);

        return $resultSet->toArrayWithRows('sire_uid');
    }
}
