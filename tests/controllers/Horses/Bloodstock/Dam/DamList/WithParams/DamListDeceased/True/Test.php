<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Bloodstock\Dam\DamList\WithParams\DamListDeseased\True;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 * @package Tests\Controllers\Horses\Bloodstock\Dam\DamList\WithParams\DamListDeseased\True
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/bloodstock/dam/dam-list?country=GB&age=10&deceased=true';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //provider/DataProvider/Bo/Bloodstock/Dam/DamList.php::getDamList
            'e59c5bd1fa0a9c303d39a37f418d4e7d' => [
                0 => [
                    'horse_uid' => 845402,
                    'style_name' => 'Childesplay',
                    'country_origin_code' => 'GB',
                    'horse_date_of_birth' => '2011-03-16 00:00:00',
                    'horse_date_of_death' => '2019-02-04 00:00:00',
                ],
                1 => [
                    'horse_uid' => 407102,
                    'style_name' => 'Clever Miss',
                    'country_origin_code' => 'GB',
                    'horse_date_of_birth' => '2011-03-03 00:00:00',
                    'horse_date_of_death' => '2018-01-24 00:00:00',
                ],
                2 => [
                    'horse_uid' => 835590,
                    'style_name' => 'Excel\'s Beauty',
                    'country_origin_code' => 'GB',
                    'horse_date_of_birth' => '2011-01-30 00:00:00',
                    'horse_date_of_death' => '2016-07-06 00:00:00',
                ],
                3 => [
                    'horse_uid' => 845326,
                    'style_name' => 'Gold Approach',
                    'country_origin_code' => 'GB',
                    'horse_date_of_birth' => '2011-03-18 00:00:00',
                    'horse_date_of_death' => '2018-12-11 00:00:00',
                ],
                4 => [
                    'horse_uid' => 831482,
                    'style_name' => 'Joyful Friend',
                    'country_origin_code' => 'GB',
                    'horse_date_of_birth' => '2011-02-12 00:00:00',
                    'horse_date_of_death' => '2018-07-31 00:00:00',
                ],
                5 => [
                    'horse_uid' => 836804,
                    'style_name' => 'Oxsana',
                    'country_origin_code' => 'GB',
                    'horse_date_of_birth' => '2011-03-16 00:00:00',
                    'horse_date_of_death' => '2016-05-10 00:00:00',
                ],
            ],
        ];
    }
}
