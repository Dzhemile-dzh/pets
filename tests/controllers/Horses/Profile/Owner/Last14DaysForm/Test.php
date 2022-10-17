<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Profile\Owner;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\Profile\Owner
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/profile/owner/292553/last-14-days-form';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models/Bo/OwnerProfile/Owner.php:15 ->getOwner()
            '46db78e1d33e34b6f02ec44f76d48a0c' => [
                0 => [
                    'owner_uid' => 292553,
                    'owner_name' => 'THE ROGUES GALLERY',
                    'silk' => null,
                    'style_name' => 'The Rogues Gallery',
                    'ptp_type_code' => 'N'
                ]
            ],

            //Models/HorseRace.php:580 ->getStatsLast14Days()
            'd0c51560837ee63564b950c0869bf424' => [
               0 => [
                    'runs' => 4,
                    'wins' => 1
               ]
            ]
        ];
    }
}
