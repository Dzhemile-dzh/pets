<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Bloodstock\Dam\DamList\WithParams;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 * @package Tests\Controllers\Horses\Bloodstock\Dam\DamList\WithParams
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/bloodstock/dam/dam-list?country=GB&age=5,6,7&name=a%20bi';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //provider/DataProvider/Bo/Bloodstock/Dam/DamList.php::getDamList
            'adbcacc0cf7cbc6d0883f0fce94e09a5' => [
                [
                    'horse_uid' => 537663,
                    'style_name' => 'A Bit Special I',
                    'country_origin_code' => 'GB',
                    'horse_date_of_birth' => '2018-05-24 14:05:00',
                    'horse_date_of_death' => null
                ],
            ],
        ];
    }
}
