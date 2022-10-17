<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Results\SalesData;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 * @package Tests\Controllers\Horses\RaceResultsCards\SalesData
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/results/714355/sales-data';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models\Bo\Results\RaceInstance:1134 -> getResultsSalesData()
            '09e058b14be16e68eef5c5030cca61af' => [
                [
                    'race_instance_uid' => 714355,
                    'horse_uid' => 1371607,
                    'style_name' => 'Yimou'
                ]
            ],
            //Models\Bo\HorseProfile\Horse:312 -> getSales() DROP TABLE #tmp_horse_ids
            '51c68ca08fb1c1d45408309c82f1814f' => [
            ],
            //Models\Bo\HorseProfile\Horse:312 -> getSales() SELECT INTO #tmp_horse_ids
            '9d77badf21f7fad0709eb398c59ae934' => [
            ],
            //Models\Bo\HorseProfile\Horse:312 -> getSales() Main statement
            'ed177e803cc51e04f0cbce4d5bef2a81' => [
                [
                    'horse_uid' => 1371607,
                    'buyer_detail' => 'Graham Thorner',
                    'price' => 18000,
                    'sale_date' => '2017-11-08 00:00:00',
                    'venue_desc' => 'GOFFS UK (DONCASTER)',
                    'venue_uid' => 44,
                    'lot_no' => 180,
                    'lot_letter' => ' ',
                    'seller_name' => 'From Godolphin',
                    'cur_code' => 'GBP',
                    'sale_name' => 'Goffs UK Autumn HIT and Yearling Sale 2017',
                    'abbrev_name' => 'Goffs UK Autumn (hit & yearlings)',
                    'sale_type' => null
                ]
            ]
        ];
    }
}
