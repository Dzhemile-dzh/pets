<?php

namespace tests\lib\Api\Input\Request\Method;

use Api\Input\Request\Horses\Profile\Trainer\Horses as HorsesRequest;
use Api\Input\Request\Parameter\Validator\ChampionshipFlag;

/**
 * Class GetChampionshipTest
 * @package tests\lib\Api\Input\Request\Method
 */
class GetChampionshipTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param HorsesRequest $request
     * @param $expected
     *
     * @dataProvider providerGetChampionship
     */
    public function testGetChampionship(HorsesRequest $request, $expected)
    {
        $this->assertEquals($expected, $request->getChampionship());
    }

    /**
     * @return array
     */
    public function providerGetChampionship()
    {
        return [
            [
                new HorsesRequest(
                    [
                        '2017',
                        'GB',
                        'flat',
                        'aw',
                        ChampionshipFlag::FLAG
                    ],
                    [
                        HorsesRequest::ENTITY_ID => '1',
                    ]
                ),
                'trainer'
            ],
            [
                new HorsesRequest(
                    [],
                    [
                    HorsesRequest::ENTITY_ID => '1',
                    ]
                ),
                null
            ]
        ];
    }
}
