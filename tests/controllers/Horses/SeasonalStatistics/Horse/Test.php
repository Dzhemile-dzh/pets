<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\SeasonalStatistics\Horse;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 * @package Tests\Controllers\Horses\SeasonalStatistics\Horse
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/seasonal-statistics/horse?seasonYearBegin=2018&raceType=flat&raceGroupId[]=6&countryCodes[]=GB&countryCodes[]=IRE&age=6&going=GS&progenyPerformersLimit=1';
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
            //Models\Bo\Selectors\Database:290 ->getEuroRateByYear()
            '67e8960489bb110e58e67f5ed995994b' => [
                [
                    'exchange_rate' => 1.13,
                ],
            ],
            //Models\Bo\SeasonalStatistics\Horse:135 ->getSeasonalStatistics()
            'e4336fa82183d46826c8aff367630a86' => [
                [
                    'horse_style_name' => 'Gulf Of Poets',
                    'horse_sex_code' => 'G',
                    'country_code' => 'GB',
                    'sire_uid' => 565797,
                    'sire_style_name' => 'Oasis Dream',
                    'sire_country_origin_code' => 'GB',
                    'trainer_uid' => 699,
                    'trainer_style_name' => 'Michael Easterby',
                    'horse_uid' => 885238,
                    'last_race_datetime' => '2018-05-05 15:05:00',
                    'horse_age' => 6,
                    'rpr' => 104,
                    'wins' => 1,
                    'second_place' => 0,
                    'third_place' => 1,
                    'fourth_place' => 0,
                    'runs' => 2,
                    'winnings_pound' => 6469.0,
                    'earnings_pound' => 10317.0,
                    'net_win_prize' => 6469.0,
                    'net_total_prize' => 10317.0,
                    'winnings_euro' => 7309.97,
                    'earnings_euro' => 11658.21,
                    'stake' => 5.0,
                ],
                [
                    'horse_style_name' => 'Windsor Beach',
                    'horse_sex_code' => 'G',
                    'country_code' => 'IRE',
                    'sire_uid' => 726295,
                    'sire_style_name' => 'Starspangledbanner',
                    'sire_country_origin_code' => 'AUS',
                    'trainer_uid' => 26177,
                    'trainer_style_name' => 'John Butler',
                    'horse_uid' => 864143,
                    'last_race_datetime' => '2018-04-28 14:20:00',
                    'horse_age' => 6,
                    'rpr' => 99,
                    'wins' => 1,
                    'second_place' => 0,
                    'third_place' => 0,
                    'fourth_place' => 0,
                    'runs' => 1,
                    'winnings_pound' => 9337.5,
                    'earnings_pound' => 9337.5,
                    'net_win_prize' => 9337.5,
                    'net_total_prize' => 9337.5,
                    'winnings_euro' => 10551.375,
                    'earnings_euro' => 10551.375,
                    'stake' => 20.0,
                ],
                [
                    'horse_style_name' => 'Rapid Applause',
                    'horse_sex_code' => 'G',
                    'country_code' => 'GB',
                    'sire_uid' => 103416,
                    'sire_style_name' => 'Royal Applause',
                    'sire_country_origin_code' => 'GB',
                    'trainer_uid' => 699,
                    'trainer_style_name' => 'Michael Easterby',
                    'horse_uid' => 856823,
                    'last_race_datetime' => '2018-05-06 15:45:00',
                    'horse_age' => 6,
                    'rpr' => 96,
                    'wins' => 1,
                    'second_place' => 0,
                    'third_place' => 0,
                    'fourth_place' => 0,
                    'runs' => 1,
                    'winnings_pound' => 6727.76,
                    'earnings_pound' => 6727.76,
                    'net_win_prize' => 6727.76,
                    'net_total_prize' => 6727.76,
                    'winnings_euro' => 7602.3688,
                    'earnings_euro' => 7602.3688,
                    'stake' => 3.0,
                ],
                [
                    'horse_style_name' => 'Wemyss Point',
                    'horse_sex_code' => 'G',
                    'country_code' => 'GB',
                    'sire_uid' => 647498,
                    'sire_style_name' => 'Champs Elysees',
                    'sire_country_origin_code' => 'GB',
                    'trainer_uid' => 18875,
                    'trainer_style_name' => 'Philip Kirby',
                    'horse_uid' => 851290,
                    'last_race_datetime' => '2018-04-23 15:40:00',
                    'horse_age' => 6,
                    'rpr' => 75,
                    'wins' => 1,
                    'second_place' => 0,
                    'third_place' => 0,
                    'fourth_place' => 0,
                    'runs' => 1,
                    'winnings_pound' => 5175.2,
                    'earnings_pound' => 5175.2,
                    'net_win_prize' => 5175.2,
                    'net_total_prize' => 5175.2,
                    'winnings_euro' => 5847.976,
                    'earnings_euro' => 5847.976,
                    'stake' => 6.0,
                ],
                [
                    'horse_style_name' => 'Ingleby Hollow',
                    'horse_sex_code' => 'G',
                    'country_code' => 'GB',
                    'sire_uid' => 516606,
                    'sire_style_name' => 'Beat Hollow',
                    'sire_country_origin_code' => 'GB',
                    'trainer_uid' => 22839,
                    'trainer_style_name' => 'David O\'Meara',
                    'horse_uid' => 870263,
                    'last_race_datetime' => '2018-05-05 13:25:00',
                    'horse_age' => 6,
                    'rpr' => 73,
                    'wins' => 1,
                    'second_place' => 0,
                    'third_place' => 0,
                    'fourth_place' => 0,
                    'runs' => 1,
                    'winnings_pound' => 3493.26,
                    'earnings_pound' => 3493.26,
                    'net_win_prize' => 3493.26,
                    'net_total_prize' => 3493.26,
                    'winnings_euro' => 3947.3838,
                    'earnings_euro' => 3947.3838,
                    'stake' => 2.25,
                ],
                [
                    'horse_style_name' => 'Be Bold',
                    'horse_sex_code' => 'G',
                    'country_code' => 'GB',
                    'sire_uid' => 626739,
                    'sire_style_name' => 'Assertive',
                    'sire_country_origin_code' => 'GB',
                    'trainer_uid' => 30212,
                    'trainer_style_name' => 'Rebecca Bastiman',
                    'horse_uid' => 852767,
                    'last_race_datetime' => '2018-04-30 14:20:00',
                    'horse_age' => 6,
                    'rpr' => 63,
                    'wins' => 1,
                    'second_place' => 0,
                    'third_place' => 0,
                    'fourth_place' => 0,
                    'runs' => 1,
                    'winnings_pound' => 3398.17,
                    'earnings_pound' => 3398.17,
                    'net_win_prize' => 3398.17,
                    'net_total_prize' => 3398.17,
                    'winnings_euro' => 3839.9321,
                    'earnings_euro' => 3839.9321,
                    'stake' => 28.0,
                ],
                [
                    'horse_style_name' => 'Harbour Patrol',
                    'horse_sex_code' => 'G',
                    'country_code' => 'IRE',
                    'sire_uid' => 541314,
                    'sire_style_name' => 'Acclamation',
                    'sire_country_origin_code' => 'GB',
                    'trainer_uid' => 30212,
                    'trainer_style_name' => 'Rebecca Bastiman',
                    'horse_uid' => 855461,
                    'last_race_datetime' => '2018-04-30 14:55:00',
                    'horse_age' => 6,
                    'rpr' => 58,
                    'wins' => 1,
                    'second_place' => 0,
                    'third_place' => 0,
                    'fourth_place' => 0,
                    'runs' => 1,
                    'winnings_pound' => 3398.17,
                    'earnings_pound' => 3398.17,
                    'net_win_prize' => 3398.17,
                    'net_total_prize' => 3398.17,
                    'winnings_euro' => 3839.9321,
                    'earnings_euro' => 3839.9321,
                    'stake' => 7.0,
                ],
                [
                    'horse_style_name' => 'Carraigin Aonair',
                    'horse_sex_code' => 'M',
                    'country_code' => 'IRE',
                    'sire_uid' => 596550,
                    'sire_style_name' => 'Fastnet Rock',
                    'sire_country_origin_code' => 'AUS',
                    'trainer_uid' => 33553,
                    'trainer_style_name' => 'Olly Murphy',
                    'horse_uid' => 888963,
                    'last_race_datetime' => '2018-05-02 18:40:00',
                    'horse_age' => 6,
                    'rpr' => 59,
                    'wins' => 1,
                    'second_place' => 0,
                    'third_place' => 0,
                    'fourth_place' => 0,
                    'runs' => 1,
                    'winnings_pound' => 3105.12,
                    'earnings_pound' => 3105.12,
                    'net_win_prize' => 3105.12,
                    'net_total_prize' => 3105.12,
                    'winnings_euro' => 3508.7856,
                    'earnings_euro' => 3508.7856,
                    'stake' => 1.375,
                ],
            ],
            //Api\Mvc\DataProvider\TemporaryTable:85 ->dropTemporaryTable()
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
            'seasonEndDate' => '2018-12-31 23:59:59',
        ];
    }
}
