<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\RaceCards\WindSurgeries;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\RaceCards\Runners
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/racecards/698515/wind-surgeries';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\RaceCards\WindSurgeries:101 ->getData()
            '52e9cf583ee5c7a4f11ea261d61cb230' => [
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 724070,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 780205,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 798177,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 799109,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 799387,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 803283,
                    'amount_races_after_surgery' => 1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'Y',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 810016,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 824337,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 826157,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 830335,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 830549,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 832519,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 834219,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 838796,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 841033,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 848280,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 848743,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 851772,
                    'amount_races_after_surgery' => 3,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 854993,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 855396,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 857308,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 860300,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 860332,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 871871,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 872366,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 874188,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 874547,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 879645,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 882071,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 883120,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 883823,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 884391,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 889788,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 905153,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
                [
                    'race_datetime' => '2018-05-05 15:55:00',
                    'horse_uid' => 988603,
                    'amount_races_after_surgery' => -1,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                ],
            ],
        ];
    }
}
