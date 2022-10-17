<?php
namespace Tests\Bo\StakesData;

use PHPUnit_Framework_TestCase;
use Tests\Stubs\Bo\StakesData\Jockey;

class JockeyTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider dataProviderTestGetData
     *
     * @param \Api\Input\Request\Horses\StakesData\Jockey $request
     * @param array                                       $expectedResult
     */
    public function testGetData(\Api\Input\Request\Horses\StakesData\Jockey $request, array $expectedResult)
    {
        $bo = new Jockey($request);
        $this->assertEquals($expectedResult, $bo->getData());
    }

    /**
     * @return array
     */
    public function dataProviderTestGetData()
    {
        return [
            [
                new \Api\Input\Request\Horses\StakesData\Jockey(
                    [],
                    [
                        'jockeyId' => 85994
                    ]
                ),
                [
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
                ]
            ]
        ];
    }

    /**
     * @dataProvider dataProviderTestGetCurrentSeason
     *
     * @param \Api\Input\Request\Horses\StakesData\Jockey $request
     * @param array                                       $expectedResult
     */
    public function testGetCurrentSeason(\Api\Input\Request\Horses\StakesData\Jockey $request, array $expectedResult)
    {
        $bo = new Jockey($request);
        $this->assertEquals($expectedResult, $bo->getCurrentSeason());
    }

    /**
     * @return array
     */
    public function dataProviderTestGetCurrentSeason()
    {
        return [
            [
                new \Api\Input\Request\Horses\StakesData\Jockey(
                    [],
                    [
                        'jockeyId' => 85994
                    ]
                ),
                [
                    'flat' => \Api\Row\StakesData\Jockey::createFromArray(
                        [
                            'race_type' => 'flat',
                            'wins' => 0,
                            'runs' => 1,
                            'stake' => '-1.00000000000000',
                        ]
                    ),
                    'jumps' => null,
                ]
            ]
        ];
    }
}
