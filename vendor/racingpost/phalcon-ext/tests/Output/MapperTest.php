<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 2/3/15
 * Time: 3:14 PM
 */

namespace Tests\Output;

require_once "MapperMock.php";

class MapperTest extends \Tests\CommonTestCase
{
    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Parameter $row must be object
     *
     */
    public function testConstructorParamObjMapFromException()
    {
        new \Tests\Output\MapperMock(1, []);
    }

    /**
     *
     */
    public function testMapField()
    {
        $objToMap = new \stdClass();
        $objToMap->field1 = 'value1';
        $objToMap->field2 = 'value2';
        $objToMap->field3 = 'value3';
        $objToMap->field4 = 'value4';

        $mapper = new \Tests\Output\MapperMock(
            $objToMap,
            [
                'field1' => 'mappedField1',
                'field2' => 'mappedField2',
            ]
        );

        $this->assertEquals(
            [
                'mappedField1' => 'value1',
                'mappedField2' => 'value2',
            ],
            get_object_vars($mapper)
        );
    }

    /**
     *
     */
    public function testMapMethod()
    {
        $objToMap = $this->getMock('\stdClass', ['getMappedField1', 'getMappedField2']);
        $objToMap->expects($this->once())
            ->method('getMappedField1')
            ->will($this->returnValue('value1'));
        $objToMap->expects($this->once())
            ->method('getMappedField2')
            ->will($this->returnValue('value2'));

        $mapper = new \Tests\Output\MapperMock(
            $objToMap,
            [
                '(getMappedField1)' => 'mappedField1',
                '(getMappedField2)' => 'mappedField2',
            ]
        );

        $this->assertEquals(
            [
                'mappedField1' => 'value1',
                'mappedField2' => 'value2',
            ],
            get_object_vars($mapper)
        );
    }

    /**
     *
     */
    public function testMapHierarchy()
    {
        $objToMap = new \stdClass();
        $objToMap->field111 = 'value111';
        $objToMap->field112 = 'value112';
        $objToMap->field121 = 'value121';
        $objToMap->field122 = 'value122';
        $objToMap->field222 = 'value222';

        $mapper = new \Tests\Output\MapperMock(
            $objToMap,
            [
                'field111' => 'field1.field1.field1',
                'field112' => 'field1.field1.field2',
                'field121' => 'field1.field2.field1',
                'field122' => 'field1.field2.field2',
                'field222' => 'field2.field2.field2',
            ]
        );

        $this->assertEquals(
            [
                'field1' => (Object)[
                    'field1' => (Object)[
                        'field1' => 'value111',
                        'field2' => 'value112',
                    ],
                    'field2' => (Object)[
                        'field1' => 'value121',
                        'field2' => 'value122',
                    ]

                ],
                'field2' => (Object)[
                    'field2' => (Object)[
                        'field2' => 'value222',
                    ],
                ],
            ],
            get_object_vars($mapper)
        );
    }

