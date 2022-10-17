<?php

namespace Tests\Bo;

use Phalcon\Exception;

class ProfileTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @param \Api\Input\Request\HorsesRequest $request
     * @param array                             $expectedResult
     *
     * @dataProvider providerTestGetSeasonInfo
     */
    public function testGetSeasonInfo(
        $request,
        array $expectedResult
    ) {
        $bo = new \Tests\Stubs\Bo\Profile($request);

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($bo->getSeasonInfo())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetSeasonInfo()
    {
        return [
            [
                new \Api\Input\Request\Horses\Profile\Trainer\Index(
                    [],
                    [
                        'trainerId' => 4336
                    ]
                ),
                [
                    'seasonYearBegin' => 2015,
                    'seasonYearEnd' => 2015,
                    'raceType' => 'flat',
                    'countryCode' => 'GB',
                    'statisticsType' => 'course'
                ]
            ],
        ];
    }
}
