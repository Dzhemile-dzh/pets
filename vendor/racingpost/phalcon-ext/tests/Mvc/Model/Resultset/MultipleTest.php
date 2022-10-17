<?php

declare(strict_types=1);

namespace Tests\Mvc\Model\Resultset;

use Phalcon\Db\Result\Sybase;
use Phalcon\Mvc\Model\Resultset\Multiple;
use Phalcon\Mvc\Model\Resultset\MultipleEntry;
use Phalcon\Mvc\Model\Resultset\ResultsetException;
use Phalcon\Mvc\Model\Row;
use Phalcon\Mvc\Model\Row\General as RowGeneral;
use Tests\CommonTestCase;
use Tests\Mvc\Model\Resultset\MultiplePdo;

/**
 * @package Tests\Mvc\Model\Resultset
 */
class MultipleTest extends CommonTestCase
{
    /**
     * @dataProvider providerBothTypesOfResult
     *
     * @param array $results
     * @param string $sql
     *
     * @internal param array $expected
     */
    public function testFetchAll(array $results, string $sql)
    {
        $resultset = $this->createResultset($results, $sql);

        $this->assertEquals($resultset->getType(), 0);

        $i = 0;
        while ($resultset->valid()) {
            $row = $resultset->current();
            $expected = (isset($results[$i])) ? $results[$i] : [];

            $this->assertEquals($expected, $row->toArray());
            $i++;
            $resultset->next();
        }

        $i = 0;
        foreach ($resultset as $row) {
            $expected = (isset($results[$i])) ? $results[$i] : [];
            $this->assertEquals($expected, $row->toArray());
            $i++;
        }

        $this->assertEquals(!count($results) ? 1: count($results), $resultset->count());
    }

    /**
     * @param array $results
     * @param string $sql
     * @param array|null $columnMap
     *
     * @return Multiple
     */
    private function createResultset(array $results, string $sql, ?array $columnMap = null)
    {
        $fakePdo = new MultiplePdo();
        $fakePdo->mock($sql, $results);
        $statement = $fakePdo->query($sql);

        $result = new Sybase(null, $statement, $sql);
        return new Multiple($result, new MultipleEntry(new Row(), $columnMap));
    }

    /**
     * @dataProvider providerNotEmptyResult
     *
     * @param array $results
     * @param string $sql
     *
     * @internal param array $expected
     * @throws ResultsetException
     */
    public function testGetRows(array $results, string $sql)
    {
        $resultset = $this->createResultset($results, $sql);

        $last = (count($results)) ? count($results) - 1 : 0;

        $this->assertEquals($results[$last], $resultset->getLast()->toArray());
        $this->assertEquals($results[0], $resultset->getFirst()->toArray());
        $this->assertEquals($results[$last], $resultset->getLast()->toArray());
    }

    /**
     * @dataProvider providerEmptyResult
     *
     * @param array $results
     * @param string $sql
     *
     * @throws ResultsetException
     * @internal param array $expected
     */
    public function testGetRowsEmptyResult(array $results, string $sql)
    {
        $resultset = $this->createResultset($results, $sql);

        $this->assertEquals($resultset->getLast()->toArray(), []);
        $this->assertEquals($resultset->getFirst()->toArray(), []);
        $this->assertEquals($resultset->getLast()->toArray(), []);
    }

    /**
     * @dataProvider providerNotEmptyResult
     *
     * @param array $results
     * @param string $sql
     *
     * @internal param array $expected
     */
    public function testArrayAccess(array $results, string $sql)
    {
        $resultset = $this->createResultset($results, $sql);
        $this->assertEquals($resultset[0]->toArray(), $results[0]);
    }

    /**
     * @dataProvider providerBothTypesOfResult
     *
     * @param array $results
     * @param string $sql
     *
     * @expectedException
     * @internal param array $expected
     */
    public function testArrayAccessIndexOfBound(array $results, string $sql)
    {
        $resultset = $this->createResultset($results, $sql);
        $this->expectException(ResultsetException::class);
        $resultset[5];
    }

    /**
     * @dataProvider providerBothTypesOfResult
     *
     * @param array $results
     * @param string $sql
     *
     * @throws \Exception
     * @expectedException
     * @internal param array $expected
     */
    public function testArrayAccessOffsetSet(array $results, string $sql)
    {
        $this->expectException(ResultsetException::class);

        $resultset = $this->createResultset($results, $sql);
        $this->expectException(ResultsetException::class);
        $resultset->offsetSet(1, 'asd');
    }

    /**
     * @dataProvider providerBothTypesOfResult
     *
     * @param array $results
     * @param string $sql
     *
     * @throws \Exception
     * @expectedException
     * @internal param array $expected
     */
    public function testArrayAccessOffsetUnset(array $results, string $sql)
    {
        $this->expectException(ResultsetException::class);

        $resultset = $this->createResultset($results, $sql);
        $this->expectException(ResultsetException::class);
        $resultset->offsetUnset(1);
    }

    /**
     * @dataProvider providerNotEmptyResult
     *
     * @param array $results
     * @param string $sql
     *
     * @expectedException
     * @internal param array $expected
     */
    public function testArrayAccessOffsetExists(array $results, string $sql)
    {
        $resultset = $this->createResultset($results, $sql);

        $this->assertEquals($resultset->offsetExists(0), true);
        $this->assertEquals($resultset->offsetExists(1), false);
        $this->assertEquals($resultset->count(), 1);

        $resultset->next();

        $this->assertEquals($resultset->offsetExists(1), true);
        $this->assertEquals($resultset->count(), 2);
        $this->assertEquals($resultset->key(), 1);
    }

