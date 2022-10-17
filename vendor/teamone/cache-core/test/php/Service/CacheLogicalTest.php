<?php
namespace RP\Test\Cache\Core\Service;

/**
 * Class CacheLogicalTest
 * @package RP\Test\Cache\Core\Service
 */
class CacheLogicalTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @test
     */
    public function readNonCached()
    {
        $sut = $this->getMockBuilder('RP\Cache\Core\Service\Cache')
            ->disableOriginalConstructor()
            ->setMethods(['getTTLSeconds'])
            ->getMock();

        $sut->expects($this->once())
            ->method('getTTLSeconds')
            ->willReturn(0);

        $this->assertNull($sut->read());
    }

    /**
     * @test
     */
    public function readSerializedOutputEmptyForceMode()
    {
        $sut = $this->getMockBuilder('RP\Cache\Core\Service\Cache')
            ->disableOriginalConstructor()
            ->setMethods(['getTTLSeconds', 'getKey', 'forceMode', 'lock'])
            ->getMock();

        $sut->expects($this->once())
            ->method('getTTLSeconds')
            ->willReturn(100);

        $sut->expects($this->once())
            ->method('getKey')
            ->willReturn('key');

        $sut->expects($this->once())
            ->method('forceMode')
            ->willReturn(true);

        $this->assertNull($sut->read());
    }

    /**
     * @test
     */
    public function readNullDto()
    {
        $sut = $this->getMockBuilder('RP\Cache\Core\Service\Cache')
            ->disableOriginalConstructor()
            ->setMethods(['getTTLSeconds', 'getKey', 'forceMode', 'start', 'lock', 'createDTO'])
            ->getMock();

        $sut->expects($this->once())
            ->method('getTTLSeconds')
            ->willReturn(100);

        $sut->expects($this->once())
            ->method('getKey')
            ->willReturn('key');

        $sut->expects($this->once())
            ->method('forceMode')
            ->willReturn(false);

        $sut->expects($this->once())
            ->method('start')
            ->willReturn('serializedContent');

        $sut->expects($this->once())
            ->method('createDTO')
            ->willReturn(null);

        $this->assertNull($sut->read());
    }

    /**
     * @test
     */
    public function readStringContent()
    {
        $expected = new \Phalcon\Http\Response();

        $dtoMock = $this->getMockBuilder('\stdClass')
            ->disableOriginalConstructor()
            ->setMethods(['cacheToResponse'])
            ->getMock();

        $dtoMock->expects($this->once())
            ->method('cacheToResponse')
            ->willReturn($expected);


        $sut = $this->getMockBuilder('RP\Cache\Core\Service\Cache')
            ->disableOriginalConstructor()
            ->setMethods(['getTTLSeconds', 'getKey', 'forceMode', 'start', 'lock', 'createDTO'])
            ->getMock();

        $sut->expects($this->once())
            ->method('getTTLSeconds')
            ->willReturn(100);

        $sut->expects($this->once())
            ->method('getKey')
            ->willReturn('key');

        $sut->expects($this->once())
            ->method('forceMode')
            ->willReturn(false);

        $sut->expects($this->once())
            ->method('start')
            ->willReturn('serializedContent');

        $sut->expects($this->once())
            ->method('createDTO')
            ->willReturn($dtoMock);

        $this->assertEquals($expected, $sut->read());
    }

    /**
     * @test
     */
    public function read()
    {
        $expected = new \Phalcon\Http\Response();

        $responseMock = $this->getMockBuilder('\Phalcon\Http\Response')
            ->disableOriginalConstructor()
            ->setMethods(['getContent'])
            ->getMock();

        $responseMock->expects($this->exactly(2))
            ->method('getContent')
            ->willReturn($expected);

        $dtoMock = $this->getMockBuilder('\stdClass')
            ->disableOriginalConstructor()
            ->setMethods(['cacheToResponse'])
            ->getMock();

        $dtoMock->expects($this->once())
            ->method('cacheToResponse')
            ->willReturn($responseMock);

        $sut = $this->getMockBuilder('RP\Cache\Core\Service\Cache')
            ->disableOriginalConstructor()
            ->setMethods(['getTTLSeconds', 'getKey', 'forceMode', 'start', 'lock', 'createDTO'])
            ->getMock();

        $sut->expects($this->once())
            ->method('getTTLSeconds')
            ->willReturn(100);

        $sut->expects($this->once())
            ->method('getKey')
            ->willReturn('key');

        $sut->expects($this->once())
            ->method('forceMode')
            ->willReturn(false);

        $sut->expects($this->once())
            ->method('start')
            ->willReturn('serializedContent');

        $sut->expects($this->once())
            ->method('createDTO')
            ->willReturn($dtoMock);

        $this->assertEquals($expected, $sut->read());
    }
}