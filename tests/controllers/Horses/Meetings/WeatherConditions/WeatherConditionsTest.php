<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Meetings\WeatherConditions;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

class WeatherConditionsTest extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/meetings/2021-01-11/weather-conditions';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\Meetings\WeatherConditions\WeatherConditions.php:23  ->getWeatherConditionsData()
            '2f3ff5dee3a94978c7d70e2a58df0b17' =>
                [
                    0 => [
                        'course_uid' => 15,
                        'country_code' => 'GB ',
                        'course_type_code' => 'B',
                        'course_style_name' => 'DONCASTER',
                        'style_name' => 'Doncaster',
                        'pre_going_desc' => 'GOOD TO SOFT, Soft in places (GoingStick: 6.9) (Rail movements: 12.30 +42yds, 1.05, 2.05, 3.10 & 3.40 +35yds)',
                        'going_desc' => 'GOOD TO SOFT (Soft in places; 6.9)',
                        'pre_weather_desc' => '(Showers)',
                        'meeting_date' => '2021-01-11 00:00:00',
                        'meeting_abandoned' => NULL,
                        'race_type_code' => 'B',
                        'weather_details' => NULL,
                        'has_finished_race' => 1,
                    ],
                    1 => [
                        'course_uid' => 15,
                        'country_code' => 'GB ',
                        'course_type_code' => 'B',
                        'course_style_name' => 'DONCASTER',
                        'style_name' => 'Doncaster',
                        'pre_going_desc' => 'GOOD TO SOFT, Soft in places (GoingStick: 6.9) (Rail movements: 12.30 +42yds, 1.05, 2.05, 3.10 & 3.40 +35yds)',
                        'going_desc' => 'GOOD TO SOFT (Soft in places; 6.9)',
                        'pre_weather_desc' => '(Showers)',
                        'meeting_date' => '2021-01-11 00:00:00',
                        'meeting_abandoned' => NULL,
                        'race_type_code' => 'C',
                        'weather_details' => NULL,
                        'has_finished_race' => 1,
                    ],
                    2 => [
                        'course_uid' => 15,
                        'country_code' => 'GB ',
                        'course_type_code' => 'B',
                        'course_style_name' => 'DONCASTER',
                        'style_name' => 'Doncaster',
                        'pre_going_desc' => 'GOOD TO SOFT, Soft in places (GoingStick: 6.9) (Rail movements: 12.30 +42yds, 1.05, 2.05, 3.10 & 3.40 +35yds)',
                        'going_desc' => 'GOOD TO SOFT (Soft in places; 6.9)',
                        'pre_weather_desc' => '(Showers)',
                        'meeting_date' => '2021-01-11 00:00:00',
                        'meeting_abandoned' => NULL,
                        'race_type_code' => 'H',
                        'weather_details' => NULL,
                        'has_finished_race' => 1,
                    ],
                    3 => [
                        'course_uid' => 24,
                        'country_code' => 'GB ',
                        'course_type_code' => 'J',
                        'course_style_name' => 'HEREFORD',
                        'style_name' => 'Hereford',
                        'pre_going_desc' => 'SOFT (Rail movements: 12.50 & 3.20 +118yds, 1.20 +150yds, 1.50 +78yds, 2.20 +46yds and 2.50 & 3.50 +111yds)',
                        'going_desc' => 'SOFT',
                        'pre_weather_desc' => '(Light rain)',
                        'meeting_date' => '2021-01-11 00:00:00',
                        'meeting_abandoned' => NULL,
                        'race_type_code' => 'B',
                        'weather_details' => NULL,
                        'has_finished_race' => 1,
                    ],
                    4 => [
                        'course_uid' => 24,
                        'country_code' => 'GB ',
                        'course_type_code' => 'J',
                        'course_style_name' => 'HEREFORD',
                        'style_name' => 'Hereford',
                        'pre_going_desc' => 'SOFT (Rail movements: 12.50 & 3.20 +118yds, 1.20 +150yds, 1.50 +78yds, 2.20 +46yds and 2.50 & 3.50 +111yds)',
                        'going_desc' => 'SOFT',
                        'pre_weather_desc' => '(Light rain)',
                        'meeting_date' => '2021-01-11 00:00:00',
                        'meeting_abandoned' => NULL,
                        'race_type_code' => 'C',
                        'weather_details' => NULL,
                        'has_finished_race' => 1
                    ],
                    5 => [
                        'course_uid' => 24,
                        'country_code' => 'GB ',
                        'course_type_code' => 'J',
                        'course_style_name' => 'HEREFORD',
                        'style_name' => 'Hereford',
                        'pre_going_desc' => 'SOFT (Rail movements: 12.50 & 3.20 +118yds, 1.20 +150yds, 1.50 +78yds, 2.20 +46yds and 2.50 & 3.50 +111yds)',
                        'going_desc' => 'SOFT',
                        'pre_weather_desc' => '(Light rain)',
                        'meeting_date' => '2021-01-11 00:00:00',
                        'meeting_abandoned' => NULL,
                        'race_type_code' => 'H',
                        'weather_details' => NULL,
                        'has_finished_race' => 1,
                    ],
                    6 => [
                        'course_uid' => 513,
                        'country_code' => 'GB ',
                        'course_type_code' => 'X',
                        'course_style_name' => 'WOLVERHAMPTON (A.W)',
                        'style_name' => 'Wolverhampton (A.W)',
                        'pre_going_desc' => 'TAPETA: STANDARD',
                        'going_desc' => 'TAPETA: STANDARD',
                        'pre_weather_desc' => '(Showers)',
                        'meeting_date' => '2021-01-11 00:00:00',
                        'meeting_abandoned' => NULL,
                        'race_type_code' => 'P',
                        'weather_details' => NULL,
                        'has_finished_race' => 0,
                    ],
                    7 => [
                        'course_uid' => 1138,
                        'country_code' => 'IRE',
                        'course_type_code' => 'X',
                        'course_style_name' => 'DUNDALK (A.W)',
                        'style_name' => 'Dundalk (A.W)',
                        'pre_going_desc' => 'POLYTRACK: STANDARD',
                        'going_desc' => 'POLYTRACK: STANDARD',
                        'pre_weather_desc' => '(Showers)',
                        'meeting_date' => '2021-01-11 00:00:00',
                        'meeting_abandoned' => NULL,
                        'race_type_code' => 'H',
                        'weather_details' => NULL,
                        'has_finished_race' => 1,
                    ],
                ]
        ];
    }
}
