<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 2/3/15
 * Time: 3:14 PM
 */

namespace Tests\Output;

use Phalcon\Http\ResponseInterface;
use Phalcon\Output\Result;

class ResultTest extends \Tests\CommonTestCase
{
    /**
     * @return Result
     */
    protected function getResultImpl()
    {
        return new class () extends Result
        {
            public $mappers = [];

            /**
             * Children should implement this method to provide content to Response. Headers can be set here
             *
             * @param ResponseInterface $response
             */
            public function proceedResponse(ResponseInterface $response): void
            {
            }

            /**
             * Provides content
             * @return string
             */
            public function getContent(): string
            {
                $result = new \stdClass();
                //Filter only data to reduce load. All other is generated by application and should be valid.
                if (!is_null($this->data)) {
                    $result->data = $this->getPreparedData();
                }
                if (!is_null($this->errors)) {
                    $result->errors = $this->isAssociativeData($this->errors) ? (Object)$this->errors : $this->errors;
                }
                $result->status = $this->status;

                $resultJson = json_encode($result);

                if ($resultJson === false) {
                    throw new \Exception('Json encoding error in result. Error(' . json_last_error() . '): ' . json_last_error_msg());
                }

                return $resultJson;
            }

            /**
             * @param array $data
             *
             * @return bool
             */
            private function isAssociativeData(array $data)
            {
                return !(empty($data) || (array_keys($data) === range(0, count($data) - 1)));
            }

            /**
             * @return array
             */
            public function getMappers(): array
            {
                return $this->mappers;
            }
        };
    }


    /**
     * @dataProvider dataProviderTestSetErrors
     *
     * @param array $errors
     * @param string $expectedResult
     *
     * @throws \ReflectionException
     */
    public function testSetErrors(array $errors, $expectedResult)
    {
        $resultImpl = $this->getResultImpl();

        $reflector = new \ReflectionClass($resultImpl);
        $propertyErrors = $reflector->getProperty('errors');
        $propertyErrors->setAccessible(true);

        $this->assertEquals(null, $propertyErrors->getValue($resultImpl));
        $this->assertJsonStringEqualsJsonString('{"status":200}', $resultImpl->getContent());

        $resultImpl->setErrors($errors);

        $this->assertEquals($errors, $propertyErrors->getValue($resultImpl));
        $this->assertJsonStringEqualsJsonString($expectedResult, $resultImpl->getContent());
    }

