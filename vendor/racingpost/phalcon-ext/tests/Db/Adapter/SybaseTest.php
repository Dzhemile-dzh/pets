<?php

namespace Tests\Db\Adapter;

class SybaseTest extends \Tests\CommonTestCase
{

    /**
     * Call protected/private method of a \Phalcon\Db\Adapter\Sybase class.
     *
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    public function invokeDbAdapterMethod($methodName = '', array $parameters = [])
    {
        $object = $this->getMock('\Phalcon\Db\Adapter\Sybase', null, [], '', false);
        $reflection = new \ReflectionClass('\Phalcon\Db\Adapter\Sybase');
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    /**
     * @expectedException \Exception
     */
    public function testConnectCannotConnect()
    {
        $descriptor = [
            'username' => 'gggg',
            'password' => 'gggg',
            'servername' => 'gggg;aaaa;zzzz',
            'dbname' => 'gggg',
        ];

        new \Phalcon\Db\Adapter\Sybase($descriptor);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Empty connection parameters
     *
     */
    public function testConnectEmptyConnectionParameters()
    {
        new \Phalcon\Db\Adapter\Sybase([]);
    }

    /**
     * @param mixed $identifier
     * @param mixed $identifierExpected
     *
     * @dataProvider providerTestEscapeIdentifier
     */
    public function testEscapeIdentifier($identifier, $identifierExpected)
    {
        $adapter = $this->getMock('\Phalcon\Db\Adapter\Sybase', null, [], '', false);

        $this->assertEquals(
            $identifierExpected,
            $adapter->escapeIdentifier($identifier)
        );
    }

    /**
     * @return array
     */
    public function providerTestEscapeIdentifier()
    {
        return [
            ['table', 'table'],
            ['1', '1'],
            [5, 5],
        ];
    }

    /**
     * @param string $str
     * @param string $strExpected
     *
     * @dataProvider providerTestEscapeString
     */
    public function testEscapeString($str, $strExpected)
    {
        $adapter = $this->getMock('\Phalcon\Db\Adapter\Sybase', null, [], '', false);

        $this->assertEquals(
            $strExpected,
            $adapter->escapeString($str)
        );
    }

    /**
     * @return array
     */
    public function providerTestEscapeString()
    {
        return [
            [
                "'",
                "U&'\\0027\\0027'"
            ],
            [
                "\\\\",
                "U&'\\005c\\005c'"
            ],
            [
                "\/",
                "U&'\\005c\\002f'"
            ],
            [
                "\b",
                "U&'\\0008'"
            ],
            [
                '\t',
                "U&'\\0009'"
            ],
            [
                '\n',
                "U&'\\000a'"
            ],
            [
                '\f',
                "U&'\\000c'"
            ],
            [
                '\r',
                "U&'\\000d'"
            ],
            [
                '"ffff"',
                "U&'\\0022ffff\\0022'"
            ],
            [
                '\005cu',
                "U&'\\005c005cu'"
            ]
        ];
    }

    /**
     * @expectedException \Phalcon\Db\Exception
     * @expectedExceptionMessage Incorrect parameter:
     */
    public function testEscapeStringException()
    {
        $adapter = $this->getMock('\Phalcon\Db\Adapter\Sybase', null, [], '', false);

        $adapter->escapeString(chr(163));
    }


    /**
     * @param string     $sqlStatementExpected
     * @param string     $sqlStatement
     * @param array|null $bindParams
     * @param array|null $bindTypes
     *
     * @dataProvider providerTestGetEmulatedBindQuery
     */
    public function testGetEmulatedBindQuery($sqlStatementExpected, $sqlStatement, $bindParams, $bindTypes)
    {
        $this->assertEquals(
            $sqlStatementExpected,
            $this->invokeDbAdapterMethod('getEmulatedBindQuery', [$sqlStatement, $bindParams, $bindTypes])
        );
    }

    /**
     * @return array
     */
    public function providerTestGetEmulatedBindQuery()
    {
        return [
            [
                'SELECT * FROM table',
                'SELECT * FROM table',
                null,
                null
            ],
            [
                "SELECT * FROM table
                 WHERE
                    field1 = U&'val1'
                    AND field2 = U&'val2'
                    AND field3 = 1
                    AND field4 = 1
                    AND field5 = U&'val5'
                    AND field6 = U&'val6'
                    AND field7 = 1
                    AND field8 = 1.2
                    AND field9 = 1
                    AND field10 = NULL",
                "SELECT * FROM table
                 WHERE
                    field1 = :val1:
                    AND field2 = :val2:
                    AND field3 = :val3:
                    AND field4 = ?
                    AND field5 = ?
                    AND field6 = ?
                    AND field7 = ?
                    AND field8 = ?
                    AND field9 = ?
                    AND field10 = ?",
                [
                    'val1' => 'val1',
                    'val2' => 'val2',
                    'val3' => 1,
                    1,
                    'val5',
                    3 => 'val6',
                    4 => '1',
                    5 => '1.2',
                    6 => true,
                    7 => null,
                ],
                null
            ],
            [
                "SELECT * FROM table WHERE field1 IN (1, 2, 3, 4, 5)",
                "SELECT * FROM table WHERE field1 IN (:val1:)",
                ['val1' => [1, 2, 3, 4, 5]],
                null
            ],
            [
                "SELECT * FROM table WHERE field1 IN (U&'1', U&'2')",
                "SELECT * FROM table WHERE field1 IN (?)",
                [[1, 2]],
                [\Phalcon\Db\Column::BIND_PARAM_STR]
            ],
            [
                "SELECT * FROM table WHERE field1 IN (1, 2)",
                "SELECT * FROM table WHERE field1 IN (:val1:)",
                ['val1' => ['1', '2']],
                ['val1' => \Phalcon\Db\Column::BIND_SKIP]
            ],
            [
                "SELECT * FROM table WHERE field2 = U&'1' AND field3 = 1 AND field4 = 1.1 AND field5 = 0 AND field6 = NULL AND field7 = 0x000056",
                "SELECT * FROM table WHERE field2 = :val2: AND field3 = :val3: AND field4 = :val4: AND field5 = :val5: AND field6 = :val6: AND field7 = :val7:",
                [
                    'val2' => 1,
                    'val3' => '1',
                    'val4' => '1.1',
                    'val5' => false,
                    'val6' => '1',
                    'val7' => '0x000056'
                ],
                [
                    'val2' => \Phalcon\Db\Column::BIND_PARAM_STR,
                    'val3' => \Phalcon\Db\Column::BIND_PARAM_INT,
                    'val4' => \Phalcon\Db\Column::BIND_PARAM_DECIMAL,
                    'val5' => \Phalcon\Db\Column::BIND_PARAM_BOOL,
                    'val6' => \Phalcon\Db\Column::BIND_PARAM_NULL,
                    'val7' => \Phalcon\Db\Column::BIND_SKIP
                ]
            ],
        ];
    }

    /**
     * @param string     $sqlStatement
     * @param array|null $bindParams
     * @param array|null $bindTypes
     *
     * @dataProvider providerTestGetEmulatedBindQueryException
     */
    public function testGetEmulatedBindQueryException($sqlStatement, $bindParams, $bindTypes)
    {
        $this->setExpectedException('Phalcon\Db\Exception');
        $this->invokeDbAdapterMethod('getEmulatedBindQuery', [$sqlStatement, $bindParams, $bindTypes]);
    }

    /**
     * @return array
     */
    public function providerTestGetEmulatedBindQueryException()
    {
        return [
            [
                "SELECT * FROM table WHERE field1 IN (:val1:)",
                ['val1' => [1, 2, 3, 4, 5]],
                ['val1' => 1025]
            ],
            [
                "SELECT * FROM table WHERE field1 IN (:val1:)",
                ['val1' => new \stdClass()],
                null
            ],
            [
                "SELECT * FROM table WHERE field1 IN (:val1:)",
                ['val2' => 1],
                null
            ],
            [
                "SELECT * FROM table WHERE field1 = 1",
                [1],
                null
            ],
        ];
    }
}
