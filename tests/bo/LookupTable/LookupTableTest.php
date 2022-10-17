<?php

namespace Tests\Bo\LookupTable;

use Api\Input\Request\Horses\LookupTable\RaceGroup as Request;
use Phalcon\Mvc\Model\Row\General;
use Tests\Stubs\Bo\LookupTable\RaceGroup as Bo;

/**
 * @package Tests\Bo\LookupTable
 */
class RaceGroup extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider providerTestGetData
     *
     * @param Request $request
     * @param array $expectedResult
     */
    public function testGetData(
        Request $request,
        array $expectedResult
    ) {
        $bo = new Bo($request);
        $this->assertEquals(
            $expectedResult,
            $bo->getData()
        );
    }

    /**
     * @return array
     */
    public function providerTestGetData()
    {
        return [
            [
                new Request([]),
                [
                    General::createFromArray(
                        [
                            'race_group_uid' => 0,
                            'race_group_code' => '0',
                            'race_group_desc' => 'Unknown',
                        ]
                    ),
                    General::createFromArray(
                        [
                            'race_group_uid' => 1,
                            'race_group_code' => '1',
                            'race_group_desc' => 'Group 1',
                        ]
                    ),
                ]
            ]
        ];
    }
}
