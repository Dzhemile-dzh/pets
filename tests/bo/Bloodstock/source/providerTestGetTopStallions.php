<?php

use Api\Input\Request\Horses\Bloodstock\Statistics as Request;

return [
    [
        new Request\TopStallions(
            [2012],
            [
                'category' => 'Worldwide G1',
                'countryOrigCodes' => ['FR'],
                'progenyPerformersLimit' => 3
            ]
        ),
        array(
            0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                array(
                    'style_name' => 'Deep Impact',
                    'country_origin_code' => 'JPN',
                    'horse_uid' => 636099,
                    'no_of_wins' => 6,
                    'no_of_runs' => 52,
                    'no_of_2nds' => 7,
                    'no_of_3rds' => 5,
                    'no_of_4ths' => 2,
                    'win_prize_money' => 6684607.0499999998,
                    'total_prize_money' => 10700495.01,
                    'no_of_winners' => 3,
                    'no_of_runners' => 29,
                    'progeny_performers' =>
                        array(
                            0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'sire_uid' => 636099,
                                    'horse_uid' => 801866,
                                    'horse_style_name' => 'Gentildonna',
                                    'horse_country_origin_code' => 'JPN',
                                    'dam_sire_uid' => 488572,
                                    'dam_sire_style_name' => 'Bertolini',
                                    'dam_sire_country_origin_code' => 'USA',
                                    'rpr' => 126,
                                )
                            ),
                            1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'sire_uid' => 636099,
                                    'horse_uid' => 798828,
                                    'horse_style_name' => 'Deep Brillante',
                                    'horse_country_origin_code' => 'JPN',
                                    'dam_sire_uid' => 109183,
                                    'dam_sire_style_name' => 'Loup Sauvage',
                                    'dam_sire_country_origin_code' => 'USA',
                                    'rpr' => 118,
                                )
                            ),
                            2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'sire_uid' => 636099,
                                    'horse_uid' => 793132,
                                    'horse_style_name' => 'Beauty Parlour',
                                    'horse_country_origin_code' => 'GB',
                                    'dam_sire_uid' => 513047,
                                    'dam_sire_style_name' => 'Giant\'s Causeway',
                                    'dam_sire_country_origin_code' => 'USA',
                                    'rpr' => 115,
                                )
                            ),
                        ),
                )
            ),
            1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                array(
                    'style_name' => 'Stay Gold',
                    'country_origin_code' => 'JPN',
                    'horse_uid' => 476873,
                    'no_of_wins' => 4,
                    'no_of_runs' => 22,
                    'no_of_2nds' => 5,
                    'no_of_3rds' => 1,
                    'no_of_4ths' => 1,
                    'win_prize_money' => 5174645.4199999999,
                    'total_prize_money' => 9210697.7300000004,
                    'no_of_winners' => 2,
                    'no_of_runners' => 11,
                    'progeny_performers' =>
                        array(
                            0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'sire_uid' => 476873,
                                    'horse_uid' => 794994,
                                    'horse_style_name' => 'Gold Ship',
                                    'horse_country_origin_code' => 'JPN',
                                    'dam_sire_uid' => 72543,
                                    'dam_sire_style_name' => 'Mejiro McQueen',
                                    'dam_sire_country_origin_code' => 'JPN',
                                    'rpr' => 128,
                                )
                            ),
                            1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'sire_uid' => 476873,
                                    'horse_uid' => 771325,
                                    'horse_style_name' => 'Orfevre',
                                    'horse_country_origin_code' => 'JPN',
                                    'dam_sire_uid' => 72543,
                                    'dam_sire_style_name' => 'Mejiro McQueen',
                                    'dam_sire_country_origin_code' => 'JPN',
                                    'rpr' => 127,
                                )
                            ),
                        ),
                )
            ),
        )
    ],
    [
        new Request\TopStallions(
            [2016],
            [
                'category' => 'First Crop',
                'countryOrigCodes' => ['GB', 'IRE'],
                'progenyPerformersLimit' => 1
            ]
        ),
        array(
            0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                array(
                    'style_name' => 'Sir Prancealot',
                    'country_origin_code' => 'IRE',
                    'horse_uid' => 800166,
                    'no_of_wins' => 42,
                    'no_of_runs' => 346,
                    'no_of_2nds' => 37,
                    'no_of_3rds' => 42,
                    'no_of_4ths' => 38,
                    'win_prize_money' => 367371.34000000003,
                    'total_prize_money' => 532221.83999999997,
                    'no_of_winners' => 28,
                    'no_of_runners' => 70,
                    'progeny_performers' =>
                        array(
                            0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'sire_uid' => 800166,
                                    'horse_uid' => 1043709,
                                    'horse_style_name' => 'Sir Dancealot',
                                    'horse_country_origin_code' => 'IRE',
                                    'dam_sire_uid' => 104011,
                                    'dam_sire_style_name' => 'Danehill Dancer',
                                    'dam_sire_country_origin_code' => 'IRE',
                                    'rpr' => 107,
                                )
                            ),
                        ),
                )
            ),
            1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                array(
                    'style_name' => 'Frankel',
                    'country_origin_code' => 'GB',
                    'horse_uid' => 763453,
                    'no_of_wins' => 22,
                    'no_of_runs' => 66,
                    'no_of_2nds' => 5,
                    'no_of_3rds' => 8,
                    'no_of_4ths' => 9,
                    'win_prize_money' => 255960.23999999999,
                    'total_prize_money' => 364586.67999999999,
                    'no_of_winners' => 15,
                    'no_of_runners' => 29,
                    'progeny_performers' =>
                        array(
                            0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'sire_uid' => 763453,
                                    'horse_uid' => 1018555,
                                    'horse_style_name' => 'Queen Kindly',
                                    'horse_country_origin_code' => 'GB',
                                    'dam_sire_uid' => 13903,
                                    'dam_sire_style_name' => 'Rahy',
                                    'dam_sire_country_origin_code' => 'USA',
                                    'rpr' => 112,
                                )
                            ),
                        ),
                )
            ),
            2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                array(
                    'style_name' => 'Mayson',
                    'country_origin_code' => 'GB',
                    'horse_uid' => 756946,
                    'no_of_wins' => 22,
                    'no_of_runs' => 173,
                    'no_of_2nds' => 34,
                    'no_of_3rds' => 24,
                    'no_of_4ths' => 12,
                    'win_prize_money' => 140137.92999999999,
                    'total_prize_money' => 357090.71000000002,
                    'no_of_winners' => 15,
                    'no_of_runners' => 44,
                    'progeny_performers' =>
                        array(
                            0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'sire_uid' => 756946,
                                    'horse_uid' => 964674,
                                    'horse_style_name' => 'Global Applause',
                                    'horse_country_origin_code' => 'GB',
                                    'dam_sire_uid' => 103416,
                                    'dam_sire_style_name' => 'Royal Applause',
                                    'dam_sire_country_origin_code' => 'GB',
                                    'rpr' => 103,
                                )
                            ),
                        ),
                )
            ),
        )
    ],
];
