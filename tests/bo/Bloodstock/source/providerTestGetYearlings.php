<?php

use Api\Input\Request\Horses\Bloodstock\Statistics as Request;

return [
    [
        new Request\Yearlings([], ['countryFlag' => 'USA']),
        [
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sire_uid' => 14363,
                    'sire_name' => 'ASCOT KNIGHT',
                    'style_name' => 'Ascot Knight',
                    'country_origin_code' => 'CAN',
                    'colts' =>
                        Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'median' => 100000,
                                'price_average' => 100000,
                                'price_total' => 100000,
                                'price_top' => 100000,
                                'prices' =>
                                    array(
                                        0 => 100000,
                                    ),
                                'sales_count' => 1,
                                'offered_count' => 1,
                                'percent_clearance_rate' => 100,
                            ]
                        ),
                    'fillies' =>
                        Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'median' => null,
                                'price_average' => 0,
                                'price_total' => 0,
                                'price_top' => 0,
                                'prices' =>
                                    array(),
                                'sales_count' => 0,
                                'offered_count' => 0,
                                'percent_clearance_rate' => 0,
                            ]
                        ),
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sire_uid' => 22751,
                    'sire_name' => 'BET TWICE',
                    'style_name' => 'Bet Twice',
                    'country_origin_code' => 'GB',
                    'colts' =>
                        Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'median' => 30000,
                                'price_average' => 30000,
                                'price_total' => 30000,
                                'price_top' => 30000,
                                'prices' =>
                                    array(
                                        0 => 30000,
                                    ),
                                'sales_count' => 1,
                                'offered_count' => 1,
                                'percent_clearance_rate' => 100,
                            ]
                        ),
                    'fillies' =>
                        Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'median' => null,
                                'price_average' => 0,
                                'price_total' => 0,
                                'price_top' => 0,
                                'prices' =>
                                    array(),
                                'sales_count' => 0,
                                'offered_count' => 0,
                                'percent_clearance_rate' => 0,
                            ]
                        ),
                ]
            )
        ],
        [
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'sale_year' => 1991,
                'sire_name' => 'ASCOT KNIGHT',
                'style_name' => 'Ascot Knight',
                'country_origin_code' => 'CAN',
                'horse_uid' => 14363,
                'horse_sex' => 'C',
                'buyer_detail' => 'Shadwell Estate Co Ltd',
                'price' => 100000,
                'exchange_rate_euro' => 1,
                'exchange_rate' => 1.9299999999999999,
                'currency_code' => 'USD',
                'cur_code' => 'USD',
            ]),
            \Phalcon\Mvc\Model\Row\General::createFromArray([
                'sale_year' => 1991,
                'sire_name' => 'BET TWICE',
                'style_name' => 'Bet Twice',
                'country_origin_code' => 'GB',
                'horse_uid' => 22751,
                'horse_sex' => 'C',
                'buyer_detail' => 'Jerome J Meyers',
                'price' => 30000,
                'exchange_rate_euro' => 1,
                'exchange_rate' => 1.9299999999999999,
                'currency_code' => 'USD',
                'cur_code' => 'USD',
            ]),
        ]
    ]
];
