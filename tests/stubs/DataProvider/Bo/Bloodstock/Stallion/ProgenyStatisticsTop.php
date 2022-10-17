<?php
namespace Tests\Stubs\DataProvider\Bo\Bloodstock\Stallion;

use Api\Input\Request\HorsesRequest;
use Models\Selectors;
use Phalcon\Mvc\Model\Row\General;

class ProgenyStatisticsTop extends \Api\DataProvider\Bo\Bloodstock\Stallion\ProgenyStatisticsTop
{
    /**
     * @param HorsesRequest $request
     * @param Selectors     $selectors
     * @param string        $category
     *
     * @return \Phalcon\Mvc\Model\Row\General[]
     */
    public function findTopProgeny(HorsesRequest $request, Selectors $selectors, $category = null)
    {
        return [
            0 => General::createFromArray(
                [
                    'horse_style_name' => 'Frankel',
                    'horse_uid' => 763453,
                    'dam_sire_uid' => 42373,
                    'dam_sire_style_name' => 'Danehill',
                    'sire_uid' => 42373,
                    'sire_style_name' => 'Danehill',
                    'rp_postmark' => 143,
                    'runs' => 12,
                    'wins' => 12,
                    'total_prize_money' => 2982864.0899999999,
                ]
            ),
            1 => General::createFromArray(
                [
                    'horse_style_name' => 'Rip Van Winkle',
                    'horse_uid' => 695691,
                    'dam_sire_uid' => 500343,
                    'dam_sire_style_name' => 'Stravinsky',
                    'sire_uid' => 500343,
                    'sire_style_name' => 'Stravinsky',
                    'rp_postmark' => 132,
                    'runs' => 11,
                    'wins' => 4,
                    'total_prize_money' => 1191759.02,
                ]
            ),
            2 => General::createFromArray(
                [
                    'horse_style_name' => 'New Approach',
                    'horse_uid' => 670119,
                    'dam_sire_uid' => 300030,
                    'dam_sire_style_name' => 'Ahonoora',
                    'sire_uid' => 500343,
                    'sire_style_name' => 'Stravinsky',
                    'rp_postmark' => 131,
                    'runs' => 10,
                    'wins' => 7,
                    'total_prize_money' => 1983270.72,
                ]
            )
        ];
    }

    /**
     * @param HorsesRequest $request
     *
     * @return General[]
     */
    public function getWorldwideG1Progeny(HorsesRequest $request)
    {
        return [
            0 => General::createFromArray(
                [
                    'horse_style_name' => 'Frankel',
                    'horse_uid' => 763453,
                    'dam_sire_uid' => 42373,
                    'dam_sire_style_name' => 'Danehill',
                    'rp_postmark' => 143,
                    'runs' => 12,
                    'wins' => 12,
                    'total_prize_money' => 2982864.0899999999,
                ]
            ),
            1 => General::createFromArray(
                [
                    'horse_style_name' => 'Rip Van Winkle',
                    'horse_uid' => 695691,
                    'dam_sire_uid' => 500343,
                    'dam_sire_style_name' => 'Stravinsky',
                    'rp_postmark' => 132,
                    'runs' => 11,
                    'wins' => 4,
                    'total_prize_money' => 1191759.02,
                ]
            ),
            2 => General::createFromArray(
                [
                    'horse_style_name' => 'New Approach',
                    'horse_uid' => 670119,
                    'dam_sire_uid' => 300030,
                    'dam_sire_style_name' => 'Ahonoora',
                    'rp_postmark' => 131,
                    'runs' => 10,
                    'wins' => 7,
                    'total_prize_money' => 1983270.72,
                ]
            ),
            3 => General::createFromArray(
                [
                    'horse_style_name' => 'Australia',
                    'horse_uid' => 826492,
                    'dam_sire_uid' => 450464,
                    'dam_sire_style_name' => 'Cape Cross',
                    'rp_postmark' => 129,
                    'runs' => 6,
                    'wins' => 4,
                    'total_prize_money' => 2078905.3200000001,
                ]
            ),
            4 => General::createFromArray(
                [
                    'horse_style_name' => 'Nathaniel',
                    'horse_uid' => 748243,
                    'dam_sire_uid' => 302273,
                    'dam_sire_style_name' => 'Silver Hawk',
                    'rp_postmark' => 127,
                    'runs' => 8,
                    'wins' => 3,
                    'total_prize_money' => 1458401.8,
                ]
            ),
            5 => General::createFromArray(
                [
                    'horse_style_name' => 'Soldier Of Fortune',
                    'horse_uid' => 660612,
                    'dam_sire_uid' => 485879,
                    'dam_sire_style_name' => 'Erins Isle',
                    'rp_postmark' => 127,
                    'runs' => 10,
                    'wins' => 5,
                    'total_prize_money' => 1254200.1399999999,
                ]
            ),
            6 => General::createFromArray(
                [
                    'horse_style_name' => 'Intello',
                    'horse_uid' => 820989,
                    'dam_sire_uid' => 42373,
                    'dam_sire_style_name' => 'Danehill',
                    'rp_postmark' => 125,
                    'runs' => 7,
                    'wins' => 4,
                    'total_prize_money' => 1335767.25,
                ]
            ),
            7 => General::createFromArray(
                [
                    'horse_style_name' => 'Order Of St George',
                    'horse_uid' => 865578,
                    'dam_sire_uid' => 304229,
                    'dam_sire_style_name' => 'Gone West',
                    'rp_postmark' => 125,
                    'runs' => 5,
                    'wins' => 2,
                    'total_prize_money' => 205165.54000000001,
                ]
            ),
            8 => General::createFromArray(
                [
                    'horse_style_name' => 'Red Rocks',
                    'horse_uid' => 643654,
                    'dam_sire_uid' => 53070,
                    'dam_sire_style_name' => 'Machiavellian',
                    'rp_postmark' => 125,
                    'runs' => 10,
                    'wins' => 2,
                    'total_prize_money' => 295474.56,
                ]
            ),
            9 => General::createFromArray(
                [
                    'horse_style_name' => 'Ruler Of The World',
                    'horse_uid' => 800342,
                    'dam_sire_uid' => 79045,
                    'dam_sire_style_name' => 'Kingmambo',
                    'rp_postmark' => 125,
                    'runs' => 7,
                    'wins' => 3,
                    'total_prize_money' => 1061547.6899999999,
                ]
            ),
        ];
    }

