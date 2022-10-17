<?php

use \Phalcon\Mvc\Model\Row\General;
use Api\Input\Request\Horses\Bloodstock\SalesStatistics\Sales as Request;

return [
    [
        new Request([4, '2017-06-30', '2017-06-30']),
        [
            0 => General::createFromArray([
                'sale_date' => '06/30/2017',
                'buyer_detail' => 'Francis Flood',
                'price' => 46000,
                'exchange_rate' => 1.1699999999999999,
                'horse_sex' => 'G',
                'horse_sex_flag' => 'M',
                'horse_age' => 3,
                'cur_code' => 'EUR',
                'currency_code' => 'EUR',
            ]),
            1 => General::createFromArray([
                'sale_date' => '06/30/2017',
                'buyer_detail' => 'Aiden Murphy (C Poste)',
                'price' => 46000,
                'exchange_rate' => 1.1699999999999999,
                'horse_sex' => 'G',
                'horse_sex_flag' => 'M',
                'horse_age' => 3,
                'cur_code' => 'EUR',
                'currency_code' => 'EUR',
            ]),
            2 => General::createFromArray([
                'sale_date' => '06/30/2017',
                'buyer_detail' => 'Joey Logan Bloodstock',
                'price' => 42000,
                'exchange_rate' => 1.1699999999999999,
                'horse_sex' => 'G',
                'horse_sex_flag' => 'M',
                'horse_age' => 3,
                'cur_code' => 'EUR',
                'currency_code' => 'EUR',
            ]),
            3 => General::createFromArray([
                'sale_date' => '06/30/2017',
                'buyer_detail' => 'Youngstars',
                'price' => 38000,
                'exchange_rate' => 1.1699999999999999,
                'horse_sex' => 'G',
                'horse_sex_flag' => 'M',
                'horse_age' => 3,
                'cur_code' => 'EUR',
                'currency_code' => 'EUR',
            ]),
            4 => General::createFromArray([
                'sale_date' => '06/30/2017',
                'buyer_detail' => 'Milestone Bloodstock',
                'price' => 38000,
                'exchange_rate' => 1.1699999999999999,
                'horse_sex' => 'G',
                'horse_sex_flag' => 'M',
                'horse_age' => 3,
                'cur_code' => 'EUR',
                'currency_code' => 'EUR',
            ]),
            5 => General::createFromArray([
                'sale_date' => '06/30/2017',
                'buyer_detail' => 'Ian Ferguson',
                'price' => 37000,
                'exchange_rate' => 1.1699999999999999,
                'horse_sex' => 'F',
                'horse_sex_flag' => 'F',
                'horse_age' => 3,
                'cur_code' => 'EUR',
                'currency_code' => 'EUR',
            ]),
            6 => General::createFromArray([
                'sale_date' => '06/30/2017',
                'buyer_detail' => 'Kilronan',
                'price' => 35000,
                'exchange_rate' => 1.1699999999999999,
                'horse_sex' => 'G',
                'horse_sex_flag' => 'M',
                'horse_age' => 3,
                'cur_code' => 'EUR',
                'currency_code' => 'EUR',
            ]),
            7 => General::createFromArray([
                'sale_date' => '06/30/2017',
                'buyer_detail' => 'Kilronan',
                'price' => 35000,
                'exchange_rate' => 1.1699999999999999,
                'horse_sex' => 'G',
                'horse_sex_flag' => 'M',
                'horse_age' => 3,
                'cur_code' => 'EUR',
                'currency_code' => 'EUR',
            ]),
            8 => General::createFromArray([
                'sale_date' => '06/30/2017',
                'buyer_detail' => 'Warren Ewing',
                'price' => 35000,
                'exchange_rate' => 1.1699999999999999,
                'horse_sex' => 'G',
                'horse_sex_flag' => 'M',
                'horse_age' => 3,
                'cur_code' => 'EUR',
                'currency_code' => 'EUR',
            ]),
            9 => General::createFromArray([
                'sale_date' => '06/30/2017',
                'buyer_detail' => 'James O\'Rourke',
                'price' => 35000,
                'exchange_rate' => 1.1699999999999999,
                'horse_sex' => 'G',
                'horse_sex_flag' => 'M',
                'horse_age' => 3,
                'cur_code' => 'EUR',
                'currency_code' => 'EUR',
            ]),
        ],
        (Object)[
            'days' => [
                0 => General::createFromArray([
                    'sale_date' => '06/30/2017',
                    'median' => 37500,
                    'price_average' => 38700,
                    'price_max' => 46000,
                    'price_min' => 35000,
                    'price_total' => 387000,
                    'price_top' => 0,
                    'prices' => [
                        0 => 46000,
                        1 => 46000,
                        2 => 42000,
                        3 => 38000,
                        4 => 38000,
                        5 => 37000,
                        6 => 35000,
                        7 => 35000,
                        8 => 35000,
                        9 => 35000,
                    ],
                    'price_count' => 10,
                    'sales_count' => 10,
                    'sold' => true,
                    'offered_count' => 10,
                    'buyers_count' => 10,
                    'withdraws_count' => 0,
                    'total_count' => 10,
                    'cur_code' => 'EUR',
                    'horse_sex_flag' => 'M',
                    'buyer_detail' => 'James O\'Rourke',
                    'price' => 35000,
                    'exchange_rate' => 1.1699999999999999,
                    'currency_code' => 'EUR',
                ]),
            ],
            'overall' => General::createFromArray([
                'sale_date' => '06/30/2017',
                'median' => 37500,
                'price_average' => 38700,
                'price_max' => 46000,
                'price_min' => 35000,
                'price_total' => 387000,
                'price_top' => 0,
                'prices' => [
                    0 => 46000,
                    1 => 46000,
                    2 => 42000,
                    3 => 38000,
                    4 => 38000,
                    5 => 37000,
                    6 => 35000,
                    7 => 35000,
                    8 => 35000,
                    9 => 35000,
                ],
                'price_count' => 10,
                'sales_count' => 10,
                'sold' => true,
                'offered_count' => 10,
                'buyers_count' => 10,
                'withdraws_count' => 0,
                'total_count' => 10,
                'cur_code' => 'EUR',
                'horse_sex_flag' => 'M',
                'buyer_detail' => 'James O\'Rourke',
                'price' => 35000,
                'exchange_rate' => 1.1699999999999999,
                'currency_code' => 'EUR',
            ]),
            'colts' => General::createFromArray([
                'sale_date' => '06/30/2017',
                'median' => 38000,
                'price_average' => 38888.889999999999,
                'price_max' => 46000,
                'price_min' => 35000,
                'price_total' => 350000,
                'price_top' => 0,
                'prices' => [
                    0 => 46000,
                    1 => 46000,
                    2 => 42000,
                    3 => 38000,
                    4 => 38000,
                    5 => 35000,
                    6 => 35000,
                    7 => 35000,
                    8 => 35000,
                ],
                'price_count' => 9,
                'sales_count' => 9,
                'sold' => true,
                'offered_count' => 9,
                'buyers_count' => 9,
                'withdraws_count' => 0,
                'total_count' => 9,
                'cur_code' => 'EUR',
                'horse_sex_flag' => 'M',
                'buyer_detail' => 'James O\'Rourke',
                'price' => 35000,
                'exchange_rate' => 1.1699999999999999,
                'currency_code' => 'EUR',
            ]),
            'fillies' => General::createFromArray([
                'sale_date' => '06/30/2017',
                'median' => 37000,
                'price_average' => 37000,
                'price_max' => 37000,
                'price_min' => 37000,
                'price_total' => 37000,
                'price_top' => 0,
                'prices' => [
                    0 => 37000,
                ],
                'price_count' => 1,
                'sales_count' => 1,
                'sold' => true,
                'offered_count' => 1,
                'buyers_count' => 1,
                'withdraws_count' => 0,
                'total_count' => 1,
                'cur_code' => 'EUR',
                'horse_sex_flag' => 'F',
                'buyer_detail' => 'Ian Ferguson',
                'price' => 37000,
                'exchange_rate' => 1.1699999999999999,
                'currency_code' => 'EUR',
            ]),
        ],
    ],
];