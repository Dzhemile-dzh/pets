<?php

namespace Tests;

use Phalcon\Exception;
use Api\Row\Results\Horse;

class GetForecastOddsStyleTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param string $input
     * @param string $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testGetForecastOddsStyle($input, $expectedResult)
    {

        $horse = new Horse();
        $this->assertEquals($expectedResult, $horse->forecastOddsStyle($input));
    }

    /**
     * @return array
     */
    public function dataProvider()
    {

        return [
            [
                '110/1',
                '110'
            ],
            [
                '85/2',
                '85-2'
            ],
            [
                '',
                null
            ],
        ];
    }
}
