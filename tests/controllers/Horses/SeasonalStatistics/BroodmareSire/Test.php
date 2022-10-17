<?php

declare(strict_types=1);

namespace Test\Controllers\Horses\SeasonalStatistics\Broodmare;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 * @package Test\Controllers\Horses\SeasonalStatistics\Broodmare
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/seasonal-statistics/broodmare-sire?raceType=flat&seasonYearBegin=2018&countryCodes[]=GB&countryCodes[]=IRE&age=7&g1Winner=1';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models\Bo\SeasonalStatistics\Season:209 ->getSeasonDatesByYearTypeRace()
            '422e5f6196cc2c95812bed5c1ab8e849' => [
                [
                    'season_uid' => 524,
                    'season_type_code' => 'F',
                    'season_start_date' => '2018-01-01 00:00:00',
                    'season_end_date' => '2018-12-31 23:59:00',
                    'season_start_year' => 2018,
                    'season_end_year' => 2018,
                    'season_desc' => 'Flat 2018',
                ],
            ],
            //Models\Bo\SeasonalStatistics\BroodmareSire:40 ->getTmpTableSeasonalStats()
            '9d5dfb2aacd8eb083eb0918cb80f048a' => [
            ],
            //Models\Bo\SeasonalStatistics:337 ->createStatsTmpIndex()
            '4725a68b1a00afa05647bed0de5b0775' => [
            ],
            //Models\Bo\Selectors\Database:290 ->getEuroRateByYear()
            '67e8960489bb110e58e67f5ed995994b' => [
                [
                    'exchange_rate' => 1.13,
                ],
            ],
            //Models\Bo\SeasonalStatistics\BroodmareSire:105 ->getSeasonalStatistics()
            '084424493b0076a160e8766d2dfeb7a3' => [
                [
                    'dam_sire_uid' => 49087,
                    'dam_sire' => 'Royal Academy',
                    'dam_sire_country_origin_code' => 'USA',
                    'weatherbys_uid' => null,
                    'weatherbys_api_uid' => null,
                    'wins' => 0,
                    'seconds' => 1,
                    'thirds' => 0,
                    'fourths' => 0,
                    'runs' => 1,
                    'rate_euro' => 1.13,
                    'win_prize_money_euro' => 0.0,
                    'win_prize_money_pound' => 0.0,
                    'total_prize_money_euro' => 0.0,
                    'total_prize_money_pound' => 75250.0,
                    'runners' => 1,
                    'winners' => 0,
                    'stakes_wins' => 0,
                    'stakes_winner' => 0,
                    'stakes_runner' => 1,
                ],
                [
                    'dam_sire_uid' => 97591,
                    'dam_sire' => 'Singspiel',
                    'dam_sire_country_origin_code' => 'IRE',
                    'weatherbys_uid' =>  "003955",
                    'weatherbys_api_uid' => "1573899",
                    'wins' => 0,
                    'seconds' => 0,
                    'thirds' => 0,
                    'fourths' => 0,
                    'runs' => 1,
                    'rate_euro' => 1.13,
                    'win_prize_money_euro' => 0.0,
                    'win_prize_money_pound' => 0.0,
                    'total_prize_money_euro' => 0.0,
                    'total_prize_money_pound' => 0.0,
                    'runners' => 1,
                    'winners' => 0,
                    'stakes_wins' => 0,
                    'stakes_winner' => 0,
                    'stakes_runner' => 1,
                ],
            ],
            //Models\Bo\SeasonalStatistics\BroodmareSire:154 ->getProgenyPerformers()
            '3d2d76c63733d1afb7dea6cd12e0dfc7' => [
                [
                    'dam_sire_uid' => 49087,
                    'horse_uid' => 828590,
                    'horse_style_name' => 'Lightning Spear',
                    'horse_country_origin_code' => 'GB',
                    'sire_uid' => 107700,
                    'sire_style_name' => 'Pivotal',
                    'sire_country_origin_code' => 'GB',
                    'rp_postmark' => 122,
                ],
                [
                    'dam_sire_uid' => 97591,
                    'horse_uid' => 851449,
                    'horse_style_name' => 'Suedois',
                    'horse_country_origin_code' => 'FR',
                    'sire_uid' => 717364,
                    'sire_style_name' => 'Le Havre',
                    'sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 106,
                ],
            ],
            //Api\Mvc\DataProvider\TemporaryTable:85 ->dropTemporaryTable()
            'eb50c6d371a291dfb376d7346ce310e6' => [],
            'e03b10673a484a9fb90442c15bf74170' => [],
            'c8767c5cb230e3ef39ddbb7447c0e268' => [],
        ];
    }

    /**
     * @return array
     */
    public function getReplacement(): array
    {
        return [
            'seasonStartDate' => '2018-01-01 00:00:00',
            'seasonEndDate' => '2018-12-31 23:59:00',
        ];
    }
}
