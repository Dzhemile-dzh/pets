<?php

namespace Tests\Bo;

use Api\Row\RaceInstance as RiRow;
use \Phalcon\Mvc\Model\Row\General as GeneralRow;
use Api\Row\OwnerProfile\Owner as OwnerRow;

/**
 * Class OwnerProfileTest
 *
 * @package Tests\Bo
 */
class OwnerProfileTest extends \PHPUnit\Framework\TestCase
{

    /**
     *
     * @dataProvider providerTestGetSinceAWin
     */
    public function testGetSinceAWin(
        \Api\Input\Request\Horses\Profile\Owner\Last14Days $request,
        $expectedResult
    ) {
        $ownerProfile = new \Tests\Stubs\Bo\OwnerProfile($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($ownerProfile->getSinceAWin())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetSinceAWin()
    {
        return [
            [
                new \Api\Input\Request\Horses\Profile\Owner\Last14Days(
                    [],
                    [
                        'ownerId' => 87600
                    ]
                ),
                GeneralRow::createFromArray([
                    'flat' => (Object)[
                        'zenithOfficial' => 90.833333330000002,
                        'race_type' => 'flat',
                        'runs' => 7579,
                        'days' => 4598,
                    ],
                    'jumps' => (Object)[
                        'zenithOfficial' => 90.833333330000002,
                        'race_type' => 'jumps',
                        'runs' => 2,
                        'days' => 1,
                    ]
                ])
            ],
        ];
    }

    /**
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetEntries
     */
    public function testGetEntries(
        \Api\Input\Request\Horses\Profile\Owner\Entries $request,
        array $expectedResult
    ) {
        $ownerProfile = new \Tests\Stubs\Bo\OwnerProfile($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($ownerProfile->getEntries())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetEntries()
    {
        return [
            [
                new \Api\Input\Request\Horses\Profile\Owner\Entries(
                    [],
                    [
                        'ownerId' => 11279
                    ]
                ),
                [
                    (Object)[
                        "race_instance_uid" => 598046,
                        "race_datetime" => "Mar 11 2015  3:20PM",
                        "course_name" => "CHELTENHAM",
                        "course_style_name" => "Cheltenham",
                        "race_instance_title" => "Betway Queen Mother Champion Chase Grade 1",
                        "race_status_code" => "C",
                        "horse_name" => "Finian's Rainbow",
                        "horse_uid" => 702302,
                        "course_uid" => 28,
                        "coures_type_code" => "N",
                        'running_conditions' => null,
                    ],
                    (Object)[
                        "race_instance_uid" => 614837,
                        "race_datetime" => "Mar 12 2015  2:40PM",
                        "course_name" => "CHELTENHAM",
                        "course_style_name" => "Cheltenham",
                        "race_instance_title" => "Ryanair Chase (Registered As The Festival Trophy Steeple Chase) Grade 1",
                        "race_status_code" => "C",
                        "horse_name" => "Finian's Rainbow",
                        "horse_uid" => 702302,
                        "course_uid" => 195,
                        "coures_type_code" => "N",
                        'running_conditions' => null,
                    ],
                    (Object)[
                        "race_instance_uid" => 598076,
                        "race_datetime" => "Mar 12 2015  3:20PM",
                        "course_name" => "CHELTENHAM",
                        "course_style_name" => "Cheltenham",
                        "race_instance_title" => "Ladbrokes World Hurdle Grade 1",
                        "race_status_code" => "C",
                        "horse_name" => "Beat That",
                        "horse_uid" => 830217,
                        "course_uid" => 195,
                        "coures_type_code" => "N",
                        'running_conditions' => null,
                    ],
                    (Object)[
                        "race_instance_uid" => 592366,
                        "race_datetime" => "Jun  6 2015  4:00PM",
                        "course_name" => "EPSOM",
                        "course_style_name" => "Epsom",
                        "race_instance_title" => "Investec Derby (Group 1) (Entire Colts & Fillies)",
                        "race_status_code" => "C",
                        "horse_name" => "Sleight Of Hand",
                        "horse_uid" => 851295,
                        "course_uid" => 195,
                        "coures_type_code" => "N",
                        'running_conditions' => null,
                    ]
                ]
            ],

        ];
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Owner\Statistics $request
     * @param array                                              $expectedResult
     *
     * @dataProvider providerTestGetStatistics
     */
    public function testGetStatistics(
        \Api\Input\Request\Horses\Profile\Owner\Statistics $request,
        array $expectedResult
    ) {
        $ownerProfileObject = new \Tests\Stubs\Bo\OwnerProfile($request);

        $result = $ownerProfileObject->getStatistics();

        $this->assertEquals($result, $expectedResult);
    }

    /**
     * @param StatisticsRequest $request
     *
     * @return array
     */
    public function providerTestGetStatistics($request)
    {

        return [
            [
                new \Api\Input\Request\Horses\Profile\Owner\Statistics(
                    [
                        2012,
                        2012,
                        "GB",
                        "flat",
                        "trainer",
                        'turf',
                    ],
                    [
                        'ownerId' => 11279
                    ]
                ),
                [
                    "OVERALL" => (Object)[
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => 18734,
                            "group_name" => "Harry Dunlop",
                            "rides" => 3,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 1,
                            "race_placed" => 0,
                            "percent" => 0,
                            "stakes" => -3,
                            "total_prize" => 1876,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => 13955,
                            "group_name" => "Jamie Osborne",
                            "rides" => 3,
                            "wins" => 0,
                            "place_2nd_number" => 1,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 2,
                            "race_placed" => 1,
                            "percent" => 0,
                            "stakes" => -3,
                            "total_prize" => 1756,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => 7221,
                            "group_name" => "Brian Meehan",
                            "rides" => 4,
                            "wins" => 0,
                            "place_2nd_number" => 1,
                            "place_3rd_number" => 1,
                            "place_4th_number" => 1,
                            "race_placed" => 2,
                            "percent" => 0,
                            "stakes" => -4,
                            "total_prize" => 1972.7,
                        ]
                    ],
                    "3YO" => [
                        (Object)[
                            "category" => "3YO",
                            "group_id" => 13955,
                            "group_name" => "Jamie Osborne",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 1,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 1,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 673.75,
                        ],
                        (Object)[
                            "category" => "3YO",
                            "group_id" => 18734,
                            "group_name" => "Harry Dunlop",
                            "rides" => 3,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 1,
                            "race_placed" => 0,
                            "percent" => 0,
                            "stakes" => -3,
                            "total_prize" => 1876,
                        ]
                    ],
                    "2YO" => [
                        (Object)[
                            "category" => "2YO",
                            "group_id" => 13955,
                            "group_name" => "Jamie Osborne",
                            "rides" => 2,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 2,
                            "race_placed" => 0,
                            "percent" => 0,
                            "stakes" => -2,
                            "total_prize" => 1082.25,
                        ],
                        (Object)[
                            "category" => "2YO",
                            "group_id" => 7221,
                            "group_name" => "Brian Meehan",
                            "rides" => 4,
                            "wins" => 0,
                            "place_2nd_number" => 1,
                            "place_3rd_number" => 1,
                            "place_4th_number" => 1,
                            "race_placed" => 2,
                            "percent" => 0,
                            "stakes" => -4,
                            "total_prize" => 1972.7,
                        ]
                    ]
                ],
            ],
            [
                new \Api\Input\Request\Horses\Profile\Owner\Statistics(
                    [
                        2014,
                        2015,
                        "IRE",
                        "jumps",
                        "month",
                        null,
                    ],
                    [
                        'ownerId' => 11279
                    ]
                ),
                [
                    "OVERALL" => [
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "November 2014",
                            "rides" => 2,
                            "wins" => 1,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 1,
                            "place_4th_number" => 0,
                            "race_placed" => 1,
                            "percent" => 50,
                            "stakes" => 1.75,
                            "total_prize" => 13035,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "December 2014",
                            "rides" => 2,
                            "wins" => 1,
                            "place_2nd_number" => 1,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 2,
                            "percent" => 50,
                            "stakes" => -0.27,
                            "total_prize" => 15290,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "January 2015",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 0,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 0,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "April 2015",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 0,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 0,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "May 2015",
                            "rides" => 3,
                            "wins" => 1,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 1,
                            "percent" => 33,
                            "stakes" => -0.38,
                            "total_prize" => 8590,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "June 2015",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 1,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 1,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 2400,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "July 2015",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 1,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 1,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 4275,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "September 2015",
                            "rides" => 2,
                            "wins" => 1,
                            "place_2nd_number" => 1,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 2,
                            "percent" => 50,
                            "stakes" => 0.1,
                            "total_prize" => 23680,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "November 2015",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 1,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 1,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 1440,
                        ]
                    ],
                    "CHASE" => [
                        (Object)[
                            "category" => "CHASE",
                            "group_id" => null,
                            "group_name" => "May 2015",
                            "rides" => 1,
                            "wins" => 1,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 1,
                            "percent" => 100,
                            "stakes" => 1.63,
                            "total_prize" => 7590,
                        ],
                        (Object)[
                            "category" => "CHASE",
                            "group_id" => null,
                            "group_name" => "June 2015",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 1,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 1,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 2400,
                        ],
                        (Object)[
                            "category" => "CHASE",
                            "group_id" => null,
                            "group_name" => "July 2015",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 1,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 1,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 4275,
                        ],
                        (Object)[
                            "category" => "CHASE",
                            "group_id" => null,
                            "group_name" => "September 2015",
                            "rides" => 2,
                            "wins" => 1,
                            "place_2nd_number" => 1,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 2,
                            "percent" => 50,
                            "stakes" => 0.1,
                            "total_prize" => 23680,
                        ]
                    ],
                    "HURDLE" => [
                        (Object)[
                            "category" => "HURDLE",
                            "group_id" => null,
                            "group_name" => "November 2014",
                            "rides" => 2,
                            "wins" => 1,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 1,
                            "place_4th_number" => 0,
                            "race_placed" => 1,
                            "percent" => 50,
                            "stakes" => 1.75,
                            "total_prize" => 13035,
                        ],
                        (Object)[
                            "category" => "HURDLE",
                            "group_id" => null,
                            "group_name" => "December 2014",
                            "rides" => 2,
                            "wins" => 1,
                            "place_2nd_number" => 1,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 2,
                            "percent" => 50,
                            "stakes" => -0.27,
                            "total_prize" => 15290,
                        ],
                        (Object)[
                            "category" => "HURDLE",
                            "group_id" => null,
                            "group_name" => "January 2015",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 0,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 0,
                        ],
                        (Object)[
                            "category" => "HURDLE",
                            "group_id" => null,
                            "group_name" => "May 2015",
                            "rides" => 2,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 0,
                            "percent" => 0,
                            "stakes" => -2,
                            "total_prize" => 1000,
                        ]
                    ],
                    "NHF" => [
                        (Object)[
                            "category" => "NHF",
                            "group_id" => null,
                            "group_name" => "April 2015",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 0,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 0,
                        ],
                        (Object)[
                            "category" => "NHF",
                            "group_id" => null,
                            "group_name" => "November 2015",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 1,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 1,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 1440,
                        ]
                    ]
                ],
            ],
            [
                new \Api\Input\Request\Horses\Profile\Owner\Statistics(
                    [
                        2011,
                        2012,
                        "IRE",
                        "jumps",
                        "horse",
                        null
                    ],
                    [
                        'ownerId' => 11279
                    ]
                ),
                [
                    "OVERALL" => [
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => 803559,
                            "group_name" => "Operating",
                            "rides" => 6,
                            "wins" => 2,
                            "place_2nd_number" => 2,
                            "place_3rd_number" => 1,
                            "place_4th_number" => 1,
                            "race_placed" => 5,
                            "percent" => 33,
                            "stakes" => -1.68,
                            "total_prize" => 19730,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => 830217,
                            "group_name" => "Beat That",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 0,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 0,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => 834415,
                            "group_name" => "Rock The World",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 1,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 1,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 1440,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => 795325,
                            "group_name" => "Soliwery",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 0,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 0,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => 766800,
                            "group_name" => "Mystic Desir",
                            "rides" => 9,
                            "wins" => 0,
                            "place_2nd_number" => 2,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 1,
                            "race_placed" => 2,
                            "percent" => 0,
                            "stakes" => -9,
                            "total_prize" => 3600,
                        ]
                    ],
                    "NHF" => [
                        (Object)[
                            "category" => "NHF",
                            "group_id" => 803559,
                            "group_name" => "Operating",
                            "rides" => 1,
                            "wins" => 1,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 1,
                            "percent" => 100,
                            "stakes" => 0.57,
                            "total_prize" => 5520,
                        ],
                        (Object)[
                            "category" => "NHF",
                            "group_id" => 830217,
                            "group_name" => "Beat That",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 0,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 0,
                        ],
                        (Object)[
                            "category" => "NHF",
                            "group_id" => 834415,
                            "group_name" => "Rock The World",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 1,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 1,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 1440,
                        ]
                    ],
                    "HURDLE" => [
                        (Object)[
                            "category" => "HURDLE",
                            "group_id" => 803559,
                            "group_name" => "Operating",
                            "rides" => 5,
                            "wins" => 1,
                            "place_2nd_number" => 2,
                            "place_3rd_number" => 1,
                            "place_4th_number" => 1,
                            "race_placed" => 4,
                            "percent" => 20,
                            "stakes" => -2.25,
                            "total_prize" => 14210,
                        ],
                        (Object)[
                            "category" => "HURDLE",
                            "group_id" => 795325,
                            "group_name" => "Soliwery",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 0,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 0,
                        ],
                        (Object)[
                            "category" => "HURDLE",
                            "group_id" => 766800,
                            "group_name" => "Mystic Desir",
                            "rides" => 9,
                            "wins" => 0,
                            "place_2nd_number" => 2,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 1,
                            "race_placed" => 2,
                            "percent" => 0,
                            "stakes" => -9,
                            "total_prize" => 3600,
                        ]
                    ]
                ],
            ],
            [
                new \Api\Input\Request\Horses\Profile\Owner\Statistics(
                    [
                        2014,
                        2014,
                        "GB",
                        "flat",
                        "distance",
                        "aw",
                    ],
                    [
                        'ownerId' => 11279
                    ]
                ),
                [
                    "OVERALL" => [
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "1651-2090",
                            "rides" => 8,
                            "wins" => 2,
                            "place_2nd_number" => 3,
                            "place_3rd_number" => 2,
                            "place_4th_number" => 0,
                            "race_placed" => 6,
                            "percent" => 25,
                            "stakes" => -0.75,
                            "total_prize" => 0,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "2091-2530",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 1,
                            "race_placed" => 0,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 0,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "2531-2970",
                            "rides" => 3,
                            "wins" => 2,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 2,
                            "percent" => 67,
                            "stakes" => 7.5,
                            "total_prize" => 0,
                        ]
                    ],
                    "2YO" => [
                        (Object)[
                            "category" => "2YO",
                            "group_id" => null,
                            "group_name" => "1651-2090",
                            "rides" => 4,
                            "wins" => 1,
                            "place_2nd_number" => 1,
                            "place_3rd_number" => 1,
                            "place_4th_number" => 0,
                            "race_placed" => 2,
                            "percent" => 25,
                            "stakes" => -0.5,
                            "total_prize" => 0,
                        ]
                    ],
                    "3YO" => [
                        (Object)[
                            "category" => "3YO",
                            "group_id" => null,
                            "group_name" => "1651-2090",
                            "rides" => 4,
                            "wins" => 1,
                            "place_2nd_number" => 2,
                            "place_3rd_number" => 1,
                            "place_4th_number" => 0,
                            "race_placed" => 4,
                            "percent" => 25,
                            "stakes" => -0.25,
                            "total_prize" => 0,
                        ],
                        (Object)[
                            "category" => "3YO",
                            "group_id" => null,
                            "group_name" => "2091-2530",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 1,
                            "race_placed" => 0,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 0,
                        ],
                        (Object)[
                            "category" => "3YO",
                            "group_id" => null,
                            "group_name" => "2531-2970",
                            "rides" => 3,
                            "wins" => 2,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 2,
                            "percent" => 67,
                            "stakes" => 7.5,
                            "total_prize" => 0,
                        ]
                    ]
                ],
            ],
            [
                new \Api\Input\Request\Horses\Profile\Owner\Statistics(
                    [],
                    [
                        'ownerId' => 50036
                    ]
                ),
                [
                    "OVERALL" => (Object)[
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => 39,
                            "group_name" => "Newton Abbot",
                            "rides" => 3,
                            "wins" => 1,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 2,
                            "place_4th_number" => 0,
                            "race_placed" => 2,
                            "percent" => 33,
                            "stakes" => -0.5,
                            "total_prize" => 1400,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => 67,
                            "group_name" => "Stratford",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 0,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 1972,
                        ]
                    ],
                    "CHASE" => (Object)[
                        (Object)[
                            "category" => "CHASE",
                            "group_id" => 39,
                            "group_name" => "Newton Abbot",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 1,
                            "place_4th_number" => 0,
                            "race_placed" => 0,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 0,
                        ],
                        (Object)[
                            "category" => "CHASE",
                            "group_id" => 67,
                            "group_name" => "Stratford",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 0,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 3600,
                        ]
                    ],
                    "HURDLE" => (Object)[
                        (Object)[
                            "category" => "HURDLE",
                            "group_id" => 39,
                            "group_name" => "Newton Abbot",
                            "rides" => 2,
                            "wins" => 1,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 1,
                            "place_4th_number" => 0,
                            "race_placed" => 2,
                            "percent" => 50,
                            "stakes" => 0.5,
                            "total_prize" => 26300,
                        ]
                    ]
                ]
            ],
        ];
    }