    /**
     *
     */
    public function testFieldProcessors()
    {
        $objToMap = $this->getMock('\stdClass', ['getField23']);
        $objToMap->expects($this->once())
            ->method('getField23')
            ->will($this->returnValue('10'));

        $objToMap->field1 = '0.005';
        $objToMap->field2 = '123';
        $objToMap->field3 = 'asdasd';

        $objToMap->field4 = 'field4';
        $objToMap->field5 = ' ';
        $objToMap->field6 = " \n";
        $objToMap->field7 = null;
        $objToMap->field8 = 23;
        $objToMap->field9 = [];

        $objToMap->field10 = 0.1;
        $objToMap->field11 = -0.1;
        $objToMap->field12 = '-1';
        $objToMap->field13 = 1;
        $objToMap->field14 = [];
        $objToMap->field15 = '-1KH';

        $objToMap->field16 = '-1KH';
        $objToMap->field17 = '-1';
        $objToMap->field18 = '1';
        $objToMap->field19 = '0.1';
        $objToMap->field20 = 0.1;
        $objToMap->field21 = 23;
        $objToMap->field22 = '23';

        $objToMap->field24 = 'Y';
        $objToMap->field25 = 'N';
        $objToMap->field26 = null;
        $objToMap->field27 = 'Y1';
        $objToMap->field28 = true;
        $objToMap->field29 = false;
        $objToMap->field30 = 0;
        $objToMap->field31 = '1';
        $objToMap->field32 = 'AsDfGhJ';
        $objToMap->field33 = '';
        $objToMap->field34 = ' ';
        $objToMap->field35 = 'okay';

        $mapper = new \Tests\Output\MapperMock(
            $objToMap,
            [
                '(stringToFloat)field1' => 'field1',
                '(stringToFloat)field2' => 'field2',
                '(stringToFloat)field3' => 'field3',

                '(nullIfStringEmpty)field4' => 'field4',
                '(nullIfStringEmpty)field5' => 'field5',
                '(nullIfStringEmpty)field6' => 'field6',
                '(nullIfStringEmpty)field7' => 'field7',
                '(nullIfStringEmpty)field8' => 'field8',
                '(nullIfStringEmpty)field9' => 'field9',

                '(nullIfLessThanZero)field10' => 'field10',
                '(nullIfLessThanZero)field11' => 'field11',
                '(nullIfLessThanZero)field12' => 'field12',
                '(nullIfLessThanZero)field13' => 'field13',
                '(nullIfLessThanZero)field14' => 'field14',
                '(nullIfLessThanZero)field15' => 'field15',

                '(stringToInteger)field16' => 'field16',
                '(stringToInteger)field17' => 'field17',
                '(stringToInteger)field18' => 'field18',
                '(stringToInteger)field19' => 'field19',
                '(stringToInteger)field20' => 'field20',
                '(stringToInteger)field21' => 'field21',
                '(stringToInteger)field22' => 'field22',

                '(getField23)' => 'field23',

                '(dbYNFlagToBoolean)field24' => 'field24',
                '(dbYNFlagToBoolean)field25' => 'field25',
                '(dbYNFlagToBoolean)field26' => 'field26',
                '(dbYNFlagToBoolean)field27' => 'field27',
                '(dbYNFlagToBoolean)field28' => 'field28',
                '(dbYNFlagToBoolean)field29' => 'field29',
                '(dbYNFlagToBoolean)field30' => 'field30',
                '(dbYNFlagToBoolean)field31' => 'field31',
                '(strtoupper)field32' => 'field32',
                '(dbYNFlagToBoolean)field33' => 'field33',
                '(dbYNFlagToBoolean)field34' => 'field34',
                '(substr)field35,0,1' => 'field351',
            ]
        );

        $this->assertSame(
            [
                'field1' => 0.005,
                'field2' => 123.0,
                'field3' => 'asdasd',

                'field4' => 'field4',
                'field5' => null,
                'field6' => null,
                'field7' => null,
                'field8' => 23,
                'field9' => [],

                'field10' => 0.1,
                'field11' => null,
                'field12' => null,
                'field13' => 1,
                'field14' => [],
                'field15' => '-1KH',

                'field16' => '-1KH',
                'field17' => -1,
                'field18' => 1,
                'field19' => '0.1',
                'field20' => 0.1,
                'field21' => 23,
                'field22' => 23,

                'field23' => '10',

                'field24' => true,
                'field25' => false,
                'field26' => false,
                'field27' => 'Y1',
                'field28' => true,
                'field29' => false,
                'field30' => 0,
                'field31' => '1',
                'field32' => 'ASDFGHJ',
                'field33' => false,
                'field34' => false,
                'field351' => 'o',
            ],
            get_object_vars($mapper)
        );
    }

    /**
     *
     * @expectedException \Exception
     * @expectedExceptionMessageRegExp /^Incorrect map syntax in field (\(ddddfield1|\(dddd_field1|\(dddd field1)$/
     *
     * @dataProvider providerTestExceptionIncorrectSignature
     */
    public function testExceptionIncorrectSignature(array $map)
    {
        $objToMap = new \stdClass();
        $objToMap->field1 = 'value1';

        $mapper = new \Tests\Output\MapperMock($objToMap, $map);
    }

    /**
     * @return array
     */
    public function providerTestExceptionIncorrectSignature()
    {
        return [
            [
                ['(ddddfield1' => 'field1']
            ],
            [
                ['(dddd_field1' => 'field1']
            ],
            [
                ['(dddd field1' => 'field1']
            ]
        ];
    }

    /**
     *
     * @expectedException \Exception
     * @expectedExceptionMessageRegExp /^Source object \(stdClass\) doesn't contain (\(dddd\)field1|\(toString\)field1) as property. Check the Mapper.*$/
     *
     * @dataProvider providerTestExceptionMethodNotExists
     */
    public function testExceptionMethodNotExists(array $map)
    {
        $objToMap = new \stdClass();
        $objToMap->field1 = 'value1';

        $mapper = new \Tests\Output\MapperMock($objToMap, $map);
    }

    /**
     * @return array
     */
    public function providerTestExceptionMethodNotExists()
    {
        return [
            [
                ['(dddd)field1' => 'field1']
            ],
            [
                ['(toString)field1' => 'field1']
            ]
        ];
    }

    /**
     *
     * @return \Phalcon\Output\Mapper
     */
    private function getMapperMock()
    {
        return $this->getMockForAbstractClass(
            '\Phalcon\Output\Mapper',
            [],
            '',
            false,
            true,
            true,
            [],
            false
        );
    }

     /**
     * @param $param
     * @param $expected
     *
     * @dataProvider providerTestPrepareToDiffusion
     */

    public function testPrepareToDiffusion($param, $expected)
    {
        $mapper = $this->getMapperMock();
        $reflector = new \ReflectionClass($mapper);
        $methodPrepareToDiffusion = $reflector->getMethod('prepareToDiffusion5');
        $methodPrepareToDiffusion->setAccessible(true);

        $this->assertEquals(
            $methodPrepareToDiffusion->invokeArgs($mapper, [$param]),
            $expected
        );
    }