    /**
     * @param HorsesRequest $request
     *
     * @return General[]
     */
    public function getEuroStakesProgeny(HorsesRequest $request)
    {
        return [
            0 => General::createFromArray(
                [
                    'horse_style_name' => 'Frankel',
                    'horse_uid' => 763453,
                    'dam_sire_uid' => 42373,
                    'dam_sire_style_name' => 'Danehill',
                    'rp_postmark' => 143,
                    'runs' => 12,
                    'wins' => 12,
                    'total_prize_money' => 2982864.0899999999,
                ]
            ),
            1 => General::createFromArray(
                [
                    'horse_style_name' => 'Rip Van Winkle',
                    'horse_uid' => 695691,
                    'dam_sire_uid' => 500343,
                    'dam_sire_style_name' => 'Stravinsky',
                    'rp_postmark' => 132,
                    'runs' => 11,
                    'wins' => 4,
                    'total_prize_money' => 1191759.02,
                ]
            ),
            2 => General::createFromArray(
                [
                    'horse_style_name' => 'New Approach',
                    'horse_uid' => 670119,
                    'dam_sire_uid' => 300030,
                    'dam_sire_style_name' => 'Ahonoora',
                    'rp_postmark' => 131,
                    'runs' => 10,
                    'wins' => 7,
                    'total_prize_money' => 1983270.72,
                ]
            ),
            3 => General::createFromArray(
                [
                    'horse_style_name' => 'Australia',
                    'horse_uid' => 826492,
                    'dam_sire_uid' => 450464,
                    'dam_sire_style_name' => 'Cape Cross',
                    'rp_postmark' => 129,
                    'runs' => 6,
                    'wins' => 4,
                    'total_prize_money' => 2078905.3200000001,
                ]
            ),
            4 => General::createFromArray(
                [
                    'horse_style_name' => 'Nathaniel',
                    'horse_uid' => 748243,
                    'dam_sire_uid' => 302273,
                    'dam_sire_style_name' => 'Silver Hawk',
                    'rp_postmark' => 127,
                    'runs' => 8,
                    'wins' => 3,
                    'total_prize_money' => 1458401.8,
                ]
            ),
            5 => General::createFromArray(
                [
                    'horse_style_name' => 'Soldier Of Fortune',
                    'horse_uid' => 660612,
                    'dam_sire_uid' => 485879,
                    'dam_sire_style_name' => 'Erins Isle',
                    'rp_postmark' => 127,
                    'runs' => 10,
                    'wins' => 5,
                    'total_prize_money' => 1254200.1399999999,
                ]
            ),
            6 => General::createFromArray(
                [
                    'horse_style_name' => 'Intello',
                    'horse_uid' => 820989,
                    'dam_sire_uid' => 42373,
                    'dam_sire_style_name' => 'Danehill',
                    'rp_postmark' => 125,
                    'runs' => 7,
                    'wins' => 4,
                    'total_prize_money' => 1335767.25,
                ]
            ),
            7 => General::createFromArray(
                [
                    'horse_style_name' => 'Order Of St George',
                    'horse_uid' => 865578,
                    'dam_sire_uid' => 304229,
                    'dam_sire_style_name' => 'Gone West',
                    'rp_postmark' => 125,
                    'runs' => 5,
                    'wins' => 2,
                    'total_prize_money' => 205165.54000000001,
                ]
            ),
            8 => General::createFromArray(
                [
                    'horse_style_name' => 'Red Rocks',
                    'horse_uid' => 643654,
                    'dam_sire_uid' => 53070,
                    'dam_sire_style_name' => 'Machiavellian',
                    'rp_postmark' => 125,
                    'runs' => 10,
                    'wins' => 2,
                    'total_prize_money' => 295474.56,
                ]
            ),
            9 => General::createFromArray(
                [
                    'horse_style_name' => 'Ruler Of The World',
                    'horse_uid' => 800342,
                    'dam_sire_uid' => 79045,
                    'dam_sire_style_name' => 'Kingmambo',
                    'rp_postmark' => 125,
                    'runs' => 7,
                    'wins' => 3,
                    'total_prize_money' => 1061547.6899999999,
                ]
            ),
        ];
    }
}
