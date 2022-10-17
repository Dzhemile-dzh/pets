<?php
namespace Tests\Stubs\DataProvider\Bo\StakesData;

class Jockey extends \Api\DataProvider\Bo\StakesData\Jockey
{
    /**
     * @param int    $jockeyUid
     * @param int    $courseUid
     * @param string $raceType
     *
     * @return array
     */
    public function getCurrentSeason($jockeyUid, $courseUid, $raceType)
    {
        return [
            'flat' => \Api\Row\StakesData\Jockey::createFromArray(
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

    /**
     * @param int    $jockeyUid
     * @param int    $courseUid
     * @param string $raceType
     *
     * @return array
     */
    public function getJockeyData($jockeyUid, $courseUid, $raceType)
    {
        return [
            'last_7_days' => \Api\Row\StakesData\Jockey::createFromArray(
                [
                    'section' => 'last_7_days',
                    'wins' => 0,
                    'runs' => 1,
                    'stake' => '-1.00000000000000',
                ]
            ),
            'last_14_days' => \Api\Row\StakesData\Jockey::createFromArray(
                [
                    'section' => 'last_14_days',
                    'wins' => 0,
                    'runs' => 1,
                    'stake' => '-1.00000000000000',
                ]
            ),
            'last_month' => \Api\Row\StakesData\Jockey::createFromArray(
                [
                    'section' => 'last_month',
                    'wins' => 0,
                    'runs' => 2,
                    'stake' => '-2.00000000000000',
                ]
            ),
            'last_3_months' => \Api\Row\StakesData\Jockey::createFromArray(
                [
                    'section' => 'last_3_months',
                    'wins' => 2,
                    'runs' => 6,
                    'stake' => '17.00000000000000',
                ]
            ),
            'last_6_months' => \Api\Row\StakesData\Jockey::createFromArray(
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
