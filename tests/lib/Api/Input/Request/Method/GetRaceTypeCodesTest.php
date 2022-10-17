<?php

namespace tests\lib\Api\Input\Request\Method;

use Api\Input\Request\Horses\HorseTracker\Index as Request;

/**
 * Class GetRaceTypeCodesTest
 * @package tests\lib\Api\Input\Request\Method
 */
class GetRaceTypeCodesTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param Request $request
     * @param string[] $expected
     * @throws \Exception
     *
     * @dataProvider providerGetRaceTypeCodes
     */
    public function testGetRaceTypeCodes(Request $request, array $expected)
    {
        $this->assertEquals($expected, $request->getRaceTypeCodes());
    }

    /**
     * @return array
     */
    public function providerGetRaceTypeCodes()
    {
        return [
            [
                new Request([], [
                    'userId' => 1,
                    'raceType' => 'flat',
                    'age' => '4yo'
                ]),
                ['F', 'X']
            ]
        ];
    }
}
