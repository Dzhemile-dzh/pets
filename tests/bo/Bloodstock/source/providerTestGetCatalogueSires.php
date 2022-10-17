<?php

use Api\Input\Request\Horses\Bloodstock\Sales as Request;

return [
    [
        new Request\CatalogueSires([], ['venueId' => 36, 'startDate' => '2016-05-01', 'endDate' => '2016-06-01']),
        [
            732354 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sire_uid' => 732354,
                    'sire_name' => 'CANFORD CLIFFS',
                    'sire_style_name' => 'Canford Cliffs',
                    'total_lots' => 1,
                    'total_lots_fillies' => 1,
                    'total_lots_colts' => 0,
                    'stud_name' => 'Coolmore Stud',
                    'stud_fee' => 17500,
                    'stud_fee_gbp' => '12867.647058823529411',
                    'cur_code' => 'EUR',
                ]
            ),
            773055 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sire_uid' => 773055,
                    'sire_name' => 'BORN TO SEA',
                    'sire_style_name' => 'Born To Sea',
                    'total_lots' => 2,
                    'total_lots_fillies' => 0,
                    'total_lots_colts' => 2,
                    'stud_name' => 'Gilltown Stud',
                    'stud_fee' => 10000,
                    'stud_fee_gbp' => '7352.941176470588235',
                    'cur_code' => 'EUR',
                ]
            ),
            763453 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sire_uid' => 763453,
                    'sire_name' => 'FRANKEL',
                    'sire_style_name' => 'Frankel',
                    'total_lots' => 2,
                    'total_lots_fillies' => 1,
                    'total_lots_colts' => 1,
                    'stud_name' => 'Banstead Manor Stud',
                    'stud_fee' => 125000,
                    'stud_fee_gbp' => '125000.000000000000000',
                    'cur_code' => 'GBP',
                ]
            ),
            565797 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sire_uid' => 565797,
                    'sire_name' => 'OASIS DREAM',
                    'sire_style_name' => 'Oasis Dream',
                    'total_lots' => 1,
                    'total_lots_fillies' => 1,
                    'total_lots_colts' => 0,
                    'stud_name' => 'Banstead Manor Stud',
                    'stud_fee' => 75000,
                    'stud_fee_gbp' => '75000.000000000000000',
                    'cur_code' => 'GBP',
                ]
            ),
            742548 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'sire_uid' => 742548,
                    'sire_name' => 'SO YOU THINK',
                    'sire_style_name' => 'So You Think',
                    'total_lots' => 2,
                    'total_lots_fillies' => 0,
                    'total_lots_colts' => 2,
                    'stud_name' => 'Coolmore Stud',
                    'stud_fee' => 12500,
                    'stud_fee_gbp' => '9191.176470588235294',
                    'cur_code' => 'EUR',
                ]
            ),
        ],
    ],
];
