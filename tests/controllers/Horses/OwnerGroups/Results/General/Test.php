<?php

declare (strict_types = 1);

namespace Tests\Controllers\Horses\OwnerGroups\Results\General;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\OwnerGroups\Results\General
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute() : string
    {
        return '/horses/owner-groups/20/results';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData() : array
    {
        return [
            //Api\DataProvider\Bo\OwnerGroups\Results:21 ->getData()
            '6443c14495d57ebbcec84358911f6c8b' => [
                [
                    'race_instance_uid' => 698051,
                    'race_datetime' => '2018-04-27 16:05:00',
                    'race_instance_title' => 'bet365 Handicap',
                    'distance_yard' => 1110,
                    'race_status_code' => 'R',
                    'local_meeting_race_datetime' => '2018-04-27 16:05:00',
                    'hours_difference' => 0,
                    'course_uid' => 54,
                    'course_name' => 'Sandown',
                    'diffusion_course_name' => 'DIFFUSION NAME',
                    'country_code' => 'GB',
                    'horse_uid' => 1427485,
                    'horse_name' => 'Haddaf',
                    'horse_country_origin_code' => 'IRE',
                    'sire_uid' => 806738,
                    'sire_name' => 'Dawn Approach',
                    'sire_country' => 'IRE',
                    'dam_uid' => 641129,
                    'dam_name' => 'Deveron',
                    'dam_country' => 'USA',
                    'trainer_uid' => 25914,
                    'trainer_name' => 'James Tate',
                    'trainer_country_code' => 'GB',
                    'trainer_country_desc' => 'Great Britain',
                    'owner_uid' => 42055,
                    'owner_name' => 'Saif Ali',
                    'jockey_uid' => 79202,
                    'jockey_name' => 'Ryan Moore',
                    'race_outcome_uid' => 1,
                    'final_race_outcome_uid' => 1,
                    'race_outcome_position' => 1,
                    'race_outcome_code' => '1',
                    'race_outcome_desc' => '1st',
                    'race_outcome_joint_yn' => 'N',
                    'non_runner' => 'N',
                    'race_type_code' => 'F',
                    'race_surface' => 'Turf',
                    'race_group_code' => 'H',
                    'race_group_desc' => 'Handicap',
                    'race_class' => '2',
                    'stream_url' => null,
                    'odds_uid' => 27,
                    'odds_desc' => '9/2',
                    'black_type' => 'N',
                    'has_race_replay_video' => null,
                    'course_region' => 'GB & IRE'
                ],
                [
                    'race_instance_uid' => 698121,
                    'race_datetime' => '2018-04-28 20:00:00',
                    'race_instance_title' => 'FCL Global Forwarding Making Logistics Personal Novice Stakes',
                    'distance_yard' => 1902,
                    'race_status_code' => 'R',
                    'local_meeting_race_datetime' => '2018-04-28 20:00:00',
                    'hours_difference' => 0,
                    'course_uid' => 513,
                    'course_name' => 'Wolverhampton (A.W)',
                    'diffusion_course_name' => 'DIFFUSION NAME',
                    'country_code' => 'GB',
                    'horse_uid' => 1740912,
                    'horse_name' => 'Excelabit',
                    'horse_country_origin_code' => 'GB',
                    'sire_uid' => 577888,
                    'sire_name' => 'Exceed And Excel',
                    'sire_country' => 'AUS',
                    'dam_uid' => 794881,
                    'dam_name' => 'Saaboog',
                    'dam_country' => 'GB',
                    'trainer_uid' => 19969,
                    'trainer_name' => 'David Lanigan',
                    'trainer_country_code' => 'GB',
                    'trainer_country_desc' => 'Great Britain',
                    'owner_uid' => 42055,
                    'owner_name' => 'Saif Ali',
                    'jockey_uid' => 80421,
                    'jockey_name' => 'Stevie Donohoe',
                    'race_outcome_uid' => 11,
                    'final_race_outcome_uid' => 11,
                    'race_outcome_position' => 11,
                    'race_outcome_code' => '11',
                    'race_outcome_desc' => '11th',
                    'race_outcome_joint_yn' => 'N',
                    'non_runner' => 'N',
                    'race_type_code' => 'X',
                    'race_surface' => 'Turf',
                    'race_group_code' => '0',
                    'race_group_desc' => 'Unknown',
                    'race_class' => '5',
                    'stream_url' => null,
                    'odds_uid' => 36,
                    'odds_desc' => '50/1',
                    'black_type' => 'N',
                    'has_race_replay_video' => null,
                    'course_region' => 'GB & IRE'
                ]
            ],
            //Api\DataProvider\Bo\OwnerGroups\OwnerGroupsProvider:94 ->getBlackTypeRunners()
            '9d289597c70e765d7cc5807c1c96c6d0' => [
                [
                    'horse_uid' => 1994521,
                    'position' => 1,
                    'race_group_uid' => 3,
                    'no_of_runners' => 18,
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function getReplacement() : array
    {
        return [
            'startDate' => '2018-04-20 00:01',
            'endDate' => '2018-07-19 23:59',
        ];
    }
}
