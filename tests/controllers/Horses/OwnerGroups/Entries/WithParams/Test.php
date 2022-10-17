<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\OwnerGroups\Entries\WithParams;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\OwnerGroups\Entries\WithParams
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/owner-groups/5/entries?ownerId=97229&countryCode=USA&includeCalendarRaces=true';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\OwnerGroups\Entries:165 ->getData()
            'f7264b9ac405f2c3965440d28e05edd4' => [
                [
                    'race_instance_uid' => 707495,
                    'race_instance_title' => 'Maiden Special Weight (Maiden) (3yo+ Fillies & Mares) (Tapeta)',
                    'race_datetime' => '2018-07-19 19:56:00',
                    'distance_yard' => 1430,
                    'race_status_code' => 'O',
                    'local_meeting_race_datetime' => '2018-07-19 13:56:00',
                    'hours_difference' => -6.0,
                    'race_type_code' => 'X',
                    'race_surface' => 'Turf',
                    'race_class' => null,
                    'course_uid' => 276,
                    'course_name' => 'Arlington Park',
                    'diffusion_course_name' => 'DIFFUSION NAME',
                    'race_group_code' => '0',
                    'race_group_desc' => 'Unknown',
                    'CMS_element_contents' => 'some url I guess',
                    'country_code' => 'USA',
                    'horse_uid' => 1574863,
                    'horse_name' => 'Mockery',
                    'horse_country_origin_code' => 'USA',
                    'sire_uid' => 476627,
                    'sire_name' => 'Distorted Humor',
                    'sire_country' => 'USA',
                    'dam_uid' => 792186,
                    'dam_name' => 'Kotuku',
                    'dam_country' => 'USA',
                    'trainer_uid' => 14480,
                    'trainer_name' => 'Eoin Harty',
                    'trainer_country_code' => 'USA',
                    'trainer_country_desc' => 'U.S.A',
                    'owner_uid' => 97229,
                    'owner_name' => 'Godolphin Racing LLC',
                    'jockey_uid' => 81416,
                    'jockey_name' => 'Jesse M Campbell',
                    'forecast_odds_desc' => null,
                    'non_runner' => 'N',
                    'black_type' => 'N',
                    // should produce "god_live_stream_URL"
                    'owner_group_id' => 5,
                    'course_region' => 'North America'
                ],
                [
                    'race_instance_uid' => 707529,
                    'race_instance_title' => 'Maiden Special Weight (Maiden) (2yo Fillies) (Turf)',
                    'race_datetime' => '2018-07-20 19:10:00',
                    'distance_yard' => 1210,
                    'race_status_code' => 'O',
                    'local_meeting_race_datetime' => '2018-07-20 14:10:00',
                    'hours_difference' => -5.0,
                    'race_type_code' => 'F',
                    'race_surface' => 'Turf',
                    'race_class' => null,
                    'course_uid' => 210,
                    'course_name' => 'Laurel Park',
                    'diffusion_course_name' => 'DIFFUSION NAME',
                    'race_group_code' => '0',
                    'race_group_desc' => 'Unknown',
                    'CMS_element_contents' => 'some url I guess 1',
                    'country_code' => 'USA',
                    'horse_uid' => 2111411,
                    'horse_name' => 'Elsa',
                    'horse_country_origin_code' => 'USA',
                    'sire_uid' => 770558,
                    'sire_name' => 'Animal Kingdom',
                    'sire_country' => 'USA',
                    'dam_uid' => 757004,
                    'dam_name' => 'Abtasaamah',
                    'dam_country' => 'USA',
                    'trainer_uid' => 8863,
                    'trainer_name' => 'Michael Stidham',
                    'trainer_country_code' => 'USA',
                    'trainer_country_desc' => 'U.S.A',
                    'owner_uid' => 97229,
                    'owner_name' => 'Godolphin Racing LLC',
                    'jockey_uid' => 84536,
                    'jockey_name' => 'Sheldon Russell',
                    'forecast_odds_desc' => null,
                    'non_runner' => 'N',
                    'black_type' => 'N',
                    // should NOT produce "god_live_stream_URL"
                    'owner_group_id' => 4,
                    'course_region' => 'North America'
                ],
                [
                    'race_instance_uid' => 707548,
                    'race_instance_title' => 'Maiden Special Weight (Maiden) (3yo+ Fillies & Mares) (Turf)',
                    'race_datetime' => '2018-07-21 20:15:00',
                    'distance_yard' => 1100,
                    'race_status_code' => 'O',
                    'local_meeting_race_datetime' => '2018-07-21 15:15:00',
                    'hours_difference' => -5.0,
                    'race_type_code' => 'F',
                    'race_surface' => 'Turf',
                    'race_class' => null,
                    'course_uid' => 248,
                    'course_name' => 'Delaware Park',
                    'diffusion_course_name' => 'DIFFUSION NAME',
                    'race_group_code' => '0',
                    'race_group_desc' => 'Unknown',
                    'CMS_element_contents' => 'some url I guess 2',
                    'country_code' => 'USA',
                    'horse_uid' => 1469683,
                    'horse_name' => 'She\'s Funny',
                    'horse_country_origin_code' => 'USA',
                    'sire_uid' => 595009,
                    'sire_name' => 'Tapit',
                    'sire_country' => 'USA',
                    'dam_uid' => 660574,
                    'dam_name' => 'Hystericalady',
                    'dam_country' => 'USA',
                    'trainer_uid' => 8863,
                    'trainer_name' => 'Michael Stidham',
                    'trainer_country_code' => 'USA',
                    'trainer_country_desc' => 'U.S.A',
                    'owner_uid' => 97229,
                    'owner_name' => 'Godolphin Racing LLC',
                    'jockey_uid' => 90019,
                    'jockey_name' => 'Brian Pedroza',
                    'forecast_odds_desc' => null,
                    'non_runner' => 'N',
                    'black_type' => 'N',
                    'owner_group_id' => 4,
                    'course_region' => 'North America'
                ],
            ],
            //Api\DataProvider\Bo\OwnerGroups\OwnerGroupsProvider:92 ->getBlackTypeRunners()
            '7d05cc1b4d4ac9064607a6349e845213' => [
            ]
        ];
    }
}
