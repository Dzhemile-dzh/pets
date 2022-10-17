<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Native\Results\MenuDate;

use UnitTestsComponents\ApiRouteTest\Xml as ApiRouteTestPrototype;

/**
 * @package Tests\Controllers\Horses\Native\Results\MenuDate
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/native/results/date-menu';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\Native\Results\MenuDate:72 ->getData()
            '419bea4c352b958d6ce8d8201af1e562' => [
                [
                    "date" => "2018-12-03 13:27:37"
                ]
            ],
            '48d46f97d0f8603b12e27397a730ce51' => [
                [
                    "race_count" => 100,
                    "unique_race_date" => "2018-12-03"
                ],
                [
                    "race_count" => 171,
                    "unique_race_date" => "2018-12-02"
                ],
                // there are no any finished races on those dates, so they completely miss in the result.
                // we have to build them manually in the PHP
//                [
//                    "race_count" => 165,
//                    "unique_race_date" => "2018-12-01"
//                ],
//                [
//                    "race_count" => 229,
//                    "unique_race_date" => "2018-11-30"
//                ],
                [
                    "race_count" => 464,
                    "unique_race_date" => "2018-11-29"
                ],
                [
                    "race_count" => 362,
                    "unique_race_date" => "2018-11-28"
                ]
            ],

        ];
    }
}
