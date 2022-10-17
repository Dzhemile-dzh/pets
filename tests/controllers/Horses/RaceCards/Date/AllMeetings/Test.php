<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\RaceCards\Date\AllMeetings;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\RaceCards\Date\AllMeetings
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/racecards/date/2018-05-03/all-meetings';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\RaceCards\Date\AllMeetings:103 ->getData()
            '2006cb050db54871d9cccda21a45ea55' => [
                [
                    'course_uid' => 82,
                    'course_name' => 'Valparaiso Sporting Club',
                    'country_code' => 'CHI',
                    'meeting_abandoned' => 'N',
                    'race_instance_uid' => 264653,
                    'race_datetime' => '2018-05-03 00:17:00',
                    'race_status_code' => 'R',
                    'horses_database' => 'N',
                    'course_region' => 'South America'
                ],
                [
                    'course_uid' => 159,
                    'course_name' => 'Evangeline Downs',
                    'country_code' => 'CHI',
                    'meeting_abandoned' => 'Y',
                    'race_instance_uid' => 264943,
                    'race_datetime' => '2018-05-03 00:18:00',
                    'race_status_code' => 'A',
                    'horses_database' => 'N',
                    'course_region' => 'South America'
                ],
                [
                    'course_uid' => 80,
                    'course_name' => 'Thirsk',
                    'country_code' => 'GB ',
                    'meeting_abandoned' => null,
                    'race_instance_uid' => 780392,
                    'race_datetime' => '2021-04-17 11:10:00',
                    'race_status_code' => 'R',
                    'horses_database' => 'Y',
                    'course_region' => 'GB & IRE'
                ]
            ],
        ];
    }
}
