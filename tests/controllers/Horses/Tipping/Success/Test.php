<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Tipping\Success;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\Tipping\Success
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/tipping/success/2100-03-28';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\Tipping:20 ->getTippings()
            '4d0e66dd066c533e935708334f0db41b' => [
                [
                    'race_instance_uid' => 723997,
                    'race_datetime' => '2100-03-28 20:30:00',
                    'course_name' => 'Newcastle',
                    'diffusion_course_name' => 'NEWCASTLE',
                    'race_status_code' => 'O',
                    'horse_name' => 'Ascot De Bruyere',
                    'horse_uid' => 884391,
                    'saddle_cloth_no' => 1,
                    'owner_uid' => 236638,
                    'vs_newspaper_uid' => 137,
                    'newspaper_uid' => 137,
                    'selection_desc' => null,
                    'jockey_name' => 'Steven Fox',
                    'trainer_name' => 'James Ewart',
                    'verdict' => 'Conditional jockey Steven Fox has a 25 per cent strike-rate at Newcastle and has two rides at the venue, three time course winner Ascot De Bruyere (2.30) looks to be the pick of those and the in form gelding can defy a 13lb rise.',
                    'opening_price' => null,
                    'tipster_uid' => 1,
                    'tipster_name' => 'JACK',
                    'tipster_type' => 'SIGNPOSTS SWEETSPOTS',
                    'tip_type' => 'mover',
                    'non_runner' => false,
                    'spotlight_tip_verdict' => null
                ],
            ],
            //Api\DataProvider\Bo\Tipping ->getSuccessfulTippings() / create tmp table
            'de3eca343fa245812f307845dc1036d6' => [
            ],
            //Api\DataProvider\Bo\Tipping ->getSuccessfulTippings()
            '7b8e946241d719f5ee00cd387868cec7' => [
                [
                    'race_datetime' => '2100-03-28 17:00:00',
                    'race_instance_uid' => 723998,
                    'course_name' => 'Nottingham',
                    'diffusion_course_name' => 1,
                    'horse_name' => 'Deinonychus',
                    'horse_uid' => 2,
                    'tipster_uid' => 1,
                    'tipster_name' => 'JACK',
                    'tipster_type' => 'RP',
                    'race_outcome_uid' => 1,
                    'odds_desc' => '11/8F',
                    'odds_value' => 1.375
                ]
            ],

            //Api\DataProvider\Bo\Tipping ->getSpotlightTips()
            'ab41311735a38576064f888bb87ca54c' => [
                [
                    'race_datetime' => '2100-03-27 11:00:00',
                    'race_instance_uid' => 1234,
                    'course_name' => 'SOMEWHERE',
                    'diffusion_course_name' => 1,
                    'horse_name' => 'Deinonychus',
                    'horse_uid' => 2,
                    'tipster_uid' => 2,
                    'tipster_name' => 'DAVID',
                    'tipster_type' => 'SPOTLIGHT',
                    'race_outcome_uid' => 1,
                    'odds_desc' => '11/8F',
                    'odds_value' => 1.375,
                ],
                [
                    'race_datetime' => '2100-03-28 17:00:00',
                    'race_instance_uid' => 700000,
                    'course_name' => 'Nottingham',
                    'diffusion_course_name' => 1,
                    'horse_name' => 'Deinonychus',
                    'horse_uid' => 2,
                    'tipster_uid' => 2,
                    'tipster_name' => 'DAVID',
                    'tipster_type' => 'SPOTLIGHT',
                    'race_outcome_uid' => 1,
                    'odds_desc' => '11/8F',
                    'odds_value' => 1.375,
                ],
            ],

            //Api\DataProvider\Bo\Tipping ->getUpcomingSpotlightTipsForTheDay()
            '78b4d633f964134d30f8eb38f0d3e1f7' => [
                [
                    'race_datetime' => '2100-03-28 19:00:00',
                    'race_instance_uid' => 711111,
                    'course_name' => 'Newcastle',
                    'diffusion_course_name' => 'NEWCASTLE',
                    'horse_name' => 'Ascot De Bruyere',
                    'horse_uid' => 884391,
                    'tipster_uid' => 2,
                    'race_status_code' => 'O',
                    'saddle_cloth_no' => 1,
                    'tipster_name' => 'DAVID',
                    'tipster_type' => 'SPOTLIGHT',
                    'spotlight_tip_verdict' => 'THERE IS SOME TEXT HERE'
                ]
            ],
            // drop table
            '8d32fb91dc48ed9ae8da16d4b4aa73bd' => [
            ],
            // FakePdo drop table
            'c8767c5cb230e3ef39ddbb7447c0e268' => [
            ],
            // FakePdo drop table
            'e03b10673a484a9fb90442c15bf74170' => [
            ]

        ];
    }
}
