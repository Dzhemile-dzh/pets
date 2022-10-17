<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Native\Cards\DateMenu;

use UnitTestsComponents\ApiRouteTest\Xml as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\Native\Cards\Predictor\Race
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/native/cards/date-menu?raceDate=2018-07-27';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\Native\Cards\DateMenu\DatesWithRaces:42 ->getData()
            'af875d42b597cd8bdfad3050669dcc30' => [
                [
                    'race_count' => 40,
                    'race_date' => '01.08.2018',
                ],
                [
                    'race_count' => 42,
                    'race_date' => '02.08.2018',
                ],
                [
                    'race_count' => 48,
                    'race_date' => '03.08.2018',
                ],
                [
                    'race_count' => 69,
                    'race_date' => '27.07.2018',
                ],
                [
                    'race_count' => 90,
                    'race_date' => '28.07.2018',
                ],
                [
                    'race_count' => 43,
                    'race_date' => '29.07.2018',
                ],
                [
                    'race_count' => 44,
                    'race_date' => '30.07.2018',
                ],
                [
                    'race_count' => 43,
                    'race_date' => '31.07.2018',
                ],
            ],
        ];
    }
}
