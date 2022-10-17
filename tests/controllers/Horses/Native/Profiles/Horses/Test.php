<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Native\Profiles\Horses;

use UnitTestsComponents\ApiRouteTest\Xml as ApiRouteTestPrototype;

/**
 * @package Tests\Controllers\Horses\Native\Results\ResultsList
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/native/profiles/horses/1509376';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\Native\Profiles\HorsesюHorse:21 ->getData()
            '4cbb2686106705d1ccf7dec0b2b0d208' => [
                [
                    'Owner' => 'Godolphin',
                    'Trainer' => 'Saeed bin Suroor',
                    'Breeder' => 'Darley',
                    'name' => 'Mountain Hunter',
                    'silk' => 'NULL',
                    'owner_uid' => 49845,
                    'sex' => 'g',
                    'rp_newspaper_output_desc' => 'b',
                    'horse_date_of_birth' => '2014-05-03 00:00:00',
                    'horse_date_of_death' => null,
                    'country_origin_code' => 'USA',
                    'h_avg' => null,
                    'dam_name' => 'Tamarillo',
                    'dam_country' => 'GB',
                    'd_avg' => null,
                    'h_sire_name' => 'Lonhro',
                    'h_sire_country' => 'AUS',
                    'h_sire_avg' => 7.7,
                    'd_sire_name' => 'Daylami',
                    'd_sire_country' => 'IRE',
                    'd_sire_avg' => 11.6,
                    's_sire_name' => 'Octagonal',
                    's_sire_country' => 'NZ',
                    's_sire_avg' => 10.2
                ]
            ],
            //Api\DataProvider\Bo\Native\Profiles\HorsesюHorse:198 ->getHorseForm()
            '2ca48ef404e1ebb85348a8a04bbefcd5' => [
                [
                    'race_instance_uid' => 709714,
                    'race_instance_title' => 'Mechanical Facilities Handicap',
                    'race_datetime' => '2018-09-13 16:40:00',
                    'course_name' => 'don',
                    'distance_yard' => 2200,
                    'going_type_code' => 'Gd',
                    'race_type_code' => 'F',
                    'weight_carried_lbs' => 136,
                    'race_outcome_code' => 5,
                    'jockey_name' => 'Oisin Murphy',
                    'rp_postmark' => 10,
                    'rp_topspeed' => null,
                    'raceOR' => null,
                    'final_race_outcome_uid' => null,
                    'race_group_uid' => null,
                    'earnings' => 100,
                    'noRunners' => 10,
                    'official_rating_ran_off' => 0
                ],
                [
                    'race_instance_uid' => 709715,
                    'race_instance_title' => 'Mechanical Facilities Handicap',
                    'race_datetime' => '2018-09-13 16:40:00',
                    'course_name' => 'don',
                    'distance_yard' => 2200,
                    'going_type_code' => 'Gd',
                    'race_type_code' => 'F',
                    'weight_carried_lbs' => 136,
                    'race_outcome_code' => 5,
                    'jockey_name' => 'Oisin Murphy',
                    'rp_postmark' => null,
                    'rp_topspeed' => null,
                    'raceOR' => null,
                    'final_race_outcome_uid' => null,
                    'race_group_uid' => null,
                    'earnings' => 0,
                    'noRunners' => 10,
                    'official_rating_ran_off' => 0
                ]
            ],
            //Api\Row\Methods\GetHorseAge
            '419bea4c352b958d6ce8d8201af1e562' => [
                [
                    'date' => '2018-01-02 08:03:58.057'
                ]
            ]
        ];
    }
}
