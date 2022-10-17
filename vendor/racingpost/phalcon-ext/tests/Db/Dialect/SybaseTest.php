<?php

namespace Tests\Db\Dialect;

use Phalcon\Db\Column as Column;
use Phalcon\Db\Index as Index;
use Phalcon\Db\Reference as Reference;

class SybaseTest extends \Tests\CommonTestCase
{
    private function getColumns()
    {
        return array(
            'column1' => new Column(
                "column1",
                array(
                    'type' => Column::TYPE_VARCHAR,
                    'size' => 10
                )
            ),
            'column2' => new Column(
                "column2",
                array(
                    'type' => Column::TYPE_INTEGER,
                    'size' => 18,
                    'unsigned' => true,
                    'notNull' => false
                )
            ),
            'column3' => new Column(
                "column3",
                array(
                    'type' => Column::TYPE_DECIMAL,
                    'size' => 10,
                    'scale' => 2,
                    'unsigned' => false,
                    'notNull' => true
                )
            ),
            'column4' => new Column(
                "column4",
                array(
                    'type' => Column::TYPE_CHAR,
                    'size' => 100,
                    'notNull' => true
                )
            ),
            'column5' => new Column(
                "column5",
                array(
                    'type' => Column::TYPE_DATE,
                    'notNull' => true
                )
            ),
            'column6' => new Column(
                "column6",
                array(
                    'type' => Column::TYPE_DATETIME,
                    'notNull' => true
                )
            ),
            'column7' => new Column(
                "column7",
                array(
                    'type' => Column::TYPE_TEXT,
                    'notNull' => true
                )
            ),
            'column8' => new Column(
                "column8",
                array(
                    'type' => Column::TYPE_FLOAT,
                    'size' => 10,
                    'scale' => 2,
                    'unsigned' => false,
                    'notNull' => true
                )
            )
        );
    }

    public function testSavepoints()
    {
        $dialect = new \Phalcon\Db\Dialect\Sybase();

        $this->assertEquals(
            $dialect->createSavepoint('PHALCON_SAVEPOINT_1'),
            'save tran PHALCON_SAVEPOINT_1'
        );
//		$this->assertEquals($dialect->releaseSavepoint('PHALCON_SAVEPOINT_1'), 'RELEASE SAVEPOINT PHALCON_SAVEPOINT_1');
        $this->assertEquals(
            $dialect->rollbackSavepoint('PHALCON_SAVEPOINT_1'),
            'rollback tran PHALCON_SAVEPOINT_1'
        );
        $this->assertTrue($dialect->supportsSavepoints());
        $this->assertTrue($dialect->supportsReleaseSavepoints());

    }

    public function testColumns()
    {

        $dialect = new \Phalcon\Db\Dialect\Sybase();

        $columns = $dialect->getColumnList(
            array('column1', 'column2', 'column3')
        );
        $this->assertEquals($columns, "column1, column2, column3");

        $columns = $this->getColumns();

        //Column definitions
        $this->assertEquals(
            $dialect->getColumnDefinition($columns['column1']),
            'VARCHAR(10)'
        );
        $this->assertEquals(
            $dialect->getColumnDefinition($columns['column2']),
            'UNSIGNED INT'
        );
        $this->assertEquals(
            $dialect->getColumnDefinition($columns['column3']),
            'DECIMAL(10,2)'
        );
        $this->assertEquals(
            $dialect->getColumnDefinition($columns['column4']),
            'CHAR(100)'
        );
        $this->assertEquals(
            $dialect->getColumnDefinition($columns['column5']),
            'DATE'
        );
        $this->assertEquals(
            $dialect->getColumnDefinition($columns['column6']),
            'DATETIME'
        );
        $this->assertEquals(
            $dialect->getColumnDefinition($columns['column7']),
            'TEXT'
        );
        $this->assertEquals(
            $dialect->getColumnDefinition($columns['column8']),
            'FLOAT(10)'
        );

    }

