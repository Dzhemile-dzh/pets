<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Tipping\Singles;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\Tipping\Singles
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/tipping/singles/2019-03-28';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\Tipping:20 ->getTippings()
            'b651c25fe4316264ff8c9b6eebd16737' => [
                [
                    'race_instance_uid' => 723997,
                    'race_datetime' => '2019-03-28T14:30:00',
                    'course_name' => 'Newcastle',
                    'diffusion_course_name' => 'NEWCASTLE',
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
                    'tipster_name' => 'Sweetspots',
                    'tipster_type' => 'SIGNPOSTS SWEETSPOTS',
                    'tip_type' => 'mover',
                    'non_runner' => false,
                    'spotlight_tip_verdict' => null
                ],
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
