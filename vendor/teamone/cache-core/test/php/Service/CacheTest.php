<?php
namespace RP\Test\Cache\Core\Service;

/**
 * Class CacheTest
 * @package RP\Test\Cache\Core\Service
 */
class CacheTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @test
     * @dataProvider forceModeData
     * @param boolean $expected
     */
    public function forceModeGet($expected)
    {
        $sut = $this->getMockBuilder('RP\Cache\Core\Service\Cache')
            ->disableOriginalConstructor()
            ->setMethods(null)
            ->getMock();

        $this->setProtectedProperty($sut, 'force', $expected);

        $this->assertEquals($expected, $sut->forceMode());
    }

    /**
     * @see forceMode()
     * @return array
     */
    public function forceModeData()
    {
        return [
            [true],
            [false],
        ];
    }

    /**
     * @test
     * @dataProvider forceModeData
     * @depends forceModeGet
     * @param boolean $expected
     */
    public function forceModeSet($expected)
    {
        $sut = $this->getMockBuilder('RP\Cache\Core\Service\Cache')
            ->disableOriginalConstructor()
            ->setMethods(null)
            ->getMock();

        $sut->forceMode($expected);

        $this->assertEquals($expected, $sut->forceMode());
    }

    /**
     *
     */
    public function checkResponseStatus()
    {

    }

    /**
     * @test
     * @dataProvider checkResponseCacheControlData
     * @param boolean $expected
     * @param string $header
     */
    public function checkResponseCacheControl($expected, $header)
    {
        $headersMock = $this->getMockBuilder('\stdClass')
            ->disableOriginalConstructor()
            ->setMethods(['get'])
            ->getMock();

        $headersMock->expects($this->once())
            ->method('get')
            ->willReturn($header);

        $responseMock = $this->getMockBuilder('\Phalcon\Http\Response')
            ->disableOriginalConstructor()
            ->setMethods(['getHeaders'])
            ->getMock();

        $responseMock->expects($this->once())
            ->method('getHeaders')
            ->willReturn($headersMock);

        $sut = $this->getMockBuilder('RP\Cache\Core\Service\Cache')
            ->disableOriginalConstructor()
            ->setMethods(null)
            ->getMock();

        $actual = $this->callMethod($sut, 'checkResponseCacheControl', [$responseMock]);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @see checkResponseCacheControl()
     * @return array
     */
    public function checkResponseCacheControlData()
    {
        return [
            [false, 'private'],
            [true, 'public'],
        ];
    }

    /**
     * Sets a protected property on a given object via reflection
     *
     * @param $object - instance in which protected value is being modified
     * @param $property - property on instance being modified
     * @param $value - new value of the property being modified
     *
     * @return void
     */
    public function setProtectedProperty($object, $property, $value)
    {
        $reflection = new \ReflectionClass($object);
        $reflection_property = $reflection->getProperty($property);
        $reflection_property->setAccessible(true);
        $reflection_property->setValue($object, $value);
    }

    /**
     * Call non public method
     *
     * @param $object - instance in which protected value is being modified
     * @param $method
     * @param array $params
     *
     * @return mixed
     */
    protected function callMethod($object, $method, array $params)
    {
        $reflector = new \ReflectionClass($object);
        $method = $reflector->getMethod($method);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $params);
    }
}