<?php

namespace Api\DataProvider\Bo\Bloodstock\Sales\Catalogue;

use Api\DataProvider\HorsesDataProvider;
use Api\Input\Request\Horses\Bloodstock\Sales\CatalogueVendors as Request;
use Phalcon\Mvc\Model\Resultset\General as ResultSet;
use Phalcon\Mvc\Model\Row;
use Api\Constants\Horses as Constants;

/**
 * Class Vendors
 *
 * @package Api\DataProvider\Bo\Bloodstock\Sales\Catalogue
 */
class Vendors extends HorsesDataProvider
{
    public function getVendors(Request $request)
    {
        $sql = "
            SELECT
                seller_name = bs.seller_name,
                sort_seller_name = UPPER(bs.seller_name),
                total_lots = COUNT(*),
                total_lots_fillies = COUNT(
                    CASE horse_sex
                        WHEN '" . Constants::HORSE_SEX_CODE_FILLY . "' THEN 1
                        ELSE NULL
                    END
                ),
                total_lots_colts = COUNT(
                    CASE horse_sex
                        WHEN '" . Constants::HORSE_SEX_CODE_COLT . "' THEN 1
                        WHEN '" . Constants::HORSE_SEX_CODE_GELDING . "' THEN 1
                        ELSE NULL
                    END
                )
            FROM
                bloodstock_sale bs
            WHERE
                bs.venue_uid = :venueId:
                AND sale_date BETWEEN :startDate: AND :endDate:
            GROUP BY
                seller_name
            ORDER BY
                total_lots DESC,
                sort_seller_name ASC
        ";

        $rtn = $this->query(
            $sql,
            [
                'venueId' => $request->getVenueId(),
                'startDate' => $request->getStartDate(),
                'endDate' => $request->getEndDate()
            ]
        );

        return $rtn->toArrayWithRows();
    }
}
