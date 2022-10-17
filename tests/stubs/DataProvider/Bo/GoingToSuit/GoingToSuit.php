<?php

/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/31/2016
 * Time: 12:16 PM
 */

namespace Tests\Stubs\DataProvider\Bo\GoingToSuit;

use Api\Input\Request\Horses\GoingToSuit as Request;

class GoingToSuit extends \Api\DataProvider\Bo\GoingToSuit\GoingToSuit
{
    public function getHorsesByRaceId(Request\Index $request)
    {
        $res = [
            666102 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'race_instance_uid' => 666102,
                    'race_instance_title' => 'Racing UK Profits Returned To Racing Maiden Hurdle',
                    'race_datetime' => 'Jan 17 2017  1:45PM',
                    'race_status_code' => 'R',
                    'going_type_code' => 'HY',
                    'going_type_desc' => 'Heavy',
                    'distance_yard' => 5350,
                    'race_type_code' => 'H',
                    'race_group_code' => '0',
                    'race_group_desc' => 'Unknown',
                    'perform_race_uid_atr' => null,
                    'perform_race_uid_ruk' => 1214905,
                    'no_of_runners' => null,
                    'country_code' => 'GB',
                    'course_uid' => 3,
                    'course_name' => 'AYR',
                    'course_style_name' => 'Ayr',
                    'declared_runners' => 8,
                    'horses' => [
                        0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'horse_uid' => 919889,
                                'horse_style_name' => 'Billy Bronco',
                                'horse_name' => 'BILLY BRONCO',
                                'sire_uid' => 458175,
                                'sire_style_name' => 'Central Park',
                                'sire_country' => 'IRE',
                                'jockey_uid' => 13380,
                                'jockey_style_name' => 'Paul Moloney',
                                'trainer_uid' => 13451,
                                'trainer_style_name' => 'Evan Williams',
                                'owner_uid' => 153545,
                                'owner_style_name' => 'Mr & Mrs William Rucker',
                                'non_runner' => null,
                                'draw' => 0,
                                'rp_topspeed' => 94,
                                'rp_postmark' => 129,
                                'rp_owner_choice' => 'a',
                                'start_number' => 1,
                                'going_form' => null,
                            ]
                        ),
                        1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'horse_uid' => 928591,
                                'horse_style_name' => 'Front At The Last',
                                'horse_name' => 'FRONT AT THE LAST',
                                'sire_uid' => 522793,
                                'sire_style_name' => 'Golan',
                                'sire_country' => 'IRE',
                                'jockey_uid' => 76669,
                                'jockey_style_name' => 'Will Kennedy',
                                'trainer_uid' => 15674,
                                'trainer_style_name' => 'Donald McCain',
                                'owner_uid' => 63055,
                                'owner_style_name' => 'Aykroyd And Sons Ltd',
                                'non_runner' => null,
                                'draw' => 0,
                                'rp_topspeed' => 85,
                                'rp_postmark' => 123,
                                'rp_owner_choice' => 'a',
                                'start_number' => 2,
                                'going_form' => null,
                            ]
                        ),
                        2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'horse_uid' => 803906,
                                'horse_style_name' => 'One Cool Clarkson',
                                'horse_name' => 'ONE COOL CLARKSON',
                                'sire_uid' => 106681,
                                'sire_style_name' => 'Clerkenwell',
                                'sire_country' => 'USA',
                                'jockey_uid' => 87671,
                                'jockey_style_name' => 'Graham Watters',
                                'trainer_uid' => 19400,
                                'trainer_style_name' => 'Neil McKnight',
                                'owner_uid' => 218450,
                                'owner_style_name' => 'Neil McKnight',
                                'non_runner' => null,
                                'draw' => 0,
                                'rp_topspeed' => null,
                                'rp_postmark' => 0,
                                'rp_owner_choice' => 'a',
                                'start_number' => 3,
                                'going_form' => null,
                            ]
                        ),
                        3 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'horse_uid' => 902730,
                                'horse_style_name' => 'Orioninverness',
                                'horse_name' => 'ORIONINVERNESS',
                                'sire_uid' => 565327,
                                'sire_style_name' => 'Brian Boru',
                                'sire_country' => 'GB',
                                'jockey_uid' => 88471,
                                'jockey_style_name' => 'Derek Fox',
                                'trainer_uid' => 6990,
                                'trainer_style_name' => 'Lucinda Russell',
                                'owner_uid' => 158167,
                                'owner_style_name' => 'Tay Valley Chasers Racing Club',
                                'non_runner' => null,
                                'draw' => 0,
                                'rp_topspeed' => null,
                                'rp_postmark' => 109,
                                'rp_owner_choice' => 'a',
                                'start_number' => 4,
                                'going_form' => null,
                            ]
                        ),
                        4 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'horse_uid' => 934021,
                                'horse_style_name' => 'Sideways',
                                'horse_name' => 'SIDEWAYS',
                                'sire_uid' => 539937,
                                'sire_style_name' => 'Gamut',
                                'sire_country' => 'IRE',
                                'jockey_uid' => 81409,
                                'jockey_style_name' => 'Brian Hughes',
                                'trainer_uid' => 28412,
                                'trainer_style_name' => 'David Dennis',
                                'owner_uid' => 226415,
                                'owner_style_name' => 'Favourites Racing Ltd',
                                'non_runner' => null,
                                'draw' => 0,
                                'rp_topspeed' => 76,
                                'rp_postmark' => 117,
                                'rp_owner_choice' => 'a',
                                'start_number' => 5,
                                'going_form' => null,
                            ]
                        ),
                        5 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'horse_uid' => 883895,
                                'horse_style_name' => 'Elusive Theatre',
                                'horse_name' => 'ELUSIVE THEATRE',
                                'sire_uid' => 84432,
                                'sire_style_name' => 'King\'s Theatre',
                                'sire_country' => 'IRE',
                                'jockey_uid' => 92084,
                                'jockey_style_name' => 'Craig Nichol',
                                'trainer_uid' => 16596,
                                'trainer_style_name' => 'S R B Crawford',
                                'owner_uid' => 203960,
                                'owner_style_name' => 'David Gordon Roberts',
                                'non_runner' => null,
                                'draw' => 0,
                                'rp_topspeed' => 92,
                                'rp_postmark' => 118,
                                'rp_owner_choice' => 'a',
                                'start_number' => 6,
                                'going_form' => null,
                            ]
                        ),
                        6 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'horse_uid' => 1284539,
                                'horse_style_name' => 'Lady Of The Clyde',
                                'horse_name' => 'LADY OF THE CLYDE',
                                'sire_uid' => 21792,
                                'sire_style_name' => 'Lord Americo',
                                'sire_country' => 'GB',
                                'jockey_uid' => 92580,
                                'jockey_style_name' => 'Ross Chapman',
                                'trainer_uid' => 21516,
                                'trainer_style_name' => 'Iain Jardine',
                                'owner_uid' => 11205,
                                'owner_style_name' => 'Robert H Goldie',
                                'non_runner' => null,
                                'draw' => 0,
                                'rp_topspeed' => null,
                                'rp_postmark' => 0,
                                'rp_owner_choice' => 'a',
                                'start_number' => 7,
                                'going_form' => null,
                            ]
                        ),
                    ],
                ]
            ),
            777777 => null
        ];

        return $res[$request->getRaceId()];
    }
}
