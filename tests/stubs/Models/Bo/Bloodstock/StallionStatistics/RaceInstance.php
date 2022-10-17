<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 2/26/2016
 * Time: 12:43 PM
 */

namespace Tests\Stubs\Models\Bo\Bloodstock\StallionStatistics;

class RaceInstance extends \Tests\Stubs\Models\RaceInstance
{
    /**
     * @param \Api\Input\Request\HorsesRequest $request
     * @param \Models\Selectors                 $selectors
     *
     * @return array
     */
    public function getRatingStatistic($request, $selectors)
    {
        return [
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 828368,
                    'horse_name' => 'Fame Game',
                    'horse_sex' => 'h',
                    'horse_age' => 6,
                    'horse_country' => 'JPN',
                    'sire_uid' => 597689,
                    'sire_name' => 'Heart\'s Cry',
                    'trainer_uid' => 12910,
                    'trainer_name' => 'Yoshitada Munakata',
                    'best_rpr' => 123,
                    'best_or' => 116,
                    'current_or' => 116,
                    'wins' => 5,
                    'runs' => 7,
                    'winnings_pound' => 4500.00,
                    'earnings_pound' => 4500.00,
                    'winnings_euro' => 4800.00,
                    'earnings_euro' => 4800.00,
                    'stake' => 3.00,
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 883627,
                    'horse_name' => 'Kitasan Black',
                    'horse_sex' => 'c',
                    'horse_age' => 4,
                    'horse_country' => 'JPN',
                    'sire_uid' => 597695,
                    'sire_name' => 'Black Tide',
                    'trainer_uid' => 22558,
                    'trainer_name' => 'Hisashi Shimizu',
                    'best_rpr' => 119,
                    'best_or' => 117,
                    'current_or' => 117,
                    'wins' => 5,
                    'runs' => 7,
                    'winnings_pound' => 2700.00,
                    'earnings_pound' => 2700.00,
                    'winnings_euro' => 2900.00,
                    'earnings_euro' => 2900.00,
                    'stake' => 2.00,
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 851214,
                    'horse_name' => 'Vazirabad',
                    'horse_sex' => 'g',
                    'horse_age' => 4,
                    'horse_country' => 'FR',
                    'sire_uid' => 606745,
                    'sire_name' => 'Manduro',
                    'trainer_uid' => 1172,
                    'trainer_name' => 'A De Royer-Dupre',
                    'best_rpr' => 118,
                    'best_or' => 120,
                    'current_or' => 120,
                    'wins' => 5,
                    'runs' => 7,
                    'winnings_pound' => 9705.00,
                    'earnings_pound' => 9705.00,
                    'winnings_euro' => 9905.00,
                    'earnings_euro' => 9905.00,
                    'stake' => 1.00,
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 906042,
                    'horse_name' => 'Twinkle',
                    'horse_sex' => 'h',
                    'horse_age' => 5,
                    'horse_country' => 'JPN',
                    'sire_uid' => 476873,
                    'sire_name' => 'Stay Gold',
                    'trainer_uid' => 25726,
                    'trainer_name' => 'Kazuya Makita',
                    'best_rpr' => 118,
                    'best_or' => null,
                    'current_or' => null,
                    'wins' => 5,
                    'runs' => 7,
                    'winnings_pound' => 4500.00,
                    'earnings_pound' => 4500.00,
                    'winnings_euro' => 4800.00,
                    'earnings_euro' => 4800.00,
                    'stake' => 3.00,
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 846640,
                    'horse_name' => 'Big Orange',
                    'horse_age' => 5,
                    'horse_sex' => 'g',
                    'horse_country' => 'GB',
                    'sire_uid' => 659996,
                    'sire_name' => 'Duke Of Marmalade',
                    'trainer_uid' => 4113,
                    'trainer_name' => 'Michael Bell',
                    'best_rpr' => 117,
                    'best_or' => 116,
                    'current_or' => 114,
                    'wins' => 2,
                    'runs' => 7,
                    'winnings_pound' => 2700.00,
                    'earnings_pound' => 2700.00,
                    'winnings_euro' => 2900.00,
                    'earnings_euro' => 2900.00,
                    'stake' => -2.00,
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'horse_uid' => 874358,
                    'horse_name' => 'Cheval Grand',
                    'horse_sex' => 'C',
                    'horse_age' => 4,
                    'horse_country' => 'JPN',
                    'sire_uid' => 597689,
                    'sire_name' => 'Heart\'s Cry',
                    'trainer_uid' => 18299,
                    'trainer_name' => 'Yasuo Tomomichi',
                    'best_rpr' => 117,
                    'best_or' => null,
                    'current_or' => null,
                    'wins' => 5,
                    'runs' => 7,
                    'winnings_pound' => 4500.00,
                    'earnings_pound' => 4500.00,
                    'winnings_euro' => 4800.00,
                    'earnings_euro' => 4800.00,
                    'stake' => 3.00,
                ]
            ),
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    "horse_uid" => 1132517,
                    "horse_name" => "Waldgeist",
                    "horse_age" => 2,
                    "horse_sex" => "C",
                    "horse_country" => "GB",
                    "sire_uid" => 531769,
                    "sire_name" => "Galileo",
                    "trainer_uid" => 1093,
                    "trainer_name" => "A Fabre",
                    "best_rpr" => 113,
                    "best_or" => null,
                    "current_or" => null,
                    "wins" => 2,
                    "runs" => 3,
                    'winnings_pound' => 114963.24,
                    'earnings_pound' => 123786.76,
                    'winnings_euro' => null,
                    'earnings_euro' => null,
                    'stake' => 9.3,
                ]
            )
        ];
    }
}