    public function testLimit()
    {
        $dialect = new \Phalcon\Db\Dialect\Sybase();
        $num = 10;
        $sql = 'select something from sometable';
        $sqlLimited = 'select top 10 something from sometable';
        $this->assertEquals($dialect->limit($sql, $num), $sqlLimited);
    }


    /**
     * @param string $expectedSql
     * @param array  $definition
     *
     * @dataProvider providerTestSelect
     */
    public function testSelect($expectedSql, array $definition)
    {
        $dialect = new \Phalcon\Db\Dialect\Sybase();
        $this->assertEquals($expectedSql, $dialect->select($definition));
    }

    /**
     * @return array
     */
    public function providerTestSelect()
    {
        return [
            [
                "SELECT sometable.something AS something, sometable.something2 AS something2 FROM sometable",
                [
                    'tables' => ['sometable'],
                    'columns' => [
                        ['something', 'sometable', 'something'],
                        [
                            [
                                'type' => 'literal',
                                'value' => 'something2'
                            ],
                            'sometable',
                            'something2'
                        ]
                    ]
                ]
            ],
            [
                "SELECT something FROM sometable",
                [
                    'tables' => 'sometable',
                    'columns' => 'something'
                ]
            ],
            [
                "SELECT * FROM sometable",
                [
                    'tables' => ['sometable'],
                    'columns' => [['*']]
                ]
            ],
            [
                "SELECT sometable.something FROM sometable",
                [
                    'tables' => ['sometable'],
                    'columns' => [['something', 'sometable', false]]
                ]
            ],
            [
                "SELECT something FROM sometable",
                [
                    'tables' => ['sometable'],
                    'columns' => [['something', false, false]]
                ]
            ],
            [
                "SELECT something FROM sometable LEFT JOIN sometable2 ON something = something2 ",
                [
                    'tables' => ['sometable'],
                    'columns' => [['something', false, false]],
                    'joins' => [
                        [
                            'source' => 'sometable2',
                            'type' => 'LEFT',
                            'conditions' => [
                                [
                                    'type' => 'literal',
                                    'value' => 'something = something2'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            [
                "SELECT something FROM sometable WHERE something = 1",
                [
                    'tables' => ['sometable'],
                    'columns' => [['something', false, false]],
                    'where' => 'something = 1'
                ]
            ],
            [
                "SELECT something FROM sometable WHERE something2 = 2",
                [
                    'tables' => ['sometable'],
                    'columns' => [['something', false, false]],
                    'where' => [
                        'type' => 'literal',
                        'value' => 'something2 = 2'
                    ]
                ]
            ],
            [
                "SELECT top 10 something FROM sometable",
                [
                    'tables' => ['sometable'],
                    'columns' => [['something', false, false]],
                    'limit' => 10
                ]
            ],
            [
                "SELECT top 10 something FROM sometable",
                [
                    'tables' => ['sometable'],
                    'columns' => [['something', false, false]],
                    'limit' => ['number' => ['value' => 10]]
                ]
            ],
            [
                "SELECT * FROM sometable GROUP BY something2, something3 HAVING something2 > 1",
                [
                    'tables' => ['sometable'],
                    'columns' => '*',
                    'group' => [
                        [
                            'type' => 'literal',
                            'value' => 'something2'
                        ],
                        [
                            'type' => 'literal',
                            'value' => 'something3'
                        ]
                    ],
                    'having' => [
                        'type' => 'literal',
                        'value' => 'something2 > 1'
                    ]
                ]
            ],
            [
                "SELECT * FROM sometable ORDER BY something2 DESC, something3",
                [
                    'tables' => ['sometable'],
                    'columns' => '*',
                    'order' => [
                        [
                            [
                                'type' => 'literal',
                                'value' => 'something2'
                            ],
                            'DESC'
                        ],
                        [
                            [
                                'type' => 'literal',
                                'value' => 'something3'
                            ]
                        ]
                    ]
                ]
            ],
        ];
    }
}
