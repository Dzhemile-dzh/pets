<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 10/24/2016
 * Time: 3:50 PM
 */

use Api\Input\Request\Horses\Bloodstock\Sales as Request;

return [
    [
        new Request\UpcomingNames(
            [],
            [
                'dateFrom' => (new \DateTime())->add(new DateInterval('P1D'))->format('Y-m-d'),
                'dateTo' => (new \DateTime())->add(new DateInterval('P1D'))->format('Y-m-d')
            ]
        ),
        (Object)[
            'horse_names' => [
                0 => (Object)[
                    'horse_uid' => 864723,
                    'horse_name' => 'Valley Of Fire',
                ],
                1 => (Object)[
                    'horse_uid' => 901817,
                    'horse_name' => 'Kummiya',
                ],
                2 => (Object)[
                    'horse_uid' => 779044,
                    'horse_name' => 'Al Khan',
                ],
                3 => (Object)[
                    'horse_uid' => 850934,
                    'horse_name' => 'Mustaqqil',
                ],
                4 => (Object)[
                    'horse_uid' => 898215,
                    'horse_name' => 'Sky Ship',
                ],
                5 => (Object)[
                    'horse_uid' => 923935,
                    'horse_name' => 'Sukiwarrior',
                ],
                6 => (Object)[
                    'horse_uid' => 871829,
                    'horse_name' => 'Vive Ma Fille',
                ],
                7 => (Object)[
                    'horse_uid' => 878545,
                    'horse_name' => 'Iona Island',
                ],
                8 => (Object)[
                    'horse_uid' => 998323,
                    'horse_name' => 'Trooper\'s Gold',
                ],
                9 => (Object)[
                    'horse_uid' => 1043208,
                    'horse_name' => 'Fields Of Song',
                ],
                10 => (Object)[
                    'horse_uid' => 929321,
                    'horse_name' => 'Shannah Bint Eric',
                ],
                11 => (Object)[
                    'horse_uid' => 1093589,
                    'horse_name' => 'New Signal',
                ],
                12 => (Object)[
                    'horse_uid' => 858061,
                    'horse_name' => 'Intisaab',
                ],
                13 => (Object)[
                    'horse_uid' => 857203,
                    'horse_name' => 'That Is The Spirit',
                ],
                14 => (Object)[
                    'horse_uid' => 867873,
                    'horse_name' => 'Taraz',
                ],
                15 => (Object)[
                    'horse_uid' => 997245,
                    'horse_name' => 'Lawless Louis',
                ],
                16 => (Object)[
                    'horse_uid' => 812037,
                    'horse_name' => 'Hoofalong',
                ],
                17 => (Object)[
                    'horse_uid' => 844388,
                    'horse_name' => 'Slingsby',
                ],
                18 => (Object)[
                    'horse_uid' => 867276,
                    'horse_name' => 'Felix De Vega',
                ],
                19 => (Object)[
                    'horse_uid' => 870013,
                    'horse_name' => 'Heart Locket',
                ],
            ],
            'sire_names' => [
                0 => (Object)[
                    'sire_uid' => 543708,
                    'sire_name' => 'Firebreak',
                ],
                1 => (Object)[
                    'sire_uid' => 503875,
                    'sire_name' => 'Dansili',
                ],
                2 => (Object)[
                    'sire_uid' => 449518,
                    'sire_name' => 'Elnadim',
                ],
                3 => (Object)[
                    'sire_uid' => 506927,
                    'sire_name' => 'Invincible Spirit',
                ],
                4 => (Object)[
                    'sire_uid' => 682732,
                    'sire_name' => 'Raven\'s Pass',
                ],
                5 => (Object)[
                    'sire_uid' => 779232,
                    'sire_name' => 'Power',
                ],
                6 => (Object)[
                    'sire_uid' => 569100,
                    'sire_name' => 'Doyen',
                ],
                7 => (Object)[
                    'sire_uid' => 659772,
                    'sire_name' => 'Dutch Art',
                ],
                8 => (Object)[
                    'sire_uid' => 777155,
                    'sire_name' => 'Sepoy',
                ],
                9 => (Object)[
                    'sire_uid' => 784836,
                    'sire_name' => 'Harbour Watch',
                ],
                10 => (Object)[
                    'sire_uid' => 737744,
                    'sire_name' => 'Poet\'s Voice',
                ],
                11 => (Object)[
                    'sire_uid' => 670119,
                    'sire_name' => 'New Approach',
                ],
                12 => (Object)[
                    'sire_uid' => 565797,
                    'sire_name' => 'Oasis Dream',
                ],
                13 => (Object)[
                    'sire_uid' => 692355,
                    'sire_name' => 'Equiano',
                ],
                14 => (Object)[
                    'sire_uid' => 576872,
                    'sire_name' => 'Pastoral Pursuits',
                ],
                15 => (Object)[
                    'sire_uid' => 740981,
                    'sire_name' => 'Lope De Vega',
                ],
                16 => (Object)[
                    'sire_uid' => 647498,
                    'sire_name' => 'Champs Elysees',
                ],
            ],
            'dam_names' => [
                0 => (Object)[
                    'dam_uid' => 406454,
                    'dam_name' => 'Charlie Girl',
                ],
                1 => (Object)[
                    'dam_uid' => 480768,
                    'dam_name' => 'Balisada',
                ],
                2 => (Object)[
                    'dam_uid' => 661134,
                    'dam_name' => 'Popolo',
                ],
                3 => (Object)[
                    'dam_uid' => 660449,
                    'dam_name' => 'Cast In Gold',
                ],
                4 => (Object)[
                    'dam_uid' => 599619,
                    'dam_name' => 'Angara',
                ],
                5 => (Object)[
                    'dam_uid' => 592072,
                    'dam_name' => 'Umniya',
                ],
                6 => (Object)[
                    'dam_uid' => 657014,
                    'dam_name' => 'Vive Madame',
                ],
                7 => (Object)[
                    'dam_uid' => 802722,
                    'dam_name' => 'Still Small Voice',
                ],
                8 => (Object)[
                    'dam_uid' => 682398,
                    'dam_name' => 'Samira Gold',
                ],
                9 => (Object)[
                    'dam_uid' => 874862,
                    'dam_name' => 'Singing Field',
                ],
                10 => (Object)[
                    'dam_uid' => 844312,
                    'dam_name' => 'Crystal Mountain',
                ],
                11 => (Object)[
                    'dam_uid' => 569938,
                    'dam_name' => 'Davie\'s Lure',
                ],
                12 => (Object)[
                    'dam_uid' => 714696,
                    'dam_name' => 'Katoom',
                ],
                13 => (Object)[
                    'dam_uid' => 550549,
                    'dam_name' => 'Fraulein',
                ],
                14 => (Object)[
                    'dam_uid' => 709742,
                    'dam_name' => 'Tamarind',
                ],
                15 => (Object)[
                    'dam_uid' => 635408,
                    'dam_name' => 'Peace And Love',
                ],
                16 => (Object)[
                    'dam_uid' => 598979,
                    'dam_name' => 'Baymist',
                ],
                17 => (Object)[
                    'dam_uid' => 553902,
                    'dam_name' => 'Ballet Fame',
                ],
                18 => (Object)[
                    'dam_uid' => 502288,
                    'dam_name' => 'Lafite',
                ],
                19 => (Object)[
                    'dam_uid' => 483470,
                    'dam_name' => 'Zante',
                ],
            ],
            'damsire_names' => [
                0 => (Object)[
                    'damsire_uid' => 44767,
                    'damsire_name' => 'Puissance',
                ],
                1 => (Object)[
                    'damsire_uid' => 301292,
                    'damsire_name' => 'Kris',
                ],
                2 => (Object)[
                    'damsire_uid' => 511443,
                    'damsire_name' => 'Fasliyev',
                ],
                3 => (Object)[
                    'damsire_uid' => 466191,
                    'damsire_name' => 'Elusive Quality',
                ],
                4 => (Object)[
                    'damsire_uid' => 300057,
                    'damsire_name' => 'Alzao',
                ],
                5 => (Object)[
                    'damsire_uid' => 304230,
                    'damsire_name' => 'Bluebird',
                ],
                6 => (Object)[
                    'damsire_uid' => 22027,
                    'damsire_name' => 'Big Shuffle',
                ],
                7 => (Object)[
                    'damsire_uid' => 47437,
                    'damsire_name' => 'Polish Precedent',
                ],
                8 => (Object)[
                    'damsire_uid' => 472998,
                    'damsire_name' => 'Gold Away',
                ],
                9 => (Object)[
                    'damsire_uid' => 97591,
                    'damsire_name' => 'Singspiel',
                ],
                10 => (Object)[
                    'damsire_uid' => 513083,
                    'damsire_name' => 'Monashee Mountain',
                ],
                11 => (Object)[
                    'damsire_uid' => 80836,
                    'damsire_name' => 'Lure',
                ],
                12 => (Object)[
                    'damsire_uid' => 21738,
                    'damsire_name' => 'Soviet Star',
                ],
                13 => (Object)[
                    'damsire_uid' => 304736,
                    'damsire_name' => 'Acatenango',
                ],
                14 => (Object)[
                    'damsire_uid' => 463975,
                    'damsire_name' => 'Sadler\'s Wells',
                ],
                15 => (Object)[
                    'damsire_uid' => 480438,
                    'damsire_name' => 'Fantastic Light',
                ],
                16 => (Object)[
                    'damsire_uid' => 92491,
                    'damsire_name' => 'Mind Games',
                ],
                17 => (Object)[
                    'damsire_uid' => 54189,
                    'damsire_name' => 'Quest For Fame',
                ],
                18 => (Object)[
                    'damsire_uid' => 302068,
                    'damsire_name' => 'Robellino',
                ],
                19 => (Object)[
                    'damsire_uid' => 75918,
                    'damsire_name' => 'Zafonic',
                ],
            ],
            'vendor_names' => [
                0 => (Object)[
                    'vendor_name' => 'From Somerville Lodge Ltd. (W. Haggas)',
                ],
                1 => (Object)[
                    'vendor_name' => 'From Beckhampton House Stables (R. Charlton)',
                ],
                2 => (Object)[
                    'vendor_name' => 'From Hambleton Lodge Stables (K. Ryan)',
                ],
                3 => (Object)[
                    'vendor_name' => 'From David O\'Meara Racing Ltd.',
                ],
                4 => (Object)[
                    'vendor_name' => 'From Freemason Lodge Stables (Sir M. Stoute)',
                ],
                5 => (Object)[
                    'vendor_name' => 'From Faringdon Place Stables (C. Hills)',
                ],
                6 => (Object)[
                    'vendor_name' => 'From Kingsley House Stables (M. Johnston)',
                ],
                7 => (Object)[
                    'vendor_name' => 'to Dissolve a Partnership from Flaxton Stables (M. Easterby)',
                ],
            ],
        ]
    ]
];
