<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Native\Cards\CardsList;

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
        return '/horses/native/cards/2018-06-19/list';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\Native\Cards\CardsList:22 ->getData()
            'cc4ac5489b544b2a6abc88817e628c27' => [
                [
                    'course_id' => 80,
                    'course_name' => 'Thirsk',
                    'course_country' => 'GB ',
                    'position' => 1,
                    'rp_position' => 1,
                    'rp_meeting_order' => null,
                    'race_id' => 703327,
                    'race_date' => '2018-06-19 13:40:00',
                    'race_title' => 'EBF Fillies\' Novice Stakes (Plus 10 Race) (Div I)',
                    'race_type' => 'F',
                    'distance' => 1753,
                    'race_status_code' => 'R',
                    'pool_prize_sterling' => 8543.98,
                    'scoop' => null,
                    'satelite_tv_txt' => 'RUK',
                    'terrestrial_tv_txt' => ' ',
                    'race_group' => 'Unknown',
                    'race_group_symbol' => '0',
                    'race_group_uid' => 5,
                    'perform_race' => 1401317,
                    'is_atr' => null,
                    'count_runners' => 9,
                    'hours_difference' => 0.0,
                    'liveCommentary' => 1,
                    'tvText' => 'RUK',
                    'race_class' => '5',
                    'race_group_desc' => 'Unknown',
                    'tvChannels' => null
                ],
                [
                    'course_id' => 67,
                    'course_name' => 'Stratford (A.W)',
                    'course_country' => 'GB ',
                    'position' => 1,
                    'rp_position' => 1,
                    'rp_meeting_order' => null,
                    'race_id' => 703237,
                    'race_date' => '2018-06-19 13:50:00',
                    'race_title' => 'racinguk.com/freetrial Mares\' Novices\' Hurdle (Div I)',
                    'race_type' => 'H',
                    'distance' => 1753,
                    'race_status_code' => 'O',
                    'pool_prize_sterling' => 7623.19,
                    'scoop' => null,
                    'satelite_tv_txt' => 'RUK',
                    'terrestrial_tv_txt' => ' ',
                    'race_group' => 'Unknown',
                    'race_group_symbol' => '0',
                    'race_group_uid' => 5,
                    'perform_race' => 1401319,
                    'is_atr' => null,
                    'count_runners' => 10,
                    'hours_difference' => 0.0,
                    'liveCommentary' => 1,
                    'tvText' => 'RUK',
                    'race_class' => '4',
                    'race_group_desc' => 'Unknown',
                    'tvChannels' => null
                ]
            ],
            //Api\DataProvider\Bo\Native\Cards\BetOffers:51 ->getData()
            '727947097d491977b82ae531bbd57df4' => [
                [
                    'race_instance_uid' => 703327,
                    'race_attrib_uid' => 449,
                    'bet_offer_flag' => 'WH'
                ],
                [
                    'race_instance_uid' => 703327,
                    'race_attrib_uid' => 511,
                    'bet_offer_flag' => 'Bet365'
                ]
            ],
            //Api\DataProvider\Bo\Native\Cards\NextRace:33 ->isAvailable()
            'ef468c060c94681f089fabda0e935cbe' => [
                [
                    'race_id' => 703237,
                ],
            ],
        ];
    }
}
