<?php

namespace Tests;

class Result extends \PHPUnit\Framework\TestCase
{
    /**
     *
     * @dataProvider dataProviderTestSetDataNotEmptyResult
     *
     * @doesNotPerformAssertions
     *
     * @param mixed $data
     */
    public function testSetDataNotEmptyResult($data)
    {
        $result = $this->getMockForAbstractClass('\Api\Result');

        $result->setData($data);
    }

    /**
     * @return array
     */
    public function dataProviderTestSetDataNotEmptyResult()
    {
        return[
            [(Object)['1' => false]],
            [(Object)['field' => [[[[[[[false]]]]]]]]],
            [(Object)['field' => false]],
            [(Object)['field' => 'value1']],
            [
                (Object)[
                    'field1' => null,
                    'field2' => (Object)[
                        'field21' => 0,
                    ]
                ]
            ],
            [
                (Object)[
                    'field1' => null,
                    'field2' => [
                        'field21' => [
                            'field211' => false
                        ],
                    ],
                    'field3' => [],
                ]
            ]
        ];
    }

    /**
     * @expectedException \Api\Exception\NotFound
     * @expectedExceptionMessage Data was not found
     *
     * @dataProvider dataProviderTestSetDataEmptyResultException
     *
     * @param mixed $data
     */
    public function testSetDataEmptyResultException($data)
    {
        $result = $this->getMockForAbstractClass('\Api\Result');

        $result->setData($data);
    }

    /**
     * @return array
     */
    public function dataProviderTestSetDataEmptyResultException()
    {
        return[
            [new \stdClass()],
            [
                (Object)[
                    'field1' => null,
                    'field2' => (Object)[
                        'field21' => null,
                    ]
                ]
            ],
            [
                (Object)[
                    'field1' => null,
                    'field2' => [
                        'field21' => [
                            'field211' => null
                        ],
                    ],
                    'field3' => [],
                ]
            ]
        ];
    }

    /**
     *
     * @expectedException \Exception
     * @expectedExceptionMessage Exception: EmptyResultException
     */
    public function testSetEmptyResultException()
    {
        $result = $this->getMockForAbstractClass('\Api\Result');

        $result
            ->setEmptyResultException(new \Exception('Exception: EmptyResultException'))
            ->setData((Object)[]);
    }
}
