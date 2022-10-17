<?php

namespace Tests\Bo\Owner;

use Api\Input\Request\Horses\Profile\Owner\SeasonsAvailable;

/**
 * Class SeasonsAvailableTest
 * @package Tests\Bo\Owner
 */
class SeasonsAvailableTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param SeasonsAvailable $request
     * @param array $expectedResult
     * @dataProvider providerTestGetSeasonsAvailable
     */
    public function testGetSeasonsAvailable(
        SeasonsAvailable $request,
        array $expectedResult
    ) {
        $bo = new \Tests\Stubs\Bo\Profile\Owner\SeasonsAvailable($request);

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($bo->getSeasonsAvailable())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetSeasonsAvailable()
    {
        return [
            [
                new SeasonsAvailable(
                    [],
                    [
                        'ownerId' => 80136
                    ]
                ),
                [
                    'FLAT' => [
                        0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'season_type' => 'FLAT',
                                'season_start_date' => 'Jan  1 2017 12:00AM',
                                'season_end_date' => 'Dec 31 2017 11:59PM',
                                'season_desc' => 'Flat 2017',
                                'country_code' => 'GB ',
                            ]
                        )
                    ],
                    'JUMPS' => [
                        0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'season_type' => 'JUMPS',
                                'season_start_date' => 'Apr 26 2015 12:00AM',
                                'season_end_date' => 'Apr 23 2016 11:59PM',
                                'season_desc' => 'NH 2015-2016',
                                'country_code' => 'GB ',
                            ]
                        )
                    ],
                ]
            ]
        ];
    }
}
