<?php

use Api\Input\Request\Horses\Bloodstock\Stallion as Request;

return [
    [
        new Request\ProgenyStatistics([], ['stallionId' => 531769]),
        (Object)(array(
            'current_year' =>
                array(
                    0 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Worldwide G1',
                                'no_of_wins' => 7,
                                'no_of_runs' => 40,
                                'no_of_2nds' => 5,
                                'no_of_3rds' => 5,
                                'no_of_winners' => 4,
                                'no_of_runners' => 24,
                                'win_prize_money' => 1395213.21,
                                'total_prize_money' => 3943523.8399999999,
                                'section_name' => 'current_year',
                                'broodmare_category' => false,
                            )
                        ),
                    1 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Euro Stakes',
                                'no_of_wins' => 19,
                                'no_of_runs' => 109,
                                'no_of_2nds' => 14,
                                'no_of_3rds' => 14,
                                'no_of_winners' => 16,
                                'no_of_runners' => 58,
                                'win_prize_money' => 1751179.8999999999,
                                'total_prize_money' => 3242533.0899999999,
                                'section_name' => 'current_year',
                                'broodmare_category' => false,
                            )
                        ),
                ),
            '2000_to_date' => null,
            '1988_to_date' =>
                array(
                    0 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Flat',
                                'no_of_wins' => 1309,
                                'no_of_runs' => 7985,
                                'no_of_2nds' => 1029,
                                'no_of_3rds' => 959,
                                'no_of_winners' => 656,
                                'no_of_runners' => 1019,
                                'win_prize_money' => 38960099.859999999,
                                'total_prize_money' => 58760297.479999997,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    1 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Turf',
                                'no_of_wins' => 1103,
                                'no_of_runs' => 6601,
                                'no_of_2nds' => 864,
                                'no_of_3rds' => 812,
                                'no_of_winners' => 573,
                                'no_of_runners' => 991,
                                'win_prize_money' => 37972844.619999997,
                                'total_prize_money' => 57340435.990000002,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    2 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'All-weather',
                                'no_of_wins' => 206,
                                'no_of_runs' => 1384,
                                'no_of_2nds' => 165,
                                'no_of_3rds' => 147,
                                'no_of_winners' => 159,
                                'no_of_runners' => 494,
                                'win_prize_money' => 987255.23999999999,
                                'total_prize_money' => 1419861.49,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    3 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Jumps',
                                'no_of_wins' => 264,
                                'no_of_runs' => 2148,
                                'no_of_2nds' => 227,
                                'no_of_3rds' => 262,
                                'no_of_winners' => 116,
                                'no_of_runners' => 234,
                                'win_prize_money' => 1806252.5800000001,
                                'total_prize_money' => 2896118.8999999999,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    4 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'NHF',
                                'no_of_wins' => 20,
                                'no_of_runs' => 83,
                                'no_of_2nds' => 10,
                                'no_of_3rds' => 11,
                                'no_of_winners' => 13,
                                'no_of_runners' => 36,
                                'win_prize_money' => 101304.56,
                                'total_prize_money' => 126340.02,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    5 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => '2yo',
                                'no_of_wins' => 276,
                                'no_of_runs' => 1426,
                                'no_of_2nds' => 194,
                                'no_of_3rds' => 178,
                                'no_of_winners' => 206,
                                'no_of_runners' => 613,
                                'win_prize_money' => 6941415.0099999998,
                                'total_prize_money' => 9100578.6099999994,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    6 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Broodmare sires',
                                'no_of_wins' => 528,
                                'no_of_runs' => 3887,
                                'no_of_2nds' => 502,
                                'no_of_3rds' => 476,
                                'no_of_winners' => 256,
                                'no_of_runners' => 433,
                                'win_prize_money' => 6726694.25,
                                'total_prize_money' => 10449481.140000001,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => true,
                            )
                        ),
                    7 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => '5-6f',
                                'no_of_wins' => 14,
                                'no_of_runs' => 129,
                                'no_of_2nds' => 12,
                                'no_of_3rds' => 20,
                                'no_of_winners' => 11,
                                'no_of_runners' => 86,
                                'win_prize_money' => 189527.81,
                                'total_prize_money' => 256384.73000000001,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    8 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => '7-9f',
                                'no_of_wins' => 507,
                                'no_of_runs' => 2865,
                                'no_of_2nds' => 374,
                                'no_of_3rds' => 340,
                                'no_of_winners' => 339,
                                'no_of_runners' => 833,
                                'win_prize_money' => 17399550.93,
                                'total_prize_money' => 24082022.420000002,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    9 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => '10-11f',
                                'no_of_wins' => 377,
                                'no_of_runs' => 2217,
                                'no_of_2nds' => 299,
                                'no_of_3rds' => 269,
                                'no_of_winners' => 278,
                                'no_of_runners' => 730,
                                'win_prize_money' => 9470876.75,
                                'total_prize_money' => 14881540.24,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    10 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => '12-13f',
                                'no_of_wins' => 263,
                                'no_of_runs' => 1695,
                                'no_of_2nds' => 222,
                                'no_of_3rds' => 216,
                                'no_of_winners' => 196,
                                'no_of_runners' => 608,
                                'win_prize_money' => 9310851.5299999993,
                                'total_prize_money' => 14785833.43,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    11 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => '14f+',
                                'no_of_wins' => 148,
                                'no_of_runs' => 1079,
                                'no_of_2nds' => 122,
                                'no_of_3rds' => 114,
                                'no_of_winners' => 91,
                                'no_of_runners' => 305,
                                'win_prize_money' => 2589292.8399999999,
                                'total_prize_money' => 4754516.6600000001,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    12 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Heavy',
                                'no_of_wins' => 79,
                                'no_of_runs' => 621,
                                'no_of_2nds' => 52,
                                'no_of_3rds' => 69,
                                'no_of_winners' => 74,
                                'no_of_runners' => 407,
                                'win_prize_money' => 1791723.2,
                                'total_prize_money' => 2230226.52,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    13 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Soft',
                                'no_of_wins' => 274,
                                'no_of_runs' => 1738,
                                'no_of_2nds' => 159,
                                'no_of_3rds' => 198,
                                'no_of_winners' => 167,
                                'no_of_runners' => 860,
                                'win_prize_money' => 4639236.3899999997,
                                'total_prize_money' => 6668707.5099999998,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    14 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Gd-sft',
                                'no_of_wins' => 185,
                                'no_of_runs' => 1232,
                                'no_of_2nds' => 142,
                                'no_of_3rds' => 149,
                                'no_of_winners' => 125,
                                'no_of_runners' => 655,
                                'win_prize_money' => 5373020.7400000002,
                                'total_prize_money' => 8491421.8699999992,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    15 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Good',
                                'no_of_wins' => 548,
                                'no_of_runs' => 4099,
                                'no_of_2nds' => 544,
                                'no_of_3rds' => 524,
                                'no_of_winners' => 344,
                                'no_of_runners' => 1574,
                                'win_prize_money' => 17134089.09,
                                'total_prize_money' => 29593226.530000001,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    16 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Gd-fm',
                                'no_of_wins' => 468,
                                'no_of_runs' => 2767,
                                'no_of_2nds' => 337,
                                'no_of_3rds' => 366,
                                'no_of_winners' => 299,
                                'no_of_runners' => 1229,
                                'win_prize_money' => 20452038.510000002,
                                'total_prize_money' => 29019611.550000001,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    17 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Firm',
                                'no_of_wins' => 14,
                                'no_of_runs' => 108,
                                'no_of_2nds' => 11,
                                'no_of_3rds' => 29,
                                'no_of_winners' => 14,
                                'no_of_runners' => 68,
                                'win_prize_money' => 275686.62,
                                'total_prize_money' => 374580.31,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                ),
        )),
        array(
            0 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'Worldwide G1',
                        'no_of_wins' => 7,
                        'no_of_runs' => 40,
                        'no_of_2nds' => 5,
                        'no_of_3rds' => 5,
                        'no_of_winners' => 4,
                        'no_of_runners' => 24,
                        'win_prize_money' => 1395213.21,
                        'total_prize_money' => 3943523.8399999999,
                        'section_name' => 'current_year',
                    )
                ),
            1 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'Euro Stakes',
                        'no_of_wins' => 19,
                        'no_of_runs' => 109,
                        'no_of_2nds' => 14,
                        'no_of_3rds' => 14,
                        'no_of_winners' => 16,
                        'no_of_runners' => 58,
                        'win_prize_money' => 1751179.8999999999,
                        'total_prize_money' => 3242533.0899999999,
                        'section_name' => 'current_year',
                    )
                ),
            2 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'Turf',
                        'no_of_wins' => 1103,
                        'no_of_runs' => 6601,
                        'no_of_2nds' => 864,
                        'no_of_3rds' => 812,
                        'no_of_winners' => 573,
                        'no_of_runners' => 991,
                        'win_prize_money' => 37972844.619999997,
                        'total_prize_money' => 57340435.990000002,
                        'section_name' => '1988_to_date',
                    )
                ),
            3 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'S',
                        'no_of_wins' => 274,
                        'no_of_runs' => 1738,
                        'no_of_2nds' => 159,
                        'no_of_3rds' => 198,
                        'no_of_winners' => 167,
                        'no_of_runners' => 860,
                        'win_prize_money' => 4639236.3899999997,
                        'total_prize_money' => 6668707.5099999998,
                        'section_name' => '1988_to_date',
                    )
                ),
            4 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'NHF',
                        'no_of_wins' => 20,
                        'no_of_runs' => 83,
                        'no_of_2nds' => 10,
                        'no_of_3rds' => 11,
                        'no_of_winners' => 13,
                        'no_of_runners' => 36,
                        'win_prize_money' => 101304.56,
                        'total_prize_money' => 126340.02,
                        'section_name' => '1988_to_date',
                    )
                ),
            5 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'Jumps',
                        'no_of_wins' => 264,
                        'no_of_runs' => 2148,
                        'no_of_2nds' => 227,
                        'no_of_3rds' => 262,
                        'no_of_winners' => 116,
                        'no_of_runners' => 234,
                        'win_prize_money' => 1806252.5800000001,
                        'total_prize_money' => 2896118.8999999999,
                        'section_name' => '1988_to_date',
                    )
                ),
            6 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'HY',
                        'no_of_wins' => 79,
                        'no_of_runs' => 621,
                        'no_of_2nds' => 52,
                        'no_of_3rds' => 69,
                        'no_of_winners' => 74,
                        'no_of_runners' => 407,
                        'win_prize_money' => 1791723.2,
                        'total_prize_money' => 2230226.52,
                        'section_name' => '1988_to_date',
                    )
                ),
            7 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'GS',
                        'no_of_wins' => 185,
                        'no_of_runs' => 1232,
                        'no_of_2nds' => 142,
                        'no_of_3rds' => 149,
                        'no_of_winners' => 125,
                        'no_of_runners' => 655,
                        'win_prize_money' => 5373020.7400000002,
                        'total_prize_money' => 8491421.8699999992,
                        'section_name' => '1988_to_date',
                    )
                ),
            8 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'GF',
                        'no_of_wins' => 468,
                        'no_of_runs' => 2767,
                        'no_of_2nds' => 337,
                        'no_of_3rds' => 366,
                        'no_of_winners' => 299,
                        'no_of_runners' => 1229,
                        'win_prize_money' => 20452038.510000002,
                        'total_prize_money' => 29019611.550000001,
                        'section_name' => '1988_to_date',
                    )
                ),
            9 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'G',
                        'no_of_wins' => 548,
                        'no_of_runs' => 4099,
                        'no_of_2nds' => 544,
                        'no_of_3rds' => 524,
                        'no_of_winners' => 344,
                        'no_of_runners' => 1574,
                        'win_prize_money' => 17134089.09,
                        'total_prize_money' => 29593226.530000001,
                        'section_name' => '1988_to_date',
                    )
                ),
            10 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'Flat',
                        'no_of_wins' => 1309,
                        'no_of_runs' => 7985,
                        'no_of_2nds' => 1029,
                        'no_of_3rds' => 959,
                        'no_of_winners' => 656,
                        'no_of_runners' => 1019,
                        'win_prize_money' => 38960099.859999999,
                        'total_prize_money' => 58760297.479999997,
                        'section_name' => '1988_to_date',
                    )
                ),
            11 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'F',
                        'no_of_wins' => 14,
                        'no_of_runs' => 108,
                        'no_of_2nds' => 11,
                        'no_of_3rds' => 29,
                        'no_of_winners' => 14,
                        'no_of_runners' => 68,
                        'win_prize_money' => 275686.62,
                        'total_prize_money' => 374580.31,
                        'section_name' => '1988_to_date',
                    )
                ),
            12 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'Broodmare sires',
                        'no_of_wins' => 528,
                        'no_of_runs' => 3887,
                        'no_of_2nds' => 502,
                        'no_of_3rds' => 476,
                        'no_of_winners' => 256,
                        'no_of_runners' => 433,
                        'win_prize_money' => 6726694.25,
                        'total_prize_money' => 10449481.140000001,
                        'section_name' => '1988_to_date',
                    )
                ),
            13 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'All-weather',
                        'no_of_wins' => 206,
                        'no_of_runs' => 1384,
                        'no_of_2nds' => 165,
                        'no_of_3rds' => 147,
                        'no_of_winners' => 159,
                        'no_of_runners' => 494,
                        'win_prize_money' => 987255.23999999999,
                        'total_prize_money' => 1419861.49,
                        'section_name' => '1988_to_date',
                    )
                ),
            14 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => '7-9f',
                        'no_of_wins' => 507,
                        'no_of_runs' => 2865,
                        'no_of_2nds' => 374,
                        'no_of_3rds' => 340,
                        'no_of_winners' => 339,
                        'no_of_runners' => 833,
                        'win_prize_money' => 17399550.93,
                        'total_prize_money' => 24082022.420000002,
                        'section_name' => '1988_to_date',
                    )
                ),
            15 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => '5-6f',
                        'no_of_wins' => 14,
                        'no_of_runs' => 129,
                        'no_of_2nds' => 12,
                        'no_of_3rds' => 20,
                        'no_of_winners' => 11,
                        'no_of_runners' => 86,
                        'win_prize_money' => 189527.81,
                        'total_prize_money' => 256384.73000000001,
                        'section_name' => '1988_to_date',
                    )
                ),
            16 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => '2yo',
                        'no_of_wins' => 276,
                        'no_of_runs' => 1426,
                        'no_of_2nds' => 194,
                        'no_of_3rds' => 178,
                        'no_of_winners' => 206,
                        'no_of_runners' => 613,
                        'win_prize_money' => 6941415.0099999998,
                        'total_prize_money' => 9100578.6099999994,
                        'section_name' => '1988_to_date',
                    )
                ),
            17 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => '14f+',
                        'no_of_wins' => 148,
                        'no_of_runs' => 1079,
                        'no_of_2nds' => 122,
                        'no_of_3rds' => 114,
                        'no_of_winners' => 91,
                        'no_of_runners' => 305,
                        'win_prize_money' => 2589292.8399999999,
                        'total_prize_money' => 4754516.6600000001,
                        'section_name' => '1988_to_date',
                    )
                ),
            18 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => '12-13f',
                        'no_of_wins' => 263,
                        'no_of_runs' => 1695,
                        'no_of_2nds' => 222,
                        'no_of_3rds' => 216,
                        'no_of_winners' => 196,
                        'no_of_runners' => 608,
                        'win_prize_money' => 9310851.5299999993,
                        'total_prize_money' => 14785833.43,
                        'section_name' => '1988_to_date',
                    )
                ),
            19 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => '10-11f',
                        'no_of_wins' => 377,
                        'no_of_runs' => 2217,
                        'no_of_2nds' => 299,
                        'no_of_3rds' => 269,
                        'no_of_winners' => 278,
                        'no_of_runners' => 730,
                        'win_prize_money' => 9470876.75,
                        'total_prize_money' => 14881540.24,
                        'section_name' => '1988_to_date',
                    )
                ),
        ),
    ],
    [
        new Request\ProgenyStatistics([], ['stallionId' => 738816]),
        (Object)(array(
            'current_year' =>
                array(
                    0 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Euro Stakes',
                                'no_of_wins' => 0,
                                'no_of_runs' => 3,
                                'no_of_2nds' => 1,
                                'no_of_3rds' => 0,
                                'no_of_winners' => 0,
                                'no_of_runners' => 3,
                                'win_prize_money' => 0,
                                'total_prize_money' => 9743.5900000000001,
                                'section_name' => 'current_year',
                                'broodmare_category' => false,
                            )
                        ),
                ),
            '2000_to_date' => null,
            '1988_to_date' =>
                array(
                    0 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Flat',
                                'no_of_wins' => 10,
                                'no_of_runs' => 68,
                                'no_of_2nds' => 10,
                                'no_of_3rds' => 7,
                                'no_of_winners' => 8,
                                'no_of_runners' => 32,
                                'win_prize_money' => 45769.309999999998,
                                'total_prize_money' => 67393.860000000001,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    1 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Turf',
                                'no_of_wins' => 8,
                                'no_of_runs' => 59,
                                'no_of_2nds' => 9,
                                'no_of_3rds' => 7,
                                'no_of_winners' => 7,
                                'no_of_runners' => 32,
                                'win_prize_money' => 39623.760000000002,
                                'total_prize_money' => 59347.660000000003,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    2 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'All-weather',
                                'no_of_wins' => 2,
                                'no_of_runs' => 9,
                                'no_of_2nds' => 1,
                                'no_of_3rds' => 0,
                                'no_of_winners' => 1,
                                'no_of_runners' => 8,
                                'win_prize_money' => 6145.5500000000002,
                                'total_prize_money' => 8046.1999999999998,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    3 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'First Crop',
                                'no_of_wins' => 10,
                                'no_of_runs' => 68,
                                'no_of_2nds' => 10,
                                'no_of_3rds' => 7,
                                'no_of_winners' => 8,
                                'no_of_runners' => 32,
                                'win_prize_money' => 45769.309999999998,
                                'total_prize_money' => 67393.860000000001,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    4 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => '2yo',
                                'no_of_wins' => 10,
                                'no_of_runs' => 68,
                                'no_of_2nds' => 10,
                                'no_of_3rds' => 7,
                                'no_of_winners' => 8,
                                'no_of_runners' => 32,
                                'win_prize_money' => 45769.309999999998,
                                'total_prize_money' => 67393.860000000001,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    5 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => '5-6f',
                                'no_of_wins' => 10,
                                'no_of_runs' => 66,
                                'no_of_2nds' => 10,
                                'no_of_3rds' => 7,
                                'no_of_winners' => 8,
                                'no_of_runners' => 31,
                                'win_prize_money' => 45769.309999999998,
                                'total_prize_money' => 67177.410000000003,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    6 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => '7-9f',
                                'no_of_wins' => 0,
                                'no_of_runs' => 1,
                                'no_of_2nds' => 0,
                                'no_of_3rds' => 0,
                                'no_of_winners' => 0,
                                'no_of_runners' => 1,
                                'win_prize_money' => 0,
                                'total_prize_money' => 0,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    7 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => '14f+',
                                'no_of_wins' => 0,
                                'no_of_runs' => 1,
                                'no_of_2nds' => 0,
                                'no_of_3rds' => 0,
                                'no_of_winners' => 0,
                                'no_of_runners' => 1,
                                'win_prize_money' => 0,
                                'total_prize_money' => 216.44999999999999,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    8 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Soft',
                                'no_of_wins' => 11,
                                'no_of_runs' => 33,
                                'no_of_2nds' => 11,
                                'no_of_3rds' => 0,
                                'no_of_winners' => 0,
                                'no_of_runners' => 1,
                                'win_prize_money' => 35579.5,
                                'total_prize_money' => 50402,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    9 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Gd-sft',
                                'no_of_wins' => 22,
                                'no_of_runs' => 55,
                                'no_of_2nds' => 0,
                                'no_of_3rds' => 11,
                                'no_of_winners' => 1,
                                'no_of_runners' => 1,
                                'win_prize_money' => 104054.5,
                                'total_prize_money' => 112520.10000000001,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    10 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Good',
                                'no_of_wins' => 22,
                                'no_of_runs' => 154,
                                'no_of_2nds' => 22,
                                'no_of_3rds' => 23,
                                'no_of_winners' => 0,
                                'no_of_runners' => 3,
                                'win_prize_money' => 127580.52,
                                'total_prize_money' => 199696.29999999999,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    11 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Gd-fm',
                                'no_of_wins' => 22,
                                'no_of_runs' => 293,
                                'no_of_2nds' => 46,
                                'no_of_3rds' => 32,
                                'no_of_winners' => 0,
                                'no_of_runners' => 8,
                                'win_prize_money' => 92506.699999999997,
                                'total_prize_money' => 181394.04999999999,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    12 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Firm',
                                'no_of_wins' => 11,
                                'no_of_runs' => 33,
                                'no_of_2nds' => 11,
                                'no_of_3rds' => 11,
                                'no_of_winners' => 0,
                                'no_of_runners' => 2,
                                'win_prize_money' => 76140.130000000005,
                                'total_prize_money' => 98370.029999999999,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                ),
        )),
        array(
            0 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'Euro Stakes',
                        'no_of_wins' => 0,
                        'no_of_runs' => 3,
                        'no_of_2nds' => 1,
                        'no_of_3rds' => 0,
                        'no_of_winners' => 0,
                        'no_of_runners' => 3,
                        'win_prize_money' => 0,
                        'total_prize_money' => 9743.5900000000001,
                        'section_name' => 'current_year',
                    )
                ),
            1 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'Turf',
                        'no_of_wins' => 8,
                        'no_of_runs' => 59,
                        'no_of_2nds' => 9,
                        'no_of_3rds' => 7,
                        'no_of_winners' => 7,
                        'no_of_runners' => 32,
                        'win_prize_money' => 39623.760000000002,
                        'total_prize_money' => 59347.660000000003,
                        'section_name' => '1988_to_date',
                    )
                ),
            2 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'S',
                        'no_of_wins' => 11,
                        'no_of_runs' => 33,
                        'no_of_2nds' => 11,
                        'no_of_3rds' => 0,
                        'no_of_winners' => 0,
                        'no_of_runners' => 1,
                        'win_prize_money' => 35579.5,
                        'total_prize_money' => 50402,
                        'section_name' => '1988_to_date',
                    )
                ),
            3 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'GS',
                        'no_of_wins' => 22,
                        'no_of_runs' => 55,
                        'no_of_2nds' => 0,
                        'no_of_3rds' => 11,
                        'no_of_winners' => 1,
                        'no_of_runners' => 1,
                        'win_prize_money' => 104054.5,
                        'total_prize_money' => 112520.10000000001,
                        'section_name' => '1988_to_date',
                    )
                ),
            4 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'GF',
                        'no_of_wins' => 22,
                        'no_of_runs' => 293,
                        'no_of_2nds' => 46,
                        'no_of_3rds' => 32,
                        'no_of_winners' => 0,
                        'no_of_runners' => 8,
                        'win_prize_money' => 92506.699999999997,
                        'total_prize_money' => 181394.04999999999,
                        'section_name' => '1988_to_date',
                    )
                ),
            5 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'G',
                        'no_of_wins' => 22,
                        'no_of_runs' => 154,
                        'no_of_2nds' => 22,
                        'no_of_3rds' => 23,
                        'no_of_winners' => 0,
                        'no_of_runners' => 3,
                        'win_prize_money' => 127580.52,
                        'total_prize_money' => 199696.29999999999,
                        'section_name' => '1988_to_date',
                    )
                ),
            6 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'Flat',
                        'no_of_wins' => 10,
                        'no_of_runs' => 68,
                        'no_of_2nds' => 10,
                        'no_of_3rds' => 7,
                        'no_of_winners' => 8,
                        'no_of_runners' => 32,
                        'win_prize_money' => 45769.309999999998,
                        'total_prize_money' => 67393.860000000001,
                        'section_name' => '1988_to_date',
                    )
                ),
            7 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'First Crop',
                        'no_of_wins' => 10,
                        'no_of_runs' => 68,
                        'no_of_2nds' => 10,
                        'no_of_3rds' => 7,
                        'no_of_winners' => 8,
                        'no_of_runners' => 32,
                        'win_prize_money' => 45769.309999999998,
                        'total_prize_money' => 67393.860000000001,
                        'section_name' => '1988_to_date',
                    )
                ),
            8 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'F',
                        'no_of_wins' => 11,
                        'no_of_runs' => 33,
                        'no_of_2nds' => 11,
                        'no_of_3rds' => 11,
                        'no_of_winners' => 0,
                        'no_of_runners' => 2,
                        'win_prize_money' => 76140.130000000005,
                        'total_prize_money' => 98370.029999999999,
                        'section_name' => '1988_to_date',
                    )
                ),
            9 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'All-weather',
                        'no_of_wins' => 2,
                        'no_of_runs' => 9,
                        'no_of_2nds' => 1,
                        'no_of_3rds' => 0,
                        'no_of_winners' => 1,
                        'no_of_runners' => 8,
                        'win_prize_money' => 6145.5500000000002,
                        'total_prize_money' => 8046.1999999999998,
                        'section_name' => '1988_to_date',
                    )
                ),
            10 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => '7-9f',
                        'no_of_wins' => 0,
                        'no_of_runs' => 1,
                        'no_of_2nds' => 0,
                        'no_of_3rds' => 0,
                        'no_of_winners' => 0,
                        'no_of_runners' => 1,
                        'win_prize_money' => 0,
                        'total_prize_money' => 0,
                        'section_name' => '1988_to_date',
                    )
                ),
            11 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => '5-6f',
                        'no_of_wins' => 10,
                        'no_of_runs' => 66,
                        'no_of_2nds' => 10,
                        'no_of_3rds' => 7,
                        'no_of_winners' => 8,
                        'no_of_runners' => 31,
                        'win_prize_money' => 45769.309999999998,
                        'total_prize_money' => 67177.410000000003,
                        'section_name' => '1988_to_date',
                    )
                ),
            12 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => '2yo',
                        'no_of_wins' => 10,
                        'no_of_runs' => 68,
                        'no_of_2nds' => 10,
                        'no_of_3rds' => 7,
                        'no_of_winners' => 8,
                        'no_of_runners' => 32,
                        'win_prize_money' => 45769.309999999998,
                        'total_prize_money' => 67393.860000000001,
                        'section_name' => '1988_to_date',
                    )
                ),
            13 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => '14f+',
                        'no_of_wins' => 0,
                        'no_of_runs' => 1,
                        'no_of_2nds' => 0,
                        'no_of_3rds' => 0,
                        'no_of_winners' => 0,
                        'no_of_runners' => 1,
                        'win_prize_money' => 0,
                        'total_prize_money' => 216.44999999999999,
                        'section_name' => '1988_to_date',
                    )
                ),
        ),
    ],
    [
        new Request\ProgenyStatistics([], ['stallionId' => 584911]),
        (Object)(array(
            'current_year' =>
                array(
                    0 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Worldwide G1',
                                'no_of_wins' => 0,
                                'no_of_runs' => 4,
                                'no_of_2nds' => 2,
                                'no_of_3rds' => 0,
                                'no_of_winners' => 0,
                                'no_of_runners' => 3,
                                'win_prize_money' => 0,
                                'total_prize_money' => 127492.50999999999,
                                'section_name' => 'current_year',
                                'broodmare_category' => false,
                            )
                        ),
                    1 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Euro Stakes',
                                'no_of_wins' => 1,
                                'no_of_runs' => 11,
                                'no_of_2nds' => 0,
                                'no_of_3rds' => 4,
                                'no_of_winners' => 1,
                                'no_of_runners' => 7,
                                'win_prize_money' => 25641.029999999999,
                                'total_prize_money' => 106422.23,
                                'section_name' => 'current_year',
                                'broodmare_category' => false,
                            )
                        ),
                ),
            '2000_to_date' => null,
            '1988_to_date' =>
                array(
                    0 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Flat',
                                'no_of_wins' => 298,
                                'no_of_runs' => 2268,
                                'no_of_2nds' => 258,
                                'no_of_3rds' => 260,
                                'no_of_winners' => 143,
                                'no_of_runners' => 248,
                                'win_prize_money' => 2616871.7200000002,
                                'total_prize_money' => 4403390.2000000002,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    1 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Turf',
                                'no_of_wins' => 210,
                                'no_of_runs' => 1621,
                                'no_of_2nds' => 182,
                                'no_of_3rds' => 183,
                                'no_of_winners' => 116,
                                'no_of_runners' => 236,
                                'win_prize_money' => 2260426.0899999999,
                                'total_prize_money' => 3831688.8799999999,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    2 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'All-weather',
                                'no_of_wins' => 88,
                                'no_of_runs' => 647,
                                'no_of_2nds' => 76,
                                'no_of_3rds' => 77,
                                'no_of_winners' => 59,
                                'no_of_runners' => 165,
                                'win_prize_money' => 356445.63,
                                'total_prize_money' => 571701.31000000006,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    3 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Jumps',
                                'no_of_wins' => 107,
                                'no_of_runs' => 778,
                                'no_of_2nds' => 91,
                                'no_of_3rds' => 68,
                                'no_of_winners' => 40,
                                'no_of_runners' => 91,
                                'win_prize_money' => 1026754.41,
                                'total_prize_money' => 1665442.4199999999,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    4 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'NHF',
                                'no_of_wins' => 8,
                                'no_of_runs' => 32,
                                'no_of_2nds' => 3,
                                'no_of_3rds' => 4,
                                'no_of_winners' => 7,
                                'no_of_runners' => 17,
                                'win_prize_money' => 21127.27,
                                'total_prize_money' => 42452.370000000003,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    5 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => '2yo',
                                'no_of_wins' => 61,
                                'no_of_runs' => 443,
                                'no_of_2nds' => 48,
                                'no_of_3rds' => 48,
                                'no_of_winners' => 46,
                                'no_of_runners' => 158,
                                'win_prize_money' => 468699.70000000001,
                                'total_prize_money' => 835417.87,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    6 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Broodmare sires',
                                'no_of_wins' => 18,
                                'no_of_runs' => 152,
                                'no_of_2nds' => 15,
                                'no_of_3rds' => 12,
                                'no_of_winners' => 11,
                                'no_of_runners' => 30,
                                'win_prize_money' => 101658.28999999999,
                                'total_prize_money' => 140172.82999999999,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => true,
                            )
                        ),
                    7 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => '5-6f',
                                'no_of_wins' => 17,
                                'no_of_runs' => 157,
                                'no_of_2nds' => 23,
                                'no_of_3rds' => 14,
                                'no_of_winners' => 13,
                                'no_of_runners' => 50,
                                'win_prize_money' => 140127.41,
                                'total_prize_money' => 283135.41999999998,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    8 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => '7-9f',
                                'no_of_wins' => 129,
                                'no_of_runs' => 1035,
                                'no_of_2nds' => 106,
                                'no_of_3rds' => 130,
                                'no_of_winners' => 73,
                                'no_of_runners' => 214,
                                'win_prize_money' => 1064176.3,
                                'total_prize_money' => 1785619.03,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    9 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => '10-11f',
                                'no_of_wins' => 78,
                                'no_of_runs' => 559,
                                'no_of_2nds' => 72,
                                'no_of_3rds' => 69,
                                'no_of_winners' => 57,
                                'no_of_runners' => 171,
                                'win_prize_money' => 697563,
                                'total_prize_money' => 1229877.5,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    10 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => '12-13f',
                                'no_of_wins' => 48,
                                'no_of_runs' => 321,
                                'no_of_2nds' => 34,
                                'no_of_3rds' => 27,
                                'no_of_winners' => 42,
                                'no_of_runners' => 125,
                                'win_prize_money' => 479765.38,
                                'total_prize_money' => 726551.75,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    11 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => '14f+',
                                'no_of_wins' => 26,
                                'no_of_runs' => 196,
                                'no_of_2nds' => 23,
                                'no_of_3rds' => 20,
                                'no_of_winners' => 12,
                                'no_of_runners' => 61,
                                'win_prize_money' => 235239.63,
                                'total_prize_money' => 378206.5,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    12 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Heavy',
                                'no_of_wins' => 22,
                                'no_of_runs' => 171,
                                'no_of_2nds' => 16,
                                'no_of_3rds' => 25,
                                'no_of_winners' => 11,
                                'no_of_runners' => 93,
                                'win_prize_money' => 252362,
                                'total_prize_money' => 351593.31,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    13 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Soft',
                                'no_of_wins' => 69,
                                'no_of_runs' => 531,
                                'no_of_2nds' => 41,
                                'no_of_3rds' => 53,
                                'no_of_winners' => 37,
                                'no_of_runners' => 243,
                                'win_prize_money' => 445467.67999999999,
                                'total_prize_money' => 866045.30000000005,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    14 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Gd-sft',
                                'no_of_wins' => 50,
                                'no_of_runs' => 640,
                                'no_of_2nds' => 112,
                                'no_of_3rds' => 49,
                                'no_of_winners' => 33,
                                'no_of_runners' => 199,
                                'win_prize_money' => 799338.43999999994,
                                'total_prize_money' => 1464495.95,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    15 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Good',
                                'no_of_wins' => 218,
                                'no_of_runs' => 1324,
                                'no_of_2nds' => 145,
                                'no_of_3rds' => 138,
                                'no_of_winners' => 76,
                                'no_of_runners' => 414,
                                'win_prize_money' => 1578762.28,
                                'total_prize_money' => 2400978.5899999999,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    16 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Gd-fm',
                                'no_of_wins' => 115,
                                'no_of_runs' => 698,
                                'no_of_2nds' => 73,
                                'no_of_3rds' => 99,
                                'no_of_winners' => 69,
                                'no_of_runners' => 295,
                                'win_prize_money' => 1016966.72,
                                'total_prize_money' => 1739108.1699999999,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                    17 =>
                        \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                            array(
                                'category' => 'Firm',
                                'no_of_wins' => 5,
                                'no_of_runs' => 19,
                                'no_of_2nds' => 2,
                                'no_of_3rds' => 2,
                                'no_of_winners' => 5,
                                'no_of_runners' => 18,
                                'win_prize_money' => 15446.5,
                                'total_prize_money' => 19052.119999999999,
                                'section_name' => '1988_to_date',
                                'broodmare_category' => false,
                            )
                        ),
                ),
        )),
        array(
            0 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'Worldwide G1',
                        'no_of_wins' => 0,
                        'no_of_runs' => 4,
                        'no_of_2nds' => 2,
                        'no_of_3rds' => 0,
                        'no_of_winners' => 0,
                        'no_of_runners' => 3,
                        'win_prize_money' => 0,
                        'total_prize_money' => 127492.50999999999,
                        'section_name' => 'current_year',
                    )
                ),
            1 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'Euro Stakes',
                        'no_of_wins' => 1,
                        'no_of_runs' => 11,
                        'no_of_2nds' => 0,
                        'no_of_3rds' => 4,
                        'no_of_winners' => 1,
                        'no_of_runners' => 7,
                        'win_prize_money' => 25641.029999999999,
                        'total_prize_money' => 106422.23,
                        'section_name' => 'current_year',
                    )
                ),
            2 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'Turf',
                        'no_of_wins' => 210,
                        'no_of_runs' => 1621,
                        'no_of_2nds' => 182,
                        'no_of_3rds' => 183,
                        'no_of_winners' => 116,
                        'no_of_runners' => 236,
                        'win_prize_money' => 2260426.0899999999,
                        'total_prize_money' => 3831688.8799999999,
                        'section_name' => '1988_to_date',
                    )
                ),
            3 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'S',
                        'no_of_wins' => 69,
                        'no_of_runs' => 531,
                        'no_of_2nds' => 41,
                        'no_of_3rds' => 53,
                        'no_of_winners' => 37,
                        'no_of_runners' => 243,
                        'win_prize_money' => 445467.67999999999,
                        'total_prize_money' => 866045.30000000005,
                        'section_name' => '1988_to_date',
                    )
                ),
            4 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'NHF',
                        'no_of_wins' => 8,
                        'no_of_runs' => 32,
                        'no_of_2nds' => 3,
                        'no_of_3rds' => 4,
                        'no_of_winners' => 7,
                        'no_of_runners' => 17,
                        'win_prize_money' => 21127.27,
                        'total_prize_money' => 42452.370000000003,
                        'section_name' => '1988_to_date',
                    )
                ),
            5 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'Jumps',
                        'no_of_wins' => 107,
                        'no_of_runs' => 778,
                        'no_of_2nds' => 91,
                        'no_of_3rds' => 68,
                        'no_of_winners' => 40,
                        'no_of_runners' => 91,
                        'win_prize_money' => 1026754.41,
                        'total_prize_money' => 1665442.4199999999,
                        'section_name' => '1988_to_date',
                    )
                ),
            6 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'HY',
                        'no_of_wins' => 22,
                        'no_of_runs' => 171,
                        'no_of_2nds' => 16,
                        'no_of_3rds' => 25,
                        'no_of_winners' => 11,
                        'no_of_runners' => 93,
                        'win_prize_money' => 252362,
                        'total_prize_money' => 351593.31,
                        'section_name' => '1988_to_date',
                    )
                ),
            7 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'GS',
                        'no_of_wins' => 50,
                        'no_of_runs' => 640,
                        'no_of_2nds' => 112,
                        'no_of_3rds' => 49,
                        'no_of_winners' => 33,
                        'no_of_runners' => 199,
                        'win_prize_money' => 799338.43999999994,
                        'total_prize_money' => 1464495.95,
                        'section_name' => '1988_to_date',
                    )
                ),
            8 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'GF',
                        'no_of_wins' => 115,
                        'no_of_runs' => 698,
                        'no_of_2nds' => 73,
                        'no_of_3rds' => 99,
                        'no_of_winners' => 69,
                        'no_of_runners' => 295,
                        'win_prize_money' => 1016966.72,
                        'total_prize_money' => 1739108.1699999999,
                        'section_name' => '1988_to_date',
                    )
                ),
            9 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'G',
                        'no_of_wins' => 218,
                        'no_of_runs' => 1324,
                        'no_of_2nds' => 145,
                        'no_of_3rds' => 138,
                        'no_of_winners' => 76,
                        'no_of_runners' => 414,
                        'win_prize_money' => 1578762.28,
                        'total_prize_money' => 2400978.5899999999,
                        'section_name' => '1988_to_date',
                    )
                ),
            10 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'Flat',
                        'no_of_wins' => 298,
                        'no_of_runs' => 2268,
                        'no_of_2nds' => 258,
                        'no_of_3rds' => 260,
                        'no_of_winners' => 143,
                        'no_of_runners' => 248,
                        'win_prize_money' => 2616871.7200000002,
                        'total_prize_money' => 4403390.2000000002,
                        'section_name' => '1988_to_date',
                    )
                ),
            11 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'F',
                        'no_of_wins' => 5,
                        'no_of_runs' => 19,
                        'no_of_2nds' => 2,
                        'no_of_3rds' => 2,
                        'no_of_winners' => 5,
                        'no_of_runners' => 18,
                        'win_prize_money' => 15446.5,
                        'total_prize_money' => 19052.119999999999,
                        'section_name' => '1988_to_date',
                    )
                ),
            12 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'Broodmare sires',
                        'no_of_wins' => 18,
                        'no_of_runs' => 152,
                        'no_of_2nds' => 15,
                        'no_of_3rds' => 12,
                        'no_of_winners' => 11,
                        'no_of_runners' => 30,
                        'win_prize_money' => 101658.28999999999,
                        'total_prize_money' => 140172.82999999999,
                        'section_name' => '1988_to_date',
                    )
                ),
            13 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => 'All-weather',
                        'no_of_wins' => 88,
                        'no_of_runs' => 647,
                        'no_of_2nds' => 76,
                        'no_of_3rds' => 77,
                        'no_of_winners' => 59,
                        'no_of_runners' => 165,
                        'win_prize_money' => 356445.63,
                        'total_prize_money' => 571701.31000000006,
                        'section_name' => '1988_to_date',
                    )
                ),
            14 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => '7-9f',
                        'no_of_wins' => 129,
                        'no_of_runs' => 1035,
                        'no_of_2nds' => 106,
                        'no_of_3rds' => 130,
                        'no_of_winners' => 73,
                        'no_of_runners' => 214,
                        'win_prize_money' => 1064176.3,
                        'total_prize_money' => 1785619.03,
                        'section_name' => '1988_to_date',
                    )
                ),
            15 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => '5-6f',
                        'no_of_wins' => 17,
                        'no_of_runs' => 157,
                        'no_of_2nds' => 23,
                        'no_of_3rds' => 14,
                        'no_of_winners' => 13,
                        'no_of_runners' => 50,
                        'win_prize_money' => 140127.41,
                        'total_prize_money' => 283135.41999999998,
                        'section_name' => '1988_to_date',
                    )
                ),
            16 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => '2yo',
                        'no_of_wins' => 61,
                        'no_of_runs' => 443,
                        'no_of_2nds' => 48,
                        'no_of_3rds' => 48,
                        'no_of_winners' => 46,
                        'no_of_runners' => 158,
                        'win_prize_money' => 468699.70000000001,
                        'total_prize_money' => 835417.87,
                        'section_name' => '1988_to_date',
                    )
                ),
            17 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => '14f+',
                        'no_of_wins' => 26,
                        'no_of_runs' => 196,
                        'no_of_2nds' => 23,
                        'no_of_3rds' => 20,
                        'no_of_winners' => 12,
                        'no_of_runners' => 61,
                        'win_prize_money' => 235239.63,
                        'total_prize_money' => 378206.5,
                        'section_name' => '1988_to_date',
                    )
                ),
            18 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => '12-13f',
                        'no_of_wins' => 48,
                        'no_of_runs' => 321,
                        'no_of_2nds' => 34,
                        'no_of_3rds' => 27,
                        'no_of_winners' => 42,
                        'no_of_runners' => 125,
                        'win_prize_money' => 479765.38,
                        'total_prize_money' => 726551.75,
                        'section_name' => '1988_to_date',
                    )
                ),
            19 =>
                \Api\Row\Bloodstock\ProgenyStatistics::createFromArray(
                    array(
                        'category' => '10-11f',
                        'no_of_wins' => 78,
                        'no_of_runs' => 559,
                        'no_of_2nds' => 72,
                        'no_of_3rds' => 69,
                        'no_of_winners' => 57,
                        'no_of_runners' => 171,
                        'win_prize_money' => 697563,
                        'total_prize_money' => 1229877.5,
                        'section_name' => '1988_to_date',
                    )
                ),
        ),
    ],

];
