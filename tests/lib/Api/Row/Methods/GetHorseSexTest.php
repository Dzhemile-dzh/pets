<?php

namespace Tests;

/**
 * Class GetHorseSexTest
 *
 * @package Tests
 */
class GetHorseSexTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Api\Row\Results\Horse $row
     * @param array                                $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testHorseSex(\Api\Row\Results\Horse $row, $expectedResult)
    {
        $this->assertEquals($expectedResult, $row->getHorseSex());
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [
                \Api\Row\Results\Horse::createFromArray(
                    [
                        'date_gelded' => '2015-05-15',
                        'horse_age' => '7',
                        'race_datetime' => '2015-05-14 02:35PM',
                        'horse_sex_code' => 'G'
                    ]
                ),
                'H'
            ],
            [
                \Api\Row\Results\Horse::createFromArray(
                    [
                        'date_gelded' => '2015-05-15',
                        'horse_age' => '7',
                        'race_datetime' => '2015-05-16 02:35PM',
                        'horse_sex_code' => 'G'
                    ]
                ),
                'G'
            ],
            [
                \Api\Row\Results\Horse::createFromArray(
                    [
                        'date_gelded' => '2015-05-15',
                        'horse_age' => '3',
                        'race_datetime' => '2015-05-16 02:35PM',
                        'horse_sex_code' => 'G'
                    ]
                ),
                'G'
            ],
            [
                \Api\Row\Results\Horse::createFromArray(
                    [
                        'date_gelded' => '2015-05-15',
                        'horse_age' => '3',
                        'race_datetime' => '2015-05-14 02:35PM',
                        'horse_sex_code' => 'G'
                    ]
                ),
                'C'
            ],
            [
                \Api\Row\Results\Horse::createFromArray(
                    [
                        'date_gelded' => null,
                        'horse_age' => '3',
                        'race_datetime' => '2015-05-14 02:35PM',
                        'horse_sex_code' => 'M'
                    ]
                ),
                'F'
            ],
            [
                \Api\Row\Results\Horse::createFromArray(
                    [
                        'date_gelded' => null,
                        'horse_age' => '8',
                        'race_datetime' => '2015-05-14 02:35PM',
                        'horse_sex_code' => 'M'
                    ]
                ),
                'M'
            ],
            [
                \Api\Row\Results\Horse::createFromArray(
                    [
                        'date_gelded' => null,
                        'horse_age' => '8',
                        'race_datetime' => '2015-05-14 02:35PM',
                        'horse_sex_code' => 'R'
                    ]
                ),
                'R'
            ],
        ];
    }
}
