<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\OwnerGroups\Entries\FirstSeasonSire;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\OwnerGroups\Entries\General
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/owner-groups/entries/first-season-sire/coolmore';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\OwnerGroups\Entries:165 ->getData()
            'b90fde4046ea86588e196fe814bf34b1' => [
                [
                    'race_instance_uid' => 705667,
                    'race_instance_title' => 'Dr. Tom Connors Handicap',
                    'race_datetime' => '2018-07-19 15:20:00',
                    'distance_yard' => 1813,
                    'race_status_code' => 'O',
                    'local_meeting_race_datetime' => '2018-07-19 15:20:00',
                    'hours_difference' => 0,
                    'race_type_code' => 'F',
                    'race_surface' => 'Turf',
                    'race_class' => '4',
                    'course_uid' => 30,
                    'course_name' => 'Leicester',
                    'diffusion_course_name' => 'DIFFUSION NAME',
                    'race_group_code' => 'H',
                    'race_group_desc' => 'Handicap',
                    'CMS_element_contents' => 'some url I guess',
                    'country_code' => 'GB',
                    'horse_uid' => 895090,
                    'horse_name' => 'Kharbetation',
                    'horse_country_origin_code' => 'IRE',
                    'sire_uid' => 761072,
                    'sire_name' => 'Dream Ahead',
                    'sire_country' => 'USA',
                    'dam_uid' => 659811,
                    'dam_name' => 'Anna\'s Rock',
                    'dam_country' => 'IRE',
                    'trainer_uid' => 22839,
                    'trainer_name' => 'David O\'Meara',
                    'trainer_country_code' => 'GB',
                    'trainer_country_desc' => 'Great Britain',
                    'owner_uid' => 189171,
                    'owner_name' => 'Hamad Rashed Bin Ghedayer',
                    'jockey_uid' => 14332,
                    'jockey_name' => 'David Nolan',
                    'forecast_odds_desc' => null,
                    'non_runner' => 'N',
                    'black_type' => 'N',
                    // This result in the SQL is produced by the request param.
                    // In firstSeasonSire this is impossible to happen, but we have to hardcode something.
                    'owner_group_id' => null,
                    'course_region' => 'GB & IRE'
                ],
                [
                    'race_instance_uid' => 705688,
                    'race_instance_title' => 'Watch Racing UK On Sky 426 Handicap',
                    'race_datetime' => '2018-07-20 14:55:00',
                    'distance_yard' => 1338,
                    'race_status_code' => '4',
                    'local_meeting_race_datetime' => '2018-07-20 14:55:00',
                    'hours_difference' => 0,
                    'race_type_code' => 'F',
                    'race_surface' => 'Turf',
                    'race_class' => '3',
                    'course_uid' => 40,
                    'course_name' => 'Nottingham',
                    'diffusion_course_name' => 'DIFFUSION NAME',
                    'race_group_code' => 'H',
                    'race_group_desc' => 'Handicap',
                    'country_code' => 'GB',
                    'CMS_element_contents' => 'some url I guess 0000',
                    'horse_uid' => 1434687,
                    'horse_name' => 'Summerghand',
                    'horse_country_origin_code' => 'IRE',
                    'sire_uid' => 740981,
                    'sire_name' => 'Lope De Vega',
                    'sire_country' => 'IRE',
                    'dam_uid' => 418582,
                    'dam_name' => 'Kate The Great',
                    'dam_country' => 'IRE',
                    'trainer_uid' => 22839,
                    'trainer_name' => 'David O\'Meara',
                    'trainer_country_code' => 'GB',
                    'trainer_country_desc' => 'Great Britain',
                    'owner_uid' => 189171,
                    'owner_name' => 'Hamad Rashed Bin Ghedayer',
                    'jockey_uid' => null,
                    'jockey_name' => null,
                    'forecast_odds_desc' => null,
                    'non_runner' => 'N',
                    'black_type' => 'N',
                    'owner_group_id' => 4,
                    'course_region' => 'GB & IRE'
                ],
                [
                    'race_instance_uid' => 705681,
                    'race_instance_title' => 'Heineken UK Scottish Stewards\' Cup Handicap',
                    'race_datetime' => '2018-07-20 19:20:00',
                    'distance_yard' => 1326,
                    'race_status_code' => '4',
                    'local_meeting_race_datetime' => '2018-07-20 19:20:00',
                    'hours_difference' => 0,
                    'race_type_code' => 'F',
                    'race_surface' => 'Turf',
                    'race_class' => '2',
                    'course_uid' => 22,
                    'course_name' => 'Hamilton',
                    'diffusion_course_name' => 'DIFFUSION NAME',
                    'race_group_code' => 'H',
                    'race_group_desc' => 'Handicap',
                    'CMS_element_contents' => 'some url I guess 1',
                    'country_code' => 'GB',
                    'horse_uid' => 1434687,
                    'horse_name' => 'Summerghand',
                    'horse_country_origin_code' => 'IRE',
                    'sire_uid' => 740981,
                    'sire_name' => 'Lope De Vega',
                    'sire_country' => 'IRE',
                    'dam_uid' => 418582,
                    'dam_name' => 'Kate The Great',
                    'dam_country' => 'IRE',
                    'trainer_uid' => 22839,
                    'trainer_name' => 'David O\'Meara',
                    'trainer_country_code' => 'GB',
                    'trainer_country_desc' => 'Great Britain',
                    'owner_uid' => 189171,
                    'owner_name' => 'Hamad Rashed Bin Ghedayer',
                    'jockey_uid' => 82231,
                    'jockey_name' => 'Daniel Tudhope',
                    'forecast_odds_desc' => null,
                    'non_runner' => 'N',
                    'black_type' => 'N',
                    'owner_group_id' => 4,
                    'course_region' => 'GB & IRE'
                ],
                [
                    'race_instance_uid' => 705748,
                    'race_instance_title' => 'Sky Bet Go-Racing-In-Yorkshire Summer Festival Handicap',
                    'race_datetime' => '2018-07-21 15:30:00',
                    'distance_yard' => 2150,
                    'race_status_code' => '4',
                    'local_meeting_race_datetime' => '2018-07-21 15:30:00',
                    'hours_difference' => 0,
                    'race_type_code' => 'F',
                    'race_surface' => 'Turf',
                    'race_class' => '4',
                    'course_uid' => 49,
                    'course_name' => 'Ripon',
                    'diffusion_course_name' => 'DIFFUSION NAME',
                    'race_group_code' => 'H',
                    'race_group_desc' => 'Handicap',
                    'country_code' => 'GB',
                    'CMS_element_contents' => 'some url I guess 2',
                    'horse_uid' => 895090,
                    'horse_name' => 'Kharbetation',
                    'horse_country_origin_code' => 'IRE',
                    'sire_uid' => 761072,
                    'sire_name' => 'Dream Ahead',
                    'sire_country' => 'USA',
                    'dam_uid' => 659811,
                    'dam_name' => 'Anna\'s Rock',
                    'dam_country' => 'IRE',
                    'trainer_uid' => 22839,
                    'trainer_name' => 'David O\'Meara',
                    'trainer_country_code' => 'GB',
                    'trainer_country_desc' => 'Great Britain',
                    'owner_uid' => 189171,
                    'owner_name' => 'Hamad Rashed Bin Ghedayer',
                    'jockey_uid' => null,
                    'jockey_name' => null,
                    'forecast_odds_desc' => null,
                    'non_runner' => 'N',
                    'black_type' => 'N',
                    'owner_group_id' => 4,
                    'course_region' => 'GB & IRE'
                ],
                [
                    'race_instance_uid' => 707081,
                    'race_instance_title' => 'Tote Scurry Handicap',
                    'race_datetime' => '2018-07-21 15:45:00',
                    'distance_yard' => 1383,
                    'race_status_code' => '6',
                    'local_meeting_race_datetime' => '2018-07-21 15:45:00',
                    'hours_difference' => 0,
                    'race_type_code' => 'F',
                    'race_surface' => 'Turf',
                    'race_class' => null,
                    'course_uid' => 178,
                    'course_name' => 'Curragh',
                    'diffusion_course_name' => 'DIFFUSION NAME',
                    'race_group_code' => 'H',
                    'race_group_desc' => 'Handicap',
                    'CMS_element_contents' => 'some url I guess 3',
                    'country_code' => 'IRE',
                    'horse_uid' => 1434687,
                    'horse_name' => 'Summerghand',
                    'horse_country_origin_code' => 'IRE',
                    'sire_uid' => 740981,
                    'sire_name' => 'Lope De Vega',
                    'sire_country' => 'IRE',
                    'dam_uid' => 418582,
                    'dam_name' => 'Kate The Great',
                    'dam_country' => 'IRE',
                    'trainer_uid' => 22839,
                    'trainer_name' => 'David O\'Meara',
                    'trainer_country_code' => 'GB',
                    'trainer_country_desc' => 'Great Britain',
                    'owner_uid' => 189171,
                    'owner_name' => 'Hamad Rashed Bin Ghedayer',
                    'jockey_uid' => null,
                    'jockey_name' => null,
                    'forecast_odds_desc' => null,
                    'non_runner' => 'N',
                    'black_type' => 'N',
                    'owner_group_id' => 4,
                    'course_region' => 'GB & IRE'
                ],
                [
                    'race_instance_uid' => 705749,
                    'race_instance_title' => 'VW Van Centre (West Yorkshire) Handicap',
                    'race_datetime' => '2018-07-21 16:40:00',
                    'distance_yard' => 1760,
                    'race_status_code' => '4',
                    'local_meeting_race_datetime' => '2018-07-21 16:40:00',
                    'hours_difference' => 0,
                    'race_type_code' => 'F',
                    'race_surface' => 'Turf',
                    'race_class' => '4',
                    'course_uid' => 49,
                    'course_name' => 'Ripon',
                    'diffusion_course_name' => 'DIFFUSION NAME',
                    'race_group_code' => 'H',
                    'race_group_desc' => 'Handicap',
                    'CMS_element_contents' => 'some url I guess 4',
                    'country_code' => 'GB',
                    'horse_uid' => 895090,
                    'horse_name' => 'Kharbetation',
                    'horse_country_origin_code' => 'IRE',
                    'sire_uid' => 761072,
                    'sire_name' => 'Dream Ahead',
                    'sire_country' => 'USA',
                    'dam_uid' => 659811,
                    'dam_name' => 'Anna\'s Rock',
                    'dam_country' => 'IRE',
                    'trainer_uid' => 22839,
                    'trainer_name' => 'David O\'Meara',
                    'trainer_country_code' => 'GB',
                    'trainer_country_desc' => 'Great Britain',
                    'owner_uid' => 189171,
                    'owner_name' => 'Hamad Rashed Bin Ghedayer',
                    'jockey_uid' => null,
                    'jockey_name' => null,
                    'forecast_odds_desc' => null,
                    'non_runner' => 'N',
                    'black_type' => 'N',
                    'owner_group_id' => 4,
                    'course_region' => 'GB & IRE'
                ],
                [
                    'race_instance_uid' => 705712,
                    'race_instance_title' => 'Watch Racing UK Fillies\' Handicap',
                    'race_datetime' => '2018-07-21 20:30:00',
                    'distance_yard' => 1100,
                    'race_status_code' => '4',
                    'local_meeting_race_datetime' => '2018-07-21 20:30:00',
                    'hours_difference' => 0,
                    'race_type_code' => 'F',
                    'race_surface' => 'Turf',
                    'race_class' => '5',
                    'course_uid' => 23,
                    'course_name' => 'Haydock',
                    'diffusion_course_name' => 'DIFFUSION NAME',
                    'race_group_code' => 'H',
                    'race_group_desc' => 'Handicap',
                    'CMS_element_contents' => 'some url I guess 5',
                    'country_code' => 'GB',
                    'horse_uid' => 1028338,
                    'horse_name' => 'Dundunah',
                    'horse_country_origin_code' => 'USA',
                    'sire_uid' => 751559,
                    'sire_name' => 'Sidney\'s Candy',
                    'sire_country' => 'USA',
                    'dam_uid' => 747383,
                    'dam_name' => 'Sealedwithapproval',
                    'dam_country' => 'USA',
                    'trainer_uid' => 22839,
                    'trainer_name' => 'David O\'Meara',
                    'trainer_country_code' => 'GB',
                    'trainer_country_desc' => 'Great Britain',
                    'owner_uid' => 189171,
                    'owner_name' => 'Hamad Rashed Bin Ghedayer',
                    'jockey_uid' => 82231,
                    'jockey_name' => 'Daniel Tudhope',
                    'forecast_odds_desc' => null,
                    'non_runner' => 'N',
                    'black_type' => 'N',
                    'owner_group_id' => 4,
                    'course_region' => 'GB & IRE'
                ],
            ],
            //Api\DataProvider\Bo\OwnerGroups\OwnerGroupsProvider:92 ->getBlackTypeRunners()
            '2098706fe07df53d754056fc582ae01c' => [
            ]
        ];
    }
}
