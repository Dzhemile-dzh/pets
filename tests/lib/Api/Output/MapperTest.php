<?php

namespace Tests;

class MapperTest extends \PHPUnit\Framework\TestCase
{
    /**
     *
     * @return \Api\Output\Mapper\HorsesMapper
     */
    private function getMapperMock()
    {
        $mapper = $this->getMockForAbstractClass(
            '\Api\Output\Mapper',
            [],
            '',
            false,
            true,
            true,
            [],
            false
        );


        return $mapper;
    }

    /**
     * @dataProvider providerTestPrepareToPdf
     *
     * @param $dateRaw
     * @param $dateExpected
     */
    public function testPrepareToPdf($dateRaw, $dateExpected)
    {
        $mapper = $this->getMapperMock();
        $reflector = new \ReflectionClass($mapper);
        $methodAddHexPrefix = $reflector->getMethod('prepareToPdf');
        $methodAddHexPrefix->setAccessible(true);

        $this->assertSame(
            $dateExpected,
            $methodAddHexPrefix->invokeArgs($mapper, $dateRaw)
        );
    }

    /**
     * @return array
     */
    public function providerTestPrepareToPdf()
    {
        return [
            [['Hamilton', 'GB'], 'Hamilton'],
            [['hamilton', 'GB'], 'Hamilton'],
            [[' Hamilton ', 'GB'], 'Hamilton'],
            [[' hamilton ', 'GB'], 'Hamilton'],
            [['Ffos Las', 'GB'], 'Ffos_Las'],
            [['Kempton (AW)', 'GB'], 'Kempton'],
            [['Fairyhouse', 'IRE'], 'Fairyhouse'],
            [['fairyhouse', 'IRE'], 'Fairyhouse'],
            [[' Fairyhouse', 'IRE'], 'Fairyhouse'],
            [['fairyhouse ', 'IRE'], 'Fairyhouse'],
            [['Gowran Park', 'IRE'], 'Gowran_Park'],
            [['Dundalk (AW)', 'IRE'], 'Dundalk'],
            [['Chantilly', 'FR'], 'Chantilly'],
            [['chantilly', 'FR'], 'Chantilly'],
            [['Krefeld', 'GER'], 'Krefeld'],
            [['krefeld', 'GER'], 'Krefeld'],
            [[' Capannelle ', 'ITY'], 'Capannelle'],
            [['capannelle ', 'ITY'], 'Capannelle'],
            [[' capannelle', 'ITY'], 'Capannelle'],
            [['Sha Tin', 'HK'], 'Sha_Tin'],
            [['sha Tin', 'HK'], 'Sha_Tin'],
        ];
    }

    /**
     *
     * @dataProvider providerTestAddHexPrefix
     */
    public function testAddHexPrefix($dateRaw, $dateExpected)
    {
        $mapper = $this->getMapperMock();
        $reflector = new \ReflectionClass($mapper);
        $methodAddHexPrefix = $reflector->getMethod('addHexPrefix');
        $methodAddHexPrefix->setAccessible(true);

        $this->assertSame(
            $dateExpected,
            $methodAddHexPrefix->invokeArgs($mapper, [$dateRaw])
        );
    }

    /**
     * @return array
     */
    public function providerTestAddHexPrefix()
    {
        return [
            ['2014-01-01', '2014-01-01'],
            ['avg', 'avg'],
            [1, 1],
            [false, false],
            ['0x0000000000065779', '0x0000000000065779'],
            ['0000000000065779', '0x0000000000065779'],
            ['1', '0x1'],
            ['A', '0xA'],
        ];
    }

    /**
     * @dataProvider provideReturnInValidType
     */
    public function testReturnInValidType($value, $expected)
    {
        $mapper = $this->getMapperMock();
        $reflector = new \ReflectionClass($mapper);
        $methodReturnInValidType = $reflector->getMethod('returnInValidType');
        $methodReturnInValidType->setAccessible(true);
        $this->assertSame(
            $expected,
            $methodReturnInValidType->invokeArgs($mapper, [$value])
        );
    }

    /**
     * @return array
     */
    public function provideReturnInValidType()
    {
        $obj = new \stdClass();
        return [
            [null,null],
            [false,false],
            [0,0],
            ['0',0],
            ['0.0',0.0],
            [1, 1],
            ['1.0', 1.0],
            [2.1, 2.1],
            [[],[]],
            [$obj,$obj],
            ['1.1', 1.1],
            ['12', 12],
            [INF, 'INF'],
            ['test', 'test']
        ];
    }
}
