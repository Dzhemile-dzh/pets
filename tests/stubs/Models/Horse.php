<?php

namespace Tests\Stubs\Models;

use Phalcon\Mvc\Model\Exception as Exception;
use Phalcon\Mvc\Model as Model;
use \Phalcon\Mvc\Model\Row\General;

class Horse extends \Models\Horse
{
    use StubDataGetter;

    protected static $_stubData = [
        'horsesOriginal' => [
            867979 => [
                'horse_uid' => 867979,
                'horse_name' => 'ALI BIN NAYEF',
                'horse_sex_code' => 'G',
                'horse_date_of_birth' => '2012-02-29 00:00',
                'horse_date_of_death' => null,
                'country_origin_code' => 'GB',
                'sire_uid' => 522845,
                'dam_uid' => 686929,
                'breeder_uid' => 1074450,
                'horse_colour_code' => 'B',
                'date_gelded' => '2014-08-31 00:00',
                'source_uid' => null,
                'timestamp' => null,
                'searchname' => 'ALIBINNAYEF',
                'breeding_comment' => null,
                'darley' => null,
                'sire_comment' => null,
                'style_name' => 'Ali Bin Nayef'
            ],
            522845 => [
                'horse_uid' => 522845,
                'horse_name' => 'NAYEF',
                'horse_sex_code' => 'H',
                'horse_date_of_birth' => '2012-02-29 00:00',
                'horse_date_of_death' => null,
                'country_origin_code' => 'USA',
                'sire_uid' => 304579,
                'dam_uid' => 415950,
                'breeder_uid' => 11267,
                'horse_colour_code' => 'B',
                'date_gelded' => null,
                'source_uid' => null,
                'timestamp' => null,
                'searchname' => 'NAYEF',
                'breeding_comment' => 'top-class at 10-12f, half-brother to Nashwan; gets 2yo winners from summer, progeny progress',
                'darley' => null,
                'sire_comment' => null,
                'style_name' => 'Nayef'
            ],
            686929 => [
                'horse_uid' => 686929,
                'horse_name' => 'MAIMOONA',
                'horse_sex_code' => 'M',
                'horse_date_of_birth' => '2005-04-08 00:00',
                'horse_date_of_death' => null,
                'country_origin_code' => 'IRE',
                'sire_uid' => 107700,
                'dam_uid' => 517136,
                'breeder_uid' => 12571,
                'horse_colour_code' => 'CH',
                'date_gelded' => null,
                'source_uid' => null,
                'timestamp' => null,
                'searchname' => 'MAIMOONA',
                'breeding_comment' => null,
                'darley' => null,
                'sire_comment' => null,
                'style_name' => 'Maimoona'
            ],
            107700 => [
                'horse_uid' => 107700,
                'horse_name' => 'PIVOTAL',
                'horse_sex_code' => 'H',
                'horse_date_of_birth' => '1993-01-19 00:00',
                'horse_date_of_death' => null,
                'country_origin_code' => 'GB',
                'sire_uid' => 58836,
                'dam_uid' => 52825,
                'breeder_uid' => 279,
                'horse_colour_code' => 'CH',
                'date_gelded' => null,
                'source_uid' => null,
                'timestamp' => null,
                'searchname' => 'PIVOTAL',
                'breeding_comment' => null,
                'darley' => null,
                'sire_comment' => 'high-class sprinter, excellent sire, can get fast, high-class 2yos, progeny often progress well',
                'style_name' => 'Pivotal'
            ],
            304579 => [
                'horse_uid' => 304579,
                'horse_name' => 'GULCH',
                'horse_sex_code' => 'H',
                'horse_date_of_birth' => '1984-01-01 00:00',
                'horse_date_of_death' => null,
                'country_origin_code' => 'USA',
                'sire_uid' => 301599,
                'dam_uid' => 417700,
                'breeder_uid' => 279,
                'horse_colour_code' => 'B',
                'date_gelded' => null,
                'source_uid' => null,
                'timestamp' => null,
                'searchname' => 'GULCH',
                'breeding_comment' => null,
                'darley' => null,
                'sire_comment' => 'top-class US dirt runner, very good sire, can get high-class 2yos but progeny usually progress well	',
                'style_name' => 'Gulch'
            ],
            415950 => [
                'horse_uid' => 415950,
                'horse_name' => 'HEIGHT OF FASHION',
                'horse_sex_code' => 'M',
                'horse_date_of_birth' => '1979-01-01 00:00',
                'horse_date_of_death' => null,
                'country_origin_code' => 'FR',
                'sire_uid' => 300363,
                'dam_uid' => 416241,
                'breeder_uid' => null,
                'horse_colour_code' => 'B',
                'date_gelded' => null,
                'source_uid' => null,
                'timestamp' => null,
                'searchname' => 'HEIGHTOFFASHION',
                'breeding_comment' => null,
                'darley' => null,
                'sire_comment' => null,
                'style_name' => 'Height Of Fashion'
            ],
            517136 => [
                'horse_uid' => 517136,
                'horse_name' => 'SHURUK',
                'horse_sex_code' => 'M',
                'horse_date_of_birth' => '1997-03-09 00:00',
                'horse_date_of_death' => null,
                'country_origin_code' => 'GB',
                'sire_uid' => 9363,
                'dam_uid' => 21410,
                'breeder_uid' => 12571,
                'horse_colour_code' => 'CH',
                'date_gelded' => null,
                'source_uid' => null,
                'timestamp' => null,
                'searchname' => 'SHURUK',
                'breeding_comment' => null,
                'darley' => null,
                'sire_comment' => null,
                'style_name' => 'Shuruk'
            ],
            416241 => [
                'horse_uid' => 416241,
                'horse_name' => 'HIGHCLERE',
                'horse_sex_code' => 'M',
                'horse_date_of_birth' => null,
                'horse_date_of_death' => null,
                'country_origin_code' => 'GB',
                'sire_uid' => 307193,
                'dam_uid' => 442907,
                'breeder_uid' => null,
                'horse_colour_code' => 'U',
                'date_gelded' => null,
                'source_uid' => null,
                'timestamp' => null,
                'searchname' => 'HIGHCLERE',
                'breeding_comment' => null,
                'darley' => null,
                'sire_comment' => null,
                'style_name' => 'Highclere'
            ],
            417700 => [
                'horse_uid' => 417700,
                'horse_name' => 'JAMEELA',
                'horse_sex_code' => 'M',
                'horse_date_of_birth' => null,
                'horse_date_of_death' => null,
                'country_origin_code' => 'USA',
                'sire_uid' => 304644,
                'dam_uid' => 525007,
                'breeder_uid' => null,
                'horse_colour_code' => 'U',
                'date_gelded' => null,
                'source_uid' => null,
                'timestamp' => null,
                'searchname' => 'JAMEELA',
                'breeding_comment' => null,
                'darley' => null,
                'sire_comment' => null,
                'style_name' => 'Jameela'
            ],
            301599 => [
                'horse_uid' => 301599,
                'horse_name' => 'MR PROSPECTOR',
                'horse_sex_code' => 'H',
                'horse_date_of_birth' => '1970-01-01 00:00',
                'horse_date_of_death' => null,
                'country_origin_code' => 'USA',
                'sire_uid' => 301976,
                'dam_uid' => 442878,
                'breeder_uid' => null,
                'horse_colour_code' => 'B',
                'date_gelded' => null,
                'source_uid' => null,
                'timestamp' => null,
                'searchname' => 'MRPROSPECTOR',
                'breeding_comment' => 'superb stallion, frequently gets top-class 2yos',
                'darley' => null,
                'sire_comment' => null,
                'style_name' => 'Mr Prospector'
            ],
            9363 => [
                'horse_uid' => 9363,
                'horse_name' => 'CADEAUX GENEREUX',
                'horse_sex_code' => 'H',
                'horse_date_of_birth' => '1985-01-01 00:00',
                'horse_date_of_death' => '2010-11-20 00:00',
                'country_origin_code' => 'GB',
                'sire_uid' => 302745,
                'dam_uid' => 435766,
                'breeder_uid' => 151,
                'horse_colour_code' => 'CH',
                'date_gelded' => null,
                'source_uid' => null,
                'timestamp' => null,
                'searchname' => 'CADEAUXGENEREUX',
                'breeding_comment' => 'top-class sprinter, excellent source of high-class 2yos, progeny usually progress well, died 2010',
                'darley' => 'D',
                'sire_comment' => null,
                'style_name' => 'Cadeaux Genereux'
            ],
            21410 => [
                'horse_uid' => 21410,
                'horse_name' => 'HARMLESS ALBATROSS',
                'horse_sex_code' => 'M',
                'horse_date_of_birth' => '1985-01-01 00:00',
                'horse_date_of_death' => null,
                'country_origin_code' => 'GB',
                'sire_uid' => 301813,
                'dam_uid' => 427040,
                'breeder_uid' => 783,
                'horse_colour_code' => 'B',
                'date_gelded' => null,
                'source_uid' => null,
                'timestamp' => null,
                'searchname' => 'HARMLESSALBATROSS',
                'breeding_comment' => null,
                'darley' => null,
                'sire_comment' => null,
                'style_name' => 'Harmless Albatross'
            ],
            58836 => [
                'horse_uid' => 58836,
                'horse_name' => 'POLAR FALCON',
                'horse_sex_code' => 'H',
                'horse_date_of_birth' => '1987-01-01 00:00',
                'horse_date_of_death' => '2001-12-06 00:00',
                'country_origin_code' => 'USA',
                'sire_uid' => 301723,
                'dam_uid' => 422949,
                'breeder_uid' => 11177,
                'horse_colour_code' => 'H',
                'date_gelded' => null,
                'source_uid' => null,
                'timestamp' => null,
                'searchname' => 'POLARFALCON',
                'breeding_comment' => null,
                'darley' => null,
                'sire_comment' => 'top class 6-8f colt, can get smart 2yos, progeny often progress well, died 2001',
                'style_name' => 'Polar Falcon'
            ],
            52825 => [
                'horse_uid' => 52825,
                'horse_name' => 'FEARLESS REVIVAL',
                'horse_sex_code' => 'M',
                'horse_date_of_birth' => '1987-03-03 00:00',
                'horse_date_of_death' => null,
                'country_origin_code' => 'GB',
                'sire_uid' => 303554,
                'dam_uid' => 437330,
                'breeder_uid' => 279,
                'horse_colour_code' => 'CH',
                'date_gelded' => null,
                'source_uid' => null,
                'timestamp' => null,
                'searchname' => 'FEARLESSREVIVAL',
                'breeding_comment' => null,
                'darley' => null,
                'sire_comment' => null,
                'style_name' => 'Fearless Revival'
            ],
            300363 => [
                'horse_uid' => 300363,
                'horse_name' => 'BUSTINO',
                'horse_sex_code' => 'H',
                'horse_date_of_birth' => '1971-01-01 00:00',
                'horse_date_of_death' => null,
                'country_origin_code' => 'GB',
                'sire_uid' => 300359,
                'dam_uid' => 443117,
                'breeder_uid' => null,
                'horse_colour_code' => 'B',
                'date_gelded' => null,
                'source_uid' => null,
                'timestamp' => null,
                'searchname' => 'BUSTINO',
                'breeding_comment' => null,
                'darley' => null,
                'sire_comment' => 'top-class 12-14f performer, can get top middle-distance runners, but not known for 2yo winners',
                'style_name' => 'Bustino'
            ]
        ],
        'horses' => [
            599067 => [
                '2014-04-03' => [
                    [
                        'race_instance_uid' => 599067,
                        'style_name' => 'Cromwells Road',
                        'country_origin_code' => 'GB',
                        'horse_id' => 767928,
                        'start_number' => 5,
                        'owner_choice' => 'a',
                        'non_runner' => null,
                        'owner_uid' => 36503,
                        'owner_name' => 'Mrs Margaret Slattery',
                    ],
                    [
                        'race_instance_uid' => 599067,
                        'style_name' => 'Tobar Na Gaoise',
                        'country_origin_code' => 'GB',
                        'horse_id' => 787488,
                        'start_number' => 2,
                        'owner_choice' => 'u',
                        'non_runner' => 'Y',
                        'owner_uid' => 20887,
                        'owner_name' => 'John P McManus',
                    ],
                    [
                        'race_instance_uid' => 599067,
                        'style_name' => 'Gold Platinum',
                        'country_origin_code' => 'GB',
                        'horse_id' => 804452,
                        'start_number' => 14,
                        'owner_choice' => 'a',
                        'non_runner' => null,
                        'owner_uid' => 21838,
                        'owner_name' => 'W J Austin',
                    ],
                    [
                        'race_instance_uid' => 599067,
                        'style_name' => 'Desertmore Stream',
                        'country_origin_code' => 'GB',
                        'horse_id' => 809966,
                        'start_number' => 6,
                        'owner_choice' => 'd',
                        'non_runner' => null,
                        'owner_uid' => 113523,
                        'owner_name' => 'Gigginstown House Stud',
                    ],
                    [
                        'race_instance_uid' => 599067,
                        'style_name' => 'On Winsome Wings',
                        'country_origin_code' => 'GB',
                        'horse_id' => 821718,
                        'start_number' => 16,
                        'owner_choice' => 'b',
                        'non_runner' => null,
                        'owner_uid' => 94868,
                        'owner_name' => 'W Loughnane',
                    ],
                    [
                        'race_instance_uid' => 599067,
                        'style_name' => 'It\'s All An Act',
                        'country_origin_code' => 'GB',
                        'horse_id' => 825057,
                        'start_number' => 1,
                        'owner_choice' => 'a',
                        'non_runner' => null,
                        'owner_uid' => 18220,
                        'owner_name' => 'Mrs A F Mee',
                    ],
                    [
                        'race_instance_uid' => 599067,
                        'style_name' => 'Royal Boru',
                        'country_origin_code' => 'GB',
                        'horse_id' => 825321,
                        'start_number' => 9,
                        'owner_choice' => 'a',
                        'non_runner' => null,
                        'owner_uid' => 190543,
                        'owner_name' => 'Pearse Callaghan',
                    ],
                    [
                        'race_instance_uid' => 599067,
                        'style_name' => 'Top Man Tim',
                        'country_origin_code' => 'GB',
                        'horse_id' => 825382,
                        'start_number' => 12,
                        'owner_choice' => 'a',
                        'non_runner' => null,
                        'owner_uid' => 36793,
                        'owner_name' => 'M O Cullinane',
                    ],
                    [
                        'race_instance_uid' => 599067,
                        'style_name' => 'Lord Fingal',
                        'country_origin_code' => 'GB',
                        'horse_id' => 825822,
                        'start_number' => 7,
                        'owner_choice' => 'a',
                        'non_runner' => null,
                        'owner_uid' => 144013,
                        'owner_name' => 'Declan O\'Farrell',
                    ],
                    [
                        'race_instance_uid' => 599067,
                        'style_name' => 'Flowerpicker',
                        'country_origin_code' => 'GB',
                        'horse_id' => 830124,
                        'start_number' => 13,
                        'owner_choice' => 'a',
                        'non_runner' => null,
                        'owner_uid' => 60051,
                        'owner_name' => 'F A Hayes',
                    ],
                    [
                        'race_instance_uid' => 599067,
                        'style_name' => 'Grangeclare Pearl',
                        'country_origin_code' => 'GB',
                        'horse_id' => 832053,
                        'start_number' => 15,
                        'owner_choice' => 'a',
                        'non_runner' => null,
                        'owner_uid' => 188799,
                        'owner_name' => 'Ethel Flanagan',
                    ],
                    [
                        'race_instance_uid' => 599067,
                        'style_name' => 'Company Coming',
                        'country_origin_code' => 'GB',
                        'horse_id' => 832105,
                        'start_number' => 4,
                        'owner_choice' => 'a',
                        'non_runner' => null,
                        'owner_uid' => 216754,
                        'owner_name' => 'P P Greaney',
                    ],
                    [
                        'race_instance_uid' => 599067,
                        'style_name' => 'Ryansbrook',
                        'country_origin_code' => 'GB',
                        'horse_id' => 835053,
                        'start_number' => 10,
                        'owner_choice' => 'a',
                        'non_runner' => null,
                        'owner_uid' => 165966,
                        'owner_name' => 'Thomas Friel',
                    ],
                    [
                        'race_instance_uid' => 599067,
                        'style_name' => 'Mister Victor',
                        'country_origin_code' => 'GB',
                        'horse_id' => 837786,
                        'start_number' => 8,
                        'owner_choice' => 'a',
                        'non_runner' => null,
                        'owner_uid' => 153817,
                        'owner_name' => 'Shane J Harrington',
                    ],
                    [
                        'race_instance_uid' => 599067,
                        'style_name' => 'She Be Fine',
                        'country_origin_code' => 'GB',
                        'horse_id' => 850398,
                        'start_number' => 17,
                        'owner_choice' => 'a',
                        'non_runner' => null,
                        'owner_uid' => 163068,
                        'owner_name' => 'Ms Mary Mullins',
                    ],
                    [
                        'race_instance_uid' => 599067,
                        'style_name' => 'Take The Hit',
                        'country_origin_code' => 'GB',
                        'horse_id' => 852951,
                        'start_number' => 11,
                        'owner_choice' => 'a',
                        'non_runner' => null,
                        'owner_uid' => 42595,
                        'owner_name' => 'L F Curtin',
                    ],
                    [
                        'race_instance_uid' => 599067,
                        'style_name' => 'Bold Conquest',
                        'country_origin_code' => 'GB',
                        'horse_id' => 854026,
                        'start_number' => 3,
                        'owner_choice' => 'a',
                        'non_runner' => null,
                        'owner_uid' => 19333,
                        'owner_name' => 'P J Gleeson',
                    ]
                ]
            ],
            597477 => [
                '2014-04-05' => [
                    0 => [
                        'race_instance_uid' => 597477,
                        'style_name' => 'Ohio Gold',
                        'country_origin_code' => 'GB',
                        'horse_id' => 750295,
                        'start_number' => 3,
                        'owner_choice' => 'a',
                        'non_runner' => null,
                        'owner_uid' => 45508,
                        'owner_name' => 'P M Warren',
                    ],
                    1 => [
                        'race_instance_uid' => 597477,
                        'style_name' => 'Muldoon\'s Picnic',
                        'country_origin_code' => 'GB',
                        'horse_id' => 756415,
                        'start_number' => 2,
                        'owner_choice' => 'a',
                        'non_runner' => null,
                        'owner_uid' => 63031,
                        'owner_name' => 'Clive Washbourn',
                    ],
                    2 => [
                        'race_instance_uid' => 597477,
                        'style_name' => 'Destroyer Deployed',
                        'country_origin_code' => 'GB',
                        'horse_id' => 768469,
                        'start_number' => 4,
                        'owner_choice' => 'a',
                        'non_runner' => null,
                        'owner_uid' => 86866,
                        'owner_name' => 'The Craftsmen',
                    ],
                    3 => [
                        'race_instance_uid' => 597477,
                        'style_name' => 'Financial Climate',
                        'country_origin_code' => 'GB',
                        'horse_id' => 778278,
                        'start_number' => 7,
                        'owner_choice' => 'a',
                        'non_runner' => null,
                        'owner_uid' => 197849,
                        'owner_name' => 'Mrs Sara Fillery',
                    ],
                    4 => [
                        'race_instance_uid' => 597477,
                        'style_name' => 'Whats Happening',
                        'country_origin_code' => 'GB',
                        'horse_id' => 781217,
                        'start_number' => 1,
                        'owner_choice' => 'a',
                        'non_runner' => null,
                        'owner_uid' => 216241,
                        'owner_name' => 'David Rea, Mike George & ECD Ltd',
                    ],
                    5 => [
                        'race_instance_uid' => 597477,
                        'style_name' => 'Saroque',
                        'country_origin_code' => 'GB',
                        'horse_id' => 799944,
                        'start_number' => 5,
                        'owner_choice' => 'a',
                        'non_runner' => null,
                        'owner_uid' => 181256,
                        'owner_name' => 'A Brooks',
                    ],
                    6 => [
                        'race_instance_uid' => 597477,
                        'style_name' => 'Samingarry',
                        'country_origin_code' => 'GB',
                        'horse_id' => 808888,
                        'start_number' => 6,
                        'owner_choice' => 'a',
                        'non_runner' => null,
                        'owner_uid' => 133719,
                        'owner_name' => 'D R Mead',
                    ],
                    7 => [
                        'race_instance_uid' => 597477,
                        'style_name' => 'Dont Do Mondays',
                        'country_origin_code' => 'GB',
                        'horse_id' => 810839,
                        'start_number' => 8,
                        'owner_choice' => 'a',
                        'non_runner' => null,
                        'owner_uid' => 127574,
                        'owner_name' => 'F W K Griffin',
                    ],
                    8 => [
                        'race_instance_uid' => 597476,
                        'style_name' => 'Dont1 Do Mondays',
                        'country_origin_code' => 'GB',
                        'horse_id' => 810836,
                        'start_number' => 8,
                        'owner_choice' => 'a',
                        'non_runner' => null,
                        'owner_uid' => 127574,
                        'owner_name' => 'F W K Griffin',
                    ],
                ]
            ],
            1 => [
                '2014-04-05' => [
                    [
                        'race_instance_uid' => 1,
                        'style_name' => 'Ohio Gold',
                        'country_origin_code' => 'GB',
                        'horse_id' => 750295,
                        'start_number' => 3,
                        'owner_choice' => 'a',
                        'non_runner' => null,
                        'owner_uid' => 45508,
                        'owner_name' => 'P M Warren',
                    ],
                ]
            ],
            2 => [
                '2014-04-05' => [
                    [
                        'race_instance_uid' => 2,
                        'style_name' => 'Ohio Gold',
                        'country_origin_code' => 'GB',
                        'horse_id' => 750295,
                        'start_number' => 3,
                        'owner_choice' => 'a',
                        'non_runner' => null,
                        'owner_uid' => 45508,
                        'owner_name' => 'P M Warren',
                    ],
                ]
            ],
            3 => [
                '2014-04-05' => [
                    [
                        'race_instance_uid' => 3,
                        'style_name' => 'Ohio Gold',
                        'country_origin_code' => 'GB',
                        'horse_id' => 750295,
                        'start_number' => 3,
                        'owner_choice' => 'a',
                        'non_runner' => null,
                        'owner_uid' => 45508,
                        'owner_name' => 'P M Warren',
                    ],
                ]
            ]
        ]
    ];

    /**
     * @param int $horseUid
     *
     * @return Model\Row
     */
    public function getHorseByUid($horseUid)
    {
        $row = null;

        if (isset(self::getStubData('horsesOriginal')[$horseUid])) {
            $row = \Api\Row\Horse::createFromArray(
                self::getStubData('horsesOriginal')[$horseUid]
            );
        }

        return $row;
    }
}