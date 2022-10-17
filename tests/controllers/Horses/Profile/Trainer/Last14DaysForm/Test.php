<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Profile\Trainer;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\Profile\Trainer
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/profile/trainer/188/last-14-days-form';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models\Bo\TrainerProfile\RaceInstance:580 ->getStatisticalSummary()
            'e10d376dfc06d89ebaf6c17b29e46ace' => [
                0 => [
                    'trainer_name' => 'OLIVER SHERWOOD',
                    'ptp_type_code' => 'N',
                    'style_name' => 'Oliver Sherwood',
                    'mirror_name' => 'O Sherwood',
                    'trainer_location' => 'Upper Lambourn, Berks',
                    'country_code' => 'GB',
                    'rp_x_coord' => 432,
                    'rp_y_coord' => 180,
                    'christian_name' => 'Oliver Martin Carwardine',
                    'primary_trainer_code' => 'J',
                ]
            ],

            //Models\Bo\TrainerProfile\RaceInstance:580 ->getStatisticalSummary()
            '76bc233a06bea3d473877a3c9d1f2efe' => [
               0 => [
                    'runs' => 8,
                    'wins' => 2
               ]
            ]
        ];
    }
}
