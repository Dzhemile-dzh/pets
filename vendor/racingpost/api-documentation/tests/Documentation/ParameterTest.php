<?php

namespace Tests\Documentation;

use RP\Documentation\Parameter;

class ParameterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerCreateFromArray
     * @param $params
     * @param $expected
     */
    public function testCreateFromArray($params, $expected)
    {
        $p = Parameter::createFromArray($params);

        $this->assertEquals($expected, $p->asArrayOfStrings());
    }

    /**
     * @expectedException \Exception
     */
    public function testNotExistsParam()
    {
        $p = Parameter::createFromArray([
            'displayName' => 'test',
            'required' => true,
            'NonExistsParam' => 12
        ]);
    }

    /**
     * @dataProvider providerReturn
     * @param $paramsForCreation
     * @param $paramsForOutput
     * @param $expected
     */
    public function testReturn($paramsForCreation, $paramsForOutput, $expected)
    {
        $p = Parameter::createFromArray($paramsForCreation);

        $this->assertEquals($expected, $p->asArray($paramsForOutput));
    }

    public function providerCreateFromArray()
    {
        return [
            [
                [
                    'displayName' => 'test',
                    'required' => true,
                    'example' => null
                ],
                [
                    'displayName' => 'test',
                    'required' => 'true',
                ]
            ]
        ];
    }

    public function providerReturn()
    {
        return [
            [
                [
                    'displayName' => 'test',
                    'required' => true,
                    'example' => 'asd'
                ],
                [],
                [
                    'displayName' => 'test',
                    'required' => true,
                    'example' => 'asd'
                ]
            ],
            [
                [
                    'displayName' => 'test',
                    'required' => true,
                    'example' => 'asd'
                ],
                [
                    'example' => null,
                    'displayName' => 'name'
                ],
                [
                    'name' => 'test',
                    'required' => true,
                ]
            ]
        ];
    }
}
