<?php

namespace Tests\Stubs\Models\Bo\JockeyProfile;

use Tests\Stubs\Models\Statistics as Model;
use Tests\Stubs\Models\StubDataGetter;

class Statistics extends Model
{
    use StubDataGetter;

    private static $data;

    private function init()
    {
        self::$data =
            [
                '2011_2012_GB_jumps_distance__13380' => [
                    "OVERALL" => [
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "0-3850",
                            "rides" => 481,
                            "wins" => 55,
                            "place_2nd_number" => 59,
                            "place_3rd_number" => 58,
                            "place_4th_number" => 62,
                            "race_placed" => 145,
                            "percent" => 11,
                            "stakes" => -96.56,
                            "total_prize" => 377378.84,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "3851-4290",
                            "rides" => 111,
                            "wins" => 21,
                            "place_2nd_number" => 11,
                            "place_3rd_number" => 11,
                            "place_4th_number" => 5,
                            "race_placed" => 39,
                            "percent" => 19,
                            "stakes" => -13.83,
                            "total_prize" => 99902.73,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "4291-4950",
                            "rides" => 281,
                            "wins" => 27,
                            "place_2nd_number" => 31,
                            "place_3rd_number" => 29,
                            "place_4th_number" => 34,
                            "race_placed" => 71,
                            "percent" => 10,
                            "stakes" => -140.55,
                            "total_prize" => 171543.68,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "4951-5830",
                            "rides" => 174,
                            "wins" => 23,
                            "place_2nd_number" => 22,
                            "place_3rd_number" => 21,
                            "place_4th_number" => 22,
                            "race_placed" => 55,
                            "percent" => 13,
                            "stakes" => -3.13,
                            "total_prize" => 189454.7,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "5831-null",
                            "rides" => 17,
                            "wins" => 4,
                            "place_2nd_number" => 2,
                            "place_3rd_number" => 3,
                            "place_4th_number" => 1,
                            "race_placed" => 10,
                            "percent" => 24,
                            "stakes" => 45,
                            "total_prize" => 310163.46,
                        ]
                    ],
                    "CHASE" => [
                        (Object)[
                            "category" => "CHASE",
                            "group_id" => null,
                            "group_name" => "0-3850",
                            "rides" => 111,
                            "wins" => 17,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 15,
                            "stakes" => -13.81,
                            "total_prize" => 166189.52,
                        ],
                        (Object)[
                            "category" => "CHASE",
                            "group_id" => null,
                            "group_name" => "3851-4290",
                            "rides" => 40,
                            "wins" => 8,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 20,
                            "stakes" => -1.93,
                            "total_prize" => 47548.83,
                        ],
                        (Object)[
                            "category" => "CHASE",
                            "group_id" => null,
                            "group_name" => "4291-4950",
                            "rides" => 108,
                            "wins" => 10,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 9,
                            "stakes" => -51.75,
                            "total_prize" => 79272.76,
                        ],
                        (Object)[
                            "category" => "CHASE",
                            "group_id" => null,
                            "group_name" => "4951-5830",
                            "rides" => 114,
                            "wins" => 18,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 16,
                            "stakes" => 5.7,
                            "total_prize" => 164081.38,
                        ],
                        (Object)[
                            "category" => "CHASE",
                            "group_id" => null,
                            "group_name" => "5831-null",
                            "rides" => 16,
                            "wins" => 4,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 25,
                            "stakes" => 46,
                            "total_prize" => 310163.46,
                        ]
                    ],
                    "HURDLE" => [
                        (Object)[
                            "category" => "HURDLE",
                            "group_id" => null,
                            "group_name" => "0-3850",
                            "rides" => 308,
                            "wins" => 31,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 10,
                            "stakes" => -60.22,
                            "total_prize" => 187204.2,
                        ],
                        (Object)[
                            "category" => "HURDLE",
                            "group_id" => null,
                            "group_name" => "3851-4290",
                            "rides" => 68,
                            "wins" => 12,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 18,
                            "stakes" => -12.65,
                            "total_prize" => 50642.9,
                        ],
                        (Object)[
                            "category" => "HURDLE",
                            "group_id" => null,
                            "group_name" => "4291-4950",
                            "rides" => 173,
                            "wins" => 17,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 10,
                            "stakes" => -88.8,
                            "total_prize" => 92270.92,
                        ],
                        (Object)[
                            "category" => "HURDLE",
                            "group_id" => null,
                            "group_name" => "4951-5830",
                            "rides" => 60,
                            "wins" => 5,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 8,
                            "stakes" => -8.83,
                            "total_prize" => 25373.32,
                        ],
                        (Object)[
                            "category" => "HURDLE",
                            "group_id" => null,
                            "group_name" => "5831-null",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 0,
                        ]
                    ],
                    "NHF" => [
                        (Object)[
                            "category" => "NHF",
                            "group_id" => null,
                            "group_name" => "0-3850",
                            "rides" => 62,
                            "wins" => 7,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 11,
                            "stakes" => -22.54,
                            "total_prize" => 23985.12,
                        ],
                        (Object)[
                            "category" => "NHF",
                            "group_id" => null,
                            "group_name" => "3851-4290",
                            "rides" => 3,
                            "wins" => 1,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 33,
                            "stakes" => 0.75,
                            "total_prize" => 1711,
                        ]
                    ]
                ],
                '2010_2015_IRE_jumps_course__13380' => [
                    "OVERALL" => [
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => 183,
                            "group_name" => "GALWAY",
                            "rides" => 4,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 1,
                            "place_4th_number" => 0,
                            "race_placed" => 1,
                            "percent" => 0,
                            "stakes" => -4,
                            "total_prize" => 1155,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => 188,
                            "group_name" => "LIMERICK",
                            "rides" => 3,
                            "wins" => 2,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 1,
                            "place_4th_number" => 0,
                            "race_placed" => 2,
                            "percent" => 67,
                            "stakes" => 22,
                            "total_prize" => 30600,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => 190,
                            "group_name" => "LISTOWEL",
                            "rides" => 4,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 1,
                            "race_placed" => 1,
                            "percent" => 0,
                            "stakes" => -4,
                            "total_prize" => 500,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => 203,
                            "group_name" => "KILBEGGAN",
                            "rides" => 2,
                            "wins" => 0,
                            "place_2nd_number" => 1,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 1,
                            "percent" => 0,
                            "stakes" => -2,
                            "total_prize" => 1360,
                        ]
                    ],
                    "CHASE" => [
                        (Object)[
                            "category" => "CHASE",
                            "group_id" => 183,
                            "group_name" => "GALWAY",
                            "rides" => 2,
                            "wins" => 0,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 0,
                            "stakes" => -2,
                            "total_prize" => 0
                        ],
                        (Object)[
                            "category" => "CHASE",
                            "group_id" => 188,
                            "group_name" => "LIMERICK",
                            "rides" => 2,
                            "wins" => 2,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 100,
                            "stakes" => 23,
                            "total_prize" => 28125,
                        ],
                        (Object)[
                            "category" => "CHASE",
                            "group_id" => 190,
                            "group_name" => "LISTOWEL",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 0,
                        ]
                    ],
                    "HURDLE" => [
                        (Object)[
                            "category" => "HURDLE",
                            "group_id" => 183,
                            "group_name" => "GALWAY",
                            "rides" => 2,
                            "wins" => 0,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 0,
                            "stakes" => -2,
                            "total_prize" => 1155,
                        ],
                        (Object)[
                            "category" => "HURDLE",
                            "group_id" => 203,
                            "group_name" => "KILBEGGAN",
                            "rides" => 2,
                            "wins" => 0,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 0,
                            "stakes" => -2,
                            "total_prize" => 1360,
                        ],
                        (Object)[
                            "category" => "HURDLE",
                            "group_id" => 188,
                            "group_name" => "LIMERICK",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 2475,
                        ],
                        (Object)[
                            "category" => "HURDLE",
                            "group_id" => 190,
                            "group_name" => "LISTOWEL",
                            "rides" => 3,
                            "wins" => 0,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 0,
                            "stakes" => -3,
                            "total_prize" => 500,
                        ]
                    ]
                ],
                '2011_2012_GB_flat_month__13380' => [
                    "OVERALL" => [
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "April 2011",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 0,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 0,
                        ]
                    ],
                    "4YO+" => [
                        (Object)[
                            "category" => "4YO+",
                            "group_id" => null,
                            "group_name" => "April 2011",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 0,
                        ]
                    ]
                ],
                '2010_2015_GB_flat_race-type_turf_9482' => [
                    "OVERALL" => [
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "Handicap",
                            "rides" => 3,
                            "wins" => 0,
                            "place_2nd_number" => 2,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 2,
                            "percent" => 0,
                            "stakes" => -3,
                            "total_prize" => 3275.9,
                        ]
                    ],
                    "4YO+" => [
                        (Object)[
                            "category" => "4YO+",
                            "group_id" => null,
                            "group_name" => "Handicap",
                            "rides" => 3,
                            "wins" => 0,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 0,
                            "stakes" => -3,
                            "total_prize" => 3275.9,
                        ]
                    ]
                ],
                '2014_2015_IRE_flat_trainer_aw_championship_91319' => [
                    "OVERALL" => [
                        (Object) [
                            "category" => "OVERALL",
                            "group_id" => 67,
                            "group_name" => "Sir Mark Prescott Bt",
                            "rides" => 1,
                            "wins" => 1,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 1,
                            "percent" => 100,
                            "stakes" => 2,
                            "total_prize" => 0,
                        ],
                        (Object) [
                            "category" => "OVERALL",
                            "group_id" => 29816,
                            "group_name" => "Anthony McCann",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 0,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 0,
                        ]
                    ],
                    "4YO+" => [
                        (Object) [
                            "category" => "4YO+",
                            "group_id" => 67,
                            "group_name" => "Sir Mark Prescott Bt",
                            "rides" => 1,
                            "wins" => 1,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 1,
                            "percent" => 100,
                            "stakes" => 2,
                            "total_prize" => 0,
                        ],
                        (Object) [
                            "category" => "4YO+",
                            "group_id" => 29816,
                            "group_name" => "Anthony McCann",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 0,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 0,
                        ]
                    ]
                ],
            ];
    }

    /**
     * @return mixed
     */
    public function getStatistics(\Api\Input\Request\HorsesRequest $request, \Models\Selectors $selectors)
    {
        if (empty(self::$data)) {
            $this->init();
        }

        return self::$data[self::getRequestKey($request)];
    }
}
