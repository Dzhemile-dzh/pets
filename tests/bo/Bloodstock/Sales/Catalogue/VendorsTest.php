<?php

/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 7/22/2016
 * Time: 5:00 PM
 */

namespace Tests\Bo\Bloodstock\Sales\Catalogue;

use Api\Input\Request\Horses\Bloodstock\Sales\CatalogueVendors as Request;
use Tests\Stubs\Bo\Bloodstock\Sales;

class VendorsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider providerTestGetVendors
     *
     * @param Request $request
     * @param         $expectedResult
     */
    public function testGetVendors(Request $request, $expectedResult)
    {
        $bo = new Sales($request);
        $this->assertEquals($expectedResult, $bo->getVendors());
    }

    /**
     * @return array
     */
    public function providerTestGetVendors()
    {
        return [
            [
                new Request([], [
                    'venueId' => 36,
                    'startDate' => '2016-07-01',
                    'endDate' => '2016-07-01'
                ]),
                [
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
                ]
            ]
        ];
    }
}
