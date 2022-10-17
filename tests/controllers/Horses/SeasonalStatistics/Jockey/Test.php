<?php

declare(strict_types=1);

namespace Test\Controllers\Horses\SeasonalStatistics\Jockey;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Test\Controllers\Horses\SeasonalStatistics\Jockey
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/seasonal-statistics/jockey?seasonYearBegin=2018&raceType=jumps&raceGroupId[]=6&age=7&going=GS&countryCodes[]=GB&countryCodes[]=IRE';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models\Bo\SeasonalStatistics\Season:216 ->getSeasonDatesByYearTypeRace()
            'ec280c5aa51414b92f3aca238b7beff9' => [
                [
                    'season_uid' => 549,
                    'season_type_code' => 'J',
                    'season_start_date' => '2018-04-29 00:00:00',
                    'season_end_date' => '2019-04-27 23:59:00',
                    'season_start_year' => 2018,
                    'season_end_year' => 2019,
                    'season_desc' => 'NH 2018-2019',
                ],
            ],
            //Models\Bo\SeasonalStatistics\Season:216 ->getSeasonDatesByYearTypeRace()
            '2bfc67b26c3045a5167475c538f65b46' => [
                [
                    'season_uid' => 550,
                    'season_type_code' => 'I',
                    'season_start_date' => '2018-04-29 00:00:00',
                    'season_end_date' => '2019-04-27 23:59:00',
                    'season_start_year' => 2018,
                    'season_end_year' => 2019,
                    'season_desc' => 'Irish Jumps 2018-2019',
                ],
            ],
            //Models\Bo\Selectors\Database:290 ->getEuroRateByYear()
            '67e8960489bb110e58e67f5ed995994b' => [
                [
                    'exchange_rate' => 1.13,
                ],
            ],
            //Models\Bo\Selectors\Database:290 ->getEuroRateByYear()
            'd4803421f29592b0482ce21eeb014da9' => [
            ],
            //Models\Bo\SeasonalStatistics\Jockey:101 ->getSeasonalStatistics()
            '7bd305adcbb2e64b60e59fd975009f18' => [
                [
                    'jockey_style_name' => 'Mr Kieren Buckley',
                    'surname' => 'Buckley',
                    'aka_style_name' => 'Mr Kieren Buckley',
                    'apprenctice_status' => 'N',
                    'conditional_status' => 'N',
                    'country_code' => null,
                    'jockey_uid' => 98226,
                    'wins' => 0,
                    'second_place' => 1,
                    'third_place' => 0,
                    'fourth_place' => 0,
                    'runs' => 1,
                    'winnings_pound' => 0.0,
                    'earnings_pound' => 1257.75,
                    'winnings_euro' => 0.0,
                    'earnings_euro' => 1421.2575,
                    'stake' => -1.0,
                    'favourite_runs' => 0,
                    'favourite_wins' => 0,
                ],
                [
                    'jockey_style_name' => 'Sam Twiston-Davies',
                    'surname' => 'Twiston-Davies',
                    'aka_style_name' => 'S Twiston-Davies',
                    'apprenctice_status' => 'N',
                    'conditional_status' => 'N',
                    'country_code' => 'GB',
                    'jockey_uid' => 88023,
                    'wins' => 0,
                    'second_place' => 1,
                    'third_place' => 0,
                    'fourth_place' => 0,
                    'runs' => 1,
                    'winnings_pound' => 0.0,
                    'earnings_pound' => 1106.64,
                    'winnings_euro' => 0.0,
                    'earnings_euro' => 1250.5032,
                    'stake' => -1.0,
                    'favourite_runs' => 1,
                    'favourite_wins' => 0,
                ],
                [
                    'jockey_style_name' => 'Tom Scudamore',
                    'surname' => 'SCUDAMORE',
                    'aka_style_name' => 'T Scudamore',
                    'apprenctice_status' => 'N',
                    'conditional_status' => 'N',
                    'country_code' => 'GB',
                    'jockey_uid' => 80502,
                    'wins' => 0,
                    'second_place' => 0,
                    'third_place' => 1,
                    'fourth_place' => 0,
                    'runs' => 1,
                    'winnings_pound' => 0.0,
                    'earnings_pound' => 801.36,
                    'winnings_euro' => 0.0,
                    'earnings_euro' => 905.5368,
                    'stake' => -1.0,
                    'favourite_runs' => 0,
                    'favourite_wins' => 0,
                ],
                [
                    'jockey_style_name' => 'Ross Chapman',
                    'surname' => 'Chapman',
                    'aka_style_name' => 'Ross Chapman',
                    'apprenctice_status' => 'N',
                    'conditional_status' => 'Y',
                    'country_code' => 'GB',
                    'jockey_uid' => 92580,
                    'wins' => 0,
                    'second_place' => 0,
                    'third_place' => 0,
                    'fourth_place' => 1,
                    'runs' => 1,
                    'winnings_pound' => 0.0,
                    'earnings_pound' => 450.0,
                    'winnings_euro' => 0.0,
                    'earnings_euro' => 508.5,
                    'stake' => -1.0,
                    'favourite_runs' => 0,
                    'favourite_wins' => 0,
                ],
                [
                    'jockey_style_name' => 'Ryan Winks',
                    'surname' => 'Winks',
                    'aka_style_name' => 'Ryan Winks',
                    'apprenctice_status' => 'N',
                    'conditional_status' => 'N',
                    'country_code' => 'GB',
                    'jockey_uid' => 89326,
                    'wins' => 0,
                    'second_place' => 0,
                    'third_place' => 0,
                    'fourth_place' => 0,
                    'runs' => 1,
                    'winnings_pound' => 0.0,
                    'earnings_pound' => 450.0,
                    'winnings_euro' => 0.0,
                    'earnings_euro' => 508.5,
                    'stake' => -1.0,
                    'favourite_runs' => 0,
                    'favourite_wins' => 0,
                ],
                [
                    'jockey_style_name' => 'Mr Luca Morgan',
                    'surname' => 'Morgan',
                    'aka_style_name' => 'Mr Luca Morgan',
                    'apprenctice_status' => 'N',
                    'conditional_status' => 'N',
                    'country_code' => null,
                    'jockey_uid' => 97285,
                    'wins' => 0,
                    'second_place' => 0,
                    'third_place' => 0,
                    'fourth_place' => 0,
                    'runs' => 1,
                    'winnings_pound' => 0.0,
                    'earnings_pound' => 350.0,
                    'winnings_euro' => 0.0,
                    'earnings_euro' => 395.5,
                    'stake' => -1.0,
                    'favourite_runs' => 1,
                    'favourite_wins' => 0,
                ],
                [
                    'jockey_style_name' => 'Tom O\'Brien',
                    'surname' => 'O\'Brien',
                    'aka_style_name' => 'T O\'Brien',
                    'apprenctice_status' => 'N',
                    'conditional_status' => 'N',
                    'country_code' => 'GB',
                    'jockey_uid' => 82134,
                    'wins' => 0,
                    'second_place' => 0,
                    'third_place' => 0,
                    'fourth_place' => 1,
                    'runs' => 1,
                    'winnings_pound' => 0.0,
                    'earnings_pound' => 350.0,
                    'winnings_euro' => 0.0,
                    'earnings_euro' => 395.5,
                    'stake' => -1.0,
                    'favourite_runs' => 0,
                    'favourite_wins' => 0,
                ],
                [
                    'jockey_style_name' => 'Tom Bellamy',
                    'surname' => 'Bellamy',
                    'aka_style_name' => 'T Bellamy',
                    'apprenctice_status' => 'N',
                    'conditional_status' => 'N',
                    'country_code' => 'GB',
                    'jockey_uid' => 89945,
                    'wins' => 0,
                    'second_place' => 0,
                    'third_place' => 0,
                    'fourth_place' => 0,
                    'runs' => 1,
                    'winnings_pound' => 0.0,
                    'earnings_pound' => 0.0,
                    'winnings_euro' => 0.0,
                    'earnings_euro' => 0.0,
                    'stake' => -1.0,
                    'favourite_runs' => 0,
                    'favourite_wins' => 0,
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function getReplacement(): array
    {
        return [
            'seasonStartDate' => '2018-04-29 00:00:00',
            'seasonEndDate' => '2019-04-27 23:59:00',
        ];
    }
}
