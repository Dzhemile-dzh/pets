<?php

namespace Tests;

use Phalcon\Exception;

class GetFutureRatingDifferenceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Api\Row\RaceCards\OfficialRating $row
     * @param array                               $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testGetFutureRatingDifference(
        \Api\Row\RaceCards\OfficialRating $row,
        $expectedResult
    ) {

        $this->assertEquals(
            $expectedResult,
            $row->getFutureRatingDifference()
        );
    }

    /**
     * @return array
     */
    public function dataProvider()
    {

        return [
            [
                \Api\Row\RaceCards\OfficialRating::createFromArray(
                    [
                        'diff_or' => null,
                        'extra_weight' => null,
                    ]
                ),
                null
            ],
            [
                \Api\Row\RaceCards\OfficialRating::createFromArray(
                    [
                        'diff_or' => 5,
                        'extra_weight' => null,
                    ]
                ),
                5
            ],
            [
                \Api\Row\RaceCards\OfficialRating::createFromArray(
                    [
                        'diff_or' => null,
                        'extra_weight' => 7,
                    ]
                ),
                null
            ],
            [
                \Api\Row\RaceCards\OfficialRating::createFromArray(
                    [
                        'diff_or' => 0,
                        'extra_weight' => 7,
                    ]
                ),
                -7
            ],
        ];
    }
}
