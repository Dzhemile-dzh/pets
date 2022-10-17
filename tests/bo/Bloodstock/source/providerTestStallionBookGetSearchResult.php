<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 5/18/2016
 * Time: 12:35 AM
 */

use Api\Input\Request\Horses\Bloodstock\StallionBook as Request;

$data = [
    [
        new \Api\Input\Request\Horses\Bloodstock\StallionBook\Index(
            [],
            [
                'type' => 'inactive',
                'stallion' => 'Galileo'
            ]
        ),
        [
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 862404,
                    'style_name' => 'Absolute Galileo',
                    'country_origin_code' => 'IRE',
                    'sire_uid' => 531769,
                    'sire_style_name' => 'Galileo',
                    'sire_line_uid' => 463975,
                    'sire_line_style_name' => 'Sadler\'s Wells',
                    'stud_name' => null,
                    'stud_country_code' => null,
                    'stud_fee' => null,
                    'year_to_stud' => null,
                    'stud_fee_condition' => null,
                    'fee_cur_code' => null,
                    'exchange_rate' => null,
                    'weatherbys_uid' => null,
                    'private_flag' => 0,
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 16975,
                    'style_name' => 'El Galileo',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 300488,
                    'sire_style_name' => 'Comedy Star',
                    'sire_line_uid' => 907129,
                    'sire_line_style_name' => 'Tom Fool',
                    'stud_name' => null,
                    'stud_country_code' => null,
                    'stud_fee' => null,
                    'year_to_stud' => null,
                    'stud_fee_condition' => null,
                    'fee_cur_code' => null,
                    'exchange_rate' => null,
                    'weatherbys_uid' => null,
                    'private_flag' => 0,
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 873770,
                    'style_name' => 'Energia Galileo',
                    'country_origin_code' => 'BRZ',
                    'sire_uid' => 554106,
                    'sire_style_name' => 'Agnes Gold',
                    'sire_line_uid' => 465637,
                    'sire_line_style_name' => 'Sunday Silence',
                    'stud_name' => null,
                    'stud_country_code' => null,
                    'stud_fee' => null,
                    'year_to_stud' => null,
                    'stud_fee_condition' => null,
                    'fee_cur_code' => null,
                    'exchange_rate' => null,
                    'weatherbys_uid' => null,
                    'private_flag' => 0,
                ]
            ),
        ]
    ],
    [
        new \Api\Input\Request\Horses\Bloodstock\StallionBook\Index(
            [],
            [
                'type' => 'weatherbys',
                'sire' => 'Warning'
            ]
        ),
        [
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 84442,
                    'style_name' => 'Piccolo',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 9284,
                    'sire_style_name' => 'Warning',
                    'sire_line_uid' => 301285,
                    'sire_line_style_name' => 'Known Fact',
                    'stud_name' => null,
                    'stud_country_code' => null,
                    'stud_fee' => 3500,
                    'year_to_stud' => 1996,
                    'stud_fee_condition' => null,
                    'fee_cur_code' => 'GBP',
                    'exchange_rate' => null,
                    'weatherbys_uid' => 2626,
                    'private_flag' => 0,
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 84442,
                    'style_name' => 'Piccolo',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 9284,
                    'sire_style_name' => 'Warning',
                    'sire_line_uid' => 301285,
                    'sire_line_style_name' => 'Known Fact',
                    'stud_name' => null,
                    'stud_country_code' => null,
                    'stud_fee' => 3500,
                    'year_to_stud' => 1997,
                    'stud_fee_condition' => null,
                    'fee_cur_code' => 'GBP',
                    'exchange_rate' => null,
                    'weatherbys_uid' => 2626,
                    'private_flag' => 0,
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 84442,
                    'style_name' => 'Piccolo',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 9284,
                    'sire_style_name' => 'Warning',
                    'sire_line_uid' => 301285,
                    'sire_line_style_name' => 'Known Fact',
                    'stud_name' => null,
                    'stud_country_code' => null,
                    'stud_fee' => 3500,
                    'year_to_stud' => 1998,
                    'stud_fee_condition' => null,
                    'fee_cur_code' => 'GBP',
                    'exchange_rate' => null,
                    'weatherbys_uid' => 2626,
                    'private_flag' => 0,
                ]
            ),
        ]
    ],
    [
        new \Api\Input\Request\Horses\Bloodstock\StallionBook\Index(
            [],
            [
                'type' => 'weatherbys',
                'stallion' => 'Piccolo',
                'sire' => 'Warning',
                'sireFlag' => 'include',
                'studCountryCode' => 'GB',
                'studFarm' => 'Lavington',
                'yearToStud' => 2002,
                'minPrice' => 1500,
                'maxPrice' => 5000
            ]
        ),
        [
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 84442,
                    'style_name' => 'Piccolo',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 9284,
                    'sire_style_name' => 'Warning',
                    'sire_line_uid' => 301285,
                    'sire_line_style_name' => 'Known Fact',
                    'stud_name' => 'Lavington Stud',
                    'stud_country_code' => 'GB',
                    'stud_fee' => 4000,
                    'year_to_stud' => 2002,
                    'stud_fee_condition' => null,
                    'fee_cur_code' => 'GBP',
                    'exchange_rate' => 1,
                    'weatherbys_uid' => 2626,
                    'private_flag' => 0,
                ]
            ),
        ]
    ],
    [
        new \Api\Input\Request\Horses\Bloodstock\StallionBook\Index(
            [],
            [
                'type' => 'weatherbys',
                'stallion' => 'Piccolo',
                'sireType' => 'secondCrop',
            ]
        ),
        [
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 84442,
                    'style_name' => 'Piccolo',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 9284,
                    'sire_style_name' => 'Warning',
                    'sire_line_uid' => 301285,
                    'sire_line_style_name' => 'Known Fact',
                    'stud_name' => null,
                    'stud_country_code' => null,
                    'stud_fee' => 3500,
                    'year_to_stud' => 1997,
                    'stud_fee_condition' => null,
                    'fee_cur_code' => 'GBP',
                    'exchange_rate' => null,
                    'weatherbys_uid' => 2626,
                    'private_flag' => 0,
                ]
            ),
        ]
    ],
    [
        new \Api\Input\Request\Horses\Bloodstock\StallionBook\Index(
            [],
            [
                'type' => 'weatherbys',
                'studFarm' => 'farm',
                'distance' => '1m6f-1m7f',
            ]
        ),
        [
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 503150,
                    'style_name' => 'Lemon Drop Kid',
                    'country_origin_code' => 'USA',
                    'sire_uid' => 79045,
                    'sire_style_name' => 'Kingmambo',
                    'sire_line_uid' => 301599,
                    'sire_line_style_name' => 'Mr Prospector',
                    'stud_name' => 'Lane\'s End Farm, Kentucky',
                    'stud_country_code' => 'USA',
                    'stud_fee' => 75000,
                    'year_to_stud' => 2002,
                    'stud_fee_condition' => null,
                    'fee_cur_code' => 'USD',
                    'exchange_rate' => 1.47,
                    'weatherbys_uid' => 2322,
                    'private_flag' => 0,
                ]
            ),
        ]
    ],
    [
        new \Api\Input\Request\Horses\Bloodstock\StallionBook\Index(
            [],
            [
                'type' => 'weatherbys',
                'turfWinners' => 1,
                'hurdleWinners' => 1,
                'chaseWinners' => 1,
                'allWeatherWinners' => 1
            ]
        ),
        [
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 84442,
                    'style_name' => 'Piccolo',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 9284,
                    'sire_style_name' => 'Warning',
                    'sire_line_uid' => 301285,
                    'sire_line_style_name' => 'Known Fact',
                    'stud_name' => null,
                    'stud_country_code' => null,
                    'stud_fee' => 3500,
                    'year_to_stud' => 1996,
                    'stud_fee_condition' => null,
                    'fee_cur_code' => 'GBP',
                    'exchange_rate' => null,
                    'weatherbys_uid' => 2626,
                    'private_flag' => 0,
                ]
            ),
        ]
    ],
    [
        new \Api\Input\Request\Horses\Bloodstock\StallionBook\Index(
            [],
            [
                'type' => 'weatherbys',
                'studFarm' => 'farm',
                'studCountryCode' => 'USA',
                'g1Winner' => 1,
                'g2Winner' => 1,
                'g3Winner' => 1,
            ]
        ),
        [
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 476627,
                    'style_name' => 'Distorted Humor',
                    'country_origin_code' => 'USA',
                    'sire_uid' => 304434,
                    'sire_style_name' => 'Forty Niner',
                    'sire_line_uid' => 301599,
                    'sire_line_style_name' => 'Mr Prospector',
                    'stud_name' => 'WinStar Farm, Kentucky',
                    'stud_country_code' => 'USA',
                    'stud_fee' => 50000,
                    'year_to_stud' => 2004,
                    'stud_fee_condition' => null,
                    'fee_cur_code' => 'USD',
                    'exchange_rate' => 1.47,
                    'weatherbys_uid' => 2312,
                    'private_flag' => 0,
                ]
            ),
        ]
    ],
    [
        new \Api\Input\Request\Horses\Bloodstock\StallionBook\Index(
            [],
            [
                'type' => 'weatherbys',
                'studFarm' => 'farm',
                'studCountryCode' => 'GB',
                'gradeWinners' => 1,
            ]
        ),
        [
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 601396,
                    'style_name' => 'Malinas',
                    'country_origin_code' => 'GER',
                    'sire_uid' => 68106,
                    'sire_style_name' => 'Lomitas',
                    'sire_line_uid' => 301671,
                    'sire_line_style_name' => 'Niniski',
                    'stud_name' => 'Yorton Farm Stud',
                    'stud_country_code' => 'GB',
                    'stud_fee' => 2000,
                    'year_to_stud' => 2012,
                    'stud_fee_condition' => null,
                    'fee_cur_code' => 'GBP',
                    'exchange_rate' => 1,
                    'weatherbys_uid' => 2396,
                    'private_flag' => 0,
                ]
            ),
        ]
    ],
    [
        new \Api\Input\Request\Horses\Bloodstock\StallionBook\Index(
            [],
            [
                'type' => 'weatherbys',
                'studCountryCode' => 'IRE',
                'blackTypeWinners' => 1,
            ]
        ),
        [
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 96595,
                    'style_name' => 'Presenting',
                    'country_origin_code' => 'GB',
                    'sire_uid' => 16491,
                    'sire_style_name' => 'Mtoto',
                    'sire_line_uid' => 300359,
                    'sire_line_style_name' => 'Busted',
                    'stud_name' => 'Rathbarry Stud',
                    'stud_country_code' => 'IRE',
                    'stud_fee' => 0,
                    'year_to_stud' => 2002,
                    'stud_fee_condition' => 'poa',
                    'fee_cur_code' => 'EUR',
                    'exchange_rate' => null,
                    'weatherbys_uid' => 2305,
                    'private_flag' => 1,
                ]
            ),
        ]
    ],
];
return $data;
