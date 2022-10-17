<?php

namespace Tests;

use Phalcon\Exception;

class SetTimestampTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Api\Row\RaceInstance $row
     * @param array                               $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testSetTimestamp(
        \Api\Row\RaceInstance $row,
        $expectedResult
    ) {

        $reflector = new \ReflectionClass(
            '\Api\Row\RaceInstance'
        );
        $method = $reflector->getMethod('setTimestamp');
        $method->setAccessible(true);
        $method->invoke($row);

        $this->assertEquals($expectedResult, $row);
    }

    /**
     * @param \Api\Row\RaceInstance $row
     * @param array                               $expectedResult
     *
     * @expectedException \Api\Exception\InternalServerError
     * @dataProvider badDataProvider
     */
    public function testFaultSetTimestamp(
        \Api\Row\RaceInstance $row,
        $expectedResult
    ) {

        $this->testSetTimestamp($row, $expectedResult);
    }

    /**
     * @return array
     */
    public function dataProvider()
    {

        return [
            [
                \Api\Row\RaceInstance::createFromArray(
                    ['race_datetime' => '27 Nov 2014 2:35PM']
                ),
                \Api\Row\RaceInstance::createFromArray(
                    [
                        'race_datetime' => '27 Nov 2014 2:35PM',
                        'timestamp' => strtotime('27 Nov 2014 2:35PM')
                    ]
                ),
            ],
            [
                \Api\Row\RaceInstance::createFromArray(
                    ['race_datetime' => '2014-11-27 14:35:00']
                ),
                \Api\Row\RaceInstance::createFromArray(
                    [
                        'race_datetime' => '2014-11-27 14:35:00',
                        'timestamp' => strtotime('2014-11-27 14:35:00')
                    ]
                ),
            ],
            [
                \Api\Row\RaceInstance::createFromArray(
                    [
                        'race_datetime' => '27 Nov 2014 2:35PM',
                        'timestamp' => 123
                    ]
                ),
                \Api\Row\RaceInstance::createFromArray(
                    [
                        'race_datetime' => '27 Nov 2014 2:35PM',
                        'timestamp' => 123
                    ]
                ),
            ],
        ];
    }

    /**
     * @return array
     */
    public function badDataProvider()
    {

        return [
            [
                \Api\Row\RaceInstance::createFromArray(
                    [
                        'race_instance_uid' => 123,
                        'race_datetime' => '27 Nodv 2014 2:35PM'
                    ]
                ),
                null
            ],
            [
                \Api\Row\RaceInstance::createFromArray(
                    [
                        'race_instance_uid' => 123,
                        'race_datetime' => ''
                    ]
                ),
                null
            ],
            [
                \Api\Row\RaceInstance::createFromArray(
                    [
                        'race_instance_uid' => 123,
                        'race_datetime' => null
                    ]
                ),
                null
            ],
        ];
    }
}
