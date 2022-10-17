<?php

namespace tests\lib\Api\Input\Request\Method;

use Api\Input\Request\Horses\Results\Search as Request;

/**
 * Class GetSearchDefaultStartDateTest
 * @package tests\lib\Api\Input\Request\Method
 */
class GetSearchDefaultStartDateTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param Request $request
     * @param string $expected
     *
     * @dataProvider providerGetSearchDefaultStartDate
     */
    public function testGetSearchDefaultStartDate(Request $request, $expected)
    {
        $this->assertEquals($expected, $request->getSearchDefaultStartDate());
    }

    /**
     * @return array
     */
    public function providerGetSearchDefaultStartDate()
    {
        return [
            [
                new Request([], [
                    'startDate' => '2016-10-14',
                    'endDate' => '2016-10-15'
                ]),
                '2016-10-08'
            ],
            [
                new Request([], [
                    'startDate' => '2016-08-11',
                    'endDate' => '2016-08-18'
                ]),
                '2016-08-11'
            ]
        ];
    }
}
