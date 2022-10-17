<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\OwnerGroups\Entries\OwnerGroup999;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 * @package Tests\Controllers\Horses\OwnerGroups\Entries\OwnerGroup999
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/owner-groups/999/entries';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\OwnerGroups\Entries:165 ->getData()
            '1b8e2526d39d3564af1a62a318337e49' => [
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
                    // this owner group should display "god_live_stream_URL"
                    // extracted from "CMS_element_contents".
                    // The rest of the owner groups - not.
                    'owner_group_id' => 5,
                    'course_region' => 'GB & IRE'
                ]
            ],
            //Api\DataProvider\Bo\OwnerGroups\OwnerGroupsProvider:92 ->getBlackTypeRunners()
            '94701a7e270c0cf7cacd7d9d597da92d' => [
            ],
            //Models\Bo\HorseProfile\Horse -> getSales() DROP TABLE #tmp_horse_ids
            '51c68ca08fb1c1d45408309c82f1814f' => [
            ],
            //Models\Bo\HorseProfile\Horse -> getSales() SELECT INTO #tmp_horse_ids
            '5a43b0133f702e2456477284a5f83740' => [
            ],
            //Models\Bo\HorseProfile\Horse -> getSales() Main statement
            'ed177e803cc51e04f0cbce4d5bef2a81' => [
            ]
        ];
    }
}
