<?php

use Api\Input\Request\Horses\Bloodstock\Sales as Request;

return [
    [
        new Request\UpcomingSales([], [
            'dateFrom' => (new \DateTime())->format('Y-m-d'),
            'dateTo' => (new \DateTime())->add(new \DateInterval('P1D'))->format('Y-m-d'),
            'age' => 2,
            'sales' => ['20160614_32'],
            'vendor' => 'sales',
            'sire' => 'wild',
            'name' => 'wild',
            'dam' => 'bad',
            'damSire' => 'bern'
        ]),
        [
            0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 890346,
                    'horse_name' => 'ZIG ZAG',
                    'horse_style_name' => 'Zig Zag',
                    'dam_date_of_birth' => 'Apr 11 1998 12:00AM',
                    'dam_style_name' => 'Le Montrachet',
                    'sire_style_name' => 'Zoffany',
                    'sire_of_dam_style_name' => 'Nashwan',
                    'horse_country_origin_code' => 'IRE',
                    'horse_first_colour_code' => 'B',
                    'horse_sex' => 'G',
                    'horse_age' => 4,
                    'sire_uid' => 756093,
                    'sire_name' => 'ZOFFANY',
                    'sire_country_origin_code' => 'IRE',
                    'dam_uid' => 628647,
                    'dam_name' => 'LE MONTRACHET',
                    'dam_country_origin_code' => 'GB',
                    'sire_of_dam_uid' => 43064,
                    'sire_of_dam_name' => 'NASHWAN',
                    'sire_of_dam_ctry_org_code' => 'USA',
                    'venue_desc' => 'GOFFS UK (DONCASTER)',
                    'venue_uid' => 44,
                    'sale_name' => 'Goffs UK September Sale 2017',
                    'sale_date' => 'Sep  6 2017 12:00AM',
                    'seller_name' => 'From Carriganog Racing, Ireland (Joseph O\'Brien)',
                    'catalogue_pedigree_pdf_url' => 'www.goffsuk.com/GoffsCMS/_Sales/146/194.pdf',
                    'lot_no' => 194,
                    'lot_no1' => 194,
                    'lot_letter' => ' ',
                    'price' => 11000,
                    'buyer_detail' => 'Philip Kirby',
                    'yob' => 2013,
                    'sirecam_video_html' => null,
                    'currency' => 'GBP',
                    'entered' => false,
                    'entry_race_uid' => [
                        683418,
                        680419,
                        681911,
                        679704,
                        682802,
                        680844,
                        682318
                    ],
                ]
            ),
        ],
    ],
];
