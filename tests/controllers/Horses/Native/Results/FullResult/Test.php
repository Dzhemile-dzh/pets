<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Native\Results\FullResult;

use UnitTestsComponents\ApiRouteTest\Xml as ApiRouteTestPrototype;

/**
 * @package Tests\Controllers\Horses\Native\Results\ResultsList
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/native/results/703306/full-result';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\Native\Results\creteHorseRaceTmpTable:287 ->getData()
            '5db4385fd5e685ce1bd1ee3bc35d3dab' => [

            ],
            //Api\DataProvider\Bo\Native\Results\FullResult:22 ->getData()
            '433f2113395bfb6d3cc67e80d958a604' => [
                [
                    'raceTitle' => 'Sky Bet Racing Cash Out "Confined" Novice Stakes (Run No More Than Four Times)',
                    'raceDate' => '2018-06-18 21:00:00',
                    'raceTime' => null,
                    'meetingName' => 'Windsor',
                    'country_code' => 'AUS',
                    'placepot_text' => chr(163) . '33.30 to a ' . chr(163) . '1 stake. Pool: ' . chr(163) . '88,142.02 - 1,927.03 winning units',
                    'quadpot_text' => chr(128) . '9.90 to a ' . chr(128) . '1 stake. Pool: ' . chr(128) . '7,290.98 - 542.27 winning units',
                    'jackpot_text' => '',
                    'hasCompetitorDetails' => 1,
                    'type' => 'F',
                    'distance' => 2200,
                    'distanceRounded' => 2200,
                    'distanceRoundedFurlong' => 2200,
                    'group' => null,
                    'going' => 'Good To Firm',
                    'agesAllowed' => '3yo+',
                    'class' => 5,
                    'adsChangeDelay' => null,
                    'winnerTime' => 129.61,
                    'diffStdTimeSec' => 5.11,
                    'actualRunners' => 7,
                ],
            ],
            //Api/DataProvider\Bo\Native\Results\FullResult:81 -> getPrizes()
            '6c949baeeec13812fa20656c53be7639' => [
                [
                    'prizeGbp' => '3752.02',
                    'prizeEur' => null,
                ],
                [
                    'prizeGbp' => '1116.5',
                    'prizeEur' => null,
                ],
                [
                    'prizeGbp' => '557.96',
                    'prizeEur' => null,
                ],
                [
                    'prizeGbp' => '278.98',
                    'prizeEur' => null,
                ],
            ],
            //Api/DataProvider\Bo\Native\Results\FullResult:114 -> getTote()
            '58da9cb52e79c269caab86f9e5cdceaa' => [
                [
                    'tote_win_money' => 1.1000,
                    'tote_place_1_money' => 1.1000,
                    'tote_place_2_money' => 5.7000,
                    'tote_place_3_money' => null,
                    'tote_place_4_money' => null,
                    'tricast_money' => null,
                    'tote_dual_forecast_money' => 13.9000,
                    'computer_strght_frcst_money' => 12.4100,
                    'tote_deadheat_text' => ''
                ]
            ],
            //Api/DataProvider\Bo\Native\Results\FullResult:145 -> getRunners()
            '3c088f4933504437780573225c26b96c' => [
                [
                    'horse_uid' => 1938006,
                    'horse_name' => 'Rock Eagle',
                    'country_origin_code' => 'GB',
                    'rate' => '1/4F',
                    'owner_uid' => 16523,
                    'rp_owner_choice' => 'b',
                    'rp_close_up_comment' => 'led at moderate pace, headed 4f out and immediately pushed along when pace lifted, closed again over 2f out, driven ahead over 1f out, kept on',
                    'rp_betting_movements' => 'op 2/5',
                    'race_outcome_code' => 1,
                    'trainer' => 'Ralph Beckett',
                    'jockey' => 'Harry Bentley',
                    'draw' => 8,
                    'weight' => 135,
                    'rp_distance_desc' => null,
                    'age' => 3
                ],
                [
                    'horse_uid' => 1266649,
                    'horse_name' => 'Hidden Depths',
                    'country_origin_code' => 'GB',
                    'rate' => '20/1',
                    'owner_uid' => 263692,
                    'rp_owner_choice' => 'b',
                    'rp_close_up_comment' => 'took keen hold, held up in 4th, swift move to lead 4f out, injected pace and stretched field, headed and no extra over 1f out',
                    'rp_betting_movements' => 'op 33/1',
                    'race_outcome_code' => 2,
                    'trainer' => 'Sir Michael Stoute',
                    'jockey' => 'Jimmy Quinn',
                    'draw' => 7,
                    'weight' => 128,
                    'rp_distance_desc' => '2 3/4',
                    'age' => 3
                ]
            ],
            //Api/DataProvider\Bo\Native\Results\FullResult:236 -> getNonRunners()
            'fe55625921a028a94903c5fd196c2bc9' => [
                [
                    'horse_uid' => 1609717,
                    'horse_name' => 'Department Of War',
                    'trainer' => 'Richard Hannon',
                    'jockey' => '-',
                    'weight' => 135,
                    'age' => 3

                ]
            ],
            //Api/DataProvider\Bo\Native\Results\FullResult:294 -> getLastRace()
            'f5f8c73aac4f083c41308fb95f8c8292' => [
                [
                    'race_instance_uid' => 703306
                ]
            ]

        ];
    }
}