    /**
     * @return array
     */
    public function providerTestPrepareToDiffusion()
    {
        return [
            ['test', 'TEST'],
            ['Iñtërnâtiônàlizætiøn', 'INTERNATIONALIZAETION'],
            ['?*!$(\\)+^|,.[]', '<Q><A><E><D><O><B><C><P><X><I><M><F><S><R>'],
            ['ÀÁÃÄÅàáâãäå', 'AAAAAAAAAAA'],
            ['Æ, æ', 'AE<M> AE'],
            ['Çç', 'CC'],
            ['ÈÉÊËèéêë', 'EEEEEEEE'],
            ['ÌÍÎÏìíîï', 'IIIIIIII'],
            ['Ðð', 'DHDH'],
            ['ÒÓÔÕÖØòóôõöø', 'OOOOOOOOOOOO'],
            ['ÙÚÛÜùúûü', 'UUUUUUUU'],
            ['ÝýÿŸ', 'YYYY'],
            ['Ññ', 'NN'],
            ['Þþ', 'THTH'],
            ['ß', 'SS'],
            ['(', '<O>'],
            [')', '<C>'],
            ['NEWMARKET (JULY)', 'NEWMARKET <O>JULY<C>'],
        ];
    }

    /**
     * @param $datetime
     * @param $expected
     *
     * @dataProvider providerTestPrepareDiffusionEventName
     */
    public function testPrepareDiffusionEventName(
        $datetime,
        $expected
    ) {
        $mapper = $this->getMapperMock();
        $reflector = new \ReflectionClass($mapper);
        $methodDiffusionEventName = $reflector->getMethod('prepareDiffusionEventName');
        $methodDiffusionEventName->setAccessible(true);
        $this->assertEquals(
            $methodDiffusionEventName->invokeArgs($mapper, [$datetime]),
            $expected
        );
    }

    /**
     * @return array
     */
    public function providerTestPrepareDiffusionEventName()
    {

        return [
            [
                '27 Nov 2014 2:35PM',
                '14:35'
            ],
            [
                '27 Nov 2014 3:35PM',
                '15:35'
            ],
            [
                '27 Nov 2014 8:15AM',
                '08:15'
            ],
        ];
    }

    /**
     * @param $datetime
     * @param $expected
     *
     * @dataProvider providerTestPrepareDiffusionDate
     */
    public function testPrepareDiffusionDate(
        $datetime,
        $expected
    ) {
        $mapper = $this->getMapperMock();
        $reflector = new \ReflectionClass($mapper);
        $methodDiffusionDate = $reflector->getMethod('prepareDiffusionDate');
        $methodDiffusionDate->setAccessible(true);
        $this->assertEquals(
            $methodDiffusionDate->invokeArgs($mapper, [$datetime]),
            $expected
        );
    }

    /**
     * @return array
     */
    public function providerTestPrepareDiffusionDate()
    {

        return [
            [
                '27 Nov 2014 2:35PM',
                '2014-11-27'
            ],
            [
                '27 Dec 2014 3:35PM',
                '2014-12-27'
            ],
            [
                '27 Mov 2014 8:15AM',
                '1970-01-01'
            ]
        ];
    }


    /**
     * @param mixed $value
     * @param mixed $expected
     *
     * @dataProvider providerTestDbYNFlagToBoolean
     */
    public function testDbYNFlagToBoolean($value, $expected)
    {
        $mapper = $this->getMapperMock();
        $reflector = new \ReflectionClass($mapper);
        $dbYNFlagToBooleanMethod = $reflector->getMethod('dbYNFlagToBoolean');
        $dbYNFlagToBooleanMethod->setAccessible(true);
        $this->assertEquals(
            $dbYNFlagToBooleanMethod->invokeArgs($mapper, [$value]),
            $expected
        );
    }

    /**
     * @return array
     */
    public function providerTestDbYNFlagToBoolean()
    {
        return [
            ['Y', true],
            ['N', false],
            ['y', true],
            ['n', false],
            [null, false],
            ['', false],
            ['str', 'str'],
            [true, true],
            [777, 777],
        ];
    }

    /**
     * @expectedException \Exception
     */
    public function testDestinationActionException()
    {
        $objToMap = new \stdClass();
        $objToMap->field1 = 11111;

        $mapper = new \Tests\Output\MapperMock(
            $objToMap,
            [
                'field1' => '(undef->addHorse)mappedField1',
            ]
        );
        get_object_vars($mapper);
    }

    /**
     * @expectedException \Exception
     */
    public function testDestinationActionIncorrectCA()
    {
        $objToMap = new \stdClass();
        $objToMap->field1 = 11111;

        $mapper = new \Tests\Output\MapperMock(
            $objToMap,
            [
                'field1' => '(ca->addHorse)mappedField1',
            ],
            'asd'
        );
        get_object_vars($mapper);
    }

    public function testDestinationAction()
    {
        $objToMap = new \stdClass();
        $objToMap->field1 = 11111;

        $mapper = new \Tests\Output\MapperMock(
            $objToMap,
            [
                'field1' => '(ca->addHorse)mappedField1',
            ],
            new Dummy()
        );
        $this->assertEquals(
            array (
                'mappedField1' => 11111,
            ),
            get_object_vars($mapper)
        );
    }
}
