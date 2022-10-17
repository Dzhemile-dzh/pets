<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Bloodstock\Stallion\DamSireSeasonsAvailable;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;
use \Api\DataProvider\Bo\Bloodstock\Stallion\Stallion;

/**
 * @package Tests\Controllers\Horses\Bloodstock\Stallion\DamSireSeasonsAvailable
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/bloodstock/stallion/734508/dam-sire-seasons-available';
    }

    /**
     * @inheritdoc
     */
    public function tearDown()
    {
        Stallion::clear();
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\Bloodstock\Stallion\SeasonsAvailable:50 ->seasonsAvailableWithCondition()
            'd06ae4ce91d94745674d680ed0d34722' => [
            ],
            //Api\DataProvider\Bo\Bloodstock\Stallion\SeasonsAvailable:81 ->seasonsAvailableWithCondition()
            'dd1b19d10a1a34e7c5ea94ac3024a177' => [
                [
                    'season_type' => 'FLAT',
                    'season_start_date' => '2018-01-01 00:00:00',
                    'season_end_date' => '2018-12-31 23:59:00',
                    'season_desc' => 'Flat 2018',
                ],
                [
                    'season_type' => 'FLAT',
                    'season_start_date' => '2017-01-01 00:00:00',
                    'season_end_date' => '2017-12-31 23:59:00',
                    'season_desc' => 'Flat 2017',
                ],
                [
                    'season_type' => 'FLAT',
                    'season_start_date' => '2016-01-01 00:00:00',
                    'season_end_date' => '2016-12-31 23:59:00',
                    'season_desc' => 'Flat 2016',
                ],
                [
                    'season_type' => 'JUMPS',
                    'season_start_date' => '2017-04-30 00:00:00',
                    'season_end_date' => '2018-04-29 23:59:00',
                    'season_desc' => 'NH 2017-2018',
                ],
            ],
            //Api\Mvc\DataProvider\TemporaryTable:85 ->dropTemporaryTable()
            '52c86dce42960ce6b09e3745c847f1b6' => [
            ],
        ];
    }
}
