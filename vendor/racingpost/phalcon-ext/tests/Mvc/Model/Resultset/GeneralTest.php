<?php

declare(strict_types=1);

namespace Tests\Mvc\Model\Resultset;

use Phalcon\Db\Result\Sybase;
use Phalcon\Mvc\Model\Resultset\General;
use Phalcon\Mvc\Model\Resultset\ResultsetException;
use Phalcon\Mvc\Model\Row;
use Phalcon\Mvc\Model\Row\General as RowGeneral;
use Pseudo\Pdo;
use Tests\CommonTestCase;

/**
 * @package Tests\Mvc\Model\Resultset
 */
class GeneralTest extends CommonTestCase
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
            $this->assertEquals($row->toArray(), $results[$i]);

            //check that current returns the same value
            $row = $resultset->current();
            $this->assertEquals($row->toArray(), $results[$i]);

            $i++;
            $resultset->next();
        }

        $this->assertEquals($resultset->count(), count($results));
    }

    /**
     * @param array $results
     * @param string $sql
     * @param array|null $columnMap
     *
     * @return General
     */
    private function createResultset(array $results, string $sql, ?array $columnMap = null)
    {
        $fakePdo = new Pdo();
        $fakePdo->mock($sql, $results);
        $statement = $fakePdo->query($sql);

        $result = new Sybase(null, $statement, $sql);
        return new General($columnMap, new Row(), $result);
    }

    /**
     * @dataProvider providerNotEmptyResult
     *
     * @param array $results
     * @param string $sql
     *
     * @internal param array $expected
     */
    public function testGetRows(array $results, string $sql)
    {
        $resultset = $this->createResultset($results, $sql);

        $last = (count($results)) ? count($results) - 1 : 0;

        $this->assertEquals($resultset->getLast()->toArray(), $results[$last]);
        $this->assertEquals($resultset->getFirst()->toArray(), $results[0]);
        $this->assertEquals($resultset->getLast()->toArray(), $results[$last]);
    }

    /**
     * @dataProvider providerEmptyResult
     *
     * @param array $results
     * @param string $sql
     *
     * @internal param array $expected
     */
    public function testGetRowsEmptyResult(array $results, string $sql)
    {
        $resultset = $this->createResultset($results, $sql);

        $this->assertEquals($resultset->getLast(), false);
        $this->assertEquals($resultset->getFirst(), false);
        $this->assertEquals($resultset->getLast(), false);
        $resultset->setIsFresh(true);
        $this->assertEquals($resultset->isFresh(), true);
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
        $this->assertEquals($resultset[1]->toArray(), $results[1]);
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
     * @expectedException
     * @internal param array $expected
     */
    public function testArrayAccessOffsetSet(array $results, string $sql)
    {
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
     * @expectedException
     * @internal param array $expected
     */
    public function testArrayAccessOffsetUnset(array $results, string $sql)
    {
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
     * @param array $results
     * @param string $sql
     *
     * @expectedException
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
            $map['id'] => $results[0]['id'],
            $map['name'] => $results[0]['name'],
        ];


        $this->assertEquals($resultset->current()->toArray(), $expected);
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
            $map['id'] => $results[0]['id'],
            $map['name'] => $results[0]['name'],
        ];

        $this->assertEquals($toArr[0], $expected);
    }

    /**
     * @dataProvider providerToArrayWithRows
     *
     * @param array $results
     * @param string $sql
     */
    public function testToArrayWithRows(array $results, string $sql, $expected, $flag)
    {
        $resultset = $this->createResultset($results, $sql);

        $toArr = $resultset->toArrayWithRows('name', new RowGeneral(), $flag);
        $this->assertEquals($expected, $toArr);
    }

    /**
     * @dataProvider providerEmptyResult
     *
     * @param array $results
     * @param string $sql
     *
     * @expectedException
     * @internal param array $expected
     */
    public function testSerializableEmpty(array $results, string $sql)
    {
        $resultset = $this->createResultset($results, $sql);
        $serialize = $resultset->serialize();
        $resultset->unserialize($serialize);

        $resultset->rewind();
        $this->assertEquals($resultset->current(), false);
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
                md5("SELECT * FROM test"),
            ],
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
    public function providerToArrayWithRows()
    {
        return [
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
                [],
                true,
            ],
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
                [],
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
                md5("SELECT * FROM test"),
            ],
        ];
    }
}
