<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 5/8/2017
 * Time: 12:37 PM
 */

namespace Tests\Stubs\DataProvider\Bo\GoingToSuit;

class RaceFlags extends \Api\DataProvider\Bo\GoingToSuit\RaceFlags
{
    public function getHorsesUid($request)
    {
        $data = [
            1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'race_instance_uid' => 673422,
                    'race_datetime' => 'May  9 2017  2:00PM',
                    'race_type_code' => 'F',
                    'going_type_code' => 'GF',
                    'going_type_desc' => 'Good To Firm',
                    'horses' => [
                        0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'horse_uid' => 1355229,
                                'horse_style_name' => 'Calypso Jo',
                                'horse_country_origin_code' => 'IRE',
                                'sire_uid' => 448003,
                                'sire_style_name' => 'Bahamian Bounty',
                                'sire_country' => 'GB',
                                'jockey_uid' => 91867,
                                'jockey_style_name' => 'Kevin Stott',
                                'trainer_uid' => 22525,
                                'trainer_style_name' => 'Kevin Ryan',
                                'owner_uid' => 213757,
                                'owner_style_name' => 'Guy Reed Racing',
                                'non_runner' => null,
                                'draw' => 3,
                                'rp_topspeed' => null,
                                'rp_postmark' => 78,
                                'rp_owner_choice' => 'a',
                                'start_number' => 1,
                                'going_form' => null,
                            ]
                        ),
                        1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'horse_uid' => 998357,
                                'horse_style_name' => 'Dalton',
                                'horse_country_origin_code' => 'IRE',
                                'sire_uid' => 756946,
                                'sire_style_name' => 'Mayson',
                                'sire_country' => 'GB',
                                'jockey_uid' => 82231,
                                'jockey_style_name' => 'Daniel Tudhope',
                                'trainer_uid' => 22839,
                                'trainer_style_name' => 'David O\'Meara',
                                'owner_uid' => 126605,
                                'owner_style_name' => 'David W Armstrong',
                                'non_runner' => null,
                                'draw' => 2,
                                'rp_topspeed' => 61,
                                'rp_postmark' => 76,
                                'rp_owner_choice' => 'a',
                                'start_number' => 2,
                                'going_form' => null,
                            ]
                        ),
                        2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'horse_uid' => 1096828,
                                'horse_style_name' => 'Hee Haw',
                                'horse_country_origin_code' => 'IRE',
                                'sire_uid' => 589184,
                                'sire_style_name' => 'Sleeping Indian',
                                'sire_country' => 'GB',
                                'jockey_uid' => 2572,
                                'jockey_style_name' => 'Joe Fanning',
                                'trainer_uid' => 24548,
                                'trainer_style_name' => 'Keith Dalgleish',
                                'owner_uid' => 2015,
                                'owner_style_name' => 'Mrs Janis Macpherson',
                                'non_runner' => null,
                                'draw' => 4,
                                'rp_topspeed' => 73,
                                'rp_postmark' => 79,
                                'rp_owner_choice' => 'a',
                                'start_number' => 3,
                                'going_form' => null,
                            ]
                        ),
                        3 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'horse_uid' => 1035092,
                                'horse_style_name' => 'Poet\'s Reward',
                                'horse_country_origin_code' => 'IRE',
                                'sire_uid' => 655133,
                                'sire_style_name' => 'Hellvelyn',
                                'sire_country' => 'GB',
                                'jockey_uid' => 81149,
                                'jockey_style_name' => 'Phillip Makin',
                                'trainer_uid' => 542,
                                'trainer_style_name' => 'David Barron',
                                'owner_uid' => 59635,
                                'owner_style_name' => 'Laurence O\'Kane',
                                'non_runner' => null,
                                'draw' => 6,
                                'rp_topspeed' => null,
                                'rp_postmark' => 86,
                                'rp_owner_choice' => 'a',
                                'start_number' => 4,
                                'going_form' => null,
                            ]
                        ),
                        4 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'horse_uid' => 998410,
                                'horse_style_name' => 'England Expects',
                                'horse_country_origin_code' => 'IRE',
                                'sire_uid' => 660604,
                                'sire_style_name' => 'Mount Nelson',
                                'sire_country' => 'GB',
                                'jockey_uid' => 93480,
                                'jockey_style_name' => 'Clifford Lee',
                                'trainer_uid' => 5019,
                                'trainer_style_name' => 'K R Burke',
                                'owner_uid' => 218616,
                                'owner_style_name' => 'Tim Dykes & Jon Hughes',
                                'non_runner' => null,
                                'draw' => 1,
                                'rp_topspeed' => 48,
                                'rp_postmark' => 74,
                                'rp_owner_choice' => 'a',
                                'start_number' => 5,
                                'going_form' => null,
                            ]
                        ),
                        5 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'horse_uid' => 1048757,
                                'horse_style_name' => 'Miss Quick',
                                'horse_country_origin_code' => 'IRE',
                                'sire_uid' => 692355,
                                'sire_style_name' => 'Equiano',
                                'sire_country' => 'FR',
                                'jockey_uid' => 90103,
                                'jockey_style_name' => 'Shane Gray',
                                'trainer_uid' => 5372,
                                'trainer_style_name' => 'Ann Duffield',
                                'owner_uid' => 167464,
                                'owner_style_name' => 'J Acheson',
                                'non_runner' => null,
                                'draw' => 5,
                                'rp_topspeed' => null,
                                'rp_postmark' => 55,
                                'rp_owner_choice' => 'a',
                                'start_number' => 6,
                                'going_form' => null,
                            ]
                        ),
                    ],
                ]
            ),
            777 => [],
        ];

        return isset($data[$request->getRaceId()]) ? $data[$request->getRaceId()] : null;
    }
}