    /**
     * @return array
     */
    public function dataProviderTestSetErrors()
    {
        return [
            [
                [
                    1 => 'ERROR 1',
                    2 => 'ERROR 2',
                    3 => 'ERROR 3',
                ],
                '{"errors":{"1":"ERROR 1","2":"ERROR 2","3":"ERROR 3"},"status":200}',
            ],
            [
                [
                    1001 => 'ERROR 1001',
                    1002 => 'ERROR 1002',
                    1003 => 'ERROR 1003',
                ],
                '{"errors":{"1001":"ERROR 1001","1002":"ERROR 1002","1003":"ERROR 1003"},"status":200}',
            ],
            [
                [
                    0 => 'ERROR 1111',
                    'ERROR 2222',
                    'ERROR 3333',
                ],
                '{"errors":["ERROR 1111","ERROR 2222","ERROR 3333"],"status":200}',
            ],
            [
                [
                    [
                        'code' => 123,
                        'message' => 'error message 123',
                        'extra' => null,
                    ],
                    [
                        'code' => 456,
                        'message' => 'error message 456',
                        'extra' => [
                            'id' => 789,
                        ],
                    ],
                ],
                '{"errors":[{"code":123,"message":"error message 123", "extra":null},
                {"code":456,"message":"error message 456", "extra":{"id":789}}],"status":200}',
            ],
        ];
    }

    /**
     * @throws \Exception
     */
    public function testSetData()
    {
        $data = (Object)[
            'field1' => 'value1',
            'field2' => 'value2',
        ];

        $result = $this->getResultImpl();

        $reflector = new \ReflectionClass($result);
        $propertyData = $reflector->getProperty('data');
        $propertyData->setAccessible(true);

        $this->assertEquals(null, $propertyData->getValue($result));
        $this->assertJsonStringEqualsJsonString('{"status":200}', $result->getContent());

        $result->setData($data);

        $this->assertEquals($data, $propertyData->getValue($result));
        $this->assertJsonStringEqualsJsonString(
            '{"data":{"field1":"value1","field2":"value2"},"status":200}',
            $result->getContent()
        );
    }

    /**
     * @throws \Exception
     */
    public function testSetStatus()
    {
        $status = 500;

        $result = $this->getResultImpl();

        $reflector = new \ReflectionClass($result);
        $propertyStatus = $reflector->getProperty('status');
        $propertyStatus->setAccessible(true);

        $this->assertEquals(200, $propertyStatus->getValue($result));
        $this->assertJsonStringEqualsJsonString('{"status":200}', $result->getContent());

        $result->setStatus($status);

        $this->assertEquals($status, $propertyStatus->getValue($result));
        $this->assertJsonStringEqualsJsonString('{"status":500}', $result->getContent());
    }

    public function testGetStatus()
    {
        $result = $this->getResultImpl();

        $this->assertEquals(200, $result->getStatus());

        $status = 201;
        $result->setStatus($status);
        $this->assertEquals($status, $result->getStatus());
    }

    /**
     * @throws \Exception
     */
    public function testGeneral()
    {
        $result = $this->getResultImpl();

        $result->setErrors(
            [
                '1' => 'ERROR 1',
                '2' => 'ERROR 2',
            ]
        )
            ->setData(
                (Object)[
                    'field1' => 'value1',
                ]
            )
            ->setStatus(500);

        $this->assertJsonStringEqualsJsonString(
            '{"data":{"field1":"value1"},"errors":{"1":"ERROR 1","2":"ERROR 2"},"status":500}',
            $result->getContent()
        );
    }

    /**
     * @throws \Exception
     */
    public function testFilterNonUtfSymbols()
    {
        $result = $this->getResultImpl();

        $result->setData(
            (Object)[
                'field1' => 'value1|' . "\x00" . '|' . chr(163),
                'field2' => new \ArrayIterator(
                    [
                        'field21' => 'value1|' . "\x00" . '|' . chr(128),
                        'field22' => '',
                    ]
                ),
            ]
        );

        $this->assertJsonStringEqualsJsonString(
            '{"data":{"field1":"value1||\u00a3","field2":{"field21":"value1||\u0080","field22":""}},"status":200}',
            $result->getContent()
        );
    }

    /**
     * @return void
     */
    public function testFieldMappers()
    {
        $data = (Object)[
            'field1' => 'value1',
            'field2' => null,
            'field3' => (Object)[
                'field1' => 'value1',
                'field2' => [
                    (Object)[
                        'field1' => 'value11',
                    ],
                    (Object)[
                        'field1' => 'value12',
                    ],
                ],
            ],
        ];

        $dataExpected = (Object)[
            'mapped_field1' => 'value1',
            'mapped_field2' => null,
            'mapped_field3' => (Object)[
                'mapped_field1' => 'value1',
                'mapped_field2' => [
                    (Object)[
                        'mapped_field1' => 'value11',
                    ],
                    (Object)[
                        'mapped_field1' => 'value12',
                    ],
                ],
            ],
        ];

        $result = $this->getResultImpl();
        $result->mappers = [
            '' => '\Tests\Output\ResultTest\Mapper1',
            'mapped_field2' => '\Tests\Output\ResultTest\Mapper2',
            'mapped_field3' => '\Tests\Output\ResultTest\Mapper2',
            'mapped_field3.mapped_field2' => '\Tests\Output\ResultTest\Mapper3',
        ];

        $result->setData($data);

        $this->assertEquals($dataExpected, json_decode($result->getContent())->data);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Can't map field '
     *
     * @dataProvider             providerTestFieldMappersCantMapFieldException
     *
     * @param array $mappers
     * @param \stdClass $data
     */
    public function testFieldMappersCantMapFieldException(array $mappers, \stdClass $data)
    {
        $result = $this->getResultImpl();
        $result->mappers = $mappers;

        $result->setData($data);
        $result->getContent();
    }

    /**
     * @return array
     */
    public function providerTestFieldMappersCantMapFieldException()
    {
        return [
            [
                [
                    'field1' => '\Tests\Output\ResultTest\Mapper1',
                ],
                (Object)[
                    'field1' => 'value1',
                ],
            ],
            [
                [
                    'field1.field2' => '\Tests\Output\ResultTest\Mapper1',
                ],
                (Object)[
                    'field1' => 'value1',
                ],
            ],
        ];
    }
}
