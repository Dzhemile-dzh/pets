<?php

namespace Tests;

use Phalcon\Exception;

class GetDistanceInFurlongTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Api\Row\RaceInstance $row
     * @param  array                              $expectedResult
     *
     * @dataProvider providerTestGetDistanceInFurlong
     */
    public function testGetDistanceInFurlong(\Api\Row\RaceInstance $row, $expectedResult)
    {

        $this->assertEquals($expectedResult, $row->GetDistanceInFurlong());
    }

    /**
     * @return array
     */
    public function providerTestGetDistanceInFurlong()
    {

        $row1 = new \Api\Row\RaceInstance();
        $row1->distance_yard = 220;

        $row2 = new \Api\Row\RaceInstance();
        $row2->distance_yard = 4180;

        $row3 = new \Api\Row\RaceInstance();
        $row3->distance_yard = 0;

        $row4 = new \Api\Row\RaceInstance();
        $row4->distance_yard = 3608;

        $row5 = new \Api\Row\RaceInstance();
        $row5->distance_yard = 4779;

        $row6 = new \Api\Row\RaceInstance();
        $row6->distance_yard = null;

        $row7 = new \Api\Row\RaceInstance();
        $row7->distance_yard = 2233;

        $row8 = new \Api\Row\RaceInstance();
        $row8->distance_yard = 2332;

        $row9 = new \Api\Row\RaceInstance();
        $row9->distance_yard = 2376;


        return [
            [$row1, 1],
            [$row2, 19],
            [$row3, 0],
            [$row4, 16.5],
            [$row5, 21.5],
            [$row6, null],
            [$row7, 10],
            [$row8, 10.5],
            [$row9, 11],
        ];
    }
}
