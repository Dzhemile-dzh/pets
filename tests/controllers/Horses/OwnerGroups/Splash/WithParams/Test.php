<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\OwnerGroups\Splash\WithParams;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/owner-groups/splash?ownerGroupId=5&ownerGroupLookupId=2&deviceType=iphone-6-2x';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\OwnerGroups\Splash:64 ->getData()
            'f1ac72a8165b2f4c2bdcc0901bd1b2d3' => [
                [
                    'owner_group_lookup_uid' => 2,
                    'owner_group_uid' => 5,
                    'owner_group_splash_uid' => 8,
                    'to_follow_uid' => 19,
                    'device_type' => 'iphone-6-2x',
                    'splash_url' => 'assets.rpb2b.com/rabbah/rabbah2_6.png',
                ],
            ],
        ];
    }
}
