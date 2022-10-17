<?php
namespace Api\DataProvider\Bo\Bloodstock\Sales\Catalogue;

use Api\DataProvider\HorsesDataProvider;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Row\General;

class Index extends HorsesDataProvider
{
    /**
     * @param \Api\Input\Request\Horses\Bloodstock\Sales\Catalogue $request
     *
     * @return General[]
     */
    public function getCatalogue(\Api\Input\Request\Horses\Bloodstock\Sales\Catalogue $request)
    {
        $year = $request->getYear();
        $isToCurrentDate = $request->getLimitToDate();

        $result = $this->query(
            "SELECT
                v.venue_uid
                , sale_name = (CASE WHEN bsd.sale_name IS NULL OR bsd.sale_name = '' THEN v.venue_desc ELSE bsd.sale_name END)
                , bsd.abbrev_name
                , sale_co = v.venue_desc
                , bsd.sale_date
                , sale_end_date = bsd.sale_date
                , total_lots = COUNT(bs.lot_no)
            FROM
                bloodstock_sale_date bsd
            JOIN
                venue v ON bsd.venue_uid = v.venue_uid
            LEFT JOIN
                bloodstock_sale bs ON bs.venue_uid = bsd.venue_uid AND bs.sale_date = bsd.sale_date
            WHERE
                bsd.sale_date BETWEEN :fromDate AND :toDate
            GROUP BY
                v.venue_uid
                , bsd.sale_name
                , bsd.abbrev_name
                , v.venue_desc
                , bsd.sale_date
            ORDER BY
                v.venue_uid, bsd.sale_date
            ",
            [
                'fromDate' => $year . '-01-01 00:00',
                'toDate' => $isToCurrentDate ? date('Y-m-d H:i') : $year . '-12-31 23:59',
            ]
        );

        return $result->toArrayWithRows();
    }
}
