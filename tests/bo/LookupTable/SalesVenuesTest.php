<?php

namespace Tests\Bo\LookupTable;

use Api\Input\Request\Horses\LookupTable\SalesVenues as Request;
use Phalcon\Mvc\Model\Row\General;
use Tests\Stubs\Bo\LookupTable\SalesVenues as Bo;

/**
 * @package Tests\Bo\LookupTable
 */
class SalesVenues extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider providerTestGetData
     *
     * @param Request $request
     * @param array $expectedResult
     */
    public function testGetData(
        Request $request,
        array $expectedResult
    ) {
        $bo = new Bo($request);
        $this->assertEquals(
            $expectedResult,
            $bo->getData()
        );
    }

    /**
     * @return array
     */
    public function providerTestGetData()
    {
        return [
            [
                new Request([]),
                [
                    General::createFromArray(
                        [
                            "venue_uid" => 1,
                            "venue_desc" => "DBS (GNS)",
                            "currency_code" => "GBG",
                            "country_flag" => "E"
                        ]
                    ),
                    General::createFromArray(
                        [
                            "venue_uid" => 2,
                            "venue_desc" => "BRIGHTWELLS",
                            "currency_code" => "GBP",
                            "country_flag" => "E"
                        ]
                    ),
                    General::createFromArray(
                        [
                            "venue_uid" => 4,
                            "venue_desc" => "TATTERSALLS IRELAND",
                            "currency_code" => "EUR",
                            "country_flag" => "I"
                        ]
                    ),
                ]
            ]
        ];
    }
}