    /**
     *
     * @dataProvider providerTestGetBigRaceWins
     */
    public function testGetBigRaceWins(
        \Api\Input\Request\Horses\Profile\Owner\BigRaceWins $request,
        array $expectedResult
    ) {
        $ownerProfile = new \Tests\Stubs\Bo\OwnerProfile($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($ownerProfile->getBigRaceWins())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetBigRaceWins()
    {
        return [
            [
                new \Api\Input\Request\Horses\Profile\Owner\BigRaceWins(
                    [],
                    [
                        'ownerId' => 11234
                    ]
                ),
                array(
                    0 =>
                        RiRow::createFromArray(array(
                            'race_date' => 'Feb 26 2017  4:20PM',
                            'rp_abbrev_3' => 'NAA',
                            'country' => 'IRE',
                            'distance_yard' => 3520,
                            'race_instance_uid' => 669615,
                            'race_instance_title' => 'We Show All Live Racing Chase (Grade 3)',
                            'course_name' => 'NAAS',
                            'course_style_name' => 'Naas',
                            'trainer_short_name' => 'H De Bromhead',
                            'trainer_ptp_type_code' => 'N',
                            'prize_sterling' => 24358.970000000001,
                            'prize_euro' => 28500,
                            'days_diff' => 235,
                            'race_outcome_code' => '1',
                            'race_outcome_position' => 1,
                            'disq_desc' => null,
                            'horse_style_name' => 'Alisier D\'Irlande',
                            'country_origin_code' => 'FR',
                            'horse_uid' => 857888,
                            'trainer_style_name' => 'Henry De Bromhead',
                            'trainer_uid' => 1249,
                            'race_type_code' => 'C',
                            'race_group_desc' => 'Grade 3',
                            'race_group_code' => '9',
                            'course_uid' => 192,
                            'course_type_code' => 'B',
                            'video_detail' =>
                                array(
                                    0 =>
                                        GeneralRow::createFromArray(array(
                                            'race_instance_uid' => 669615,
                                            'ptv_video_id' => 184110,
                                            'video_provider' => 'ATR',
                                            'complete_race_uid' => 248,
                                            'complete_race_start' => 0,
                                            'complete_race_end' => 1,
                                            'finish_race_uid' => 248,
                                            'finish_race_start' => 0,
                                            'finish_race_end' => 1,
                                        )),
                                ),
                        )),
                    1 =>
                        RiRow::createFromArray(array(
                            'race_date' => 'Jan 29 2017  2:30PM',
                            'rp_abbrev_3' => 'LEO',
                            'country' => 'IRE',
                            'distance_yard' => 3740,
                            'race_instance_uid' => 667040,
                            'race_instance_title' => 'Frank Ward Solicitors Arkle Novice Chase (Grade 1)',
                            'course_name' => 'LEOPARDSTOWN',
                            'course_style_name' => 'Leopardstown',
                            'trainer_short_name' => 'H De Bromhead',
                            'trainer_ptp_type_code' => 'N',
                            'prize_sterling' => 46153.849999999999,
                            'prize_euro' => 54000,
                            'days_diff' => 263,
                            'race_outcome_code' => '1',
                            'race_outcome_position' => 1,
                            'disq_desc' => null,
                            'horse_style_name' => 'Some Plan',
                            'country_origin_code' => 'IRE',
                            'horse_uid' => 847746,
                            'trainer_style_name' => 'Henry De Bromhead',
                            'trainer_uid' => 1249,
                            'race_type_code' => 'C',
                            'race_group_desc' => 'Grade 1',
                            'race_group_code' => '7',
                            'course_uid' => 187,
                            'course_type_code' => 'B',
                            'video_detail' =>
                                array(
                                    0 =>
                                        GeneralRow::createFromArray(array(
                                            'race_instance_uid' => 667040,
                                            'ptv_video_id' => 177336,
                                            'video_provider' => 'ATR',
                                            'complete_race_uid' => 248,
                                            'complete_race_start' => 0,
                                            'complete_race_end' => 1,
                                            'finish_race_uid' => 248,
                                            'finish_race_start' => 0,
                                            'finish_race_end' => 1,
                                        )),
                                ),
                        )),
                )
            ],
        ];
    }

    /**
     *
     * @dataProvider providerTestGetLast14Days
     */
    public function testGetLast14Days(
        \Api\Input\Request\Horses\Profile\Owner\Last14Days $request,
        array $expectedResult
    ) {
        $ownerProfile = new \Tests\Stubs\Bo\OwnerProfile($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($ownerProfile->getLast14Days())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetLast14Days()
    {
        return [
            [
                new \Api\Input\Request\Horses\Profile\Owner\Last14Days(
                    [],
                    [
                        'ownerId' => 11234
                    ]
                ),
                array(
                    0 =>
                        RiRow::createFromArray(array(
                            'race_instance_uid' => 684474,
                            'race_datetime' => 'Oct 14 2017  3:35PM',
                            'course_uid' => 12,
                            'race_instance_title' => 'Paul Ferguson\'s Jumpers To Follow Hurdle (A Limited Handicap)',
                            'race_type_code' => 'H',
                            'distance_yard' => 3531,
                            'horse_uid' => 890420,
                            'horse_style_name' => 'Champagne City',
                            'horse_country_origin_code' => 'GB',
                            'weight_carried_lbs' => 152,
                            'rp_betting_movements' => 'tchd 15/2',
                            'course_rp_abbrev_3' => 'CHP',
                            'course_rp_abbrev_4' => 'Chep',
                            'course_name' => 'CHEPSTOW',
                            'course_style_name' => 'Chepstow',
                            'course_type_code' => 'B',
                            'course_code' => 'CHEP',
                            'first_time_yn' => null,
                            'rp_postmark_difference' => -18,
                            'race_outcome_code' => '7',
                            'odds_value' => 7,
                            'trainer_short_name' => 'T George',
                            'trainer_ptp_type_code' => 'N',
                            'going_type_services_desc' => 'GS',
                            'prize_sterling' => 12996,
                            'prize_euro' => 0,
                            'race_outcome_position' => 7,
                            'no_of_runners' => 10,
                            'rp_close_up_comment' => 'badly hampered 1st, behind, effort on outside and in touch before 5th, weakened next',
                            'rp_horse_head_gear_code' => null,
                            'odds_desc' => '7/1',
                            'trainer_uid' => 8036,
                            'trainer_style_name' => 'Tom George',
                            'rp_postmark' => 107,
                            'rp_pre_postmark' => 125,
                            'actual_race_class' => '2',
                            'rp_ages_allowed_desc' => '4yo',
                            'race_group_code' => 'H',
                            'race_group_desc' => 'Handicap',
                            'race_output_order' => 7,
                            'orig_race_output_order' => 7,
                            'dtw_rp_distance_desc' => null,
                            'dtw_sum_distance_value' => 35,
                            'dtw_count_horse_race' => 0,
                            'dtw_total_distance_value' => 38.75,
                            'video_detail' =>
                                array(
                                    0 =>
                                        GeneralRow::createFromArray(array(
                                            'race_instance_uid' => 684474,
                                            'ptv_video_id' => 247149,
                                            'video_provider' => 'ATR',
                                            'complete_race_uid' => 248,
                                            'complete_race_start' => 0,
                                            'complete_race_end' => 1,
                                            'finish_race_uid' => 248,
                                            'finish_race_start' => 0,
                                            'finish_race_end' => 1,
                                        )),
                                ),
                        )),
                    1 =>
                        RiRow::createFromArray(array(
                            'race_instance_uid' => 686289,
                            'race_datetime' => 'Oct 13 2017  2:50PM',
                            'course_uid' => 179,
                            'race_instance_title' => 'I.N.H. Stallion Owners EBF Maiden Hurdle',
                            'race_type_code' => 'H',
                            'distance_yard' => 4950,
                            'horse_uid' => 978937,
                            'horse_style_name' => 'Whispering Affair',
                            'horse_country_origin_code' => 'GB',
                            'weight_carried_lbs' => 151,
                            'rp_betting_movements' => null,
                            'course_rp_abbrev_3' => 'DPT',
                            'course_rp_abbrev_4' => 'Dpat',
                            'course_name' => 'DOWNPATRICK',
                            'course_style_name' => 'Downpatrick',
                            'course_type_code' => 'B',
                            'course_code' => 'DOWN',
                            'first_time_yn' => null,
                            'rp_postmark_difference' => 6,
                            'race_outcome_code' => '2',
                            'odds_value' => 25,
                            'trainer_short_name' => 'S Crawford',
                            'trainer_ptp_type_code' => 'N',
                            'going_type_services_desc' => 'Y',
                            'prize_sterling' => 7478.6300000000001,
                            'prize_euro' => 8750,
                            'race_outcome_position' => 2,
                            'no_of_runners' => 9,
                            'rp_close_up_comment' => 'close up early until soon settled behind leaders, disputed close 4th 4 out, pushed along into 2nd after 2 out and no impression on easy winner before last, kept on well run-in',
                            'rp_horse_head_gear_code' => null,
                            'odds_desc' => '25/1',
                            'trainer_uid' => 16596,
                            'trainer_style_name' => 'S R B Crawford',
                            'rp_postmark' => 109,
                            'rp_pre_postmark' => 103,
                            'actual_race_class' => null,
                            'rp_ages_allowed_desc' => '5yo+',
                            'race_group_code' => '0',
                            'race_group_desc' => 'Unknown',
                            'race_output_order' => 2,
                            'orig_race_output_order' => 2,
                            'dtw_rp_distance_desc' => '3',
                            'dtw_sum_distance_value' => 3,
                            'dtw_count_horse_race' => 0,
                            'dtw_total_distance_value' => 121.25,
                            'video_detail' =>
                                array(
                                    0 =>
                                        GeneralRow::createFromArray(array(
                                            'race_instance_uid' => 686289,
                                            'ptv_video_id' => 246823,
                                            'video_provider' => 'ATR',
                                            'complete_race_uid' => 248,
                                            'complete_race_start' => 0,
                                            'complete_race_end' => 1,
                                            'finish_race_uid' => 248,
                                            'finish_race_start' => 0,
                                            'finish_race_end' => 1,
                                        )),
                                ),
                        )),
                )
            ],
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Owner\Index $request
     * @param                                               $expectedResult
     *
     * @dataProvider providerTestGetOwner
     */
    public function testGetOwner(
        \Api\Input\Request\Horses\Profile\Owner\Index $request,
        $expectedResult
    ) {
        $ownerProfileObject = new \Tests\Stubs\Bo\OwnerProfile($request);
        $result = $ownerProfileObject->getOwner();

        $this->assertEquals($result, $expectedResult);
    }

    /**
     * @return array
     */
    public function providerTestGetOwner()
    {
        return [
            [
                new \Api\Input\Request\Horses\Profile\Owner\Index(
                    [],
                    [
                        'ownerId' => 8295
                    ]
                ),
                GeneralRow::createFromArray(
                    [
                        "owner_uid" => 8295,
                        "owner_name" => " MRS S L HOBBS",
                        "ptp_type_code" => "N",
                        "silk" => "white and yellow stripes, yellow sleeves and cap.",
                        "style_name" => " Mrs S L Hobbs",
                        "silk_image_path" => "5/9/2/8295",
                        "owner_last_14_days" => \Api\Row\WinsRuns::createFromArray(
                            [
                                'runs' => 5,
                                'wins' => 1,
                            ]
                        ),
                        'since_a_win' => (Object)[
                            'flat' => (Object)[
                                'zenithOfficial' => 90.833333330000002,
                                'race_type' => 'flat',
                                'runs' => 7579,
                                'days' => 4598,
                            ],
                            'jumps' => (Object)[
                                'zenithOfficial' => 90.833333330000002,
                                'race_type' => 'jumps',
                                'runs' => 2,
                                'days' => 1,
                            ],
                        ]
                    ]
                )
            ]
        ];
    }

    /**
     * @param \Api\Input\Request\HorsesRequest $request
     * @param array                            $expectedResult
     *
     * @dataProvider providerTestGetSeasonDefaultValues
     */
    public function testGetSeasonDefaultValues(
        $request,
        array $expectedResult
    ) {
        $bo = new \Tests\Stubs\Bo\OwnerProfile($request);

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($bo->getSeasonDefaultValues())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetSeasonDefaultValues()
    {
        return [
            [
                new \Api\Input\Request\Horses\Profile\Owner\StatisticalSummary(
                    [],
                    [
                        'ownerId' => 11279
                    ]
                ),
                [
                    'raceType' => 'flat',
                    'countryCode' => 'GB'
                ]
            ],

        ];
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Owner\Results $request
     * @param array                                           $expectedResult
     *
     * @dataProvider providerTestGetResults
     */
    public function testGetResults(
        \Api\Input\Request\Horses\Profile\Owner\Results $request,
        array $expectedResult
    ) {
        $bo = new \Tests\Stubs\Bo\OwnerProfile($request);

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($bo->getResults())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetResults()
    {
        return [
            [
                new \Api\Input\Request\Horses\Profile\Owner\Results(
                    [
                        'ownerId' => 25289
                    ],
                    [
                        '2016'
                    ]
                ),
                array(
                    649705 =>
                        OwnerRow::createFromArray(array(
                            'race_datetime' => 'Apr 25 2016  4:50PM',
                            'rp_abbrev_3' => 'AYR',
                            'country_code' => 'GB ',
                            'distance_yard' => 1760,
                            'race_instance_uid' => 649705,
                            'race_instance_title' => 'Conference And Events At Ayr Racecourse Handicap (Div II)',
                            'course_style_name' => 'Ayr',
                            'trainer_short_name' => 'A Whillans',
                            'trainer_ptp_type_code' => 'N',
                            'horse_style_name' => 'Galilee Chapel',
                            'country_origin_code' => 'IRE',
                            'horse_uid' => 784622,
                            'prize_sterling' => 0,
                            'prize_euro' => 0,
                            'days_diff' => 547,
                            'race_outcome_code' => '9',
                            'race_outcome_position' => 9,
                            'disq_desc' => null,
                            'trainer_style_name' => 'Alistair Whillans',
                            'trainer_uid' => 4180,
                            'race_type_code' => 'F',
                            'race_group_desc' => 'Handicap',
                            'race_group_code' => 'H',
                            'course_uid' => 3,
                            'course_type_code' => 'B',
                            'video_detail' =>
                                array(
                                    0 =>
                                        GeneralRow::createFromArray(array(
                                            'race_instance_uid' => 649705,
                                            'ptv_video_id' => 1124581,
                                            'video_provider' => 'RUK',
                                            'complete_race_uid' => 2593347,
                                            'complete_race_start' => 506,
                                            'complete_race_end' => 700,
                                            'finish_race_uid' => 2593368,
                                            'finish_race_start' => 572,
                                            'finish_race_end' => 631,
                                        )),
                                ),
                        )),
                    647800 =>
                        OwnerRow::createFromArray(array(
                            'race_datetime' => 'May  1 2016  5:05PM',
                            'rp_abbrev_3' => 'HAM',
                            'country_code' => 'GB ',
                            'distance_yard' => 1828,
                            'race_instance_uid' => 647800,
                            'race_instance_title' => 'Jordan Electrics Handicap',
                            'course_style_name' => 'Hamilton',
                            'trainer_short_name' => 'A Whillans',
                            'trainer_ptp_type_code' => 'N',
                            'horse_style_name' => 'Gun Case',
                            'country_origin_code' => 'GB',
                            'horse_uid' => 866896,
                            'prize_sterling' => 0,
                            'prize_euro' => 0,
                            'days_diff' => 541,
                            'race_outcome_code' => '9',
                            'race_outcome_position' => 9,
                            'disq_desc' => null,
                            'trainer_style_name' => 'Alistair Whillans',
                            'trainer_uid' => 4180,
                            'race_type_code' => 'F',
                            'race_group_desc' => 'Handicap',
                            'race_group_code' => 'H',
                            'course_uid' => 22,
                            'course_type_code' => 'F',
                            'video_detail' =>
                                array(
                                    0 =>
                                        GeneralRow::createFromArray(array(
                                            'race_instance_uid' => 647800,
                                            'ptv_video_id' => 1126993,
                                            'video_provider' => 'RUK',
                                            'complete_race_uid' => 2594970,
                                            'complete_race_start' => 316,
                                            'complete_race_end' => 555,
                                            'finish_race_uid' => 2594971,
                                            'finish_race_start' => 389,
                                            'finish_race_end' => 440,
                                        )),
                                ),
                        )),
                )
            ]
        ];
    }
}
