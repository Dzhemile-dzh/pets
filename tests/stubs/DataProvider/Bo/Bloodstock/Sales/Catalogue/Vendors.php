<?php

/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 7/21/2016
 * Time: 3:34 PM
 */

namespace Tests\Stubs\DataProvider\Bo\Bloodstock\Sales\Catalogue;

use Api\DataProvider\HorsesDataProvider;
use Api\Input\Request\Horses\Bloodstock\Sales\CatalogueVendors as Request;
use Phalcon\Mvc\Model\Resultset\General as ResultSet;
use Phalcon\Mvc\Model\Row;

class Vendors extends \Api\DataProvider\Bo\Bloodstock\Sales\Catalogue\Vendors
{
    public function getVendors(Request $request)
    {
        return [
            0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'seller_name' => 'From Wertheimer & Frere',
                    'sort_seller_name' => 'FROM WERTHEIMER & FRERE',
                    'total_lots' => 13,
                    'total_lots_fillies' => 7,
                    'total_lots_colts' => 6,
                ]
            ),
            1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'seller_name' => 'From Pantall',
                    'sort_seller_name' => 'FROM PANTALL',
                    'total_lots' => 12,
                    'total_lots_fillies' => 5,
                    'total_lots_colts' => 7,
                ]
            ),
            2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'seller_name' => 'From Aga Khan Studs',
                    'sort_seller_name' => 'FROM AGA KHAN STUDS',
                    'total_lots' => 9,
                    'total_lots_fillies' => 0,
                    'total_lots_colts' => 9,
                ]
            ),
            3 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'seller_name' => 'From Clement',
                    'sort_seller_name' => 'FROM CLEMENT',
                    'total_lots' => 9,
                    'total_lots_fillies' => 5,
                    'total_lots_colts' => 4,
                ]
            ),
            4 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'seller_name' => 'From Chappet',
                    'sort_seller_name' => 'FROM CHAPPET',
                    'total_lots' => 7,
                    'total_lots_fillies' => 3,
                    'total_lots_colts' => 4,
                ]
            ),
        ];
    }
}
