<?php

declare (strict_types = 1);

namespace Tests\Controllers\Horses\OwnerGroups\Results\WithParams;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\OwnerGroups\Splash\WithParams
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute() : string
    {
        return '/horses/owner-groups/20/results?ownerId=42055&trainerId=25914&trainerCountryCode=GB&startDate=2017-07-27&endDate=2017-09-11';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData() : array
    {
        return [
            //Api\DataProvider\Bo\OwnerGroups\Results:21 ->getData()
            '3fa79d77af2e8c2b0e0e94a77eb82d38' => [
                [
                    'race_instance_uid' => 680588,
                    'race_datetime' => '2017-08-06 14:35:00',
                    'race_instance_title' => 'Horseradish Hospitality At Southport Flower Show/EBF Stallions Conditions Stakes (Plus 10 Race)',
                    'distance_yard' => 1337,
                    'race_status_code' => 'R',
                    'local_meeting_race_datetime' => '2017-08-06 14:35:00',
                    'hours_difference' => 0,
                    'course_uid' => 13,
                    'course_name' => 'Chester',
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
                    'jockey_uid' => 86585,
                    'jockey_name' => 'Martin Harley',
                    'race_outcome_uid' => 5,
                    'final_race_outcome_uid' => 5,
                    'race_outcome_position' => 5,
                    'race_outcome_code' => '5',
                    'race_outcome_desc' => '5th',
                    'race_outcome_joint_yn' => 'N',
                    'non_runner' => 'N',
                    'race_type_code' => 'F',
                    'race_surface' => 'Turf',
                    'race_group_code' => '0',
                    'race_group_desc' => 'Unknown',
                    'race_class' => '2',
                    'stream_url' => null,
                    'odds_uid' => 27,
                    'odds_desc' => '9/2',
                    'black_type' => 'N',
                    'has_race_replay_video' => null,
                    'course_region' => 'GB & IRE'
                ],
                [
                    'race_instance_uid' => 681689,
                    'race_datetime' => '2017-08-26 16:10:00',
                    'race_instance_title' => 'Julia Graves Roses Stakes (Listed Race)',
                    'distance_yard' => 1100,
                    'race_status_code' => 'R',
                    'local_meeting_race_datetime' => '2017-08-26 16:10:00',
                    'hours_difference' => 0,
                    'course_uid' => 107,
                    'course_name' => 'York',
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
                    'jockey_uid' => 86585,
                    'jockey_name' => 'Martin Harley',
                    'race_outcome_uid' => 10,
                    'final_race_outcome_uid' => 10,
                    'race_outcome_position' => 10,
                    'race_outcome_code' => '10',
                    'race_outcome_desc' => '10th',
                    'race_outcome_joint_yn' => 'N',
                    'non_runner' => 'N',
                    'race_type_code' => 'F',
                    'race_surface' => 'Turf',
                    'race_group_code' => '4',
                    'race_group_desc' => 'Listed',
                    'race_class' => '1',
                    'stream_url' => null,
                    'odds_uid' => 20,
                    'odds_desc' => '16/1',
                    'black_type' => 'N',
                    'has_race_replay_video' => null,
                    'course_region' => 'GB & IRE'
                ],
            ],
            //Api\DataProvider\Bo\OwnerGroups\OwnerGroupsProvider:92 ->getBlackTypeRunners()
            'e8510193dee96c94058b5e97dfe20519' => []
        ];
    }
}
