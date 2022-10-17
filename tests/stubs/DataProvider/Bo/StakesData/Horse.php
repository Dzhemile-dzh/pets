<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 1/12/2017
 * Time: 6:48 PM
 */

namespace Tests\Stubs\DataProvider\Bo\StakesData;

class Horse extends \Api\DataProvider\Bo\StakesData\Horse
{
    public function getCurrentSeason($horseUid, $courseUid, $raceType)
    {
        return [
            'flat' => \Api\Row\StakesData\Horse::createFromArray(
                [
                    'race_type' => 'flat',
                    'wins' => 0,
                    'runs' => 1,
                    'stake' => '-1.00000000000000',
                ]
            ),
            'jumps' => null,
        ];
    }

    public function getHorseData($horseUid, $courseUid, $raceType)
    {
        return [
            'last_7_days' => \Api\Row\StakesData\Horse::createFromArray(
                [
                    'section' => 'last_7_days',
                    'wins' => 0,
                    'runs' => 1,
                    'stake' => '-1.00000000000000',
                ]
            ),
            'last_14_days' => \Api\Row\StakesData\Horse::createFromArray(
                [
                    'section' => 'last_14_days',
                    'wins' => 0,
                    'runs' => 1,
                    'stake' => '-1.00000000000000',
                ]
            ),
            'last_month' => \Api\Row\StakesData\Horse::createFromArray(
                [
                    'section' => 'last_month',
                    'wins' => 0,
                    'runs' => 2,
                    'stake' => '-2.00000000000000',
                ]
            ),
            'last_3_months' => \Api\Row\StakesData\Horse::createFromArray(
                [
                    'section' => 'last_3_months',
                    'wins' => 2,
                    'runs' => 6,
                    'stake' => '17.00000000000000',
                ]
            ),
            'last_6_months' => \Api\Row\StakesData\Horse::createFromArray(
                [
                    'section' => 'last_6_months',
                    'wins' => 3,
                    'runs' => 14,
                    'stake' => '13.00000000000000',
                ]
            ),
        ];
    }
}