    /**
     * @dataProvider providerNotEmptyResult
     *
     *
     * @param array $results
     * @param string $sql
     *
     * @throws ResultsetException
     * @internal param array $expected
     */
    public function testSerializableNotEmpty(array $results, string $sql)
    {
        $map = ['id' => 'ID', 'name' => 'NAME'];
        $resultset = $this->createResultset($results, $sql, $map);
        $serialize = $resultset->serialize();
        $resultset->unserialize($serialize);

        $resultset->rewind();

        $expected = [
            $map['id'] => $results[0][0]['id'],
            $map['name'] => $results[0][0]['name'],
        ];


        $this->assertEquals($resultset->current()->toArray()[0], $expected);
    }

    /**
     * @dataProvider providerNotEmptyResult
     *
     * @param array $results
     * @param string $sql
     *
     * @expectedException
     * @internal param array $expected
     */
    public function testJsonSerializable(array $results, string $sql)
    {
        $resultset = $this->createResultset($results, $sql);
        $this->assertEquals($resultset->jsonSerialize(), $results);
    }


    /**
     * @dataProvider providerNotEmptyResult
     *
     * @param array $results
     * @param string $sql
     *
     * @expectedException
     * @internal param array $expected
     */
    public function testToArrayWithMap(array $results, string $sql)
    {
        $map = ['id' => 'ID', 'name' => 'NAME'];
        $resultset = $this->createResultset($results, $sql, $map);

        $toArr = $resultset->toArray();

        $expected = [
            $map['id'] => $results[0][0]['id'],
            $map['name'] => $results[0][0]['name'],
        ];

        $this->assertEquals($toArr[0][0], $expected);
    }

    /**
     * @return array
     */
    public function providerEmptyResult()
    {
        return [
            [
                [
                ],
                md5("SELECT * FROM test WHERE not_found = 100"),
            ],
        ];
    }

    /**
     * @return array
     */
    public function providerBothTypesOfResult()
    {
        return [
            [
                [
                    [
                        [
                            'id' => 1,
                            'name' => 'asd',
                        ],
                        [
                            'id' => 2,
                            'name' => 'qwe',
                        ],
                        [
                            'id' => 3,
                            'name' => 'zxc',
                        ],
                        [
                            'id' => 4,
                            'name' => 'asd',
                        ],
                    ]
                ],
                md5("SELECT * FROM test"),
            ],
            [
                [
                    []
                ],
                md5("SELECT * FROM test WHERE not_found = 100"),
            ],
        ];
    }

    /**
     * @return array
     */
    public function providerToArrayWithRows()
    {
        return [
            [
                [
                    [
                        [
                            'id' => 1,
                            'name' => 'asd',
                        ],
                        [
                            'id' => 2,
                            'name' => 'qwe',
                        ],
                        [
                            'id' => 3,
                            'name' => 'zxc',
                        ],
                        [
                            'id' => 4,
                            'name' => 'asd',
                        ],
                    ],
                    [
                        [
                            'id' => 5,
                            'name' => 'asd',
                            'desc' => 'value',
                        ],
                        [
                            'id' => 6,
                            'name' => 'qwe',
                            'desc' => 'value',
                        ],
                    ]
                ],
                md5("SELECT * FROM test"),
                [
                    'asd' => [
                        RowGeneral::createFromArray([
                            'id' => 1,
                            'name' => 'asd',
                        ]),
                        RowGeneral::createFromArray([
                            'id' => 4,
                            'name' => 'asd',
                        ]),
                    ],
                    'qwe' => [
                        RowGeneral::createFromArray([
                            'id' => 2,
                            'name' => 'qwe',
                        ]),
                    ],
                    'zxc' => [
                        RowGeneral::createFromArray([
                            'id' => 3,
                            'name' => 'zxc',
                        ]),
                    ],
                ],
                true,
            ],
            [
                [
                ],
                md5("SELECT * FROM test WHERE not_found = 100"),
                [
                    []
                ],
                true,
            ],
            [
                [
                    [
                        [
                            'id' => 1,
                            'name' => 'asd',
                        ],
                        [
                            'id' => 2,
                            'name' => 'qwe',
                        ],
                        [
                            'id' => 3,
                            'name' => 'zxc',
                        ],
                        [
                            'id' => 4,
                            'name' => 'asd',
                        ],
                    ],
                    [
                        [
                            'id' => 5,
                            'name' => 'asd',
                            'desc' => 'value',
                        ],
                        [
                            'id' => 6,
                            'name' => 'qwe',
                            'desc' => 'value',
                        ],
                    ]
                ],
                md5("SELECT * FROM test"),
                [
                    'asd' =>
                        RowGeneral::createFromArray([
                            'id' => 4,
                            'name' => 'asd',
                        ]),
                    'qwe' =>
                        RowGeneral::createFromArray([
                            'id' => 2,
                            'name' => 'qwe',
                        ]),
                    'zxc' =>
                        RowGeneral::createFromArray([
                            'id' => 3,
                            'name' => 'zxc',
                        ]),
                ],
                false,
            ],
            [
                [
                ],
                md5("SELECT * FROM test WHERE not_found = 100"),
                [
                    []
                ],
                false,
            ],
        ];
    }

    /**
     * @return array
     */
    public function providerNotEmptyResult()
    {
        return [
            [
                [
                    [
                        [
                            'id' => 1,
                            'name' => 'asd',
                        ],
                        [
                            'id' => 2,
                            'name' => 'qwe',
                        ],
                        [
                            'id' => 3,
                            'name' => 'zxc',
                        ],
                    ],
                    [
                        [
                            'id' => 5,
                            'name' => 'asd',
                        ],
                        [
                            'id' => 6,
                            'name' => 'qwe',
                        ],
                        [
                            'id' => 7,
                            'name' => 'zxc',
                        ],
                    ]
                ],
                md5("SELECT * FROM test"),
            ],
        ];
    }
}
