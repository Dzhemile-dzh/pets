<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\SeasonalStatistics\Sire;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 * @package Tests\Controllers\Horses\SeasonalStatistics\Sire
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/seasonal-statistics/sire?seasonYearBegin=2018&raceType=jumps&raceGroupId[]=6&age=7&going=GS&countryCodes[]=GB&countryCodes[]=IRE&&progenyPerformersLimit=1';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models\Bo\SeasonalStatistics\Season:209 ->getSeasonDatesByYearTypeRace()
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
            //Models\Bo\SeasonalStatistics\Season:209 ->getSeasonDatesByYearTypeRace()
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
            //Models\Bo\SeasonalStatistics\Sire:55 ->getTmpTableSeasonalStats()
            '95100461f5b3721d053c5ede19b5483f' => [
            ],
            //Models\Bo\SeasonalStatistics:324 ->createStatsTmpIndex()
//            'dd3d2c8defee7eb3c03e46f48b8fc97b' => [],
            '4725a68b1a00afa05647bed0de5b0775' => [],
            //Models\Bo\Selectors\Database:290 ->getEuroRateByYear()
            '67e8960489bb110e58e67f5ed995994b' => [
                [
                    'exchange_rate' => 1.13,
                ],
            ],
            //Models\Bo\SeasonalStatistics\Sire:124 ->getSeasonalStatistics()
            '2b45de936ee49e847b49460e8deb297b' => [
                [
                    'sire_uid' => 660597,
                    'sire' => 'Mahler',
                    'sire_country_origin_code' => 'GB',
                    'weatherbys_uid' => '001234',
                    'weatherbys_api_uid' => '001234',
                    'rate_euro' => 1.13,
                    'wins' => 0,
                    'seconds' => 0,
                    'thirds' => 0,
                    'fourths' => 0,
                    'runs' => 8,
                    'win_prize_money_euro' => 0.0,
                    'win_prize_money_pound' => 0.0,
                    'total_prize_money_euro' => 0.0,
                    'total_prize_money_pound' => 3600.0,
                    'net_win_prize_money' => 0.0,
                    'net_total_prize_money' => 10112.4,
                    'runners' => 1,
                    'winners' => 0,
                    'stakes_wins' => 0,
                    'stakes_winner' => 0,
                    'stakes_runner' => 0,
                ],
            ],
            'aee29d56911918d8087d9f896e563dc4' => [
                [
                    'sire_uid' => 660597,
                    'sire' => 'Mahler',
                    'sire_country_origin_code' => 'GB',
                    'weatherbys_uid' => '001234',
                    'weatherbys_api_uid' => '001234',
                    'rate_euro' => 1.13,
                    'wins' => 0,
                    'seconds' => 0,
                    'thirds' => 0,
                    'fourths' => 0,
                    'runs' => 8,
                    'win_prize_money_euro' => 0.0,
                    'win_prize_money_pound' => 0.0,
                    'total_prize_money_euro' => 0.0,
                    'total_prize_money_pound' => 3600.0,
                    'net_win_prize_money' => 0.0,
                    'net_total_prize_money' => 10112.4,
                    'runners' => 1,
                    'winners' => 0,
                    'stakes_wins' => 0,
                    'stakes_winner' => 0,
                    'stakes_runner' => 0,
                ],
            ],
            //Models\Bo\SeasonalStatistics\Sire:188 ->getProgenyPerformers()
            '256468a30e11dd675b329e613081a092' => [
                [
                    'sire_uid' => 660597,
                    'horse_uid' => 890709,
                    'horse_style_name' => 'Grow Nasa Grow',
                    'horse_country_origin_code' => 'IRE',
                    'dam_sire_uid' => 301308,
                    'dam_sire_style_name' => 'Lancastrian',
                    'dam_sire_country_origin_code' => 'GB',
                    'rp_postmark' => 50,
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
            'seasonStartDate' => '2018-04-29 00:00:00',
            'seasonEndDate' => '2019-04-27 23:59:00',
        ];
    }
}
