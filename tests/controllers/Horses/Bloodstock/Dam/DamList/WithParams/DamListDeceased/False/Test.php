<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Bloodstock\Dam\DamList\WithParams\DamListDeseased\False;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\Bloodstock\Dam\DamList\WithParams\DamListDeseased\False
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/bloodstock/dam/dam-list?country=GB&age=5,6,7&deceased=false';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //provider/DataProvider/Bo/Bloodstock/Dam/DamList.php::getDamList
            '0ba8f631c10260411cc293f0ad9ffb29' => [
                0 => [
                    'horse_uid' => 1942035,
                    'style_name' => 'Carrie\'s Vision',
                    'country_origin_code' => 'GB',
                    'horse_date_of_birth' => '2016-03-27 00:00:00',
                    'horse_date_of_death' => null,
                ],
                1 => [
                    'horse_uid' => 2205902,
                    'style_name' => 'Designated',
                    'country_origin_code' => 'GB',
                    'horse_date_of_birth' => '2016-04-08 00:00:00',
                    'horse_date_of_death' => null,
                ],
                2 => [
                    'horse_uid' => 2320797,
                    'style_name' => 'Fanveil',
                    'country_origin_code' => 'GB',
                    'horse_date_of_birth' => '2016-03-05 00:00:00',
                    'horse_date_of_death' => null,
                ],
                3 => [
                    'horse_uid' => 2001137,
                    'style_name' => 'Kodelight',
                    'country_origin_code' => 'GB',
                    'horse_date_of_birth' => '2016-05-13 00:00:00',
                    'horse_date_of_death' => null,
                ],
                4 => [
                    'horse_uid' => 1956427,
                    'style_name' => 'Little Kim',
                    'country_origin_code' => 'GB',
                    'horse_date_of_birth' => '2016-02-19 00:00:00',
                    'horse_date_of_death' => null,
                ],
                5 => [
                    'horse_uid' => 1870985,
                    'style_name' => 'On The Stage',
                    'country_origin_code' => 'GB',
                    'horse_date_of_birth' => '2016-04-06 00:00:00',
                    'horse_date_of_death' => null,
                ],
                6 => [
                    'horse_uid' => 2245145,
                    'style_name' => 'Red Fedora',
                    'country_origin_code' => 'GB',
                    'horse_date_of_birth' => '2016-03-22 00:00:00',
                    'horse_date_of_death' => null,
                ],
                7 => [
                    'horse_uid' => 1969835,
                    'style_name' => 'Requirement',
                    'country_origin_code' => 'GB',
                    'horse_date_of_birth' => '2016-02-04 00:00:00',
                    'horse_date_of_death' => null,
                ],
            ],
        ];
    }
}
