<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\OwnerGroups\DailyStats;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\OwnerGroups\Entries\General
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/owner-groups/daily-stats/coolmore?date=2200-01-01';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\OwnerGroups\DailyStats:27 ->getData() temp table
            '387982c0fff310ba5ea772aa3c2ef397' => [
                ],
            //Api\DataProvider\Bo\DailyStats:23 ->getData() Drop temp table
            'c3209aba1ca7c6ed4ecb499c15f0e4b3' => [
                ],
            //Api\DataProvider\Bo\VideoProviders:148 - update dist
            'd8c2065b684fa9dcc92ed021169f1dbf' => [
                ],
            //Api\DataProvider\Bo\VideoProviders:163 - select from temp table
                '66c99ce8bee3b1f5118578255b618fe1' => [
                    [
                        'horse_uid' => 12345,
                        'date' => 'Mar 14 2020',
                        'course' => 'KENSINGTON',
                        'cntry' => 'AUS',
                        'm' => 1,
                        'f' => 9,
                        'yd' => 0,
                        'going' => 'G',
                        'horse_name' => 'BIRTH OF VENUS',
                        'age' => 5,
                        'sex' => 'M',
                        'wght_lbs' => 129,
                        'headgear' => null,
                        'title' => 'Bowermans Office Furniture Handicap (3yo+) (Turf)',
                        'Code' => 'Flat Turf',
                        'Type' => 'Handicap',
                        'fin_pos' => '2nd',
                        'EUROS' => null,
                        'STERLING' => 5608.4656,
                        'time' => 109.13,
                        'diff' => null,
                        'jockey' => 'OISIN ORR',
                        'trainer' => 'CHRIS WALLER',
                        'RPR' => 0,
                        'rp_close_up_comment' => 'some long ass comment'
                    ]
                ]
        ];
    }
}
